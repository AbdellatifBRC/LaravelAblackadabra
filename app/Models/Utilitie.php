<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilitie extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'banner1',
        'banner2',
        'banner3',
        'emails',
        'phones',
        'countries'
    ];

}
