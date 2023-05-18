<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Exception;

class PaymentController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {        
        return view('admin.payment.razorpay_view');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function store(Request $request)
    // {
    //     $input = $request->all();
  
    //     $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
  
    //     $payment = $api->payment->fetch($input['razorpay_payment_id']);
  
    //     if(count($input)  && !empty($input['razorpay_payment_id'])) {
    //         try {
    //             $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
  
    //         } catch (Exception $e) {
    //             return  $e->getMessage();
    //             Session::put('error',$e->getMessage());
    //             return redirect()->back();
    //         }
    //     }
          
    //     Session::put('success', 'Payment successful');
    //     return redirect()->back();
    // }

    public function razorPaySuccess(Request $request)
    {
    dd($request->all());
        $session_id=Session::getId();
        if(Auth::check()){
            $user_id=Auth::id();   
        }
         else{
            $user_id=Session::getId();
            Session::put('user_id', $user_id);  
         } 
         
         $data1 = DB::table("carts")
         ->select("carts.product_id")
         ->where('carts.user_id',$request->user_id)
         ->get();

         $product[]= $data1;  
        // print_r($data1);die();

         $data = [
                   'user_id' => $user_id,
                   'product_id' => json_encode($data1),
                   'r_payment_id' => $request->payment_id,
                   'amount' => $request->amount,
                   'payment_type' => $request->payment_type,
                   'payment_status' => 'Processing',
                ];
 
        $proname = DB::table("carts")->join('products', 'carts.product_id', '=', 'products.id')
                ->select("products.title")
                ->where('carts.user_id',$request->user_id)
                ->get();
       
          $productname[]= $proname;  
         $order = [
          'user_id' => $user_id,
          'payment_id' => $request->payment_id,
         //  'name' =>  json_encode($proname),
          'amount' => $request->amount,
          'status' => 'Processing',

       ];

       $dataqty = DB::table("carts")
         ->select("carts.qty")
         ->where('carts.user_id',$request->user_id)
         ->get();

         $dataqty1[]= $dataqty;  

        //  $datatitle = DB::table("products")
        //  ->select("products.title")
        //  ->where('products.user_id',$request->user_id)
        //  ->get();

        //  $datatitles[]= $datatitle;  

       $orderitem = [
         'user_id' => $user_id,
          'order_id' => 2,
         'product_id' => json_encode($data1),
         'title' => $request->name,
         'amount' => $request->amount,
         'qty' =>  json_encode($dataqty),
      ];

      //  print_r($orderitem);die();
       $getId = Payment::insertGetId($data);  
       $getoId = Order::insertGetId($order);  
       $orderitems = Orderitem::insertGetId($orderitem);  

        $userid=$request->user_id;
        $product=DB::table('carts')->join('products', 'carts.product_id', '=', 'products.id')->select('carts.*', 'products.*')->where('carts.user_id',$userid)->get();
        $producttotal=DB::table('carts')->join('products', 'carts.product_id', '=', 'products.id')->select('carts.*', 'products.*')->where('carts.user_id',$userid)->first();
        $profile= DB::table('userprofiles')->join('payments', 'userprofiles.user_id', '=', 'payments.user_id')->select('userprofiles.*', 'payments.*')->where('userprofiles.user_id',$userid )->first();
        //  $arr = array('msg' => 'Payment successfully credited', 'status' => true);
       
        // session()->flush();
      //   Auth::logout();
        return view('user/thankyou',compact('profile','product','producttotal'));
     }

}


