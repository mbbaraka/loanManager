<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public $incrementing = false;

    protected $primaryKey = 'loan_id';

    protected $keyType = 'string';

    public function client(){
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function payment(){
        return $this->hasMany(Payment::class, 'loan_id');
    }
}
