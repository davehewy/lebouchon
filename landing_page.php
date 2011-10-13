<?php

/* Template Name: Landing page */

lebouchon_submit_landing(); 

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
	<div id="intro-text">Welcome to Le Bouchon Brasserie & Hotel, a grade II listed Georgian building which has recently undergone an extensive refurbishment programme restoring the building to its former glory.
	</div>

    <div id="main-text"> <a href="<?php bloginfo('stylesheet_directory'); ?>/assets/images/Le-Bouchon-menu.png" rel="lightbox"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/sample-menu.png" width="160" height="167" /></a>
    <h2>Brasserie</h2>
    <p>Our restaurant offers a blend of both French and English Cuisine, catering for 100 diners set in a relaxed and intimate environment. Enjoy a meal from either our à la carte menu in the main restaurant or a lighter meal in the courtyard bar. During the summer months enjoy a drink and a meal in our secluded walled courtyard.</p>
	</div>
    
    <div id="main-text">
    <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/brasserie-image.png" width="160" height="109" alt="Brasserie food" />
<h2>Boutique Hotel</h2>
<p>14 individually styled en-suite boutique bedrooms each with their own character. All rooms have as standard a 32" flat screen LED TV, telephone and wifi access. Here is a sample of our room rates:</p>	</div>
    
    <div id="main-text">
    <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/hotel-room-image.png" width="160" height="109" alt="Hotel accomodation" />
    <ul id="left">
    	<li>Deluxe Single – £55</li>
        <li>Deluxe Double – £65</li>
        <li>Superior Single – £75</li>
	</ul>
    
    <ul id="right">
        <li>Superior Double – £85</li>
        <li>Le Bouchon Suite – £95<br />
	    <em>(sleeps 4 – £15 extra pp)</em></li>
    </ul>
    
    <p>All room rates include complimentary continental breakfast.</p>
	</div>

    <div id="main-text">
    <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/functions-image.png" width="160" height="109" alt="Functions" />
    <h2>Functions</h2>
   	<p>Le Bouchon is available for your very own private or corporate function. Enjoy full use of all bar and restaurant facilities reserved exclusively for you and your guests together with overnight use of the 14 en-suite bedrooms.</p>
    </div>
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