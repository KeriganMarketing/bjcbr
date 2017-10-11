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
    protected $adminEmail;
    protected $domain;
    /**
     * Leads constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('America/New_York');

        $this->adminEmail = 'daron@kerigan.com';
        $this->domain = 'bjcbr.com';
    }

    /**
     * @param array $contactInfo
     */
    public function addToDashboard($contactInfo)
    {

        echo '<pre>',print_r($contactInfo),'</pre>';

        $street  = $contactInfo['addr1'];
        $street2 = $contactInfo['addr2'];
        $city    = $contactInfo['city'];
        $state   = $contactInfo['state'];
        $zip     = $contactInfo['zip'];
        $name    = $contactInfo['first_name'] . ' ' . $contactInfo['last_name'];

        $fullAddress = $this->fullAddress($street, $street2, $city, $state, $zip);

        $createdLead = wp_insert_post(
            [ //POST INFO
                'post_content'   => '',
                'post_status'    => 'publish',
                'post_type'      => 'Lead',
                'post_title'     => $name,
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'meta_input'     => [ //POST META
                    'lead_info_name'               => $name,
                    'lead_info_date'               => date('M j, Y').' @ '.date('g:i a e'),
                    'lead_info_phone_number'       => $contactInfo['phone'],
                    'lead_info_email_address'      => $contactInfo['email'],
                    'lead_info_requested_physican' => $contactInfo['requested_physician'],
                    'lead_info_address'            => $fullAddress,
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

    public function sendNotifications($input)
    {
        $email       = $input['email'];
        $name        = $input['first_name'] . ' ' . $contactInfo['last_name'];
        $phone       = $input['phone'];
        $quoteType   = $input['requestType'];
        $street      = $input['addr1'];
        $street2     = $input['addr2'];
        $city        = $input['city'];
        $state       = $input['state'];
        $zip         = $input['zip'];
        $fullAddress = $this->fullAddress($street, $street2, $city, $state, $zip);

        $sendadmin = [
            'to'      => $this->adminEmail,
            'from'    => get_bloginfo().' <noreply@'.$this->domain.'>',
            'subject' => 'Quote request from website',
            'bcc'     => 'support@kerigan.com, jack@kerigan.com',
            'replyto' => $email
        ];

        $sendreceipt = [
            'to'      => $email,
            'from'    => get_bloginfo().' <noreply@'.$this->domain.'>',
            'subject' => 'Your quote request from Hannon Insurance was received',
            'bcc'     => 'support@kerigan.com'
        ];

        $emailvars = [
            'Name'              => $name,
            'Email Address'     => $email,
            'Phone Number'      => $phone,
            'Quote Type'        => $quoteType
        ];

        if ($input['addr1']!='') {
            $emailvars['Address'] = $fullAddress;
        }

        $fontstyle          = 'font-family: sans-serif;';
        $headlinestyle      = 'style="font-size:20px; '.$fontstyle.' color:#1D877F;"';
        $copystyle          = 'style="font-size:16px; '.$fontstyle.' color:#333;"';
        $labelstyle         = 'style="padding:4px 8px; background:#F7F6F3; border:1px solid #FFFFFF; font-weight:bold; '.$fontstyle.' font-size:14px; color:#4D4B47; width:150px;"';
        $datastyle          = 'style="padding:4px 8px; background:#F7F6F3; border:1px solid #FFFFFF; '.$fontstyle.' font-size:14px;"';

        $headline           = '<h2 '.$headlinestyle.'>Quote Request</h2>';
        $receiptheadline    = '<h2 '.$headlinestyle.'>Your quote request</h2>';
        $adminintrocopy     = '<p '.$copystyle.'>You have received a lead from the website. Details are below:</p>';
        $receiptintrocopy   = '<p '.$copystyle.'>Your message has been received and we will get back with you as soon as we can. What you submitted is below:</p>';
        $dateofemail        = '<p '.$copystyle.'>Date Submitted: '.date('M j, Y').' @ '.date('g:i a').'</p>';

        $submittedData = '<table cellpadding="0" cellspacing="0" border="0" style="width:100%" ><tbody>';
        foreach ($emailvars as $key => $var) {
            if (!is_array($var)) {
                $submittedData .= '<tr><td '.$labelstyle.' >'.$key.'</td><td '.$datastyle.'>'.$var.'</td></tr>';
            } else {
                $submittedData .= '<tr><td '.$labelstyle.' >'.$key.'</td><td '.$datastyle.'>';
                foreach ($var as $k => $v) {
                    $submittedData .= '<span style="display:block;width:100%;">'.$v.'</span><br>';
                }
                $submittedData .= '</ul></td></tr>';
            }
        }
        $submittedData .= '</tbody></table>';

        $adminContent   = $adminintrocopy.$submittedData.$dateofemail;
        $receiptContent = $receiptintrocopy.$submittedData.$dateofemail;

        $emaildata = [
            'headline'  => $headline,
            'introcopy' => $adminContent,
        ];
        $receiptdata = [
            'headline'  => $receiptheadline,
            'introcopy' => $receiptContent,
        ];

        $this->sendEmail($sendadmin, $emaildata);
        $this->sendEmail($sendreceipt, $receiptdata);
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
                'Name'                => 'locked',
                'Date'                => 'locked',
                'Phone Number'        => 'locked',
                'Email Address'       => 'locked',
                'Address'             => 'locked',
                'Physician'           => 'locked',
                'Location'            => 'locked',
                'Date'                => 'locked',
                'Time'                => 'locked'
            ]
        );
        // $leads->add_taxonomy('Type');
    }

    public function createAdminColumns()
    {
        add_filter('manage_lead_posts_columns', function() {
            $defaults = [
                'title'   => 'Name',
                'address' => 'Address',
                'email_address' => 'Email',
                'phone'   => 'Phone Number',
                'physican' => 'Physician',
                'date' => 'Date'
            ];
            return $defaults;
        }, 0);
        add_action('manage_lead_posts_custom_column', function($column_name, $post_ID) {
            switch ($column_name) {
                case 'address':
                    $address = get_post_meta($post_ID, 'lead_info_address', true);
                    echo(isset($address) ? $address : null);
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

    public function sendEmail(
        $sendadmin = [
            'to'      => 'daron@kerigan.com',
            'from'    => 'Website <noreply@kerigan.com>',
            'subject' => 'Email from website'
        ],
        $emaildata = [
            'headline'  => 'This is an email from the website!',
            'introcopy' => 'If we weren\'t testing, there would be stuff here.',
            'filedata'  => '',
            'fileinfo'  => ''
        ],
        $emailTemplate = ''
    ) {
        $eol = "\r\n";

        //search for directory in active WP template
        if (file_exists(wp_normalize_path(get_template_directory().'/inc/modules/leads/emailtemplate.php'))) {
            $emailTemplate = file_get_contents(wp_normalize_path(get_template_directory().'/inc/modules/leads/emailtemplate.php'));
        } else {
            $emailTemplate = '<!doctype html>
                <html>
                    <head>
                        <meta charset="utf-8">
                    </head>
                    <body bgcolor="#EAEAEA" style="background-color:#EAEAEA;">
                        <table cellpadding="0" cellspacing="0" border="0" align="center" style="width:650px; background-color:#FFFFFF; margin:30px auto;" bgcolor="#FFFFFF" >
                            <tbody>
                                <tr>
                                    <td style="padding:20px; border-top:10px solid #333333; border-bottom: #333333 solid 2px;" >
                                    <!--[content]-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </body>
                </html>';
        }

        $split       = strrpos($emailTemplate, '<!--[content]-->');
        $templatebot = substr($emailTemplate, $split);
        $templatetop = substr($emailTemplate, 0, $split);

        $bottomsplit = strrpos($templatebot, '<!--[date]-->');
        $bottombot   = substr($templatebot, $bottomsplit);
        $bottomtop   = substr($templatebot, 0, $bottomsplit);
        $senddate    = date('M j, Y').' @ '.date('g:i a');

        //build headers
        $headers  = 'From: ' . $sendadmin['from'] . $eol;
        $headers .= (isset($sendadmin['cc']) ? 'Cc: ' . $sendadmin['cc'] . $eol : '');
        $headers .= (isset($sendadmin['bcc']) ? 'Bcc: ' . $sendadmin['bcc'] . $eol : '');
        $headers .= 'MIME-Version: 1.0' . $eol;

        //noreply pass: raw9z.kvc@b*
        $headers       .= 'Content-type: text/html; charset=utf-8' . $eol;
        $emailcontent   = $templatetop . $eol . $eol;
        $emailcontent  .= '<h2>'.$emaildata['headline'].'</h2>';
        $emailcontent  .= '<p>'.$emaildata['introcopy'].'</p>';
        $emailcontent  .= $templatebot . $eol . $eol;

        mail($sendadmin['to'], $sendadmin['subject'], $emailcontent, $headers);
    }
}
