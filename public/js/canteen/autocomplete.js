$(document).ready(function() {
	var shop_html = '';
	var shop = $('div.container.pad-top');
	var shop_card = $('div.card');
	var shop_source = [];

	$.each( shop_card, function(index, val) { shop_source.push($(val).data('name')); });
	console.log(shop_source);
	var autocomplete = $( "input.form-control.form-control-lg.mr-sm-2" ).autocomplete({
		source: shop_source,
	 	create: function( event, ui) {
	 		stores_html = shop.html();
	 	},
	 	select: function( event, ui ) {
	 		//store(ui.item.value);
	 	},
	 	change: function(event, ui) {
	 		if ($( "input.form-control.form-control-lg.mr-sm-2" ).val() == ''){
	 			shop.html(stores_html);
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
		// item.label;
		// item.value;
		var dd = $('<div>').attr('class', 'card-body p-4');
		var h4 = $('<h4>').attr('class', 'card-title').append(item.label).appendTo(dd);
		var p = $('<p>').attr('class', 'card-text').append('location').appendTo(dd);
		var i = $('<img>').attr('class', 'card-img-top');
		var d = $("<div>").attr('class', 'card fill').append(i).append(dd);

		return $('<li>').append(d).appendTo(ul);
	};

	// autocomplete.data('ui-autocomplete')._resizeMenu = function() {
	//   this.menu.element.outerWidth( $( "input.form-control.main-search" ).parent().width() );
	// }
});