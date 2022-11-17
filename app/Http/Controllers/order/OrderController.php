<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Sale;
use App\Models\variation;
use App\Models\Store_equipment_cost;
use App\Models\Cancel_order;

class OrderController extends Controller
{
    public function orders()
    {
        $title = "Orders Retail";

        $nota = Sale::count('id');
        $qty = Sale::sum('qty');
        $ongkir = Sale::sum('ongkir');
        $gross_sale = Sale::sum('subtotal');
        $expenses = Store_equipment_cost::sum('total_price');
        // $discount = Sale::sum('diskon_all')->groupBy('id_invoice');
        $discount = 12;
        $net_sales = 15436565;

        return view('order/orders', compact(
            'title',
            'nota',
            'qty',
            'ongkir',
            'gross_sale',
            'expenses',
            'discount',
            'net_sales',
        ));
    }

    public function load_tborders(Request $request)
    {
        $querys_result = $request->querys;
        $last_id = $request->last_id;
        $pages = $request->pages;
        $limit = 10;
        $current_page = ($pages * $limit) - ($limit - 1);

        if ($last_id == '0') {
            if ($querys_result == '') {
                $data = Sale::with('details', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')
                    ->groupBy('id_invoice')
                    ->orderBy('id_invoice', 'DESC')
                    ->limit(10)
                    ->get();
            } else {
                $data = Sale::with('details', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                    ->where('id_reseller', $querys_result)
                    ->orwhere('produk',  'Like', '%' . $querys_result . '%')
                    ->orwhere('id_produk',  $querys_result)
                    ->orwhere('id_invoice', $querys_result)
                    ->orwhere('users', $querys_result)

                    ->orderBy('id_invoice', 'DESC')
                    ->groupBy('id_invoice')
                    ->limit(10)
                    ->get();
            }
        } else {
            if ($querys_result == '') {
                $data = Sale::with('details', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                    ->where('id', '<', $last_id)

                    ->groupBy('id_invoice')
                    ->orderBy('id_invoice', 'DESC')
                    ->limit(10)
                    ->get();
            } else {
                $data = Sale::with('details', 'store')
                    ->selectRaw('*,GROUP_CONCAT(produk SEPARATOR " ") as produk,GROUP_CONCAT(id_produk SEPARATOR " ") as id_produk')

                    ->where([['id', '<', $last_id], ['id_reseller', $querys_result]])
                    ->orwhere([['id', '<', $last_id], ['produk',  'Like', '%' . $querys_result . '%']])
                    ->orwhere([['id', '<', $last_id], ['id_produk', $querys_result]])
                    ->orwhere([['id', '<', $last_id], ['id_invoice', $querys_result]])
                    ->orwhere([['id', '<', $last_id], ['users', $querys_result]])

                    ->orderBy('id_invoice', 'DESC')
                    ->groupBy('id_invoice')
                    ->limit(10)
                    ->get();
            }
        }

        $count = count($data);

        if ($last_id == 'last') {
        } else {
            return view('order.load_tborder', compact(
                'data',
                'count',
                'current_page'
            ));
        }
    }

    public function cancel_order(Request $request)
    {
        $id_invoice = $request->id_invoice;

        $get_id_invoice = Sale::where('id_invoice', $id_invoice)->get();

        foreach ($get_id_invoice as $data) {
            // Convert To Cancel Order
            $datas = new Cancel_order();
            $datas->tanggal = $data->tanggal;
            $datas->tipe_refund = 'CANCEL';
            $datas->customer = $data->customer;
            $datas->id_invoice = $data->id_invoice;
            $datas->idpo = $data->idpo;
            $datas->id_produk = $data->id_produk;
            $datas->id_ware = $data->id_ware;
            $datas->id_area = $data->id_area;
            $datas->id_store = $data->id_store;
            $datas->id_brand = $data->id_brand;
            $datas->id_reseller = $data->id_reseller;
            $datas->payment = $data->payment;
            $datas->produk = $data->produk;
            $datas->size = $data->size;
            $datas->qty = $data->qty;
            $datas->quality = $data->quality;
            $datas->m_price = $data->m_price;
            $datas->selling_price = $data->selling_price;
            $datas->diskon_item = $data->diskon_item;
            $datas->diskon_all = $data->diskon_all;
            $datas->subtotal = $data->subtotal;
            $datas->grandtotal = $data->grandtotal;
            $datas->cash = $data->cash;
            $datas->bca = $data->bca;
            $datas->mandiri = $data->mandiri;
            $datas->qris = $data->qris;
            $datas->ongkir = $data->ongkir;
            $datas->refund = $data->refund;
            $datas->desc = '';
            $datas->users = Auth::user()->name;
            $datas->save();
            // Convert To Cancel Order

            // Variations
            $old_qty = variation::where('id_produk', $data->id_produk)
                ->where('idpo', $data->idpo)
                ->where('id_ware', $data->id_ware)
                ->where('size', $data->size)
                ->get('qty');

            $qty_new = intval($old_qty[0]['qty']) + intval($data->qty);

            variation::where('id_produk', $data->id_produk)
                ->where('idpo', $data->idpo)
                ->where('id_ware', $data->id_ware)
                ->where('size', $data->size)
                ->update([
                    'qty' => $qty_new,
                ]);
            // Variations

            // Delete Id_Invoice
            Sale::where('id', $data->id)->delete();
            // Delete Id_Invoice
        }

        return redirect('order/orders');
    }

    public function load_refund(Request $request)
    {
        $id_invoice = $request->id_invoice;
        $count = $request->count;
        $data = Sale::where('id_invoice', $id_invoice)->get();

        return view('order.load_refund', compact(
            'id_invoice',
            'count',
            'data'
        ));
    }

    public function refund_order(Request $request)
    {
        $id_invoice = $request->r_id_invoice;
        $count = $request->r_count;
        $id = $request->r_produk;
        $qty = $request->r_qty;
        $ket = $request->ket;

        for ($i = 0; $i < count($id); $i++) {
            $produk = Sale::where('id', $id[$i])->get();
            $result = intval($produk[0]['qty']) - intval($qty[$i]);

            $old_qty = variation::where('id_produk', $produk[0]['id_produk'])
                ->where('idpo', $produk[0]['idpo'])
                ->where('id_ware', $produk[0]['id_ware'])
                ->where('size', $produk[0]['size'])
                ->get('qty');

            $qty_baru = intval($old_qty[0]['qty']) + intval($qty[$i]);

            if ($result === 0) {
                variation::where('id_produk', $produk[0]['id_produk'])
                    ->where('idpo', $produk[0]['idpo'])
                    ->where('id_ware', $produk[0]['id_ware'])
                    ->where('size', $produk[0]['size'])
                    ->update([
                        'qty' => $qty_baru,
                    ]);

                // Convert To Cancel Order
                $datas = new Cancel_order();
                $datas->tanggal = $produk[0]['tanggal'];
                $datas->tipe_refund = 'REFUND';
                $datas->customer = $produk[0]['customer'];
                $datas->id_invoice = $produk[0]['id_invoice'];
                $datas->idpo = $produk[0]['idpo'];
                $datas->id_produk = $produk[0]['id_produk'];
                $datas->id_ware = $produk[0]['id_ware'];
                $datas->id_area = $produk[0]['id_area'];
                $datas->id_store = $produk[0]['id_store'];
                $datas->id_brand = $produk[0]['id_brand'];
                $datas->id_reseller = $produk[0]['id_reseller'];
                $datas->payment = $produk[0]['payment'];
                $datas->produk = $produk[0]['produk'];
                $datas->size = $produk[0]['size'];
                $datas->qty = $qty[$i];
                $datas->quality = $produk[0]['quality'];
                $datas->m_price = $produk[0]['m_price'];
                $datas->selling_price = $produk[0]['selling_price'];
                $datas->diskon_item = $produk[0]['diskon_item'];
                $datas->diskon_all = $produk[0]['diskon_all'];
                $datas->subtotal = $produk[0]['subtotal'];
                $datas->grandtotal = $produk[0]['grandtotal'];
                $datas->cash = $produk[0]['cash'];
                $datas->bca = $produk[0]['bca'];
                $datas->mandiri = $produk[0]['mandiri'];
                $datas->qris = $produk[0]['qris'];
                $datas->ongkir = $produk[0]['ongkir'];
                $datas->refund = $produk[0]['refund'];
                $datas->desc = $ket[$i];
                $datas->users = Auth::user()->name;
                $datas->save();
                // Convert To Cancel Order

                Sale::where('id', $id[$i])->delete();
            } else {
                variation::where('id_produk', $produk[0]['id_produk'])
                    ->where('idpo', $produk[0]['idpo'])
                    ->where('id_ware', $produk[0]['id_ware'])
                    ->where('size', $produk[0]['size'])
                    ->update([
                        'qty' => $qty_baru,
                    ]);

                // Convert To Cancel Order
                $datas = new Cancel_order();
                $datas->tanggal = $produk[0]['tanggal'];
                $datas->tipe_refund = 'REFUND';
                $datas->customer = $produk[0]['customer'];
                $datas->id_invoice = $produk[0]['id_invoice'];
                $datas->idpo = $produk[0]['idpo'];
                $datas->id_produk = $produk[0]['id_produk'];
                $datas->id_ware = $produk[0]['id_ware'];
                $datas->id_area = $produk[0]['id_area'];
                $datas->id_store = $produk[0]['id_store'];
                $datas->id_brand = $produk[0]['id_brand'];
                $datas->id_reseller = $produk[0]['id_reseller'];
                $datas->payment = $produk[0]['payment'];
                $datas->produk = $produk[0]['produk'];
                $datas->size = $produk[0]['size'];
                $datas->qty = $qty[$i];
                $datas->quality = $produk[0]['quality'];
                $datas->m_price = $produk[0]['m_price'];
                $datas->selling_price = $produk[0]['selling_price'];
                $datas->diskon_item = $produk[0]['diskon_item'];
                $datas->diskon_all = $produk[0]['diskon_all'];
                $datas->subtotal = $produk[0]['subtotal'];
                $datas->grandtotal = $produk[0]['grandtotal'];
                $datas->cash = $produk[0]['cash'];
                $datas->bca = $produk[0]['bca'];
                $datas->mandiri = $produk[0]['mandiri'];
                $datas->qris = $produk[0]['qris'];
                $datas->ongkir = $produk[0]['ongkir'];
                $datas->refund = $produk[0]['refund'];
                $datas->desc = $ket[$i];
                $datas->users = Auth::user()->name;
                $datas->save();
                // Convert To Cancel Order

                Sale::where('id', $id[$i])
                    ->update([
                        'qty' => $result,
                    ]);
            }
        }

        return redirect('order/orders');
    }
}
