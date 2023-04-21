<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Film
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'censorship',
        'price',
        'premiereDate',
        'user_id',
        'quantity',
        'film_id'
    ];
}
