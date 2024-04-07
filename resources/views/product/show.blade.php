@extends('layouts.app')
@section('content')
<!-- editar del grupo de medicmanetos  a los medicamentos -->
<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white">
          <div style="padding: 2%">
            <div>
              <h1>{{ $product->nombre_comercial }}</h1>
            </div>
            <div>
              <h1>EDITAR MEDICAMENTO</h1>
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

                       <!-- editar del grupo de medicmanetos  a los medicamentos -->
                       <div class="form-group">
                    <label for="nombre">NOMBRE GENERICO<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nombre_generico" value="{{ $product->nombre_generico }}" placeholder="INGRESE EL NOMBRE GENERICO" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nombre">CONCENTRACION:<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="concentracion" value="{{ $product->concentracion }}" placeholder="INGRESE LA CONCENTRACION" disabled>
                  </div>
                  <div class="form-group">
                      <label for="nombre">CANTIDAD:<span style="color: red">*</span></label>
                      <input type="number" min="0" step="1" class="form-control" name="cantidad" value="{{ $product->cantidad }}" placeholder="INGRESE LA CANTIDAD" disabled>
                    </div>
                    <div class="form-group">
                      <label for="">PRECIO ADQUIRIDO:<span style="color: red">*</span></label>
                      <input type="number" step="any" min="0" class="form-control" name="precio_adquirido" value="{{ $product->precio_adquirido }}" placeholder="INGRESE EL PRECIO ADQUIRIDO" required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">FECHA DE REGISTRO:<span style="color: red">*</span></label>
                      <input type="date" class="form-control" value="{{ $product->fecha_registro }}" name="fecha_registro" >
                    </div>
                   
                    
                    <div class="form-group">
                      <label for="">GRUPO DE MEDICAMENTO:<span style="color: red">*</span></label>
                      <select class="form-control" aria-label=".form-select-lg example" name="categoria" id="inputRole_id"  required >
                        <option value="{{ $product->categoria->id }}"  selected> {{ $product->categoria->nombre }}</option>
                      @foreach ($categorias as $categoria)
                          @if ($product->categoria->nombre != $categoria->nombre)
                              <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                          @endif
                      @endforeach
                      </select>
                    </div>
                    
                   
                    <div class="form-group">
                    <label for="nombre">LABORATORIO:<span style="color: red">*</span></label>
                    <select class="form-control" aria-label=".form-select-lg example" name="proveedor" id="inputRole_id"  required  disabled>
                        <option value="{{ $product->proveedor->id }}"  selected> {{ $product->proveedor->nombre }}</option>
                      @foreach ($proveedores as $proveedor)
                          @if ($product->proveedor->nombre != $proveedor->nombre)
                              <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                          @endif
                      @endforeach
                      </select>
                  </div>
                    
                   

                    <div class="button">
                      <button type="submit" class="btn btn-success"> GUARDAR <i class="fa fa-file" aria-hidden="true"></i> </button>
                      <a href="{{ url()->previous() }}" class="btn btn-danger">CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i></a>
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
                </div>
                <div class="col-md-6">
                  <!-- Aquí puedes agregar contenido en la segunda columna -->
                  
                  <div class="form-group">
                      <label for="nombre">NOMBRE COMERCIAL:<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nombre_comercial" value="{{ $product->nombre_comercial }}" placeholder="INGRESE EL NOMBRE COMERCIAL" disabled>
                    </div>
                    <div class="form-group">
                    <label for="nombre">FORMA FARMACEUTICA:<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="forma_farmaceutica" value="{{ $product->forma_farmaceutica }}" placeholder="INGRESE LA FORMA FARMACEUTICA" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nombre">NIVEL DE REORDENAMIENTO:<span style="color: red">*</span></label>
                    <input type="number" min="0" step="1" class="form-control" name="nivel_reorden" value="{{ $product->nivel_reorden }}" placeholder="INGRESE EL NIVEL DE REORDENAMIENTO" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">PRECIO EN VENTA:</label>
                    <input type="number" step="any" min="0" class="form-control" name="precio_venta" value="{{ $product->precio_venta }}" placeholder="INGRESE EL PRECIO DE VENTA" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">FECHA DE VENCIMIENTO:<span style="color: red">*</span></label>
                    <input type="date" class="form-control" name="fecha_vencimiento" value="{{ $product->fecha_vencimiento }}" required>
                  </div>
                  <div class="form-group">
                      <label for="nombre">TIPO DE VENTA:<span style="color: red">*</span></label>
                      <select class="form-control" name="tipo_venta" required>
                        <option value="{{ $product->tipo_de_venta }}" selected>{{ $product->tipo_de_venta }}</option>
                        @if ($product->tipo_de_venta == "Publico")
                        <option value="PUBLICO">PUBLICO/option>
                           
                        @else
                        <option value="BAJO RECETA">BAJO RECETA</option>
                        @endif 
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="nombre">REFRIGERADO:<span style="color: red">*</span></label>
                    <select class="form-control" name="refrigerado" required>
                      <option value="{{$product->refrigerado}}" selected>{{$product->refrigerado}}</option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>
                    </select>
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


