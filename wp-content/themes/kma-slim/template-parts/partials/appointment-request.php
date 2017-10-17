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
        <p class="help" style="margin-bottom:1rem;">*You must complete all fields.</p>
    </div>

    <form method="post">

        <div class="columns is-multiline">

            <div class="column is-12 is-6-desktop">
                <div class="columns is-multiline">

                    <div class="column is-6">
                        <div class="field">
                            <label class="label">First Name</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="First Name" name="first_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="field">
                            <label class="label">Last Name</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="Last Name" name="last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="field">
                            <label class="label">Email Address</label>
                            <div class="control">
                                <input class="input" type="email" placeholder="Email Address" name="email_address" required>
                            </div>
                        </div>
                    </div>
                    <div class="column is-6">
                        <div class="field">
                            <label class="label">Phone Number</label>
                            <div class="control">
                                <input class="input" type="phone" placeholder="(###) ###-####" name="phone_number" required>
                            </div>
                        </div>
                    </div>

                    <div class="column is-6">
                        <label class="label">Requested Date</label>
                        <div class="field flatpickr" id="requested_date">
                            <date-picker name="requested_date" icon="fa-calendar" placeholder="Select a date" :config="{ dateFormat: 'F j, Y', appendTo: requested_date }"></date-picker>
                        </div>
                        <p class="help">Office hours are 8:00 am - 5:00 pm, Mon - Fri</p>
                    </div>
                    <div class="column is-6">
                        <label class="label">Requested Time</label>
                        <div class="field flatpickr" id="requested_time">
                            <date-picker name="requested_time" icon="fa-clock-o" placeholder="Select a time" :config="{ enableTime: true, noCalendar: true, minuteIncrement: 15, appendTo: requested_time }"></date-picker>
                        </div>
                    </div>
                    <div class="column is-12">
                        <div class="field">
                            <label class="label">Requested Location</label>
                            <div class="control">
                                <div class="select is-fullwidth">
                                    <select name="requested_location" required>
                                        <option value="" >Select a location</option>
                                        <?php $locations = new Locations();
                                        foreach($locations->getLocations() as $location){ ?>
                                            <option value="<?php echo str_replace(' Clinic', '', $location['name']); ?>" <?php echo $requestedLocation == $location['slug'] ? 'selected' : '' ?> >
                                                <?php echo str_replace(' Clinic', '', $location['name']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Is there anything else you'd like us to know?</label>
                    <div class="control">
                        <textarea class="textarea" placeholder="Type your message here." name="additional_instructions"></textarea>
                    </div>
                </div>

                <div class="field" style="margin-top:2rem;">
                    <div class="control">
                        <strong>Subscribe to our eNewsletter?</strong>
                        <label class="radio">
                            <input type="radio" name="newsletter_signup" checked>
                            Yes
                        </label>
                        <label class="radio">
                            <input type="radio" name="newsletter_signup">
                            No
                        </label>
                    </div>
                </div>

            </div>
            <div class="column is-12 is-6-desktop">
                <label class="label">Requested Physician</label>
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
            </div>


        </div>

        <div class="columns is-multiline">


            <div class="column is-12 is-6-desktop">

            </div>

        </div>

        <button type="submit" class="button is-primary is-large" style="margin: -100px 0;">Submit Appointment Request</button>
    </form>
</div>

