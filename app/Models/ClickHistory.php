<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClickHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'user_id',
        'ip_address',
        'clicked_at',
    ];

    /**
     * Get the link associated with the click history.
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }

    /**
     * Get the user associated with the click history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
