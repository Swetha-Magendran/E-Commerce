<?php

namespace App\Http\Controllers;

use App\Models\Billing_Details;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order_Place;
use App\Models\Product;
use App\Models\Temporary_Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Dotenv\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //Get Home Page Data Here
    public function index()
    {
        $query1 = DB::table('products')
            ->select('products.id', 'products.product_name', 'products.product_image', 'products.price', 'products.description', 'categories.category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.status', '=', '1')
            ->groupBy('products.category_id')
            ->get();

        $query2 = DB::table('products')
            ->select('id', 'product_name', 'product_image', 'price', 'description')
            ->where('category_id', '=', '2')
            ->where('status', '=', '1')
            ->limit('4')
            ->get();

        $query3 = DB::table('products')
            ->select('id', 'product_name', 'product_image', 'price', 'description')
            ->where('category_id', '=', '1')
            ->where('status', '=', '1')
            ->limit('4')
            ->get();

        $query4 = DB::table('products')
            ->select('id', 'product_name', 'product_image', 'price', 'description')
            ->where('category_id', '=', '3')
            ->where('status', '=', '1')
            ->get();

        $query5 = DB::table('products')
            ->select('id', 'product_name', 'product_image', 'price', 'description')
            ->where('category_id', '=', '4')
            ->where('status', '=', '1')
            ->limit('4')
            ->get();

        $query6 = DB::table('products')
            ->select('products.id', 'products.product_name', 'products.product_image', 'products.price', 'products.description', 'categories.category', 'sub_category.sub_category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
            ->where('products.status', '=', '1')
            ->get();

        $query7 = DB::table('products')
            ->select('products.id', 'products.product_name', 'products.product_image', 'products.price', 'products.description', 'categories.category', 'sub_category.sub_category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
            ->where('products.status', '=', '1')
            ->limit('6')
            ->get();

        $query8 = DB::table('products')
            ->select('products.id', 'products.product_name', 'products.product_image', 'products.price', 'products.description', 'categories.category', 'sub_category.sub_category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
            ->where('products.category_id', '=', '2')
            ->where('products.status', '=', '1')
            ->limit('4')
            ->get();

        if (!empty(Auth::id()) && Auth::user()->usertype == 'User') {
            $UserId = Auth::id();

            $query9 = DB::table('temporary_carts')
                ->where('user_id', '=', $UserId)
                ->count('user_id');
            $res['cart_count'] = $query9;
        } else {
            $res['cart_count'] = 0;
        }

        $res['all_pro_val'] = $query1;
        $res['vegtables_val'] = $query2;
        $res['fruits_val'] = $query3;
        $res['bread_val'] = $query4;
        $res['meat_val'] = $query5;
        $res['fresh_veg'] = $query6;
        $res['best_fruits'] = $query7;
        $res['best_vegies'] = $query8;

        return view('home.index', $res);
    }
    //Get Shop Page Data Here
    public function shop()
    {
        // dd(Auth::id());
        // dd( Auth::user()->usertype);
        $cate = Category::all();

        $query1 = DB::table('products')
            ->where('category_id', '=', '1')
            ->count('category_id');

        $query2 = DB::table('products')
            ->where('category_id', '=', '2')
            ->count('category_id');

        $query3 = DB::table('products')
            ->where('category_id', '=', '3')
            ->count('category_id');

        $query4 = DB::table('products')
            ->where('category_id', '=', '4')
            ->count('category_id');

        $pro_det = DB::table('products')
            ->select('products.*', 'categories.category', 'sub_category.sub_category')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
            ->where('products.status', '=', '1')
            ->get();

        $query5 = DB::table('products')
            ->select('products.id', 'products.product_name', 'products.product_image', 'products.price', 'products.discount', 'products.description', 'categories.category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.status', '=', '1')
            ->groupBy('products.category_id')
            ->get();

        if (!empty(Auth::id()) && Auth::user()->usertype == 'User') {
            $UserId = Auth::id();

            $query9 = DB::table('temporary_carts')
                ->where('user_id', '=', $UserId)
                ->count('user_id');
            $res['cart_count'] = $query9;
        } else {
            $res['cart_count'] = 0;
        }

        $res['categories'] = $cate;
        $res['fruits_count'] = $query1;
        $res['veg_count'] = $query2;
        $res['bread_count'] = $query3;
        $res['meat_count'] = $query4;
        $res['all_products'] = $pro_det;
        $res['featured_product'] = $query5;

        return view('home.shop', $res);
    }

    public function login()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype == 'User') {
            $UserId = Auth::id();

            $query9 = DB::table('temporary_carts')
                ->where('user_id', '=', $UserId)
                ->count('user_id');
            $res['cart_count'] = $query9;
        } else {
            $res['cart_count'] = 0;
        }

        return view('home.login', $res);
    }

    public function user_profile()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype == 'User') {
            $user_id = Auth::id();

            $query = DB::table('users')
                ->select('users.*')
                ->where('users.id', '=', $user_id)
                ->get();

            $query9 = DB::table('temporary_carts')
                ->where('user_id', '=', $user_id)
                ->count('user_id');
            $res['cart_count'] = $query9;
        } else {
            $query = "";
            $res['cart_count'] = 0;
        }

        $res['user_details'] = $query;

        return view('home.user_profile', $res);
    }

    public function cart()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype == 'User') {
            $user_id = Auth::id();
            $query = DB::table('temporary_carts')
                ->select('temporary_carts.*', 'products.*', 'temporary_carts.id as cart_id', 'users.city')
                ->join('products', 'products.id', '=', 'temporary_carts.product_id')
                ->join('users', 'users.id', '=', 'temporary_carts.user_id')
                ->where('user_id', '=', $user_id)
                ->get();

            // $query = Cart::where('user_id', $user_id);
            // dd($query);
            $query9 = DB::table('temporary_carts')
                ->where('user_id', '=', $user_id)
                ->count('user_id');

            $res['cart_count'] = $query9;
        } else {
            $query = "";
            $res['cart_count'] = 0;
        }

        $res['tem_cart_list'] = $query;
        return view('home.cart', $res);
    }

    //Update Temporary Cart table Here
    public function update_cart_item(Request $request)
    {
        $userid = $request->input('user_id');
        $proid = $request->input('product_id');
        $qty = $request->input('quantity');
        $tot = $request->input('total');

        $result1 = DB::table('temporary_carts')
            ->where('user_id', '=', $userid)
            ->where('product_id', '=', $proid)
            ->update([
                'quantity' => $qty,
                'total' => $tot
            ]);

        $result2 = DB::table('temporary_carts')
            ->select('total')
            ->where('user_id', '=', $userid)
            ->get();

        return response()->json([
            'status' => 'Updated Cart item',
            'get_cart_list' => $result2
        ]);
    }

    public function checkout()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype == 'User') {
            $UserId = Auth::id();

            $query2 = DB::table('users')
                ->select('users.*')
                ->where('users.id', '=', $UserId)
                ->get();

            $query9 = DB::table('temporary_carts')
                ->where('user_id', '=', $UserId)
                ->count('user_id');

            $query1 = DB::table('temporary_carts')
                ->select('*')
                ->where('user_id', '=', $UserId)
                ->get();

            $res['cart_list'] = $query1;
            $res['user_details'] = $query2;
            $res['cart_count'] = $query9;
        } else {
            $res['cart_count'] = 0;
        }

        return view('home.checkout', $res);
    }

    //User Details Store Here
    // public function create_user(Request $request)
    // {
    //     $data = $request->except('_token');

    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|unique:users,email|email',
    //         'mobile' => 'required|unique:users,mobile|numeric',
    //         'password' => 'required',
    //         'address' => 'required'
    //     ]);

    //     $data = new User;
    //     $data->name = $request->input('name');
    //     $data->email = $request->input('email');
    //     $data->mobile = $request->input('mobile');
    //     $data->address = $request->input('address');
    //     $data->password = Hash::make($request->input('password'));
    //     $data->save();

    //     Auth::login($data);

    //     return response()->json([
    //         'Status' => 'User Added',
    //     ]);

    // }

    //Get All Product Here
    public function get_product_details(Request $request, Product $product_id)
    {

        $pro_det = DB::table('products')
            ->select('products.*', 'categories.category', 'sub_category.sub_category')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
            ->where('products.status', '=', '1')
            ->where('products.id', '=', $product_id->id)
            ->limit('1')
            ->get();

        //dd($pro_det);
        foreach ($pro_det as $key => $product_det) {
            $cate_id = $product_det->category_id;
            //print_r($cate_id);exit();
            if ($cate_id == '1') {
                $cate_pro = DB::table('products')
                    ->select('products.*', 'categories.category', 'sub_category.sub_category')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                    ->where('products.status', '=', '1')
                    ->where('products.category_id', '=', $cate_id)
                    ->get();
            } elseif ($cate_id == '2') {
                $cate_pro = DB::table('products')
                    ->select('products.*', 'categories.category', 'sub_category.sub_category')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                    ->where('products.status', '=', '1')
                    ->where('products.category_id', '=', $cate_id)
                    ->get();
            } elseif ($cate_id == '3') {
                $cate_pro = DB::table('products')
                    ->select('products.*', 'categories.category', 'sub_category.sub_category')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                    ->where('products.status', '=', '1')
                    ->where('products.category_id', '=', $cate_id)
                    ->get();
            } else {
                $cate_pro = DB::table('products')
                    ->select('products.*', 'categories.category', 'sub_category.sub_category')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                    ->where('products.status', '=', '1')
                    ->where('products.category_id', '=', $cate_id)
                    ->get();
            }
        }

        $cate = Category::all();

        $query1 = DB::table('products')
            ->where('category_id', '=', '1')
            ->count('category_id');

        $query2 = DB::table('products')
            ->where('category_id', '=', '2')
            ->count('category_id');

        $query3 = DB::table('products')
            ->where('category_id', '=', '3')
            ->count('category_id');

        $query4 = DB::table('products')
            ->where('category_id', '=', '4')
            ->count('category_id');

        $query5 = DB::table('products')
            ->select('products.id', 'products.product_name', 'products.product_image', 'products.price', 'products.discount', 'products.description', 'categories.category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.status', '=', '1')
            ->groupBy('products.category_id')
            ->get();

        $res['categories'] = $cate;
        $res['fruits_count'] = $query1;
        $res['veg_count'] = $query2;
        $res['bread_count'] = $query3;
        $res['meat_count'] = $query4;
        $res['featured_product'] = $query5;

        $res['product_details'] = $pro_det;
        $res['cate_wise_product'] = $cate_pro;

        if (!empty(Auth::id()) && Auth::user()->usertype == 'User') {
            $UserId = Auth::id();

            $query9 = DB::table('temporary_carts')
                ->where('user_id', '=', $UserId)
                ->count('user_id');
            $res['cart_count'] = $query9;
        } else {
            $res['cart_count'] = 0;
        }

        return view('home.productDetails', $res);
    }
    //Get Category Product Here
    public function get_category_wise_product(Request $request)
    {
        $category_id = $request->input('cate_id');

        $pro_det = DB::table('products')
            ->select('products.*', 'categories.category', 'sub_category.sub_category')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
            ->where('products.status', '=', '1')
            ->where('products.category_id', '=', $category_id)
            ->get();
        //dd($pro_det);
        return response()->json([
            'category_wise_product' => $pro_det
        ]);
    }
    //Get Sub Category Product Here
    public function get_sub_category_wise_product(Request $request)
    {
        $sub_cate_id = $request->input('sub_cate');

        if ($sub_cate_id == 1) {
            $pro_det = DB::table('products')
                ->select('products.*', 'categories.category', 'sub_category.sub_category')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                ->where('products.status', '=', '1')
                ->where('products.sub_category_id', '=', '1')
                ->get();
        } elseif ($sub_cate_id == 2) {
            $pro_det = DB::table('products')
                ->select('products.*', 'categories.category', 'sub_category.sub_category')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                ->where('products.status', '=', '1')
                ->where('products.sub_category_id', '=', '4')
                ->get();
        } elseif ($sub_cate_id == 3) {
            $pro_det = DB::table('products')
                ->select('products.*', 'categories.category', 'sub_category.sub_category')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                ->where('products.status', '=', '1')
                ->get();
        } else {
            $pro_det = DB::table('products')
                ->select('products.*', 'categories.category', 'sub_category.sub_category')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
                ->where('products.status', '=', '1')
                ->where('products.discount', '!=', '0')
                ->get();
        }

        return response()->json([
            'sub_category_wise_product' => $pro_det
        ]);
    }
    //Get Price Rage Data Here
    public function get_price_wise_product(Request $request)
    {
        $price = $request->input('price');

        $pro_det = DB::table('products')
            ->select('products.*', 'categories.category', 'sub_category.sub_category')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('sub_category', 'sub_category.id', '=', 'products.sub_category_id')
            ->where('products.status', '=', '1')
            ->where('products.price', '<=', $price)
            ->get();

        return response()->json([
            'price_wise_product' => $pro_det
        ]);
    }

    //Add to Cart Product by User Id
    public function add_to_cart(Request $request)
    {
        $userid = $request->input('user_id');
        $prodid = $request->input('pro_id');
        $quantity    = $request->input('quantity');

        $query1 = DB::table('products')
            ->select('products.*')
            ->where('id', '=', $prodid)
            ->get();

        $query3 = Temporary_Cart::where('product_id', $prodid)->count();
        //$query3 = $query2->count();

        //dd($query3);
        if ($query3 == 0) {
            foreach ($query1 as $key => $product) {
                $pro_name = $product->product_name;
                $pro_img = $product->product_image;
                $price = $product->price;
                $dis = $product->discount;
                $disVal = $dis / 100;
                $calculate = $disVal * $price;
                $get_val = $price - $calculate;
                $tot = $quantity * $get_val;

                $data = new Temporary_Cart();
                $data->user_id = $userid;
                $data->product_id = $prodid;
                $data->product_name = $pro_name;
                $data->product_image = $pro_img;
                $data->price = $price;
                $data->discount = $dis;
                $data->quantity = $quantity;
                $data->total = $tot;
                $data->save();
                //dd($pro_name);

            }

            $query5 = Temporary_Cart::where('user_id', $userid)->count();
            //$query5 = $query4->count();

            return response()->json([
                'status' => 'Success',
                'cart_count' => $query5
            ]);
        } else {
            return response()->json([
                'status' => 'Already Added to Cart'
            ]);
        }
    }

    //Delete cart item by userId & cartId
    public function delete_cart_item(Request $request)
    {
        $userid = $request->input('user_id');
        $cartId = $request->input('cart_id');

        $query = DB::table('temporary_carts')
            ->where('id', $cartId)
            ->where('user_id', $userid)
            ->delete();

        return response()->json([
            'status' => 'deleted'
        ]);
    }

    //Order details store here
    public function store_order_details(Request $request)
    {
        //dd($request->all());
        $user_id = $request->input('user_id');

        $query1 = DB::table('temporary_carts')
            ->where('user_id', '=', $user_id)
            ->count('user_id');

        $data = $request->except('_token');

        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'email' => 'required',
        //     'mobile' => 'required',
        //     'address' => 'required',
        //     'landmark' => 'required',
        //     'city' => 'required',
        //     'country' => 'required',
        //     'postcode' => 'required',
        //     'payment_mode' => 'required'
        // ]);

        if (Billing_Details::where('mobile', '=', $request->input('mobile'))->exists()) 
        {
            
        }
        else
        {
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
                $final_tot = $tot;

                // $number = mt_rand(1000000000, 9999999999);
                // echo $number;
                
                $order = new Order_Place();
                $order->user_id = $user_id;
                $order->billing_id = $bill_user->id;
                $order->product_id = $cart->product_id;
                $order->product_name = $pro_name;
                $order->product_image = $pro_img;
                $order->price = $get_val;
                $order->quantity = $quantity;
                $order->total = $final_tot;
                $order->payment_mode = 'Cash On Delivery';
                $order->paymentId = 'Pending';
                $order->save();
                // $order->id;

        
            }

            $cart_del = DB::table('temporary_carts')->where('user_id', $user_id)->delete();
        }

        $query2 = DB::table('billing_details')
            ->select('billing_details.*', 'order_details.*', 'order_details.id as order_id')
            ->rightJoin('order_details', 'order_details.billing_id', '=', 'billing_details.id')
            ->where('billing_details.user_id', '=', $user_id)
            ->get();

        $res['order_details'] = $query2;
        $res['cart_count'] = $query1;

        return view('home.order_details', $res);
    }

    public function order_details()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype == 'User')
        {
            $query1 = DB::table('temporary_carts')
            ->where('user_id', '=', Auth::id())
            ->count('user_id');

        $query2 = DB::table('billing_details')
            ->select('billing_details.*', 'order_details.*')
            ->rightJoin('order_details', 'order_details.user_id', '=', 'billing_details.user_id')
            ->where('billing_details.user_id', '=', Auth::id())
            ->get();
        //dd($query2);    
        $res['order_details'] = $query2;
        $res['cart_count'] = $query1;

        return view('home.order_details', $res);

        } 
        else { $res['cart_count'] = 0; }

        return view('home.order_details', $res);
    }
}
