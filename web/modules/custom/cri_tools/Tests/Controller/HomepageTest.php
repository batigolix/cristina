<?php

namespace Drupal\cri_tools\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the cri_tools module.
 */
class HomepageTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "cri_tools Homepage's controller functionality",
      'description' => 'Test Unit for module cri_tools and controller Homepage.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests cri_tools functionality.
   */
  public function testHomepage() {
    // Check that the basic functions of module cri_tools.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
