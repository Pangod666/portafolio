@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          <div style="padding: 2%">
            <div>
              <h1>EDITAR ESPECIALIDAD</h1>
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
                <div class="col-md-12">
                  <form method="POST">
                    {{ csrf_field() }}
                    <div class="input-box">
                        <input type="hidden" name="id" value="{{ $especialidad->id }}">
                    </div>
                    <div class="form-group">
                      <label for="nit">NOMBRE:<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nombre" value="{{ $especialidad->nombre }}">
                    </div>
                    <div class="form-group">
                      <label for="nombre">DESCRIPCION:</label>
                      <textarea name="descripcion" rows="2" cols="20" class="form-control">{{ $especialidad->descripcion }}</textarea>
                    </div>
                    <div class="button">
                      <button type="submit" class="btn btn-success">GUARDAR <i class="fa fa-file" aria-hidden="true"></i> </button>
                      <a href="{{ route('bedindex') }}" class="btn btn-danger">CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i> </a> 
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



