<?php

namespace App\Http\Controllers\storeequipmentcost;

use App\Http\Controllers\Controller;
use App\Models\Store_equipment_cost;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;



class StoreEquipmentCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store_expense()
    {
        $title = "Store Expenses";

        $getstore = Store::all();

        $now = Carbon::now('Asia/Jakarta');
        $tanggalskrg = Date('Y-m-d');

        $count = Store_equipment_cost::all()->where('tanggal', '=', $tanggalskrg)->count('id_costs');
        $amounttoday = Store_equipment_cost::all()->where('tanggal', '=', $tanggalskrg)->sum('total_price');

        return view('store_expense.store_expenses', compact(
            'title',
            'getstore',
            'count',
            'amounttoday'
        ));
    }

    public function tableexpenses(Request $request)
    {
        if ($request->ajax()) {
            $data = Store_equipment_cost::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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

     */
    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Bangkok');
        $tanggalskrg = Date('Y-m-d');
        $thn_bln_tgl = $now->format('ymd');

        $hitung = Store_equipment_cost::count();
        if ($hitung === 0) {
            $urut = 1;
            $get_idcosts = $thn_bln_tgl . sprintf("%04s", ($urut));
        } else {
            $ambildatas = Store_equipment_cost::all()->last();
            $hitung2 = (int)substr($ambildatas->id_costs, 6) + 1;
            $get_idcosts = $thn_bln_tgl . sprintf("%04s", + ($hitung2));
        }
        $getuser = Auth::user()->name;

        $data = new Store_equipment_cost();
        $data->tanggal = $tanggalskrg;
        $data->id_costs = $get_idcosts;
        $data->store = $request->store;
        $data->item = Str::headline($request->item);
        $data->desc = $request->desc;
        $data->total_price = $request->total_price;
        $data->users = $getuser;
        $data->save();

        return redirect('store_expense/store_expenses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store_equipment_cost  $store_equipment_cost
     * @return \Illuminate\Http\Response
     */
    public function show(Store_equipment_cost $store_equipment_cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store_equipment_cost  $store_equipment_cost
     * @return \Illuminate\Http\Response
     */
    public function edit(Store_equipment_cost $store_equipment_cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *

     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store_equipment_cost  $store_equipment_cost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store_equipment_cost $store_equipment_cost)
    {
        //
    }
}
