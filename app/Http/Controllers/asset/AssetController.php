<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\brand;
use App\Models\Sub_category;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_variation;
use App\Models\variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class AssetController extends Controller
{
    public function assets()
    {
        $title = "Assets";

        $qtyasset = DB::table('variations')->select(DB::raw('SUM(qty) as totalqty'),)->get();
        $modalasset = DB::table('products')->select(DB::raw('SUM(m_price) as modals'),)->get();
        $totalmodal = $qtyasset[0]->totalqty * $modalasset[0]->modals;

        $qtyrelease = DB::table('supplier_orders')->select(DB::raw('SUM(qty) as qtyreleases'),)->where('tipe_order', '=', 'RELEASE')->get();
        $qtyrepeat = DB::table('supplier_orders')->select(DB::raw('SUM(qty) as qtyrepeats'),)->where('tipe_order', '=', 'REPEAT')->get();

        return view('asset.assets', compact(
            'title',
            'qtyasset',
            'modalasset',
            'totalmodal',
            'qtyrelease',
            'qtyrepeat'
        ));
    }

    public function tableassets(Request $request)
    {
        if ($request->ajax()) {
            $supplier = Product::with('supplier_order', 'warehouse', 'product_variation', 'supplier_variation')
                ->get();

            return DataTables::of($supplier)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->make(true);
        }
    }
}
