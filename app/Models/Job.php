<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'stage_id',
        'title',
        'url',
        'salary',
        'location',
        'description',
    ];

    public function stage() {
        return $this->belongsTo(Job::class);
    }
}
