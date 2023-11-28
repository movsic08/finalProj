@extends('admin.layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit Product Variation</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{ route('product-variations.index',$product->id) }}" class="btn btn-primary">Back</a>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>

 <!-- Main content -->
 <section class="content">
  <!-- Default box -->
  <div class="container-fluid">

    
    <div class="row">

      <div class="col-md-3">

        <!-- fetch the first image-->
        @php 
          /*fetces the first ProductImage instance*/
          $productImage = $product->product_images->first();
        @endphp

        <div class="card" style="width:100%">
          
          @if(!empty($productImage->image))

            <img src="{{ asset('uploads/product/small/'.$productImage->image) }}" class="img-thumbnail" width="100%" >
          @else
            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" class="img-thumbnail" width="100%">

          @endif


          <div class="card-body">
            <h4 class="card-title">{{ $product->title }}</h4>
            <p class="card-text">Product ID</p>
            {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
          </div>
        </div>

      </div>

      <div class="col-md-9">

        <div class="card mb-3">
          <div class="card-body">		
            <div class="row">
              
              
              
              <div class="col-md-12">
                <div class="mb-3 w-100">
                  <div class="d-flex justify-content-between mb-2">
                    <label >Product Size & Color Variation</label>
                
                   
                  </div>
        
                  <!-- Product Variation Form-->
                  <form id="variationForm" name="variationForm"  >
        
                    @if(!empty($colors))
                      <div class="row " >
        
                        <div class="card col-12">
                          <div class="card-header">Shoe Colors <p class="mb-0" id="color_error"></p></div>
        
                          <div class="card-body row overflow-auto color-con">
                            @foreach($colors as $color)
        
                              <div class="col-12 col-md-2 d-flex flex-row  justify-items-between"> 
                                <div class="d-flex flex-column mr-3 align-items-center justify-content-around">
                                  <div class="form-check ">
        
                                    <input name="color" {{ $product_variation->color_id == $color->id ? 'checked' : '' }} class="colors form-check-input mt-2" type="radio" value="{{ $color->id }}" >
        
                                    <label class="form-check-label" style="background: transparent;">
                                      <div style="display:inline-block; width: 30px; height:30px; background: {{ $color->color }}; color: {{ $color->color }}; border-radius:100%; border:1px solid gray;"></div>
                                    </label>
                                  </div>
                                  
                                  <div>
                                    {{ $color->name }}
                                  </div>
        
                                </div>
                              </div>
                          
                            @endforeach
                            
                          </div>
        
                          
        
                        </div>
                      </div>
                    @else
                      <div class="row">
                        <h6>No Color Record found</h6>
                      </div>
        
                    @endif
        
                    @if(!empty($sizes))
                      <div class="row " >
        
                        <div class="card col-12">
                          <div class="card-header">Shoe sizes <p class="mb-0" id="size_error"></p></div>
        
                          <div class="card-body row overflow-auto size-con" >
                            @foreach($sizes as $size)
                            
                              <div class="col-12 col-md-2 d-flex flex-row  justify-items-between"> 
                                <div class="d-flex flex-column mr-3 align-items-center justify-content-around">
                                  <div class="form-check ">
        
                                    <input name="size"  {{ $product_variation->size_id == $size->id ? 'checked' : '' }} class="sizes form-check-input mt-2" type="radio" value="{{ $size->id }}" >
        
                                    <label class="form-check-label" style="background: transparent;">
                                      {{ $size->size }}
                                    </label>
                                  </div>
                                  
                                </div>
                              </div>
                          
                            @endforeach
                            
                          </div>
        
                          
        
                        </div>
                      </div>
                    @else
                      <div class="row">
                        <h6>No Color Record found</h6>
                      </div>
        
                    @endif
                      
                    
                    <div class="form-group">
                      <label for="">Quantity</label>
                      <input type="number" class=" form-control mb-2" placeholder="Available Qty" id="stock_quantity" name="stock_quantity" value="{{ !empty($product_variation->stock_quantity) ? $product_variation->stock_quantity : '' }}">
                      <p></p>
                    </div>

                    
      
                    <button type="submit" class=" btn btn-primary mx-auto" >Save</button>
                    
                    
                    
        
                  </form>
                  <!-- end of Product Variation Form-->
        
                  
        
                  <p id="color-error"></p>	
                </div>
              </div>
              
        
            </div>
          </div>
        </div>

      </div>
    </div>


  </div>
 </section>


@endsection

@section('customJs')

  <script type="text/javascript">
    $("#variationForm").submit(function(event){
      event.preventDefault();

      $.ajax({
        url: '{{ route("product-variations.update",[$product->id,$product_variation->id]) }}',
        type: 'put',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){

          if(response.status == true){

            window.location.href = "{{ route('product-variations.index',$product->id) }}";

          }else{

            var errors = response.errors;

            if(errors.color){
              $("#color_error").addClass('text-danger').html('<small>' + errors.color + '</small>');
              $(".color-con").addClass('border border-danger');
            }else{
              $("#color_error").removeClass('text-danger').html("");
              $(".color-con").removeClass('border border-danger');
            }

            if(errors.size){
              $("#size_error").addClass('text-danger').html('<small>' + errors.size + '</small>');
              $(".size-con").addClass('border border-danger');
            }else{
              $("#size_error").removeClass('text-danger').html("");
              $(".size-con").removeClass('border border-danger');
            }

            if(errors.stock_quantity){
              $("#stock_quantity").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.stock_quantity);
            }else{
              $("#stock_quantity").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

          }

        }
        
      });


    });


  </script>

@endsection 