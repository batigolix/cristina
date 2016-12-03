<?php

namespace Drupal\cri_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'CriToolsIntroEnglish' block.
 *
 * @Block(
 *  id = "cri_tools_intro_english",
 *  admin_label = @Translation("Cristina tools: introduction in english"),
 * )
 */
class CriToolsIntroEnglish extends BlockBase {

  protected $default_markup = 'The amusement park is the mirror-image space in which the boundaries between the real and the virtual fade away. The fact is that there is something ghostly about that illuminated architecture, sparkling, caught up in the darkness of the night, yet unlikely in the difficult balance of anti-gravitational forces that hold it up.<br /><br /><br />THE WONDERS OF VISION<br />Rosa Gutiérrez Herranz';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'label' => t("Introduction in english"),
      'intro_english_markup_string' => $this->default_markup,
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
    $form['intro_english_markup_string_text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Introduction in english markup'),
      '#description' => $this->t('This text will appear in the introduction in english block.'),
      '#default_value' => $this->configuration['intro_english_markup_string'],
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['intro_english_markup_string']
      = $form_state->getValue('intro_english_markup_string_text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->configuration['intro_english_markup_string'],
    );
  }

}
