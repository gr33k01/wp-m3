(function( $ ) {
	if (!window.addEventListener) return;
	function m3(e) {	 	
		var jwt = e.data;
		var options = {
			type: 'POST',
			url: wpM3.ajaxUrl,
			data: {
				action: 'wp_m3'
				m3_jwt: jwt
			},
			success: function(response) {

			},
			error: function(response) {

			}
		};

		$.ajax(options);               
	};
	window.addEventListener('message', m3, false);
})( jQuery );
