@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Reviews</h1>
        </div>
        {{-- <div class="col-sm-6 text-right">
          <a href="{{ route('reviews.create') }}" class="btn btn-primary">New Category</a>
        </div> --}}
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">


    <!-- Default box -->
    <div class="container-fluid">

      <!-- Message -->
      @include('admin.message') 

      <div class="card">

        <!--Search bar -->
        <form action="" method="get">
          @csrf
          <div class="card-header">

            <div class="card-title">
              <button onclick="window.location.href='{{ route('reviews.index') }}'" class="btn btn-default btn-sm">Reset</button>
            </div>

            <div class="card-tools">

              <div class="input-group input-group" style="width: 250px;">
                <input type="text" name="keyword" class="form-control float-right" placeholder="Search" value="{{ Request::get('keyword') }}">
      
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>

            </div>
          </div>
        </form>


        <div class="card-body table-responsive p-0">								
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th class="text-nowrap">Product Details</th>
                <th class="text-nowrap">Review Details</th>
                <th class="text-right">Action </th>
              </tr>
            </thead>
            <tbody>

              {{-- cehck if it is empty --}}
              @if($reviews->isNotEmpty())

                @foreach($reviews as $review)
                  <tr>
                    <td>

                      <div class="row mb-1">
                        <div class="col-md-6">
                          @php
                            $product = App\Models\Product::where('id',$review->product_id)->first();

                            $productImage = $product->product_images->first();

                            $orderItem = App\Models\OrderItem::where('product_id',$review->product_id)->where('order_id',$review->order_id)->first();

                            if(!empty($orderItem)){
                              $color = getColor($orderItem->color_id);
                              $size = getSize($orderItem->size_id);
                            }

                          @endphp


                          @if(!empty($productImage->image))
                            <img class="card-img-top w-25" style="min-width: 100px;" src="{{ asset('uploads/product/small/'.$productImage->image) }}" alt="img-thumbnail">
                          @else
                            <img class="card-img-top "  style="min-width:100px;" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="img-thumbnail">
                          @endif

                        </div>
                        <div class="col-md-6">
                          <small class="text-primary text-wrap">{{ $product->title }}</small>
                         
                            @if(!empty($color))
                              <div class="d-flex justify-content-between">
                                <div>
                                  Color: 
                                </div>
        
                                <div>
                                  <div style="display: inline-block; width:15px; height: 15px; border:1px solid gray; background-color: {{ $color->color }}"></div> 
                                  <span class="fw-bolder"><strong>{{ $color->name }}</strong> </span> 
                                </div>
                              </div>
                              
                            @endif
                            
      
                          
      
                          
                            @if(!empty($size))
                              <div class="d-flex justify-content-between">
                                <div>
                                  Size: 
                                </div>
        
                                <div>
                                  <strong> S {{ $size->size }}</strong>  
                                </div>
                              </div>
                            @endif
                            
      
                          
                          
                        </div>
                        
                      </div>


                      <div class="badge badge-warning  d-flex justify-content-between mb-1">
                        <div>
                          Product ID
                        </div>
                        <div>
                          {{ $review->product_id }}
                        </div>
                        
                      </div>

                      

                      <div class="badge badge-secondary  d-flex justify-content-between mb-1">
                        <div>
                          Order ID
                        </div>
                        <div>
                          {{ $review->order_id }}
                        </div>
                        
                      </div>
                      


                    
                    </td>
                    <td>

                      <div class="col-md-3">
                        <strong class="">{{ $review->reviewer_name }}</strong> &nbsp;&nbsp;
                        <small class="text-info">{{ $review->reviewer_email }}</small>
                        <span class=" mb-0 ">
                          Rating: {{ $review->rating }}<span class="fas fa-star text-primary"></span> &nbsp;
                        </span>
                        


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
                          
                          <small class="text-wrap">{{ $review->review }}</small>
                        </div>  



                      </div>

                      
                      <div class="badge badge-primary  d-flex justify-content-between mb-1">
                        <div>
                          Review ID
                        </div>
                        <div>
                          {{ $review->id }}
                        </div>
                        
                      </div>

                      <div>
                        Show on Reviews: 
                        @if($review->showOnReviews == 'Yes')
                          <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                        @else 
                          <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                        @endif
                      </div>

                    </td>
                    
                    <td class="text-right">
                      <div class="card">
                        <div class="card-body">

                          <!-- update form-->
                          <form action="" method="post" class="updateReviewForm" >
                            @csrf

                            <label for="">Show on Product Reviews</label>
                            <select name="show" id="" class="form-control form-control-sm mb-2">
                              <option value="">Select</option>
                              <option {{ !empty($review->showOnReviews) && $review->showOnReviews == 'Yes' ? 'selected' : ''  }} value="Yes">Yes</option>
                              <option {{ !empty($review->showOnReviews) && $review->showOnReviews == 'No' ? 'selected' : ''  }} value="No">No</option>
                            </select>

                            <!-- id -->
                            <input type="hidden" name="review_id" value="{{ $review->id }}">

                            <button class="btn btn-primary btn-sm">
                              
                              Update
                            </button>
                          </form>

                          <button class="btn btn-info btn-sm mt-2" onclick="productReplyReview({{ $review->id }})">
                            
                            {!! empty($review->review_reply) ? 'Leave a Reply' : 'Edit Recent Reply' !!}
                          </button>

                        </div>
                      </div>
                      

                      {{-- <a href="{{ route('reviews.update',$review->id) }}">
                        
                      </a> --}}
                      <!-- delete btn-->
                      {{-- <a onclick="deleteCategory({{ $review->id }})" class="text-danger w-4 h-4 mr-1">
                        <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                          </svg>
                      </a> --}}
                    </td>
                  </tr>

                @endforeach

                
              @else

                <tr>
                  <td colspan="100%">Record Not Found</td>
                </tr>

              @endif

              
              
            </tbody>
          </table>										
        </div>
        <div class="card-footer clearfix">
          {{ $reviews->links() }}

          {{-- 
          <ul class="pagination pagination m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
           --}}
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

<!-- Product Review Modal-->
  <div id="modal_review_value">
    @include('admin.reviews._product_review_modal')
  </div>

<!-- end of Product Review modal-->




@endsection
@if($reviews->isNotEmpty())

  @section('customJs')
    <script>

      $(".updateReviewForm").on("submit",function(event){
        event.preventDefault();
        // var id = $(this).attr("data-review-id");
        // console.log(id);
      
        $.ajax({
          type: 'put',
          url: '{{ route("reviews.update",$review->id) }}',
          data: $(this).serializeArray(),
          dataType: 'json',
          success: function(response){
            console.log(response);

            if(response.status == true){
              window.location.href = "{{ route('reviews.index') }}";
            }

          }
        });

      });

      
      //product review js 
    function productReplyReview(review_id){
      console.log(review_id);


      $.ajax({
        type: 'post',
        url:  '{{ route("reviews.get_review") }}',
        data: {review_id: review_id},
        dataType: 'json',
        success: function(response){

          $("#modal_review_value").html(response.success);
          $("#reviewProductModal").modal("show");

          $("#replyReviewProductForm").on("submit",function(event){
            event.preventDefault();

            $.ajax({
              type: 'put',
              url: '{{ route("reviews.reply") }}',
              data: $(this).serializeArray(),
              dataType: 'json',
              success: function(){
                console.log(response);

                if(response.status == true){
                  window.location.href = "{{ route('reviews.index') }}";
                }

              }
            });

          }); 

        }
      });

      


    }

    //send product review form


    </script>  
    {{-- 

      $.ajax({
        type: 'post',
        url:  '{{ route("reviews.get_review") }}',
        data: {review_id: review_id}
        dataType: 'json',
        success: function(response){

          console.log(response);
    
          $("#modal_review_value").html(response.success);
          $("#reviewProductModal").modal("show");

          $("#replyReviewProductForm").on("submit",function(event){
            event.preventDefault();

            $.ajax({
              type: 'put',
              url: '{{ route("reviews.reply") }}',
              data: $(this).serializeArray(),
              dataType: 'json',
              success: function(){
                console.log(response);

                if(response.status == true){
                  window.location.href = "{{ route('reviews.index') }}";
                }

              }
            });

          }); 


        }
      });
      <!-- end of pasted data




      $.ajax({

        type: 'POST',
        url: '{{ route("front.get_product_details_for_review") }}',
        data : { 
          product_id: product_id,
          order_item_id: order_item_id
        },
        //processData: false,
        //contentType: false,
        dataType: 'json',
        success: function(data){
          console.log(data);

          if(data.status == true){
            $('#modal_review_value').html(data.success);

            // $("#reviewProductModal .modal-body").html(data.message); // display the modal message data
            $("#reviewProductModal").modal('show'); //display the modal
          

            //function for the star ratings
            $(".star").on('click',function(){

              var star_val_selected = $(this).attr('data-val');
              $("#rating").val(star_val_selected); //on the rating input, add the rating value
              


              $(".star").each(function(){

                let star_val = $(this).attr('data-val');
                if(star_val <= star_val_selected){
                  $(this).removeClass("far");		// not filled star
                  $(this).addClass("fas");			//filled star
                }else{
                  $(this).addClass("far");		// not filled star
                  $(this).removeClass("fas");			//filled star
                }
              });

              console.log($(this).attr('data-val'));

            });


            //ajax for the submission of the review form
            $("#reviewProductForm").on("submit",function(event){

              event.preventDefault();


              $.ajax({
                type: 'POST',
                url: '{{ route("account.review-add") }}',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){
                  console.log(response);

                  if(response.status == true){


                    window.location.href = "{{ route('account.orders') }}";
                  }else{

                    var errors = response.errors;
                    if(errors.rating){
                      $("#rating_error").html("<small class='text-danger'>" + errors.rating + "</small>");
                    }else{
                      $("#rating_error").html("");
                    }


                  }


                }
              });


            });
            


          }
          

        }


      });
      //end of product review js


      // function deleteCategory(id){
      //   //console.log(id);

      //   /*for debuging
      //     var url = '{{ route("reviews.delete","ID") }}';
      //     var newUrl = url.replace("ID",id); //to replace the ID with the id [ category->id fetched ]
      //     alert(newUrl);
      //     return false; //to return nothing
      //   /*end of for debugging*/

      //   var url = '{{ route("reviews.delete","ID") }}';
      //   var newUrl = url.replace("ID",id); //to replace the ID with the id [ category->id fetched ]


      //   //request confirmation before proceeding
      //   if(confirm('Are you sure you want to delete?')){
      //     $.ajax({
      //       url: newUrl,
      //       type: 'delete',
      //       data: {},
      //       dataType: 'json',
      //       headers: {
      //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //       },
      //       success: function(response){
      //         if(response["status"] == true){ //returns the success response
      //           window.location.href = "{{ route('reviews.index') }}";
      //         }else{
      //           window.location.href = "{{ route('reviews.index') }}";
      //         }
      //       }

      //     });

      //   }
        

      // }
      --}}
  @endsection

@endif