<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdmissionController;
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
Route::post('admisiones', [AdmissionController::class, 'store'])->middleware('throttle:5,1');

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

Route::middleware(['auth:sanctum', 'refresh-token-expiration'])->group(function () {
	Route::get('auth/me', [AuthController::class, 'me']);
	Route::delete('auth/logout', [AuthController::class, 'logout']);
	Route::post('auth/change-password', [AuthController::class, 'changePassword'])->middleware('throttle:5,1');
});

Route::middleware(['auth:sanctum', 'role:Admin,Editor', 'refresh-token-expiration'])->group(function () use ($contentResources) {
	Route::get('admin/sliders', [SliderController::class, 'adminIndex']);
	Route::get('admin/programas', [ProgramaController::class, 'adminIndex']);
	Route::get('admin/categorias-programa', [CategoriaProgramaController::class, 'adminIndex']);
	Route::get('admin/nosotros', [NosotrosController::class, 'adminIndex']);
	Route::get('admin/equipo', [EquipoController::class, 'adminIndex']);
	Route::get('admin/aliados', [AliadoController::class, 'adminIndex']);

	foreach ($contentResources as $resource => $controller) {
		Route::apiResource($resource, $controller)->only(['store', 'update', 'destroy']);
	}
});

Route::middleware(['auth:sanctum', 'role:Admin', 'refresh-token-expiration'])->group(function () {
	Route::apiResource('usuarios', App\Http\Controllers\UsuarioController::class);
	Route::apiResource('roles', App\Http\Controllers\RolController::class);
	Route::apiResource('tipos-documento', TipoDocumentoController::class)->only(['store', 'update', 'destroy']);
});
