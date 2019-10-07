
<div class="container">
        <div class="row">
            <div class="col-md-12 footer-adv">                
                
                <?php                
                //$catId = lang_category_id(913);               
                $catId = lang_category_id(1075);               
                $query_args = array(
                    'post_type' => 'banners',
                    'showposts' => '1',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'banners_category',
                            'field' => 'id',
                            'terms' => $catId
                        )
                    ),
                );
                $query = query_posts($query_args);
              
                if (have_posts()) : while (have_posts()) : the_post(); 
                    $meta = get_post_meta( $post->ID, 'wp_banner_attachment', true ); 
                ?>  
                <span class="banner_borders">
                <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="1000" HEIGHT="80" id="Yourfilename" ALIGN="">                
                    <PARAM NAME=movie VALUE="<?php echo $meta['url']; ?>">                
                    <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#999 > 
                    <EMBED src="<?php echo $meta['url']; ?>" quality=high bgcolor=#999 WIDTH="728" HEIGHT="90" NAME="Yourfilename" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
                    </EMBED> 
                </OBJECT>
                </span>
                <?php endwhile; endif; ?>
                <?php wp_reset_query(); ?> 
                
            </div>
        </div>        
               
    </div>
</div>

<div class="footer">
   
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    wp_nav_menu( array( 
                          'theme_location' => 'footer-menu',                                         
                          'menu_class'      => 'footer-menu',
                          'container'       => 'ul'
                    ) ); 
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                Էլ-փոստ՝ info@kinoashkharh.am, kinoashkharh@gmail.com, հեռ.՝ 055 438435
            </div>
            <div class="col-md-6">
                &copy;<?php echo date("Y"); echo " "; ?>
                Բոլոր իրավունքները պաշտպանված են ՀՀ օրենսդրությամբ: 
                Կայքի հրապարակումների մասնակի կամ ամբողջական օգտագործման ժամանակ հղումը կայքին պարտադիր է:
            </div>
        </div>
        <div class="footer_socials">
            <?php ?>
        </div>
            
    </div>
   
</div>

	

	<?php wp_footer(); ?>
	
	<!-- Don't forget analytics -->
	
</body>

</html>
