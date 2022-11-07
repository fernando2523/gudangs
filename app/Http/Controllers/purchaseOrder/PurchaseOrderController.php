<?php

namespace App\Http\Controllers\purchaseOrder;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\brand;
use App\Models\Sub_category;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_variation;
use App\Models\variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class PurchaseOrderController extends Controller
{
    public function purchaseorder()
    {
        $title = "Purchase Order";
        $datapo = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('tanggal'), DB::raw('users'),)->groupBy('idpo', 'tanggal', 'users')->limit(10)->get();
        $datapoDetail = Supplier_order::all();
        $datamodal = DB::table('supplier_orders')->select(DB::raw('SUM(m_price) as modals'), DB::raw('idpo'),)->groupBy('idpo')->get();
        $datasubtotal = DB::table('supplier_orders')->select(DB::raw('SUM(subtotal) as subtotals'), DB::raw('idpo'),)->groupBy('idpo')->get();
        $supplier = Supplier::all();
        $totalpo = Supplier_order::all('idpo')->groupBy('idpo')->count('idpo');
        $totalmodal = Supplier_order::all('subtotal')->sum('subtotal');
        $datatotalqty = DB::table('supplier_orders')->select(DB::raw('SUM(qty) as total_qty'), DB::raw('idpo'),)->groupBy('idpo')->get();

        return view('purchase/purchaseorder', compact(
            'title',
            'datapo',
            'datapoDetail',
            'datamodal',
            'datasubtotal',
            'supplier',
            'totalpo',
            'totalmodal',
            'datatotalqty'
        ));
    }

    public function load_purchase_order(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->idpo;
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            $get_variation = Supplier_variation::all();

            return view('purchase/load_purchase_order', compact(
                'idpo',
                'id_produk',
                'id_ware',
                'produk',
                'get_variation'
            ));
        }
    }

    public function purchase_variation(Request $request)
    {
        if ($request->ajax()) {
            $idpo = $request->idpo;
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            $id_sup = $request->id_sup;
            $m_price = $request->m_price;
            $tipe_order = $request->tipe_order;
            $variationss = Supplier_variation::all();

            return view('purchase/purchase_variation', compact(
                'idpo',
                'id_produk',
                'id_ware',
                'produk',
                'id_sup',
                'm_price',
                'tipe_order',
                'variationss'
            ));
        }
    }
}
