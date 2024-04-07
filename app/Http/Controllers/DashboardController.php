<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use DB;
use App\Models\Product;
use Carbon\Carbon;
use PDF;

class DashboardController extends Controller
{
    public function index(){

        // $options = [
        //     'chart_title' => 'Productos vendidos al dia',
        //     'report_type' => 'group_by_date',
        //     'model' => 'App\Models\User',
        //     'group_by_field' => 'created_at',
        //     'group_by_period' => 'month',
        //     'chart_type' => 'bar',
        // ];

        $ventas_diarias = DB::table('orders')
                            ->join('orderproducts','orders.id','=','orderproducts.order_id')
                            ->selectRaw('orders.fecha as fecha, SUM(orderproducts.cantidad) as productos',)
                            ->groupBy('orders.fecha')
                            ->get();

        $valores = [];

        foreach ($ventas_diarias as $venta) {
            $carbonDate = Carbon::parse($venta->fecha);
            $valores[] = ['name'=>$carbonDate->toDateString(), 'y'=>intval($venta->productos)];
        }  
        
        $fechaActual = now()->toDateString(); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        $fecha7DiasDespues = now()->addDays(90)->toDateString();
        
        $products = Product::whereBetween(DB::raw('fecha_vencimiento'), [$fechaActual, $fecha7DiasDespues])
                    ->orwhere('nivel_reorden', '>=', DB::raw('cantidad'))
                    ->orwhere('fecha_vencimiento','<',$fechaActual)->get();
        return view('dashboard',["data"=>json_encode($valores),"products"=>$products]);
    }


    public function caducos_pdf(){
        $fechaActual = now()->toDateString(); // Obtiene la fecha actual en formato 'YYYY-MM-DD'
        $fecha7DiasDespues = now()->addDays(90)->toDateString();
        $productos = Product::whereBetween(DB::raw('fecha_vencimiento'), [$fechaActual, $fecha7DiasDespues])
        ->orwhere('nivel_reorden', '>=', DB::raw('cantidad'))
        ->orwhere('fecha_vencimiento','<',$fechaActual)->get();
        $pdf = PDF::loadView('caducos.pdf',['productos'=>$productos]);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream();
    }
}
