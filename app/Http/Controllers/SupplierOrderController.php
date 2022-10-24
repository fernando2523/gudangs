<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplier_orderRequest;
use App\Http\Requests\UpdateSupplier_orderRequest;
use App\Models\Supplier_order;

class SupplierOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreSupplier_orderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplier_orderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier_order  $supplier_order
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier_order $supplier_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier_order  $supplier_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier_order $supplier_order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplier_orderRequest  $request
     * @param  \App\Models\Supplier_order  $supplier_order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplier_orderRequest $request, Supplier_order $supplier_order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier_order  $supplier_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier_order $supplier_order)
    {
        //
    }
}
