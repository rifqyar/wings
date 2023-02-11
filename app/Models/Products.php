<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'product_name',
        'price',
        'currency',
        'discount',
        'dimension',
        'unit'
    ];

    public function whishlists(){
        return $this->hasMany(Whishlists::class,'product_id');
    }
}
