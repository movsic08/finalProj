<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\DiscountCodeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ProductColorController;
use App\Http\Controllers\admin\ProductVariationController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\AuthOtpController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//for testing
// Route::get('/test',function(){
//     orderEmail(4); //check this function on the helper.php file
// }); 


/**user routes */
    //home
    Route::get('/',[FrontController::class,'index'])->name('front.home');
    //shop
    Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('front.shop');
    //product
    Route::get('/product/{slug}',[ShopController::class,'product'])->name('front.product');
    //cart
    Route::get('/cart',[CartController::class,'cart'])->name('front.cart');
    //add to cart
    Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('front.addToCart');
    //update cart item
    Route::post('/update-cart',[CartController::class,'updateCart'])->name('front.updateCart');
    //delete cart item
    Route::post('/delete-item',[CartController::class,'deleteItem'])->name('front.deleteItem.cart');
    //checkout
    Route::get('/checkout',[CartController::class,'checkout'])->name('front.checkout');
    //process checkout
    Route::post('/process-checkout',[CartController::class,'processCheckout'])->name('front.processCheckout');
    
    //thanks
    Route::get('/thanks/{orderId}',[CartController::class,'thankyou'])->name('front.thankyou');
    //get order summery
    Route::post('/get-order-summery',[CartController::class,'getOrderSummery'])->name('front.getOrderSummery');
    //apply discount
    Route::post('/apply-discount',[CartController::class,'applyDiscount'])->name('front.applyDiscount');
    //remove discount
    Route::post('/remove-discount',[CartController::class,'removeCoupon'])->name('front.removeCoupon');
    //add to wishlist 
    Route::post('/add-to-wishlist',[FrontController::class,'addToWishlist'])->name('front.addToWishlist');
    //ajax to get product details
    Route::post('/get_product_details',[ProductController::class,'get_product_details'])->name('front.get_product_details');
    //ajax to get product details for review
    Route::post('/get_product_details_for_review',[ProductController::class,'get_product_details_for_review'])->name('front.get_product_details_for_review');

    //ajax route to get colors
    Route::post('/get_size',[ProductController::class,'get_size'])->name('front.get_size');


    //display page
    Route::get('/page/{slug}',[FrontController::class,'page'])->name('front.page');
    //send contact email
    Route::post('/send-contact-email',[FrontController::class,'sendContactEmail'])->name('front.sendContactEmail');

    
    
    //account middleware
    Route::group(['prefix' => 'account'],function(){
        //verifies that the users is guest
        Route::group(['middleware' => 'guest'],function(){
            //register
            Route::get('/register',[AuthController::class,'register'])->name('account.register');
            //post : register
            Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');
            //login
            Route::get('/login',[AuthController::class,'login'])->name('account.login');
            //post : login
            Route::post('/login',[AuthController::class,'authenticate'])->name('account.authenticate');
            //forgot password
            Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('account.forgotPassword');
            //post : forgot password
            Route::post('/forgot-password',[AuthController::class,'postForgotPassword'])->name('account.postForgotPassword');
            //reset password form page
            Route::get('/reset/{token}',[AuthController::class,'reset'])->name('account.resetPassword');
            //post : reset password form
            Route::post('/reset/{token}',[AuthController::class,'postReset'])->name('account.postResetPassword');

        }); 

        //verifies that the user is authenticated
        Route::group(['middleware' => 'auth'],function(){
            //profile
            Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
            //update profile
            Route::post('/update-profile',[AuthController::class,'updateProfile'])->name('account.updateProfile');
            //show change password form
            Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.changePassword');
            //post: change password form
            Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');
            //update address
            Route::post('/update-address',[AuthController::class,'updateAddress'])->name('account.updateAddress');
            //orders
            Route::get('/my-orders',[AuthController::class,'orders'])->name('account.orders');
            //cancel order
            Route::get('/cancel-order/{orderId}',[CartController::class,'cancelOrder'])->name('front.cancelOrder');
            //order details
            Route::get('/order-detail/{orderId}',[AuthController::class,'orderDetail'])->name('account.orderDetail');
            //my wishlist
            Route::get('/my-wishlist',[AuthController::class,'wishlist'])->name('account.wishlist');
            //remove product from wishlist
            Route::post('/remove-product-from-wishlist',[AuthController::class,'removeProductFromWishlist'])->name('account.removeProductFromWishlist');
            //ajax for the submission of the review form
            Route::post('/review-add',[ReviewController::class,'add'])->name('account.review-add');
            //logout
            Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');

            /**Email Verication */
                //verify email
                Route::get('/verify-email',[AuthController::class,'verifyEmail'])->name('account.verifyEmail');
                //email verified
                Route::get('/email-verified/{token}',[AuthController::class,'emailVerified'])->name('account.emailVerified');
            /**end of Email Verification */

            /**Phone Verification */
                //login
                Route::get('/otp/login',[AuthOtpController::class,'login'])->name('otp.login');
                //generate
                Route::post('/otp/generate',[AuthOtpController::class,'generate'])->name('otp.generate');
                //verification
                Route::get('/otp/verification',[AuthOtpController::class,'verification'])->name('otp.verification');
                //post verification
                Route::post('/otp/post-verification',[AuthOtpController::class,'postVerification'])->name('otp.postVerification');
            /**end of Phone Verification */

            /**Gcash */
                //temp-images.create -> used for the dropzone
                Route::post('/upload-temp-gcash-reciept',[TempImagesController::class,'gcash_receipt'])->name('temp-images-gcash.create');
            /**end of Gcash */

            //ajax to get provinces based on region_code
            Route::post('/get-provinces',[ShippingController::class,'getProvinces'])->name('account.getProvinces');
            //ajax to get city / municipality based on province_code
            Route::post('/get-city-municipality',[ShippingController::class,'getCityMunicipality'])->name('account.getCityMunicipality');
            //ajax to get barangay based on city_municipality_code
            Route::post("/get-barangays",[ShippingController::class,'getBarangay'])->name('account.getBarangay');

        });
    });

/**end of user routes */




/**admin routes */
    
    //the prefix is admin   =>      /admin/
    Route::group(['prefix' => 'admin'],function(){

        //for guest admin routes
        Route::group(['middleware' => 'admin.guest'],function(){ //AdminredirectIfAuthenticate    -> middleware
            //admin login
            Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
            //admin login post request
            Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
            //admin forgot password
            Route::get('/forgot-password',[AdminLoginController::class,'forgotPassword'])->name('admin.forgotPassword');
            //admin - post : forgot password
            Route::post('/forgot-password',[AdminLoginController::class,'postForgotPassword'])->name('admin.postForgotPassword');
            //admin reset password form page
            Route::get('/reset/{token}',[AdminLoginController::class,'reset'])->name('admin.resetPassword');
            //admin - post : reset password form
            Route::post('/reset/{token}',[AdminLoginController::class,'postReset'])->name('admin.postResetPassword');

        });


        //for auth admin routes
        Route::group(['middleware' => 'admin.auth'],function(){ //AdminAuthenticate     -> middleware

            //admin home
            Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
            //admin logout
            Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');

            /**Setting Routes */

                //Admin Account Settings
                    //change password form
                    Route::get('/change-password',[SettingController::class,'showChangePasswordForm'])->name('admin.showChangePasswordForm');
                    //post change password form
                    Route::post('/process-change-password',[SettingController::class,'processChangePassword'])->name('admin.processChangePassword');
                //end of Admin Account Settings

                
                //Shop Settings
                    //main index
                    Route::get('/settings/index',[SettingController::class,'index'])->name('admin.settings');
                    //update : post main index
                    Route::put('/settings/index-update',[SettingController::class,'update'])->name('admin.updateSettings');
                //end of Shop Settings


            /**end of Setting Routes */

            /**Category Routes */
                //list
                Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
                //create category
                Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
                //post create -> store
                Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
                //edit
                Route::get('/categories/{category}/edit',[CategoryController::class,'edit'])->name('categories.edit');
                //edit put  // works like post update
                Route::put('/categories/{category}',[CategoryController::class,'update'])->name('categories.update');
                //delete // works like post but for destroy
                Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('categories.delete');


                //temp-images.create -> used for the dropzone
                Route::post('/upload-temp-image',[TempImagesController::class,'create'])->name('temp-images.create');
                //temp-images.create_setting_image -> used for the dropzone
                Route::post('/upload-temp-image-setting',[TempImagesController::class,'create_setting_image'])->name('temp-images.create_setting_image');


                //get slug
                Route::get('/getSlug',function(Request $request){
                    $slug = '';

                    if(!empty($request->title)){
                        $slug = Str::slug($request->title);
                    }

                    return response()->json([
                        'status' => true,
                        'slug' => $slug,
                    ]);
                })->name('getSlug');
            /**end of Category Routes */

            /**Sub Category Routes */
                //index
                Route::get('/sub-categories',[SubCategoryController::class,'index'])->name('sub-categories.index');
                //create
                Route::get('/sub-categories/create',[SubCategoryController::class,'create'])->name('sub-categories.create'); 
                //post create -> store
                Route::post('/sub-categories',[SubCategoryController::class,'store'])->name('sub-categories.store');   
                //edit
                Route::get('/sub-categories/{subCategory}/edit',[SubCategoryController::class,'edit'])->name('sub-categories.edit');
                //post edit -> put
                Route::put('/sub-categories/{subCategory}',[SubCategoryController::class,'update'])->name('sub-categories.update');
                //delete
                Route::delete('/sub-categories/{subCategory}',[SubCategoryController::class,'destroy'])->name('sub-categories.delete');


            /**end of Sub Category Routes */

            /**Brand Routes */  

                //index
                Route::get('/brands',[BrandController::class,'index'])->name('brands.index');
                //create
                Route::get('/brands/create',[BrandController::class,'create'])->name('brands.create');
                //store
                Route::post('/brands',[BrandController::class,'store'])->name('brands.store');
                //edit
                Route::get('/brands/{brand}/edit',[BrandController::class,'edit'])->name('brands.edit');
                //update -> put
                Route::put('/brands/{brand}',[BrandController::class,'update'])->name('brands.update');
                //delete
                Route::delete('/brands/{brand}',[BrandController::class,'destroy'])->name('brands.delete');

            /**end of Brand Routes */

            /**Color Routes */  

                //index
                Route::get('/colors',[ColorController::class,'index'])->name('colors.index');
                //create
                Route::get('/colors/create',[ColorController::class,'create'])->name('colors.create');
                //store
                Route::post('/colors',[ColorController::class,'store'])->name('colors.store');
                //edit
                Route::get('/colors/{color}/edit',[ColorController::class,'edit'])->name('colors.edit');
                //update -> put
                Route::put('/colors/{color}',[ColorController::class,'update'])->name('colors.update');
                //delete
                Route::delete('/colors/{color}',[ColorController::class,'destroy'])->name('colors.delete');

            /**end of Color Routes */

             /**Size Routes */  

                //index
                Route::get('/sizes',[SizeController::class,'index'])->name('sizes.index');
                //create
                Route::get('/sizes/create',[SizeController::class,'create'])->name('sizes.create');
                //store
                Route::post('/sizes',[SizeController::class,'store'])->name('sizes.store');
                //edit
                Route::get('/sizes/{color}/edit',[SizeController::class,'edit'])->name('sizes.edit');
                //update -> put
                Route::put('/sizes/{color}',[SizeController::class,'update'])->name('sizes.update');
                //delete
                Route::delete('/sizes/{color}',[SizeController::class,'destroy'])->name('sizes.delete');

            /**end of Size Routes */

            /**Product Routes */
                //index
                Route::get('/products',[ProductController::class,'index'])->name('products.index');
                //create 
                Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
                //store -> post create
                Route::post('/products',[ProductController::class,'store'])->name('products.store');
                //edit
                Route::get('/products/{product}/edit',[ProductController::class,'edit'])->name('products.edit');
                //update -> method put 
                Route::put('/products/{product}',[ProductController::class,'update'])->name('products.update');
                //delete
                Route::delete('/products/{product}',[ProductController::class,'destroy'])->name('products.delete');
                
                //ajax for getting the products for select2 on edit related products
                Route::get('/get-products',[ProductController::class,'getProducts'])->name('products.getProducts');
                //ajax for getting the colors for select2 on edit colors
                Route::get('/get-colors',[ProductController::class,'getColors'])->name('products.getColors');
                
                //ajax to update, create product_colors
                Route::post('/update-product-colors',[ProductColorController::class,'updateProductColor'])->name('products.updateProductColor');

                //ajax for the update of ProductImage -> product_images
                Route::post('/product-images/update',[ProductImageController::class,'update'])->name('product-images.update');
                //ajax for the deletion of ProductImage -> product_images
                Route::delete('/product-images',[ProductImageController::class,'destroy'])->name('product-images.destroy');
                //ajax for the sub_category change based on category selected
                Route::post('/product-subcategories',[ProductSubCategoryController::class,'index'])->name('product-subcategories.index');



            /**end of Product Routes */

            /**Variation Routes */
                //index
                //Route::get('/product-variations/{product}',[ProductVariationController::class,'index'])->name('product-variations.index');
                //create 
                Route::get('/product-variations/{product}/create',[ProductVariationController::class,'create'])->name('product-variations.index');
                //store -> post create
                Route::post('/product-variations/{product}',[ProductVariationController::class,'store'])->name('product-variations.store');
                

                //ajax to get product variation
                Route::post('/get-product-variations/{product}',[ProductVariationController::class,'getProductVariations'])->name('product-variations.getProductVariations');
            /**end of Variation Routes */


            /**Shipping Routes */
                //create
                Route::get('/shipping/create',[ShippingController::class,'create'])->name('shipping.create');
                Route::post('/shipping/create',[ShippingController::class,'create']);
                //store
                Route::post('/shipping',[ShippingController::class,'store'])->name('shipping.store');
                //edit
                Route::get('/shipping/{id}',[ShippingController::class,'edit'])->name('shipping.edit');
                //update : post edit -> method put
                Route::put('/shipping/{id}',[ShippingController::class,'update'])->name('shipping.update');
                //delete : destroy
                Route::delete('/shipping/{id}',[ShippingController::class,'destroy'])->name('shipping.delete');

                //ajax to get provinces based on region_code
                Route::post('/get-provinces',[ShippingController::class,'getProvinces'])->name('shipping.getProvinces');
                //ajax to get city / municipality based on province_code
                Route::post('/get-city-municipality',[ShippingController::class,'getCityMunicipality'])->name('shipping.getCityMunicipality');
                //ajax to get barangay based on city_municipality_code
                Route::post("/get-barangays",[ShippingController::class,'getBarangay'])->name('shipping.getBarangay');

            /**end of Shipping Routes */

            /**Coupon Code Routes */
                //index
                Route::get('/coupons',[DiscountCodeController::class,'index'])->name('coupons.index');
                //create 
                Route::get('/coupons/create',[DiscountCodeController::class,'create'])->name('coupons.create');
                //store -> post create
                Route::post('/coupons',[DiscountCodeController::class,'store'])->name('coupons.store');
                //edit
                Route::get('/coupons/{coupon}/edit',[DiscountCodeController::class,'edit'])->name('coupons.edit');
                //update -> method put 
                Route::put('/coupons/{coupon}',[DiscountCodeController::class,'update'])->name('coupons.update');
                //delete
                Route::delete('/coupons/{coupon}',[DiscountCodeController::class,'destroy'])->name('coupons.delete');
                
            /**end of Coupon Code Routes */

            /**Order Routes */
                //index
                Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
                //order detail
                Route::get('/orders/{id}',[OrderController::class,'detail'])->name('orders.detail');
                //order status
                Route::post('/order/change-status/{id}',[OrderController::class,'changeOrderStatus'])->name('orders.changeOrderStatus');
                //send order email
                Route::post('/order/send-email/{id}',[OrderController::class,'sendInvoiceEmail'])->name('orders.sendInvoiceEmail');
            /**end of Order Routes */

            /**User table Routes */  

                //index
                Route::get('/users',[UserController::class,'index'])->name('users.index');
                //create
                Route::get('/users/create',[UserController::class,'create'])->name('users.create');
                //store
                Route::post('/users',[UserController::class,'store'])->name('users.store');
                //edit
                Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
                //update -> put
                Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
                //delete
                Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.delete');

            /**end of User table Routes */

            /**Page table Routes */  

                //index
                Route::get('/pages',[PageController::class,'index'])->name('pages.index');
                //create
                Route::get('/pages/create',[PageController::class,'create'])->name('pages.create');
                //store
                Route::post('/pages',[PageController::class,'store'])->name('pages.store');
                //edit
                Route::get('/pages/{page}/edit',[PageController::class,'edit'])->name('pages.edit');
                //update -> put
                Route::put('/pages/{page}',[PageController::class,'update'])->name('pages.update');
                //delete
                Route::delete('/pages/{page}',[PageController::class,'destroy'])->name('pages.delete');

            /**end of Page table Routes */

            
            /**Reviews table Routes */  

                //index
                Route::get('/reviews',[ReviewController::class,'index'])->name('reviews.index');
                //create
                // Route::get('/reviews/create',[ReviewController::class,'create'])->name('reviews.create');
                //store
                // Route::post('/reviews',[ReviewController::class,'store'])->name('reviews.store');
                //edit
                // Route::get('/reviews/{page}/edit',[ReviewController::class,'edit'])->name('reviews.edit');
                //update -> put
                Route::put('/reviews/{page}',[ReviewController::class,'update'])->name('reviews.update');
                //delete
                // Route::delete('/reviews/{page}',[ReviewController::class,'destroy'])->name('reviews.delete');
                //reply -> put
                Route::put('/reviews-reply',[ReviewController::class,'reply'])->name('reviews.reply');
                //ajax to get review
                Route::post('/get-review',[ReviewController::class,'get_review'])->name('reviews.get_review');


            /**end of Reviews table Routes */


        });




    });
/**end of admin routes */
