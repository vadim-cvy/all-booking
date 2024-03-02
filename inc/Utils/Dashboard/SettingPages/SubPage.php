<?php
namespace Jab\Utils\Dashboard\SettingPages;

if ( ! defined( 'ABSPATH' ) ) exit;

// todo: maybe remove
abstract class SubPage extends Page
{
  protected function register() : void
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