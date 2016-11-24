<?php

/**
 * @file
 * Contain \Drupal\crimi\migrate\process
 */

namespace Drupal\crimi\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
//use Drupal\migrate\MigrateSkipProcessException;
use Drupal\migrate\MigrateSkipProcessException;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Example on how to migrate an image from any place in Drupal.
 *
 * @MigrateProcessPlugin(
 *   id = "file_import"
 * )
 */
class FileImport extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    dd($value);
//    \Drupal::logger('crimi')->notice(serialize($value));

    // Fails if there is no URL.
    if (empty($value)) {
      throw new MigrateSkipProcessException;
    }
    // Save the file, return its ID.
    $file = system_retrieve_file($value, 'public://', TRUE, FILE_EXISTS_REPLACE);

    // Attempts to find file by replacing the URL.
    if ($file == FALSE) {
      $source = str_replace('sites/cristina.val/files/', '', $value);
      $source = str_replace('test2.doesb.org', 'cristina.val', $source);
      if (substr($source, 0, 4) != "http") {
        $source = 'http://cristina.val' . $source;
      }
      $file = system_retrieve_file($value, 'public://', TRUE, FILE_EXISTS_REPLACE);
    }

    // Fails if no file is found.
    if ($file == FALSE) {
      throw new MigrateSkipProcessException;
    }

    // Returns the file ID if found.
    return $file->id();
  }
}
