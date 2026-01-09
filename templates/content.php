 <?php if (is_single()):
        echo get_template_part('templates/blog/blog-details');
    else: ?>
     <article id="post-<?php the_ID(); ?>" <?php post_class("tp-postbox-item mb-30") ?>>
         <div class="tp-postbox-thumb mb-30">
             <?php if (has_post_thumbnail()) :  ?>
                 <?php the_post_thumbnail(); ?>
                 <?php echo get_template_part('templates/blog/blog-category'); ?>
             <?php endif; ?>
         </div>
         <div class="tp-postbox-content">
             <?php echo get_template_part('templates/blog/blog-meta'); ?>
             <h2 class="tp-postbox-title mb-15"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
             <?php the_content() ?>
             <?php echo get_template_part('templates/blog/blog-btn'); ?>
         </div>
     </article>

 <?php endif; ?>