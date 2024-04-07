{{-- @extends('dashboard')
@section('content')
<div class="container">
    <!-- Content here -->

    <div class="container-fluid">
      <form class="d-flex">
        <input type="text" class="form-control me-2 light-table-filter" data-table="table" placeholder="Buscar Categoria">
      </form>
    </div>
    
    <div class="container-fluid">
      <label for=""></label>
    </div>
    
    @can('agregar_categoria')
    <div class="container-fluid">
      <a href="{{ route('create_category')}}" class="btn btn-primary ">NUEVO GRUPO</a>  
    </div>
    @endcan

    <div class="container-fluid">
      <label for=""></label>
    </div>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Productos Registrados</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            
            @foreach ($categorias as $categoria)
              <tr>
                <td>{{ $categoria->id}}</td>
                <td>{{ $categoria->nombre}}</td>
                <td>{{ $categoria->descripcion}}</td>
                <td>{{ $categoria->cantidad}}</td>
                <td>
                    <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                    <a href="#" class="btn btn-primary ">Visualizar</a>
                    <a href="#" class="btn btn-warning ">Editar</a>
                    @can('eliminar_categoria')
                    <a href="{{ route('categorydelete', $categoria->id) }}" class="btn btn-danger">Eliminar</a>                    
                    @endcan
                </td>
              </tr>
            @endforeach
        </tbody>
      </table>
  </div>
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
                      <h1>GRUPO DE MEDICAMENTOS REGISTRADOS </h1>
                    </div>
                    <div class="container-fluid">
                      <form class="d-flex">
                        <input type="text" id="search" name="search" class="form-control me-2 light-table-filter" data-table="table" placeholder="BUSCAR EL GRUPO DE MEDICAMENTO">
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
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      </div> 
                    @endif
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    
                    <div class="container-fluid">
                      <a href="{{ route('create_category')}}" class="btn btn-primary ">NUEVO <i class="fa fa-plus" aria-hidden="true"></i></a>  
                      @can('agregar_categoria')
                      <a href="{{ route('category_pdf')}}" target="_blank" class="btn btn-info ">PDF  <i class="fa fa-file" aria-hidden="true"></i></a> 
                      @endcan
                    </div>
                
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="user-table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color:white">ID</th>
                            <th scope="col" style="color:white">NOMBRE</th>
                            <th scope="col" style="color:white">DESCRIPCION</th>
                            <th scope="col" style="color:white">PRODUCTOS</th>
                            <th scope="col" style="color:white">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($categorias as $categoria)
                          <tr>
                            <td>{{ $categoria->id}}</td>
                            <td>{{strtoupper( $categoria->nombre)}}</td>
                            <td>{{ $categoria->descripcion}}</td>
                            <td>{{ $categoria->cantidad}}</td>
                            <td>
                                <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                <a href="{{ route('show_category',$categoria->id) }}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                @can('editar_categoria')
                                <a href="{{ route('edit_category',$categoria->id) }}" class="btn btn-warning"><i class="fa fa-magic" aria-hidden="true"></i></a>
                                @endcan
                                @can('eliminar_categoria')
                                <a href="{{ route('categorydelete', $categoria->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>                    
                                @endcan
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
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
              url: "{{ route('search_category') }}",
              type: "GET",
              data: { query: query },
              success: function(response) {
                  var tbody = '';

                  response.forEach(function(data) {
                    console.log(response);
                      tbody += '<tr>';
                      tbody += '<td>' + data.id + '</td>';
                      tbody += '<td>' + data.nombre + '</td>';
                      tbody += '<td>' + data.descripcion + '</td>';
                      tbody += '<td>' + data.cantidad + '</td>';
                       if (data.rol=="admin" || data.rol=="Jefe de Enfermeria") {
                        
                        tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="edit-button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                        tbody += '<a style="color:white" data-id="' + data.id + '" id="disable-button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>';
                       }
                      
                      tbody += '</tr>';
                  });

                  $('#user-table tbody').html(tbody);
              }
          });
      });

      $(document).on('click', '#edit-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('show_category', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#disable-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('categorydelete', ':id') }}".replace(':id', userId);
      });
  });
</script>

@endsection
