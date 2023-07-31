<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lenddata extends Model
{
    use HasFactory;


    protected $table="lenddata";
    protected $fillable = [
        'id',
        'item',
        'amount',
        'quantity',
        'notes',
        'debtorName',
        'created_at',
        'UserName',
        'total',
    ];
    public $timestamps=false;
}
