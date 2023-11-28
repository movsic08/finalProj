@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
              <li class="breadcrumb-item">Login</li>
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
          <form action="{{-- route('otp.generate') --}}" method="post" class="text-center" id="verification_form">
            @csrf
              <h4 class="modal-title">Verify OTP</h4>
              <div class="form-group">
                  <input type="text" class="form-control text-center" placeholder="OTP Verification Code" name="otp_code" id="otp_code" value="">
                  <p></p>
              </div>
              
            
              <input type="submit" class="btn btn-dark btn-block btn-lg" value="Verify">     

          </form>		

          
          

      </div>

      <div class="text-center small">
        <form action="{{ route('otp.generate') }}" method="post" class="text-center" id="otp_form">
          @csrf

          <input type="hidden" class="form-control text-center" placeholder="Phone number" name="mobile_no" id="mobile_no" value="{{ Auth::user()->phone }}">
          Resend verification code? <button class="" style="background: transparent; border: none;" type="submit">Resend</button>
        </form>
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


    //ajax code for the otp code resend form
    $("#otp_form").submit(function(event){
      event.preventDefault();

      //disable the submit button
      $("button[type='submit']").prop('disabled',true);

      $.ajax({
        url: '{{ route("otp.generate") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
          //disable the submit button
          $("button[type='submit']").prop('disabled',false);

          //errors
          var errors = response.errors;
          
          if(response.status == false){

            if(errors.mobile_no){
              $("#mobile_no").addClass('is-invalid').siblings("p").addClass('invalid-feedback').html(errors.mobile_no);
            }else{
              $("#mobile_no").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
            }

            
          }else{
            //remove errors class and messages
            $("#mobile_no").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
            

            //redirect to verification
            window.location.href = "{{ route('otp.verification') }}";

          }


        },
        error: function(jQXHR, exception){
          console.log("Something went wrong");
        }

      });


    });

    //ajax code for the form
    $("#verification_form").submit(function(event){
      event.preventDefault();

      //disable the submit button
      $("button[type='submit']").prop('disabled',true);

      $.ajax({
        url: '{{ route("otp.postVerification") }}',
        type: 'post',
        data: $(this).serializeArray(),
        dataType: 'json',
        success: function(response){
          //disable the submit button
          $("button[type='submit']").prop('disabled',false);

          //errors
          var errors = response.errors;
          
          if(response.status == false){

            if(errors.otp_code){
              $("#otp_code").addClass('is-invalid').siblings("p").addClass('invalid-feedback').html(errors.otp_code);
            }else{
              $("#otp_code").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
            }

            
          }else{
            //remove errors class and messages
            $("#otp_code").removeClass('is-invalid').siblings("p").removeClass('invalid-feedback').html('');
            

            //redirectaccount.profile
            window.location.href = "{{ route('account.profile') }}";

          }


        },
        error: function(jQXHR, exception){
          console.log("Something went wrong");
        }

      });


    });




    

  </script>
@endsection