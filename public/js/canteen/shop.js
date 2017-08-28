var shop_id = 0;

var comment_others = function(data) {
	if (data.updatedat == '0000-00-00 00:00:00')
		return $('<div>')[0];

	moment().format('YYYY-MM-DD HH:mm:ss');
	var time = (data.updatedat != '0000-00-00 00:00:00') ? moment(data.updatedat).fromNow() : '';
	var drcc = $('<div>').addClass('row').append($('<div>').addClass('container').append(data.comment));
	var dru = $('<div>').addClass('row user');
	dru.append('<div class="col-lg-1"><div class="comment-icon"><i class="fa fa-user" aria-hidden="true"></i></div></div>');
	dru.append('<div class="col-lg-9"><div class="comment-user">' + data.name + ' | ' + time + '</div></div>');
	// dru.append('<div class="col-lg-2"><div class="likes "><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>&nbsp;' + data.num_like + '</div></div>');
	return $('<div>').addClass('container-fluid others').append(dru).append(drcc)[0];
}

var comment_show = function(div, data) {
	for (var i = 1; i < div.children.length; i++) {
		div.children[i].remove();
	}
	console.log(data);
	$.each(data, function(index, val) {
		div.append(comment_others(val));
	});
}

var commentSubmit = function() {
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		url: '/path/to/file',
		type: 'POST',
		dataType: 'json',
		data: {
			_token: CSRF_TOKEN,
			'shop_id': shop_id,
			'comment': $('#comment').val(),
		},
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	});
	
}

var shop_card = function(data) {
	var img = $('<img>').attr({ class: 'fill', alt: 'Card image cap', src: 'img/food/test.jpg', }); //data.img_src
	var dcl4 = $('<div>').addClass('col-lg-4').append($('<div>').addClass('limit').append(img));
	var dtt = $('<div>').addClass('title');
	dtt.append('<div class="inlineLeft"><h1>' + data.name + '</h1></div><div class="inlineRight goBack"><a onclick="shop_hide();">Back&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></a></div><br><hr>')
	var ddes = $('<div>').addClass('description').append(data.description);
	var df = $('<div>').addClass('footer').append(data.footer);
	var dcl8 = $('<div>').addClass('col-lg-8').append(dtt).append(ddes).append(df);
	return $('<div>').addClass('row').append(dcl4).append(dcl8);
}

var shop_rating = function(data) {
	var dcfr = $('<div>').addClass('container-fluid rating');
	dcfr.append('<h2>Rating</h2>')
	dcfr.append('<h2><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></h2>');
	dcfr.append('<h3>' + data.rating + '</h3>');
	return dcfr;
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
		$('div.container-fluid.store').html(shop_card(data));
		$('div.container-fluid.rating').html(shop_rating(data).html());
		comment_show($('div.row.comment-content').children('div.col-lg-5')[0], data.comments);

		$('div.container.card-content').hide();
		$('div.container-fluid.store-content').show();
		$('div.row.comment-content').show();
	})
	.fail(function(html, statusCode) {
		// console.log("Error, Please contact webmaster.");
		console.log(html.responseText);
		var newWindow = window.open();
		newWindow.document.write(html.responseText);
		
	});
}

var shop_hide = function() {
	$('div.container.card-content').show();
	$('div.container-fluid.store-content').hide();
	$('div.row.comment-content').hide();
}