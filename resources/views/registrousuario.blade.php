@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white">
          <div style="padding: 2%">
            <div>
              <h1>REGISTRO DEL PERSONAL DE LA UNDIAD DE TERPIA INTENSIVA DEL H.S.G</h1>
            </div>
            <div class="container">
              @if (session('mensaje'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              @endif
              <div class="row">
                <div class="col-md-6">
                  <form method="POST" action="{{ route('storeuser') }}" >
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="ci">CARNET DE IDENTIDAD: <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="ci" placeholder="INGRESE SU CI" required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">NOMBRE: <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nombre" placeholder="INGRESE EL NOMBRE" required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">APELLIDO PATERNO : <span style="color: red"></span></label>
                      <input type="text" class="form-control" name="ap_paterno" placeholder="INGRESE EL APELLIDO PATERNO">
                    </div>
                    <div class="form-group">
                      <label for="nombre">APELLIDO MATERNO: <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="ap_materno" placeholder="INGRESE EL APELLIDO MATERNO" required>
                    </div>
                    <div class="form-group">
                      <label>GENERO: <span style="color: red">*</span></label>
                      <select name="genero" class="form-control" required>
                        <option value="" disabled selected >SELECIONE SU GENERO</option>
                        <option value="HOMBRE">HOMBRE</option>
                        <option value="MUJER">MUJER</option>
                      </select>
                    </div>
                    @can('reports')
                    <div class="form-group">
                      <label>CARGO: <span style="color: red">*</span></label>
                      <select class="form-control" aria-label=".form-select-lg example" name="role" style="margin:10px; width: 300px" required >
                        <option value="" disabled selected>SELCCIONE EL CARGO</option>
                        @foreach ($data as $rol)
                            <option value="{{ $rol['name'] }}">{{ $rol['name'] }}</option>
                        @endforeach
                      </select>
                    </div>    
                    @endcan
                    <!-- Agrega más campos aquí -->
                  
                </div>
                <div class="col-md-6">
                  <!-- Aquí puedes agregar contenido en la segunda columna -->
                  <div class="form-group">
                    <label for="nombre">EXTENSIÓN:<span style="color: red">*</span></label>
                    <select name="extension" class="form-control" required>
                      <option value="" disabled selected >SELECION LA EXTENSION DE SU CI</option>
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
                    <input type="date" class="form-control" name="fechanacimiento" max="{{date('Y-m-d', strtotime('-18 years'))}}" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">CELULAR: <span style="color: red">*</span></label>
                    <input type="number" class="form-control" min="10000000" name="celular" placeholder="INGRESE EL NUMERO DE CELULAR">
                  </div>
                  <div class="form-group">
                    <label for="nombre">DIRECCION: <span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="direccion" placeholder="INGRESE EL DOMICILIO" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">EMAIL: <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="correo" placeholder="INGRESE EL CORREO ELECTRONICO" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="button">
                      <button type="submit" class="btn btn-success"> GUARDAR  <i class="fa fa-file" aria-hidden="true"></i> </button>
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


