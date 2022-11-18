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

class ReportQualityController extends Controller
{
    public function quality()
    {
        $title = "Report Quality";

        return view('reportQuality/quality', compact(
            'title'
        ));
    }

    public function tablereportquality(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::latest()->groupBy('quality')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
