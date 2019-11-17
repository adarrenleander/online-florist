<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    public function headerTransaction() {
        return $this->belongsTo('App\HeaderTransaction');
    }

    public function flower() {
        return $this->belongsTo('App\Flower');
    }
}
