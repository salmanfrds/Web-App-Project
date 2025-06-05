<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $primaryKey = 'activity_id';
    protected $fillable = [
        'user_id',
        'description',
        'title',
        'start_date',
        'end_date',
        'status',
        'category',
    ];
}
