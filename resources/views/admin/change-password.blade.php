@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Change Password</h1>
        </div>
        <div class="col-sm-6 text-right">
          {{-- <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a> --}}
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">
      @include('admin.message')

      <form action="" method="post" id="changePassword" name="changePassword">
        @csrf
        <div class="card">

          <div class="card-body">								
            <div class="row">

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="old_password">Old Password</label>
                  <input type="password" name="old_password" id="old_password" class="form-control password_input" placeholder="Old Password">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="new_password">New Password</label>
                  <input type="password" name="new_password" id="new_password" class="form-control password_input" placeholder="New Password">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="confirm_password">Confirm New Password</label>
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control password_input" placeholder="Confirm New Password">
                  <p></p>	
                </div>
              </div>

              <!-- show password-->
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="show_password">
                    <label class="form-check-label" for="show_password">Show Password</label>
                  </div>
                </div>
                
              </div>

              

            </div>
          </div>	

        </div>
        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Update</button>
          {{-- <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a> --}}
        </div>

      </form>

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection

@section('customJs')
  <script>
    //show password
    $("#show_password").on("click",function(){

      if($(this).is(":checked")){

        $(".password_input").each(function(){
          $(this).prop("type","text");
        });

      }else{

        $(".password_input").each(function(){
          $(this).prop("type","password");
        });

      }

    });

    //console.log('change password');

    /**Ajax for the form*/
      $('#changePassword').submit(function(event){
        event.preventDefault(); //prevents the defualt submission of the form

        var element = $(this);//register the form

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled

        $.ajax({
          url: '{{ route("admin.processChangePassword") }}', //post create route
          type: 'post',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){

            $("button[type=submit]").prop('disabled',false); //enable in every success json response

            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){

              //move to the change password form
              window.location.href="{{ route('admin.showChangePasswordForm') }}";

              $('#name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message


              

              //check response
              console.log(response);

            }else{

              

              //if errors occur
              var errors = response['errors'];

              if(errors['old_password']){ //if there are errors on old_password
                $('#old_password').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['old_password']); //with error class and the error message
              }else{ // if no errors on the old_password, remove the error messages
                $('#old_password').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['new_password']){ //if there are errors on new_password
                $('#new_password').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['new_password']); //with error class and the error message
              }else{ // if no errors on the new_password, remove the error messages
                $('#new_password').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['confirm_password']){ //if there are errors on confirm_password
                $('#confirm_password').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['confirm_password']); //with error class and the error message
              }else{ // if no errors on the confirm_password, remove the error messages
                $('#confirm_password').removeClass('is-invalid') //remove the invalid class
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