<?php
if ( ! empty( $template_args['connections'] ) )
{ ?>
  <ul>
    <?php
    foreach ( $template_args['connections'] as $connection_type_label )
    {
      printf( '<li>%s.</li>', $connection_type_label );
    } ?>
  </ul>
<?php
}
else
{
  printf( '<p>%s post type is not connected to any other bookable post types yet.</p>',
    $template_args['pt']->get_label_multiple()
  );
} ?>

<p>
  <?php
  printf( 'You can setup %s connections on <a href="%s">%s</a> page.',
    esc_html( strtolower( $template_args['pt']->get_label_single() ) ),
    esc_url( $template_args['global_settings_page']->get_url() ),
    esc_html( $template_args['global_settings_page']->get_page_title() )
  ); ?>
</p>