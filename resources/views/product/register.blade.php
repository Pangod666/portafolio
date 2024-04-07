{{-- @extends('dashboard')

@section('content')
<!-- NUEVO MEDICAMETOS  -->
<div class="container">
  <div class="title">Nuevo Medicamento</div>
  <div class="content">
    <form method="POST" action="{{ route('productstore') }}">
      {{ csrf_field() }}
      <div class="product-details">
        <div class="input-box">
          <span class="details">NOMBRE</span>
          <input type="text" name="nombre" placeholder="Ingrese el nombre del producto" required>
        </div>
        <div class="input-box">
          <span class="details">PRESENTACION</span>
          <input type="text" name="presentacion" placeholder="Indique el tipo de presentacion del producto" required>
        </div>
        <div class="input-box">
          <span class="details">TIPO DE VENTA</span>
          <input type="text" name="tipo_venta" placeholder="Ingrese el tipo de venta del producto" required>
        </div>
        <div class="input-box">
          <span class="details">PRECIO</span>
          <input type="number" step="any" name="precio" placeholder="Ingrese el precio publico" required>
        </div>
        <div class="input-box">
          <span class="details">EXISTENCIAS</span>
          <input type="number" name="existencias" placeholder="Ingrese la cantidad de producto" required>
        </div> 
      </div>
      
      <div class="selection-role">
        <div class="row align-items-center">
          <div class="col-md-1">
            <span class="details">CATEGORIA</span>
          </div>
          <div class="col-md-10">
            <select class="form-select form-select-mg mb-3" aria-label=".form-select-lg example" name="categoria" id="inputRole_id"  required >
                <option value="" disabled selected>Seleccione la categoria</option>
              @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>


      <div class="selection-role">
        <div class="row align-items-center">
          <div class="col-md-1">
            <span class="details">LABORATORIO</span>
          </div>
          <div class="col-md-10">
            <select class="form-select form-select-mg mb-3" aria-label=".form-select-lg example" name="proveedor" id="inputRole_id"  required >
                <option value="" disabled selected>Seleccione el laboratorio</option>
              @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      
      <div class="button">
        <input type="submit" value="Crear">
      </div>
    </form>
  </div>
</div>

@endsection --}}

<!-- aqui editar los campos de almacen de medicamentos -->


@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white">
          <div style="padding: 2%">
            <div>
              <h1>NUEVO MEDICAMENTO O PRODUCTO</h1>
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
                  <form method="POST" action="{{ route('productstore') }}" >
                    {{ csrf_field() }}
                    <div class="form-group">
                    <label for="nombre">NOMBRE GENERICO:<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="nombre_generico" placeholder="INGRESE EL NOMBRE GENERICO"required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">CONCENTRACION:<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="concentracion" placeholder="INGRESE LA CONCENTRACION" required>
                  </div>
                  <div class="form-group">
                      <label for="nombre">CANTIDAD:<span style="color: red">*</span></label>
                      <input type="number" min="0" step="1" class="form-control" name="cantidad" placeholder="INGRESE LA CANTIDAD" required>
                    </div>
                  
                    <div class="form-group">
                      <label for="">PRECIO ADQUIRIDO:<span style="color: red">*</span></label>
                      <input type="number" step="any" min="0" class="form-control" name="precio_adquirido" placeholder="INGRESE EL PRECIO ADQUIRIDO" required>
                    </div>
                    <div class="form-group">
                      <label for="nombre">FECHA DE REGISTRO:<span style="color: red">*</span></label>
                      <input type="date" class="form-control" name="fecha_registro" required>
                    </div>
                   
                    <div class="form-group">
                      <label for="">GRUPO DE MEDICAMENTO:<span style="color: red">*</span></label>
                      <select class="form-control" aria-label=".form-select-lg example" name="categoria" id="inputRole_id"  required >
                        <option value="" disabled selected>Seleccione la categoria</option>
                      @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                      @endforeach
                      </select>
                    </div> 
                   
                    
                    <div class="form-group">
                      <label for="">LABORATORIO:<span style="color: red">*</span></label>
                      <select class="form-control" aria-label=".form-select-lg example" name="proveedor" id="inputRole_id" required>
                        <option value="" disabled selected>Seleccione el laboratorio</option>
                      @foreach ($proveedores as $proveedor)
                        @if ($proveedor->estado == 'activo')
                          <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                        @endif
                      @endforeach
                    </select>
                    </div>
                   

                    <div class="button">
                      <button type="submit" class="btn btn-success"> GUARDAR <i class="fa fa-file" aria-hidden="true"></i></button>
                      <a href="{{ route('productlist') }}" class="btn btn-danger">CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i></a>
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
                </div>
                <div class="col-md-6">
                  <!-- Aquí puedes agregar contenido en la segunda columna -->
                 
                  <div class="form-group">
                      <label for="nombre">NOMBRE COMERCIAL:<span style="color: red">*</span></label>
                      <input type="text" class="form-control" name="nombre_comercial" placeholder="INGRESE EL NOMBRE COMERCIAL" required>
                    </div>
                    

                  <div class="form-group">
                  <label for="nombre">FORMA FARMACEUTICA:<span style="color: red">*</span></label>
                                    <select name="forma_farmaceutica" class="form-control" required>
                                      <option value="" disabled selected >INGRESE LA FORMA FARMACEUTICA</option>
                                      <option >AMPOLLAS</option>
                                      <option >CAPSULAS</option>
                                      <option >CREMAS</option>
                                      <option >BARRAS</option>
                                      <option >CREMAS</option>
                                      <option >EMULSIONES</option>
                                      <option >FRASCOS</option>
                                      <option >JARABES</option>
                                      <option >OVULOS</option>
                                      <option >SUPOSITORIOS</option>
                                      <option >SOLUCIONES</option>
                                      <option >TABLETAS</option>
                                     
                                    </select>
                                  </div>




                  <div class="form-group">
                    <label for="nombre">NIVEL DE REORDENAMIENTO:<span style="color: red;">*</span></label>
                    <input type="number" min="0" step="1" class="form-control" name="nivel_reorden" placeholder="Ingrese el nivel de reorden para el producto" required>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <label for="nombre">Precio de Venta<span style="color: red">*</span></label>
                    <input type="number" step="any" min="0" class="form-control" name="precio_venta" placeholder="Ingrese el precio de Venta" required>
                  </div>
                  <div class="form-group">
                    <label for="nombre">Fecha Vencimiento<span style="color: red">*</span></label>
                    <input type="date" class="form-control" name="fecha_vencimiento" required>
                  </div>
                  
                  <div class="form-group">
                      <label for="nombre">Tipo de Venta:<span style="color: red">*</span></label>
                      <select class="form-control" name="tipo_venta" required>
                        <option value="" disabled selected>Seleccion el tipo de venta:</option>
                        <option value=" LIBRE">Libre</option>
                        <option value="BAJO RECETA">Bajo Receta</option>
                      </select>
                  </div>

                  <div class="form-group">
                    <label for="nombre">Refrigerado:<span style="color: red">*</span></label>
                    <select class="form-control" name="refrigerado" required>
                      <option value="" disabled selected>Seleccion una opcion:</option>
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



