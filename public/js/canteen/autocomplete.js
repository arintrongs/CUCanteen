var elememt_shop = $('div.container.pad-top');
var elememt_input = $("input.form-control.form-control-lg.mr-sm-2");
var elememt_shop_card = $('div#shop_card.col-lg-4');

var shop_source = [];

$(document).ready(function() {
	prepareSource();
	prepareAutocomplete();

	elememt_input.keyup(function(event) {
		// console.log(event, elememt_input.val());
		clearHidden();
	});
});

var prepareSource = function() {
	// console.log(elememt_shop_card);
	$.each( elememt_shop_card, function(index, val) { 
		// console.log($(val));
		var tmp = {
			'value' : index,
			'label' : $(val).data('name'),
			'location' : $(val).data('location'),
			'img' : $(val)[0].children[0].children[0].currentSrc,
			'description' : $(val)[0].children[0].children[1].children[1].innerText,
			'rating' : $(val)[0].children[0].children[2].children[0].children[0].innerText,
		};
		shop_source.push(tmp); 
	});

	// console.log(shop_source);
}

var prepareAutocomplete = function() {
	var autocomplete = elememt_input.autocomplete({
		source: shop_source,
	 	select: function( event, ui ) {
	 		//store(ui.item.value);
	 	},
	 	change: function(event, ui) {
	 		clearHidden();
	 	},
	 	messages: {
	        noResults: '',
	        results: function() {}
	    }
	});

	autocomplete.data('ui-autocomplete')._renderMenu = function( ul, items ) {
		var that = this;
		$.each(elememt_shop_card, function(index, val) {
			// console.log(val);
			$(val).attr('hidden', '');
		});
		$.each(items, function(index, val) {
			that._renderItem(ul, val.value);
		});
	};

	autocomplete.data('ui-autocomplete')._renderItem = function( ul, id ) {
		var card = $(elememt_shop_card[id]);
		// console.log(card);
		card.removeAttr('hidden');
	};

	// autocomplete.data('ui-autocomplete')._resizeMenu = function() {
	//   this.menu.element.outerWidth( $( "input.form-control.main-search" ).parent().width() );
	// }
}

var clearHidden = function() {
	if (elememt_input.val() == '') {
		$.each(elememt_shop_card, function(index, val) {
			$(val).removeAttr('hidden');
		});
	}
}