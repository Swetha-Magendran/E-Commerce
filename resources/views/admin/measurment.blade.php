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
                                <a href="#">Add Measurment</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Measurment</div>
                                </div>
                                <form action="/measurment_store" enctype="multipart/form-data" method="POST">
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
                                                        <label for="email1">Measurment</label>
                                                        <input type="text" class="form-control {{$errors->has('measurment')?'is-invalid':''}}" name="measurment" id="measurment" placeholder="Enter Measurment" />
                                                        @if($errors->has('measurment'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('measurment')}}</strong>
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
                                                <div class="col-sm-4">
                                                    
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
                                    <div class="card-title">Measurment Table</div>
                                </div>
                                <div class="card-body">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Measurment Name</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($measur_val as $key => $measur)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$measur->measurment}}</td>
                                                <td>
                                                    @if($measur->status == 'Active')
                                                        <span style="background-color: lightgreen;">{{$measur->status}}</span>
                                                    @else
                                                        <span style="background-color: #ff0000b3;">{{$measur->status}}</span>  
                                                    @endif
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
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            if(id != '')
            {
                var data = {
                    'cate_id' : id,
                }

                $.ajax({
                        type : 'POST',
                        url  : '/get_category',
                        headers: { 'X-CSRF-Token': csrfToken },
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var cate_item = response.categories;
                            cate_item.forEach(function(item)
                            {
                                //console.log(item.category);
                                $('#cate_name').val(item.category);
                                $('#cate_status').val(item.status);
                                $('#category_id').val(id);
                                //$('#cate_img').append('<img src="images/category/"'+item.category_image+' width="100" height="80" alt="">');
                                //$('#cate_status').append('<option value=' + item.status + '>' + item.status + '</option>');
                            });
                        }
                    });
            }
        });

        $(document).on('click', '.btn_delete', function(e) {
            var id = $(this).attr('get_id');
            //console.log(id);
        });
    });
</script>
</html>