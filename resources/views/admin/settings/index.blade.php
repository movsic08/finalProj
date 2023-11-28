@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">					
    <div class="container-fluid my-2">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Shop Settings</h1>
        {{-- </div>
        <div class="col-sm-6 text-right">
          <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
        </div> --}}
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="container-fluid">
      <!-- Message -->
      @include('admin.message') 

      <form action="" method="post" id="settingForm" name="settingForm">
        @csrf
        <div class="card">

          <div class="card-header">
            <h2 class="card-title text-primary text-bold">Shop information</h2>
          </div>
          
          <div class="card-body">								
            <div class="row">

              <!-- Name-->
              <div class="col-12 col-md-12">
                <div class="mb-3">
                  <label for="name">Name</label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->name) ? $setting->name : '' }}" name="name" id="name" class="form-control" placeholder="Name">
                  <p></p>	
                </div>
              </div>

              <!-- logo-->
                <!-- image input-->
                <input type="hidden" id="logo_image_id" name="logo_image_id" value="">  <!-- the value of this input is automatically given based onthe uplaoded returned logo_image_id-->
                
                <!-- dropzone-->
                <div class="col-12 col-md-3">
                  <div class="mb-3">
                    <label for="logo_image">Logo Image</label>
                    <div id="logo_image" class="dropzone dz-clickable text-center">
                      <div class="dz-message needsclick">
                        <br>Drop files here or click to upload. <br><br>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-3 ">
                  @if(!empty($setting->logo))
                    <label for="logo">Logo Thumbnail</label>
                    <div class="text-center" style="border-radius: 5px; border:2px dashed rgb(0, 135, 247); min-height: 150px;">
                      <img width="200" style="border-radius: 10px;" class="p-2" src="{{ asset('uploads/setting/thumb/'.$setting->logo) }}" alt="">
                    </div>

                  @else
                    <label for="logo">Logo Thumbnail</label>
                    <div class="text-center" style="border-radius: 5px; border:2px dashed rgb(0, 135, 247); min-height: 150px;">
                      <img width="200" style="border-radius: 10px;" class="p-2" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="">
                    </div>

                  @endif


                </div>
              <!-- end of logo-->

              <!-- favicon-->
                <!-- image input-->
                <input type="hidden" id="favicon_image_id" name="favicon_image_id" value="">  <!-- the value of this input is automatically given based onthe uplaoded returned favicon_image_id-->
              
                <!-- dropzone-->
                <div class="col-12 col-md-3">
                  <div class="mb-3 ">
                    <label for="favicon_image">Favicon Image</label>
                    <div id="favicon_image" class="dropzone dz-clickable text-center">
                      <div class="dz-message needsclick">
                        <br>Drop files here or click to upload. <br><br>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-3  ">
                  @if(!empty($setting->favicon))
                    <label for="logo">Favicon Thumbnail</label>
                    <div class="text-center" style="border-radius: 5px; border:2px dashed rgb(0, 135, 247); min-height: 150px;">
                      <img width="200" style="border-radius: 10px; " class="p-2" src="{{ asset('uploads/setting/thumb/'.$setting->logo) }}" alt="">
                    </div>
                  @else
                    <label for="logo">Favicon Thumbnail</label>
                    <div class="text-center" style="border-radius: 5px; border:2px dashed rgb(0, 135, 247); min-height: 150px;">
                      <img width="200" style="border-radius: 10px;" class="p-2" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt="">
                    </div>

                  @endif
                </div>
 
              <!-- end of favicon-->


              <div class="col-12">
                <div >
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card">

          <div class="card-header ">
            <h2 class="card-title text-primary text-bold ">Contact Information</h2>
          </div>

          <div class="card-body">								
            <div class="row">

              <!-- Location-->
              <div class="col-12 col-md-12">
                <div class="mb-3">
                  <label for="location">Location</label>
                  <textarea name="location" class="summernote" id="" cols="30" rows="10">{!! !empty($setting) && !empty($setting->location) ? $setting->location : '' !!}</textarea>
                  <p></p>	
                </div>
              </div>
                
              <!-- Mobile Number-->
              <div class="col-12 col-md-6" data-bs-toggle="tooltip" >
                <div class="mb-3">
                  <label for="mobile_number">Mobile Number : Main</label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->mobile_number) ? $setting->mobile_number : '' }}" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number">
                  <p></p>	
                </div>
              </div>

              <!-- Mobile Number-->
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="mobile_number_2">Mobile Number : 2nd alternative</label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->mobile_number_2) ? $setting->mobile_number_2 : '' }}" name="mobile_number_2" id="mobile_number_2" class="form-control" placeholder="Mobile Number : 2nd ">
                  <p></p>	
                </div>
              </div>

              <!-- Mobile Number-->
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="mobile_number_3">Mobile Number :  3rd alternative</label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->mobile_number_3) ? $setting->mobile_number_3 : '' }}" name="mobile_number_3" id="mobile_number_3" class="form-control" placeholder="Mobile Number : 3rd">
                  <p></p>	
                </div>
              </div>

              <!-- Mobile Number-->
              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="mobile_number_4">Mobile Number :  4th alternative</label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->mobile_number_4) ? $setting->mobile_number_4 : '' }}" name="mobile_number_4" id="mobile_number_4" class="form-control" placeholder="Mobile Number : 4th">
                  <p></p>	
                </div>
              </div>


              <!-- Email-->
              <div class="col-12 col-md-12">
                <div class="mb-3">
                  <label for="email">Email</label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->email) ? $setting->email : '' }}" name="email" id="email" class="form-control" placeholder="Email">
                  <p></p>	
                </div>
              </div>

              <div class="col-12">
                <div >
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h2 class="card-title text-primary text-bold">Social Media Accounts</h2>
          </div>

          <div class="card-body">								
            <div class="row">

              <!-- Facebook-->
              <div class="col-12 col-md-12">
                <div class="mb-3">
                  <label for="facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px;" viewBox="0 0 216 216">
                      <path d="M108 0C48.309 0 0 48.309 0 108s48.309 108 108 108 108-48.309 108-108S167.691 0 108 0zm26.215 36.52h14.49c.585 0 10.627 14.278 10.627 32.058v14.733H141.84c-14.067 0-16.65 6.628-16.65 16.34v21.409h33.529l-4.364 34.286h-29.165v87.83H88.493v-87.83H64.403v-34.286h24.09v-21.41c0-32.317 19.752-49.983 48.305-49.983z" fill="#1877f2"/>
                    </svg>
                    
                    Facebook
                  </label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->facebook) ? $setting->facebook : '' }}" name="facebook" id="facebook" class="form-control" placeholder="Facebook">
                  <p></p>	
                </div>
              </div>

              <!-- Twitter-->
              <div class="col-12 col-md-12">
                <div class="mb-3">
                  <label for="twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px;"  viewBox="0 0 24 24">
                      <path d="M23.954 4.574c-.885.389-1.83.654-2.825.774 1.014-.611 1.794-1.574 2.163-2.722-.949.555-2.005.958-3.13 1.184-.896-.958-2.174-1.56-3.588-1.56-2.722 0-4.92 2.198-4.92 4.92 0 .386.043.76.127 1.122-4.09-.205-7.722-2.16-10.15-5.143-.424.73-.666 1.574-.666 2.472 0 1.704.866 3.208 2.184 4.088-.804-.025-1.56-.247-2.215-.616v.061c0 2.385 1.693 4.37 3.93 4.826-.412.112-.845.172-1.289.172-.314 0-.616-.03-.918-.083.616 1.924 2.4 3.324 4.525 3.359-1.654 1.293-3.742 2.066-5.995 2.066-.39 0-.775-.023-1.16-.068 2.14 1.372 4.678 2.17 7.415 2.17 8.898 0 13.77-7.36 13.77-13.77 0-.209 0-.418-.015-.627.947-.684 1.768-1.54 2.422-2.514z" fill="#1da1f2"/>
                    </svg>
                    
                    Twitter
                  </label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->twitter) ? $setting->twitter : '' }}" name="twitter" id="twitter" class="form-control" placeholder="Twitter">
                  <p></p>	
                </div>
              </div>


              <!-- Youtube-->
              <div class="col-12 col-md-12">
                <div class="mb-3">
                  
                  <label for="youtube">
                    
                    <svg width="20px" height="auto" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>Youtube</title>
                      <g id="Icon/Social/youtube-color" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <path d="M20.2838235,29.7208546 L20.2817697,19.3775851 L30.0092421,24.5671906 L20.2838235,29.7208546 Z M41.6409276,17.5856462 C41.6409276,17.5856462 41.2890436,15.0488633 40.2097727,13.9319394 C38.8405739,12.4655276 37.3060444,12.4583393 36.6026186,12.3724221 C31.5649942,12 24.008044,12 24.008044,12 L23.9922983,12 C23.9922983,12 16.4356904,12 11.398066,12.3724221 C10.6939556,12.4583393 9.16045298,12.4655276 7.79091194,13.9319394 C6.71164104,15.0488633 6.36009927,17.5856462 6.36009927,17.5856462 C6.36009927,17.5856462 6,20.5646804 6,23.5437145 L6,26.3365376 C6,29.3152295 6.36009927,32.2946059 6.36009927,32.2946059 C6.36009927,32.2946059 6.71164104,34.8310466 7.79091194,35.9483127 C9.16045298,37.4147246 10.9592378,37.3681718 11.7605614,37.5218644 C14.6406709,37.8042616 24.0001711,37.8915481 24.0001711,37.8915481 C24.0001711,37.8915481 31.5649942,37.8799099 36.6026186,37.5074878 C37.3060444,37.4219129 38.8405739,37.4147246 40.2097727,35.9483127 C41.2890436,34.8310466 41.6409276,32.2946059 41.6409276,32.2946059 C41.6409276,32.2946059 42,29.3152295 42,26.3365376 L42,23.5437145 C42,20.5646804 41.6409276,17.5856462 41.6409276,17.5856462 L41.6409276,17.5856462 Z" id="Shape" fill="#E70000"></path>
                      </g>
                  </svg>
                    
                    
                    Youtube
                  </label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->youtube) ? $setting->youtube : '' }}" name="youtube" id="youtube" class="form-control" placeholder="Youtube">
                  <p></p>	
                </div>
              </div>

              <!-- Instagram-->
              <div class="col-12 col-md-12">
                <div class="mb-3">
                  <label for="instagram">
                    <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                      <svg width="20px" height="20px" viewBox="0 0 2500 2500" xmlns="http://www.w3.org/2000/svg"><defs><radialGradient id="0" cx="332.14" cy="2511.81" r="3263.54" gradientUnits="userSpaceOnUse"><stop offset=".09" stop-color="#fa8f21"/><stop offset=".78" stop-color="#d82d7e"/></radialGradient><radialGradient id="1" cx="1516.14" cy="2623.81" r="2572.12" gradientUnits="userSpaceOnUse"><stop offset=".64" stop-color="#8c3aaa" stop-opacity="0"/><stop offset="1" stop-color="#8c3aaa"/></radialGradient></defs><path d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57" fill="url(#0)"/><path d="M833.4,1250c0-230.11,186.49-416.7,416.6-416.7s416.7,186.59,416.7,416.7-186.59,416.7-416.7,416.7S833.4,1480.11,833.4,1250m-225.26,0c0,354.5,287.36,641.86,641.86,641.86S1891.86,1604.5,1891.86,1250,1604.5,608.14,1250,608.14,608.14,895.5,608.14,1250M1767.27,582.69a150,150,0,1,0,150.06-149.94h-0.06a150.07,150.07,0,0,0-150,149.94M745,2267.47c-121.87-5.55-188.11-25.85-232.13-43-58.36-22.72-100-49.78-143.78-93.5s-70.88-85.32-93.5-143.68c-17.16-44-37.46-110.26-43-232.13-6.06-131.76-7.27-171.34-7.27-505.15s1.31-373.28,7.27-505.15c5.55-121.87,26-188,43-232.13,22.72-58.36,49.78-100,93.5-143.78s85.32-70.88,143.78-93.5c44-17.16,110.26-37.46,232.13-43,131.76-6.06,171.34-7.27,505-7.27s373.28,1.31,505.15,7.27c121.87,5.55,188,26,232.13,43,58.36,22.62,100,49.78,143.78,93.5s70.78,85.42,93.5,143.78c17.16,44,37.46,110.26,43,232.13,6.06,131.87,7.27,171.34,7.27,505.15s-1.21,373.28-7.27,505.15c-5.55,121.87-25.95,188.11-43,232.13-22.72,58.36-49.78,100-93.5,143.68s-85.42,70.78-143.78,93.5c-44,17.16-110.26,37.46-232.13,43-131.76,6.06-171.34,7.27-505.15,7.27s-373.28-1.21-505-7.27M734.65,7.57c-133.07,6.06-224,27.16-303.41,58.06C349,97.54,279.38,140.35,209.81,209.81S97.54,349,65.63,431.24c-30.9,79.46-52,170.34-58.06,303.41C1.41,867.93,0,910.54,0,1250s1.41,382.07,7.57,515.35c6.06,133.08,27.16,223.95,58.06,303.41,31.91,82.19,74.62,152,144.18,221.43S349,2402.37,431.24,2434.37c79.56,30.9,170.34,52,303.41,58.06C868,2498.49,910.54,2500,1250,2500s382.07-1.41,515.35-7.57c133.08-6.06,223.95-27.16,303.41-58.06,82.19-32,151.86-74.72,221.43-144.18s112.18-139.24,144.18-221.43c30.9-79.46,52.1-170.34,58.06-303.41,6.06-133.38,7.47-175.89,7.47-515.35s-1.41-382.07-7.47-515.35c-6.06-133.08-27.16-224-58.06-303.41-32-82.19-74.72-151.86-144.18-221.43S2150.95,97.54,2068.86,65.63c-79.56-30.9-170.44-52.1-303.41-58.06C1632.17,1.51,1589.56,0,1250.1,0S868,1.41,734.65,7.57" fill="url(#1)"/>
                      </svg>
                    
                    
                    
                    Instagram
                  </label>
                  <input type="text" value="{{ !empty($setting) && !empty($setting->instagram) ? $setting->instagram : '' }}" name="instagram" id="instagram" class="form-control" placeholder="Instagram">
                  <p></p>	
                </div>
              </div>

              <div class="col-12">
                <div >
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>

            </div>
          </div>

        </div>


        <div class="card">

          <div class="card-header">
            <h2 class="card-title text-primary text-bold">Shop Time Details & Order Confirmation Schedules</h2>
          </div>

          <div class="card-body">								
            <div class="row">

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="open_time">Shop Open Time</label>
                  <input placeholder="Open Time" value="{{ !empty($setting) && !empty($setting->open_time) && $setting->open_time != date('00:00:00') ? \Carbon\Carbon::parse($setting->open_time)->format('h:i A') : '' }}" type="text" name="open_time" id="open_time" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="close_time">Shop Close Time</label>
                  <input placeholder="Close Time" value="{{ !empty($setting) && !empty($setting->close_time) && $setting->open_time != date('00:00:00') ? \Carbon\Carbon::parse($setting->close_time)->format('h:i A')  : '' }}" type="text" name="close_time" id="close_time" class="form-control time" >
                  <p></p>	
                </div>
              </div>


              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="order_confirm_open_time_1">[1st] Order Confirmation Start Time</label>
                  <input placeholder="1st Start Time" value="{{ !empty($setting) && !empty($setting->order_confirm_open_time_1 ) && $setting->order_confirm_open_time_1 != date('00:00:00')  ? \Carbon\Carbon::parse($setting->order_confirm_open_time_1)->format('h:i A') : '' }}" type="text" name="order_confirm_open_time_1" id="order_confirm_open_time_1" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="order_confirm_close_time_1">[1st] Order Confirmation End Time</label>
                  <input placeholder="1st End Time" 
                    value="{{ !empty($setting) && !empty($setting->order_confirm_close_time_1) && $setting->order_confirm_close_time_1 != date('00:00:00') ? \Carbon\Carbon::parse($setting->order_confirm_close_time_1)->format('h:i A')  : '' }}"
                   type="text" 
                   name="order_confirm_close_time_1" 
                   id="order_confirm_close_time_1" 
                   class="form-control time" >
                  <p></p>	
                </div>
              </div> 


              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="order_confirm_open_time_2">[2nd] Order Confirmation Start Time</label>
                  <input placeholder="2nd Start Time" value="{{ !empty($setting) && !empty($setting->order_confirm_open_time_2 ) && $setting->order_confirm_open_time_2 != date('00:00:00')  ? \Carbon\Carbon::parse($setting->order_confirm_open_time_2)->format('h:i A') : '' }}" type="text" name="order_confirm_open_time_2" id="order_confirm_open_time_2" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="order_confirm_close_time_2">[2nd] Order Confirmation End Time</label>
                  <input placeholder="2nd End Time" 
                    value="{{ !empty($setting) && !empty($setting->order_confirm_close_time_2) && $setting->order_confirm_close_time_2 != date('00:00:00') ? \Carbon\Carbon::parse($setting->order_confirm_close_time_2)->format('h:i A')  : '' }}"
                   type="text" 
                   name="order_confirm_close_time_2" 
                   id="order_confirm_close_time_2" 
                   class="form-control time" >
                  <p></p>	
                </div>
              </div> 


              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="order_confirm_open_time_3">[3rd] Order Confirmation Start Time</label>
                  <input placeholder="3rd Start Time" value="{{ !empty($setting) && !empty($setting->order_confirm_open_time_3 ) && $setting->order_confirm_open_time_3 != date('00:00:00')  ? \Carbon\Carbon::parse($setting->order_confirm_open_time_3)->format('h:i A') : '' }}" type="text" name="order_confirm_open_time_3" id="order_confirm_open_time_3" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="order_confirm_close_time_3">[3rd] Order Confirmation End Time</label>
                  <input placeholder="3rd End Time" 
                    value="{{ !empty($setting) && !empty($setting->order_confirm_close_time_3) && $setting->order_confirm_close_time_3 != date('00:00:00') ? \Carbon\Carbon::parse($setting->order_confirm_close_time_3)->format('h:i A')  : '' }}"
                   type="text" 
                   name="order_confirm_close_time_3" 
                   id="order_confirm_close_time_3" 
                   class="form-control time" >
                  <p></p>	
                </div>
              </div> 


              <!-- 
                OrderCofirmTime
                many times that the order are confirmed
              
              -->

              

              
            </div>
          </div>	

        </div>



        <div class="card">

          <div class="card-header">
            <h2 class="card-title text-primary text-bold">Gcash Account</h2>
          </div>

          <div class="card-body">								
            <div class="row">

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="acc_1_gcash_name">[1st] Account - Gcash Name</label>
                  <input placeholder="[1st] Gcash Name" value="{{ !empty($setting) && !empty($setting->acc_1_gcash_name) ? $setting->acc_1_gcash_name : '' }}" type="text"  name="acc_1_gcash_name" id="acc_1_gcash_name" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="acc_1_gcash_number">[1st] Account - Gcash Number</label>
                  <input placeholder="[1st] Gcash Number" value="{{ !empty($setting) && !empty($setting->acc_1_gcash_number) ? $setting->acc_1_gcash_number : '' }}" type="text" name="acc_1_gcash_number" id="acc_1_gcash_number" class="form-control time" >
                  <p></p>	
                </div>
              </div>


              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="acc_2_gcash_name">[2nd] Account - Gcash Name</label>
                  <input placeholder="[2nd] Gcash Name" value="{{ !empty($setting) && !empty($setting->acc_2_gcash_name) ? $setting->acc_2_gcash_name : '' }}"  type="text" name="acc_2_gcash_name" id="acc_2_gcash_name" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="acc_2_gcash_number">[2nd] Account - Gcash Number</label>
                  <input placeholder="[2nd] Gcash Number" value="{{ !empty($setting) && !empty($setting->acc_2_gcash_number) ? $setting->acc_2_gcash_number : '' }}" type="text" name="acc_2_gcash_number" id="acc_2_gcash_number" class="form-control time" >
                  <p></p>	
                </div>
              </div>


              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="acc_3_gcash_name">[3rd] Account - Gcash Name</label>
                  <input placeholder="[3rd] Gcash Name" value="{{ !empty($setting) && !empty($setting->acc_3_gcash_name) ? $setting->acc_3_gcash_name : '' }}" type="text" name="acc_3_gcash_name" id="acc_3_gcash_name" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="acc_3_gcash_number">[3rd] Account - Gcash Number</label>
                  <input placeholder="[3rd] Gcash Number" value="{{ !empty($setting) && !empty($setting->acc_3_gcash_number) ? $setting->acc_3_gcash_number : '' }}" type="text" name="acc_3_gcash_number" id="acc_3_gcash_number" class="form-control time" >
                  <p></p>	
                </div>
              </div>



            </div>
          </div>

        </div>


        <div class="card">

          <div class="card-header">
            <h2 class="card-title text-primary text-bold">Twilio Account Settings</h2>
          </div>

          <div class="card-body">								
            <div class="row">

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="twilio_sid">Twilio SID</label>
                  <input placeholder="Twilio SID" value="{{ !empty($setting) && !empty($setting->twilio_sid) ? $setting->twilio_sid : '' }}" type="text"  name="twilio_sid" id="twilio_sid" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="twilio_token">Twilio Token</label>
                  <input placeholder="Twilio Token" value="{{ !empty($setting) && !empty($setting->twilio_token) ? $setting->twilio_token : '' }}" type="text"  name="twilio_token" id="twilio_token" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              <div class="col-12 col-md-6">
                <div class="mb-3">
                  <label for="twilio_from">Twilio From</label>
                  <input placeholder="Twilio From" value="{{ !empty($setting) && !empty($setting->twilio_from) ? $setting->twilio_from : '' }}" type="text"  name="twilio_from" id="twilio_from" class="form-control time" >
                  <p></p>	
                </div>
              </div>

              {{-- 
                // TWILIO_SID="ACbe46690b196ea6f1bc5b7639d21283e4"
            // TWILIO_TOKEN="48fce15b5d691fa2cfd68e053df04e88"
            // TWILIO_FROM="+639692696666"

                --}}
             



            </div>
          </div>

        </div>
          










        <div class="pb-5 pt-3">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>

    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->





@endsection 

@section('customJs')
  <script>
    //datetimepicker
    $(document).ready(function(){
      $('.time').datetimepicker({
        //options here
        datepicker: false,
        format: 'h:i A',
        
      });
    });


    //console.log('edit setting');

    /**Ajax for the form*/
      $('#settingForm').submit(function(event){
        event.preventDefault(); //prevents the defualt submission of the form

        var element = $(this);//register the form

        $("button[type=submit]").prop('disabled',true); //disables the submit button when the input slug had not loaded and the input is not yet filled

        $.ajax({
          url: '{{ route("admin.updateSettings") }}', //post edit route -> notice that the method used here is put, works the same like post but used for updating
          type: 'put',
          data: element.serializeArray(), //turn the form into array
          dataType: 'json',
          success: function(response){

            $("button[type=submit]").prop('disabled',false); // enable form button on every success json response

            //check if the response status is true [ success ] or false [ fail ]
            if(response['status'] == true){

              //move to the settings index page
              window.location.href="{{ route('admin.settings') }}";

              $('#name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#email').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#location').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#mobile_number').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#mobile_number_2').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#mobile_number_3').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#mobile_number_4').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#open_time').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#close_time').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              
              $('#order_confirm_open_time_1').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#order_confirm_close_time_1').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#order_confirm_open_time_2').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#order_confirm_close_time_2').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#order_confirm_open_time_3').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#order_confirm_close_time_3').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#acc_1_gcash_name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#acc_1_gcash_number').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#acc_2_gcash_name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#acc_2_gcash_number').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#acc_3_gcash_name').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#acc_3_gcash_number').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#twilio_sid').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#twilio_token').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message

              $('#twilio_from').removeClass('is-invalid') //remove the invalid class
              .siblings('p')  // remove a new p tag
              .removeClass('invalid-feedback').html(""); //remove error class and the error message


              

              //check response
              console.log(response);

            }else{

              //if notFound is true   [ setting is not found ]
              // if(response['notFound'] == true){
              //   window.location.href = "{{ route('categories.index') }}";
              //   return false;
              // }

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
              }else{ //if no errors on the email, remove the error messages
                $('#email').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['location']){ //if there are errors on location
                $('#location').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['location']); //with error class and the error message
              }else{ //if no errors on the location, remove the error messages
                $('#location').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['mobile_number']){ //if there are errors on mobile_number
                $('#mobile_number').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['mobile_number']); //with error class and the error message
              }else{ //if no errors on the mobile_number, remove the error messages
                $('#mobile_number').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['mobile_number_2']){ //if there are errors on mobile_number_2
                $('#mobile_number_2').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['mobile_number_2']); //with error class and the error message
              }else{ //if no errors on the mobile_number_2, remove the error messages
                $('#mobile_number_2').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['mobile_number_3']){ //if there are errors on mobile_number_3
                $('#mobile_number_3').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['mobile_number_3']); //with error class and the error message
              }else{ //if no errors on the mobile_number_3, remove the error messages
                $('#mobile_number_3').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['mobile_number_4']){ //if there are errors on mobile_number_4
                $('#mobile_number_4').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['mobile_number_4']); //with error class and the error message
              }else{ //if no errors on the mobile_number_4, remove the error messages
                $('#mobile_number_4').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['open_time']){ //if there are errors on open_time
                $('#open_time').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['open_time']); //with error class and the error message
              }else{ //if no errors on the open_time, remove the error messages
                $('#open_time').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['close_time']){ //if there are errors on close_time
                $('#close_time').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['close_time']); //with error class and the error message
              }else{ //if no errors on the close_time, remove the error messages
                $('#close_time').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['order_confirm_open_time_1']){ //if there are errors on order_confirm_open_time_1
                $('#order_confirm_open_time_1').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['order_confirm_open_time_1']); //with error class and the error message
              }else{ //if no errors on the order_confirm_open_time_1, remove the error messages
                $('#order_confirm_open_time_1').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['order_confirm_close_time_1']){ //if there are errors on order_confirm_close_time_1
                $('#order_confirm_close_time_1').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['order_confirm_close_time_1']); //with error class and the error message
              }else{ //if no errors on the order_confirm_close_time_1, remove the error messages
                $('#order_confirm_close_time_1').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['order_confirm_open_time_2']){ //if there are errors on order_confirm_open_time_2
                $('#order_confirm_open_time_2').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['order_confirm_open_time_2']); //with error class and the error message
              }else{ //if no errors on the order_confirm_open_time_2, remove the error messages
                $('#order_confirm_open_time_2').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['order_confirm_close_time_2']){ //if there are errors on order_confirm_close_time_2
                $('#order_confirm_close_time_2').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['order_confirm_close_time_2']); //with error class and the error message
              }else{ //if no errors on the order_confirm_close_time_2, remove the error messages
                $('#order_confirm_close_time_2').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['order_confirm_open_time_3']){ //if there are errors on order_confirm_open_time_3
                $('#order_confirm_open_time_3').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['order_confirm_open_time_3']); //with error class and the error message
              }else{ //if no errors on the order_confirm_open_time_3, remove the error messages
                $('#order_confirm_open_time_3').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['order_confirm_close_time_3']){ //if there are errors on order_confirm_close_time_3
                $('#order_confirm_close_time_3').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['order_confirm_close_time_3']); //with error class and the error message
              }else{ //if no errors on the order_confirm_close_time_3, remove the error messages
                $('#order_confirm_close_time_3').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['acc_1_gcash_name']){ //if there are errors on acc_1_gcash_name
                $('#acc_1_gcash_name').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['acc_1_gcash_name']); //with error class and the error message
              }else{ //if no errors on the acc_1_gcash_name, remove the error messages
                $('#acc_1_gcash_name').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['acc_1_gcash_number']){ //if there are errors on acc_1_gcash_number
                $('#acc_1_gcash_number').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['acc_1_gcash_number']); //with error class and the error message
              }else{ //if no errors on the acc_1_gcash_number, remove the error messages
                $('#acc_1_gcash_number').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }


              if(errors['acc_2_gcash_name']){ //if there are errors on acc_2_gcash_name
                $('#acc_2_gcash_name').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['acc_2_gcash_name']); //with error class and the error message
              }else{ //if no errors on the acc_2_gcash_name, remove the error messages
                $('#acc_2_gcash_name').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['acc_2_gcash_number']){ //if there are errors on acc_2_gcash_number
                $('#acc_2_gcash_number').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['acc_2_gcash_number']); //with error class and the error message
              }else{ //if no errors on the acc_2_gcash_number, remove the error messages
                $('#acc_2_gcash_number').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }


              if(errors['acc_3_gcash_name']){ //if there are errors on acc_3_gcash_name
                $('#acc_3_gcash_name').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['acc_3_gcash_name']); //with error class and the error message
              }else{ //if no errors on the acc_3_gcash_name, remove the error messages
                $('#acc_3_gcash_name').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['acc_3_gcash_number']){ //if there are errors on acc_3_gcash_number
                $('#acc_3_gcash_number').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['acc_3_gcash_number']); //with error class and the error message
              }else{ //if no errors on the acc_3_gcash_number, remove the error messages
                $('#acc_3_gcash_number').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['twilio_sid']){ //if there are errors on twilio_sid
                $('#twilio_sid').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['twilio_sid']); //with error class and the error message
              }else{ //if no errors on the twilio_sid, remove the error messages
                $('#twilio_sid').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['twilio_token']){ //if there are errors on twilio_token
                $('#twilio_token').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['twilio_token']); //with error class and the error message
              }else{ //if no errors on the twilio_token, remove the error messages
                $('#twilio_token').removeClass('is-invalid') //remove the invalid class
                .siblings('p')  // remove a new p tag
                .removeClass('invalid-feedback').html(""); //remove error class and the error message
              }

              if(errors['twilio_from']){ //if there are errors on twilio_from
                $('#twilio_from').addClass('is-invalid') //add the invalid class
                .siblings('p')  // add a new p tag
                .addClass('invalid-feedback').html(errors['twilio_from']); //with error class and the error message
              }else{ //if no errors on the twilio_from, remove the error messages
                $('#twilio_from').removeClass('is-invalid') //remove the invalid class
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



    /**Dropzone */  //->this is also the submission platform for the dropzone [ image ]
      Dropzone.autoDiscover = false;

      const dropzone = $('#logo_image').dropzone({
        init: function(){
          this.on('addedfile',function(file){
            if(this.files.length > 1){
              this.removeFile(this.files[0]);
            }
          });
        },
        url: "{{ route('temp-images.create_setting_image') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png, image/gif",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file,response){
          //when the temp_image is uploaded, it will return back the logo_image_id to the value of the hidden logo_image_id input file
          $('#logo_image_id').val(response.image_id);
        }

      });


      const dropzone2 = $('#favicon_image').dropzone({
        init: function(){
          this.on('addedfile',function(file){
            if(this.files.length > 1){
              this.removeFile(this.files[0]);
            }
          });
        },
        url: "{{ route('temp-images.create_setting_image') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg, image/png, image/gif",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file,response){
          //when the temp_image is uploaded, it will return back the favicon_image_id to the value of the hidden favicon_image_id input file
          $('#favicon_image_id').val(response.image_id);
        }

      })




    /**end of Dropzone*/

  </script>
@endsection
