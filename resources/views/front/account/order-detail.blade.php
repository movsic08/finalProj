@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
              <li class="breadcrumb-item">Settings</li>
          </ol>
      </div>
  </div>
</section>

<section class=" section-11 ">
  <div class="container  mt-5">
      <div class="row">
        

          <div class="col-md-3">
            @include('front.account.common.sidebar')
          </div>
          <div class="col-md-9">
              <div class="card">
                  <div class="card-header">
                      <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                  </div>

                  <div class="card-body pb-0">
                      <!-- Info -->
                      <div class="card card-sm">
                          <div class="card-body bg-light mb-3">
                              <div class="row">
                                  <div class="col-6 col-lg-3">
                                      <!-- Heading -->
                                      <h6 class="heading-xxxs text-muted">Order No:</h6>
                                      <!-- Text -->
                                      <p class="mb-lg-0 fs-sm fw-bold">
                                        {{ $order->id }}
                                      </p>
                                  </div>
                                  <div class="col-6 col-lg-3">
                                      <!-- Heading -->
                                      <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                      <!-- Text -->
                                      <p class="mb-lg-0 fs-sm fw-bold">
                                          <time datetime="2019-10-01">
                                            @if(!empty($order->shipped_date))
                                              {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}
                                            @else 
                                              n/a
                                            @endif
                                          </time>
                                      </p>
                                  </div>



                                  <div class="col-6 col-lg-3">
                                      <!-- Heading -->
                                      <h6 class="heading-xxxs text-muted">Status:</h6>
                                      <!-- Text -->
                                      <p class="mb-0 fs-sm fw-bold">
                                        @if($order->status == 'pending')
                                          <span class="badge bg-danger">Pending</span>
                                        @elseif($order->status == 'confirmed')
                                          <span class="badge bg-secondary">Confirmed</span>
                                        @elseif($order->status == 'shipped')
                                          <span class="badge bg-info">Shipped</span>
                                        @elseif($order->status == 'delivered')
                                          <span class="badge bg-success">Delivered</span>
                                        @elseif($order->status == 'cancelled')
                                          <span class="badge bg-danger">Cancelled</span>
                                        @endif
                                      </p>
                                  </div>

                                  
                                  <div class="col-6 col-lg-3">
                                      <!-- Heading -->
                                      <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                      <!-- Text -->
                                      <p class="mb-0 fs-sm fw-bold">
                                        &#8369; {{ number_format($order->grandtotal,2) }}
                                      </p>
                                  </div>

                                  @if(!empty($order->shipping_days))

                                    <div class="col-6 col-lg-3 ">
                                      <!-- Heading -->
                                      <h6 class="heading-xxxs text-muted">Shipping Days:</h6>
                                      <!-- Text -->
                                      <p class="mb-lg-0 fs-sm fw-bold">
                                          <time datetime="2019-10-01">
                                            @if(!empty($order->shipping_days))
                                              {{ $order->shipping_days }}
                                            @else 
                                              n/a
                                            @endif
                                          </time>
                                      </p>
                                    </div>

                                    @php
                                      $numberOfDays = intval($order->shipping_days);
                                      
                                      $shippedDateTime = \Carbon\Carbon::parse($order->shipped_date);
            
                                      $expectedDateToArrive = $shippedDateTime->addDays($numberOfDays);
            
                                    @endphp


                                    <div class="col-12 col-lg-6">
                                      <!-- Heading -->
                                      <h6 class="heading-xxxs text-muted">Expected Date to Arrive:</h6>
                                      <!-- Text -->
                                      <p class="mb-lg-0 fs-sm fw-bold">
                                          <time datetime="2019-10-01">
                                            @if(!empty($order->shipping_days))
                                              {{ \Carbon\Carbon::parse($expectedDateToArrive)->format('d M, Y') }}
                                            @else 
                                              n/a
                                            @endif
                                          </time>
                                      </p>
                                    </div>
                                  @endif


                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="card-footer p-3">

                      <!-- Heading -->
                      <h6 class="mb-7 h5 mt-4">Order Items ({{ $orderItems->count() }})</h6>

                      <!-- Divider -->
                      <hr class="my-3">

                      <!-- List group -->
                      <ul>
                        @foreach($orderItems as $item)
                          <li class="list-group-item">
                              <div class="row align-items-center">
                                  <div class="col-4 col-md-3 col-xl-2">
                                    {{-- get product image --}}
                                    @php 
                                      $productImage = getProductImage($item->product_id);
                                    @endphp
                                    {{-- color --}}
                                      @php 
                                        $color = getColor($item->color_id);
                                      @endphp
                                      
                                    {{-- end of color --}}

                                    {{-- size --}}
                                      @php 
                                        $size = getSize($item->size_id);
                                      @endphp
                                      
                                    {{-- end of size --}}

                                    @if(!empty($productImage->image))
                                      <!-- Image -->
                                      <img src="{{ asset('uploads/product/small/'.$productImage->image) }}" alt="..." class="img-fluid">

                                    @else 
                                      <!-- Backup for empty Image -->
                                      <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="..." class="img-fluid">

                                    @endif
                                  </div>
                                  <div class="col">
                                      <!-- Title -->
                                      
                                        {{-- @if(!empty($color))
                                          <div style="display: inline-block; width:15px; height: 15px; border:1px solid gray; background-color: {{ $color->color }}"></div>
                                        @endif
                                        
                                        @if(!empty($size))
                                          <strong>Size: </strong> {{ $size->size }}
                                        @endif --}}

                                      <p class="mb-4 fs-sm fw-bold">
                                        
                                        @if(!empty($color))
                                          
                                          <div style="display: inline-block; width:15px; height: 15px; border:1px solid gray; background-color: {{ $color->color }}"></div> <span class="fw-bolder">{{ $color->name }} </span> 
                                        @endif
                                        
                                        @if(!empty($size))
                                          <strong> S </strong> {{ $size->size }} :
                                        @endif

                                          <a class="text-body" href="product.html">
                                            {{ $item->name }} x {{ $item->qty }}
                                          </a> <br>
                                          <span class="text-muted">&#8369; {{ number_format($item->total,2) }}</span>
                                          @if($order->status == "delivered")

                                            {{-- check review --}}
                                            @php 
                                             $checkReview = reviewExists($item->order_id,$item->product_id);
                                            @endphp

                                            @if($checkReview)
                                              <br>
                                              <strong class="text-warning"><small>Product Review Sent :) </small></strong><br>
                                              <small class="text-info">Thank you for your review</small>
                                            @else
                                              <br>
                                              <button class="btn btn-sm btn-primary" onclick="productReview({{ $item->product_id }},{{ $item->id }})">Give Product Review </button>
                                            @endif
                                           


                                          @endif

                                      </p>
                                  </div>
                              </div>
                          </li>
                        @endforeach
                      </ul>
                  </div>                      
              </div>
              
              <div class="card card-lg mb-5 mt-3">
                  <div class="card-body">
                      <!-- Heading -->
                      <h6 class="mt-0 mb-3 h5">Order Total</h6>

                      <!-- List group -->
                      <ul>
                          <li class="list-group-item d-flex">
                              <span>Subtotal</span>
                              <span class="ms-auto">&#8369; {{ number_format($order->subtotal,2) }}</span>
                          </li>
                          <li class="list-group-item d-flex">
                              <span>Discount {{ (!empty($order->coupon_code)) ? '('.$order->coupon_code.')' : '' }}</span>
                              <span class="ms-auto">&#8369; {{ number_format($order->discount,2) }}</span>
                          </li>
                          <li class="list-group-item d-flex">
                              <span>Shipping</span>
                              <span class="ms-auto">&#8369; {{ number_format($order->shipping,2) }}</span>
                          </li>
                          <li class="list-group-item d-flex fs-lg fw-bold">
                              <span>Grand Total</span>
                              <span class="ms-auto">&#8369; {{ number_format($order->grandtotal,2) }}</span>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection