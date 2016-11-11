<?php
/**
 * @file
 * Contains \Drupal\crimi\Plugin\migrate\process\Body2.
 */
namespace Drupal\crimi\Plugin\migrate\process;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;
use Drupal\migrate\MigrateSkipRowException;
/**
 * Process the file url into a D8 compatible URL.
 *
 * @MigrateProcessPlugin(
 *   id = "body2"
 * )
 */
class Body2 extends ProcessPluginBase {
  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {

    dd($row);



    list($filepath, $filename) = $value;
    $destination_base_uri = 'public://files';
    return $destination_base_uri . $filename;
  }
}