@extends('admin.layouts.app')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Sub Category</h1>
        </div>
        <div class="col-sm-6 text-right">
          <a href="{{ route('sub-categories.index') }}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">

      <form action="" name="subCategoryForm" id="subCategoryForm">

        <div class="card">
          <div class="card-body">								
            <div class="row">

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name">Category</label>
                  <select name="category" id="category" class="form-control">

                    <option value="" selected>Select category</option>
                    @if($categories->isNotEmpty())

                      @foreach($categories as $category)
                        <option {{ $subCategory->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach

                    @endif
                  </select>
                  <p></p>

                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $subCategory->name }}">	
                  <p></p>
                </div>
              </div>

              <div class="col-md-4">
                <div class="mb-3">
                  <label for="slug">Slug</label>
                  <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $subCategory->slug }}">	
                  <p></p>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control">
                    <option {{ $subCategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                    <option {{ $subCategory->status == 0 ? 'selected' : ''}}  value="0">Block</option>
                  </select>
                  <p></p>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="mb-3">
                  <label for="showHome">Show on Home</label>
                  <select name="showHome" id="showHome" class="form-control">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>	
                  <p></p>
                </div>
              </div>
              
            </div>
          </div>							
        </div>
        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('sub-categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

      </form>

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->

@endsection

@section('customJs')

  <script>

    /*Ajax on the form*/
    $('#subCategoryForm').submit(function(event){
      event.preventDefault();
      var element = $(this);

      $("button[type=submit]").prop('disabled',true);

      //ajax to insert the new category
      $.ajax({
        url: '{{ route("sub-categories.update",$subCategory->id) }}',
        type: 'put',
        data: element.serializeArray(),
        dataType: 'json',
        success: function(response){

          //check if the response status is true [ success ] or false [ fail ]
          if(response['status'] == true){

            //move to the categories index page
            window.location.href="{{ route('sub-categories.index') }}";

            $('#name').removeClass('is-invalid') //remove the invalid class
            .siblings('p')  // remove a new p tag
            .removeClass('invalid-feedback').html(""); //remove error class and the error message

            $('#slug').removeClass('is-invalid') //remove the invalid class
            .siblings('p')  // remove a new p tag
            .removeClass('invalid-feedback').html(""); //remove error class and the error message

            $('#category').removeClass('is-invalid') //remove the invalid class
            .siblings('p')  // remove a new p tag
            .removeClass('invalid-feedback').html(""); //remove error class and the error message

            //check response
            console.log(response);

          }else{

            //if category is not found
            if(response['notFound'] == true){
              window.location.href = "{{ route('sub-categories.index') }}";
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

            if(errors['category']){ //if there are errors on category
              $('#category').addClass('is-invalid') //add the invalid class
              .siblings('p')  // add a new p tag
              .addClass('invalid-feedback').html(errors['category']); //with error class and the error message
            }else{ //if no errors on the category, remove the error messages
              $('#category').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message
            }
          }

        },
      });

    });



    //Ajax code to generate an automatic slug based on the inputted data on the input name tag
    $("#name").change(function(){
      element = $(this);
      $("button[type=submit]").prop('disabled',true);
      //Ajax
      $.ajax({
        url: '{{ route("getSlug") }}',
        type: 'get',
        data: {title:element.val()},
        dataType: 'json',
        success: function(response){
          $("button[type=submit]").prop('disabled',false);
          if(response["status"] == true){
            $("#slug").val(response["slug"]);
          }

        }
      });


    });



  </script>
  
@endsection

@section('uncommentable_part')

@endsection