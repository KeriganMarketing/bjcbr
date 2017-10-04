<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead  = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');

include(locate_template('template-parts/partials/top.php'));
?>
    <div id="mid">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <section id="content" class="content section">
                <div class="container">
                    <div class="entry-content">

                        <h1 class="title is-1"><?php echo $headline; ?></h1>
                        <?php echo($subhead != '' ? '<p class="subtitle">' . $subhead . '</p>' : null); ?>
                        <?php the_content(); ?>
                        <p>made a change...</p>
                        <p>Made another change...</p>

                    </div>
                </div>
            </section>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
