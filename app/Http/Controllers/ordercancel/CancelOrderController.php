<?php

namespace App\Http\Controllers\ordercancel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Cancel_order;
use Illuminate\Support\Str;
use App\Models\Store_equipment_cost;

class CancelOrderController extends Controller
{
    public function cancel()
    {
        $title = "Cancel Order";

        return view('ordercancel/cancel', compact(
            'title'
        ));
    }

    public function tablecancel(Request $request)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->get();

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

            return view('ordercancel/rincian_cancel', compact(
                'id_invoice',
                'desc',
            ));
        }
    }
}
