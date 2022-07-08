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

////////

Route::get("/capital/listar", "CapitalController@indexcapital");
Route::get("/capital/getInfo", "CapitalController@infocapital");
Route::get("/capital/crear", "CapitalController@crearcapital");
//Route::post("/capital/crear", "CapitalController@crearcapital");
Route::get("/capital/editar", "CapitalController@editarcapital");
//Route::put("/capital/editar", "CapitalController@editarCapital");
Route::get("/capital/eliminar", "CapitalController@eliminarcapital");
//Route::put("/capital/eliminar", "CapitalController@eliminarcapital");

Route::get("/clima/listar", "ClimaController@indexclima");
Route::get("/clima/getInfo", "ClimaController@infoclima");
Route::get("/clima/crear", "ClimaController@crearclima");
//Route::post("/clima/crear", "ClimaController@crearclima");
Route::get("/clima/editar", "ClimaController@editarclima");
//Route::put("/clima/editar", "ClimaController@editarclima");
Route::get("/clima/eliminar", "ClimaController@eliminarclima");
//Route::put("/clima/eliminar", "ClimaController@eliminarclima");

Route::get("/comida/listar", "ComidaController@indexcomida");
Route::get("/comida/getInfo", "ComidaController@infocomida");
Route::get("/comida/crear", "ComidaController@crearcomida");
//Route::post("/comida/crear", "ComidaController@crearcomida");
Route::get("/comida/editar", "ComidaController@editarcomida");
//Route::put("/comida/editar", "ComidaController@editarcomida");
Route::get("/comida/eliminar", "ComidaController@eliminarcomida");
//Route::put("/comida/eliminar", "ComidaController@eliminarcomida");

Route::get("/economia/listar", "EconomiaController@indexeconomia");
Route::get("/economia/getInfo", "EconomiaController@infoeconomia");
Route::get("/economia/crear", "EconomiaController@creareconomia");
//Route::post("/economia/crear", "EconomiaController@creareconomia");
Route::get("/economia/editar", "EconomiaController@editareconomia");
//Route::put("/economia/editar", "EconomiaController@editareconomia");
Route::get("/economia/eliminar", "EconomiaController@eliminareconomia");
//Route::put("/economia/eliminar", "EconomiaController@eliminareconomia");

Route::get("/baile/listar", "BaileController@indexbaile");
Route::get("/baile/getInfo", "BaileController@infobaile");
Route::get("/baile/crear", "BaileController@crearbaile");
//Route::post("/baile/crear", "BaileController@crearbaile");
Route::get("/baile/editar", "BaileController@editarbaile");
//Route::put("/baile/editar", "BaileController@editarbaile");
Route::get("/baile/eliminar", "BaileController@eliminarbaile");
//Route::put("/baile/eliminar", "BaileController@eliminarbaile");

Route::get("/hidrografia/listar", "HidrografiaController@indexhidrografia");
Route::get("/hidrografia/getInfo", "HidrografiaController@infohidrografia");
Route::get("/hidrografia/crear", "HidrografiaController@crearhidrografia");
//Route::post("/hidrografia/crear", "HidrografiaController@crearhidrografia");
Route::get("/hidrografia/editar", "HidrografiaController@editarhidrografia");
//Route::put("/hidrografia/editar", "HidrografiaController@editarhidrografia");
Route::get("/hidrografia/eliminar", "HidrografiaController@eliminarhidrografia");
//Route::put("/hidrografia/eliminar", "HidrografiaController@eliminarhidrografia");

Route::get("/relieve/listar", "RelieveController@indexrelieve");
Route::get("/relieve/getInfo", "RelieveController@inforelieve");
Route::get("/relieve/crear", "RelieveController@crearrelieve");
//Route::post("/relieve/crear", "RelieveController@crearrelieve");
Route::get("/relieve/editar", "RelieveController@editarrelieve");
//Route::put("/relieve/editar", "RelieveController@editarrelieve");
Route::get("/relieve/eliminar", "RelieveController@eliminarrelieve");
//Route::put("/relieve/eliminar", "RelieveController@eliminarrelieve");

//Route::post("/salas/crear", "SalasController@crearsalas");
//
Route::get("/salas/crear", "SalasController@crearsalas");
Route::put("/salas/editar", "SalasController@editarsalas");
Route::get("/salas/validar", "SalasController@validarsalas");
Route::get("/salas/getInfo", "SalasController@infosalas");
