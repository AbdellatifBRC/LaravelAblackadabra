<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\OrderItem;
use App\Models\OrderSimple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Midtrans\Snap;

class OrderController extends Controller
{
	public function arprocess()
	{
        return view('frontend.order.checkout');
    }
    public function process()
	{
        return view('Arfrontend.order.checkout');
    }

    private function getSelectedShipping($destination, $totalWeight, $shippingService)
	{
		$shippingOptions = $this->getShippingCost($destination, $totalWeight);

		$selectedShipping = null;
		if ($shippingOptions['results']) {
			foreach ($shippingOptions['results'] as $shippingOption) {
				if (str_replace(' ', '', $shippingOption['service']) == $shippingService) {
					$selectedShipping = $shippingOption;
					break;
				}
			}
		}

		return $selectedShipping;
	}

    public function checkout(Request $request){
        $params = $request->except('_token');

		$order = \DB::transaction(function() use ($params) {
			$destination = $params['city'];
			$items = \Cart::getContent();

			$totalWeight = 0;
			foreach ($items as $item) {
				$totalWeight += ($item->quantity * $item->associatedModel->weight);
			}

			$selectedShipping = $this->getSelectedShipping($destination,$totalWeight, $params['shippingService']);

			$baseTotalPrice = \Cart::getSubTotal();
			$shippingCost = $selectedShipping['cost'];
			$discountAmount = 0;
			$discountPercent = 0;
			$grandTotal = ($baseTotalPrice + $shippingCost) - $discountAmount;

			$orderDate = date('Y-m-d H:i:s');
			$paymentDue = (new \DateTime($orderDate))->modify('+3 day')->format('Y-m-d H:i:s');

			$user_profile = [
				'username' => $params['fullName'],
				'address' => $params['address'],
				'address2' => $params['address2'],
				'province_id' => $params['province'],
				'city_id' => $params['city'],
				'postcode' => $params['postcode'],
				'phone' => $params['phone'],
				'email' => $params['email'],
			];

			auth()->user()->update($user_profile);

			$orderParams = [
				'user_id' => auth()->id(),
				'code' => Order::generateCode(),
				'status' => Order::CREATED,
				'order_date' => $orderDate,
				'payment_due' => $paymentDue,
				'payment_status' => Order::UNPAID,
				'base_total_price' => $baseTotalPrice,
				'discount_amount' => $discountAmount,
				'discount_percent' => $discountPercent,
				'shipping_cost' => $shippingCost,
				'grand_total' => $grandTotal,
				'customer_first_name' => $params['fullName'],
				'customer_address' => $params['address'],
				'customer_address2' => $params['address2'],
				'customer_phone' => $params['phone'],
				'customer_email' => $params['email'],
				'customer_city_id' => $params['city'],
				'customer_province_id' => $params['province'],
				'customer_postcode' => $params['postcode'],
				'notes' => $params['notes'],
				'shipping_courier' => $selectedShipping['courier'],
				'shipping_service_name' => $selectedShipping['service'],
			];

			$order = Order::create($orderParams);

			$cartItems = \Cart::getContent();

			if ($order && $cartItems) {
				foreach ($cartItems as $item) {
					$itemDiscountAmount = 0;
					$itemDiscountPercent = 0;
					$itemBaseTotal = $item->quantity * $item->price;
					$itemSubTotal = $itemBaseTotal - $itemDiscountAmount;

					$product = $item->associatedModel;

					$orderItemParams = [
						'order_id' => $order->id,
						'product_id' => $item->associatedModel->id,
						'qty' => $item->quantity,
						'base_price' => $item->price,
						'base_total' => $itemBaseTotal,
						'discount_amount' => $itemDiscountAmount,
						'discount_percent' => $itemDiscountPercent,
						'sub_total' => $itemSubTotal,
						'name' => $item->name,
						'weight' => $item->associatedModel->weight,
					];

					$orderItem = OrderItem::create($orderItemParams);

					if ($orderItem) {
						$product = Product::findOrFail($product->id);
						$product->quantity -= $item->quantity;
						$product->save();
					}
				}
			}

			$shippingFirstName = $params['fullName'];
			$shippingAddress1 = $params['address'];
			$shippingAddress2 = $params['address2'];
			$shippingPhone = $params['phone'];
			$shippingEmail = $params['email'];
			$shippingCityId = $params['city'];
			$shippingProvinceId = $params['province'];
			$shippingPostcode = $params['postcode'];

			$shipmentParams = [
				'user_id' => auth()->id(),
				'order_id' => $order->id,
				'status' => Shipment::PENDING,
				'total_qty' => \Cart::getTotalQuantity(),
				'total_weight' => $totalWeight,
				'first_name' => $shippingFirstName,
				'address1' => $shippingAddress1,
				'address2' => $shippingAddress2,
				'phone' => $shippingPhone,
				'email' => $shippingEmail,
				'city_id' => $shippingCityId,
				'province_id' => $shippingProvinceId,
				'postcode' => $shippingPostcode,
			];
			Shipment::create($shipmentParams);

			return $order;

		});

		if (!isset($order)) {
			return redirect()->back()->with([
				'message' => 'something went wrong !',
				'alert-type' => 'danger'
			]);
			// return redirect()->route('checkout.received', $order->id);
		}
        return response()->json([
            'status'=>200,
            'message'=>'until now it works'
        ]);

		\Cart::clear();
		\Cart::clearCartConditions();

		$this->initPaymentGateway();

		$customerDetails = [
			'first_name' => $order->customer_first_name,
			'email' => $order->customer_email,
			'phone' => $order->customer_phone,
		];

		$transaction_details = [
			'enable_payments' => Payment::PAYMENT_CHANNELS,
			'transaction_details' => [
				'order_id' => $order->code,
				'gross_amount' => $order->grand_total,
			],
			'customer_details' => $customerDetails,
			'expiry' => [
				'start_time' => date('Y-m-d H:i:s T'),
				'unit' => Payment::EXPIRY_UNIT,
				'duration' => Payment::EXPIRY_DURATION,
			]
		];

		try{
			$snap = Snap::createTransaction($transaction_details);

			$order->payment_token = $snap->token;
			$order->payment_url = $snap->redirect_url;
			$order->save();

			return $order->payment_url;
		}
		catch(Exception $e) {
			echo $e->getMessage();
		}

	}
    public function order(Request $request){
        $validator = Validator::make($request->all(),[
            'fullName' => 'string|required',
            'province' => 'string|nullable',
            'city' => 'string|nullable',
            'shippingService' => 'string|nullable',
            'address' => 'string|nullable',
            'address2' => 'string|nullable',
            'postcode' => 'string|nullable',
            'phone' => 'string|nullable',
            'email' => 'string|nullable',
            'notes' => 'string|nullable'

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 200,
                'message' => 'order faild to send !'
            ]);
        }else {
		$userId = auth()->id();
        $user = UserController::getUser();
        $cartProduct = \Cart::getContent();
        $cartTotal = \Cart::getTotal();
        $orderParams = [
            'user_id' => $userId,
            'fullname' => $request->input('fullName'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'shippingService' => $request->input('shippingService'),
            'address' => $request->input('address'),
            'address2' => $request->input('address2'),
            'postcode' => $request->input('postcode'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'notes' => $request->input('notes'),
            'grand_total' => $cartTotal
        ];

        $order = OrderSimple::create($orderParams);
        if (!$order && !$cartProduct) {
            return abort(404);
        }else {
            foreach($cartProduct as $item){
                $itemDiscountAmount = 0;
                $itemDiscountPercent = 0;
                $itemBaseTotal = $item->price * $item->quantity;
                $itemSubTotal = $itemBaseTotal - $itemDiscountAmount;

                $product = $item->associatedModel;
                $orderItemParams = [
                    'qty' => $item->quantity,
                    'base_price' => $item->price,
                    'base_total' => $itemBaseTotal,
                    'discount_amount' => $itemDiscountAmount,
                    'discount_percent' => $itemDiscountPercent,
                    'sub_total' => $itemSubTotal,
                    'name' => $item->name,
                    'weight' => $item->associatedModel->weight,
                    'order_id' => $order->id,
                    'product_id' => $item->associatedModel->id
                ];
               $orderProduct = OrderItem::create($orderItemParams);
               if ($orderProduct) {
                    $product = Product::findOrFail($product->id);
                    $product->quantity -= $item->quantity;
                    $product->save();
               }
            }
        }

        $data=[
            'user_id'=> $user,
            'fullname' => $request->input('fullName'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'shippingService' => $request->input('shippingService'),
            'address' => $request->input('address'),
            'address2' => $request->input('address2'),
            'postcode' => $request->input('postcode'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'notes' => $request->input('notes'),
            'cart'=> \Cart::getContent()
        ];

		\Cart::clear();
        \Cart::clearCartConditions();
        return response()->json([
                     'status' => 200,
                     'message' => 'order has succesfully been send !',
                     'data' => $data,
                 ]);

        }

    }
}
