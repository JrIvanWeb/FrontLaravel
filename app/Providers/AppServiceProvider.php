<?php

namespace App\Providers;

use App\Interfaces\IAliadoService;
use App\Interfaces\ICategoriaProgramaService;
use App\Interfaces\IEquipoService;
use App\Interfaces\IGaleriaService;
use App\Interfaces\IInfoService;
use App\Interfaces\INosotrosService;
use App\Interfaces\IProgramaService;
use App\Interfaces\IRolService;
use App\Interfaces\ISliderService;
use App\Interfaces\ITipoGaleriaService;
use App\Interfaces\ITipoDocumentoService;
use App\Interfaces\IUsuarioService;
use App\Interfaces\IPasswordResetService;
use App\Services\AliadoService;
use App\Services\CategoriaProgramaService;
use App\Services\EquipoService;
use App\Services\GaleriaService;
use App\Services\InfoService;
use App\Services\NosotrosService;
use App\Services\ProgramaService;
use App\Services\RolService;
use App\Services\SliderService;
use App\Services\TipoGaleriaService;
use App\Services\TipoDocumentoService;
use App\Services\UsuarioService;
use App\Services\PasswordResetService;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->app->bind(ISliderService::class, SliderService::class);
		$this->app->bind(IProgramaService::class, ProgramaService::class);
		$this->app->bind(ICategoriaProgramaService::class, CategoriaProgramaService::class);
		$this->app->bind(INosotrosService::class, NosotrosService::class);
		$this->app->bind(IAliadoService::class, AliadoService::class);
		$this->app->bind(IGaleriaService::class, GaleriaService::class);
		$this->app->bind(ITipoGaleriaService::class, TipoGaleriaService::class);
		$this->app->bind(ITipoDocumentoService::class, TipoDocumentoService::class);
		$this->app->bind(IEquipoService::class, EquipoService::class);
		$this->app->bind(IInfoService::class, InfoService::class);
		$this->app->bind(IUsuarioService::class, UsuarioService::class);
		$this->app->bind(IPasswordResetService::class, PasswordResetService::class);
		$this->app->bind(IRolService::class, RolService::class);
	}

	public function boot(): void
	{
		Sanctum::authenticateAccessTokensUsing(
			static function (PersonalAccessToken $token, bool $isValid): bool {
				$lastActivity = $token->last_used_at ?? $token->created_at;

				return $isValid
					&& $lastActivity->gt(now()->subMinutes((int) config('session.lifetime')));
			}
		);
	}
}
