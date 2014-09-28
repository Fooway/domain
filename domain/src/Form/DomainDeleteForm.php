<?php

/**
 * @file
 * Contains \Drupal\domain\Form\DomainDeleteForm.
 */

namespace Drupal\domain\Form;

use Drupal\Core\Entity\EntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Builds the form to delete a domain record.
 */
class DomainDeleteForm extends EntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete %name?', array('%name' => $this->entity->label()));
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('domain.admin');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->entity->delete();
    drupal_set_message(t('Domain %label has been deleted.', array('%label' => $this->entity->label())));
    watchdog('domain', 'Domain %label has been deleted.', array('%label' => $this->entity->label()), WATCHDOG_NOTICE);
    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}