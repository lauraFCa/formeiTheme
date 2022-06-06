<?php get_header(); ?>

<section id="pagina">
    <div class="page-heading">
        <div class="container">
            <div class="heading-content">
                <h1><?php the_title()?></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

            <?php the_content(); ?>

            <?php endwhile; ?>

            <?php else : get_404_template();  endif; ?>

        </div>

    </div>
    </div>

    </div>
</section>
<?php get_footer(); ?>