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
    <h3>PRODUCTOS CADUCOS,POR CADUCAR Y DE BAJO STOCK</h3>
    
    <p style="text-align: left; width: 250px;font-size: 10px">Fecha: {{ Carbon::now('America/La_Paz') }}<br>Generado por el Usuario: {{ Auth::user()->person->nombre . ' ' . Auth::user()->person->ap_paterno . ' ' . Auth::user()->person->ap_materno}}</p>
    <p style="text-align: initial;font-size: 10px">Productos: {{ $productos->count() }}</p>

   
    
    
        <table class="pdf-table" style="text-align: center; margin: 0 auto">
            <thead class="thead-dark">
            <tr>
              <th scope="col" >CODIGO</th>
              <th scope="col" >NOM. GENERICO</th>
              <th scope="col" >NOM. COMERCIAL</th>
              <th scope="col" >PRESENTACION</th>
              <th scope="col" >CONCEN.</th>
              <th scope="col" >LAB.</th>
              <th scope="col" >F.CADUCIDAD</th>
              <th scope="col" >REFRIGERADO</th>
              <th scope="col" >PRECIO</th>
              <th scope="col" >CANTIDAD</th>
              <th scope="col" >NIVEL REORDEN</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($productos as $product)
            <tr>
              
              <td>{{ $product->codigo}}</td>
              <td>{{ $product->nombre_generico}}</td>
              <td>{{ $product->nombre_comercial}}</td>
              <td>{{ $product->forma_farmaceutica}}</td>
              <td>{{ $product->concentracion}}</td>
              <td>{{ $product->proveedor->nombre}}</td>
              @if ($product->fecha_vencimiento <= now()->addDays(90))
                <td style="color:rgb(255, 17, 0)">{{ $product->fecha_vencimiento}}</td>
              @else
                <td>{{ $product->fecha_vencimiento}}</td>
              @endif
              
              <td>{{ $product->refrigerado }}</td>
              
              <td>{{ $product->precio_venta}} Bs</td>
              @if ($product->cantidad<=$product->nivel_reorden)
                <td style="color:rgb(255, 17, 0)">{{ $product->cantidad}} Uni.</td>
              @else
                <td>{{ $product->cantidad}} Uni.</td>
              @endif
                <td>{{ $product->nivel_reorden }} Uni.</td>
              
            </tr>
          @endforeach
               
            </tbody>
        </table>

      
    
    
</body>
</html>






