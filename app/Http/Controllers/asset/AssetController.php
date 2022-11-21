<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\brand;
use App\Models\Sub_category;
use App\Models\warehouse;
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

        $assets_valuation = variation::with('supplier')->get();

        $qtyasset = DB::table('variations')->select(DB::raw('SUM(qty) as totalqty'),)->get();
        $qtyrelease = DB::table('supplier_orders')->select(DB::raw('SUM(qty) as qtyreleases'),)->where('tipe_order', '=', 'RELEASE')->get();
        $qtyrepeat = DB::table('supplier_orders')->select(DB::raw('SUM(qty) as qtyrepeats'),)->where('tipe_order', '=', 'REPEAT')->get();

        return view('asset.assets', compact(
            'title',
            'assets_valuation',
            'qtyrelease',
            'qtyrepeat',
            'qtyasset'
        ));
    }

    public function tableassets(Request $request)
    {
        if ($request->ajax()) {
            $supplier = Supplier_order::with('supplier_order3', 'sales', 'stock', 'details_po', 'asset_value')
                ->groupBy('id_produk')
                ->get();

            return DataTables::of($supplier)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->make(true);
        }
    }

    public function load_detail_asset(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;

            return view('asset/load_detail_asset', compact(
                'id_produk',
            ));
        }
    }

    public function table_detail_asset(Request $request, $id_produk)
    {
        if ($request->ajax()) {
            $supplier = Supplier_order::with('supplier_variation2')
                ->where('id_produk', $id_produk)
                ->get();

            return DataTables::of($supplier)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->make(true);
        }
    }
}
