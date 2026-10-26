<?php

namespace App\Http\Controllers;

use App\Interfaces\ISliderService;
use App\Models\Slider;
use Illuminate\Database\Eloquent\Collection;

class SliderController extends ApiResourceController
{
    public function __construct(ISliderService $service)
    {
        parent::__construct($service);
    }

    public function index(): Collection
    {
        return Slider::query()
            ->where('Estado', true)
            ->orderBy('Id')
            ->get(['Id', 'Imagen', 'Nombre', 'Url']);
    }

    public function adminIndex(): Collection
    {
        return Slider::query()->orderBy('Id')->get();
    }

    protected array $rules = [
        'Imagen' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        'Nombre' => ['required', 'string', 'max:255'],
        'Url' => ['required', 'string', 'max:2048'],
        'Estado' => ['required', 'boolean'],
    ];
}