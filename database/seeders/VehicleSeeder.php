<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicles')->insert([
            [
                'leased_by' => 1,
                'status' => 'leased',
                'make' => 'Toyota',
                'model' => 'Corolla',
                'engine' => '1.8L I4',
                'miles' => 12000.5,
                'color' => 'White',
                'seats' => 5,
                'transmission' => 'Automatic',
                'year' => 2021,
                'fuel_consumption' => 6.0,
                'value' => 20000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'leased_by' => null, // Explicitly set this
                'status' => 'garage',
                'make' => 'Ford',
                'model' => 'Mustang',
                'engine' => '5.0L V8',
                'miles' => 5000.2,
                'color' => 'Red',
                'seats' => 4,
                'transmission' => 'Manual',
                'year' => 2022,
                'fuel_consumption' => 10.5,
                'value' => 40000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'leased_by' => null, // Explicitly set this
                'status' => 'garage',
                'make' => 'Tesla',
                'model' => 'Model S',
                'engine' => 'Electric',
                'miles' => 1000.0,
                'color' => 'Black',
                'seats' => 5,
                'transmission' => 'Automatic',
                'year' => 2023,
                'fuel_consumption' => 0.0,
                'value' => 90000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}
