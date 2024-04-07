<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Tutor;
use App\Models\Person;
use App\Models\Especialidad;
use App\Models\RegisterPatient;
use Auth;
use PDF;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function index(){
        $pacientes = Patient::orderBy('estado','asc')
                    ->orderBy('id','asc')->get();
        return view('patient.index')->with('pacientes',$pacientes);
    }

    public function pdfall(){
        $pacientes = Patient::all();
        $pdf = PDF::loadView('patient.pdfall',['pacientes'=>$pacientes]);
        $pdf->setPaper('letter', 'landscape');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function crear(){
        $especialidades = Especialidad:: all();
        return view('patient.register')->with('especialidades',$especialidades);
    }

    public function show($id){
        $paciente = Patient::where('id',$id)->first();
        $histories = RegisterPatient::where('id_patient',$id)->get();
        $especialidades = Especialidad::all();
        return view('patient.history',compact('paciente','especialidades','histories'));
    }

    public function reinternar($id){
        $paciente = Patient::where('id',$id)->first();
        $histories = RegisterPatient::where('id_patient',$id)->get();
        $especialidades = Especialidad::all();
        session()->flash('mensaje', 'REVISE LOS DATOS DEL PACIENTE Y SELECCIONE LA ESPECIALIDAD HA INTERNAR');
        return view('patient.history',compact('paciente','especialidades','histories'));
    }

    public function store(Request $request){
        try {
            if(!($request->especialidad ==NULL) || !($request->especialidad=='')){
                Person::create([
                    'ci' => $request->ci_tutor,
                    'extension'=>$request->extencion,
                    'nombre' => $request->nombre_tutor,
                    'ap_paterno' => $request->ap_paterno_tutor,
                    'ap_materno' => $request->ap_materno_tutor,
                    'celular' => $request->telefono_tutor,
                    'direccion' => $request->direccion_tutor,
                    'telefono_emergencia' => $request->telefono_emergencia_tutor
                ]);
        
                $tutor = Person::where("ci",$request->ci_tutor)->first();
        
                Tutor::create([
                    'id_people' => $tutor->id,
                    'parentesco' => $request->parentesco,
                ]);
        
                $codigotutor = Tutor::where("id_people",$tutor->id)->first();
        
                Person::create([
                    'ci' => $request->ci,
                    'extension'=>$request->extension,
                    'nombre' => $request->nombre,
                    'ap_paterno' => $request->ap_paterno,
                    'ap_materno' => $request->ap_materno,
                    'fechanacimiento' => $request->fechanacimiento,
                    'genero'=>$request->genero,
                    'celular' => $request->telefono,
                    'direccion' => $request->direccion,
                    'ocupacion'=>$request->ocupacion,
                    'estado_civil'=>$request->estado_civil,
                    'nit'=>$request->nit,
                    'telefono_emergencia' => $request->telefono_emergencia
                ]);
        
                $datos_personales = Person::where("ci",$request->ci)->first();
        
                Patient::create([
                    'id_people'=>$datos_personales->id,
                    'estado' => 'INTERNADO',
                    'id_tutor'=> $codigotutor->id,
                    'id_especialidad' => $request->especialidad
                ]);

                $paciente = Patient::where("id_people",$datos_personales->id)->first();

                RegisterPatient::create([
                    'id_user'=> Auth::user()->id,
                    'id_patient'=>$paciente->id,
                    'id_especialidad'=>$request->especialidad,
                    'action'=>'INTERNADO',
                    'fecha'=> Carbon::now()
                ]);

                session()->flash('mensaje', 'Paciente registrado con exito');
                return redirect(route('patientindex'));
            }else{
                session()->flash('mensaje', 'Error al intentar registrar al paciente, CI ya registrado o datos faltantes');
                return redirect(route('patientregister'));
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Error al intentar registrar al paciente, CI ya registrado o datos faltantes');
            return redirect(route('patientindex'));
        }
    }    
    
    public function pdf($id){
        $paciente = Patient::find($id);
        $pdf = PDF::loadView('patient.pdf',['paciente'=>$paciente]);
        $pdf->setPaper('letter', 'landscape');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function update(Request $request){
        try {
            Person::where('id',$request->id)->update([
                
                'estado_civil'=>$request->estado_civil,
                'ocupacion'=>$request->ocupacion,
                'fechanacimiento' => $request->fechanacimiento,
                'celular' => $request->telefono,
                'direccion' => $request->direccion,
                'correo'=>$request->correo,
                'telefono_emergencia'=> $request->telefono_emergencia,
                'nit'=>$request->nit
            ]);
    
            Patient::where('id_people',$request->id)->update([
                'id_especialidad' => $request->especialidad
            ]);
    
            session()->flash('mensaje', 'Paciente registrado con exito');
            return redirect(route('patientindex'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Error al intentar editar al paciente');
            return redirect(route('patientindex'));
        }
    }

    public function alta($id){
        Patient::where('id',$id)->update([
            'estado'=>'NO INTERNADO'
        ]);

        RegisterPatient::create([
            'id_user'=> Auth::user()->id,
            'id_patient'=>$id,
            'id_especialidad'=>NULL,
            'action'=>'DE ALTA',
            'fecha'=> now('America/La_Paz')
        ]);

        session()->flash('mensaje', 'Paciente dado de alta exitosamente');
        return redirect(route('patientindex'));
    }


    public function internar($id,$id_especialidad){
        Patient::where('id',$id)->update([
            'estado'=>'INTERNADO'
        ]);

        RegisterPatient::create([
            'id_user'=> Auth::user()->id,
            'id_patient'=>$id,
            'id_especialidad'=>$id_especialidad,
            'action'=>'INTERNADO',
            'fecha'=> now('America/La_Paz')
        ]);

        session()->flash('mensaje', 'Paciente internado exitosamente');
        return redirect(route('patientindex'));
    }

    public function updatetutor(Request $request){
        try {
            Person::where('id',$request->id_tutor)->update([
                'nombre' => $request->nombre_tutor,
                'ap_paterno' => $request->ap_paterno_tutor,
                'ap_materno' => $request->ap_materno_tutor,
                'ci' => $request->ci_tutor,
                'extension'=>$request->extension_tutor,
                'ocupacion'=>$request->ocupacion_tutor,
                'fechanacimiento' => $request->fechanacimiento_tutor,
                'celular' => $request->telefono_tutor,
                'direccion' => $request->direccion_tutor,
                'genero'=>$request->genero_tutor,
                'correo'=>$request->correo_tutor,
                'telefono_emergencia'=> $request->telefono_emergencia_tutor,
                'nit'=>$request->nit_tutor
            ]);
            Tutor::where('id_people',$request->id_tutor)->update([
                'parentesco' => $request->parentesco
            ]);
            session()->flash('mensaje', 'Tutor registrado con exito');
            return redirect(route('patientindex'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Error al intentar editar al tutor');
            return redirect(route('patientindex'));
        }
        
    }
    
    
    public function search(Request $request){
        
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



