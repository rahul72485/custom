<?php

namespace Drupal\custom\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Response;

/**
 * An example controller.
 */
class PagejsonController extends ControllerBase {

  /**
   * Returns a render-able array for a test page.
   */
  public function pagejson($siteapikey, $nid) {
    $node = Node::load($nid);

    $title = $node->get('title')->value;
    $body = $node->get('body')->value;

    $data = [
      'nid' => $nid,
      'title' => $title,
      'content' => $body,
    ];

    $response = new Response();
    $response->setContent(json_encode($data));
    $response->headers->set('Content-Type', 'application/json');
    return $response;
  }

  /**
   * Checks access for this controller.
   */
  public function pagejsonaccess($siteapikey, $nid) {
    $node = Node::load($nid);
    $type = $node->getType();

    $getsiteapikey = \Drupal::config('system.site')->get('siteapikey');

    if ($type == 'page' && $siteapikey == $getsiteapikey) {
      return AccessResult::allowed();

    }
    else {
      return AccessResult::forbidden();
    }

  }

}
