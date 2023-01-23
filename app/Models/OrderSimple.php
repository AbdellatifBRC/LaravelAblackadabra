<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSimple extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'order_simples';

    public const ORDERCODE = 'INV';

    public const PAID = 'paid';
	public const UNPAID = 'unpaid';

	public const CREATED = 'created';
	public const CONFIRMED = 'confirmed';
	public const DELIVERED = 'delivered';
	public const COMPLETED = 'completed';
	public const CANCELLED = 'cancelled';

	public const STATUSES = [
		self::CREATED => 'Created',
		self::CONFIRMED => 'Confirmed',
		self::DELIVERED => 'Delivered',
		self::COMPLETED => 'Completed',
		self::CANCELLED => 'Cancelled',
	];

    protected $fillable = [
        'user_id',
        'fullname',
        'province',
        'city',
        'shippingService',
        'address',
        'address2',
        'postcode',
        'phone',
        'email',
        'notes',
        'grand_total'
    ];


    public function orderItems()
	{
		return $this->hasMany(OrderItem::class , 'order_id', 'id');
    }
    public function grandTotal()
    {
        $orderProducts = $this->orderItems;
        $some=0;
        foreach ($orderProducts as $item) {
            $some = $some + ($item->base_total);
        }
        return $some;
    }

	public function shipment(){
		return $this->hasOne(Shipment::class);
	}

	public function isPaid()
	{
		return $this->payment_status == self::PAID;
	}

	public function isCreated()
	{
		return $this->status == self::CREATED;
	}

	public function isConfirmed()
	{
		return $this->status == self::CONFIRMED;
	}

	public function isDelivered()
	{
		return $this->status == self::DELIVERED;
	}

	public function isCancelled(){
		return $this->status == self::CANCELLED ;
	}
}
