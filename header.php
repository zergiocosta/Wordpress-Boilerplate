<?php
/**
 * @package Project Name
 */
?>
<!DOCTYPE html>
<!--[if lt IE 9]>
<script type="text/javascript">
    window.location.href = "<?php bloginfo('siteurl'); ?>/ie/";
</script>
<![endif]-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

<title><?php wp_title('|', true, 'right'); ?></title>

<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><![endif]-->

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="copyright" content="&copy; Copyright 2013 <?php bloginfo('name'); ?>" />
<link type="text/plain" rel="author" href="<?php bloginfo('template_url'); ?>/humans.txt" />
<meta name="keywords" content="<?php the_tags(); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="google-site-verification" content="" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href="<?php bloginfo('template_url'); ?>/assets/images/icons/favicon.ico" rel="shortcut icon" />
<!-- <link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet"> -->

<?php if (is_home()) { ?>
    <meta property="og:title" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:type" content="site"/>
    <meta property="og:url" content="<?php bloginfo('siteurl'); ?>"/>
    <meta property="og:image" content="<?php bloginfo('template_url'); ?>/screenshot.png"/>
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:description" content="<?php bloginfo('description'); ?>"/>
<?php } else { ?>
    <meta property="og:title" content="<?php echo get_the_title($post->ID); ?>"/>
    <meta property="og:type" content="site"/>
    <meta property="og:url" content="<?php echo get_post_permalink($post->ID); ?>"/>
    <meta property="og:image" content="<?php echo get_the_post_thumbnail($post->ID); ?>"/>
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:description" content="<?php bloginfo('description'); ?>"/>
<?php } ?>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>