<?php

namespace Drupal\cri_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'CriToolsIntroVisual' block.
 *
 * @Block(
 *  id = "cri_tools_intro_visual",
 *  admin_label = @Translation("Cristina tools: introduction visual"),
 * )
 */
class CriToolsIntroVisual extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $path = \Drupal::service('extension.list.module')->getPath('cri_tools');
    return [
      '#theme' => 'image',
      '#width' => 600,
      '#height' => 450,
      '#uri' => $path . '/assets/intro-visual.jpg',
      '#alt' => 'Link up tres 2014 Acrylic on wood 150 x 400 cm',
      '#title' => 'Link up tres 2014 Acrylic on wood 150 x 400 cm',
    ];
  }

}
