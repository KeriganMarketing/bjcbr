<?php
/**
 * @package KMA
 * @subpackage kmaslim
 * @since 1.0
 * @version 1.2
 */

$headline = ($post->page_information_headline != '' ? $post->page_information_headline : $post->post_title);
$subhead = ($post->page_information_subhead != '' ? $post->page_information_subhead : '');
$content = $post->post_content;

if(strlen($content) > 200) {
    $content = $content.' ';
    $content = substr($content, 0, 200);
    $content = substr($content, 0, strrpos($content ,' '));
    $content = $content.'...';
}

?>
<div class="column is-4">
	<div class="article">
		<div class="article-image">
            <a class="article-footer-item" href="<?php echo get_the_permalink(); ?>">
			<figure class="image is-4by3">
			<img src="<?php echo the_post_thumbnail_url( 'medium' ); ?>">
			</figure>
            </a>
		</div>
		<div class="article-content">
			<?php echo $content; ?>
		</div>
		<div class="article-footer">
		    <a class="article-footer-item" href="<?php echo get_the_permalink(); ?>">Read More</a>
		</div>
	</div>
</div>
