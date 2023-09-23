<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
	require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('twenty_twenty_one_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup()
	{

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support('title-tag');

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1568, 9999);

		register_nav_menus(
			array(
				'primary' => esc_html__('Primary menu', 'twentytwentyone'),
				'footer'  => esc_html__('Secondary menu', 'twentytwentyone'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		// Add support for editor styles.
		add_theme_support('editor-styles');
		$background_color = get_theme_mod('background_color', 'D1E4DD');
		if (127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex($background_color)) {
			add_theme_support('dark-editor-style');
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ($is_IE) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style($editor_stylesheet_path);

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__('Extra small', 'twentytwentyone'),
					'shortName' => esc_html_x('XS', 'Font size', 'twentytwentyone'),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__('Small', 'twentytwentyone'),
					'shortName' => esc_html_x('S', 'Font size', 'twentytwentyone'),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__('Normal', 'twentytwentyone'),
					'shortName' => esc_html_x('M', 'Font size', 'twentytwentyone'),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__('Large', 'twentytwentyone'),
					'shortName' => esc_html_x('L', 'Font size', 'twentytwentyone'),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__('Extra large', 'twentytwentyone'),
					'shortName' => esc_html_x('XL', 'Font size', 'twentytwentyone'),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__('Huge', 'twentytwentyone'),
					'shortName' => esc_html_x('XXL', 'Font size', 'twentytwentyone'),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__('Gigantic', 'twentytwentyone'),
					'shortName' => esc_html_x('XXXL', 'Font size', 'twentytwentyone'),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__('Black', 'twentytwentyone'),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__('Dark gray', 'twentytwentyone'),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__('Gray', 'twentytwentyone'),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__('Green', 'twentytwentyone'),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__('Blue', 'twentytwentyone'),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__('Purple', 'twentytwentyone'),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__('Red', 'twentytwentyone'),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__('Orange', 'twentytwentyone'),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__('Yellow', 'twentytwentyone'),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__('White', 'twentytwentyone'),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__('Purple to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__('Green to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to green', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__('Red to yellow', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__('Yellow to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__('Purple to red', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__('Red to purple', 'twentytwentyone'),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if (is_customize_preview()) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support('starter-content', twenty_twenty_one_get_starter_content());
		}

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Add support for custom line height controls.
		add_theme_support('custom-line-height');

		// Add support for link color control.
		add_theme_support('link-color');

		// Add support for experimental cover block spacing.
		add_theme_support('custom-spacing');

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support('custom-units');

		// Remove feed icon link from legacy RSS widget.
		add_filter('rss_widget_feed_link', '__return_empty_string');
	}
}
add_action('after_setup_theme', 'twenty_twenty_one_setup');

/**
 * Registers widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init()
{

	register_sidebar(
		array(
			'name'          => esc_html__('Footer', 'twentytwentyone'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here to appear in your footer.', 'twentytwentyone'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'twenty_twenty_one_widgets_init');

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('twenty_twenty_one_content_width', 750);
}
add_action('after_setup_theme', 'twenty_twenty_one_content_width', 0);

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global bool       $is_IE
 * @global WP_Scripts $wp_scripts
 *
 * @return void
 */
function twenty_twenty_one_scripts()
{
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ($is_IE) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get('Version'));
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
	}

	// RTL styles.
	wp_style_add_data('twenty-twenty-one-style', 'rtl', 'replace');

	// Print styles.
	wp_enqueue_style('twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get('Version'), 'print');

	// Threaded comment reply styles.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get('Version'),
		true
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if (has_nav_menu('primary')) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array('twenty-twenty-one-ie11-polyfills'),
			wp_get_theme()->get('Version'),
			true
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array('twenty-twenty-one-ie11-polyfills'),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_scripts');

/**
 * Enqueues block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script()
{

	wp_enqueue_script('twentytwentyone-editor', get_theme_file_uri('/assets/js/editor.js'), array('wp-blocks', 'wp-dom'), wp_get_theme()->get('Version'), true);
}

add_action('enqueue_block_editor_assets', 'twentytwentyone_block_editor_script');

/**
 * Fixes skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 * @deprecated Twenty Twenty-One 1.9 Removed from wp_print_footer_scripts action.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix()
{

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
?>
		<script>
			/(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", (function() {
				var t, e = location.hash.substring(1);
				/^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
			}), !1);
		</script>
	<?php
	}
}

/**
 * Enqueues non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages()
{
	$custom_css = twenty_twenty_one_get_non_latin_css('front-end');

	if ($custom_css) {
		wp_add_inline_style('twenty-twenty-one-style', $custom_css);
	}
}
add_action('wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages');

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueues scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init()
{
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri('/assets/js/customize-preview.js'),
		array('customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers'),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_preview_init', 'twentytwentyone_customize_preview_init');

/**
 * Enqueues scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts()
{

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri('/assets/js/customize-helpers.js'),
		array(),
		wp_get_theme()->get('Version'),
		true
	);
}
add_action('customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts');

/**
 * Calculates classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes()
{
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters('twentytwentyone_html_classes', '');
	if (!$classes) {
		return;
	}
	echo 'class="' . esc_attr($classes) . '"';
}

/**
 * Adds "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class()
{
	?>
	<script>
		if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
			document.body.classList.add('is-IE');
		}
	</script>
<?php
}
add_action('wp_footer', 'twentytwentyone_add_ie_class');

if (!function_exists('wp_get_list_item_separator')) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator()
	{
		/* translators: Used between list items, there is a space after the comma. */
		return __(', ', 'twentytwentyone');
	}
endif;

/**
 * Never worry about cache again!
 */
function my_load_scripts($hook)
{

	$version = time();
	wp_enqueue_style('datatables', 'https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css', array(), $version, 'all');
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), $version, 'all');
	wp_enqueue_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', array(), $version, true);
	wp_enqueue_script('datatables', 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js', array(), $version, true);
	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), $version, true);
	wp_localize_script(
		'custom-js',
		'custom',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		)
	);
	// wp_register_style( 'my_css', 	plugins_url( 'style.css', 	 __FILE__ ), false,   $my_css_ver );
	wp_enqueue_style('my_css');
}
add_action('wp_enqueue_scripts', 'my_load_scripts');

/*
* Creating a function to create employees details our CPT
*/

function employees_post_type()
{

	$labels = array(
		'name'                => _x('Employees', 'Post Type General Name', 'twentytwentyone'),
		'singular_name'       => _x('Employee', 'Post Type Singular Name', 'twentytwentyone'),
		'menu_name'           => __('Employees', 'twentytwentyone'),
		'parent_item_colon'   => __('Parent Employee', 'twentytwentyone'),
		'all_items'           => __('All Employees', 'twentytwentyone'),
		'view_item'           => __('View Employee', 'twentytwentyone'),
		'add_new_item'        => __('Add New Employee', 'twentytwentyone'),
		'add_new'             => __('Add New', 'twentytwentyone'),
		'edit_item'           => __('Edit Employee', 'twentytwentyone'),
		'update_item'         => __('Update Employee', 'twentytwentyone'),
		'search_items'        => __('Search Employee', 'twentytwentyone'),
		'not_found'           => __('Not Found', 'twentytwentyone'),
		'not_found_in_trash'  => __('Not found in Trash', 'twentytwentyone'),
	);

	$args = array(
		'label'               => __('Employees', 'twentytwentyone'),
		'description'         => __('Employee details', 'twentytwentyone'),
		'labels'              => $labels,
		'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
		'taxonomies'          => array('genres'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'show_in_rest' => true,

	);
	register_post_type('employees', $args);
}

add_action('init', 'employees_post_type', 0);


add_action('wp_ajax_store_employee_details_to_employee_post_type', 'store_employee_details_to_employee_post_type');
add_action('wp_ajax_nopriv_store_employee_details_to_employee_post_type', 'store_employee_details_to_employee_post_type');

function store_employee_details_to_employee_post_type()
{

	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	$output = array();
	$employee_id = $_POST['employee_id'];
	$employee_name = $_POST['employee_name'];
	$employee_enrollno = $_POST['employee_enrollno'];
	$employee_mobileno = $_POST['employee_mobileno'];
	$employee_email = $_POST['employee_email'];
	$employee_file = $_POST['employee_file'];

	$employee_post = array(
		'post_type' => 'employees',
		'post_title' => $employee_name,
		'post_status' => 'publish'
	);
	$query = $wpdb->prepare(
		"SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = %s AND meta_value = %s LIMIT 1",
		'enroll_no',
		$employee_enrollno
	);
	$is_enroll_no = $wpdb->get_var($query);
	if ($is_enroll_no == "") {
		$post_id = wp_insert_post($employee_post);
		if ($post_id) {

			update_field('id', $employee_id, $post_id);
			update_field('name', $employee_name, $post_id);
			update_field('enroll_no', $employee_enrollno, $post_id);
			update_field('mobile_no', $employee_mobileno, $post_id);
			update_field('email', $employee_email, $post_id);
			update_field('resume', $employee_file, $post_id);
		}
	}



	if ($post_id) {
		$output['status'] = 'Success';
	} else {
		$output['status'] = 'Error';
	}
	echo json_encode($output);

	exit();
}

add_action('wp_ajax_delete_employee_post', 'delete_employee_post');
add_action('wp_ajax_nopriv_delete_employee_post', 'delete_employee_post');

function delete_employee_post()
{

	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	$output = array();
	$id = $_POST['id'];
	wp_delete_post($id);
	echo json_encode($output);

	exit();
}

add_action('wp_ajax_update_employee_post', 'update_employee_post');
add_action('wp_ajax_nopriv_update_employee_post', 'update_employee_post');

function update_employee_post()
{

	global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	$output = array();
	$page_id = $_POST['id'];
	$employee_name = $_POST['employee_name'];
	$employee_enrollno = $_POST['employee_enrollno'];
	$employee_email = $_POST['employee_email'];

	update_post_meta($page_id, 'name', $employee_name);
	update_post_meta($page_id, 'enroll_no', $employee_enrollno);
	update_post_meta($page_id, 'email', $employee_email);

	echo json_encode($output);
	exit();
}


function show_mini_cart_on_hover() {
    if (class_exists('WooCommerce')) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
			// Selector for the cart link and mini cart content
			var cartLink = $('.mini-cart');
			var miniCart = $('.mini-cart-content');

			// Function to update the cart quantity
			function updateCartQuantity() {
				$.ajax({
					type: 'GET',
					dataType: 'json',
					url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
					success: function (data) {
						if (data && data.fragments) {
							// Update the cart quantity
							if (data.fragments.cart_count) {
								cartLink.find('.cart-quantity').html(data.fragments.cart_count);
							}

							// Update the mini cart content
							if (data.fragments['div.widget_shopping_cart_content']) {
								miniCart.html(data.fragments['div.widget_shopping_cart_content']);
							}
						}
					}
				});
			}

			// Show/hide mini cart on hover
			cartLink.hover(
				function () {
					miniCart.slideDown('fast');
					// Update the cart quantity when hovering
					updateCartQuantity();
				},
				function () {
					miniCart.slideUp('fast');
				}
			);
		});
        </script>
        <?php
    }
}

function custom_mini_cart() {
	echo '<div class="mini-cart"> ';
		echo '<a href="#" class="dropdown-back " data-toggle="dropdown"> ';
		echo '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
		echo '<div class="basket-item-count" style="display: inline;">';
		echo '<span class="cart-items-count count">';
		echo WC()->cart->get_cart_contents_count();
		echo '</span>';
		echo '</div>';
		echo '</a>';
		echo '<ul class="dropdown-menu dropdown-menu-mini-cart">';
		echo '<li> <div class="widget_shopping_cart_content mini-cart-content">';
		woocommerce_mini_cart();
		echo '</div></li></ul>
		
		</div>';
	
	}
	add_shortcode( 'quadlayers-mini-cart', 'custom_mini_cart' );

add_action('wp_footer', 'show_mini_cart_on_hover');


function update_cart_item_quantity() {
    if (isset($_POST['update_cart']) && isset($_POST['cart_item_key']) && isset($_POST['quantity'])) {
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        $new_quantity = intval($_POST['quantity']);

        // Update the cart item quantity
        if ($new_quantity > 0) {
            WC()->cart->set_quantity($cart_item_key, $new_quantity);
        }

        // Redirect to the cart page or refresh the page
        wp_safe_redirect(wc_get_cart_url());
        exit;
    }
}
add_action('init', 'update_cart_item_quantity');