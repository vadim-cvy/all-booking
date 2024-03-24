<?php
namespace Jab;

if ( ! defined( 'ABSPATH' ) ) exit;

// todo: add hooks
final class Dashboard extends \Jab\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_action( 'admin_enqueue_scripts', fn() => $this->enqueue_base_assets() );
  }

  private function enqueue_base_assets() : void
  {
    jab_enqueue_local_css( 'dashboard-base', 'dashboard/index.css' );
  }
}