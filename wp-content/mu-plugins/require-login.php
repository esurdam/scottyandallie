<?php

function _force_redirect_to_login() {
    if ( ! is_user_logged_in() ) {
        auth_redirect();
	return false;
    }

    return true;
}
//add_filter( 'do_parse_request', '_force_redirect_to_login' );
