<?php

namespace App\Http\Controllers;

use App\Models\Billing_Details;
use App\Models\Order_Place;
use App\Models\Temporary_Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    private $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->getAccessToken();
    }

    public function handlePayment(Request $request)
    {
        //dd($request->all());
        $user_id = $request->input('user_id');
        $data = $request->except('_token');
        $final_amt = $request->input('final_amt') + 30;

        $order['intent'] = 'CAPTURE';
        $purchase_units = [];

        $unit = [
            'items' => [
                [
                    'name' => 'Broccoli',
                    'quantity' => 1,
                    'unit_amount' => [
                        'currency_code' => 'USD',
                        'value' => $final_amt
                    ]
                ],
            ],
            'amount' => [
                'currency_code' => 'USD',
                'value' => $final_amt,
                'breakdown' => [
                    'item_total' => [
                        'currency_code' => 'USD',
                        'value' => $final_amt
                    ]
                ]
            ]
        ];

        $purchase_units[] = $unit;

        $order['purchase_units'] = $purchase_units;

        $order['application_context'] = [
            'return_url' => url('payment-success'),
            'cancel_url' => url('payment-failed')
        ];

        $response = $this->provider->createOrder($order);
        //dd($response);
        try {

            if (Billing_Details::where('mobile', '=', $request->input('mobile'))->exists()) 
            {
                //dd($request->all());
                $cart_list = Temporary_Cart::where('user_id', $user_id)->get();
                //dd($cart_list);
                $final_tot = 0;
                foreach ($cart_list as $key => $cart) 
                {
                    $pro_name = $cart->product_name;
                    $pro_img = $cart->product_image;
                    $quantity = $cart->quantity;
                    $price = $cart->price;
                    $dis = $cart->discount;
                    $disVal = $dis / 100;
                    $calculate = $disVal * $price;
                    $get_val = $price - $calculate;
                    $tot = $quantity * $get_val;
                    $final_tot = $tot ;

                    $order_det = new Order_Place();
                    $order_det->user_id = $user_id;
                    $order_det->billing_id = 'null';
                    $order_det->product_id = $cart->product_id;
                    $order_det->product_name = $pro_name;
                    $order_det->product_image = $pro_img;
                    $order_det->price = $get_val;
                    $order_det->quantity = $quantity;
                    $order_det->total = $final_tot;
                    $order_det->payment_mode = 'Pay via Paypal';
                    $order_det->paymentId = 'Paid';
                    $order_det->save();
                }
            } 
            else 
            {
                //dd($request->all());
                $bill_user = new Billing_Details();
                $bill_user->user_id = $user_id;
                $bill_user->first_name = $request->input('first_name');
                $bill_user->last_name = $request->input('last_name');
                $bill_user->mobile = $request->input('mobile');
                $bill_user->email = $request->input('email');
                $bill_user->address = $request->input('address');
                $bill_user->landmark = $request->input('landmark');
                $bill_user->city = $request->input('city');
                $bill_user->country = $request->input('country');
                $bill_user->postcode = $request->input('postcode');
                $bill_user->save();
                // $user->id;   

                $cart_list = Temporary_Cart::where('user_id', $user_id)->get();
                //dd($cart_list);
                $final_tot = 0;
                foreach ($cart_list as $key => $cart) 
                {
                    $pro_name = $cart->product_name;
                    $pro_img = $cart->product_image;
                    $quantity = $cart->quantity;
                    $price = $cart->price;
                    $dis = $cart->discount;
                    $disVal = $dis / 100;
                    $calculate = $disVal * $price;
                    $get_val = $price - $calculate;
                    $tot = $quantity * $get_val;
                    $final_tot = $tot + 30;

                    $order_det = new Order_Place();
                    $order_det->user_id = $user_id;
                    $order_det->billing_id = 'null';
                    $order_det->product_id = $cart->product_id;
                    $order_det->product_name = $pro_name;
                    $order_det->product_image = $pro_img;
                    $order_det->price = $get_val;
                    $order_det->quantity = $quantity;
                    $order_det->total = $final_tot;
                    $order_det->payment_mode = 'Pay via Paypal';
                    $order_det->paymentId = 'Paid';
                    $order_det->save();
                }
            }
            $cart_del = DB::table('temporary_carts')->where('user_id', $user_id)->delete();

            return response()->json([
                'payment_link' => $response
            ]);
        } catch (\Throwable $th) {
            dd($th->getMessage(), $response);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $response = $this->provider->capturePaymentOrder($request->get('token'));
        //dd($response);
        $result1 = DB::table('order_id')->insert(
            array(
                   'user_id'     =>   Auth::id(), 
                   'orderId'   =>   $response['id']
            )
       );

        $query1 = DB::table('temporary_carts')
            ->where('user_id', '=', Auth::id())
            ->count('user_id');

        $query2 = DB::table('billing_details')
            ->select('billing_details.*', 'order_details.*')
            ->rightJoin('order_details', 'order_details.user_id', '=', 'billing_details.user_id')
            ->where('billing_details.user_id', '=', Auth::id())
            ->groupBy('order_details.product_id')
            ->get();
        //dd($query2);    
        $res['order_details'] = $query2;
        $res['cart_count'] = $query1;

        return view('home.order_details', $res);
    }

    public function paymentFailed() {}
}
