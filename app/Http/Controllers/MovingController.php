<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moving;
use App\Models\Product;
use Auth;
use Carbon\Carbon;
use PDF;

class MovingController extends Controller
{
    public function index(){
        $products = Product::where('estado','activo')->get();
        return view('stock.index')->with('products',$products);
    }

    public function add($id){
        $product = Product::where('id',$id)->first();
        return view('stock.increment', compact('product'));
    }

    public function decrement($id){
        $product = Product::where('id',$id)->first();
        return view('stock.decrement', compact('product'));
    }

    public function pdf(){
        $movimientos = Moving::all();
        $pdf = PDF::loadView('reports.pdf',['movimientos'=>$movimientos]);
        $pdf->setPaper('letter', 'landscape');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function saveIncrement(Request $request){
        $fecha_actual = Carbon::now('America/La_Paz');
        $product = Product::where('id',$request->id)->first();
        $product->cantidad = $product->cantidad + $request->quantity;
        
        $product->save();

        Moving::create([
            'id_user' => Auth::user()->id,
            'id_product' => $request->id,
            'quantity'=> $request->quantity,
            'moving'=>'Incremento',
            'fecha'=> $fecha_actual->format('Y-m-d H:i:s')
        ]);

        session()->flash('mensaje', "INCREMENTO DE STOCK REGISTRADO CON EXITO");
        return redirect(route('productlist'));
    }

    public function saveDecrement(Request $request){
        $fecha_actual = Carbon::now('America/La_Paz');
        $product = Product::where('id',$request->id)->first();
        if ($request->quantity <= $product->cantidad) {
            $product->cantidad = $product->cantidad - $request->quantity;
            $product->save();
            Moving::create([
                'id_user' => Auth::user()->id,
                'id_product' => $request->id,
                'quantity'=> $request->quantity,
                'moving'=>'Retiro',
                'fecha'=> $fecha_actual->format('Y-m-d H:i:s')
            ]);
            session()->flash('mensaje', "INCREMENTO DE STOCK REGISTRADO CON EXITO");
            return redirect(route('productlist'));
        }else{
            session()->flash('error', "ESA CANTIDAD SUPERA LA DEL STOCK ACTUAL");
            return redirect(route('productlist'));
        } 
    }

    
}
