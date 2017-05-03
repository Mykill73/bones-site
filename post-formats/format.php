
              <?php
                /*
                 * This is the default post format.
                 *
                 * So basically this is a regular post. if you don't want to use post formats,
                 * you can just copy ths stuff in here and replace the post format thing in
                 * single.php.
                 *
                 * The other formats are SUPER basic so you can style them as you like.
                 *
                 * Again, If you want to remove post formats, just delete the post-formats
                 * folder and replace the function below with the contents of the "format.php" file.
                */
              ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <header class="article-header entry-header">

                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>

                    <?php printf( __( '', 'bonestheme' ).' %1$s %2$s',
                       /* the time the post was published */
                      
                       '<p><div class="mpdate" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</div><div class="mpauthor"> BY ' . get_the_author_link( get_the_author_meta( 'ID' ) ). '</div><div class="mpcategory"> ' . get_the_category_list(', ') .'</div></p>',
                       /* the author of the post */

                        '</span>'

                    ); ?>

 				<?php
                    if ( has_post_thumbnail() ) {
                         the_post_thumbnail(array(720,720));
                    }
                    else {
                         echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/thumbnail-default.jpg"  />';
                    }
					
                    the_content();
                  ?>
                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                 
                </section> <?php // end article section ?>

                <footer class="article-footer">

                <div class="mpauthorblock"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID'), 40);  ?></div>
                <?php $user_info = get_userdata(2); echo $user_info->description ?></div>

                </footer>  
                <?php // end article footer ?>

                <?php //comments_template(); ?>

              </article> <?php // end article ?>
