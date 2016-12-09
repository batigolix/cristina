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

  protected $default_markup = 'The amusement park is the mirror-image space in which the boundaries between the real and the virtual fade away. The fact is that there is something ghostly about that illuminated architecture, sparkling, caught up in the darkness of the night, yet unlikely in the difficult balance of anti-gravitational forces that hold it up.<br /><br /><br />THE WONDERS OF VISION<br />Rosa Gutiérrez Herranz';

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'label' => t("Introduction visual"),
      'intro_english_markup_string' => $this->default_markup,
      'intro_visual_upload' => NULL,
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
    $form['intro_visual_upload'] = array(
      '#title' => t('Upload visual for the introduction'),
      '#type' => 'managed_file',
      '#description' => t('The uploaded image will be displayed in the introduction block that is on the homepage.'),
      '#default_value' => $this->configuration['intro_visual_upload'],
      '#upload_location' => 'public://images/',
      '#required' => FALSE,
      '#theme'    =>    'advphoto_thumb_upload',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {

//    parent::submitForm($form, $form_state);

//    $config_key = $form_state->getValue('config_key');
//    $this->editableConfig = [$config_key];
//    $config = $this->config($config_key);
//
//    // Exclude unnecessary elements before saving.
//    $form_state->cleanValues();
//    $form_state->unsetValue('var');
//    $form_state->unsetValue('config_key');
//
//    $values = $form_state->getValues();
//ksm($values);
//    // If the user uploaded a new logo or favicon, save it to a permanent location
//    // and use it in place of the default theme-provided file.
//    if (!empty($values['intro_visual_upload'])) {
//      $filename = file_unmanaged_copy($values['intro_visual_upload']->getFileUri());
//      $values['default_logo'] = 0;
//      $values['intro_visual_path'] = $filename;
//    }
//
//    $this->setConfigurationValue('org_name', $form_state->getValue('org_name'));
//
//    $this->configuration['intro_english_markup_string']
//      = $form_state->getValue('intro_english_markup_string_text');
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

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
//    $org_name = $form_state->getValue('org_name');
//    if (is_numeric($org_name)) {
//      drupal_set_message('needs to be an integer', 'error');
//      $form_state->setErrorByName('org_name', t('Organization name should not be numeric'));
//    }
//
//
//
////    if ($this->moduleHandler->moduleExists('file')) {
//      // Handle file uploads.
//      $validators = array('file_validate_is_image' => array());
//
//      // Check for a new uploaded logo.
////      $file = file_save_upload('intro_visual_upload', $validators, FALSE, 0);
//      if (isset($file)) {
//        // File upload was attempted.
//        if ($file) {
//          // Put the temporary file in form_values so we can save it on submit.
//          $form_state->setValue('intro_visual_upload', $file);
//        }
//        else {
//          // File upload failed.
//          $form_state->setErrorByName('intro_visual_upload', $this->t('The logo could not be uploaded.'));
//        }
//      }
//
////    }
//
//
  }




}
