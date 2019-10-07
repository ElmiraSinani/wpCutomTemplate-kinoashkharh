<?php get_header(); ?>
<?php if (have_posts()) : ?>  

    <div class="container">
     <div class="row conteiner-archive">
         <div class="col-md-12 line_pattern_widget">
                <span class="widget_title">  Search Results  </span>
            </div>
        </div>
    </div>
    <?php $videoCat = lang_category_id(12); ?>


    <div class="container">
        <div class="main_content">   
            <div class="row">
                <div class="col-md-12">
                    <?php while (have_posts()) : the_post(); ?>                    
                    
                    <div class="row kino-post-item">
                    
                        <div class="col-md-3 kino-item-image">
                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                <?php the_post_thumbnail( 'thumbnail', array('class'=>'img-thumbnail') ) ?>
                            </a>
                        </div>
                    
                        <div class="col-md-9 kino-item-data">
                            <a class="title" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                               <?php the_title(); ?>
                            </a>
                            <ul class="kino-item-meta">
                                <li>                                
                                    <?php echo get_the_date('g:i F j, Y '); ?>                                
                                </li>
                                <li>
                                    <?php the_category(' '); ?>
                                </li>
                                <li>
                                    <?php the_author_posts_link() ?>  
                                </li>                               
                                <?php if (has_category( $videoCat, get_the_ID())): ?>
                                <li>
                                    <img src ="<?php echo get_template_directory_uri() ?>/images/video.png" id="video-img">
                                </li>
                                <?php endif; ?>
                            </ul>
                            <a class="txt_content" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                                <p><?php the_excerpt(); ?> </p>
                            </a>
                        </div>
                    </div>
                    <div class="widget_buttom_line"></div>

                    <?php endwhile; ?>
                    <div class="text-center">
                        <?php kino_content_nav( 'nav-below' ); ?>               
                    </div>
                </div>
                
            </div>
            
            
        </div>                            
    </div>

<?php else : ?>
<div class="container">
    <div class="main_content">   
        <div class="row">
            <div class="col-md-12">
            <h2>Nothing found</h2>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php get_footer(); ?>