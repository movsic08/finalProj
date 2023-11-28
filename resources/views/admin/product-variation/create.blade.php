@extends('admin.layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Product Variation</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
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

      <div class="col-md-12">
        @include('admin.message')
      </div>

      <div class="col-sm-3">

        <!-- fetch the first image-->
        @php 
          /*fetces the first ProductImage instance*/
          $productImage = $product->product_images->first();
        @endphp

        <div class="card w-100 mx-auto" >
          
          @if(!empty($productImage->image))

            <img src="{{ asset('uploads/product/small/'.$productImage->image) }}" class="img-thumbnail" style="max-width: 100%; min-width: 90%;" >
          @else
            <img src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="" class="img-thumbnail" style="max-width: 100%; min-width: 90%;">

          @endif


          <div class="card-body">
            <h4 class="card-title">{{ $product->title }}</h4>
            <p class="card-text">ID #{{ $product->id }}</p>
            {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
          </div>
        </div>

      </div>

      <div class="col-sm-9">

        <div class="card mb-3">
          <div class="card-body">		
            <div class="row">
              
              
              
              <div class="col-md-12">
                <div class="mb-3 w-100">
                  <div class="d-flex justify-content-between mb-2">
                    <label >Product Size & Color Variation </label>
                
                   
                  </div>

                  <form action="" class="mb-3 container-fluid" id="showVariation" method="post">

                  
                    <!-- color and size options-->
                      @if(!empty($colors))
                        <div class="row " >
          
                          <div class="card col-12">
                            <div class="card-header">
                              Choose Color/s 
                              <div class="form-group mb-0 ml-2" style="display: inline-block">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="select_all_colors" >
                                  <label for="select_all_colors" class="custom-control-label">Select All</label>
                                </div>
                              </div>

                              <p class="mb-0 " id="color_error"></p>
                            </div>
          
                            <div class="card-body row overflow-auto color-con">
                              @foreach($colors as $color)
          
                                <div class="col-4 col-md-2 d-flex flex-row  justify-items-between"> 
                                  <div class="d-flex flex-column mr-3 align-items-center justify-content-around">
                                    <div class="form-check ">
          
                                      <input name="color[]" class="colors form-check-input mt-2" type="checkbox" value="{{ $color->id }}" >
          
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
                            <div class="card-header">
                              Choose Size/s 
                              <div class="form-group mb-0 ml-2" style="display: inline-block">
                                <div class="custom-control custom-checkbox">
                                  <input class="custom-control-input" type="checkbox" id="select_all_sizes" >
                                  <label for="select_all_sizes" class="custom-control-label">Select All</label>
                                </div>
                              </div>

                              <p class="mb-0" id="size_error"></p>
                            </div>
          
                            <div class="card-body row overflow-auto size-con" >
                              @foreach($sizes as $size)
                              
                                <div class="col-4 col-md-2 d-flex flex-column  justify-items-between"> 
                                  <div class="d-flex flex-column mr-3 align-items-center justify-content-around">
                                    <div class="form-check ">
          
                                      <input name="size[]" class="sizes form-check-input mt-2" type="checkbox" value="{{ $size->id }}" >
          
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
                    <!-- end of color and size variations -->
                    <div class="row">
                      <button class="btn btn-info mx-auto" type="submit">Show or Update Variations</button>
                    </div>
                    
                  </form>


                  <div id="VariationForm">

                  </div>
                  
        
                  
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

    //for the colors
    $("#select_all_colors").on("change",function(){

      $(".colors").prop("checked",$(this).prop("checked"));
      
    });

    //for the sizes
    $("#select_all_sizes").on("change",function(){

      $(".sizes").prop("checked",$(this).prop("checked"));

    });

    

    
    /*Update variation form*/

      //hide the variation form on changes on the colors and sizes and also
      $(".colors").on("change",function(){
        $("#VariationForm").html("");
      });

      $(".sizes").on("change",function(){
        $("#VariationForm").html("");
      });

      //for the form
      $("#showVariation").on("submit",function(event){
        event.preventDefault();

        console.log(event);
        

        $.ajax({
          url: '{{ route("product-variations.getProductVariations",$product->id) }}',
          type: 'post',
          data: $(this).serializeArray(),
          dataType: 'json',

          success: function(response){
            
            


            if(response.status == true){

              //window.location.href = "{{ route('product-variations.index',$product->id) }}";

              $("#color_error").removeClass('text-danger').html("");
              $(".color-con").removeClass('border border-danger');

              $("#size_error").removeClass('text-danger').html("");
              $(".size-con").removeClass('border border-danger');

              $("#VariationForm").html(response.success);


              /*ajax for the variation updating form*/
                //form 
                $("#variationForm").submit(function(event){
                  event.preventDefault();

                  //console.log("hello");

                  $.ajax({
                    url: '{{ route("product-variations.store",$product->id) }}',
                    type: 'post',
                    data: $(this).serializeArray(),
                    dataType: 'json',
                    success: function(response){

                      if(response.status == true){

                        window.location.href = "{{ route('product-variations.index',$product->id) }}";

                      }else{

                        

                      }

                    }
                    
                  });


                });
              /*end of ajax for the variation updating form*/


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

              

            }
          },
        });


      });

    /*end of Update variation form*/

    


  </script>

@endsection 