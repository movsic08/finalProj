<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel Shop :: Administrative Panel</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css') }}">
		<link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
      @include('admin.message')

			<div class="card card-outline card-warning">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Administrative Panel</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Update your Password</p>
					<form action="{{ route('admin.resetPassword',$user->remember_token) }}" method="post" id="resetPasswordForm">
            @csrf

              
              
              <!-- new_password-->
				  		<div class="input-group mb-3">
                <input type="password" name="new_password" id="new_password" class="form-control password_input" placeholder="New Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                <p id="p_new"></p>

				  		</div>

              <!-- confirm_password-->
				  		<div class="input-group mb-3">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control password_input" placeholder="Confirm Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                    </div>
                </div>
                <p id="p_confirm"></p>

				  		</div>

							<!-- show password-->
							<div class="form-group">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="show_password">
									<label class="form-check-label" for="show_password">Show Password</label>
								</div>
							</div>


				  		<div class="row">
							<!-- <div class="col-8">
					  			<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">
						  				Remember Me
									</label>
					  			</div>
							</div> -->
							<!-- /.col -->
							<div class="col-4">
					  			<button type="submit" class="btn btn-warning btn-block">Update</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
		  			<p class="mb-1 mt-3">
				  		<a href="{{ route("admin.login") }}" class="text-warning">Login</a>
					</p>					
			  	</div>
			  	<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="{{ asset('admin-assets/js/demo.js') }}"></script>


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



      //reset password form validator
      $("#resetPasswordForm").submit(function(e){
        e.preventDefault();

        //console.log('submitted');

        //disable the submit button by default
        $("#submit").prop("disabled",true);

        $.ajax({
          url: '{{ route("admin.postResetPassword",$user->remember_token) }}',
          type: 'post',
          data: $(this).serializeArray(),
          dataType: 'json',
          success: function(response){

            $("#submit").prop("disabled",false); //enable the submit button

            if(response.status == true){

              window.location.href = "{{ route('admin.login') }}";

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
	

	</body>
</html>