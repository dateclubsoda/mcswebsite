<?php get_header(); ?>
<main id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
</main>
<div class="read-next-bar-wrapper">
	<div class="read-next-bar"></div>
	<span>Read next</span>
	<div class="read-next-bar"></div>
</div>
<?php $next_post ?>
<div class="more-blog-posts">
	<div class="first-post">
		<?php if ( have_posts() ) : while( have_posts()  ) : the_post(); ?>
			<?php $next_post=get_adjacent_post(false, '', true);
				if ($next_post) :
					echo '<a href="'. get_permalink($next_post->ID) .'">';
					echo '<h1>'. get_the_title($next_post->ID) .'</h1>';
					echo get_the_post_thumbnail($next_post->ID);
					echo '</a>';
					echo '<p>'. get_the_excerpt($next_post->ID) .'</p>';
				endif;
			?>
		<?php endwhile; endif; ?>
	</div>
	<div class="second-post">	
		<?php
			$args = array(
				'numberposts' => 100,
				'orderby' => 'date',
				'order' => 'DESC',
			);
			$posts = get_posts( $args );
			$stop_loop=false;
			if ( ! empty( $posts )) {
				foreach ( $posts as $p ) {
					if ($stop_loop) {
						echo '<a href="'. get_permalink($p->ID) .'">';
						echo '<h1>'. get_the_title($p->ID) .'</h1>';
						echo get_the_post_thumbnail($p->ID);
						echo '</a>';
						echo '<p>'. get_the_excerpt($p->ID) .'</p>';
						break;
					}
					if ($p == $next_post) {
						$stop_loop = true;
					}
				}
			}
		?>
	</div>
</div>
<?php get_footer(); ?>
<script>
	jQuery(document).ready(() => {
		var html = document.getElementsByTagName("html")[0];
		html.style.backgroundImage = "linear-gradient(180deg, #2A1368 0%, #06041D 75%, #06041D 100%)";
		var footerContainer = document.getElementById("footer-border-container");
		footerContainer.style.borderTop = "1px solid rgba(142,122,140,0.4)";
		var wrapper = document.getElementById("wrapper");
		wrapper.style.marginBottom = "unset";
	});
</script>