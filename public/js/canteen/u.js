$(document).ready(function() {
	$('input[name="login"]').on('click', function(event) {
		event.preventDefault();
		sign_in($(this));
	});

	$('input[name="register"]').on('click', function(event) {
		event.preventDefault();
		sign_up($(this));
	});

	$('input[name="logout"]').on('click', function(event) {
		event.preventDefault();
		sign_out($(this));
	});
});

var sign_in = function(sec) {
	var that = sec.parent();
	$.ajax({
		url: '/user',
		type: 'POST',
		dataType: 'json',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			action: 'signin',
			a: that.children('input[name="user"]').val(),
			b: that.children('input[name="pass"]').val(),
		},
	})
	.done(function(data) {
		// console.log(data);
		if (data.success == 'ok')
		{
			$('a[data-target="#login-modal"]').append(data.name);
			$('#login-modal').modal('hide');
			setTimeout((function(){$('#login-modal').remove();}), 1000);
			setTimeout((function(){$('#register-modal').remove();}), 1000);
		}
		else
		{
			alert('We have something wrong.');
		}
	}).fail(function(html, statusCode) {
		errorShow(html.responseText);
	});

	return false;
}

var sign_up = function(sec) {
	that = sec.parent();

	pass1 = that.children('input[name="pass"]').val();
	pass2 = that.children('input[name="re-pass"]').val();

	if (pass1 !== pass2)
	{
		alert('Password mismatch, check your password again.');
		return;
	}

	$.ajax({
		url: '/user',
		type: 'POST',
		dataType: 'json',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			action: 'signup',
			a: that.children('input[name="user"]').val(),
			b: pass1,
			c: that.children('input[name="email"]').val(),
		},
	})
	.done(function(data) {
		// console.log(data);
		if (data.status != 'true')
			alert(data.error);
		else
			location.reload();
		
	}).fail(function(html, statusCode) {
		errorShow(html.responseText);
	});

	return false;
}

var sign_out = function(sec) {
	that = sec.parent();
	$.ajax({
		url: '/user',
		type: 'POST',
		dataType: 'json',
		data: {
			_token: $('meta[name="csrf-token"]').attr('content'),
			action: 'signout',
		},
	})
	.fail(function(html, statusCode) {
		errorShow(html.responseText);
	});

	return false;
}