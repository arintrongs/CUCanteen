<div class="container-fluid comment">
	<div class="row" >
		<div class="col-lg-1">
			<div class="comment-icon"> 
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
		</div>
		<div class="col-lg-11">
			<div class="comment-box">
				<textarea class="comment_area" id="comment" rows="3" placeholder="Comment Here."></textarea>
			</div>

		</div>
	</div>
	<div class="row ">
		<div class="col-lg-6">
			<input type="text" class="form-control" id="food" data-provide="typeahead"  autocomplete="off" placeholder="อาหารที่แนะนำ">
		</div>
		<div class="col-lg-3 rate " >
			<div class="input-group">
				<div class="input-group-addon"><i class="fa fa-star-o" aria-hidden="true"></i></div>
    			<input type="text" class="form-control" id="rate" placeholder="0-5">
  			</div>
		</div>
		<div class="col-lg-2"><button type="button" class="btn btn-outline-success " onclick="commentSubmit();">Success</button></div>
		<div class="col-lg-1"></div>

	</div>
</div>
