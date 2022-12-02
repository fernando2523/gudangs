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
use App\Models\Store;
use App\Models\variation;
use App\Models\warehouse;
use Meneses\LaravelMpdf\Facades\LaravelMpdf as MPDF;

class BarcodeController extends Controller
{
    public function barcodes()
    {
        $title = "Barcode";

        $selectWarehouse = warehouse::all();
        $userware = DB::table('stores')->where('id_store', '=', Auth::user()->id_store)->get();

        return view('barcode.barcodes', compact(
            'title',
            'selectWarehouse',
            'userware'
        ));
    }

    public function load_barcode(Request $request)
    {
        if ($request->ajax()) {
            $id_ware = $request->id_ware;

            return view('barcode/load_barcode', compact(
                'id_ware',
            ));
        }
    }

    public function tablebarcode(Request $request, $id_ware)
    {
        if ($request->ajax()) {
            if ($id_ware === "all_ware") {
                $product = Product::with('warehouse', 'image_product', 'product_variation', 'areas')
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
                ->groupBy('size')
                ->get();

            return view('barcode/select_size_po', compact(
                'idpo',
                'get_idpo_variation'
            ));
        }
    }

    public function printtest(Request $request)
    {
        $size = $request->size;
        $qty = $request->qty;
        $idpo = $request->idpo;
        $tipe_print = $request->tipe_print;
        $size_custom = $request->size_custom;
        $v_id_produk = $request->v_id_produk;
        $v_id_ware = $request->v_id_ware;

        // print_r($size_custom);
        // print_r('<br>');
        // print_r($qty);
        // print_r('<br>');
        // print_r($tipe_print);
        // print_r('<br>');
        // print_r($idpo);
        // print_r('<br>');
        // print_r($size);
        // print_r('<br>');
        // print_r($v_id_produk);
        // print_r('<br>');
        // print_r($v_id_ware);
        // print_r('<br>');

        $data = [
            'size' => $size,
            'qty' => $qty,
            'v_id_produk' => $v_id_produk,
            'idpo' => $idpo,
        ];
        $pdf = MPDF::loadView(
            'print.printtest',
            $data,
            [],
            [
                'format' => 'A5',
                'orientation' => 'L',
                'margin_left' => -0,
                'margin_right ' => -20,
                'margin_top' => 5,
                'margin_bottom' => -10,
                'margin_header' => 0,
                'margin_footer' => 0,
            ]
        );

        return $pdf->stream('document.pdf');
    }
}
