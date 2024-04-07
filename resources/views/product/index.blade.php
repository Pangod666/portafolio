
{{-- @extends('dashboard')
@section('content')
<div class="container">
    <!-- Content here -->
    
    <div class="container-fluid">
      <form class="d-flex">
        <input type="text" class="form-control me-2 light-table-filter" data-table="table" placeholder="Buscador">
      </form>
    </div>
    
    <div class="container-fluid">
      <label for=""></label>
    </div>
    
    @can('agregar_producto')
    <div class="container-fluid">
      <a style="position: relative; left: 80%;" href="{{ route('productcreate')}}" class="btn btn-primary ">Nuevo Producto</a>  
    </div>
    @endcan

    <div class="container-fluid">
      <label for=""></label>
    </div>
    
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">CODIGO</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">PRESENTACION</th>
            <th scope="col">VENTA</th>
            <th scope="col">PRECIO</th>
            <th scope="col">UNIDADES DISPONIBLES</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            
            @foreach ($products as $product)
              <tr>
                <td>{{ $product->id}}</td>
                <td>{{ $product->codigo}}</td>
                <td>{{ $product->nombre}}</td>
                <td>{{ $product->presentacion}}</td>
                <td>{{ $product->tipo_de_venta}}</td>
                <td>{{ $product->precio}}</td>
                <td>{{ $product->existencias}}</td>
                <td>
                    <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                    <a href="{{ route('addproduct', $product->id) }}" class="btn btn-primary ">Agregar</a>                                    
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
      
      <div class="container-fluid">
        <label for=""></label>
      </div>
      <div class="container-fluid">
        <a href="{{ route('vercarrito')}}" class="btn btn-primary ">Ver Carrito</a>  
      </div>
      <div class="container-fluid">
        <label for=""></label>
      </div>
  </div>
  <script src="../../js/buscador.js" type="module"></script>
@endsection






 --}}






@extends('layouts.app')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
          <!-- Card stats -->
              
                <div style="background-color: white">
                  <div style="padding: 5%">
                    <div style="margin-top: 10px; padding-bottom: 10px;">
                      <h1>ALMACEN DE MEDICAMENTOS</h1>
                    </div>
                    <div class="container-fluid">
                      <form class="d-flex">
                        <input type="text" id="search" name="search" class="form-control me-2 light-table-filter" data-table="table" placeholder="BUSCAR MEDICAMENTOS">
                      </form>
                    </div>
                    <div>
                      <br>
                    </div>
                    @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                      <button button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> 
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <span class="alert-text"><strong>{{ session('error') }}</strong></span>
                      <button button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> 
                    @endif
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    
                    <div class="container-fluid" style=" justify-content: space-between; ">
                      @can('agregar_categoria')
                      <a href="{{ route('productcreate')}}"  class="btn btn-primary" >NUEVO <i class="fa fa-plus" aria-hidden="true"></i></a>     
                      @endcan
                     
                      <a href="{{ route('vercarrito')}}" class="btn btn-success " >DESCARGAR MEDICAMENTOS</a>  
                      @can('agregar_categoria')
                        <a href="{{ route('stock_index') }}" class="btn btn-default" >INGRESAR Y RETIRAR</a>    
                      @endcan
                      <a href="{{ route('almacenpdf')}}" class="btn btn-info" target="_blank" >ALMACEN PDF <i class="fa fa-file" aria-hidden="true"></i></a>
                      <a href="{{ route('excel_products')}}" class="btn btn-warning " >ALMACEN EXCEL <i class="fa fa-file" aria-hidden="true"></i></a>  
                      
                    </div>
                
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="user-table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color: white">COD.</th>
                            <th scope="col" style="color: white;">NOM.GENERICO</th>
                            <th scope="col" style="color: white ;">NOM.COMERCIAL</th>
                            <th scope="col" style="color: white;">CONCEN.</th>
                            <th scope="col" style="color: white">F.FARMA.</th>
                            <th scope="col" style="color: white">UNI.DISP.</th>
                            <th scope="col" style="color: white">LAB.</th>
                            <th scope="col" style="color: white">T.VENTA</th>
                            <th scope="col" style="color: white;">REFRI.</th>
                            <th scope="col" style="color: white;">PRECIO</th>
                            <th scope="col" style="color: white">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($products as $product)
                          <tr>
                            
                            <td td scope="col" style="text-align: rigth; width: 50px;font-size: 13px">{{ $product->codigo}}</td>
                            
                            <td td scope="col" style="text-align: rigth; width: 150px;font-size: 14px">{{ $product->nombre_generico}}</td>
                            <td td scope="col" style="text-align: rigth; width: 150px;font-size: 14px">{{ $product->nombre_comercial}}</td>
                            <td td scope="col" style="text-align: rigth; width: 15px;font-size: 14px">{{ $product->concentracion}}</td>
                            <td td scope="col" style="text-align: rigth; width: 15px;font-size: 14px">{{ $product->forma_farmaceutica}}</td>
                            <td td scope="col" style="text-align: rigth;color: blue; width: 15px;font-size: 14px">{{ $product->cantidad}} Uni.</td>
                                <td td scope="col" style="text-align: rigth; width: 15px;font-size: 12px">{{ $product->proveedor->nombre}}</td>
                            <td scope="col" style="text-align: rigth; width: 10px;font-size: 12px">{{ $product->tipo_de_venta}}</td>
                            <td scope="col" style="text-align: rigth; width: 10px;font-size: 12px">{{ $product->refrigerado}}</td>
                            <td scope="col" style="text-align: rigth; width: 10px;font-size: 14px">{{ $product->precio_venta}} Bs</td>
                            
                            <td>
                                <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                
                                @if ($product->estado == 'activo')
                                  @if ($product->cantidad > 0)
                                    <a td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" href="{{ route('addproduct', $product->id)}}"  class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>      
                                  @else
                                    <td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" button href="{{ route('addproduct', $product->id)}}" class="btn btn-primary " disabled="true"><i class="fa fa-download" aria-hidden="true"></i></button>
                                  @endif

                                  @can('agregar_categoria')
                                    <a td scope="col" style="text-align: center; width: 20px;font-size: 10px" href="{{ route('show_product',$product->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                  @endcan  
                                  
                                  @can('eliminar_producto')
                                  <a td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" href="{{ route('disableproduct', $product->id)}}" class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i></a> 
                                  @endcan
                                                                    
                                @else
                                    <button td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" href="{{ route('addproduct', $product->id)}}" class="btn btn-danger" disabled><i class="fa fa-download" aria-hidden="true"></i></button> 
                                  @can('eliminar_producto')
                                    <a td scope="col" style="text-align: rigth; width:50px;font-size: 12px" href="{{ route('activeproduct', $product->id)}}" class="btn btn-success" ><i class="fa fa-check" aria-hidden="true"></i></a> 
                                  @endcan                          
                                @endif

                                  
                                
                            </td>
                          </tr>
                        @endforeach
                             
                        </tbody>
                      </table>
                      <div class="container-fluid">
                        <label for=""></label>
                      </div>
                      
                      <div class="container-fluid">
                        <label for=""></label>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
      </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
  $(document).ready(function() {
      $('#search').on('keyup', function() {
          let query = $(this).val();

          $.ajax({
              url: "{{ route('search_product') }}",
              type: "GET",
              data: { query: query },
              success: function(response) {
                  var tbody = '';

                  response.forEach(function(data) {
                    console.log(response);
                      tbody += '<tr>';
                      
                      tbody += '<td>' + data.codigo + '</td>';
                      tbody += '<td>' + data.nombre_generico + '</td>';
                      tbody += '<td>' + data.nombre_comercial + '</td>';
                      tbody += '<td>' + data.concentracion + '</td>';
                      tbody += '<td>' + data.forma_farmaceutica + '</td>';
                      tbody += '<td>' + data.cantidad + "Uni.";'</td>';
                      tbody += '<td>' + data.laboratorio+ '</td>';
                      tbody += '<td>' + data.tipo_de_venta + '</td>';
                      tbody += '<td>' + data.refrigerado + '</td>';
                      tbody += '<td>' + data.precio_venta + "bs";'</td>';
                     
                      
                      // if (data.estado == 'activo') {
                      //   tbody += '<td style="color:dodgerblue;">' + data.estado + '</td>';  
                      // }else{
                      //   tbody += '<td style="color:red;">' + data.estado + '</td>';  
                      // }
                      
                      
                      
                      if(data.estado =='inactivo'){
                        tbody += '<td> <button style="color:white" data-id="' + data.id + '" id="descargar-button" class="btn btn-danger" disabled="true"><i class="fa fa-download" aria-hidden="true"></i></button>';
                          if (data.rol=="admin" || data.rol=="Jefe de Enfermeria"){
                            tbody += '<button style="color:white" data-id="' + data.id + '" id="disable-button" class="btn btn-danger" disabled="true"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
                          }
                      }else{
                        tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="descargar-button" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></a>'; 
                          if (data.rol=="admin" || data.rol=="Jefe de Enfermeria"){
                            tbody += ' <a style="color:white" data-id="' + data.id + '" id="edit-button" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>';
                            tbody += ' <a style="color:white" data-id="' + data.id + '" id="disable-button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                          }
                      }
                      
                      tbody += '</tr>';
                  });

                  $('#user-table tbody').html(tbody);
              }
          });
      });

      $(document).on('click', '#edit-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('show_product', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#descargar-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('addproduct', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#disable-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('disableproduct', ':id') }}".replace(':id', userId);
      });
  });
</script>


@endsection
