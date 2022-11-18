<?php

namespace App\Http\Controllers\reportProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ReportProductController extends Controller
{
    public function product()
    {
        $title = "Report Product";

        return view('reportProduct/product', compact(
            'title'
        ));
    }
}
