<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return view('panel.index');

});

//Route::resource('/productos', ProductoController::class)->names('producto');

Route::group(['middleware' => ['can:lista_productos']], function () {
    Route::resource('/productos', ProductoController::class)->names('producto');
});
