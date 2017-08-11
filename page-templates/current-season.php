<?php
/*
Template Name: Current Season
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="main-wrap full-width" role="main">
	
	

	<?php do_action( 'foundationpress_before_content' ); ?>
	
	 <?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			
			<?php 
				
			$thisyear = date('Y');
			
			$args = array (
			    'post_type' => 'post',
			    'posts_per_page'	=> -1,
			    'category_name' => 'Event',
			    'orderby'	=> 'start_date',
			    'order' => 'ASC',
			    'meta_query' => array(
				     array(
				        'key'		=> 'start_date',
				        'compare'	=> '>=',
				        'value'		=> $thisyear,
				    )
			    ),
			);
			
			
			
						
			 
		          
			
			
			// get posts
			$posts = get_posts($args);
	
			foreach ( $posts as $post ) : setup_postdata( $post ); 
			
			$startdate = new DateTime(get_field('start_date'));
			$enddate = new DateTime(get_field('end_date'));
			?>
			
			
			
			<div class="fh-event-list-item row">
				<div class="small-12 medium-3 columns">
					<img src="<?php the_field('poster_image'); ?>" alt="<?php the_title(); ?>">
				</div>
				
				<div class="small-12 medium-9 columns">
					<a href="<?php the_permalink(); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
					<h4><?php echo $startdate->format('F d'); ?> - <?php echo $enddate->format('F d'); ?></h4>
					<p><?php the_field('subtitle'); ?></p> 
				</div>
				
			</div>
			<?php endforeach; 
				wp_reset_postdata(); 
			?>

			
		</article>
	 <?php endwhile;?>
	
	<?php do_action( 'foundationpress_after_content' ); ?>
	

</div>

<?php get_footer();
