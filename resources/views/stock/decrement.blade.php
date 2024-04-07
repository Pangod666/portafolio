@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white">
          <div style="padding: 2%">
            <div>
              <h1>{{ $product->nombre_generico }}</h1>
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
                  <form method="POST" >
                    {{ csrf_field() }}
                    <div class="input-box">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                      </div>
                      <div class="form-group">
                      <label for="nombre"><b>Nombre Generico:</b> {{ strtoupper($product->nombre_generico) }}</label>
                    </div>
                    <div class="form-group">
                    <label for="nombre"><b>Concentracion: </b>{{ $product->concentracion }}</label>
                  </div>
                  <div class="form-group">
                      <label for="nombre"><b>Cantidad Disponible:</b> {{ $product->cantidad }}Uni.</label>
                    </div>
                    <div class="form-group">
                      <label for=""><b>Precio Adquirido: </b>{{ $product->precio_adquirido }}Bs</label>
                    </div>
                    <div class="form-group">
                      <label for="nombre"><b>Fecha de Registro</b> {{ $product->fecha_registro }}</label>
                    </div>
                    <div class="form-group">
                    <label for=""><b>Categoria: </b>{{ $product->categoria->nombre }}</label>
                  </div> 
                    
                   
                  
                    
                   

                    <div class="form-group">
                        <label for="nombre">Cantidad a Retirar:</label>
                        <input type="number" min="0" step="1" class="form-control" name="quantity" placeholder="Ingrese la cantidad de producto a ingresar en el sistema" required>
                    </div>

                    <div class="button">
                      <button type="submit" class="btn btn-primary">Retirar</button>
                      <a href="{{ route('productlist') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
                </div>
                <div class="col-md-6">
                  <!-- Aquí puedes agregar contenido en la segunda columna -->
                  <div class="form-group">
                      <label for="nombre"><b>Nombre Comercial:</b> {{ strtoupper($product->nombre_comercial) }}</label>
                    </div>
                  
                  <div class="form-group">
                    <label for="nombre"><b>Forma Farmaceutica: </b>{{ $product->forma_farmaceutica }}</label>
                  </div>
                  <div class="form-group">
                      <label for="nombre"><b>Cantidad de Reorden:</b> {{ $product->nivel_reorden}}Uni.</label>
                    </div>
                    <div class="form-group">
                    <label for="nombre"><b>Precio de Venta: </b>{{ $product->precio_venta }}Bs</label>
                  </div>
                  <div class="form-group">
                    <label for="nombre"><b>Fecha Vencimiento: </b>{{ $product->fecha_vencimiento }}</label>
                  </div>
                  <div class="form-group">
                      <label for=""><b>Laboratorio: </b>{{ strtoupper($product->proveedor->nombre) }}</label>
                    </div>
                  <div class="form-group">
                      <label for="nombre"><b>Tipo de Venta:</b> {{ strtoupper($product->tipo_de_venta) }}</label>
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
