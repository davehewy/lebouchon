<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Bytewirev3
 * @since Bytewirev3 1.0
 */

get_header(); ?>

	<?php
		get_template_part( 'loop', 'single' );
	?>



	<?php get_sidebar(); ?>


<?php get_footer(); ?>
