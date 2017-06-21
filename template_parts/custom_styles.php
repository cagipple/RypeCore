<?php 
    function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Format the hex color string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Get decimal values
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));

        // Adjust number of steps and keep it inside 0 to 255
        $r = max(0,min(255,$r + $steps));
        $g = max(0,min(255,$g + $steps));  
        $b = max(0,min(255,$b + $steps));

        $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
        $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
        $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

        return '#'.$r_hex.$g_hex.$b_hex;
    } 

    $style_global_bg = get_option('style_global_bg');
    $style_top_bar_bg = get_option('style_top_bar_bg');
    $style_top_bar_text = get_option('style_top_bar_text');
    $style_top_bar_social = get_option('style_top_bar_social');
    $style_header_bg = get_option('style_header_bg');
    $style_header_text = get_option('style_header_text');
    $style_page_banner_bg = get_option('style_page_banner_bg');
    $style_page_banner_title = get_option('style_page_banner_title');
    $style_footer_bg = get_option('style_footer_bg');
    $style_footer_header = get_option('style_footer_header');
    $style_footer_text = get_option('style_footer_text');
    $style_footer_link = get_option('style_footer_link');
    $style_bottom_bar_bg = get_option('style_bottom_bar_bg');
    $style_bottom_bar_text = get_option('style_bottom_bar_text');
?>

<style>
/* GLOBAL */
<?php if(!empty($style_global_bg)) { ?>
    body { background:<?php echo $style_global_bg; ?>; }
<?php } ?>

/* TOPBAR */
<?php if(!empty($style_top_bar_bg)) { ?>
    .top-bar { background:<?php echo $style_top_bar_bg; ?>; }
<?php } ?>

<?php if(!empty($style_top_bar_text)) { ?>
    .top-bar span { color:<?php echo $style_top_bar_text; ?>; }
<?php } ?>

<?php if(!empty($style_top_bar_social)) { ?>
    .top-bar .social-icons a { color:<?php echo $style_top_bar_social; ?>; }
<?php } ?>

/* HEADER */
<?php if(!empty($style_header_bg)) { ?>
    .navbar { background:<?php echo $style_header_bg; ?>; }
<?php } ?>

<?php if(!empty($style_header_text)) { ?>
    .nav.navbar-nav li a,
    .navbar,
    .navbar-default .navbar-brand { color:<?php echo $style_header_text; ?>; }
<?php } ?>

/* PAGE BANNER */
<?php if(!empty($style_page_banner_bg)) { ?>
    .subheader { background:<?php echo $style_page_banner_bg; ?>; }
<?php } ?>

<?php if(!empty($style_page_banner_title)) { ?>
    .subheader h1 { color:<?php echo $style_page_banner_title; ?>; }
<?php } ?>

/* FOOTER */
<?php if(!empty($style_footer_bg)) { ?>
    #footer { background:<?php echo $style_footer_bg; ?>; }
<?php } ?>

<?php if(!empty($style_footer_header)) { ?>
    #footer h4 { color:<?php echo $style_footer_header; ?>; }
<?php } ?>

<?php if(!empty($style_footer_text)) { ?>
    #footer { color:<?php echo $style_footer_text; ?>; }
<?php } ?>

<?php if(!empty($style_footer_link)) { ?>
    #footer a { color:<?php echo $style_footer_link; ?>; }
<?php } ?>

<?php if(!empty($style_bottom_bar_bg)) { ?>
    .bottom-bar { background:<?php echo $style_bottom_bar_bg; ?>; }
<?php } ?>

<?php if(!empty($style_bottom_bar_text)) { ?>
    .bottom-bar { color:<?php echo $style_bottom_bar_text; ?>; }
    .bottom-bar a { color:<?php echo $style_bottom_bar_text; ?>; }
<?php } ?>
</style>