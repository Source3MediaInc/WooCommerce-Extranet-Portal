<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

get_header();
?>

<div class="container container-slim" id="search-wrapper">

		<div class="row">

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">

							<h1 class="page-title"><?php printf(
							/* translators:*/
							 esc_html__( 'Search Results for: %s', $permaslug ),
								'<span>' . get_search_query() . '</span>' ); ?></h1>

					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-files/content', 'search' );
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<p>
            No posts found from search criteria
          </p>

				<?php endif; ?>

			</main><!-- #main -->

	</div><!-- .row -->

</div><!-- Container end -->

<?php get_footer(); ?>
