<?php

namespace Drupal\colony_map\Controller;

class ColonyMapController {
    public function getmapbase() {
      $apikey = 'AIzaSyDEidvy2vklHYOkaOrRNpiL0aGL3WVIoMM';
      return '<div id="map"></div>';
    }

    public function colonies() {
      // webform with colony submissions
      $form_node_title = 'Members Only'; 
      

      // find node with webform
      $node = \Drupal::entityTypeManager()
                 ->getStorage('node')
                 ->loadByProperties(['title' => $form_node_title]);

      // find form submissions
#      $wf = Webform::load('cat_colony_form');
      $storage = \Drupal::entityTypeManager()->getStorage('webform_submission');
      $submissions = $storage->loadByProperties([
        'entity_type' => 'node',
        'entity_id' => array_keys($node)[0]
      ]);
      $locations = array();
      foreach ($submissions as $submission) {
        $data = $submission->getData();
        $data[id] = $submission->id();
        $locations[] = $data;
      }
      return array(
        '#theme' => 'colony_map',
	'#title' => 'Colony Map',
        '#locations' => $locations, 
      );
    }
}
