<?php

// BEGIN NEWS/Lrahos Widget 
add_action( 'widgets_init', 'register_azdagir_widget' );

function register_azdagir_widget() {
    register_widget( 'Azdagir_Widget' );
}

class Azdagir_Widget extends WP_Widget {
    function Azdagir_Widget() {
        $widget_ops = array( 'classname' => 'azdagir_widget', 'description' => __('Displays the category Azdagir', 'kino') );
        $control_ops = array( 'id_base' => 'azdagir-widget' );
        $this->WP_Widget( 'azdagir-widget', __('6. Azdagir Category Widget', 'kino'), $widget_ops, $control_ops );
    }
    function widget( $args, $instance ){
        
        //$cat_azdagir = lang_category_id(915); //local
        $cat_azdagir = lang_category_id(1055); //server
        $cat_main = lang_category_id(17);
        
        $catName = get_the_category_by_ID($cat_azdagir);
       
        //print_r($myPost);
        $category_link = get_category_link($cat_azdagir);
        //$args = query_posts('cat=' . $cat_azdagir .'&posts_per_page=15');
        $query = query_posts('cat=' . $cat_azdagir .',-'. $cat_main. '&posts_per_page=15');
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
