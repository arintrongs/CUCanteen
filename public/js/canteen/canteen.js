$(document).ready(function() {
	getPosition();
	getShop();
	var stars = [	$('[class="comment-star"][value="1"]'),
					$('[class="comment-star"][value="2"]'),
					$('[class="comment-star"][value="3"]'),
					$('[class="comment-star"][value="4"]'),
					$('[class="comment-star"][value="5"]')];
	
	stars.forEach(function (item, index){
		item.mouseover(function(){
			for(i = 0; i < stars.length; i++){
			if(stars[i].attr('value') <= $(this).attr('value')){
				stars[i].addClass('active');
			}
			else{
				stars[i].removeClass('active');
			}
		}
		});
		item.mouseout(function(){
			var val = (isNaN($('#rate').val()))?0:$('#rate').val();
			for(i = 0; i < stars.length; i++){
				if(stars[i].attr('value') <= val){
					stars[i].addClass('active');
				}
				else{
					stars[i].removeClass('active');
				}
			}
		});
		item.click(function(){
			$('#rate').val(isNaN($(this).attr('value'))?0:$(this).attr('value'));
			for(i = 0; i < stars.length; i++){
				if(stars[i].attr('value') <= $(this).attr('value')){
					stars[i].addClass('active');
				}
				else{
					stars[i].removeClass('active');
				}
			}
		});
	});
});

var latitude = '';
var longitude = '';

var errorShow = function(text) {
	var newWindow = window.open();
	newWindow.document.write(text);
	return newWindow;
};

var getShop = function() {
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/canteen/scopeDist',
		type: 'POST',
		dataType: 'json',
		data: {
			_token: CSRF_TOKEN,
			lat: latitude,
			lng: longitude,
		},
	})
	.done(function(data) {
		// console.log(data);
		
		if (data.lenght > 0)
		{
			var contain = $('div.container.card-content')[0].children[0].children;
			$.each(contain, function(index, val) {
				val.empty();
			});

			var i = 0;
			$.each(data, function(index, val) {
				contain[(i++) % 3].append(shop_card(val));
			});
		}
	})
	.fail(function(html, statusCode) {
		errorShow(html.responseText);
	});	
}

var getPosition = function() {
    if (navigator.geolocation) {
    	navigator.geolocation.getCurrentPosition(function(position) { 
		    position_callback(position);
	    },
	    function(failure) {
	        $.getJSON('https://ipinfo.io/geo', function(response) { 
		        var loc = response.loc.split(',');
		        var position = {
		        	coords: {
			            latitude: loc[0],
			            longitude: loc[1]
			        },
		        }
	        	position_callback(position);
	        });
		});
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

var position_callback = function(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;

    // console.log(latitude);
    // console.log(longitude);
}