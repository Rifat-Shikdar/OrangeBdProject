<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
// Route::get('products',function(){
//     // return ('this is products');

// });
Route::get('products', [ProductController::class,'index']);
Route::post('products', [ProductController::class,'create']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::get('products/{id}/edit',[ProductController::class,'edit']);
Route::put('products/{id}/edit',[ProductController::class,'update']);
Route::delete('products/{id}/delete',[ProductController::class,'delete']);
Route::get('products/search/{name}', [ProductController::class, 'search']);




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
