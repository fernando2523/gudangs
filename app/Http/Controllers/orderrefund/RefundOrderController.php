<?php

namespace App\Http\Controllers\orderrefund;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Store_equipment_cost;
use App\Models\Cancel_order;

class RefundOrderController extends Controller
{
    public function refund()
    {
        $title = "Refund";

        return view('orderrefund/refund', compact(
            'title'
        ));
    }

    public function tablerefund(Request $request)
    {
        if ($request->ajax()) {
            $data = Cancel_order::with('stores', 'warehouses')->where('tipe_refund', '=', 'REFUND')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function table_rincian_refund(Request $request, $id_invoice)
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

    public function rincian_refund(Request $request)
    {
        if ($request->ajax()) {
            $id_invoice = $request->id_invoice;
            $desc = $request->desc;

            return view('orderrefund/rincian_refund', compact(
                'id_invoice',
                'desc',
            ));
        }
    }
}
