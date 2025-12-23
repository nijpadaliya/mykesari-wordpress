<?php
/*
Template Name: Services
*/

get_header();
?>
<div class="service-hero-section-wrapper">
    <div class="service-hero-section-container">
        <div class="service-hero-content">
            <h2>Services</h2>
            <p>
                <a href="<?php echo home_url(); ?>">Home</a>
                <i aria-hidden="true" class="fas fa-angle-double-right"></i>
                <a href="<?php echo get_permalink($post_id); ?>">Services</a>
            </p>
        </div>
    </div>
</div>

<?php


global $post;
$post_id = $post->ID;


$query = new WP_Query([
    'post_type' => 'service',
    'post_status' => 'publish',
    'posts_per_page' => -1,
]);

if ($query->have_posts()) {
    echo '<div class="service-section"><div class="container"><div class="row">';
    while ($query->have_posts()) {
        $query->the_post();
        $postId = get_the_ID();
        $title = get_the_title();
        $excerpt = get_the_excerpt();
        $thumbUrl = get_the_post_thumbnail_url($postId, 'medium');
        $permalink = esc_url(get_permalink($postId));
        ?>

        <div class="col-md-4 col-lg-4 col-12 mb-4">
            <div class="service-card">
                <div class="card-image">
                    <a href="<?php echo $permalink; ?>">
                        <img src="<?php echo esc_url($thumbUrl); ?>" alt="<?php echo esc_attr($title); ?>" />
                    </a>
                </div>
                <div class="card-content">
                    <a href="<?php echo $permalink; ?>">
                        <h3><?php echo esc_html($title); ?></h3>
                    </a>
                    <p><?php echo esc_html(mb_substr($excerpt, 0, 90)) . '...'; ?></p>
                    <div class="service-btn">
                        <a href="<?php echo $permalink; ?>" class="learn-more">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div></div></div>';
    wp_reset_postdata();
} else {
    echo '<div class="container"><h4>No services found.</h4></div>';
}
get_footer();


return ob_get_clean(); // Return the buffered content


