<?php
#------------------------------------------------------------------------------#
# Ajax Functions
# Developer: Darkmatter Development - JP
# Requires: js/ajax-load-more.js - l1 -  4.5.16.f1
#------------------------------------------------------------------------------#
add_action( 'wp_enqueue_scripts', 'add_javascript');
function add_javascript() {
	wp_enqueue_script('mft_ajax', get_stylesheet_directory_uri() . '/js/ajax-load-more.js' );
	wp_localize_script('mft_ajax', 'mft_load_more_ajax', array(
		'ajaxurl' =>admin_url('admin-ajax.php'),
	));
}

function mft_load_more_ajax() {

	$ppp     = (isset($_POST['ppp'])) ? $_POST['ppp'] : 10;
	$offset  = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
	
	$args = array(
		'post_type'      => 'review',
		'posts_per_page' => $ppp,
		'offset'          => $offset,
	);
	
	$post_list = array();
	$i = 0;
	$u = 9;
	$the_query = new WP_Query ( $args );
	
if ( $the_query->have_posts() ) {
while ( $the_query->have_posts() ) {
$the_query->the_post(); 
ob_start();
$stars = get_field('stars');
$review = get_field('review');
$author = get_the_title();
$names = str_split($author);			
?>
<div class="review-single"><div class="review-single-inner">
  <div class="review-author-info">
  <div class="review-author"><?php if (get_the_title() != null) { echo get_the_title(); } else { echo 'Guest'; } ?></div></div>
  <span class="review-stars"><?php if($stars == 1) { echo '<i class="fas fa-star"></i>';} else if ($stars == 2){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i>';} else if ($stars == 3){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';} else if ($stars == 4){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';} else if ($stars == 5){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';} ?></span><span class="review-date"><?php echo get_the_date(); ?></span>
    <div class="review-content"><p><?php echo $review; ?></p></div>
  <div class="right-wrap">
			
			<?php
			$post_list[$i] = ob_get_clean();
			$i++;
		}
		
		echo json_encode($post_list);
		
	} else {
		// no posts found
	}

	die();
}

add_action( 'wp_ajax_mft_load_more_ajax', 'mft_load_more_ajax' );
add_action( 'wp_ajax_nopriv_mft_load_more_ajax', 'mft_load_more_ajax' );