<?php
	$hide_footer_widget_area = get_option('hide_footer_widget_area');
	$footer_bg = get_option('footer_bg');
	$footer_bg_display = get_option('footer_bg_display');
	$display_bottombar = get_option('display_bottombar');
	$bottom_bar_text = get_option('bottom_bar_text');
?>

<?php if($hide_footer_widget_area != "true") { ?>
<footer id="footer" <?php if(!empty($footer_bg)) { echo 'style="background-image:url('.$footer_bg.'); '. bgDisplay($footer_bg_display) .'"'; } ?>>
    <div class="container">
        <div class="row">
            <?php if ( dynamic_sidebar('Footer') ) : else : endif; ?>
        </div><!-- end row -->
    </div><!-- end footer container -->
</footer>
<?php } ?>

<?php if($display_bottombar == "true") { ?>
<div class="bottom-bar">
	<div class="container">
		<?php if(!empty($bottom_bar_text)) { ?><span><?php echo $bottom_bar_text; ?></span><?php } ?>
	</div>
</div>
<?php } ?>

<?php wp_footer(); ?>

</body>
</html>