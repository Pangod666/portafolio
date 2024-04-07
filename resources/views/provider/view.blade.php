@extends('layouts.app')
@section('content')
<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          
            
            
            
              <div style="padding: 5%">
                <div style="margin-top: 10px; padding-bottom: 10px;">
                  <h1>MEDICAMENTOS DISTRIBUIDOS POR {{$provider->nombre}} </h1>
                </div>
                <div>
                  <br>
                </div>
                <div class="table-responsive">
                  <table class="table" id="user-table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col" style="color: white">CODIGO</th>
                        <th scope="col" style="color: white">NOM. COMERCIAL</th>
                        <th scope="col" style="color: white">NOM. GENERICO</th>
                        <th scope="col" style="color: white">CONCEN.</th>
                        <th scope="col" style="color: white">F. FARMACEUTICA</th>
                        <th scope="col" style="color: white">TIPO VENTA</th>
                        <th scope="col" style="color: white">PRECIO </th>
                        <th scope="col" style="color: white">CANTIDAD</th>
                        <th scope="col" style="color: white">ACCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($provider->productos as $producto)
                          <tr>
                            <td>{{ $producto->codigo}}</td>
                            <td>{{ $producto->nombre_comercial}}</td>
                            <td>{{ $producto->nombre_generico}}</td>
                            <td>{{ $producto->concentracion}}</td>
                            <td>{{ $producto->forma_farmaceutica}}</td>
                            <td>{{ $producto->tipo_de_venta}}</td>
                            <td>{{ $producto->precio_venta}} Bs</td>
                            <td>{{ $producto->cantidad}}</td>
                            <td>
                              <!-- aca botones con opciones eliminar, permisos, editar, visualizar -->
                              <a href="{{ route('show_product',$producto->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                              <a href="{{ route('providerdisable',$producto->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>                    
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
</div>
@endsection