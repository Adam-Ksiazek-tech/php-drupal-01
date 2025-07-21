<?php

/**
 * @file
 * Contains the RSVP Enabler service.
 */

namespace Drupal\rsvplist;

use Drupal\Core\Database\Connection;
use Drupal\node\Entity\Node;

class EnablerService {
  protected $database_connection;

  public function __construct(Connection $connection) {
    $this->database_connection = $connection;
  }

  /**
   * Checks if an individual node is RSVP functionality
   *
   * @param Node $node
   * @return bool
   * whether or not node is enabled for the RSVP functionality.
   */
  public function isEnabled(Node &$node) {
    if ($node->isNew()) {
      return FALSE;
    }
    try {
      $select = $this->database_connection->select("rsvplist_enabled', 're');
      $select->fields('re', ['nid']);
      $select->condition('nid', $node->id());
      $results = $select->execute();

      return !(empty( $results->fetchCol() ));

    }
    catch ( \Exception $e ) {
      \Drupal::messenger()->addError(
      $this->t('Unable to determine RSVP settings at this time.'));

      return NULL;
    }
  }
}
