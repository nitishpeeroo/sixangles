(function($) {
    $(document).ready(function() {
	    qodefDisconnectFromInstagram();
    });

    function qodefDisconnectFromInstagram() {
        if($('.qodef-disconnect-from-instagram').length) {
            $('.qodef-disconnect-from-instagram').click(function(e) {
                e.preventDefault();

                //@TODO get this from data attr
                var button = $(this);
	            button.text('Disconnecting...');
                var data = {
                    action: 'qode_disconnect_from_instagram'
                }

                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: data,
                    dataType: 'json',
                    success: function(response) {
	                    if(response.status){
		                    window.location.href = window.location.href.split('&')[0];
	                    }

                    }
                });
            });
        }
    }
})(jQuery)
