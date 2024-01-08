<?php
namespace JBK\Core\Utils\Dashboard\SettingPages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class ParentPage extends Page
{
  final protected function register() : void
  {
    add_menu_page(
			$this->get_page_title(),
			$this->get_menu_label(),
			$this->get_user_capability(),
			$this->get_slug(),
			fn() => $this->render_content()
		);
  }
}