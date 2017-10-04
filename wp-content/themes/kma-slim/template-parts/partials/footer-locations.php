<?php

use Includes\Modules\Locations\Locations;

/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<div class="container">
    <div class="columns is-multiline">
        <div class="column is-12 is-9-desktop">

            <div class="columns is-multiline">
                <?php $locations = new Locations();
                foreach($locations->getLocations() as $location){ ?>
                    <div class="location column">
                        <h3><?php echo $location['name']; ?></h3>
                        <p class="address"><?php echo nl2br($location['address']); ?></p>
                        <p class="phone"><em>tel:</em> <a href="tel:<?php echo str_replace('(','',str_replace(') ', '-', $location['phone'])); ?>"><?php echo $location['phone']; ?></a></p>
                        <p class="phone"><em>fax:</em> <a href="tel:<?php echo str_replace('(','',str_replace(') ', '-', $location['fax'])); ?>"><?php echo $location['fax']; ?></a></p>
                    </div>
                <?php } ?>
            </div>

        </div>
        <div class="watermark column is-12 is-3-desktop">
            <img src="<?php echo get_template_directory_uri().'/img/bjc-tree.png'; ?>" alt="Bone & Joint Clinic of Baton Rouge" class="footer-watermark" >
        </div>
    </div>
</div>
