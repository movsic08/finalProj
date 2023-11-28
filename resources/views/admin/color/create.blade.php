

@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Color</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="{{ route('colors.index') }}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">
      <form action="" method="post" id="colorsForm" name="colorsForm">
        @csrf
        <div class="card">

          <div class="card-body">								
            <div class="row">

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                  <p></p>	
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="slug">Slug</label>
                  <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" readonly>	
                  <p></p>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">

                  <label>Color </label>
                  <div class="input-group my-colorpicker2">
                    <input name="color" id="color" type="text" class="form-control">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>

                    
                  </div>

                  
                  <p id="color_error"> </p>


                </div>
              </div>

              

            </div>
          </div>	

        </div>
        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Create</button>
          <a href="{{ route('colors.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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

    

    /*for the color picker*/
    $(".my-colorpicker2").colorpicker();

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    /**Ajax for the form*/
      $('#colorsForm').submit(function(event){
        event.preventDefault(); //prevents the defualt submission of the form

        var element = $(this);//register the form

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled

        $.ajax({
          url: '{{ route("colors.store") }}', //post create route
          type: 'post',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){

            $("button[type=submit]").prop('disabled',false); //enable in every success json response

            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){

              //move to the colors index page
              window.location.href="{{ route('colors.index') }}";

              $('#name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#slug').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#color').removeClass('is-invalid'); //remove the invalid class
              $('#color_error')  // remove a new p tag
              .removeClass('text-danger').html(""); //remove error class and the error message


              //check response
              console.log(response);

            }else{

              //if category is not found
              if(response["notFound"] == true){
                window.location.href = "{{ route('colors.index') }}";
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

              if(errors['slug']){ //if there are errors on slug
                $('#slug').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['slug']); //with error class and the error message
              }else{ //if no errors on the slug, remove the error messages
                $('#slug').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['color']){ //if there are errors on color
                $('#color').addClass('is-invalid'); //add the invalid class
                
                $('#color_error').addClass('text-danger').html(`<small>` + errors['color'] + `</small>`); //with error class and the error message

              }else{ //if no errors on the color, remove the error messages
                $('#color').removeClass('is-invalid'); //remove the invalid class

                $('#color_error').removeClass('text-danger').html(""); //remove error class and the error message

              }
            }

            


          }, error: function(jqXHR,exception){
            console.log("Something went wrong");
          }


        });

      });
    /**end of Ajax for the form*/


    /**get Slug Ajax */
      $('#name').change(function(){

        //registers the name
        element = $(this);

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled


        $.ajax({
          url: '{{ route("getSlug") }}',
          type: 'get',
          data: {title: element.val()}, //passes the data value of the input
          dataType: 'json',
          success: function(response){

            $("button[type=submit]").prop('disabled',false); //enables the submit button back when the slug is filled


            //then returns the formatted slug text into the slug input
            if(response["status"] == true){
              $('#slug').val(response["slug"]);
            }

          },

        });

      });
    /**end of get Slug Ajax */



  </script>
@endsection