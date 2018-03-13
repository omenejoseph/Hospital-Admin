<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Paystack;

use Illuminate\Support\Facades\Session;
use App\Patient;
use App\Mail\paymentSuccessfulMail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
     /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $id = $request->id;
        $ref = $request->reference;

        $patient = Patient::findOrFail($id);
        if($patient->is_bill_paid == 0){
            $patient->transc_ref = $ref;
            $patient->save();
       
        // dd($id);
            return Paystack::getAuthorizationUrl()->redirectNow();
        }else{
            return view('bill.paid');
        }
        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Request $request)
    {   
        // dd($request->session()->get('id'));
        $paymentDetails = Paystack::getPaymentData();
        if($paymentDetails['status'] == true){
            $patient = Patient::where('transc_ref', $paymentDetails['data']['reference'])->first();
            // dd($paymentDetails['data']['customer']['email']);
            $patient->is_bill_paid = 1;
            $patient->transc_ref = 0;
            $patient->save();
            Mail::to($paymentDetails['data']['customer']['email'])->send(new paymentSuccessfulMail($patient));
            return view('bill.success');
        } else {
            return view('bill.fail');
        }

        
        // dd($paymentDetails);

        
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
