<?php 
/*
Template Name: HOME page
*/
get_header();
?>

<div class="container">
    <div class="main_content">
        <div class="row">
            <div class="col-md-8">  
                <?php 
                    if ( is_active_sidebar( 'home_slider_sidebar' ) ) : 
                        dynamic_sidebar( 'home_slider_sidebar' );
                    endif; 
                ?>                
                <?php 
                     if ( is_active_sidebar( 'home_category_pairs' ) ) : 
                         dynamic_sidebar( 'home_category_pairs' ); 
                     endif; 
                 ?>
                
            </div>
             <div class="col-md-4">
                <?php 
                    if ( is_active_sidebar( 'main_sidebar' ) ) : 
                        dynamic_sidebar( 'main_sidebar' ); 
                    endif; 
                ?>
            </div>
        </div>
        
    </div>
    
<?php

get_footer();