/*globals window, document, $, jQuery */

(function ($) {
	"use strict";
    $(document).ready(function () {
		var weddingDay  = new Date(2015, 6, 6, 12, 0, 0);
		$('#wedding-counter').countdown({until: weddingDay});
    });

}(jQuery));