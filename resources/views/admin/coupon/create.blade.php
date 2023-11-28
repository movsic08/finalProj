@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Coupon Code</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="{{ route('coupons.index') }}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">
      <form action="" method="post" id="discountForm" name="discountForm">
        @csrf
        <div class="card">

          <div class="card-body">								
            <div class="row">

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="code">Code </label>
                  <input type="text" name="code" id="code" class="form-control" placeholder="Coupon Code">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Coupon Code Name">	
                  <p></p>
                </div>
              </div>

              

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="max_uses">Max Uses</label>
                  <input type="text" name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="max_uses_user">Max Uses User</label>
                  <input type="text" name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max Uses User">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="type">Type</label>
                  <select name="type" id="type" class="form-control">
                    <option value="percent">Percent</option>
                    <option value="fixed">Fixed</option>
                  </select>
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="discount_amount">Discount Amount</label>
                  <input type="text" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="min_amount">Min Amount</label>
                  <input type="text" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount">	
                  <p></p>
                </div>
              </div>


              <div class="col-md-6">
                <div class="mb-3">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Block</option>
                  </select>
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="starts_at">Starts At</label>
                  <input type="text" name="starts_at" id="starts_at" class="form-control" placeholder="Starts At">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="expires_at">Expires At</label>
                  <input type="text" name="expires_at" id="expires_at" class="form-control" placeholder="Expires At">	
                  <p></p>
                </div>
              </div>


              <div class="col-md-12">
                <div class="mb-3">
                  <label for="description">Description</label>
                  <textarea name="description" id="description" cols="10" rows="3" class="form-control summernote"></textarea>
                  <p></p>
                </div>
              </div>
              

            </div>
          </div>	

        </div>
        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Create</button>
          <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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

    /*Datetime picker*/
      $(document).ready(function(){

        $('#starts_at').datetimepicker({
          // options here
          format:'Y-m-d H:i:s',
        });

        $('#expires_at').datetimepicker({
          // options here
          format:'Y-m-d H:i:s',
        });

      });
    /*end of Datetime picker*/


    /**Ajax for the form*/
      $('#discountForm').submit(function(event){
        event.preventDefault(); //prevents the defualt submission of the form

        var element = $(this);//register the form

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled

        $.ajax({
          url: '{{ route("coupons.store") }}', //post create route
          type: 'post',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){
            $("button[type=submit]").prop('disabled',false); // enable form button on every success json response

            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){

              //move to the coupons index page
              window.location.href="{{ route('coupons.index') }}";

              $('#code').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#discount_amount').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#starts_at').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message


              //check response
              console.log(response);

            }else{

              //if category is not found
              if(response["notFound"] == true){
                window.location.href = "{{ route('categories.index') }}";
                return false;
              }

              //if errors occur
              var errors = response['errors'];

              if(errors['code']){ //if there are errors on code
                $('#code').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['code']); //with error class and the error message
              }else{ // if no errors on the code, remove the error messages
                $('#code').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['discount_amount']){ //if there are errors on discount_amount
                $('#discount_amount').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['discount_amount']); //with error class and the error message
              }else{ //if no errors on the discount_amount, remove the error messages
                $('#discount_amount').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['starts_at']){ //if there are errors on starts_at
                $('#starts_at').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['starts_at']); //with error class and the error message
              }else{ //if no errors on the starts_at, remove the error messages
                $('#starts_at').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['expires_at']){ //if there are errors on expires_at
                $('#expires_at').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['expires_at']); //with error class and the error message
              }else{ //if no errors on the expires_at, remove the error messages
                $('#expires_at').removeClass('is-invalid') //remove the invalid class
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


  </script>
@endsection