/*globals window, document, $, jQuery */

(function ($) {
	"use strict";

	var current = 0, photos, photoData, img;

	function gallery() {
		window.setTimeout(function () {
			if ( current + 1 === photos.length ) {
				current = 0;
			} else {
				current += 1;
			}

			img.hide().attr( 'src', photos[ current ] ).fadeIn();
			gallery();
		}, 5000);
	}

    $(document).ready(function () {
		var weddingDay = new Date(2015, 5, 6, 12, 0, 0);
		$('#wedding-counter').countdown({until: weddingDay});

		photoData = $( '#home-gallery-data' );
		if ( photoData.length ) {
			img = $( '#home-gallery img' );
			photos = $.parseJSON( photoData.html() );
			gallery();
		}
    });

}(jQuery));