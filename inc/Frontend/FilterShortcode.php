<?php
namespace Jab\Frontend;

use WP_Error;
use Jab\Filter;

if ( ! defined( 'ABSPATH' ) ) exit;

final class FilterShortcode extends \Jab\Utils\Shortcode
{
  static protected function get_name_base() : string
  {
    return 'filter';
  }

  protected function get_allowed_att_names() : array
  {
    return $this->get_required_att_names();
  }

  protected function get_required_att_names() : array
  {
    return [ 'id' ];
  }

  protected function render() : WP_Error | null
  {
    $template_args = $this->get_template_args();

    require jab_resolve_path( JAB_TEMPLATES_PATH . '/frontend/filter-shortcode/filter-shortcode.php' );

    return null;
  }

  protected function get_template_args() : array
  {
    return [
      'filter' => new Filter( $this->get_att( 'id' ) ),
      'item_popup_triggers' => [
        [
          'slug' => 'details',
          'label_html' => 'Details',
        ],
        [
          'slug' => 'book',
          'label_html' => 'Book Now',
        ],
      ],
    ];
  }

  protected function enqueue_js() : void
  {
    $vue_handle = jab_enqueue_vue();

    jab_enqueue_local_js( 'filter-shortcode', 'frontend/filter-shortcode/index.dev.js', [ $vue_handle ] );
  }

  protected function enqueue_css() : void
  {
    jab_enqueue_local_css( 'filter-shortcode', 'frontend/filter-shortcode/index.css');
  }

  protected function validate_sanitize_att(
    string $name,
    mixed $value,
    array $raw_atts
  ) : WP_Error | string | int | float
  {
    switch ( $name )
    {
      case 'id':
        $value = (int) $value;

        $value = (new Filter( $value ))->exists() ? $value : new WP_Error( 'invalid_id', 'This filter does not exist.' );

        break;
    }

    return $value;
  }

  protected function get_wrapper_tag_atts() : array
  {
    return [
      ...parent::get_wrapper_tag_atts(),
      'data-jab-filter-id' => $this->get_att( 'id' ),
    ];
  }
}