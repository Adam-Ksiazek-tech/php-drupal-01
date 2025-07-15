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

  public function sayHello() {
    return new Response('<html><body>Hello Drupal world.</body></html>');
  }

  public function sayHelloJSON() {
    $data = ['hello' => 'world'];
    return new JsonResponse($data);
  }

}
