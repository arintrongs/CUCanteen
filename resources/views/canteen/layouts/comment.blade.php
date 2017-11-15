<div class="container-fluid comment">
	<div class="row" >
		<div class="col-lg-1 col-md-1 col-sm-1 col-1">
			<div class="comment-icon"> 
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
		</div>
		<div class="col-lg-11 col-md-11 col-sm-11 col-11">
			<div class="comment-box">
				<textarea class="comment_area" id="comment" rows="3" placeholder="Comment Here."></textarea>
			</div>

		</div>
	</div>
	<div class="row ">
		<div class="col-lg-6 col-md-6 col-sm-6 col-6">
			<input type="text" class="form-control" id="food" data-provide="typeahead"  autocomplete="off" placeholder="อาหารที่แนะนำ">
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-3 rate" >
			<div class="input-group">
    			<input type="text" class="form-control" id="rate" hidden>
    			<span class="comment-star" value="1">&#9733</span>
    			<span class="comment-star" value="2">&#9733</span>
    			<span class="comment-star" value="3">&#9733</span>
    			<span class="comment-star" value="4">&#9733</span>
    			<span class="comment-star" value="5">&#9733</span>
  			</div>
		</div>
		<div class="col-lg-2  col-md-2 col-sm-2 col-2 "><button type="button" class="btn btn-outline-success " onclick="commentSubmit();">Success</button></div>
		<div class="col-lg-1 col-md-1 col-sm-1 col-1"></div>

	</div>
</div>
