<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("/departamento/listar", "DepartamentoController@indexdepartamento");
Route::get("/departamento/getInfo", "DepartamentoController@infodepartamento");
Route::get("/departamento/crear", "DepartamentoController@creardepartamento");
//Route::post("/departamento/crear", "DepartamentoController@creardepartamento");
Route::get("/departamento/editar", "DepartamentoController@editardepartamento");
//Route::put("/departamento/editar", "DepartamentoController@editardepartamento");
Route::get("/departamento/eliminar", "DepartamentoController@eliminardepartamento");
//Route::put("/departamento/eliminar", "DepartamentoController@eliminardepartamento");

Route::get("/tablas/listar", "TablasController@indextablas");
Route::get("/tablas/getInfo", "TablasController@infotablas");
Route::get("/tablas/crear", "TablasController@creartablas");
//Route::post("/tablas/crear", "TablasController@creartablas");
Route::get("/tablas/editar", "TablasController@editartablas");
//Route::put("/tablas/editar", "TablasController@editartablas");
Route::get("/tablas/eliminar", "TablasController@eliminartablas");
//Route::put("/tablas/eliminar", "TablasController@eliminartablas");
