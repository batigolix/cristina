<?php
/**
 * @file
 * Contains \Drupal\example_migrate\Plugin\migrate\source\WorkNodes.
 */
namespace Drupal\example_migrate\Plugin\migrate\source;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;
use Drupal\migrate_source_json\Plugin\migrate\source\JSONSource;

/**
 * Drupal 8 node from database.
 *
 * @MigrateSource(
 *   id = "example_content"
 * )
 */
class WorkNodes extends JSONSource {
  /**
   * {@inheritdoc}
   */
//  public function query() {
//    $query = $this->select('articles', 'a')
//      ->fields('a', array('id', 'title', 'excerpt', 'content', 'image_id',
//        'category', 'created_at', 'updated_at'));
//    return $query;
//  }
  /**
   * {@inheritdoc}
   */
//  public function fields() {
//    $fields = array(
//      'id' => $this->t('Content ID'),
//      'title' => $this->t('Title of the content'),
//      'raw_content' => $this->t('Full text of the content'),
//      'excerpt' => $this->t('Summary of the content'),
//      'file_ids' => $this->t('IDs of the file from the articles_files table'),
//      'image_id' => $this->t('Image id'),
//      'created_at' => $this->t('The date YYYY-MM-DD H:i:s time that the post was added.'),
//      'updated_at' => $this->t('The date YYYY-MM-DD H:i:s time that the post was last updated.'),
//    );
//    return $fields;
//  }
  /**
   * {@inheritdoc}
   */
//  public function getIds() {
//    return array(
//      'id' => array(
//        'type' => 'integer',
//        'alias' => 'a',
//      ),
//    );
//  }
  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    if (parent::prepareRow($row) === FALSE) {
      return FALSE;
    }
    // In this example the source database has a table articles_files that hold the attached file ids of the articles.
    // We make an array of file_ids that we can map with our file migration.
    $file_ids = array();
    $content_id = $row->getSourceProperty('id');
    if (!empty($content_id)) {
      $file_ids = $this->select('articles_files', 'f')
        ->fields('f', array('file_id'))
        ->condition('article_id', $content_id)
        ->execute()
        ->fetchCol();
    }
    // Set a new property file_ids.
    $row->setSourceProperty('file_ids', $file_ids);
  }
}