<?php
/**
 * Displays the site navigation.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'twentytwentyone' ); ?>">
		<div class="menu-button-container">
			<button id="primary-mobile-menu" class="button" aria-controls="primary-menu-list" aria-expanded="false">
				<span class="dropdown-icon open"><?php esc_html_e( 'Menu', 'twentytwentyone' ); ?>
					<?php echo twenty_twenty_one_get_icon_svg( 'ui', 'menu' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</span>
				<span class="dropdown-icon close"><?php esc_html_e( 'Close', 'twentytwentyone' ); ?>
					<?php echo twenty_twenty_one_get_icon_svg( 'ui', 'close' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
				</span>
			</button><!-- #primary-mobile-menu -->
		</div><!-- .menu-button-container -->
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'primary-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
		<?php echo do_shortcode('[quadlayers-mini-cart]'); ?>
		<?php 
		/*
		if (class_exists('WooCommerce')) : ?>
			<div class="mini-cart-container">
				<a href="<?php echo wc_get_cart_url(); ?>" class="mini-cart-link">
					 <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"/></svg> (<?php echo WC()->cart->get_cart_contents_count(); ?>)
				</a>
				<div class="mini-cart-content">
					<?php
					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
						$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						?>
						<div class="mini-cart-item">
							<a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>" class="remove" title="Remove this item">
								<i class="fa fa-times-circle"></i>
							</a>
							<div class="mini-cart-item-thumbnail">
								<?php echo $_product->get_image(); ?>
							</div>
							<div class="mini-cart-item-details">
								<p class="mini-cart-item-title"><?php echo $_product->get_name(); ?></p>
								<!-- Quantity update form -->
								<form class="cart-item-quantity-form" method="post" enctype='multipart/form-data'>
									<input type="hidden" name="cart_item_key" value="<?php echo $cart_item_key; ?>">
									<input type="number" name="quantity" step="1" value="<?php echo $cart_item['quantity']; ?>">
									<button type="submit" class="button" name="update_cart" value="Update">Update</button>
								</form>
							</div>
						</div>
					<?php endforeach; ?>
				</div>


			</div>
		<?php endif; 
		*/
		?>
	</nav><!-- #site-navigation -->
	<?php
endif;
