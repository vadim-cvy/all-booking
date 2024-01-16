<div class="jbk-filters-setting__filter__settings__section">
  <strong class="jbk-filters-setting__filter__settings__section__title">
    Filter Settings
  </strong>

  <div class="jbk-filters-setting__filter__settings__section__content">
    <?php
    foreach ( [ 'label', 'items-per-page' ] as $setting_name )
    {
      require_once jbk_get_template_path( __DIR__ . "/setting_$setting_name.php" );
    } ?>
  </div>
</div>
