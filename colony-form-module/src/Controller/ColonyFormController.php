<?php

namespace Drupal\colony_form\Controller;

class ColonyFormController {
    public function getmapbase() {
      $apikey = 'AIzaSyDEidvy2vklHYOkaOrRNpiL0aGL3WVIoMM';
      return 
'<iframe
  width="600"
  height="450"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key='.$apikey.'
    &q=Space+Needle,Seattle+WA" allowfullscreen>hi
</iframe>';
    }

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
        '#title' => 'Colony Information',
        '#markup' => $this->getmapbase()
      );
    }
}
