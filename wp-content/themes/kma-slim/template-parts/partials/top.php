<?php

use Includes\Modules\Navwalker\BulmaNavwalker;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<div id="MobileNavMenu" :class="[{ 'is-active': isOpen }, 'navbar']">
    <?php wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container'      => false,
        'menu_class'     => 'navbar-start',
        'fallback_cb'    => '',
        'menu_id'        => 'main-menu',
        'link_before'    => '',
        'link_after'     => '',
        'items_wrap'     => '<div id="%1$s" class="%2$s">%3$s</div>',
        'walker'         => new BulmaNavwalker()
    )); ?>
    <span class="top-slash"></span>
</div>
<div :class="['site-wrapper', { 'menu-open': isOpen }, {'full-height': footerStuck}]">
<header id="top" class="header">
    <div class="container">
        <nav class="navbar">

            <div id="TopNavMenu" class="navbar-menu">
                <?php wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'container'      => false,
                    'menu_class'     => 'navbar-start',
                    'fallback_cb'    => '',
                    'menu_id'        => 'main-menu',
                    'link_before'    => '',
                    'link_after'     => '',
                    'items_wrap'     => '<div id="%1$s" class="%2$s">%3$s</div>',
                    'walker'         => new BulmaNavwalker()
                )); ?>
                <span class="top-slash"></span>
            </div>

            <div class="navbar-end">

                <div class="navbar-item go-arrow">
                    <a href="/patient-center/appointments/" class="navbar-link">
                        <span>Request an</span>
                        Appointment</a>
                </div>
                <div class="navbar-item go-arrow">
                    <a href="tel:225-766-0050" class="navbar-link">
                        <span>Contact Us</span>
                        225-766-0050</a>
                </div>
            </div>

            <div class="navbar-brand">
                <div class="navbar-burger burger" id="MobileNavBurger" data-target="MobileNavMenu" @click="toggleMenu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

        </nav>
    </div>
</header>
<div class="top-pad"></div>
<div class="sticky-logo">
    <div class="container" >
        <a href="/">
            <img class="logo" src="<?php echo get_template_directory_uri() . '/img/bjc-logo.png'; ?>"
                 alt="Bone & Joint Clinic of Baton Rouge">
        </a>
    </div>
</div>
