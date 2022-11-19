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
use App\Models\Sale;

class ReportProductController extends Controller
{
    public function product()
    {
        $title = "Report Product";

        $get_qty = Sale::sum('qty');
        $get_gross = Sale::all();

        return view('reportProduct/product', compact(
            'title',
            'get_gross',
            'get_qty'
        ));
    }

    public function tablereportproduct(Request $request)
    {
        if ($request->ajax()) {
            $product = Sale::with('image_product', 'qtys', 'disc_item', 'disc_all', 'gross', 'costs', 'profit')->groupBy('id_produk')->get();
            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
