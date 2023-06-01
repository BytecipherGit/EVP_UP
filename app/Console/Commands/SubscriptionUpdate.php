<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\CompanySubscription;
use App\Models\CompanySubscriptionPayment;
use Auth;
use Carbon\Carbon;


// use Carbon\Carbon;

class SubscriptionUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // return Command::SUCCESS;
        \Log::info("Cron is working fine!");
        //     $startDate = Carbon::now();
        //     $tomorrow = Carbon::tomorrow();
        //     $unixTimestamp = $tomorrow->timestamp;
    
        
        //       $paymentSubData = CompanySubscriptionPayment::orderBy('created_at','DESC')->first();
        //       $companySubData = CompanySubscription::where('name','!=','Free')->orderBy('created_at','DESC')->first();

        //   if(!empty($companySubData) && !empty($paymentSubData)){
        //     \Log::info("Cron is working fine!");
        //       if($companySubData->end_date < Carbon::now()){
        //            $updateSubscriptionData = CompanySubscription::where('company_id',$paymentSubData->company_id)
        //               ->update([
      
        //                   'company_id' => $paymentSubData->company_id,
        //                   'razorpay_subscription_id' =>$paymentSubData->razorpay_subscription_id,
        //                   'subscription_id' =>$paymentSubData->subscription_id,
        //                   'subscription_type' => !empty($paymentSubData->subscription_type) ? $paymentSubData->subscription_type : null,
        //                   'name' => !empty($paymentSubData->name) ? $paymentSubData->name : null,
        //                   'price' => !empty($paymentSubData->payment_price) ? $paymentSubData->payment_price : null, 
        //                   'description' => !empty($paymentSubData->description) ? $paymentSubData->description : null,
        //                   'start_date' => !empty($paymentSubData->start_date) ? $paymentSubData->start_date : null,
        //                   'end_date' => !empty($paymentSubData->end_date) ? $paymentSubData->end_date : null,
        //                   'status' => '1'
                
        //             ]);
        //         }else{
        //             return false;
        //         }
        //     }else{
        //         \Log::info("Cron is working fine!");
        //     }
    }
}
