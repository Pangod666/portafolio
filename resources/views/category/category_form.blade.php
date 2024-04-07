{{-- @extends('dashboard')
@section('content')
<div class="container">
    <div class="content">
        <h1>Crear Categoria</h1>
      <form method="POST" action="{{ route('store_category') }}" >
        {{ csrf_field() }}
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nombre</span>
            <input type="text" name="nombre" placeholder="Ingrese el nombre de la categoria" required>
          </div>
          <div class="input-box">
            <span class="details">Descripcion</span>
            <textarea name="descripcion" rows="4" cols="20" class="form-control" placeholder="Breve Descripcion"></textarea>
          </div>
        <div class="button">
          <input type="submit" value="Registrar">
        </div>
      </form>
    </div>
  </div>
@endsection --}}


@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white; border-radius: 10px">
          <div style="padding: 2%">
            <div>
              <h1>REGISTRAR GRUPO DE MEDICAMENTO</h1>
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
                  <form method="POST" action="{{ route('store_category') }}" >
                    {{ csrf_field() }}
                   
                    <div class="form-group">
                    <label for="categoria">NOMBRE:<span style="color: red">*</span></label>
                                    <select name="nombre" class="form-control" required>
                                      <option value=""  selected >INGRESE EL GRUPO DE MEDICAMENTO </option>
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


                                     
                                    </select>
                                  </div>







                    <div class="form-group">
                      <label for="nombre">DESCRIPCION:</label>
                      <textarea name="descripcion" rows="4" cols="20" class="form-control" placeholder="BREBE DESCRIPCION"></textarea>
                    </div>
                    <div class="button">
                      <button type="submit" class="btn btn-success"> GUARDAR <i class="fa fa-file" aria-hidden="true"></i></button>
                      <a href="{{ route('index_category') }}" class="btn btn-danger">CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i></a>
                    </div>
                    
                    <!-- Agrega más campos aquí -->
                  
                </div>
                
              </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection



