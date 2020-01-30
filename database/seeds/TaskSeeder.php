<?php

use App\models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
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
            Task::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 10),
                'end_date' => $faker->dateTime(),
                'start_date' => $faker->dateTime(),
                'reminder_date' => $faker->dateTime(),
                'priority' => $faker->numberBetween($min = 1, $max = 5),
                'status' => $faker->word,
                'description' => $faker->text,
            ]);
        }
    }
}
