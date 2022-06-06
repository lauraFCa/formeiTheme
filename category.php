<?php
/*
Template Name: Category
*/
?>

<?php get_header(); ?>

<section id="pagina">
    <div class="page-heading">
        <div class="container">
            <div class="heading-content">
                <h1><?php the_title( ) ?></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="text-center">
                <?php the_content() ?>
            </div>
        </div>
    </div>
    <?php $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $posts = new WP_Query(array( 'category'=> '', 'posts_per_page' => 6, 'paged' => $paged,));
    ?>
    <div class="container">
        <div class="row centralizar">
            <?php while($posts->have_posts()) : $posts->the_post(); ?>
                <div class="col-md-4 col-sm-12 noticia">
                    <div class="imagem">
                        <?php the_post_thumbnail(); ?>
                        <a href="<?php the_permalink() ?>">
                            <div class="capa">
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
        <div class="row text-center">
            <div class="paginas">
            <?php 
                    $big = 999999999; // need an unlikely integer
                    
                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged = %#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $posts->max_num_pages,
                        'prev_text' => 'Recentes',
                        'next_text' => 'Anteriores',
                        
                    ) );
                    
                ?>
            </div>
        </div>

    </div>

</section>

<?php get_footer(); ?>