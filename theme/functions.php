<?php
/**
 * WPBaseStarter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WPBaseStarter
 */

if ( ! defined( 'WPBASESTARTER_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( 'WPBASESTARTER_VERSION', '0.1.0' );
}

if ( ! defined( 'WPBASESTARTER_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `wpbasestarter_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'WPBASESTARTER_TYPOGRAPHY_CLASSES',
		'prose-neutral max-w-none prose-a:text-primary'
	);
}

if ( ! function_exists( 'wpbasestarter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wpbasestarter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WPBaseStarter, use a find and replace
		 * to change 'wpbasestarter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wpbasestarter', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'wpbasestarter' ),
				'menu-2' => __( 'Footer Menu', 'wpbasestarter' ),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );
		add_editor_style( 'style-editor-extra.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', 'wpbasestarter_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wpbasestarter_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', 'wpbasestarter' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'wpbasestarter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wpbasestarter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wpbasestarter_scripts() {
	wp_enqueue_style( 'wpbasestarter-style', get_stylesheet_uri(), array(), WPBASESTARTER_VERSION );
	wp_enqueue_script( 'wpbasestarter-script', get_template_directory_uri() . '/js/script.min.js', array(), WPBASESTARTER_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpbasestarter_scripts' );

/**
 * Enqueue the block editor script.
 */
function wpbasestarter_enqueue_block_editor_script() {
	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		wp_enqueue_script(
			'wpbasestarter-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			WPBASESTARTER_VERSION,
			true
		);
		wp_add_inline_script( 'wpbasestarter-editor', "tailwindTypographyClasses = '" . esc_attr( WPBASESTARTER_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', 'wpbasestarter_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function wpbasestarter_tinymce_add_class( $settings ) {
	$settings['body_class'] = WPBASESTARTER_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'wpbasestarter_tinymce_add_class' );

/**
 * Limit the block editor to heading levels supported by Tailwind Typography.
 *
 * @param array  $args Array of arguments for registering a block type.
 * @param string $block_type Block type name including namespace.
 * @return array
 */
function wpbasestarter_modify_heading_levels( $args, $block_type ) {
	if ( 'core/heading' !== $block_type ) {
		return $args;
	}

	// Remove <h1>, <h5> and <h6>.
	$args['attributes']['levelOptions']['default'] = array( 2, 3, 4 );

	return $args;
}
add_filter( 'register_block_type_args', 'wpbasestarter_modify_heading_levels', 10, 2 );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Register custom gutenberg block without external plugin
 */
function wpbasestarter_register_demo_block() {
    register_block_type( get_template_directory() . '/blocks/demo-blok' );
}
add_action( 'init', 'wpbasestarter_register_demo_block' );

/**
 * Register custom gutenberg block meta
 */
function wpbasestarter_register_meta() {
    register_post_meta('post', 'demo_block_content', [
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
    ]);
}
add_action('init', 'wpbasestarter_register_meta');

/**
 * Set custom endpoint
 */
add_action('rest_api_init', function () {
    register_rest_route('wpbasestarter/v1', '/demo-block/(?P<id>\d+)', [
        'methods'             => 'GET',
        'callback'            => function($request) {
            $post_id = $request['id'];
            $content = get_post_meta($post_id, 'demo_block_content', true);
            return rest_ensure_response(['content' => $content]);
        },
        'permission_callback' => '__return_true',
    ]);
});
/**
 * Set excerpt max length
 */
function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Set custom breadcrumbs
 */
function custom_breadcrumbs() {
    $separator = ' &raquo; ';

    echo '<nav class="breadcrumbs">';
    if ( !is_front_page() ) {
        echo '<a href="' . home_url() . '">Strona główna</a>';
        echo $separator;
    } else {
        echo '<span>Strona główna</span>';
        echo '</nav>';
        return;
    }
    if (is_single()) {
        $category = get_the_category();
        if ($category) {
            $main_cat = $category[0];
            if ($main_cat->parent) {
                $parent_cat = get_category($main_cat->parent);
                echo '<a href="' . get_category_link($parent_cat->term_id) . '">' . esc_html($parent_cat->name) . '</a>' . $separator;
            }
            echo '<a href="' . get_category_link($main_cat->term_id) . '">' . esc_html($main_cat->name) . '</a>' . $separator;
        }
        echo '<span>' . get_the_title() . '</span>';

    } elseif (is_category()) {
        echo '<span>' . single_cat_title('', false) . '</span>';

    } elseif (is_page()) {
        global $post;
        if ($post->post_parent) {
            $ancestors = array_reverse(get_post_ancestors($post->ID));
            foreach ($ancestors as $ancestor) {
                echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>' . $separator;
            }
        }
        echo '<span>' . get_the_title() . '</span>';

    } elseif (is_search()) {
        echo '<span>Wyniki wyszukiwania: "' . get_search_query() . '"</span>';

    } elseif (is_404()) {
        echo '<span>Błąd 404</span>';
    }

    echo '</nav>';
}