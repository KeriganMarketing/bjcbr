<?php
namespace Includes\Modules\Leads;

use Includes\Modules\CPT\CustomPostType;

/**
 * Class kmaLeads
 * Author: Bryan Baird
 * Date: 2/3/2017 Time: 1:21 PM
 */

class KmaLeads
{
    public $adminEmail;
    public $domain;
    public $ccEmail;
    public $bccEmail;
    public $siteName;

    /**
     * Leads constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('America/Chicago');

        $this->domain = 'boneandjointclinicbr.com';

        //separate multiple email addresses with a ';'
        $this->adminEmail = 'web@kerigan.com';
        $this->ccEmail    = 'web@kerigan.com'; //Admin email only
        $this->bccEmail   = 'support@kerigan.com';
    }

    public function handleAppointment($contactInfo){
        $this->addToDashboard($contactInfo);
        $this->sendNotifications($contactInfo);
    }

    /**
     * @param array $contactInfo
     */
    public function addToDashboard($contactInfo)
    {

        echo '<pre>',print_r($contactInfo),'</pre>';

        $name    = $contactInfo['first_name'] . ' ' . $contactInfo['last_name'];

        wp_insert_post(
            [ //POST INFO
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_type'      => 'Lead',
                'post_title'     => $name,
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'meta_input'     => [ //POST META
                    'lead_info_name'                    => $name,
                    'lead_info_phone_number'            => $contactInfo['phone_number'],
                    'lead_info_email_address'           => $contactInfo['email_address'],
                    'lead_info_date'                    => $contactInfo['requested_date'],
                    'lead_info_time'                    => $contactInfo['requested_time'],
                    'lead_info_location'                => $contactInfo['requested_location'],
                    'lead_info_physician'               => $contactInfo['requested_physician'],
                    'lead_info_additional_instructions' => $contactInfo['additional_instructions'],
                ]
            ],
            true
        );
    }

    /**
     * Returns a properly formatted address
     * @param  $street
     * @param  $street2
     * @param  $city
     * @param  $state
     * @param  $zip
     *
     * @return string
     */
    protected function fullAddress($street, $street2, $city, $state, $zip)
    {
        return $street . ' ' . $street2. ' '. $city . ', '. $state .'  '. $zip;
    }

    /*
     * Sends notification email(s)
     * @param array $leadInfo
     */
    protected function sendNotifications ($contactInfo)
    {
        $name = $contactInfo['first_name'] . ' ' . $contactInfo['last_name'];

        $requestData = [
            'Name'                   => $name,
            'Phone Number'           => $contactInfo['phone_number'],
            'Email Address'          => $contactInfo['email_address'],
            'Requested Date'         => $contactInfo['requested_date'],
            'Requested Time'         => $contactInfo['requested_time'],
            'Requested Location'     => $contactInfo['requested_location'],
            'Requested Physician'    => $contactInfo['requested_physician'],
            'Additional Information' => $contactInfo['additional_instructions'],
        ];

        $tableData = '';
        foreach ($requestData as $key => $var) {
            if ($var != '') {
                $tableData .= '<tr><td class="label"><strong>' . $key . '</strong></td><td>' . $var . '</td>';
            }
        }

        $this->sendEmail(
            [
                'to'        => $this->adminEmail,
                'from'      => urldecode(get_bloginfo()) . ' <noreply@' . $this->domain . '>',
                'subject'   => 'New appointment request submitted on website',
                'cc'        => $this->ccEmail,
                'bcc'       => $this->bccEmail,
                'replyto'   => $name . '<' . $contactInfo['email_address'] . '>',
                'headline'  => 'New Appointment Request From Website',
                'introcopy' => 'An appointment request was received from the website. Details are below:',
                'leadData'  => $tableData
            ]
        );

        $this->sendEmail(
            [
                'to'        => $name . '<' . $contactInfo['email_address'] . '>',
                'from'      => urldecode(get_bloginfo()). ' <noreply@' . $this->domain . '>',
                'subject'   => 'Your website submission has been received',
                'bcc'       => $this->bccEmail,
                'headline'  => 'Thank you',
                'introcopy' => 'We\'ll review the information you\'ve provided and one of our friendly reservationists will contact you within 24 hours to confirm the most convenient time available.',
                'leadData'  => $tableData
            ]
        );
    }

    /**
     * @return null
     */
    public function createPostType()
    {
        //CREATE LEAD MGMT SYS
        $leads = new CustomPostType(
            'Lead',
            [
                'supports'           => [ 'title' ],
                'menu_icon'          => 'dashicons-star-empty',
                'has_archive'        => false,
                'menu_position'      => null,
                'public'             => false,
                'publicly_queryable' => false,
            ]
        );

        $leads->addMetaBox(
            'Lead Info',
            [
                'Name'                      => 'locked',
                'Phone Number'              => 'locked',
                'Email Address'             => 'locked',
                'Physician'                 => 'locked',
                'Location'                  => 'locked',
                'Date'                      => 'locked',
                'Time'                      => 'locked',
                'Additional Instructions'   => 'locked'
            ]
        );
    }

    public function createAdminColumns()
    {
        add_filter('manage_lead_posts_columns', function () {
            $defaults = [
                'cb'            => '',
                'title'         => 'Name',
                'date_time'     => 'Requested Date/Time',
                'email_address' => 'Email',
                'phone_number'  => 'Phone Number',
                'physician'     => 'Physician',
                'date'          => 'Date'
            ];
            return $defaults;
        }, 0);
        add_action('manage_lead_posts_custom_column', function ($column_name, $post_ID) {
            switch ($column_name) {
                case 'date_time':
                    $date = get_post_meta($post_ID, 'lead_info_date', true);
                    $time = get_post_meta($post_ID, 'lead_info_time', true);
                    echo(isset($date) && isset($time) ? $date . ' at ' . $time : null);
                    break;
                case 'email_address':
                    $email_address = get_post_meta($post_ID, 'lead_info_email_address', true);
                    echo(isset($email_address) ? '<a href="mailto:'.$email_address.'" >'.$email_address.'</a>' : null);
                    break;
                case 'phone_number':
                    $phone_number = get_post_meta($post_ID, 'lead_info_phone_number', true);
                    echo(isset($phone_number) ? '<a href="tel:'.$phone_number.'" >'.$phone_number.'</a>' : null);
                    break;
                case 'physician':
                    $physician = get_post_meta($post_ID, 'lead_info_physician', true);
                    echo(isset($physician) ? $physician : null);
                    break;
            }
        }, 0, 2);
    }

    protected function createEmailTemplate ($emailData)
    {
        $eol           = "\r\n";
        $emailTemplate = file_get_contents(wp_normalize_path(get_template_directory() . '/inc/modules/Leads/emailtemplate.php'));
        $emailTemplate = str_replace('{headline}', $eol . $emailData['headline'] . $eol, $emailTemplate);
        $emailTemplate = str_replace('{introcopy}', $eol . $emailData['introcopy'] . $eol, $emailTemplate);
        $emailTemplate = str_replace('{data}', $eol . $emailData['leadData'] . $eol, $emailTemplate);
        $emailTemplate = str_replace('{datetime}', date('M j, Y') . ' @ ' . date('g:i a'), $emailTemplate);
        $emailTemplate = str_replace('{website}', 'www.' . $this->domain, $emailTemplate);
        $emailTemplate = str_replace('{url}', 'https://' . $this->domain, $emailTemplate);
        $emailTemplate = str_replace('{copyright}', date('Y') . ' ' . get_bloginfo(), $emailTemplate);
        return $emailTemplate;
    }

    /*
     * actually send an email
     * TODO: Add handling for attachments
     */
    public function sendEmail ( $emailData = [] ) {
        $eol           = "\r\n";
        $emailTemplate = $this->createEmailTemplate($emailData);
        $headers       = 'From: ' . $emailData['from'] . $eol;
        $headers       .= (isset($emailData['cc']) ? 'Cc: ' . $emailData['cc'] . $eol : '');
        $headers       .= (isset($emailData['bcc']) ? 'Bcc: ' . $emailData['bcc'] . $eol : '');
        $headers       .= (isset($emailData['replyto']) ? 'Reply-To: ' . $emailData['replyto'] . $eol : '');
        $headers       .= 'MIME-Version: 1.0' . $eol;
        $headers       .= 'Content-type: text/html; charset=utf-8' . $eol;

        wp_mail($emailData['to'], $emailData['subject'], $emailTemplate, $headers);
    }
}
