<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

$photo = $physician['photo'] != '' ? $physician['photo'] : 'http://bulma.io/images/placeholders/256x256.png';
$specialties = $physician['specialties'] != '' ? explode('<br />', nl2br($physician['specialties'])) : [];
?>
<div class="mini-physician-thumb is-centered">

    <figure class="image">
        <img src="<?php echo $photo; ?>">
    </figure>

    <p class="physician-name"><?php echo $physician['name']; ?></p>
    <p class="physician-specialties">
    <?php foreach($specialties as $specialty){
        echo $specialty.'<br>';
    } ?>
    </p>
    <p class="physician-link"><a href="<?php echo $physician['link']; ?>" >View video & more</a></p>

</div>
