<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\Category;
use App\Models\Measurment;
use App\Models\Product;
use App\Models\Product_Stock;
use App\Models\SubCategory;
use App\Models\Temporary_Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\RecordNotFoundException;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    
    public function index()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        {            
            // $user_id = Auth::id();
            // $query = DB::table('authentication')
            // ->select('authentication.*')
            // ->where('authentication.id','=',$user_id)
            // ->get();
            //$res['user'] = $query;

            return view('admin.index');
        }
        else
        {
            return view('admin.login');
        }
    }

    public function category()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        {                    
            $categories = Category::all(); 
            //dd($categories);
              
            $user_id = Auth::id();
            // $query = DB::table('authentication')
            // ->select('authentication.*')
            // ->where('authentication.id','=',$user_id)
            // ->get();
            // $res['user'] = $query;
            $res['categories'] = $categories;  

            return view('admin.category',$res); 
        }
        else
        {
            return view('admin.login');
        }
    }

    public function sub_category()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        {         
            $categories = Category::all();
   
            $query = DB::table('categories')
            ->select('categories.id','categories.category','sub_category.*')
            ->join('sub_category','sub_category.category_id','=','categories.id')
            ->where('categories.status','=','Active')
            ->get();
              
            $user_id = Auth::id();
            // $query1 = DB::table('authentication')
            // ->select('authentication.*')
            // ->where('authentication.id','=',$user_id)
            // ->get();
            // $res['user'] = $query1;
            $res["sub_categories"] = $query;
            $res['categories'] = $categories;  
            return view('admin.sub_category',$res);
        }
        else
        {
            return view('admin.login');
        }        
    }

    public function product()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        { 
            $categories1 = DB::table('categories')
            ->select('categories.*')
            ->where('categories.status','=','Active')
            ->get();

            $query2 = DB::table('products')
            ->select('products.*','categories.category','sub_category.sub_category')
            ->join('categories','categories.id','=','products.category_id')
            ->join('sub_category','sub_category.id','=','products.sub_category_id')
            ->get();

            $user_id = Auth::id();
            // $query1 = DB::table('authentication')
            // ->select('authentication.*')
            // ->where('authentication.id','=',$user_id)
            // ->get();

            // $return['user'] = $query1;
            $return["categories"] = $categories1;
            $return["products"] = $query2;

            return view('admin.product',$return);
            
        }
        else
        {
            return view('admin.login');
        }  

    }

    public function measurment()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        { 
            $user_id = Auth::id();
            // $query1 = DB::table('authentication')
            // ->select('authentication.*')
            // ->where('authentication.id','=',$user_id)
            // ->get();            

            $measur_val = Measurment::all();

            $return['measur_val'] = $measur_val;
            //$return['user'] = $query1;

            return view('admin.measurment',$return);            
        }
        else
        {
            return view('admin.login');
        }  
        
    }

    //Category Store Here
    public function category_store(Request $request)
    {
        $data = $request->except('_token');
        $cate_id = $request->input('category_id');
        if($cate_id == '')
        {            
            $request->validate([
                'category' => 'required',
                'cate_status' => 'required'
            ]);

            $data = new Category();
            $data->category = $request->input('category');
            $data->status = $request->input('cate_status');
            $data->save();

            return back()
            ->withSuccess('Category Added Successfully!'); 
        } else {
            
            $request->validate([
                'category' => 'required',
                'cate_status' => 'required'
            ]);
            DB::table('categories')->where('id', $cate_id)->update(array(
                'category'=>$request->input('category'),
                'status' => $request->input('cate_status')
            ));

            return back()
            ->withSuccess('Category Updated Successfully!'); 
        }
    }

    //Get Category value by id
    public function get_category(Request $request)
    {
        $cate_id = $request->input('cate_id');

        $query= DB::table('categories')
        ->select('categories.*')
        ->where('id',$cate_id)
        ->get();

        return response()->json([
            'categories' => $query
        ]);
    }  

    //Get Sub Category value by id
    public function get_sub_category(Request $request)
    {
        $sub_cate_id = $request->input('sub_cate_id');
        //dd($cate_id);
        $query= DB::table('sub_category')
        ->select('sub_category.*','categories.category')
        ->join('categories','categories.id','=','sub_category.category_id')
        ->where('sub_category.id','=', $sub_cate_id)
        ->get();

        return response()->json([
            'sub_cate' => $query
        ]);
    }

    //Sub Category Store here
    public function sub_category_store(Request $request)
    {        
        $data = $request->except('_token');
        $sub_cate_id = $request->input('sub_category_id');
        if($sub_cate_id == '')
        {            
            $request->validate([
                'category_id' => 'required',
                'sub_category' => 'required',
                'status' => 'required'
            ]);
    
            $data = new SubCategory();
            $data->category_id = $request->input('category_id');
            $data->sub_category = $request->input('sub_category');
            $data->status = $request->input('status');
            $data->save();
    
            return back()
            ->withSuccess('Sub Category Added Successfully!');  

        } else {
            
            $request->validate([
                'category_id' => 'required',
                'sub_category' => 'required',
                'status' => 'required'
            ]);
            DB::table('sub_category')->where('id', $sub_cate_id)->update(array(
                'category_id'=>$request->input('category_id'),
                'sub_category'=>$request->input('sub_category'),
                'status' => $request->input('status')
            ));

            return back()
            ->withSuccess('Sub Category Updated Successfully!'); 
        }
        
    }

    //Product store here
    public function product_store(Request $request)
    {
        $data = $request->except('_token');

        $pro_id = $request->input('product_id');
        //dd($request->all());
        if(empty($pro_id ))
        {
            $request->validate([
                'pro_name' => 'required',
                'pro_code' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'sub_category' => 'required',
                'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:1000'],
                'price' => 'required',
                'discount' => 'required',
                'status' => 'required'
            ]);
    
            $imageName = time().'.'.$request->image->extension(); 
    
            $request->image->move(public_path('images/products_image'), $imageName);
    
            $data = new Product();
            $data->product_name = $request->input('pro_name');
            $data->product_code = $request->input('pro_code');
            $data->category_id = $request->input('category_id');
            $data->sub_category_id = $request->input('sub_category');
            $data->product_image = $imageName;
            $data->price = $request->input('price');
            $data->discount = $request->input('discount');
            $data->status = $request->input('status');
            $data->description = $request->input('description');
            $data->save();
    
            return back()
            ->withSuccess('Product Added Successfully!'); 

        }
        else
        {
            //$image = $request->input('image');
            if ($_FILES['image']['error'] == 4 || ($_FILES['image']['size'] == 0 && $_FILES['image']['error'] == 0))
            {       
                $request->validate([
                    'pro_name' => 'required',
                    'pro_code' => 'required',
                    'description' => 'required',
                    'category_id' => 'required',
                    'sub_category' => 'required',
                    'price' => 'required',
                    'discount' => 'required',
                    'status' => 'required'
                ]);

                DB::table('products')->where('id', $pro_id)->update(array(
                    'product_name'=> $request->input('pro_name'),
                    'product_code'=> $request->input('pro_code'),
                    'description' => $request->input('description'),
                    'category_id' => $request->input('category_id'),
                    'sub_category_id'=> $request->input('sub_category'),
                    'price' => $request->input('price'),
                    'discount'=> $request->input('discount'),
                    'status'=> $request->input('status')
                ));
            } else {
                $request->validate([
                    'pro_name' => 'required',
                    'pro_code' => 'required',
                    'description' => 'required',
                    'category_id' => 'required',
                    'sub_category' => 'required',
                    'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:1000'],
                    'price' => 'required',
                    'discount' => 'required',
                    'status' => 'required'
                ]);
    
                $imageName = time().'.'.$request->image->extension(); 
    
                $request->image->move(public_path('images/products_image'), $imageName);

                DB::table('products')->where('id', $pro_id)->update(array(
                    'product_name'=> $request->input('pro_name'),
                    'product_code'=> $request->input('pro_code'),
                    'description' => $request->input('description'),
                    'category_id' => $request->input('category_id'),
                    'sub_category_id'=> $request->input('sub_category'),
                    'product_image'=> $imageName,
                    'price' => $request->input('price'),
                    'discount'=> $request->input('discount'),
                    'status'=> $request->input('status')
                ));
            }          

            return back()
            ->withSuccess('Product Updated Successfully!'); 
        }
    }

    //Store measurment here
    public function measurment_store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'measurment' => 'required',
            'status' => 'required'
        ]);

        $data = new Measurment();
        $data->measurment = $request->input('measurment');
        $data->status = $request->input('status');
        $data->save();

        return back()
        ->withSuccess('Measurment Added Successfully!'); 
    }

    //Get Product by product Id here
    public function get_product(Request $request)
    {
        $pro_id = $request->input('product_id');

        $query = DB::table('products')
        ->select('products.*','sub_category.sub_category')
        ->join('sub_category','sub_category.id','=','products.sub_category_id')
        ->where('products.id','=',$pro_id)
        ->get();

        return response()->json([
            'products' => $query
        ]);
    }

    //Get User Details Here
    public function user_details()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        { 
            // $users = DB::table('users')
            // ->join('order_details', function (JoinClause $join) {
            //     $join->on('users.id', '=', 'order_details.user_id')
            //          ->where('order_details.user_id', '>', 5);
            // })
            // ->get(); 
            //  dd($users);
            $users = User::all();

            $res['users'] = $users;

            return view('admin.user_details', $res);
        }
        else
        {
            return view('admin.login');
        }
    }

    //Delete user details here
    public function delete_user_details(Request $request)
    {
        $userid = $request->input('user_id');

        $query = DB::table('users')
        ->where('users.id','=',$userid)
        ->delete();

        return response()->json([
            'status' => 'deleted'
        ]);
    }

    //List order details here
    public function order_details()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        { 
            $user_id = Auth::id();

            $order_details = DB::table('order_details')
            ->select('order_details.*','users.name','users.mobile')
            ->join('users','users.id','=','order_details.user_id')
            ->where('users.usertype','=','User')
            ->get();
            //dd($order_details);
            //$res['user'] = $query1;
            $res['order_details'] = $order_details;
            
            return view('admin.order_details', $res);
        }
        else
        {
            return view('admin.login');
        }
    }

    //Delete Order by id here
    public function delete_order_details(Request $request)
    {
        $cart_id = $request->input('cart_id');

        $query = DB::table('temporary_carts')
        ->where('temporary_carts.id','=',$cart_id)
        ->delete();

        return response()->json([
            'status' => 'deleted'
        ]);
    }

    //View Authentication Here
    public function authentication()
    {
            
        $access_list = User::all();

        $res['access_list'] = $access_list;            
        
        return view('admin.authentication', $res);
    }

    //Get Authentication data by id here
    public function get_authentication(Request $request)
    {
        $auth_id = $request->input('auth_id');

        // $query = DB::table('authentication')
        // ->select('authentication.*')
        // ->where('authentication.id','=',$auth_id)
        // ->get();

        $query = User::find($auth_id);

        return response()->json([
            'auth_data' => $query
        ]);
    }

    //View Stock page here
    public function stock()
    {
        if (!empty(Auth::id()) && Auth::user()->usertype != 'User')
        {            
            $user_id = Auth::id();
            $query1 = DB::table('authentication')
            ->select('authentication.*')
            ->where('authentication.id','=',$user_id)
            ->get();

            $query2 = DB::table('products')
            ->select('id','product_name')
            ->get();

            $query3 = DB::table('products_stock')
            ->select('products_stock.*','products.product_name')
            ->join('products','products.id','=','products_stock.product_id')
            ->get();

            $res['user'] = $query1;
            $res['products'] = $query2;
            $res['stock_products'] = $query3;

            return view('admin.stock',$res);
        }
        else
        {
            return view('admin.login');
        } 
    }

    //Stock Details Store here
    public function stock_entry(Request $request)
    {
        $data = $request->except('_token');

        $pro_stock_id = $request->input('product_stock_id');
        //dd($request->all());
        if(empty($pro_stock_id ))
        {
            $request->validate([
                'product_id' => 'required',
                'product_code' => 'required',
                'product_stock' => 'required',
                'product_recevied_from' => 'required'
            ]);
    
            $data = new Product_Stock();
            $data->product_id = $request->input('product_id');
            $data->product_code = $request->input('product_code');
            $data->product_stock = $request->input('product_stock');
            $data->received_from = $request->input('product_recevied_from');
            $data->save();
    
            return back()
            ->withSuccess('Stock Added Successfully!'); 

        }
        else
        {
            $request->validate([
                'product_id' => 'required',
                'product_code' => 'required',
                'product_stock' => 'required',
                'product_recevied_from' => 'required'
            ]);

            DB::table('products_stock')->where('id', $pro_stock_id)->update(array(
                'product_id'=> $request->input('product_id'),
                'product_code'=> $request->input('product_code'),
                'product_stock' => $request->input('product_stock'),
                'received_from' => $request->input('product_recevied_from')
            ));        

            return back()
            ->withSuccess('Stock Updated Successfully!'); 
        }
    }

    //Get Product Code here
    public function get_product_code(Request $request)
    {
        $pro_id = $request->input('product_id');

        $query = DB::table('products')
        ->select('id','product_code')
        ->where('products.id','=',$pro_id)
        ->get();

        return response()->json([
            'product_code' => $query
        ]);
    }

    //Get Stock Detail here
    public function get_stock(Request $request)
    {
        $stock_id = $request->input('stock_id');

        $query = DB::table('products_stock')
        ->select('products_stock.*')
        ->where('products_stock.id','=',$stock_id)
        ->get();

        return response()->json([
            'product_stock' => $query
        ]);
    }

    //Delete Stock Detail here
    public function delete_stock(Request $request)
    {
        $stock_id = $request->input('stock_id');

        $query = DB::table('products_stock')
        ->where('products_stock.id','=',$stock_id)
        ->delete();

        return response()->json([
            'status' => 'deleted'
        ]);
    }

}
