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
    <h3 style="text-align: center">PACIENTES REGISTRADOS EN EL SERVICIO DE LA UNIDAD DE TERAPIA INTENSIVA DEL H.S.G</h3>
    <div style="">
    <p style="text-align: left; width: 200px;font-size: 10px">Fecha: {{ Carbon::now('America/La_Paz') }}<br> Generado por el Usuario: {{ Auth::user()->person->nombre . ' ' . Auth::user()->person->ap_paterno . ' ' . Auth::user()->person->ap_materno}}</p>
    
      <table class="pdf-table" style="text-align: center; margin: 0 auto">
        <thead class="thead-dark">
          <tr>
            <th scope="col" style="text-align: center;" >CI</th>
            <th scope="col" style="text-align: center;" >NOMBRE</th>
            <th scope="col" style="text-align: center;" >AP PATERNO</th>
            <th scope="col" style="text-align: center;" >AP MATERNO</th>
            <th scope="col" style="text-align: center;" >FECHA NACIMIENTO</th>
            <th scope="col" style="text-align: center;" >GENERO</th>
            <th scope="col" style="text-align: center;" >ESPECIALIDAD</th>
            <th scope="col" style="text-align: center;" >CELULAR</th>
            <th scope="col" style="text-align: center;" >DIRECCION</th>
            <th scope="col" style="text-align: center;" >ESTADO</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
                <tr>
                    <th scope="col" style="text-align: left;">{{ $paciente->person->ci . $paciente->person->extension }}</th>
                    <th scope="col" style="text-align: left;">{{ $paciente->person->nombre }}</th>
                    <th scope="col" style="text-align: left;">{{ $paciente->person->ap_paterno }}</th>
                    <th scope="col" style="text-align: left;">{{ $paciente->person->ap_materno }}</th>
                    <th>{{ $paciente->person->fechanacimiento }}</th>
                    <th>{{ $paciente->person->genero }}</th>
                    <th scope="col" style="text-align: left;">{{ $paciente->especialidad->nombre }}</th>
                    <th>{{ $paciente->person->celular }}</th>
                    <th scope="col" style="text-align: left;">{{ $paciente->person->direccion }}</th>
                    <th>{{ $paciente->estado}}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
      
    {{-- <h2 style="text-align: right"> <strong>TOTAL: {{ $total }}</strong> </h2>
    <p style="text-align: center"> Generado por el Usuario: {{ $orden->usuario->person->ap_paterno . " " .$orden->usuario->person->ap_materno . " " . $orden->usuario->person->nombre  }}</p> --}}
   
    
</body>
</html>