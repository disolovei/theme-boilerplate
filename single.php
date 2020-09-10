<?php get_header(); ?>

<?php
    while ( have_posts() ) : the_post();

    the_post_thumbnail();

    the_content();

    endwhile;
?>

<?php get_footer(); ?>
