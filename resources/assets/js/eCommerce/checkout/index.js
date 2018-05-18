
$(document).ready(function() {
	
	$('.icon-del').click( function(){
		var _self = $(this)
		_self.parents('.item-cart-detail').length == 1 ? _self.parents('.item-cart-detail').remove() : ''
		
	})
	

});