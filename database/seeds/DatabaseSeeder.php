<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DepartmentSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LeaveSeeder::class);
        $this->call(LeaveTypeSeeder::class);
        $this->call(ExpensesSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->call(TaskSeeder::class);
    }
}
