<?php

/* Template Name: Menu page */

get_header(); ?>

<div id="bodywrapper">
  <div id="headerwrapper">
    <ul>
    	<li>14 boutique rooms</li>
        <li><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/header-bullet.png" width="24" height="14" alt="•" /></li>
		<li>Hotel available for private and corporate functions</li>
        <li><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/header-bullet.png" width="24" height="14" alt="•" /></li>
		<li>Modern English French cuisine</li>
	</ul>
	</div>

	<div id="container">
	<?php
		$counter = 1;
		$menu_groups = get_terms( 'menu_category', 'orderby=id' );
		foreach($menu_groups as $menu_group):
		
	?>
	<div class="menu_group">
		<img src="<?=bloginfo('template_url')?>/assets/images/<?=$menu_group->slug?>_text.png">
	</div>
	<?php
		query_posts( array ('post_type' => 'menu', 'showposts' => 20, 'menu_category' => $menu_group->slug, 'orderby' => 'id', 'order' => 'ASC' ) );
		if (have_posts()) : while (have_posts()) : the_post();
			$lebouchon_text = get_post_meta($post->ID,'_lebouchon_text',true);
			$lebouchon_price = get_post_meta($post->ID,'_lebouchon_price',true);
			$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	?>
		<div class="menu_item">
			<div class="info">
				<a href="<?=$image?>" <?php if(!empty($image)) { ?>class="preview"<?php } else { ?>class="preview_none"<?php } ?>>
					<span class="title"><?=get_the_title()?></span>
					<span class="description"><?=$lebouchon_text?></span>
				</a>
			</div>
			<div class="price">&pound;<?=$lebouchon_price?></div>
		</div>
	<?php
		endwhile; endif;
		
		if(count($menu_groups) > $counter){
	?>
			<div class="menu_symbol"></div>
	<?php
		}
		$counter++;
		endforeach;
	?>
    </div>

<div id="right-column">
	<div id="facebook">
		<a href="http://www.facebook.com/pages/Le-bouchon/265746736775205" title="Follow us on Facebook" target="_blank"></a>
	</div>
	
	<div id="sign_up_box">
		<div class="top"></div>
		<div class="content">
		
	        <h3>Be the first to hear our latest news</h3>
			<form action="" method="post" id="news_form">
			<table>
			  <tr>
			    <td><input type="text" class="text" name="news_name" id="news_name" value="Name:"></td>
			  </tr>
			  <tr>
			    <td><input type="text" class="text" name="news_email" id="news_email" value="Email:"></td>
			  </tr>
			  <tr>
			    <td>
			    	<button type="submit" class="news_submit" name="submit_news">Send</button>
			    </td>
			  </tr>
			</table>
			<input type="text" name="trsideid" class="clever" value="">
			<?php wp_nonce_field('submit-news','submit-news-action'); ?>
			</form>
						
		</div>
		<div class="bottom"></div>
	</div>
        
      <div id="jobs">
      <a href="mailto:enquiries@le-bouchon.co.uk?subject=CV and application letter">
      	<img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/job-vacancies.png" width="235" height="172" alt="Job vacancies - click to apply" />
      </a>
      </div>
	
	<a href="http://maps.google.co.uk/maps?q=CM9+4LT" target="_blank" title="See how to find us">
		<div id="map">
       		<div id="map-title">How to find us</div>
    	</div>
    </a>

  </div>
</div>
  </div>


<?php get_footer(); ?>