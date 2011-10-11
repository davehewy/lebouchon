<?php if (  $wp_query->max_num_pages > 1 ) : ?>

	<div class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"><span class="orange">&laquo;</span></span> Older posts' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"><span class="orange">&raquo;</span></span>' ) ); ?></div>
	</div><!-- #nav-below -->

<?php endif; ?>


<div class="latest_blog_post_listings">
<?php 
 $post_count = 0;
 if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 	<?php
 	
 	/* Next lets find the title for the post and make it a link to the single post */
 	?>
 	
 	<div class="thumb">
	<?php
		if(has_post_thumbnail()){ ?>
			<a href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>
	<?php } ?>
	</div>

 	<h3>
 		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
 	</h3>
 	 
 	<div class="blog_excerpt">
	 	<?php
	 	the_excerpt(); 
	 	?>
 	</div>

 	<div class="right blog_read_more">
 		<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read more &raquo;</a>
 	</div>
	

 	<?php
	$post_count++;
	endwhile; else: ?>


 <?php endif; ?>
 
 </div>
 

 
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="navigation padtop">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav"><span class="orange">&laquo;</span></span> Older posts' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav"><span class="orange">&raquo;</span></span>' ) ); ?></div>
	</div><!-- #nav-below -->
<?php endif; ?>
