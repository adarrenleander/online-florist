<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    // each header transaction can only be made by one user
    public function user() {
        return $this->belongsTo('App\User');
    }

    // each header transaction can only be associated to one courier
    public function courier() {
        return $this->belongsTo('App\Courier');
    }

    // each header transaction can have many detail transactions
    public function detailTransactions() {
        return $this->hasMany('App\DetailTransaction');
    }
}
