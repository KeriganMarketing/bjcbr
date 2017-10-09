<?php
/**
 * 404 Page
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

include(locate_template('template-parts/partials/top.php'));
?>
<div id="mid" >
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="header section">
            <div class="header-container">
                <div class="container">
                    <h1 class="title is-1">404</h1>
                    <p class="subtitle">Page not found</p>
                </div><!-- .entry-content -->
            </div>
        </section>
    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>