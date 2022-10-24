<?php
/*
Template Name: All Posts
*/
?>

<?php get_header(); ?>
<?php $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $posts = new WP_Query(array('posts_per_page' => 6, 'paged' => $paged,));
    ?>
<div class="container">
    <div class="row category-page">
        <h2> Publicações </h2>
        <?php while($posts->have_posts()) : $posts->the_post(); ?>
        <div class="col-md-4 p-2">
            <div class="item">
            <?php the_post_thumbnail(); ?>
            <a href="<?php the_permalink() ?>">
                <div class="conteudo">
                    <h3>
                        <?php the_title() ?>
                    </h3>
                    <?php the_excerpt() ?>
                </div>
            </a>
            </div>
        </div>
        <?php endwhile; ?>

    </div>
    <div class="paginacao">
    <?php 
                    $big = 999999999; // need an unlikely integer
                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged = %#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $posts->max_num_pages,
                        'prev_text' => '<',
                        'next_text' => '>',
                    ) );?>
    </div>
</div>


<?php get_footer(); ?>