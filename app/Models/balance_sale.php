<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class balance_sale extends Model
{
    use HasFactory;

    protected $table="balance_sales";
    protected $fillable = [
        'id',
        'ooredoo',
        'jawwal',
        'jawwalpay',
        'ooredoobills',
        'electricity',
        'firstpay',
        'bop',
        'bankquds',
        'updated_at',
    ];


}
