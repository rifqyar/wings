<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_id',
        'document_code',
        'document_number',
        'product_code',
        'price',
        'quantity',
        'unit',
        'sub_total',
        'currency'
    ];

    public function product(){
        return $this->hasMany(Products::class, 'product_code', 'product_code');
    }
}
