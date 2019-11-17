<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    public function headerTransactions() {
        return $this->hasMany('App\HeaderTransaction');
    }
}
