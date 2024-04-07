<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Product;
use Carbon\Carbon;
use DB;


class CaducosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $fechaActual = now()->toDateString(); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        $fecha7DiasDespues = now()->addDays(90)->toDateString();
        $productos = Product::whereBetween(DB::raw('fecha_vencimiento'), [$fechaActual, $fecha7DiasDespues])
        ->orwhere('nivel_reorden', '>=', DB::raw('cantidad'))
        ->orwhere('fecha_vencimiento','<',$fechaActual)->get();
        return view('caducos',compact('productos'));
    }
}
