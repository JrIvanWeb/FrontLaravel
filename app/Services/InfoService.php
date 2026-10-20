<?php

namespace App\Services;

use App\Interfaces\IInfoService;
use App\Models\Info;

class InfoService extends CrudService implements IInfoService
{
    protected string $modelClass = Info::class;
    protected array $fileFields = ['Logo' => 'uploads/logos'];
}