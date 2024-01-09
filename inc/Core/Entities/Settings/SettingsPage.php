<?php
namespace JBK\Core\Entities\Settings;

use \JBK\Core\Utils\Dashboard\SettingPages\SubPage;
use \JBK\Core\Entities\PostType;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends SubPage
{
  private PostType $post_type;

  public function __construct( PostType $post_type )
  {
		parent::__construct();

    $this->post_type = $post_type;
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

  public function get_page_title() : string
	{
		return $this->get_post_type()->get_label_multiple() . ' Booking Settings';
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
					'items_per_filter_page' => $this->get_post_type()->get_label_multiple() . ' per Page',
				],
			],
    ];
	}

	protected function handle_submission() : array
	{
		$notices = [];

		// todo

		if ( empty( $notices ) )
		{
			$notices[] = $this->get_success_notice();
		}

		return $notices;
	}

	protected function get_settings() : Settings
	{
		return $this->get_post_type()->get_settings();
	}
}