<?php

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'vaveragroxner_video_widgets' );


// Register widget.
function vaveragroxner_video_widgets() {
	register_widget( 'vaveragroxner_video_Widget' );
}

// Widget class.
class vaveragroxner_video_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function vaveragroxner_video_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'vaveragroxner_video_widget', 'description' => __('Show last video from category Vaveragroxner', 'kino') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'vaveragroxner_video_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'vaveragroxner_video_widget', __('5. Vaveragroxner Last Widget', 'kino'), $widget_ops, $control_ops );
	}
/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
        
        $cat_news = lang_category_id(352);
                
        $catName = get_the_category_by_ID($cat_news);
       
        //print_r($myPost);
        $category_link = get_category_link($cat_news);
        //$args = query_posts('cat=' . $cat_news .'&posts_per_page=15');
        $query = query_posts('cat=' . $cat_news .'&posts_per_page=15');
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