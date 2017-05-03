<?php get_header(); ?>

<div id="content">
<section id="thetop">
	<div class="center">
		<p>SINCE 1973</p>
		<h1>MICHAEL POLISKEY</h1>
		<a href="#portfolio" class="button" type="button">WORK</a>
		<a href="#contact" class="button" type="button">CONTACT</a>
		<div class="roundfront">
        <img src="<?php echo get_template_directory_uri(); ?>/library/images/pyramid_logo_white.svg" />
			<!--<div class="flip3d">
				<div class="back">1</div>
				<div class="front">2</div>
			</div>-->
		</div>
	</div>
		<!--<div class="roundfront">
			<div class="flip3d">
				<div class="back">1</div>
				<div class="front">2</div>
			</div>
		</div>-->
</section>
<section id="home">
	<div id="inner-content" class="wrap cf home">
		<div class="d-all t-all m-all" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
		</div>

	</div>
</section>
</div>
<section id="portfolionone"><a name="portfolio"></a>
	<div class="cf">
	<?php $loop = new WP_Query( array( 'post_type' => 'mp-portfolio', 'posts_per_page' => -1, 'orderby' => 'post_title', 'order' => 'ASC'  ) ); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="d-1of4 t-1of3 m-1of2">
			<div class="resp2">
			<a href="<?php the_permalink();?>"><?php global $post; ?><?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'portfolio-desktop', false, '' );?>
			<div class="portthumb lazy" style="background-image: url(<?php echo $src[0]; ?> ) !important; background-size:cover; width: 100%; height: auto; ">
				<div id="overlay">
				<span id="plus">
					<p><?php the_title(); ?></p><?php 
					//echo get_the_term_list( $post->ID, 'project-type', '', ', ', '' );
					$jebus = get_the_term_list( $post->ID, 'project-type', 'Type: ', ', ', '' );
					if (strpos($jebus, 'Web Design') !== false) {
						echo ' <i class="fa fa-laptop"></i>';
					} elseif (strpos($jebus, 'Video') !== false) {
						echo '<i class="fa fa-youtube-play"></i>';
					} 
					elseif (strpos($jebus, 'Illustration') !== false) {
						echo '<i class="fa fa-pencil"></i>';
					} 
					else {

					}
				 	?>
				 </span>
				 </div>
				 </div>
				 </a>
			</div>
			<div style="clear: both;"></div>
		</div>
	<?php endwhile; wp_reset_query(); ?>
	</div>
</section>
<section id="currently">
	<div id="inner-content" class="wrap cf home">
		<div class="d-all" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Currently">
			<?php $query = new WP_Query( 'pagename=i-am-currently' );
            // The Loop
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                    }
                    echo '<h2>';
                    the_title();
                    echo '</h2>';
                    the_content();
                }
            }
            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
		</div>
	</div>
</section>
<section id="thebottom"><a name="contact"></a>
<div id="inner-content" class="wrap cf home">
	    <div class="d-all" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Currently">
	    <h2>Contact</h2>
			<?php if( function_exists( 'ninja_forms_display_form' ) ) { ninja_forms_display_form( 1 );  } ?>
		</div>
		<!--<div class="roundfront">
			<div class="flip3d">
				<div class="back">1</div>
				<div class="front">2</div>
			</div>
		</div>-->
		</div>
</section>
<section id="blogarea">		
	<div id="inner-content" class="wrap cf home">
		<h2>Nothing Too Serious</h2>	
		<?php
		//The Query To Get Posts
		$my_query = new WP_Query('showposts=3&cat=-12');
		//Run the Query and Loop Through Results
		while ($my_query->have_posts()) : $my_query->the_post();
		$do_not_duplicate = $post->ID;
		?>
		<div class="d-1of3 t-1of3 m-all" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
		<?php 
		if ( has_post_thumbnail() ) {
		the_post_thumbnail('home-blog');
		}
		else {
		echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
			. '/images/thumbnail-default.jpg" />';
		}
		?>
        <h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
		<div class="mpdate"><?php echo get_the_date(); ?></div>
		<p><?php $string = get_the_content(''); $newString = substr($string, 0, 200); echo $newString; ?></p>
		<a href="<?php the_permalink() ?>" title="">Continue reading...</a>
		</div>
		<?php endwhile; ?>	

	</div>
</section>
<section id="featuredvideo">
	<div id="inner-content" class="wrap cf home">
		<div class="d-all t-all" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
			<?php $query = new WP_Query( 'pagename=featured-videos' );
            // The Loop
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                    $query->the_post();
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                    }
                    echo '<h2>';
                    the_title();
                    echo '</h2>';
                    the_content();
                }
            }
            /* Restore original Post Data */
            wp_reset_postdata();
            ?>
		</div>

	</div>
</section>
		
			

<?php get_footer(); ?>
