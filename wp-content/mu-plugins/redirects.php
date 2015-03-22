<?php

if ( 0 === strpos( $_SERVER['REQUEST_URI'], '/rsvp' ) ) {
	wp_redirect( 'http://goo.gl/forms/Lg253XzRe3' );
	exit();
}