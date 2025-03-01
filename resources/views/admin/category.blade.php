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
                                <a href="#">Add Category</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Category</div>
                                </div>
                                <!-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif -->
                                <form action="/category_store" enctype="multipart/form-data" method="POST">
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
                                                        <input type="text" class="form-control {{$errors->has('category')?'is-invalid':''}}" name="category" id="cate_name" placeholder="Enter Category" />
                                                        @if($errors->has('category'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('category')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="category_id" id="category_id">
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="smallSelect">Status</label>
                                                        <select class="form-select form-control-sm {{$errors->has('cate_status')?'is-invalid':''}}" id="cate_status" name="cate_status">
                                                            <option value="">Select</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Deactive">Deactive</option>
                                                        </select>
                                                        @if($errors->has('cate_status'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('cate_status')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" id="btn_submit" type="submit">Submit</button>

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
                                    <div class="card-title">Categories Table</div>
                                </div>
                                <div class="card-body">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $key => $category)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$category->category}}</td>
                                                <td>
                                                    @if($category->status == 'Active')
                                                        <span style="background-color: lightgreen;">{{$category->status}}</span>
                                                    @else
                                                        <span style="background-color: #ff0000b3;">{{$category->status}}</span>  
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" get_id="{{$category->id}}" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg btn_edit" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- <button type="button" get_id="{{$category->id}}" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger btn_delete"
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
            //const csrfToken = $('meta[name="csrf-token"]').attr('content');
            if(id != '')
            {
                var data = {
                    'cate_id' : id,
                }
                //$('#cate_status').empty();
                $.ajax({
                        type : 'get',
                        url  : '/get_category',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var cate_item = response.categories;
                            cate_item.forEach(function(item)
                            {
                                $('#category_id').val(item.id);
                                $('#cate_name').val(item.category);
                                //$('#cate_status').append('<option value=' + item.status + 'selected>' + item.status + '</option>');
                                $('#cate_status').val(item.status);
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