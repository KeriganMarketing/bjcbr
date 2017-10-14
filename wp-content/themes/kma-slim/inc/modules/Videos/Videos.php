<?php
/**
 * Created by PhpStorm.
 * User: bbair
 * Date: 10/13/2017
 * Time: 9:02 PM
 */

namespace Includes\Modules\Videos;

use Includes\Modules\CPT\CustomPostType;
use Includes\Modules\Team\Physicians;
use Includes\Modules\Videos\Viewmedica;

class Videos
{

    public function __construct()
    {
    }

    public function createPostType()
    {

        $video = new CustomPostType('Video',
            [
                'supports'           => ['title', 'author', 'revisions'],
                'menu_icon'          => 'dashicons-video',
                'has_archive'        => false,
                'menu_position'      => null,
                'public'             => true,
                'publicly_queryable' => true,
                'hierarchical'       => true,
                'show_ui'            => true,
                'show_in_nav_menus'  => true,
                '_builtin'           => false,
            ]
        );

        $video->addTaxonomy('Source');
        $video->addTaxonomy('Video Category');
        $video->convertCheckToRadio('source');
        $video->convertCheckToRadio('video_category');

        $video->addMetaBox(
            'Video Info',
            [
                'Photo'       => 'image',
                'Video Code'  => 'text',
            ]
        );

        $video->addMetaBox(
            'Video Description',
            [
                'html' => 'wysiwyg'
            ]
        );

    }

    public function getVideos($args = [], $taxonomy = '')
    {

        $request = [
            'post_type'      => 'video',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
            'offset'         => 0,
            'post_status'    => 'publish',
        ];

        if ( $taxonomy != '' ) {
            $categoryarray = [
                'relation' => 'AND',
                [
                    'taxonomy'         => 'video_category',
                    'field'            => 'slug',
                    'terms'            => $taxonomy,
                    'include_children' => false,
                ],
            ];
            $request['tax_query'] = $categoryarray;
        }

        $request = get_posts(array_merge($request, $args));

        $output = [];
        foreach ($request as $item) {

            array_push($output, [
                'id'           => (isset($item->ID) ? $item->ID : null),
                'name'         => $item->post_title,
                'slug'         => (isset($item->post_name) ? $item->post_name : null),
                'video_code'   => (isset($item->video_info_video_code) ? $item->video_info_video_code : null),
                'photo'        => (isset($item->video_info_photo) ? $item->video_info_photo : null),
                'description'  => (isset($item->video_description_html) ? $item->video_description_html : null),
                'link'         => get_permalink($item->ID),
            ]);

        }

        return $output;
    }

    public function getPhysicianVideos()
    {

        $physicians = new Physicians();
        $physicianVideos = $physicians->getPhysicians();

        $output = [];
        foreach ($physicianVideos as $video) {
            array_push($output, [
                'name'       => $video['name'],
                'video_type' => 'youtube',
                'video_code' => $video['youtube_code'],
            ]);
        }

        return $output;
    }

}