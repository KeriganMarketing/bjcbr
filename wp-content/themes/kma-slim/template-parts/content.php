<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead  = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
$featuredPhoto = get_the_post_thumbnail( $post, 'post-thumbnail');
//print_r($featuredPhoto);

$sidebar = get_the_terms($post,'layout');
$getSidebar = (isset($sidebar[0]->slug) ? $sidebar[0]->slug : '');

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

                        <?php if ($getSidebar !=''){ ?>
                            <div class="columns is-multiline">
                                <div class="column is-9">
                        <?php } ?>

                        <?php the_content(); ?>

                        <?php if ($getSidebar !=''){ ?>
                                </div>
                                <div class="column is-3">
                                    <?php include(locate_template('template-parts/sidebars/' . $getSidebar . '.php')); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        </article>
    </div>
<?php include(locate_template('template-parts/partials/bot.php')); ?>
