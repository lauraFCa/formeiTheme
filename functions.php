<?php

function cacem_title_tag(){
    add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'cacem_title_tag' );

if(!function_exists('_wp_render_title_tag')) {
    function cacem_render_title(){
        ?>
<title>
    <?php wp_title('|', true, 'right'); ?>
</title>
<?php
    }
    add_action( 'wp_head', 'cacem_render_title' );
}

// Registra o Custom Navigation Walker
require_once get_template_directory() .'/class-wp-bootstrap-navwalker.php';

// Registrar os menus
register_nav_menus( array(
    'principal' => __('Menu principal', 'cacem'),
));

// Definir o estilo da paginação
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

// Criar o tipo de post para o banner
function create_post_type() {

    register_post_type('banners',
    // Definir as opções
    array(
        'labels' => array(
            'name' => __('Banners'),
            'singular_name' => __('Banners')
        ),
        'supports' => array(
            'title', 'editor', 'thumbnail'
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-images-alt2',
        'rewrite' => array('slug' => 'banners'),
    ));
}

//Iniciar o tipo de post
add_action('init', 'create_post_type');

//LOGO
function cacem_custom_logo_setup() {
    $defaults = array(
    'width'       => 100,
    'height'      => 'auto',
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
    
   }
   add_action( 'after_setup_theme', 'cacem_custom_logo_setup' );
    
    add_filter('excerpt_length', 'custom_excerpt_length');
	function custom_excerpt_length($length) {
	return 10; //Nova quantidade de caracteres do excerpt
	}

// Ativar o fomrulário para respostas nos comentários
function theme_queue_js() {
    if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') ) wp_enqueue_script('comment-reply');
}
add_action('wp_print_scripts', 'theme_queue_js');

// Personalizar os comentários
function format_comment($comment, $args, $depth) {

    $GLOBALS['comment'] = $comment; ?>

<div <?php comment_class('ml-4'); ?> id="comment-<?php comment_ID(); ?>">

    <div class="card mb-3">
        <div class="card-body">

            <div class="comment-intro">

                <h5 class="card-title"><?php printf(__('%s'), get_comment_author_link()) ?></h5>
                <h6 class="card-subtitle mb-3 text-muted">Comentou em
                    <?php printf(__('%1$s'), get_comment_date('d/m/y'), get_comment_time()) ?></h6>

            </div>

            <?php comment_text(); ?>

            <div class="reply">
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>

        </div>
    </div>

    <?php

}

add_theme_support( 'post-thumbnails' );

add_image_size( 'centering', 9999, 200, array('center', 'center') );

function registrar_sidebars_dinamicas() {
    register_sidebar( array(
        'name' => 'Carrossel-Insta',
        'id' => 'widget_insta',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ) );
    
    register_sidebar( array(
        'name' => 'Mais-Sobre',
        'id' => 'widget_mais_sobre',
        'before_widget' => '<div class="content">',
        'after_widget' => '</div>',
        'before_title' => '<p class="titulo-1">',
        'after_title' => '</p>',
    ) );
    
    register_sidebar( array(
        'name' => 'Conquistas',
        'id' => 'widget_conquistas',
        'before_widget' => '<div class="row"> <div class="pricing-tables"> <div class="container">',
        'after_widget' => '</div></div></div>',
        'before_title' => '<p class="titulo-1"><i>',
        'after_title' => '</i></p>',
    ) );
}

add_action( 'widgets_init', 'registrar_sidebars_dinamicas' );

//Calcular Tempo de Leitura do post
function reading_time($post_id) {
    $content = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( strip_tags( $content ) );
    
    //para que o tempo de leitura seja maior, diminua o valor da variavel
    //para que o tempo de leitura seja menor, aumente o valor da variavel
    $variavel = 100;
    
    $readingtime = ceil($word_count / $variavel); //media de leitura por min
    $totalreadingtime = $readingtime . " min";
    
    return $totalreadingtime;
}

// $args = array(
// 	'default-color' => '000000',
// 	'default-image' => '%1$s/images/background.jpg',
// );
// add_theme_support( 'custom-background', $args );

add_filter('next_posts_link_attributes', __NAMESPACE__ . '\\posts_link_attributes');
add_filter('previous_posts_link_attributes', __NAMESPACE__ . '\\posts_link_attributes');


?>