<?php

namespace App\Http\Controllers\barcode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;

class BarcodeController extends Controller
{
    public function barcodes()
    {
        $title = "Barcode";

        return view('barcode.barcodes', compact(
            'title'
        ));
    }

    public function tablebarcode(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function barcode_detail(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $id_area = $request->id_area;

            return view('barcode/barcode_detail', compact(
                'id_produk',
                'id_ware',
                'id_area',
            ));
        }
    }
}
