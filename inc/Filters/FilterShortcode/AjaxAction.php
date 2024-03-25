<?php
namespace Jab\Filters\FilterShortcode;

use Exception;
use Jab\Filters\Filter;

if ( ! defined( 'ABSPATH' ) ) exit;

abstract class AjaxAction extends \Jab\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    $hook_prefixes = [ 'wp_ajax' ];

    if ( $this->is_nopriv_allowed() )
    {
      $hook_prefixes[] = 'wp_ajax_nopriv';
    }

    foreach ( $hook_prefixes as $hook_prefix )
    {
      $hook_name = $hook_prefix . '_jab_filter_' . $this->get_name_base();

      add_action( $hook_name, fn() => $this->handle_submission() );
    }
  }

  abstract protected function get_name_base() : string;

  abstract protected function is_nopriv_allowed() : bool;

  abstract protected function handle_submission() : void;

  protected function get_filter_instance() : Filter
  {
    $filter_id = $this->get_submitted_data()['filter_id'] ?? null;

    if ( ! isset( $filter_id ) )
    {
      throw new Exception( 'Filter id is missed!' );
    }

    $filter = new Filter( $filter_id );

    if ( ! $filter->exists() )
    {
      throw new Exception( 'Filter does not exist!' );
    }

    return $filter;
  }

  protected function get_submitted_data() : array
  {
    $data = $_POST;

    array_walk_recursive( $data, fn( &$value ) => $value = stripslashes( $value ) );

    return $data;
  }

  protected function send_ajax_error( string $err_msg ) : void
  {
    wp_send_json_error([ 'errMsg' => $err_msg ]);
  }

  protected function send_ajax_success( array $data ) : void
  {
    wp_send_json_success( $data );
  }
}