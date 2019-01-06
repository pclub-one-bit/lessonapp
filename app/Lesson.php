<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'lesson_datetime',
        'body',
        'evaluation',
        'total_participant',
        'total_revenue',
        'total_expense',
        'total_budget',
    ];

    /**
     * 参加者
     */
    public function participants()
    {
        return $this->hasMany('App\Participant');
    }

    /**
     * 収入
     */
    public function revenues()
    {
        return $this->hasMany('App\Revenue');
    }

    /**
     * 費用
     */
    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }
}
