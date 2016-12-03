<?php

namespace Drupal\cri_tools\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'CriToolsIntroSpanish' block.
 *
 * @Block(
 *  id = "cri_tools_intro_spanish",
 *  admin_label = @Translation("Cristina tools: introduction in spanish"),
 * )
 */
class CriToolsIntroSpanish extends BlockBase {

  protected $default_markup = 'El parque de atracciones es ese espacio especular en el que las fronteras entre lo real y lo virtual se diluyen. Y es que esa arquitectura de luz que centellea prendida en la oscuridad de la noche, tiene algo de espectral. Incluso de inverosímil, en el difícil equilibrio de fuerzas antigravitatorias que la sostiene.<br /><br /><br />LOS PRODIGIOS DE LA VISIÓN<br />Rosa Gutiérrez Herranz</p>';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'label' => t("Introduction in spanish"),
      'intro_spanish_markup_string' => $this->default_markup,
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
    $form['intro_spanish_markup_string_text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Introduction in spanish markup'),
      '#description' => $this->t('This text will appear in the introduction in spanish block.'),
      '#default_value' => $this->configuration['intro_spanish_markup_string'],
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['intro_spanish_markup_string']
      = $form_state->getValue('intro_spanish_markup_string_text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#type' => 'markup',
      '#markup' => $this->configuration['intro_spanish_markup_string'],
    );
  }

}
