<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    if(Auth::user()){
        return redirect(route('dashboard'));
    }else{
        return view('auth.login');
    }
})->name('welcome');



//DIRECCION DE PRUEBA PARA PROGETER RUTAS DE USUARIOS NO REGISTRADOS
Route::get('/editar', function(){
    return view('editar');
})->middleware('auth');

Route::get('/usuarios',function(){
    return view('usuarios');
});


Route::fallback(function () {
    return redirect()->route('welcome');
});

//EXCEL PRUEBA
Route::get('/caducos_export','App\Http\Controllers\ExcelController@export')->name('excel_prueba');
Route::get('/productos_export','App\Http\Controllers\ExcelController@export_products')->name('excel_products');

//RUTAS DE CONTROL DE CATEGORIAS
Route::get('/categorias','App\Http\Controllers\CategoryController@index')->name('index_category');

Route::get('/categoria_search','App\Http\Controllers\CategoryController@search')->name('search_category');
Route::get('/registro_categorias','App\Http\Controllers\CategoryController@pdf')->name('category_pdf');


//RUTAS PRODUCTOS
Route::get('/productos','App\Http\Controllers\ProductController@index')->name('productlist');
Route::get('/product_search','App\Http\Controllers\ProductController@search')->name('search_product');
Route::get('/productos/visualizar/{id}','App\Http\Controllers\ProductController@show')->name('show_product');
Route::post('/productos/visualizar/{id}','App\Http\Controllers\ProductController@update')->name('edit_product');
Route::get('/productos/pdf','App\Http\Controllers\AlmacenController@pdf')->name('almacenpdf');


//RUTA CADUCOS
Route::get('/dashboard/caducos_pdf','App\Http\Controllers\DashboardController@caducos_pdf')->name('caducos_pdf');

//RUTAS CARRITO
Route::get('/productos/car/add/{id}','App\Http\Controllers\ProductController@addtoCart')->name('addproduct');
Route::get('/carrito','App\Http\Controllers\ProductController@viewCart')->name('vercarrito');
Route::get('/destroy','App\Http\Controllers\ProductController@destroyCart')->name('destroycart');
Route::get('/carrito/remove/{id}','App\Http\Controllers\ProductController@removetoCart')->name('removetocart');
Route::get('/carrito/add/{id}','App\Http\Controllers\ProductController@addProductCart')->name('addproductcart');

//RUTA DE CAMAS
Route::get('/especialidades','App\Http\Controllers\EspecialidadController@index')->name('bedindex');
Route::get('/nueva_especialidad','App\Http\Controllers\EspecialidadController@crear')->name('bedregister');
Route::post('/nueva_especialidad','App\Http\Controllers\EspecialidadController@store')->name('bedstore');
Route::get('/especialidades/{id}','App\Http\Controllers\EspecialidadController@show')->name('bedshow');
Route::get('/especialidades/detalles/{id}','App\Http\Controllers\EspecialidadController@view')->name('bedview');
Route::post('/especialidades/{user}', 'App\Http\Controllers\EspecialidadController@update')->name('bededit');
Route::get('/especialidades/{id}/delete', 'App\Http\Controllers\EspecialidadController@delete')->name('beddelete');

Route::get('/camasearch','App\Http\Controllers\EspecialidadController@search')->name('searchbed');
Route::get('/especialidades_registro','App\Http\Controllers\EspecialidadController@pdf')->name('bedpdf');

//RUTA DE PACIENTES
Route::get('/pacientes','App\Http\Controllers\PatientController@index')->name('patientindex');
Route::get('/nuevo_paciente','App\Http\Controllers\PatientController@crear')->name('patientregister');
Route::post('/nuevo_paciente','App\Http\Controllers\PatientController@store')->name('patientstore');
Route::get('/pacientes/{paciente}','App\Http\Controllers\PatientController@show')->name('patientshow');
Route::post('/pacientes/{paciente}', 'App\Http\Controllers\PatientController@update')->name('patientedit');
Route::post('/pacientes/{paciente}/tutor', 'App\Http\Controllers\PatientController@updatetutor')->name('tutoredit');
Route::get('/pacientes/{id}/disable', 'App\Http\Controllers\PatientController@delete')->name('patientdisable');
Route::get('/pacientes/{id}/pdf', 'App\Http\Controllers\PatientController@pdf')->name('patientpdf');
Route::get('/pacientes/{id}/dar_alta/success', 'App\Http\Controllers\PatientController@alta')->name('dar_alta');
Route::get('/pacientes/{id}/{especialidad}/internar/success', 'App\Http\Controllers\PatientController@internar')->name('internar');
Route::get('/pacientes/{id}/reinternar/success', 'App\Http\Controllers\PatientController@reinternar')->name('reinternar');
Route::get('/paciente_search', 'App\Http\Controllers\PatientController@search')->name('search_patient');

Route::get('/registro_pacientes', 'App\Http\Controllers\PatientController@pdfall')->name('pdf_all');

//RUTA DE ORDENES
Route::get('/descargos','App\Http\Controllers\OrderController@index')->name('descargosindex');
Route::get('/orden/pdf/{id}', 'App\Http\Controllers\OrderController@pdf')->name('ordenpdf');
Route::get('/orden_descargo', 'App\Http\Controllers\OrderController@descargo')->name('ordendescargo');
Route::get('/descargos/{id}', 'App\Http\Controllers\OrderController@descargar')->name('descargar');

Route::get('/descargo_search', 'App\Http\Controllers\OrderController@search')->name('search_descargo');
Route::get('/searchpacientedescargo', 'App\Http\Controllers\OrderController@search_patient')->name('search_patient_download');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('dashboard','App\Http\Controllers\DashboardController@index')->name('dashboard');
});



Route::group(['middleware' => 'admin'], function () {
    //RUTAS DE USUARIO
    Route::get('/registro_usuario', 'App\Http\Controllers\PersonController@create')->name('createuser');
    Route::post('/registro_usuario', 'App\Http\Controllers\PersonController@store')->name('storeuser');
    Route::get('/registro_usuarios', 'App\Http\Controllers\PersonController@index')->name('userlist');
    
    Route::get('/registro_usuarios/usuario/{user}', 'App\Http\Controllers\PersonController@show')->name('usershow');
    Route::get('/registro_usuario/pdf', 'App\Http\Controllers\PersonController@pdf')->name('userspdf');
    Route::post('/registro_usuarios/usuario/{user}', 'App\Http\Controllers\PersonController@update')->name('useredit');
    Route::get('/registro_usuarios/{id}/disable', 'App\Http\Controllers\PersonController@disable')->name('userdisable');
    Route::get('/registro_usuarios/{id}/enable','App\Http\Controllers\PersonController@enable')->name('userenable');    
    Route::get('/search','App\Http\Controllers\PersonController@search')->name('searchuser');

    
});


Route::group(['middleware' => 'checkUserRole:admin,Jefe de Enfermeria'], function () {
    
    
    //RUTAS CATEGORIA
    Route::get('/nueva_categoria','App\Http\Controllers\CategoryController@create')->name('create_category');
    Route::post('/nueva_categoria','App\Http\Controllers\CategoryController@store')->name('store_category');
    
    Route::get('/categoria/{id}/visualizar','App\Http\Controllers\CategoryController@show')->name('show_category');
    Route::get('/categoria/{id}/editar','App\Http\Controllers\CategoryController@edit')->name('edit_category');
    Route::post('/categoria/{id}/editar','App\Http\Controllers\CategoryController@update')->name('update_category');
    Route::get('/categoria/{id}','App\Http\Controllers\CategoryController@delete')->name('categorydelete');

    //RUTAS PROVEEDOR
    Route::get('/proveedores','App\Http\Controllers\ProviderController@index')->name('providerlist');
    Route::get('/proveedores/registro','App\Http\Controllers\ProviderController@create')->name('providerform');
    Route::post('/proveedores/registro','App\Http\Controllers\ProviderController@store')->name('providerstore');
    Route::get('/proveedores/{provider}', 'App\Http\Controllers\ProviderController@show')->name('providershow');
    Route::get('/proveedores/detalles/{provider}', 'App\Http\Controllers\ProviderController@view')->name('providerview');
    Route::post('/proveedores/{provider}', 'App\Http\Controllers\ProviderController@update')->name('provideredit');
    Route::get('/proveedores/{provider}/disable', 'App\Http\Controllers\ProviderController@disable')->name('providerdisable');
    Route::get('/proveedores/{provider}/activate', 'App\Http\Controllers\ProviderController@active')->name('provideractive');

    Route::get('/proveedoressearch','App\Http\Controllers\ProviderController@search')->name('searchprovider');
    Route::get('/proveedores_pdf','App\Http\Controllers\ProviderController@pdf')->name('providerpdf');



    //RUTAS PRODUCTOS
    Route::get('/nuevo_producto','App\Http\Controllers\ProductController@create')->name('productcreate');
    Route::post('/nuevo_producto','App\Http\Controllers\ProductController@store')->name('productstore'); 
    Route::get('/productos/{producto}/disable','App\Http\Controllers\ProductController@disableProduct')->name('disableproduct');
    Route::get('/productos/{producto}/active','App\Http\Controllers\ProductController@activeProduct')->name('activeproduct');

    //RUTAS REPORTES Y MOVIMIENTOS
    Route::get('/stock','App\Http\Controllers\MovingController@index')->name('stock_index');
    Route::get('/stock/add/{id}','App\Http\Controllers\MovingController@add')->name('add_product_stock');
    Route::post('/stock/add/{id}','App\Http\Controllers\MovingController@saveIncrement')->name('save_increment');
    Route::get('/stock/remove/{id}','App\Http\Controllers\MovingController@decrement')->name('remove_product_stock');
    Route::post('/stock/remove/{id}','App\Http\Controllers\MovingController@saveDecrement')->name('save_decrement');
    Route::get('/reports','App\Http\Controllers\ReportsController@index')->name('report_index');
    Route::get('/reports_registro','App\Http\Controllers\MovingController@pdf')->name('movings_pdf');


});