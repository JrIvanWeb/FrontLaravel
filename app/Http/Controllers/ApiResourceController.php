<?php

namespace App\Http\Controllers;

use App\Interfaces\ICrudService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class ApiResourceController extends Controller
{
    public function __construct(protected ICrudService $service)
    {
    }

    protected array $rules = [];

    public function index()
    {
        return $this->service->getAll();
    }

    public function store(Request $request)
    {
        $record = $this->service->create($request->validate($this->rules));

        return response()->json($record, 201);
    }

    public function show(int $id)
    {
        return $this->service->getById($id);
    }

    public function update(Request $request, int $id)
    {
        $record = $this->service->getById($id);

        return $this->service->update($id, $request->validate($this->updateRules($record)));
    }

    public function destroy(int $id)
    {
        $this->service->delete($id);

        return response()->noContent();
    }

    protected function updateRules(Model $record): array
    {
        $rules = [];

        foreach ($this->rules as $field => $fieldRules) {
            $rules[$field] = array_merge(['sometimes'], (array) $fieldRules);
        }

        return $rules;
    }
}