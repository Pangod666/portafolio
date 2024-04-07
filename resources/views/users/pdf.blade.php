@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Planilla de Usuarios del Servicio de UTI del HSG</title>
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

    <h4 style="text-align: center">PLANILLA DE USUSARIOS DE LA UNIDAD DE TERAPIA INTENSIVA DEL H.S.G</h4>
    <P style="text-align: initial;font-size: 10px" >Generado: {{ Carbon::now('America/La_Paz') }}<br> Generado por el Usuario: {{ Auth::user()->person->nombre . ' ' . Auth::user()->person->ap_paterno . ' ' . Auth::user()->person->ap_materno}}</P>
    
  
    <div style="">
      <table class="pdf-table" style="text-align: center; margin: 0 auto">
        <thead class="thead-dark">
          <tr>
            <th scope="col" style="text-align: center">C.I.</th>
            <th scope="col" style="text-align: center">NOMBRE</th>
            <th scope="col" style="text-align: center">APELLIDO PATERNO</th>
            <th scope="col" style="text-align: center">APELLIDO MATERNO</th>
            <th scope="col" style="text-align: center">CARGO</th>
            <th scope="col" style="text-align: center">COERREO</th>
            <th scope="col" style="text-align: center">DIRECCION</th>
            <th scope="col" style="text-align: center">CELULAR</th>
            <th scope="col" style="text-align: center">ESTADO</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $user_role)

                              <tr>
                                <td>{{ $user_role->person->ci }}</td>
                                <td scope="col" style="text-align: left">{{ $user_role->person->nombre }}</td>
                                <td scope="col" style="text-align: left">{{ $user_role->person->ap_paterno }}</td>
                                <td scope="col" style="text-align: left">{{ $user_role->person->ap_materno }}</td>
                                <td scope="col" style="text-align: left">{{ $user_role->getRoleNames()->first()}}</td>
                                <td scope="col" style="text-align: left">{{ $user_role->person->correo}}</td>
                                <td scope="col" style="text-align: left">{{ $user_role->person->direccion}}</td>
                                <td>{{ $user_role->person->celular}}</td>
                                <td>{{ $user_role->estado}}</td>
                            
                              </tr>  
            @endforeach              
        </tbody>
    </table>
    </div>
</body>
</html>