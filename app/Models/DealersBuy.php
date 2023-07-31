<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealersBuy extends Model
{
    use HasFactory;

    protected $table="dealersbuy";
    protected $fillable = [
        'id',
        'item',
        'amount',
        'SellerName',
        'notes',
        'created_at',
        'UserName',
    ];
    public $timestamps=false;
}
