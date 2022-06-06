<?php get_header(); ?>

</div>

<div class="latest-news">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php $destaquePosts = new WP_Query(array( 'tag' => 'destaque'));?>
            <?php
            while ( $destaquePosts->have_posts() ) : $destaquePosts->the_post();
                if ( $gallery = get_post_gallery( get_the_ID(), false ) ) :
                    // Loop through all the image and output them one by one.
                    foreach ( $gallery['src'] AS $src ) { ?>
            <div class="carousel-item" data-bs-interval="10000">
                <img src="<?php echo $src; ?>" alt="Gallery image" />
            </div>
            <?php
                    }
                endif;
            endwhile;
            wp_reset_query();
            ?>
            <!-- pegar 3 primeiros destaques apenas -->
            <div class="carousel-item active" data-bs-interval="10000">
                <img src="https://www.cursosapientia.com.br/admimg/siteBlog/cacd-diplomata-itamaraty-diplomacia-o-que-voce-precisa-saber-antes-de-comecar-a-estudar-para-o-cacd.png"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="https://adaptive.com.br/wp-content/uploads/estrategia-a-chave-para-o-sucesso-do-seu-negocio-e-tema-de-palestra-5a946b6a8f048.jpg"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://folhadirigida.com.br/blog/wp-content/uploads/2021/08/thumb_1_servidoriniciante.png"
                    class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- exemplo -->
<div class="container">
    <div class="row">
        <div class="patrocinadores text-center text-uppercase">
            <?php $patrocinadores = new WP_Query(array( 'tag' => 'patrocinadores'));?>
            <div class="row">
                <?php
            while ( $patrocinadores->have_posts() ) : $patrocinadores->the_post();
                if ( $gallery = get_post_gallery( get_the_ID(), false ) ) :
                    // Loop through all the image and output them one by one.
                    foreach ( $gallery['src'] AS $src ) { ?>
                <div class="col-md-4 imagem-galeria">
                    <img src="<?php echo $src; ?>" alt="Gallery image" />
                </div>
                <?php
                    }
                endif;
            endwhile;
            wp_reset_query();
            ?>
            </div>
        </div>
    </div>
</div>

<?php $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
    $posts = new WP_Query(array( 'category'=> '', 'posts_per_page' => 6, 'paged' => $paged,));
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

        <div class="col-sm-4">
            <iframe class="calendar"
                src="https://calendar.google.com/calendar/embed?wkst=1&bgcolor=%233F51B5&ctz=America%2FSao_Paulo&showPrint=0&showTabs=0&showTz=0&showCalendars=0&showDate=0&showNav=1&showTitle=0&src=cHQuYnJhemlsaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%237986CB"
                style="border-width:0" frameborder="0" scrolling="no"></iframe>
            <div class="calendar-list">
                <div class="card">
                    <div class="card-header">
                        Visitas e Palestras
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="card-title">Colégio XXXX</h5>
                            <p class="card-text">10/07 - 15:00</p>
                        </li>
                        <li class="list-group-item">
                            <h5 class="card-title">Colégio XXXX</h5>
                            <p class="card-text">10/07 - 15:00</p>
                        </li>
                        <li class="list-group-item">
                            <h5 class="card-title">Colégio XXXX</h5>
                            <p class="card-text">10/07 - 15:00</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>