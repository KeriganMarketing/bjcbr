<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

use Includes\Modules\Helpers\CleanWP;
use Includes\Modules\Layouts\Layouts;
use Includes\Modules\Team\Physicians;
use Includes\Modules\Slider\BulmaSlider;
use Includes\Modules\Locations\Locations;
use Includes\Modules\Social\SocialSettingsPage;

require('vendor/autoload.php');

new CleanWP();

$socialLinks = new SocialSettingsPage();
if (is_admin()) {
    $socialLinks->createPage();
}

$layouts = new Layouts();
$layouts->createPostType();
$layouts->createDefaultFormats();

$slider = new BulmaSlider();
$slider->createPostType();
$slider->createAdminColumns();

$physicians = new Physicians();
$physicians->createPostType();
$physicians->createAdminColumns();

$locations = new Locations();
$locations->createPostType();
$locations->createAdminColumns();

if (is_admin()) {
    $post_id = (isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : null));

    if (($post_id == get_option('page_on_front') ? true : false)) {
        //        $frontpage = new CustomPostType('Page');
//        $frontpage->addMetaBox('Contact Info', array(
//            'phone'   => 'text',
//            'email'   => 'text',
//            'address' => 'textarea',
//            'hours'   => 'textarea'
//        ));
    }
};

if (! function_exists('kmaslim_setup')) :

    function kmaslim_setup()
    {
        load_theme_textdomain('kmaslim', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');

        register_nav_menus([
            'mobile-menu' => esc_html__('Mobile Menu', 'kmaslim'),
            'footer-menu' => esc_html__('Footer Menu', 'kmaslim'),
            'main-menu'   => esc_html__('Main Navigation', 'kmaslim')
        ]);

        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ]);

        function kmaslim_inline()
        {
            ?>
            <style type="text/css">
                <?php echo file_get_contents(get_template_directory() . '/style.css'); ?>
            </style>
        <?php
        }

        add_action('wp_head', 'kmaslim_inline');

        add_image_size('large-thumbnail', 300, 300, true);
    }
endif;
add_action('after_setup_theme', 'kmaslim_setup');

function kmaslim_scripts()
{
    wp_register_script('scripts', get_template_directory_uri() . '/app.js', [], null, true);
    wp_enqueue_script('scripts');
}

add_action('wp_enqueue_scripts', 'kmaslim_scripts');
