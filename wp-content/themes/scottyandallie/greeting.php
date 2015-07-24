<?php

$description = get_bloginfo( 'description' );

if ( ! empty ( $description ) ) : ?>
	<div id="description">
		<h2 id="site-description"><?php echo $description ?></h2>
		<div id="wedding-counter"></div>
	</div><!-- #description -->
<?php endif; ?>