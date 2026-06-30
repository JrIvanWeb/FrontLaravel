<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\IEstudianteService;
use App\Services\EstudianteService;
use App\Interfaces\IProfesorService;
use App\Services\ProfesorService;
use App\Interfaces\ICursoService;
use App\Services\CursoService;
use App\Interfaces\IAsignaturaService;
use App\Services\AsignaturaService;
use App\Repositories\Interfaces\IEstudianteRepository;
use App\Repositories\Implementations\EstudianteRepository;
use App\Repositories\Interfaces\IProfesorRepository;
use App\Repositories\Implementations\ProfesorRepository;
use App\Repositories\Interfaces\ICursoRepository;
use App\Repositories\Implementations\CursoRepository;
use App\Repositories\Interfaces\IAsignaturaRepository;
use App\Repositories\Implementations\AsignaturaRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
     // Servicio
        $this->app->bind(
            IEstudianteService::class,
            EstudianteService::class
        );
        $this->app->bind(
            IProfesorService::class,
            ProfesorService::class
        );
        $this->app->bind(
            ICursoService::class,
            CursoService::class
        );
        $this->app->bind(
            IAsignaturaService::class,
            AsignaturaService::class
        );

        // Repositorio
        $this->app->bind(
           IEstudianteRepository::class,
           EstudianteRepository::class
        );
        $this->app->bind(
           IProfesorRepository::class,
           ProfesorRepository::class
        );
        $this->app->bind(
           ICursoRepository::class,
           CursoRepository::class
        );
        $this->app->bind(
           IAsignaturaRepository::class,
           AsignaturaRepository::class
        );
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
