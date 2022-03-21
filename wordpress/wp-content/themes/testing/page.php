<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Testing
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( is_front_page() ) : ?>
			<section class="contents">
				<div class="imgsParallax">
					<?php
						while ( have_posts() ) : the_post();

							if( have_rows('item') ):

							$repeater = get_field('item');

							foreach ($repeater as $key => $row) :

								$image = $row['content_group']['image']['url'];
								?>
									<div class="m<?= $key; ?>">
										<img src="<?= $image; ?>" alt="">
									</div>

								<?php endforeach;

							endif;

						endwhile; // End of the loop.
					?>
				</div>
			</section>
		<?php else : 
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		endif; 
		?>

	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();
