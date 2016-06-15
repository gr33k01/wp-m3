(function( $ ) {	
	function m3(e) {	 	
		console.log(e);
		if(e.origin != wpM3.m3BaseUrl) return;
		$.ajax({
			type: 'POST',
			url: wpM3.ajaxUrl,
			data: {
				action: 'wp_m3',
				m3_jwt: e.data
			},
			success: function(response) {
				window.location.href = wpM3.redirectAfterSubmission;
			},
			error: function(response) {
				console.log(response);
				alert('Error submitting results.');
			}
		});               
	};
	window.addEventListener('message', m3, false);
})( jQuery );
