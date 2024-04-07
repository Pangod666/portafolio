<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidad;
use PDF;

class EspecialidadController extends Controller
{
    public function index(){
        $especialidades = Especialidad::all();
        return view('bed.index')->with('especialidades', $especialidades);
    }

    public function crear(){
        return view('bed.register');
    }

    public function view($id){
        $especialidad = Especialidad::where('id',$id)->first();
        return view('bed.view_especialidad', compact('especialidad'));
    }

    public function store(Request $request){
        try {
            if($request->descripcion==NULL){
                Especialidad::create([
                    'nombre' => $request->nombre,
                    'descripcion'=>''
                ]);
            }else{
                Especialidad::create([
                    'nombre' => $request->nombre,
                    'descripcion'=> $request->descripcion,
                ]);
            }
            
            session()->flash('mensaje', 'Especialidad creada exitosamente');
            return redirect(route('bedindex'));
        } catch (\Throwable $th) {
            session()->flash('mensaje', 'Esa especialidad ya ha sido creada');
            return redirect(route('bedregister'));
        }
    }

    public function show($id){

        $especialidad = Especialidad::where('id',$id)->first();
        return view('bed.edit', compact('especialidad'));

    }


    public function pdf(){
        $especialidades = Especialidad::all();
        $pdf = PDF::loadView('bed.pdf',['especialidades'=>$especialidades]);
        $pdf->setPaper('letter', 'landscape');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }



    public function update(Request $request){

        

        try {
            $data = Especialidad::where('id',$request->id)->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
            ]);
            
            session()->flash('mensaje', 'Especialidad modificada con exito');
            return redirect(route('bedindex'));
        } 
        catch (\Throwable $th) {
            session()->flash('mensaje', 'Ya existe una categoria con ese nombre');
            return redirect(route('bedshow',$request->id));
        }
    }

    public function delete($id){
        try {
            Especialidad::where('id',$id)->delete();
            session()->flash('mensaje', 'Eliminado Exitosamente');
            return redirect(route('bedindex'));
        } catch (\Throwable $th) {
            return redirect(route('bedindex'))->with('error', 'Imposible borrar, la especialidad aun cuenta con pacientes');;
        }
        
    }







    public function search(Request $request){
        
        $query = $request->get('query');

        $data=[];   

        if ($query != '' or $query != NULL or $query->empty()) {
            $especialidades = Especialidad::where('id', 'LIKE', '%' . $query . '%')
                        ->orWhere('nombre', 'LIKE', '%' . $query . '%')
                        ->orWhere('descripcion', 'LIKE', '%' . $query . '%')
                        ->get();
            
            foreach ($especialidades as $especialidad) {
                
                $datatable = [
                        [
                        'id'=>$especialidad->id,
                        'nombre' => $especialidad->nombre,
                        'descripcion' => $especialidad->descripcion,
                        'pacientes'=> $especialidad->pacientes->count()
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);

        } else {
            $especialidades = Especialidad::all();
            
            foreach ($especialidades as $especialidad) {
                
                $datatable = [
                    [
                    'id'=>$especialidad->id,
                    'nombre' => $especialidad->nombre,
                    'descripcion' => $especialidad->descripcion,
                    'pacientes'=> $especialidad->pacientes->count()
                    ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);
        }  
    }
}
