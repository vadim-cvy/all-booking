<?php
namespace Jab\Utils\Settings\SettingsPages;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class TopPage extends Page
{
  final protected function register() : void
  {
    add_menu_page(
			$this->get_page_title(),
			$this->get_menu_label(),
			$this->get_user_capability(),
			$this->get_slug(),
			fn() => $this->render(),
			$this->get_menu_icon(),
			$this->get_menu_position(),
		);
  }

	protected function get_menu_icon() : string
  {
    return '';
  }
}