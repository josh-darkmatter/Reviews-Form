<?php

/* ---------- Custom Reviews - JP ---------- */
// Custom Reviews Form
function reviews_form($attr, $content) {
	ob_start();
	get_template_part( 'includes/reviews', 'form' );
	return ob_get_clean();
}
add_shortcode( 'reviews-form', 'reviews_form' );

// Localize ACF reviews field 
add_action ('wp_enqueue_scripts','wpse244551_add_field');
function wpse244551_add_field() {
  $my_field = array ();
  $my_field[] = array (field1 => get_field ('stars'));
  wp_localize_script ('darkmatter-josh', 'MyFields', $my_field);
  }
  
// Single Review Redirect 
 
add_action( 'template_redirect', 'darkmatter_redirect_post' );

function darkmatter_redirect_post() {
  $queried_post_type = get_query_var('post_type');
  if ( is_single() && 'review' ==  $queried_post_type ) {
    wp_redirect( home_url(), 301 );
    exit;
  }
}  

// Load Ajax and Isotope functions 
require_once get_stylesheet_directory() . '/includes/custom-functions/isotope-ajax-loadmore.php';  


add_action('acf/save_post', 'my_save_post');

function my_save_post( $post_id ) {
		
	# vars
	$post = get_post( $post_id );	
	
  $emails = "all emails seperated by comma"; 
  $title = wp_strip_all_tags(get_the_title($post_id));
  $url = get_edit_post_link($post_id);
  $link = get_permalink($post_id);
  $stars = get_field('stars', $post_id);
  $review = get_field('review', $post_id);
	
	# email data
  $message = "This review needs to be approved and published or deleted. \nLink to reviews:  https://your-url/wp-admin/edit.php?post_type=review \nName: {$title} \nStars: {$stars} \nReview Content: {$review}";
  if(get_post_type($post_id) === 'review') {
    wp_mail($emails, "A new review has been submitted", $message);
  }	
}


/* ---------- End custom reviews ---------- */
