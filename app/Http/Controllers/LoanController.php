<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Loan;
use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::get();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $client = Client::where('client_id', $id)->first();
        return view('loans.create', compact('id', 'client'));
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
            'amount' => 'required',
            'interest' => 'required|max:10',
            'guarantor_names'=> 'required',
            'guarantor_phone'=> 'required'

        ]);

        $loan = new Loan();
        $loan->loan_id = 'LN-'.rand(1000,9999);
        $loan->client_id = $request->client_id;
        $loan->amount = $request->amount;
        $loan->interest = $request->interest;
        $loan->security = $request->security;
        $loan->period = $request->period;
        $loan->payments = $request->payment;
        $loan->guarantor_one_name = $request->guarantor_names;
        $loan->guarantor_one_phone = $request->guarantor_phone;

        $save = $loan->save();

        if ($save) {
            //get client details
            $client = Client::where('client_id', $request->client_id)->first();

            $message = "You have secured a loan of UGX ".number_format($request->amount)." from Canan Credits at an interest of 15% and the loan is to be paid in ". $request->period . " days.\n Thank You!";

            $AT       = new AfricasTalking(env('SMS_USERNAME'), env('SMS_API'));

            $sms      = $AT->sms();
            // Use the service
            $result   = $sms->send([
            'to'      => $client->phone,
            'message' => $message,
            ]);
            return redirect()->route('loans-index')->with('message', 'Successfully added loan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function delete($loan)
    {
        $loans = Loan::where('loan_id', $loan)->first();
        if ($loans->delete()) {
            return redirect()->back()->with('message', 'Loan Details successfully deleted');
        }
    }
}
