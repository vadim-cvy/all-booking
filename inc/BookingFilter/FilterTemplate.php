<?php
namespace JBK\BookingFilter;

if ( ! defined( 'ABSPATH' ) ) exit;

class FilterTemplate extends \Cvy\DesignPatterns\Singleton
{
  public function render() : void
  {
    extract( $this->get_vars() );

    require_once jbk_get_template_path( 'booking-filter/booking-filter.php' )
  }

  private function get_vars() : array
  {
    return apply_filters( 'jbk/booking-filter-template/vars', [
      'paginate_links_args' => $this->get_paginate_links_args(),
      'results' => // todo,
      'are_unavailable_hidden' => // todo,
      'items_label_plural' => // todo,
      'popup_types' => // todo,
    ]);
  }

  private function get_paginate_links_args() : array
  {
    return [
      'base' => str_replace( PHP_INT_MAX, '%#%', esc_url( get_pagenum_link( PHP_INT_MAX ) ) ),
      'format' => '?page=%#%',
      'current' => $this->get_cur_page(),
      'total' => $this->get_total_pages(),
      'prev_text' => '<',
      'next_text' => '>',
    ];
  }

  private function get_cur_page() : int
  {
    return $_GET['page'] ?? 1;
  }

  private function get_total_pages() : int
  {
    // todo: implement
  }
}