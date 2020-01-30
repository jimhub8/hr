<?php

use App\models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 4) as $index) {
            Department::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 10),
                'name' => $faker->word,
                'description' => $faker->text,
            ]);
        }
    }
}
