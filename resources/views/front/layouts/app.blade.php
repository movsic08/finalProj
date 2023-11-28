<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<link href="{{ getShopFavicon() }}" rel="icon" type="image/jpg">

	<title>{{ getShopName() }}</title>

	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	

	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/video-js.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css') }}" />

    <!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	
	<link rel="stylesheet" href="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.css') }}"> <!-- for the dropzone-->

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />

	{{-- csrf token for every form --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body data-instant-intensity="mousedown">

<div class="bg-light top-header">        
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-4 logo">
				
				<a href="{{ route('front.shop') }}" class="text-decoration-none text-nowrap">
					
					<span class="h1 text-uppercase text-primary bg-dark px-2">SHOE</span>
					<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">NIVERSE</span>
				</a>
			</div>
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">

				@if(Auth::check())
					<a href="{{ route('account.profile') }}" class="nav-link text-dark">My Account</a>
				@else 	
					<a href="{{ route('account.login') }}" class="nav-link text-dark">Login/Register</a>
				@endif

				<form action="{{ route('front.shop') }}" method="get">					
					<div class="input-group">
						<input value="{{ Request::get('search') }}" type="text" name="search" placeholder="Search For Products" class="form-control" aria-label="Amount (to the nearest dollar)">
						<button type="submit" class="input-group-text">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>

<!-- header-->
<header class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-xl" id="navbar">
			<a href="{{ route('front.shop') }}" class="text-decoration-none mobile-logo text-nowrap">
				<span class="h2 text-uppercase text-primary bg-dark">SHOE</span>
				<span class="h2 text-uppercase text-white ">NIVERSE</span>
			</a>
			{{-- 
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
				<a href="{{ route('account.profile') }}" class="nav-link text-dark">My Account</a>
				<form action="">					
					<div class="input-group">
						<input type="text" placeholder="Search For Products" class="form-control" aria-label="Amount (to the nearest dollar)">
						<span class="input-group-text">
							<i class="fa fa-search"></i>
					  	</span>
					</div>
				</form>
			</div>
			 --}}
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
				  <i class="navbar-toggler-icon fas fa-bars"></i>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
      			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="d-lg-none">
								<form action="{{ route('front.shop') }}" method="get">					
									<div class="input-group">
										<input value="{{ Request::get('search') }}" type="text" name="search" placeholder="Search For Products" class="form-control" aria-label="Amount (to the nearest dollar)">
										<button type="submit" class="input-group-text">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</form>
							</li>
							<li class="d-lg-none">
								@if(Auth::check())
									<a href="{{ route('account.profile') }}" class="nav-link ">My Account</a>
								@else 	
									<a href="{{ route('account.login') }}" class="nav-link ">Login/Register</a>
								@endif
							</li>
        			<!-- <li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
        			</li> -->

                    {{-- call the function from app\Helpers\helper.php --}}
                    @if(getCategories()->isNotEmpty())
                        @foreach(getCategories() as $category)

													@if($category->sub_category->isNotEmpty())
                            <li class="nav-item dropdown">

															
                                <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $category->name }}
                                </button>

                                
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    @foreach($category->sub_category as $subCategory)
                                        <li><a class="dropdown-item nav-link" href="{{ route('front.shop',[$category->slug,$subCategory->slug]) }}">{{ $subCategory->name }}</a></li>
                                    @endforeach

                                </ul>
															</li>
														@else 

															<li class="nav-item">
																<a class="nav-link active" aria-current="page" href="{{ route('front.shop',$category->slug) }}" title="{{ $category->name }}">{{ $category->name }}</a>
															</li>
															
														@endif

                            
                        @endforeach
                    @endif


                    
					
					
      			</ul>      			
      		</div>   
			<div class="right-nav py-0">
				<a href="{{ route('front.cart') }}" class="ml-3 d-flex pt-2">
					<i class="fas fa-shopping-cart text-primary"></i>					
				</a>
			</div> 		
      	</nav>
  	</div>
</header>



<main>
  @yield('content')
</main>

<!-- footer-->
@include('front.layouts.footer')

<!-- Wishlist Modal-->
	<div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Wishlist</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<div class="modal-body">
					...
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>

			</div>
		</div>
	</div>
<!-- end of Wishlist modal-->


<!-- Product Review Modal-->
<div id="modal_review_value">
	@include('front._product_review_modal')
</div>

<!-- end of Product Review modal-->



<!-- Add to Cart Modal-->
	@php 
		$product_id = 0;
	@endphp

	<div id="modal_value">
		@include('front._product_modal')
	</div>

<!-- end of Add to Cart modal-->

<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<!-- Dropzone  -->
<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script> <!-- for the dropzone-->
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>

<!-- to always provide ajax submission with the csrf token-->
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
	});

	/*for the summernote*/
	$(document).ready(function(){
		$(".summernote").summernote({
			height: 250,
		});
	});


	//ajax for displaying the product add to cart details
	function showProductDetails(id){
		

		//get the user_id
    // var user_id = $(this).attr('data-id');

    
    //console.log(search); //check the search value by outputting the values on the console log
    $.ajax({
      type : 'POST',
      url : "{{ route('front.get_product_details',) }}", //route to fetch the chat users
      data : { id: id },
      //processData: false,
      //contentType: false,
      dataType: 'json',
      success: function(data){

        // //render the fetched success value into the html
      	$('#modal_value').html(data.success);

        // $('#view_info').modal('show');

        // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        // var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        //   return new bootstrap.Tooltip(tooltipTriggerEl)
        // });

				//$('#addToCartModal .modal-body').html(id);
				$('#addToCartModal').modal('show');
				$("#add_to_cart_btn").addClass("disabled");

				var product_id = data.product_id;

				//console.log(data);


				var color_selected = 0;
				var size_selected = 0;

				var color_id_selected = 0;

				$(".colors").on("change",function(){
					
					$(".colors").each(function(){

						
						if($(this).is(':checked')){
							color_selected = $(this).val();
							
						}
						//console.log('color ' + $(this).val() + ' is picked');
						$("#size_container").removeClass("d-none");

						//update the sizes shown controller
						$.ajax({
							type : 'POST',
							url : "{{ route('front.get_size',) }}", //route to fetch the chat users
							data : { id: color_selected },
							//processData: false,
							//contentType: false,
							dataType: 'json',
							success: function(data){
								
								
								
							} 
						});
						


					});

					if(color_selected == 0 || size_selected  == 0){
						console.log('color : ' + color_selected + ' , size : ' + size_selected);
					}else{
						console.log('color and size is selected');
						$("#add_to_cart_btn").removeClass("disabled");
						$("#add_to_cart_btn").attr("onclick","addToCart(" + product_id + "," + color_selected + "," + size_selected + ");");

					}
					

				});

				$(".sizes").on("change",function(){
					
					$(".sizes").each(function(){

						if($(this).is(':checked')){
							size_selected = $(this).val();
						}
						//console.log('size ' + $(this).val() + ' is picked');

					});

					if(color_selected == 0 || size_selected == 0){
						console.log('color : ' + color_selected + ' , size : ' + size_selected);
					}else{
						//console.log('color and size is selected');
						$("#add_to_cart_btn").removeClass("disabled");
						$("#add_to_cart_btn").attr("onclick","addToCart(" + product_id + "," + color_selected + "," + size_selected + ");");

						console.log($("#add_to_cart_btn").attr("onclick"));
					}

					//console.log()

				});


				

        
      },
      error: function(data){

      },  
    });


	}

	//Ajax for the add_to_cart
	function addToCart(id,color_id,size_id){
		//alert(id);
		console.log(id + ' - color : ' + color_id + ' - size : ' + size_id );

		$.ajax({
			url: '{{ route("front.addToCart") }}',
			type: 'post',
			data: {id: id,color_id : color_id, size_id: size_id},
			dataType: 'json',
			success: function(response){

				// window.location.href = '{{ route("front.cart") }}';

				if(response.status == true){ //if product is successfully added in cart
					window.location.href = '{{ route("front.cart") }}';
					alert('Product added to cart');
				}else if(response.status == false){  // if product is already in the cart
					// window.location.href = '{{ route("front.cart") }}';
					alert(response.message);
				}

				alert(response.message);

			}
		});

	}


  $("#add_to_cart_btn").addClass("disabled");



	//ad to wishtlist
	function addToWishlist(id){
		//alert(id);
		$.ajax({
			url: '{{ route("front.addToWishlist") }}',
			type: 'post',
			data: {id: id},
			dataType: 'json',
			success: function(response){

				// window.location.href = '{{ route("front.cart") }}';

				if(response.status == true){ //if product is successfully added in cart
					

					

					$("#wishlistModal .modal-body").html(response.message); // display the modal message response
					$("#wishlistModal").modal('show'); //display the modal

				}else if(response.status == false){  // if product is already in the cart
					window.location.href = "{{ route('account.login') }}";
					//alert(response.message);
				}

				

			}
		});
	}


	//product review js 
	function productReview(product_id,order_item_id){
		console.log(product_id,order_item_id);


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

		// $("#reviewProductModal").modal("show");


	}

	//send product review form
	

		

	//for the tooltip
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
	});	

</script>




@yield('customJs')

</body>
</html>