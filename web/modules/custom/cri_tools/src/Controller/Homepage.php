<?php

namespace Drupal\cri_tools\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class Homepage.
 *
 * @package Drupal\cri_tools\Controller
 */
class Homepage extends ControllerBase {

  public function content() {

    // Returning an empty page. Homepage content will be provided by blocks.
    return array(
      '#type' => 'markup',
      '#markup' => 'asjflajslkajslkjasdklj',
    );
  }

}
