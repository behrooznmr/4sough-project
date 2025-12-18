<?php
defined( 'ABSPATH' ) || exit;


//related posts
function ra_sb_jannah_related_posts($atts) {
    $atts = shortcode_atts(array(
        'count' => 2,
        'title' => 'نوشته های مشابه',
    ), $atts);

    if (!is_single()) {
        return '';
    }

    $current_post_id = get_the_ID();
    $categories = get_the_category($current_post_id);

    if (!$categories) {
        return '';
    }

    $cat_ids = array();
    foreach ($categories as $category) {
        $cat_ids[] = $category->term_id;
    }

    $args = array(
        'category__in'   => $cat_ids,
        'post__not_in'   => array($current_post_id),
        'posts_per_page' => $atts['count'],
        'orderby'        => 'rand',
        'ignore_sticky_posts' => 1,
    );

    $related_query = new WP_Query($args);

    ob_start();

    if ($related_query->have_posts()) : ?>
        <div id="inline-related-post" class="ra-sb-wrapper mag-box mini-posts-box content-only" style="margin: 30px 0;">
            <div class="ra-sb-container container-wrapper">

                <div class="ra-sb-header widget-title the-global-title">
                    <div class="ra-sb-title the-subtitle"><?php echo esc_html($atts['title']); ?></div>
                </div>

                <div class="ra-sb-body mag-box-container clearfix">
                    <ul class="ra-sb-list posts-items posts-list-container">
                        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>

                            <li class="ra-sb-item widget-single-post-item widget-post-list tie-standard">
                                <div class="ra-sb-thumbnail post-widget-thumbnail">
                                    <a aria-label="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" class="ra-sb-link post-thumb">
                                        <?php
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('thumbnail', array(
                                                'class' => 'ra-sb-img attachment-jannah-image-small size-jannah-image-small tie-small-image',
                                                'width' => 220,
                                                'height' => 150
                                            ));
                                        } else {
                                            echo '<img width="220" height="150" src="https://via.placeholder.com/220x150" class="ra-sb-img attachment-jannah-image-small tie-small-image" alt="no-image">';
                                        }
                                        ?>
                                    </a>
                                </div>

                                <div class="ra-sb-content post-widget-body">
                                    <a class="ra-sb-post-title post-title the-subtitle" href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                    <div class="ra-sb-meta post-meta">
                                        <span class="ra-sb-date date meta-item tie-icon"><?php echo get_the_date(); ?></span>
                                    </div>
                                </div>
                            </li>

                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php
    endif;

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('ra_related_posts', 'ra_sb_jannah_related_posts');