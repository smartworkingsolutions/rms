<?php
/**
 * The template part for displaying CTA in knowledge bank archive page.
 *
 * @package RMS
 */

?>

<div class="share-text mr-2"><?php esc_html_e( 'Share -', 'rms' ); ?></div>
<ul class="icons flex space-x-3">

	<li><a href="//www.facebook.com/share.php?m2w&s=100&p[url]=<?php echo rawurlencode( get_permalink() ); ?>&p[images][0]=<?php echo rawurlencode( $img_url ); ?>&p[title]=<?php echo rawurlencode( get_the_title() ); ?>&u=<?php echo rawurlencode( get_permalink() ); ?>&t=<?php echo rawurlencode( get_the_title() ); ?>" class="hover:text-primary" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fab fa-facebook"></i></a></li>

	<li><a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink( $post->ID ) ); ?>&media=<?php echo rawurlencode( $img_url ); ?>&description=<?php get_the_title(); ?>" class="hover:text-primary" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fab fa-pinterest"></i></a></li>

	<li><a title="Click to share this post on Twitter" href="http://twitter.com/intent/tweet?text=<?php echo rawurlencode( get_the_title() ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>" class="hover:text-primary" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a></li>

	<li><a href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&title=<?php echo rawurlencode( get_the_title() ); ?>&source=<?php echo 'url'; ?>" class="hover:text-primary" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-linkedin"></i></a></li>

</ul>
