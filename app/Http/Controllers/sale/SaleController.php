<?php

namespace App\Http\Controllers\sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Image_product;
use App\Models\Store;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Reseller;
use App\Models\Warehouse;
use App\Models\variation;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sale()
    {
        $title = "SALES";

        $getstore = Store::all();
        $getkasir = Employee::all()->where('role', '!=', 'ADMIN');
        $getreseller = Reseller::all();
        // $getreseller = Reseller::all();

        return view('sale.sales', compact(
            'title',
            'getstore',
            'getkasir',
            'getreseller'
        ));
    }

    public function tablesale(Request $request)
    {
        if ($request->ajax()) {
            $id_area = $request->area;
            $data = Product::with('warehouse', 'image_product', 'product_variation')->where('products.id_area', $id_area)->paginate(6);

            return view('load.load_catalog', compact(
                'data'
            ));
        }
    }

    public function load_size(Request $request)
    {
        if ($request->ajax()) {
            $id_produk = $request->id_produk;
            $id_ware = $request->id_ware;

            $data = DB::table('variations')->where('id_produk', $id_produk)->where('id_ware', $id_ware)->get();

            return view('load.load_modal_catalog', compact(
                'data'
            ));
        }
    }

    public function load_ware(Request $request)
    {
        if ($request->ajax()) {
            $id_area = $request->id_area;
            $data = DB::table('warehouses')->where('id_area', $id_area)->get();

            return view('load.load_warehouse', compact(
                'data'
            ));
        }
    }

    public function save_sales(Request $request)
    {
        $tanggal = $request->r_tanggal;
        $idinvoice = $request->r_idinvoice;
        $warehouse = $request->r_warehouse;
        $store = $request->store;

        $customer = $request->customer;
        $quality = $request->r_quality;
        $produk = $request->r_produk;
        $size = $request->r_size;
        $qty = $request->r_qty;
        $m_price = $request->r_m_price;
        $selling_price = $request->r_selling_price;
        $discitem = $request->r_diskon_item;
        $discnota = $request->rs_discnota;
        $subtotal = $request->r_subtotal;
        $grandtotal = $request->rs_payment;
        $cash = $request->r_cash;
        $bca = $request->r_bca;
        $mandiri = $request->r_mandiri;
        $banktf = $request->r_banktf;
        $ongkir = $request->rs_ongkir;
        $cashier = $request->cashier;
        $idbrand = $request->r_id_brand;
        $idproduk = $request->r_id_produk;

        if ($request->reseller_name === null) {
            $reseller_name = '-';
        } else {
            $reseller_name = $request->reseller_name;
        }

        if ($cash === null) {
            $cash = '0';
        } else {
            $cash = $request->r_cash;
        }

        if ($bca === null) {
            $bca = '0';
        } else {
            $bca = $request->r_bca;
        }

        if ($mandiri === null) {
            $mandiri = '0';
        } else {
            $mandiri = $request->r_mandiri;
        }

        if ($banktf === null) {
            $banktf = '0';
        } else {
            $banktf = $request->r_banktf;
        }


        $count = $request->count;

        // Save Function
        for ($i = 0; $i < $count; $i++) {
            $data = new Sale();
            $data->tanggal = $tanggal;
            $data->id_invoice = $idinvoice;
            $data->id_produk = $idproduk[$i];
            $data->id_ware = $warehouse;
            $data->id_store = $store;
            $data->id_brand = $idbrand[$i];
            $data->id_reseller = $reseller_name;
            $data->payment = 'PAID';
            $data->customer = $customer;
            $data->quality = $quality[$i];
            $data->produk = $produk[$i];
            $data->size = $size[$i];
            $data->qty = $qty[$i];
            $data->m_price = $m_price[$i];
            $data->selling_price = $selling_price[$i];
            $data->diskon_item = $discitem[$i];
            $data->diskon_all = $discnota;
            $data->subtotal = $subtotal[$i];
            $data->grandtotal = $grandtotal;
            $data->cash = $cash;
            $data->bca = $bca;
            $data->mandiri = $mandiri;
            $data->qris = $banktf;
            $data->ongkir = $ongkir;
            $data->refund = '0';
            $data->users = $cashier;
            $data->save();
        }
        // End Save Function

        return redirect('/sale/sales');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSaleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleRequest  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
