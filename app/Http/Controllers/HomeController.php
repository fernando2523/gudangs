<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Sale;
use App\Models\Store_equipment_cost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Dashboard";
        $store = Store::all();

        return view('dashboard.dashboards', compact(
            'title',
            'store'
        ));
    }

    public function load_db(Request $request)
    {
        $store = $request->store;
        $start = $request->start;
        $end = $request->end;

        if ($store === 'ALL') {
            $get_sales = Sale::all()->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->count('id_invoice');
            $get_qty = Sale::all()->whereBetween('tanggal', [$start, $end])->sum('qty');
            $get_expense = Store_equipment_cost::all()->whereBetween('tanggal', [$start, $end])->sum('total_price');
        } else {
            $get_sales = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->groupBy('id_invoice')->count('id_invoice');
            $get_qty = Sale::all()->where('id_store', $store)->whereBetween('tanggal', [$start, $end])->sum('qty');
            $get_expense = Store_equipment_cost::all()->where('store', $store)->whereBetween('tanggal', [$start, $end])->sum('total_price');
        }

        $get_payment = DB::table('sales')->select(DB::raw('SUM(cash) as cashs'), DB::raw('SUM(bca) as bcas'), DB::raw('SUM(qris) as qriss'))->groupBy('id_invoice')->get();
        $getTop_product = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('produk'), DB::raw('id_brand'))->groupBy('id_produk')->limit(10)->get();
        $getTop_reseller = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('id_reseller'))->where('customer', '=', 'RESELLER')->groupBy('id_reseller')->limit(10)->get();

        if (count($get_payment) > 0) {
            $payment = intval($get_payment[0]->cashs) + intval($get_payment[0]->bcas) + intval($get_payment[0]->qriss);
            $getTotalpayment = $payment - $get_expense;
        } else {
            $payment = 0;
            $getTotalpayment = $payment - $get_expense;
        }

        return view('dashboard.load_dashboard', compact(
            'get_sales',
            'get_qty',
            'get_expense',
            'get_payment',
            'getTop_product',
            'getTop_reseller',
            'getTotalpayment',
            'store',
            'start',
            'end'
        ));
    }
}
