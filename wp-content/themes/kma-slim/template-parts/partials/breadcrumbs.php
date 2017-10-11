<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>
<section class="section breadcrumb-section">
    <div class="container">
        <div class="content">
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p class="breadcrumbs">', '</p>');
            }
            ?>
        </div>
    </div>
</section>