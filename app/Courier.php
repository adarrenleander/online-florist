<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    // one courier can be involved in many header transactions
    public function headerTransactions() {
        return $this->hasMany('App\HeaderTransaction');
    }
}
