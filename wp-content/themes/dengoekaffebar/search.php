<?php
/**
 * Template for displaying Search Results pages
 *
 * @package Bootstrap Canvas WP
 * @since Bootstrap Canvas WP 1.0
 */

	get_header(); ?>

      <div class="row">

        <div class="col-sm-12 blog-main">

          <h1><?php printf( __( 'Search Results for: %s', 'bootstrapcanvaswp' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		  <hr />
		  <?php get_template_part( 'loop', 'search' ); ?>

        </div><!-- /.blog-main -->

      </div><!-- /.row -->
      
	<?php get_footer(); ?>