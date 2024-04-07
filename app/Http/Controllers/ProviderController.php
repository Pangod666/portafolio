<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use PDF;

class ProviderController extends Controller
{
    public function index(){
        $providers = Provider::Orderby('id','asc')->get();
        return view('provider.index')->with('providers', $providers);
    }

    public function pdf(){
        $proveedores = Provider::all();
        $pdf = PDF::loadView('provider.pdf',['proveedores'=>$proveedores]);
        $pdf->setPaper('letter', 'landscape');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function view($id){
        $provider = Provider::where('id',$id)->first();
        return view('provider.view', compact('provider'));
    }

    public function create(){
        return view('provider.register');
    }

    public function store(Request $request){
        try {
            Provider::create([
                'nit' => $request->nit,
                'encargado'=>$request->encargado,
                'nombre'=>$request->nombre,
                'direccion' =>$request->direccion,
                'telefono'=>$request->telefono,
                'email'=>$request->email
            ]);
            
            session()->flash('mensaje', 'Proveedor registrado con exito');
            return redirect(route('providerlist'));
        } catch (\Throwable $th) {
            session()->flash('mensaje', 'Ya existe un proveedor con ese documento de NIT o correo electronico');
            return redirect(route('providerform'));   
        }
        
    }

    public function show($id){

        $provider = Provider::where('id',$id)->first();
        return view('provider.edit', compact('provider'));

    }

    public function update(Request $request){

        

        try {
            $data = Provider::where('id',$request->id)->update([
                'nit' => $request->nit,
                'encargado' => $request->encargado,
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
                'direccion' => $request->direccion,
            ]);
            
            session()->flash('mensaje', 'Proveedor modificado con exito');
            return redirect(route('providerlist'));
        } 
        catch (\Throwable $th) {
            session()->flash('mensaje', 'Ya existe un proveedor con ese documento de NIT o correo electronico');
            return redirect(route('providershow',$request->id));
        }
    }

    public function disable($request){

        Provider::where('id',$request)->update([
            'estado' => 'inactivo'
        ]);
        session()->flash('mensaje', 'Desactivado con exito');
        return redirect(route('providerlist'));
    }

    public function active($request){

        Provider::where('id',$request)->update([
            'estado' => 'activo'
        ]);
        session()->flash('mensaje', 'Proveedor habilitado exitosamente');
        return redirect(route('providerlist'));
    }


    public function search(Request $request){
        
        $query = $request->get('query');

        $data=[];   

        if ($query != '' or $query != NULL or $query->empty()) {
            $providers = Provider::where('nit', 'LIKE', '%' . $query . '%')
                        ->orWhere('nombre', 'LIKE', '%' . $query . '%')
                        ->orWhere('encargado', 'LIKE', '%' . $query . '%')
                        ->orWhere('telefono', 'LIKE', '%' . $query . '%')
                        ->orWhere('email', 'LIKE', '%' . $query . '%')
                        ->get();
            
            foreach ($providers as $provider) {
                
                $datatable = [
                        [
                        'id'=>$provider->id,
                        'nit'=>$provider->nit,
                        'encargado'=>$provider->encargado,
                        'nombre' => $provider->nombre,
                        'direccion' => $provider->direccion,
                        'telefono' => $provider->telefono,
                        'email' => $provider->email,
                        'estado' => $provider->estado
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);

        } else {
            $providers = Provider::all();
            
            foreach ($providers as $provider) {
                
                $datatable = [
                        [
                        'id'=>$provider->id,
                        'nit'=>$provider->nit,
                        'encargado'=>$provider->encargado,
                        'nombre' => $provider->nombre,
                        'direccion' => $provider->direccion,
                        'telefono' => $provider->telefono,
                        'email' => $provider->email,
                        'estado' => $provider->estado
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);
        }  
    }

}

