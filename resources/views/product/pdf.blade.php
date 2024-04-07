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
    <h3 style="text-align: center">ALMACEN DE MEDICAMENTOS DEL SERVICIO DE UTI DEL H.S.G.</h3>
    
    <p style="text-align: left; width: 250px;font-size: 10px">Fecha: {{ Carbon::now('America/La_Paz') }}<br>Generado por el Usuario: {{ Auth::user()->person->nombre . ' ' . Auth::user()->person->ap_paterno . ' ' . Auth::user()->person->ap_materno}}</p>
    <p style="text-align: initial;font-size: 10px">Productos: {{ $productos->count() }}</p>

   
    
    <div style="">
   
      <table class="pdf-table" style="text-align: center; margin: 0 auto">
        <thead class="thead-dark">
            <tr>
                <th scope="col" style="text-align: center;font-size: 10px">CODIGO</th>
                <th scope="col" style="text-align: center;font-size: 10px">GRUPO</th>
                <th scope="col" style="text-align: center;font-size: 10px">NOM. GENERICO</th>
                <th scope="col" style="text-align: center;font-size: 10px">NOM. COMERCIAL</th>
                <th scope="col" style="text-align: center;font-size: 10px">CONCENTRACION</th>
                <th scope="col" style="text-align: center;font-size: 10px">REFRIGERADOS</th>
                <th scope="col" style="text-align: center;font-size: 10px">FORMA FARMACEUTICA</th>
                <th scope="col" style="text-align: center;font-size: 10px">LAB</th>
                <th scope="col" style="text-align: center;font-size: 10px">TIPO DE VENTA</th>
                <th scope="col" style="text-align: center;font-size: 10px">PRECIO </th>
                <th scope="col" style="text-align: center;font-size: 10px">UNI. DISP</th>
                <th scope="col" style="text-align: center;font-size: 10px">NIVEL REORDEN</th>
                <th scope="col" style="text-align: center;font-size: 10px">VENCIMIENTO</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                {{ $total= $total + ($producto->cantidad * $producto->precio_venta) }}

                <tr>
                    <th scope="col" style="text-align: center;font-size: 9px">{{ $producto->codigo }}</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->categoria->nombre }}</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->nombre_generico }}</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->nombre_comercial }}</th>
                 
                    <th>{{ $producto->concentracion }}</th>
                    <th>{{ $producto->refrigerado }}</th>
                    <th scope="col" style="text-align: left;font-size: 9px"scope="col" style="text-align: left;font-size: 10px">{{ $producto->forma_farmaceutica }}</th>
                    <th >{{ $producto->proveedor->nombre }}</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->tipo_de_venta }}</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->precio_venta }} Bs</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->cantidad }} Uni.</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->nivel_reorden }} Uni.</th>
                    <th scope="col" style="text-align: left;font-size: 9px">{{ $producto->fecha_vencimiento }}</th>
                </tr>
               
                @endforeach
    <p scope="col" style="text-align: left;font-size: 10px">Total del almacen: {{ $total }} Bs</p>

            
        </tbody>
    </table>
    </div>
      
    
    
</body>
</html>






