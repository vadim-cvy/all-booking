<?php
namespace Jab\Utils;

use WP_Error;
use Jab\Utils\Hooks\iHookable;

if ( ! defined( 'ABSPATH' ) ) exit;

// todo: add hooks
abstract class Shortcode extends \Jab\Utils\DesignPatterns\Singleton implements iHookable
{
  use \Jab\Utils\Hooks\tHookable;

  private array $atts;

  private string $user_content;

  private array $att_validation_errors = [];

  private bool $are_assets_enqueued = false;

  protected function __construct()
  {
    add_shortcode(
      $this->get_name(),
      fn( array | string $atts, string $user_content = '' ) => $this->handle( $atts, $user_content )
    );

    add_action( 'wp_enqueue_scripts', fn() => $this->maybe_enqueue_assets_automatically() );
  }

  static public function get_name() : string
  {
    return 'jab_' . static::get_name_base();
  }

  abstract static protected function get_name_base() : string;

  private function handle( array | string $atts, string $user_content ) : string
  {
    if ( ! is_array( $atts ) )
    {
      $atts = [];
    }

    $this->set_atts( $atts );

    $this->set_user_content( $user_content );

    return $this->get_wrapper_opening_tag() . $this->get_content() . $this->get_wrapper_closing_tag();
  }

  private function set_user_content( string $user_content ) : void
  {
    $this->user_content = $user_content;
  }

  protected function get_user_content() : string
  {
    return $this->user_content;
  }

  abstract protected function get_allowed_att_names() : array;

  abstract protected function get_required_att_names() : array;

  private function set_atts( array $raw_atts ) : void
  {
    $missing_atts = array_diff(
      $this->get_required_att_names(),
      array_keys( $raw_atts )
    );

    if ( ! empty( $missing_atts ) )
    {
      $this->att_validation_errors[] = sprintf( 'The following atts are missing: "%s".',
        implode( '", "', $missing_atts )
      );
    }

    $allowed_atts = $this->get_allowed_att_names();

    foreach ( $raw_atts as $name => $value )
    {
      if ( ! in_array( $name, $allowed_atts ) )
      {
        $this->att_validation_errors[] = sprintf( 'Unexpected attribute passed: "%s"! Allowed attributes are: "%s".',
          $name,
          implode( '", "', $allowed_atts )
        );
      }

      $att_value = $this->validate_sanitize_att( $name, $value, $raw_atts );

      if ( is_wp_error( $att_value ) )
      {
        $this->att_validation_errors[] = sprintf( 'Attribute "%s": %s', $name, $att_value->get_error_message() );
      }
      else
      {
        $this->atts[ $name ] = $att_value;
      }
    }

    foreach ( $this->att_validation_errors as $error_message )
    {
      $this->throw_notice( $error_message );
    }
  }

  abstract protected function validate_sanitize_att(
    string $name,
    mixed $value,
    array $raw_atts
  ) : WP_Error | string | int | float;

  protected function get_att( string $name, mixed $default = null ) : mixed
  {
    return $this->atts[ $name ] ?? $default;
  }

  private function get_content() : string
  {
    $error_message_pattern = '<b>Error. Can\'t render this content. %s</b>';

    ob_start();

    if ( ! $this->are_assets_enqueued )
    {
      echo $this->get_render_error_html( 'Assets are not enequeued!' );
    }
    else if ( ! empty( $this->att_validation_errors ) )
    {
      echo $this->get_render_error_html(sprintf( 'Attribute validation error(s): <p>%s</p>',
        implode( '</p><p>', $this->att_validation_errors )
      ));
    }
    else
    {
      $render_result = $this->render();

      if ( is_wp_error( $render_result ) )
      {
        ob_clean();

        echo $this->get_render_error_html( $render_result->get_error_message() );
      }
    }

    $content = ob_get_contents();

    ob_end_clean();

    return $content;
  }

  private function get_render_error_html( string $message ) : string
  {
    $html = '<b>Error. Can\'t render this content.<br>';

    if ( current_user_can( 'manage_options' ) )
    {
      $html .= ' ' . $message;
    }

    $html .= '</b>';

    return $html;
  }

  private function get_wrapper_opening_tag() : string
  {
    $tag = '<' . $this->get_wrapper_tag_name();

    foreach ( $this->get_wrapper_tag_atts() as $key => $value )
    {
      $tag .= sprintf( ' %s="%s"', esc_attr( $key ), esc_attr( $value ) );
    }

    $tag .= '>';

    return $tag;
  }

  protected function get_wrapper_tag_atts() : array
  {
    return [
      'class' => str_replace( '_', '-', $this->get_name() ),
    ];
  }

  private function get_wrapper_closing_tag() : string
  {
    return sprintf( '</%s>', $this->get_wrapper_tag_name() );
  }

  protected function get_wrapper_tag_name() : string
  {
    return 'div';
  }

  abstract protected function render() : WP_Error | null;

  private function maybe_enqueue_assets_automatically() : void
  {
    if ( $this->should_enqueue_assets_automatically() )
    {
      $this->enqueue_assets();
    }
  }

  protected function should_enqueue_assets_automatically() : bool
  {
    return is_singular() && has_shortcode( get_the_content(), $this->get_name() );
  }

  public function enqueue_assets() : void
  {
    $this->enqueue_js();
    $this->enqueue_css();

    $this->are_assets_enqueued = true;
  }

  abstract protected function enqueue_js() : void;

  abstract protected function enqueue_css() : void;

  protected function throw_notice( string $msg ) : void
  {
    $msg .= ' Shortcode name: "' . $this->get_name() . '".';

    trigger_error( $msg );
  }

  static protected function get_hook_base_args() : array
  {
    return [];
  }

  static protected function get_hook_name_prefix() : string
  {
    return 'shortcode/' . static::get_name_base();
  }

  static protected function get_parent_hookable() : iHookable | null
  {
    return null;
  }
}