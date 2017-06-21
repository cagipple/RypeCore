<?php

/*-----------------------------------------------------------------------------------*/
/*	Hide admin toolbar
/*-----------------------------------------------------------------------------------*/
add_filter('show_admin_bar', '__return_false');

/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain( 'rypecore', get_template_directory() . '/languages' );


/*-----------------------------------------------------------------------------------*/
/*	Content Width
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) $content_width = 828;

/*-----------------------------------------------------------------------------------*/
/*	Include Admin Scripts
/*-----------------------------------------------------------------------------------*/
add_action('admin_enqueue_scripts', 'rypecore_admin_scripts');
 
function rypecore_admin_scripts() {
    if (is_admin()) {
    	wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_register_script('admin-js', get_template_directory_uri() . '/admin/admin.js', array('jquery','media-upload','thickbox', 'wp-color-picker'), '', true);
		wp_enqueue_script('admin-js');
		wp_register_style('admin-css',  get_template_directory_uri() . '/admin/admin.css', array(), '3.0', 'all');
    	wp_enqueue_style( 'admin-css' );
    	wp_register_style('font-awesome',  get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), '', 'all');
		wp_enqueue_style('font-awesome');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_script( 'jquery-form', array( 'jquery' ) );
		wp_enqueue_style( 'wp-color-picker' );
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Include Theme Stylesheets
/*-----------------------------------------------------------------------------------*/
function load_rypecore_stylesheets() {
	if (!is_admin()) {

		// register styles
		wp_register_style('bootstrap',  get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.0', 'all');
        wp_register_style('bxslider-css',  get_template_directory_uri() . '/css/jquery.bxslider.css', array(), '4.0', 'all');
        wp_register_style('responsive-css',  get_template_directory_uri() . '/css/responsive.css', array(), '', 'all');
		wp_register_style('font-awesome',  get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', array(), '', 'all');

        // enqueue styles
        wp_enqueue_style( 'bootstrap' );
        wp_enqueue_style('bxslider-css');
		wp_enqueue_style( 'style', get_stylesheet_uri() );
        wp_enqueue_style('responsive-css');
		wp_enqueue_style('font-awesome');

	}
}
add_action('wp_enqueue_scripts', 'load_rypecore_stylesheets');

/*-----------------------------------------------------------------------------------*/
/*	Include Theme Scripts
/*-----------------------------------------------------------------------------------*/
function load_rypecore_scripts() {
	if (!is_admin()) {

		/* Register scripts */
		wp_register_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.js', '', '', false );
	    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '', true );
	    wp_register_script( 'respond', get_template_directory_uri() . '/js/respond.js', array( 'jquery' ), '', true );
	    wp_register_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array( 'jquery' ), '4.1.1', true );
	 	wp_register_script( 'global', get_template_directory_uri() . '/js/global.js', array( 'jquery' ), '', true );

	 	/* Enqueue Scripts */
	 	wp_enqueue_script( 'html5shiv' );
	    wp_enqueue_script( 'bootstrap' );
	    wp_enqueue_script( 'respond' );
	    wp_enqueue_script( 'bxslider' );
	    wp_enqueue_script( 'global' );  

	    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	}
} 
add_action( 'wp_enqueue_scripts', 'load_rypecore_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Include theme options
/*-----------------------------------------------------------------------------------*/
include('admin/theme_options.php');

function bgDisplay($displayValue) {
        if($displayValue == 'fixed') {
            $displayValue = 'background-attachment:fixed; background-size:100%; background-repeat:no-repeat;';
        } else if($displayValue == 'repeat') {
            $displayValue = 'background-repeat:repeat;';
        } else {
            $displayValue = 'background-size:cover; background-repeat:no-repeat;';
        }
    return $displayValue;
}

/*-----------------------------------------------------------------------------------*/
/*	MOBILE DEVICE DETECTION
/*-----------------------------------------------------------------------------------*/
if( !function_exists('mobile_user_agent_switch') ){
	function mobile_user_agent_switch(){
		$device = '';
		
		if( stristr($_SERVER['HTTP_USER_AGENT'],'ipad') ) {
			$device = "ipad";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'iphone') || strstr($_SERVER['HTTP_USER_AGENT'],'iphone') ) {
			$device = "iphone";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'blackberry') ) {
			$device = "blackberry";
		} else if( stristr($_SERVER['HTTP_USER_AGENT'],'android') ) {
			$device = "android";
		}
		
		if( $device ) {
			return $device; 
		} return false; {
			return false;
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Register main menu
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'rypecore_register_menus' );
	function rypecore_register_menus() {
	    register_nav_menus(
	        array(
	            'menu-1' => __( 'Primary Menu', 'rypecore' ),
	        )
	    );
	}

/*-----------------------------------------------------------------------------------*/
/*	Add post thumbnail support
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'post-thumbnails' ); 

/*-----------------------------------------------------------------------------------*/
/*	Excerpt size
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit);
}

/*-----------------------------------------------------------------------------------*/
/*	Register Page Layout Meta Box
/*-----------------------------------------------------------------------------------*/
 function rypecore_add_page_layout_meta_box() {
 	add_meta_box( 'page-layout-meta-box', 'Page Settings', 'rypecore_page_layout_meta_box', 'page', 'normal', 'high' );
 }
add_action( 'add_meta_boxes', 'rypecore_add_page_layout_meta_box' );

function rypecore_page_layout_meta_box($post) {

	$values = get_post_custom( $post->ID );
	$banner_display = isset( $values['banner_display'] ) ? esc_attr( $values['banner_display'][0] ) : 'true';
	$banner_title = isset( $values['banner_title'] ) ? esc_attr( $values['banner_title'][0] ) : '';
	$banner_bg_img = isset( $values['banner_bg_img'] ) ? esc_attr( $values['banner_bg_img'][0] ) : '';
	$banner_bg_display = isset( $values['banner_bg_display'] ) ? esc_attr( $values['banner_bg_display'][0] ) : '';
	$page_layout = isset( $values['page_layout'] ) ? esc_attr( $values['page_layout'][0] ) : 'full';
	$page_layout_widget_area = isset( $values['page_layout_widget_area'] ) ? esc_attr( $values['page_layout_widget_area'][0] ) : 'blog_sidebar';
	wp_nonce_field( 'rypecore_page_layout_meta_box_nonce', 'rypecore_page_layout_meta_box_nonce' );
	?>
	
	<div id="accordion" class="accordion">
		<h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Banner</h3>
		<div>
			<div class="admin-module">
				<input id="banner_display" type="checkbox" name="banner_display" value="true" <?php if($banner_display == 'true') { echo 'checked'; } ?> />
				<label for="banner_display">Display Banner</label>
			</div>

			<div class="admin-module">
				<label>Banner Title</label><br/>
				<input type="text" name="banner_title" value="<?php echo $banner_title; ?>" />
			</div>

			<div class="admin-module">
				<label>Banner Background Image</label><br/>
				<input type="text" id="banner_bg_img" name="banner_bg_img" value="<?php echo $banner_bg_img; ?>" />
				<input id="_btn" class="upload_image_button" type="button" value="Upload Image" />
			</div>
			
			<div class="admin-module">
				<label>Banner Background Display</label>
				<select name="banner_bg_display">
					<option value="cover" <?php if($banner_bg_display == 'cover') { echo 'selected'; } ?>>Cover</option>
					<option value="fixed" <?php if($banner_bg_display == 'fixed') { echo 'selected'; } ?>>Fixed</option>
					<option value="repeat" <?php if($banner_bg_display == 'repeat') { echo 'selected'; } ?>>Tiled</option>
				</select>
			</div>
		</div><!-- end banner tab -->
		
		<h3 class="accordion-tab"><i class="fa fa-chevron-right icon"></i> Page Layout</h3>
		<div>
			<div class="admin-module">
				<table style="float:left; margin-right:30px;">
				<tr>
				<td><input type="radio" name="page_layout" id="page_layout_full" value="full" <?php if($page_layout == 'full') { echo 'checked="checked"'; } ?> /></td>
				<td><img style="float:left; width:55px;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/admin/images/full-width-icon.png" alt="" /></td>
				</tr><br/>
				<tr>
				<td></td>
				<td>Full Width</td>
				</tr>
				</table>

				<table style="float:left;">
				<tr>
				<td><input type="radio" name="page_layout" id="page_layout_right_sidebar" value="right sidebar" <?php if($page_layout == 'right sidebar') { echo 'checked="checked"'; } ?> /></td>
				<td><img style="float:left; width:55px;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/admin/images/right-sidebar-icon.png" alt="" /></td>
				</tr>
				<tr>
				<td></td>
				<td>Right Sidebar</td>
				</tr>
				</table>

				<table style="float:left;">
				<tr>
				<td><input type="radio" name="page_layout" id="page_layout_left_sidebar" value="left sidebar" <?php if($page_layout == 'left sidebar') { echo 'checked="checked"'; } ?> /></td>
				<td><img style="float:left; width:55px;" src="<?php echo esc_url( get_template_directory_uri() ); ?>/admin/images/left-sidebar-icon.png" alt="" /></td>
				</tr>
				<tr>
				<td></td>
				<td>Left Sidebar</td>
				</tr>
				</table>
				<div style="clear:both;"></div>
			</div>

			<div class="admin-module">
				<label for="page_layout_widget_area">Sidebar Widget Area</label>
				<select name="page_layout_widget_area" id="page_layout_widget_area">
					<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
						 <option value="<?php echo ucwords( $sidebar['id'] ); ?>" <?php if($page_layout_widget_area == ucwords( $sidebar['id'] )) { echo 'selected'; } ?>>
								  <?php echo ucwords( $sidebar['name'] ); ?>
						 </option>
					<?php } ?>
				</select>
			</div>
		</div><!-- page layout tab -->
	</div><!-- end accordion -->

<?php } 

/* Save banner form */
add_action( 'save_post', 'rypecore_save_page_layout_meta_box' );
function rypecore_save_page_layout_meta_box( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['rypecore_page_layout_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['rypecore_page_layout_meta_box_nonce'], 'rypecore_page_layout_meta_box_nonce' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;

    // save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        ),
		'b' => array(),
		'strong' => array(),
		'i' => array()
    );
     
    // make sure data is set before saving
	if( isset( $_POST['banner_display'] ) ) {
        update_post_meta( $post_id, 'banner_display', wp_kses( $_POST['banner_display'], $allowed ) );
	} else {
		update_post_meta( $post_id, 'banner_display', wp_kses( '', $allowed ) );
	}
		
    if( isset( $_POST['banner_title'] ) )
        update_post_meta( $post_id, 'banner_title', wp_kses( $_POST['banner_title'], $allowed ) );
		
	if( isset( $_POST['banner_bg_img'] ) )
        update_post_meta( $post_id, 'banner_bg_img', wp_kses( $_POST['banner_bg_img'], $allowed ) );
		
	if( isset( $_POST['banner_bg_display'] ) )
        update_post_meta( $post_id, 'banner_bg_display', wp_kses( $_POST['banner_bg_display'], $allowed ) );

    if( isset( $_POST['page_layout'] ) )
        update_post_meta( $post_id, 'page_layout', wp_kses( $_POST['page_layout'], $allowed ) );

    if( isset( $_POST['page_layout_widget_area'] ) )
        update_post_meta( $post_id, 'page_layout_widget_area', wp_kses( $_POST['page_layout_widget_area'], $allowed ) );
}


/*-----------------------------------------------------------------------------------*/
/*	Register Widget Areas
/*-----------------------------------------------------------------------------------*/
function rypecore_widgets_init() {

	/** MAIN SIDEBAR **/
	register_sidebar( array(
		'name' => 'Page Sidebar',
		'id' => 'page_sidebar',
		'before_widget' => '<div class="col-lg-12 col-md-12 col-sm-6 sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4><div class="divider"></div>',
	) );

	/** BLOG SIDEBAR **/
	register_sidebar( array(
		'name' => 'Blog Sidebar',
		'id' => 'blog_sidebar',
		'before_widget' => '<div class="col-lg-12 col-md-12 col-sm-6 sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4><div class="divider"></div>',
	) );
	
	/** FOOTER **/
	$num_footer_cols = get_option('num_footer_cols');
	if($num_footer_cols == '1') {
		$footer_widget_class = '<div class="col-lg-12 col-md-12 col-sm-12 footer-widget">';
	} else if ($num_footer_cols == '2') {
		$footer_widget_class = '<div class="col-lg-6 col-md-6 col-sm-6 footer-widget">';
	} else if($num_footer_cols == '3') {
		$footer_widget_class = '<div class="col-lg-4 col-md-4 col-sm-6 footer-widget">';
	} else if($num_footer_cols == '4') {
		$footer_widget_class = '<div class="col-lg-3 col-md-3 col-sm-6 footer-widget">';
	} else if($num_footer_cols == '6') {
		$footer_widget_class = '<div class="col-lg-2 col-md-2 col-sm-6 footer-widget">';
	} else {
		$footer_widget_class = '<div class="col-lg-3 col-md-3 col-sm-6 footer-widget">';
	}

	register_sidebar( array(
		'name' => 'Footer',
		'id' => 'footer-widgets',
		'before_widget' => $footer_widget_class,
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	) );
}
add_action( 'widgets_init', 'rypecore_widgets_init' );

?>