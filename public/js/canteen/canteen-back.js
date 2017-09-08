var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

var store_selector = $($('div.container-fluid')[3]);
var img = $('img');
var input_id = $('input[name="id"]');
var input_name = $('input[name="name"]');
var input_canteen = $('input[name="canteen"]');
var input_lat = $('input[name="lat"]');
var input_lng = $('input[name="lng"]');
var input_time = $('input[name="time"]');
var input_description = $('textarea[name="description"]');
var input_food_list = $('select[name="food"]');
var input_food_name = $('input[name="foodname"]');
var input_vege = $('input[name="vege"]');
var input_halal = $('input[name="halal"]');
var button_add = $('button[name="add"]');
var button_food_delete = $('button[name="food_delete"]');
var button_submit = $('button[name="submit"]');
var button_clear = $('button[name="clear"]');
var button_edit = $('button[name="edit"]');
var button_delete = $('button[name="delete"]');
var button_new = $('button[name="new"]');

$(document).ready(function() {
	// console.log(img.parent());
	button_add.on('click', function(event) {
		event.preventDefault();
		food_input_add();
	});

	button_food_delete.on('click', function(event) {
		event.preventDefault();
		food_select_del(input_food_list.val());
	});

	button_clear.on('click', function(event) {
		event.preventDefault();
		clear();
	});

	button_submit.on('click', function(event) {
		event.preventDefault();
		add();
	});

	button_edit.on('click', function(event) {
		event.preventDefault();
		// console.log($(this).data('id'));
		edit($(this).data('id'));
	});

	button_new.on('click', function(event) {
		event.preventDefault();
		clear();
		store_selector.show();
	});
	button_delete.on('click', function(event) {
		event.preventDefault();
		// console.log($(this));
		ondelete($(this).data('id'));
	});
});

var food_input_add = function() {
	var val = input_food_name.val();
	var option = $('<option>').append(val);
	input_food_list.append(option);
}

var food_select_del = function(val) {
	if (!val.length) return;
	for (var j = 0; j < val.length; j++) {
		for (var i = 0; i < input_food_list[0].children.length; i++) {
			if (input_food_list[0].children[i].outerText == val[j])
				input_food_list[0].children[i].remove();
		}
	}
}

var clear = function() {
	var text = '';
	input_id.val(0);
	input_name.val(text);
	input_canteen.val(text);
	input_lat.val(text);
	input_lng.val(text);
	input_description.val(text);
	input_food_name.val(text);
	while (input_food_list[0].children.length)
		input_food_list[0].children[0].remove();
	input_vege.prop("checked", false);
	input_halal.prop("checked", false);
}

var set_image = function(url) {
	var host = img.parent();
	while (host[0].children.length)
		host[0].children[0].remove();
	host.append($('<img>').attr('src', url));
}

var set = function(data) {
	if (data.shop_id) 		input_id.val(data.shop_id);
	if (data.shop_name)		input_name.val(data.shop_name);
	if (data.shop_location) input_canteen.val(data.shop_location);
	if (data.shop_lat) 		input_lat.val(data.shop_lat);
	if (data.shop_lng) 		input_lng.val(data.shop_lng);
	if (data.shop_time) 	input_time.val(data.shop_time);
	if (data.shop_description) input_description.val(data.shop_description);
	if (data.shop_isVeg) 	input_vege.prop("checked", true);
	if (data.shop_isHalal) 	input_halal.prop("checked", true);
	if (data.shop_picture)	set_image(data.shop_picture);
	// console.log(data.shop_food);
	for (var i=0; i < data.shop_food.length; i++) {
		var option = $('<option>').append(data.shop_food[i].food_name).data('id', data.shop_food[i].food_id);
		input_food_list.append(option);
		delete data.shop_food[i];
	}
}

var errorShow = function(text) {
	var newWindow = window.open();
	newWindow.document.write(text);
}

var ondelete = function (id) {
	$.ajax({
		url: '/backdoor/' + id,
		type: 'DELETE',
		dataType: 'json',
		data: {_token: CSRF_TOKEN},
	})
	.done(function(data) {
		// console.log(data);
		location.reload();
	})
	.fail(function(html, statusCode) {
		errorShow(html.responseText);
	});
}

var edit = function(id) {
	$.ajax({
		url: 'backdoor/' + id,
		type: 'GET',
		dataType: 'json',
		data: {_token: CSRF_TOKEN},
	})
	.done(function(data) {
		// console.log("success");
		clear();
		set(data);
		console.log(data);
		store_selector.show();
	})
	.fail(function(html, statusCode) {
		errorShow(html.responseText);
	});
	
}

var add = function() {
	data = checkData();
	data['_token'] = CSRF_TOKEN;

	// console.log(data['food']);
	// return;
	$.ajax({
		url: '/backdoor',
		type: 'POST',
		dataType: 'json',
		data: data,
	})
	.done(function(data) {
		// console.log(data);
		location.reload();
	})
	.fail(function(html, statusCode) {
		errorShow(html.responseText);
	});
}

var checkData = function() {
	data = {};
	data['id'] = getVal('input[name="id"]');
	data['name'] = getVal(input_name);
	data['location'] = getVal(input_canteen);
	data['description'] = getVal(input_description);
	data['food'] = getVal(input_food_list);
	data['lat'] = getVal(input_lat);
	data['lng'] = getVal(input_lng);
	// data['picture'] = getVal('input[name="picture"]');
	data['time'] = getTime(input_time);
	data['isVeg'] = getVal(input_vege);
	data['isHalal'] = getVal(input_halal);
	return data;
}

var getVal = function(sec) {
	if (typeof sec == 'string')
		sec = $(sec);

	if (sec.length <= 0)
		return null;

	// console.log(sec);
	if (sec.length == 1)
	{
		if (sec.attr('type') == 'checkbox')
			return sec.is(":checked");

		// console.log(sec[0].tagName );
		if (sec[0].tagName == 'SELECT')
		{
			var data = [];
			for (var i = 0; i < sec[0].children.length; i++) {
				var tmp = { 'val' : sec[0].children[i].innerText };
				if ($(sec[0].children[i]).data('id'))
					tmp['id'] = $(sec[0].children[i]).data('id');
				data.push(tmp);
			}
			return data;
		}

		return sec.val();
	}

	var data = [];
	for (var i = 0; i < sec.length; i++) {
		data.push($(sec[i]).val());
	}

	return data;
}

var getTime = function(sec)
{
	if (!sec.val()) return;
	var time = sec.val().split("-");
	var open = time[0].replace(/^\s+|\s+$/g, '');
	var close = time[1].replace(/^\s+|\s+$/g, '');
	return open + ' - ' + close;
}