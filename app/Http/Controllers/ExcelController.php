<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CaducosExport;
use App\Exports\ProductsExport;

class ExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new CaducosExport, 'caducos.xlsx');
    }

    public function export_products()
    {
        return Excel::download(new ProductsExport, 'productos.xlsx');
    }
}
