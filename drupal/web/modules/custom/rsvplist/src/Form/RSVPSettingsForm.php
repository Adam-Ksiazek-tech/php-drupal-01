<?php

/**
 * @file
 * Contains the settings for administering the RSVP Form
 *
 * https://www.youtube.com/watch?v=_USUedcqRfk&list=PLpVC00PAQQxFNDfiXn6LH1gOLllGS3hhl&index=29
 *
 * https://www.drupal.org/docs/drupal-apis/configuration-api/working-with-configuration-forms *
 */

namespace Drupal\rsvplist\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class RSVPSettingsForm extends ConfigFormBase {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'rsvplist.settings';

    /**
     * Returns an array of available content types (node types).
     *
     * @return array
     *   An associative array of content type machine names => labels.
     */
    private function getContentTypeNames(): array {
        $types = \Drupal::entityTypeManager()
            ->getStorage('node_type')
            ->loadMultiple();

        $type_names = [];
        foreach ($types as $type) {
            $type_names[$type->id()] = $type->label();
        }

        return $type_names;
    }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rsvplist_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // $types = node_type_get_name();
    $type_names = $this->getContentTypeNames();

    $config = $this->config(static::SETTINGS);
    $form['rsvplist_types'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('The content types to enable RSVP collection for'),
      '#default_value' => $config->get('allowed_types'),
      '#options' => $type_names,
      '#description' => $this->t('On the specyfied node types, an RSVP option
        will be available and can be enabled while the node is being edited.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      $selected_allowed_types = array_filter($form_state->getValue(
          'rsvplist_types'));
      sort($selected_allowed_types);

      $this->config(static::SETTINGS)
        ->set('allowed_types', $selected_allowed_types)
        ->save();

      parent::submitForm($form, $form_state);
  }
}
