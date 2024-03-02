<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{

    public function index(){
        return view('sent-sms');
    }

    public function SendSms(Request $req){
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_NUMBER');
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
          ->create($req->number, // to
            array(
              "from" => $from,
              "body" => $req->message
            )
          );
          return redirect()->back()->with('status', $message);

    }
}
