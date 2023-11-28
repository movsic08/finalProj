@if(!empty($review))
  <div class="modal fade" id="reviewProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Review Product</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form action="" method="post" id="replyReviewProductForm">

            <div class="card">
        
              <div class="card-header">

                <span>{{ $review->reviewer_name }}</span> &nbsp;&nbsp;&nbsp;
                <span class=" mb-0 ">
                  Rating: {{ $review->rating }}<span class="fas fa-star text-primary"></span> &nbsp;
                </span>
                <br>
                <small><strong>{{ $review->review }}</strong></small>
                
              </div>


              <div class="card-body">
        
                <input name="order_id" id="order_id" value="{{ $review->order_id }}" type="hidden">
                <input name="product_id" id="product_id" value="{{ $review->product_id }}" type="hidden" >
                <input name="review_id" id="review_id" value="{{ $review->id }}" type="hidden" >
        
        
                <div class="form-group">
                  <label for="">Reply to Review</label>
                  <textarea name="review_reply" type="text" class="form-control" placeholder="{!! !empty($review->review_reply) ? $review->review_reply : 'No Recent Reply on the Review' !!}">{!! !empty($review->review_reply) ? $review->review_reply : '' !!}</textarea>
                </div>

                <button class="btn btn-primary btn-sm mt-2" >Submit Reply</button>
        
              </div>
        
            </div>
            @csrf
            
        
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>

@endif

