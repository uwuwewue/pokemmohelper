<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'team_name', 'playstyle', 'requirements', 'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
