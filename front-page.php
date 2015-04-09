<?php
/*
Template Name: Home Page
*/

get_header(); ?>

<div id="primary" class="content-area"> <!-- main content area -->
	<div id="featured-container" class="front-page hero"> <!-- Featured Posts Slider -->
		<section id="news" class="news-ticker">
				<h2><a href="<?php bloginfo( 'url' ); ?>/category/news/" class="hero-labels">News</a></h2>
						<ul id="news-ticker-ul" class="news-ticker-ul">
							<?php $query = new WP_Query( array(
								'post_type' => 'post',
								'category_name' => 'News',
								'posts-per_page' => 10,
							) );
							while ($query->have_posts()) : $query->the_post(); ?>
							<li class="home news-ticker">
								<a href="<?php the_permalink(); ?>">
									<span><?php the_title(); ?></span>
								</a>
								<span class="news-ticker-ts"> – <?php echo human_time_diff( get_the_time( 'U' ), current_time('timestamp') ); ?></span>
							</li>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</ul>
			</section>
		<section id="featured-slider" class="featured-posts">
			<h2><a href="#" class="hero-labels">Featured</a></h2>
			<div class="featured-container">
				<ul id="featured-ul" class="featured-slider">
				<?php $query = new WP_Query( array(
					'meta_value' => 'isfeatured',
					'posts_per_page' => 5,
				) );
				while ($query->have_posts()) : $query->the_post(); ?>
					<li class="home featured" id="feature-li">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array(450,300) ); ?></a><!-- retrieves featured image for post -->
						<a href="<?php the_permalink(); ?>">
							<span class="featured-title"><?php the_title(); ?></span>
							<span><?php $category = get_the_category();
							echo $category[0]->cat_name; ?></span>
						</a>
					</li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</section><!-- /#featured-slider -->

		<div id="featured-right-column" class="featured-right">
			<section id="mixes" class="latest-mixes">
				<h2><a href="<?php bloginfo( 'url' ); ?>/category/mixes" class="hero-labels">Staff Mixes</a></h2>
				<div id="playlist-container">
					<p>Eventually some playlists will go here.</p>
				</div>
			</section><!-- /#playlists -->

			<!-- /#featured-slider -->
		</div>
	</div><!-- /#featured-container -->

<div id="three-column" class="three-column-container hero">

	<section id="reviews-container" class="front-page third-column"> <!-- Reviews Column -->
		<h2><a href="<?php bloginfo( 'url' ); ?>/category/reviews/">Reviews »</a></h2>
		<ul class="latest-reviews">
			<?php $query = new WP_Query( array(
				'post_type' => 'post',
				'category_name' => 'Reviews',
				'posts_per_page' => 4
			) );
			while ($query->have_posts()) : $query->the_post(); ?>
			<li class="home latest-reviews">
				<span class="date-label"><?php echo get_the_date( 'M j \a\t g:i A' ); ?></span>
				<a href="<?php the_permalink(); ?>" class="review-img-thumb">
					<?php if (class_exists('MultiPostThumbnails')) :
					MultiPostThumbnails::the_post_thumbnail( get_post_type(), 'secondary-image', $post_id, thumbnail, array( 'class' => 'review-thumb wp-post-image') );
						endif; ?></a>
					<!--<?php the_post_thumbnail( thumbnail, array( 'class' => 'review-thumb' ) ); ?></a><!-- retrieves featured image for post -->
				<a href="<?php the_permalink(); ?>" class="review-score"><span><?php $key='Score'; echo get_post_meta($post->ID, $key, true ); ?></span>
					<a href="<?php the_permalink(); ?>" class="meta">
						<div class="latest-reviews-meta">
							<span><?php $key='Release'; echo get_post_meta($post->ID, $key, true ); ?></span><!-- Gets 'Artist' custom field -->
							<br />
							<span><?php $key='Artist'; echo get_post_meta($post->ID, $key, true ); ?></span>
							<br />
							<span><?php $key='Label'; echo get_post_meta($post->ID, $key, true ); ?> // <?php $key='Year'; echo get_post_meta($post->ID, $key, true ); ?></span>
					</div></a>
			</li>
			<?php endwhile; ?>
		</ul>
	</section><!-- /#reviews-container -->

	<!-- Shows Column -->
	<section id="shows-container" class="front-page third-column">
		<h2><a href="<?php bloginfo( 'url' ); ?>/category/photos/">Visual »</a></h2>
		<ul class="featured">
			<?php $query = new WP_Query( array(
				'post_type' => 'post',
				'category_name' => 'Visual',
				'posts-per_page' => 3
			) );
			while ($query->have_posts()) : $query->the_post(); ?>
			<li class="home featured">
				<?php echo get_the_post_thumbnail(); ?><!-- retrieves featured image for post -->
				<br />
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
	</section><!-- /#shows-container -->

	<!-- Tracks Column -->
	<section id="tracks-container" class="front-page third-column">
		<h2><a href="<?php bloginfo( 'url' ); ?>/category/tracks/">Tracks »</a></h2>
		<ul class="tracks">
			<?php $query = new WP_Query( array(
				'post_type' => 'post',
				'category_name' => 'Tracks',
				'posts-per_page' => 8
			) );
			while ($query->have_posts()) : $query->the_post(); ?>
			<li class="home tracks">
				<!--<span class="date-label"><?php echo get_the_date( 'M j \a\t g:i A' ); ?></span> -->
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
		</ul>
	</section><!-- /#tracks-container -->
</div><!-- /.three-column-container -->
	
	<section id="all-posts" class="front-page recent-posts clear hero">
		<span class="recent-posts-label">All posts</span>
		<ul class="recent-posts">
			<?php $query = new WP_Query( array(
				'post-type' => 'post',
				'posts-per-page' => 12
			) );
			while ($query->have_posts()) : $query->the_post(); ?>
			<li class="recent-post-tile">
				<span><?php echo get_the_date( 'F j' ); ?></span>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		<?php endwhile; ?>
		</ul>
	</section>


</div><!-- /#primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>