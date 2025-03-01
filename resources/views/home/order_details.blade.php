<!DOCTYPE html>
<html lang="en">

@include('folder.header')

<body>

    <!-- Spinner Start -->
    @include('folder.top_menu')
    <!-- Spinner End -->



    <!-- Checkout Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="container-fluid featurs py-5">
                <div class="container py-5">
                    <div class="row g-4"><div class="col-lg-4 text-start">
                        <h1>Order Details</h1>
                    </div>
                        @foreach($order_details as $key => $order)
                        <div id="success_meg"></div>
                        <?php $price = number_format((float)$order->total, 2, '.', '')?>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="featurs-item text-center rounded bg-light p-4">
                                <table class="table">
                                    <tbody>
                                        <td><img src="images/products_image/{{$order->product_image}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt=""></td>
                                        <td>
                                            <h5><b>Product Name :</b> {{$order->product_name}}</h5>
                                            <h6><b>Payment Mode :</b> {{$order->payment_mode}}</h6>
                                        </td>
                                        <td>
                                            <h6><b>Quantity :</b> {{$order->quantity}}</h6>
                                            <h6><b>Price :</b> &#x20b9; {{$price}}</h6>
                                        </td>
                                        <td>
                                            <h5><b>Mobile :</b> {{$order->mobile}}</h5>
                                            <h6><b>Email :</b> {{$order->email}}</h6>
                                        </td>
                                        <td>
                                            <h6><b>Address :</b> <br>
                                            {{$order->first_name}}<br>
                                            {{$order->address}}<br>
                                            {{$order->city}}<br>
                                            {{$order->country}}<br>
                                            {{$order->postcode}}<br>
                                            </h6>
                                        </td>
                                        <td>
                                            <h5><b>Payment Mode :</b> {{$order->payment_mode}}</h5>
                                            
                                            <h6><b>Payment Status :</b> {{$order->paymentId}}</h6>
                                        </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Checkout Page End -->


    <!-- Footer Start -->
    @include('folder.footer')
    <!-- Footer End -->

</body>

<script>
    $(document).ready(function(e) {
        e.preventDefault();
        $('#success_meg').html('<h4 style="color: green;margin-left:25%;">This Order has been placed successfully.</h4>');
        setTimeout(function() {
            $('#success_meg').fadeOut('fast');
        }, 3000);
        
    });
</script>
</html>