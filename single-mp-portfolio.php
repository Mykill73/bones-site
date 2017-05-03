<?php
/*
 * CUSTOM POST TYPE TEMPLATE
 *
 * This is the custom post type post template. If you edit the post type name, you've got
 * to change the name of this template to reflect that name change.
 *
 * For Example, if your custom post type is "register_post_type( 'bookmarks')",
 * then your single template should be single-bookmarks.php
 *
 * Be aware that you should rename 'custom_cat' and 'custom_tag' to the appropiate custom
 * category and taxonomy slugs, or this template will not finish to load properly.
 *
 * For more info: http://codex.wordpress.org/Post_Type_Templates
*/
?>

<?php get_header(); ?>

			<div id="content" class="poliskey_songlr">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-1of1 d-1of1 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

								<header class="article-header">

									<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>
									<!--<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) ), get_the_term_list( $post->ID, 'custom_cat', ' ', ', ', '' ) );
									?></p>-->
										
										<?php 
										
										echo '<div class="mplink"><i class="fa fa-external-link"></i> <a href="'.get_post_meta( get_the_ID(), 'link', true ) .'">Go to Site</a></div>';

										$jebus = get_the_term_list( $post->ID, 'project-type', 'Type: ', ', ', '' );

										if (strpos($jebus, 'Web Design') !== false) {

											echo '<div class="mpcat"><i class="fa fa-laptop"></i>'.get_the_term_list( $post->ID, 'project-type', '&nbsp;', ', ', '' ).'</div>';
				    
										} elseif (strpos($jebus, 'Video') !== false) {

											echo '<div class="mpcat"><i class="fa fa-youtube-play"></i>'.get_the_term_list( $post->ID, 'project-type', '&nbsp;', ', ', '' ).'</div>';
				   
										} 
										
										elseif (strpos($jebus, 'Illustration') !== false) {

											echo '<div class="mpcat"><i class="fa fa-pencil"></i>'.get_the_term_list( $post->ID, 'project-type', '&nbsp;', ', ', '' ).'</div>';
				   
										} 
										else {
				    
										}  
										?>

								</header>

								<section class="entry-content cf">
									<?php

									echo "<br />";
									
									$meta  = get_post_meta( get_the_ID(), 'youtube', true );
									$video = '<div class="videoWrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/'. $meta . str_repeat('" ', 1) . 'frameborder="0" allowfullscreen></iframe></div>';

										if(!empty($meta)) {
										
											echo $video;
											echo "<br />";

										} elseif(has_post_thumbnail()){
											
											the_post_thumbnail('portfolio-single');
											echo "<p></p>";
										
										} else {
											
										}

										
									
										the_content();

										

										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</section> <!-- end article section -->

								<footer class="article-footer">
									

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single-custom_type.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

						<!--<?php get_sidebar(); ?>-->

				</div>

			</div>

<?php get_footer(); ?>
