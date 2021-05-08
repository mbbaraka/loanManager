<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function client(){
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function loan(){
        return $this->belongsTo(Loan::class, 'loan_id', 'loan_id');
    }
}
