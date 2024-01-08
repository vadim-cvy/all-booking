<?php
namespace JBK\Core;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class DashboardSubPage extends DashboardPage
{
  final protected function register() : void
  {
    add_submenu_page(
      $this->get_parent_page_slug(),
			$this->get_page_title(),
			$this->get_menu_label(),
			$this->get_user_capability(),
			$this->get_slug(),
			fn() => $this->render_content()
		);
  }

  abstract protected function get_parent_page_slug() : string;
}