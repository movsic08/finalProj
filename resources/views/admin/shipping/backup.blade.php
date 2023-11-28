@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Shipping Management</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
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

              <div class="col-md-4">
                <div class="mb-3">
                  
                  <select name="country" id="country" class="form-control" >
                    <option value="">Select a Country</option>
                    @if($countries->isNotEmpty())
                      @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                      @endforeach
                      <option value="rest_of_world">Rest of the world</option>
                    @endif
                  </select>
                  <p></p>	

                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-3">
                  <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount">
                  <p></p>
                </div>

              </div>

              <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Create</button>
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
          url: '{{ route("shipping.store") }}', //post create route
          type: 'post',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){
            //console.log(response);
                        
            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){
              
              window.location.href = "{{ route('shipping.create') }}";
              //$("button[type=submit]").prop('disabled',true);

            }else{

              

              //if errors occur
              
              var errors = response['errors'];

              if(errors['country']){ //if there are errors on country
                $('#country').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['country']); //with error class and the error message
              }else{ // if no errors on the country, remove the error messages
                $('#country').removeClass('is-invalid') //remove the invalid class
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
            console.log(exception);
            console.log(exception);
            console.log("Something went wrong");
          }


        });

      });
    /**end of Ajax for the form*/


      

  </script>
@endsection


{{--

  //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){
              
              window.location.href = "{{ route('shipping.create') }}";
               $("button[type=submit]").prop('disabled',true);
            }else{

              /*
              //if category is not found
              if(response["notFound"] == true){
                window.location.href = "{{ route('categories.index') }}";
                return false;
              }*/

              //if errors occur
              
              var errors = response['errors'];

              if(errors['country']){ //if there are errors on country
                $('#country').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['country']); //with error class and the error message
              }else{ // if no errors on the country, remove the error messages
                $('#country').removeClass('is-invalid') //remove the invalid class
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




        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Create</button>
          <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
          --}}