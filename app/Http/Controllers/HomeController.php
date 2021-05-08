<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_payment = 0;
        $count_loan = 0;
        $payments = Payment::orderBy('id', 'ASC')
        ->whereDate('created_at', '<=', Carbon::now()->addDays(30))->get();
        $loans = Loan::orderBy('loan_id', 'ASC')
        ->whereDate('created_at', '<=', Carbon::now()->addDays(30))->get();

        foreach ($payments as $payment) {
            $count_payment += $payment->amount;
        }

        foreach ($loans as $loan) {
            $count_loan += $loan->amount;
        }
        $progress = (($count_loan - $count_payment )/$count_loan)*100;
        $progress = 100 -$progress;
        return view('home', compact('count_payment', 'count_loan', 'progress'));
    }
}
