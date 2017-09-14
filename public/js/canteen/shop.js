var shop_id = 0;

var comment_others = function(data) {
	if (data.updatedat.date == '0000-00-00 00:00:00')
		return $('<div>')[0];

	var time = (data.updatedat.date != '0000-00-00 00:00:00') ? moment.utc(data.updatedat.date).fromNow() : '';
	var drcc = $('<div>').addClass('row').append($('<div>').addClass('container').append(data.comment));
	var dru = $('<div>').addClass('row user');
	dru.append('<div class="col-lg-1"><div class="comment-icon"><i class="fa fa-user" aria-hidden="true"></i></div></div>');
	dru.append('<div class="col-lg-9"><div class="comment-user">' + data.name + ' | ' + time + '</div></div>');
	// dru.append('<div class="col-lg-2"><div class="likes "><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;' + data.num_like + '</div></div>');
	return $('<div>').addClass('container-fluid others').append(dru).append(drcc)[0];
}

var comment_show = function(div, data) {
	while(div.children.length > 1) div.children[1].remove();
	$.each(data, function(index, val) { div.append(comment_others(val)); });
	$('#comment').val('');
	$('#rate').val('');
	$('#food').val('');
}

var shop_card = function(data) {
	var a = $('<a>').addClass('float-right select ').attr('onclick', 'shop_show(' + data.id + ');').append('>');
	var clg2 = $('<div>').addClass('col-lg-2').append(a);
	var clg10_info = $('<div>').addClass('col-lg-10 card-info').append('<div class="col-lg-10 card-info">Rating : ' + data.rating + '</div>'); //  | ' + data.distance + ' m. away
	var c_footer = $('<div>').append($('<div>').append(clg10_info));
	var c_body = $('<div>').addClass('card-body p-4');
	c_body.append('<h4 class="card-title">' + data.title + '</h4>');
	c_body.append('<p class="card-text">' + data.description + '</p>');
	var img = $('<img>').attr({
		class: 'card-img-top',
		alt: 'Card image cap',
		src: data.img,
	});

	return $('<div>').attr({
		class: 'card',
		'data-name': data.title,
		'data-location': data.location,
	}).append(img).append(c_body).append(c_footer);
}

var shop_box = function(data) {
	var img = $('<img>').attr({  alt: 'Card image cap', src: data.img, }); //
	var dcl4 = $('<div>').addClass('col-lg-4').addClass('no-padding').append($('<div>').addClass('img').append(img));
	var dtt = $('<div>').addClass('title');
	dtt.append('<div class="inlineLeft"><h1>' + data.name + '</h1></div><div class="inlineRight goBack"><a class="back" onclick="shop_hide();">Back&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></a></div><br><hr>');
	dtt.append($('<div>').addClass('recommended').append('<h1>Recommeded : ' + data.recommend)).append('<hr>');
	var ddes = $('<div>').addClass('description').append(data.description);
	var df = $('<div>').addClass('footer').append(data.footer);
	var dcl8 = $('<div>').addClass('col-lg-8').append(dtt).append(ddes).append(df);
	return $('<div>').addClass('row').append(dcl4).append(dcl8);
}

var shop_rating = function(data) {
	var dcfr = $('<div>').addClass('container-fluid rating');
	dcfr.append('<div class="row"><div class="col-lg-12 rating_header no-padding"><h3>Rating</h3></div></div>')
	dcfr.append('<div class="rating_star"><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><br>'+data.rating +'</div>');
	return dcfr;
}

var commentSubmit = function() {
	if (shop_id <= 0)
	{
		alert('Please, select shop before comment.\n The system have something wrong.');
		return;
	}

	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	var comment = $('#comment').val();
	var rate = $('#rate').val();
	var food = $('input#food').typeahead("getActive");

	if(comment == '') {
		alert('Please, insert comment.');
		return;
	}

	if(!food) {
		alert('Please, insert favorite food with this shop.');
		return;
	}

	if(rate == '') {
		alert('Please, rate this shop.');
		return;
	}

	$.ajax({
		url: '/canteen',
		type: 'POST',
		dataType: 'text',
		data: {
			_token: CSRF_TOKEN,
			'shop_id': shop_id,
			'comment': comment,
			'rating' : rate,
			'food'	 : food.id,
		},
	})
	.done(function(data) {
		console.log(data);
		if (data == 'logon')
			$('#login-modal').modal('show');
		else if (data == 'true')
			location.reload();
		else
			alert('The system have something wrong.');
	})
	.fail(function(html, statusCode) {
		// errorShow(html.responseText);
	});
	
}

var shop_show = function(id) {
	shop_id = id;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: 'canteen/' + id,
		type: 'GET',
		dataType: 'json',
		data: {
			_token: CSRF_TOKEN,
		},
	})
	.done(function(data) {
		$('div.container-fluid.store').html(shop_box(data));
		$('div.container-fluid.rating').html(shop_rating(data).html());
		comment_show($('div.row.comment-content').children('div.col-lg-5')[0], data.comments);
		$("input#food").typeahead({ source: data.foods, autoSelect: true });
		$('div.container.card-content').hide();
		$('div.container-fluid.store-content').fadeIn("slow");
		$('div.row.comment-content').fadeIn("slow");
	})
	.fail(function(html, statusCode) {
		// errorShow(html.responseText);
	});
}

var shop_hide = function() {
	shop_id = 0;
	$('div.container.card-content').fadeIn("slow");
	$('div.container-fluid.store-content').hide();
	$('div.row.comment-content').hide();
}