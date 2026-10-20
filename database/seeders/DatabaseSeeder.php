<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Rol::query()->firstOrCreate(['Nombre' => 'Admin']);
        Rol::query()->firstOrCreate(['Nombre' => 'Editor']);
    }
}
