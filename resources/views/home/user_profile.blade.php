<!DOCTYPE html>
<html lang="en">

@include('folder.header')

<body>

    <!-- Navbar start -->
    @include('folder.top_menu')
    <!-- Navbar End -->


    <!-- Single Page Header start -->
    <div class="container-fluid py-5">

    </div>
    <!-- Single Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="p-5 bg-light rounded">
                <div id="success_meg" style="color: sienna;"></div>
                @if(!empty(Auth::id() && Auth::user()->usertype == 'User'))
                <form action="{{route('store')}}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Profile Details</h1>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        @foreach($user_details as $key => $user_det)
                        <div class="col-lg-6">
                            <input type="text" id="name" name="name" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('name')?'is-invalid':''}}" value="{{$user_det->name}}" placeholder="First Name">
                            @if($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('name')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="mobile" name="mobile" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('mobile')?'is-invalid':''}}" value="{{$user_det->mobile}}" readonly placeholder="Mobile">
                            @if($errors->has('mobile'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('mobile')}}</strong>
                            </span>
                            @endif                           
                            <input type="password" id="password" name="password" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('password')?'is-invalid':''}}" placeholder="Password">
                            @if($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="address" name="address" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('address')?'is-invalid':''}}" value="{{$user_det->address}}" placeholder="Address">
                            @if($errors->has('address'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('address')}}</strong>
                            </span>
                            @endif 
                            <input type="text" id="city" name="city" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('city')?'is-invalid':''}}" value="{{$user_det->city}}" placeholder="City">
                            @if($errors->has('city'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('city')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="postcode" name="postcode" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('postcode')?'is-invalid':''}}" value="{{$user_det->postcode}}" placeholder="Postcode">
                            @if($errors->has('postcode'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('postcode')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <input type="text" id="lname" name="lname" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('lname')?'is-invalid':''}}" value="{{$user_det->lname}}" placeholder="Lastname">
                            @if($errors->has('lname'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('lname')}}</strong>
                            </span>
                            @endif
                            <input type="email" id="email" name="email" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('email')?'is-invalid':''}}" value="{{$user_det->email}}" readonly placeholder="Email">
                            @if($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                            @endif  
                            <input type="password" id="con_password" name="password_confirmation" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('password_confirmation')?'is-invalid':''}}" placeholder="Confirm Password">
                            @if($errors->has('con_password'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('con_password')}}</strong>
                            </span>
                            @endif<span id='message'></span>                          
                            <input type="text" id="landmark" name="landmark" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('landmark')?'is-invalid':''}}" value="{{$user_det->landmark}}" placeholder="Landmark">
                            @if($errors->has('landmark'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('landmark')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="country" name="country" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('country')?'is-invalid':''}}" value="{{$user_det->country}}" placeholder="Country">
                            @if($errors->has('country'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('country')}}</strong>
                            </span>
                            @endif
                        </div>
                        @endforeach
                        <div class="col-lg-12" style="padding-left: 5% !important;">
                            <button type="submit" style="width: 50% !important;" class="w-100 btn form-control border-secondary py-3 bg-white text-primary">Update</button>
                        </div>
                    </div>
                </form>
                @else
                <form action="{{route('store')}}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Profile Details</h1>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="0">
                        <div class="col-lg-6">
                            <input type="text" id="name" name="name" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('name')?'is-invalid':''}}" value="" placeholder="First Name">
                            @if($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('name')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="mobile" name="mobile" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('mobile')?'is-invalid':''}}" value="" placeholder="Mobile">
                            @if($errors->has('mobile'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('mobile')}}</strong>
                            </span>
                            @endif                           
                            <input type="password" id="password" name="password" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('password')?'is-invalid':''}}" placeholder="Password">
                            @if($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="address" name="address" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('address')?'is-invalid':''}}" value="" placeholder="Address">
                            @if($errors->has('address'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('address')}}</strong>
                            </span>
                            @endif 
                            <input type="text" id="city" name="city" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('city')?'is-invalid':''}}" value="" placeholder="City">
                            @if($errors->has('city'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('city')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="postcode" name="postcode" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('postcode')?'is-invalid':''}}" value="" placeholder="Postcode">
                            @if($errors->has('postcode'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('postcode')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <input type="text" id="lname" name="lname" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('lname')?'is-invalid':''}}" value="" placeholder="Lastname">
                            @if($errors->has('lname'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('lname')}}</strong>
                            </span>
                            @endif
                            <input type="email" id="email" name="email" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('email')?'is-invalid':''}}" value=""  placeholder="Email">
                            @if($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                            @endif  
                            <input type="password" id="con_password" name="password_confirmation" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('password_confirmation')?'is-invalid':''}}" placeholder="Confirm Password">
                            @if($errors->has('con_password'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('con_password')}}</strong>
                            </span>
                            @endif<span id='message'></span>                          
                            <input type="text" id="landmark" name="landmark" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('landmark')?'is-invalid':''}}" value="" placeholder="Landmark">
                            @if($errors->has('landmark'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('landmark')}}</strong>
                            </span>
                            @endif
                            <input type="text" id="country" name="country" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('country')?'is-invalid':''}}" value="" placeholder="Country">
                            @if($errors->has('country'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('country')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-12" style="padding-left: 5% !important;">
                            <button type="submit" style="width: 50% !important;" class="w-100 btn form-control border-secondary py-3 bg-white text-primary">Submit</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
    <!-- Contact End -->



    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        // $(document).ready(function() {
        //     $(document).on('click', '#btn_submit', function(e) {
        //         e.preventDefault();
        //         const csrfToken = $('meta[name="csrf-token"]').attr('content');

        //         var name = $('#user_name').val();
        //         var mobile = $('#mobile_no').val();
        //         var addr = $('#address').val();
        //         var mail = $('#email').val();
        //         var pwd = $('#password').val();
        //         var con_pwd = $('#con_password').val();

        //         if (name != '' && mobile != '' && addr != '' && mail != '' && pwd != '' && con_pwd != '') {
        //             if ($('#password').val() == $('#con_password').val()) {
        //                 $('#message').html('Matching').css('color', 'green');
        //                 $('.error').empty();
        //                 var data = {
        //                     'name': $('#user_name').val(),
        //                     'mobile': $('#mobile_no').val(),
        //                     'address': $('#address').val(),
        //                     'email': $('#email').val(),
        //                     'password': $('#password').val()
        //                 }

        //                 $.ajax({
        //                     type: 'POST',
        //                     url: '/create_user',
        //                     headers: {
        //                         'X-CSRF-Token': csrfToken
        //                     },
        //                     data: data,
        //                     dataType: 'json',
        //                     success: function(response) {
        //                         //console.log(response.Status);
        //                         if (response.Status == 'User Added') {
        //                             $('#success_meg').html('User Details Added Successfully');
        //                             $('#user_name').val('');
        //                             $('#mobile_no').val('');
        //                             $('#address').val('');
        //                             $('#email').val('');
        //                             $('#password').val('');
        //                             $('#con_password').val('');
        //                             $('#message').html("");
        //                             setTimeout(function() {
        //                                 $('#success_meg').fadeOut('fast');
        //                             }, 5000);
        //                         } else {

        //                         }
        //                     }
        //                 });
        //             } else {
        //                 $('#message').html('Not Matching').css('color', 'red');
        //             }

        //         } else {
        //             $('.error').html('This field is required!');
        //         }
        //     });
        // });
    </script>
</body>

</html>