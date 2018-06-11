<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package DalleniusVoltaire
 */
$imgDir = get_stylesheet_directory_uri() . '/img';

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<a href="<?php echo get_permalink(8); ?>">
				<img
						srcset="<?php echo $imgDir; ?>/logo-large.png  1920w,
						        <?php echo $imgDir; ?>/logo-medium.png  960w,
						        <?php echo $imgDir; ?>/logo-small.png   480w"
						src="<?php echo $imgDir; ?>/logo-standard.png">
			</a>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
