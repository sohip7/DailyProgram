<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dailydata extends Model
{
    use HasFactory;
    protected $table="dailydata";
    protected $fillable = [
        'id',
        'RecordType',
        'item',
        'amount',
        'quantity',
        'notes',
        'created_at',
        'user_name',
        'total',
    ];
    public $timestamps=false;

}
