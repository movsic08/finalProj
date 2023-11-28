@extends('front.layouts.app')

@section('content')
    
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
              <li class="breadcrumb-item">Cart</li>
          </ol>
      </div>
  </div>
</section>

<section class=" section-9 pt-4">
  <div class="container">
      <div class="row">
        @include('front.message')

        @if(Cart::count() > 0)
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table" id="cart">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cart item-->
                            @if(!empty($cartContent))
                                @foreach($cartContent as $item)
                                    <tr>
                                        <td class="text-start">
                                            <div class="d-flex align-items-center">
                                                    {{-- <imgsrc="images/product-1.jpg"width=""height=""> --}}
                                                @if(!empty($item->options->productImage->image))
                                                    <img src="{{ asset('uploads/product/small/'.$item->options->productImage->image) }}" alt="">
                                                @else   
                                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="">
                                                @endif

                                                <h2>{{ $item->name }}</h2>
                                            </div>
                                        </td>
                                        <td>
                                            @php 
                                                $color = getColor($item->options->color);
                                            @endphp
                                            {{ !empty($color) ? $color->name : $item->options->color }}
                                        </td>

                                        <td>
                                            @php 
                                                $size = getSize($item->options->size);
                                            @endphp
                                            {{ !empty($size) ? $size->size : $item->options->size }}
                                        </td>

                                        <td  class="text-nowrap">&#8369; {{ number_format($item->price) }}</td>
                                        <td>
                                            <!-- $item->rowId is part of Laravel Shopping Cart Package-->
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 sub" data-id="{{ $item->rowId }}">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{ $item->qty }}">

                                                <!-- delete btn-->
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 add" data-id="{{ $item->rowId }}">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>

                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            &#8369; {{ number_format($item->price * $item->qty) }}
                                        </td>
                                        <td>
                                            <button onclick="deleteItem('{{ $item->rowId }}');"  class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            <!-- end of Cart item-->
                                                            
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">            
                <div class="card cart-summery">
                    <div class="sub-title">
                        <h2 class="bg-white">Cart Summery</h3>
                    </div> 
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2">
                            <div>Subtotal</div>
                            <div>&#8369; {{ Cart::subtotal() }}</div>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div>Shipping</div>
                            <div>&#8369; </div>
                        </div>
                        <div class="d-flex justify-content-between summery-end">
                            <div>Total</div>
                            <div>&#8369; {{ Cart::subtotal() }}</div>
                        </div>
                        <div class="pt-5">
                            <a href="{{ route('front.checkout') }}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>     
                <div class="input-group apply-coupan mt-4">
                    <input type="text" placeholder="Coupon Code" class="form-control">
                    <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                </div> 
            </div>
        @else
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h4>Your Cart is empty!</h4>
                    </div>
                </div>
            </div>
        @endif

      </div>
  </div>
</section>

@endsection

@section('customJs')
    <script>

        /*add and sub buttons*/
            //add btn
            $('.add').click(function(){
                var qtyElement = $(this).parent().prev(); //Qty input
                var qtyValue = parseInt(qtyElement.val());
                if(qtyValue < 10){
                    
                    qtyElement.val(qtyValue + 1);

                    var rowId = $(this).data('id'); //get rowId
                    var newQty = qtyElement.val(); //get the updated qty value
                    updateCart(rowId,newQty); //update cart
                }
            });


            //sub btn
            $('.sub').click(function(){
                var qtyElement = $(this).parent().next(); //
                var qtyValue = parseInt(qtyElement.val());
                if(qtyValue > 1){
                    
                    qtyElement.val(qtyValue - 1);
                    
                    var rowId = $(this).data('id'); //get rowId
                    var newQty = qtyElement.val(); //get the updated qty value
                    updateCart(rowId,newQty); //update cart
                }
            });
        /*end of add and sub buttons*/


        //Ajax to update the cart
        function updateCart(rowId,qty){
            $.ajax({
                url: '{{ route("front.updateCart") }}',
                type: 'post',
                data: {rowId: rowId, qty: qty},
                dataType: 'json',
                success: function(response){
                    if(response.status == true){
                        window.location.href = '{{ route("front.cart") }}';
                    }else if(response.status == false){
                        window.location.href = '{{ route("front.cart") }}';
                    }
                }
            });
        }

        //Ajax to delete cart item
        function deleteItem(rowId){
            //alert(rowId);
            
            if(confirm("Are you sure you want to delete? ")){
                $.ajax({
                    url: '{{ route("front.deleteItem.cart") }}',
                    type: 'post',
                    data: {rowId: rowId },
                    daatType: 'json',
                    success: function(response){
                        window.location.href = '{{ route("front.cart") }}';
                    }
                });
            }
            
            
        }
        


    </script>
@endsection