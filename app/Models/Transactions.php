<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transaction_header';

    protected $fillable = [
        'document_code',
        'document_number',
        'user',
        'total',
        'date'
    ];

    public function details(){
        return $this->hasMany(TransactionDetails::class, 'header_id', 'id');
    }

    public function users(){
        return $this->hasMany(User::class, 'id', 'user');
    }
}
