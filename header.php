<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>        
        <meta charset="<?php bloginfo('charset'); ?>" />        
        <meta name="viewport" content="width=device-width" />        
        <title>kinoashkharh</title>        
        <link rel="profile" href="http://gmpg.org/xfn/11" />        
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />        
        <!-- Facebook Opengraph -->       
        <meta property="og:url" content="<?php echo the_permalink() ?>"/>       
        <?php if (is_single()) { ?>            
            <meta property="og:title" content="<?php echo single_post_title(''); ?>" />            
            <meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />	           
            <meta property="og:image" content="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" />        
        <?php } else { ?>     
            <meta property="og:title" content="<?php echo "kinoashkhar"; ?>" /> 
            <meta property="og:site_name" content="<?php echo "kinoashkhar.am"; ?>" />           
            <meta property="og:description" content="<?php echo bloginfo('description'); ?>" />            
            <meta property="og:image" content="<?php echo bloginfo('template_url') ?>/images/logo_big.png" />        
        <?php } ?> 
    
    
        <meta charset="<?php bloginfo('charset'); ?>" />
        
        <?php if (is_search()) { ?>
            <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>

        
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">       

        <?php 
            if (is_singular()) wp_enqueue_script('comment-reply'); 
            
            $langs = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');

            wp_head();
        ?>
    </head>

    <body <?php body_class(); ?>>

        <div class="top_line"></div>
        <div class="top_menu_langs">
            <div class="container">
                <ul class="social">
                    <li><a class="fb_icon_top" target="_blank" href="https://www.facebook.com/Kinoashkharh">FB</a></li>
                    <li><a  class="yt_icon_top" target="_blank" href="https://www.youtube.com/user/kinoashkharh">YouTube</a></li>
                </ul>
                <?php $langs = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str'); ?>
                <ul class="langs">
                    <li><a href="<?php echo $langs['en']['url']; ?>" class="lang_link">en</a></li>
                    <li><a href="<?php echo $langs['ru']['url']; ?>" class="lang_link">ru</a></li>
                    <li><a href="<?php echo $langs['hy']['url']; ?>" class="lang_link">arm</a></li>
                </ul>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'top-menu',
                    'menu_class' => 'top_menu',
                    'container' => 'ul'
                ));
                ?>

            </div>
        </div>
        <div class="container logo_box">
            <div class="col-md-3"><a id="logo" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><img src="<?php bloginfo('template_directory') ?>/images/logo.png"  class="img-responsive" border="0" alt="" /></a></div>
            <div class="col-md-9 top-banner">
                <?php                
                //$catId = lang_category_id(912);   //local
                $catId = lang_category_id(1076);   //server
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
                <span >
                <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH="1000" HEIGHT="80" id="Yourfilename" ALIGN="">                
                    <PARAM NAME=movie VALUE="<?php echo $meta['url']; ?>">                
                    <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#999 > 
                    <EMBED src="<?php echo $meta['url']; ?>" quality=high bgcolor=#999 WIDTH="728" HEIGHT="100" NAME="Yourfilename" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer">
                    </EMBED> 
                </OBJECT>
                </span>
                <?php endwhile; endif; ?>
                <?php wp_reset_query(); ?>  

            </div>          
        </div>

        <div class="container">
            <nav class="navbar navbar-main" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header-menu',
                            'menu_class' => 'nav navbar-nav',
                            'container' => '',
                            'walker' => new Custom_Walker_Nav_Menu()
                        ));
                        ?>
                        <?php get_search_form(); ?>                    
                    </div>
                    <div class="menu_buttom_line"></div>
                </div><!-- /.container-fluid -->
            </nav>
            <div class="navbar-main-line"></div>
        </div>
