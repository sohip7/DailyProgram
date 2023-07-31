<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPay extends Model
{
    use HasFactory;

    protected $table="customerpay";
    protected $fillable = [
        'id',
        'CustomerName',
        'amount',
        'notes',
        'created_at',
        'userName',
    ];
    public $timestamps=false;
}
