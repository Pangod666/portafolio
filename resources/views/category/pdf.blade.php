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
    <h4 style="text-align: center">Grupo de Medicametos y Categoria del Servicio de UTI del HSG</h4>
    <div style="">
    <p style="text-align: left; width: 250px;font-size: 10px">Fecha: {{ Carbon::now('America/La_Paz') }}<br>Generado por el Usuario: {{ Auth::user()->person->nombre . ' ' . Auth::user()->person->ap_paterno . ' ' . Auth::user()->person->ap_materno}}</p>
   
      <table class="pdf-table" style="text-align: center; margin: 0 auto">
        <thead class="thead-dark">
          <tr>
            <th scope="col" style="text-align: center;" >ID</th>
            <th scope="col" style="text-align: center;" >NOMBRE</th>
            <th scope="col" style="text-align: center;" >DESCRIPCION</th>
            <th scope="col" style="text-align: center;" >MEDICAMENTOS REGISTRADOS</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <th>{{ $categoria->id }}</th>
                    <th>{{ $categoria->nombre }}</th>
                    <th>{{ $categoria->descripcion }}</th>
                    <th>{{ $categoria->productos->count() }}</th>

                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
      
   
   
    
</body>
</html>