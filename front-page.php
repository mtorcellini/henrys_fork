<?php
/**
 * The template for displaying the front page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package henrys_fork
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'henrys_fork' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php the_custom_logo(); ?>
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        
      <nav id="site-navigation" class="main-navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
          <?php //esc_html_e( 'Primary Menu', 'henrys_fork' ); ?> 
          <div class="burgerDiv"></div>
          <div class="burgerDiv"></div>
          <div class="burgerDiv"></div>
        </button>
        <?php
        wp_nav_menu(
          array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
          )
        );
        ?>
      </nav>

    <?php
			$henrys_fork_description = get_bloginfo( 'description', 'display' );
			if ( $henrys_fork_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $henrys_fork_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
    </div><!-- .site-branding -->
    
    <?php 
    if (is_active_sidebar('sidebar-top')) {
      dynamic_sidebar('sidebar-top');
    }
    ?>

	</header><!-- #masthead -->


	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
      the_post();
      // Remove standard template for pages
      // get_template_part( 'template-parts/content', 'page' );
      ?>

      <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
          array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'henrys_fork' ),
            'after'  => '</div>',
          )
        );
        ?>
      </div><!-- .entry-content -->



      <?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
