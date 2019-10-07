<?php

/*-----------------------------------------------------------------------------------
Name: Youtube Playlist  Widget
Description: About Widget - Youtube Playlist Widget	
-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget.
add_action( 'widgets_init', 'youtube_playlist_widgets' );


// Register widget.
function youtube_playlist_widgets() {
	register_widget( 'youtube_playlist_Widget' );
}

// Widget class.
class youtube_playlist_Widget extends WP_Widget {

/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
	function youtube_playlist_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'youtube_playlist_widget', 'description' => __('Youtube Playlist - Show youtube Playlist', 'kino') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'youtube_playlist_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'youtube_playlist_widget', __('2. Youtube Playlist Widget', 'kino'), $widget_ops, $control_ops );
	}
/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
	function widget( $args, $instance ) {		
		
            $title = apply_filters('widget_title', $instance['title'] );

            /* Our variables from the widget settings. */
//            /echo $title;	

            $style = 'style="width:345px;height:230px;border:0;"';
            $src = "http://www.youtube.com/embed/?listType=playlist&amp;list=PLVxF2ESbMRxl3atOJXmwCyTOVBBAwW0Go&amp;version=2&amp;modestbranding=1&amp;showinfo=1&amp;theme=dark&amp;controls=1&amp;color=1&amp;start=0&amp;loop=0&amp;iv_load_policy=1&amp;fs=1&amp;disablekb=1&autoplay=0";
         ?>
            <div class="row playlist">
                <div class="col-md-12">
                    <iframe class="youlist" <?php echo $style; ?> src=<?php echo $src ; ?> ></iframe>
                </div>
            </div>
	<?php	
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display Widget */
		?>

            <?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings
/*-----------------------------------------------------------------------------------*/
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(		
		    'title' => ''		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

            <!-- Widget Title: Text Input -->
            <p>
              <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php _e('Title:', 'kino') ?>
              </label>
              <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
            </p>

            <?php
	}
}