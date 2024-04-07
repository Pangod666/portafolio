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
                      <h1> USUARIOS REGISTRADOS</h1>
                    </div>
                    <div class="container-fluid">
                      <form class="d-flex">
                        <input type="text" id="search" ci="search"  name="search" class="form-control me-2 light-table-filter" data-table="table" placeholder=" BUSCAR USUSARIO POR C.I. Y POR NOMBRE " >
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
                    
                    <div class="container-fluid" style="justify-content: space-between;">
                      <a href="{{ route('createuser')}}" class="btn btn-primary "> NUEVO <i class="fa fa-plus" aria-hidden="true"></i></a>  
                      @can('reports' )
                        <a style="text-align:center;" href="{{ route('userspdf') }}" class="btn btn-info  " target="_blank"> PDF <i class="fa fa-file" aria-hidden="true"></i></a>  
                      @endcan
                    </div>
                    
                    
                
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="user-table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color:white">C.I.</th>
                            <th scope="col" style="color:white">Nombre</th>
                            <th scope="col" style="color:white">Apellido Paterno</th>
                            <th scope="col" style="color:white">Apellido Materno</th>
                            <th scope="col" style="color:white">Cargo</th>
                            <th scope="col" style="color:white">Correo</th>
                            <th scope="col" style="color:white">Estado</th>
                            <th scope="col" style="color:white">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                             @foreach ($users_roles as $user_role)
                              @if ($user_role->user->estado == 'activo')
                              <tr>
                                <td>{{ strtoupper($user_role->user->person->ci) }}</td>
                                <td>{{ strtoupper ($user_role->user->person->nombre) }}</td>
                                <td>{{ strtoupper ($user_role->user->person->ap_paterno )}}</td>
                                <td>{{ strtoupper ($user_role->user->person->ap_materno )}}</td>
                                <td>{{ strtoupper ($user_role->role->name)}}</td>
                                <td>{{ $user_role->user->person->correo}}</td>
                                <td style="color: dodgerblue">{{ strtoupper ($user_role->user->estado)}}</td>
                                <td>
                                    <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                    <a style="text-align:left; font-size: 12px"  href="{{ route('usershow', $user_role->user->id)}}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                    <a style="text-align:left; font-size: 12px"  href="{{ route('userdisable', $user_role->user->id)}}" class="btn btn-danger "><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                              </tr>  
                              @else
                              <tr>
                                <td>{{ strtoupper ($user_role->user->person->ci )}}</td>
                                <td>{{ strtoupper ($user_role->user->person->nombre) }}</td>
                                <td>{{strtoupper ( $user_role->user->person->ap_paterno )}}</td>
                                <td>{{ strtoupper ($user_role->user->person->ap_materno )}}</td>
                                <td>{{  strtoupper ($user_role->role->name)}}</td>
                                <td>{{   $user_role->user->person->correo}}</td>
                                <td style="color: red">{{   strtoupper ($user_role->user->estado)}}</td>
                                <td>
                                    <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                    <a style="text-align:left; font-size: 12px"  href="{{ route('usershow', $user_role->user->id)}}"class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                    <a style="text-align:left; font-size: 12px"  href="{{ route('userenable', $user_role->user->id)}}" class="btn btn-success "> <i class="fa fa-check" aria-hidden="true"></i></a>
                                </td>
                              </tr> 
                              @endif
                              
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
              url: "{{ route('searchuser') }}",
              type: "GET",
              data: { query: query },
              success: function(response) {
                  var tbody = '';

                  response.forEach(function(data) {
                    console.log(response);
                      tbody += '<tr>';
                      tbody += '<td>' + data.ci + '</td>';
                      tbody += '<td>' + data.nombre + '</td>';
                      tbody += '<td>' + data.paterno + '</td>';
                      tbody += '<td>' + data.materno + '</td>';
                      tbody += '<td>' + data.cargo + '</td>';
                      tbody += '<td>' + data.correo + '</td>';
                       if (data.estado == 'activo') {
                         tbody += '<td style="color:dodgerblue;">' + data.estado + '</td>';  
                         tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="edit-button" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>';
                         tbody += '<a style="color:white" data-id="' + data.id + '" id="disable-button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></td>';
                         tbody += '</tr>';
                       }else{
                         tbody += '<td style="color:red;">' + data.estado + '</td>';  
                         tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="edit-button" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>';
                         tbody += '<a style="color:white" data-id="' + data.id + '" id="enabled-button" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i</a></td>';
                         tbody += '</tr>';
                       }
                      
                       
                  });

                  $('#user-table tbody').html(tbody);
              }
          });
      });

      $(document).on('click', '#edit-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('usershow', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#disable-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('userdisable', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#enabled-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('userenable', ':id') }}".replace(':id', userId);
      });
  });
</script>


@endsection
