<?php

namespace App\Http\Controllers\reportProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Product;

class ReportProductController extends Controller
{
    public function product()
    {
        $title = "Report Product";

        return view('reportProduct/product', compact(
            'title'
        ));
    }

    public function tablereportproduct(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('warehouse', 'image_product', 'product_variation')->groupBy('id_produk')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
