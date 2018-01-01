<?php

if(!function_exists('smartoutdoor_sc_featured_post_categories'))
{
    function smartoutdoor_sc_featured_post_categories($atts = [])
    {
        $params = shortcode_atts(array(
            'category'  => 'uncategorized',
            'direction' => 'horizontal',
            'thumbnail' => 'yes',
            'postnum'   => '4'
        ), $atts);
        $posts_query = new WP_Query(array(
            'post_type'     => 'post',
            'category_name' => $params['category'],
            'post_per_page' => $params['postnum']
        ));
        $test = get_posts(array(
            'post_type'     => 'post',
            'category_name' => $params['category'],
            'post_per_page' => 5
        ));
        $is_thumbnail_show = TRUE;
        if($params['thumbnail'] == 'no' || $params['thumbnail'] == 'NO')
        {
            $is_thumbnail_show = FALSE;
        }
        $cat = get_term_by('slug', $params['category'], 'category');
        $sec_class = array('short-code-featured-post-cat-section');
        $is_vertical = FALSE;
        if($params['direction'] == 'vertical')
        {
            $is_vertical = TRUE;
        }
        $direction_class = $is_vertical ? 'vertical' : 'horizontal';
        array_push($sec_class, $direction_class);

        if($posts_query->have_posts())
        {
            echo '<section class="'. join(' ', $sec_class) .'" aria-label="' . esc_attr__( 'Featured Posts', 'storefront' ) . '">';
            echo '<div class="heading">';
            $title = '<h2 class="section-title">';
            $title .= '<a href="' . esc_url(get_category_link($cat->term_id)) . '" alt="' . wp_kses_post( $cat->name ) . '">';
            $title .= wp_kses_post( $cat->name ) . '</a></h2>';
            echo $title;
            echo '</div>';
            echo '<div class="posts">';

            if($is_vertical)
            {
                $posts_query->the_post();
                echo '<div class="first">';
                echo '<div class="' . join(" ", get_post_class('post')) . '">';
                if(has_post_thumbnail() && $is_thumbnail_show)
                {
                    echo '<div class="post-thumbnail">';
                    echo '<a href="' . esc_url( get_permalink() ) . '">';
                    echo get_the_post_thumbnail( $post->ID, 'smartoutdoor_large_blog_image' );
                    echo '</a>';
                    echo '</div>';
                }

                echo '<div class="post-title">';
                echo '<h2><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h2>';
                echo '</div>';

                echo '<div class="post-entry">';
                $is_post_more = strpos( $post->post_content, '<!--more-->' );
                if ( $is_post_more ) :
                    the_content();
                else :
                    the_excerpt();
                endif;
                echo '</div>';

                echo '</div>';
                echo '</div>';
                echo '<div class="following">';
            }

            while($posts_query->have_posts())
            {
                $posts_query->the_post();

                echo '<div class="' . join(" ", get_post_class('post')) . '">';
                if(has_post_thumbnail() && $is_thumbnail_show)
                {
                    echo '<div class="post-thumbnail">';
                    echo '<a href="' . esc_url( get_permalink() ) . '">';
                    echo get_the_post_thumbnail( $post->ID, 'smartourdoor_blog_image' );
                    echo '</a>';
                    echo '</div>';
                }

                echo '<div class="post-title">';
                echo '<h2><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></h2>';
                echo '</div>';

                echo '<div class="post-entry">';
                $is_post_more = strpos( $post->post_content, '<!--more-->' );
                if ( $is_post_more ) :
                    the_content();
                else:
                    the_excerpt();
                endif;
                echo '</div>';
                
                echo '</div>';

            }
            if($is_vertical) echo '</div>';
            echo '</div>';
            echo '</section>';
        }

        wp_reset_postdata();
    }
}
