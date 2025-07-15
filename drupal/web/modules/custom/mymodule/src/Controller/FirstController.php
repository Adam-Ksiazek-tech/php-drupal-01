<?php

/**
 * @file
 * Generates markup to be display. Functionality in this Controlleris
 * wired to Drupal in mymodule.routing.yml
 */

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;

class FirstController extends ControllerBase {
  public function simpleContent() {
    return [
      '#type' => 'markup',
      '#markup' => t('Hello Drupal world.
                            Time flies like an arrow, fruit flies like a banana.'),
    ];
  }
}
