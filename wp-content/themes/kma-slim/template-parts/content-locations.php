<?php

use Includes\Modules\Locations\Locations;

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
            <div class="section-wrapper map">
                <div class="container">
                    <div class="columns is-multiline">
                        <?php $locations = new Locations();
                        foreach($locations->getLocations() as $location){ ?>
                            <div class="location column is-4-desktop">
                                <figure class="image is-4by3">
                                    <img src="<?php echo $location['photo']; ?>" alt="<?php echo $location['name']; ?>" >
                                </figure>
                                <h3><?php echo str_replace(' Clinic', '',$location['name']); ?></h3>
                                <p class="address"><?php echo nl2br($location['address']); ?></p>
                                <p class="phone"><em>tel:</em> <a href="tel:<?php echo str_replace('(','',str_replace(') ', '-', $location['phone'])); ?>"><?php echo $location['phone']; ?></a></p>
                                <p class="phone"><em>fax:</em> <a href="tel:<?php echo str_replace('(','',str_replace(') ', '-', $location['fax'])); ?>"><?php echo $location['fax']; ?></a></p>
                                <p class="appt-button"><a class="button is-info" href="/patient-center/appointments/?office=<?php echo strtolower(str_replace(' ', '-', $location['name'])); ?>">Request an appointment at this office</a></p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php include(locate_template('template-parts/partials/location-map.php')); ?>

            </div>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
