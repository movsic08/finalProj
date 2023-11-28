@extends('front.layouts.app')

@section('content')

  <section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </div>
    </div>
  </section>

  <section class="section-6 pt-5">
    <div class="container">
        <div class="row">            
            <div class="col-md-3 sidebar">
              <!--Categories and Subcategories -->
                <div class="sub-title">
                    <h2>Categories</h3>
                </div>
                
                
                <div class="card">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionExample">
                          @if($categories->isNotEmpty()) 
                            @foreach($categories as $key => $category)
                              <div class="accordion-item">
                                  
                                  @if($category->sub_category->isNotEmpty())
                                    <h2 class="accordion-header" id="headingOne">
                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $key }}" aria-expanded="false" aria-controls="collapseOne-{{ $key }}">
                                        {{ $category->name }}
                                      </button>
                                    </h2>
                                  @else

                                    <a href="{{ route('front.shop',$category->slug) }}" class="nav-item nav-link {{ $categorySelected == $category->id ? 'text-primary' : '' }}">{{ $category->name }}</a>
                                  @endif 
                                  

                                  @if($category->sub_category->isNotEmpty())
                                    <div id="collapseOne-{{ $key }}" class="accordion-collapse collapse {{ $categorySelected == $category->id ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <div class="navbar-nav">

                                              @foreach($category->sub_category as $subCategory)
                                                <a href="{{ route('front.shop',[$category->slug,$subCategory->slug]) }}" class="nav-item nav-link {{ $subCategorySelected == $subCategory->id ? 'text-primary' : '' }}" >{{ $subCategory->name }}</a>
                                              @endforeach

                                            </div>
                                        </div>
                                    </div>
                                  @endif

                              </div> 
                            @endforeach 
                          @endif
                                           
                                                
                        </div>
                    </div>
                </div>
              <!--end of Categories and Subcategories -->


              <!--Brand -->
                <div class="sub-title mt-5">
                    <h2>Brand</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                      @if($brands->isNotEmpty())
                        @foreach($brands as $brand)
                          <div class="form-check mb-2">
                              {{-- checks if the brand is in the array of brands selected --}}
                              <input {{ (in_array($brand->id,$brandsArray)) ? 'checked' : '' }} class="form-check-input  brand-label" type="checkbox" value="{{ $brand->id }}" name="brand[]" id="brand">
                              <label class="form-check-label" for="brand-{{ $brand->id }}">
                                  {{ $brand->name }}
                              </label>
                          </div>
                        @endforeach
                      @endif           
                    </div>
                </div>
              <!--end of Brand -->

              <!-- Price Range-->
                <div class="sub-title mt-5">
                    <h2>Price Range</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                      
                      <input type="text" class="js-range-slider" name="my_range" value="">
                      
                    </div>
                </div>
              <!-- end of Price Range-->


            </div>

          <!-- Products-->
            <div class="col-md-9">
                <div class="row pb-3">
                  <!-- Sorting Buttons-->  
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <div class="ml-2">

                                {{--  
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Price High</a>
                                        <a class="dropdown-item" href="#">Price Low</a>
                                    </div>
                                </div>
                                --}}
                                <select name="sort" id="sort" class="form-control">
                                  <option {{ ($sort == 'latest') ? 'selected' : '' }} value="latest">Latest</option>  
                                  <option {{ ($sort == 'price_desc') ? 'selected' : '' }} value="price_desc">Price High</option>  
                                  <option {{ ($sort == 'price_asc') ? 'selected' : '' }} value="price_asc">Price Low</option>  
                                </select>  
                                
                                
                            </div>
                        </div>
                    </div>
                  <!-- end of Sorting Buttons-->  

                  <!-- Main Products Section-->
                    @if($products->isNotEmpty())
                      @foreach($products as $product)
                        @php 
                          $productImage = $product->product_images->first();
                        @endphp

                        <div class="col-md-4">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    {{-- <ahref=""class="product-img"><imgclass="card-img-top"src="images/product-1.jpg"alt=""></a> --}}

                                    <a href="{{ route('front.product',$product->slug) }}" class="product-img">
                                      @if(!empty($productImage->image))
                                          <img class="card-img-top" src="{{ asset('uploads/product/small/'.$productImage->image) }}" alt="img-thumbnail">
                                      @else
                                          <img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="img-thumbnail">
                                      @endif
                                    </a>

                                    <a onclick="addToWishlist({{ $product->id }})" class="whishlist" href="javascript:void(0)"><i class="far fa-heart"></i></a>                             

                                    <div class="product-action">
                                      @if($product->track_qty == 'Yes')
                                        
                                        @if($product->qty > 0)
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
                                    <a class="h6 link" href="{{ route('front.product',$product->slug) }}">{{ $product->title }}</a>
                                    <div class="price mt-2">

                                      <span class="h5"><strong>&#8369; {{ number_format($product->price) }}</strong></span>
                                      @if($product->compare_price > 0)
                                          <span class="h6 text-underline"><del>&#8369; {{ number_format($product->compare_price) }}</del></span>
                                      @endif
                                        
                                    </div>
                                </div>                        
                            </div>                                               
                        </div> 
                      @endforeach 
                    @endif
                   
                  <!-- end of Main Products Section-->

                  <!-- Pagination-->
                    <div class="col-md-12 pt-5">
                        {{ $products->links() }}
                        {{--
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>  --}}
                    </div>
                  <!-- end of Pagination-->

                </div>
            </div>
          <!-- end of Products-->

        </div>
    </div>
  </section>


@endsection

@section('customJs')
  <script>

    /*range slider*/
    rangeSlider = $(".js-range-slider").ionRangeSlider({
        type: "double",
        min: 0,
        max: 10000,
        from: {{ ($priceMin) }},
        step: 200,
        to: {{ ($priceMax) }},
        skin: "round",
        max_postfix: "+",
        prefix: "&#8369;",
        onFinish: function(){
          apply_filters()
        }
      });

    /*end of range slider*/

    //saving its instance to var 
    var slider = $(".js-range-slider").data("ionRangeSlider");

    /*for the brands*/
      //on every checked on unchecking change made on the brand checkboxes, perform the apply filters
      $(".brand-label").change(function(){
        apply_filters();  //update the values in every change event
      });

      //sort dropdown
      $("#sort").change(function(){
        apply_filters(); //update the value in every selected option on the sort
      });

      function apply_filters(){

        var brands = [];
        $(".brand-label").each(function(){
          if( $(this).is(":checked") == true ){ //check if the brand checkbox is checked
            brands.push($(this).val()); //pushes the values into the array
          }
        });
        
        //check brands values
        //console.log(brands);
        //console.log(brands.toString());

        var url = '{{ url()->current() }}?';//get the current url with ? at the end

        //PRICE RANGE FILTER
        //apply the price range filter into the url
        url += '&price_min=' + slider.result.from + '&price_max=' + slider.result.to;


        //BRAND FILTER
        if(brands.length > 0){  //verify if there is a brand array value
          //push the brand array values into the url
          url += '&brand=' + brands.toString();
        }

        //SORTING FILTER
        url += '&sort=' + $('#sort').val();

        //SEARCH INPUT FORM FILTER
        
        var keyword = $("#search").val();
        // var length = 0;

        // console.log(keyword);

        if(keyword != undefined){
          if(keyword.length > 0){
            url += '&search=' + keyword;
          }
        }

        

        
        
        //redirect with filter
        window.location.href = url;

      }
    /*end of for the brands*/

    

  </script>

@endsection