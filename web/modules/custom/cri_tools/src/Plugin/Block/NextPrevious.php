<?php

/**
 * @file
 * Contains \Drupal\cri_tools\Plugin\Block\NextPrevious.
 *
 * See https://ffwagency.com/blog/create-a-simple-nextprevious-navigation-in-drupal-8
 */

namespace Drupal\cri_tools\Plugin\Block;

use Drupal\Core\Link;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;

/**
 * Provides 'Next Previous' navigation.
 *
 * @Block(
 *   id = "next_previous",
 *   admin_label = @Translation("Next Previous"),
 *   category = @Translation("Blocks")
 * )
 */
class NextPrevious extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    // Gets the created time of the current node.
    $node = \Drupal::request()->attributes->get('node');
    $created_time = $node->getCreatedTime();

    // Gets the taxonomy term ID if there is one.
    $term = $node->get('field_group')->getValue();
    $term_target_id = $term ? $term[0]['target_id'] : NULL;

    // Looks up the previous (youngest node which is still older than the node
    // currently being viewed) and the next node (oldest node which is still younger than the node
    // currently being viewed).
    $build = array();
    if ($prev = $this->generateNextPrevious('prev', $created_time, $term_target_id)) {
      $build['prev'] = array(
        '#markup' => $prev,
        '#prefix' => '<div class="prev">',
        '#suffix'=>'</div>',
      );
    }
    if ($next = $this->generateNextPrevious('next', $created_time, $term_target_id)) {
      $build['next'] = array(
        '#markup' => $next,
        '#prefix' => '<div class="next">',
        '#suffix'=>'</div>',
      );
    }
    return $build;
  }

  /**
   * Looks up the next or previous node
   *
   * @param  string $direction either 'next' or 'previous'
   * @param  string $created_time a Unix time stamp
   * @return string an html link to the next or previous node
   */
  private function generateNextPrevious($direction = 'next', $created_time, $term_target_id = NULL) {
    if ($direction === 'next') {
      $comparison_operator = '>';
      $sort = 'ASC';
      $display_text = t('Next');
    }
    elseif ($direction === 'prev') {
      $comparison_operator = '<';
      $sort = 'DESC';
      $display_text = t('Previous');
    }

    //Looks up 1 node younger (or older) than the current node
    $query = \Drupal::entityQuery('node');
    $query->condition('created', $created_time, $comparison_operator)
      ->condition('type', 'work')
      ->sort('created', $sort)
      ->range(0, 1);
    if ($term_target_id) {
      $query->condition('field_group.target_id', $term_target_id);
    }
    $next = $query->execute();

    //If this is not the youngest (or oldest) node
    if (!empty($next) && is_array($next)) {
      $next = array_values($next);
      $next = $next[0];

      //Find the alias of the next node
      $next_url = \Drupal::service('path_alias.manager')
        ->getAliasByPath('/node/' . $next);

      //Build the URL of the next node
      $next_url = Url::fromUri('base:/' . $next_url);

      //Build the HTML for the next node
      return Link::fromTextAndUrl($display_text, $next_url);

    }
  }
}
