<?php

namespace App\Http\Controllers\ordercancel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cancel_order;
use App\Models\Reseller;
use App\Models\Store;
use Illuminate\Support\Str;
use App\Models\Store_equipment_cost;

class CancelOrderController extends Controller
{
    public function cancel()
    {
        $title = "Cancel Order";
        // $getdata = DB::table('cancel_orders')
        //     ->where('id_invoice', '=', '1105496')
        //     ->select(DB::raw('id_invoice'), DB::raw('id_reseller'), DB::raw('tanggal'), DB::raw('id_store'), DB::raw('SUM(qty) as totalqty'), DB::raw('SUM(diskon_item) as diskon_items'), DB::raw('SUM(diskon_all) as diskon_alls'))
        //     ->groupBy('id_invoice')->get();

        // $hasil = intval($getdata[0]->diskon_items) + intval($getdata[0]->diskon_alls);
        // dd($hasil);

        return view('ordercancel/cancel', compact(
            'title'
        ));
    }

    public function tablecancel(Request $request)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->where('tipe_refund', '=', 'CANCEL')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function table_rincian_cancel(Request $request, $id_invoice)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->where('id_invoice', '=', $id_invoice)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function rincian_cancel(Request $request)
    {
        if ($request->ajax()) {
            $id_invoice = $request->id_invoice;
            $desc = $request->desc;
            $getdata = DB::table('cancel_orders')
                ->where('id_invoice', '=', $id_invoice)
                ->select(DB::raw('id_invoice'), DB::raw('id_reseller'), DB::raw('tanggal'), DB::raw('id_store'), DB::raw('SUM(qty) as totalqty'), DB::raw('SUM(diskon_item) as diskon_items'), DB::raw('SUM(diskon_all) as diskon_alls'), DB::raw('SUM(grandtotal) as grandtotals'), DB::raw('SUM(grandtotal) as grandtotals'), DB::raw('customer'), DB::raw('id_reseller'), DB::raw('cash'), DB::raw('bca'), DB::raw('qris'))
                ->groupBy('id_invoice')->get();
            $discount = intval($getdata[0]->diskon_items) + intval($getdata[0]->diskon_alls);

            $getstore = Store::all()->where('id_store', '=', $getdata[0]->id_store);
            $getreseller = Reseller::all()->where('id_reseller', '=', $getdata[0]->id_reseller);


            return view('ordercancel/rincian_cancel', compact(
                'id_invoice',
                'desc',
                'getdata',
                'discount',
                'getstore',
                'getreseller'
            ));
        }
    }
}
