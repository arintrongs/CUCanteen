var shop_source = [];
var shop_html = '';

$(document).ready(function() {
	prepareSource();
	prepareAutocomplete();
});

var prepareSource = function() {
	var shop_card = $('div.card');
	$.each( shop_card, function(index, val) { 
		// console.log($(val));
		var tmp = {
			'value' : $(val).data('name'),
			'label' : $(val).data('name'),
			'location' : $(val).data('location'),
			'img' : $(val)[0].children[0].currentSrc,
			'description' : $(val)[0].children[1].children[1].innerText,
			'rating' : $(val)[0].children[2].children[0].children[0].innerText,
		};
		shop_source.push(tmp); 
	});

	// console.log(shop_source);
}

/*function(request, response) {
	// console.log(request.term);
	//method 1, serach in array

	// term = request.term.toLowerCase();
    var choices = ['ActionScript', 'AppleScript', 'Asp', ...];
    var matches = [];
    for (i=0; i<choices.length; i++)
        if (~choices[i].toLowerCase().indexOf(term)) 
        	matches.push(choices[i]);

    response(matches);


	//method 2, send request to server
},*/

var prepareAutocomplete = function() {
	var shop = $('div.container.pad-top');
	var input = $( "input.form-control.form-control-lg.mr-sm-2" );
	var autocomplete = input.autocomplete({
		source: shop_source,
	 	create: function( event, ui) {
	 		stores_html = shop.html();
	 	},
	 	select: function( event, ui ) {
	 		//store(ui.item.value);
	 	},
	 	change: function(event, ui) {
	 		if (input.val() == ''){
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
		var d = $("<div>").attr('class', 'card').append(i).append(dd);

		return $('<li>').append(d).appendTo(ul);
	};

	// autocomplete.data('ui-autocomplete')._resizeMenu = function() {
	//   this.menu.element.outerWidth( $( "input.form-control.main-search" ).parent().width() );
	// }
}