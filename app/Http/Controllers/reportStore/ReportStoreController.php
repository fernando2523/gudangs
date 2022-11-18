<?php

namespace App\Http\Controllers\reportStore;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ReportStoreController extends Controller
{
    public function store()
    {
        $title = "Report Store";

        return view('reportStore/store', compact(
            'title'
        ));
    }
}
