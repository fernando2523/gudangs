<?php

namespace App\Http\Controllers\reportSummary;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Sale;
use App\Models\Store_equipment_cost;

class ReportSummaryController extends Controller
{
    public function summary()
    {
        $title = "Report Summary";

        $nota = Sale::selectRaw('count(DISTINCT id_invoice) as id_invoice')->get('id_invoice');
        $qty = Sale::sum('qty');
        $ongkir = Sale::selectRaw('ongkir')->groupBy('id_invoice')->get();
        $gross_sale = Sale::all();
        $expenses = Store_equipment_cost::sum('total_price');
        $discount_item = Sale::sum('diskon_item');
        $discount_all = Sale::selectRaw('diskon_all')->groupBy('id_invoice')->get('diskon_all');
        $cost = Sale::all();

        return view('reportSummary/summary', compact(
            'title',
            'nota',
            'qty',
            'ongkir',
            'gross_sale',
            'expenses',
            'discount_item',
            'discount_all',
            'cost',
        ));
    }

    public function load_tbsummary(Request $request)
    {
        $querys_result = $request->querys;
        $last_id = $request->last_id;
        $pages = $request->pages;
        $limit = 10;
        $current_page = ($pages * $limit) - ($limit - 1);

        if ($last_id == '0') {
            if ($querys_result == '') {
                $data = Sale::with('details2', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                    ->groupBy('id_invoice')
                    ->orderBy('id_invoice', 'DESC')
                    ->limit(10)
                    ->get();
            } else {
                $data = Sale::with('details2', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                    ->where('id_reseller', $querys_result)
                    ->orwhere('produk',  'Like', '%' . $querys_result . '%')
                    ->orwhere('id_produk',  $querys_result)
                    ->orwhere('id_invoice', $querys_result)
                    ->orwhere('users', $querys_result)

                    ->orderBy('id_invoice', 'DESC')
                    ->groupBy('id_invoice')
                    ->limit(10)
                    ->get();
            }
        } else {
            if ($querys_result == '') {
                $data = Sale::with('details2', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                    ->where('id_invoice', '<', $last_id)

                    ->groupBy('id_invoice')
                    ->orderBy('id_invoice', 'DESC')
                    ->limit(10)
                    ->get();
            } else {
                $data = Sale::with('details2', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                    ->where([['id_invoice', '<', $last_id], ['id_reseller', $querys_result]])
                    ->orwhere([['id_invoice', '<', $last_id], ['produk',  'Like', '%' . $querys_result . '%']])
                    ->orwhere([['id_invoice', '<', $last_id], ['id_produk', $querys_result]])
                    ->orwhere([['id_invoice', '<', $last_id], ['id_invoice', $querys_result]])
                    ->orwhere([['id_invoice', '<', $last_id], ['users', $querys_result]])

                    ->orderBy('id_invoice', 'DESC')
                    ->groupBy('id_invoice')
                    ->limit(10)
                    ->get();
            }
        }

        $count = count($data);

        if ($last_id == 'last') {
        } else {
            return view('reportSummary.load_tbsummary', compact(
                'data',
                'count',
                'current_page'
            ));
        }
    }
}
