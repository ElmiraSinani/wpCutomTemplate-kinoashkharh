<?php
// Add function to widgets_init that'll load our widget.
add_action('widgets_init', 'home_slider_widgets');

// Register widget.
function home_slider_widgets() {
    register_widget('home_slider_Widget');
}

// Widget class.
class home_slider_widget extends WP_Widget {
    /* ----------------------------------------------------------------------------------- */
    /* 	Widget Setup
      /*----------------------------------------------------------------------------------- */

    function home_slider_Widget() {

        /* Widget settings. */
        $widget_ops = array('classname' => 'home_slider_widget', 'description' => __('Show News Slider for Home page'), 'kino');
        /* Widget control settings. */
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'home_slider_widget');
        /* Create the widget. */
        $this->WP_Widget('home_slider_widget', __('Home News Slider', 'kino'), $widget_ops, $control_ops);
    }

    /* ----------------------------------------------------------------------------------- */
    /* 	Display Widget
    /*----------------------------------------------------------------------------------- */

    function widget($args, $instance) {
        
        $cat = lang_category_id(17);
        //global $query_string;
        $a = query_posts('cat=' . $cat . '&posts_per_page=1&order=ASC');
        //print_r($a);
        $i = 1;         

        /* Before widget (defined by themes). */
        echo $before_widget;
        /* Display Widget */
        ?>  
                
            <div class="line_pattern"></div>   
            <div id="home-slider" class="shadowBox">
                <div class="row-fluid">
                    <div class="col-md-12" >
                    <?php while (have_posts()) : the_post(); ?>                        
                        <div class="row-fluid sl_item" <?php if($i>1){ echo 'style="display: none;"'; }?> >                       
                            <div class="col-md-5">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail(array(270, 190), array('class' => "img-responsive img-thumbnail") ) ?>
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a class="sl_content" href="<?php the_permalink(); ?>">
                                    <h2 class="sl_title" ><?php the_title(); ?>  </h2>
                                    <p class="sl_txt"><?php the_excerpt(); ?> </p>
                                </a>
                            </div>
                        </div>
                     <?php $i++; ?>
                    <?php endwhile; ?>  
                    <?php wp_reset_query(); ?> 
                    </div>
                    

                 </div>  
                <?php 
                    $cat_lastNews = lang_category_id(916); //on local
                    //$cat_lastNews = lang_category_id(1053); //on server
                    //global $query_string;
                    $lastNewsQuery = query_posts('cat=' . $cat_lastNews . '&posts_per_page=4');
                    $j = 1;
                ?>
                
                <?php while (have_posts()) : the_post();?>
                <?php if($j%2 != 0 ){ echo '<div class="row-fluid sl_items">'; } ?>  
                <div class="col-md-6"> 
                    <div class="row">
                        <div class="col-md-3">
                            <?php the_post_thumbnail(array(77, 77), array('class' => "img-responsive img-thumbnail")); ?>
                        </div>
                        <div class="col-md-9"> <a class="sl_thumb_title" href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> </div>
                    </div>
                </div>
                <?php $j++; ?>
                <?php if($j%2 != 0 ){echo '</div>'; } ?> 
                <?php endwhile; ?>
                 <?php wp_reset_query(); ?>    
                <div class="menu_buttom_line"></div>
            </div>  <!-- End home-slider-->  
           
        <?php
        /* After widget (defined by themes). */
        echo $after_widget;
    }

   

}
