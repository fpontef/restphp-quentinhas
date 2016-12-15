<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Veio padrão:
// Route::get('/', function () {
//     return view('welcome');
//});

Route::group(array('prefix'=>'api'), function()
{
    Route::get('/', function(){
      return response()->json(['message' => 'Marmitaria API', 'status'=>'Connected']);;
    });
    
    Route::resource('cliente', 'ClienteController');
    Route::resource('empresa', 'EmpresaController');
    Route::resource('entregador', 'EntregadorController');
    Route::resource('produto', 'ProdutoController');
    Route::resource('pedido', 'PedidoController');
    
    // //Meus:
    // Route::get('busca', 'ClienteController@busca');
    // Route::get('entregador/{id}/empresa', 'EntregadorController@empresa');
    // Route::get('empresa/{id}/entregador', 'EmpresaController@entregador');
});

Route::get('/', function(){
  return redirect('api');
});
