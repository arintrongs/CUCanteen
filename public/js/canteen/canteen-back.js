var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function() {
	
});

var errorShow = function(text) {
	var newWindow = window.open();
	newWindow.document.write(text);
}

var add = function() {
	$.ajax({
		url: 'backdoor',
		type: 'POST',
		dataType: 'json',
		data: {
			_token: CSRF_TOKEN,
			name: $('#name').val(),
			location: $('#location').val(),
			description: $('#description').val(),
		},
	})
	.done(function(data) {
		console.log(data);
		location.reload();
	})
	.fail(function(html, statusCode) {
		errorShow(html.responseText);
	});
}