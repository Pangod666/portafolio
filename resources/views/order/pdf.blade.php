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
<body>
    <img src="img\san_gabriel.jpeg" width="15%">
    <h4 style="text-align: center"> COMPROBANTE DE LOS MEDICAMENTOS DESCARGADOS EN U.T.I. DEL H.S.G.</h4>

    <div>
        <p style="text-align: left; width: 150px;font-size: 10px"> ORDEN NRO: {{ $orden->id }}  <br> Fecha: {{ Carbon::now('America/La_Paz') }}</p>
 
        <p style="text-align: left; width: 200px;font-size: 10px"> HCL: {{ $orden->paciente->id }}<br> Paciente: {{$orden->paciente->person->nombre . " " . $orden->paciente->person->ap_paterno . " " .$orden->paciente->person->ap_materno }} <br> C.I: {{ $orden->paciente->person->ci}}</p>
    <p style="text-align: center ;font-size: 10px">DETALLE</p>
        ------------------------------------------------------------------------------------------------------------------------------------------
    </div>
    <div style="">
      <table class="table" style="text-align: center; margin: 0 auto; ">
        <thead class="thead-dark">
          <tr>
            <th scope="col" style="text-align: left; width: 200px;font-size: 10px">PRODUCTO</th>
           
            <th scope="col" style="text-align: left; width: 130px;font-size: 10px">PRESENTACION</th>
            <th scope="col" style="text-align: left; width: 130px;font-size: 10px">CONCENTRACION</th>
            <th scope="col" style="text-align: left; width: 100px;font-size: 10px">CANTIDAD</th>
            <th scope="col" style="text-align: left; width: 100px;font-size: 10px">PRECIO </th>
            
            <th scope="col" style="text-align: left; width: 100px;font-size: 10px">MONTO</th>
          </tr>
        </thead>
        <tbody>
            @php
              $total = 0;    
            @endphp
            @foreach ($orden->productos as $producto)
              <tr>
                <td style="text-align: left; width: 200px;font-size: 10px">{{ $producto->nombre_generico}}</td>
              
                <td style="text-align: left; width: 130px;font-size: 10px">{{ $producto->forma_farmaceutica}}</td>
                <td style="text-align: left; width: 130px;font-size: 10px">{{ $producto->concentracion}} Uni.</td>
                <td style="text-align: left; width: 100px;font-size: 10px">{{ $producto->pivot->cantidad}} Uni.</td>
                <td style="text-align: left; width: 100px;font-size: 10px">{{ $producto->precio_venta}} Bs </td>
                <td style="text-align: left; width: 100px;font-size: 10px">{{ $producto->precio_venta * $producto->pivot->cantidad}} Bs</td>
                @php
                    $total = $total + ($producto->precio_venta * $producto->pivot->cantidad); 
                @endphp
                
              </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    
    ------------------------------------------------------------------------------------------------------------------------------------------
    <h4 style="text-align: right; font-size: 10px"> <strong>TOTAL: {{ $total }}</strong> Bs</h4>
    <p style="text-align:right; font-size: 10px"> Usuario: {{$orden->usuario->person->nombre ." ". $orden->usuario->person->ap_paterno . " " .$orden->usuario->person->ap_materno  }} </p>
    
   
</body>
</html>








