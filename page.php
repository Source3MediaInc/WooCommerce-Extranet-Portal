<?php

get_header();

?>
<div class="container">
  <h2 class="text-center"><?php the_title();?></h2>
  <div class="row">
    <?php the_content();?>
  </div>
</div>

<?php

get_footer();

?>
