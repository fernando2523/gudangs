<?php

namespace App\Http\Controllers\reportQuality;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Sale;

class ReportQualityController extends Controller
{
    public function quality()
    {
        $title = "Report Quality";

        $get_qty = Sale::sum('qty');
        $get_gross = Sale::all();
        $get_discitem = Sale::all()->sum('diskon_item');
        $get_costs = Sale::all();

        return view('reportQuality/quality', compact(
            'title',
            'get_qty',
            'get_gross',
            'get_discitem',
            'get_costs',
        ));
    }

    public function tablereportquality(Request $request)
    {
        if ($request->ajax()) {
            $product = Sale::with('quality_qtys', 'quality_gross', 'quality_disc_item', 'quality_costs')->groupBy('quality')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
