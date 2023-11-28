@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
              <li class="breadcrumb-item">{{ $product->title }}</li>
          </ol>
      </div>
  </div>
</section>

<section class="section-7 pt-3 mb-3">
  <div class="container">
      <div class="row ">
          <div class="col-md-5">
              <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner bg-light">

                    @if($product->product_images)
                      @foreach($product->product_images as $key => $productImage)
                        <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
                          <img class="w-100 h-100" src="{{ asset('uploads/product/large/'.$productImage->image) }}" alt="Image">
                        </div>
                      @endforeach
                    @endif

                    

                  </div>
                  <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                      <i class="fa fa-2x fa-angle-left text-dark"></i>
                  </a>
                  <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                      <i class="fa fa-2x fa-angle-right text-dark"></i>
                  </a>
              </div>
          </div>
          <div class="col-md-7">
              <div class="bg-light right">
                  <h1>{{ $product->title }}</h1>
                  {{-- <div class="d-flex mb-3">
                      <div class="text-primary mr-2">
                          <small class="fas fa-star"></small>
                          <small class="fas fa-star"></small>
                          <small class="fas fa-star"></small>
                          <small class="fas fa-star-half-alt"></small>
                          <small class="far fa-star"></small>
                      </div>
                      <small class="pt-1">(99 Reviews)</small>
                  </div> --}}

                  <!-- Reviews Sction-->
                  <div class="d-flex mb-3">

                    {{-- <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div> --}}

                    {!! reviewStars($product->id) !!}

                    <small class="pt-1">({{ countReviews($product->id) }} Reviews)</small>
                  </div>
                  <!-- end of Reviews Section-->

                  
                  @if($product->compare_price > 0)
                    <h2 class="price text-secondary"><del>&#8369; {{ number_format($product->compare_price) }}</del></h2> 
                  @endif
                  
                  <h2 class="price ">&#8369; {{ number_format($product->price) }}</h2>
                  @php 
                    $stocks = 0;  
                    $stocks = App\Models\ProductVariation::getProductStocks($product->id);
                  @endphp
                  
                  <h6>Remaining Stocks: {{ $stocks }}</h6>

                  <p>{!! $product->short_description !!}</p>
                  <button class="btn btn-dark" onclick="showProductDetails({{ $product->id }})">
                    <i class="fa fa-shopping-cart"></i> ADD TO CART
                  </button>
              </div>
          </div>

          <div class="col-md-12 mt-5">
              <div class="bg-light">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                      </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">

                      <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <p>
                          @if(!empty($product->description))
                            {!! $product->description !!}
                          @else
                            <small>No Product Description </small> 
                          @endif
                        </p>
                      </div>

                      <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                        <p>
                          @if(!empty($product->shipping_returns))
                            {!! $product->shipping_returns !!}
                          @else
                            <small>No Product Shipping Returns </small> 
                          @endif
                        </p>
                      </div>

                      <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                        @php 
                          $getReviews = getReviews($product->id);
                        @endphp

                        
                        @forelse ($getReviews as $review)
                          <div class="card mb-2">
                            <div class="card-header">
                              
                              <small>
                                Posted at {{ Carbon\Carbon::parse($review->created_at)->diffForHumans() }}
                              </small>
                            </div>

                            <div class="card-body">
                                
                              <div class="row">


                                <div class="col-md-3">
                                  <strong class="">{{ $review->reviewer_name }}</strong><br>
                                  <small class="text-info">{{ $review->reviewer_email }}</small>
                                  <p class=" mb-0 ">
                                    Rating: {{ $review->rating }}<span class="fas fa-star text-primary"></span> &nbsp;
                                  </p>
                                  


                                </div>

                                <div class="col-md-9">
                                  
                                    
                                  <div class="">
    
                                    <div class="text-primary mr-2">
                                      @for($i = 1; $i <= 5; $i++ )
                                        @if($i <= $review->rating)
                                          <small class="fas fa-star"></small>
                                        @else
                                          <small class="far fa-star"></small>
                                        @endif
                                      @endfor
      
                                      
                                    </div>
                                    
                                    <small>{{ $review->review }}</small>
                                  </div>  
    


                                </div>

                              </div>
                              
                             

                              
                              
                              
                            

                            </div>

                            @if(!empty($review->review_reply))
                              <div class="card-footer">
                                <div class="row">
                                  <div class="col-md-3">
                                    <small class="text-info">From Shoeniverse: </small>
                                  </div>

                                  <div class="col-md-9">
                                    <small class="text-muted">
                                      <strong>
                                        {!! $review->review_reply !!}
                                      </strong>
                                      
                                    </small>
                                  </div>

                                </div>

                                
                                
                                
                              </div>
                            @endif


                          </div>
                        @empty
                          <small>No reviews</small>
                        @endforelse

                        
                      </div>

                  </div>
              </div>
          </div> 
      </div>           
  </div>
</section>


@if(!empty($relatedProducts))
<!-- Related Products-->
<section class="pt-5 section-8">
  <div class="container">
      <div class="section-title">
          <h2>Related Products</h2>
      </div> 
      <div class="col-md-12">
          <div id="related-products" class="carousel">

            
            @foreach($relatedProducts as $relProduct)
                @php 
                    $productImage = $relProduct->product_images->first()
                @endphp

                <div class="card product-card">
                    <div class="product-image position-relative">
                        {{-- <ahref=""class="product-img"><imgclass="card-img-top"src="images/product-1.jpg"alt=""></a> --}}
                        <a href="{{ route('front.product',$relProduct->slug) }}" class="product-img">
                            @if(!empty($productImage->image))
                                <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" alt="img-thumbnail">
                            @else
                                <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="img-thumbnail">
                            @endif
                        </a>

                        <a onclick="addToWishlist({{ $relProduct->id }})" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                           

                        <div class="product-action">
                          @if($relProduct->track_qty == 'Yes')
                                        
                            @if($relProduct->qty > 0)
                              <button class="btn btn-dark" onclick="showProductDetails({{ $product->id }})">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                              </button>  
                            @else
                                <a class="btn btn-dark" href="javascript:void(0);" >
                                    <i class="fa fa-shopping-cart"></i> Out of Stock
                                </a> 
                            @endif

                          @else
                            <button class="btn btn-dark" onclick="showProductDetails({{ $product->id }})">
                              <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>  
                          @endif                             
                        </div>
                    </div>                        
                    <div class="card-body text-center mt-3">
                        <a class="h6 link" href="">{{ $relProduct->title }}</a>
                        <div class="price mt-2">
                        
                            <span class="h5"><strong>&#8369; {{ number_format($relProduct->price) }}</strong></span>
                            @if($relProduct->compare_price > 0)
                                <span class="h6 text-underline"><del>&#8369; {{ number_format($relProduct->compare_price) }}</del></span>
                            @endif
                            
                        </div>
                    </div>                        
                </div>
            @endforeach
             
              
          </div>
      </div>
  </div>
</section>
@endif

@endsection

@section('customJs')
  <script type="text/javascript">

    
  </script>
@endsection