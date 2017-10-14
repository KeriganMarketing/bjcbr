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
                        <h1 class="title is-1"><?php echo $headline; ?>
                            <?php echo($subhead != '' ? '<span class="subtitle">' . $subhead . '</span>' : null); ?></h1>
                    </div>
                </div>
            </section>
            <?php include(locate_template('template-parts/partials/breadcrumbs.php')); ?>
            <section id="content" class="content section">
                <div class="container">
                    <div class="entry-content">
                        <?php the_content(); ?>

                        <?php

                            $videos = new Videos();
                            $physicianVideos = $videos->getPhysicianVideos();
                            $footConditionVideos = $videos->getVideos([],'foot-ankle-conditions');
                            $footProcedureVideos = $videos->getVideos([],'foot-ankle-procedures');
                            $spineVideos = $videos->getVideos([],'spine-procedures');
                            $sportsVideos = $videos->getVideos([],'sports-medicine');

//                            print_r($videos->getVideos());

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
                        <div class="columns is-multiline">
                            <?php foreach($footConditionVideos as $video){ ?>
                                <div class="column is-6-tablet is-4-desktop is-3-widescreen">
                                    <a @click="$emit('toggleModal', 'viewmedica', '<?php echo $video['video_code']; ?>')" >
                                        <figure class="image is-16by9">
                                            <img src="<?php echo $video['photo']; ?>" alt="<?php echo $video['name']; ?>">
                                        </figure>
                                        <p style="margin-top:.25rem; text-align:center;"><?php echo $video['name']; ?></p>
                                    </a>
                                </div>
                            <?php }  ?>
                        </div>
                        <h3>Procedures</h3>
                        <div class="columns is-multiline">
                            <?php foreach($footProcedureVideos as $video){ ?>
                                <div class="column is-6-tablet is-4-desktop is-3-widescreen">
                                    <a @click="$emit('toggleModal', 'viewmedica', '<?php echo $video['video_code']; ?>')" >
                                        <figure class="image is-16by9">
                                            <img src="<?php echo $video['photo']; ?>" alt="<?php echo $video['name']; ?>">
                                        </figure>
                                        <p style="margin-top:.25rem; text-align:center;"><?php echo $video['name']; ?></p>
                                    </a>
                                </div>
                            <?php }  ?>
                        </div>
                        <h2>Spine Procedures</h2>
                        <div class="columns is-multiline">
                            <?php foreach($spineVideos as $video){ ?>
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
                        <h2>Sports Medicine</h2>
                        <div class="columns is-multiline">
                            <?php foreach($sportsVideos as $video){ ?>
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


                        <!--example
                        <p><a class="button is-primary" @click="$emit('toggleModal', 'viewmedica', 'A_2eb99938')"
                            >open a viewmedica video
                        </a></p>
                        -->

                    </div>
                </div>
            </section>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
