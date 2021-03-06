<?php
/**
 * Partial template for content in page.php
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php do_action( 'conversions_page_before_content' ); ?>

	<header class="entry-header">

		<?php
		if ( ! has_post_thumbnail() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		}
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'conversions' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'conversions' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

	<?php do_action( 'conversions_page_after_content' ); ?>

</article><!-- #post-## -->
