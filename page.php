<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="container">
<div class="row conteiner-archive">
    <div class="col-md-12 line_pattern_widget">
           <span class="widget_title">  
              <h2><?php the_title(); ?></h2>        
           </span>
       </div>
   </div>
</div>

<div class="container">
    <div class="main_content">   
        <div class="row">
            <div class="col-md-12">
                <div class="post" id="post-<?php the_ID(); ?>">
                    <div class="entry">
                            <?php the_content(); ?>				
                    </div>			
                </div>		
                <?php // comments_template(); ?>
                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>