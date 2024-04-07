@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white">
          <div style="padding: 5%">
            <div>
              <h1>EDITAR USUSARIO </h1>
            </div>
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <form method="POST">
                    {{ csrf_field() }}
                    
                    <div class="input-box">
                      <input type="hidden" name="id" value="{{ $user->person->id }}">
                    </div>

                    <div class="form-group">
                      <label for="ci">CARNET DE IDENTIDAD: <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="ci" placeholder="INGRESE SU CI" required value="{{ $user->person->ci }}">
                      </div>      
                    <div class="form-group">
                      <label for="nombre">NOMBRE:<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nombre" placeholder="INGRESE EL NOMBRE" required value="{{$user->person->nombre }}">
                    </div>
                    
                    
                    
                    
                    <div class="form-group">
                      <label for="nombre">APELLIDO PATERNO :<span style="color: red"></span></label>
                      <input type="text" class="form-control" name="ap_paterno" placeholder="INGRESE EL APELLIDO PATERNO" value="{{ $user->person->ap_paterno }}">
                    </div>
                    <div class="form-group">
                      <label for="nombre">APELLIDO MATERNO: <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="ap_materno" placeholder="INGRESE EL APELLIDO MATERNO" required value="{{$user->person->ap_materno }}">                    </div>
                  
                    <div class="form-group">
                      <label for="nombre">GENERO:<span style="color: red">*</span></label>
                      <select name="genero" class="form-control" required value="{{ $user->person->genero}}>
                        <option value="selected >SELECIONE SU GENERO</option>
                        <option value="HOMBRE">HOMBRE</option>
                        <option value="MUJER">MUJER</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label for="nombre">GENERO:<span style="color: red">*</span></label>
                        <select class="form-control" aria-label=".form-select-lg example" name="role"  required >
                          @foreach ($roles as $rol)
                            @if ($rol->name == $user_role->role->name)
                            <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                            @else
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endif
                          @endforeach
                        </select>
                    </div>
                    
                    <!-- Agrega más campos aquí -->  
                </div>

                <!-- OTRA COLUMNA -->

                <div class="col-md-6">
                  <!-- Aquí puedes agregar contenido en la segunda columna -->
                
                  <div class="form-group">
                    <label for="nombre">EXTENSION <span style="color: red">*</span></label>
                    <select name="extension" class="form-control" required>
                      <option value="{{ $user->person->extension }}" selected >{{ $user->person->extension }}</option>
                      <option value="LP">LP (LA PAZ)</option>
                      <option value="OR">OR (ORURO)</option>
                      <option value="PT">PT (POTOSI)</option>
                      <option value="CB">CB (CBBA)</option>
                      <option value="SC">SC (STA CRUZ)</option>
                      <option value="BN">BN (BENI)</option>
                      <option value="PA">PA (PANDO)</option>
                      <option value="TJ">TJ (TARIJA)</option>
                      <option value="CH">CH (CHUQUISACA)</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="nombre">FECHA DE NACIMIENTO: <span style="color: red">*</span></label>
                    <input type="date" class="form-control" name="fechanacimiento" value="{{ $user->person->fechanacimiento }}" max="{{date('Y-m-d', strtotime('-18 years'))}}">
                  </div>
                  <div class="form-group">
                    <label for="nombre">CELULAR: <span style="color: red">*</span></label>
                    <input type="number" class="form-control" min="10000000" name="celular"   required value="{{ $user->person->celular }}">
                  </div>
                  <div class="form-group">
                    <label for="nombre">DIRECCION: <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="direccion" placeholder="INGRESE EL DOMICILIO"  required value="{{ ucwords($user->person->direccion) }}">
                  </div>
                  <div class="form-group">
                    <label for="nombre">EMAIL: <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="correo"  required value="{{ $user->person->correo }}">
                  </div>
                </div>
                
                <div class="row">
                  <div class="form-group">
                      <button type="submit" class="btn btn-success"> GUARDAR <i class="fa fa-file" aria-hidden="true"></i> </button> 
                      <a href="{{ route('userlist') }}" class="btn btn-danger"> CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i> </a> 
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection


