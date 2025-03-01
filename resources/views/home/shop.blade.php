<!DOCTYPE html>
<html lang="en">

    @include('folder.header')

    <body>

        <!-- Navbar start -->
        @include('folder.top_menu')
        <!-- Navbar End -->

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('shop')}}">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h1 class="mb-4">Fresh fruits shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <!-- <div class="row g-4">
                            <div class="col-xl-3">
                                <div class="input-group w-100 mx-auto d-flex">
                                    <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                                    <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Default Sorting:</label>
                                    <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option value="volvo">Nothing</option>
                                        <option value="saab">Popularity</option>
                                        <option value="opel">Organic</option>
                                        <option value="audi">Fantastic</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                @foreach($categories as $key => $category)
                                                    @if($category->id == 1)
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                                            <span>({{$fruits_count}})</span>
                                                        </div>
                                                    </li>
                                                    @elseif($category->id == 2)
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                                            <span>({{$veg_count}})</span>
                                                        </div>
                                                    </li>
                                                    @elseif($category->id == 3)
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                                            <span>({{$bread_count}})</span>
                                                        </div>
                                                    </li>
                                                    @elseif($category->id == 4)
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#" class="category_id" value="{{$category->id}}"><i class="fas fa-apple-alt me-2"></i>{{$category->category}}</a>
                                                            <span>({{$meat_count}})</span>
                                                        </div>
                                                    </li>
                                                    @else
                                                    <!-- <li>    
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="#"><i class="fas fa-apple-alt me-2"></i>Fresh</a>
                                                            <span>(2)</span>
                                                        </div>
                                                    </li> -->
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4 class="mb-2">Price</h4>
                                            <input type="range" class="form-range w-100" id="rangeInput" name="rangeInput" min="0" max="1000" value="0" oninput="amount.value=rangeInput.value">
                                            <output id="amount" name="amount" min-velue="0" max-value="500" for="rangeInput">0</output>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Additional</h4>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 sub_category_val" id="Categories-1" get_id="1" name="Categories-1" value="Beverages">
                                                <label for="Categories-1"> Organic</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 sub_category_val" id="Categories-2" get_id="2" name="Categories-1" value="Beverages">
                                                <label for="Categories-2"> Fresh</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 sub_category_val" id="Categories-3" get_id="3" name="Categories-1" value="Beverages">
                                                <label for="Categories-3"> Sales</label>
                                            </div>
                                            <div class="mb-2">
                                                <input type="radio" class="me-2 sub_category_val" id="Categories-4" get_id="4" name="Categories-1" value="Beverages">
                                                <label for="Categories-4"> Discount</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <h4 class="mb-3">Featured products</h4>
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
                                            <img src="img/banner-fruits.jpg" class="img-fluid w-100 rounded" alt="">
                                            <div class="position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%);">
                                                <h3 class="text-secondary fw-bold">Fresh <br> Fruits <br> Banner</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center" id="get_all_products">
                                    @foreach($all_products as $key => $product)
                                    <?php $price = $product->price;
                                        $dis = $product->discount;
                                        $dicval = $dis / 100;
                                        $cal = $dicval * $price;
                                        $get_val = $price - $cal;  
                                        $final_rate = number_format((float)$get_val, 2, '.', '');                          
                                    ?>
                                    <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <a href="/get_product_details/{{$product->id}}" target="_blank">
                                                <img src="images/products_image/{{$product->product_image}}" class="img-fluid w-100 rounded-top" alt="">
                                                </a>
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$product->category}}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>{{$product->product_name}}</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;"><del>&#x20b9; {{$product->price}}</del></p>
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;">&#x20b9; {{$final_rate}} /Kg</p>
                                                    @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                                                    <a href="/get_product_details/{{$product->id}}" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @else                                                    
                                                    <a href="/login" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            <a href="#" class="rounded">&laquo;</a>
                                            <a href="#" class="active rounded">1</a>
                                            <a href="#" class="rounded">2</a>
                                            <a href="#" class="rounded">3</a>
                                            <a href="#" class="rounded">4</a>
                                            <a href="#" class="rounded">5</a>
                                            <a href="#" class="rounded">6</a>
                                            <a href="#" class="rounded">&raquo;</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->


        <!-- Footer Start -->
        @include('folder.footer')
        <!-- Footer End -->

    </body>

    <script>
        $(document).ready(function() {
            //Category Wise List Out Products
            $(document).on('click', '.category_id', function(e) {
                e.preventDefault();
                var data = {
                    cate_id : $(this).attr('value')
                }
                //console.log(data);
                if($(this).attr('value') != '')
                {                    
                    $('#get_all_products').empty();
                    $.ajax({
                        type : 'get',
                        url  : '/get_category_wise_product',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var cate_pro_item = response.category_wise_product;
                            cate_pro_item.forEach(function(item)
                            {
                                $price = item.price;
                                $dis = item.discount;
                                $dicval = $dis / 100;
                                $cal = $dicval * $price;
                                $get_val = $price - $cal;  
                                $final_rate = $get_val.toFixed(2);

                                const product = `
                                   <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <a href="/get_product_details/${item.id}" target="_blank">
                                                <img src="images/products_image/${item.product_image}" class="img-fluid w-100 rounded-top" alt="">
                                                </a>
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">${item.category}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>${item.product_name}</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;"><del>&#x20b9; ${item.price}</del></p>
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;">&#x20b9; ${$final_rate} /Kg</p>
                                                    @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                                                    <a href="/get_product_details/${item.id}" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @else                                                    
                                                    <a href="/login" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> `;
                                $('#get_all_products').append(product);
                            });
                        }
                    });
                }
            });

            //Sub Category Wise List Out Products
            $(document).on('click', '.sub_category_val', function(e) {
                e.preventDefault();
                var data = {
                    sub_cate : $(this).attr('get_id')
                }
                //console.log(data);
                if($(this).attr('value') != '')
                {                    
                    $('#get_all_products').empty();
                    $.ajax({
                        type : 'get',
                        url  : '/get_sub_category_wise_product',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var sub_cate_pro_item = response.sub_category_wise_product;
                            sub_cate_pro_item.forEach(function(item)
                            {
                                $price = item.price;
                                $dis = item.discount;
                                $dicval = $dis / 100;
                                $cal = $dicval * $price;
                                $get_val = $price - $cal;  
                                $final_rate = $get_val.toFixed(2);

                                const product = `
                                   <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <a href="/get_product_details/${item.id}" target="_blank">
                                                <img src="images/products_image/${item.product_image}" class="img-fluid w-100 rounded-top" alt="">
                                                </a>
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">${item.category}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>${item.product_name}</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;"><del>&#x20b9; ${item.price}</del></p>
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;">&#x20b9; ${$final_rate} /Kg</p>
                                                    @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                                                    <a href="/get_product_details/${item.id}" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @else                                                    
                                                    <a href="/login" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> `;
                                $('#get_all_products').append(product);
                            });
                        }
                    });
                }
            });

            $(document).on('input', '#rangeInput', function(e) {
                e.preventDefault();
                var data = {
                    price : $(this).val()
                }
                //console.log(data);
                if($(this).val() != '')
                {
                    $('#get_all_products').empty();
                    $.ajax({
                        type : 'get',
                        url  : '/get_price_wise_product',
                        data : data,
                        dataType : 'json',
                        success: function (response) {
                            //console.log(response);
                            var price_wise_pro_item = response.price_wise_product;
                            price_wise_pro_item.forEach(function(item)
                            {   
                                $price = item.price;
                                $dis = item.discount;
                                $dicval = $dis / 100;
                                $cal = $dicval * $price;
                                $get_val = $price - $cal;  
                                $final_rate = $get_val.toFixed(2);

                                const product = `
                                   <div class="col-md-6 col-lg-6 col-xl-4">
                                        <div class="rounded position-relative fruite-item">
                                            <div class="fruite-img">
                                                <a href="/get_product_details/${item.id}" target="_blank">
                                                <img src="images/products_image/${item.product_image}" class="img-fluid w-100 rounded-top" alt="">
                                                </a>
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">${item.category}</div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4>${item.product_name}</h4>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt</p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;"><del>&#x20b9; ${item.price}</del></p>
                                                    <p class="text-dark fw-bold mb-0" style="font-size: 1.rem !important;">&#x20b9; ${$final_rate} /Kg</p>
                                                    @if (!empty(Auth::id() && Auth::user()->usertype == 'User'))
                                                    <a href="/get_product_details/${item.id}" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @else                                                    
                                                    <a href="/login" class="btn border border-secondary rounded-pill px-3 text-primary">
                                                        <i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> `;
                                $('#get_all_products').append(product);
                            });
                        }
                    });
                }
            });
        });
    </script>
</html>