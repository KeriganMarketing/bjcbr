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
                            <div class="column is-3">
                                <img src="<?php echo $physician['photo']; ?>" >
                            </div>
                            <div class="column">
                                <h1 class="title physician-name"><?php echo $headline; ?></h1>
                                <p class="specialties-list">
                                    <?php foreach($specialties as $specialty){
                                        echo $specialty.'<br>';
                                    } ?>
                                </p>
                                <a class="button is-primary" href="/patient-center/appointments/?physician=<?php echo $physician['slug']; ?>" >Request an appointment</a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <section id="content" class="content section">
                <div class="container">
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php echo '<pre>',print_r($physician),'</pre>'; ?>
                    </div>
                </div>
            </section>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
