<?php

use Includes\Modules\Facebook\FacebookFeed;

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
$content = $post->post_content;

if(strlen($content) > 200) {
    $content = $content.' ';
    $content = substr($content, 0, 200);
    $content = substr($content, 0, strrpos($content ,' '));
    $content = $content.'...';
}
$feed    = new FacebookFeed();
$results = $feed->fetch(9);
//echo '<pre>', print_r($results) , '</pre>';
$now     = time();
foreach ($results->data as $result) {
    if (strlen($result->message) > 0) {
        $trimmed = wp_trim_words($result->message, $num_words = 26, '...');
    } else {
        $trimmed = 'This just in...';
    }

    $photo_url = $feed->photo($result);
    ?>

    <div class="column is-4">
        <div class="clinic-news">
            <div class="article-image">
                <figure class="image is-4by3">
                    <?php if($result->type != 'video') { ?>
                        <a href="<?php echo $result->link; ?>" target="_blank">
                            <img src="<?php echo $photo_url; ?>" alt="<?php echo $result->caption; ?>" style="object-fit:cover;">
                            <?php echo '<pre>', printf($photo_url), '</pre>' ?>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo $result->link; ?>" target="_blank">
                            <iframe
                                    src="<?php echo 'https://www.facebook.com/plugins/video.php?href='.$result->link ?>"
                                    style="border:none;overflow:hidden"
                                    scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true" class="article-image">
                            </iframe>
                        </a>
                    <?php } ?>
                </figure>
            </div>
            <p class="is-centered" style="font-weight:lighter;">
                posted <?php echo human_time_diff($now, strtotime($result->created_time)); ?> ago
            </p>
            <p class="article-content">
                <?php echo $trimmed; ?>
            </p>
            <div class="article-footer">
                <a class="article-footer-item" href="<?php echo $result->link; ?>" target="_blank" >Read more on Facebook</a>
            </div>
        </div>
    </div>
<?php } ?>

<!--<div class="column is-4">-->
<!--	<div class="article">-->
<!--		<div class="article-image">-->
<!--            <a class="article-footer-item" href="--><?php //echo get_the_permalink(); ?><!--">-->
<!--			<figure class="image is-4by3">-->
<!--			<img src="--><?php //echo the_post_thumbnail_url( 'medium' ); ?><!--">-->
<!--			</figure>-->
<!--            </a>-->
<!--		</div>-->
<!--		<div class="article-content">-->
<!--			--><?php //echo $content; ?>
<!--		</div>-->
<!--		<div class="article-footer">-->
<!--		    <a class="article-footer-item" href="--><?php //echo get_the_permalink(); ?><!--">Read More</a>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
