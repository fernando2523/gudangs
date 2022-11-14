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

class OrderController extends Controller
{
    public function orders()
    {
        $title = "Orders Retail";

        return view('order/orders', compact(
            'title'
        ));
    }

    public function load_tborders(Request $request)
    {
        $querys = $request->querys;
        $last_id = $request->last_id;

        if ($querys == '') {
            $data = Sale::with('details', 'store')->where('id', '>', $last_id)->groupBy('id_invoice')->orderBy('id_invoice')->limit(10)->get();
            $data_max = Sale::where('id', '>', $last_id)->groupBy('id_invoice')->orderBy('id_invoice')->limit(10)->get('id');
        } else {
            $data = Sale::with('details', 'store')->where('id', '>', $last_id)->groupBy('id_invoice')->orderBy('id_invoice')->limit(10)->get();
        }

        return view('order.load_tborder', compact(
            'data',
            'data_max'
        ));
    }
}
