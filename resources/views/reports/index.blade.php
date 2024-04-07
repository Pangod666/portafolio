
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
                      <h1>REPORTE DE MOVIMIENTOS </h1>
                    </div>

                  
                    
                    <div>
                      
                    <a href="{{ route('movings_pdf')}}" target="_blank" class="btn btn-info  ">Movimientos PDF <i class="fa fa-file" aria-hidden="true"></i></a>  
              
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
                            <th scope="col" style="color:white">USUARIO</th>
                            <th scope="col" style="color:white">NOMBRE GENERICO</th>
                            <th scope="col" style="color:white">NOMBRE COMERCIAL</th>
                            <th scope="col" style="color:white">LAB.</th>
                            <th scope="col" style="color:white">CANTIDAD</th>
                            <th scope="col" style="color:white">ACCIÓN</th>
                            <th scope="col" style="color:white">FECHA</th>
                          </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($movings as $moving)
                              <tr>
                                <td>{{ $moving->usuario->person->nombre ." ". $moving->usuario->person->ap_paterno." ". $moving->usuario->person->ap_materno }}</td>
                                <td>{{ $moving->producto->nombre_generico }}</td>
                                <td>{{ $moving->producto->nombre_comercial }}</td>
                                <td>{{ $moving->producto->Proveedor->nombre }}</td>
                                <td>{{ $moving->quantity }}</td>
                                @if ($moving->moving == 'Incremento')
                                    <td style="color: green">{{ $moving->moving }}</td>    
                                @else
                                    <td style="color: red">{{ $moving->moving }}</td>  
                                @endif
                                <td>{{ $moving->fecha }}</td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <center>{{ $movings->links() }}</center>
                    </div>
                    
                  </div>
                </div>
              </div>
      </div>
  </div>
</div>

@endsection
