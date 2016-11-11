<?php

namespace Drupal\cri_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'CriToolsCredits' block.
 *
 * @Block(
 *  id = "cri_tools_credits",
 *  admin_label = @Translation("Cristina tools: credits"),
 * )
 */
class CriToolsCredits extends BlockBase {

  protected $default_markup = 'All work (c) 2010 - 2016 Cristina Silván. All rights reserved.';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'label' => t("Credits"),
      'credits_markup_string' => $this->default_markup,
      'cache' => array(
        'max_age' => 3600,
        'contexts' => array(
          'cache_context.user.roles',
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['credits_markup_string_text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Credits markup'),
      '#description' => $this->t('This text will appear in the example block.'),
      '#default_value' => $this->configuration['credits_markup_string'],
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['credits_markup_string']
      = $form_state->getValue('credits_markup_string_text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->configuration['credits_markup_string'],
    );
  }

}
