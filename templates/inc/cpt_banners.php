<?php

// function: post_type BEGIN
function banners_post_type(){
    
    $labels = array(
                    'name' => __( 'Banners'), 
                    'singular_name' => __('Banners'),
                    'rewrite' => array(
                            'slug' => __( 'adp_banners' ) 
                    ),
                    'add_new' => _x('Add Item', 'banners'), 
                    'edit_item' => __('Edit Banners Item'),
                    'new_item' => __('New Banners Item'), 
                    'view_item' => __('View Banners'),
                    'search_items' => __('Search Banners'), 
                    'not_found' =>  __('No Banners Items Found'),
                    'not_found_in_trash' => __('No Banners Items Found In Trash'),
                    'parent_item_colon' => ''
                );
    $args = array(
                    'labels' => $labels,
                    'public' => true,
                    'publicly_queryable' => true,
                    'show_ui' => true,
                    'query_var' => true,
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    'menu_position' => null,
                    'rewrite' => array('slug' => 'banners'),
                    //'has_archive' => true,
                    'menu_icon' => get_template_directory_uri('template_directory').'/images/banners.png',
                    'supports' => array(
                            //'comments',
                            'title',
                            //'editor',
                            //'thumbnail',
                            //'excerpt',
                            //'custom-fields',
                            //'page-attributes'
                    ),
                  //'taxonomies' => array('post_tag', 'banners_category'),
                  'suppress_filters' => true
             );
    
    register_post_type(__( 'banners' ), $args);        
} 

// function: banners_messages BEGIN
function banners_messages($messages)
{
    $messages[__( 'banners' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Banners Updated. <a href="%s">View Banners</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Banners Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Banners Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Banners Published. <a href="%s">View Banners</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Banners Saved.'),
                    8 => sprintf(__('Banners Submitted. <a target="_blank" href="%s">Preview Banners</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Banners Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Banners</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Banners Draft Updated. <a target="_blank" href="%s">Preview Banners</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: banners_messages END

// function: banners_category BEGIN
function banners_category()
{
    register_taxonomy(
            __( "banners_category" ),
            array(__( "banners" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category" ),
                    "singular_label" => __( "Category" ),
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    "rewrite" => array(
                            'slug' => 'banners_category',
                            'hierarchical' => true
                    )
            )
    );
} // function: banners_category END

add_action( 'init', 'banners_post_type' );
add_action( 'init', 'banners_category', 0 );
add_filter( 'post_updated_messages', 'banners_messages' );