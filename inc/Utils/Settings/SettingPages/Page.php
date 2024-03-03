<?php
namespace Jab\Utils\Settings\SettingPages;

use \Jab\Utils\Hooks\iHookable;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Page extends \Jab\Utils\DesignPatterns\Singleton implements iHookable
{
  use \Jab\Utils\Hooks\tHookable;

  protected function __construct()
  {
    add_action( 'admin_menu', fn() => $this->register() );

    add_action( 'current_screen', fn() => $this->on_maybe_is_current() );
  }

  private function on_maybe_is_current() : void
  {
    if (
      get_current_screen()->id === 'toplevel_page_' . $this->get_slug()
      && current_user_can( $this->get_user_capability() )
    )
    {
      $this->on_is_current();

      $this->do_action( 'on_is_current' );
    }
  }

  protected function on_is_current() : void
  {
    add_action( 'admin_enqueue_scripts', fn() => $this->enqueue_assets() );

    $this->instansiate_submission_handlers();
  }

  abstract protected function register() : void;

  abstract static protected function get_menu_label() : string;

  abstract static public function get_page_title() : string;

  final static public function get_url() : string
  {
    return menu_page_url( static::get_slug(), false );
  }

  final static protected function get_user_capability() : string
  {
    return static::apply_filters( 'user_capability', static::get_user_capability_raw() );
  }

  static protected function get_user_capability_raw() : string
  {
    return 'manage_options';
  }

  abstract static public function get_slug() : string;

  final protected function render() : void
	{
    echo '<div class="wrap">';

    printf( '<h1>%s</h1>', esc_html( $this->get_page_title() ) );

    printf( '<form action="%s" method="post" id="%s">',
      esc_url( $this->get_url() ),
      esc_attr( str_replace( '_', '-', $this->get_slug() ) )
    );

    $this->render_fields();

    submit_button( 'Save' );

    echo '</form>';

    echo '</div>';
	}

  private function render_fields() : void
  {
    $template_name = str_replace( [ 'jab_', '_' ], [ '', '-' ], $this->get_slug() );

    $template_args = $this->get_template_args();

    require_once jab_resolve_path(sprintf( JAB_TEMPLATES_PATH . 'dashboard/setting-pages/%s/%s.php',
      $template_name,
      $template_name
    ));
  }

  abstract protected function get_template_args() : array;

  abstract
   protected function instansiate_submission_handlers() : void;

  static protected function get_hook_base_args() : array
  {
    return [ static::get_slug() ];
  }

  static protected function get_hook_name_prefix() : string
  {
    return 'settings-page/';
  }

  static protected function get_parent_hookable() : iHookable | null
  {
    return null;
  }
}