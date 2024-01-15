<?php
namespace JBK\Core\Pts\Settings;

use \JBK\Core\Utils\Dashboard\SettingPages\SubPage;
use \JBK\Core\Pts\PostType;
use \JBK\Core\GlobalSettings\SettingsPage as GlobalSettingsPage;

if ( ! defined( 'ABSPATH' ) ) exit;

final class SettingsPage extends SubPage
{
	static private array $instances = [];

  private PostType $pt;

	static public function get_instance( PostType $pt )
	{
		if ( ! isset( static::$instances[ $pt->get_slug() ] ) )
		{
			static::$instances[ $pt->get_slug() ] = new static( $pt );
		}

		return static::$instances[ $pt->get_slug() ];
	}

  protected function __construct( PostType $pt )
  {
    $this->pt = $pt;

		parent::__construct( $pt->get_settings() );
  }

  public function get_slug() : string
  {
    return $this->settings->get_name();
  }

	protected function get_parent_page_slug() : string
	{
		return GlobalSettingsPage::get_instance()->get_slug();
	}

  protected function get_menu_label() : string
	{
		return $this->pt->get_label_multiple() . ' Settings';
	}

  public function get_page_title() : string
	{
		return $this->pt->get_label_multiple() . ' Booking Settings';
	}

	protected function enqueue_footer_js() : void {}

	protected function get_sections_structure() : array
	{
		return [
			'common' => [
				'label' => 'Common',
				'fields' => [
					'has-limit' => [
						'label' => 'Has Limit',
						'setting_name' => 'has_limit'
					],
					'has-price' => [
						'label' => 'Has Price',
						'setting_name' => 'has_price'
					],
					'connections' => [
						'label' => 'Connections',
						'setting_name' => 'connections'
					],
				],
			],

			'time' => [
				'label' => 'Time',
				'fields' => [
					'has-seasons' => [
						'label' => 'Has Seasons',
						'setting_name' => 'has_seasons',
					],
					'has-timeslots' => [
						'label' => 'Has Timeslots',
						'setting_name' => 'has_timeslots',
					],
					'is-blockable' => [
						'label' => 'Is Time Blockable',
						'setting_name' => 'is_blockable',
					],
					'max-future-days' => [
						'label' => 'Maximum days from today the booking can be made',
						'setting_name' => 'max_future_days',
					],
				],
			],
    ];
	}

	protected function get_field_template_args(
		string $field_name,
		string|null $setting_name,
		string $section_name
	) : array
	{
		$args = parent::get_field_template_args( $field_name, $setting_name, $section_name );

		$args['pt'] = $this->pt;

		if ( $field_name === 'connections' )
		{
			$args['global_settings_page'] = GlobalSettingsPage::get_instance();

			$args['connections'] = [];

			foreach ( $this->pt->get_connections() as $connection )
			{
				$connection_type_label = GlobalSettingsPage::get_connection_type_options()[ $connection['type'] ];

				$label_placeholders = [
					'%pt_label_single%' => strtolower( $this->pt->get_label_single() ),
					'%pt_label_multiple%' => strtolower( $this->pt->get_label_multiple() ),
					'%sub_pt_label_single%' => strtolower( $connection['pt']->get_label_single() ),
					'%sub_pt_label_multiple%' => strtolower( $connection['pt']->get_label_multiple() ),
				];

				$args['connections'][] = str_replace(
					array_keys( $label_placeholders ),
					array_values( $label_placeholders ),
					$connection_type_label
				);
			}
		}
		else if ( $field_name === 'filter-shortcode' )
		{
			$args['shortcode'] = sprintf( '[%s_filter]', $args['pt']->get_slug() );
		}

		return $args;
	}

	// todo
	// protected function handle_submission() : array
	// {
	// 	$notices = [];

	// 	// todo

	// 	if ( empty( $notices ) )
	// 	{
	// 		$notices[] = $this->get_success_notice();
	// 	}

	// 	return $notices;
	// }
}