<?php
// app/Models/DailyClickCount.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyClickCount extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id', 'click_date', 'click_count',
    ];

    /**
     * Define the relationship with the Link model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function link()
    {
        return $this->belongsTo(Link::class);
    }
}
