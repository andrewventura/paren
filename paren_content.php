<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" class="paren_hentry">
	<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<?php
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
			$url = $thumb['0'];
		?>
		<div class="paren_entry-thumbnail" style="background:url('<?=$url?>'); background-size: 100% 100%;">
		</div>
	<?php endif; ?>

	<section class="paren_entry">
		<header class="paren_entry-header">
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="paren_entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>

			<div class="paren_entry-meta">
				<?php twentythirteen_entry_meta(); ?>
				<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="paren_entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="paren_entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		?>
	</div><!-- .entry-content -->
	</section><!-- .entry -->
		<div class="review-sidebar">
			<div class="review-tracks">
				<h6>FROM THIS RELEASE</h6>
				<div class="track">
					<article><a href="#"><span class="genericon genericon-video"></span></a><span>"Know Yourself" (via SoundCloud)</span></article>
					<article><a href="#"><span class="genericon genericon-video"></span></a><span>"Energy" (via SoundCloud)</span></article>
				</div>
			</div>
			<div class="review-meta">
				<div>
					<?php if (class_exists('MultiPostThumbnails')) :
					MultiPostThumbnails::the_post_thumbnail( get_post_type(), 'secondary-image', $post_id, array( 400, 400 ) );
						endif; ?>
					<span><?php $key='Score'; echo get_post_meta($post->ID, $key, true); ?></span>
					<span>/10</span>
				</div>
				<section>
					<span class="release"><?php $key='Release'; echo get_post_meta($post->ID, $key, true ); ?></span><!-- Gets 'Artist' custom field -->
					<br />
					<span>Artist: <?php $key='Artist'; echo get_post_meta($post->ID, $key, true ); ?></span>
					<br />
					<span>Label: <?php $key='Label'; echo get_post_meta($post->ID, $key, true ); ?> // <?php $key='Year'; echo get_post_meta($post->ID, $key, true ); ?></span>
					<br />
					<section class="external-links">
						<span class="aff-links">Find it at:</span>
						<span><a href="#">Amazon</a> | <a href="#">Spotify</a> | <a href="#">iTunes</a></span>
					</section>
				</section>
			</div>
		</div>
	<?php endif; ?>


	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->