var store_html = '';
var store_name = [ "I-Canteen", "โรงอาหารอักษร", "Card title", "javascript", "asp", "ruby" ];
var autocomplete = $( "input.form-control.main-search" ).autocomplete({
 	source: store_name,
 	create: function( event, ui) {
 		store_html = $('#store').html();
 	},
 	select: function( event, ui ) {
 		$('#store').html('');
 	},
 	change: function(event, ui) {
 		if ($( "input.form-control.main-search" ).val() == ''){
 			$('#store').html(store_html);
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

var store = function( id, name ) {
	var div = $('<div>').addClass('jumbotron');
	$.ajax({
		url: '/path/to/file',
		type: 'GET',
		dataType: 'json',
		data: {id: id, name: name},
	})
	.done(function( data ) {
		$('<img>').addClass('img-fluid').attr('src', data.img).appendTo(div);
		$('<h1>').addClass('display-3 store').append(data.header)
		div.append('<hr class="my-4">')
		div.append($('<p>').append(data.description));
		div.append('<div class="clearfix">\
        <div class="btn-group float-right">\
            <button type="button" id="testBtn" class="btn btn-success" data-loading-text=" ... ">\
                <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>0</button>\
            <button type="button" id="testBtnDown" class="btn btn-danger" data-loading-text=" ... "><i class="fa fa-thumbs-o-down" aria-hidden="true"></i>0</button>\
	        </div>\
	    </div>');
	    div.append('<hr class="my-4">');
	    comment_box( div );
		div.append('<hr class="my-4">');
		$.each( data.comments, function(index, el) {
			comment(div, el);
		});
	})	
}

var comment = function( div, item) {
	var dh = $('<div>').addClass('card-header').append(item.name);
	var i = $('<img>').attr({
		class: 'user-photo',
		src: 'https://ssl.gstatic.com/accounts/ui/avatar_2x.png',
	});
	var dcl = $('<div>').addClass('col-lg-2 col-md-3').append(i);
	var cl = '<div class="clearfix"><button type="button" id="testBtn" class="btn btn-success float-right" data-loading-text=" ... "><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>0</button></div>';
	var dcr = $('<div>').addClass('col-lg-10 col-md-9').append(item.comment).append(cl);
	var db = $('<div>').addClass('card-block').append($('<div>').addClass('row').append(dcl).append(dcr));
	return $('<div>').addClass('card').append(dh).append(db).appendTo(div);
};

var comment_box = function ( div ) {
	var d = $('<div>').addClass('form-group').appendTo(div);
	d.append('<label for="exampleTextarea" class="padText">Comment</label>');
	d.append('<textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Write your comment here."></textarea>');
	var dc = $('div').addClass('clearfix').appendTo(d);
	var dbg = $('div').addClass('btn-group float-right comment').appendTo('dc');
	dbg.append('<button type="button" id="testBtn" class="btn btn-fail" data-loading-text=" ... ">Clear</button>');
	dbg.append('<button type="button" id="testBtn" class="btn btn-success" data-loading-text=" ... ">Submit</button>');
}