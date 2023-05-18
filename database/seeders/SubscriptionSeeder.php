<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::create([
            'user_id' => '1',
            'name' => 'Free',
            'type' => 'Free',
            'price' => '0',
            'description' =>'Free subcription',
            'duration'=>'7',
            'status'=>'1'
        ]);
        Subscription::create([
            'user_id' => '1',
            'name' => 'Monthly',
            'type' => 'Monthly',
            'price' => '120',
            'description' =>'Monthly subcription',
            'duration'=>'28',
            'status'=>'1'
        ]);
        Subscription::create([
            'user_id' => '1',
            'name' => 'Yearly',
            'type' => 'Yearly',
            'price' => '340',
            'description' =>'Yearly subcription',
            'duration'=>'336',
            'status'=>'1'
        ]);
    }
}
