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
        $get_sales = Sale::all()->groupBy('id_invoice')->count('id_invoice');
        $get_qty = Sale::all()->sum('qty');
        $get_expense = Store_equipment_cost::all()->sum('total_price');

        $get_payment = DB::table('sales')->select(DB::raw('SUM(cash) as cashs'), DB::raw('SUM(bca) as bcas'), DB::raw('SUM(qris) as qriss'))->groupBy('id_invoice')->get();
        $getTop_product = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('produk'), DB::raw('id_brand'))->groupBy('id_produk')->limit(10)->get();
        $getTop_reseller = DB::table('sales')->select(DB::raw('SUM(qty) as qtys'), DB::raw('id_reseller'))->where('customer', '=', 'RESELLER')->groupBy('id_reseller')->limit(10)->get();

        $payment = intval($get_payment[0]->cashs) + intval($get_payment[0]->bcas) + intval($get_payment[0]->qriss);
        $getTotalpayment = $payment - $get_expense;
        // dd($getTotalpayment);

        return view('dashboard.dashboards', compact(
            'title',
            'get_sales',
            'get_qty',
            'get_expense',
            'get_payment',
            'getTop_product',
            'getTop_reseller',
            'getTotalpayment'
        ));
    }
}
