@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a></li>
              <li class="breadcrumb-item">My Profile</li>
          </ol>
      </div>
  </div>
</section>

<section class=" section-11 ">
  <div class="container  mt-5">
      <div class="row">

        {{-- session message --}}
            <div class="col-12">
                @include('front.message')
            </div>
        {{-- end of session message --}}


          <div class="col-md-3">
            @include('front.account.common.sidebar')
          </div>
          <div class="col-md-9">

            {{-- main user profile --}}
              <div class="card">

                <form action="" name="profileForm" id="profileForm">
                  <div class="card-header">
                      <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                  </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="mb-3">               
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control" value="{{ $user->name }}">
                            <p></p>
                        </div>
                        <div class="mb-3">  
                            
                            <div class="col-12 d-flex justify-content-between">
                                <div>
                                    <label for="email">Email</label> 
                                </div>  
                               
                                <div>
                                    @if(empty(Auth::user()->email_verified_at))
                                        <span class=" text-danger"><i class="fas fa-times" class="text-success"></i> Email is not verified</span>
    
                                        <a class="btn btn-sm btn-primary" href="{{ route('account.verifyEmail') }}" data-bs-toggle="tooltip" title="Click here to send verification email">Verify</a>
    
                                    @else 
                                        <span class="text-success float-right"> <i class="fas fa-check" class="text-success"></i> Email is verified</span>
    
    
                                    @endif
                                </div>
                            </div>

                            <input type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control" value="{{ $user->email }}">
                            <p></p>


                        </div>
                        <div class="mb-3">                                    
                            
                            <div class="col-12 d-flex justify-content-between">

                                <div class="mb-0">
                                    <label for="phone">Phone</label> 
                                </div>  
                               
                                <div class="">
                                    @if(empty(Auth::user()->phone_verified_at))
                                        <span class=" text-danger"><i class="fas fa-times" class="text-success"></i> Phone is not verified</span>
    
                                        <a class="btn btn-sm btn-primary " href="{{ route('otp.login') }}" data-bs-toggle="tooltip" title="Click here to verify phone number">Verify</a>
    
                                    @else 
                                        <span class="text-success float-right"> <i class="fas fa-check" class="text-success"></i> Phone is verified</span>
    
    
                                    @endif
                                </div>

                            </div>
                            
                            <input type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control" value="{{ $user->phone }}">
                            <p></p>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-dark">Update</button>
                        </div>
                    </div>
                </div>
                </form>

              </div>
            {{-- end of main user profile --}}

            {{-- user address --}}
                <div class="card">

                    <form action="" name="addressForm" id="addressForm">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">               
                                    <label for="first_name">First Name</label>
                                    <input value="{{ (!empty($customer_address)) ? $customer_address->first_name : '' }}" type="text" name="first_name" id="first_name" placeholder="Enter Your First Name" class="form-control" >
                                    <p></p>
                                </div>

                                <div class="mb-3">               
                                    <label for="last_name">Last Name</label>
                                    <input value="{{ (!empty($customer_address)) ? $customer_address->last_name : '' }}" type="text" name="last_name" id="last_name" placeholder="Enter Your Last Name" class="form-control" >
                                    <p></p>
                                </div>

                                <div class="mb-3">            
                                    <label for="email">Email</label>
                                    <input value="{{ $user->email }}" readonly type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control" >
                                    <p></p>
                                </div>

                                <div class="mb-3">                                    
                                    <label for="mobile">Mobile</label>
                                    <input value="{{ $user->phone }}" readonly type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile" class="form-control" >
                                    <p></p>
                                </div>

                                <div class="mb-3">                                    
                                    <label for="country_id">Country</label>
                                    <select disabled name="country_id" id="country_id" class="form-control">
                                        <option value="">Select a Country</option>
                                        @if($countries->isNotEmpty())
                                            @foreach($countries as $country)
                                                <option {{ $country->id == '170' ? 'selected' : '' }} value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-3">         
                                    @php
                                        $regions = getRegions();
                                    @endphp                           
                                    <label for="region_code">Regions</label>
                                    <select name="region_code" id="region_code" class="form-control">
                                        <option value="">Select a Region</option>
                                        @if($regions->isNotEmpty())
                                            @foreach($regions as $region)
                                                <option {{ (!empty($customer_address) && $customer_address->region_code == $region->region_code) ? 'selected' : '' }}  value="{{ $region->region_code }}">{{ $region->region_description }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-3">         
                                    @php
                                        if(!empty($customer_address)){
                                            $provinces = getProvinces($customer_address->region_code);
                                        }else{
                                            $provinces = [];
                                        }
                                        
                                    @endphp                           
                                    <label for="province_code">Province</label>
                                    <select name="province_code" id="province_code" class="form-control">
                                        <option value="">Select a Province</option>
                                        @if(!empty($provinces))
                                            @foreach($provinces as $province)
                                                <option {{ (!empty($customer_address) && $customer_address->province_code == $province->province_code) ? 'selected' : '' }} value="{{ $province->province_code }}">{{ $province->province_description }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-3">         
                                    @php
                                        if(!empty($customer_address)){
                                            $cities = getCities($customer_address->province_code);
                                        }else{
                                            $cities = [];
                                        }
                                    @endphp                           
                                    <label for="city_municipality_code">City || Municipality</label>
                                    <select name="city_municipality_code" id="city_municipality_code" class="form-control">
                                        <option value="">Select a City || Municipality</option>
                                        @if(!empty($cities))
                                            @foreach($cities as $city)
                                                <option {{ (!empty($customer_address) && $customer_address->city_municipality_code == $city->city_municipality_code) ? 'selected' : '' }} value="{{ $city->city_municipality_code }}">{{ $city->city_municipality_description }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-3">         
                                    @php
                                        if(!empty($customer_address)){
                                            $barangays = getBarangays($customer_address->city_municipality_code);
                                        }else{
                                            $barangays = [];
                                        }
                                    @endphp                           
                                    <label for="barangay_code">Barangay</label>
                                    <select name="barangay_code" id="barangay_code" class="form-control">
                                        <option value="">Select a Barangay</option>
                                        @if(!empty($barangays))
                                            @foreach($barangays as $barangay)
                                                <option {{ (!empty($customer_address) && $customer_address->barangay_code == $barangay->barangay_code) ? 'selected' : '' }} value="{{ $barangay->barangay_code }}">{{ $barangay->barangay_description }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>

                                <div class="mb-3">                                    
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" placeholder="Enter Your Address" class="form-control" rows="5">{{ (!empty($customer_address)) ? $customer_address->address : '' }}</textarea>
                                    <p></p>
                                </div>

                                <div class="mb-3">                                    
                                    <label for="apartment">Apartment</label>
                                    <textarea name="apartment" id="apartment" placeholder="Apartment, suite, unit, etc. (optional)" class="form-control" rows="5">{{ (!empty($customer_address)) ? $customer_address->apartment : '' }}</textarea>
                                    <p></p>
                                </div>

                                {{-- <div class="mb-3">                                    
                                    <label for="city">City</label>
                                    <input value="{{ (!empty($address)) ? $address->city : '' }}" type="text" name="city" id="city" placeholder="City" class="form-control" >
                                    <p></p>
                                </div>

                                <div class="mb-3">                                    
                                    <label for="state">State</label>
                                    <input value="{{ (!empty($address)) ? $address->state : '' }}" type="text" name="state" id="state" placeholder="State" class="form-control" >
                                    <p></p>
                                </div> --}}

                                <div class="mb-3">                                    
                                    <label for="zip">Zip</label>
                                    <input value="{{ (!empty($customer_address)) ? $customer_address->zip : '' }}" type="text" name="zip" id="zip" placeholder="Zip" class="form-control" >
                                    <p></p>
                                </div>


                                <div class="d-flex">
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            {{-- end of user address --}}


          </div>
      </div>
  </div>
</section>

@endsection

@section('customJs')
    <script>

        /*profileForm*/
        $("#profileForm").submit(function(event){
            event.preventDefault();

            //ajax for the profileForm
            $.ajax({
                url: '{{ route("account.updateProfile") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){

                    if(response.status == true){ //for true

                        window.location.href = '{{ route("account.profile") }}';

                    }else{ //for errors

                        var errors = response.errors;
                        if(errors.name){ //add error messages
                            $("#name")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.name)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#name")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.email){ //add error messages
                            $("#email")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.email)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#email")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.phone){ //add error messages
                            $("#phone")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.phone)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#phone")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                    }

                }
            });

        });
        /*end of profileForm*/

        /*addressForm*/
        $("#addressForm").submit(function(event){
            event.preventDefault();

            //ajax for the addressForm
            $.ajax({
                url: '{{ route("account.updateAddress") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){

                    if(response.status == true){ //for true

                        window.location.href = '{{ route("account.profile") }}';

                    }else{ //for errors

                        var errors = response.errors;
                        if(errors.first_name){ //add error messages
                            $("#addressForm #first_name")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.first_name)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #first_name")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.last_name){ //add error messages
                            $("#addressForm #last_name")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.last_name)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #last_name")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.email){ //add error messages
                            $("#addressForm #email")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.email)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #email")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.country_id){ //add error messages
                            $("#addressForm #country_id")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.country_id)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #country_id")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.address){ //add error messages
                            $("#addressForm #address")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.address)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #address")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.city){ //add error messages
                            $("#addressForm #city")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.city)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #city")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.state){ //add error messages
                            $("#addressForm #state")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.state)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #state")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.zip){ //add error messages
                            $("#addressForm #zip")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.zip)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #zip")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors.mobile){ //add error messages
                            $("#addressForm #mobile")
                                .addClass('is-invalid')
                                .siblings("p")
                                .html(errors.mobile)
                                .addClass('invalid-feedback');
                        }else{ //remove error messages
                            $("#addressForm #mobile")
                                .removeClass('is-invalid')
                                .siblings("p")
                                .html('')
                                .removeClass('invalid-feedback');
                        }

                        if(errors['country']){ //if there are errors on country
                            $('#country').addClass('is-invalid') //add the invalid class
                            .siblings('p')  // add a new p tag
                            .addClass('invalid-feedback').html(errors['country']); //with error class and the error message
                        }else{ // if no errors on the country, remove the error messages
                            $('#country').removeClass('is-invalid') //remove the invalid class
                            .siblings('p')  // remove a new p tag
                            .removeClass('invalid-feedback').html(""); //remove error class and the error message
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

                        


                    }

                }
            });

        });
        /*end of addressForm*/


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


    </script>
@endsection