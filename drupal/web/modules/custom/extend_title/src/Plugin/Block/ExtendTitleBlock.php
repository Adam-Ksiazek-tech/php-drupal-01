<?php

namespace Drupal\extend_title\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * @Block(
 *   id = "title_html_block",
 *   admin_label = @Translation("Title HTML Block")
 * )
 */
class ExtendTitleBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#markup' => '<div class="extendTitleBlock">hello block here #100</div>',
      '#allowed_tags' => ['div'], // jeśli włączony filtr bezpieczeństwa
      '#attached' => [
        'library' => [
          'extend_title/extend_title_styles'
        ],
      ],
    ];
  }
}


