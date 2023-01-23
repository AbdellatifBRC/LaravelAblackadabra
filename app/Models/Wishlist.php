<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id',
        'user_id'
    ];

    public function product(){
        return $this->hasMany(Product::class,'id','product_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'id','user_id');
    }
}
