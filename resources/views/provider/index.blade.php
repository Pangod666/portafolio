
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
                      <h1>PROVEEDORES DE MEDICAMENTOS</h1>
                    </div>
                    <div class="container-fluid">
                      <form class="d-flex">
                        <input type="text" id="search" name="search" class="form-control me-2 light-table-filter" data-table="table" placeholder="BUSCAR LABORATORIO O PROVEEDOR">
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
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    
                    <div class="container-fluid">
                      <a href="{{ route('providerform')}}" class="btn btn-primary ">NUEVO <i class="fa fa-plus" aria-hidden="true"></i></a>  
                      @can('agregar_categoria')
                        <a href="{{ route('providerpdf')}}" target="_blank" class="btn btn-info "> PDF  <i class="fa fa-file" aria-hidden="true"></i></a>
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
                            <th scope="col" style="color:white">NIT</th>
                            <th scope="col" style="color:white">LABORATORIO</th>
                            <th scope="col" style="color:white">DIRECCION</th>
                            <th scope="col" style="color:white; ">RESPONSABLE</th>
                            <th scope="col" style="color:white">CELULAR</th>
                            <th scope="col" style="color:white">EMAIL</th>
                            <th scope="col" style="color:white">ESTADO</th>
                            <th scope="col" style="color:white">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($providers as $provider)
                              <tr>
                                <td td scope="col" style="text-align: rigth; width: 10px;font-size: 14px"> {{ $provider->id}}</td>
                                <td td scope="col" style="text-align: rigth; width: 50px;font-size: 14px">{{ $provider->nit}}</td>
                                <td td scope="col" style="text-align: rigth; width: 50px;font-size: 14px">{{ $provider->nombre}}</td>
                                <td td scope="col" style="text-align: rigth; width: 50px;font-size: 14px">{{ $provider->direccion}}</td>
                                <td td scope="col" style="text-align: rigth; width: 15px;font-size: 14px">{{ $provider->encargado}}</td>
                                <td td scope="col" style="text-align: rigth; width: 10px;font-size: 14px">{{ $provider->telefono}}</td>
                                <td td scope="col" style="text-align: rigth; width: 150px;font-size: 14px">{{ $provider->email}}</td>
                                @if ($provider->estado == 'inactivo')
                                  <td td scope="col" style="color: red ;text-align: rigth; width: 100px;font-size: 14px" >{{ $provider->estado}}</td>
                                @else
                                  <td td scope="col" style="text-align: rigth; width: 100px;font-size: 14px;color: blue" >{{ $provider->estado}}</td>
                                @endif
                                
                                <td>
                                  <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                  <a href="{{ route('providerview',$provider->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                                  <a href="{{ route('providershow',$provider->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                  
                                  @if ($provider->estado == 'inactivo')
                                    
                                    <a td scope="col" style="text-align: rigth; width: 50px;font-size: 14px" href="{{ route('provideractive',$provider->id) }}" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a>
                                  @else
                                    <a td scope="col" style="text-align: rigth; width: 50px;font-size: 14px" href="{{ route('providerdisable',$provider->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  @endif
                                                  
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
              url: "{{ route('searchprovider') }}",
              type: "GET",
              data: { query: query },
              success: function(response) {
                  var tbody = '';

                  response.forEach(function(data) {
                    console.log(response);
                      tbody += '<tr>';
                      tbody += '<td>' + data.id + '</td>';
                      tbody += '<td>' + data.nit + '</td>';
                      tbody += '<td>' + data.encargado + '</td>';
                      tbody += '<td>' + data.nombre + '</td>';
                      tbody += '<td>' + data.direccion + '</td>';
                      tbody += '<td>' + data.telefono + '</td>';
                      tbody += '<td>' + data.email + '</td>';
                      if (data.estado == 'inactivo') {
                        tbody += '<td style="color:red">' + data.estado + '</td>';
                      } else {
                        tbody += '<td style="color:green">' + data.estado + '</td>';
                      }
                      
                      tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="edit-button" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>';
                        if (data.estado == 'inactivo') {
                          tbody += '<a style="color:white" data-id="' + data.id + '" id="active-button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></a></td>';
                        } else {
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
                window.location.href = "{{ route('providershow', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#disable-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('providerdisable', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#active-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('provideractive', ':id') }}".replace(':id', userId);
      });
  });
</script>

@endsection


