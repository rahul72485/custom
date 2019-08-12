<?php

namespace Drupal\custom\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * ExtendedSiteInformationForm Doc Comment.
 *
 * @category Class
 * @package MyPackage
 * @author A N Other
 */
class ExtendedSiteInformationForm extends SiteInformationForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $site_config = $this->config('system.site');
    $form = parent::buildForm($form, $form_state);
    $form['site_information']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => t('Site API Key'),
      '#default_value' => $site_config->get('siteapikey') ?: 'No API Key yet',
      '#description' => t("Custom field to set the API Key"),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('system.site')
      ->set('siteapikey', $form_state->getValue('siteapikey'))
      ->save();
    parent::submitForm($form, $form_state);
    $msg = $form_state->getValue('siteapikey');
    $message = drupal_get_messages('status', FALSE);
    drupal_get_messages('status');
    drupal_set_message('Site API Key has been saved with ' . $msg);
  }

}
