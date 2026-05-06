<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'type',
        'abilities',
        'description',
        'image',
        'pokedex_number',
    ];

    protected $casts = [
        'pokedex_number' => 'integer',
    ];
}
