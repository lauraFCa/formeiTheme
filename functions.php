<?php


#region MENU
// Registra o Custom Navigation Walker
// require_once get_template_directory() .'/class-wp-bootstrap-navwalker.php';

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

// Registrar os menus
register_nav_menus( array(
    'principal' => __('Menu principal', 'menu_principal'),
));

// register a new menu

#endregion

#region LOGO
// Setup the logo
function custom_logo_setup() {
    $defaults = array(
    'width'       => 100,
    'height'      => 'auto',
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
    
}
add_action( 'after_setup_theme', 'custom_logo_setup' );

#endregion

#region GENERAL
// Thumbnails
add_theme_support( 'post-thumbnails' );

// Images Size
add_image_size( 'centering', 9999, 200, array('center', 'center') );

#endregion

#region SIDEBAR
function registrar_sidebars_dinamicas() {
    register_sidebar( array(
        'name' => 'Calendario-Iframe',
        'id' => 'sidebar_calendario_iframe',
        'before_widget' => '<div class="calendar">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => '',
    ) );
    
    register_sidebar( array(
        'name' => 'Exemplos-de-Widget',
        'id' => 'widget_exemplo',
        'before_widget' => '<div class="row"> <div class="pricing-tables"> <div class="container">',
        'after_widget' => '</div></div></div>',
        'before_title' => '<p class="titulo-1"><i>',
        'after_title' => '</i></p>',
    ) );
}

add_action( 'widgets_init', 'registrar_sidebars_dinamicas' );

#endregion

#region POSTS

#region COMENTARIOS
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

#endregion

#region EXCERPT
// Excerpt lenght
function custom_excerpt_length($length) {
    return 30; //Nova quantidade de caracteres do excerpt
}
add_filter('excerpt_length', 'custom_excerpt_length');

#endregion

#region TEMPO DE LEITURA
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


// Definir o estilo da paginação
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');


#endregion

#endregion


function item_carrousel($ativo, $post){
    if ( has_post_thumbnail( $post ) ) {
        $imgUrl = get_the_post_thumbnail_url( $post );
    }else{
        $blog = get_bloginfo('template_url');
        $imgGenerica = "img/basicBG.jpg";
        $imgUrl =  $blog . "/". $imgGenerica  ;
        }
    
    echo('
        <div class="carousel-item '.$ativo.'">
                        <img src="'. $imgUrl .'" class="d-block w-100" alt="Post featured image">
                    <div class="carousel-caption d-md-block">
                        <h5>
                            <a href="'. get_the_permalink($post).'" style="color: inherit;">
                                '.get_the_title( $post ).'
                            </a>
                        </h5>
                        <p> '.get_the_excerpt($post).' </p>
                    </div>
                </div>
    ');
};

?>