@extends('layouts.app')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
          <!-- Card stats -->
          <!-- ingresar y retirar medicamentos-->
              
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
                
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="user-table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color: white">CODIGO</th>
                            <th scope="col" style="color: white">NOM. GENERICO</th>
                            <th scope="col" style="color: white">NOM. COMERCIAL</th>
                            <th scope="col" style="color: white">CONCEN.</th>
                            <th scope="col" style="color: white">F.FARMACEUTICA</th>
                            <th scope="col" style="color: white">LAB.</th>
                            <th scope="col" style="color: white">TIPO DE VENTA</th>
                            <th scope="col" style="color: white">UNI. DISP.</th>
                            <th scope="col" style="color: white">REFRI.</th>
                            <th scope="col" style="color: white">PRECIO</th>
                            
                            <th scope="col" style="color: white">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($products as $product)
                          <tr>
                            
                            <td>{{ $product->codigo}}</td>
                           
                            <td>{{ $product->nombre_generico}}</td>
                            <td>{{ $product->nombre_comercial}}</td>
                            <td>{{ $product->concentracion}}</td>
                            <td>{{ $product->forma_farmaceutica}}</td>
                            <td>{{ $product->proveedor->nombre}}</td>
                            <td>{{ $product->tipo_de_venta}}</td>
                            <td>{{ $product->cantidad}}Uni.</td>
                            <td>{{ $product->refrigerado}}</td>
                            <td>{{ $product->precio_venta}} Bs</td>
                            
                            <td>
                                <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                    <a href="{{ route('add_product_stock',$product->id) }}" class="btn btn-success ">Ingresar</a>      
                                    <a href="{{ route('remove_product_stock',$product->id) }}" class="btn btn-danger ">Retirar</a>  
                                                                 
                                
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
                      tbody += '<td>' + data.laboratorio + '</td>';
                      tbody += '<td>' + data.tipo_de_venta + '</td>';
                      tbody += '<td>' + data.cantidad + "Uni.";'</td>';
                      tbody += '<td>' + data.refrigerado +'</td>';
                      tbody += '<td>' + data.precio_venta + "bs";'</td>';
                      
                      
                      // if (data.estado == 'activo') {
                      //   tbody += '<td style="color:dodgerblue;">' + data.estado + '</td>';  
                      // }else{
                      //   tbody += '<td style="color:red;">' + data.estado + '</td>';  
                      // }
                      
                      
                      
                      if(data.estado =='inactivo'){
                        tbody += '<td> <button style="color:white" data-id="' + data.id + '" id="descargar-button" class="btn btn-success" disabled="true">Ingresar</button>';
                          if (data.rol=="admin" || data.rol=="Jefe de Enfermeria"){
                            tbody += '<button style="color:white" data-id="' + data.id + '" id="disable-button" class="btn btn-danger" disabled="true">Retirar</button></td>';
                          }
                      }else{
                        tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="descargar-button" class="btn btn-success">Ingresar</a>'; 
                          if (data.rol=="admin" || data.rol=="Jefe de Enfermeria"){
                            tbody += ' <a style="color:white" data-id="' + data.id + '" id="disable-button" class="btn btn-danger">Retirar</a></td>';
                          }
                      }
                      
                      tbody += '</tr>';
                  });

                  $('#user-table tbody').html(tbody);
              }
          });
      });

       $(document).on('click', '#descargar-button', function() {
                 var userId = $(this).data('id');
                 window.location.href = "{{ route('add_product_stock', ':id') }}".replace(':id', userId);
       });

       $(document).on('click', '#disable-button', function() {
                 var userId = $(this).data('id');
                 window.location.href = "{{ route('remove_product_stock', ':id') }}".replace(':id', userId);
       });
  });
</script>


@endsection
