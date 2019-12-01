<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    public function flowerType() {
        return $this->belongsTo('App\FlowerType');
    }

    public function detailTransactions() {
        return $this->hasMany('App\DetailTransaction');
    }

    public function carts() {
        return $this->hasMany('App\Cart');
    }
}
