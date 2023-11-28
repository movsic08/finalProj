@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Update Shipping</h1>
        </div>
        
        <div class="col-sm-6 text-right">
          <a href="{{ route('shipping.create') }}" class="btn btn-primary">Back</a>
        </div>
         
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">
      <form action="" method="post" id="shippingForm" name="shippingForm">
        @csrf
        <div class="card">

          <div class="card-body">								
            <div class="row">


              <!-- Regions -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Region</label>

                    <select name="region_code" id="region_code" class="form-control" >
                      
                      <option value="">Select a Region</option>
                      @if($regions->isNotEmpty())
                        @foreach($regions as $region)
                          <option {{ ($shippingCharge->region_code == $region->region_code) ? 'selected' : '' }} value="{{ $region->region_code }}">{{ $region->region_description }}</option>
                        @endforeach
                      @endif
                    </select>
                    <p></p>	

                  </div>
                </div>
              <!-- end of regions-->

              <!-- Province -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="">Province</label>

                    <select name="province_code" id="province_code" class="form-control" >
                      <option value="">Select a Province</option>
                      @if($provinces->isNotEmpty())
                        @foreach($provinces as $province)
                          <option {{ ($shippingCharge->province_code == $province->province_code) ? 'selected' : '' }} value="{{ $province->province_code }}">{{ $province->province_description }}</option>
                        @endforeach
                      @endif
                    </select>
                    <p></p>	

                  </div>
                </div>
              <!-- end of Province-->

              <!-- Cities -->
                <div class="col-md-6">
                  <div class="mb-3">
                    
                    <label for="">Municipality</label>

                    <select name="city_municipality_code" id="city_municipality_code" class="form-control" >
                      <option value="">Select a City || Municipality</option>
                      @if($city_municipality->isNotEmpty())
                        @foreach($city_municipality as $city)
                          <option {{ ($shippingCharge->city_municipality_code == $city->city_municipality_code) ? 'selected' : '' }} value="{{ $city->city_municipality_code }}">{{ $city->city_municipality_description }}</option>
                        @endforeach
                      @endif
                    </select>
                    <p></p>	

                  </div>
                </div>
              <!-- end of Cities-->

              <!-- Barangays -->
                <div class="col-md-6">
                  <div class="mb-3">
                    
                    <label for="">Barangay</label>

                    <select name="barangay_code" id="barangay_code" class="form-control" >
                      <option value="">Select a Barangay</option>
                      @if($barangays->isNotEmpty())
                        @foreach($barangays as $barangay)
                          <option {{ ($shippingCharge->barangay_code == $barangay->barangay_code) ? 'selected' : '' }} value="{{ $barangay->barangay_code }}">{{ $barangay->barangay_description }}</option>
                        @endforeach
                      @endif
                    </select>
                    <p></p>	

                  </div>
                </div>
              <!-- end of Barangays-->


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="">Shipping Charge</label>

                  <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" value="{{ $shippingCharge->amount }}">
                  <p></p>
                </div>

              </div>

              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
              
              

            </div>
          </div>	

        </div>

        

      </form>

      

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection

@section('customJs')
  <script>
    //console.log('create category');

    /**Ajax for the form*/
      $('#shippingForm').submit(function(event){
        event.preventDefault(); //prevents the defualt submission of the form

        var element = $(this);//register the form

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled

        $.ajax({
          url: '{{ route("shipping.update",$shippingCharge->id) }}', //post create route
          type: 'put',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){
            $("button[type=submit]").prop('disabled',false); //enable submit btn

            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){

              
              window.location.href="{{ route('shipping.create') }}";
              if(response.message){
                alert('message');
              }

              //check response
              console.log(response);

            }else{

              

              //if errors occur
              var errors = response['errors'];

              console.log(errors);

              
              if(errors['country']){ //if there are errors on country
                $('#country').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['country']); //with error class and the error message
              }else{ // if no errors on the country, remove the error messages
                $('#country').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
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

              if(errors['amount']){ //if there are errors on amount
                $('#amount').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['amount']); //with error class and the error message
              }else{ //if no errors on the amount, remove the error messages
                $('#amount').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }





            }

            


          }, error: function(jqXHR,exception){
            console.log("Something went wrong");
          }


        });

      });
    /**end of Ajax for the form*/

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

          url: '{{ route("shipping.getProvinces") }}',
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
        url: '{{ route("shipping.getCityMunicipality") }}',
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
          url: '{{ route("shipping.getBarangay") }}',
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