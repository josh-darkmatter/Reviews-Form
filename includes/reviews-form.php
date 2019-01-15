<?php 
acf_form_head();
?>

 <?php 
global $post;

$args = array(
'post_type'  => 'review',
'posts_per_page' => '10',
);
$count_reviews = wp_count_posts('review');
$total_reviews = $count_reviews->publish;
$the_query = new WP_Query( $args );
?>
<div class="reviews-loop"><div class="reviews-loop-inner">
<div class="reviews-top"><div class="reviews-title"><h3>Reviews Title</h3></div></div>
<div class="reviews-bottom">
<div class="rev-form-top"><div class="reviews-count"><div class="stars-count"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div><div class="review-number"><?php echo $total_reviews; ?></div><div class="count-text"><p>Reviews</p></div></div><div class="reviews-request"><a href="javascript:void(0)" class="rev-write-trigger">Write a Review</a></div><div class="clearfix"></div></div>

<div class="form-holder"><div class="thanks"><div class="thanks-inner"><div><h3>Thanks for the review!</h3></div><div><a class="thanks-close" href="javascript:void(0);">Close</a></div></div></div><div class="reviews-form">
<div class="popup-close"><i class="fa fa-times" aria-hidden="true"></i></div>  

<?php
	acf_form(array(
  	'field_groups' => array('field group ID'),
		'post_id'		=> 'new_post',
		'post_title'	=> true,
		'new_post'		=> array(
			'post_type'		=> 'review',
			'post_status'	=> 'pending',
		),
		'submit_value'	=> 'Submit Review',		
	));
	
	?>
	
</div>
</div>  
<div class="reviews-holder">  
  <?php  
 if ($the_query->have_posts() ) : 
while ( $the_query->have_posts() ) : 
$the_query->the_post(); 
$stars = get_field('stars');
$review = get_field('review');
$author = get_the_title();
$names = str_split($author);
?> 
<div class="review-single"><div class="review-single-inner">
  <div class="review-author-info">
  <div class="review-author"><?php if (get_the_title() != null) { echo get_the_title(); } else { echo 'Guest'; } ?></div></div>
  <span class="review-stars"><?php if($stars == 1) { echo '<i class="fas fa-star"></i>';} else if ($stars == 2){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i>';} else if ($stars == 3){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';} else if ($stars == 4){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';} else if ($stars == 5){ echo  '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';} ?></span><span class="review-date"><?php echo get_the_date(); ?></span>
  <!--  <div class="review-title"><h4><?php echo the_title(); ?></h4></div> -->
    <div class="review-content"><p><?php echo $review; ?></p></div>
  <div class="right-wrap"> 
<?php endwhile; wp_reset_postdata(); ?>
</div>
		<button class="load-more-posts button" data-nonce="<?php echo wp_create_nonce('mft_load_more_ajax'); ?>">Load More Reviews</button>


<?php endif; ?>

</div></div></div> <!-- /.reviews-loop --> 

