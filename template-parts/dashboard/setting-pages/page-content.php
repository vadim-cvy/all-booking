<?php
if ( ! defined( 'ABSPATH' ) ) exit;

settings_errors( $this->get_notices_slug() ); ?>

<div class="wrap">
  <h1>
    <?php echo esc_html( get_admin_page_title() ); ?>
  </h1>

  <form action="options.php" method="post">
    <?php
    settings_fields( $this->get_slug() );

    do_settings_sections( $this->get_slug() );

    submit_button( 'Save' );
    ?>
  </form>
</div>