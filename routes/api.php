<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\EstudianteController;

Route::apiResource('asignaturas', AsignaturaController::class);
Route::apiResource('cursos', CursoController::class);
Route::apiResource('profesores', ProfesorController::class);
Route::apiResource('estudiantes', EstudianteController::class);