<?php
namespace JBK\Core\Pts\SinglePost;

use \JBK\Core\Pts\PostTypes;
use \JBK\Core\Pts\PostType;
use \Cvy\WP\Assets\JS;

if ( ! defined( 'ABSPATH' ) ) exit;

// todo: extend from new version of cvy-metabox
final class SettingsMetabox
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

		add_action( 'add_meta_boxes', fn() => $this->register() );
  }

	private function register() : void
	{
		$bookable_pt_slugs = array_map(
			fn( $pt ) => $pt->get_slug(),
			PostTypes::get_bookable()
		);

		add_meta_box(
			'jbk_settings',
			'Booking Settings',
			fn() => $this->render(),
			$bookable_pt_slugs
		);
	}

	private function render() : void
	{
		require_once JBK_TEMPLATES_PATH . 'dashboard/metaboxes/post-settings.php';

    $this->enqueue_footer_js();
	}

	// todo: this doesn't work
	protected function enqueue_footer_js() : void
  {
    (new JS( 'dashboard-metabox-post-settings/index.dev.js', [ 'vue' ] ))->enqueue();
  }
}