$(document).ready(function() {
	var stores_html = '';
	
	$.each( stores_recomment, function(index, val) {
		var div = $('div.card-deck.pad-bottom');
		store_card(div, val);
	});

	var autocomplete = $( "input.form-control.main-search" ).autocomplete({
	 	source: stores_name,
	 	create: function( event, ui) {
	 		stores_html = $('#store').html();
	 	},
	 	select: function( event, ui ) {
	 		store(ui.item.value);
	 	},
	 	change: function(event, ui) {
	 		if ($( "input.form-control.main-search" ).val() == ''){
	 			$('#store').html(stores_html);
	 		}
	 	},
	 	messages: {
	        noResults: '',
	        results: function() {}
	    }
	});

	autocomplete.data('ui-autocomplete')._renderMenu = function( ul, items ) {
		var that = this;
		$.each( items, function( index, item ) {
			that._renderItemData( ul, item );
		});
		$( ul ).addClass('list-group');
		$( '.ui-helper-hidden-accessible' ).css('display', 'none');
	};

	autocomplete.data('ui-autocomplete')._renderItem = function( ul, item ) {
		var a = $( "<a>" );
		var m = $( "<div>" ).addClass("media");
		var img = $('<img>').attr({ class: "d-flex mr-3", src: "img/bg.png" }).appendTo(m);
		var mb = $( "<div>" ).addClass("media-body").appendTo( m );
		var h = $( "<h5>" ).addClass("mt-0").append(item.label).appendTo( mb );
		return $('<li>').addClass('list-group-item').append(m).appendTo( ul );
	};

	autocomplete.data('ui-autocomplete')._resizeMenu = function() {
	  this.menu.element.outerWidth( $( "input.form-control.main-search" ).parent().width() );
	}
});

var store = function( shop ) {
	$('#store').html('');
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	$.ajax({
		url: '/canteen/' + shop,
		type: 'get',
		dataType: 'json',
		success: function( data ) {
			var div = $('<div>').addClass('jumbotron');
			$('<img>').addClass('img-fluid').appendTo(div); //.attr('src', data.img)
			$('<h1>').addClass('display-3 store').append(data.name).appendTo(div);
			div.append('<hr class="my-4">')
			div.append($('<p>').append(data.description));
			div.append('<div class="clearfix">\
	        <div class="btn-group float-right">\
	            <button type="button" class="btn btn-success"">\
	                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>0</button>\
	            <button type="button" class="btn btn-danger"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>0</button>\
		        </div>\
		    </div>');
		    div.append('<hr class="my-4">');
		    comment_box(div);
			div.append('<hr class="my-4">');
			$.each( data.comments, function(index, el) {
				comment(div, el);
			});
			$('#store').append(div);
		}
	});
};

var comment = function( div, item) {
	var dh = $('<div>').addClass('card-header').append(item.name);
	var i = $('<img>').attr({
		class: 'user-photo',
		src: 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png',
	});
	var dcl = $('<div>').addClass('col-lg-2 col-md-3').append(i);
	var cl = '<div class="clearfix"><button type="button" class="btn btn-success float-right"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>0</button></div>';
	var dcr = $('<div>').addClass('col-lg-10 col-md-9').append(item.comment).append(cl);
	var db = $('<div>').addClass('card-block').append($('<div>').addClass('row').append(dcl).append(dcr));
	return $('<div>').addClass('card').append(dh).append(db).appendTo(div);
};

var comment_box = function ( div ) {
	var dbg = $('<div>').addClass('btn-group float-right comment');
	dbg.append('<button type="button" class="btn btn-fail" onclick="clear();">Clear</button>');
	dbg.append('<button type="button" class="btn btn-success" onclick="send();">Submit</button>');
	var dc = $('<div>').addClass('clearfix').append(dbg);
	var d = $('<div>').addClass('form-group');
	d.append('<label class="padText">Comment</label>');
	d.append('<textarea class="form-control" rows="3" placeholder="Write your comment here."></textarea>');
	return d.append(dc).appendTo(div);
}

var store_card = function( div, item ){
	var img = $('<img>').addClass('card-img-top img-fluid hidden-xs-down').attr('src', item.img);
	var d = $('<div>').addClass('card-block').append('<h4 class="card-title" onclick="store(\''+item.name+'\');">' + item.name + '</h4>')
	return $('<div>').addClass('card').append(img).append(d).appendTo(div);
}

var send = function() {
	$.post('/canteen', {comment: $('textarea.form-control').val()}, function(data, textStatus, xhr) {
		$('textarea.form-control').val(data);
	});
}

var clear = function() {
	$('textarea.form-control').val('');
}