<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformBalance extends Model
{
    use HasFactory;

    protected $table="platformbalance";
    protected $fillable = [
        'id',
        'OoredooBalance',
        'JawwalBalance',
        'JawwalPayBalance',
        'ElectricityBalance',
        'OoredooBillsBalance',
        'BankOfPalestineBalance',
        'BankAlQudsBalance',
        'BalanceType',
        'notes',
        'created_at',
        'userName',
        'updated_By',
    ];
    public $timestamps=false;
}


