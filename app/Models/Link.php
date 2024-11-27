<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Link extends Model
{
    use HasFactory, Searchable;
    protected $fillable = ['user_id', 'destination_url', 'short_url', 'tags', 'click_count'];


    /**
     * Specify the searchable fields.
     */
    public function toSearchableArray()
    {
        return [
            'destination_url' => $this->destination_url,
            'short_url' => $this->short_url,
            'tags' => $this->tags,
            // 'email' => $this->email,
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
