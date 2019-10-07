<?php
/* -----------------------------------------------------------------------------------
  Name: Youtube Playlist  Widget
  Description: About Widget - Youtube Playlist Widget
  ----------------------------------------------------------------------------------- */


// Add function to widgets_init that'll load our widget.
add_action('widgets_init', 'related_posts_widgets');

// Register widget.
function related_posts_widgets() {
    register_widget('related_posts_Widget');
}

// Widget class.
class related_posts_Widget extends WP_Widget {
    /* ----------------------------------------------------------------------------------- */
    /* 	Widget Setup
      /*----------------------------------------------------------------------------------- */

    function related_posts_Widget() {

        /* Widget settings. */
        $widget_ops = array('classname' => 'related_posts_widget', 'description' => __('Show Related Posts By Tags', 'kino'));

        /* Widget control settings. */
        $control_ops = array('width' => 300, 'height' => 350, 'id_base' => 'related_posts_widget');

        /* Create the widget. */
        $this->WP_Widget('related_posts_widget', __('Related Posts By Tags', 'kino'), $widget_ops, $control_ops);
    }

    /* ----------------------------------------------------------------------------------- */
    /* 	Display Widget
      /*----------------------------------------------------------------------------------- */

    function widget($args, $instance) {

        $orig_post = $post;
        global $post;
        $tags = wp_get_post_tags($post->ID);
        
         if (ICL_LANGUAGE_CODE == 'hy') {
            $title = 'Հարակից թեմաներ';
        } elseif (ICL_LANGUAGE_CODE == 'ru') {
            $title = 'Похожие темы';
        } else {
            $title = 'Related Posts ';
        }

        if ($tags) {
            $tag_ids = array();
            foreach ($tags as $individual_tag)
                $tag_ids[] = $individual_tag->term_id;
            $args = array(
                'tag__in' => $tag_ids,
                'post__not_in' => array($post->ID),
                'posts_per_page' => 10, // Number of related posts that will be shown.
                'caller_get_posts' => 1
            );
            $my_query = new wp_query($args);
            if ($my_query->have_posts()) {
                ?>
                <div class="row-fluid ">
                    <div class="col-md-12 line_pattern_widget">
                        <span class="widget_title">
                            <a href="#"><?php echo $title; ?></a>
                        </span>
                    </div>
                </div>
                <div class="row-fluid sidebar_news shadowBox">
                <?php
                while ($my_query->have_posts()) {
                    $my_query->the_post();
                    ?>
                        <div class="col-md-12 item"> 
                            <div class="row">
                                <div class="col-md-3">
                    <?php the_post_thumbnail(array(48, 48), array('class' => 'img-thumbnail')); ?>
                                </div>
                                <div class="col-md-9"> <a class="sl_content" href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </div>
                            </div>
                        </div>

                    <?php
                }
                echo '
                        </div>
                        <div class="widget_buttom_line"></div>';
            }
        }
        $post = $orig_post;
        wp_reset_query();
    }

    /* ----------------------------------------------------------------------------------- */
    /* 	Widget Settings
      /*----------------------------------------------------------------------------------- */

    function form($instance) {

        /* Set up some default widget settings. */
        $defaults = array(
            'title' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>

            <!-- Widget Title: Text Input -->
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">
        <?php _e('Title:', 'kino') ?>
                </label>
                <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
            </p>

        <?php
    }

}
