<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    // many detail transactions may only be associated with only one header transaction
    public function headerTransaction() {
        return $this->belongsTo('App\HeaderTransaction');
    }

    // each detail transaction can only be associated with one flower
    public function flower() {
        return $this->belongsTo('App\Flower');
    }
}
