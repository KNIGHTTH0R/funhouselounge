<?php
/*
Template Name: Event List
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="main-wrap full-width" role="main">
	
	

	<?php do_action( 'foundationpress_before_content' ); ?>
	
	<div class="row">
		<div class="small-12 columns">
			
			<h2>Upcoming Events</h2>
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
	
			foreach ( $posts as $post ) : setup_postdata( $post ); ?>
			
			<div class="fh-event-list-item row">
				<div class="small-12 medium-3 columns">
					<img src="<?php the_field('poster_image'); ?>" alt="<?php the_title(); ?>">
				</div>
				
				<div class="small-12 medium-9 columns">
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
					<h4><?php the_field('subtitle'); ?></h4>
					<p><?php the_field('show_dates'); ?></p> 
				</div>
				
			</div>
			<?php endforeach; 
			wp_reset_postdata();?>
			
			
			<h2>Weekly Shows</h2>
			
			<?php 
			
			$args = array (
			    'post_type' => 'post',
			    'category_name' => 'Ongoing',
			);
			
			// get posts
			$posts = get_posts($args);
	
			foreach ( $posts as $post ) : setup_postdata( $post ); ?>
			
			<div class="fh-event-list-item row">
				<div class="small-12 medium-3 columns">
					<img src="<?php the_field('featured_image'); ?>" alt="<?php the_title(); ?>">
				</div>
				
				<div class="small-12 medium-9 columns">
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
					<h4><?php the_field('recurring'); ?></h4>
				</div>
				
			</div>
			<?php endforeach; 
			wp_reset_postdata();?>
		</div>
	</div>
	
	<?php do_action( 'foundationpress_after_content' ); ?>
	

</div>

<?php get_footer();
