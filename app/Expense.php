<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item',
        'amount',
        'receipt_path',
        'receipt_original_name',
        'receipt_mime',
    ];
}
