<div class="jab-filter__item__popup-triggers">
  <?php
  foreach ( $template_args['item_popup_triggers'] as $popup_trigger )
  { ?>
    <a
      href="#"
      class="
        jab-filter__item__popup-trigger
        jab-filter__item__popup-trigger--<?php echo esc_attr( $popup_trigger['slug'] ); ?>"
      @click.prevent="openItemPopup( item.id, '<?php echo esc_attr( $popup_trigger['slug'] ); ?>' )"
    >
      <?php echo $popup_trigger['label_html']; ?>
    </a>
  <?php
  } ?>
</div>