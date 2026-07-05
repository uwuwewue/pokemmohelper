<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $fillable = [
        'pokedex_number', 'name', 'type_1', 'type_2', 'image_url'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
