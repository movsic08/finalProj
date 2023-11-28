@extends('front.layouts.app')

@section('content')
    
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
              <li class="breadcrumb-item">Checkout</li>
          </ol>
      </div>
  </div>
</section>

<section class="section-9 pt-4">
  <div class="container">
    <form action="" id="orderForm" name="orderForm" method="post">
      <div class="row">
          <div class="col-md-8">
              <div class="sub-title">
                  <h2>Shipping Address</h2>
              </div>
              <div class="card shadow-lg border-0">
                  <div class="card-body checkout-form">
                      <div class="row">
                          
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{{ (!empty($customerAddress)) ? $customerAddress->first_name : '' }}">
                                  <p></p>
                              </div>            
                          </div>
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{ (!empty($customerAddress)) ? $customerAddress->last_name : '' }}">
                                  <p></p>
                              </div>            
                          </div>
                          
                          <div class="col-md-12">
                              <div class="mb-3">
                                  <input type="text" readonly name="email" id="email" class="form-control" placeholder="Email" value="{{ (!empty(Auth::user()->email)) ? Auth::user()->email : '' }}">
                                  <p></p>
                              </div>            
                          </div>

                          <div class="col-md-12">
                              <div class="mb-3">
                                  <select disabled name="country" id="country" class="form-control">
                                    <option value="">Select a Country</option>
                                    @if($countries->isNotEmpty())
                                      @foreach($countries as $country)
                                        @php
                                        /* 
                                          $country_id = 170; // for PH id
                                          if(!empty($customerAddress) && $customerAddress->country_id == $country->id){
                                            $country_id = $country->id;
                                          }
                                          */
                                        @endphp
                                          {{-- $country_id==$country->id?'selected':'' --}}
                                        <option {{ $country->id == 170 ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                  <p></p>
                              </div>            
                          </div>

                          <div class="col-md-12">
                              <div class="mb-3">
                                  <textarea name="address" id="address" cols="30" rows="3" placeholder="Street Name, Building House No." class="form-control">{{ (!empty($customerAddress)) ? $customerAddress->address : '' }}</textarea>
                                  <p></p>
                              </div>            
                          </div>

                          <div class="col-md-12">
                              <div class="mb-3">
                                  <input type="text" name="apartment" id="apartment" class="form-control" placeholder="Apartment, suite, unit, etc. (optional)" value="{{ (!empty($customerAddress)) ? $customerAddress->apartment : '' }}">
                              </div>            
                          </div>



                          <div class="col-md-6">         
                              @php
                                  $regions = getRegions();
                              @endphp                           
                              <select name="region_code" id="region_code" class="form-control shipping_info">
                                  <option value="">Select a Region</option>
                                  @if($regions->isNotEmpty())
                                      @foreach($regions as $region)
                                          <option {{ (!empty($customerAddress) && $customerAddress->region_code == $region->region_code) ? 'selected' : '' }}  value="{{ $region->region_code }}">{{ $region->region_description }}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <p></p>
                          </div>

                          <div class="col-md-6">         
                              @php
                                  if(!empty($customerAddress->region_code)){
                                    $provinces = getProvinces($customerAddress->region_code);
                                  }else{
                                    $provinces = [];
                                  }
                              @endphp                           
                              <select name="province_code" id="province_code" class="form-control shipping_info">
                                  <option value="">Select a Province</option>
                                  @if(!empty($provinces))
                                      @foreach($provinces as $province)
                                          <option {{ (!empty($customerAddress) && $customerAddress->province_code == $province->province_code) ? 'selected' : '' }} value="{{ $province->province_code }}">{{ $province->province_description }}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <p></p>
                          </div>

                          <div class="col-md-6">         
                              @php
                                if(!empty($customerAddress->province_code)){
                                  $cities = getCities($customerAddress->province_code);
                                }else{
                                  $cities = [];
                                }
                                  //dd($cities)
                              @endphp       
                              <label for="">City || Municipality</label>                    
                              <select name="city_municipality_code" id="city_municipality_code" class="form-control shipping_info">
                                  <option value="">Select a City || Municipality</option>
                                  @if(!empty($cities))
                                      @foreach($cities as $city)
                                          <option {{ (!empty($customerAddress) && $customerAddress->city_municipality_code == $city->city_municipality_code) ? 'selected' : '' }} value="{{ $city->city_municipality_code }}">{{ $city->city_municipality_description }}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <p></p>
                          </div>

                          <div class="col-md-6">         
                              @php
                                if(!empty($customerAddress->city_municipality_code)){
                                  $barangays = getBarangays($customerAddress->city_municipality_code);
                                }else{
                                  $barangays = [];
                                }
                                  
                              @endphp                           
                              <label for="">Barangay</label>
                              <select name="barangay_code" id="barangay_code" class="form-control shipping_info">
                                  <option value="">Select a Barangay</option>
                                  @if(!empty($barangays))
                                      @foreach($barangays as $barangay)
                                          <option {{ (!empty($customerAddress) && $customerAddress->barangay_code == $barangay->barangay_code) ? 'selected' : '' }} value="{{ $barangay->barangay_code }}">{{ $barangay->barangay_description }}</option>
                                      @endforeach
                                  @endif
                              </select>
                              <p></p>
                          </div>



                          
                          
                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="">ZIP CODE</label>
                                  <input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" value="{{ (!empty($customerAddress)) ? $customerAddress->zip : '' }}">
                                  <p></p>
                              </div>            
                          </div>

                          <div class="col-md-6">
                              <div class="mb-3">
                                <label for="">Mobile Number</label>
                                  <input type="text" readonly name="mobile" id="mobile" class="form-control" placeholder="Mobile No." value="{{ (!empty(Auth::user()->phone)) ? Auth::user()->phone : '' }}">
                                  <p></p>
                              </div>            
                          </div>
                          

                          <div class="col-md-12">
                              <div class="mb-3">
                                  <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control"></textarea>
                              </div>            
                          </div>

                      </div>
                  </div>
              </div>    
          </div>
          <div class="col-md-4">
              <div class="sub-title">
                  <h2>Order Summery</h3>
              </div>                    
              <div class="card cart-summery">
                  <div class="card-body">
                    @foreach(Cart::content() as $item)
                      <div class="d-flex justify-content-between pb-2">
                          <div class="h6">
                          
                            {{-- color --}}
                              @php 
                                $color = getColor($item->options->color);
                              @endphp
                              @if(!empty($color))
                                <div style="display: inline-block; width:10px; height: 10px; border:1px solid gray; background-color: {{ $color->color }}"></div> 
                              @endif
                            {{-- end of color --}}

                            {{-- size --}}
                              @php 
                                $size = getSize($item->options->size);
                              @endphp
                              @if(!empty($size))
                                <div style="display: inline-block; height: 10px; ">{{ $size->size }} - </div> 
                              @endif
                            {{-- end of size --}}


                            {{ $item->name }} X {{ $item->qty }}
                          </div>
                          <div class="h6 text-nowrap">&#8369; {{ $item->price * $item->qty }}</div>
                      </div>
                    @endforeach

                      <div class="d-flex justify-content-between summery-end">
                          <div class="h6"><strong>Subtotal</strong></div>
                          <div class="h6"><strong>&#8369; {{ Cart::subtotal() }}</strong></div>
                      </div>
                      <div class="d-flex justify-content-between summery-end">
                        <div class="h6"><strong>Discount</strong></div>
                        <div class="h6"><strong id="discount_value">&#8369; {{ number_format($discount,2) }}</strong></div>
                      </div>
                      <div class="d-flex justify-content-between mt-2">
                          <div class="h6"><strong>Shipping</strong></div>
                          <div class="h6"><strong id="shippingAmount">&#8369; {{ number_format($totalShippingCharge,2) }}</strong></div>
                      </div>
                      <div class="d-flex justify-content-between mt-2 summery-end">
                          <div class="h5"><strong>Total</strong></div>
                          <div class="h5"><strong id="grandTotal">&#8369; {{ number_format($grandTotal,2) }}</strong></div>
                      </div>                            
                  </div>
              </div>   
              
              <div class="input-group apply-coupon mt-4">
                <input type="text" placeholder="Coupon Code" class="form-control" name="discount_code" id="discount_code">
                <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
              </div>

              <div id="discount-response-wrapper">
                @if(Session::has('code'))
                  <div class=" mt-4" id="discount-response">
                    <strong >
                      {{ Session::get('code')->code }}
                    </strong>
                    <a class=" btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
                  </div>
                @endif
              </div>

              <div class="card payment-form "> 
                  <h3 class="card-title h5 mb-3" id="payment_error">Payment Method</h3>
                  <p ></p>
                
                  <div class="form-check">
                    
                    <input type="radio" name="payment_method" value="cod" id="payment_method_one">
                    <label for="payment_method_one" class="form-check-label">COD</label>
                  </div>

                  



                  {{-- For Stripe --}}
                  {{-- <div class="form-check">
                    <input type="radio" name="payment_method" value="stripe" id="payment_method_two">
                    <label for="payment_method_two" class="form-check-label">Stripe</label>
                  </div>
                
                  
                  <div class="card-body p-0 d-none" id="card-payment-form">
                      <div class="mb-3">
                          <label for="card_number" class="mb-2">Card Number</label>
                          <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <label for="expiry_date" class="mb-2">Expiry Date</label>
                              <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
                          </div>
                          <div class="col-md-6">
                              <label for="expiry_date" class="mb-2">CVV Code</label>
                              <input type="text" name="expiry_date" id="expiry_date" placeholder="123" class="form-control">
                          </div>
                      </div>
                      
                  </div>
                  --}}

                  <div class="form-check">
                    
                    <input type="radio" name="payment_method" value="gcash" id="payment_method_three">
                    <label for="payment_method_three" class="form-check-label">Gcash</label>
                  </div>


                  <div class="card-body p-0 d-none" id="gcash-payment-form">
                    <div class="mb-3">
                        <label for="card_number" class="mb-2">Shoeniverse Gcash Details</label>
                        <br>
                        <small>IMPORTANT NOTE: <br>Before submitting your gcash payment info here, please make sure that you have first sent your payment with the total amount to be paid on the Gcash details of our shop below</small><br>

                        <div style="line-height: normal">
                          <small>{!! getGcash1() !!}</small>
                          <small>{!! getGcash2() !!}</small>
                          <small>{!! getGcash3() !!}</small>
                        </div>
                        


                    </div>
                    

                    <div class="form-group ">
                      <label for="" class="col-form-label text-nowrap">Amount: <span class="text-danger">*</span></label>
                      <input type="text" name="" readonly id="" class="form-control" placeholder="&#8369;" value="&#8369; {{ number_format($grandTotal,2) }}">
                      
                    </div>
        
                    <div class="form-group hidden-inputs">
                      <label for="gcash_name" class="col-form-label text-nowrap hidden-inputs"><span class="text-info">GCASH</span> Name: <span class="text-danger">*</span></label>
                      <input type="text" name="gcash_name" id="gcash_name" class="form-control hidden-inputs" placeholder="Name">
                      <p></p>
                    </div>
        
                    <div class="form-group hidden-inputs">
                      <label for="gcash_number" class="col-form-label text-nowrap hidden-inputs"><span class="text-info">GCASH</span> Phone number: <span class="text-danger">*</span></label>
                      <input type="text" name="gcash_number" id="gcash_number" class="form-control hidden-inputs" placeholder="Gcash number">
                      <p></p>
                    </div>
        
                    {{-- <div class="form-group hidden-inputs">
                      <label for="gcash_photo_reciept" class="col-form-label text-nowrap hidden-inputs"><span class="text-info">GCASH</span> Reciept [ image,photo,file ]: <span class="text-danger">*</span></label>
                      <input type="file" name="gcash_photo_reciept" id="gcash_photo_reciept" class="form-control hidden-inputs" placeholder="Gcash photo reciept">
                      <p></p>
                    </div> --}}

                    <!-- dropzone-->
                      
                    <div class="form-group hidden-inputs">
                      <label for="image">Image</label>
                      <div id="image" class="dropzone dz-clickable">
                        <div class="dz-message needsclick">
                          <br>Drop files here or click to upload. <br><br>
                        </div>
                      </div>
                    </div>
                      
                      <input type="hidden" id="gcash_photo_reciept" name="gcash_photo_reciept" value="">  <!-- the value of this input is automatically given based onthe uplaoded returned gcash_photo_reciept-->
                      <p></p>
        
                    <div class="form-group hidden-inputs">
                      <label for="gcash_ref_number" class="col-form-label text-nowrap hidden-inputs"><span class="text-info">GCASH</span> Reference Number: <span class="text-danger">*</span></label>
                      <input type="text" name="gcash_ref_number" id="gcash_ref_number" class="form-control hidden-inputs" placeholder="Reference number">
                      <p></p>
                    </div>

                    <div class="form-group hidden-inputs">
                      <label for="gcash_sent_to" class="col-form-label text-nowrap hidden-inputs"><span class="text-info">GCASH</span> Payment Sent to: <span class="text-danger">*</span></label>

                      <select name="gcash_sent_to" id="gcash_sent_to" class="form-control">
                        <option value="">Select Gcash Account</option>
                        @if(!empty(getGcashOptions()))
                          {!! getGcashOptions() !!}
                        @endif
                      </select>
                      <p></p>

                    </div>
                      
                  </div>


                  
                  <div class="pt-4">
                    {{-- <ahref="#"class="btn-darkbtnbtn-blockw-100">PayNow</a> --}}
                    <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                  </div>

              </div>

                    
              <!-- CREDIT CARD FORM ENDS HERE -->
              
          </div>
      </div>
    </form>
  </div>
</section>

@endsection

@section('customJs')
  <script>


    // $("#gcash_name").prop("required","");
    // $("#gcash_name").prop("required","");
    // $("#gcash_name").prop("required","");
    // $("#gcash_name").prop("required","");
    // $("#gcash_name").prop("required","");


    /*for COD*/
    $("#payment_method_one").click(function(){
      //close stripe form
      if($(this).is(':checked') == true){
        $("#card-payment-form").addClass("d-none");
      }

      //close the gcash form
      if($(this).is(':checked') == true){
        $("#gcash-payment-form").addClass("d-none");
      }


    });

    /*for Stripe*/
    $("#payment_method_two").click(function(){
      //close the gcash form
      if($(this).is(':checked') == true){
        $("#gcash-payment-form").addClass("d-none");
      }

      //open the stripe form
      if($(this).is(':checked') == true){
        $("#card-payment-form").removeClass("d-none");
      }
      
    });

    /*for gcash*/
    $("#payment_method_three").click(function(){
      //close stripe form
      if($(this).is(':checked') == true){
        $("#card-payment-form").addClass("d-none");

        // $("#gcash_name").prop("required","required");
        // $("#gcash_name").prop("required","required");
        // $("#gcash_name").prop("required","required");
        // $("#gcash_name").prop("required","required");
        // $("#gcash_name").prop("required","required");


      }

      //open the gcash form
      if($(this).is(':checked') == true){
        $("#gcash-payment-form").removeClass("d-none");
      }



    });


    $("#orderForm").submit(function(event){

      event.preventDefault();
      $('button[type="submit"]').prop('disabled',true); // disable the submit button by default
      


      $.ajax({
        url: '{{ route("front.processCheckout") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
          $('button[type="submit"]').prop('disabled',false); // enable the submit button by default
      
          var errors = response.errors;
          

          if(response.status == false){
            
            

            if(errors.first_name){
              $("#first_name").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.first_name);
            }else{
              $("#first_name").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.last_name){
              $("#last_name").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.last_name);
            }else{
              $("#last_name").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.email){
              $("#email").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.email);
            }else{
              $("#email").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.country){
              $("#country").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.country);
            }else{
              $("#country").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.address){
              $("#address").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.address);
            }else{
              $("#address").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.state){
              $("#state").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.state);
            }else{
              $("#state").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.city){
              $("#city").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.city);
            }else{
              $("#city").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.zip){
              $("#zip").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.zip);
            }else{
              $("#zip").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.mobile){
              $("#mobile").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.mobile);
            }else{
              $("#mobile").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors.payment_method){
              $("#payment_error").addClass('is-invalid')
                .siblings("p")
                .addClass("invalid-feedback")
                .html(errors.payment_method);
            }else{
              $("#payment_error").removeClass('is-invalid')
                .siblings("p")
                .removeClass("invalid-feedback")
                .html('');
            }

            if(errors['region_code']){ //if there are errors on country
                $('#region_code').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['region_code']); //with error class and the error message
            }else{ // if no errors on the region_code, remove the error messages
                $('#region_code').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            if(errors['province_code']){ //if there are errors on country
                $('#province_code').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['province_code']); //with error class and the error message
            }else{ // if no errors on the province_code, remove the error messages
                $('#province_code').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            if(errors['city_municipality_code']){ //if there are errors on country
                $('#city_municipality_code').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['city_municipality_code']); //with error class and the error message
            }else{ // if no errors on the city_municipality_code, remove the error messages
                $('#city_municipality_code').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            if(errors['barangay_code']){ //if there are errors on country
                $('#barangay_code').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['barangay_code']); //with error class and the error message
            }else{ // if no errors on the barangay_code, remove the error messages
                $('#barangay_code').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            if(errors['gcash_name']){ //if there are errors on country
                $('#gcash_name').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['gcash_name']); //with error class and the error message
            }else{ // if no errors on the gcash_name, remove the error messages
                $('#gcash_name').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }


            if(errors['gcash_number']){ //if there are errors on country
                $('#gcash_number').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['gcash_number']); //with error class and the error message
            }else{ // if no errors on the gcash_number, remove the error messages
                $('#gcash_number').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            if(errors['gcash_photo_reciept']){ //if there are errors on country
                $('#gcash_photo_reciept').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['gcash_photo_reciept']); //with error class and the error message
            }else{ // if no errors on the gcash_photo_reciept, remove the error messages
                $('#gcash_photo_reciept').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            if(errors['gcash_ref_number']){ //if there are errors on country
                $('#gcash_ref_number').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['gcash_ref_number']); //with error class and the error message
            }else{ // if no errors on the gcash_ref_number, remove the error messages
                $('#gcash_ref_number').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            if(errors['gcash_sent_to']){ //if there are errors on country
                $('#gcash_sent_to').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['gcash_sent_to']); //with error class and the error message
            }else{ // if no errors on the gcash_sent_to, remove the error messages
                $('#gcash_sent_to').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }

            
            

          }else{  // success -> front.thankyou
            window.location.href = "{{ url('thanks/') }}/" + response.orderId; //passed to url with the success response orderId
            
          }




        }
      });


    });

    //ajax to change the value of shipping depending on the location selected
    $("#country").change(function(){
      $.ajax({
        url: '{{ route("front.getOrderSummery") }}',
        type: 'post',
        data: {country_id: $(this).val()},
        dataType: 'json',
        success: function(response){

          //if response is true, update the values
          if(response.status == true){
            $("#shippingAmount").html("&#8369; " + response.shippingCharge);
            $("#grandTotal").html("&#8369; " + response.grandTotal);
          }

        }
      });
    });


    //ajax to apply discount code if the code is used
    $("#apply-discount").click(function(){
      $.ajax({
        url: '{{ route("front.applyDiscount") }}',
        type: 'post',
        data: {code: $("#discount_code").val(),country_id: $("#country").val()},
        dataType: 'json',
        success: function(response){

          //if response is true, update the values
          if(response.status == true){
            $("#shippingAmount").html("&#8369; " + response.shippingCharge);
            $("#grandTotal").html("&#8369; " + response.grandTotal);
            $("#discount_value").html("&#8369; " + response.discount);
            $("#discount-response-wrapper").html(response.discountString);
          }else{
            $("#discount-response-wrapper").html("<span class='text-danger mt-3 mx-3'>" +response.message + "</span>");
          }

        }
      });
    });

    //remove discount
    $('body').on('click','#remove-discount',function(){

      $.ajax({
        url: '{{ route("front.removeCoupon") }}',
        type: 'post',
        data: {country_id: $("#country").val()},
        dataType: 'json',
        success: function(response){
          if(response.status == true){
            $("#shippingAmount").html("&#8369; " + response.shippingCharge);
            $("#grandTotal").html("&#8369; " + response.grandTotal);
            $("#discount_value").html("&#8369; " + response.discount);
            
            //console.log('deleted');
            $("#discount-response-wrapper").html(response.discountString);
            //remove the discount disply
            $("#discount-response").html('');
            $("#discount_code").val('');
            
          }
          
        }
      });
      

    });

    
    /*Ajax to get provinces*/
        $("#region_code").on("change",function(){

            // console.log($(this).val());
            var region_code = $(this).val();

            //if someting is changed, make defaults
            // $("#city_municipality_code").prop("disabled","disabled");
            $("#city_municipality_code").html('<option value=""> Select a City || Municipality</option>');

            // $("#barangay_code").prop("disabled","disabled");
            $("#barangay_code").html('<option value=""> Select a Barangay</option>');


            //ajax to return the provinces connected to the region
            $.ajax({

                url: '{{ route("account.getProvinces") }}',
                type: 'post',
                data: {region_code:region_code},
                dataType: 'json',
                success: function(data){
                    if(data.status == false){
                    alert(data.message);
                    }else{

                    // alert("success");
                    $("#province_code").prop("disabled","");
                    $("#province_code").html(data.html);

                    }
                }

            });

        });
    /*end of Ajax to get provinces*/

    /*Ajax to get city_municipality*/
        $("#province_code").on("change",function(){

            //console.log($(this).val());
            var province_code = $(this).val();

            //if someting is changed, make defaults
            // $("#barangay_code").prop("disabled","disabled");
            $("#barangay_code").html('<option value=""> Select a Barangay</option>');


            $.ajax({
                url: '{{ route("account.getCityMunicipality") }}',
                type: 'post',
                data: {province_code:province_code},
                dataType: 'json',
                success: function(data){

                    if(data.status == false){
                    alert(data.message);
                    }else{

                    // alert("success");
                    $("#city_municipality_code").prop("disabled","");
                    $("#city_municipality_code").html(data.html);

                    }

                }
            });

        });
    /*end of Ajax to get city_municipality*/

    /*Ajax to get barangay*/
        $("#city_municipality_code").on("change",function(){

            //console.log($(this).val());
            var city_municipality_code = $(this).val();

            $.ajax({
                url: '{{ route("account.getBarangay") }}',
                type: 'post',
                data: {city_municipality_code: city_municipality_code},
                dataType: 'json',
                success: function(data){

                    $("#barangay_code").prop("disabled","");
                    $("#barangay_code").html(data.html);

                }
            });

        });
    /*end of Ajax to get barangay*/

    /*Ajax to Update Shipping when the .shipping_info is changed*/
      $(".shipping_info").on("change",function(){
        var region_code = $("#region_code").val();
        var province_code = $("#province_code").val();
        var city_municipality_code = $("#city_municipality_code").val();
        var barangay_code = $("#barangay_code").val();

        console.log("region_code: " + region_code + " , province_code: " + province_code + " , city_municipality_code: " + city_municipality_code + " , barangay_code: " + barangay_code );

        
        $.ajax({
          url: '{{ route("front.getOrderSummery") }}',
          type: 'post',
          data: {
            region_code: region_code,
            province_code: province_code,
            city_municipality_code: city_municipality_code,
            barangay_code: barangay_code
          },
          dataType: 'json',
          success: function(response){

            //if response is true, update the values
            if(response.status == true){
              $("#shippingAmount").html("&#8369; " + response.shippingCharge);
              $("#grandTotal").html("&#8369; " + response.grandTotal);
            }

          }
        });
      });

    /*end of Ajax to Update Shipping when the .shipping_info is changed*/


     /**Dropzone */  //->this is also the submission platform for the dropzone [ image ]
     Dropzone.autoDiscover = false;
      const dropzone = $('#image').dropzone({
        init: function(){
          this.on('addedfile',function(file){
            if(this.files.length > 1){
              this.removeFile(this.files[0]);
            }
          });
        },
        url: "{{ route('temp-images-gcash.create') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png, image/gif",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file,response){
          //when the temp_image is uploaded, it will return back the image_id to the value of the hidden image_id input file
          $('#gcash_photo_reciept').val(response.image_id);
        }

      })
    /**end of Dropzone*/


  </script>
@endsection