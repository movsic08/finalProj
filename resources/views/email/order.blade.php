<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Order Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif">

  @if($mailData["userType"] == 'customer')
    <h1>Thanks for you order at SHOENIVERSE :)</h1>
    <h2>Your order ID is : #{{ $mailData['order']->id }}</h2>
  @else
    <h1>You have recieved an order: </h1>
    <h2>Your order ID is : #{{ $mailData['order']->id }}</h2>
  @endif

  <address>
    <strong>{{ $mailData['order']->first_name }} {{ $mailData['order']->last_name }}</strong><br>
    {{ $mailData['order']->address }}<br>
    {{ $mailData['order']->city }}, {{ $mailData['order']->zip }} {{ getCountryInfo($mailData['order']->country_id)->name }}<br> 
    Phone: {{ $mailData['order']->mobile }}<br>
    Email: {{ $mailData['order']->email }}
  </address>

  <h2>Products</h2>

  <table class="table table-striped">
    <thead>
      <tr style="background:#CCC;">
          <th>Product</th>
          <th width="100">Price</th>
          <th>Color</th>
          <th>Size</th>
          <th width="100">Qty</th>                                        
          <th width="100">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($mailData['order']->items as $item)
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
            <th colspan="5" class="text-right" align="right">Subtotal:</th>
            <td class="text-nowrap">&#8369; {{ number_format($mailData['order']->subtotal,2) }}</td>
        </tr>
        
        <tr>
          <th colspan="5" class="text-right" align="right">Discount: {{ (!empty($mailData['order']->coupon_code)) ? '('.$mailData['order']->coupon_code.')' : '' }}</th>
          <td class="text-nowrap">&#8369; {{ number_format($mailData['order']->discount,2) }}</td>
        </tr>

        <tr>
            <th colspan="5" class="text-right" align="right">Shipping:</th>
            <td class="text-nowrap">&#8369; {{ number_format($mailData['order']->shipping,2) }}</td>
        </tr>

        <tr>
            <th colspan="5" class="text-right" align="right">Grand Total:</th>
            <td class="text-nowrap">&#8369; {{ number_format($mailData['order']->grandtotal,2) }}</td>
        </tr>
        
    </tbody>
  </table>



</body>
</html>