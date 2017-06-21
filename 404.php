<?php get_header() ?>

<?php get_template_part('template_parts/subheader'); ?>

<section class="page-content page-not-found">
    <div class="container">

		<h1>404</h1>
		<p>Oops! The page you are looking for does not exist.</p>
		<a href="<?php echo home_url(); ?>">&larr; Go Back Home</a>
		
		<form class="page-not-found-search" action="<?php bloginfo('siteurl'); ?>" method="get">
            <input type="search" id="s" name="s" placeholder="Search our site" required />
        </form>

    </div><!-- end container -->
</section>

<?php get_footer() ?>