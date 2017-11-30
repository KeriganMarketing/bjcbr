<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <style>
        @media screen and (min-width: 1024px){
            #app {
                display: none;
            }
        }
    </style>
</head>

<body <?php body_class(); ?> >
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'kmaslim' ); ?></a>
<div id="app" >