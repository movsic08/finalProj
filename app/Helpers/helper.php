<?php
  //test
  //echo "hello";
use App\Models\Page;
use App\Models\Size;
use App\Models\Color;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\ProductImage;
use App\Mail\OrderEmailUpdate;
use App\Models\PhilippineCity;
use App\Models\PhilippineRegion;
use App\Models\ProductVariation;
use App\Models\PhilippineBarangay;
use App\Models\PhilippineProvince;
use App\Models\Review;
use App\Mail\OrderMail; // for the emailing
use Illuminate\Support\Facades\Mail; //for the mail services

function getCategories(){
  return Category::orderBy('name','ASC')
  ->with('sub_category')
  ->orderBy('id','DESC')
  ->where('status',1) // active
  ->where('showHome','Yes')
  ->get();
  //->with('sub_category') is a function on the Category class that gets all sub_categories connected to the Category
}



function getProductImage($productId){
  return ProductImage::where('product_id',$productId)->first();
}


//for the orderEmail
function orderEmail($orderId, $userType = "customer"){
  $order = Order::where('id',$orderId)->with('items')->first();
  //dd($order);

  if($userType == "customer"){
    $subject = 'Thanks for your order at SHOENIVERSE';
    $email = $order->email;
  }else{
    $subject = 'You have recieve an order';


    $setting = Setting::getShopSettings();

    if(!empty($setting) && !empty($setting->email)){
      $email =  $setting->email;
    }else{
      $email = env('ADMIN_EMAIL');
    }

    
  }


  //mail data
  $mailData = [
    'subject' => $subject,
    'order' => $order,
    'userType' => $userType
  ];

  Mail::to($email)->send(new OrderMail($mailData));

}

//to send the update on the order {either it is confirmed or cancelled and the remark for the order}
function orderUpdateEmail($orderId){

  $order = Order::find($orderId);

  $status = strtoupper($order->status);

  $subject = 'SHOENIVERSE Order '.$status;
  $email = $order->email;
  $message = 'Your order had been ';

  if($order->status == 'cancelled'){
    $message .= "<span class='text-danger'>CANCELLED</span><br>".$order->order_remark;

  }else{
    $message .= "<span class'text-primary'>".$status."</span>";
  }

  //mail data
  $mailData = [
    'subject' => $subject,
    'order' => $order,
    'message' => $message
  ];

  Mail::to($email)->send(new OrderEmailUpdate($mailData));

}




function getCountryInfo($id){
  return Country::where('id',$id)->first();
}

//if costumer_address records IS EMPTY
  function getRegions(){
    return PhilippineRegion::select('region_description','region_code')->get();
  }


  function getProvinces($region_code){
    return PhilippineProvince::select('province_description','region_code','province_code')
      ->where('region_code',$region_code)
      ->limit(100)
      ->get();
  }

  function getCities($province_code){
    return PhilippineCity::select('city_municipality_description','province_code','city_municipality_code')
      ->where('province_code',$province_code)
      ->limit(100)
      ->get();
  }

  function getBarangays($city_municipality_code){
    return PhilippineBarangay::select('barangay_description','city_municipality_code','barangay_code')
      ->where('city_municipality_code',$city_municipality_code)
      ->limit(100)
      ->get();
  }
//end of IS EMPTY

//if costomer_address IS NOT EMPTY
  


  // function getMyBarangays($city_code){
  //   return PhilippineBarangay::select('barangay_description','city_municipality_code','barangay_code')->where('city_municipality_code',$city_code)->orderBy('barangay_description','ASC')->limit(100)->get();
  // }

//end of if costomer_address IS NOT EMPTY


//for order details


function getProduct($id){
  return Product::where('id',$id)->first();
}

//get size
function getSize($id){
  return Size::where('id',$id)->first();
}

//get color
function getColor($id){
  return Color::where('id',$id)->first();
}

//get pages
function staticPages(){
  $pages = Page::orderBy('name','asc')->get();
  return $pages;
}

function check_variation($product_id,$color_id,$size_id){
  
  $product_variation = ProductVariation::where('product_id',$product_id)->where('color_id',$color_id)->where('size_id',$size_id)->first();

  if(!empty($product_variation)){
    return $product_variation->stock_quantity;
  }else{
    return 0;
  }


}


/**Shop Setting Functions */
  //get logo
  function getShopLogo(){

    $setting = Setting::getShopSettings();

    if(!empty($setting) && !empty($setting->logo)){
      return asset('uploads/setting/thumb/'.$setting->logo);
    }else{
      return asset('admin-assets/img/default-150x150.png');
    }


  }

  //get favicon
  function getShopFavicon(){

    $setting = Setting::getShopSettings();

    if(!empty($setting) && !empty($setting->favicon)){
      return asset('uploads/setting/thumb/'.$setting->favicon);
    }else{
      return asset('admin-assets/img/default-150x150.png');
    }


  }

  //get name
  function getShopName(){

    $setting = Setting::getShopSettings();

    if(!empty($setting) && !empty($setting->name)){
      return $setting->name;
    }else{
      return "SHOENIVERSE";
    }


  }

  //get email
  function getShopEmail(){
    $setting = Setting::getShopSettings();

    if(!empty($setting) && !empty($setting->email)){
      return $setting->email;
    }else{
      return "shoeniver802@gmail.com";
    }
  }

  //get location 
  function getShopLocation(){
    $setting = Setting::getShopSettings();

    if(!empty($setting) && !empty($setting->location)){
      return $setting->location;
    }else{
      return "2nd Floor of Dayros Complex , M. Rabago Street corner San Jose Drive, Poblacion Alaminos City, Pangasinan (itaas ng 7 Eleven papunta Golden West, pangalawang kanto mula Tennis Court, katabi ng Oregon Building)";
    }
  }

  //mobile 1
  function getShopMobile1(){
    $setting = Setting::getShopSettings();

    if(!empty($setting) && !empty($setting->mobile_number)){
      return $setting->mobile_number;
    }else{
      return "";
    }
  }

  //mobile 2
  function getShopMobile2(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->mobile_number_2)){
      return $setting->mobile_number_2;
    }else{
      return "";
    }
  }

  function getShopMobile3(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->mobile_number_3)){
      return $setting->mobile_number_3;
    }else{
      return "";
    }
  }

  function getShopMobile4(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->mobile_number_4)){
      return $setting->mobile_number_4;
    }else{
      return "";
    }
  }

  //show open time
  function getShopOpenTime(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->open_time)){
      return $setting->open_time;
    }else{
      return "";
    }
  }

  //show open time
  function getShopCloseTime(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->close_time)){
      return $setting->close_time;
    }else{
      return "";
    }
  }

  //social media : facebook
  function getShopFacebook(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->facebook)){
      return $setting->facebook;
    }else{
      return "";
    }
  }

   //social media : youtube
   function getShopYoutube(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->youtube)){
      return $setting->youtube;
    }else{
      return "";
    }
  }

  //social media : twitter
  function getShopTwitter(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->twitter)){
      return $setting->twitter;
    }else{
      return "";
    }
  }


  //social media : instagram
  function getShopInstagram(){
    $setting = Setting::getShopSettings();
    
    if(!empty($setting) && !empty($setting->instagram)){
      return $setting->instagram;
    }else{
      return "";
    }
  }


  //get order_confirm 1
  function getOrderConf1(){
    $setting = Setting::getShopSettings();

    $con_time_open = $setting->order_confirm_open_time_1;
    $con_time_close = $setting->order_confirm_close_time_1;

    
    if(!empty($setting) && !empty($con_time_open) && !empty($con_time_close) && $con_time_open != date("00:00:00") && $con_time_close != date("00:00:00") ){
      return "<hr>" . \Carbon\Carbon::parse($con_time_open)->format('H:i A') . " to " . \Carbon\Carbon::parse($con_time_close)->format('H:i A') . "<hr>";
    }else{
      return "";
    }
  }


  //get order_confirm 2
  function getOrderConf2(){
    $setting = Setting::getShopSettings();

    $con_time_open = $setting->order_confirm_open_time_2;
    $con_time_close = $setting->order_confirm_close_time_2;

    
    if(!empty($setting) && !empty($con_time_open) && !empty($con_time_close) && $con_time_open != date("00:00:00") && $con_time_close != date("00:00:00") ){
      return "<hr>" . \Carbon\Carbon::parse($con_time_open)->format('H:i A') . " to " . \Carbon\Carbon::parse($con_time_close)->format('H:i A') . "<hr>";
    }else{
      return "";
    }
  }


  //get order_confirm 3
  function getOrderConf3(){
    $setting = Setting::getShopSettings();

    $con_time_open = $setting->order_confirm_open_time_3;
    $con_time_close = $setting->order_confirm_close_time_3;

    
    if(!empty($setting) && !empty($con_time_open) && !empty($con_time_close) && $con_time_open != date("00:00:00") && $con_time_close != date("00:00:00") ){
      return "<hr>" . \Carbon\Carbon::parse($con_time_open)->format('H:i A') . " to " . \Carbon\Carbon::parse($con_time_close)->format('H:i A') . "<hr>";
    }else{
      return "";
    }
  }


  //get gcash account 1 
  function getGcash1(){
    $setting = Setting::getShopSettings();

    $gcash_name = $setting->acc_1_gcash_name;
    $gcash_number = $setting->acc_1_gcash_number;

    
    if(!empty($setting) && !empty($gcash_name) && !empty($gcash_number)){
      return "<hr>Gcash Account [main]:<br> " . $gcash_name . " -> " . $gcash_number."<hr>";
    }else{
      return "";
    }
  }

  //get gcash account 2 
  function getGcash2(){
    $setting = Setting::getShopSettings();

    $gcash_name = $setting->acc_2_gcash_name;
    $gcash_number = $setting->acc_2_gcash_number;

    
    if(!empty($setting) && !empty($gcash_name) && !empty($gcash_number)){
      return "<hr>Gcash Account [alternative]:<br> " . $gcash_name . " -> " . $gcash_number."<hr>";
    }else{
      return "";
    }
  }


  //get gcash account 3
  function getGcash3(){
    $setting = Setting::getShopSettings();

    $gcash_name = $setting->acc_3_gcash_name;
    $gcash_number = $setting->acc_3_gcash_number;

    
    if(!empty($setting) && !empty($gcash_name) && !empty($gcash_number)){
      return "<hr>Gcash Account [alternative] :<br> " . $gcash_name . " -> " . $gcash_number."<hr>";
    }else{
      return "";
    }
  }

  //gcash for the option tags
  function getGcashOptions(){
    $setting = Setting::getShopSettings();

    $gcash_name_1 = $setting->acc_1_gcash_name;
    $gcash_number_1 = $setting->acc_1_gcash_number;

    $gcash_name_2 = $setting->acc_2_gcash_name;
    $gcash_number_2 = $setting->acc_2_gcash_number;

    $gcash_name_3 = $setting->acc_3_gcash_name;
    $gcash_number_3 = $setting->acc_3_gcash_number;

    $option = '';

    if(!empty($setting) && !empty($gcash_name_1) && !empty($gcash_number_1)){
      $option .= "<option value=".$gcash_name_1.'-'. $gcash_number_1.">Gcash Account : " . $gcash_name_1 . " -> " . $gcash_number_1."</option>";
    }

    if(!empty($setting) && !empty($gcash_name_2) && !empty($gcash_number_2)){
      $option .= "<option value=".$gcash_name_2.'-'. $gcash_number_2.">Gcash Account : " . $gcash_name_2 . " -> " . $gcash_number_2."</option>";
    }

    if(!empty($setting) && !empty($gcash_name_3) && !empty($gcash_number_3)){
      $option .= "<option value=".$gcash_name_3.'-'. $gcash_number_3.">Gcash Account : " . $gcash_name_3 . " -> " . $gcash_number_3."</option>";
    }

    return $option;

  }



/**end of Shop Settings functions */




//for Reviews to check if the user had already made a review on the product
  function reviewExists($order_id,$product_id){

    $user_id = Auth::user()->id;

    $review = Review::where('created_by',$user_id)->where('product_id',$product_id)->where('order_id',$order_id)->first();

    if(!empty($review)){
      return true;
    }else{
      return false;
    }

  }


  //count reviews of product
  function countReviews($product_id){
    $reviews = Review::where('product_id',$product_id)->where('showOnReviews','Yes')->count();

    if(!empty($reviews)){
      return $reviews;
    }else{
      return 0;
    }

  }

  /*
   <small class="fas fa-star"></small> - filled star
    <small class="fas fa-star-half-alt"></small> - half filled star
    <small class="far fa-star"></small> - no fill star
  */

  //review stars
  function reviewStars($product_id){
    $review_count = Review::where('product_id',$product_id)->where('showOnReviews','Yes')->count();
    $reviews = Review::where('product_id',$product_id)->get(); // get all reviews


    if(!empty($reviews) && !empty($review_count)){

      $total_rating = 0;
      foreach ($reviews as $review) {
        $total_rating += $review->rating;
      }      

      $star_rating = $total_rating / $review_count;

      $html = '<div class="text-primary mr-2">';

        $count = abs($star_rating);

        for($i = 1;$i <= 5;$i++){

          if($i <= $count){
            $html .= '<small class="fas fa-star"></small>';
          }else{
            $html .= '<small class="far fa-star"></small>';
          }

          
        }


      $html .= '</div>';
      return $html;

    }else{
      return '
      <div class="text-primary mr-2">
          <small class="far fa-star"></small>
          <small class="far fa-star"></small>
          <small class="far fa-star"></small>
          <small class="far fa-star"></small>
          <small class="far fa-star"></small>
      </div>
      ';
    }

  }


  //get reviews for product
  function getReviews($product_id){
    // $reviews = 

    // dd($reviews);
    return Review::select('reviews.*','users.name as reviewer_name','users.email as reviewer_email')
      ->join('users','users.id','=','reviews.created_by')
      ->where('product_id',$product_id)
      ->where('showOnReviews','Yes')
      ->get(); // get all reviews
  }

  //get user that given the reviews

//end of for Reviews




?>