<?php
/**
 * @file
 * Contains \Drupal\crimi\Plugin\migrate\source\GalleryTerms.
 */
namespace Drupal\crimi\Plugin\migrate\source;
use Drupal\migrate_source_json\Plugin\migrate\source\JSONSource;

/**
 * Tags source from database.
 *
 * @MigrateSource(
 *   id = "gallery_terms"
 * )
 */
class GalleryTerms extends JSONSource {
  /**
   * {@inheritdoc}
   */
//  public function query() {
//    // We retrieve distinct value of category name from the articles table.
//    return $this->select('articles', 'a')
//      ->fields('a', array('category'))
//      ->distinct()
//      ->groupBy('a.category');
//  }
//  /**
//   * {@inheritdoc}
//   */
//  public function fields() {
//    $fields = array(
//      'category' => $this->t('Category name'),
//    );
//    return $fields;
//  }



  /**
   * {@inheritdoc}
   */
  public function getIds() {
    // We can use the category name as a unique string id.
    return array(
      'category' => array(
        'type' => 'string',
        'alias' => 'a',
      ),
    );
  }
}