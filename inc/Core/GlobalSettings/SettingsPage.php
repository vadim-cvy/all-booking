<?php
namespace JBK\Core\GlobalSettings;

use \Cvy\DesignPatterns\tSingleton;
use \JBK\Core\Utils\Dashboard\SettingPages\ParentPage;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends ParentPage
{
  use tSingleton;

  protected function __construct()
  {
    parent::__construct();
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
          'which' => 'Which of the post types will be involved into booking process?',
          'db_connections' => 'Post Type Connections',
        ],
      ]
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
    return Settings::get_instance();
  }
}