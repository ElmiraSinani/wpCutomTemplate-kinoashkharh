<?php

include("templates/inc/custom_nav_menu.php");
include("templates/inc/cpt_our_staff.php");
include("templates/inc/cpt_banners.php");
include("templates/inc/bunner_metabox.php");
include("templates/inc/youtube_link.php");

function kinotemplate_setup() {
	
	load_theme_textdomain( 'kino', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'kinotemplate_setup' );
function autoset_featured() {  
    global $post;	
    $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
    if (!empty($attached_image)) {
        //print_r($attached_image);exit;
        foreach ($attached_image as $attachment_id => $attachment) {
            //echo $attachment_id;exit;
            set_post_thumbnail($post->ID, $attachment_id);
        }
    }	
}  //end function

add_action('the_post', 'autoset_featured');
add_action('save_post', 'autoset_featured');
add_action('draft_to_publish', 'autoset_featured');
add_action('new_to_publish', 'autoset_featured');





function register_kino_menus() {
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu','kino'),
            'top-menu'    => __('Top Menu','kino'),
            'footer-menu' => __('Footer Menu','kino')
        )
    );
}
add_action('init', 'register_kino_menus');

// Add RSS links to <head> section
//automatic_feed_links();

function load_styles_and_scripts() {

    //load styles       
    wp_enqueue_style('bootstrap-styles', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');   
    if (!is_admin()) {
        wp_deregister_script('jquery');       
        wp_enqueue_script('jquery-min', get_template_directory_uri() . '/js/jquery-1.8.3.min.js', array(), '', true);
    }   
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array(), '', true);   
    wp_enqueue_script('common-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '', true);

}

add_action('wp_enqueue_scripts', 'load_styles_and_scripts');

// Clean up the <head>
function removeHeadLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
}

add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

// Declare sidebar widget zone
//if (function_exists('register_sidebar')) {
//    register_sidebar(array(
//        'name' => 'Sidebar Widgets',
//        'id' => 'sidebar-widgets',
//        'description' => 'These are widgets for the sidebar.',
//        'before_widget' => '<div id="%1$s" class="widget %2$s">',
//        'after_widget' => '</div>',
//        'before_title' => '<h2>',
//        'after_title' => '</h2>'
//    ));    
//}

function lang_category_id($id){
    if(function_exists('icl_object_id')) {
        return icl_object_id($id,'category',true);
    } else {
        return $id;
    }
}
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Register widgetized area and update sidebar with default widgets
 */
function kino_widgets_init() {
    register_sidebar( array (
            'name' => __( 'Home Sidebar Widgets', 'kino' ),
            'id' => 'main_sidebar',
            'description' => __( 'We use this sidebar for call main page widgets', 'kino'),
            'before_widget' => '<div class="second_sidebar shadowBox">',
            'after_widget' => '</div><div class="widget_buttom_line"></div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    ) );
    register_sidebar( array (
            'name' => __( 'Home Slide Posts Widgets', 'kino' ),
            'id' => 'home_slider_sidebar',
            'description' => __( 'We use this sidebar for home News Slider', 'kino'),
            'before_widget' => '',
            'after_widget' => "",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    ) );
    register_sidebar( array (
            'name' => __( 'Home Pair Category Widgets', 'kino' ),
            'id' => 'home_category_pairs',
            'description' => __( 'We use this sidebar for home categories', 'kino'),
            'before_widget' => '',
            'after_widget' => "",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    ) );
    register_sidebar( array (
            'name' => __( 'Second Slider Widgets', 'kino' ),
            'id' => 'second_sidebar',
            'description' => __( 'We use this sidebar for list archive like categories, search results...', 'kino'),
            'before_widget' => '<div class="second_sidebar shadowBox">',
            'after_widget' => '</div><div class="widget_buttom_line"></div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    ));
    register_sidebar( array (
            'name' => __( 'Single Post Widgets', 'kino' ),
            'id' => 'single_sidebar',
            'description' => __( 'We use this sidebar for single post page', 'kino'),
            'before_widget' => '<div class="second_sidebar shadowBox">',
            'after_widget' => '</div><div class="widget_buttom_line"></div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
    ));
}
add_action( 'init', 'kino_widgets_init' );

define('KINO_WIDGETS', get_template_directory() . '/widgets/');
// ============== Load widgets
require_once( KINO_WIDGETS .'news_lrahos.php' );
require_once( KINO_WIDGETS .'youtube_playlist.php' );
require_once( KINO_WIDGETS .'meetings_video.php' );
require_once( KINO_WIDGETS .'video_news.php' );
require_once( KINO_WIDGETS .'home_slider.php' );
require_once( KINO_WIDGETS .'home_pair_cats.php' );
require_once( KINO_WIDGETS .'related_posts.php' );
require_once( KINO_WIDGETS .'other_sites.php' );
require_once( KINO_WIDGETS .'vaveragroxner.php' );
require_once( KINO_WIDGETS .'azdagir.php' );



function get_kino_paging(){

                global $wp_query;
                $total_pages = $wp_query->max_num_pages;
                if ($total_pages > 1):
                    $current_page = max(1, get_query_var('paged'));
                ?>
                <ul class="pagination">
                    <li>
                        <?php
                        $args = array(
                                  'base' => get_pagenum_link(1) . '%_%',
                                  'format' => '/page/%#%',
                                  'current' => $current_page,
                                  'total' => $total_pages,
                                  'prev_text' => '«',
                                  'next_text' => '»'
                                );
                         $links = paginate_links($args);
                         $links = str_replace('<a ', '<li><a ', $links);
                         echo $links;
                       ?>
                    </li>
              </ul>           

            <?php endif;
}

add_filter('widget_text','execute_php',100);
function execute_php($html){
    if(strpos($html,"<"."?php")!==false){
            ob_start();
            eval("?".">".$html);
            $html=ob_get_contents();
            ob_end_clean();
    }
    return $html;
}


if ( ! function_exists( 'kino_content_nav' ) ) :
    /**
     * Displays navigation to next/previous pages when applicable.
     *
     * @since Twenty Twelve 1.0
     */
    function kino_content_nav( $html_id ) {
            global $wp_query;

            $html_id = esc_attr( $html_id );
            if ( function_exists( 'wp_paginate' ) ) {
                    wp_paginate();
            }
            else {
                if ( $wp_query->max_num_pages > 1 ) : ?>
                        <nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
                                <h3 class="assistive-text"><?php _e( 'Post navigation', 'kino' ); ?></h3>
                                <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'kino' ) ); ?></div>
                                <div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'kino' ) ); ?></div>
                        </nav><!-- #<?php echo $html_id; ?> .navigation -->
                <?php endif;
            }
    }
endif;


?>
