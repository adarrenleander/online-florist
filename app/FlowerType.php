<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowerType extends Model
{
    // each flower type can be associated to many flowers
    public function flowers() {
        return $this->hasMany('App\Flower');
    }
}
