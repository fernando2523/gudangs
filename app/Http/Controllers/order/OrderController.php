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
use PhpParser\Node\Stmt\Return_;

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

    public function load_retur(Request $request)
    {
        $id_invoice = $request->id_invoice;
        $count = $request->count;
        $data = Sale::where('id_invoice', $id_invoice)->get();

        return view('order.load_retur', compact(
            'id_invoice',
            'count',
            'data'
        ));
    }

    public function cek_size_retur(Request $request)
    {
        $id_invoice = $request->r_id_invoice;
        $id = $request->id;

        $get_produk = Sale::where('id', $id)->get();

        $get_var = variation::where('id_produk', $get_produk[0]['id_produk'])
            ->where('id_area', $get_produk[0]['id_area'])
            ->where('size', '!=', $get_produk[0]['size'])
            ->get();

        $result = '';
        foreach ($get_var as $data) {
            $result .= '<option data-max="' . $data->qty . '" value="' . $data->size . '">' . $data->size . '=' . $data->qty . '</option>';
        }

        echo $result;
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

    public function retur_order(Request $request)
    {
        $id_invoice = $request->r_id_invoice;
        $count = $request->r_count;
        $id = $request->r_produk;
        $size_new = $request->r_size;
        $qty_new = $request->r_qty;
        $ket = $request->ket;

        if ($qty_new === '0') {
        } else {
            for ($i = 0; $i < count($id); $i++) {
                DB::beginTransaction();

                $get_produk = Sale::where('id', $id[$i])->get();

                $result_qty = $get_produk[0]['qty'] - $qty_new[$i];

                $old_qty = variation::where('id_produk', $get_produk[0]['id_produk'])
                    ->where('idpo', $get_produk[0]['idpo'])
                    ->where('id_ware', $get_produk[0]['id_ware'])
                    ->where('size', $get_produk[0]['size'])
                    ->get();

                $qty_baru = intval($old_qty[0]['qty']) + intval($qty_new[$i]);

                $new_qty = variation::where('id_produk', $get_produk[0]['id_produk'])
                    ->where('idpo', $get_produk[0]['idpo'])
                    ->where('id_ware', $get_produk[0]['id_ware'])
                    ->where('size', $size_new[$i])
                    ->get();

                $qty_baru2 = intval($new_qty[0]['qty']) - intval($qty_new[$i]);

                print_r('id_invoice = ' . $id_invoice . '<br>');
                print_r('id_ = ' . $id[$i] . '<br>');
                print_r('Size Old = ' . $get_produk[0]['size'] . '<br>');
                print_r('Size Retur= ' . $size_new[$i] . '<br>');
                print_r('Qty Old = ' . $get_produk[0]['qty'] . '<br>');
                print_r('Qty Retur= ' . $qty_new[$i] . '<br>');
                print_r('Old - Retur = ' . $result_qty . '<br>');
                print_r('Var + Retur = ' . $old_qty[0]['size'] . '=' . $qty_baru . '<br>');
                print_r('Var - Retur = ' . $new_qty[0]['size'] . '=' . $qty_baru2 . '<br>');
                print_r('Ket = ' . $ket[$i] . '<br>');
                print_r('<br>');

                if ($result_qty === 0) {
                    $cek_produk = Sale::where('id_invoice', $id_invoice)
                        ->where('size', $size_new[$i])
                        ->get();

                    if (count($cek_produk) > 0) {
                        Sale::where('id_invoice', $id_invoice)
                            ->where('size', $size_new[$i])
                            ->update([
                                'qty' => $cek_produk[0]['qty'] + $qty_new[$i],
                            ]);

                        Sale::where('id', $id[$i])->delete();
                    } else {
                        Sale::where('id', $id[$i])
                            ->update([
                                'size' => $size_new[$i],
                            ]);
                    }

                    variation::where('id_produk', $get_produk[0]['id_produk'])
                        ->where('idpo', $get_produk[0]['idpo'])
                        ->where('id_ware', $get_produk[0]['id_ware'])
                        ->where('size', $get_produk[0]['size'])
                        ->update([
                            'qty' => $qty_baru,
                        ]);

                    variation::where('id_produk', $get_produk[0]['id_produk'])
                        ->where('idpo', $get_produk[0]['idpo'])
                        ->where('id_ware', $get_produk[0]['id_ware'])
                        ->where('size', $size_new[$i])
                        ->update([
                            'qty' => $qty_baru2,
                        ]);
                } else {
                    Sale::where('id', $id[$i])
                        ->update([
                            'qty' => $result_qty,
                        ]);

                    $cek_produk = Sale::where('id_invoice', $id_invoice)
                        ->where('size', $size_new[$i])
                        ->get();

                    if (count($cek_produk) > 0) {
                        Sale::where('id_invoice', $id_invoice)
                            ->where('size', $size_new[$i])
                            ->update([
                                'qty' => $cek_produk[0]['qty'] + $qty_new[$i],
                            ]);
                    } else {
                        // Save Function
                        $data = new Sale();
                        $data->m_price = $get_produk[0]['m_price'];
                        $data->tanggal = $get_produk[0]['tanggal'];
                        $data->id_invoice = $get_produk[0]['id_invoice'];
                        $data->id_produk = $get_produk[0]['id_produk'];
                        $data->idpo = $get_produk[0]['idpo'];
                        $data->id_area = $get_produk[0]['id_area'];
                        $data->id_ware = $get_produk[0]['id_ware'];
                        $data->id_store = $get_produk[0]['id_store'];
                        $data->id_brand = $get_produk[0]['id_brand'];
                        $data->id_reseller = $get_produk[0]['id_reseller'];
                        $data->payment = $get_produk[0]['payment'];
                        $data->customer = $get_produk[0]['customer'];
                        $data->quality = $get_produk[0]['quality'];
                        $data->produk = $get_produk[0]['produk'];
                        $data->size = $size_new[$i];
                        $data->qty = $qty_new[$i];
                        $data->selling_price = $get_produk[0]['selling_price'];
                        $data->diskon_item = $get_produk[0]['diskon_item'];
                        $data->diskon_all = $get_produk[0]['diskon_all'];
                        $data->subtotal = $get_produk[0]['subtotal'];
                        $data->grandtotal = $get_produk[0]['grandtotal'];
                        $data->cash = $get_produk[0]['cash'];
                        $data->bca = $get_produk[0]['bca'];
                        $data->mandiri = $get_produk[0]['mandiri'];
                        $data->qris = $get_produk[0]['qris'];
                        $data->ongkir = $get_produk[0]['ongkir'];
                        $data->refund = $get_produk[0]['refund'];
                        $data->users = $get_produk[0]['users'];
                        $data->save();
                        // End Save Function
                    }




                    variation::where('id_produk', $get_produk[0]['id_produk'])
                        ->where('idpo', $get_produk[0]['idpo'])
                        ->where('id_ware', $get_produk[0]['id_ware'])
                        ->where('size', $get_produk[0]['size'])
                        ->update([
                            'qty' => $qty_baru,
                        ]);

                    variation::where('id_produk', $get_produk[0]['id_produk'])
                        ->where('idpo', $get_produk[0]['idpo'])
                        ->where('id_ware', $get_produk[0]['id_ware'])
                        ->where('size', $size_new[$i])
                        ->update([
                            'qty' => $qty_baru2,
                        ]);
                }

                DB::commit();
            }
        }



        return redirect('order/orders');
    }
}
