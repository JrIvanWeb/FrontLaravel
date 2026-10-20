<?php

namespace App\Services;

use App\Exceptions\FileStorageException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\DataConflictException;
use App\Interfaces\ICrudService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use RuntimeException;
use Throwable;

abstract class CrudService implements ICrudService
{
    protected string $modelClass;
    protected array $fileFields = [];

    public function getAll(): Collection
    {
        $model = $this->modelClass;

        return $model::query()->get();
    }

    public function create(array $data): Model
    {
        $model = $this->modelClass;
        $storedPaths = [];

        try {
            $data = $this->storeUploadedFiles($data, $storedPaths);

            return $model::query()->create($data);
        } catch (Throwable $exception) {
            $this->handleFailedWrite($storedPaths, $exception);
        }
    }

    public function getById(int $id): Model
    {
        $model = $this->modelClass;
        $record = $model::query()->find($id);

        if (!$record) {
            throw new ResourceNotFoundException(class_basename($model));
        }

        return $record;
    }

    public function update(int $id, array $data): Model
    {
        $record = $this->getById($id);
        $oldFiles = [];
        foreach ($this->fileFields as $field => $directory) {
            if (($data[$field] ?? null) instanceof UploadedFile) {
                $oldFiles[$field] = $record->getAttribute($field);
            }
        }

        $storedPaths = [];
        try {
            $data = $this->storeUploadedFiles($data, $storedPaths);
            $record->update($data);
        } catch (Throwable $exception) {
            $this->handleFailedWrite($storedPaths, $exception);
        }

        foreach ($oldFiles as $field => $path) {
            $this->deleteManagedFile($field, $path);
        }

        return $record->refresh();
    }

    public function delete(int $id): void
    {
        $record = $this->getById($id);
        $record->delete();

        foreach ($this->fileFields as $field => $directory) {
            $this->deleteManagedFile($field, $record->getAttribute($field));
        }
    }

    protected function storeUploadedFiles(array $data, array &$storedPaths): array
    {
        foreach ($this->fileFields as $field => $directory) {
            $file = $data[$field] ?? null;
            if (!$file instanceof UploadedFile) {
                continue;
            }

            $path = $file->store($directory, 'public');
            if (!is_string($path)) {
                throw new FileStorageException($field);
            }

            $storedPaths[] = $path;
            $data[$field] = $path;
        }

        return $data;
    }

    protected function deleteStoredPaths(array $paths): void
    {
        if ($paths !== []) {
            Storage::disk('public')->delete($paths);
        }
    }

    private function handleFailedWrite(array $storedPaths, Throwable $exception): never
    {
        $this->deleteStoredPaths($storedPaths);

        if ($exception instanceof QueryException && in_array($exception->errorInfo[0] ?? null, ['23000', '23505'], true)) {
            throw new DataConflictException(previous: $exception);
        }

        throw $exception;
    }

    protected function deleteManagedFile(string $field, mixed $path): void
    {
        $directory = $this->fileFields[$field] ?? null;
        if (is_string($directory) && is_string($path) && str_starts_with($path, $directory.'/')) {
            Storage::disk('public')->delete($path);
        }
    }
}