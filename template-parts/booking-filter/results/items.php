<?php
if ( ! defined( 'ABSPATH' ) ) exit;

foreach ( $results as $date_label => $date_items )
{ ?>
  <div class="jbk-filter__results__section">
    <h3 class="jbk-filter__results__section__label">
      <?php echo esc_html( $date_label ); ?>
    </h3>

    <div class="jbk-filter__results__section__items">
      <?php
      foreach ( $date_items as $item )
      {
        require jbk_get_template_path( 'booking-filter/results/item.php' );
      } ?>
    </div>
  </div>
<?php
}