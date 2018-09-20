<?php

use App\Customer;
use App\Itinerary;
use App\Tour;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tour::class, 5)->create()->each(function ($tour) {
            for ($i = 1; $i <= 5; $i++) {
                $tour->trips()->save(factory(Itinerary::class)->make(['day_no' => $i]));
            }
        });
        factory(Customer::class, 20)->create();
    }
}
