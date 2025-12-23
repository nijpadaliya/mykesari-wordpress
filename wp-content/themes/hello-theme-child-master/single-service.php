<?php
/*
Template Name: Single Service
*/
get_header();


$services_page = get_page_by_path('services');
$services_link = $services_page ? get_permalink($services_page->ID) : '#';
$benefits = esc_html(get_field('benefits'));
$thumbUrl = get_the_post_thumbnail_url($postId, 'full');
?>

<div class="service-hero-section-wrapper"
    style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo esc_url($thumbUrl); ?>'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="service-hero-section-container">
        <div class="service-hero-content">
            <h2><?php echo esc_html(get_the_title()); ?></h2>
            <p>
                <a href="<?php echo esc_url(home_url()); ?>">Home</a>
                <i aria-hidden="true" class="fas fa-angle-double-right"></i>
                <a href="<?php echo esc_url($services_link); ?>">Services</a>
                <i aria-hidden="true" class="fas fa-angle-double-right"></i>
                <span aria-current="page"><?php echo esc_html(get_the_title()); ?></span>
            </p>
        </div>
    </div>
</div>


<?php
if (have_posts()):
    while (have_posts()):
        the_post();

        $benefits = get_field('benefits'); // No esc_html here yet
?>
        <div class="service-single-content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-lg-8 col-12">
                        <div class="service-single-content">
                            <h2><?php echo esc_html(get_the_title()); ?></h2>
                            <div class="service-content-text">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <?php if ($benefits): ?>
                        <div class="service-benefits">
                            <h2><?php echo esc_html($benefits); ?></h2>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    endwhile;
endif;


get_footer();
?>