<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'activity_text',
        'status'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
