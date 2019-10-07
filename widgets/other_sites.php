<?php

// BEGIN NEWS/Lrahos Widget 
add_action( 'widgets_init', 'register_other_sites_widget' );

function register_other_sites_widget() {
    register_widget( 'Other_Sites_Widget' );
}

class Other_Sites_Widget extends WP_Widget {
    function Other_Sites_Widget() {
        $widget_ops = array( 'classname' => 'other_sites_widget', 'description' => __('Displays the Other Site News ', 'kino') );
        $control_ops = array( 'id_base' => 'other_sites-widget' );
        $this->WP_Widget( 'other_sites-widget', __('Other Sites Widget', 'kino'), $widget_ops, $control_ops );
    }
    function widget( $args, $instance ){
        
        //$cat_other_sites = lang_category_id(914); //local
        $cat_other_sites = lang_category_id(1054); //server
        $cat_main = lang_category_id(17);
        
        $catName = get_the_category_by_ID($cat_other_sites);
       
        //print_r($myPost);
        $category_link = get_category_link($cat_other_sites);
        //$args = query_posts('cat=' . $cat_other_sites .'&posts_per_page=15');
        $query = query_posts('cat=' . $cat_other_sites .',-'. $cat_main. '&posts_per_page=15');
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
