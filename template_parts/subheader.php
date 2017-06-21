<?php
	// Global page banner settings
	$page_banner_bg = get_option('page_banner_bg');
	$page_banner_bg_display = get_option('page_banner_bg_display');
	$page_banner_title_align = get_option('page_banner_title_align');
	$page_banner_padding_top = get_option('page_banner_padding_top');
	$page_banner_padding_bottom = get_option('page_banner_padding_bottom');
	$page_banner_display_search = get_option('page_banner_display_search');

	//calculate padding
	if(!empty($page_banner_padding_top)) {
		$page_banner_padding_top = 'padding-top:'. $page_banner_padding_top .'px;';
	}
	if(!empty($page_banner_padding_bottom)) {
		$page_banner_padding_bottom = 'padding-bottom:'. $page_banner_padding_bottom .'px;';
	}

	//Individual page banner settings (these overwrite global settings)
	if(is_home()) {
        $queried_object = get_queried_object();
        if(!empty($queried_object)) {
            $values = get_post_custom( $queried_object->ID );
        } else {
            $values = get_post_custom( $post->ID );
        }
    } else {
    	$values = get_post_custom( $post->ID );
    }

	$banner_display = isset( $values['banner_display'] ) ? esc_attr( $values['banner_display'][0] ) : 'true';
	$banner_title = isset( $values['banner_title'] ) ? $values['banner_title'][0] : '';
	$banner_bg_img = isset( $values['banner_bg_img'] ) ? esc_attr( $values['banner_bg_img'][0] ) : '';
	$banner_bg_display = isset( $values['banner_bg_display'] ) ? esc_attr( $values['banner_bg_display'][0] ) : '';
?>

<?php if($banner_display == 'true') { ?>
<section class="module subheader" 
	<?php 
		 if(!empty($banner_bg_img)) { 
			echo 'style="background-image:url('.$banner_bg_img.'); '. bgDisplay($banner_bg_display) . $page_banner_padding_top . $page_banner_padding_bottom .' "'; 
		} else if (!empty($page_banner_bg)) {
			echo 'style="background-image:url('.$page_banner_bg.'); '. bgDisplay($page_banner_bg_display) . $page_banner_padding_top . $page_banner_padding_bottom .'"';
		} else {
			echo 'style="'.$page_banner_padding_top . $page_banner_padding_bottom.'"';
		}
	?>>
	<div class="container">
		
		<h1 <?php if($page_banner_title_align == 'right') { echo 'class="right"'; } else if($page_banner_title_align == 'center') { echo 'class="center"'; } ?>>
			<?php
			if(!empty($banner_title)) {
				echo $banner_title;
			} else if (is_front_page()) {			
				bloginfo('title');
			} else {
				wp_title('');
			}
			?>
		</h1>

		<?php if($page_banner_display_search == 'true') { ?>
			<div class="search-form-wrap <?php if($page_banner_title_align == 'right') { echo 'left'; } else if($page_banner_title_align == 'center') { echo 'center'; } else { echo 'right'; } ?>"><?php echo get_search_form(); ?></div>
		<?php } ?>
	
	</div>
</section>
<?php } ?>