<?php

namespace App\Services;

use App\Interfaces\ISliderService;
use App\Models\Slider;

class SliderService extends CrudService implements ISliderService
{
    protected string $modelClass = Slider::class;
    protected array $fileFields = ['Imagen' => 'uploads/sliders'];
}