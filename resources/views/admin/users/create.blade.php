@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Users</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">
      <form action="" method="post" id="userForm" name="userForm">
        @csrf
        <div class="card">

          <div class="card-body">								
            <div class="row">

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="password">Password</label>
                  <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-12">
                <div class="mb-3">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option value="1">Active</option>
                    <option value="0">Block</option>
                  </select>	
                  <p></p>
                </div>
              </div>

              
              

            </div>
          </div>	

        </div>
        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Create</button>
          <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

      </form>

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection

@section('customJs')
  <script>
    //console.log('create user');

    /**Ajax for the form*/
      $('#userForm').submit(function(event){
        event.preventDefault(); //prevents the defualt submission of the form

        var element = $(this);//register the form

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled

        $.ajax({
          url: '{{ route("users.store") }}', //post create route
          type: 'post',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){

            $("button[type=submit]").prop('disabled',false); //enable in every success json response

            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){

              //move to the users index page
              window.location.href="{{ route('users.index') }}";

              $('#name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#email').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#password').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#phone').removeClass('is-invalid') //remove the invalid class
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

              if(errors['name']){ //if there are errors on name
                $('#name').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['name']); //with error class and the error message
              }else{ // if no errors on the name, remove the error messages
                $('#name').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['email']){ //if there are errors on email
                $('#email').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['email']); //with error class and the error message
              }else{ // if no errors on the email, remove the error messages
                $('#email').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['password']){ //if there are errors on password
                $('#password').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['password']); //with error class and the error message
              }else{ // if no errors on the password, remove the error messages
                $('#password').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['phone']){ //if there are errors on phone
                $('#phone').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['phone']); //with error class and the error message
              }else{ // if no errors on the phone, remove the error messages
                $('#phone').removeClass('is-invalid') //remove the invalid class
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