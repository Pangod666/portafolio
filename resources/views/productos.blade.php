<h1><center>ALMACEN DE MEDICAMENTOS</center></h1>
<table class="table" id="user-table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">COD.</th>
        <th scope="col">NOM.GENERICO</th>
        <th scope="col">NOM.COMERCIAL</th>
        <th scope="col">CONCEN.</th>
        <th scope="col">F.FARMA.</th>
        <th scope="col">UNI.DISP.</th>
        <th scope="col">LAB.</th>
        <th scope="col">T.VENTA</th>
        <th scope="col">REFRI.</th>
        <th scope="col">PRECIO</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        
        <td td scope="col">{{ $product->codigo}}</td>
        
        <td td scope="col">{{ $product->nombre_generico}}</td>
        <td td scope="col">{{ $product->nombre_comercial}}</td>
        <td td scope="col">{{ $product->concentracion}}</td>
        <td td scope="col">{{ $product->forma_farmaceutica}}</td>
        <td td scope="col">{{ $product->cantidad}} Uni.</td>
            <td td scope="col">{{ $product->proveedor->nombre}}</td>
        <td scope="col">{{ $product->tipo_de_venta}}</td>
        <td scope="col">{{ $product->refrigerado}}</td>
        <td scope="col">{{ $product->precio_venta}} Bs</td>
      </tr>
    @endforeach
         
    </tbody>
  </table>