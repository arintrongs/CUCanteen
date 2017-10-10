<div class="col-lg-4 col-md-4 col-sm-6 col-12" id="shop_card" data-name="{{ $title }}" data-location="{{ $location }}">
    <div class="card">
        <img class="card-img-top" src="{{ $img }}" alt="Card image cap">
        <div class="card-body p-4">
          <h4 class="card-title">{{ $title }}</h4>
          <p class="card-text">{{ $description }}</p>
        </div>
        <div class="card-footer">
        	<div class="row">
        		<div class="col-lg-10 col-md-10 col-sm-10 col-10 card-info">
        		Rating : {{ number_format($rating,2) }}<!--  | 150 m. away -->
        		</div>
        		<div class="col-lg-2 col-md-2 col-sm-2 col-2">
        			<a class="float-right select" id="select" onclick="shop_show({{ $id }});">></a>
        		</div>
        	</div>
        </div>
    </div>
</div>