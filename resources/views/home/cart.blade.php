<!DOCTYPE html>
<html lang="en">

@include('folder.header')

<body>

    <!-- Navbar start -->
    @include('folder.top_menu')
    <!-- Navbar End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('shop')}}">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <!-- Cart Delete Modal Search Start -->
    <div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                </div>
                <div class="modal-body">
                <input type="hidden" id="get_user_id">
                <input type="hidden" id="get_cart_id">
                <p>Are you sure you want to delete this product?</p>
                </div>          
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" id="btn_del_cart_item">Delete</button>
                </div>
            </div>  
        </div>
    </div>
    <!-- Cart Delete Modal Search End -->

    <!-- Check Out Modal Search Start -->
    <div id="CheckOutModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">CheckOut</h4>
                </div>
                <div class="modal-body">
                <p>Please wait</p>
                <h3>Processing.....</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="btn_checkout_close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn_end">Proceed</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Check Out Modal Search End -->

    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">            
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Discount</th>
                            <th scope="col">Selling Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                        @foreach($tem_cart_list as $key => $cart_list)
                        <tr id="cart_row_{{$cart_list->cart_id}}">
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="images/products_image/{{$cart_list->product_image}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{$cart_list->product_name}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">&#x20b9; {{$cart_list->price}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">{{$cart_list->discount}} %</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4">&#x20b9; {{$cart_list->total}}</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border get_quantity" get_pro_id="{{$cart_list->id}}" get_cart_id="{{$cart_list->cart_id}}" row_id="{{$key+1}}" get_dis="{{$cart_list->discount}}" get_price="{{$cart_list->price}}" get_id="{{$cart_list->user_id}}">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0" id="{{$key+1}}" value="{{$cart_list->quantity}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border get_quantity" get_pro_id="{{$cart_list->id}}" get_cart_id="{{$cart_list->cart_id}}" row_id="{{$key+1}}" get_dis="{{$cart_list->discount}}" get_price="{{$cart_list->price}}" get_id="{{$cart_list->user_id}}">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4" id="set_total_{{$key+1}}">&#x20b9; {{$cart_list->total}} </p>
                            </td>
                            <td>
                                <button class="btn btn-md rounded-circle bg-light border mt-4 del_cart_item" get_id="{{$cart_list->user_id}}" get_cart_id="{{$cart_list->cart_id}}">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                        @endforeach
                        @else
                        <tr>Your cart is Empty!</tr>
                        @endif

                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <!-- <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply Coupon</button> -->
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">

                        @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                        <?php $sum_tot_Price = 0 ?>
                        @foreach($tem_cart_list as $key => $cart_list)
                        <?php $sum_tot_Price += $cart_list->total ?>

                        @endforeach
                        @endif
                        @if($sum_tot_Price != 0)
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="cart_total" value="{{$sum_tot_Price}}">&#x20b9; {{$sum_tot_Price}}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat Rate: &#x20b9; 30.00</p>
                                    <input type="hidden" id="flat_rate" value="30">
                                </div>
                            </div>
                            <p class="mb-0 text-end">Shipping to {{$cart_list->city}}.</p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="final_total">&#x20b9; 0.00</p>
                        </div>
                        <a href="/checkout" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" 
                            id="btn_proceed" type="button">Proceed Checkout</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->


    <!-- Footer Start -->
    @include('folder.footer')
    <!-- Footer End -->

</body>

<script>
    $(document).ready(function() {
        var total = $('#cart_total').attr('value');
        var val = $('#flat_rate').val();
        var tot = parseFloat(total) + parseInt(val);
        $('#final_total').empty();
        var final = $('#final_total').append('&#x20b9; ' + tot.toFixed(2));
        // console.log(total);
        // console.log(val);
        // console.log(tot);
        $(document).on('click', '.get_quantity', function(e) {
            e.preventDefault();
            var user_id = $(this).attr('get_id');
            var pro_id = $(this).attr('get_pro_id');
            var row_id = $(this).attr('row_id');
            var qty = $('#' + row_id).val();
            var price = $(this).attr('get_price');
            var disc = $(this).attr('get_dis');
            var cart_id = $(this).attr('get_cart_id');

            var disVal = disc / 100;
            var calculate = disVal * price;
            var get_val = price - calculate;
            var tot = qty * get_val;

            $('#set_total_' + row_id).empty();
            $('#set_total_' + row_id).append('&#x20b9; ' + tot.toFixed(2));

            if (user_id != '' && pro_id != '') 
            {
                var data = {
                    'user_id': user_id,
                    'product_id': pro_id,
                    'quantity': qty,
                    'total': tot
                }
                $.ajax({
                    type: 'get',
                    url: '/update_cart_item',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response);
                        var cart_list = response.get_cart_list;
                        var a = 0;
                        cart_list.forEach(function(item) {
                            a += item.total;
                            //$('#category_id').val(item.id);
                        });                        
                        frate = parseFloat(a) + parseInt(val);
                        console.log(a);
                        console.log(frate);
                        $('#final_total').empty();
                        $('#cart_total').empty();
                        $('#cart_total').append('&#x20b9; ' + a.toFixed(2));
                        $('#final_total').append('&#x20b9; ' + frate.toFixed(2));
                    }
                });
            }
        });

        $(document).on('click', '.del_cart_item', function(e) {
            e.preventDefault();
            $('#GSCCModal').modal('show');
            var user_id = $(this).attr('get_id');
            var cart_id = $(this).attr('get_cart_id');
            $('#get_user_id').val('');
            $('#get_cart_id').val('');
            $('#get_user_id').val(user_id);
            $('#get_cart_id').val(cart_id);
            // console.log(user_id);
            // console.log(cart_id);
        });

        $(document).on('click', '#btn_close', function(e) {
            e.preventDefault();
            $('#GSCCModal').modal('hide');
        });

        $(document).on('click', '#btn_checkout_close', function(e) {
            e.preventDefault();
            $('#CheckOutModal').modal('hide');
        });

        $(document).on('click', '#btn_end', function(e) {
            e.preventDefault();
            $('#CheckOutModal').modal('hide');
        });

        //$(document).on('click', '#btn_proceed', function(e) {
        //    e.preventDefault();
        //    $('#CheckOutModal').modal('show');
        //});

        $(document).on('click', '#btn_del_cart_item', function(e) {
            e.preventDefault();
            var user_id = $('#get_user_id').val();
            var cart_id = $('#get_cart_id').val();
            // console.log(user_id);
            // console.log(cart_id);
            if(user_id != '' && cart_id != '')
            {
                var data = {
                    'user_id': user_id,
                    'cart_id': cart_id
                }
                $.ajax({
                    type: 'get',
                    url: '/delete_cart_item',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response);
                        if(response.status = 'deleted')
                        {
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
</script>

</html>