<?php
/**
 * --------------------------------------------------------------
 * ADMIN PANEL CONFIGURATION - Do not change anything here!
 * --------------------------------------------------------------
 *
 * @package Project Name
 */

/*
 * Manage items from admin bar.
 */
function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    // $wp_admin_bar->remove_menu('view-site');
    $wp_admin_bar->remove_menu('updates');
    $wp_admin_bar->remove_menu('new-content');
    $wp_admin_bar->remove_menu('comments');

    $wp_admin_bar->add_menu(
        array(
            'id'    => 'new',
            'title' => '+ Add Nova...'
        )
    );
    $wp_admin_bar->add_menu(
        array(
            'parent' => 'new',
            'id'     => 'post_type',
            'title'  => 'Nome do post type',
            'href'   => admin_url().'post-new.php?post_type={post_type}'
        )
    );
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );

/*
 * Hide update notice of wordpress version.
 */
function wp_hide_msg() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','wp_hide_msg');

/*
 * Change the footer text
 */
function remove_footer_admin () {
    echo "&copy;". date( 'Y' ) . ' - ' . get_bloginfo( 'name' ) . " - Todos os Direitos Reservados.";
}
add_filter('admin_footer_text', 'remove_footer_admin');

/*
 * Remove version from footer.
 */
function change_footer_version() {
    return 'Orgulhosamente desenvolvido por <a href="http://www.sergiocosta.net.br" target="_blank" title="Sergio Costa">Sergio Costa</a>';
}
add_filter( 'update_footer', 'change_footer_version', 9999 );

/*
 * Remove meta boxes from posts.
 */
function remove_meta_boxes() {
    // remove_meta_box( 'submitdiv', 'post', 'normal' );        // Publish meta box
    remove_meta_box( 'commentsdiv', 'post', 'normal' );         // Comments meta box
    remove_meta_box( 'revisionsdiv', 'post', 'normal' );        // Revisions meta box
    remove_meta_box( 'authordiv', 'post', 'normal' );           // Author meta box
    remove_meta_box( 'slugdiv', 'post', 'normal' );             // Slug meta box
    remove_meta_box( 'tagsdiv-post_tag', 'post', 'side' );      // Post tags meta box
    // remove_meta_box( 'categorydiv', 'post', 'side' );        // Category meta box
    remove_meta_box( 'postexcerpt', 'post', 'normal' );         // Excerpt meta box
    // remove_meta_box( 'formatdiv', 'post', 'normal' );           // Post format meta box
    remove_meta_box( 'trackbacksdiv', 'post', 'normal' );       // Trackbacks meta box
    remove_meta_box( 'postcustom', 'post', 'normal' );          // Custom fields meta box
    remove_meta_box( 'commentstatusdiv', 'post', 'normal' );    // Comment status meta box
    // remove_meta_box( 'postimagediv', 'post', 'side' );       // Featured image meta box
    // remove_meta_box( 'pageparentdiv', 'page', 'side' );      // Page attributes meta box
}
add_action( 'admin_menu', 'remove_meta_boxes' );


/*
 * Remove widgets dashboard.
 */
function admin_remove_dashboard_widgets() {
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
}
add_action( 'wp_dashboard_setup', 'admin_remove_dashboard_widgets' );

/*
 * Adicionar box no dashboard
 */
add_action('wp_dashboard_setup', 'mycustom_dashboard_widgets');
function mycustom_dashboard_widgets() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_help_widget', 'Bem vindo ao painel do portal' . get_bloginfo('name'), 'custom_dashboard_help');
}
function custom_dashboard_help() {
    echo '<p>Aqui você poderá gerenciar todo o conteúdo do site.</p><p>Qualquer dúvida, entre em contato através do email sergio.costa@outlook.com</p><p>Este site é mantido com a tecnologia do sistema WordPress e foi desenvolvido por <a href="http://www.sergiocosta.net.br" target="_blank">Sergio Costa</a></p>';
}

/**
 * Disable auto update of plugins.
 */
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

/*
 * Remove Welcome Panel.
 */
remove_action( 'welcome_panel', 'wp_welcome_panel' );

$current_user = wp_get_current_user();
if ($current_user->user_login != 'sergio') {
    /*
     * Remove tabs from menu.
     */
    function remove_menus(){  
        remove_menu_page( 'index.php' );                  // Dashboard
        remove_menu_page( 'edit.php' );                   // Posts
        remove_menu_page( 'upload.php' );                 // Media
        // remove_menu_page( 'edit.php?post_type=page' );    // Pages
        remove_menu_page( 'edit-comments.php' );          // Comments
        remove_menu_page( 'themes.php' );                 // Appearance
        remove_menu_page( 'plugins.php' );                // Plugins
        remove_menu_page( 'users.php' );                  // Users
        remove_menu_page( 'tools.php' );                  // Tools
        remove_menu_page( 'options-general.php' );        // Settings  
    }
    add_action( 'admin_menu', 'remove_menus' );

    function remove_submenus() {
        remove_submenu_page( 'themes.php', 'themes.php' );
        remove_submenu_page( 'themes.php', 'customize.php' );
        remove_submenu_page( 'edit-comments.php', 'edit-comments.php' );
    }
    add_action( 'admin_menu', 'remove_submenus', 999 );
}


/*
 * Rename admin menu labels
 */
// function change_admin_label_names( $translated ) {  
//     $translated = str_replace( 'Disqus', 'Gerenciar Comentários', $translated );
//     $translated = str_replace( 'disqus', 'comentarios', $translated );
//     return $translated;
// }
// add_filter( 'gettext', 'change_admin_label_names' );
// add_filter( 'ngettext', 'change_admin_label_names' );

?>