<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use PDF;



class CategoryController extends Controller
{
    public function index(){
        $categorias = Category::Orderby('categories.id')
                    ->selectRaw('categories.*, count(products.id_category) as cantidad')
                    ->leftjoin('products', 'categories.id', '=', 'products.id_category')
                    ->groupBy('categories.id')
                    ->get();
                                  
        return view('category.index_category')->with('categorias',$categorias);
    }

    public function create(){
        return view('category.category_form');
    }

    public function pdf(){
        $categorias = Category::all();
        $pdf = PDF::loadView('category.pdf',['categorias'=>$categorias]);
        $pdf->setPaper('letter', 'landscape');
        //$pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function store(Request $request){
        try {
            Category::create([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion
            ]);
            session()->flash('mensaje', 'Grupo de Medicamentos creado con exito');
            return redirect(route('index_category'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Ya existe un grupo con ese nombre');
            return view('category.category_form');
        }
        
    }

    public function show($id){

        $categoria = Category::where('id',$id)->first();
        return view('category.view_category', compact('categoria'));

    }

    public function edit($id){

        $categoria = Category::where('id',$id)->first();
        return view('category.edit', compact('categoria'));

    }

    public function update(Request $request){

        try {
            $data = Category::where('id',$request->id)->update([
                'nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion
            ]);
            
            session()->flash('mensaje', 'Grupo modificado con exito');
            return redirect(route('index_category'));
        } 
        catch (\Throwable $th) {
            session()->flash('error', 'Ya existe un grupo de medicamentos con ese nombre');
            return redirect(route('show_category',$request->id));
        }
    }

    

    public function delete($id){
        try {
            Category::where('id',$id)->delete();
            session()->flash('mensaje', 'Categoria eliminada exitosamente');
            return redirect(route('index_category'));
        } catch (\Throwable $th) {
            session()->flash('error', 'Imposible eliminar la categoria, existen productos almacenados');
            return redirect(route('index_category'));
        }
    }



    public function search(Request $request){
        
        $user = Auth::user();
        $role = $user->roles->first();
        $roleName = $role->name;

        $query = $request->get('query');

        $data=[];   

        if ($query != '' or $query != NULL or $query->empty()) {
            $categorias = Category::Orderby('categories.id')
                    ->selectRaw('categories.*, count(products.id_category) as cantidad')
                    ->leftjoin('products', 'categories.id', '=', 'products.id_category')
                    ->groupBy('categories.id')
                    ->where('categories.nombre', 'LIKE', '%' . $query . '%')
                    ->get();
            
            foreach ($categorias as $categoria) {
                
                $datatable = [
                        [
                        'id'=>$categoria->id,
                        'nombre'=>$categoria->nombre,
                        'descripcion'=>$categoria->descripcion,
                        'cantidad' => $categoria->cantidad,
                        'rol'=>$roleName
                        ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);

        } else {
            $categorias = Category::Orderby('categories.id')
                        ->selectRaw('categories.*, count(products.id_category) as cantidad')
                        ->leftjoin('products', 'categories.id', '=', 'products.id_category')
                        ->groupBy('categories.id')
                        ->get();
            
            foreach ($categorias as $categoria) {
                
                $datatable = [
                    [
                    'id'=>$categoria->id,
                    'nombre'=>$categoria->nombre,
                    'descripcion'=>$categoria->descripcion,
                    'cantidad' => $categoria->cantidad,
                    'rol'=>$roleName
                    ]
                ];

                $data = array_merge($data, $datatable);
            }

            return response()->json($data);
        }  
    }
}
