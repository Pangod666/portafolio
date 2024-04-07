@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          <div style="padding: 2%">
            <div>
              <h1>EDITAR GRUPO </h1>
            </div>
            <div class="container">
              @if (session('mensaje'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              @endif
              <div class="row">
                <div class="col-md-12">
                  <form method="POST">
                    {{ csrf_field() }}

                    <!-- <div class="form-group">
                      <label for="nit">Nombre:</label>
                      <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
                    </div> -->
                    <div class="form-group">
                                    <label for="nombre">NOMBRE:<span style="color: red">*</span></label>
                                    <select  name="nombre" class="form-control"  required>
                                      <option value="{{ $categoria->nombre }}"  selected >{{ $categoria->nombre }} </option>
                                      <option value="AMINOGLUCOSIDOS">AMINOGLUCOSIDOS</option>
                                      <option value="ANALGESICOS">ANALGESICOS</option>
                                      <option value="ANALGESICOS NARCOTICOS">ANALGESICOS NARCOTICOS</option>
                                      <option value="ANTIGONISTAS BENZEODIAZEPINA<" >ANTIGONISTAS BENZEODIAZEPINA</option>
                                      <option value="ANTIACIDOS" >ANTIACIDOS</option>
                                      <option  value="ANTIANGINOSOS">ANTIANGINOSOS</option>
                                      <option value="ANTIEPILEPTICOS">ANTIEPILEPTICOS</option>
                                      <option value="ANTIESPASMODICOS">ANTIESPASMODICOS</option>
                                      <option value="ANTIHEMORRAIGCOS">ANTIHEMORRAIGCOS</option>
                                      <option value="ANTIHISTAMINICOS">ANTIHISTAMINICOS</option>
                                      <option value="ANTIHIPERTENSIVOS">ANTIHIPERTENSIVOS</option>
                                      <option value="ANTIINFLAMATORIOSS">ANTIINFLAMATORIOSS</option>
                                      <option value="ANTISEPTICOS">ANTISEPTICOS</option>
                                      <option value="ANTITROMBOTICOS">ANTITROMBOTICOS</option>
                                      <option value="BETALACTAMICOS">BETALACTAMICOS</option>
                                      <option value="CEFALOSPORINAS">CEFALOSPORINAS</option>
                                      <option value="CLORANFENICOLES">CLORANFENICOLES</option>
                                      <option value="CORTICOIDES">CORTICOIDES</option>
                                      <option value="DIURETICOS">DIURETICOS</option>
                                      <option value="ELECTROTERAPIAS">ELECTROTERAPIAS</option>
                                      <option value="EMOLIENTES">EMOLIENTES</option>
                                      <option value="EXPECTORANTES">EXPECTORANTES</option>
                                      <option value="GLUCOPEPTIDOS">GLUCOPEPTIDOS</option>
                                      <option value="INSUMOS ACCECORIOS">INSUMOS ACCECORIOS</option>
                                      <option value="INSUMOS BISTURIS">INSUMOS BISTURIS</option>
                                      <option  value="INSUMOS BOLSAS">INSUMOS BOLSAS</option>
                                      <option value="INSUMOS BISTURIS">INSUMOS BISTURIS</option>
                                      <option value="INSUMOS EQUIPOS">INSUMOS EQUIPOS</option>
                                      <option value="INSUMOS GUANTES">INSUMOS GUANTES</option>
                                      <option value="INSUMOS JERINGAS">INSUMOS JERINGAS</option>
                                      <option value="INSUMOS SONDAS">INSUMOS SONDAS</option>
                                      <option value="INSUMOS SUTURAS">INSUMOS SUTURAS</option>
                                      <option value="INSUMOS TELA ADHESIVAS">INSUMOS TELA ADHESIVAS</option>
                                      <option value="INSUMOS VENDAS">INSUMOS VENDAS</option>
                                      <option value="INSUMOS TUBOS">INSUMOS TUBOS</option>
                                      <option value="LAXANTES">LAXANTES</option>
                                      <option value="MACROLIDOS">MACROLIDOS</option>
                                      <option value="EMETRONIDAZOLES">METRONIDAZOLES</option>
                                      <option value="MISCELANEOS">MISCELANEOS</option>
                                      <option value="MULTIVITAMINAS">MULTIVITAMINAS</option>
                                      <option value="PSICONALEPTICOS">PSICONALEPTICOS</option>
                                      <option value="QUEMADURAS">QUEMADURAS</option>
                                      <option value="QUINOLONAS">QUINOLONAS</option>
                                      <option value="SOLUCIONES PARENTERALES ">SOLUCIONES PARENTERALES </option>
                                      <option value="SUPLEMENTOS NUTICIONALES">SUPLEMENTOS NUTICIONALES</option>
                                      <option value="TERAPIA CARDIACAS">TERAPIA CARDIACAS</option>
                                     
                                  </div>

                    





                    <div class="form-group">
                      <label for="nombre">Descripción:</label>
                      <textarea name="descripcion" rows="4" cols="20" class="form-control">{{ $categoria->descripcion }}</textarea>
                    </div>
                    <div class="button">
                      <button type="submit" class="btn btn-success"> Guardar <i class="fa fa-file" aria-hidden="true"></i></button>
                      <a href="{{ route('index_category') }}" class="btn btn-danger">Cancelar <i class="fa fa-window-close" aria-hidden="true"></i></a>
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
                </div>
                
              </div>
              </form>
              </div>

              <!-- <div style="padding: 5%">
                <div style="margin-top: 10px; padding-bottom: 10px;">
                  <h1>MEDICAMENTOS REGISTRADOS </h1>
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
                               aca botones con opciones eliminar, permisos, editar, visualizar 
                              <a href="{{ route('show_product',$producto->id) }}" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
                              <a href="{{ route('providerdisable',$producto->id) }}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>                    
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection


