<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Models\Store;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $title = "Store";

        $getwarehouse = Warehouse::get();
        return view('store.stores', compact(
            'title',
            'getwarehouse'
        ));
    }

    public function tablestore(Request $request)
    {
        if ($request->ajax()) {
            $data = Store::latest()->get();
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
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeadd(Request $request)
    {
        $cek = Store::count();
        if ($cek === 0) {
            $urut = 1;
            $idstore = "STR-" . $urut;
        } else {
            $ambildata = Store::all()->max('id_store');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idstore = 'STR-' . $cek3;
        }

        $get_id_ware = $request->id_ware;
        $getwarename = DB::table('warehouses')
            ->where('id_ware', '=', $get_id_ware)
            ->pluck('warehouse');
        $getwarename2 = $getwarename->toArray();
        $getwarename3 = implode(" ", $getwarename2);

        $data = new Store();
        $data->id_store = $idstore;
        $data->id_ware = $get_id_ware;
        $data->warehouse = $getwarename3;
        $data->store = $request->store;
        $data->address = $request->address;
        $data->save();

        return redirect('store/stores');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function editact(Request $request, $id)
    {
        $get_id_ware = $request->e_id_ware;
        $getwarename = DB::table('warehouses')
            ->where('id_ware', '=', $get_id_ware)
            ->pluck('warehouse');
        $getwarename2 = $getwarename->toArray();
        $getwarename3 = implode(" ", $getwarename2);

        $data = Store::find($id);
        $data->id_ware = $request->e_id_ware;
        $data->warehouse = $getwarename3;
        $data->store = $request->e_store;
        $data->address = $request->e_address;
        $data->update();

        return redirect('store/stores');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Store::destroy($id);

        return redirect('store/stores');
    }
}
