<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use App\Models\Product;

class OrderController extends Controller
{
    //index
    public function index(Request $request){

        $orders = Order::latest('orders.created_at')->select('orders.*','users.name','users.email'); //get latest records based on orders.created_at
        $orders = $orders->leftJoin('users','users.id','orders.user_id');

        if($request->get('keyword') != ""){
            $orders = $orders->where('users.name' ,'like','%'.$request->keyword.'%');
            $orders = $orders->orWhere('users.email' ,'like','%'.$request->keyword.'%');
            $orders = $orders->orWhere('orders.id' ,'like','%'.$request->keyword.'%');
        }

        $orders = $orders->paginate(10);

        return view('admin.orders.list',[
            'orders' => $orders,
        ]);
    }

    //detail
    public function detail($orderId){
    
        //get order
        $order = Order::select('orders.*','countries.name as countryName','philippine_regions.region_description as regionDescription','philippine_provinces.province_description as provinceDescription','philippine_cities.city_municipality_description as cityDescription','philippine_barangays.barangay_description as barangayDescription' )
            ->where('orders.id',$orderId)
            ->leftJoin('countries','countries.id','orders.country_id')
            ->leftJoin('philippine_regions','philippine_regions.region_code','orders.region_code')
            ->leftJoin('philippine_provinces','philippine_provinces.province_code','orders.province_code')
            ->leftJoin('philippine_cities','philippine_cities.city_municipality_code','orders.city_municipality_code')
            ->leftJoin('philippine_barangays','philippine_barangays.barangay_code','orders.barangay_code')
            ->first();

        //get orderItems
        $orderItems = OrderItem::where('order_id',$order->id)->get();

        return view('admin.orders.detail',[
            'order' => $order,
            'orderItems' => $orderItems
        ]);
    }

    //order status
    public function changeOrderStatus(Request $request,$orderId){
        //dd($request->all());

        $order = Order::find($orderId);
        $order->status = $request->status;
        $order->order_remark = $request->order_remark;


        //if order status is cancelled, update ProductVariation and Product
        if($order->status == 'cancelled'){


            //get Order Items
            $orderItems = OrderItem::where('order_id',$order->id)->get();

            if(!empty($orderItems)){ // of order items exists

                foreach($orderItems as $item){

                    //get product_variation
                    $product_variation = ProductVariation::where('product_id',$item->product_id)->where('color_id',$item->color_id)->where('size_id',$item->size_id)->first();

                    //if the product variation exists, update it
                    $currentQty = $product_variation->stock_quantity;
                    $updatedQty = $currentQty + $item->qty;

                    $product_variation->stock_quantity = $updatedQty; //update the quantity of the product variation
                    $product_variation->save();

                    //then we now update the product
                    $product = Product::find($item->product_id);
                    
                    $product->qty = $product->variations->sum('stock_quantity');

                    $product->save(); 


                }

            }
            
            

        }


        $order->shipped_date = $request->shipped_date;
        $order->shipping_days = $request->shipping_days;
        $order->save();

        orderUpdateEmail($order->id);

        $message = "Order status updated successfully";

        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    //send invoice email
    public function sendInvoiceEmail(Request $request,$orderId){
        // echo "hello";

        orderEmail($orderId,$request->userType);

        $message = "Order email send successsfully";

        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
        

    }



}
