<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ['user_id', 'destination_url', 'short_url', 'tags', 'click_count'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
