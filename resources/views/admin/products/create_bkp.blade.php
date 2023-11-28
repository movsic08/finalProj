@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Product</h1>
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

      <!-- productForm-->
      <form action="" method="post" name="productForm" id="productForm">
        <div class="row">
            <div class="col-md-8">

              <!-- Title, Slug, Description-->
              <div class="card mb-3">
                <div class="card-body">		
                  <div class="row">

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                            <p class="error"></p>	
                        </div>
                    </div>

                    <div class="col-md-12">
                      <div class="mb-3">
                          <label for="slug">Slug</label>
                          <input readonly type="text" name="slug" id="slug" class="form-control" placeholder="Slug">	
                          <p class="error"></p>	
                      </div>
                    </div>
                    

                    @if(!empty($colors))
                      <div class="col-md-12">
                        <div class="mb-3 w-100">
                          <label >Colors</label>
                        
                          <div class="row">

                          
                            @foreach($colors as $color)
                            <div class="col-12 col-md-2 d-flex flex-row  justify-items-between"> 
                              <div class="d-flex flex-column mr-3 align-items-center justify-content-around">
                                <div class="form-check ">

                                  <input name="colors[{{ $color->id }}][color_id]" data-color-id="{{ $color->id }}" class="colors form-check-input mt-2" type="checkbox" value="{{ $color->id }}" >

                                  <label class="form-check-label" style="background: transparent;">
                                    <div style="display:inline-block; width: 30px; height:30px; background: {{ $color->color }}; color: {{ $color->color }}; border-radius:100%; border:1px solid gray;"></div>
                                  </label>
                                </div>
                                
                                <div>
                                  {{ $color->name }}
                                </div>


                                 
                                <div class="form-check color-cons color-con-{{ $color->id }}">

                                  <input name="colors[{{ $color->id }}][track_qty]" class="colors form-check-input mt-2 color-track" type="checkbox" value="Yes" data-color-id="{{ $color->id }}">

                                  <label class="form-check-label color-track" style="background: transparent;">
                                    <small>Track Qty</small>
                                  </label>
                                  
                                  <input min="1" max="100" step="1" name="colors[{{ $color->id }}][qty]" type="number"  class="form-control form w-100 color-qtys color-qty-{{ $color->id }}" disabled placeholder="Qty">
                                  
                                </div>

                              </div>
                            </div>
                            @endforeach
                          </div>


                          

                          <p id="color-error"></p>	
                        </div>
                      </div>
                    @endif

                    @if(!empty($sizes))
                      <div class="col-md-12">
                        <div class="mb-3 w-100">
                          <label >Sizes</label>
                        
                            <div class="row">
                              @foreach($sizes as $size)
                                <div class="col-12 col-md-2 d-flex flex-row  justify-items-between">


                                  <div class="d-flex flex-column mr-3 align-items-center justify-content-around">
                                    <div class="form-check ">

                                      <input data-size-id="{{ $size->id }}" name="sizes[{{ $size->id }}][size_id]" class="sizes form-check-input mt-2" type="checkbox" value="{{ $size->id }}" >

                                      <label class="form-check-label" style="background: transparent;">
                                        {{ $size->size }}
                                      </label>
                                    </div>


                                    <div class="form-check size-cons size-con-{{ $size->id }}">

                                      <input name="sizes[{{ $size->id }}][track_qty]" class="sizes form-check-input mt-2 size-track" type="checkbox" value="Yes" data-size-id="{{ $size->id }}">
    
                                      <label class="form-check-label size-track" style="background: transparent;">
                                        <small>Track Qty</small>
                                      </label>
                                      
                                      <input min="1" max="100" step="1" name="sizes[{{ $size->id }}][qty]" type="number"  class="form-control form w-100 size-qtys size-qty-{{ $size->id }}" disabled placeholder="Qty">
                                      
                                    </div>
                                    

                                  </div>




                                </div>
                              @endforeach
                            </div>
                          
                          

                          <p id="size-error"></p>	
                        </div>
                      </div>
                    @endif

                    <div class="col-md-12">
                      <div class="mb-3">
                          <label for="short_description">Short Description</label>
                          <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote" placeholder="Short Description"></textarea>
                          <p class="error"></p>	
                      </div>
                    </div>

                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                            <p class="error"></p>	
                        </div>
                    </div> 

                    <div class="col-md-12">
                      <div class="mb-3">
                          <label for="shipping_returns">Shipping and Returns</label>
                          <textarea name="shipping_returns" id="shipping_returns" cols="30" rows="10" class="summernote" placeholder="Shipping and Returns"></textarea>
                          <p class="error"></p>	
                      </div>
                    </div> 

                  </div>
                </div>	                                                                      
              </div>

              <!-- image-->
              <div class="card mb-3">
                  <div class="card-body">
                      <h2 class="h4 mb-3">Media</h2>								
                      <div id="image" class="dropzone dz-clickable">
                          <div class="dz-message needsclick">    
                              <br>Drop files here or click to upload.<br><br>                                            
                          </div>
                      </div>
                  </div>	                                                                      
              </div>
              <!-- image preview-->
              <div class="row" id="product-gallery"></div>

              <!-- price, compare_price-->
              <div class="card mb-3">
                  <div class="card-body">
                      <h2 class="h4 mb-3">Pricing</h2>								
                      <div class="row">
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <label for="price">Price</label>
                                  <input type="text" name="price" id="price" class="form-control" placeholder="Price">	
                                  <p class="error"></p>	
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <label for="compare_price">Compare at Price</label>
                                  <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                  <p class="error"></p>	
                                  <p class="text-muted mt-3">
                                      To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                  </p>	
                              </div>
                          </div>                                            
                      </div>
                  </div>	                                                                      
              </div>

              <!-- sku, barcode, track_qty, qty-->
              <div class="card mb-3">
                <div class="card-body">
                  <h2 class="h4 mb-3">Inventory</h2>								
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="sku">SKU (Stock Keeping Unit)</label>
                        <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">	
                        <p class="error"></p>	
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="barcode">Barcode</label>
                        <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                        <p class="error"></p>	
                      </div>
                    </div>   
                    <div class="col-md-12">

                      <div class="mb-3">
                        <div class="custom-control custom-checkbox">
                          <!-- hidden track_qty No -->
                          <input type="hidden" name="track_qty" value="No">
                          
                          <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes">
                          
                          <label for="track_qty" class="custom-control-label">Track Quantity</label>
                          <p class="error"></p>	
                        </div>
                      </div>

                      <div class="mb-3">
                        <input readonly type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">	
                        <p class="error"></p>	
                      </div>

                    </div>                                         
                  </div>
                </div>	                                                                      
              </div>

              <!-- related products-->
              <div class="card mb-3">
                <div class="card-body">	
                  <h2 class="h4 mb-3">Related Products</h2>
                  <div class="mb-3">
                    <select multiple name="related_products[]" id="related_products" class="related-product w-100">
                      
                    </select>
                  </div>
                  <p class="error"></p>
                </div>
              </div>

            </div>


            <div class="col-md-4">

              <!--status -->
              <div class="card mb-3">
                <div class="card-body">	
                    <h2 class="h4 mb-3">Product status</h2>
                    <div class="mb-3">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Block</option>
                        </select>
                    </div>
                </div>
              </div> 

              <!-- category, sub_category-->
              <div class="card">
                <div class="card-body">	
                    <h2 class="h4  mb-3">Product category</h2>
                    <div class="mb-3">
                        <label for="category">Category</label>

                        <select name="category" id="category" class="form-control">
                          <option value="">Select a category</option>
                          <!-- display categories if not empty-->
                          @if($categories->isNotEmpty())
                            @foreach($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          @endif

                        </select>
                        <p class="error"></p>

                    </div>
                    <div class="mb-3">
                        <label for="category">Sub category</label>
                        <select name="sub_category" id="sub_category" class="form-control">

                          <option value="">Select a Subcategory</option>

                        </select>
                    </div>
                </div>
              </div>
              
              <!-- brand-->
              <div class="card mb-3">
                <div class="card-body">	
                  <h2 class="h4 mb-3">Product brand</h2>
                  <div class="mb-3">
                    <select name="brand" id="brand" class="form-control">
                      <option value="">Select a brand</option>

                      @if($brands->isNotEmpty())
                        @foreach($brands as $brand)
                          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                      @endif

                    </select>
                  </div>
                </div>
              </div> 

              <!-- is_featured-->
              <div class="card mb-3">
                <div class="card-body">	
                  <h2 class="h4 mb-3">Featured product</h2>
                  <div class="mb-3">
                    <select name="is_featured" id="is_featured" class="form-control">
                      <option value="No">No</option>
                      <option value="Yes">Yes</option>                                                
                    </select>
                  </div>
                </div>
              </div>   
              
              
            </div>
        </div>
      
        <!--submit btn -->
        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Create</button>
          <a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

      </form>
      <!-- end of productForm-->

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection 

@section('customJs')
  <script>
    //glet obal tracking of any track_qty of size and color
    var total_qty = 0;

    function updateTotalqty(){
      //display the total_qty
      console.log(total_qty);
      if(total_qty > 0){
        $('#track_qty').attr('checked',true);
        $('#qty').val(total_qty);
      }else{
        $('#track_qty').attr('checked',false);
        $('#qty').val(total_qty);
      }
    }



    //for colors
    // $('.colors').change(function(){
    //   var colors = [];
    //   $(".colors").each(function(){
    //     if( $(this).is(":checked") == true ){ //check if the colors checkbox is checked
    //       colors.push($(this).val()); //pushes the values into the array
    //     }
    //   });


    //   $.ajax({
    //     url: '',
    //     type: post,
    //     data: {colors:colors,product_id: ""},
    //     dataType: 'json',
    //     success: function(data){
    //       console.log(data);
    //     }
    //   });
    //   //console.log(colors);



    // });

    /*Color JS*/
      //hide the color cons
      $(".color-cons").fadeOut();
      $(".color-cons").fadeOut("slow");
      $(".color-cons").fadeOut(3000);

      //for the colors tracking of quantity
      $('.colors').change(function(){

        $(".color-cons").fadeOut();
        $(".color-cons").fadeOut("slow");
        $(".color-cons").fadeOut(3000);

        $('.colors').each(function(){
          if($(this).is(':checked') == true){
            //console.log($(this).attr('data-color-id'));

            let check_id = $(this).attr('data-color-id');

            console.log(".color-con-" + check_id);

            $(".color-con-" + check_id).fadeIn();
            $(".color-con-" + check_id).fadeIn("slow");
            $(".color-con-" + check_id).fadeIn(3000);
            


          }
        });

        //make the inputs as disabled and not required
        $('.color-qtys').attr('disabled',true);
        $('.color-qtys').attr('required',false);

        //check the colors to be tracked
        $('.color-track').each(function(){

          

          if($(this).is(':checked') == true){

            let check_id = $(this).attr('data-color-id');

            $('.color-qty-' + check_id).attr('disabled',false);
            $('.color-qty-' + check_id).attr('required',true);

            //add the qty to global qty
            let value = $('.color-qty-' + check_id).val();
            total_qty += parseInt(value);

          }
          
        });



      });

    /*end of Color JS*/

    /*size JS*/
      //hide the size cons
      $(".size-cons").fadeOut();
      $(".size-cons").fadeOut("slow");
      $(".size-cons").fadeOut(3000);

      //for the sizes tracking of quantity
      $('.sizes').change(function(){

        $(".size-cons").fadeOut();
        $(".size-cons").fadeOut("slow");
        $(".size-cons").fadeOut(3000);

        $('.sizes').each(function(){
          if($(this).is(':checked') == true){
            //console.log($(this).attr('data-size-id'));

            let check_id = $(this).attr('data-size-id');

            console.log(".size-con-" + check_id);

            $(".size-con-" + check_id).fadeIn();
            $(".size-con-" + check_id).fadeIn("slow");
            $(".size-con-" + check_id).fadeIn(3000);
            


          }else{

            let check_id = $(this).attr('data-size-id');

            $('.size-track-qty-' + check_id).attr('checked',false);

            //subtract the qty to global qty


            $('.size-qty-' + check_id).val(0);


          }

        });

        //make the inputs as disabled and not required
        $('.size-qtys').attr('disabled',true);
        $('.size-qtys').attr('required',false);

        //check the colors to be tracked
        $('.size-track').each(function(){

          

          if($(this).is(':checked') == true){

            let check_id = $(this).attr('data-size-id');

            $('.size-qty-' + check_id).attr('disabled',false);
            $('.size-qty-' + check_id).attr('required',true);

            //add the qty to global qty
            let value = $('.size-qty-' + check_id).val();
            total_qty += parseInt(value);

          }else{ //if the track_qty for sizes is OFF

            let check_id = $(this).attr('data-size-id');

            $('.size-qty-' + check_id).attr('checked',false);

            // //make the inputs as disabled and not required
            // $('.size-qtys').attr('disabled',true);
            // $('.size-qtys').attr('required',false);

            //subtract the qty to global qty


            $('.size-qty-' + check_id).val(0);

          }
          
        });

        

      });

    /*end of size JS*/


    
    // $('.color-qtys')on('input',function(){
    //   //display the total_qty
    //   // if(total_qty > 0){
    //   //   $('#track_qty').attr('checked',true);
    //   //   $('#qty').val(total_qty);
    //   // }else{
    //   //   $('#track_qty').attr('checked',false);
    //   //   $('#qty').val(total_qty);
    //   // }
    //   // console.log(total_qty);
    // });

    // $('.size-qtys')on('input',function(){
    //   //display the total_qty
    //   if(total_qty > 0){
    //     $('#track_qty').attr('checked',true);
    //     $('#qty').val(total_qty);
    //   }else{
    //     $('#track_qty').attr('checked',false);
    //     $('#qty').val(total_qty);
    //   }
    //   console.log(total_qty);
    // });
    

    // $('body').change(function(){
    //   
    // });




    /*for the Select2 js tag*/
    $('.related-product').select2({
      ajax: {
        url: '{{ route("products.getProducts") }}',
        dataType: 'json',
        tags: true,
        multiple: true,
        minimumInputLength: 3,
        processResults: function(data){
          return {
            results: data.tags
          };
        }
      }
    });


    /*for the Slug generator*/
    $("#title").change(function(){
      element = $(this);
      $("button[type=submit]").prop('disabled',true);

      $.ajax({
        url: '{{ route("getSlug") }}',
        type: 'get',
        data: {title: element.val()},
        dataType: 'json',
        success: function(response){
          $("button[type=submit]").prop('disabled',false);
          if(response["status"] == true){
            $("#slug").val(response['slug']);
          }
        },
      });

    });

    /*productForm*/
    $("#productForm").submit(function(event){
      event.preventDefault();
      var formArray = $(this).serializeArray();

      //disable the submit button
      $("button[type='submit']").prop('disabled',true);

      $.ajax({
        url: '{{ route("products.store") }}',
        type: 'post',
        data: formArray,
        dataType: 'json',
        success: function(response){
          $("button[type='submit']").prop('disabled',false);//enable the submit btn

          //console.log(response);

          if(response['status'] == true){ //if response true

            $(".error").removeClass('invalid-feedback').html('');// remove all error class and message
            $("input[type='text'], select, input[type='number']").removeClass('is-invalid');//remove the error calss on the input text and select

            window.location.href = "{{ route('products.index') }}";

          }else{ //if response false

            var errors = response['errors'];

            // if(errors['title']){ //if errors found, add error class and message
            //   $('#title').addClass('is-invalid')
            //     .siblings('p')
            //     .addClass('invalid-feedback')
            //     .html(errors['title']);
            // }else{ //remove error class and message if no error is found
            //   $('#title').removeClass('is-invalid')
            //     .siblings('p')
            //     .removeClass('invalid-feedback')
            //     .html('');
            // }

            //now we will generate a code that placed the errors no their parts 
            $(".error").removeClass('invalid-feedback').html('');//first, remove all error class and message
            $("input[type='text'], select, input[type='number']").removeClass('is-invalid');//remove the error calss on the input text and select

            //insert the updated errors fetched from the json response
            $.each(errors,function(key, value){ 
              $(`#${key}`).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
            });

            if(errors['colors']){
              
              $('#color-error').addClass('text-danger').html("<small>" + errors['colors'] + "</small>");

            }else{
              $('#color-error').removeClass('text-danger').html("");

            }


            if(errors['sizes']){
              
              $('#size-error').addClass('text-danger').html("<small>" + errors['sizes'] + "</small>");

            }else{
              $('#size-error').removeClass('text-danger').html("");

            }


          }

        },
        error: function(){
          console.log("Something went wrong");
        }
      });
    });
    /*end of productForm*/

    //category to change sub_category ajax
    $("#category").change(function(){

      var category_id = $(this).val();

      //console.log(category_id);

      //ajax
      $.ajax({
        url: '{{ route("product-subcategories.index") }}',
        type: 'post',
        data: {category_id: category_id},
        dataType: 'json',
        success: function(response){
          //console.log(response);

          //modify the sub_category select options
          //remove the first one
          $("#sub_category").find("option").not(":first").remove();

          //display fetched subcategories
          $.each(response["subCategories"],function(key,item){
            $("#sub_category").append(`<option value='${item.id}'>${item.name}</option>`);
          })

        },
        error: function(){
          console.log("Something went wrong");
        }

      });


    });


    /*Dropzone*/
    Dropzone.autoDiscover = false;

    const dropzone = $("#image").dropzone({

      /*this code is for single entry of image -> we have to uncomment this in order to make multiple entries for the product
      init: function(){
        this.on('addedfile',function(file){
          if(this.files.length > 1){
            this.removeFile(this.files[0]);
          }
        });
      },
      */


      url: '{{ route("temp-images.create") }}',
      maxFiles: 10,
      paramName: 'image',
      addRemoveLinks: true,
      acceptedFiles: "image/jpeg, image/png, image/gif",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(file, response){
        //$("$image_id").val(response.image_id);

        var html = `
          <div class="col-md-3" id="image-row-${response.image_id}">
            <div class="card">
              <input type="hidden" name="image_array[]" value="${response.image_id}">
              <img src="${response.ImagePath}" class"card-img-top" alt="">
              <div class="card-body">
                <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
          `;

        $("#product-gallery").append(html);

      },
      complete: function(file){
        this.removeFile(file);
      }

    });

    function deleteImage(id){
      $("#image-row-"+id).remove();
    }
    /*end of Dropzone*/

  </script>
@endsection

{{-- 
  <script>
    /*for the Slug generator*/
    $("#title").change(function(){
      element = $(this);
      $("button[type=submit]").prop('disabled',true);

      $.ajax({
        url: '{{ route("getSlug") }}',
        type: 'get',
        data: {title: element.val()},
        dataType: 'json',
        success: function(response){
          $("button[type=submit]").prop('disabled',false);
          if(response["status"] == true){
            $("#slug").val(response['slug']);
          }
        },
      });

    });

    /*productForm*/
    $("#productForm").submit(function(event){
      event.preventDefault();

      $.ajax({
        url: ,
        type: ,
        data: ,
        dataType: ,
        success: function(response){

        },
        error: function(){
          console.log("Something went wrong");
        }
      });
    });
    /*end of productForm*/

    //category to change sub_category ajax
    $("#category").change(function(){

      var category_id = $(this).val();

      console.log(category_id);

      //ajax
      $.ajax({
        url: '{{ route("product-subcategories.index") }}',
        type: 'post',
        data: {category_id: category_id},
        dataType: 'json',
        success: function(response){
          console.log(response);
        },
        error: function(){
          console.log("Something went wrong");
        }

      });
     

    });


  </script>
  --}}

  {{-- 
                      <div class="col-md-12">
                        <div class="mb-3">
                            <label for="short_description">Colors Available</label>
                            
                            <!-- color-select-->
              
                            <select multiple name="color_select[]" id="colors-select" class="colors-select w-100">
                              
                            </select>


                            <p class="error"></p>	
                        </div>

                        <div id="colors" class="mb-3">
                          
                        </div>
                      </div>
                      
                       <div class="col-md-12">
                        <div class="row">
                          @foreach($colors as $color)
                            <div class="col-2">
                              {{ $color->name }}
                            </div>

                          @endforeach
                        </div>
                      </div>
                       --}}


                       {{-- 
                        /*for the Colors Select js tag*/
    // $('.colors-select').select2({
    //   ajax: {
    //     url: '{{ route("products.getColors") }}',
    //     dataType: 'json',
    //     tags: true,
    //     multiple: true,
    //     minimumInputLength: 3,
    //     processResults: function(data){
          
    //       return {
    //         results: data.tags,
            
    //       };
    //     },
        
    //   } 
    // });

    // $('.colors-select').change(function(){

    //   var children = $(this).children('option');

    //   $('#colors').html('');

    //   let html = '';

    //   for(child of children){
    //     html +=  child['value'] + ',';
    //   } 
    //   $('#colors').html(html);

    //   console.log(html);

    //   //console.log(children.attr('value'));
    //   // console.log(children.attr('data-select2-id'));

    // });
                        --}}
