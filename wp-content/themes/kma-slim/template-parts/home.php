<?php

use Includes\Modules\Slider\BulmaSlider;
use Includes\Modules\Team\Physicians;
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ( $post->page_information_headline != '' ? $post->page_information_headline : $post->post_title );
$subhead  = ( $post->page_information_subhead != '' ? $post->page_information_subhead : '' );

include(locate_template('template-parts/partials/top.php'));
?>
<div id="mid">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="section-wrapper home-slider" >

            <bulma-slider>
                <?php
                $slider = new BulmaSlider();
                echo $slider->getSlider('home-page-slider');
                ?>
            </bulma-slider>

        </div>

        <div class="section-wrapper home-page-text" >



        </div>

        <div class="section-wrapper doctor-carousel" >
            <div class="container">
                <slick ref="slick" :options="slickOptions">
                    <?php
                    $physicians = new Physicians();
                    foreach($physicians->getPhysicians() as $num => $physician){ ?>
                        <div class="slick-item">
                            <?php include(locate_template('template-parts/partials/mini-physician-thumb.php')); ?>
                        </div>
                    <?php } ?>
                </slick>
            </div>
        </div>

        <div class="section-wrapper specialties-area" >



        </div>

        <div class="section-wrapper clinic-news" >



        </div>

        <div class="section-wrapper enews-signup" >



        </div>

    </article><!-- #post-## -->
</div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
