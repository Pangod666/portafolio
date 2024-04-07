
{{-- @extends('dashboard')
@section('content')
<div class="container">
    <!-- Content here -->
  
    <div class="container-fluid">
      <form class="d-flex">
        <input type="text" class="form-control me-2 light-table-filter" data-table="table" placeholder="Buscar Paciente">
      </form>
    </div>
    
    <div class="container-fluid">
      <label for=""></label>
    </div>
    
    <div class="container-fluid">
      <a href="{{ route('patientregister')}}" class="btn btn-primary ">REGISTRAR PACIENTE</a>  
    </div>
    
    <div class="container-fluid">
      <label for=""></label>
    </div>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">H.C.</th>
            <th scope="col">Carnet</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Nombre</th>
            <th scope="col">Especialidad</th>
            <th scope="col">Estado</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            
            @foreach ($pacientes as $paciente)
              @if ($paciente->estado == 'Interno')
              <tr>
                <td>{{ $paciente->id }}</td>
                <td>{{ $paciente->person->ci }}</td>
                <td>{{ $paciente->person->ap_paterno }}</td>
                <td>{{ $paciente->person->ap_materno }}</td>
                <td>{{ $paciente->person->nombre }}</td>
                <td>{{ $paciente->especialidad->nombre }}</td>
                <td>{{ $paciente->estado}}</td>
                <td>
                    <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                    <a href="#" class="btn btn-primary ">Historia</a>
                    <a href="#" class="btn btn-warning ">Descargo</a>
                </td>
              </tr>  
              @else
                
              @endif
              
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
                      <h1>PACIENTES REGISTRADOS </h1>
                    </div>
                    <div class="container-fluid">
                      <form class="d-flex">
                        <input type="text" id="search" ci="search" name="search" class="form-control me-2 light-table-filter" data-table="table" placeholder="BUSCAR PACIENTE POR C.I. Y POR NOMBRE  ">
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
                      <a href="{{ route('patientregister')}}" class="btn btn-primary ">NUEVO <i class="fa fa-plus" aria-hidden="true"></i></a>
                      <a href="{{ route('pdf_all')}}" target="_blank" class="btn btn-info">PDF  <i class="fa fa-file" aria-hidden="true"></i></a>  
                    </div>
                
                    <div class="container-fluid">
                      <label for=""></label>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="user-table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color: white">H.C.</th>
                            <th scope="col" style="color: white">C.I</th>
                            <th scope="col" style="color: white">Nombres</th>
                            <th scope="col" style="color: white">Apellido Paterno</th>
                            <th scope="col" style="color: white">Apellido Materno</th>
                           
                            <th scope="col" style="color: white">Especialidad</th>
                            <th scope="col" style="color: white">Estado</th>
                            <th scope="col" style="color: white">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                          @foreach ($pacientes as $paciente)
                          
                          <tr>
                            <td>{{  $paciente->id }}</td>
                            <td>{{ $paciente->person->ci }}</td>
                            <td>{{ strtoupper($paciente->person->nombre) }}</td>
                            <td>{{ strtoupper($paciente->person->ap_paterno) }}</td>
                            <td>{{ strtoupper($paciente->person->ap_materno )}}</td>
                          
                            <td>{{  strtoupper($paciente->especialidad->nombre) }}</td>
                            @if ($paciente->estado=='INTERNADO')
                              <td style="color: blue" >{{ $paciente->estado}}</td> 
                            @else
                              <td style="color: red" >{{ $paciente->estado}}</td> 
                            @endif
                            
                            <td>
                                <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                <a href="{{ route('patientshow',$paciente->id) }}" class="btn btn-success"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{ route('patientpdf',$paciente->id) }}" target="_blank" class="btn btn-info"> PDF</a>
                                @if ($paciente->estado == 'NO INTERNADO')
                                  <a href="{{ route('reinternar',$paciente->id) }}" class="btn btn-success" target="_blank" > INTERNAR</a>
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
              url: "{{ route('search_patient') }}",
              type: "GET",
              data: { query: query },
              success: function(response) {
                  var tbody = '';

                  response.forEach(function(data) {
                    console.log(response);
                      tbody += '<tr>';
                      tbody += '<td>' + data.id + '</td>';
                      tbody += '<td>' + data.ci + '</td>';
                      tbody += '<td>' + data.nombre + '</td>';
                      tbody += '<td>' + data.paterno + '</td>';
                      tbody += '<td>' + data.materno + '</td>';
                      
                      tbody += '<td>' + 	 data.especialidad + '</td>';
                      if (data.estado=='INTERNADO') {
                        tbody += '<td style="color:blue">' + data.estado + '</td>';
                      }else{
                        tbody += '<td style="color: red">' + data.estado + '</td>';
                      }                      
                      tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="edit-button" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                      tbody += '<a style="color:white" data-id="' + data.id + '" id="disable-button" id="my-link"  class="btn btn-info" >PDF <i class="fa fa-file" aria-hidden="true"></i></a>';
                      if (data.estado!='INTERNADO') {
                        tbody += '<a style="color:white" data-id="' + data.id + '" id="internar-button"  class="btn btn-success">Internar</a></td>';
                      }else
                      tbody+='</td>'
                      tbody += '</tr>';
                  });

                  $('#user-table tbody').html(tbody);
              }
          });
      });

      

      $(document).on('click', '#edit-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('patientshow', ':id') }}".replace(':id', userId);
      });

      $(document).on('click', '#disable-button', function() {
                var userId = $(this).data('id');
                // window.location.href = "{{ route('patientpdf', ':id') }}".replace(':id', userId);
                window.open("{{ route('patientpdf', ':id') }}".replace(':id', userId), '_blank');
      });

      $(document).on('click', '#internar-button', function() {
                var userId = $(this).data('id');
                window.location.href = "{{ route('reinternar', ':id') }}".replace(':id', userId);
      });
  });
</script>


@endsection
