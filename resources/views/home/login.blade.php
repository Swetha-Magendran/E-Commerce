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
                @if ($msg = Session::get('success'))
                <div class="alert alert-danger">
                    <strong>{{$msg}}</strong>
                </div>
                @endif
                <form action="{{route('authenticate')}}" method="POST">
                @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="text-center mx-auto" style="max-width: 700px;">
                                <h1 class="text-primary">Login</h1>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <input type="email" id="email" name="email" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('email')?'is-invalid':''}}" placeholder="Email">
                            @if($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('email')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-5">
                            <input type="password" id="password" name="password" class="w-100 form-control border-0 py-3 mb-4 {{$errors->has('password')?'is-invalid':''}}" placeholder="Password">
                            @if($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{$errors->first('password')}}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-lg-12" style="padding-left: 5% !important;">
                            <button type="submit" style="width: 50% !important;" class="w-100 btn form-control border-secondary py-3 bg-white text-primary">Submit</button>
                        </div>
                    </div>
                </form>
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


</body>

</html>