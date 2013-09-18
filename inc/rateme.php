<?php
/**
 * A non-disruptive admin nag to rate the theme on WordPress.org
 *
 * @package Expound
 */

// Don't nag users who can't switch themes.
if ( ! is_admin() || ! current_user_can( 'switch_themes' ) )
	return;

function expound_rateme_admin_notice() {
	if ( isset( $_GET['expound-rateme-dismiss'] ) )
		set_theme_mod( 'rateme-dismiss', true );

	$dismiss = get_theme_mod( 'rateme-dismiss', false );
	if ( $dismiss )
		return;
	?>
	<div class="updated expound-rateme">
		<p><?php printf( __( 'Thank you for using Expound! If you like the theme, please consider giving it a <a target="_blank" href="%s">high rating on WordPress.org</a>. Thank you! <a href="%s">(hide this message)</a>', 'expound' ), 'http://wordpress.org/themes/expound', add_query_arg( 'expound-rateme-dismiss', 1 ) ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'expound_rateme_admin_notice' );