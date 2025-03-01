<!DOCTYPE html>
<html lang="en">

    @include('folder.header')

    <body>

        <!-- Spinner Start -->
        @include('folder.top_menu')
        <!-- Spinner End -->

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Checkout</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('shop')}}">Pages</a></li>
                <li class="breadcrumb-item active text-white">Checkout</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Billing details</h1>
                <form action="{{route('place_order')}}" method="POST">
                    @csrf
                    <div class="row g-5">
                        @foreach($user_details as $key => $user_det)
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <input type="hidden" id="user_id" name="user_id" value="{{$user_det->id}}">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">First Name<sup>*</sup></label>
                                        <input type="text" class="form-control {{$errors->has('first_name')?'is-invalid':''}}" id="first_name" name="first_name" value="{{$user_det->name}}">
                                        @if($errors->has('first_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('first_name')}}</strong>
                                        </span>
                                        @endif
                                        <span class="input_error" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Last Name<sup>*</sup></label>
                                        <input type="text" class="form-control {{$errors->has('last_name')?'is-invalid':''}}" id="last_name" name="last_name" value="{{$user_det->lname}}">
                                        @if($errors->has('last_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('last_name')}}</strong>
                                        </span>
                                        @endif
                                        <span class="input_error" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                                        <input type="text" class="form-control {{$errors->has('mobile')?'is-invalid':''}}" id="mobile" name="mobile" value="{{$user_det->mobile}}">
                                        @if($errors->has('mobile'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('mobile')}}</strong>
                                        </span>
                                        @endif
                                        <span class="input_error" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Email<sup>*</sup></label>
                                        <input type="text" class="form-control {{$errors->has('email')?'is-invalid':''}}" id="email" name="email" value="{{$user_det->email}}">
                                        @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('email')}}</strong>
                                        </span>
                                        @endif
                                        <span class="input_error" style="color:red;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Address<sup>*</sup></label>
                                <input type="text" class="form-control {{$errors->has('address')?'is-invalid':''}}" id="address" name="address" value="{{$user_det->address}}" placeholder="House Number Street Name">
                                @if($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('address')}}</strong>
                                </span>
                                @endif
                                <span class="input_error" style="color:red;"></span>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Landmark <sup>*</sup></label>
                                <input type="text" class="form-control {{$errors->has('landmark')?'is-invalid':''}}" id="landmark" name="landmark" value="{{$user_det->landmark}}">
                                @if($errors->has('landmark'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('landmark')}}</strong>
                                </span>
                                @endif
                                <span class="input_error" style="color:red;"></span>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Town/City<sup>*</sup></label>
                                <input type="text" class="form-control {{$errors->has('city')?'is-invalid':''}}" id="city" name="city" value="{{$user_det->city}}">
                                @if($errors->has('city'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('city')}}</strong>
                                </span>
                                @endif
                                <span class="input_error" style="color:red;"></span>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Country<sup>*</sup></label>
                                <input type="text" class="form-control {{$errors->has('country')?'is-invalid':''}}" id="country" name="country" value="{{$user_det->country}}">
                                @if($errors->has('country'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('country')}}</strong>
                                </span>
                                @endif
                                <span class="input_error" style="color:red;"></span>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                                <input type="text" class="form-control {{$errors->has('postcode')?'is-invalid':''}}" id="postcode" name="postcode" value="{{$user_det->postcode}}">
                                @if($errors->has('postcode'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('postcode')}}</strong>
                                </span>
                                @endif
                                <span class="input_error" style="color:red;"></span>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">MRP</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                                        <?php $final = 0; $with_rate = 0; ?>
                                        @foreach($cart_list as $key => $item)
                                        <?php $price = $item->total;
                                        $qty = $item->quantity;
                                        $tot = $price * $qty;
                                        $final += $price;
                                        $with_tax = $final + 30;
                                        ?>
                                        <tr>
                                            <input type="hidden" name="final_amt" id="final_amt" value="{{$with_tax}}">
                                            <th scope="row">
                                                <div class="d-flex align-items-center mt-2">
                                                    <img src="images/products_image/{{$item->product_image}}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                </div>
                                            </th>
                                            <td class="py-5">{{$item->product_name}}</td>
                                            <td class="py-5">&#x20b9; {{$item->price}}</td>
                                            <td class="py-5">{{$item->quantity}}</td>
                                            <td class="py-5">&#x20b9; {{$price}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark py-3">Subtotal</p>
                                            </td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">&#x20b9; {{$with_tax}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark py-4">Shipping</p>
                                            </td>
                                            <td colspan="3" class="py-5">
                                                <div class="form-check text-start">
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-1" name="Shipping-1" value="Shipping" checked>
                                                    <label class="form-check-label" for="Shipping-1">Free Shipping</label>
                                                </div>
                                                <div class="form-check text-start">
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-2" name="Shipping-1" value="Shipping" checked>
                                                    <label class="form-check-label" for="Shipping-2">Flat rate: &#x20b9; 15.00</label>
                                                </div>
                                                <div class="form-check text-start">
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-3" name="Shipping-1" value="Shipping" checked>
                                                    <label class="form-check-label" for="Shipping-3">Local Pickup: &#x20b9; 8.00</label>
                                                </div>
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                                            </td>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0 text-dark">&#x20b9; {{$with_tax}}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0 {{$errors->has('payment_mode')?'is-invalid':''}}" id="Transfer-1" name="payment_mode" value="Bank Transfer">
                                        <label class="form-check-label" for="Transfer-1">Direct Bank Transfer</label>
                                        @if($errors->has('payment_mode'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('payment_mode')}}</strong>
                                        </span>
                                        @endif  
                                    </div>
                                    <p class="text-start text-dark">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0" id="Payments-1" name="payment_mode" value="Payments">
                                        <label class="form-check-label" for="Payments-1">Check Payments</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0 {{$errors->has('payment_mode')?'is-invalid':''}}" id="Delivery-1" name="payment_mode" value="Cash On Delivery">
                                        <label class="form-check-label" for="Delivery-1">Cash On Delivery</label>
                                        @if($errors->has('payment_mode'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('payment_mode')}}</strong>
                                        </span>
                                        @endif  
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                                <div class="col-12">
                                    <div class="form-check text-start my-3">
                                        <input type="radio" class="form-check-input bg-primary border-0 {{$errors->has('payment_mode')?'is-invalid':''}}" id="Paypal-1" name="payment_mode" value="Paypal">
                                        <label class="form-check-label" for="Paypal-1">Paypal</label>
                                        @if($errors->has('payment_mode'))
                                        <span class="invalid-feedback">
                                            <strong>{{$errors->first('payment_mode')}}</strong>
                                        </span>
                                        @endif  
                                    </div>
                                </div>
                            </div> -->
                            
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order | Cash On Delivery</button>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button type="button" id="btn_paypal" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Pay via Paypal</button>
                                 <!-- <a href="{{route('make.payment')}}" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Pay via Paypal</a> -->
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        <!-- Checkout Page End -->


        <!-- Footer Start -->
        @include('folder.footer')
        <!-- Footer End -->

    </body>
    
    <script>
    $(document).ready(function() {
        $(document).on('click', '#btn_paypal', function(e) {
            var userid = $('#user_id').val();
            var fname = $('#first_name').val();
            var lname = $('#last_name').val();
            var email = $('#email').val();
            var mobile = $('#mobile').val();
            var address = $('#address').val();
            var landmark = $('#landmark').val();
            var city = $('#city').val();
            var country = $('#country').val();
            var postcode = $('#postcode').val();
            var final_amount = $('#final_amt').val();
            var data = {
                'user_id' : userid,
                'first_name' : fname,
                'last_name' : lname,
                'email' : email,
                'mobile' : mobile,
                'address' : address,
                'landmark' : landmark,
                'city' : city,
                'country' : country,
                'postcode' : postcode,
                'final_amt' : final_amount
            }

            if(fname != '' && lname != '' && email != '' && mobile != '' && address != '' && landmark != '' && city != '' && country != '' && postcode != '') 
            {
                
                $.ajax({
                        type : 'get',
                        url  : "{{route('make.payment')}}",
                        data : data,
                        dataType : 'json',
                        success: function (response) 
                        {
                            //console.log(response);
                            
                            var paypal_item = response.payment_link;
                            location.href = paypal_item['links'][1]['href'];
                            //console.log(paypal_item);
                            // paypal_item.forEach(function(item)
                            // {
                            //     console.log(item);
                            // });
                        }
                    });
            }
            else
            {
                $('.input_error').html('This field is required!');
            }
        });
    });
</script>
    
</html>