<?php

namespace App\Http\Controllers\productTransfer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Image_product;

class ProductTransferController extends Controller
{
    public function productTransfers()
    {
        $title = "Product Transfer";

        return view('productTransfer/productTransfers', compact(
            'title',
        ));
    }

    public function tableproducttransfer(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('warehouse', 'image_product', 'product_variation2')->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function load_product_transfer(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;
            $id_area = $request->id_area;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            $brand = $request->brand;
            $quality = $request->quality;
            $category = $request->category;

            $dataimg = Image_product::all();
            $getwarehouse_awal = DB::table('warehouses')->where('id_ware', $id_ware)->get();
            $getwarehouse_tujuan = DB::table('warehouses')->get();
            $variationss = DB::table('variations')->select(DB::raw('SUM(qty) as qty'), DB::raw('id_produk'), DB::raw('id_ware'), DB::raw('size'))->where('id_ware', '=', $id_ware)->groupBy('size', 'id_produk')->get();

            return view('productTransfer/load_product_transfer', compact(
                'id_produk',
                'id_area',
                'id_ware',
                'produk',
                'brand',
                'quality',
                'category',
                'dataimg',
                'getwarehouse_awal',
                'getwarehouse_tujuan',
                'variationss'
            ));
        }
    }

    public function transfer()
    {
    }
}
