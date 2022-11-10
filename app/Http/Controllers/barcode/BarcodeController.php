<?php

namespace App\Http\Controllers\barcode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BarcodeController extends Controller
{
    public function barcodes()
    {
        $title = "Barcode";

        return view('barcode.barcodes', compact(
            'title'
        ));
    }
}
