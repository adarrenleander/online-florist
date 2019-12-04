<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // each cart item is only associated to one user
    public function user() {
        return $this->belongsTo('App\User');
    }

    // each cart item can only be of one flower
    public function flower() {
        return $this->belongsTo('App\Flower');
    }
}
