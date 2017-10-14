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

    public function getViewMedicaVideos()
    {

        /// wish this would have worked...
        $vm = Viewmedica::make([
            'username' => 'spinecenterBR',
            'password' => 'sp1neVids',
            'practice' => 'The Spine Center of Baton Rouge',
            'url'      => 'http://spinecenterbr.com',  ///think this is an issue
            'content'  => 'A_3509a994,A_2b537a6a,A_ca77b897'
        ]);

        $client = $vm->response['body']; //json

        print_r($client);

        return $client;
    }
}