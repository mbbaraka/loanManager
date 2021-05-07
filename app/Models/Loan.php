<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public $incrementing = false;

    public function client(){
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}
