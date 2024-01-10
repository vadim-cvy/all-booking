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
		$args = array_merge( parent::get_field_template_args( $setting_name ), [
      'public_pts' => PostTypes::get_public(),
    ]);

    if ( $setting_name === 'entity_connections' )
    {
      $one = '<strong>ONE</strong>';
      $only_one = '<strong>ONLY ONE</strong>';
      $one_or_more = '<strong>ONE OR MORE</strong>';

      $pt_label_single = '%pt_label_single%';
      $pt_label_multiple = '%pt_label_multiple%';

      $sub_pt_label_single = '%sub_pt_label_single%';
      $sub_pt_label_multiple = '%sub_pt_label_multiple%';

      $args['connection_types'] = [
        'no_connection' => 'No connection',
        'one_to_one' =>
          "$one $pt_label_single may be connected to $only_one $sub_pt_label_single"
          . " <i>and</i> $one $sub_pt_label_single may be connected to $only_one $pt_label_single",
        'one_to_many' =>
          "$one $pt_label_single may be connected to $one_or_more $sub_pt_label_multiple"
          . " <i>but</i> $one $sub_pt_label_single may be connected to $only_one $pt_label_single",
        'many_to_one' =>
          "$one $pt_label_single may be connected to $only_one $sub_pt_label_single"
          . " <i>but</i> $one $sub_pt_label_single may be connected to $one_or_more $pt_label_multiple",
        'many_to_many' =>
          "$one $pt_label_single may be connected to $one_or_more $sub_pt_label_multiple"
          . " <i>and</i> $one $sub_pt_label_single may be connected to $one_or_more $pt_label_multiple",
      ];
    }

    return $args;
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