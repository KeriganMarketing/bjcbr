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

    <div class="section-wrapper enews-signup">

        <?php include(locate_template('template-parts/partials/enews-signup.php')); ?>

    </div>

    <div id="bot">
        <div class="section-wrapper locations" >

            <?php include(locate_template('template-parts/partials/footer-locations.php')); ?>

        </div>
    </div>

    <div id="bot-bot">
        <div class="container">
            <div class="section-wrapper">
                <div class="columns is-multiline is-vertically-aligned">
                    <div class="column is-12 is-8-widescreen is-7-fullhd">
                        <div class="the-end">
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
                                    <p id="copyright">&copy; <?php echo date('Y'); ?> <?php echo get_bloginfo(); ?>. All&nbsp;rights&nbsp;reserved. <a href="/about/privacy-policy/" >Privacy&nbsp;Policy</a>
                                        <span id="siteby" ><svg version="1.1" id="kma" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="14" width="20" viewBox="0 0 12.5 8.7" style="enable-background:new 0 0 12.5 8.7;" xml:space="preserve">
                                        <path class="kma" fill="#b4be35" d="M6.4,0.1c0,0,0.1,0.3,0.2,0.9c1,3,3,5.6,5.7,7.2l-0.1,0.5c0,0-0.4-0.2-1-0.4C7.7,7,3.7,7,0.2,8.5L0.1,8.1
                                    c2.8-1.5,4.8-4.2,5.7-7.2C6,0.4,6.1,0.1,6.1,0.1H6.4L6.4,0.1z"/></svg> <a href="https://keriganmarketing.com" target="_blank">Site by KMA</a>.</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-12 is-4-widescreen is-5-fullhd">
                        <p class="help non-discriminatory-notice">Bone & Joint Clinic of Baton Rouge, Inc. complies with applicable Federal civil rights laws and does not discriminate on the basis of race, color, national origin, age, disability or sex. <a href="http://bjcbr.com/downloads/nondiscrimination-notice_2016.pdf">Click&nbsp;to&nbsp;view&nbsp;our&nbsp;notice</a>.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</footer>
</div>