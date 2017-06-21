<?php

//enqueue media uploader
if($_GET['page'] == 'theme_options') {
    wp_enqueue_media();
}

// create settings menu
add_action('admin_menu', 'rypecore_theme_options_create_menu');

function rypecore_theme_options_create_menu() {

	//create new top-level menu
	add_menu_page('Theme Options', 'Theme Options', 'administrator', 'theme_options', 'rypecore_theme_options_page' , null, 99 );

	//call register settings function
	add_action( 'admin_init', 'register_rypecore_theme_options' );
}

function register_rypecore_theme_options() {

    //register general settings
    register_setting( 'rypecore-settings-group', 'site_width' );
    register_setting( 'rypecore-settings-group', 'global_bg' );
    register_setting( 'rypecore-settings-group', 'global_bg_display' );
    register_setting( 'rypecore-settings-group', 'tracking_code' );

	//register header settings
    register_setting( 'rypecore-settings-group', 'sticky_header' );
    register_setting( 'rypecore-settings-group', 'display_topbar' );
    register_setting( 'rypecore-settings-group', 'phone' );
    register_setting( 'rypecore-settings-group', 'email' );
    register_setting( 'rypecore-settings-group', 'fb' );
    register_setting( 'rypecore-settings-group', 'twitter' );
    register_setting( 'rypecore-settings-group', 'google' );
    register_setting( 'rypecore-settings-group', 'linkedin' );
    register_setting( 'rypecore-settings-group', 'youtube' );
    register_setting( 'rypecore-settings-group', 'vimeo' );
    register_setting( 'rypecore-settings-group', 'instagram' );
    register_setting( 'rypecore-settings-group', 'flickr' );
    register_setting( 'rypecore-settings-group', 'dribbble' );
    register_setting( 'rypecore-settings-group', 'header_bg' );
    register_setting( 'rypecore-settings-group', 'header_bg_display' );
	register_setting( 'rypecore-settings-group', 'logo' );
    register_setting( 'rypecore-settings-group', 'favicon' );

    //register page banner settings
    register_setting( 'rypecore-settings-group', 'page_banner_bg' );
    register_setting( 'rypecore-settings-group', 'page_banner_bg_display' );
    register_setting( 'rypecore-settings-group', 'page_banner_title_align' );
    register_setting( 'rypecore-settings-group', 'page_banner_padding_top' );
    register_setting( 'rypecore-settings-group', 'page_banner_padding_bottom' );
    register_setting( 'rypecore-settings-group', 'page_banner_display_search' );

    //register footer settings
    register_setting( 'rypecore-settings-group', 'hide_footer_widget_area' );
    register_setting( 'rypecore-settings-group', 'num_footer_cols' );
    register_setting( 'rypecore-settings-group', 'footer_bg' );
    register_setting( 'rypecore-settings-group', 'footer_bg_display' );
    register_setting( 'rypecore-settings-group', 'display_bottombar' );
    register_setting( 'rypecore-settings-group', 'bottom_bar_text' );

    //register style settings
    register_setting( 'rypecore-settings-group', 'style_global_bg' );
    register_setting( 'rypecore-settings-group', 'style_top_bar_bg' );
    register_setting( 'rypecore-settings-group', 'style_top_bar_text' );
    register_setting( 'rypecore-settings-group', 'style_top_bar_social' );
    register_setting( 'rypecore-settings-group', 'style_header_bg' );
    register_setting( 'rypecore-settings-group', 'style_header_text' );
    register_setting( 'rypecore-settings-group', 'style_page_banner_bg' );
    register_setting( 'rypecore-settings-group', 'style_page_banner_title' );
    register_setting( 'rypecore-settings-group', 'style_footer_bg' );
    register_setting( 'rypecore-settings-group', 'style_footer_header' );
    register_setting( 'rypecore-settings-group', 'style_footer_text' );
    register_setting( 'rypecore-settings-group', 'style_footer_link' );
    register_setting( 'rypecore-settings-group', 'style_bottom_bar_bg' );
    register_setting( 'rypecore-settings-group', 'style_bottom_bar_text' );
}

function rypecore_theme_options_page() {
?>

<div class="wrap theme-options">
<h2>Theme Options</h2>
<br/>

<div class="theme-options-header">
	<span class="theme-options-logo"><img src="<?php echo get_template_directory_uri(); ?>/admin/images/logo.png" alt="" /> <span class="logo-text">Rype Core</span></span>
    <div class="created-by">
        <a href="http://rypecreative.com/" target="_blank">Made by Rype Creative</a> | <a href="http://rypecreative.com/contact/" target="_blank">Support</a>
    </div>
    <div class="theme-version">
        <?php
        $my_theme = wp_get_theme();
        echo "Version " . $my_theme->get( 'Version' );
        ?>
    </div>
    <div class="clear"></div>
</div>

<?php settings_errors(); ?>

<form method="post" action="options.php" id="theme-options-form">
    <?php settings_fields( 'rypecore-settings-group' ); ?>
    <?php do_settings_sections( 'rypecore-settings-group' ); ?>

    <?php
        //set default values
        $site_width_default = 1170;
        $bottom_bar_text_default = get_bloginfo('title').' | Theme by <a href="http://rypecreative.com/" target="_blank">Rype Creative</a> | &copy; '. the_time('Y');
    ?>

    <div id="tabs" class="ui-tabs">
    	<ul class="ui-tabs-nav">
            <li><a href="#general"><i class="fa fa-globe"></i> General</a></li>
    		<li><a href="#header"><div class="header-icon"><div class="header-icon-head"></div><div class="header-icon-content"></div></div> Header</a></li>
            <li><a href="#page-banner"><div class="header-icon page-banner-icon"><div class="header-icon-head"></div><div class="header-icon-banner"></div><div class="header-icon-content"></div></div> Page Banners</a></li>
    		<li><a href="#footer"><div class="header-icon"><div class="header-icon-content"></div><div class="header-icon-head"></div></div> Footer</a></li>
    		<li><a href="#styling"><i class="fa fa-tint"></i> Styling</a></li>
    	</ul>

        <div class="tab-loader"><img src="<?php echo home_url(); ?>/wp-admin/images/spinner.gif" alt="" /> Loading...</div>

        <div id="general" class="tab-content">
            <h2>General</h2>

            <div class="admin-module">
                <label class="left" for="site_width">Site Width</label>
                <div class="more-info">
                    <div class="more-info-question">?</div>
                    <div class="more-info-content">
                        Set the site width within the range of 700 - 1200px. The default value is 1170px.
                    </div>
                </div>
                <div class="clear"></div>
                <input type="number" min="700" max="1200" id="site_width" name="site_width" value="<?php echo esc_attr( get_option('site_width',  $site_width_default) ); ?>" />
                Pixels
            </div>

            <div class="admin-module">
                <label>Global Background Image</label><br/>
                <input type="text" id="global_bg" name="global_bg" value="<?php echo esc_attr( get_option('global_bg') ); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                <span class="button-secondary remove">Remove</span>
            </div>

            <div class="admin-module">   
                <label>Global Background Display</label>
                <select name="global_bg_display">
                    <option value="cover" <?php if(esc_attr(get_option('global_bg_display')) == 'cover') { echo 'selected'; } ?>>Cover</option>
                    <option value="fixed" <?php if(esc_attr(get_option('global_bg_display')) == 'fixed') { echo 'selected'; } ?>>Fixed</option>
                    <option value="repeat" <?php if(esc_attr(get_option('global_bg_display')) == 'repeat') { echo 'selected'; } ?>>Tiled</option>
                </select>
            </div>

            <div class="admin-module">
                <label class="left" for="tracking_code">Tracking Code</label>
                <div class="more-info">
                    <div class="more-info-question">?</div>
                    <div class="more-info-content">
                        Copy and paste your Google Analytics tracking code here. The tracking code will be applied to every page. Make sure to include script tags.
                    </div>
                </div>
                <div class="clear"></div>
                <textarea id="tracking_code" name="tracking_code" ><?php echo esc_attr( get_option('tracking_code') ); ?></textarea>
            </div>
        </div><!-- end general -->

    	<div id="header" class="tab-content">
    		<h2>Header</h2>

            <div class="admin-module">
                <input type="checkbox" id="sticky_header" name="sticky_header" value="true" <?php checked('true', get_option('sticky_header'), true) ?> />
                <label for="sticky_header">Enable sticky header</label>
            </div>

            <div id="accordion" class="accordion">
                <h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Top Bar</h3>
                <div>
                    <div class="admin-module">
                        <input type="checkbox" id="display_topbar" name="display_topbar" value="true" <?php checked('true', get_option('display_topbar'), true) ?> />
                        <label for="display_topbar">Display top bar</label>
                    </div>

                    <div class="admin-module">
                        <label for="phone">Phone</label><br/>
                        <input type="text" id="phone" name="phone" value="<?php echo esc_attr( get_option('phone') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="email">Email</label><br/>
                        <input type="text" id="email" name="email" value="<?php echo esc_attr( get_option('email') ); ?>" />
                    </div>
                    <br/>

                    <h3>Social Media</h3>
                    <div class="social-media-profiles">
                        <div class="admin-module">
                            <label for="fb">Facebook</label><br/>
                            <input type="text" id="fb" name="fb" value="<?php echo esc_attr( get_option('fb') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="twitter">Twitter</label><br/>
                            <input type="text" id="twitter" name="twitter" value="<?php echo esc_attr( get_option('twitter') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="google">Google Plus</label><br/>
                            <input type="text" id="google" name="google" value="<?php echo esc_attr( get_option('google') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="linkedin">LinkedIn</label><br/>
                            <input type="text" id="linkedin" name="linkedin" value="<?php echo esc_attr( get_option('linkedin') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="youtube">Youtube</label><br/>
                            <input type="text" id="youtube" name="youtube" value="<?php echo esc_attr( get_option('youtube') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="vimeo">Vimeo</label><br/>
                            <input type="text" id="vimeo" name="vimeo" value="<?php echo esc_attr( get_option('vimeo') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="instagram">Instagram</label><br/>
                            <input type="text" id="instagram" name="instagram" value="<?php echo esc_attr( get_option('instagram') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="flickr">Flickr</label><br/>
                            <input type="text" id="flickr" name="flickr" value="<?php echo esc_attr( get_option('flickr') ); ?>" />
                        </div>

                        <div class="admin-module">
                            <label for="dribbble">Dribbble</label><br/>
                            <input type="text" id="dribbble" name="dribbble" value="<?php echo esc_attr( get_option('dribbble') ); ?>" />
                        </div>
                    </div><!-- end social media profiles -->
                </div>
            </div><!-- end topbar section -->

            <div class="admin-module">
                <label>Header Background Image</label><br/>
                <input type="text" id="header_bg" name="header_bg" value="<?php echo esc_attr( get_option('header_bg') ); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                <span class="button-secondary remove">Remove</span>
            </div>

            <div class="admin-module">   
                <label>Header Background Display</label>
                <select name="header_bg_display">
                    <option value="cover" <?php if(esc_attr(get_option('header_bg_display')) == 'cover') { echo 'selected'; } ?>>Cover</option>
                    <option value="fixed" <?php if(esc_attr(get_option('header_bg_display')) == 'fixed') { echo 'selected'; } ?>>Fixed</option>
                    <option value="repeat" <?php if(esc_attr(get_option('header_bg_display')) == 'repeat') { echo 'selected'; } ?>>Tiled</option>
                </select>
            </div>

            <div class="admin-module">
                <label>Logo</label><br/>
                <input type="text" id="logo" name="logo" value="<?php echo esc_attr( get_option('logo') ); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                <span class="button-secondary remove">Remove</span>
                <?php $logo = get_option('logo'); ?>
                <?php if(!empty($logo)) { ?><div class="option-preview logo-preview"><img src="<?php echo esc_attr( get_option('logo') ); ?>" alt="" /></div><?php } ?>
            </div>

            <div class="admin-module">
                <label class="left">Favicon</label>
                <div class="more-info">
                    <div class="more-info-question">?</div>
                    <div class="more-info-content">
                        A favicon, also known as a shortcut icon, website icon, tab icon, URL icon or bookmark icon, is a file named favicon.ico and 
                        containing one or more small icons, most commonly 16×16 pixels.
                    </div>
                </div>
                <div class="clear"></div>
                <input type="text" id="favicon" name="favicon" value="<?php echo esc_attr( get_option('favicon') ); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                <span class="button-secondary remove">Remove</span>
                <?php $favicon = get_option('favicon'); ?>
                <?php if(!empty($favicon)) { ?><div class="option-preview favicon-preview"><img src="<?php echo esc_attr( get_option('favicon') ); ?>" alt="" /></div><?php } ?>
            </div>
    	</div><!-- end header -->

        <div id="page-banner" class="tab-content">
            <h2>Page Banners</h2>

            <div class="admin-module">
                <label class="left">Page Banner Background Image</label>
                <div class="more-info">
                    <div class="more-info-question">?</div>
                    <div class="more-info-content">
                        Set the global banner background image for all pages/posts. This can be overridden on individual pages/posts.
                    </div>
                </div>
                <div class="clear"></div>
                <input type="text" id="page_banner_bg" name="page_banner_bg" value="<?php echo esc_attr( get_option('page_banner_bg') ); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                <span class="button-secondary remove">Remove</span>
            </div>

            <div class="admin-module">   
                <label>Page Banner Background Display</label>
                <select name="page_banner_bg_display">
                    <option value="cover" <?php if(esc_attr(get_option('page_banner_bg_display')) == 'cover') { echo 'selected'; } ?>>Cover</option>
                    <option value="fixed" <?php if(esc_attr(get_option('page_banner_bg_display')) == 'fixed') { echo 'selected'; } ?>>Fixed</option>
                    <option value="repeat" <?php if(esc_attr(get_option('page_banner_bg_display')) == 'repeat') { echo 'selected'; } ?>>Tiled</option>
                </select>
            </div>

            <div class="admin-module">   
                <label>Title Alignment</label>
                <select name="page_banner_title_align">
                    <option value="left" <?php if(esc_attr(get_option('page_banner_title_align')) == 'left') { echo 'selected'; } ?>>Left</option>
                    <option value="center" <?php if(esc_attr(get_option('page_banner_title_align')) == 'center') { echo 'selected'; } ?>>Center</option>
                    <option value="right" <?php if(esc_attr(get_option('page_banner_title_align')) == 'right') { echo 'selected'; } ?>>Right</option>
                </select>
            </div>

            <div class="admin-module">
                <label for="page_banner_padding_top">Padding Top</label><br/>
                <input type="number" id="page_banner_padding_top" name="page_banner_padding_top" value="<?php echo esc_attr( get_option('page_banner_padding_top',  '25') ); ?>" />
                Pixels
            </div>

            <div class="admin-module">
                <label for="page_banner_padding_bottom">Padding Bottom</label><br/>
                <input type="number" id="page_banner_padding_bottom" name="page_banner_padding_bottom" value="<?php echo esc_attr( get_option('page_banner_padding_bottom',  '25') ); ?>" />
                Pixels
            </div>

            <div class="admin-module">
                <input type="checkbox" id="page_banner_display_search" name="page_banner_display_search" value="true" <?php checked('true', get_option('page_banner_display_search'), true) ?> />
                <label for="page_banner_display_search">Display Search Form</label>
            </div>

        </div><!-- end page banner -->

    	<div id="footer" class="tab-content">
    		<h2>Footer</h2>

            <div class="admin-module">
                <input type="checkbox" id="hide_footer_widget_area" name="hide_footer_widget_area" value="true" <?php checked('true', get_option('hide_footer_widget_area'), true) ?> />
                <label for="hide_footer_widget_area">Hide Footer Widget Area</label>
            </div>
            
            <div class="admin-module">
                <label>Number of footer columns</label>
                <select name="num_footer_cols">
                    <option value="1" <?php if(esc_attr(get_option('num_footer_cols')) == '1') { echo 'selected'; } ?>>1</option>
                    <option value="2" <?php if(esc_attr(get_option('num_footer_cols')) == '2') { echo 'selected'; } ?>>2</option>
                    <option value="3" <?php if(esc_attr(get_option('num_footer_cols')) == '3') { echo 'selected'; } ?>>3</option>
                    <option value="4" <?php if(esc_attr(get_option('num_footer_cols')) == '4') { echo 'selected'; } ?>>4</option>
                    <option value="5" <?php if(esc_attr(get_option('num_footer_cols')) == '5') { echo 'selected'; } ?>>5</option>
                    <option value="6" <?php if(esc_attr(get_option('num_footer_cols')) == '6') { echo 'selected'; } ?>>6</option>
                </select>
            </div>

            <div class="admin-module">
                <label>Footer Background Image</label><br/>
                <input type="text" id="footer_bg" name="footer_bg" value="<?php echo esc_attr( get_option('footer_bg') ); ?>" />
                <input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
                <span class="button-secondary remove">Remove</span>
            </div>

            <div class="admin-module">   
                <label>Footer Background Display</label>
                <select name="footer_bg_display">
                    <option value="cover" <?php if(esc_attr(get_option('footer_bg_display')) == 'cover') { echo 'selected'; } ?>>Cover</option>
                    <option value="fixed" <?php if(esc_attr(get_option('footer_bg_display')) == 'fixed') { echo 'selected'; } ?>>Fixed</option>
                    <option value="repeat" <?php if(esc_attr(get_option('footer_bg_display')) == 'repeat') { echo 'selected'; } ?>>Tiled</option>
                </select>
            </div>

            <div id="accordion" class="accordion">
                <h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Bottom Bar</h3>
                <div>
                    <div class="admin-module">
                        <input type="checkbox" id="display_bottombar" name="display_bottombar" value="true" <?php checked('true', get_option('display_bottombar'), true) ?> />
                        <label for="display_bottombar">Display Bottom Bar</label>
                    </div>

                    <div class="admin-module">
                        <label for="bottom_bar_text">Bottom Bar Text</label><br/>
                        <textarea id="bottom_bar_text" name="bottom_bar_text"><?php echo esc_attr( get_option('bottom_bar_text', $bottom_bar_text_default) ); ?></textarea>
                    </div>
                </div>
            </div>

    	</div><!-- end footer -->

    	<div id="styling" class="tab-content">
    		<h3>Styling</h3>

            <div id="accordion" class="accordion">
                <h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Global Styles</h3>
                <div>
                    <div class="admin-module">
                        <label for="style_global_bg">Background Color</label><br/>
                        <input type="text" name="style_global_bg" id="style_global_bg" class="color-field" data-default-color="#ffffff" value="<?php echo esc_attr( get_option('style_global_bg', '#ffffff') ); ?>" />
                    </div>
                </div>
            </div>

            <div id="accordion" class="accordion">
                <h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Top Bar Styles</h3>
                <div>
                    <div class="admin-module">
                        <label for="style_top_bar_bg">Top Bar Background Color</label><br/>
                        <input type="text" name="style_top_bar_bg" id="style_top_bar_bg" class="color-field" data-default-color="#333333" value="<?php echo esc_attr( get_option('style_top_bar_bg', '#333333') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_top_bar_text">Top Bar Text Color</label><br/>
                        <input type="text" name="style_top_bar_text" id="style_top_bar_text" class="color-field" data-default-color="#717171" value="<?php echo esc_attr( get_option('style_top_bar_text', '#717171') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_top_bar_social">Top Bar Social Icons Color</label><br/>
                        <input type="text" name="style_top_bar_social" id="style_top_bar_social" class="color-field" data-default-color="#2e8db6" value="<?php echo esc_attr( get_option('style_top_bar_social', '#2e8db6') ); ?>" />
                    </div>
                </div>
            </div>

            <div id="accordion" class="accordion">
                <h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Header Styles</h3>
                <div>
                    <div class="admin-module">
                        <label for="style_header_bg">Header Background Color</label><br/>
                        <input type="text" name="style_header_bg" id="style_header_bg" class="color-field" data-default-color="#f8f8f8" value="<?php echo esc_attr( get_option('style_header_bg', '#f8f8f8') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_header_text">Header Text Color</label><br/>
                        <input type="text" name="style_header_text" id="style_header_text" class="color-field" data-default-color="#777" value="<?php echo esc_attr( get_option('style_header_text', '#777') ); ?>" />
                    </div>
                </div>
            </div>

            <div id="accordion" class="accordion">
                <h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Page Banner Styles</h3>
                <div>
                    <div class="admin-module">
                        <label for="style_page_banner_bg">Page Banner Background Color</label><br/>
                        <input type="text" name="style_page_banner_bg" id="style_page_banner_bg" class="color-field" data-default-color="#eeeeee" value="<?php echo esc_attr( get_option('style_page_banner_bg', '#eeeeee') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_page_banner_title">Page Banner Title Color</label><br/>
                        <input type="text" name="style_page_banner_title" id="style_page_banner_title" class="color-field" data-default-color="#313131" value="<?php echo esc_attr( get_option('style_page_banner_title', '#313131') ); ?>" />
                    </div>
                </div>
            </div>

            <div id="accordion" class="accordion">
                <h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Footer Styles</h3>
                <div>
                    <div class="admin-module">
                        <label for="style_footer_bg">Footer Background Color</label><br/>
                        <input type="text" name="style_footer_bg" id="style_footer_bg" class="color-field" data-default-color="#313131" value="<?php echo esc_attr( get_option('style_footer_bg', '#313131') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_footer_header">Footer Header Color</label><br/>
                        <input type="text" name="style_footer_header" id="style_footer_header" class="color-field" data-default-color="#828282" value="<?php echo esc_attr( get_option('style_footer_header', '#828282') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_footer_text">Footer Text Color</label><br/>
                        <input type="text" name="style_footer_text" id="style_footer_text" class="color-field" data-default-color="#828282" value="<?php echo esc_attr( get_option('style_footer_text', '#828282') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_footer_link">Footer Link Color</label><br/>
                        <input type="text" name="style_footer_link" id="style_footer_link" class="color-field" data-default-color="#2e8db6" value="<?php echo esc_attr( get_option('style_footer_link', '#2e8db6') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_bottom_bar_bg">Bottom Bar Background Color</label><br/>
                        <input type="text" name="style_bottom_bar_bg" id="style_bottom_bar_bg" class="color-field" data-default-color="#272727" value="<?php echo esc_attr( get_option('style_bottom_bar_bg', '#272727') ); ?>" />
                    </div>

                    <div class="admin-module">
                        <label for="style_bottom_bar_text">Bottom Bar Text Color</label><br/>
                        <input type="text" name="style_bottom_bar_text" id="style_bottom_bar_text" class="color-field" data-default-color="#464646" value="<?php echo esc_attr( get_option('style_bottom_bar_text', '#464646') ); ?>" />
                    </div>
                </div>
            </div>

    	</div><!-- end styling -->

	</div><!-- end tabs -->
	<div class="clear"></div>
    
    <?php submit_button(); ?>
    <div class="loader"><img src="<?php echo home_url(); ?>/wp-admin/images/spinner.gif" alt="" /></div>
    <div class="clear"></div>
    <div id="save-result">Settings Saved Successfully</div>

</form>
</div>

<?php } ?>