<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header(); ?>

    <div class="wrapper" id="service-wrapper">
        <div id="content" class="container-fluid">
            <div class="row">
                <div class="col-xl-12 nopadding">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main" role="main">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <?php get_template_part( 'loop-templates/content', 'service' ); ?>
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                                ?>
                            <?php endwhile; // end of the loop. ?>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>