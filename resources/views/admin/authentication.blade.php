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
                                <a href="#">Login Authority</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Login Authority</div>
                                </div>
                                <form action="{{route('login_authority')}}" enctype="multipart/form-data" method="POST">
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
                                                        <label for="email1">Authentication</label>
                                                        <select name="authentication" id="authentication" class="form-control {{$errors->has('authentication')?'is-invalid':''}}">
                                                            <option value="">Select</option>
                                                            <option value="Admin">Admin</option>
                                                            <option value="Employee">Employee</option>
                                                            <option value="Store Keeper">Store Keeper</option>
                                                            <option value="Security">Security</option>
                                                        </select>
                                                        @if($errors->has('authentication'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('authentication')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <input type="hidden" name="auth_id" id="auth_id">
                                                    <div class="form-group">
                                                        <label for="comment">Address</label>
                                                        <textarea class="form-control {{$errors->has('address')?'is-invalid':''}}" name="address" id="address" rows="5">
                                                        </textarea>
                                                        @if($errors->has('address'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('address')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email1">Name</label>
                                                        <input type="text" class="form-control {{$errors->has('user_name')?'is-invalid':''}}" name="user_name" id="user_name" placeholder="User Name" />
                                                        @if($errors->has('user_name'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('user_name')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email1">Mobile</label>
                                                        <input type="text" class="form-control {{$errors->has('mobile')?'is-invalid':''}}" name="mobile" id="mobile" placeholder="Mobile No" />
                                                        @if($errors->has('mobile'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('mobile')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="email1">Email Id</label>
                                                        <input type="text" class="form-control {{$errors->has('email')?'is-invalid':''}}" name="email" id="email" placeholder="Email" />
                                                        @if($errors->has('email'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('email')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email1">Password</label>
                                                        <input type="password" class="form-control {{$errors->has('password')?'is-invalid':''}}" name="password" id="password" placeholder="Password" />
                                                        @if($errors->has('password'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('password')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
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
                                    <div class="card-title">Authentication Table</div>
                                </div>
                                <div class="card-body">
                                    <table class="table mt-3">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Authority</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Mobile</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($access_list as $key => $access)
                                            @if($access->usertype != 'User')
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$access->usertype}}</td>
                                                <td>{{$access->name}}</td>
                                                <td>{{$access->email}}</td>
                                                <td>{{$access->mobile}}</td>
                                                <td>{{$access->address}}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" get_id="{{$access->id}}" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg btn_edit" data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <!-- <button type="button" get_id="{{$access->id}}" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger btn_delete"
                                                            data-original-title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button> -->
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
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
            var auth_id = $(this).attr('get_id');
            //console.log(auth_id);
            if(auth_id != '')
            {
                var data = {
                    'auth_id' : auth_id,
                }
                $.ajax({
                        type : 'get',
                        url  : '{{route("get_authentication")}}',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var auth_item = response.auth_data;
                            // auth_item.forEach(function(item)
                            // {
                                $('#auth_id').val(auth_item.id);
                                $('#authentication').val(auth_item.usertype);
                                $('#user_name').val(auth_item.name);
                                $('#mobile').val(auth_item.mobile);
                                $('#email').val(auth_item.email);                                
                                $('#address').val(auth_item.address);
                            //});
                        }
                    });
            }
        });

        $(document).on('click', '#btn_cancel', function(e) {
            $('#auth_id').val('');
            $('#authentication').val('');
            $('#user_name').val('');
            $('#mobile').val('');
            $('#email').val('');                                
            $('#address').val('');
            $('#password').val('');
        });
    });
</script>

</html>