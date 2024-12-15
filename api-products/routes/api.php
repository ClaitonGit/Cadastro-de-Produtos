<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::apiResource('products', ProductController::class);


// Rotas de produtos com autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::post('products', [ProductController::class, 'store']); // Criar um novo produto
    Route::put('products/{id}', [ProductController::class, 'update']); // Atualizar um produto
    Route::delete('products/{id}', [ProductController::class, 'destroy']); // Excluir um produto
});
Route::get('products', [ProductController::class, 'index']); // Listar todos os produtos
Route::get('products/{id}', [ProductController::class, 'show']); // Exibir um único produto

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
