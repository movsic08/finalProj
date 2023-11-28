@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Create Brand</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="brands.html" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">

      <form action="" id="createBrandForm" name="createBrandForm" method="post">

        <div class="card">
          <div class="card-body">								
            <div class="row">

              <div class="col-md-4">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-3">
                  <label for="slug">Slug</label>
                  <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-4">
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
          <a href="{{ route("brands.index") }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
      </form>


    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection

@section('customJs')

  <script>

    /*Ajax on form*/
    $('#createBrandForm').submit(function(event){
      event.preventDefault();
      var element = $(this);

      $("button[type=submit]").prop("disabled",true);

      /*main ajax*/
      $.ajax({
        url: '{{ route("brands.store") }}',
        type: 'post',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){

          $("button[type=submit]").prop('disabled',false); // enable form button on every success json response

          //check if the response status is true [ success ] or false [ fail ]
          if(response['status'] == true){

            
            //move to the categories index page
            window.location.href="{{ route('brands.index') }}";

            
            $('#name').removeClass('is-invalid') //remove the invalid class
            .siblings('p')  // remove a new p tag
            .removeClass('invalid-feedback').html(""); //remove error class and the error message

            $('#slug').removeClass('is-invalid') //remove the invalid class
            .siblings('p')  // remove a new p tag
            .removeClass('invalid-feedback').html(""); //remove error class and the error message

            /*
            $('#category').removeClass('is-invalid') //remove the invalid class
            .siblings('p')  // remove a new p tag
            .removeClass('invalid-feedback').html(""); //remove error class and the error message
            */

            //check response
            console.log(response);
            

          }else{

            //if brands record is not found
            if(response["notFound"] == true){
              window.location.href = "{{ route('brands.index') }}";
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

            /*
            if(errors['category']){ //if there are errors on category
              $('#category').addClass('is-invalid') //add the invalid class
              .siblings('p')  // add a new p tag
              .addClass('invalid-feedback').html(errors['category']); //with error class and the error message
            }else{ //if no errors on the category, remove the error messages
              $('#category').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }*/
          }



        }
      });


    });

    /*Ajax on Slug*/
    $('#name').change(function(){
      element = $(this);
      $("button[type=submit]").prop('disabled',true);

      $.ajax({
        url: '{{ route("getSlug") }}',
        type: 'get',
        data: {title: element.val()},
        dataType: 'json',
        success: function(response){
          $('button[type=submit]').prop('disabled',false);
          if(response['status'] == true){
            $("#slug").val(response["slug"]);
          }
        },
      });

    });
  </script>
  
@endsection

@section('uncommentable_part')
{{-- 


/*
            */
 --}}
@endsection