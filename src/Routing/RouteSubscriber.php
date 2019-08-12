<?php

namespace Drupal\custom\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $route = $collection->get('system.site_information_settings');
    if ($route) {
      $route->setDefault('_form', 'Drupal\custom\Form\ExtendedSiteInformationForm');
    }
  }

}
