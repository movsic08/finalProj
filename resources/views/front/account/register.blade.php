@extends('front.layouts.app')

@section('content')

<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
              <li class="breadcrumb-item">Register</li>
          </ol>
      </div>
  </div>
</section>

<section class=" section-10">
  <div class="container">
      <div class="login-form">    
          <form action="" method="post" name="registrationForm" id="registrationForm"> 
              <h4 class="modal-title">Register Now</h4>
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                  <p></p>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                  <p></p>
              </div>
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
                  <p></p>
              </div>
              <div class="form-group">
                  <input type="password" class="form-control password_input" placeholder="Password" id="password" name="password">
                  <p></p>
              </div>
              <div class="form-group">
                  <input type="password" class="form-control password_input" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                  <p></p>

                  <!-- show password-->
                  <div class="col-md-12 mt-1">
                    <div class="form-group">
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="show_password">
                        <label class="form-check-label" for="show_password">Show Password</label>
                      </div>
                    </div>
                    
                  </div>

              </div>
              

              <div class="form-group small">
                  <a href="#" class="forgot-link">Forgot Password?</a>
              </div> 
              <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
          </form>			
          <div class="text-center small">Already have an account? <a href="{{ route('account.login') }}">Login Now</a></div>
      </div>
  </div>
</section>

@endsection

@section('customJs')
  <script type="text/javascript">

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


    //ajax code for the form
    $("#registrationForm").submit(function(event){
      event.preventDefault();

      //disable the submit button
      $("button[type='submit']").prop('disabled',true);

      $.ajax({
        url: '{{ route("account.processRegister") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
          //disable the submit button
          $("button[type='submit']").prop('disabled',false);

          //errors
          var errors = response.errors;
          
          if(response.status == false){

            if(errors.name){
              $("#name").siblings("p").addClass('invalid-feedback').html(errors.name);
              $("#name").addClass('is-invalid');
            }else{
              $("#name").siblings("p").removeClass('invalid-feedback').html('');
              $("#name").removeClass('is-invalid');
            }

            if(errors.email){
              $("#email").siblings("p").addClass('invalid-feedback').html(errors.email);
              $("#email").addClass('is-invalid');
            }else{
              $("#email").siblings("p").removeClass('invalid-feedback').html('');
              $("#email").removeClass('is-invalid');
            }

            if(errors.phone){
              $("#phone").siblings("p").addClass('invalid-feedback').html(errors.phone);
              $("#phone").addClass('is-invalid');
            }else{
              $("#phone").siblings("p").removeClass('invalid-feedback').html('');
              $("#phone").removeClass('is-invalid');
            }

            if(errors.password){
              $("#password").siblings("p").addClass('invalid-feedback').html(errors.password);
              $("#password").addClass('is-invalid');
            }else{
              $("#password").siblings("p").removeClass('invalid-feedback').html('');
              $("#password").removeClass('is-invalid');
            }

            if(errors.confirm_password){
              $("#confirm_password").siblings("p").addClass('invalid-feedback').html(errors.confirm_password);
              $("#confirm_password").addClass('is-invalid');
            }else{
              $("#confirm_password").siblings("p").removeClass('invalid-feedback').html('');
              $("#confirm_password").removeClass('is-invalid');
            }

          }else{
            //remove errors class and messages
            $("#name").siblings("p").removeClass('invalid-feedback').html('');
            $("#name").removeClass('is-invalid');
            $("#email").siblings("p").removeClass('invalid-feedback').html('');
            $("#email").removeClass('is-invalid');
            $("#password").siblings("p").removeClass('invalid-feedback').html('');
            $("#password").removeClass('is-invalid');

            //redirect to login
            window.location.href = "{{ route('account.login') }}";

          }


        },
        error: function(jQXHR, exception){
          console.log("Something went wrong");
        }

      });


    });
  </script>
@endsection