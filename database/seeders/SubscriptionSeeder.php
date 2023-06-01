<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Razorpay\Api\Api;

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
            'name' => 'Free',
            'type' => 'Free',
            'price' => '0',
            'description' =>'Free subcription',
            'duration'=>'7',
            'status'=>'1'
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $plan_id = $api->plan->create(array('period' => 'monthly', 'interval' => 1, 'item' => array('name' => 'Monthly test', 
        'description' => 'Description for monthly plan of 28 days','amount' => 120, 'currency' => 'INR'),'notes'=> array('key1'=> 'Monthly','key2'=> 'value2')));

        Subscription::create([
            'name' => 'Monthly',
            'type' => 'Monthly',
            'price' => '120',
            'plan_id' => $plan_id->id,
            'description' =>'Monthly subcription',
            'duration'=>'28',
            'status'=>'1'
        ]);

        $plan_id_yearly = $api->plan->create(array('period' => 'yearly', 'interval' => 1, 'item' => array('name' => 'Yearly test', 
        'description' => 'Description for yearly plan of 336 days','amount' => 1300, 'currency' => 'INR'),'notes'=> array('key1'=> 'Yearly','key2'=> 'value2')));

        Subscription::create([
            'name' => 'Yearly',
            'type' => 'Yearly',
            'price' => '1300',
            'plan_id' => $plan_id_yearly->id,
            'description' =>'Yearly subcription',
            'duration'=>'336',
            'status'=>'1'
        ]);
  
    }

}
