<?php

namespace App\Http\Controllers\warehouse;

use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StorewarehouseRequest;
use App\Http\Requests\UpdatewarehouseRequest;


class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function warehouse()
    {
        $title = "Warehouse";

        return view('warehouse.warehouses', compact(
            'title',
        ));
    }

    public function tablewarehouse(Request $request)
    {
        if ($request->ajax()) {
            $data = Warehouse::latest()->get();
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
     * @param  \App\Http\Requests\StorewarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Warehouse::count();
        if ($cek === 0) {
            $urut = 1;
            $idware = "WARE-" . $urut;
        } else {
            $ambildata = Warehouse::all()->max('id_ware');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idware = 'WARE-' . $cek3;
        }
        $data = new warehouse();
        $data->id_ware = $idware;
        $data->warehouse = $request->warehouse;
        $data->address = $request->address;
        $data->save();

        return redirect('warehouse/warehouses');
    }

    public function editact(Request $request, $id)
    {
        $data = Warehouse::find($id);
        $data->warehouse = $request->e_warehouse;
        $data->address = $request->e_address;
        $data->update();

        return redirect('warehouse/warehouses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(warehouse $warehouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatewarehouseRequest  $request
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatewarehouseRequest $request, warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Warehouse::destroy($id);

        return redirect('warehouse/warehouses');
    }
}
