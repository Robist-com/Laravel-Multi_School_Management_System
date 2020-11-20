<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
class PaymentController extends Controller
{  

    function __construct()
    {
        $this->middleware('auth');
    }


    // public function payment(Request $request)
    // {
    //     $availablePlans = [
    //             'small plan' => "Monthly",
    //             'big plan' => "Yearly"
    //     ];
    //     $user = auth()->user();

    //     $data = [
    //         'intent' => $user->createSetupIntent(),
    //         'plans' =>   $availablePlans
    //     ];
    //     return view('admins.payments.index')->with($data);
    // }

    // public function subscribe(Type $var = null)
    // {
    //     $user = auth()->user();

    //     $paymentMethod = $request->payment_method;
    //     $planId = $request->plan;
    //     $user->newSubscription('main', $planId)->create($paymentMethod);

    // return response([
    //     'success_url'=> redirect()->intended('/')->getTargetUrl(),
    //     'message'=>'success'
    //     ]);


    public function payment()
    {
        $availablePlans =[
           'price_1HRohaJexbOU5vZnI7NfRFzg' => "Big Plan",
           'price_1HRoggJexbOU5vZnnNR3zPDV' => "Small Plan",
        ];
        $data = [
            'intent' => auth()->user()->createSetupIntent(),
            'plans'=> $availablePlans
        ];
        return view('admins.payments.index')->with($data);
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $paymentMethod = $request->payment_method;

        $planId = $request->plan;

        $quantity = [
            'quantity'      => 1,
            'trial_ends_at' => now()->addDays(7),
            'ends_at'       => null,
        ];
        
        $user->newSubscription('main', $planId,  $quantity)->create($paymentMethod);

        return response([
            'success_url'=> redirect(url('school/website'))->getTargetUrl(),
            'message'=>'success'
        ]);

    }
}
