<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    public function flowerTypes() {
        return $this->belongsTo('App\FlowerType');
    }

    public function detailTransactions() {
        return $this->hasMany('App\DetailTransaction');
    }
}
