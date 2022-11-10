<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function orders()
    {
        $title = "Orders Retail";

        return view('order/orders', compact(
            'title'
        ));
    }
}
