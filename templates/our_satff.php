<?php
/* Template Name: Our Staff  */
?>

<?php get_header(); ?>

<div class="container">
    <div class="conteiner-archive row">
        <div class="col-md-12 line_pattern_widget">
            <span class="widget_title"><h2><?php echo get_the_title(); ?></h2></span>
        </div>    
    </div>
</div>

<div class="container">
    <div class="main_content">        
         
        
            <?php               
            //query_posts(array('post_type' => 'rules', 'showposts' => 5, 'rules_category' => 'adoption_abroad' ));
            $catId = lang_category_id(890);
            query_posts( array('post_type' => 'our_staff', 'terms' => array($catId), 'order' => 'ASC' ));
            if (have_posts()) : while (have_posts()) : the_post();                
            ?>   
            <div class="row our_staff">
                <div class="col-md-3 text-center">   
                    <?php $image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
                    <img src="<?php echo $image; ?>" alt="" class="img-thumbnail staff_img" />                                       
                </div>                   
                <div class="col-md-9">
                    <div class="staff_title"><?php the_title(); ?></div>
                    <div class="staff_txt"><?php the_content(); ?></div> 
                </div>
            </div>  
            <?php endwhile; else: ?>

            <div class="row"><?php _e('Sorry, no posts matched your criteria.'); ?></div>
            <?php endif; ?>
            <?php wp_reset_query(); ?>  
            
              
    </div>
</div>





<?php get_footer(); ?>