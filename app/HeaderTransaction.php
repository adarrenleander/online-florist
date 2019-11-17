<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function courier() {
        return $this->belongsTo('App\Courier');
    }

    public function detailTransactions() {
        return $this->hasMany('App\DetailTransaction');
    }
}
