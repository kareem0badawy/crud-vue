<?php

use Illuminate\Database\Seeder;
use App\Car;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = new Car();
        $car->model_name = 'BMW';
        $car->color = 'black';
        $car->year_production = 2015;
        $car->save();
    }
}
