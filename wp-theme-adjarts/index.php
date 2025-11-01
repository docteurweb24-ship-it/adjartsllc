<?php get_header(); ?>

<main id="site-content">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
            <h1><?php the_title(); ?></h1>
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
    <?php endwhile; else: ?>
        <p><?php _e('No posts found', 'adjarts'); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
