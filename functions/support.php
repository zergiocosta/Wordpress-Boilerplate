<?php
/**
 * @package Project Name
 */

function after_setup_theme_handler(){

	/**
     * Register nav menus.
     */
    register_nav_menus(
        array(
            'main-menu'   => 'Main Menu',
            'footer-menu' => 'Footer Menu'
        )
    );

    /**
     * Register sidebars.
     */
    register_sidebar(
        array(
            'name'          => 'Name here',
            'id'            => 'id-here',
            'description'   => 'Description goes here',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '',
            'after_title'   => ''
        )
    );

    /*
     * Add post_thumbnails suport.
     */
    add_theme_support('post-thumbnails');
    add_image_size('thumb-main', 50, 50, true);

}
add_action('after_setup_theme', 'after_setup_theme_handler');

$current_user = wp_get_current_user();
if ($current_user->user_login != 'sergio') {
    /**
     * Hide admin bar from the front-end
     */
    add_filter( 'show_admin_bar', '__return_false' );
}

/*
 * Stop images getting wrapped up in p tags when they get dumped out with the_content() for easier theme styling
 */
function wpfme_remove_img_ptags($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'wpfme_remove_img_ptags');

/*
 * change amount of posts on the search page - set here to 50
 */
function wpfme_search_results_per_page( $query ) {
    global $wp_the_query;
    if ( ( ! is_admin() ) && ( $query === $wp_the_query ) && ( $query->is_search() ) ) {
    $query->set( 'wpfme_search_results_per_page', 50 );
    }
    return $query;
}
add_action( 'pre_get_posts',  'wpfme_search_results_per_page'  );


/////////////////////////////////////////////////
// Add metabox for CTP Archives in wp nav menu
/////////////////////////////////////////////////
/* inject cpt archives meta box */
add_action( 'admin_head-nav-menus.php', 'inject_cpt_archives_menu_meta_box' );
function inject_cpt_archives_menu_meta_box() {
   add_meta_box( 'add-cpt', __( 'Custom Post Types', 'default' ), 'wp_nav_menu_cpt_archives_meta_box', 'nav-menus',    'side', 'default' );
}
/* render custom post type archives meta box */
function wp_nav_menu_cpt_archives_meta_box() {
/* get custom post types with archive support */
$post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );    
/* hydrate the necessary object properties for the walker */
foreach ( $post_types as &$post_type ) {
    $post_type->classes = array();
    $post_type->type = $post_type->name;
    $post_type->object_id = $post_type->name;
    $post_type->title = $post_type->labels->name . ' ' . __( 'Archive', 'default' );
    $post_type->object = 'cpt-archive';
}
$walker = new Walker_Nav_Menu_Checklist( array() );
?>
    <div id="cpt-archive" class="posttypediv">
        <div id="tabs-panel-cpt-archive" class="tabs-panel tabs-panel-active">
            <ul id="ctp-archive-checklist" class="categorychecklist form-no-clear">
                <?php
                  echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $post_types), 0, (object) array( 'walker' => $walker) );
                ?>
            </ul>
        </div><!-- /.tabs-panel -->
    </div>
    <p class="button-controls">
        <span class="add-to-menu">
            <input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-ctp-archive-menu-item" id="submit-cpt-archive" />
        </span>
    </p>
<?php
}
/* take care of the urls */
add_filter( 'wp_get_nav_menu_items', 'cpt_archive_menu_filter', 10, 3 );
function cpt_archive_menu_filter( $items, $menu, $args ) {
/* alter the URL for cpt-archive objects */
foreach ( $items as &$item ) {
    if ( $item->object != 'cpt-archive' ) continue;
    $item->url = get_post_type_archive_link( $item->type );
    /* set current */
    if ( get_query_var( 'post_type' ) == $item->type ) {
        $item->classes []= 'current-menu-item';
        $item->current = true;
    }
}
return $items;
}
// swf
function add_upload_mime_types( $mimes ) {
    if ( function_exists( 'current_user_can' ) )
        $unfiltered = $user ? user_can( $user, 'unfiltered_html' ) : current_user_can( 'unfiltered_html' );
    if ( !empty( $unfiltered ) ) {
        $mimes['swf'] = 'application/x-shockwave-flash';
    }
    return $mimes;
}
add_filter( 'upload_mimes', 'add_upload_mime_types' );
?>
