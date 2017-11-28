<?php
/**
 * Created by PhpStorm.
 * User: Bryan
 * Date: 11/28/2017
 * Time: 1:54 PM
 */

namespace Includes\Modules\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class MailChimp
{
    protected $apiKey;
    protected $listId;
    protected $dc;

    public function __construct()
    {
        $this->apiKey = MAILCHIMP_API_KEY;
        $this->listId = MAILCHIMP_LIST_ID;
        $this->dc     = MAILCHIMP_GEO;
    }

    protected function connectToAPI()
    {
        $client = new Client([
            'base_uri' => 'https://' . $this->dc . '.api.mailchimp.com/',
            'auth'     => [ 'apikey' , $this->apiKey ],
        ]);

        return $client;
    }

    protected function hashEmail( $emailAddress ){
        return md5(strtolower($emailAddress));
    }

    public function addSubscriber( $emailAddress )
    {
        $headers = [
            'User-Agent' => 'testing/1.0',
            'Accept'     => 'application/json'
        ];

        $options = [
            $headers,
            'body' => json_encode([
                'email_address' => $emailAddress,
                'status'        => 'subscribed'
            ])
        ];

        $api = $this->connectToAPI();
        $api->post('/3.0/lists/' . $this->listId . '/members', $options);

    }

    public function handleSubscriber( $emailAddress )
    {
        $api = $this->connectToAPI();
        $md5Email = $this->hashEmail( $emailAddress );

        try {
            $request = $api->request('GET', '/3.0/lists/' . $this->listId . '/members/' . $md5Email);

            $result = json_decode($request->getBody()->getContents());
            $status = $result->status;

            switch ($status) {
                case 'subscribed':
                    $response = 'Thanks, but you are already on our list.';
                    break;
                case 'unsubscribed':
                case 'cleaned':
                case 'pending':
                default:
                    $response = 'Thanks for subscribing!';
                    $this->addSubscriber( $emailAddress );
            }

        } catch (ClientException $e) {

            $response = 'We\'ve added you to our list. Thanks for subscribing!';
            $this->addSubscriber( $emailAddress );

        }

        return $response;
    }
}