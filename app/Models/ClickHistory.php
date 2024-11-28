<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClickHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id', 'ip_address', 'clicked_at'
    ];

    // Define the relationship to the Link model
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
