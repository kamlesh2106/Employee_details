<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
	<style>
		.woocommerce-mini-cart-item.mini_cart_item{
			font-size: 16px;
		}
		.woocommerce-mini-cart-item.mini_cart_item .wp-post-image{
			max-width: 100px !important;
		}
		.woocommerce-mini-cart__buttons a{
			margin-bottom: 10px;
		}
		li{
			list-style-type: none;
		}
		.widget_shopping_cart_content {
			display: none;
			position: absolute;
			top: 100%;
			right: 0;
			background: #fff;
			border: 1px solid #ccc;
			padding: 10px;
			z-index: 999;
		}

		/* Style for the close button (optional) */
		.widget_shopping_cart_content .close-cart {
			position: absolute;
			top: 5px;
			right: 10px;
			cursor: pointer;
		}
		/* Mini cart container */
		.mini-cart-container {
			position: relative;
			display: inline-block;
		}

		/* Mini cart link */
		.mini-cart-link {
			text-decoration: none;
			color: #333;
			font-weight: bold;
		}

		/* Mini cart content */
		.mini-cart-content {
			display: none;
			position: absolute;
			top: 100%;
			right: 0;
			background: #fff;
			border: 1px solid #ccc;
			padding: 10px;
			z-index: 999;
			min-width: 200px;
		}

		/* Mini cart item */
		.mini-cart-item {
			display: flex;
			align-items: center;
			margin-bottom: 10px;
		}

		/* Mini cart item thumbnail */
		.mini-cart-item-thumbnail {
			flex: 0 0 30%;
			margin-right: 10px;
		}

		/* Mini cart item details */
		.mini-cart-item-details {
			flex: 1;
		}

		/* Mini cart item title */
		.mini-cart-item-title {
			font-weight: bold;
			margin-bottom: 5px;
		}

		/* Mini cart item quantity */
		.mini-cart-item-quantity {
			font-size: 14px;
			color: #888;
		}
	</style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">
		<?php
		/* translators: Hidden accessibility text. */
		esc_html_e( 'Skip to content', 'twentytwentyone' );
		?>
	</a>

	<?php get_template_part( 'template-parts/header/site-header' ); ?>

	<div id="content" class="site-content">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
