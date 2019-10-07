<?php

add_post_type_support( 'our_staff', 'comments' );

// function: post_type BEGIN
function our_staff_post_type(){
    
    $labels = array(
                    'name' => __( 'Our Staff'), 
                    'singular_name' => __('Our Staff'),
                    'rewrite' => array(
                            'slug' => __( 'adp_our_staff' ) 
                    ),
                    'add_new' => _x('Add Item', 'our_staff'), 
                    'add_new_item' => _x('Add New Item', 'our_staff'), 
                    'edit_item' => __('Edit Our Staff Item'),
                    'all_items' => __( 'All Our Staff Items', 'our_staff' ),
                    'new_item' => __('New Our Staff Item'), 
                    'view_item' => __('View Our Staff'),
                    'search_items' => __('Search Our Staff'), 
                    'not_found' =>  __('No Our Staff Items Found'),
                    'not_found_in_trash' => __('No Our Staff Items Found In Trash'),
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
                    'rewrite' => array('slug' => 'our_staff'),
                    'has_archive' => true,
                    'menu_icon' => get_template_directory_uri('template_directory').'/images/our_staff.png',
                    'supports' => array(
                            'comments',
                            'title',
                            'editor',
                            'thumbnail',
                            'excerpt',
                            'custom-fields',
                            'page-attributes'
                    ),
                  //'taxonomies' => array('post_tag', 'our_staff_category'),
                  'suppress_filters' => true
             );
    
    register_post_type(__( 'our_staff' ), $args);        
} 

// function: our_staff_messages BEGIN
function our_staff_messages($messages)
{
    $messages[__( 'our_staff' )] = 
            array(
                    0 => '', 
                    1 => sprintf(('Our Staff Updated. <a href="%s">View our_staff</a>'), esc_url(get_permalink($post_ID))),
                    2 => __('Custom Field Updated.'),
                    3 => __('Custom Field Deleted.'),
                    4 => __('Our Staff Updated.'),
                    5 => isset($_GET['revision']) ? sprintf( __('Our Staff Restored To Revision From %s'), wp_post_revision_title((int)$_GET['revision'], false)) : false,
                    6 => sprintf(__('Our Staff Published. <a href="%s">View Portfolio</a>'), esc_url(get_permalink($post_ID))),
                    7 => __('Our Staff Saved.'),
                    8 => sprintf(__('Our Staff Submitted. <a target="_blank" href="%s">Preview Our Staff</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
                    9 => sprintf(__('Our Staff Scheduled For: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Our Staff</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
                    10 => sprintf(__('Our Staff Draft Updated. <a target="_blank" href="%s">Preview Our Staff</a>'), esc_url( add_query_arg('preview', 'true', get_permalink($post_ID)))),
            );
    return $messages;

} // function: our_staff_messages END

// function: our_staff_category BEGIN
function our_staff_category()
{
    register_taxonomy(
            __( "our_staff_category" ),
            array(__( "our_staff" )),
            array(
                    "hierarchical" => true,
                    "label" => __( "Category" ),
                    "singular_label" => __( "Category" ),
                    'show_ui'           => true,
                    'show_admin_column' => true,
                    /*"rewrite" => array(
                            'slug' => 'our_staff_category',
                            'hierarchical' => true
                    )*/
            )
    );
} // function: our_staff_category END

add_action( 'init', 'our_staff_post_type' );
add_action( 'init', 'our_staff_category', 0 );
add_filter( 'post_updated_messages', 'our_staff_messages' );