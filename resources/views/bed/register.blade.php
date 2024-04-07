{{-- @extends('dashboard')

@section('content')

<div class="container">
  <div class="title">ESPECIALIDAD</div>
  <div class="content">
    <form method="POST" action="{{ route('bedstore') }}" >
      {{ csrf_field() }}
      <div class="user-details">

        <div class="input-box">
          <span class="details">Nombre:<span style="color: red">*</span></label>
          <input type="text" name="nombre" placeholder="Ingrese el nombre de la unidad" required>
        </div>
        <div class="input-box">
          <span class="details">Descripción:</span>
          <input type="text" name="descripcion" placeholder="Ingrese el nombre de la unidad">
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
              <h1>ESPECIALIDADES REGISTRADAS</h1>
            </div>
            <div class="container">
              @if (session('mensaje'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              @endif
              <div class="row">
                <div class="col-md-12">
                  <form method="POST" action="{{ route('bedstore') }}" >
                    {{ csrf_field() }}
                   


                    <div class="form-group">
                    <label for="nit">NOMBRE <span style="color: red">*</span></label>
                                    <select name="nombre" class="form-control" required>
                                      <option value="" disabled selected >INGRESE EL NOMBRE DE LA ESPECIALIDAD </option>
                                      <option >CARDIOLOGIA</option>
                                      <option >CIRUGIA PLASTICA</option>
                                      <option >CIRUGIA GENERAL</option>
                                      <option >COLOPROCTOLOGIA</option>
                                      <option >NEFROLOGIA</option>
                                      <option >NEUMOLOGIA</option>
                                      <option >NEUROLOGIA</option>
                                      <option >UROLOGIA</option>
                                      <option >TRAUMATOLOGIA</option>
                                      <option >POLICONTUSO GRAVE</option>
                                     
                                    </select>
                                  </div>

                    <div class="form-group">
                      <label for="nombre">DESCRIPCION:</label>
                      <textarea name="descripcion" rows="4" cols="20" class="form-control" placeholder="BREVE DESCRIPCION"></textarea>
                    </div>
                    <div class="button">
                      <button type="submit" class="btn btn-success">GUARDAR <i class="fa fa-file" aria-hidden="true"></i> </button>
                      <a href="{{ route('bedindex') }}" class="btn btn-danger"> CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i> </a> 
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
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



