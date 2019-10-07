<?php
/**
 * Template Name: Հեղինակներ
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
 <?php $args = array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => 'author',
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => 'login',
	'order'        => 'ASC',
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => ''
 ); ?>

<div class="container">
    <div class="conteiner-archive row">
        <div class="col-md-12 line_pattern_widget">
            <span class="widget_title"><h2><?php echo get_the_title(); ?></h2></span>
        </div>    
    </div>
</div>

 <div class="container">
        <div class="main_content">   
            <div class="row">
                <div class="col-md-8">     
                    <?php  $users = get_users( $args ); ?> 
             
                    <?php foreach($users as $item): ?>
                        <div class="row kino-post-item">                    
                            <div class="col-md-3 user-item-image"> 
                                <?php userphoto($item->ID); ?>
                            </div> 
                            <div class="col-md-9 kino-item-data">
                                <a class="title" href="<?php echo get_author_posts_url($item->ID) ?>" title="<?php echo $item->display_name ?>">
                                    <?php echo $item->display_name ?>
                                </a>
                            </div> 
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="col-md-4">
                <?php
                if (is_active_sidebar('second_sidebar')) :
                    dynamic_sidebar('second_sidebar');
                endif;
                ?>
                </div>
        </div>
    </div><!-- #content -->
</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>