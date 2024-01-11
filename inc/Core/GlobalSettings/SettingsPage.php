<?php
namespace JBK\Core\GlobalSettings;

use \Cvy\DesignPatterns\tSingleton;
use \JBK\Core\Utils\Dashboard\SettingPages\TopPage;
use \JBK\Core\Pts\PostTypes;
use \Cvy\WP\Assets\JS;

if ( ! defined( 'ABSPATH' ) ) exit;

class SettingsPage extends TopPage
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

  protected function get_menu_position() : int | null
  {
    return 25;
  }

  protected function enqueue_footer_js() : void
  {
    (new JS( 'dashboard-page-global-settings/index.dev.js', [ 'jquery' ] ))->enqueue();
  }

  protected function get_sections_structure() : array
  {
    return [
      'common' => [
        'label' => 'Common',
        'fields' => [
          'bookable-pts' => [
            'label' => 'Which of the post types will be involved into booking process?',
            'setting_name' => 'bookable_pts',
          ],
          'pt-connections' => [
            'label' => 'Post Type Connections',
            'setting_name' => 'pt_connections',
          ],
        ],
      ]
    ];
  }

  protected function get_field_template_args(
		string $field_name,
		string|null $setting_name,
		string $section_name
	) : array
	{
    $args = parent::get_field_template_args( $field_name, $setting_name, $section_name );

		$args['public_pts'] = PostTypes::get_public();

    if ( $field_name === 'pt-connections' )
    {
      $args['connection_types'] = $this->get_connection_type_options();
    }

    return $args;
	}

  public static function get_connection_type_options() : array
  {
    $one = '<strong>ONE</strong>';
    $only_one = '<strong>ONLY ONE</strong>';
    $one_or_more = '<strong>ONE OR MORE</strong>';

    $pt_label_single = '%pt_label_single%';
    $pt_label_multiple = '%pt_label_multiple%';

    $sub_pt_label_single = '%sub_pt_label_single%';
    $sub_pt_label_multiple = '%sub_pt_label_multiple%';

    return [
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