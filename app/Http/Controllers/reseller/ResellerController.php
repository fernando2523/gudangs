<?php

namespace App\Http\Controllers\reseller;

use App\Http\Controllers\Controller;
use App\models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reseller()
    {
        $title = "Reseller";

        return view('reseller.resellers', compact(
            'title'
        ));
    }

    public function tablereseller(Request $request)
    {
        if ($request->ajax()) {
            $data = Reseller::latest()->get();
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
     * @param  \App\Http\Requests\StoreresellerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Reseller::count();
        if ($cek === 0) {
            $urut = 1;
            $idres = "RES-" . $urut;
        } else {
            $ambildata = Reseller::all()->max('id_reseller');
            $cek2 = explode("-", $ambildata);
            $cek3 = $cek2[1] + 1;
            $idres = 'RES-' . $cek3;
        }

        $data = new Reseller();
        $data->id_reseller = $idres;
        $data->nama = $request->nama;
        $data->tlp = $request->tlp;
        if (empty($_FILES['file']['name'][0])) {
            $data->img = "";
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('reseller'), $fileName);
            // end get files
            $data->img = $fileName;
        }
        $data->save();

        return redirect('reseller/resellers');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function show(reseller $reseller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function editact(Request $request, $id)
    {
        $data = Reseller::find($id);
        $data->nama = $request->e_nama;
        $data->tlp = $request->e_tlp;
        if (empty($_FILES['file']['name'][0])) {
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);

            if ($request->e_img2 === null or $request->e_img2 === "") {
            } else {
                $image = Reseller::find($id);
                unlink("reseller/" . $image->img);
            }

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('reseller'), $fileName);
            // end get file
            $data->img = $fileName;
        }
        $data->update();

        return redirect('reseller/resellers');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\reseller  $reseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->del_img === null or $request->del_img === "") {
            Reseller::destroy($id);
        } else {
            Reseller::destroy($id);
            unlink("brand/" . $request->del_img);
        }

        return redirect('brand/brands');
    }
}
