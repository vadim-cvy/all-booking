
<div class="jbk-filters-setting__filter__settings__section">
  <strong class="jbk-filters-setting__filter__settings__section__title">
    Popup
  </strong>

  <div class="jbk-filters-setting__filter__settings__section__content">
    <?php
    foreach ( [ 'has-time-slots', 'popup-fields' ] as $popup_setting_name )
    {
      require_once jbk_get_template_path( __DIR__ . "/setting_$popup_setting_name/setting_$popup_setting_name.php" );
    } ?>
  </div>
</div>