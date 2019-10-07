<?php
// Add function to widgets_init that'll load our widget.
add_action('widgets_init', 'pair_cats_widgets');

// Register widget.
function pair_cats_widgets() {
    register_widget('pair_cats_Widget');
}

// Widget class.
class pair_cats_widget extends WP_Widget {
    /* ----------------------------------------------------------------------------------- */
    /* 	Widget Setup
      /*----------------------------------------------------------------------------------- */

    function pair_cats_Widget() {

        /* Widget settings. */
        $widget_ops = array('classname' => 'pair_cats_widget', 'description' => __('Show Pair Categories By Custom choose'), 'kino');
        /* Widget control settings. */
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'pair_cats_widget');
        /* Create the widget. */
        $this->WP_Widget('pair_cats_widget', __('Home Pair Categoris Widget', 'kino'), $widget_ops, $control_ops);
    }

    /* ----------------------------------------------------------------------------------- */
    /* 	Display Widget
    /*----------------------------------------------------------------------------------- */

    function widget($args, $instance) {

        /* Before widget (defined by themes). */
        echo $before_widget;
        /* Display Widget */
        $right_catID = $instance['right_category_id'];
        $left_catID = $instance['left_category_id'];
        
        $cat_right = lang_category_id($right_catID);
        $cat_left  = lang_category_id($left_catID);       
        
        $left_cat_link  = get_category_link($cat_right);
        $right_cat_link = get_category_link($cat_left);
       
        $main_cat  = lang_category_id(17);
        $right_cat = lang_category_id($instance['right_category_id']);
        $left_cat  = lang_category_id($instance['left_category_id']);
        
        ?>
       
        <div class="row pair_categories">
            <div class="col-md-6 ">
                <div class="row-fluid">                 
                    <div class="col-md-12 line_pattern_widget">
                        <span class="widget_title"><a href="<?php echo esc_url($right_cat_link); ?>"> <?php echo get_cat_name($instance['left_category_id']) ?> </a></span>
                    </div>
                </div>
                <div class="row-fluid shadowBox pair_cats">                 
                    <div class="col-md-12">
                        <?php $i = 1; ?>
                        <?php query_posts('cat=' . $left_cat . '&posts_per_page=4'); ?>
                        <?php while (have_posts()) : the_post();?>     
                        <?php if( $i == 1 ): ?>
                        <div class="row pair_item_first">                                                   
                            <div class="col-md-12">
                                <div class="item_first_img"><?php the_post_thumbnail(array(300, 164), array('class' => 'img-thumbnail')); ?></div>
                                <div class="item_first_title"><a class="first_item_title" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></div>
                            </div>                                                  
                        <?php else: ?>
                        <div class="row pair_items">
                            <div class="col-md-3">
                                <?php the_post_thumbnail(array(48, 48), array('class' => 'img-thumbnail')); ?>
                            </div>
                            <div class="col-md-9"> <a class="thumb_title" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </div>
                         <?php endif; ?>
                         </div>
                         <?php $i++; ?>
                         <?php endwhile; ?>
                         <?php wp_reset_query(); ?>  
                    </div>
                </div>
                <div class="menu_buttom_line"></div>
            
            </div>
            <div class="col-md-6 ">
                <div class="row-fluid">                   
                    <div class="col-md-12 line_pattern_widget">
                        <span class="widget_title"><a href="<?php echo esc_url($left_cat_link); ?>"> <?php echo  get_cat_name($instance['right_category_id']) ?> </a></span>
                    </div>                   
                </div>
                <div class="row-fluid shadowBox pair_cats">                 
                    <div class="col-md-12 ">
                       <?php $j = 1; ?>
                       <?php query_posts('cat=' . $right_cat . '&posts_per_page=4'); ?>
                       <?php while (have_posts()) : the_post();?>   
                        <?php if( $j == 1 ): ?>  
                        <div class="row pair_item_first">                                                   
                            <div class="col-md-12">
                                <div class="item_first_img"><?php the_post_thumbnail(array(300, 164), array('class' => 'img-thumbnail')); ?></div>
                                <div class="item_first_title"><a class="first_item_title" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></div>
                            </div>                                                  
                        <?php else: ?>
                        <div class="row pair_items">
                            <div class="col-md-3">
                                <?php the_post_thumbnail(array(48, 48), array('class' => 'img-thumbnail')); ?>
                            </div>
                            <div class="col-md-9"> <a class="thumb_title" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </div>
                         <?php endif; ?>
                         </div>
                         <?php $j++; ?>
                         <?php endwhile; ?>
                         <?php wp_reset_query(); ?>  
                    </div>
                </div>
                <div class="menu_buttom_line"></div>
            </div>
            
        </div>
        
        
       
       
        
        
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
		    'title' => '',		
                    'right_category_id' => '',
                    'left_category_id' => ''		
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <!-- Widget Title: Text Input -->
        <p>
          <label for="<?php echo $this->get_field_id( 'title' ); ?>">
            <?php _e('Title:', 'kino') ?>
          </label>
          <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <hr>
        <p>
          <label for="<?php echo $this->get_field_id( 'right_category_id' ); ?>">
            <?php _e('Right Cat ID', 'kino') ?>
          </label>
          <input type="text" id="<?php echo $this->get_field_id( 'right_category_id' ); ?>" name="<?php echo $this->get_field_name( 'right_category_id' ); ?>" value="<?php echo $instance['right_category_id']; ?>" />
        </p>
        <hr>
        <p>
          <label for="<?php echo $this->get_field_id( 'left_category_id' ); ?>">
            <?php _e('Left Cat ID:', 'kino') ?>
          </label>
          <input type="text" id="<?php echo $this->get_field_id( 'left_category_id' ); ?>" name="<?php echo $this->get_field_name( 'left_category_id' ); ?>" value="<?php echo $instance['left_category_id']; ?>" />
        </p>
        <?php
	}

   

}
