<?php
/**
 * Testing functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Testing
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function testing_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Testing, use a find and replace
		* to change 'testing' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'testing', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

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
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'testing' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'testing_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'testing_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function testing_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'testing_content_width', 640 );
}
add_action( 'after_setup_theme', 'testing_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function testing_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'testing' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'testing' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'testing_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function testing_scripts() {
	wp_enqueue_style( 'testing-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'testing-style', 'rtl', 'replace' );

	wp_enqueue_script( 'testing-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'testing_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


// *********************** NEW ADD ***********************/

// DISABLE GUTENBERG ::
add_filter('use_block_editor_for_post', '__return_false', 10);

// OPTIONS PAGE ::
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}


// CUSTOM ENDPOINT ::

add_action( 'rest_api_init', function () {
	register_rest_route( '/custom/v2', '/home-page/',
		array( 'methods' => 'GET', 'callback' => 'homeData' )
	);
});

function homeData(){

	$data = array();

	// BRAND LOGO ::
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	$data['logo']['url'] = $image[0];

	// HEADER DATA ::
	$variable = get_field("items_header", "option"); 
	foreach($variable as $key => $item) :
		$data['header'][$key]['text'] = $item['text'];
	endforeach;

	// FOOTER DATA ::
	$variable = get_field("items_footer", "option"); 
	$data['footer']['instagram'] = $variable['instagram'];
	$data['footer']['email'] = $variable['email'];
	$data['footer']['country'] = $variable['country'];
	$data['footer']['terms'] = $variable['terms'];
	foreach($variable['phones'] as $key => $item) :
		$data['footer']['phones'][$key]['languague'] = $item['languague'];
		$data['footer']['phones'][$key]['number'] = $item['number'];
	endforeach;

	// ADD MENU DATA ::
	$menuLocations = get_nav_menu_locations(); 
	$menuID = $menuLocations['menu-1'];
	$primaryNav = wp_get_nav_menu_items($menuID);
	foreach($primaryNav as $key => $item):
		$data['menu'][$key]['title'] = $item->title;
	endforeach;

	// DATA PAGE HOME ::
	$args = array('page_id' => '23');
	$query = new WP_Query($args);
	while ( $query->have_posts() ) : $query->the_post();
		$repeater = get_field('item');
		foreach ($repeater as $key => $row) :
			$data['data']['acf'][$key]['image'] = $row['content_group']['image']['url'];
			$data['data']['acf'][$key]['title'] = $row['content_group']['title'];
			$data['data']['acf'][$key]['description'] = $row['content_group']['description'];
		endforeach;
	endwhile;

	return $data;
} 