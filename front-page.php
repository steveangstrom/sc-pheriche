<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<div id="primary" >
<?php the_content(); ?>
</div><!-- #primary -->


<?php get_footer(); ?>
