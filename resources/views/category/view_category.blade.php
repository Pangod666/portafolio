@extends('layouts.app')
@section('content')


<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          
    <!-- Content here -->

    <div style="padding: 5%">
                <div style="margin-top: 10px; padding-bottom: 10px;">
                 <div>
                    <h1>{{$categoria->nombre}} </h1>
                 </div>
                    <h2>MEDICAMENTOS REGISTRADOS </h2>
                </div>
                <div>
                  <br>
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
                        <th scope="col" style="color: white">TIPO VENTA</th>
                        <th scope="col" style="color: white">PRECIO </th>
                        <th scope="col" style="color: white">CANTIDAD</th>
                        <th scope="col" style="color: white">ACCIONES</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($categoria->productos as $producto)
                          <tr>
                            <td  scope="col" style="text-align: rigth; width: 50px;font-size: 13px">{{ $producto->codigo}}</td>
                            <td scope="col" style="text-align: rigth; width: 150px;font-size: 13px" >{{ $producto->nombre_comercial}}</td>
                            <td  scope="col" style="text-align: rigth; width: 150px;font-size: 13px" >{{ $producto->nombre_generico}}</td>
                            <td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" >{{ $producto->concentracion}}</td>
                            <td scope="col" style="text-align: rigth; width: 100px;font-size: 12px" >{{ $producto->forma_farmaceutica}}</td>
                            <td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" >{{ $producto->Proveedor->nombre}}</td>
                            <td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" >{{ $producto->tipo_de_venta}}</td>
                            <td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" >{{ $producto->precio_venta}} Bs</td>
                            <td scope="col" style="text-align: rigth; width: 50px;font-size: 12px" >{{ $producto->cantidad}} Uni.</td>
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







@endsection







