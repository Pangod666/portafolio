@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    /* Estilos CSS para la tabla */
    .pdf-table {
        width: 100%;
        font-size: 10px; /* Ajusta el tamaño de la fuente */
    }

    .pdf-table th,
    .pdf-table td {
        padding: 3px; /* Ajusta el espaciado entre celdas */
        border: 1px solid #000;
    } 
</style>

<body>
<img src="img\san_gabriel.jpeg" width="15%">
    <h3 style="text-align: center">HISTORIAL DE INGRESO DEL PACIENTE</h3>
   
    <div style="">
      <table class="pdf-table" style="text-align: left; margin: 0 auto,">
      <div class="col-4">
                              <div class="form-group">
                              <label style="text-align: left;font-size: 12px"><b>Fecha : </b>{{ Carbon::now('America/La_Paz') }}</label>
                                 
                            </div>
                              </div>
    
      <div class="col-4">
                              <div class="form-group">
                              <p style="text-align: left;font-size: 13px"><b>DATOS DEL PACIENTE:</b></p>
                            </div>
                              </div>
                             
                            <div class="col-4" style="display:flex" >
                                  <div class="form-group">
                                  <label style="text-align: left;font-size: 12px"><b>Especialidad:</b> {{ $paciente->especialidad->nombre }}</label>
                                </div>
                                  </div>
                                  <div class="col-4">
                              <div class="form-group">
                              <label style="text-align: left;font-size: 12px" for="nombre"><b>Cedula de Identidad: </b> {{ucfirst($paciente->person->ci." ".$paciente->person->extension) }} </label>  
                            </div>
                              </div>
                                  
                                  <div class="col-4">
                              <div class="form-group">
                              <label  style="text-align: left;font-size: 12px"for="nombre"><b>Nombre y Apellido: </b> {{ucfirst($paciente->person->nombre ." ".$paciente->person->ap_paterno." ".$paciente->person->ap_materno ) }} </label>
                            </div>
                              </div>
                                 
                                  <div class="col-4">
                                  <div class="form-group">
                                  <label  style="text-align: left;font-size: 12px"for="nombre"><b>Fecha de Naciemiento: </b> {{ucfirst($paciente->person->fechanacimiento ." ".$paciente->person->extension) }} </label>  
                                  
                                </div>
                                  </div>
                                  <div class="col-4">
                                  <div class="form-group">
                                  <label style="text-align: left;font-size: 12px" for="nombre"><b>Genero: </b> {{ucfirst($paciente->person->genero  ) }} </label>  
                                  
                                </div>
                                  </div>
                                  <div class="col-4">
                                  <div class="form-group">
                                  <label style="text-align: left;font-size: 12px" for="nombre"><b>Estado Civil: </b> {{ucfirst($paciente->person->estado_civil ) }} </label>  
                                  
                                </div>
                                  </div>
                                  <div class="col-4">
                                  <div class="form-group">
                                  <label style="text-align: left;font-size: 12px" for="nombre"><b>Ocupacpión: </b> {{ucfirst($paciente->person->ocupacion ) }} </label>  
                                  
                                </div>
                                  </div>
                                  <div class="col-4">
                                  <div class="form-group">
                                   <label style="text-align: left;font-size: 12px" for="nombre"><b>Dirección: </b> {{ucfirst($paciente->person->direccion) }} </label>  
                                  
                                </div>
                                  </div>
                                  <div class="col-4">
                                  <div class="form-group">
                                  <label style="text-align: left;font-size: 12px" for="nombre"><b>Celular: </b> {{ucfirst($paciente->person->celular) }} </label>  
                                  
                                </div>
                                  </div>
                                 
 
    </table>
    </div>
    
    
    <div style="">
        <table class="pdf-table" style="text-align: center; margin: 0 auto">
        <table class="pdf-table" style="text-align: left; margin: 0 auto,">
    
        <div class="form-group">
                              <p style="text-align: left;font-size: 13px"><b>DATOS DEL TUTOR:</b></p>
                            </div>
                            <div class="col-4">
                              <div class="form-group">
                              <label style="text-align: left;font-size: 12px" for="nombre"><b>Cedula de Identidad: </b> {{ucfirst($paciente->tutor->ci_tutor ." ".$paciente->tutor->extension_tutor) }} </label>  
                            </div>
                              </div>
                               <div class="col-4" style="display:flex" >
                              <div class="form-group">
                             
                              <label style="text-align: left;font-size: 12px" for="nombre"><b>Nombre y Apellido: </b> {{ucfirst($paciente->tutor->person->nombre." ".$paciente->tutor->person->ap_paterno." ".$paciente->tutor->person->ap_materno ) }} </label>
                            </div>
                              </div>
                             
                             
                              <div class="col-4">
                              <div class="form-group">
                              <label  style="text-align: left;font-size: 12px"for="nombre"><b>Parentesco: </b> {{ucfirst($paciente->tutor->parentesco) }} </label>  
                            </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                              <label style="text-align: left;font-size: 12px" for="nombre"><b>Dirección: </b> {{ucfirst($paciente->tutor->direccion_tutor ) }} </label>  
                              
                            </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                              <label style="text-align: left;font-size: 12px" for="nombre"><b>Celular: </b> {{ucfirst($paciente->tutor->person->celular) }} </label>  
                              
                            </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                              <label style="text-align: left;font-size: 12px" for="nombre"><b>Telefono: </b> {{ucfirst($paciente->tutor->person->telefono_emergencia_tutor ) }} </label>  
                              
                           
                             

</table>
         
      </table>
      </div>
      
   
</body>
</html>