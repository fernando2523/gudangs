<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Sale;
use App\Models\Store_equipment_cost;

class OrderController extends Controller
{
    public function orders()
    {
        $title = "Orders Retail";

        $nota = Sale::count('id');
        $qty = Sale::sum('qty');
        $ongkir = Sale::sum('ongkir');
        $gross_sale = Sale::sum('subtotal');
        $expenses = Store_equipment_cost::sum('total_price');
        $discount = 123456;
        $net_sales = 15436565;

        return view('order/orders', compact(
            'title',
            'nota',
            'qty',
            'ongkir',
            'gross_sale',
            'expenses',
            'discount',
            'net_sales',
        ));
    }

    public function load_tborders(Request $request)
    {
        $querys = $request->querys;
        $last_id = $request->last_id;

        if ($last_id == '0') {
            if ($querys == '') {
                $data = Sale::with('details', 'store')
                    ->groupBy('id_invoice')
                    ->orderBy('id_invoice', 'DESC')
                    ->limit(10)
                    ->get();
            } else {
                $data = Sale::with('details', 'store')
                    ->where('id_reseller', $querys)
                    ->orwhere('produk', $querys)
                    ->orwhere('id_invoice', $querys)
                    ->orderBy('id_invoice', 'DESC')
                    ->groupBy('id_invoice')
                    ->limit(10)
                    ->get();
            }
        } else {
            if ($querys == '') {
                $data = Sale::with('details', 'store')
                    ->where('id', '<', $last_id)
                    ->groupBy('id_invoice')
                    ->orderBy('id_invoice', 'DESC')
                    ->limit(10)
                    ->get();
            } else {
                $data = Sale::with('details', 'store')
                    ->where([['id', '<', $last_id], ['id_reseller', $querys]])
                    ->orwhere([['id', '<', $last_id], ['produk', $querys]])
                    ->orwhere([['id', '<', $last_id], ['id_invoice', $querys]])
                    ->orderBy('id_invoice', 'DESC')
                    ->groupBy('id_invoice')
                    ->limit(10)
                    ->get();
            }
        }

        $count = count($data);

        if ($last_id == 'last') {
        } else {
            return view('order.load_tborder', compact(
                'data',
                'count'
            ));
        }
    }
}
