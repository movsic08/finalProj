@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
  <div class="container-fluid my-2">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Order: #{{ $order->id }}</h1>
      </div>
      <div class="col-sm-6 text-right">
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-9">

        @include('admin.message')

        <div class="card">
            <div class="card-header pt-3">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                      <h1 class="h5 mb-3">Shipping Address</h1>
                      <address>
                        <strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                        {{ $order->address }}<br>
                        <small>
                          {{ $order->zip }} {{ $order->countryName }}, <br>
                      
                          {{ $order->regionDescription }}<br>
                          {{ $order->provinceDescription }}, {{ $order->cityDescription }}, {{ $order->barangayDescription }} <br>
                        </small>
                        Phone: {{ $order->mobile }}<br>
                        Email: {{ $order->email }}
                      </address>
                      <strong>Shipped Date</strong><br>
                      @if(!empty($order->shipped_date))
                        {{ \Carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}
                      @else 
                        n/a
                      @endif
                    </div>
                    
                    <div class="col-sm-4 invoice-col">
                      <b>Invoice #007612</b><br>
                      <br>
                      <b>Order ID:</b> {{ $order->id }}<br>
                      
                      @if(!empty($order->shipping_days))
                        <b>Shipping Days:</b> {{ !empty($order->shipping_days) ? $order->shipping_days : 'N\A'  }}<br>

                        @php
                          $numberOfDays = intval($order->shipping_days);
                          
                          $shippedDateTime = \Carbon\Carbon::parse($order->shipped_date);

                          $expectedDateToArrive = $shippedDateTime->addDays($numberOfDays);

                        @endphp

                        <strong>Expected Date to Arrive: </strong><br>
                        {{ \Carbon\Carbon::parse($expectedDateToArrive)->format('d M, Y') }} <br>
                      
                      @endif


                      <b>Total:</b> &#8369; {{ number_format($order->grandtotal,2) }}<br>
                      <b>Status:</b> 
                        @if($order->status == 'pending')
                          <span class="badge badge-danger">Pending</span>
                        @elseif($order->status == 'confirmed')
                          <span class="badge badge-primary">Confirmed</span>
                        @elseif($order->status == 'shipped')
                          <span class="badge badge-info">Shipped</span>
                        @elseif($order->status == 'delivered')
                          <span class="badge badge-success">Delivered</span>
                        @elseif($order->status == 'cancelled')
                          <span class="badge badge-danger">Cancelled</span>
                        @endif
                      <br>

                      

                    </div>

                    
                    <div class="col-sm-4 invoice-col">
                      <strong>Payment Method : {!! !empty($order->gcash_name) ? '<span class="text-primary">Gcash</span>' : 'COD' !!}</strong><br>
                      <small>
                        {{-- for gcash --}}
                          @if(!empty($order->gcash_name))
                            <b><span class="text-primary">Gcash</span> Name:</b> {{  $order->gcash_name }}<br>
                          @endif

                          @if(!empty($order->gcash_number))
                            <b><span class="text-primary">Gcash</span> Number:</b> {{  $order->gcash_number }}<br>
                          @endif

                          @if(!empty($order->gcash_ref_number))
                            <b><span class="text-primary">Gcash</span> Reference Number:</b> {{  $order->gcash_ref_number }}<br>
                          @endif

                          @if(!empty($order->gcash_sent_to))
                            <b><span class="text-primary">Gcash</span> Sent to Gcash account:</b> {{  $order->gcash_sent_to }}<br>
                          @endif

                          @if(!empty($order->gcash_photo_reciept))
                            <button data-toggle="collapse" data-target="#gcash_photo_reciept" class="btn btn-sm btn-outline-primary">View / Hide Gcash Photo Receipt</button>

                            <div id="gcash_photo_reciept" class="collapse" >
                              <img width="220" style="border-radius: 10px;" class="p-2" src="{{ asset('uploads/gcash/thumb/'.$order->gcash_photo_reciept) }}" alt="">
                            </div>
                          @endif

       

                        
                        {{-- end of for gcash --}}
                      </small>
                    </div>









                </div>
            </div>
            <div class="card-body table-responsive p-3">								
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th width="100">Price</th>
                            <th width="100">Qty</th>                                        
                            <th width="100">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($orderItems as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            {{-- color --}}
                              @php 
                                $color = getColor($item->color_id);
                              @endphp
                              <td class="text-nowrap">
                                @if(!empty($color))
                                  <div style="display: inline-block; width:10px; height: 10px; border:1px solid gray; background-color: {{ $color->color }}"></div> {{ $color->name }} 
                                @else
                                  {{ $item->color }}
                                @endif
                              </td>
                            {{-- end of color --}}

                            {{-- size --}}  
                              @php 
                                $size = getSize($item->size_id);
                              @endphp
                              <td>
                                @if(!empty($size))
                                  {{ $size->size }}
                                @else 
                                  {{ $item->size }}
                                @endif 
                                  
                              </td>

                            {{-- end of size --}}
                            
                            <td class="text-nowrap">&#8369; {{ number_format($item->price,2) }}</td>                                        
                            <td>{{ $item->qty }}</td>
                            <td class="text-nowrap">&#8369; {{ number_format($item->total,2) }}</td>
                        </tr>
                      @endforeach 


                        <tr>
                            <th colspan="5" class="text-right">Subtotal:</th>
                            <td class="text-nowrap">&#8369; {{ number_format($order->subtotal,2) }}</td>
                        </tr>
                        
                        <tr>
                          <th colspan="5" class="text-right">Discount: {{ (!empty($order->coupon_code)) ? '('.$order->coupon_code.')' : '' }}</th>
                          <td class="text-nowrap">&#8369; {{ number_format($order->discount,2) }}</td>
                        </tr>

                        <tr>
                            <th colspan="5" class="text-right">Shipping:</th>
                            <td class="text-nowrap">&#8369; {{ number_format($order->shipping,2) }}</td>
                        </tr>

                        <tr>
                            <th colspan="5" class="text-right">Grand Total:</th>
                            <td class="text-nowrap">&#8369; {{ number_format($order->grandtotal,2) }}</td>
                        </tr>
                        
                    </tbody>
                </table>								
            </div>                            
        </div>
      </div>
      <div class="col-md-3">
        <div class="card">
            <div class="card-body">
              <form action="" id="changeOrderStatusForm">
                <h2 class="h4 mb-3">Order Status</h2>
                <div class="mb-3">
                    <select name="status" id="status" class="form-control {{ ($order->status == 'cancelled') ? ' border border-danger' : ''}}" {{ ($order->status == 'cancelled') ? 'disabled' : ''}} >
                        <option {{ ($order->status == 'pending') ? 'selected' : '' }} value="pending">Pending</option>
                        <option {{ ($order->status == 'confirmed') ? 'selected' : '' }} value="confirmed">Confirmed</option>
                        <option {{ ($order->status == 'shipped') ? 'selected' : '' }} value="shipped">Shipped</option>
                        <option {{ ($order->status == 'delivered') ? 'selected' : '' }} value="delivered">Delivered</option>
                        <option {{ ($order->status == 'cancelled') ? 'selected' : '' }} value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="mb-3">
                  <label for="">Shipped Date</label>
                  <input placeholder="Shipped Date" value="{{ $order->shipped_date }}" type="text" name="shipped_date" id="shipped" class="form-control" {{ ($order->status == 'cancelled') ? 'disabled' : ''}} >
                </div>

                <div class="mb-3">
                  <label for="">Shipment Days</label>
                  <input placeholder="Shipment Days" value="{{ $order->shipping_days }}" type="number" min="1" max="10" step="1" name="shipping_days" id="shipping_days" class="form-control" {{ ($order->status == 'cancelled') ? 'disabled' : ''}} >
                </div>

                <div class="mb-3">
                  <label for="">Order Remark</label>
                  {{-- <input placeholder="Your remark for the order" value="{{ $order->order_remark }}" type="number" min="1" max="10" step="1" name="order_remark" id="order_remark" class="form-control" {{ ($order->status == 'cancelled') ? 'disabled' : ''}} > --}}

                  <textarea name="order_remark" id="order_remark" placeholder="Your remark/reason for canceling the order" class="form-control" {{ ($order->status == 'cancelled') ? 'disabled' : ''}} cols="10" rows="5">{{ $order->order_remark }}</textarea>
                </div>

                <div class="mb-3">
                    <button type="submit"  class="btn btn-primary" {{ ($order->status == 'cancelled') ? 'disabled' : ''}} >Update</button>
                </div>
              </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
              <form action="" method="post" name="sendInvoiceEmail" id="sendInvoiceEmail">
                <h2 class="h4 mb-3">Send Inovice Email</h2>
                <div class="mb-3">
                    <select name="userType" id="userType" class="form-control">
                        <option value="customer">Customer</option>                                                
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary">Send</button>
                </div>
              </form> 
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
  <script>
    //datetimepicker
    $(document).ready(function(){
      $('#shipped').datetimepicker({
        //options here
        format: 'Y-m-d H:i:s',
      });
    });
    
    $('#shipped').prop('disabled','disabled');
    $('#shipped').prop('required','required');

    $('#shipping_days').prop('disabled','disabled');
    $('#shipping_days').prop('required','required');

    $('#order_remark').prop('disabled','disabled');
    $('#order_remark').prop('required','required');


    $("#status").on("change",function(){
      if($("#status").val() === "shipped"){
        $('#shipped').prop('disabled','');
        $('#shipped').prop('required','required');

        $('#shipping_days').prop('disabled','');
        $('#shipping_days').prop('required','required');

        
      }else if($("#status").val() === "cancelled"){

        $('#order_remark').prop('disabled','');
        $('#order_remark').prop('required','required');


      }else{
        $('#shipped').prop('disabled','disabled');
        $('#shipped').prop('required','required');

        $('#shipping_days').prop('disabled','disabled');
        $('#shipping_days').prop('required','required');

        $('#order_remark').prop('disabled','disabled');
        $('#order_remark').prop('required','required');
        
      }



    });
    


    //for the submittion of the update status
    $("#changeOrderStatusForm").submit(function(event){
      event.preventDefault();

      if($("#status").val() === "cancelled"){
        
        var isConfirmed = confirm("Are you sure you want to cancel the order? You cant undo this action once cancelled");

        if(isConfirmed){
          $.ajax({
            url: '{{ route("orders.changeOrderStatus",$order->id) }}',
            type: 'post',
            data: $(this).serializeArray(),
            dataType: 'json',
            success: function(response){
              window.location.href = '{{ route("orders.detail",$order->id) }}'
            }
            
          });
        }


      }else{

        $.ajax({
          url: '{{ route("orders.changeOrderStatus",$order->id) }}',
          type: 'post',
          data: $(this).serializeArray(),
          dataType: 'json',
          success: function(response){
            window.location.href = '{{ route("orders.detail",$order->id) }}'
          }
          
        });

      }
      

      
    });
    


    //for the options of sending invoice email
    $("#sendInvoiceEmail").submit(function(event){
      event.preventDefault();


      if(confirm("Are you sure you want to send email?")){
        $.ajax({
          url: '{{ route("orders.sendInvoiceEmail",$order->id) }}',
          type: 'post',
          data: $(this).serializeArray(),
          dataType: 'json',
          success: function(response){
            window.location.href = '{{ route("orders.detail",$order->id) }}'
          }
          
        });
      }
      


    });
    
  </script>
@endsection