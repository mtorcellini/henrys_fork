<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package henrys_fork
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				
        // get_template_part( 'template-parts/content', get_post_type() );

        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header class="entry-header">
            <?php
            if ( is_singular() ) :
              the_title( '<h1 class="entry-title">', '</h1>' );
            else :
              the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            endif;

            if ( 'post' === get_post_type() ) :
              ?>
              <div class="entry-meta">
                <?php
                henrys_fork_posted_on();
                // henrys_fork_posted_by();
                ?>
              </div><!-- .entry-meta -->
            <?php endif; ?>
          </header><!-- .entry-header -->

          <?php henrys_fork_post_thumbnail(); ?>

          <div class="entry-content">

              <figure class="archive-image">
                <img src="<?php echo get_first_image(get_the_id()); ?>" alt="post image" />
              </figure>


            <?php


            the_excerpt(
              sprintf(
                wp_kses(
                  /* translators: %s: Name of current post. Only visible to screen readers */
                  __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'henrys_fork' ),
                  array(
                    'span' => array(
                    'class' => array(),
                    ),
                  )
                ),
                wp_kses_post(get_the_title())
              )
            );

            // the_content(
            //   sprintf(
            //     wp_kses(
            //       /* translators: %s: Name of current post. Only visible to screen readers */
            //       __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'henrys_fork' ),
            //       array(
            //         'span' => array(
            //           'class' => array(),
            //         ),
            //       )
            //     ),
            //     wp_kses_post( get_the_title() )
            //   )
            // );

            wp_link_pages(
              array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'henrys_fork' ),
                'after'  => '</div>',
              )
            );
            ?>
          </div><!-- .entry-content -->

          <footer class="entry-footer">
            <?php henrys_fork_entry_footer(); ?>
          </footer><!-- .entry-footer -->
        </article><!-- #post-<?php the_ID(); ?> -->



<?php

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
