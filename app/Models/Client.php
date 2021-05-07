<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $incrementing = false;

    public function loan(){
        return $this->hasMany(Loan::class, 'client_id');
    }
}
