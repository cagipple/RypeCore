
                    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    
                        <!-- start post -->
                        <article <?php post_class(); ?>>
                                <div class="blog-post">
									<a href="<?php the_permalink(); ?>" class="blog-post-img"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } ?></a>
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<ul class="blog-post-details">
										<li><i class="fa fa-user icon"></i>Posted by <?php the_author_link(); ?> in <?php the_category(', '); ?></li>
										<li><i class="fa fa-calendar-o icon"></i><?php the_time('F j, Y') ?></li>
										<li><i class="fa fa-comment icon"></i><?php comments_number(); ?></li>
									</ul>
                                    <?php 
                                    if(is_single()) { 
                                        the_content(); 
                                    } else { ?>
                                        <?php the_excerpt(); ?>
                                        <a class="button small" href="<?php the_permalink(); ?>">READ MORE</a>
                                    <?php } ?>
                                    
                                    <?php if(has_tag()) { ?>
                                        <div class="tag-list right">
											<i class="fa fa-tag"></i>
											<?php the_tags('',', ',''); ?>
                                        </div>
                                    <?php } ?>
                                </div><!-- end blog post -->
                        </article>
                        <!-- end post -->
						
						<?php comments_template(); ?>
                    
                    <?php endwhile; ?>

                <?php 
				wp_reset_query();
                $big = 999999999; // need an unlikely integer

                $args = array(
                    'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'       => '/page/%#%',
                    'total'        => $wp_query->max_num_pages,
                    'current'      => max( 1, get_query_var('paged') ),
                    'show_all'     => False,
                    'end_size'     => 1,
                    'mid_size'     => 2,
                    'prev_next'    => True,
                    'prev_text'    => __('&raquo; Previous', 'rypecore'),
                    'next_text'    => __('Next &raquo;', 'rypecore'),
                    'type'         => 'plain',
                    'add_args'     => False,
                    'add_fragment' => '',
                    'before_page_number' => '',
                    'after_page_number' => ''
                ); ?>

                <div class="page-list">
                <?php echo paginate_links( $args ); ?> 
                </div>

                <?php else: ?>
                    <p><?php _e('Sorry, no posts matched your criteria.', 'rypecore'); ?></p>
                <?php endif; ?>