@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    <div class="container-fluid mt--7">
        @if (session('mensaje'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                      <button button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div> 
        @endif
        <div class="row">
            
            <div class="col-xl-8 mb-5 mb-xl-0">
            </div>
            <div class="col-xl-8">
                <div class="card shadow">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
                        </div>
                    
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    
                        
                        <div class="card-body">
                            <!-- Chart -->
                            <div id="grafico">

                            </div>
                        </div>
                    
                </div>
            </div>
            <div class="container" style="padding: 0 0 2em 0">
                <h2>PRODUCTOS POR CADUCAR, CADUCOSY DE BAJO STOCK</h2> 
                <h3>  LA FECHA DE CADUCIDAD SE ALERTARA EN MENOS DE 90 DIAS</h3>
                    <div style="padding: 1em; align-content: space-between">
                        <a href="{{ route('caducos_pdf') }}" target="_blank" class="btn btn-success">PDF <i class="fa fa-file" aria-hidden="true"></i></a>
                        <a href="{{ route('excel_prueba') }}" target="_blank" class="btn btn-info">EXCEL <i class="fa fa-file" aria-hidden="true"></i></a>
                    </div>
                <div class="table-responsive">
                    <table class="table" id="user-table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col" style="color: white">CODIGO</th>
                          <th scope="col" style="color: white">NOM. GENERICO</th>
                          <th scope="col" style="color: white">NOM. COMERCIAL</th>
                          <th scope="col" style="color: white">PRESENTACION</th>
                          <th scope="col" style="color: white">CONCEN.</th>
                          <th scope="col" style="color: white">LAB.</th>
                          <th scope="col" style="color: white">F.CADUCIDAD</th>
                          
                          <th scope="col" style="color: white">PRECIO</th>
                          <th scope="col" style="color: white">CANTIDAD</th>
                          <th scope="col" style="color: white">NIVEL REORDEN</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
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
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')

    <script>
       Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Cantidad de productos vendidos los ultimos dias'
    },
    accessibility: {
        announceNewData: {
            enabled: false
        }
    },
    xAxis: {
        type: 'category',

    },
    yAxis: {
        title: {
            text: 'Productos Vendidos'
        }

    },
    legend: {
        enabled: true
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y} productos'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
    },

    series: [
        {
            name: 'Fecha',
            colorByPoint: true,
            data: <?= $data ?>
        }
    ],

    credits:{
        enable:false
    }
});
    </script>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush