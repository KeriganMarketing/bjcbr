<?php

use Includes\Modules\Locations\Locations;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<div class="location-map">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRXeRhZCIYcKhtc-rfHCejAJsEW9rYtt4" ></script>
    <div class="full-width-map">
        <google-map :latitude="30.442075" :longitude="-91.368458" :zoom="14" >
            <?php $locations = new Locations();
            foreach($locations->getLocations() as $location){ ?>
                <pin :latitude="<?php echo $location['latitude']; ?>" :longitude="<?php echo $location['longitude']; ?>" title="<?php echo str_replace(' Clinic', '',$location['name']); ?>">
                    <p><strong><?php echo str_replace(' Clinic', '',$location['name']); ?></strong></p>
                    <p class="address"><?php echo nl2br($location['address']); ?></p>
                    <p class="phone"><em>tel:</em> <a href="tel:<?php echo str_replace('(','',str_replace(') ', '-', $location['phone'])); ?>"><?php echo $location['phone']; ?></a></p>
                    <p class="phone"><em>fax:</em> <a href="tel:<?php echo str_replace('(','',str_replace(') ', '-', $location['fax'])); ?>"><?php echo $location['fax']; ?></a></p>
                    <p class="appt-button"><a class="button is-info" href="https://www.google.com/maps/dir//<?php echo $location['latitude']; ?>,<?php echo $location['longitude']; ?>">Get Directions</a></p>
                </pin>
            <?php } ?>
        </google-map>
    </div>
</div>
