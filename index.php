<?php get_header();  ?>

<section class="carrossel-principal">
    <?php $query = new WP_Query(array( 'category_name'=> 'destaque', 'posts_per_page' => 3)); 
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
                <?php item_carrousel('active', $firstpost) ?>
                <?php item_carrousel('', $secondPost) ?>
                <?php item_carrousel('', $thirdPost) ?>
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
<section class="posts-recentes-calendario">
    <!-- QUERY de todos os Posts -->
    <?php $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $posts = new WP_Query(array( 'posts_per_page' => 5, 'paged' => $paged,));
    ?>
    <div class="container-fluid">
        <div class="row">

            <!-- QUERY das Visitas a escolas -->
            <?php 
                $recent_args = array(
                    "posts_per_page" => 5,
                    "orderby"        => "date",
                    "order"          => "DESC",
                    "category_name"  => "visita"
                );
                $visitas = new WP_Query($recent_args); ?>


            <!-- Lista de visitas do modo Mobile -->
            <div class="calendar-list phone-page">
                <div class="card">
                    <div class="card-header">
                        Visitas e Palestras
                    </div>
                    <ul class="list-group list-group-flush">

                        <?php while ( $visitas->have_posts() ) : $visitas->the_post();?>
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

            <div class="posts-recentes col-sm-8">
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
                    <?php endwhile;   wp_reset_query();  ?>
                </div>

                <!-- paginacao -->
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
                    ) );?>

                    </div>
                </div>
            </div>

            <!-- SIDEBAR COM CALENDARIO -->
            <div class="sidebar-calendario col-sm-4">
                <div class="calendar">
                    <iframe name="google-calendar" id="google-calendar"
                        src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=America%2FSao_Paulo&showTitle=0&showNav=0&showTz=0&showCalendars=0&showTabs=0&showPrint=0&showDate=1&src=YWRkcmVzc2Jvb2sjY29udGFjdHNAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%2333B679&color=%230B8043"
                        style="border-width:0" scrolling="no"></iframe>
                    <!-- <iframe src=" <?php echo bloginfo('template_url'); ?>/calendar-iframe/google.php "></iframe> -->
                </div>

                <div class="calendar-list large-page">
                    <div class="card">
                        <div class="card-header">
                            Visitas e Palestras
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php while ( $visitas->have_posts() ) : $visitas->the_post(); ?>
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
</section>
</div>

<?php get_footer(); ?>