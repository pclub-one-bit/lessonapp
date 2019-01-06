<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item',
        'amount',
    ];
}
