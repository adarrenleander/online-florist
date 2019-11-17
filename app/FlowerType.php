<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlowerType extends Model
{
    public function flowers() {
        return $this->hasMany('App\Flower');
    }
}
