<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>



<div class="main-wrap full-width" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
		<header>
			<h1 class="fh-event-title"><?php the_title(); ?></h1>
		</header>
		<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
		
		
		<?php if( in_category( 'Event' ) ): ?>
		   	<div class="row fh-event">
			
				<div class="small-12 large-8 columns">
					
					
					<h2><?php the_field('subtitle'); ?></h2>
					
					<?php the_content(); ?>
					
					<hr>
					
					<?php
					
					if(get_field('director'))
					{
						echo '<h3>Directed by: ' . get_field('director') . '</h3>';
					}
					
					if(get_field('featuring'))
					{
						echo '<h3>Featuring: ' . get_field('featuring') . '</h3>';
					}
					
					if(get_field('music'))
					{
						echo '<h3>Music by: ' . get_field('music') . '</h3>';
					}
					?>
	
					
				</div>
				
				<div class="small-12 large-4 columns">
					<img src="<?php the_field('poster_image'); ?>">
					
					
					
					
					<?php 
						$today = date('Ymd');
						
						if ( get_field( 'expiration_date' ) >= $today ): ?>
					
					
					

					<a class="fh-events-button button" href="<?php the_field('ticket_url'); ?>">Get Tickets</a>
					
					<?php else: // field_name returned false ?>
					
					
					<?php endif; // end of if field_name logic ?>
					
					
				</div>
		
			</div>
		<?php endif; ?>
		
		<?php if( in_category( 'Ongoing' ) ): ?>
		
			<div class="row fh-ongoing">
				
				<div class="small-12 columns">
					
					<h2><?php the_field('recurring'); ?></h2>
					
					
					<?php the_content(); ?>
					<?php
					
					if(get_field('hosted_by'))
					{
						echo '<h3>Hosted by: ' . get_field('hosted_by') . '</h3>';
					}
					?>
					
					<div class="fh-ongoing-image">
						<img src="<?php the_field('featured_image'); ?>">

					</div>
					
					
				</div>
				
			</div>
		
		<?php endif; ?>
		
		

		
	</article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>
</div>
<?php get_footer();
