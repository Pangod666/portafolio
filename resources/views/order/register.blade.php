@extends('layouts.app')
@section('content')
<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
                <div style="background-color: white">
                  <div style="padding: 5%">
                    <div class="container">
                      <!-- Content here -->
                      <div style="margin-top: 10px; padding-bottom: 10px;">
                      <h1>SELECCIONE AL PACIENTE PARA EL DESCARGO  </h1>
                    </div>
                      <div class="container-fluid">
                        <form class="d-flex">
                          <input type="text" id="search" ci="search"  name="search" class="form-control me-2 light-table-filter" data-table="table" placeholder="Buscar Paciente por C.I o por Nombre">
                        </form>
                      </div>
                     
                      <div class="container-fluid">
                        <label for=""></label>
                      </div>
                      <a href="{{ route('productlist') }}" class="btn btn-primary">AGREGAR MAS PRODUCTOS</a>
                       
                          <a href="{{ route('vercarrito') }}" class="btn btn-danger ">VACIAR</a>
          
                      <div class="container-fluid">
                        <label for=""></label>
                      </div>
                      
                      <table class="table" id="user-table">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col"style="color: white">H.C.</th>
                              <th scope="col"style="color: white">CARNET</th>
                              <th scope="col" style="color: white">NOMBRE</th>
                              <th scope="col" style="color: white">APELLIDO PATERNO</th>
                              <th scope="col" style="color: white">APELLIDO MATERNO</th>
                              
                              <th scope="col" style="color: white">ESTADO</th>
                              <th scope="col" style="color: white">ACCION</th>
                            </tr>
                          </thead>
                          <tbody>
                              
                              @foreach ($pacientes as $paciente)
                                @if ($paciente->estado == 'INTERNADO')
                                <tr>
                                  <td>{{ $paciente->id }}</td>
                                  <td>{{ $paciente->person->ci }}</td>
                                  <td>{{ $paciente->person->nombre }}</td>
                                  <td>{{ $paciente->person->ap_paterno }}</td>
                                  <td>{{ $paciente->person->ap_materno }}</td>
                                  
                                  <td style="color:blue">{{ $paciente->estado}}</td>
                                  <td>
                                      <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                                      <a href="{{ route('descargar',$paciente->id) }}"  class="btn btn-success">DESCARGAR</a>
                                  </td>
                                </tr>  
                                @else
                                 
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            let query = $(this).val();
  
            $.ajax({
                url: "{{ route('search_patient_download') }}",
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
                        
                        if (data.estado=='INTERNADO') {
                          tbody += '<td style="color:blue">' + data.estado + '</td>';
                          tbody += '<td> <a style="color:white" data-id="' + data.id + '" id="download-button" class="btn btn-success">Descargar</a>';
                        }else{
                          tbody += '<td td style="color:red">' + data.estado + '</td>';
                          tbody += '<td><button style="color:white" data-id="' + data.id + '" id="internar-button" disabled=true  class="btn btn-danger">Descargar</button></td>';
                        }                      
                        tbody+='</td>'
                        tbody += '</tr>';
                    });
  
                    $('#user-table tbody').html(tbody);
                }
            });
        });
  
        
  
        $(document).on('click', '#download-button', function() {
                  var userId = $(this).data('id');
                  window.location.href = "{{ route('descargar', ':id') }}".replace(':id', userId);
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