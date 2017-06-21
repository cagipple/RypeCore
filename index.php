<?php 
	if(is_home()) {
		$queried_object = get_queried_object();
		if(!empty($queried_object)) {
			$values = get_post_custom( $queried_object->ID );
		} else {
			$values = get_post_custom( $post->ID );
		}
	} else {
		$page_for_posts = get_option( 'page_for_posts' );
		$values = get_post_custom( $page_for_posts );
	}

    $page_layout = isset( $values['page_layout'] ) ? esc_attr( $values['page_layout'][0] ) : 'full';
    $page_layout_widget_area = isset( $values['page_layout_widget_area'] ) ? esc_attr( $values['page_layout_widget_area'][0] ) : 'blog_sidebar';

?>

<?php get_header() ?>

<?php get_template_part('template_parts/subheader'); ?>

<section class="page-content">
    <div class="container">

		<div class="row">
			<?php if($page_layout == 'full') { ?>
				<div class="col-lg-12"><?php get_template_part('template_parts/loop_blog'); ?></div>
			<?php } ?>

			<?php if($page_layout == 'right sidebar') { ?>
				<div class="col-lg-8 col-md-8"><?php get_template_part('template_parts/loop_blog'); ?></div>
				<div class="col-lg-4 col-md-4"><?php dynamic_sidebar( $page_layout_widget_area ); ?></div>
			<?php } ?>

			<?php if($page_layout == 'left sidebar') { ?>
				<div class="col-lg-4 col-md-4"><?php dynamic_sidebar( $page_layout_widget_area ); ?></div>
				<div class="col-lg-8 col-md-8"><?php get_template_part('template_parts/loop_blog'); ?></div>
			<?php } ?>
		</div><!-- end row -->

    </div><!-- end container -->
</section>

<?php get_footer() ?>