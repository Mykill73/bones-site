<?php get_header(); ?>

			<div id="content" class="poliskey_songlr">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
							?>
							
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

								<header class="entry-header article-header">

									 <h3 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>                 

					                    <?php printf( __( '', 'bonestheme' ).' %1$s %2$s',
					                       /* the time the post was published */
					                      
					                       '<p><div class="mpdate" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</div><div class="mpauthor" itemprop="author" itemscope itemptype="http://schema.org/Person"> BY ' . get_the_author_link( get_the_author_meta( 'ID' ) ). '</div><div class="mpcategory"> ' . get_the_category_list(', ') .'</div></p>',
					                       /* the author of the post */

					                        '</span>'

					                    ); ?>
								</header>
								<section class="entry-content cf">

									

								<?php	if ( has_post_thumbnail() ) {
										    the_post_thumbnail('portfolio-blog');
										}
										else {
										    echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
										        . '/library/images/default.jpg" />';
										}
										?>

									<p><?php $string = get_the_content(''); $newString = substr($string, 0, 250); echo $newString; ?></p>
		<a href="<?php the_permalink() ?>" title="">Continue reading <i class="fa fa-step-forward"></i></a>

								</section>

								<footer class="article-footer">

								</footer>

							</article>

							<?php endwhile; ?>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
