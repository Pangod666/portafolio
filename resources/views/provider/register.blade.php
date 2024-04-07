{{-- @extends('dashboard')

@section('content')

<div class="container">
  <div class="title">Registro de Proveedores</div>
  <div class="content">
    <form method="POST" action="{{ route('providerstore') }}" >
      {{ csrf_field() }}
      <div class="user-details">
        <div class="input-box">
          <span class="details">NIT<span style="color: red">*</span></label>
          <input type="text" name="nit" placeholder="Ingrese su nombre" required>
        </div>
        <div class="input-box">
          <span class="details">Nombre</span>
          <input type="text" name="nombre" placeholder="Ingrese su apellido paterno" required>
        </div>
        <div class="input-box">
          <span class="details">Direccion</span>
          <input type="text" name="direccion" placeholder="Ingrese su apellido paterno" required>
        </div>
        <div class="input-box">
          <span class="details">Telefono</span>
          <input type="text" name="telefono" placeholder="Ingrese su numero de CI" required>
        </div>
        <div class="input-box">
          <span class="details">Email</span>
          <input type="email" name="email" required>
        </div>
        
      <div class="button">
        <input type="submit" value="Registrar">
      </div>
    </form>
  </div>
</div>

@endsection --}}


@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          <div style="padding: 2%">
            <div>
              <h1>REGISTRO DE LABORATORIO Y PROVEEDOR DE MEDICAMENTOS</h1>
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
                  <form method="POST" action="{{ route('providerstore') }}" >
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="nit">NIT: <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nit" placeholder="INGRESE EL NIT" required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">LABORATORIO: <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nombre" placeholder="INGRESE EL NOMBRE DEL LABORATORIO"required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">DIRECCION <span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="direccion" placeholder="INGRESE LA DIRECCION DEL LABORATIRIO" required>
                    </div>
                    <div class="button">
                      <button type="submit" class="btn btn-primary">GUARDAR</button>
                      <a href="{{ route('providerlist') }}" class="btn btn-danger">CANCELAR</a>
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
                </div>
                <div class="col-md-6">
                  <!-- Aquí puedes agregar contenido en la segunda columna -->
                  <div class="form-group">
                    <label for="nombre">NOMBRE DEL PROVEEDOR:<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="encargado" placeholder="INGRESE EL NOMBRE DEL PROVEEDOR" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">CELULAR: <span style="color: red">*</span></label>
                    <input type="number" min="10000000" class="form-control" name="telefono" placeholder="INGRESE EL CELULAR" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">EMAIL:</label>
                    <input type="email" class="form-control" name="email" placeholder="INGRESE EL CORREO ELECTRONICO">
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


