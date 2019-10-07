<?php

// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'meetings_last_video_widgets' );


// Register widget.
function meetings_last_video_widgets() {
	register_widget( 'meetings_last_video_Widget' );
}

// Widget class.
class meetings_last_video_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function meetings_last_video_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'meetings_last_video_widget', 'description' => __('Show last video from category meetings', 'kino') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'meetings_last_video_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'meetings_last_video_widget', __('3. Meetings Last Widget', 'kino'), $widget_ops, $control_ops );
	}
/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {
		
                $cat = lang_category_id(577);
                global $query_string;
                $myPost = query_posts('cat=' . $cat . '&posts_per_page=1');
                $postID = $myPost['0']->ID;
                $catName = get_the_category_by_ID($cat);
                //print_r($myPost);
                $category_link = get_category_link($cat);
                
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?>
                <div class="video-item">
                    
                    <div class="row-fluid ">
                        <div class="col-md-12 line_pattern_widget">
                            <span class="widget_title">
                                <a href="<?php echo esc_url($category_link); ?>"><?php echo $catName ?></a>
                            </span>
                        </div>
                    </div>
              
                    
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>                  
                    <div class="widget_video">
                    <?php                        
                        $link = get_post_meta( $postID, '_youtube_link_key', true );
                        
                        if($link):
                            $shortcode = "[embed]".$link."[/embed]";
                            global $wp_embed;
                            echo $wp_embed->run_shortcode($shortcode);
                        endif;                        
                    ?>                   
                    </div>
                    <div class="line_dotted"></div>
                    <?php 
                           endwhile;
                           endif;
                    ?>
                    <?php wp_reset_query(); ?>
                    
                </div>
                <?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

}