@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
  <div class="container">
      <div class="light-font">
          <ol class="breadcrumb primary-color mb-0">
              <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a></li>
              <li class="breadcrumb-item">My Orders</li>
          </ol>
      </div>
  </div>
</section>

<section class=" section-11 ">
  <div class="container  mt-5">
      <div class="row">
        <div class="col-md-12">
          @include('front.message')
        </div>
          <div class="col-md-3">
            @include('front.account.common.sidebar')
          </div>
          <div class="col-md-9">
              <div class="card">
                

                <div class="card-body">
                  <div class="row">

                    <div class="col-md-6 border border-start-0 border-end-0 border-primary border-3 p-2" >

                      <button class="btn btn-outline-warning" data-bs-toggle="collapse" data-bs-target="#order_confirmation_schedules">Orders Confirmation Time Schedules:</button>

                      <div id="order_confirmation_schedules" class="collapse">
                        
                        @if(getOrderConf1() != "")
                          <p class="mb-0 text-start">{!! getOrderConf1() !!}</p>
                        @endif

                        @if(getOrderConf2() != "")
                          <p class="mb-0 text-start">{!! getOrderConf2() !!}</p>
                        @endif

                        @if(getOrderConf3() != "")
                          <p class="mb-0 text-start">{!! getOrderConf3() !!}</p>
                        @endif
                      </div>


                    </div>

                    <div class="col-md-6 border border-start-0 border-end-0 border-warning border-3 p-2 table-responsive">
                      <button class="btn btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#gcash_accounts">Our Gcash Accounts: </button>

                      <div id="gcash_accounts" class="collapse">
                        
                        @if(!empty(getGcash1()))
                          <p class="mb-0 text-start mt-1">{!! getGcash1() !!}</p>
                        @endif

                        @if(!empty(getGcash2()))
                          <p class="mb-0 text-center">{!! getGcash2() !!}</p>
                        @endif

                        @if(!empty(getGcash3()))
                          <p class="mb-0 text-center">{!! getGcash2() !!}</p>
                        @endif
                      </div>

                      {{-- <table class="table table-striped table-hover" id="accounts_table">
                        <thead>
                          
                          <th class="text-primary">Account</th>
                          <th>Name</th>
                          <th>Number</th>
                        </thead>

                        @if(!empty(getGcash1()))
                          {!! getGcash1() !!}
                        @endif
                        
                      </table>
                       --}}
                        
                      
                      

                      

                    </div>

                  </div>
                  
                </div>


              </div>

              <div class="card">
                  <div class="card-header">
                      <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                  </div>
                  <div class="card-body p-4">

                    <div class="table-responsive">
                      <table class="table">
                        <thead> 
                          <tr>
                            <th>Orders #</th>
                            <th>Date Purchased</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Cancel</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                          @if($orders->isNotEmpty())
                            @foreach ($orders as $order)
                              <tr>
                                <td>
                                    <a href="{{ route('account.orderDetail',$order->id) }}" class="btn btn-sm btn-primary text-light">Order Details</a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                <td>
                                  @if($order->status == 'pending')
                                    <span class="badge bg-danger">Pending</span>
                                  @elseif($order->status == 'confirmed')
                                    <span class="badge bg-secondary">Confirmed</span>
                                  @elseif($order->status == 'shipped')
                                    <span class="badge bg-info">Shipped</span>
                                  @elseif($order->status == 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                  @elseif($order->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                  @endif
                                    
                                </td>
                                <td>&#8369; {{ number_format($order->grandtotal,2) }}</td>
                                <td>

                                  @if($order->status == 'pending')
                                    <a href="{{ route('front.cancelOrder',['orderId' => $order->id]) }}" onclick="return confirm('Are you sure you want to go to the link?')" class="btn btn-sm btn-danger text-light">Cancel</a>
                                  @else 
                                    <button class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" title="Cannot cancel order because it is already been confirmed by the shop administrator">Cancel</button>
                                  @endif
                                </td>
                              </tr>
                            @endforeach
                          @else
                            <tr>
                              <td colspan="100%">Orders Not Found</td>
                            </tr>
                          @endif
                          
                          
                          
                        </tbody>
                      </table>
                    </div> 

                  </div>
              </div>
          </div>
      </div>
  </div>
</section>

@endsection


{{-- @section('customJs')
  <script>
    $("#toggle_conf_time_sched").on("click",function(){
      $("#order_conf_time_sched_con").toggleClass("d-none");
    });
  </script>
@endsection --}}