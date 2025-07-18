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
 *   admin_label = @Translation("The RSVP Block #101")
 * )
 */
class RSVPBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    /*return [
      '#type' => 'markup',
      '#markup' => $this->t('My RSVP List Block #102'),
    ];*/

    return \Drupal::formBuilder()->getForm('Drupal\rsvplist\Form\RSVPForm');
  }

  public function blockAccess(AccountInterface $account)
  {
    $node = \Drupal::routeMatch()->getParameter('node');
    if ( !(is_null($node)) ) {
      return AccessResult::allowedIfHasPermission($account, 'view rsvplist');
    }

    return AccessResult::forbidden();
  }
}
