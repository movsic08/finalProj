<!-- Product Variation Form-->
<form action="" name="variationForm" id="variationForm" class="container-fluid">
        
  <div class=" table-responsive">
    <table class="table ">
      <thead>
        <th class="text-nowrap">
          <i class="fa fa-angle-double-down"></i> Colors and Sizes <i class="fa fa-angle-double-right"></i>
        </th>

        @if($sizes->isNotEmpty())

          @foreach($sizes as $size)
            <th class="text-center" align="middle">{{ $size->size }}</th>
          @endforeach

        @else 

          <th>No Size Found</th>

        @endif

        <th>Action</th>

      </thead>

      @if($colors->isNotEmpty())

        

        @foreach($colors as $color)
          <tr>
            <th class="text-nowrap">{{ $color->name }}</th>


            @if($sizes->isNotEmpty())

              @foreach($sizes as $size)
                <td style="min-width: 100px;">
                  <input type="hidden" name="sizes_id[]" value="{{ $size->id }}">
                  <input type="hidden" name="colors_id[]" value="{{ $color->id }}">
                  @php 
                    $stock_quantity = check_variation($product->id,$color->id,$size->id);
                  @endphp 

                  <input min="0" max="99" step="1" type="number" name="stock_quantity[]" class="form-control text-center border {{ ($stock_quantity > 0) ? 'border-success' : 'border-danger' }} " style="border-width: 5px;" placeholder="Quantity" value="{{ $stock_quantity  }}">
                </td>
              @endforeach

            @else 

              <th>No Color Found</th>

            @endif

            <td class="text-nowrap">
              <button class="btn btn-sm btn-primary" >
                <i class="fas fa-save"></i>
                Save
              </button>
            </td>


          </tr>


          
        @endforeach

      @else 

      <tr>
        <td colspan="100%">
          No Sizes Found
        </td>
      </tr>

      @endif

      
      


    </table>
  </div>
    
  
  {{-- <div class="form-group">
    <label for="">Quantity</label>
    <input type="number" class=" form-control mb-2" placeholder="Available Qty" id="stock_quantity" name="stock_quantity">
    <p></p>
  </div> --}}

  

  
  
  
  

</form>
<!-- end of Product Variation Form-->