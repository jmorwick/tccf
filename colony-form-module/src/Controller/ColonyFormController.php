<?php

namespace Drupal\colony_form\Controller;

class ColonyFormController {
    public function hello() {
        return array(
                '#title' => 'Hello World!',
                '#markup' => 'Here is some content.',
            );
    }
}
