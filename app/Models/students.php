<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;


    public function courses()
    {
        return $this->belongsTo(course::class, 'course');

    }
}
