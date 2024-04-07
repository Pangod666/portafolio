@extends('layouts.app')
@section('content')

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8">
  <div class="container-fluid">
      <div class="header-body">
        <div style="background-color: white">
          <div style="padding: 2%">
            <div class="container">
              <!-- Content here -->
              
                    @php
                        $cart = session()->get('cart');
                        $total = 0;
                    @endphp
                    @if (!$cart)
                      <h1>AUN NO SELECCIONASTE PRODUCTOS A DESCARGAR</h1>
                      <a href="{{ route('productlist') }}" class="btn btn-primary">Agregar Productos</a>
                    @else
                      <h1>MEDICAMENTOS SELECCIONADOS  </h1>
                      <div>
                        <label for=""></label>
                      </div>
                      <a href="{{ route('productlist') }}" class="btn btn-primary">AGREGAR PRODUCTOS</a>
                      <div>
                        <br>
                      </div>
                      @if (session('mensaje'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{ session('mensaje') }}</strong></span>
                        <button button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div> 
                      @endif
                      @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>{{ session('error') }}</strong></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        </div> 
                      @endif
                      <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col" style="color: white">NOM. GENERICO</th>
                            <th scope="col" style="color: white">PRESENTACION</th>
                            
                            <th scope="col" style="color: white">CANTIDAD </th>
                            <th scope="col" style="color: white">PRECIO UNI.</th>
                            <th scope="col" style="color: white">TOTAL</th>
                            <th scope="col" style="color: white">ACCIONES</th>
                          </tr>
                        </thead>
                        <tbody>
                      @foreach ( session('cart') as $product=>$details)
                        @php
                          $total = $total + ($details['cantidad'] * $details['precio_venta']);
                        @endphp
                        <tr>
                          <td>{{ $details['nombre'] }}</td>
                          <td>{{ $details['forma_farmaceutica'] }}</td>
                         
                          
                          <td>{{ $details['cantidad']." Uni." }}</td>
                          <td>{{ $details['precio_venta'] ." Bs"}}</td>
                          <td>{{ ($details['cantidad'] * $details['precio_venta']) . " Bs"}}</td>
                          <td>
                              <a href="{{ route ('removetocart', $details['id']) }}" class="btn btn-warning ">-</a>
                              <a href="{{ route ('addproductcart', $details['id']) }}" class="btn btn-primary ">+</a>
                          </td>
                        </tr>
                      
                        @endforeach
                    @endif
                    </tbody>
                    </table>
                    <h2> Precio Total:  {{ $total }}  Bs</h2>
                    @if (session()->get('cart'))
                      <a href="{{ route('ordendescargo') }}" class="btn btn-success">DESCARGAR</a>
                    @else
                    <a href="{{ route('ordendescargo') }}" class="btn btn-success disabled">DESCARGAR</a>  
                    @endif
                          
                          <a href="{{ route('destroycart') }}" class="btn btn-danger ">VACIAR</a>
          
                
            </div>
          </div>
        </div>
      </div>
  </div>
</div>




@endsection



