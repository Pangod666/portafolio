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
                      <h1>DESCARGOS REGISTRADOS </h1>
                    </div>
                    <div class="container-fluid">
                      <form class="d-flex">
                        <input type="text" id="search" ci="search"  name="search" class="form-control me-2 light-table-filter" data-table="table" placeholder=" BUSCAR POR NUMERO DE ORDEN O FECHA">
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
                      <label for=""></label>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="user-table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color: white">ID</th>
                            
                            <th scope="col" style="color: white">USUARIO</th>
                         
                            <th scope="col" style="color: white">PACIENTE</th>
                            <th scope="col" style="color: white">FECHA</th>
                            <th scope="col" style="color: white">ACCION</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($orders as $order)
                          <tr>
                            <td>{{ $order->id}}</td>
                           
                            <td>{{ $order->usuario->person->nombre ." ". $order->usuario->person-> ap_paterno." ".$order->usuario->person-> ap_materno}}</td>
                          
                            <td>{{ $order->paciente->person->nombre." ".$order->paciente->person-> ap_paterno." ".$order->paciente->person-> ap_materno}}</td>
                            <td>{{ $order->fecha}}</td>
                            <td>
                                <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                <a href="{{ route('ordenpdf', $order) }}" class=" btn btn-success " target="_blank">  <i class="fa fa-eye" aria-hidden="true"></i> PDF </a>                                  
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
              url: "{{ route('search_descargo') }}",
              type: "GET",
              data: { query: query },
              success: function(response) {
                  var tbody = '';

                  response.forEach(function(data) {
                    console.log(response);
                      tbody += '<tr>';
                      tbody += '<td>' + data.id + '</td>';
                      tbody += '<td>' + data.usuario + '</td>';
              
                      tbody += '<td>' + data.hc +'</td>';
                      tbody += '<td>' + data.fecha + '</td>';
                      tbody += '<td><a style="color:white" data-id="' + data.id + '" id="visualizar-button" class="btn btn-primary">Visualizar</a></td>';
                      tbody += '</tr>';
                  });

                  $('#user-table tbody').html(tbody);
              }
          });
      });

      $(document).on('click', '#visualizar-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('ordenpdf', ':id') }}".replace(':id', userId);
      });

  });
</script>


@endsection
