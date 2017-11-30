<?php

use Includes\Modules\Helpers\MailChimp;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

if(isset($_POST['srgaerg534qgq34erg4wq5g45gq45g']) && $_POST['srgaerg534qgq34erg4wq5g45gq45g'] == ''){
    $mailChimp = new MailChimp();
    $message = $mailChimp->handleSubscriber($_POST['email_address']);
}
?>
<div class="enewsletter-signup" id="subscribe">
    <div class="container">
        <form method="post" class="form columns" name="mailchimp_subscribe" novalidate action="#subscribe">
            <div class="column is-half-desktop">
                <p class="form-instructions is-centered">
                    <?= $message != '' ? $message : 'Sign up to receive our quarterly Doctor\'s Orders e-newsletter.'; ?>
                </p>
            </div>
            <div class="column is-half-desktop">
                <div class="field is-grouped">
                    <p class="control is-expanded">
                        <input type="email" value="" name="email_address" class="input is-centered" placeholder="email address">
                    </p>
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="srgaerg534qgq34erg4wq5g45gq45g" tabindex="-1" value=""></div>
                    <p class="control">
                        <button type="submit" class="button is-primary is-outlined">
                            sign up
                        </button>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>
