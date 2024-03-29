<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <title><?php bloginfo('name') ?></title>

    <?php wp_head(); ?>

</head>

<body>
    <div class="menu-bar">
        <div class="logo-pc">
            <?php
          $custom_logo_id = get_theme_mod( 'custom_logo' );
          $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );

          if ( has_custom_logo() ) {
            echo '<a href="' . get_bloginfo('url') . '"><img src="' . esc_url( $logo[0] ) . '" ""></a>';
          } else {
            echo '<h1>' . get_bloginfo('name') . '</h1>';
            echo '<p class="lead">' . get_bloginfo('description') . '</p>';
          }
        ?>
        </div>

        <nav class="navbar navbar-expand-md navbar-dark bg-my-color-2 rounded" role="navigation">
            <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
              <?php
              wp_nav_menu( array(
                'theme_location'    => 'principal',
                'depth'             => 3,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
              ) );
              ?>
            </div>
          </nav>

        <div class="logo-phone">
            <?php
          $custom_logo_id = get_theme_mod( 'custom_logo' );
          $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );

          if ( has_custom_logo() ) {
            echo '<a href="' . get_bloginfo('url') . '"><img src="' . esc_url( $logo[0] ) . '" ""></a>';
          } else {
            echo '<h1>' . get_bloginfo('name') . '</h1>';
            echo '<p class="lead">' . get_bloginfo('description') . '</p>';
          }
        ?>
        </div>
    </div>