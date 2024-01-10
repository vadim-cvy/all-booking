<?php
namespace JBK\Core\Entities\Settings;

use \JBK\Core\Utils\Dashboard\SettingPages\SubPage;
use \JBK\Core\Entities\PostType;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends SubPage
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
		return 'edit.php?post_type=' . $this->pt->get_slug();
	}

  protected function get_menu_label() : string
	{
		return 'Booking Settings';
	}

  public function get_page_title() : string
	{
		return $this->pt->get_label_multiple() . ' Booking Settings';
	}

	protected function get_sections_structure() : array
	{
		return [
      'global' => [
				'label' => 'Global',
				'fields' => [
					'has_limit' => 'Has Limit',
					'has_price' => 'Has Price',
					'connections' => 'Connections',
				],
			],

			'time' => [
				'label' => 'Time',
				'fields' => [
					'has_seasons' => 'Has Seasons',
					'has_timeslots' => 'Has Timeslots',
					'is_blockable' => 'Is Time Blockable',
					'max_future_days' => 'Maximum days from today the booking can be made',
				],
			],

			'filter' => [
				'label' => 'Filter',
				'fields' => [
					'has_filter' => 'Has Filter',
					'items_per_filter_page' => $this->pt->get_label_multiple() . ' per Page',
				],
			],
    ];
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