<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employeeStatus = array(
            array('title' => 'Invitation send'),
            array('title' => 'Confirmed interview'),
            array('title' => 'Seggested a new time'),
            array('title' => 'Decline interview'),
        );
        DB::table('employee_interview_statuses')->insert($employeeStatus);
    }
}
