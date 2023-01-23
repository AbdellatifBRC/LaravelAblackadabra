<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillabale = [
        'order_id',
        'qty',
        'base_price',
        'base_total',
        'tax_amount',
        'tax_percent',
        'discount_amount',
        'discount_percent',
        'sub_total',
        'name',
        'weight',
        'product_id'
    ];

     /**
	 * Define relationship with the Product
	 *
	 * @return void
	 */
	public function product()
	{
		return $this->belongsTo(Product::class);
	}
    public function order(){
        return $this->belongsTo(OrderSimple::class);
    }
}
