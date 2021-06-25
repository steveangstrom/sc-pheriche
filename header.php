<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php bloginfo('name'); ?><?php wp_title( '|', true, 'left' ); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<?php wp_head();  ?>
</head>
<body <?php body_class(); ?> >
<header class="alignfull">

<div class = "wp-block-group__inner-container header_inner">
  <div class="site_logo">
    <a href="<?php echo home_url( '/' ); ?>" title="<?php echo bloginfo('name'); ?>" rel="home">
    <?php bloginfo( 'name' ); ?>
    </a>
  </div>
  <div class="menu_container">
  <?php
  wp_nav_menu( array('theme_location' => is_user_logged_in() ? 'sc-small-menu' : 'sc-small-menu') );
  ?>
  </div>
</div>

</header>