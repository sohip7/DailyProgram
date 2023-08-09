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
        'ooredooin',
        'jawwal',
        'jawwalin',
        'jawwalpay',
        'jawwalpayin',
        'ooredoobills',
        'ooredoobillsin',
        'electricity',
        'electricityin',
        'firstpay',
        'bop',
        'bopin',
        'bankquds',
        'bankqudsin',
        'updated_at',
        'notes',
    ];


}
