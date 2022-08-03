<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// locate_block_template()
// locate_template()

if( wp_is_block_theme() ) {
    // block_template_part('header');
    wp_head();
    block_header_area();
}
else    get_header();

?>

<main>

    <?php if( have_posts() ) : ?>
        <?php while( have_posts() ) : the_post(); ?>
    
            <?php echo do_shortcode( '[moderni-form-project-view id="' . get_the_ID() . '"]' ); ?>
        
        <?php endwhile; ?>
    <?php endif; ?>
    
</main>

<?php
if( wp_is_block_theme() ) {
    // block_template_part('footer');
    block_footer_area();
    wp_footer();
}
else    get_footer();