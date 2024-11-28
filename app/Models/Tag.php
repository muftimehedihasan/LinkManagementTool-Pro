<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // Define the many-to-many relationship with Link
    public function links()
{
    return $this->belongsToMany(Link::class, 'link_tag', 'tag_id', 'link_id');
}

}
