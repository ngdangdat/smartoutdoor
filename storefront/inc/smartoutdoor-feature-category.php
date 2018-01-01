<?php

function render_product_category($cat_id = '') {
    if ( storefront_is_woocommerce_activated() ) {
        $cat = get_term_by('slug', $cat_id, 'product_cat');
        $args = apply_filters( 'storefront_recent_products_args', array(
            'limit'             => 8,
            'columns'           => 4,
            'title'             => $cat->name,
            'url'               => get_category_link($cat->term_id),
            'description'       => $cat->description
        ));

        $shortcode_content = storefront_do_shortcode( 'product_category', apply_filters( 'storefront_recent_products_shortcode_args', array(
            'per_page' => intval( $args['limit'] ),
            'columns'  => intval( $args['columns'] ),
            'category' => $cat_id
        ) ) );

        /**
         * Only display the section if the shortcode returns products
         */
        if ( false !== strpos( $shortcode_content, 'product' ) ) {

            echo '<section class="smartoutdoor-home-category storefront-product-section storefront-recent-products" aria-label="' . esc_attr__( 'Recent Products', 'storefront' ) . '">';

            do_action( 'storefront_homepage_before_recent_products' );
            echo '<div class="heading">';
            $title = '<h2 class="section-title">';
            $title .= '<a href="' . esc_url($args['url']) . '" alt="' . wp_kses_post( $args['title'] ) . '">';
            $title .= wp_kses_post( $args['title'] ) . '</a></h2>';
            echo $title;
            if(!empty($args['description'])) {
                $description = '<div class="smartoutdoor-home-cat-desc"><p>'. wp_kses_post($args['description']) . '</p></div>';
                echo $description;
            }
            echo '</div>';

            do_action( 'storefront_homepage_after_recent_products_title' );

            echo $shortcode_content;

            do_action( 'storefront_homepage_after_recent_products' );
            echo '</section>';
        }
    }
}

if(!function_exists('smartoutdoor_storefront_featured_categories'))
{
    function smartoutdoor_storefront_featured_categories (){
        $display_cat_1 = get_option('featured_category_1');
        $display_cat_2 = get_option('featured_category_2');
        $display_cat_3 = get_option('featured_category_3');

        $cat_array = array();

        if(!empty($display_cat_1)) {
            array_push($cat_array, $display_cat_1);
        }

        if(!empty($display_cat_2)) {
            array_push($cat_array, $display_cat_2);
        }

        if(!empty($display_cat_3)) {
            array_push($cat_array, $display_cat_3);
        }

        foreach ($cat_array as $key => $cat) {
            render_product_category($cat);
        }
    }
}
