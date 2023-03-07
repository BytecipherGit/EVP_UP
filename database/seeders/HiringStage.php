<?php

namespace Database\Seeders;

use App\Models\HiringStage as Hs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HiringStage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hiringStages = array(
            array('title' => 'Invited For Interview'),
            array('title' => 'Interviewed'),
            array('title' => 'Invitation To Complete Machine Task'),
            array('title' => 'Machine Task Completed'),
            array('title' => 'Feedback & Hr Policies Shared'),
            array('title' => 'Offer Sent'),
            array('title' => 'Offer Decline'),
            array('title' => 'Candidate Withdrew'),
            array('title' => 'Candidate Unresponsive'),
            array('title' => 'Rejected'),
            array('title' => 'Hired'),
        );
        DB::table('hiring_stages')->insert($hiringStages);
    }
}
