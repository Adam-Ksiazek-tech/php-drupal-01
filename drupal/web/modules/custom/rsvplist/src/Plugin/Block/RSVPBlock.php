<?php

/**
 * @file
 * Creatres a block which displays the RTVPForm contained in RSVPForm.php
 */

namespace Drupal\rsvplist\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides the RSVP mian block.
 *
 * @Block(
 *   id = "rsvp_block",
 *   admin_label = @Translation("The RSVP Block")
 * )
 */
class RSVPBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('My RSVP List Block'),
    ];
  }
}
