<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    //home
    public function index(){
        //$admin = Auth::guard('admin')->user();

        //echo 'Welcome '.$admin->name.'<a href="'.route('admin.logout').'"> Logout</a>';

        $totalOrders = Order::where('status','!=','cancelled')->count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role',1)->count();

        //total revenue
        $totalRevenue = Order::where('status','!=','cancelled')->sum('grandtotal');

        //this month revenue
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        $revenueThisMonth = Order::where('status','!=','cancelled')
                                ->whereDate('created_at','>=',$startOfMonth)
                                ->whereDate('created_at','<=',$currentDate)
                                ->sum('grandtotal');

        //last month revenue
        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        $revenueLastMonth = Order::where('status','!=','cancelled')
                                ->whereDate('created_at','>=',$lastMonthStartDate)
                                ->whereDate('created_at','<=',$lastMonthEndDate)
                                ->sum('grandtotal');


        //last 30 days
        $lastThirtyDayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');

        $revenueLastThirtyDays = Order::where('status','!=','cancelled')
                                ->whereDate('created_at','>=',$lastThirtyDayStartDate)
                                ->whereDate('created_at','<=',$currentDate)
                                ->sum('grandtotal');

        //today
        $revenueToday = Order::where('status','!=','cancelled')
                            ->whereDate('created_at','=',now())
                            ->sum('grandtotal');

        //last 7 days
        $WeekStartDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $WeekEndDate = Carbon::now()->endOfWeek()->format('Y-m-d');
        $revenueThisWeek = Order::where('status','!=','cancelled')
                                    ->whereDate('created_at','>=',$WeekStartDate)
                                    ->whereDate('created_at','<=',$WeekEndDate)
                                    ->sum('grandtotal');

        $data['totalOrders'] = $totalOrders;
        $data['totalProducts'] = $totalProducts;
        $data['totalCustomers'] = $totalCustomers;
        $data['totalRevenue'] = $totalRevenue;
        $data['revenueThisMonth'] = $revenueThisMonth;
        $data['revenueLastMonth'] = $revenueLastMonth;
        $data['revenueLastThirtyDays'] = $revenueLastThirtyDays;
        $data['revenueToday'] = $revenueToday;
        $data['revenueThisWeek'] = $revenueThisWeek;


        return view('admin.dashboard',$data);
    }

    //logout the admin
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
