<!--Modify query for last three articles-->
<div class="lasts-news">
    <?php 
        //3 last articles from latest to oldest
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'order' => 'DESC',
            'orderby' => 'date',
        );

        $my_query = new WP_Query( $args );

        //Loop (similar to standard wp one)
        if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post(); ?>
            
        <div class="card">
            <span class="tag"><?php echo the_tags(); ?></span>
            <div class="card__img">
                <?php echo the_post_thumbnail('medium'); ?>    
            </div>
            <div class="card__body">
                <h3><?php echo the_title(); ?></h3>
                <?php echo the_excerpt(); ?>
                <a href="<?php echo the_permalink(); ?>" class="button button--lg">View article</a>
            </div>
        </div>

    <?php
        endwhile;
        endif;

        //Reset post data to main query one
        wp_reset_postdata();
    ?>
</div>