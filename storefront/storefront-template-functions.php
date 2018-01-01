<?php

require get_theme_file_path() . '/storefront/inc/smartoutdoor-feature-category.php';
require get_theme_file_path() . '/storefront/inc/smartoutdoor-content.php';
require get_theme_file_path() . '/storefront/inc/smartoutdoor-shortcode.php';
require get_theme_file_path() . '/storefront/inc/setup.php';

/**
 * Smart Daily Outdoor custom storefront functions.
 */


if(!function_exists('setup_smart_outdoor_homepage'))
{
function setup_smart_outdoor_homepage()
	{
		remove_action( 'storefront_homepage', 'storefront_homepage_header', 10 );
		remove_action('homepage', 'storefront_page_header', 10);
		remove_action('homepage', 'storefront_product_categories', 20);
		remove_action('homepage', 'storefront_recent_products', 30);
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item_title',      'woocommerce_show_product_loop_sale_flash', 6 );

		add_action('homepage', 'smartoutdoor_storefront_featured_categories', 20);
		add_filter('excerpt_length', 'smartoutdoor_custom_excerpt_length', 999 );
		add_filter('excerpt_more', 'smartoutdoor_custom_excerpt_symbol' );
	}
}

/**
 * Initialize functions used in storefront 
 */
function init_storefront()
{
	/* Set up general */
	add_action( 'after_setup_theme', 'smartourdoor_setup' );
	/* Set up homepage */
	add_action('after_setup_theme', 'setup_smart_outdoor_homepage', 10);

	/* Add shortcodes */
	add_shortcode( 'featurecat', 'smartoutdoor_sc_featured_post_categories' );
}