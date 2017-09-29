<?php

use Includes\Modules\Slider\BulmaSlider;
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

            <slider>
                <?php
                $slider = new BulmaSlider();
                echo $slider->getSlider('home-page-slider');
                ?>
            </slider>

        </div>

        <div class="section-wrapper home-page-text" >



        </div>

        <div class="section-wrapper doctor-carousel" >



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
