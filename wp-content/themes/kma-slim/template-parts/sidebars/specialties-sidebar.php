<?php
$parentId = wp_get_post_parent_id( $post->ID );
$pageList = get_children($parentId, [
    'post_parent' => $parentId,
    'post_type'   => 'page',
    'numberposts' => -1,
]);
?>
<div class="sidebar-module specialties-list">
    <p class="sidebar-title">Select another specialty</p>
    <ul class="none">
        <?php foreach ($pageList as $page){
            echo '<li>' .
                 ($post->ID != $page->ID ? '<a href="' . get_permalink($page->ID) . '" >' : '' ) .
                 $page->post_title .
                 ($post->ID != $page->ID ? '</a>' : '' ) . '</li>';
        } ?>
    </ul>
</div>