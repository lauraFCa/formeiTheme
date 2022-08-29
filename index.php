<?php get_header(); ?>

</div>

<!-- CARROSSEL  // ta dando ruim qd integra com wordpress  -->
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
                <img src="https://i.pinimg.com/originals/f8/e3/95/f8e395b6785428be9450d570bf48bf09.png"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://wallpaperaccess.com/full/627165.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>

            </div>
            <div class="carousel-item">
                <img src="https://www.pixelstalk.net/wp-content/uploads/images2/Free-Download-Computer-Wallpaper-HD-for-Desktop.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
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

<!-- TESTE DE CARROSSEL  -->

<?php 
$items = new WP_Query(array(
'post_type' => 'home-slider',
'posts_per_page' => 10,
'meta_key' => '_thumbnail_id'
));
$count = $items->found_posts;
?>
<div class="featured-carousel">
    <div class="carousel-shadow">
        <div id="carousel-home-featured" class="carousel-fade slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-home-featured" data-slide-to="0" class="active"></li>
                <?php for($num = 1; $num < $count; $num++){ ?>
                <li data-target="#carousel-home-featured" data-slide-to="<?php echo $num; ?>"></li>
                <?php } ?>
            </ol>
            <div class="carousel-inner">
                <?php 
        $ctr = 0;
        while ( $items->have_posts() ) :
          $items->the_post();
          $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
          $custom = get_post_custom($post->ID);
          $link = $custom["more-link"][0];
          $class = $ctr == 0 ? ' active' : '';
        ?>
                <div class="item<?php echo $class; ?>" id="<? the_ID(); ?>"> <a href="<?php echo $link; ?>">
                        <?php echo get_the_post_thumbnail($post->ID, 'full', array('class'=>"img-responsive"));?> </a>
                </div>
                <?php $ctr++; 
        endwhile;  ?>

            </div>
        </div>
    </div>
</div>

<!-- FIM DO TESTE -->

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
                    <br />
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>