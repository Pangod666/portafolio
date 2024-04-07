@extends('layouts.app')
@section('content')
<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          
    <!-- Content here -->
    <div style="padding: 5%">
                <div style="margin-top: 10px; padding-bottom: 10px;">
                  <h1>PACIENTES REGISTRADOS EN {{ strtoupper($especialidad->nombre) }}</h1>
                </div>
                <div style="margin-top: 10px; padding-bottom: 10px;">
                  <h4>Pacientes: {{ $especialidad->pacientes()->count()}}</h4>
                </div>
                <div>
                  <br>
                </div>
                <div class="table-responsive">
                  <table class="table" id="user-table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col" style="color: white">H.C.</th>
                          <th scope="col" style="color: white">Carnet</th>
                          <th scope="col" style="color: white">Apellido Paterno</th>
                          <th scope="col" style="color: white">Apellido Materno</th>
                          <th scope="col" style="color: white">Nombre</th>
                          <th scope="col" style="color: white">Especialidad</th>
                          <th scope="col" style="color: white">Estado</th>
                          <th scope="col" style="color: white">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                      @foreach ($especialidad->pacientes as $paciente)
                      @if ($paciente->estado == 'INTERNADO')
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
                            <a href="{{ route('patientshow',$paciente->id) }}" class="btn btn-primary ">Historia</a>
                           
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
@endsection