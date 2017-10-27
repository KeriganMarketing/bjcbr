<?php

use Includes\Modules\Team\Physicians;

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
            <section class="header section">
                <div class="header-container">
                    <div class="container">
                        <p class="title is-1"><?php echo $headline; ?></p>
                    </div>
                </div>
            </section>
            <?php include(locate_template('template-parts/partials/breadcrumbs.php')); ?>
            <section id="content" class="content section">
                <div class="container">
                    <div class="entry-content">
                        <h1><?php echo($subhead != '' ? '<span class="subtitle">' . $subhead . '</span>' : null); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
            <div class="section-wrapper doctor-gallery is-centered">
                <div class="container">
                    <div class="columns is-multiline">
                        <?php
                        $physicians = new Physicians();
                        foreach ($physicians->getPhysicians() as $num => $physician) { ?>
                            <div class="column is-4-tablet is-3-widescreen">
                                <div class="physician-gallery-thumb">
                                <?php include(locate_template('template-parts/partials/mini-physician-thumb.php')); ?>
                                <a class="button is-primary is-outlined" href="/patient-center/appointments/?requested_physician=<?php echo $physician['name']; ?>" >Request an appointment</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
