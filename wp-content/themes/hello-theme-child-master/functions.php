<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0');

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles()
{

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action('wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20);




/*  CSS
 * Enqueue styles
 */
if (!function_exists('nij_load_styles')) {
	function nij_load_styles()
	{

		wp_enqueue_style('slick-css', get_stylesheet_directory_uri() . '/slick-1.8.1/slick/slick.css', false, null);
	}
}
add_action('wp_enqueue_scripts', 'nij_load_styles');




/* JS  (function.php) *
 * Enqueue script
 */
if (!function_exists('nij_load_scripts')) {
	function nij_load_scripts()
	{

		wp_enqueue_script('slick-js', get_stylesheet_directory_uri() . '/slick-1.8.1/slick/slick.min.js', array('jquery'), '', true);
		wp_enqueue_script('function-js', get_stylesheet_directory_uri() . '/js/function.js', array('jquery'), rand(), true);
	}
}
add_action('wp_enqueue_scripts', 'nij_load_scripts', 1000);





function mytheme_enqueue_bootstrap()
{
	// Bootstrap CSS
	wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/bootstrap-5.3.5-dist/css/bootstrap.min.css');

	// Font Awesome CSS (local)
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/fontawesome-free-6.7.2-web (1)/css/all.min.css');

	// Bootstrap JS
	wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/bootstrap-5.3.5-dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_bootstrap');






// hero Slider 
function slick_slider()
{
	?>
	<div class="hero_slider">

		<div class="hero1 hero">
			<div class="hero-content">
				<div class="container">
					<p>Welcome to Kesari Infrabuild Private Limited</p>
					<h1> <span>Environmental </span> Consultancy <BR> Services</h1>
					<p>Vorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate <BR> libero et
						velit
						interdum, ac aliquet odio mattis.</p>
					<a href="#" class="btn">Learn More</a>
				</div>
			</div>
		</div>

		<div class="hero2 hero">
			<div class="hero-content">
				<div class="container">
					<p>Welcome to Kesari Infrabuild Private Limited</p>
					<h1> <span> Water, Waste water </span> Treatment <br>& SWM</h1>
					<p>Vorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate <BR> libero et
						velit
						interdum, ac aliquet odio mattis.</p>
					<a href="#" class="btn">Learn More</a>
				</div>
			</div>
		</div>

		<div class="hero3 hero">
			<div class="hero-content">
				<div class="container">
					<p>Welcome to Kesari Infrabuild Private Limited</p>
					<h1> <span>Green Zone </span> <br> Development</h1>
					<p>Vorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate <BR> libero et
						velit
						interdum, ac aliquet odio mattis.</p>
					<a href="#" class="btn">Learn More</a>
				</div>
			</div>
		</div>

		<div class="hero4 hero">
			<div class="hero-content">
				<div class="container">
					<p>Welcome to Kesari Infrabuild Private Limited</p>
					<h1> <span>Sustainable Infrastructure </span> <br> Services</h1>
					<p>Vorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vulputate <BR> libero et
						velit
						interdum, ac aliquet odio mattis.</p>
					<a href="#" class="btn">Learn More</a>
				</div>
			</div>
		</div>


	</div>
	<?php

}

add_shortcode('SlickSlider', 'slick_slider');

	




/* Services slider */
function services_slider()
{
	ob_start(); // Start output buffering
	?>

	<div class="services-slider">

		<?php
		
		$query = new WP_Query([
			'post_type' => 'service',
			'post_status' => 'publish',
			'posts_per_page' => -1,					
		]);

		if ($query->have_posts()):
			while ($query->have_posts()):
				$query->the_post();
				$postId = get_the_ID();
				$title = get_the_title();
				$excerpt = get_the_excerpt();
				$thumbUrl = get_the_post_thumbnail_url($postId, 'medium');
				$permalink = esc_url(get_permalink($postId));
				?>

				<div class="service-card">
					<div class="card-image">
						<a href="<?php echo $permalink; ?>">
							<img src="<?php echo esc_url($thumbUrl); ?>" alt="<?php echo esc_attr($title); ?>">
						</a>
					</div>
					<div class="card-content">
						<a href="<?php echo $permalink; ?>">
							<h3>                                                                                                                
								<a href="<?php echo $permalink; ?>">
									<?php echo esc_html($title); ?>
								</a>
							</h3>

						</a>
						<p><?php echo esc_html(mb_substr($excerpt, 0, 90)) . '...'; ?></p>
						<a href="<?php echo $permalink; ?>" class="learn-more">Learn More <i
								class="fa-solid fa-arrow-right"></i></a>
					</div>
				</div>

				<?php
			endwhile;
			wp_reset_postdata();
		else:
			echo '<p>No services found.</p>';
		endif;
		?>

	</div>

	<?php
	return ob_get_clean(); 
}
	add_shortcode('services-slider', 'services_slider');

