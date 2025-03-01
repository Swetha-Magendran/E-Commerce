<!DOCTYPE html>
<html lang="en">

@include('folder.header')

<body>

    <!-- Navbar start -->
    @include('folder.top_menu')
    <!-- Navbar End -->

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Shop Detail</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('shop')}}">Pages</a></li>
            <li class="breadcrumb-item active text-white">Shop Detail</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div id="success_meg"></div>
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        @foreach($product_details as $key => $pro_det)
                        <?php $price = $pro_det->price;
                            $dis = $pro_det->discount;
                            $dicval = $dis / 100;
                            $cal = $dicval * $price;
                            $get_val = $price - $cal; 
                            $final_rate = number_format((float)$get_val, 2, '.', '');                           
                        ?>
                        <div class="col-lg-6">
                            <div class="border rounded">
                                <a href="#"> 
                                    <img src="{{url('images/products_image/')}}/{{$pro_det->product_image}}" class="img-fluid rounded" alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                            <input type="hidden" name="product_id" id="product_id" value="{{$pro_det->id}}">
                            <h4 class="fw-bold mb-3">{{$pro_det->product_name}}</h4>
                            <p class="mb-3">Category: {{$pro_det->category}}</p>
                            <h6 class="text-dark fs-5 fw-bold" style="font-family: auto !important;">
                                <del>&#x20b9; {{$pro_det->price}}</del></h6>
                                <h5 style="font-family: auto !important;">&#x20b9; {{$final_rate}}</h5>
                            <div class="d-flex mb-4">
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star text-secondary"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <p class="mb-4">{{$pro_det->description}}</p>
                            <p class="mb-4">Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish</p>
                            <div class="input-group quantity mb-5" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="quantity" name="quantity" class="form-control form-control-sm text-center border-0" value="1">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <a href="#" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary" id="add_to_cart">
                                <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs mb-3">
                                    <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                        id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                        aria-controls="nav-about" aria-selected="true">Description</button>
                                    <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                        id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                        aria-controls="nav-mission" aria-selected="false">Reviews</button>
                                </div>
                            </nav>
                            <div class="tab-content mb-5">
                                <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                    <p>{{$pro_det->description}}</p>
                                    <p>Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic
                                        icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.</p>
                                    <div class="px-2">
                                        <div class="row g-4">
                                            <div class="col-6">
                                                <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">1 kg</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Country of Origin</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Agro Farm</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Quality</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Organic</p>
                                                    </div>
                                                </div>
                                                <div class="row text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Сheck</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">Healthy</p>
                                                    </div>
                                                </div>
                                                <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                    <div class="col-6">
                                                        <p class="mb-0">Min Weight</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="mb-0">250 Kg</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                    <div class="d-flex">
                                        <img src="{{url('img/avatar.jpg')}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Jason Smith</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p>The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <img src="{{url('img/avatar.jpg')}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                        <div class="">
                                            <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                            <div class="d-flex justify-content-between">
                                                <h5>Sam Peters</h5>
                                                <div class="d-flex mb-3">
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star text-secondary"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <p class="text-dark">The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic
                                                words etc. Susp endisse ultricies nisi vel quam suscipit </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="nav-vision" role="tabpanel">
                                    <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                        amet diam et eos labore. 3</p>
                                    <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                        Clita erat ipsum et lorem et sit</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <form action="#">
                            <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0 me-4" placeholder="Your Name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0" placeholder="Your Email *">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea name="" id="" class="form-control border-0" cols="30" rows="8" placeholder="Your Review *" spellcheck="false"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Please rate:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star text-muted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <a href="#" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="input-group w-100 mx-auto d-flex mb-4">
                                <!-- <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span> -->
                            </div>
                            <div class="mb-4">
                                <h4>Categories</h4>
                                <ul class="list-unstyled fruite-categorie">
                                    @foreach($categories as $key => $category)
                                    @if($category->id == 1)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="/shop" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                            <span>({{$fruits_count}})</span>
                                        </div>
                                    </li>
                                    @elseif($category->id == 2)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="/shop" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                            <span>({{$veg_count}})</span>
                                        </div>
                                    </li>
                                    @elseif($category->id == 3)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="/shop" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                            <span>({{$bread_count}})</span>
                                        </div>
                                    </li>
                                    @elseif($category->id == 4)
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="/shop" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                            <span>({{$meat_count}})</span>
                                        </div>
                                    </li>
                                    @else
                                    <li>
                                        <div class="d-flex justify-content-between fruite-name">
                                            <a href="/shop"><i class="fas fa-apple-alt me-2"></i>Fresh</a>
                                            <span>(2)</span>
                                        </div>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h4 class="mb-4">Featured products</h4>
                            @foreach($featured_product as $key => $featured_pro)
                            <?php $price = $featured_pro->price;
                                $dis = $featured_pro->discount;
                                $dicval = $dis / 100;
                                $cal = $dicval * $price;
                                $get_val = $price - $cal; 
                                $final_rate = number_format((float)$get_val, 2, '.', '');                           
                            ?>
                            <div class="d-flex align-items-center justify-content-start">
                                <div class="rounded me-4" style="width: 100px; height: 100px;">
                                    <a href="/get_product_details/{{$featured_pro->id}}" target="_blank">
                                        <img src="{{url('images/products_image/')}}/{{$featured_pro->product_image}}" class="img-fluid rounded" alt="">
                                    </a>
                                </div>
                                <div>
                                    <h6 class="mb-2">{{$featured_pro->product_name}}</h6>
                                    <div class="d-flex mb-2">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <h5 class="fw-bold me-2" style="font-family: auto !important;">&#x20b9; {{$final_rate}}</h5>
                                        <h5 class="text-danger text-decoration-line-through" style="font-family: auto !important;"><del>&#x20b9; {{$featured_pro->price}}</del></h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="d-flex justify-content-center my-4">
                                <a href="/shop" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Vew More</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="position-relative">
                                <img src="{{url('img/banner-fruits.jpg')}}" class="img-fluid w-100 rounded" alt="">
                                <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                    <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="fw-bold mb-0">Related products</h1>
            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">
                    @foreach($cate_wise_product as $key => $cate_roduct)
                    <?php $price = $cate_roduct->price;
                        $dis = $cate_roduct->discount;
                        $dicval = $dis / 100;
                        $cal = $dicval * $price;
                        $get_val = $price - $cal; 
                        $final_rate = number_format((float)$get_val, 2, '.', '');                           
                    ?>
                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <a href="/get_product_details/{{$cate_roduct->id}}" target="_blank">
                                <img src="{{url('images/products_image/')}}/{{$cate_roduct->product_image}}" class="img-fluid w-100 rounded-top" alt="">
                            </a>
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{$cate_roduct->category}}</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>{{$cate_roduct->product_name}}</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;"><del>&#x20b9; {{$cate_roduct->price}}</del></p>
                            <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;">&#x20b9; {{$final_rate}} /Kg</p>
                                @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                                <a href="/get_product_details/{{$cate_roduct->id}}" class="btn border border-secondary rounded-pill px-3 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                @else                                                    
                                <a href="/login" class="btn border border-secondary rounded-pill px-3 text-primary">
                                    <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->


    <!-- Footer Start -->
    @include('folder.footer')
    <!-- Footer End -->

</body>

<script>
    $(document).ready(function() {
        $(document).on('click', '#add_to_cart', function(e) {
            var user_id = $('#user_id').val();
            var pro_id = $('#product_id').val();
            var qut = $('#quantity').val();
            // console.log(user_id);
            // console.log(pro_id);
            // console.log(qut);
            //const csrfToken = $('meta[name="csrf-token"]').attr('content');
            if(user_id != '' && pro_id != '')
            {
                var data = {
                    'user_id' : user_id,
                    'pro_id' : pro_id,
                    'quantity' : qut
                }
                
                $.ajax({
                        type : 'get',
                        url  : '{{route("add_to_cart")}}',
                        data : data,
                        dataType : 'json',
                        success: function (response) 
                        {
                            //console.log(response);
                            if(response.status == 'Success')
                            {
                                $('#success_meg').html('<h4 style="color: green; margin-left:25%;">This Product is added to cart. Please check your cart</h4>');
                                setTimeout(function() {
                                    $('#success_meg').fadeOut('fast');
                                }, 8000);
                                //$('.cart_tag').load();
                                $('#cart_val').empty();
                                $('#cart_val').html(response.cart_count);
                            }
                            else{
                                $('#success_meg').html('<h4 style="color: sienna;margin-left:25%;">This Product is already added to cart. Please check your cart</h4>');
                                setTimeout(function() {
                                    $('#success_meg').fadeOut('fast');
                                }, 8000);
                                //$('.cart_tag').load();
                            }
                        }
                    });
            }
        });
    });
</script>

</html>