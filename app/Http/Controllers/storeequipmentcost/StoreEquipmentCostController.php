<?php

namespace App\Http\Controllers\storeequipmentcost;

use App\Http\Controllers\Controller;
use App\Models\Store_equipment_cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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

        return view('store_expense.store_expenses', compact(
            'title'
        ));
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
        //
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
