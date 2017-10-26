<?php

use Includes\Modules\Slider\BulmaSlider;
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

        <div class="section-wrapper home-slider">

            <bulma-slider>
                <?php
                $slider = new BulmaSlider();
                echo $slider->getSlider('home-page-slider');
                ?>
            </bulma-slider>

        </div>

        <div class="section-wrapper home-page-text">

            <div class="container">
                <div class="content is-centered">
                    <h1 class="title"><?php echo $headline; ?></h1>
                    <?php echo($subhead != '' ? '<p class="subtitle">' . $subhead . '</p>' : null); ?>
                    <?php the_content(); ?>
                </div>
            </div>

        </div>

        <div class="section-wrapper doctor-carousel is-centered">
            <div class="container">
                <slick ref="slick" :options="slickOptions">
                    <?php
                    $physicians = new Physicians();
                    foreach ($physicians->getPhysicians() as $num => $physician) { ?>
                        <div class="slick-item">
                            <?php include(locate_template('template-parts/partials/mini-physician-thumb.php')); ?>
                        </div>
                    <?php } ?>
                </slick>
                <a href="/physicians/" class="button is-primary is-outlined">Meet Our Doctors</a>
            </div>
        </div>

        <div class="section-wrapper specialties-area">

            <?php include(locate_template('template-parts/partials/home-page-specialties.php')); ?>

        </div>

        <div class="section-wrapper home-clinic-news">

            <?php include(locate_template('template-parts/partials/home-page-clinic-news.php')); ?>

        </div>

    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
