<?php

// BEGIN NEWS/Lrahos Widget 
add_action( 'widgets_init', 'register_news_widget' );

function register_news_widget() {
    register_widget( 'News_Widget' );
}

class News_Widget extends WP_Widget {
    function News_Widget() {
        $widget_ops = array( 'classname' => 'news_widget', 'description' => __('A widget that displays the News ', 'kino') );
        $control_ops = array( 'id_base' => 'news-widget' );
        $this->WP_Widget( 'news-widget', __('1. News Widget', 'kino'), $widget_ops, $control_ops );
    }
    function widget( $args, $instance ){
        
        $cat_news = lang_category_id(38);
        $cat_main = lang_category_id(17);
        
        $catName = get_the_category_by_ID($cat_news);
       
        //print_r($myPost);
        $category_link = get_category_link($cat_news);
        //$args = query_posts('cat=' . $cat_news .'&posts_per_page=15');
        $query = query_posts('cat=' . $cat_news .',-'. $cat_main. '&posts_per_page=15');
    ?>    
        <div class="row-fluid ">
            <div class="col-md-12 line_pattern_widget">
                <span class="widget_title">
                    <a href="<?php echo esc_url($category_link); ?>"><?php echo $catName; ?> </a>
                </span></div>
        </div>

        <div class="row-fluid sidebar_news shadowBox">
        <?php while (have_posts()) : the_post(); ?>
            <div class="col-md-12 item"> 
                <div class="row">
                    <div class="col-md-3">
                        <?php the_post_thumbnail( array(48, 48), array('class' => 'img-thumbnail')); ?>
                    </div>
                    <div class="col-md-9"> <a class="sl_content" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </div>
                </div>
            </div>
        <?php endwhile; ?> 
        <?php wp_reset_query(); ?>    
        </div>
        <div class="widget_buttom_line"></div>
    <?php
    }
}
// END NEWS/Lrahos Widget 
