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
get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="home page-content">
		<?php
	    $post = $wp_query->get_queried_object();
	    $pagename = $post->post_name;
			$child_pages = new WP_Query( array(
		    'post_type'      => 'page', // set the post type to page
		    'posts_per_page' => 1, // number of posts (pages) to show
		    'post_parent'    => $pagename, // enter the post ID of the parent page
		    'no_found_rows'  => true, // no pagination necessary so improve efficiency of loop
			));

		if ( $child_pages->have_posts() ) : while ( $child_pages->have_posts() ) : $child_pages->the_post();

			the_post();
			the_content();
		endwhile; endif;
		wp_reset_postdata();
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>