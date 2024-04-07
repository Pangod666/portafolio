@extends('layouts.app')

@section('content')
<head>
    <style>
        td.active {
  background-color: #2c6ed5;
}

input[type="date" i] {
  padding: 14px;
}

.table-condensed td, .table-condensed th {
  font-size: 14px;
  font-family: "Roboto", "Arial", "Helvetica Neue", sans-serif;
  font-weight: 400;
}

.daterangepicker td {
  width: 40px;
  height: 30px;
}

.daterangepicker {
  border: none;
  -webkit-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 8px 20px 0px rgba(0, 0, 0, 0.15);
  display: none;
  border: 1px solid #e0e0e0;
  margin-top: 5px;
}

.daterangepicker::after, .daterangepicker::before {
  display: none;
}

.daterangepicker thead tr th {
  padding: 10px 0;
}

.daterangepicker .table-condensed th select {
  border: 1px solid #ccc;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  font-size: 14px;
  padding: 5px;
  outline: none;
}

/* ==========================================================================
   #FORM
   ========================================================================== */
input {
  outline: none;
  margin: 0;
  border: none;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  width: 100%;
  font-size: 14px;
  font-family: inherit;
}

.input--style-4 {
  line-height: 50px;
  background: #fafafa;
  -webkit-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  -moz-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  padding: 0 20px;
  font-size: 16px;
  color: #666;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  transition: all 0.4s ease;
}

.input--style-4::-webkit-input-placeholder {
  /* WebKit, Blink, Edge */
  color: #666;
}

.input--style-4:-moz-placeholder {
  /* Mozilla Firefox 4 to 18 */
  color: #666;
  opacity: 1;
}

.input--style-4::-moz-placeholder {
  /* Mozilla Firefox 19+ */
  color: #666;
  opacity: 1;
}

.input--style-4:-ms-input-placeholder {
  /* Internet Explorer 10-11 */
  color: #666;
}

.input--style-4:-ms-input-placeholder {
  /* Microsoft Edge */
  color: #666;
}

.label {
  font-size: 16px;
  color: #555;
  text-transform: capitalize;
  display: block;
  margin-bottom: 5px;
}

.radio-container {
  display: inline-block;
  position: relative;
  padding-left: 30px;
  cursor: pointer;
  font-size: 16px;
  color: #666;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.radio-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.radio-container input:checked ~ .checkmark {
  background-color: #e5e5e5;
}

.radio-container input:checked ~ .checkmark:after {
  display: block;
}

.radio-container .checkmark:after {
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  -o-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  width: 12px;
  height: 12px;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  background: #57b846;
}

.checkmark {
  position: absolute;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #e5e5e5;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  border-radius: 50%;
  -webkit-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  -moz-box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
  box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.input-group {
  position: relative;
  margin-bottom: 22px;
}

.input-group-icon {
  position: relative;
}

.input-icon {
  position: absolute;
  font-size: 18px;
  color: #999;
  right: 18px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  cursor: pointer;
}

.btn {
  display: inline-block;
  line-height: 50px;
  padding: 0 50px;
  -webkit-transition: all 0.4s ease;
  -o-transition: all 0.4s ease;
  -moz-transition: all 0.4s ease;
  transition: all 0.4s ease;
  cursor: pointer;
  font-size: 18px;
  color: #fff;
  font-family: "Poppins", "Arial", "Helvetica Neue", sans-serif;
}

.btn--radius {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
}

.btn--radius-2 {
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
}

.btn--pill {
  -webkit-border-radius: 20px;
  -moz-border-radius: 20px;
  border-radius: 20px;
}

.btn--green {
  background: #57b846;
}

.btn--green:hover {
  background: #4dae3c;
}

.btn--blue {
  background: #4272d7;
}

.btn--blue:hover {
  background: #3868cd;
}
    </style>
</head>
<body>

  <div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
          <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
            <div class="wrapper wrapper--w680">
                <div class="card card-4">
                    <div class="card-body">
                        <h1  class="title" scope="col" style="text-align: center;" class="title">DATOS DE PACIENTE</h1>
                        <form method="POST" action="{{ route('patientstore') }}">
                            {{ csrf_field() }}
                            <div class="row row-space">
                            <div class="col-2">
                            </div>
            
                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="ci">CARNET DE IDENTIDAD: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="ci" placeholder="INGRESE SU CI" required>
                                  </div>
                                  
                                  <div class="form-group">
                                    <label for="nombre">NOMBRE: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nombre" placeholder="INGRESE EL NOMBRE" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">APELLIDO PATERNO: </label>
                                    <input type="text" class="form-control" name="ap_paterno" placeholder="INGRESE EL APELLIDO PATERNO" >
                                  </div>

                                  <div class="form-group">
                                    <label for="nombre">APELLIDO MATERNO: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="ap_materno" placeholder="INGRESE EL APELLIDO MATERNO" required>
                                  </div>

                                
                                  <div class="form-group">
                                    <label>GENERO: <span style="color: red">*</span></label>
                                    <select name="genero" class="form-control">
                                      <option value="" disabled selected >SELECIONE SU GENERO</option>
                                      <option value="HOMBRE">HOMBRE</option>
                                      <option value="MUJER">MUJER</option>
                                    </select>
                                  </div>
                                 
                                  <div class="form-group">
                                    <label class="label">ESPECIALIDAD: <span style="color: red">*</span></label>
                                    <select name="especialidad" class="form-control" value="" required >
                                      <option disabled="disabled" value="" selected="selected" >SELECCIONE LA ESPECIALIDAD</option>
                                      @foreach ($especialidades as $especialidad)
                                          <option value="{{ $especialidad['id'] }}">{{ $especialidad['nombre'] }}</option>
                                      @endforeach
                                    </select>
                                  </div>
                               
                                </div>



                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="nombre">EXTENSION: <span style="color: red">*</span></label>
                                    <select name="extension" class="form-control" required>
                                      <option value="" disabled selected >SELECIONE LA EXTENSION DE SU CI </option>
                                      <option value="LP">LP (LA PAZ)</option>
                                      <option value="OR">OR (ORURO)</option>
                                      <option value="PT">PT (POTOSI)</option>
                                      <option value="CB">CB (CBBA)</option>
                                      <option value="SC">SC (STA CRUZ)</option>
                                      <option value="BN">BN (BENI)</option>
                                      <option value="PA">PA (PANDO)</option>
                                      <option value="TJ">TJ (TARIJA)</option>
                                      <option value="CH">CH (CHUQUISACA)</option>
                                    </select>
                                  </div>

                                  

                                  <div class="form-group">
                                    <label for="nombre">FECHA DE NACIMIENTO: <span style="color: red">*</span></label>
                                    <input type="date" class="form-control" name="fechanacimiento" max="{{date('Y-m-d')}}" required>
                                  </div>
                                 

                                  <div class="form-group">
                                    <label for="nombre">ESTADO CIVIL: </label>
                                    <input type="text" class="form-control" name="estado_civil" placeholder="INGRESE SU ESTADO CIVIL" >
                                  </div>


                                  <div class="form-group">
                                    <label for="nombre">OCUPACION: </label>
                                    <input type="text" class="form-control" name="ocupacion" placeholder="INGRESE LA OCUPACION DEL PACIENTE">
                                  </div>

                                  <div class="form-group">
                                    <label for="nombre">CELULAR:</label>
                                    <input type="text" class="form-control" name="telefono" placeholder="INGRESE SU NUMERO DE CELULAR">
                                  </div>
                                  <div class="form-group">
                                    <label for="">DIRECCION:</label>
                                    <input type="text" class="form-control" name="direccion" placeholder="INGRESE LA DIRECCION DE SU DOMICILIO">
                                  </div>
                                  
                                </div>
                              </div>

                              
                                <h1  class="title" scope="col" style="text-align: center;" class="title"> DATOS DEL RESPONSABLE</h1>
                              

                              <div class="row row-space">
                              <div class="col-2">
                              </div>
                                <div class="col-4">
                                  <div class="form-group">
                                    <label for="ci">CARNET DE IDENTIDAD:</label>
                                    <input type="text" class="form-control" name="ci_tutor" placeholder="INGRESE EL C.I.">
                                  </div>

                                  <div class="form-group">
                                    <label for="nombre">NOMBRE: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="nombre_tutor" placeholder="INGRESE EL NOMBRE DEL RESPONSABLE" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="nombre">APELLIDO PATERNO: </label>
                                    <input type="text" class="form-control" name="ap_paterno_tutor" placeholder="INGRESE EL APELLIDO PATERNO" >
                                  </div>

                                  <div class="form-group">
                                    <label for="nombre">APELLIDO MATERNO: <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="ap_materno_tutor" placeholder="INGRESE EL APELLIDO MATERNO" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="">CELULAR:<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="telefono_tutor" placeholder="CELULAR DEL RESPONSABLE " required>
                                  </div>
                                  

                                  
                                </div>



                                <div class="col-4">
                                <div class="form-group">
                                    <label for="nombre">EXTENSION:</label>
                                    <select name="extension_tutor" class="form-control">
                                      <option value="" disabled selected >INGRESE LA EXTENSION DE SU C.I
                                      <option value="OR">OR (ORURO)</option>
                                      <option value="PT">PT (POTOSI)</option>
                                      <option value="CB">CB (CBBA)</option>
                                      <option value="SC">SC (STA CRUZ)</option>
                                      <option value="BN">BN (BENI)</option>
                                      <option value="PA">PA (PANDO)</option>
                                      <option value="TJ">TJ (TARIJA)</option>
                                      <option value="CH">CH (CHUQUISACA)</option>
                                    </select>
                                  </div>

                                
                                  <div class="form-group">
                                    <label for="nombre">PARENTESCO <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" name="parentesco" placeholder="INGRESE EL PARENTESCO CON EL PACIENTE" required>
                                  </div>

                                  <div class="form-group">
                                    <label for="">DIRECCION:</label>
                                    <input type="text" class="form-control" name="direccion_tutor" placeholder="INGRESE LA DIRECCION DEL DOMICILIO">
                                  </div>
                              
                              <div class="form-group">
                                    <label for="">TELEFONO :</label>
                                    <input type="text" class="form-control" name="telefono_emergencia_tutor" placeholder=" INGRESE SU TELEFONO">
                                  </div>
                              
                                  </div>
  
                              <div style="padding: 10px 200px 20px;"  class="p-t-15">
                                <button class="btn btn-success" type="submit"> GUARDAR <i class="fa fa-file" aria-hidden="true"></i> </button>
                                <a href="{{ route('patientindex') }}" class="btn btn-danger">CANCELAR <i class="fa fa-window-close" aria-hidden="true"></i> </a>
                            </div>
                                
                            
                        </form>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</body>
@endsection