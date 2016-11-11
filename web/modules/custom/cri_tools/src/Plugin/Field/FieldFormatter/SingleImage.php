<?php

namespace Drupal\cri_tools\Plugin\Field\FieldFormatter;

use Drupal\Component\Utility\Html;
use Drupal\Core\Field\FieldItemInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatter;

/**
 * Plugin implementation of the 'single_image' field formatter.
 *
 * @FieldFormatter(
 *   id = "single_image",
 *   label = @Translation("Single image"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class SingleImage extends ImageFormatter {
  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = parent::settingsSummary();
    $summary[] = t('Showing a single image. To show all images use the default image formatter.');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = parent::viewElements($items, $langcode);
    $elements = array_slice($elements, 0, 1);
    return $elements;
  }

}
