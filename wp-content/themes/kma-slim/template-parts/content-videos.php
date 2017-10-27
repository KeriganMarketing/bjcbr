<?php

use Includes\Modules\Videos\Videos;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead  = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
$featuredPhoto = get_the_post_thumbnail( $post, 'post-thumbnail');
print_r($featuredPhoto);
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
                        <h1><?php echo($subhead != '' ? $subhead: null); ?></h1>
                        <?php the_content(); ?>

                        <?php

                            $videos = new Videos();
                            $physicianVideos = $videos->getPhysicianVideos();

                            ?>

                        <h2>Physician Videos</h2>
                        <div class="columns is-multiline">
                            <?php foreach($physicianVideos as $video){ ?>
                              <div class="column is-6-tablet is-4-desktop is-3-widescreen">
                                  <a @click="$emit('toggleModal', 'youtube', '<?php echo $video['video_code']; ?>')" >
                                      <figure class="image is-16by9">
                                        <img src="https://i.ytimg.com/vi/<?php echo $video['video_code']; ?>/0.jpg" alt="<?php echo $video['name']; ?>">
                                      </figure>
                                      <p style="margin-top:.25rem; text-align:center;"><?php echo $video['name']; ?></p>
                                  </a>
                              </div>
                            <?php }  ?>
                        </div>

                        <h2>Foot & Ankle Videos</h2>
                        <h3>Conditions</h3>
                        <?php echo do_shortcode('[getvideos taxonomy="foot-ankle-conditions"]'); ?>
                        <h3>Procedures</h3>
                        <?php echo do_shortcode('[getvideos taxonomy="foot-ankle-procedures"]'); ?>
                        <h2>Spine Procedures</h2>
                        <?php echo do_shortcode('[getvideos taxonomy="spine-procedures"]'); ?>
                        <h2>Sports Medicine</h2>
                        <?php echo do_shortcode('[getvideos taxonomy="sports-medicine"]'); ?>

                    </div>
                </div>
            </section>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
