<?php
$filter_settings_sections = [
  'base' => 'Base',
  'booking' => 'Booking',
];

foreach ( $filter_settings_sections as $filter_settings_section_name => $filter_settings_section_label )
{ ?>
  <div class="jbk-filters__filter__settings__section">
    <strong class="jbk-filters__filter__settings__section__title">
      <?php echo esc_html( $filter_settings_section_label ); ?> Settings
    </strong>

    <div class="
      jbk-filters__filter__settings__section__content
      jbk-filters__filter__settings_<?php echo esc_attr( $filter_settings_section_name ); ?>
    ">
      <?php require_once jbk_get_template_path(
        __DIR__ . "/$filter_settings_section_name/$filter_settings_section_name.php" ); ?>
    </div>
  </div>
<?php
}