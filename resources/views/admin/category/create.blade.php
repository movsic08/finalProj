@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Category</h1>
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
      <form action="" method="post" id="categoryForm" name="categoryForm">
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
                  <label for="showHome">Show on Home</label>
                  <select name="showHome" id="showHome" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>	
                  <p></p>
                </div>
              </div>

              <!-- dropzone-->
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="image">Image</label>
                  <div id="image" class="dropzone dz-clickable">
                    <div class="dz-message needsclick">
                      <br>Drop files here or click to upload. <br><br>
                    </div>
                  </div>
                </div>
              </div>
              
              <input type="hidden" id="image_id" name="image_id" value="">  <!-- the value of this input is automatically given based onthe uplaoded returned image_id-->
              

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

    /**Ajax for the form*/
      $('#categoryForm').submit(function(event){
        event.preventDefault(); //prevents the defualt submission of the form

        var element = $(this);//register the form

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled

        $.ajax({
          url: '{{ route("categories.store") }}', //post create route
          type: 'post',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){

            $("button[type=submit]").prop('disabled',false); //enable in every success json response

            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){

              //move to the categories index page
              window.location.href="{{ route('categories.index') }}";

              $('#name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#slug').removeClass('is-invalid') //remove the invalid class
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

              if(errors['slug']){ //if there are errors on slug
                $('#slug').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['slug']); //with error class and the error message
              }else{ //if no errors on the slug, remove the error messages
                $('#slug').removeClass('is-invalid') //remove the invalid class
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

    /**Dropzone */  //->this is also the submission platform for the dropzone [ image ]
      Dropzone.autoDiscover = false;
      const dropzone = $('#image').dropzone({
        init: function(){
          this.on('addedfile',function(file){
            if(this.files.length > 1){
              this.removeFile(this.files[0]);
            }
          });
        },
        url: "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png, image/gif",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file,response){
          //when the temp_image is uploaded, it will return back the image_id to the value of the hidden image_id input file
          $('#image_id').val(response.image_id);
        }

      })
    /**end of Dropzone*/

  </script>
@endsection