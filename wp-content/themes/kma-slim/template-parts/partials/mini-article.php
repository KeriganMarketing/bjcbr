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
$numberOfPosts = is_page('home') ? 3 : 9;
$feed    = new FacebookFeed();
$results = $feed->fetch($numberOfPosts);
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
                <?php if($result->type != 'video') { ?>
                <figure class="image is-4by3">
                        <a href="<?php echo $result->link; ?>" target="_blank">
                            <img src="<?php echo $photo_url; ?>" alt="<?php echo $result->caption; ?>" >
                        </a>
                </figure>
                <?php } else { ?>
                <figure class="image video is-4by3">
                    <iframe
                            src="<?php echo 'https://www.facebook.com/plugins/video.php?href='.$result->link ?>"
                            style="border:none;overflow:hidden"
                            scrolling="no"
                            frameborder="0"
                            allowTransparency="true"
                            allowFullScreen="true"
                            class="article-image"
                            width="100%"
                            height="460">

                    </iframe>
                </figure>
                <?php } ?>
            </div>
            <div class="article-content is-centered">
                <p>posted <?php echo human_time_diff($now, strtotime($result->created_time)); ?> ago</p>
                <p><?php echo $trimmed; ?></p>
            </div>
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
