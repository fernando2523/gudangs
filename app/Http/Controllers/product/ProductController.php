<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Displays;
use App\Models\Sub_category;
use App\Models\warehouse;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_variation;
use App\Models\variation;
use App\Models\Variation_history;
use App\Models\Image_product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
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
        $getsupplier = DB::table('suppliers')->orderBy('id_sup', 'desc')->get();
        $getware = Warehouse::all();

        $get_totalproduk = variation::all()->where('qty', '!=', '0')->groupBy('id_produk')->count('id_produk');
        $get_totalqty = variation::all()->sum('qty');

        $getsproduct = DB::table('products')
            ->select(DB::raw('id_area'), DB::raw('id_ware'), DB::raw('id_produk'))->groupBy('id_ware')->get();

        $getnamewarehouse = Warehouse::all();

        $get_perware = DB::table('variations')
            ->select(
                DB::raw('COUNT(DISTINCT id_produk) as countidproduk'),
                DB::raw('SUM(qty) as totalQty'),
                DB::raw('id_ware'),
            )->where('qty', '!=', '0')->groupBy('id_ware')->get();

        $get_Supplier_Order = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('tanggal'), DB::raw('id_sup'),)->groupBy('idpo', 'tanggal', 'id_sup')->orderBy('idpo', 'desc')->limit(10)->get();

        $selectWarehouse = warehouse::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();

        return view('product.products', compact(
            'title',
            'getbrand',
            'getcategory',
            'getware',
            'getsupplier',
            'get_totalproduk',
            'get_totalqty',
            'get_perware',
            'getsproduct',
            'get_Supplier_Order',
            'getnamewarehouse',
            'selectWarehouse',
            'userware'
        ));
    }

    public function detail_product(Request $request)
    {
        if ($request->ajax()) {
            $id_ware = $request->id_ware;
            $getbrand = brand::all();
            $getcategory = Sub_category::all();

            return view('product/detail_product', compact(
                'id_ware',
                'getbrand',
                'getcategory'
            ));
        }
    }

    public function tableproduct(Request $request, $id_ware)
    {
        if ($request->ajax()) {
            $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();

            if ($id_ware === "all_ware") {
                $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas')->get();
            } elseif ($id_ware === "per_area") {
                $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas')
                    ->where('id_area', '=', $userware[0]->id_area)
                    ->get();
            } else {
                $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas')
                    ->where('id_ware', '=', $id_ware)
                    ->get();
            }

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

    public function load_edit_variation(Request $request)
    {

        if ($request->ajax()) {
            $variationss = variation::all();
            $id_ware = $request->id_ware;
            $id_produk = $request->id_produk;

            return view('load/load_edit_variation', compact(
                'id_ware',
                'id_produk',
                'variationss'
            ));
        }
    }

    public function load_image(Request $request)
    {

        if ($request->ajax()) {
            $dataimg = Image_product::all();
            $id_produk = $request->id_produk;

            return view('load/load_image', compact(
                'id_produk',
                'dataimg'
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
        DB::beginTransaction();
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

        $cek = Product::sharedLock()->count();
        if ($cek === 0) {
            $urut = 1;
            $idproduk = '1' . $get_brand3 . $thn . sprintf("%05s", ($urut));
        } else {
            $ambildata = Product::sharedLock()->get()->last();
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
            $request->file->move(public_path('../../public_html/footbox/product'), $fileName);
            // end get files
            $data_image->img = $fileName;
        }
        $data_image->save();

        $data_ware = DB::table('warehouses')->select(DB::raw('id_ware'), DB::raw('id_area'))->get();
        foreach ($data_ware as $data_wares) {
            // DB PRODUCT
            $data = new Product();
            $data->id_produk = $idproduk;
            $data->id_area = $data_wares->id_area;
            $data->id_ware = $data_wares->id_ware;
            $data->brand = $get_brands3;
            $data->tanggal = $tanggalskrg;
            $data->produk = Str::headline($request->produk);
            $data->desc = null;
            $data->category = $request->category;
            $data->quality = $request->quality;
            $data->n_price = preg_replace("/[^0-9]/", "", $request->n_price);
            $data->r_price = preg_replace("/[^0-9]/", "", $request->r_price);
            $data->g_price = preg_replace("/[^0-9]/", "", $request->g_price);
            $data->m_price = preg_replace("/[^0-9]/", "", $request->m_price);
            $data->users = $getuser;
            $data->save();
            // END DB PRODUCT
        }

        $qtys = 0;
        //GET ID PO
        $thn_bln = $now->format('ym');
        $ceks = Supplier_order::sharedLock()->count();
        if ($ceks === 0) {
            $urut2 = 1;
            $get_idpo = $thn_bln . sprintf("%04s", ($urut2));
        } else {
            $ambildatas = DB::table('supplier_orders')->sharedLock()->select(DB::raw('idpo'))->max('idpo');
            $ceks2 = (int)substr($ambildatas, 4) + 1;
            $get_idpo = $thn_bln . sprintf("%04s", + ($ceks2));
        }
        //END GET IDPO

        //GET ID HISTORY
        $thn_bln_tgl = $now->format('ymd');
        $hitung = Variation_history::sharedLock()->count();
        if ($hitung === 0) {
            $urut3 = 1;
            $get_idhistory = $thn_bln_tgl . sprintf("%04s", ($urut3));
        } else {
            $ambildatas2 = Variation_history::sharedLock()->get()->last();
            $hitung2 = (int)substr($ambildatas2->id_history, 6) + 1;
            $get_idhistory = $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }
        //END ID HISTORY
        $get_supplier_Lama = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('id_sup'),)->where('idpo', '=', $request->id_po_lama)->groupBy('idpo', 'id_sup')->pluck('id_sup');
        $get_supplier_Lama2 = $get_supplier_Lama->toArray();
        $get_supplier_Lama3 = implode(" ", $get_supplier_Lama2);

        $getselectedwarehouse = DB::table('warehouses')->where('id_ware', '=', $request->id_ware)->select(DB::raw('id_ware'), DB::raw('id_area'),)->get();
        if ($request->type_po === "baru") {
            for ($i = 0; $i < Count($request->size); $i++) {
                //DB VARIATION
                $data2 = new variation();
                $data2->tanggal = $tanggalskrg;
                $data2->id_produk = $idproduk;
                $data2->idpo = $get_idpo;
                $data2->id_area = $getselectedwarehouse[0]->id_area;
                $data2->id_ware = $request->id_ware;
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
                $data4->id_area = $getselectedwarehouse[0]->id_area;
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
            $data3->id_ware = $getselectedwarehouse[0]->id_ware;
            $data3->brand = $get_brands3;
            $data3->tanggal = $tanggalskrg;
            $data3->produk = Str::headline($request->produk);
            $data3->qty = $qtys;
            $data3->m_price = preg_replace("/[^0-9]/", "", $request->m_price);
            $data3->subtotal = preg_replace("/[^0-9]/", "", $request->m_price) * $qtys;
            $data3->tipe_order = "RELEASE";
            $data3->users = $getuser;
            $data3->save();
            //END DB SUPPLIER ORDER
        } elseif ($request->type_po === "lama") {
            for ($i = 0; $i < Count($request->size); $i++) {
                //DB VARIATION
                $data2 = new variation();
                $data2->tanggal = $tanggalskrg;
                $data2->id_produk = $idproduk;
                $data2->idpo = $request->id_po_lama;
                $data2->id_area = $getselectedwarehouse[0]->id_area;
                $data2->id_ware = $request->id_ware;
                $data2->users = $getuser;
                $data2->size = $request->size[$i];
                $data2->qty = $request->qty[$i];
                $data2->save();
                $qtys =  $qtys + $request->qty[$i];
                //END DB VARIATION

                //DB SUPPLIER VARIATIONS
                $data4 = new Supplier_variation();
                $data4->idpo = $request->id_po_lama;
                $data4->id_sup = $get_supplier_Lama3;
                $data4->id_produk = $idproduk;
                $data4->id_area = $getselectedwarehouse[0]->id_area;
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
            $data3->idpo = $request->id_po_lama;
            $data3->id_sup = $get_supplier_Lama3;
            $data3->id_produk = $idproduk;
            $data3->id_ware = $request->id_ware;
            $data3->brand = $get_brands3;
            $data3->tanggal = $tanggalskrg;
            $data3->produk = Str::headline($request->produk);
            $data3->qty = $qtys;
            $data3->m_price = preg_replace("/[^0-9]/", "", $request->m_price);
            $data3->subtotal = preg_replace("/[^0-9]/", "", $request->m_price) * $qtys;
            $data3->tipe_order = "RELEASE";
            $data3->users = $getuser;
            $data3->save();
            //END DB SUPPLIER ORDER
        }
        DB::commit();
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
    public function editact(Request $request, $id)
    {
        $get_id_produk = $request->id_produk;

        Product::where('id_produk', $get_id_produk)
            ->update([
                'produk' => Str::headline($request->edit_produk),
                'brand' => $request->edit_id_brand,
                'category' => $request->edit_category,
                'quality' => $request->edit_quality,
                'r_price' => preg_replace("/[^0-9]/", "", $request->edit_r_price),
                'n_price' => preg_replace("/[^0-9]/", "", $request->edit_n_price),
                'g_price' => preg_replace("/[^0-9]/", "", $request->edit_g_price),
            ]);

        Supplier_order::where('id_produk', $get_id_produk)
            ->update([
                'produk' => Str::headline($request->edit_produk),
                'brand' => $request->edit_id_brand,
            ]);

        $getimg = Image_product::all()->where('id_produk', '=', $request->id_produk)->pluck('id');
        $getimg2 = $getimg->toArray();
        $getimg3 = implode(" ", $getimg2);
        $id = $getimg3;

        $data = Image_product::find($id);
        if (empty($_FILES['file']['name'][0])) {
        } else {
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);

            if ($data->img === "") {
            } else {
                $image = Image_product::find($id);
                unlink("product/" . $image->img);
            }

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('../../public_html/footbox/product'), $fileName);
            $data->img = $fileName;
        }
        $data->update();

        return redirect('product/products');
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
    public function destroy(Request $request, $id)
    {
        DB::table('products')->where('id_produk', $request->del_id_produk)->delete();
        DB::table('variations')->where('id_produk', $request->del_id_produk)->delete();

        $image = DB::table('image_products')->where('id_produk', $request->del_id_produk)->get();
        foreach ($image as $images) {
            if ($images->id_produk === "" or $images->id_produk === null or $images->img === null or $images->img === "") {
                DB::table('image_products')->where('id_produk', $request->del_id_produk)->delete();
            } else {
                unlink("product/" . $images->img);
                DB::table('image_products')->where('id_produk', $request->del_id_produk)->delete();
            }
        }

        return redirect('product/products');
    }

    public function displays()
    {
        $selectStore = Store::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();
        $title = 'Displays Product';
        $warehouse = warehouse::all();

        return view('displays.displays', compact(
            'selectStore',
            'userware',
            'title',
            'warehouse'
        ));
    }

    public function load_display(Request $request)
    {
        // if ($request->ajax()) {
        $id_store = $request->store;
        $id_ware = $request->id_ware;
        $getbrand = brand::all();
        $getcategory = Sub_category::all();

        return view('displays.load_displays', compact(
            'id_store',
            'id_ware',
            'getbrand',
            'getcategory'
        ));
        // }
    }

    public function tabledisplay(Request $request, $id_ware)
    {
        if ($request->ajax()) {
            $product = Product::with('store', 'image_product', 'display')->where('id_ware', $id_ware)->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function add_display(Request $request)
    {
        $now = Carbon::now('Asia/Bangkok');
        $tanggalskrg = Date('Y-m-d');

        $data = new Displays();
        $data->tanggal = $tanggalskrg;
        $data->id_produk = $request->id_produk;
        $data->id_area = $request->id_area;
        $data->id_ware = $request->id_ware;
        $data->id_store = $request->id_store;
        $data->brand = $request->brand;
        $data->produk = $request->produk;
        $data->size = $request->size;
        $data->qty = $request->qty;
        $data->users = Auth::user()->name;
        $data->save();

        return redirect('/displays_product');
    }

    public function remove_display(Request $request)
    {
        Displays::where('id', $request->id_display)->delete();

        return redirect('/displays_product');
    }
}
