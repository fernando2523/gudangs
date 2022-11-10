<?php

namespace App\Http\Controllers\repeat;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\brand;
use App\Models\Sub_category;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Supplier_order;
use App\Models\Supplier_variation;
use App\Models\variation;
use App\Models\Variation_history;
use App\Models\Image_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request as Psr7Request;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class RepeatOrderController extends Controller
{
    public function repeatorders()
    {
        $title = "Repeat Order";

        // $getsupplier = Supplier::all()->where('id_sup', '=', 'SUP-2')->pluck('supplier');
        // $getsupplier2 = $getsupplier->toArray();
        // $getsupplier3 = implode(" ", $getsupplier2);

        // dd($getsupplier3);

        return view('repeat/repeatorders', compact(
            'title'
        ));
    }

    public function tablerepeatorder(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('warehouse', 'image_product', 'product_variation')->get();

            return DataTables::of($product)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    public function load_repeatorder(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;
            $produk = $request->produk;
            $m_price = $request->m_price;
            $brand = $request->brand;

            $getsupplier = Supplier::all();
            $variationss = variation::all();
            $get_Supplier_Order = DB::table('supplier_orders')->select(DB::raw('idpo'), DB::raw('tanggal'), DB::raw('id_sup'),)->groupBy('idpo', 'tanggal', 'id_sup')->orderBy('idpo', 'desc')->limit(10)->get();

            return view('repeat/load_repeatorder', compact(
                'id',
                'id_produk',
                'id_ware',
                'produk',
                'm_price',
                'brand',
                'getsupplier',
                'variationss',
                'get_Supplier_Order',
            ));
        }
    }

    public function table_detail_repeatorder(Request $request, $id_ware, $id_produk)
    {
        if ($request->ajax()) {
            $supplier = Supplier_order::with('supplier_variation', 'suppliers_detail')
                ->where('id_ware', $id_ware)
                ->where('id_produk', $id_produk)
                ->get();

            return DataTables::of($supplier)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->make(true);
        }
    }

    public function repeats(Request $request)
    {
        $getuser = Auth::user()->name;

        $now = Carbon::now('Asia/Bangkok');
        $tanggalskrg = Date('Y-m-d');

        $thn_bln = $now->format('ym');
        $ceks = Supplier_order::count();
        if ($ceks === 0) {
            $urut2 = 1;
            $get_idpo = $thn_bln . sprintf("%04s", ($urut2));
        } else {
            $ambildatas = Supplier_order::all()->last();
            $ceks2 = (int)substr($ambildatas->idpo, 4) + 1;
            $get_idpo = $thn_bln . sprintf("%04s", + ($ceks2));
        }
        //END GET IDPO

        //GET ID HISTORY
        $thn_bln_tgl = $now->format('ymd');
        $hitung = Variation_history::count();
        if ($hitung === 0) {
            $urut3 = 1;
            $get_idhistory = $thn_bln_tgl . sprintf("%04s", ($urut3));
        } else {
            $ambildatas2 = Variation_history::all()->last();
            $hitung2 = (int)substr($ambildatas2->id_history, 6) + 1;
            $get_idhistory = $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }
        //END ID HISTORY
        $get_supplier_Lama = Supplier_order::all()->where('idpo', '=', $request->id_po_lama)->pluck('id_sup');
        $get_supplier_Lama2 = $get_supplier_Lama->toArray();
        $get_supplier_Lama3 = implode(" ", $get_supplier_Lama2);


        $qtys = 0;
        if ($request->type_po === "baru") {
            for ($i = 0; $i < Count($request->size); $i++) {
                //DB VARIATION

                $qtys =  $qtys + $request->qty[$i];
                //END DB VARIATION
                variation::where('id_produk', $request->id_produk)->where('id_ware', $request->id_ware)->where('size', $request->size[$i])
                    ->update([
                        'qty' => $request->qty_old[$i] + $request->qty[$i],
                    ]);

                Product::where('id_produk', $request->id_produk)
                    ->update([
                        'm_price' => preg_replace("/[^0-9]/", "", $request->m_price),
                    ]);

                //DB SUPPLIER VARIATIONS
                $data4 = new Supplier_variation();
                $data4->idpo = $get_idpo;
                $data4->id_sup = $request->id_sup;
                $data4->id_produk = $request->id_produk;
                $data4->id_ware = $request->id_ware;
                $data4->tanggal = $tanggalskrg;
                $data4->size = $request->size[$i];
                $data4->qty = $request->qty[$i];
                $data4->tipe_order = "REPEAT";
                $data4->users = $getuser;
                $data4->save();
                //END DB SUPPLIER VARIATIONS

                //DB VARIATIONS_HISTORIES
                $data5 = new Variation_history();
                $data5->tanggal = $tanggalskrg;
                $data5->id_history = $get_idhistory;
                $data5->id_produk = $request->id_produk;
                $data5->id_ware = $request->id_ware;
                $data5->size = $request->size[$i];
                $data5->qty = $request->qty[$i];
                $data5->users = $getuser;
                $data5->save();
                //END DB VARIATIONS_HISTORIES
            }
            //DB SUPPLIER ORDER
            $data3 = new Supplier_order();
            $data3->idpo = $get_idpo;
            $data3->id_sup = $request->id_sup;
            $data3->id_produk = $request->id_produk;
            $data3->id_ware = $request->id_ware;
            $data3->brand = $request->brand;
            $data3->tanggal = $tanggalskrg;
            $data3->produk = Str::headline($request->produk);
            $data3->qty = $qtys;
            $data3->m_price = preg_replace("/[^0-9]/", "", $request->m_price);
            $data3->subtotal = preg_replace("/[^0-9]/", "", $request->m_price) * $qtys;
            $data3->tipe_order = "REPEAT";
            $data3->users = $getuser;
            $data3->save();
            //END DB SUPPLIER ORDER
        } elseif ($request->type_po === "lama") {
            for ($i = 0; $i < Count($request->size); $i++) {
                //DB VARIATION

                $qtys =  $qtys + $request->qty[$i];
                //END DB VARIATION
                variation::where('id_produk', $request->id_produk)->where('id_ware', $request->id_ware)->where('size', $request->size[$i])
                    ->update([
                        'qty' => $request->qty_old[$i] + $request->qty[$i],
                    ]);

                Product::where('id_produk', $request->id_produk)
                    ->update([
                        'm_price' => preg_replace("/[^0-9]/", "", $request->m_price),
                    ]);

                //DB SUPPLIER VARIATIONS
                $data4 = new Supplier_variation();
                $data4->idpo = $request->id_po_lama;
                $data4->id_sup = $get_supplier_Lama3;
                $data4->id_produk = $request->id_produk;
                $data4->id_ware = $request->id_ware;
                $data4->tanggal = $tanggalskrg;
                $data4->size = $request->size[$i];
                $data4->qty = $request->qty[$i];
                $data4->tipe_order = "REPEAT";
                $data4->users = $getuser;
                $data4->save();
                //END DB SUPPLIER VARIATIONS

                //DB VARIATIONS_HISTORIES
                $data5 = new Variation_history();
                $data5->tanggal = $tanggalskrg;
                $data5->id_history = $get_idhistory;
                $data5->id_produk = $request->id_produk;
                $data5->id_ware = $request->id_ware;
                $data5->size = $request->size[$i];
                $data5->qty = $request->qty[$i];
                $data5->users = $getuser;
                $data5->save();
                //END DB VARIATIONS_HISTORIES
            }
            //DB SUPPLIER ORDER
            $data3 = new Supplier_order();
            $data3->idpo = $request->id_po_lama;
            $data3->id_sup = $get_supplier_Lama3;
            $data3->id_produk = $request->id_produk;
            $data3->id_ware = $request->id_ware;
            $data3->brand = $request->brand;
            $data3->tanggal = $tanggalskrg;
            $data3->produk = Str::headline($request->produk);
            $data3->qty = $qtys;
            $data3->m_price = preg_replace("/[^0-9]/", "", $request->m_price);
            $data3->subtotal = preg_replace("/[^0-9]/", "", $request->m_price) * $qtys;
            $data3->tipe_order = "REPEAT";
            $data3->users = $getuser;
            $data3->save();
            //END DB SUPPLIER ORDER
        }

        return redirect('repeat/repeatorders');
    }
}