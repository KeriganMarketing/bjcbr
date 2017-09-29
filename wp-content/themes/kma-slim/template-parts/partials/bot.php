<?php

use Includes\Modules\Navwalker\BulmaNavwalker;
use Includes\Modules\Social\SocialSettingsPage;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>

<footer :class="{stuck: footerStuck}">

    <div id="bot">
        <div class="section-wrapper locations" >

            <?php include(locate_template('template-parts/partials/footer-locations.php')); ?>

        </div>
    </div>

    <div id="bot-bot">
        <div class="container">
            <div class="section-wrapper the-end">
                <div class="social">
                    <?php
                    $social      = new SocialSettingsPage();
                    $socialLinks = $social->getSocialLinks('svg', 'circle');
                    if (is_array($socialLinks)) {
                        foreach ($socialLinks as $socialId => $socialLink) {
                            echo '<a class="' . $socialId . '" href="' . $socialLink[0] . '" target="_blank" >' . $socialLink[1] . '</a>';
                        }
                    }
                    ?>
                </div>
                <div class="copyright-section">
                    <div class="footer-menu navbar-menu">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'footer-menu',
                            'container'      => false,
                            'menu_class'     => 'footer-nav',
                            'fallback_cb'    => '',
                            'menu_id'        => 'footer-menu',
                            'link_before'    => '',
                            'link_after'     => '',
                            'items_wrap'     => '<div id="%1$s" class="%2$s">%3$s</div>',
                            'walker'         => new BulmaNavwalker()
                        )); ?>
                    </div>
                    <div class="signoff">
                        <p id="copyright">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo(); ?>. All rights
                            reserved.
                            <span id="siteby">Site by <a href="https://keriganmarketing.com"
                                                         target="_blank">KMA</a>.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>