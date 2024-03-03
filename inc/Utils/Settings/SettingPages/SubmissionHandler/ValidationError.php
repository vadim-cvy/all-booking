<?php
namespace Jab\Utils\Settings\SettingPages\SubmissionHandler;

use Exception;

if ( ! defined( 'ABSPATH' ) ) exit;

class ValidationError extends Exception
{
  final public function __construct( $message = '' )
  {
    if ( ! empty( $message ) )
    {
      throw new Exception(sprintf(
        'You\'re doing it wrong. Use %s::throw_validation_error() or add_validation_error::%s() instead.',
        SubmissionHandler::class,
        SubmissionHandler::class
      ));
    }
  }
}