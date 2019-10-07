<?php 
    get_header(); 
    
    $post_id = get_the_ID();

    global $wpdb;
    $row = $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . $wpdb->prefix . 'most_read_hits' . ' tc WHERE post_ID = %d', $post_id), ARRAY_A);
?>

<div class="container">
        <div class="main_content">   
            <div class="row">
                <div class="col-md-8">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <ul class="kino-item-meta">
                            <li><?php echo get_the_date('g:i F j, Y '); ?></li>
                            <li>
                                <?php the_category(' '); ?>
                            </li>
                            <li>
                                <?php the_author_posts_link(); ?>  
                            </li>  
                        </ul>
                        <div class="entry">
                            <?php the_content(); ?>
                            <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
                            <?php the_tags('Tags: ', ', ', ''); ?>
                        </div>
                        <?php //edit_post_link('Edit this entry', '', '.'); ?>
                    </div>
                    <div class="row socials">
                        <div class="col-lg-6">
                            <div id="fb-root"></div>
                            <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
                            <fb:like href="<?php echo get_permalink(); ?>" data-layout="button_count" show_faces="true" width="450" send="true">
                            </fb:like>                       
                        </div>
                        <div class="col-lg-6 single-view-count" > 
                            Դիտվել է <?php echo $row['hits']; ?> անգամ
                        </div>
                    </div>
                    
                    <?php comments_template(); ?>
                    <?php endwhile; endif; ?>
                    
                    
                    
                </div>
                <div class="col-md-4">
                   
                   <?php
                    if (is_active_sidebar('single_sidebar')) :
                        dynamic_sidebar('single_sidebar');
                    endif;
                    ?>
                </div>
            </div>
        </div>
</div>

<?php get_footer(); ?>