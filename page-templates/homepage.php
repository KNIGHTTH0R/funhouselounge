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
		    'meta_query' => array(
				array(
			        'key'		=> 'publish_date',
			        'compare'	=> '<=',
			        'value'		=> $today,
			    ),
			     array(
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
					<p><?php echo $startdate->format('F d'); ?> - <?php echo $enddate->format('F d'); ?></p> 
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
	
	<!--<h2>Upcoming Shows</h2>
	
	<div class="row expanded fh-home-callouts">

		
		<?php 
		$today = date('Ymd');
		
		$args = array (
		    'post_type' => 'post',
		    'category_name' => 'Event',
		    'order' => 'ASC',
		    'meta_query' => array(
			     array(
			        'key'		=> 'publish_date',
			        'compare'	=> '>=',
			        'value'		=> $today,
			    )
		    ),
		);
		
		// get posts
		$posts = get_posts($args);

		foreach ( $posts as $post ) : setup_postdata( $post ); ?>
			
		
		<div class="small-12 large-4 columns">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php the_field('homepage_image'); ?>" alt="<?php the_title(); ?>">
				<span>More Information</span>
			</a>
			<div class="fh-home-callout-description">
				<h3><?php the_title(); ?></h3>
				<h4><?php the_field('subtitle'); ?></h4>
			</div>
			
		</div>
		<?php endforeach; 
		wp_reset_postdata();?>
		
	
	</div>-->
	
	<div class="row expanded">
		<div class="small-12 large-6 columns">
			<h2>Schedule of Events</h2>

			<?php
			    // query for the about page
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
			<h2>Purchase Tickets</h2>
			<div style="width:100%; text-align:left;"><iframe src="//eventbrite.com/tickets-external?eid=35439378134&ref=etckt" frameborder="0" height="1400" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe><div style="font-family:Helvetica, Arial; font-size:12px; padding:10px 0 5px; margin:2px; width:100%; text-align:left;" ><a class="powered-by-eb" style="color: #ADB0B6; text-decoration: none;" target="_blank" href="http://www.eventbrite.com/">Powered by Eventbrite</a></div></div>
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
		slidesToShow: 3,
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

