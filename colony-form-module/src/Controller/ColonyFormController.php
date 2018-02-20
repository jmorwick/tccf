<?php

namespace Drupal\colony_form\Controller;

class ColonyFormController {
    public function colonies() {
      // webform with colony submissions
      $form_node_title = 'Members Only'; 

      // find node with webform
      $node = \Drupal::entityTypeManager()
                 ->getStorage('node')
                 ->loadByProperties(['title' => $form_node_title]);

      // find form submissions
      $storage = \Drupal::entityTypeManager()->getStorage('webform_submission');
      $submissions = $storage->loadByProperties([
        'entity_type' => 'node',
        'entity_id' => array_keys($node)[0]
      ]);
      $map_data = array();
      foreach ($submissions as $submission) {
        $map_data[] = $submission->getData();
      }
      return array(
        '#title' => 'Hello World!',
        '#markup' => print_r($map_data,true)
      );
    }
}
