<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\brand;
use App\Models\Sub_category;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        $title = "Products";

        $getbrand = brand::all();
        $getcategory = Sub_category::all();
        $getware = Warehouse::all();
        $getsupplier = Supplier::all();

        return view('product.products', compact(
            'title',
            'getbrand',
            'getcategory',
            'getware',
            'getsupplier'
        ));
    }

    public function tableproduct(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('product_variation')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function load_variation(Request $request)
    {
        if ($request->ajax()) {
            $search = $_POST['variasi'];

            return view('load/load_variation', compact(
                'search'
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $getuser = Auth::user()->name;
        $tanggalskrg = Date('Y-m-d');

        $getbrand = $request->id_brand;
        $get_brand = DB::table('brands')
            ->where('id_brand', '=', $getbrand)
            ->pluck('code');
        $get_brand2 = $get_brand->toArray();
        $get_brand3 = implode(" ", $get_brand2);

        $cek = Product::count();

        $now = Carbon::now('Asia/Bangkok');
        $thn = $now->format('y');
        if ($cek === 0) {
            $urut = 1;
            $idproduk = '1' . $get_brand3 . $thn . sprintf("%05s", ($urut));
        } else {
            $ambildata = Product::all()->max('id_produk');
            $cek2 = (int)substr($ambildata, -5) + 1;
            $idproduk = '1' . $get_brand3 . $thn . sprintf("%05s", + ($cek2));
        }

        // $data = new Product();
        // $data->id_produk = $idproduk;
        // $data->id_ware = $request->id_ware;
        // $data->brand = $get_brand3;
        // $data->tanggal = $tanggalskrg;
        // $data->produk = $request->produk;
        // $data->desc = null;
        // $data->category = $request->category;
        // $data->quality = $request->quality;
        // $data->n_price = $request->n_price;
        // $data->r_price = $request->r_price;
        // $data->g_price = $request->g_price;
        // $data->m_price = $request->m_price;

        // if (empty($_FILES['file']['name'][0])) {
        //     $data->img = "";
        // } else {
        //     // get file
        //     $request->validate([
        //         'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        //     ]);
        //     $fileName = time() . '.' . $request->file->extension();
        //     $request->file->move(public_path('product'), $fileName);
        //     // end get files
        //     $data->img = $fileName;
        // }
        // $data->users = $getuser;
        // $data->save();

        $data2 = new variation();
        $data2->tanggal = $tanggalskrg;
        $data2->id_produk = $idproduk;
        $data2->id_ware = $request->id_ware;

        // $sizes = variation::get('size');
        $data2_get = array();

        foreach ($request->size as $sizes2) {
            $data2_get[] = new variation(array(
                'size' => $sizes2['size'],
                'qty' => $sizes2['qty'],
            ));
        }
        $data2->users = $getuser;
        $data2->saveMany();
        // $data2->sizes()->saveMany($data2_get);

        return redirect('product/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
