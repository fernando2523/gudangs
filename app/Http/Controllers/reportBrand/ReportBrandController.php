<?php

namespace App\Http\Controllers\reportBrand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Sale;

class ReportBrandController extends Controller
{
    public function brand()
    {
        $title = "Report Brand";

        $get_qty = Sale::sum('qty');
        $get_gross = Sale::all();
        $get_discitem = Sale::all()->sum('diskon_item');
        $get_costs = Sale::all();

        return view('reportBrand/brand', compact(
            'title',
            'get_qty',
            'get_gross',
            'get_discitem',
            'get_costs',
        ));
    }

    public function tablereportbrand(Request $request)
    {
        if ($request->ajax()) {
            $product = Sale::with('brand_qtys', 'brand_gross', 'brand_disc_item', 'brand_costs')->groupBy('id_brand')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
