
@if(!empty($product))


<div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

      

			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

      @php 

        if(!empty($product)){
          $productImage = $product->product_images->first();

        }
       
      @endphp

			<div class="modal-body">

        <div class="row">

          <div class="col-md-6">
            <div class="w-100">
              <a href="{{ route("front.product",$product->slug) }}" class="product-img">
                @if(!empty($productImage->image))
                    <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" alt="img-thumbnail">
                @else
                    <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="img-thumbnail">
                @endif
              </a>
            </div>
          </div>

          <div class="col-md-6">
            
            <div class=" right">
              <h4>{{ $product->title }}</h4>


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
                <h5 class="price text-secondary"><del>&#8369; {{ number_format($product->compare_price) }}</del></h5> 
                
                
              @endif

              @php 
                $stocks = 0;  
                $stocks = App\Models\ProductVariation::getProductStocks($product->id);
              @endphp
              
              <h5 class="price ">&#8369; {{ number_format($product->price) }}</h5>
              <h6>Remaining Stocks: {{ $stocks }}</h6>

              <p><small>{!! $product->short_description !!}</small></p>

              {{-- 
              
                --}}
            </div>

          </div>


          <div class="col-md-12 mt-2">
            <div class="card">    

              <div class="card-body">
                <h6 class="card-title">Choose a color:</h6>

                <div class="row" >



                  @if(!empty($product_colors))

                    @foreach($product_colors as $color)
                    <div class="col-md-3 " style="">

                      <div class="form-check">
                        <input type="radio" class="form-check-input colors" id="color-{{ $color['id'] }}" name="color_id" value="{{ $color['id'] }}">
                        <label class="form-check-label" for="radio1">
                          <div style="width:50px; min-width: 25px; height: 25px; background: {{ $color['color'] }}; display: inline-block; border:1px solid #99989873;"></div>
                          {{ $color['color_name'] }}
                        </label>
                      </div>

                    </div>
                    @endforeach

                  @else 
                    <div class="col-md-12">
                      <small>No color available</small>
                    </div>
                  @endif
    

                </div>
              </div>

            </div>
          </div>


          <div class="col-md-12 mt-2 d-none" id="size_container">
            <div class="card">    

              <div class="card-body">
                <h6 class="card-title">Choose a size:</h6>

                <div class="row" >

                  @if(!empty($product_sizes))

                    @foreach($product_sizes as $size)
                    <div class="col-md-3 " style="">

                      <div class="form-check">
                        <input type="radio" class="form-check-input sizes" id="size-{{ $size['id'] }}" name="size_id" value="{{ $size['id'] }}">
                        <label class="form-check-label" for="radio1">
                          
                          {{ $size['size'] }}
                        </label>
                      </div>

                    </div>
                    @endforeach

                  @else 
                    <div class="col-md-12">
                      <small>No sizes available</small>
                    </div>
                  @endif
    

                </div>
              </div>

            </div>
          </div>

        </div>


        


				
			</div>

			<div class="modal-footer">
        <a id="add_to_cart_btn" href="javascript:void(0)" onclick="addToCart({{ $product->id }});" class="btn btn-dark"><i class="fas fa-shopping-cart" data-product-id="{{ $product->id }}"></i> &nbsp;ADD TO CART</a>


				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>

@endif

