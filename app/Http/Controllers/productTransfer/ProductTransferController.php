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
use App\Models\warehouse;

class ProductTransferController extends Controller
{
    public function productTransfers()
    {
        $title = "Product Transfer";

        $selectWarehouse = warehouse::all();

        return view('productTransfer/productTransfers', compact(
            'title',
            'selectWarehouse'
        ));
    }

    public function detail_product_transfer(Request $request)
    {
        if ($request->ajax()) {
            $id_ware = $request->id_ware;

            return view('productTransfer/detail_product_transfer', compact(
                'id_ware',
            ));
        }
    }

    public function tableproducttransfer(Request $request, $id_ware)
    {
        if ($request->ajax()) {

            if ($id_ware === "all_ware") {
                $product = Product::with('warehouse', 'image_product', 'product_variation2')
                    ->get();
            } else {
                $product = Product::with('warehouse', 'image_product', 'product_variation2')
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
