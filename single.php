<?php get_header(); ?>

<section id="pagina">

    <div class="container bottom-30">
        <div class="row">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <h2>
                <?php the_title(); ?>
            </h2>
            <div class="small-text">
                <p>Tags: <?php the_tags(' ') ?> | <?php the_date() ?></p>
                <p> Categorias: <?php the_category( ', ') ?></p>
            </div>
            <div class="content">
                <?php the_content(); ?>
            </div>

            <div class="icone mb-2">
                <span>Destaque:</span>
                <?php the_post_thumbnail('full') ?>
            </div>

            <?php endwhile; ?>

            <?php else : get_404_template();  endif; ?>

        </div>
    </div>

</section>

<?php get_footer(); ?>