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
                                <a href="#">Add Sub Category</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Category</div>
                                </div>

                                <form action="/sub_category_store" enctype="multipart/form-data" method="POST">
                                    <div class="card-body">
                                        @if ($msg = Session::get('success'))
                                        <div class="alert alert-success">
                                            <strong>{{$msg}}</strong>
                                        </div>
                                        @endif
                                        <div class="row">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email1">Category</label>
                                                        <select class="form-select form-control-sm {{$errors->has('category_id')?'is-invalid':''}}" id="category_id" name="category_id">
                                                            <option value="">Select</option>
                                                            @foreach($categories as $key => $cate)
                                                            @if($cate->status != 'Deactive')
                                                            <option value="{{$cate->id}}">{{$cate->category}}</option>
                                                            @endif
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('category_id'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('category_id')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="sub_category_id" id="sub_category_id">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email1">Sub Category</label>
                                                        <input type="text" class="form-control {{$errors->has('sub_category')?'is-invalid':''}}" name="sub_category" id="sub_category" placeholder="Enter Sub Category" />
                                                        @if($errors->has('sub_category'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('sub_category')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="smallSelect">Status</label>
                                                        <select class="form-select form-control-sm {{$errors->has('status')?'is-invalid':''}}" id="status" name="status">
                                                            <option value="">Select</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Deactive">Deactive</option>
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Sub Categories Table</div>
                                </div>
                                <div class="card-body">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Sub Category Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sub_categories as $key => $sub_cate)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$sub_cate->category}}</td>
                                                <td>{{$sub_cate->sub_category}}</td>
                                                <td>
                                                    @if($sub_cate->status == 'Active')
                                                        <span style="background-color: lightgreen;">{{$sub_cate->status}}</span>
                                                    @else
                                                        <span style="background-color: #ff0000b3;">{{$sub_cate->status}}</span>  
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                    <button type="button" get_id="{{$sub_cate->id}}" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg btn_edit" data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <!-- <button type="button" get_id="{{$sub_cate->id}}" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger btn_delete"
                                                        data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button> -->
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
        $(document).on('click', '.btn_edit', function(e) {
            var id = $(this).attr('get_id');
            //console.log(id);
            if(id != '')
            {
                var data = {
                    'sub_cate_id' : id,
                }
                
                $.ajax({
                        type : 'get',
                        url  : '/get_sub_category',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var sub_cate_item = response.sub_cate;
                            sub_cate_item.forEach(function(item)
                            {
                                $('#sub_category_id').val(item.id);
                                $('#category_id').val(item.category_id);
                                $('#sub_category').val(item.sub_category);
                                $('#status').val(item.status);
                            });
                        }
                    });
            }
        });

        $(document).on('click', '#btn_cancel', function(e) {
            $('#category_id').val('');
            $('#cate_name').val('');
            $('#cate_status').empty();
        });
    });
</script>

</html>