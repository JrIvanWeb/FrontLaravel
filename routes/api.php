<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AliadoController;
use App\Http\Controllers\CategoriaProgramaController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\GaleriaController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TipoGaleriaController;
use App\Http\Controllers\TipoDocumentoController;

Route::post('auth/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('throttle:3,1');
Route::post('auth/reset-password', [AuthController::class, 'resetPassword'])->middleware('throttle:5,1');

$contentResources = [
	'sliders' => SliderController::class,
	'programas' => ProgramaController::class,
	'categorias-programa' => CategoriaProgramaController::class,
	'nosotros' => NosotrosController::class,
	'aliados' => AliadoController::class,
	'galeria' => GaleriaController::class,
	'tipos-galeria' => TipoGaleriaController::class,
	'equipo' => EquipoController::class,
	'infos' => InfoController::class,
];

foreach ($contentResources as $resource => $controller) {
	Route::apiResource($resource, $controller)->only(['index', 'show']);
}

Route::apiResource('tipos-documento', TipoDocumentoController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
	Route::get('auth/me', [AuthController::class, 'me']);
	Route::delete('auth/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'role:Admin,Editor'])->group(function () use ($contentResources) {
	foreach ($contentResources as $resource => $controller) {
		Route::apiResource($resource, $controller)->only(['store', 'update', 'destroy']);
	}
});

Route::middleware(['auth:sanctum', 'role:Admin'])->group(function () {
	Route::apiResource('usuarios', App\Http\Controllers\UsuarioController::class);
	Route::apiResource('roles', App\Http\Controllers\RolController::class);
	Route::apiResource('tipos-documento', TipoDocumentoController::class)->only(['store', 'update', 'destroy']);
});