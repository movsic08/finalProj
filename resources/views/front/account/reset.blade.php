@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.resetPassword',$user->remember_token) }}">Home</a></li>
              <li class="breadcrumb-item">Reset Password</li>
          </ol>
      </div>
  </div>
</section>

<section class=" section-10">
  <div class="container">
    @if(Session::has('success'))
      <div class="alert alert-success">
        {{ Session::get('success') }}
      </div>
    @endif

    @if(Session::has('error'))
      <div class="alert alert-danger">
        {{ Session::get('error') }}
      </div>
    @endif

      <div class="login-form">    
          <form action="{{ route('account.forgotPassword') }}" method="post" id="resetPasswordForm">
            @csrf
              <h4 class="modal-title">Update Your Password</h4>
              <div class="form-group">
                <input type="password" class="form-control password_input" placeholder="New Password" name="new_password"  id="new_password" value="{{ old('new_password') }}">
                <p id="p_new"></p>
                
                <input type="password" class="form-control password_input mt-2" placeholder="Confirm Password" name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}">
                <p id="p_confirm"></p>


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


              <div class="text-center"> 
                <input type="submit" class="btn btn-dark btn-block btn-lg " value="Update"> 
              </div>
                           
          </form>		
          
          <div class="text-center small">Already registered? <a href="{{ route('account.login') }}">Login</a></div>
          <div class="text-center small">Don't have an account? <a href="{{ route('account.register') }}">Sign up</a></div>

          
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


    $("#resetPasswordForm").submit(function(e){
      e.preventDefault();

      //console.log('submitted');

      //disable the submit button by default
      $("#submit").prop("disabled",true);

      $.ajax({
        url: '{{ route("account.postResetPassword",$user->remember_token) }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){

          $("#submit").prop("disabled",false); //enable the submit button

          if(response.status == true){

            window.location.href = "{{ route('account.login') }}";

          }else{

            var errors = response.errors;

            // if(errors.old_password){
            //   $("#old_password").addClass("is-invalid").siblings("p").addClass("invalid-feedback").html(errors.old_password);
            // }else{
            //   $("#old_password").removeClass("is-invalid").siblings("p").removeClass("invalid-feedback").html("");
            // }

            if(errors.new_password){
              $("#new_password").addClass("is-invalid");
              $("#p_new").addClass("invalid-feedback").html(errors.new_password);
            }else{
              $("#new_password").removeClass("is-invalid");
              $("#p_new").removeClass("invalid-feedback").html("");
            }

            if(errors.confirm_password){
              $("#confirm_password").addClass("is-invalid");
              $("#p_confirm").addClass("invalid-feedback").html(errors.confirm_password);
            }else{
              $("#confirm_password").removeClass("is-invalid");
              $("#p_confirm").removeClass("invalid-feedback").html("");
            }

          }

        }
      });


    });


  </script>
@endsection