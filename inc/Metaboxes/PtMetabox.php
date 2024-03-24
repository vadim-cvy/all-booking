<?php
namespace Jab\Metaboxes;

use Jab\Filters\Filters;
use Jab\FilterRelatedPosts\FilterRelatedPost;

if ( ! defined( 'ABSPATH' ) ) exit;

// todo: add hooks
final class PtMetabox extends \Jab\Utils\DesignPatterns\Singleton
{
  protected function __construct()
  {
    add_action( 'add_meta_boxes', fn() => $this->maybe_register() );

    $this->maybe_handle_submission();
  }

  private function maybe_register() : void
  {
    if ( ! $this->can_register() )
    {
      return;
    }

    $this->register();

    add_action( 'admin_enqueue_scripts', fn() => $this->enqueue_assets() );
  }

  private function can_register() : bool
  {
    return is_admin()
      && get_current_screen()->base === 'post'
      && isset( $_GET['post'] )
      && current_user_can( 'manage_options' )
      && $this->get_current_post()->has_related_popup_fields();
  }

  private function register() : void
  {
    add_meta_box( 'jab', jab_get_plugin_name(), fn() => $this->render(), get_current_screen() );
  }

  private function render() : void
  {
    require jab_resolve_path( JAB_TEMPLATES_PATH . '/dashboard/metaboxes/pt-metabox.php' );
  }

  private function get_js_data() : array
  {
    $current_post = $this->get_current_post();

    $overrides = [];

    // todo: make it work recursively
    foreach ( Filters::get_all() as $filter )
    {
      $filter_fields_overrides = [];

      foreach ( $filter->get_popup_fields() as $field )
      {
        if ( in_array( $field->get_id(), $current_post->get_related_popopup_field_ids() ) )
        {
          $filter_fields_overrides[] = [
            'id' => $field->get_id(),
            ...$field->get_raw_data(),
            ...$current_post->get_popup_field_overrides( $field->get_id() )
          ];
        }
      }

      if ( ! empty( $filter_fields_overrides ) )
      {
        $overrides[] = [
          'filterLabel' => $filter->get_label(),
          'fields' => $filter_fields_overrides,
        ];
      }
    }

    return [
      'limit' => $current_post->get_limit(),
      'overrides' => $overrides,
    ];
  }

  private function maybe_handle_submission() : void
  {
    if ( ! empty( $_POST ) )
    {
      add_action( 'save_post', fn( $post_id ) =>
        $this->can_register() && $this->get_current_post()->get_id() === $post_id ?
        $this->handle_submission() :
        null
      );
    }
  }

  // todo: add validation
  private function handle_submission() : void
  {
    $current_post = $this->get_current_post();

    $current_post->update_limit( (int) $_POST['jab']['limit'] );

    foreach ( $_POST['jab']['filters'] as $filter )
    {
      foreach ( $filter['popup']['fields'] as $submitted_field_data )
      {
        $field = Filters::get_popup_field( $submitted_field_data['id'] );

        $field_original = [
          'id' => $field->get_id(),
          ...$field->get_raw_data(),
        ];

        $current_post->update_popup_field_overrides(
          $submitted_field_data['id'],
          array_diff_assoc( $submitted_field_data, $field_original )
        );
      }
    }
  }

  private function enqueue_assets() : void
  {
    $vue_handle = jab_enqueue_vue();

    $local_handle_js = jab_enqueue_local_js( 'pt-metabox', 'dashboard/metaboxes/pt-metabox/index.dev.js', [ $vue_handle ] );

    wp_localize_script( $local_handle_js, 'jabMetaboxData', $this->get_js_data() );

    jab_enqueue_local_css( 'pt-metabox', 'dashboard/metaboxes/pt-metabox/index.css' );
  }

  private function get_current_post() : FilterRelatedPost | null
  {
    return new FilterRelatedPost( $_GET['post'] );
  }
}