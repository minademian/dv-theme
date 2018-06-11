<?php
/**
 * dv functions and definitions
 *
 * @package DalleniusVoltaire
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 780; /* pixels */
}

if ( ! function_exists( 'dv_content_width' ) ) :

function dv_content_width() {
	global $content_width;

	if ( is_singular( 'post' ) ) {
		$content_width = 490;
	}
}
add_action( 'template_redirect', 'dv_content_width' );

endif;

if ( ! function_exists( 'dv_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dv_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on dv, use a find and replace
	 * to change 'dv' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'dv', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_editor_style( array( 'editor-style.css', dv_fonts_url() ) );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'dv-blog-thumbnail', 200, 133, true );
	add_image_size( 'dv-single-thumbnail', 660 );
	add_image_size( 'dv-project-thumbnail', 310, 250, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'dv' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dv_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // dv_setup
add_action( 'after_setup_theme', 'dv_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function dv_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer One', 'dv' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Use this widget area to display widgets in the first column of the footer.', 'dv' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Two', 'dv' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Use this widget area to display widgets in the second column of the footer.', 'dv' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Three', 'dv' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Use this widget area to display widgets in the third column of the footer.', 'dv' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'dv_widgets_init' );

/**
 * Register Google Fonts
 */
function dv_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Cabin
	 font: on or off', 'dv' ) ) {
		$fonts[] = 'Cabin:500,700,500italic,700italic';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Alegreya font: on or off', 'dv' ) ) {
		$fonts[] = 'Alegreya:400,700,400italic,700italic';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'dv' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function dv_scripts() {
	wp_enqueue_style( 'dv-style', get_stylesheet_uri() );

	wp_enqueue_style( 'dv-fonts', dv_fonts_url(), array(), null );

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	wp_enqueue_script( 'dv-js', get_template_directory_uri() . '/js/dv.js', array( 'jquery' ), '20150326', true );

	wp_enqueue_script( 'dv-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'dv-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( 'jetpack-portfolio' == get_post_type() && dv_get_gallery() ) {
		wp_enqueue_style( 'dv-slick-css', get_template_directory_uri() . '/js/slick/slick.css' );
		wp_enqueue_script( 'dv-slick-js', get_template_directory_uri() . '/js/slick/slick.js', array( 'jquery' ), '1.4.1', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dv_scripts' );

function dv_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'dv_excerpt_length', 999 );

/**
 * Add 'Read more' link to excerpts
 */
function dv_excerpt_more( $excerpt ) {
	return '&hellip; <a class="read-more" href="'. esc_url( get_permalink() ) . '">' . sprintf( wp_kses_post( __( 'Read more <span class="screen-reader-text">%1$s</span>', 'dv' ) ), esc_attr( strip_tags( get_the_title() ) ) ) . '</a>';
}
add_filter( 'excerpt_more', 'dv_excerpt_more' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/plugin-enhancements.php';