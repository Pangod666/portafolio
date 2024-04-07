<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Provider;
use Illuminate\Http\Request;
use Session;
use Log;
use Auth;
use PDF;
use Carbon\Carbon;

class ProductController extends Controller
{

    public function index(){
        $products = Product::all();
        return view('product.index')->with('products',$products);
    }

    public function create(){
        $categorias = Category::all();
        $proveedores = Provider::all();
        return view('product.register', compact('categorias','proveedores'));
    }

    public function show($id){
        $product = Product::where('id',$id)->first();
        if ($product) {
            $categorias = Category::all();
            $proveedores = Provider::all();
            return view('product.show', compact('product','proveedores','categorias'));
        }else{
            return redirect(route('dashboard'));
        }      
    }

    public function store(Request $request){

        $cantidadProductos = Product::OrderBy("id","desc")->first();
        
        if($cantidadProductos==NULL){
            $cantidadProductos = 0;
        }else{
            $cantidadProductos = $cantidadProductos->id;
        }
        
        $categoria = Category::where('id', $request->categoria)->first();

        $codigo = strtoupper(substr($categoria->nombre,0,3)) . ($cantidadProductos+1);

        Product::create([
            'codigo'=>$codigo,
            'nombre_generico' => strtoupper($request->nombre_generico),
            'nombre_comercial'=>strtoupper($request->nombre_comercial),
            'concentracion'=>strtoupper($request->concentracion),
            'forma_farmaceutica'=>strtoupper($request->forma_farmaceutica),
            'tipo_de_venta'=>strtoupper($request->tipo_venta),
            'fecha_registro'=>$request->fecha_registro,
            'fecha_vencimiento'=>$request->fecha_vencimiento,
            'precio_adquirido'=>$request->precio_adquirido,
            'precio_venta'=>$request->precio_venta,
            'refrigerado'=>$request->refrigerado,
            'cantidad'=>$request->cantidad,
            'nivel_reorden'=>$request->nivel_reorden,
            'id_proveedor'=>$request->proveedor,
            'id_category'=>$request->categoria
        ]);

        return redirect(route('productlist'));
    }

    public function update(Request $request){
       
            Product::where('id',$request->id)->update([
                'tipo_de_venta'=>strtoupper($request->tipo_venta),
                'fecha_registro'=>$request->fecha_registro,
                'fecha_vencimiento'=>$request->fecha_vencimiento,
                'precio_adquirido'=>$request->precio_adquirido,
                'precio_venta'=>$request->precio_venta,
                'refrigerado'=> $request->refrigerado,
                'nivel_reorden'=>$request->nivel_reorden,
                'id_category'=>$request->categoria
            ]);
            session()->flash('mensaje', "PRODUCTO EDITADO CON EXITO");
            return redirect(route('productlist'));
        
    }

    public function disableProduct($id){
        Product::where('id',$id)->update([
            'estado'=>'inactivo'
        ]);
        session()->flash('mensaje', "PRODUCTO INHABILITADO CON EXITO");
        return redirect(route('productlist'));
    }

    public function activeProduct($id){
        Product::where('id',$id)->update([
            'estado'=>'activo'
        ]);
        session()->flash('mensaje', "PRODUCTO HABILITADO CON EXITO");
        return redirect(route('productlist'));
    }



    public function addtoCart($id){
    
        $product = Product::find($id);

        $cart = session()->get('cart');

        if($product->cantidad>0){
            if(!$cart){
                $cart = [
                    $id => [
                        "id"=> $product->id,
                        "nombre" => $product->nombre_comercial,
                        "cantidad" => 1,
                        "precio_venta" => $product->precio_venta,
                        "forma_farmaceutica" => $product->forma_farmaceutica
                    ]
                ];
                session()->put('cart', $cart);

                session()->flash('mensaje', $product->nombre_comercial . " agregado con exito a la lista de descargo");
                return redirect(route('productlist'));
            }
    
            if(isset($cart[$id])) {
                if($cart[$id]['cantidad']<$product->cantidad){
                    $cart[$id]['cantidad']++;
                    session()->put('cart', $cart);
                    session()->flash('mensaje', $product->nombre_comercial . " agregado con exito a la lista de descargo");
                    return redirect(route('productlist'));
                }else{
                    session()->flash('error', $product->nombre_comercial . " se agrego el maximo de producto a la lista");
                    return redirect(route('productlist'));
                }
                
            }
    
            $cart[$id] = [
                "id" => $product->id,
                "nombre" => $product->nombre_comercial,
                "cantidad" => 1,
                "precio_venta" => $product->precio_venta,
                "forma_farmaceutica" => $product->forma_farmaceutica
            ];
            session()->put('cart', $cart);
            session()->flash('mensaje', $product->nombre_comercial . " agregado con exito a la lista de descargo");
            return redirect(route('productlist'));
        }else{
            session()->flash("NO QUENDAN UNIDADES DISPONIBLES");
            return redirect(route('productlist'));
        }
    }

    public function removetoCart($id){
        try {
            $cart = session()->get('cart');
            $producto = Product::find($id);
        
            if ($cart[$id]['cantidad']>1) {
                $cart[$id]['cantidad']--;
                    session()->put('cart', $cart);
                    session()->flash('mensaje',"Reducido: ". $producto->nombre_comercial ." con exito");
                    return redirect(route('vercarrito'));
            }

            if(isset($cart[$id])) {
                if($cart[$id]['cantidad']>1){
                    $cart[$id]['cantidad']--;
                    session()->put('cart', $cart);
                    session()->flash('mensaje',"Reducido: " . $producto->nombre_comercial . "con exito");
                    return redirect(route('vercarrito'));
                }
                else{
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                    session()->flash('mensaje', 'Producto removido con exito');
                    return redirect(route('vercarrito'));
                }
            }
        } catch (\Throwable $th) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect(route('productlist'));
        }
    }

    public function addProductCart($id){
        try {
            $cart = session()->get('cart');
            $producto = Product::find($id);

            if($producto->cantidad > 0){
                if($cart[$id]['cantidad'] < $producto->cantidad){
            
                    $cart[$id]['cantidad']++;
                    session()->put('cart', $cart);
                    session()->flash('mensaje','Adicionado: '. $producto->nombre_comercial . " con exito");
                    return redirect(route('vercarrito'));
                }else{
                    session()->flash('error','NO QUEDAN MAS UNIDADES DISPONIBLES DE ESTE PRODUCTO');
                    return redirect(route('vercarrito'));
                }
            }else{
                session()->flash('error','NO QUEDAN MAS UNIDADES DISPONIBLES DE ESTE PRODUCTO');
                return redirect(route('vercarrito'));
            }
        } catch (\Throwable $th) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->flash('mensaje','ERROR');
            return redirect(route('productlist'));
        }
    }

    public function viewCart(){
        return view('product.car');
    }

    public function destroyCart(){
        Session::forget('cart');
        return redirect()->back();
    }

    


    public function search(Request $request){

        $user = Auth::user();
        $role = $user->roles->first();
        $roleName = $role->name;
        
        $query = $request->get('query');

        $data=[];   

        if ($query != '' or $query != NULL or $query->empty()) {
            $productos = Product::where('id', 'LIKE', '%' . $query . '%')
                        ->orWhere('nombre_comercial', 'LIKE', '%' . $query . '%')
                        ->orWhere('nombre_generico', 'LIKE', '%' . $query . '%')
                        ->orWhere('codigo', 'LIKE', '%' . $query . '%')
                        ->get();
            
            foreach ($productos as $producto) {
                
                $datatable = [
                        [
                        'id'=>$producto->id,
                        'codigo'=>$producto->codigo,
                        'nombre_comercial' => $producto->nombre_comercial,
                        'nombre_generico' => $producto->nombre_generico,
                        'concentracion' => $producto->concentracion,
                        'forma_farmaceutica'=>$producto->forma_farmaceutica,
                        'laboratorio'=>$producto->proveedor->nombre,
                        'tipo_de_venta'=>$producto->tipo_de_venta,
                        'precio_venta'=>$producto->precio_venta,
                        'refrigerado'=>$producto->refrigerado,
                        'cantidad'=>$producto->cantidad,
                        'estado'=>$producto->estado,
                        'rol'=>$roleName
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);

        } else {
            $productos = Product::where('estado','activo');
            
            foreach ($productos as $producto) {
                
                $datatable = [
                        [
                        'id'=>$producto->id,
                        'codigo'=>$producto->codigo,
                        'nombre_comercial' => $producto->nombre_comercial,
                        'nombre_generico' => $producto->nombre_generico,
                        'concentracion' => $producto->concentracion,
                        'forma_farmaceutica'=>$producto->forma_farmaceutica,
                        'laboratorio'=>$producto->proveedor->nombre,
                        'tipo_de_venta'=>$producto->tipo_de_venta,
                        'precio_venta'=>$producto->precio_venta,
                        'refrigerado'=>$producto->refrigerado,
                        'cantidad'=>$producto->cantidad,
                        'estado'=>$producto->estado,
                        'rol'=>$roleName
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);
        }  
    }


}
