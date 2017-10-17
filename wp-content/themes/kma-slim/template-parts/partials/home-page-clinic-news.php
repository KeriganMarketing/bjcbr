<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */
?>

<div class="container">
    <h2 class="line-right">Clinic <strong>news</strong><span class="line"></span></h2>

    <div class="article-container">
        <div class="columns is-multiline">
            <?php
                get_template_part('template-parts/partials/mini-article', get_post_format());
            ?>
        </div>
    </div>
    <p class="is-centered"><a href="/news/" class="button is-primary is-outlined" style="margin-bottom: 35px;">Read all news</a></p>
</div>
