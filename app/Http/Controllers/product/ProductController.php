<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\brand;
use App\Models\Sub_category;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_variation;
use App\Models\variation;
use App\Models\Variation_history;
use App\Models\Image_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

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

        // $dataproduk = DB::table('products')
        //     ->select('id_ware')
        //     ->groupBy('id_ware')
        //     ->get();

        // $datass = $dataproduk->toArray();
        // $product = Product::with('product_variation')
        //     ->whereIn('id_ware', ['WARE-2'])
        //     ->get();

        // $now = Carbon::now('Asia/Bangkok');

        // dd($get_idpo);

        return view('product.products', compact(
            'title',
            'getbrand',
            'getcategory',
            'getware',
            'getsupplier',
        ));
    }

    public function tableproduct(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('warehouse', 'image_product', 'product_variation')->get();

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
        $getbrand = $request->id_brand;
        $get_brand = DB::table('brands')->where('id_brand', '=', $getbrand)->pluck('code');
        $get_brand2 = $get_brand->toArray();
        $get_brand3 = implode(" ", $get_brand2);

        $get_brands = DB::table('brands')->where('id_brand', '=', $getbrand)->pluck('brand');
        $get_brands2 = $get_brands->toArray();
        $get_brands3 = implode(" ", $get_brands2);

        $now = Carbon::now('Asia/Bangkok');
        $thn = $now->format('y');
        $tanggalskrg = Date('Y-m-d');

        $getuser = Auth::user()->name;

        $cek = Product::count();
        if ($cek === 0) {
            $urut = 1;
            $idproduk = '1' . $get_brand3 . $thn . sprintf("%05s", ($urut));
        } else {
            $ambildata = Product::all()->last();
            $cek2 = (int)substr($ambildata->id_produk, 5) + 1;
            $idproduk = '1' . $get_brand3 . $thn . sprintf("%05s", + ($cek2));
        }

        $data_image = new Image_product();
        $data_image->id_produk = $idproduk;
        if (empty($_FILES['file']['name'][0])) {
            $data_image->img = "";
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('product'), $fileName);
            // end get files
            $data_image->img = $fileName;
        }
        $data_image->save();

        $data_ware = Warehouse::all();
        foreach ($data_ware as $data_wares) {
            // DB PRODUCT
            $data = new Product();
            $data->id_produk = $idproduk;
            $data->id_ware = $data_wares->id_ware;
            $data->brand = $get_brands3;
            $data->tanggal = $tanggalskrg;
            $data->produk = Str::headline($request->produk);
            $data->desc = null;
            $data->category = $request->category;
            $data->quality = $request->quality;
            $data->n_price = $request->n_price;
            $data->r_price = $request->r_price;
            $data->g_price = $request->g_price;
            $data->m_price = $request->m_price;
            $data->users = $getuser;
            $data->save();
            // END DB PRODUCT


            $qtys = 0;
            if ($data_wares->id_ware == $request->id_ware) {
                //GET ID PO
                $thn_bln = $now->format('ym');
                $ceks = Supplier_order::count();
                if ($ceks === 0) {
                    $urut2 = 1;
                    $get_idpo = $thn_bln . sprintf("%04s", ($urut2));
                } else {
                    $ambildatas = Supplier_order::all()->last();
                    $ceks2 = (int)substr($ambildatas->idpo, 4) + 1;
                    $get_idpo = $thn_bln . sprintf("%04s", + ($ceks2));
                }
                //END GET IDPO

                //GET ID HISTORY
                $thn_bln_tgl = $now->format('ymd');
                $hitung = Variation_history::count();
                if ($hitung === 0) {
                    $urut3 = 1;
                    $get_idhistory = $thn_bln_tgl . sprintf("%04s", ($urut3));
                } else {
                    $ambildatas2 = Variation_history::all()->last();
                    $hitung2 = (int)substr($ambildatas2->id_history, 6) + 1;
                    $get_idhistory = $thn_bln_tgl . sprintf("%04s", + ($hitung2));
                }
                //END ID HISTORY
                for ($i = 0; $i < Count($request->size); $i++) {
                    //DB VARIATION
                    $data2 = new variation();
                    $data2->tanggal = $tanggalskrg;
                    $data2->id_produk = $idproduk;
                    $data2->id_ware = $data_wares->id_ware;
                    $data2->users = $getuser;
                    $data2->size = $request->size[$i];
                    $data2->qty = $request->qty[$i];
                    $data2->save();
                    $qtys =  $qtys + $request->qty[$i];
                    //END DB VARIATION

                    //DB SUPPLIER VARIATIONS
                    $data4 = new Supplier_variation();
                    $data4->idpo = $get_idpo;
                    $data4->id_sup = $request->id_sup;
                    $data4->id_produk = $idproduk;
                    $data4->id_ware = $request->id_ware;
                    $data4->tanggal = $tanggalskrg;
                    $data4->size = $request->size[$i];
                    $data4->qty = $request->qty[$i];
                    $data4->tipe_order = "RELEASE";
                    $data4->users = $getuser;
                    $data4->save();
                    //END DB SUPPLIER VARIATIONS

                    //DB VARIATIONS_HISTORIES
                    $data5 = new Variation_history();
                    $data5->tanggal = $tanggalskrg;
                    $data5->id_history = $get_idhistory;
                    $data5->id_produk = $idproduk;
                    $data5->id_ware = $request->id_ware;
                    $data5->size = $request->size[$i];
                    $data5->qty = $request->qty[$i];
                    $data5->users = $getuser;
                    $data5->save();
                    //END DB VARIATIONS_HISTORIES
                }
                //DB SUPPLIER ORDER
                $data3 = new Supplier_order();
                $data3->idpo = $get_idpo;
                $data3->id_sup = $request->id_sup;
                $data3->id_produk = $idproduk;
                $data3->id_ware = $request->id_ware;
                $data3->brand = $get_brands3;
                $data3->tanggal = $tanggalskrg;
                $data3->produk = Str::headline($request->produk);
                $data3->qty = $qtys;
                $data3->m_price = $request->m_price;
                $data3->subtotal = $request->m_price * $qtys;
                $data3->tipe_order = "RELEASE";
                $data3->users = $getuser;
                $data3->save();
                //END DB SUPPLIER ORDER

            } else {
                for ($i = 0; $i < Count($request->size); $i++) {
                    $data2 = new variation();
                    $data2->tanggal = $tanggalskrg;
                    $data2->id_produk = $idproduk;
                    $data2->id_ware = $data_wares->id_ware;
                    $data2->users = $getuser;
                    $data2->size = $request->size[$i];
                    $data2->qty = '0';
                    $data2->save();
                }
            }
            // End DB VARIATION


        }

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
