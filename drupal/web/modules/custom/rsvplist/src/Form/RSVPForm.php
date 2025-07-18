<?php

/**
 * @file
 * A form to collect an email address for RSVP details.
 */

namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

class RSVPForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rsvpform_email_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $node = \Drupal::routeMatch()->getParameter('node');
//    \Drupal::messenger()->addMessage(t("form_id ---@id---", ['@id' => $form_id] ));
    \Drupal::messenger()->addMessage(t('RSVPForm->buildForm, a tu node:@node', ['@node' => $node->label()]));
    if ( !(is_null($node)) ) {
      $nid = $node->id();
    }
    else {
      $nid = 0;
    }

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email address #100'),
      '#size' => 25,
      '#description' => $this->t('We will send updates to the email address you
        provide.'),
      '#required' => TRUE,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('RSVP'),
    ];
    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $value = $form_state->getValue('email');
    if ( !(\Drupal::service('email.validator')->isValid($value))) {
      $form_state->setErrorByName('email',
        $this->t('It appears that the email address @email you entered is incorrect.
        Please try again.', ['@email' => $value]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
//    $submitted_email = $form_state->getValue('email');
//    $this->messenger()->addMessage($this->t("The form is working! You entered @entry.",
//      ['@entry' => $submitted_email]));
    try {
      //Phase 1:
      $uid = \Drupal::currentUser()->id();

      // Pobierz pełny obiekt użytkownika na podstawie jego ID
      $full_user = User::load(\Drupal::currentUser()->id());

      $nid = $form_state->getValue('nid');
      $email = $form_state->getValue('email');

      $current_time = \Drupal::time()->getRequestTime();

      //Phase 2:
      $query = \Drupal::database()->insert('rsvplist');
      $query->fields([
        'uid',
        'nid',
        'mail',
        'created',
      ]);

      $query->values([
        $uid,
        $nid,
        $email,
        $current_time,
      ]);

      $query->execute();

      //Phase 3:
      \Drupal::messenger()->addMessage(
        $this->t('Thank you for your RSVP, you are on the list for the event!'));
    }
    catch (\Exception $e) {
      \Drupal::messenger()->addError(
        $this->t('Unable to save RSVP settings at this time due to database error.
        Please try again.')
      );
    }
  }
}
