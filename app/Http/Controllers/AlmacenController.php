<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use PDF;
use Carbon\Carbon;

class AlmacenController extends Controller
{
    public function pdf(){
        $productos = Product::all();
        $total = 0;
        $pdf = PDF::loadView('product.pdf',['productos'=>$productos, 'total'=>$total]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
    }
}
