<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::get();
        return view('payments.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($clientt, $loan)
    {
        $client = Client::where('client_id', $clientt)->first();
        $last_payment = Payment::orderBy('id', 'DESC')->where('client_id', $clientt)->where('loan_id', $loan)->first();
        if($last_payment != NULL){
            $balance = $last_payment->balance;
        }else{
            $balance = Loan::where('loan_id', $loan)->first()->amount;
        }
        return view('payments.create', compact('client', 'loan', 'clientt', 'balance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required'

        ]);
        $payment = new Payment();
        $payment->loan_id = $request->loan_id;
        $payment->client_id = $request->client_id;
        $payment->amount = $request->amount;

        $balance = str_replace('UGX', '', $request->final_balance);
        $balance = intval(str_replace(',', '', $balance));

        $payment->balance = $balance;

        $save = $payment->save();

        if ($save) {

            //get client details
            $client = Client::where('client_id', $request->client_id)->first();

            $message = "Successfully made payment of UGX ".number_format($request->amount)." for ". $client->first_name." ".$client->last_name . " and balance is UGX ".number_format($balance);

            $AT       = new AfricasTalking(env('SMS_USERNAME'), env('SMS_API'));

            $sms      = $AT->sms();
            // Use the service
            $result   = $sms->send([
            'to'      => $client->phone,
            'message' => $message,
            ]);

            return redirect()->back()->with('message', $message);
        }


        // intval(str_replace(',', '', $request->balance))
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
