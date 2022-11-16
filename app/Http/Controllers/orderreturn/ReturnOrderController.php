<?php

namespace App\Http\Controllers\orderreturn;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Store_equipment_cost;
use App\Models\Return_order;

class ReturnOrderController extends Controller
{
    public function return()
    {
        $title = "Return";

        return view('orderreturn/return', compact(
            'title'
        ));
    }

    public function tablereturn(Request $request)
    {
        if ($request->ajax()) {
            $data = Return_order::with('stores', 'warehouses')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function table_rincian_return(Request $request, $id_invoice)
    {
        if ($request->ajax()) {
            $data = Return_order::with('stores', 'warehouses')->where('id_invoice', '=', $id_invoice)->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function rincian_return(Request $request)
    {
        if ($request->ajax()) {
            $id_invoice = $request->id_invoice;
            $desc = $request->desc;

            return view('orderreturn/rincian_return', compact(
                'id_invoice',
                'desc',
            ));
        }
    }
}
