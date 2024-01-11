<?php
namespace JBK\Core\Utils\Dashboard\SettingPages;

use \JBK\Core\Utils\ComplexOption;
use \Cvy\DesignPatterns\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class Page
{
  protected ComplexOption $settings;

  protected function __construct( ComplexOption $settings )
  {
    $this->settings = $settings;

    add_action( 'admin_menu', fn() => $this->register() );

    add_action( 'admin_init', fn() => $this->register_ui_elements() );
  }

  abstract protected function register() : void;

  abstract protected function get_menu_label() : string;

  abstract public function get_page_title() : string;

  final public function get_url() : string
  {
    return menu_page_url( $this->get_slug(), false );
  }

  final protected function get_user_capability() : string
  {
    return 'manage_options';
  }

  abstract public function get_slug() : string;

  final protected function render_content() : void
	{
		require_once JBK_TEMPLATES_PATH . 'dashboard/setting-pages/page-content.php';
	}

  private function register_ui_elements() : void
  {
    $this->register_sections();

    $this->register_fields();
  }

  private function register_sections() : void
  {
    foreach ( $this->get_sections_structure() as $slug_base => $section_data )
    {
      add_settings_section(
				$this->get_section_slug( $slug_base ),
				$section_data['label'],
				'__return_false',
				$this->get_slug()
			);
    }
  }

	abstract protected function get_sections_structure() : array;

	public final function get_section_slug( string $slug_base ) : string
	{
		return $this->get_slug() . '_section_' . $slug_base;
	}

  private function register_fields() : void
  {
		foreach ( $this->get_sections_structure() as $section_slug_base => $section_data )
		{
			foreach ( $section_data['fields'] as $field_slug_base => $field_label )
			{
				$field_slug = $this->get_slug() . '_field_' . $field_slug_base;

				add_settings_field(
					$field_slug,
					$field_label,
					fn() => $this->render_field( $field_slug_base ),
					$this->get_slug(),
					$this->get_section_slug( $section_slug_base ),
				);
			}
		}
  }

	private function render_field( string $setting_name ) : void
  {
    $template_args = $this->get_field_template_args( $setting_name );

		require JBK_TEMPLATES_PATH . "dashboard/setting-pages/field.php";
  }

  protected function get_field_template_args( string $setting_name ) : array
  {
    $setting_value_getter_name =
      preg_match( '/^is_|has_/', $setting_name ) ?
      $setting_name :
      'get_' . $setting_name;

    $setting_value =
      method_exists( $this->settings, $setting_value_getter_name ) ?
      $this->settings->$setting_value_getter_name() :
      null;

    $setting_name_dashed = str_replace( '_', '-', $setting_name );

    return [
      'input_id' => 'jbk-input_' . $setting_name_dashed,
      'input_name' => sprintf( '%s[%s]', $this->get_slug(), $setting_name ),
      'setting_name' => $setting_name,
      'setting_value' => $setting_value,
      'setting_name_dashed' => $setting_name_dashed,
    ];
  }

  // todo
	// private function maybe_handle_submission() : void
	// {
	// 	if ( ! current_user_can( $this->get_user_capability() ) )
	// 	{
	// 		return;
	// 	}

	// 	// todo: check is on the page (or is settings update page)

  //   // todo
	// 	// if ( ! isset( $_GET['settings-updated'] ) )
	// 	// {
  //   // }

  //   $notices = $this->handle_submission();

  //   foreach ( $notices as $notice )
  //   {
  //     add_settings_error(
  //       $this->get_notices_slug(),
  //       $notice['slug_base'],
  //       $notice['message'],
  //       $notice['type'],
  //     );
  //   }
  // }

  final protected function get_success_notice() : array
  {
    return [
      'slug_base' => 'success',
      'message' => 'Settings are successfully updated!',
      'type' => 'updated',
    ];
  }

  private function get_notices_slug() : string
  {
    return $this->get_slug() . '_messages';
  }
}