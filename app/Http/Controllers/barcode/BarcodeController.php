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
use App\Models\variation;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as MPDF;

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

            $get_variation = DB::table('variations')
                ->where('id_ware', $id_ware)
                ->where('id_produk', $id_produk)
                ->groupBy('size')->get();

            $get_idpo = DB::table('supplier_orders')
                ->where('id_ware', $id_ware)
                ->where('id_produk', $id_produk)
                ->groupBy('idpo')->get();

            // $get_idpo_variation = DB::table('supplier_variations')
            //     ->where('id_ware', $id_ware)
            //     ->where('id_produk', $id_produk)
            //     ->groupBy('size')->get();

            return view('barcode/barcode_detail', compact(
                'id_produk',
                'id_ware',
                'id_area',
                'get_variation',
                'get_idpo'
            ));
        }
    }
    public function select_size_po(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->value;
            $id_produk = $request->v_id_produk;
            $id_ware = $request->v_id_ware;

            $get_idpo_variation = DB::table('supplier_variations')
                ->where('id_produk', $id_produk)
                ->where('idpo', $idpo)
                ->groupBy('size')->get();

            return view('barcode/select_size_po', compact(
                'idpo',
                'get_idpo_variation'
            ));
        }
    }

    public function printtest()
    {
        $data = [
            'foo' => 'bar'
        ];
        $pdf = MPDF::loadView(
            'print.printtest',
            $data,
            [],
            [
                'format' => 'A5',
                'orientation' => 'L',
                'margin_left' => 1,
                'margin_right ' => 1,
                'margin_top' => 0,
                'margin_bottom' => 0,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]
        );
        return $pdf->stream('document.pdf');
    }
}
