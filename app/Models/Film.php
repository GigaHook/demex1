<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of Film
 */
class Film extends Model
{
    use HasFactory;

    /**
     * Summary of inCart
     * @return CartItem|null
     */
    public function inCart(): CartItem|null {
        return CartItem::firstWhere(['film_id' => $this->id, 'user_id' => Auth::id()]);
    }
    
}
