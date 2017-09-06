<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
				

<?php
/*
Template Name: Home
*/
get_header(); ?>


	<div id="loadingLogo">
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.jpg" alt="Funhouse Lounge">
	</div>


<?php do_action( 'foundationpress_before_content' ); ?>
<section class="fh-home-content">
	<h2>Featured Shows</h2>
	
	<div class="row expanded fh-home-callouts">
		
		<?php 
			
		$today = date('Ymd');
		
		$args = array (
		    'post_type' => 'post',
		    'category_name' => 'Event',
		    'order' => 'ASC',
'posts_per_page' => 3,
'orderby' => 'start_date',
		    'meta_query' => array (
				
			     array (
			        'key'		=> 'expiration_date',
			        'compare'	=> '>=',
			        'value'		=> $today,
			    )
		    ),
		);
		
		// get posts
		$posts = get_posts($args);
		foreach ( $posts as $post ) : setup_postdata( $post ); 
		$startdate = new DateTime(get_field('start_date'));
		$enddate = new DateTime(get_field('end_date'));
		
		?>
		
		<div class="small-12 large-4 columns">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php the_field('homepage_image'); ?>" alt="<?php the_title(); ?>">
				<span>Info and Tickets</span>
				<div class="fh-home-callout-description">
					<h3><?php the_title(); ?></h3>
					<h4><?php the_field('subtitle'); ?></h4>

<?php 
if ( get_field( 'start_date' ) == get_field( 'end_date' ) ): ?>

<p><?php echo $enddate->format('F d'); ?></p> 
					
<?php else: // field_name returned false ?>
<p><?php echo $startdate->format('F d'); ?> - <?php echo $enddate->format('F d'); ?></p> 					
					
<?php endif; // end of if field_name logic ?>


				</div>
			</a>
			
			
		</div>
		<?php endforeach; 
		wp_reset_postdata();?>
		
		
	
	</div>
	
	<h2>Weekly and Monthly Shows</h2>
	
	<div class="row expanded">
		<div class="small-12 columns">
			<div class="fh-home-slider">
				
				<?php 
			
				
				$args = array (
				    'post_type' => 'post',
				    'category_name' => 'Ongoing',
				    
				);
				
				// get posts
				$posts = get_posts($args);
		
				foreach ( $posts as $post ) : setup_postdata( $post ); 
				
				?>
				
					<a href="<?php the_permalink(); ?>">
						<img src="<?php the_field('featured_image'); ?>" alt="<?php the_title(); ?>">
						
					</a>
				<?php endforeach; 
				wp_reset_postdata();?>
				
				
			</div>
		</div>
	</div>

	
	<div class="row expanded">
		<div class="small-12 large-6 columns">
			<h2>Schedule of Events</h2>

			<?php
			    // query for the calendar page
			    $your_query = new WP_Query( 'pagename=calendar' );
			    // "loop" through query (even though it's just one page) 
			    while ( $your_query->have_posts() ) : $your_query->the_post();
			        the_content();
			    endwhile;
			    // reset post data (important!)
			    wp_reset_postdata();
			?>

		</div>
		<div class="small-12 large-6 columns">
			<h2>Sign up for our newsletter</h2>
			<p>Show announcements, special ticket deals, and more!</p>

			<?php
			    // query for the calendar page
			    $your_query = new WP_Query( 'pagename=newsletter' );
			    // "loop" through query (even though it's just one page) 
			    while ( $your_query->have_posts() ) : $your_query->the_post();
			        the_content();
			    endwhile;
			    // reset post data (important!)
			    wp_reset_postdata();
			?>

			
		</div>
	</div>
	

	

	
</section>



<?php do_action( 'foundationpress_after_content' ); ?>

<script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
<script>
		
		
	$(document).ready(function(){
		$('#loadingLogo').fadeOut('slow');
		
	  $('.fh-home-slider').slick({
	    centerMode: true,
	    centerPadding: 0,
		slidesToShow: 4,
		infinite: true,
		responsive: [
			{
		      breakpoint: 600,
		      settings: {
			      slidesToShow: 1
			    }
		    }
		]
		});
	    
	});
	
    
	</script>



<?php get_footer();
