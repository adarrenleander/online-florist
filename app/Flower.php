<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    // each flower can only have one flower type
    public function flowerType() {
        return $this->belongsTo('App\FlowerType');
    }

    // each flower can be included in many detail transactions
    public function detailTransactions() {
        return $this->hasMany('App\DetailTransaction');
    }

    // each flower can be included in many cart items
    public function carts() {
        return $this->hasMany('App\Cart');
    }
}
