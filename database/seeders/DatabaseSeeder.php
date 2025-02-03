<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Database\Factories\CarFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create car types
        CarType::factory()->sequence([])->count(5)->create();

        // Create fuel types
        FuelType::factory()->sequence([])->count(5)->create();

        // Create states with cities
        $states = [
            'California' => ['Los Angeles', 'San Diego', 'San Francisco'],
            'Texas' => ['Houston', 'Dallas', 'Austin'],
            'Florida' => ['Miami', 'Orlando', 'Tampa'],
            'New York' => ['New York City', 'Buffalo', 'Rochester']
        ];

        foreach($states as $state => $cities) {
            State::factory()->state(['name' => $state])
                ->has(
                    City::factory()
                    ->count(count($cities))
                    ->sequence(...array_map(fn($city) => ['name' => $city], $cities))
                )
                ->create();
        }

        // Create makers with their corresponding models
        $makers = [
            'Toyota' => ['Camry', 'Corolla', 'RAV4'],
            'Lexus' => ['RX400', 'RX350', 'NX200'],
            'BMW' => ['M5', 'I8', 'X6'],
            'Honda' => ['Civic', 'Accord', 'CR-V']
        ];

        foreach($makers as $maker => $models) {
            Maker::factory()->state(['name' => $maker])
            ->has(
                Model::factory()
                ->count(count($models))
                ->sequence(...array_map(fn($model) => ['name' => $model], $models))
            )
            ->create();
        }


        // Create users, cars with images and features
        // Create 3 users first, then create 2 more users,
        // and for each user (from the last 2 users) create 50 cars,
        // with images and features and add these cars to favourite cars
        // of these 2 users.

        User::factory()->count(3)->create();

        User::factory()->count(2)
            ->has(
                Car::factory()
                ->count(50)
                ->has(
                    CarImage::factory()
                    ->count(5)
                    ->sequence(fn(Sequence $sequence) => ['position' => $sequence->index % 5 + 1]),
                    // ->sequence(['position' => 1], ['position' => 2], ['position' => 3], ['position' => 4], ['position' => 5])
                    'images'
                )
                ->hasCarFeatures(),
                'favouriteCars'
            )
        ->create();


    }
}