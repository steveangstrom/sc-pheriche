<?php
get_header(); ?>
<div class="content_inner">
<?php while ( have_posts() ) : the_post(); ?>

<h2>
  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a>
</h2>
<?php the_content() ?>
<?php endwhile; ?>
</div><!-- end content inner-->
<?php get_footer(); ?>