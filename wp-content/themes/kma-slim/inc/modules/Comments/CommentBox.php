<?php
namespace Includes\Modules\Comments;

use Includes\Modules\CPT\CustomPostType;

class CommentBox
{
    public $adminEmail;
    public $domain;
    public $ccEmail;
    public $bccEmail;
    public $siteName;

    public function __construct()
    {
        date_default_timezone_set('America/Chicago');

        $this->domain = 'boneandjointclinicbr.com';

        //separate multiple email addresses with a ';'
        $this->adminEmail = 'ddarby@bjcbr.com';
        //$this->adminEmail = 'web@kerigan.com';
        //$this->ccEmail    = 'web@kerigan.com'; //Admin email only
        $this->bccEmail   = 'support@kerigan.com; jack@kerigan.com';

        if(isset($_POST['sfg354fgefrfedt45gfe4rfag']) && $_POST['sfg354fgefrfedt45gfe4rfag'] == ''){
            $this->handleComment($_POST);
        }
    }

    public function registerShortcode()
    {
        add_shortcode('comment_box', function() {
            return $this->displayForm();
        });
    }

    public function displayForm()
    {
        return file_get_contents(wp_normalize_path(get_template_directory() .'/inc/modules/Comments/display.php'));
    }

    protected function handleComment($submissionInfo){
        //echo '<pre>',print_r($submissionInfo),'</pre>';
        $this->addToDashboard($submissionInfo);
        $this->sendNotifications($submissionInfo);
    }

    /*
     * Sends notification email(s)
     * @param array $leadInfo
     */
    protected function sendNotifications ($contactInfo)
    {

        $requestData = [
            'Email Address' => $contactInfo['email_address'],
            'Feedback' => $contactInfo['commentBox'],
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
                'subject'   => 'Patient feedback submitted on website',
                'cc'        => $this->ccEmail,
                'bcc'       => $this->bccEmail,
                'replyto'   => $contactInfo['email_address'],
                'headline'  => 'New Appointment Request From Website',
                'introcopy' => 'A patient has provided feedback using the website. Details are below:',
                'leadData'  => $tableData
            ]
        );

        $this->sendEmail(
            [
                'to'        => $contactInfo['email_address'],
                'from'      => urldecode(get_bloginfo()). ' <noreply@' . $this->domain . '>',
                'subject'   => 'Your feedback has been received',
                'bcc'       => $this->bccEmail,
                'headline'  => 'Thank you',
                'introcopy' => 'Thank you for taking the time to help us. Your comments will be kept strictly confidential.',
                'leadData'  => $tableData
            ]
        );
    }

    public function createPostType()
    {
        //CREATE LEAD MGMT SYS
        $feedback = new CustomPostType(
            'Feedback',
            [
                'supports'           => [ 'title' ],
                'menu_icon'          => 'dashicons-star-empty',
                'has_archive'        => false,
                'menu_position'      => null,
                'public'             => false,
                'publicly_queryable' => false,
            ]
        );

        $feedback->addMetaBox(
            'Feedback',
            [
                'Email Address' => 'locked',
                'Feedback'      => 'locked'
            ]
        );
    }

    public function createAdminColumns()
    {
        add_filter('manage_feedback_posts_columns', function () {
            $defaults = [
                'cb'            => '',
                'email_address' => 'Email',
                'date'          => 'Date Posted'
            ];
            return $defaults;
        }, 0);
        add_action('manage_feedback_posts_custom_column', function ($column_name, $post_ID) {
            switch ($column_name) {
                case 'email_address':
                    $email_address = get_post_meta($post_ID, 'feedback_email_address', true);
                    echo(isset($email_address) ? $email_address : null);
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

    public function addToDashboard($contactInfo)
    {
        wp_insert_post(
            [ //POST INFO
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_type'      => 'feedback',
                'post_title'     => $contactInfo['email_address'],
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'meta_input'     => [ //POST META
                    'feedback_email_address' => $contactInfo['email_address'],
                    'feedback_feedback'      => $contactInfo['commentBox'],
                ]
            ],
            true
        );
    }
}
