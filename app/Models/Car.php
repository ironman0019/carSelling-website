<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes, HasFactory;

    public function carType(): BelongsTo
    {
        return $this->belongsTo(CarType::class);
    }


    public function fuelType(): BelongsTo
    {
        return $this->belongsTo(FuelType::class);
    }


    public function maker(): BelongsTo
    {
        return $this->belongsTo(Maker::class);
    }


    public function model(): BelongsTo
    {
        return $this->belongsTo(ModelsModel::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }



    public function carFeatures(): HasOne
    {
        return $this->hasOne(CarFeatures::class);
    }


    public function primaryImage(): HasOne
    {
        return $this->hasOne(CarImage::class)->oldestOfMany('position');
    }


    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }


    public function favouredUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorite_cars');
    }
    
}
