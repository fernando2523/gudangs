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

class ReportBrandController extends Controller
{
    public function brand()
    {
        $title = "Report Brand";

        return view('reportBrand/brand', compact(
            'title'
        ));
    }

    public function tablereportbrand(Request $request)
    {
        if ($request->ajax()) {
            $product = Brand::latest()->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
