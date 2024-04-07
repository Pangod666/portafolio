@extends('layouts.app', ['title' => __('Patient Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('PACIENTE: ') . ' '. strtoupper($paciente->person->nombre ). ' ' . strtoupper($paciente->person->ap_paterno) . ' '. strtoupper($paciente->person->ap_materno),
        // 'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="https://images.vexels.com/media/users/3/153835/isolated/preview/172ddc045ae1707a415adeae0543a5f0-icono-de-trazo-de-color-del-paciente.png" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3>
                                {{ $paciente->person->nombre . ' ' . $paciente->person->ap_paterno . ' ' . $paciente->person->ap_materno }}<span class="font-weight-light"></span>
                            </h3>
                            <div class="h5 font-weight-800"> 
                                <i class="ni location_pin mr-2"></i> ESPECIALIDAD: {{ strtoupper($paciente->especialidad->nombre) }}
                            </div>
                            @if ($paciente->estado=='INTERNADO')
                              <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i> ESTADO: {{ $paciente->estado }}
                              </div>
                              <div>
                                <i class="ni education_hat mr-2"></i><a href="{{ route('patientpdf',$paciente->id) }}" target="_blank" class="btn btn-primary">IMPRIMIR DATOS</a>
                              </div>
                              <div>
                                <i class="ni education_hat mr-2" style="padding-top:2em "></i><a href="{{ route('dar_alta',$paciente->id) }}" class="btn btn-danger">DAR DE ALTA</a>
                              </div>
                            @else
                              <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i> Estado: {{ $paciente->estado }}
                              </div>
                              <div>
                                <i class="ni education_hat mr-2"></i><a href="{{ route('patientpdf',$paciente->id) }}" target="_blank" class="btn btn-primary">IMPRIMIR DATOS</a>
                              </div>
                              <div>
                                <i class="ni education_hat mr-2" style="padding-top:2em "></i><a href="{{ route('internar',['id' => $paciente->id, 'especialidad' => $paciente->especialidad->id]) }}" class="btn btn-success">INTERNAR</a>
                              </div>
                            @endif

                            <div>
                              <i class="ni education_hat mr-2" style="padding-top:2em "></i><a href="#historial" class="btn btn-default">VER HISTORIAL </a>
                            </div>
                            
    

                        <div>
                            <a href="{{ route('patientindex') }}" class="btn btn-danger ">CANCELAR</a>
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <!--- FORMULARIO --->
            @if (session('mensaje'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                      <button button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> 
            @endif
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row text-aling-center">
                            <h3 style="padding: 0px 150px 0px;"class="mb-0">{{ __('DATOS DEL PACIENTES') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('patientedit',$paciente->id) }}">
                            {{ csrf_field() }}
                            <div class="row row-space">
                            <div class="col-1">
                            </div>
                                <div class="col-5">
                                  <div class="input-box">
                                    <input type="hidden" name="id" value="{{ $paciente->person->id }}">
                                  </div>
                                  <div class="form-group">
                                    <label for="ci">CARNET DE IDENTIDAD:span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="ci" placeholder="INGRESE SU CI" value="{{ $paciente->person->ci }}"  required>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="nombre">NOMBRE:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nombre" value="{{ $paciente->person->nombre }}" placeholder="INGRESE EL NOMBRE"  required>
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">APELLIDO PATERNO:</label>
                                    <input type="text" class="form-control" name="ap_paterno" value="{{ $paciente->person->ap_paterno }}" placeholder="INGRESE EL APELLIDO PATERNO" >
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">APELLIDO MATERNO:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="ap_materno" value="{{ $paciente->person->ap_materno }}" placeholder="INGRESE EL APELLIDO MATERNO"   required>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label>GENERO:<span style="color: red">*</span></label>
                                    <select name="genero" class="form-control" >
                                      <option value="{{ $paciente->person->genero }}" selected >{{ $paciente->person->genero }}</option>
                                      <option value="HOMBRE">HOMBRE</option>
                                      <option value="MUJER">MUJER</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label class="label">ESPECIALIDAD:<span style="color: red">*</span></label>
                                    <select name="especialidad" class="form-control" value="" required >
                                      <option value="{{ $paciente->especialidad->id }}" selected="selected" >{{ $paciente->especialidad->nombre }}</option>
                                      @foreach ($especialidades as $especialidad)
                                          <option value="{{ $especialidad['id'] }}">{{ $especialidad['nombre'] }}</option>
                                      @endforeach 
                                    </select>
                                  </div>
                                </div>

                                
                                <div class="col-5">
                                  <div class="form-group">
                                    <label for="nombre">EXTENSION:<span style="color: red">*</span></label>
                                    <select name="extension" class="form-control"  required>
                                      <option value="{{ $paciente->person->extension }}" selected >{{ $paciente->person->extension }}</option>
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
                                    <label for="nombre">FECHA DE NACIMIENTO:<span style="color: red">*</span></label>
                                    <input type="date" class="form-control" value="{{ $paciente->person->fechanacimiento }}" name="fechanacimiento" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">ESTADO CIVIL:</label>
                                    <input type="text" class="form-control" value="{{ lcfirst($paciente->person->estado_civil )}}" name="estado_civil" placeholder="INGRESE SU ESTADO CIVIL">
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">OCUPACION:</label>
                                    <input type="text" class="form-control" name="ocupacion" value="{{ $paciente->person->ocupacion }}" placeholder="INGRESE LA OCUPACION DEL PACIENTE">
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">CELULAR:</label>
                                    <input type="text" class="form-control" name="telefono" value="{{ $paciente->person->celular  }}" placeholder="INGRESE SU NUMERO DE CELULAR">
                                  </div>
                                  <div class="form-group">
                                    <label for="">DIRECCION:</label>
                                    <input type="text" class="form-control" name="direccion" value="{{ ucwords($paciente->person->direccion)  }}" placeholder="INGRESE LA DIRECCION DE SU DOMICILIO">
                                  </div>
                                </div>
                                
                                
                           
                            </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </div> 
                        </form>


                        <hr class="my-4" />


                        <form method="POST" action="{{ route('tutoredit',$paciente->tutor->id) }}">
                          {{ csrf_field() }}
                            
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 style="padding: 0px 150px 0px;"class="mb-0" class="mb-0">{{ __('DATOS DEL RESPONSABLE') }}</h3>
                                </div>
                            </div>
                            <div class="input-box">
                              <input type="hidden" name="id_tutor" value="{{ $paciente->tutor->person->id }}">
                            </div>
                            <div class="row row-space">
                            <div class="col-1">
                            </div>
                                <div class="col-5">
                                  <div class="form-group">
                                    <label for="ci">CARNET DE IDENTIDAD:</label>
                                    <input type="text" class="form-control" value="{{ $paciente->tutor->person->ci }}" name="ci_tutor" placeholder="INGRESE EL CI">
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">NOMBRE:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nombre_tutor" value="{{ $paciente->tutor->person->nombre }}" placeholder="INGRESE EL NOMBRE" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">APELLIDO MATERNO:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="ap_materno_tutor" value="{{ $paciente->tutor->person->ap_materno }}" placeholder="INGRESE EL APELLIDO MATERNO" required>
                                  </div>

                                </div>
                                
                                
                                <div class="col-5">
                                  <div class="form-group">
                                    <label for="nombre">Extensión:</label>
                                    <select name="extension_tutor" class="form-control">
                                      <option value="" disabled selected >{{ $paciente->tutor->person->extension  }}</option>
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
                                    <label for="nombre">APELLIDO PATERNO:</label>
                                    <input type="text" class="form-control" name="ap_paterno_tutor" value="{{ $paciente->tutor->person->ap_paterno }}" placeholder="INGRESE EL APELLIDO PATERNO" >
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">PARENTESCO</label>
                                    <input type="text" class="form-control" name="parentesco" value="{{ $paciente->tutor->parentesco }}" placeholder="PARENTESCO CON EL PACIENTE" required>
                                  </div>
                                </div>
                            </div>


                            <div class="row row-space">
                            <div class="col-1">
                            </div>
                              <div class="col-3">
                                <div class="form-group">
                                  <label for="">DIRECCION:</label>
                                  <input type="text" class="form-control" name="direccion_tutor" value="{{ $paciente->tutor->person->direccion }}" placeholder="DIRECCION DE DOMICILIO">
                                </div>
                              </div>
                             
                              <div class="col-3">
                              <div class="form-group">
                                    <label for="">Celular:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="telefono_tutor" value="{{ $paciente->tutor->person->celular}}" placeholder="CELULAR DEL RESPONSABLE" required>
                                  </div>
                              </div>
                              <div class="col-3">
                                <div class="form-group">
                                  <label for="">TELEFONO</label>
                                  <input type="text" class="form-control" name="telefono_emergencia_tutor" value="{{ $paciente->tutor->person->telefono_emergencia }}" placeholder="INGRESE EL TELEFONO">
                                </div>
                              </div>
                            </div>
                            <div class="pl-lg-4">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success">GUARDAR</button>
                                </div>
                            </div> 
                        </form>

                        <hr class="my-4" />
                    </div>
                    

                    <div class="card-header bg-white border-0">
                      <div class="row align-items-center">
                          <h3 id="historial" class="mb-0">{{ __('HISTORIAL DE INGRESOS Y EGRESOS DEL PACIENTE') }}</h3>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="user-table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color: white">HISTORIA</th>
                            <th scope="col" style="color: white">ESPECIALIDAD</th>
                            <th scope="col" style="color: white">FECHA</th>
                            <th scope="col" style="color: white">RESPONSABLE</th>
                          </tr>
                        </thead>
                        <tbody>
                             @foreach ($histories as $history)
                              <tr>
                                @if ($history->action == 'INTERNADO')
                                  <td style="color: green">{{ $history->action }}</td>   
                                 
                                @else
                                  <td style="color: red">{{ $history->action }}</td>   
                                @endif
                                @if ($history->especialidad)
                                  <td>{{ $history->especialidad->nombre }}</td>   
                                  
                                @else
                                  <td></td>  
                                  @endif
                                  
                                 <td>{{ $history->fecha}}</td>
                                 <td>{{ $history->usuario->person->nombre . " " .$history->usuario->person->ap_materno . " ". $history->usuario->person->ap_paterno  }}</td>
                              </tr>
                             @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                <hr class="my-4" />
            </div>
        </div>
    </div>
@endsection
