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
                            <h4 class="modal-title" id="myModalLabel">Delete Stock</h4>
                        </div>
                        <div class="modal-body">
                        <input type="hidden" id="set_stock_id">
                        <p>Are you sure you want to delete this stock?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="btn_close" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="btn_del_stock">Delete</button>
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
                                <a href="#">Add Stock</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Stock</div>
                                </div>
                                <form action="/stock_entry" enctype="multipart/form-data" method="POST">
                                    <div class="card-body">
                                        @if ($msg = Session::get('success'))
                                        <div class="alert alert-success msg_data">
                                            <strong>{{$msg}}</strong>
                                        </div>
                                        @endif
                                        <div class="row">
                                            @csrf
                                            <input type="hidden" name="product_stock_id" id="product_stock_id">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email1">Product Name</label>
                                                        <select class="form-select form-control-sm {{$errors->has('product_id')?'is-invalid':''}}" name="product_id" id="product_id">
                                                            <option value="">Select</option>
                                                            @foreach($products as $key => $product)
                                                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('product_id'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('product_id')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email1">Product Recevied From</label>
                                                        <input type="text" class="form-control {{$errors->has('product_recevied_from')?'is-invalid':''}}" name="product_recevied_from" id="product_recevied_from" placeholder="Company Name" />
                                                        @if($errors->has('product_recevied_from'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('product_recevied_from')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">                                                    
                                                    <div class="form-group">
                                                        <label for="email1">Product Code</label>
                                                        <input type="text" class="form-control {{$errors->has('product_code')?'is-invalid':''}}" name="product_code" id="product_code" placeholder="Product Code" readonly/>
                                                        @if($errors->has('product_code'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('product_code')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email1">Product Stock</label>
                                                        <input type="text" class="form-control {{$errors->has('product_stock')?'is-invalid':''}}" name="product_stock" id="product_stock" placeholder="Product Stock" />
                                                        @if($errors->has('product_stock'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('product_stock')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="submit">Submit</button>

                                        <button class="btn btn-danger" id="btn_cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Stock Table</div>
                                </div>
                                <div class="msg_div"></div>
                                <div class="card-body">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Product Code</th>
                                                <th scope="col">Product Stock</th>
                                                <th scope="col">Recevied From</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stock_products as $key => $pro)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$pro->product_name}}</td>
                                                <td>{{$pro->product_code}}</td>
                                                <td>{{$pro->product_stock}}</td>
                                                <td>{{$pro->received_from}}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                    <button type="button" get_id="{{$pro->id}}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg btn_edit" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" get_id="{{$pro->id}}" data-bs-toggle="tooltip" title="" 
                                                        class="btn btn-link btn-danger btn_delete"
                                                        data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    </div>
                                                </td>
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
        $(document).on('change', '#product_id', function(e) {
            var id = $(this).val();
            //console.log(id);
            if(id != '')
            {
                var data = {
                    'product_id' : id,
                }

                $.ajax({
                        type : 'get',
                        url  : '/get_product_code',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var pro_item = response.product_code;
                            pro_item.forEach(function(item)
                            {
                                $('#product_code').val(item.product_code);
                            });
                        }
                    });
            }
        });


        $(document).on('click', '.btn_edit', function(e) {
            var stock_id = $(this).attr('get_id');
            //console.log(stock_id);
            if(stock_id != '')
            {
                var data = {
                    'stock_id' : stock_id,
                }

                $.ajax({
                        type : 'get',
                        url  : '/get_stock',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var stock_item = response.product_stock;
                            stock_item.forEach(function(item)
                            {
                                $('#product_stock_id').val(stock_id);
                                $('#product_id').val(item.product_id);
                                $('#product_code').val(item.product_code);
                                $('#product_stock').val(item.product_stock);
                                $('#product_recevied_from').val(item.received_from);
                            });
                        }
                    });
            }
        });

        $(document).on('click', '.btn_delete', function(e) {
            e.preventDefault();
            $('#GSCCModal').modal('show');
            var stock_id = $(this).attr('get_id');
            $('#set_stock_id').val(stock_id);
            //console.log(user_id);
            
        });

        $(document).on('click', '#btn_close', function(e) {
            e.preventDefault();
            $('#GSCCModal').modal('hide');
        });
        
        $(document).on('click', '#btn_del_stock', function(e) {
            var stock_id = $('#set_stock_id').val();
            //console.log(stock_id);
            if(stock_id != '')
            {
                var data = {
                    'stock_id' : stock_id,
                }

                $.ajax({
                        type : 'get',
                        url  : '/delete_stock',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            console.log(response);
                            if(response.status == 'deleted')
                            {
                                $('#GSCCModal').modal('hide');
                                $('.msg_data').html('This stock deleted successfully');
                                setTimeout(function() {
                                    $('.msg_data').fadeOut('fast');
                                }, 10000);
                                window.location.reload();
                            }
                        }
                    });
            }
        });
        
        $(document).on('click', '#btn_cancel', function(e) {
            $('#product_id').val('');
            $('#product_code').val('');
            $('#product_stock').val('');
            $('#product_recevied_from').val('');
        });
    });
</script>

</html>