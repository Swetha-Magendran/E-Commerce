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
                                <a href="#">Add Product</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Product Details</div>
                                </div>
                                <form action="/product_store" enctype="multipart/form-data" method="POST">
                                    <div class="card-body">
                                        @if ($msg = Session::get('success'))
                                        <div class="alert alert-success">
                                            <strong>{{$msg}}</strong>
                                        </div>
                                        @endif
                                        <div class="row">
                                            @csrf
                                            <input type="hidden" name="product_id" id="product_id">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="email1">Product Name</label>
                                                        <input type="text" class="form-control {{$errors->has('pro_name')?'is-invalid':''}}" id="pro_name" name="pro_name" placeholder="Enter Product" />
                                                        @if($errors->has('pro_name'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('pro_name')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email1">Product Code</label>
                                                        <input type="text" class="form-control {{$errors->has('pro_code')?'is-invalid':''}}" id="pro_code" name="pro_code" placeholder="Enter Product Code" />
                                                        @if($errors->has('pro_code'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('pro_code')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">Description</label>
                                                        <textarea class="form-control {{$errors->has('description')?'is-invalid':''}}" name="description" id="description" rows="5">
                                                        </textarea>
                                                        @if($errors->has('description'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('description')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="smallSelect">Category</label>
                                                        <select class="form-select form-control-sm {{$errors->has('category_id')?'is-invalid':''}}" name="category_id" id="category_id">
                                                            <option value="">Select</option>
                                                            @foreach($categories as $key => $cate)
                                                            <option value="{{$cate->id}}">{{$cate->category}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('category_id'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('category_id')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email1">Sub Category</label>
                                                        <select class="form-select form-control-sm {{$errors->has('sub_category')?'is-invalid':''}}" name="sub_category" id="sub_category">
                                                            <!-- <option value="">Select</option> -->
                                                        </select>
                                                        @if($errors->has('sub_category'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('sub_category')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group" id="img_div">
                                                        <label for="exampleFormControlFile1">Product Image</label>
                                                        <input type="file" class="form-control-file {{$errors->has('image')?'is-invalid':''}}" name="image" id="image" />
                                                        <div id="img_file"></div>
                                                        @if($errors->has('image'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('image')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="email1">Price</label>
                                                        <input type="text" class="form-control {{$errors->has('price')?'is-invalid':''}}" name="price" id="price" placeholder="Enter Price" />
                                                        @if($errors->has('price'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('price')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email1">Discount</label>
                                                        <input type="text" class="form-control {{$errors->has('discount')?'is-invalid':''}}" name="discount" id="discount" placeholder="Enter Discount" />
                                                        @if($errors->has('discount'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('discount')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="smallSelect">Status</label>
                                                        <select class="form-select form-control-sm {{$errors->has('status')?'is-invalid':''}}" name="status" id="status">
                                                            <option value="">Select</option>
                                                            <option value="1">Active</option>
                                                            <option value="2">Deactive</option>
                                                        </select>
                                                        @if($errors->has('status'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('status')}}</strong>
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Product Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            id="multi-filter-select"
                                            class="display table table-striped table-hover">
                                            <thead>
                                            <tr>
                                                    <th>Product</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Price</th>
                                                    <th>Discount</th>
                                                    <th>Product Image</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $key => $product)
                                                <tr>
                                                    <td>{{$product->product_name}}</td>
                                                    <td>{{$product->category}}</td>
                                                    <td>{{$product->sub_category}}</td>
                                                    <td>{{$product->price}}</td>
                                                    <td>{{$product->discount}}</td>
                                                    <td>
                                                    <img src="images/products_image/{{$product->product_image}}" width="80" height="50" alt="">
                                                    </td>
                                                    <td>
                                                        @if($product->status == '1')
                                                            <span style="background-color: lightgreen;">Active</span>
                                                        @else
                                                            <span style="background-color: #ff0000b3;">Deactive</span>  
                                                        @endif
                                                    </td>
                                                    <td>
                                                    <div class="form-button-action">
                                                        <button type="button" get_id="{{$product->id}}" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg btn_edit" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
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

    </div>
    @include('admin_folder.footer')
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Datatables -->
  <script src="../assets/js/plugin/datatables/datatables.min.js"></script>
  <!-- Kaiadmin JS -->
  <script src="../assets/js/kaiadmin.min.js"></script>
  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="../assets/js/setting-demo2.js"></script>
  <script>
    $(document).ready(function () {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
          this.api()
            .columns()
            .every(function () {
              var column = this;
              var select = $(
                '<select class="form-select"><option value=""></option></select>'
              )
                .appendTo($(column.footer()).empty())
                .on("change", function () {
                  var val = $.fn.dataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();
                });

              column
                .data()
                .unique()
                .sort()
                .each(function (d, j) {
                  select.append(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      
    });
  </script>
<script>
    $(document).ready(function() {
        $(document).on('change', '#category_id', function(e) {
            e.preventDefault();

            var cate_id = $(this).val();
            var data = {
                'cate_id': cate_id,
            }
            console.log(cate_id);
            if (cate_id != '') {
                $('#sub_category').empty();
                $.ajax({
                    type: 'Get',
                    url: '/get_sub_category',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var sub_cate_item = response.sub_cate;
                        //console.log(response.sub_cate);
                        $('#sub_category').append('<option value="">Select Sub Category</option>');
                        sub_cate_item.forEach(function(item) {
                            //console.log(item.category);
                            $('#sub_category').append('<option value=' + item.id + '>' + item.sub_category + '</option>');
                        });
                    }
                });
            }
        });

        $(document).on('click', '.btn_edit', function(e) {
            var pro_id = $(this).attr('get_id');
            //console.log(pro_id);
            if(pro_id != '')
            {
                var data = {
                    'product_id' : pro_id,
                }
                
                $.ajax({
                        type : 'get',
                        url  : '/get_product',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var pro_item = response.products;
                            pro_item.forEach(function(item)
                            {
                                $('#product_id').val(item.id);
                                $('#pro_name').val(item.product_name);
                                $('#pro_code').val(item.product_code);
                                $('#description').text(item.description);
                                $('#category_id').val(item.category_id);
                                $('#sub_category').append('<option value=' + item.sub_category_id + '>' + item.sub_category + '</option>');
                                //$('#sub_category').val(item.sub_category_id);
                                //$('#img_file').text(item.product_image);   
                                $('#price').val(item.price);
                                $('#discount').val(item.discount);
                                $('#status').val(item.status);
                            });
                        }
                    });
            }
        });

        $(document).on('click', '#btn_cancel', function(e) {
            $('#pro_name').val('');
            $('#pro_code').val('');
            $('#description').val('');
            $('#category_id').val('');
            $('#sub_category').val('');
            $('#image').val('');
            $('#price').val('');
            $('#discount').val('');
            $('#status').val('');
        });

    });
</script>

</html>