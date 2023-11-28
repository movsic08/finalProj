@extends('front.layouts.app')

@section('content')

    <!--Carousel -->
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-1-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-1.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-1.jpg') }}" alt="" />
                        {{-- <source media="(max-width: 799px)" srcset="{{ asset('uploads/shop/wall2.jpeg') }}" /> 
                        <source media="(min-width: 800px)" srcset="{{ asset('uploads/shop/wall2.jpeg') }}" />
                        <img src="{{ asset('uploads/shop/wall2.jpeg') }}" alt="" />  --}}
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3"> Step into Savings at <br>👟 Shoeniverse! 👠</h1>
                            <p class="mx-md-5 px-5">🛍️ Quality meets affordability, and every step is a statement! Shop now before these deals walk away! ✨<br> #ShoeniverseSavings #StealsAndHeels"</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{ url('/shop?discount="true"') }}">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    
                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-2-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-2.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-2.jpg') }}" alt="" />
                        {{-- <source media="(max-width: 799px)" srcset="{{ asset('uploads/shop/wall3.jpeg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('uploads/shop/wall3.jpeg') }}" />
                        <img src="{{ asset('uploads/shop/wall3.jpeg') }}" alt="" /> --}}
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Shoeniverse Spotlight: <br>🌟 Featured Products! 👢</h1>
                            <p class="mx-md-5 px-5">Elevate your elegance with our carefully curated collection. From trendsetting designs to timeless classics, every pair is a masterpiece. </p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#featured_products">Shop Now</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <!-- <img src="images/carousel-3.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                        <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/carousel-3-m.jpg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/carousel-3.jpg') }}" />
                        <img src="{{ asset('front-assets/images/carousel-2.jpg') }}" alt="" />
                        {{-- <source media="(max-width: 799px)" srcset="{{ asset('uploads/shop/wall1.jpeg') }}" />
                        <source media="(min-width: 800px)" srcset="{{ asset('uploads/shop/wall1.jpeg') }}" />
                        <img src="{{ asset('uploads/shop/wall1.jpeg') }}" alt="" /> --}}
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Unveiling the Latest at <br> 👡 Shoeniverse! 🚀 </h1>
                            <p class="mx-md-5 px-5">Stay ahead of the curve with our Newest Arrivals. From runway to reality, these styles are fresh off the design board</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#latest_products">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- 4 card Banner-->
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>                    
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>                    
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>                    
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>                    
                </div>
            </div>
        </div>
    </section>


    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>           
            <div class="row pb-3">

                @if(getCategories()->isNotEmpty())
                    @foreach(getCategories() as $category)
                        <div class="col-lg-3">
                            <div class="cat-card">
                                <div class="left">
                                    @if($category->image != "")
                                        <img src="{{ asset('uploads/category/thumb/'.$category->image) }}" alt="" class="img-fluid">
                                    @endif
                                </div>
                                <div class="right">
                                    <div class="cat-data">
                                        <h2>{{ $category->name }}</h2>
                                        {{-- <p>100Products</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                
            </div>
        </div>
    </section>
    
    <!-- Featured Products-->
    <section class="section-4 pt-5" id="featured_products">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>    
            <div class="row pb-3">

                @if($featuredProducts->isNotEmpty())
                    @foreach($featuredProducts as $product)
                        {{-- product image --}}
                        @php 
                            $productImage = $product->product_images->first();
                        @endphp
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    {{-- <ahref=""class="product-img"><imgclass="card-img-top"src="asset('front-assets/') }}images/product-1.jpg" alt=""></a>--}}

                                    <a href="{{ route("front.product",$product->slug) }}" class="product-img">
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
                                                {{-- 
                                                <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>  

                                                 --}}

                                                <button class="btn btn-dark" onclick="showProductDetails({{ $product->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </button>
                                            @else
                                                <a class="btn btn-dark" href="javascript:void(0);" >
                                                    <i class="fa fa-shopping-cart"></i> Out of Stock
                                                </a> 
                                            @endif

                                        @else
                                            {{--  
                                            <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>  
                                            --}}

                                            <button class="btn btn-dark" onclick="showProductDetails({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </button>
                                        @endif
                                        
                                        
                                    </div>
                                </div>                        
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route("front.product",$product->slug) }}">{{ $product->title }}</a>
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
                
                
            </div>
        </div>
    </section>

    <!-- Latest Products-->
    <section class="section-4 pt-5" id="latest_products">
        <div class="container">
            <div class="section-title">
                <h2>Latest Produsts</h2>
            </div>    
            <div class="row pb-3">

                @if($latestProducts->isNotEmpty())
                    @foreach($latestProducts as $product)
                        {{-- product image --}}
                        @php 
                            $productImage = $product->product_images->first();
                        @endphp
                        <div class="col-md-3">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    {{-- <ahref=""class="product-img"><imgclass="card-img-top"src="asset('front-assets/') }}images/product-1.jpg" alt=""></a>--}}
                                    <a href="{{ route("front.product",$product->slug) }}" class="product-img">
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
                                                {{-- 
                                                <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart( $product->id  }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a> 
                                                 --}}
                                                 
                                                 <button class="btn btn-dark" onclick="showProductDetails({{ $product->id }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </button>
                                            @else
                                                <a class="btn btn-dark" href="javascript:void(0);" >
                                                    <i class="fa fa-shopping-cart"></i> Out of Stock
                                                </a> 
                                            @endif

                                        @else
                                            {{--  
                                            <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </a>  
                                            --}}

                                            <button class="btn btn-dark" onclick="showProductDetails({{ $product->id }})">
                                                <i class="fa fa-shopping-cart"></i> Add To Cart
                                            </button>
                                        @endif                          
                                    </div>
                                </div>                        
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="{{ route("front.product",$product->slug) }}">{{ $product->title }}</a>
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

                
            </div>
        </div>
    </section>

@endsection

{{-- 
    //add to cart orginal btn
    <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart( $product->id  }})">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
    
    
    --}}