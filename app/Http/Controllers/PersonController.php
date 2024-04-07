<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;
use App\Models\Model_has_roles;
use Illuminate\Support\Facades\Hash;
use DB;
use PDF;

class PersonController extends Controller
{
    public function index(){
        $users_roles = Model_has_roles::Orderby('model_id')->get();
        return view('users.user_list')->with('users_roles',$users_roles);
    }


    public function create(){
        
        $data = Role::all();
        return view('registrousuario')->with('data',$data);

    }



    public function store(Request $request){
        //$datospersona = $request->all();
        //Person::create($datospersona);
        try {
            if ($request->ap_paterno) {
                Person::create([
                    'ci' => $request->ci,
                    'extension'=>$request->extension,
                    'nombre' => $request->nombre,
                    'ap_paterno' => $request->ap_paterno,
                    'ap_materno' => $request->ap_materno,
                    'genero'=> $request->genero,
                    'fechanacimiento' => $request->fechanacimiento,
                    'celular' => $request->celular,
                    'direccion' => $request->direccion,
                    'correo'=>$request->correo
                ]);
                
                $id_people = Person::where('ci',$request->ci)->first();
    
                User::create([
                    'id_people'=> $id_people->id,
                    'name' => $request->nombre,
                    'email' => $request->nombre[0] . $request->ap_paterno[0] . $request->ap_materno[0] . $request->ci . "@sis.com",
                    'username'=>$id_people->generateUser(),
                    'password'=> Hash::make($request->ci),
                    'estado'=>'activo',
                ])->assignRole($request->role);

                // User::create([
                //     'id_people'=> $id_people->id,
                //     'name' => $request->nombre,
                //     'email' => $request->nombre[0] . $request->ap_paterno[0] . $request->ap_materno[0] . $request->ci . "@sis.com",
                //     'username'=>$request->nombre[0] . $request->ap_paterno[0] . $request->ap_materno[0] . $request->ci,
                //     'password'=> Hash::make($request->ci),
                //     'estado'=>'activo',
                // ])->assignRole($request->role);
                
                session()->flash('mensaje', 'Usuario registrado con exito');
                return redirect(route('userlist'));
            }else {
                Person::create([
                    'ci' => $request->ci,
                    'extension'=>$request->extension,
                    'nombre' => $request->nombre,
                    'ap_materno' => $request->ap_materno,
                    'genero'=> $request->genero,
                    'fechanacimiento' => $request->fechanacimiento,
                    'celular' => $request->celular,
                    'direccion' => $request->direccion,
                    'correo'=>$request->correo
                ]);
                
                $id_people = Person::where('ci',$request->ci)->first();
    
                User::create([
                    'id_people'=> $id_people->id,
                    'name' => $request->nombre,
                    'email' => $request->nombre[0] . $request->ap_materno[0] . $request->ap_materno[1] . $request->ci . "@sis.com",
                    'username'=>$id_people->generateUser(),
                    'password'=> Hash::make($request->ci),
                    'estado'=>'activo',
                ])->assignRole($request->role);

                // User::create([
                //     'id_people'=> $id_people->id,
                //     'name' => $request->nombre,
                //     'email' => $request->nombre[0] . $request->ap_materno[0] . $request->ap_materno[1] . $request->ci . "@sis.com",
                //     'username'=>$request->nombre[0] . $request->ap_materno[0] . $request->ap_materno[1] . $request->ci,
                //     'password'=> Hash::make($request->ci),
                //     'estado'=>'activo',
                // ])->assignRole($request->role);
                
                session()->flash('mensaje', 'Usuario registrado con exito');
                return redirect(route('userlist'));
            }
        } catch (\Throwable $th) {

         session()->flash('mensaje', 'Error ya existe un usuario con ese numero de carnet');
         return redirect(route('createuser'));
        }
    }

    public function show(User $user){
        $roles = Role::all();
        $user_role = Model_has_roles::where("model_id",$user->id)->first();
        return view('users.user_show', compact('user','roles','user_role'));
    }

    public function pdf(){
        $usuarios = User::all();
        $pdf = PDF::loadView('users.pdf',['usuarios'=>$usuarios]);
        $pdf->setPaper('letter', 'landscape');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function update(Request $request){

        try {
            
            $data = Person::where('id',$request->id)->update([

                'ci' => $request->ci,
                'extension'=>$request->extension,
                'nombre' => $request->nombre,
                'ap_materno' => $request->ap_materno,  
                'ap_paterno'=>$request->ap_paterno,                  
                'fechanacimiento' => $request->fechanacimiento,
                'celular' => $request->celular,
                'direccion' => $request->direccion,
                'genero'=>$request->genero,
                'correo'=>$request->correo
            ]);

            $people = Person::where('ci',$request->ci)->first();
            

            $user = User::where('id_people',$request->id)->first();
            
            $user->update([
                'username'=> $people->generateUser()
            ]);
            

            DB::table('model_has_roles')->where('model_id',$user->id)->update([
                'role_id' => $request->role
            ]);
            session()->flash('mensaje', 'USUARIO MODIFICADO EXITOSAMENTE');
            return redirect(route('userlist'));
        } catch (\Throwable $th) {
            session()->flash('mensaje', 'Error ya existe un usuario con ese numero de carnet');
            return redirect(route('createuser'));
        }
        
    }



    public function disable($request){

        $usuario = User::where('id',$request)->first();

        if ($usuario && $usuario->estado == 'activo') {
            $usuario->estado = 'inactivo';
            $usuario->save();
            session()->flash('mensaje', 'Usuario: ' . $usuario->username . ' dehabilitado exitosamente');
            return redirect(route('userlist'));
        }else{
            session()->flash('error', 'Error al intentar deshabilitar al usuario');
            return redirect(route('userlist'));
        }
    }



    public function enable($request){

        $usuario = User::where('id',$request)->first();

        if ($usuario && $usuario->estado == 'inactivo') {
            $usuario->estado = 'activo';
            $usuario->save();
            session()->flash('mensaje', 'Usuario: ' . $usuario->username . ' habilitado exitosamente');
            return redirect(route('userlist'));
        }else{
            session()->flash('error', 'Error al intentar habilitar al usuario');
            return redirect(route('userlist'));
        }
    }

    
    public function search(Request $request){
        
        $query = $request->get('query');

        $data=[];   

        if ($query != '' or $query != NULL or $query->empty()) {
            
            $listausuarios = User::join('people','people.id','=','users.id_people')
                        ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                        ->join('roles','roles.id','=','model_has_roles.role_id')
                        ->select('users.id as id','people.ci as ci','people.nombre as nombre','people.ap_paterno as paterno','people.ap_materno as materno','roles.name as cargo', 'people.correo as correo', 'users.estado as estado')
                        ->where('people.nombre', 'LIKE', '%' . $query . '%')
                        ->orwhere('people.ci', 'LIKE', '%' . $query . '%')
                        ->orwhere('people.ap_paterno', 'LIKE', '%' . $query . '%')
                        ->orwhere('people.ap_materno', 'LIKE', '%' . $query . '%')
                        ->get();
            
            foreach ($listausuarios as $usuario) {
                
                $datatable = [
                        [
                        'id'=>$usuario->id,
                        'ci'=>$usuario->ci,
                        'nombre'=>$usuario->nombre,
                        'paterno'=>$usuario->paterno,
                        'materno' => $usuario->materno,
                        'cargo'=>$usuario->cargo,
                        'correo'=>$usuario->correo,
                        'estado'=>$usuario->estado
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);

        } else {
            $usuarios = User::join('people','people.id','=','users.id_people')
                        ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                        ->join('roles','roles.id','=','model_has_roles.role_id')
                        ->select('users.id as id','people.ci as ci','people.nombre as nombre','people.ap_paterno as paterno','people.ap_materno as materno','roles.name as cargo', 'people.correo as correo', 'users.estado as estado')
                        ->get();
            
            foreach ($usuarios as $usuario) {
                
                $datatable = [
                    [
                        'id'=>$usuario->id,
                        'ci'=>$usuario->ci,
                        'nombre'=>$usuario->nombre,
                        'paterno'=>$usuario->paterno,
                        'materno' => $usuario->materno,
                        'cargo'=>$usuario->cargo,
                        'correo'=>$usuario->correo,
                        'estado'=>$usuario->estado
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);
        }  
    }

}

