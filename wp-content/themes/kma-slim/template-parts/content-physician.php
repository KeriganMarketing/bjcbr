<?php

use Includes\Modules\Team\Physicians;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);

$physicians = new Physicians();
$physician = $physicians->getSingle($headline);
$specialties = $physician['specialties'] != '' ? explode('<br />', nl2br($physician['specialties'])) : [];


include(locate_template('template-parts/partials/top.php'));
?>
    <div id="mid">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <section class="header section">
                <div class="header-container">
                    <div class="container">
                        <div class="columns">
                            <div class="column is-3 physician-header-left">
                                <img class="large-physician-photo" src="<?php echo $physician['photo']; ?>" >
                            </div>
                            <div class="column physician-header-right">
                                <div class="physician-details">
                                    <h1 class="title physician-name"><?php echo $headline; ?></h1>
                                    <p class="specialties-list">
                                        <?php foreach($specialties as $specialty){
                                            echo $specialty.'<br>';
                                        } ?>
                                    </p>
                                    <a class="button is-primary" href="/patient-center/appointments/?requested_physician=<?php echo $physician['slug']; ?>" >Request an appointment</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <section id="content" class="content section">
                <div class="container">
                    <div class="entry-content">

                        <div class="columns is-multiline">
                            <div class="column is-12 is-9-widescreen">
                                <div class="physician-video">
                                    <iframe class="embed-responsive-item" src="https://www.youtube-nocookie.com/embed/<?php echo $physician['youtube_code']; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen=""></iframe>
                                </div>
                            </div>

                            <div class="column is-12 is-8-desktop is-9-widescreen is-third-widescreen">
                                <div class="physician-bio">
                                    <?php //echo '<pre>',print_r($physician),'</pre>'; ?>
                                    <?php the_content(); ?>
                                </div>
                            </div>

                            <div class="column is-12 is-4-desktop is-3-widescreen is-second-widescreen">
                                <div class="sidebar-module physician-list">
                                    <p class="sidebar-title">Select another doctor</p>
                                    <h4>Orthopedic Surgeons</h4>
                                    <ul class="none">
                                        <?php $orthopedicSurgeons = $physicians->getPhysicians([],'Orthopedic Surgeons');
                                        foreach ($orthopedicSurgeons as $doctor){
                                            echo '<li>' .
                                                 ($physician['id'] != $doctor['id'] ? '<a href="' . $doctor['link'] . '" >' : '' ) .
                                                 $doctor['name'] .
                                                 ($physician['id'] != $doctor['id'] ? '</a>' : '' ) . '</li>';
                                        } ?>
                                    </ul>

                                    <h4>Podiatrists</h4>
                                    <ul class="none">
                                        <?php $podiatrists = $physicians->getPhysicians([],'Podiatrists');
                                        foreach ($podiatrists as $doctor){
                                            echo '<li>' .
                                                 ($physician['id'] != $doctor['id'] ? '<a href="' . $doctor['link'] . '" >' : '' ) .
                                                 $doctor['name'] .
                                                 ($physician['id'] != $doctor['id'] ? '</a>' : '' ) . '</li>';
                                        } ?>
                                    </ul>

                                    <h4>Physiatrists</h4>
                                    <ul class="none">
                                        <?php $physiatrists = $physicians->getPhysicians([],'Physiatrists');
                                        foreach ($physiatrists as $doctor){
                                            echo '<li>' .
                                                 ($physician['id'] != $doctor['id'] ? '<a href="' . $doctor['link'] . '" >' : '' ) .
                                                 $doctor['name'] .
                                                 ($physician['id'] != $doctor['id'] ? '</a>' : '' ) . '</li>';
                                        } ?>
                                    </ul>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
