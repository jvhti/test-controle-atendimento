<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::all()->each(function($employee){
           for($i = 0; $i <= 6; ++$i) {
               if(rand(0, 10) < 7) continue;
               Shift::factory()->createOne(['employee_id' => $employee->id, 'day_of_week' => $i]);
           }
        });
    }
}
