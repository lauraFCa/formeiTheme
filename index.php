<?php get_header(); ?>

</div>

<section>

    <?php $query = new WP_Query(array( 'tag'=> 'destaque', 'posts_per_page' => 3)); 
    $posts = $query -> get_posts();
    $firstpost=$posts[0];
    $secondPost=$posts[1];
    $thirdPost=$posts[2];
    ?>

    <div class="latest-news">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?php echo(get_the_post_thumbnail_url( $firstpost )) ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            <a href="<?php echo(get_the_permalink($firstpost)) ?>" style="color: inherit;">
                                <?php echo(get_the_title( $firstpost )) ?>
                            </a>
                        </h5>
                        <p> <?php echo(get_the_excerpt($firstpost)) ?> </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="<?php echo(get_the_post_thumbnail_url($secondPost)) ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            <a href="<?php echo(get_the_permalink($secondPost)) ?>" style="color: inherit;">
                                <?php echo(get_the_title( $secondPost )) ?>
                            </a>
                        </h5>
                        <p><?php echo(get_the_excerpt( $secondPost )) ?></p>
                    </div>

                </div>
                <div class="carousel-item">
                    <img src="<?php echo(get_the_post_thumbnail_url($thirdPost)) ?>" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            <a href="<?php echo(get_the_permalink($thirdPost)) ?>" style="color: inherit;">
                                <?php echo(get_the_title( $thirdPost )) ?>
                            </a>
                        </h5>
                        <p><?php echo(get_the_excerpt( $thirdPost )) ?></p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <?php wp_reset_query(); ?>
</section>

<!-- POSTS / CALENDARIO -->
<?php $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $posts = new WP_Query(array( 'category_name'=> '', 'posts_per_page' => 6, 'paged' => $paged,));
    ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <div class="news-cards">
                <?php while($posts->have_posts()) : $posts->the_post();
                $categories = get_the_category();?>
                <div class="news">
                    <div class="card text-center">
                        <div class="card-header">
                            <?php if ( ! empty( $categories ) ) {echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';}  ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php the_title() ?></h5>
                            <p class="card-text"><?php the_excerpt() ?></p>
                            <a href="<?php the_permalink() ?>" class="btn btn-primary">Ler mais</a>
                        </div>
                        <div class="card-footer text-muted">
                            <?php the_date('d/m/Y') ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; 
            wp_reset_query();
            ?>
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
                        'prev_text' => '<',
                        'next_text' => '>',
                        
                    ) );
                    
                ?>
                </div>
            </div>
        </div>

        <div class="col-sm-4">

            <div class="calendar">
                <iframe
                    src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=America%2FSao_Paulo&showTitle=0&showNav=0&showTz=0&showCalendars=0&showTabs=0&showPrint=0&showDate=1&src=Zm9ybWVpdW5pYWNhZGVtaWFAZ21haWwuY29t&color=%23039BE5"
                    scrolling="no" style="border-width:0"></iframe>
            </div>

            <div class="calendar-list">
                <div class="card">
                    <div class="card-header">
                        Visitas e Palestras
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php 
                        $recent_args = array(
                            "posts_per_page" => 5,
                            "orderby"        => "date",
                            "order"          => "DESC",
                            "category_name"  => "visita"
                        );
                        $visitas = new WP_Query($recent_args);
                    while ( $visitas->have_posts() ) : $visitas->the_post();
                    ?>
                        <li class="list-group-item">
                            <h5 class="card-title">
                                <a href="<?php the_permalink() ?>" class="text-reset"><?php the_title() ?></a>
                            </h5>
                            <p class="card-text"><?php the_excerpt() ?></p>
                        </li>
                        <?php endwhile; wp_reset_query(); ?>
                    </ul>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>