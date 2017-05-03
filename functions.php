<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'poliskey', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );
  // cleaning up excerpt
  add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/


// Thumbnail sizes
add_image_size( 'portfolio-desktop', 350, 197, array( 'left', 'top' ) );
add_image_size( 'portfolio-blog', 250, 141, array( 'left', 'top' ) );
add_image_size( 'portfolio-single', 1100, 2000, true );
add_image_size( 'home-blog', 500, 281, true );
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/



function mp_add_nf_styles( $form_id ) {
    if( $form_id == 1 ) {
        echo '<style>
        .ninja-forms-form-wrap input, .ninja-forms-form-wrap select, .ninja-forms-form-wrap textarea {
        width: auto;
        height: 40px !important;
        vertical-align: inherit;
        }
        input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], select, textarea, .field {
        display: block;
        height: 40px;
        line-height: 1em;
        padding: 0 12px;
        margin-bottom: 14px !important;
        font-size: 1em;
        color: #5c6b80;
        border-radius: 0px;
        vertical-align: middle;
        box-shadow: none;
        border: 0;
        width: 100% !important;
        max-width: 100% !important;
        font-family: "Lato", "Helvetica Neue", Helvetica, Arial, sans-serif;
        background-color: #eaedf2;
        -webkit-transition: background-color 0.24s ease-in-out;
        transition: background-color 0.24s ease-in-out;
        }
        .field-wrap.label-left .ninja-forms-field, .field-wrap.label-left .ninja-forms-star-rating-control {
        margin-left: 0px !important;
        }
        .field-wrap, #ninja_forms_required_items {
        margin-bottom: 7px !important;
        }
        .ninja-forms-required-items {
          display: none;
        }
        .ninja-forms-req-symbol {
          color: #333 !important;
        }
        .ninja-forms-response-msg, .ninja-forms-success-msg {
        text-align: center;          
        }
        </style>';
    }
}
add_action ( 'ninja_forms_display_css', 'mp_add_nf_styles' );

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/*
This is a modification of a function found in the
twentythirteen theme where we can declare some
external fonts. If you're using Google Fonts, you
can replace these fonts, change it in your scss files
and be up and running in seconds.
*/
function bones_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');
  wp_enqueue_style('googleFonts2', 'http://fonts.googleapis.com/css?family=Raleway:400,700,500');
  wp_enqueue_style('googleFonts3', 'https://fonts.googleapis.com/css?family=Abel');
  wp_enqueue_script( 'script', get_template_directory_uri() . '/library/js/jquery.lazyload.min.js', array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'script', get_template_directory_uri() . '/library/js/scripts.js', array ( 'jquery' ), 1.1, true);
  wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js', false, '1.3.2');

}

add_action('wp_enqueue_scripts', 'bones_fonts');

/*function mpaddthis(){

 if(is_home() ) {

   

} else {
 wp_register_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56f6e8c9dcc04572', 1.1, true);
    wp_enqueue_script('addthis');
} 

}
add_action('wp_enqueue_scripts', 'mpaddthis');
*/


function onehalf( $atts, $content = null ) {
	
	// Attributes
  extract( shortcode_atts(
    array(
      'fa-icon' => 'fa-reddit-alien',
      'title' => 'puttitlehere',
	  'ytvideo' => 'youtube'
    ), $atts )
  );
  
    return '<div class="d-1of2">
	<div id="videoWithNoJs" class="videoWrapper">
	<iframe src="https://www.youtube.com/embed/' . $atts['ytvideo'] . '?wmode=transparent" frameborder="0" width="560" height="315" frameborder="0" allowfullscreen></iframe>
	</div><h3><i class="fa ' . $atts['fa-icon'] . ' "></i> ' . $atts['title'] . ' </h3><p>' .$content. '</p></div>';
	
}
add_shortcode("colsix", "onehalf");

function ytviddy( $atts, $content = null ) {
	
	// Attributes
  extract( shortcode_atts(
    array(
	  'ytvideo' => 'youtube'
    ), $atts )
  );
  
    return '
	<div id="videoWithNoJs" class="videoWrapper">
	<iframe src="https://www.youtube.com/embed/' . $atts['ytvideo'] . '?wmode=transparent" frameborder="0" width="560" height="315" frameborder="0" allowfullscreen></iframe></div>';
	
}
add_shortcode("video", "ytviddy");

function onethird( $atts, $content = null ) {

  // Attributes
  extract( shortcode_atts(
    array(
      'fa-icon' => 'fa-reddit-alien',
      'title' => 'puttitlehere',
    ), $atts )
  );

    return '<div class="d-1of3 t-1of3"><h3><i class="fa ' . $atts['fa-icon'] . ' "></i> ' . $atts['title'] . ' </h3><p>'.$content.'</p></div>';

}
add_shortcode("onethird", "onethird");

function goodbutton( $atts, $content = null ) {

  // Attributes
  extract( shortcode_atts(
    array(
      'fa-icon' => 'fa-reddit-alien',
      'title' => 'puttitlehere',
	  'link' => 'putlinkhere',
    ), $atts )
  );

    return '<div class="goodbutton"><a href="' . $atts['link'] . '" target="blank"><i class="fa ' . $atts['fa-icon'] . ' "></i> ' . $atts['title'] . ' '.$content.'</a></div>';

}
add_shortcode("goodbutton", "goodbutton");


function onefourth( $atts, $content = null ) {

  // Attributes
  extract( shortcode_atts(
    array(
      'fa-icon' => 'fa-reddit-alien',
      'title' => 'puttitlehere',
    ), $atts )
  );

    return '<div class="d-1of4 t-1of4 m-all fadecontent"><h3><i class="fa ' . $atts['fa-icon'] . ' "></i> </h3><p class="title">'.$atts['title'].'</p><p>' . $content . '</p></div>';

}
add_shortcode("onefourth", "onefourth");

add_action( 'widgets_init', 'poliskey_slug_widgets_init' );
function poliskey_slug_widgets_init() {
  register_sidebar( array(
      'name' => __( 'Footer 1', 'poliskey' ),
      'id' => 'footer-1',
      'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'poliskey' ),
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<h3 class="footerwidget">',
      'after_title'   => '</h3>',
    ) );
   register_sidebar( array(
      'name' => __( 'Footer 2', 'poliskey' ),
      'id' => 'footer-2',
      'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'poliskey' ),
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<h3 class="footerwidget">',
      'after_title'   => '</h3>',
    ) );
  register_sidebar( array(
      'name' => __( 'Footer 3', 'poliskey' ),
      'id' => 'footer-3',
      'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'poliskey' ),
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<h3 class="footerwidget">',
      'after_title'   => '</h3>',
    ) );
}

add_action('wp_head', 'add_googleanalytics');

function add_googleanalytics() { ?>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2314425-1', 'auto');
  ga('send', 'pageview');

</script>
<?php } 

function defer_parsing_of_js ( $url ) {
if ( FALSE === strpos( $url, '.js' ) ) return $url;
if ( strpos( $url, 'jquery.js' ) ) return $url;
return "$url' defer ";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );


/* DON'T DELETE THIS CLOSING TAG */ ?>