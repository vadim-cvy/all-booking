<?php
namespace JBK\Core\GlobalSettings;

use \Cvy\DesignPatterns\tSingleton;
use \JBK\Core\Utils\Dashboard\SettingPages\ParentPage;
use \JBK\Core\Entities\PostTypes;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends ParentPage
{
  use tSingleton;

  protected function __construct()
  {
    parent::__construct( Settings::get_instance() );
  }

  protected function get_menu_label() : string
  {
    return 'Booking Global Settings';
  }

  public function get_page_title() : string
  {
    return $this->get_menu_label();
  }

  public function get_slug() : string
  {
    return 'jbk_global_settings';
  }

  protected function get_sections_structure() : array
  {
    return [
      'common' => [
        'label' => 'Common',
        'fields' => [
          'bookable_entities' => 'Which of the post types will be involved into booking process?',
          'entity_connections' => 'Post Type Connections',
        ],
      ]
    ];
  }

  protected function get_field_template_args( string $setting_name ) : array
	{
		return array_merge( parent::get_field_template_args( $setting_name ), [
      'public_pts' => PostTypes::get_public(),
    ]);
	}

  // todo
  // protected function handle_submission() : array
  // {
  //   $notices = [];

	// 	// todo

	// 	if ( empty( $notices ) )
	// 	{
	// 		$notices[] = $this->get_success_notice();
	// 	}

	// 	return $notices;
  // }
}