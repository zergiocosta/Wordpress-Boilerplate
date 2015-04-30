<?php
/**
 * @package Project Name
 */

/////////////////////////////////////////////
// Register Custom taxonomy TAXONOMY_NAME
/////////////////////////////////////////////
function taxonomy() {

        $labels = array(
                'name'                       => _x( '', 'Taxonomy General Name', 'text_domain' ),
                'singular_name'              => _x( '', 'Taxonomy Singular Name', 'text_domain' ),
                'menu_name'                  => __( '', 'text_domain' ),
                'all_items'                  => __( 'All Items', 'text_domain' ),
                'parent_item'                => __( 'Parent Item', 'text_domain' ),
                'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
                'new_item_name'              => __( 'New Item Name', 'text_domain' ),
                'add_new_item'               => __( 'Add New Item', 'text_domain' ),
                'edit_item'                  => __( 'Edit Item', 'text_domain' ),
                'update_item'                => __( 'Update Item', 'text_domain' ),
                'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
                'search_items'               => __( 'Search Items', 'text_domain' ),
                'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
                'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
                'not_found'                  => __( 'Not Found', 'text_domain' ),
        );
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => true,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
        );
        register_taxonomy( 'taxonomy', 'post_type', $args );

}

// Hook into the 'init' action
add_action( 'init', 'taxonomy', 0 );