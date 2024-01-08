<?php
namespace JBK\Core;

use \Cvy\DesignPatterns\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class DashboardPage
{
  protected function __construct()
  {
    add_action( 'admin_menu', fn() => $this->register() );
  }

  abstract protected function register() : void;

  abstract protected function get_menu_label() : string;

  abstract protected function get_page_title() : string;

  final protected function get_user_capability() : string
  {
    return 'manage_options';
  }

  abstract public function get_slug() : string;

  abstract protected function render_content() : void;
}