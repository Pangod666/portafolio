<center><h1>PRODUCTOS CADUCOS</h1></center>
<div class="table-responsive">
    <table class="table" id="user-table">
      <thead class="thead-dark">
        <tr>
          <th scope="col" >CODIGO</th>
          <th scope="col" >NOM. GENERICO</th>
          <th scope="col" >NOM. COMERCIAL</th>
          <th scope="col" >PRESENTACION</th>
          <th scope="col" >CONCEN.</th>
          <th scope="col" >LAB.</th>
          <th scope="col" >F.CADUCIDAD</th>
          
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