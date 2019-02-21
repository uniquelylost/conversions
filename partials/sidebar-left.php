<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package conversions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'left-sidebar' ) ) {
	return;
}

// which sidebar is selected?
$sidebar_pos = get_theme_mod( 'conversions_sidebar_position' );
?>

<?php 
	if ( 'left' === $sidebar_pos ) { ?>
		<div class="col-md-4 col-xl-3 widget-area" id="left-sidebar" role="complementary">
	<?php } 
?>
<?php dynamic_sidebar( 'left-sidebar' ); ?>

</div><!-- #left-sidebar -->
