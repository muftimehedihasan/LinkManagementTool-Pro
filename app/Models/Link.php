<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory, Searchable;


    protected $fillable = ['destination_url', 'short_url', 'tags', 'click_count', 'user_id'];

    /**
     * Define a one-to-many relationship with ClickHistory.
     */
    public function clickHistories()
    {
        return $this->hasMany(ClickHistory::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function dailyClickCounts()
    {
        return $this->hasMany(DailyClickCount::class);
    }

}
