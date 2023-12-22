<?php

namespace Drupal\event_details\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides an Event Details block.
 *
 * @Block(
 *   id = "event_details_block",
 *   admin_label = @Translation("Event Details Block"),
 *   category = @Translation("Event Details")
 * )
 */
class EventDetailsBlock extends BlockBase {

  /* Create the field which exist on the 'block edit' screen */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    $form['event_date'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Event Date'),
      '#default_value' => isset($config['event_date']) ? $config['event_date'] : '',
    ];

    $form['event_venue'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Event Venue'),
      '#default_value' => isset($config['event_venue']) ? $config['event_venue'] : '',
    ];

    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->setConfigurationValue('event_date', $form_state->getValue('event_date'));
    $this->setConfigurationValue('event_venue', $form_state->getValue('event_venue'));
  }


  /* Create a build function which references the .libraries.yml file */
  public function build() {
    $config = $this->getConfiguration();

    return [
      '#theme' => 'event_details_block',
      '#event_date' => $config['event_date'],
      '#event_venue' => $config['event_venue'],
      '#attached' => [
        'library' => [
          'event_details/event-details'
        ],
      ],
    ];
  }
}