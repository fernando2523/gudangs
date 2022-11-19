<?php

namespace App\Http\Controllers\reportStore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Sale;

class ReportStoreController extends Controller
{
    public function store()
    {
        $title = "Report Store";

        $get_qty = Sale::sum('qty');
        $get_gross = Sale::all();
        $get_discitem = Sale::all()->sum('diskon_item');
        $get_costs = Sale::all();

        return view('reportStore/store', compact(
            'title',
            'get_qty',
            'get_gross',
            'get_discitem',
            'get_costs',
        ));
    }

    public function tablereportstore(Request $request)
    {
        if ($request->ajax()) {
            $product =  Sale::with('store_qtys', 'store_gross', 'store_disc_item', 'store_costs')->groupBy('id_store')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
