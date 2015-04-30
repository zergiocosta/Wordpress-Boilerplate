<?php
/**
 * @package Project Name
 */

/////////////////////////////////////////////
// Register Custom Post Type POST_TYPE_NAME
/////////////////////////////////////////////
function post_type() {
 
        $labels = array(
                'name'                => _x( '', 'Post Type General Name', 'text_domain' ),
                'singular_name'       => _x( '', 'Post Type Singular Name', 'text_domain' ),
                'menu_name'           => __( '', 'text_domain' ),
                'parent_item_colon'   => __( ' mãe', 'text_domain' ),
                'all_items'           => __( 'Todas as ', 'text_domain' ),
                'view_item'           => __( 'Ver ', 'text_domain' ),
                'add_new_item'        => __( 'Add Nova ', 'text_domain' ),
                'add_new'             => __( 'Add Nova', 'text_domain' ),
                'edit_item'           => __( 'Editar ', 'text_domain' ),
                'update_item'         => __( 'Atualizar ', 'text_domain' ),
                'search_items'        => __( 'Buscar ', 'text_domain' ),
                'not_found'           => __( 'Não encontrada', 'text_domain' ),
                'not_found_in_trash'  => __( 'Não encontrada na lixeira', 'text_domain' ),
        );
        $args = array(
                'label'               => __( '', 'text_domain' ),
                'description'         => __( '', 'text_domain' ),
                'labels'              => $labels,
                'supports'            => array( 'title', 'editor', 'thumbnail', 'comments' ),
                'hierarchical'        => true,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'post',
                'taxonomies'          => array('category', 'post_tag')
        );
        register_post_type( 'post_type', $args );
 
}
// Hook into the 'init' action
add_action( 'init', 'post_type', 0 );