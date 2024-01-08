<?php
namespace JBK\Core\Entities\Settings;

use \JBK\Core\Entities\PostType;

if ( ! defined( 'ABSPATH' ) ) exit;

class Settings extends \JBK\Core\Utils\Settings
{
	private PostType $post_type;

  public function __construct( PostType $post_type )
  {
    $this->post_type = $post_type;
  }

	protected function get_defaults() : array
	{
		return [
			'has_limit' => true,
			'has_price' => true,
			'has_seasons' => true,
			'has_timeslots' => true,
			'is_blockable' => true,
			'has_filter' => true,
			'items_per_filter_page' => 12,
		];
	}

	public function get_slug() : string
	{
		return $this->post_type->get_slug() . '_booking_settings';
	}
}