<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClickHistory extends Model
{
    use HasFactory;

    protected $fillable = ['link_id', 'user_id', 'ip_address', 'clicked_at'];

    /**
     * Define a belongs-to relationship with Link.
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }

    /**
     * Define a belongs-to relationship with User (optional).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

// In ClickHistory.php
protected $casts = [
    'clicked_at' => 'datetime',
];



}
