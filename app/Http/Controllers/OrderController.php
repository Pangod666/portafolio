<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Patient;
use App\Models\User;
use PDF;
use Carbon\Carbon;
use Auth;
use Session;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::Orderby('id','desc')->get();
        return view('order.index')->with('orders',$orders);
    }

    public function pdf($id){
        $orden = Order::find($id);
        $pdf = PDF::loadView('order.pdf',['orden'=>$orden]);
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
        
    }

    public function descargo(){
        if(session()->get('cart')){
            $pacientes = Patient::all();
            return view('order.register')->with('pacientes',$pacientes);
        }else{
            return redirect(route('dashboard'));
        }
        
    }

    public function descargar($id){
        
        if (session()->get('cart')) {
            Carbon::now('America/La_Paz');

            $orden = Order::create([
                'id_paciente'=> $id,
                'id_user' => Auth::user()->id,
                'fecha' =>Carbon::now('America/La_Paz')
            ]);

            $cart = session()->get('cart');

        
            $ordenes = Order::OrderBy('id','desc')->first();
            
            
            foreach ($cart as $product => $detail) { 
                $ordenes->productos()->attach($detail['id'],['cantidad'=>$detail['cantidad']]);
                $producto=Product::find($detail['id']);
                $producto->cantidad = $producto->cantidad - $detail['cantidad'];
                $producto->save();
            }
        
            Session::forget('cart');

            $orden = Order::OrderBy('id','desc')->first();
        
            return redirect(route('descargosindex'));
    
        }else{
            return redirect(route('dashboard'));
        }      
    }



    public function search(Request $request){
        
        $query = $request->get('query');

        $data=[];   

        if ($query != '' or $query != NULL or $query->empty()) {
            $ordenes = Order::Orderby('id','desc')
                      ->where('id', 'LIKE', '%'. $query .'%')
                      ->orwhere('fecha','LIKE','%'.$query.'%')
                      ->get();
            
            foreach ($ordenes as $orden) {

                $paciente = Patient::where('id',$orden->id_paciente)->first();
                $usuario = User::where("id",$orden->id_user)->first();
                
                $datatable = [
                        [
                        'id'=>$orden->id,
                        'hc'=>$paciente->person->nombre,
                        'usuario' => $usuario->person->nombre .  $usuario->person->ap_paterno,
                        'fecha' => $orden->fecha,
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);

        } else {
            $ordenes = Order::all();

            foreach ($ordenes as $orden) {

                $paciente = Patient::where('id',$orden->id_paciente)->first();
                $usuario = User::where("id",$orden->id_user)->first();
                
                $datatable = [
                        [
                        'id'=>$orden->id,
                        'hc'=>$paciente->id,
                        'usuario' => $usuario->id,
                        'fecha' => $orden->fecha,
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);
        }  
    }


    public function search_patient(Request $request){
        
        $user = Auth::user();
        $role = $user->roles->first();
        $roleName = $role->name;

        $query = $request->get('query');

        $data=[];   

        if ($query != '' or $query != NULL or $query->empty()) {
            $usuarios = Patient::selectRaw('patients.id as id,people.ci as ci, people.ap_paterno as paterno, people.ap_materno as materno, people.nombre as nombre, especialidads.nombre as especialidad, patients.estado as estado')
                        ->join('people','people.id','=','patients.id_people')
                        ->join('especialidads','especialidads.id','=','patients.id_especialidad')
                        ->where('people.ci', 'LIKE', '%' . $query . '%')
                        ->orwhere('people.nombre', 'LIKE', '%' . $query . '%')
                        ->orwhere('people.ap_paterno', 'LIKE', '%' . $query . '%')
                        ->orwhere('people.ap_materno', 'LIKE', '%' . $query . '%')
                        ->get();
            
            foreach ($usuarios as $usuario) {
                
                $datatable = [
                        [
                        'id'=>$usuario->id,
                        'ci'=>$usuario->ci,
                        'nombre'=>$usuario->nombre,
                        'paterno'=>$usuario->paterno,
                        'materno' => $usuario->materno,
                        'especialidad'=>$usuario->especialidad,
                        'estado'=>$usuario->estado,
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);

        } else {
            $usuarios = Patient::selectRaw('id as id,people.ci as ci, people.ap_paterno as paterno, people.ap_materno as materno, people.nombre as nombre, especialidads.nombre, estado as estado')
            ->join('people','people.id','=','patients.id_people')
            ->join('especialidads','especialidads.id','=','patients.id_especialidad')
            ->get();
            
            foreach ($usuarios as $usuario) {
                
                $datatable = [
                    [
                        'id'=>$usuario->id,
                        'ci'=>$usuario->ci,
                        'nombre'=>$usuario->nombre,
                        'paterno'=>$usuario->paterno,
                        'materno' => $usuario->materno,
                        'especialidad'=>$usuario->especialidad,
                        'estado'=>$usuario->estado,
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);
        }  
    }

}
