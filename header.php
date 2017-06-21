<?php 
    $site_width = get_option('site_width');
    $global_bg = get_option('global_bg');
    $global_bg_display = get_option('global_bg_display');
    $tracking_code = get_option('tracking_code');
    $sticky_header = get_option('sticky_header');
    $display_topbar = get_option('display_topbar');
    $phone = get_option('phone');
    $email = get_option('email');
    $fb = get_option('fb');
    $twitter = get_option('twitter');
    $google = get_option('google');
    $linkedin = get_option('linkedin');
    $youtube = get_option('youtube');
    $vimeo = get_option('vimeo');
    $instagram = get_option('instagram');
    $flickr = get_option('flickr');
    $dribbble = get_option('dribbble');
    $header_bg = get_option('header_bg');
    $header_bg_display = get_option('header_bg_display');
    $logo = get_option('logo');
    $favicon = get_option('favicon');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="<?php if(is_single()) { echo get_the_title().' - '.$excerpt; } else { bloginfo('name'); ?> - <?php bloginfo('description'); } ?>">
<meta name="keywords" content="<?php echo get_the_title(); ?>">
<meta name="author" content="<?php echo get_option( 'admin_email'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

<!-- tracking code -->
<?php if(!empty($tracking_code)) { ?>
    <?php echo $tracking_code; ?>
<?php } ?>

<!-- favicon -->
<?php if(!empty($favicon)) { ?>
    <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php } ?>

<!-- adjust site width -->
<?php if(!empty($site_width)) { ?>
<style>
    @media (min-width: 1200px) {
        .container{
            max-width: <?php echo $site_width; ?>px;
        }
    }
</style>
<?php } ?>

<!-- android mobile nav fix -->
<?php if(mobile_user_agent_switch() != 'iphone' && mobile_user_agent_switch() != 'ipad') { ?>
<style>
    @media only screen and (max-width:1200px) {
        .nav.navbar-nav li.menu-item-has-children a { pointer-events:none; }
        .nav.navbar-nav li.menu-item-has-children .sub-menu li a { pointer-events:auto; }
        .nav.navbar-nav li.menu-item-has-children .sub-menu li.menu-item-has-children a { pointer-events:none; }
        .nav.navbar-nav li.menu-item-has-children .sub-menu li.menu-item-has-children .sub-menu li a { pointer-events:auto; }
    }
</style>
<?php } ?>

<!-- wp head -->
<?php wp_head(); ?>

<!-- Calculate header height (for sticky header) -->
<?php if($sticky_header == 'true') { ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
    var headerHeight = $('header').height();
    $('body').css('padding-top', headerHeight);
});
</script>
<?php } ?>

<!-- custom styles -->
<?php get_template_part('template_parts/custom_styles'); ?>
</head>

<body <?php body_class(); ?> style="<?php if(!empty($global_bg)) { echo 'background-image: url('.$global_bg.');'. bgDisplay($global_bg_display) .''; } ?>">

<header class="navbar navbar-default <?php if($sticky_header == 'true') { echo 'navbar-fixed-top'; } ?>" style="<?php if(!empty($header_bg)) {  echo 'background-image:url('.$header_bg.');'. bgDisplay($header_bg_display) .''; } ?>">

<?php if($display_topbar == 'true') { ?>
<div class="top-bar">
    <div class="container">
        <div class="top-bar-left left">
            <?php if(!empty($phone)) { echo '<span><i class="fa fa-phone icon"></i>'.$phone.'</span>'; } ?>
            <?php if(!empty($email)) { echo '<span><i class="fa fa-envelope icon"></i>'.$email.'</span>'; } ?>
        </div>
        <div class="top-bar-right right">
            <ul class="social-icons">
                <?php if(!empty($fb)) { ?><li><a href="<?php echo $fb; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
                <?php if(!empty($twitter)) { ?><li><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
                <?php if(!empty($google)) { ?><li><a href="<?php echo $google; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
                <?php if(!empty($linkedin)) { ?><li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
                <?php if(!empty($youtube)) { ?><li><a href="<?php echo $youtube; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php } ?>
                <?php if(!empty($vimeo)) { ?><li><a href="<?php echo $vimeo; ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li><?php } ?>
                <?php if(!empty($instagram)) { ?><li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php } ?>
                <?php if(!empty($flickr)) { ?><li><a href="<?php echo $flickr; ?>" target="_blank"><i class="fa fa-flickr"></i></a></li><?php } ?>
                <?php if(!empty($dribbble)) { ?><li><a href="<?php echo $dribbble; ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li><?php } ?>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php } ?>

<div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php if(!empty($logo)) { ?>
            <a class="navbar-brand" href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo('title') ?>" /></a>
        <?php } else { ?>
            <a class="navbar-brand" href="<?php echo home_url(); ?>"><?php bloginfo('title') ?></a>
        <?php } ?>
    </div>
	
	<!-- start main menu -->
    <div class="navbar-collapse collapse">
        <?php
		if ( has_nav_menu( 'menu-1' ) ) {
            wp_nav_menu( array(
                'theme_location' => 'menu-1',
                'container'      => false,
                'menu_class'     => 'nav navbar-nav right navbar-right',
                'depth'          => 3
            ));
		}
        ?>
    </div>
	<!-- end main menu -->

</div><!-- end header container -->
</header><!-- End Header -->