var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
	
});

var errorShow = function(text) {
	var newWindow = window.open();
	newWindow.document.write(text);
}

var add = function() {
	data = checkData();
	data['_token'] = CSRF_TOKEN;

	// console.log(data);
	// return;
	$.ajax({
		url: '/backdoor',
		type: 'POST',
		dataType: 'json',
		data: data,
	})
	.done(function(data) {
		console.log(data);
		location.reload();
	})
	.fail(function(html, statusCode) {
		errorShow(html.responseText);
	});
}

var checkData = function() {
	data = {};
	data['id'] = getVal('input[name="id"]');
	data['name'] = getVal('input[name="name"]');
	data['location'] = getVal('input[name="location"]');
	data['description'] = getVal('textarea[name="description"]');
	data['food[]'] = getVal('input[name="food[]"]');
	data['lat'] = getVal('input[name="lat"]');
	data['lng'] = getVal('input[name="lng"]');
	data['picture'] = getVal('input[name="picture"]');
	data['time'] = getVal('input[name="time"]');
	data['isVeg'] = getVal('input[name="isVeg"]');
	data['isHalal'] = getVal('input[name="isHalal"]');

	$.each(data, function(index, val) {
		if (!data[index])
			delete data[index];
	});
	return data;
}

var getVal = function(selector) {
	var sec = $(selector);
	if (sec.length <= 0)
		return null;
	// console.log(sec);
	if (sec.length == 1)
		return $(sec[0]).val();

	var data = [];
	for (var i = 0; i < sec.length; i++) {
		data.push($(sec[i]).val());
	}

	return data;
}