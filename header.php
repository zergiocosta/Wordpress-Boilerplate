<?php
/**
 * @package Project Name
 * @category Main theme files
 * @author Sergio Costa
 */
?>
<!DOCTYPE html>
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <script>
        var baseUrl = "<?php bloginfo('url'); ?>";
    </script>
    <!--[if lt IE 8]>
       <script type="text/javascript"> window.location.href = baseUrl + "ie/index.html"; </script>
    <![endif]-->

    <?php
        // General Variables
        $title_default = get_bloginfo('name');
        $keys_default  = '';
        $link_default  = get_bloginfo('wpurl');
        $desc_default  = get_bloginfo('description');
        $image_default = get_bloginfo('template_url') . '/assets/img/logo.png';
        if (is_single() || is_page()) {
            $title_default = get_the_title($post->ID);
            $link_default  = get_permalink();
            if(has_post_thumbnail()){
                $image_ID      = get_post_thumbnail_id(get_the_id());
                $image_default = wp_get_attachment_image_src($image_ID, 'thumbnail');
                $image_default = $image_default[0];
            }
        }
    ?>

    <title><?php wp_title('&raquo;', 'true', 'right'); ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/plain" rel="author" href="<?php bloginfo('template_url'); ?>/humans.txt" />
    <meta name="copyright" content="&copy; Copyright <?php echo date('Y'); ?> <?php echo $title_default; ?>" />
    <meta name="keywords" content="<?php echo $keys_default; ?>, <?php if($posttags){foreach($posttags as $tag){echo $tag->name . ', ';}}; ?>" />
    <meta name="description" content="<?php echo $desc_default; ?>" />
    <?php
        if(is_single() || is_page() || is_category() || is_home()) {
            echo '<meta name="robots" content="all,noodp" />';
            echo "\n";
        }
        else if(is_archive()) {
            echo '<meta name="robots" content="noarchive,noodp" />';
            echo "\n";
        }
        else if(is_search() || is_404()) {
            echo '<meta name="robots" content="noindex,noarchive" />';
            echo "\n";
        }

        if (wp_is_mobile()) { ?>
            <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/assets/img/icons/apple-touch-icon.png">
            <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/assets/img/icons/apple-touch-icon-72x72.png">
            <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/assets/img/icons/apple-touch-icon-114x114.png">
            <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/assets/img/icons/apple-touch-icon-144x144.png">
    <?php } else { ?>
            <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/img/icons/favicon.ico" type="image/x-icon">
    <?php } ?>

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <meta property="og:title" content="<?php echo $title_default; ?>"/>
    <meta property="og:type" content="site"/>
    <meta property="og:url" content="<?php echo $link_default; ?>"/>
    <meta property="og:image" content="<?php echo $image_default; ?>"/>
    <meta property="og:site_name" content="<?php echo $title_default; ?>"/>
    <meta property="og:description" content="<?php echo $desc_default; ?>"/>

<?php wp_head(); ?>
</head>
    <body <?php body_class(); ?>>
