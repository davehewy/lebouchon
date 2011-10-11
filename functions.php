<?php

/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage Bytewirev3
 * @since Bytewirev3 1.0
 */

include_once("theme_config.php");

add_action( 'after_setup_theme', 'lebouchon_setup' ); 
 

/* helpers 
		
	SIDEBAR
	
	if ( function_exists('register_sidebar') ):
	    register_sidebar(array(

		"before_widget" => "",
		
		"after_widget" => "",
		
		"before_title" => "<h4>",
		
		"after_title" => "</h4>",
		
		"name" => "Blog Sidebar"

		));	
	endif;
	
	REGISTER A POST TYPE
	
	register_post_type( 'services',
			array(
				'labels' => array(
					'name' => __( 'Services' ),
					'singular_name' => __( 'Services' ),
					'add_new' => __( 'Add new' ),
					'add_new_item' => __( 'Add New Service' ),
					'edit' => __( 'Edit' ),
					'edit_item' => __( 'Edit Service' ),
					'new_item' => __( 'New Service' ),
					'view' => __( 'View Service' ),
					'view_item' => __( 'View Service' ),
					'search_items' => __( 'Search Services' ),
					'not_found' => __( 'No services found' ),
					'not_found_in_trash' => __( 'No services found in Trash' ),
					'parent' => __( 'Parent services' ),
				),
				'public' => true,
				'query_var' => true,
				'menu_position' => 5,
				'show_ui' => true,
				'supports' => array('title','editor','thumbnail','custom-fields','page-attributes','revisions'),
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'hierarchical' => true
			)
		);	
		
	CUSTOM TAXONOMY

	register_taxonomy( 'service_category', 'services', array( 'hierarchical' => true, 'label' => __('Service Category', 'series'), 'query_var' => 'service_category', 'rewrite' => array( 'slug' => 'service_category' ) ) );	


// =========== 
// ! The main setup for the blog  
// ===========

/**
 * Sets up the blog accordingly
 *
 * @since JT Photography 1.0
 */ 

if( ! function_exists('lebouchon_setup')){
	
	function lebouchon_setup(){	
		
		add_editor_style();
		
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 260, 200, true ); 
				
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'twentyten' ),
		) );
		
		if ( function_exists('register_sidebar') ):
		    register_sidebar(array(

			"before_widget" => "",
			
			"after_widget" => "",
			
			"before_title" => "<h4>",
			
			"after_title" => "</h4>",
			
			"name" => "Site sidebar"

			));	
		endif;		
		
	
	}

}


/**
 * Submits the landing page newsletter
 *
 * @lebouchon since 1.0
 */

if( ! function_exists('lebouchon_submit_landing') ):
	function lebouchon_submit_landing(){
		
		if(isset($_POST['submit_news'])):
		
			/* Check nonce */
			
			if(wp_verify_nonce($_POST['submit-news-action'],'submit-news')):
			
			/* Check no hidden field is submitted */
			
				if(empty($_POST['trsiteid'])):
				
					$email = trim($_POST['news_email']);
					$name = trim($_POST['news_name']);
					
					/* Validate email and name */
					
					if(checkEmail($email) && strlen($name)>=3):
					
						/* Check DB exists */
						
						global $wpdb;
						
						$table = $wpdb->prefix."newsletter_signups";
					
						if( mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$table."'"))):
								
								$wpdb->query("CREATE TABLE `$table` (
	  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	  `name` varchar(255) DEFAULT NULL,
	  `email` varchar(255) DEFAULT NULL,
	  `time` int(11) DEFAULT '0',
	  `ip` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
								
						endif;					
						
						/* Insert to DB */
						
						$wpdb->insert($table,array(
							"name" => $name,
							"email" => $email,
							"time" => time(),
							"ip" => $_SERVER['REMOTE_ADDR']
						));
						
						/* WP Mail Client Sign up */
						
						$date = date("Y-m-d H:i:s",time());
						
						$to = "enquiries@le-bouchon.co.uk";
						$subject = "New newsletter signup";
						$message = "<h1>A new person has signed up to Le Bouchon's newsletter</h3><p>Here are the details of the new signup.<br><br>Email: $email<br>Name: $name<br>time: $date<br>IP: {$_SERVER['DOCUMENT_ROOT']}<br><br>Thanks.</p>";
						
						wp_mail( $to, $subject, $message);
						
						/* Redirect to success */
						
						wp_redirect( site_url().'/success/', 301 );
					
					endif;
				
				endif;
				
			endif;
			
		endif;
		
	}
endif;


if ( ! function_exists( 'lebouchon_photography_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since JT Photography 1.0
 */
function lebouchon_photography_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'lebouchon_photography_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since JT Photography 1.0
 */
function lebouchon_photography_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">link</a>.', 'lebouchon_photography' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">link</a>.', 'lebouchon_photography' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">link</a>.', 'lebouchon_photography' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
 
if ( ! function_exists( 'checkdata' ) ) :

function checkdata($data,$type){
	if($type==1){
		if(strlen($data)>30){
			return 0;
		} elseif(ereg('[^0-9]', $data)) {
			return 0;
		} else {
			return $data;
		}
	}
	elseif($type==2){
		return addslashes(strip_tags(trim($data)));		
	}
	elseif($type==3){
		if(strlen($data)>50){
			return 0;
		}elseif (ereg('[^A-Za-z0-9]', $data)){
			return 0;
		}else{
			return $data;
		}	
	} elseif($type==4) {
		if(strlen($data)>50){
			return 0;
		}elseif (ereg('[^-A-Za-z0-9_!| ]', $data)){
			return 0;
		}else{
			return $data;
		}	
	} elseif($type==5) {
		if(strlen($data)>200){
			return 0;
		}elseif (ereg('[^-A-Za-z0-9_!| ]', $data)){
			return 0;
		}else{
			return $data;
		}	
	} elseif($type==6) {
		if(strlen($data) < 6) {
			return 0;
		} else {
			return $data;
		}
	}
}

endif;

if ( ! function_exists( ' is_tree' ) ) :
function is_tree( $pid ) {      // $pid = The ID of the page we're looking for pages underneath
    global $post;               // load details about this page

    if ( is_page($pid) )
        return true;            // we're at the page or at a sub page

    $anc = get_post_ancestors( $post->ID );
    foreach ( $anc as $ancestor ) {
        if( is_page() && $ancestor == $pid ) {
            return true;
        }
    }

    return false;  // we arn't at the page, and the page is not an ancestor
}
endif;

if ( ! function_exists( 'dimox_breadcrumbs' ) ) :
function dimox_breadcrumbs() {
 
  $delimiter = '&nbsp;&raquo;&nbsp;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  
  }
} // end dimox_breadcrumbs()
endif;

if ( ! function_exists( 'checkEmail' ) ) :

function checkEmail($email){
  return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}

endif;

if ( ! function_exists( 'isValidURL' ) ) :

function isValidURL($url) {
	return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}

endif;


if(!function_exists( 'lebouchon_update')){
	function lebouchon_update($content){
		if(is_page()){
			return $content;
		}else{
		if(!is_home()){
			/* $button = '<div style="float:right;margin-left:20px;"><a href="http://twitter.com/share" class="twitter-share-button" data-count="vertical">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>'; */
			return $content;
		}else{
			return $content;	
		}
		}
	}
}


if(!function_exists('get_link_more_posts')){
	function get_link_more_posts(){
		if($_GET['pg']){
			if(is_numeric($_GET['pg'])){
				$page = $_GET['pg'];
			}
		}else{
			$page = 1;
		}
		
		$amount = $page*4;
		$view = '#post-'.($amount+1);
		
		if($page){
			$pagi = '?pg='.($page+1);
		}
		
		$count_posts = wp_count_posts();

		$published_posts = $count_posts->publish;
		
		if($amount<$published_posts){
		
			$link = array('<a href="'.get_bloginfo('url').'/blog/'.$pagi.$view.'">More blog posts <span class="orange">&raquo;</span></a>',$amount);
		
		}else{
		
			$link = '';
			
		}
		
		return $link;
		
	}
}

if(!function_exists('lebouchon_is_odd')){
	function lebouchon_is_odd($number){
  		return $number & 1;
	}	
}

function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;
	return $args;
} // function

if(!function_exists('new_excerpt_length')){
function new_excerpt_length($length) {
	return 25;
}
}

add_filter('excerpt_length', 'new_excerpt_length'); 

add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );

add_filter('the_content', 'lebouchon_update', 8);

