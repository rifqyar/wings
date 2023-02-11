<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whishlists extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id');
    }

    public function product(){
        return $this->hasMany(Products::class, 'id', 'product_id');
    }
}
