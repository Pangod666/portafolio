@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          <div style="padding: 2%">
            <div>
              <h1>EDITAR LABORATORIO Y PROVEEDOR </h1>
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
                  <form method="POST">
                    {{ csrf_field() }}

                    <div class="input-box">
                        <input type="hidden" name="id" value="{{ $provider->id }}">
                      </div>
                    <div class="form-group">
                      <label for="nit">NIT:<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nit" value="{{ $provider->nit }}" required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">LABORATORIO:<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nombre" value="{{ $provider->nombre }}" required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">DIRECCION:<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="direccion" value="{{ $provider->direccion }}" required>
                    </div>
                    <div class="button">
                      <button type="submit" class="btn btn-success">GUARDAR <i class="fa fa-file" aria-hidden="true"></i></button>
                      <a href="{{ route('providerlist') }}" class="btn btn-danger">CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i></a>
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
                </div>
                <div class="col-md-6">
                  <!-- Aquí puedes agregar contenido en la segunda columna -->
                  <div class="form-group">
                    <label for="nombre">NOMBRE DEL PROVEEDOR:<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="encargado" value="{{ $provider->encargado }}" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">CELULAR:<span style="color: red">*</span></label>
                    <input type="number" min="10000000" class="form-control" name="telefono" value="{{$provider->telefono}}" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">EMAIL:</label>
                    <input type="email" class="form-control" name="email" value="{{$provider->email}}">
                  </div>
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