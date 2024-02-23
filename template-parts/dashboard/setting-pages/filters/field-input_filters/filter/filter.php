<?php
foreach ( [ 'settings', 'preview' ] as $box_name )
{ ?>
  <div class="jbk-filter__<?php echo esc_attr( $box_name ); ?>">
    <?php require_once jbk_get_template_path( __DIR__ . "/$box_name/$box_name.php" ); ?>
  </div>
<?php
}