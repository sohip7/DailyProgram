<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outs extends Model
{
    use HasFactory;

    protected $table="outs";
    protected $fillable = [
        'id',
        'item',
        'amount',
        'RecordType',
        'beneficiary',
        'notes',
        'created_at',
        'userName',
    ];
    public $timestamps=false;
}
