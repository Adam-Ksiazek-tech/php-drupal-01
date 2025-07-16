<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FirstController extends ControllerBase {
  public function simpleContent() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello Drupal world. Time flies like an arrow, fruit flies like a banana.'),
    ];
  }

  public function variableContent($name_1, $name_2) {
    return [
      '#type' => 'markup',
      '#markup' => t('@name1 and @name2 say hello',
        ['@name1' => $name_1, '@name2' => $name_2]),
    ];
  }

  public function sayHello() {
    return new Response('<html><body>Hello Drupal world.</body></html>');
  }

  public function sayHelloJSON() {
    $data = ['hello' => 'world'];
    return new JsonResponse($data);
  }

}
