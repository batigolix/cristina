<?php

/**
 * @file
 * Contain \Drupal\crimi\migrate\process
 */

namespace Drupal\crimi\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
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
//    $source = drupal_get_path('module', 'comics_migration') . '/migration_assets/images/' . $value;

//    $source = str_replace('http://cristina.val/','http://cristinasilvan.com/',$source);
//
//
//    //http://cristinasilvan.com/sites/cristinasilvan.com/files/images/LINK-UP.2.preview.jpg
//
//    if (!$uri = file_unmanaged_copy($source)) {
//      return [];
//    }
//
//    $file = \Drupal::entityTypeManager()->getStorage('file')->create(['uri' => $uri]);
//    $file->save();

    \Drupal::logger('crimi')->notice(serialize($value));


    if (empty($value)) {
      // Skip this item if there's no URL.
      throw new MigrateSkipProcessException();
    }

    $source = str_replace('sites/cristina.val/files/','',$value);

    // Save the file, return its ID.
    $file = system_retrieve_file($source, 'public://', TRUE, FILE_EXISTS_REPLACE);

//
    $ddumper = \Drupal::service('devel.dumper');
    $ddumper->debug($file);

    dd('afasasdasas');


//    drupal_debug($file);
//debug($file);
//
//    DevelDumperManagerInterface::debug($file);

//    \Drupal::logger('crimi')->notice($file->id());
//    \Drupal::logger('crimi')->notice(serialize($file));


    return $file->id();
  }


}
