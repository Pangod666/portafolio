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

    <h3 style="text-align: center">REPORTE DE MOVIMIENTOS DE LA UNIDAD DE TERPIA INTENSICA </h3>
    <div style="">
    <p style="text-align: left; width: 150px;font-size: 10px">Fecha: {{ Carbon::now('America/La_Paz') }}</p>
    {{-- <h2 style="text-align: right"> <strong>TOTAL: {{ $total }}</strong> </h2>
    <p style="text-align: center"> Generado por el Usuario: {{ $orden->usuario->person->ap_paterno . " " .$orden->usuario->person->ap_materno . " " . $orden->usuario->person->nombre  }}</p> --}}
    <p style="text-align:left; font-size: 10px"> Generado por el Usuario: {{ Auth::user()->person->nombre . ' ' . Auth::user()->person->ap_paterno . ' ' . Auth::user()->person->ap_materno}}</p>
      <table class="pdf-table" style="text-align: center; margin: 0 auto">
        <thead class="thead-dark">
          <tr>
            <th scope="col" style="text-align: center;" >ID</th>
            <th scope="col" style="text-align: center;" >USUARIO</th>
            <th scope="col" style="text-align: center;" >PRODUCTO</th>
            <th scope="col" style="text-align: center;" >LAB.</th>
            
            <th scope="col" style="text-align: center;" >MOVIMIENTO</th>
            <th scope="col" style="text-align: center;" >CANTIDAD</th>
            <th scope="col" style="text-align: center;" >FECHA REGISTRADA</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $movimiento)
                <tr>
                    <th scope="col" style="text-align: center;font-size: 9px">{{ $movimiento->id }}</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $movimiento->usuario->person->nombre . ' '. $movimiento->usuario->person->ap_paterno .' '. $movimiento->usuario->person->ap_materno}}</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $movimiento->producto->nombre_generico }}</th>
                    <td scope="col" style="text-align: center;font-size: 9px"> {{ $movimiento->producto->Proveedor->nombre }}</td>
                    <th scope="col" style="text-align: center;font-size: 9px">{{ $movimiento->moving }}</th>
                    <th scope="col" style="text-align: center;font-size: 9px"> {{ $movimiento->quantity }}</th>
                    <th scope="col" style="text-align: center;font-size: 9px">{{ $movimiento->fecha }}</th>

                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
      
   

</body>
</html>