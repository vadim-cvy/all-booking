<?php
namespace JBK\Core\Entities\Settings;

use \JBK\Core\DashboardSubPage;
use \JBK\Core\Entities\PostType;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends DashboardSubPage
{
  private PostType $post_type;

  public function __construct( PostType $post_type )
  {
		parent::__construct();

    $this->post_type = $post_type;

    add_action( 'admin_init', fn() => $this->register_settings() );
  }

  public function get_post_type() : PostType
  {
    return $this->post_type;
  }

  public function get_slug() : string
  {
    return $this->get_post_type()->get_slug();
  }

	protected function get_parent_page_slug() : string
	{
		return 'edit.php?post_type=' . $this->get_post_type()->get_slug();
	}

  protected function get_menu_label() : string
	{
		return 'Booking Settings';
	}

  protected function get_page_title() : string
	{
		return $this->get_post_type()->get_label_multiple() . ' Booking Settings';
	}

	private function register_settings() : void
  {
    $this->register_sections();

    $this->register_fields();

		$this->maybe_handle_submission();
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

	private function get_sections_structure() : array
	{
		return [
      'global' => [
				'label' => 'Global',
				'fields' => [
					'has_limit' => 'Has Limit',
					'has_price' => 'Has Price',
				],
			],

			'time' => [
				'label' => 'Time',
				'fields' => [
					'has_seasons' => 'Has Seasons',
					'has_timeslots' => 'Has Timeslots',
					'is_blockable' => 'Is Time Blockable',
				],
			],

			'filter' => [
				'label' => 'Filter',
				'fields' => [
					'has_filter' => 'Has Filter',
					'items_per_filter_page' => $this->get_post_type()->get_label_multiple() . ' per Page',
				],
			],
    ];
	}

	public function get_section_slug( string $slug_base ) : string
	{
		return $this->get_slug() . '_section_' . $slug_base;
	}

  private function register_fields() : void
  {
		// todo
		// 'limit' => [
		// 	'description' => 'Limit max item bookings at the same time interval?',
		// 	'hint' => 'You will be able to set custom limit for each item on the item edit page.',
		// ],

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
		$value = $this->get_post_type()->get_settings()->get_one( $setting_name );

		$input_id = $setting_name;
		$input_name = sprintf( '%s[%s]', $this->get_slug(), $setting_name );

		require JBK_TEMPLATES_PATH . "dashboard/post-type-booking-settings-page/field.php";
  }

	protected function render_content() : void
	{
		require_once JBK_TEMPLATES_PATH . 'dashboard/post-type-booking-settings-page/page-content.php';
	}

	// todo: move to DashboardPage
	protected function maybe_handle_submission() : void
	{
		if ( ! current_user_can( $this->get_user_capability() ) )
		{
			return;
		}

		// todo: check is on the page (or is settings update page)

		if ( isset( $_GET['settings-updated'] ) )
		{
			// add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
		}
	}
}