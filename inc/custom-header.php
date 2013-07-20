<?php
/**
 * Custom Header
 */

function expound_custom_header_setup() {
	/**
	 * Custom Header support
	 */
	add_theme_support( 'custom-header', array(
		'default-text-color'     => '3a3a3a',
		'width'                  => 1020,
        'height'                 => 154,
        'flex-height'            => true,
        'wp-head-callback'       => 'expound_header_style',
        'admin-head-callback'    => 'expound_admin_header_style',
	) );
}
add_action( 'after_setup_theme', 'expound_custom_header_setup' );

if ( ! function_exists( 'expound_admin_header_style' ) ) :
function expound_admin_header_style() {
	?>
	<style type="text/css">
	#headimg {
		background-position: 50% 0;
	}
	#headimg h1 {
		margin-top: 50px;
		margin-left: 40px;
		margin-bottom: 0;
		margin-right: 40px;
		font-size: 34px;
		line-height: 34px;
		font-family: Georgia, "Times New Roman", serif;
		font-weight: 300;
	}
	#headimg h1 a {
		text-decoration: none;
		color: #3a3a3a;
		display: block;
	}
	#headimg h1 a:hover {
		color: #117bb8;
	}
	#headimg #desc {
		font: 13px/20px "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-weight: 300;
		color: #878787;
		margin-left: 40px;
	}
	</style>
	<?php
}
endif;

if ( ! function_exists( 'expound_header_style' ) ) :
function expound_header_style() {
	$color = get_header_textcolor();
	$default_color = get_theme_support( 'custom-header', 'default-text-color' );
	$header_image = get_header_image();

			/*<?php if ( ! empty( $header_image ) ) : ?>
				<a class="expound-custom-header" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
				</a>
			<?php endif; ?>*/

	if ( $color == $default_color && empty( $header_image ) )
		return;
	?>
	<style type="text/css">
	<?php if ( 'blank' == $color ) : ?>
		.site-title,
        .site-description {
            position: absolute !important;
            clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
            clip: rect(1px, 1px, 1px, 1px);
        }

        <?php if ( empty( $header_image ) ) : // blank *and* no header image ?>
			.site-header .site-branding {
				min-height: 0;
				height: 0;
				height: 0;
			}
        <?php endif; ?>

	<?php else : // not blank ?>
        .site-title a,
        .site-title a:hover,
        .site-description {
			color: #<?php echo $color; ?>;
        }
	<?php endif; ?>

	<?php if ( ! empty( $header_image ) ) : ?>
		.site-header .site-branding {
			background-color: transparent;
			background-image: url('<?php echo esc_url( $header_image ); ?>');
			background-position: 50% 0;
			background-repeat: no-repeat;
			height: <?php echo absint( get_custom_header()->height ); ?>px;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;