<!DOCTYPE html>
<html lang="en">

@include('admin_folder.header')

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        
        <!-- End Sidebar -->

        <div class="main-panel">
            

            <div class="container">
                <div class="page-inner">
                    
                    <div class="row">
                        <div class="col-md-6" style="margin-left: 15%;">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Login</div>
                                </div>
                                @if ($msg = Session::get('success'))
                                <div class="alert alert-danger">
                                    <strong>{{$msg}}</strong>
                                </div>
                                @endif
                                @if($errors->any())
                                    <ul>
                                        {!! implode('', $errors->all('<li style="color: red;">:message</li>'))!!}
                                    </ul>
                                @endif
                                <form action="{{route('login_authentication')}}" method="POST" >
                                    <div class="card-body">
                                        <div class="row">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group" style="min-width: 150%;">
                                                        <label for="email1">Access</label>
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
                                                    <div class="form-group" style="min-width: 150%;">
                                                        <label for="email1">Email</label>
                                                        <input type="text" class="form-control {{$errors->has('email')?'is-invalid':''}}" name="email" id="email" placeholder="Email" />
                                                        @if($errors->has('email'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{$errors->first('email')}}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group" style="min-width: 150%;">
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
                                        <button class="btn btn-success" id="btn_submit" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    @include('admin_folder.footer')
</body>

</html>