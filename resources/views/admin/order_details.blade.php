<!DOCTYPE html>
<html lang="en">

@include('admin_folder.header')

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin_folder.left_menu')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="backend/index.html" class="logo">
                            <img src="backend/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                @include('admin_folder.top_index')
                <!-- End Navbar -->
            </div>

            <!-- Cart Delete Modal Search Start -->
            <div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Delete Order</h4>
                        </div>
                        <div class="modal-body">
                        <input type="hidden" id="set_cart_id">
                        <p>Are you sure you want to delete this order?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="btn_close" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="btn_del_user">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Cart Delete Modal Search End -->

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Forms</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Order Details</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Order Table</div>
                                </div>
                                <div class="msg_div"></div>
                                <div class="card-body">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Mobile No</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Product Image</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Payment Mode</th>
                                                <th scope="col">Status</th>
                                                <!-- <th scope="col">Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order_details as $key => $order)
                                            <?php $price = number_format((float)$order->total, 2, '.', '')?>
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->mobile}}</td>
                                                <td>{{$order->product_name}}</td>
                                                <td><img src="images/products_image/{{$order->product_image}}" width="80" height="50" alt=""></td>
                                                <td>{{$order->quantity}}</td>
                                                <td>&#x20b9; {{$price}}</td>
                                                <td>{{$order->payment_mode}}</td>
                                                <td>{{$order->paymentId}}</td>
                                                <!-- <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger btn_delete"
                                                            data-original-title="Remove" get_cart_id="{{$order->id}}">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td> -->
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @include('admin_folder.footer')
</body>

<script>
    $(document).ready(function() {
        $(document).on('click', '.btn_delete', function(e) {
            e.preventDefault();
            $('#GSCCModal').modal('show');
            var user_id = $(this).attr('get_cart_id');
            $('#set_user_id').val(user_id);
            //console.log(user_id);
            
        });

        $(document).on('click', '#btn_close', function(e) {
            e.preventDefault();
            $('#GSCCModal').modal('hide');
        });

        $(document).on('click', '#btn_del_user', function(e) {
            e.preventDefault();
            var cart_id = $('#set_cart_id').val();
            //console.log(cart_id);
            if(cart_id != '')
            {
                var data = {
                    'cart_id': cart_id
                }
                $.ajax({
                    type: 'get',
                    url: '/delete_order_details',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        //console.log(response);                        
                        if(response.status == 'deleted')
                        {
                            $('#GSCCModal').modal('hide');
                            $('.msg_div').html('This Order Deleted Successfully');
                            $('.msg_div').html("");
                            setTimeout(function() {
                                $('.msg_div').fadeOut('fast');
                            }, 5000);
                            window.location.reload();
                        }
                    }
                });
            }
        });
    });
</script>
</html>