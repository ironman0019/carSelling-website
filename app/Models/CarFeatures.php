<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarFeatures extends Model
{
    
    public $timestamps = false;

    protected $primaryKey = 'car_id';
    

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

}
