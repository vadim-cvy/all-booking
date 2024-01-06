<?php
if ( ! defined( 'ABSPATH' ) ) exit;


require_once __DIR__ . '/vendor/autoload.php';


/**
 * Base Constants
 */
define( 'JBK_ROOT_PATH', __DIR__ . '/' );
define( 'JBK_TEMPLATES_PATH', JBK_ROOT_PATH . 'template-parts/' );


/**
 * Validate environment (CVY_ENV constant must defined in wp-config.php).
 * @see https://github.com/vadim-cvy/util-wp-env
 */
Cvy\WP\Env\Env::get_instance();
Cvy\WP\Env\Env::set_is_grid_pane( true );


/**
 * Reduce WP All In One Migration export file size.
 * @see https://github.com/vadim-cvy/util-wp-all-in-one-migration/
 */
Cvy\WP\AllInOneMigration\Main::get_instance()
  ->set_app_root_dir( JBK_ROOT_PATH )
  ->add_base_export_exclusions()
  ->add_export_exclusions([
    'assets/src',
    'webpack.base.config.js',
    'webpack.dev.config.js',
    'webpack.prod.config.js',
  ]);


/**
 * Set up assets util and enqueue main stylesheet of this theme.
 * @see https://github.com/vadim-cvy/util-wp-assets
 */
Cvy\WP\Assets\Main::set_app_namespace( 'jbk' );

require_once __DIR__ . '/core-functions.php';