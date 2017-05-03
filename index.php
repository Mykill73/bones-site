<?php get_header(); ?>

			<div id="content" class="poliskey_songlr">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : query_posts( 'cat=-12' ); while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header entry-header">

                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                     <?php printf( __( '', 'bonestheme' ).' %1$s %2$s',
                       /* the time the post was published */
                      
                       '<p><div class="mpdate" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</div>
                        <div class="mpauthor"> BY ' . get_the_author_link( get_the_author_meta( 'ID' ) ). '</div>
                        <div class="mpcategory"> ' . get_the_category_list(', ') .'</div></p>',
                       /* the author of the post */

                        '</span>'

                     ); ?>
								<section class="entry-content cf" itemprop="articleBody">
									<div class="d-1of3"><?php
										
											if ( has_post_thumbnail() ) {
										    the_post_thumbnail('portfolio-blog');
										}
										else {
										    echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
										        . '/library/images/default.jpg" />';
										}
						
										 ?></div>
                                         <div class="d-2of3">
                                         <?php
										$content = get_the_content(); echo mb_strimwidth($content, 0, 300, '...'); ?>
										<?php echo '<div style="margin: 10px auto; "></div>';
										echo '<a href="'; ?><?php the_permalink() ?>
										<?php echo '">Read more </a>'; ?>
                                        </div>
                                        
                                        <?php
										

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
									?>
								</section>


								<footer class="article-footer">

                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</main>

						<?php get_sidebar(); ?>

				</div>

			</div>


<?php get_footer(); ?>