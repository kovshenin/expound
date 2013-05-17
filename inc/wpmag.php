<?php
/**
 * WP Magazine extras
 */
add_filter( 'shortcode_atts_caption', 'wpmag_shortcode_atts_caption' );
function wpmag_shortcode_atts_caption( $attr ) {
	global $content_width;

	if ( isset( $attr['width'] ) && $attr['width'] < $content_width )
		$attr['width'] -= 4;

	return $attr;
}

add_action( 'mag_navigation_after', 'wpmag_navigation_after' );
function wpmag_navigation_after() {
	?>
	<ul class="social">
		<li class="twitter"><a target="_blank" href="http://twitter.com/wpmagru">Twitter</a></li>
		<li class="facebook"><a target="_blank" href="http://facebook.com/wpmagru">Facebook</a></li>
		<li class="feed"><a target="_blank" href="http://wpmag.ru/feed/">Feed</a></li>
		<li class="vkontakte"><a target="_blank" href="http://vk.com/wpmag">Vkontakte</a></li>
		<!--<li class="google-plus"><a target="_blank" href="https://plus.google.com/108553372817411783434/posts">Google+</a></li>-->
	</ul>
	<?php
}

add_filter( 'mag_credits_text', 'wpmag_credits_text' );
function wpmag_credits_text( $text ) {
	return '&copy; ' . date( 'Y' ) . ' Копирование материалов без разрешения автора запрещено. WordPress и WordCamp являются зарегистрированными торговыми марками и принадлежат фонду <a href="http://wordpressfoundation.org">WordPress Foundation</a>. Читайте правила использования торговых марок. Работает на <a href="http://wordpress.org">WordPress</a>.';
}