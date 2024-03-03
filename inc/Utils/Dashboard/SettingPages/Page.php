<?php
namespace Jab\Utils\Dashboard\SettingPages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Page extends \Jab\Utils\DesignPatterns\Singleton
{
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
    }
  }

  protected function on_is_current() : void
  {
    add_action( 'admin_enqueue_scripts', fn() => $this->enqueue_assets() );

    $this->instansiate_submission_handlers();
  }

  abstract protected function register() : void;

  abstract protected function get_menu_label() : string;

  abstract public function get_page_title() : string;

  public function get_url() : string
  {
    return menu_page_url( $this->get_slug(), false );
  }

  protected function get_user_capability() : string
  {
    return 'manage_options';
  }

  abstract public function get_slug() : string;

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
    $page_file_name = str_replace( [ 'jab_', '_' ], [ '', '-' ], $this->get_slug() );

    $template_args = $this->get_template_args();

    require_once jab_resolve_path(sprintf( JAB_TEMPLATES_PATH . 'dashboard/setting-pages/%s/%s.php',
      $page_file_name,
      $page_file_name
    ));
  }

  abstract protected function get_template_args() : array;

  abstract protected function instansiate_submission_handlers();
}