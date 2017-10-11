<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

use Includes\Modules\Team\Physicians;
use Includes\Modules\Locations\Locations;
use Includes\Modules\Leads\KmaLeads;

$requestedPhysician = isset($_GET['requested_physician']) ? $_GET['requested_physician'] : null;
$requestedLocation = isset($_GET['office']) ?  $_GET['office'] : null;
if ($_POST) {
    $lead = new KmaLeads();
    $lead->addToDashboard($_POST);
}
?>
<div class="container">
    <div class="intro-text">
        <p class="help" style="text-align: right; margin-bottom:1rem;">*You must complete all fields.</p>
    </div>

    <form method="post">

        <div class="columns is-multiline">

            <div class="column is-6 is-3-desktop">
                <div class="field">
                    <label class="label">First Name</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="First Name" name="first_name">
                    </div>
                </div>
            </div>
            <div class="column is-6 is-3-desktop">
                <div class="field">
                    <label class="label">Last Name</label>
                    <div class="control">
                        <input class="input" type="text" placeholder="Last Name" name="last_name">
                    </div>
                </div>
            </div>
            <div class="column is-6 is-3-desktop">
                <div class="field">
                    <label class="label">Email Address</label>
                    <div class="control">
                        <input class="input" type="email" placeholder="Email Address" name="email_address">
                    </div>
                </div>
            </div>
            <div class="column is-6 is-3-desktop">
                <div class="field">
                    <label class="label">Phone Number</label>
                    <div class="control">
                        <input class="input" type="phone" placeholder="(###) ###-####" name="phone_number">
                    </div>
                </div>
            </div>
            <div class="column is-12">
                <div class="field">
                    <div class="control">
                        <strong>Subscribe to our eNewsletter?</strong>
                        <label class="radio">
                            <input type="radio" name="newsletter_signup">
                            Yes
                        </label>
                        <label class="radio">
                            <input type="radio" name="newsletter_signup">
                            No
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <div class="columns is-multiline">

            <div class="column is-6 is-3-desktop">
                <label class="label">Requested Date</label>
                <div class="control has-icons-left">
                    <input class="input datepicker" type="text" placeholder="Select a date" name="requested_date">
                    <span class="icon is-small is-left">
                      <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <p class="help">Office hours are 8:00 am - 5:00 pm, Mon - Fri</p>
            </div>
            <div class="column is-6 is-3-desktop">
                <label class="label">Requested Time</label>
                <div class="control has-icons-left">
                    <input class="input timepicker" type="text" placeholder="Select a time" name="requested_time">
                    <span class="icon is-small is-left">
                      <i class="fa fa-clock-o"></i>
                    </span>
                </div>
            </div>
            <div class="column is-12 is-6-desktop">
                <div class="field">
                    <label class="label">Requested Location</label>
                    <div class="control">
                        <?php $locations = new Locations();
                        foreach($locations->getLocations() as $location){ ?>
                            <label class="radio">
                                <input type="radio" name="requested_location" value="<?php echo str_replace(' Clinic', '', $location['name']); ?>" <?php echo $requestedLocation == $location['slug'] ? 'checked' : '' ?> >
                                <?php echo str_replace(' Clinic', '', $location['name']); ?>
                            </label>
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="field">
            <div class="control">
                <label class="radio">
                    <input type="radio" name="requested_physician" value="First Available">
                    First Available
                    <p class="help">If you do not have a preference</p>
                </label>
            </div>
        </div>

        <?php
        $physicians = new Physicians();
        foreach ($physicians->getPhysicians() as $num => $physician) {
            $specialties = $physician['specialties'] != '' ? str_replace('<br />', ',', nl2br($physician['specialties'])) : '';
            ?>
            <div class="field">
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="requested_physician" value="<?php echo $physician['name']; ?>" <?php echo $requestedPhysician == $physician['slug'] ? 'checked' : '' ?> >
                        <?php echo $physician['name']; ?><br>
                        <p class="help"><?php echo $specialties; ?></p>
                    </label>
                </div>
            </div>
        <?php } ?>

        <button type="submit" class="button is-primary is-large">Submit Appointment Request</button>
    </form>
</div>

