<?php

use App\models\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        App::create([
            'app_name' => $faker->company,
            'logo' => $faker->imageUrl(),
            'phone' => $faker->phoneNumber,
            'website' => $faker->url,
            'address' => $faker->address
        ]);
    }
}
