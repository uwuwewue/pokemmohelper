<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserShiny extends Model
{
    protected $fillable = [
        'pokemon_name', 'nature', 'hp_iv', 'attack_iv', 'defense_iv', 'sp_attack_iv', 'sp_defense_iv', 'speed_iv', 'encounters', 'catch_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIvColor($value)
    {
        if ($value === 31) {
            return 'text-success';
        } 
        elseif ($value === 0){
            return 'text-danger';
        } 
        else {
            return 'text-poke-light';
        }
    }
}
