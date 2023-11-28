@if(!empty($product) && !empty($item))

  <div class="modal fade" id="reviewProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Review Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form action="" method="post" id="reviewProductForm">

            <div class="card">
        
              <div class="card-header">

                <div class="row">
                  <div class="col-6">
                    @php 

                      if(!empty($product)){
                        $productImage = $product->product_images->first();
              
                      }
                    
                    @endphp
                    {{-- color --}}
                      @php 
                        if(!empty($item)){
                          $color = getColor($item->color_id);
                          $size = getSize($item->size_id);
                        }
                        
                      @endphp
                      
                    {{-- end of color --}}

                    {{-- size --}}
                      @php 
                        
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

                  <div class="col-6">
                    <small>{{ $product->title }}</small><br><hr>

                    <div class="d-flex justify-content-between">
                      @if(!empty($color))
                        <div>
                          Color: 
                        </div>

                        <div>
                          <div style="display: inline-block; width:15px; height: 15px; border:1px solid gray; background-color: {{ $color->color }}"></div> 
                          <small class="fw-bolder"><strong>{{ $color->name }}</strong> </small> 
                        </div>
                        
                      @endif
                      

                    </div>

                    <div class="d-flex justify-content-between">
                      @if(!empty($size))
                        <div>
                          Size: 
                        </div>

                        <div>
                          <small><strong> S </strong> {{ $size->size }} </small>
                        </div>
                        
                      @endif
                      

                    </div>
                    
                    
                    
                  </div>
                </div>
                
                
              </div>


              <div class="card-body">
        
                <input name="order_id" id="order_id" value="{{ $item->order_id }}" type="hidden">
                <input name="product_id" id="product_id" value="{{ $product->id }}" type="hidden" >
                <input name="rating" id="rating" type="hidden">
        
                
                <p id="rating_error" class="text-danger my-0"></p>
                <div class="form-group d-flex justify-content-between mb-0">
                  <div>
                    Product Rating
                  </div>
                  <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        {{-- <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small> --}}
                        <small class="far fa-star star" data-val="1"></small>
                        <small class="far fa-star star" data-val="2"></small>
                        <small class="far fa-star star" data-val="3"></small>
                        <small class="far fa-star star" data-val="4"></small>
                        <small class="far fa-star star" data-val="5"></small>

                    </div>
                    {{-- <small class="pt-1">(99 Reviews)</small> --}}
                  </div>
                  



                </div>
                
        
        
                <div class="form-group">
                  <label for="">Product Review</label>
                  <textarea name="review" type="text" class="form-control" ></textarea>
                </div>

                <button class="btn btn-primary btn-sm mt-2" >Submit Rating</button>
        
              </div>
        
            </div>
            @csrf
            
        
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

  


@endif

