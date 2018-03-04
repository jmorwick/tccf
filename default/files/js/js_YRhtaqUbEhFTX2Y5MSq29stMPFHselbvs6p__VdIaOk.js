/**
 * @file
 * JavaScript behaviors for composite element builder.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Initialize composite element builder.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.webformElementComposite = {
    attach: function (context) {
      $('[data-composite-types]').once('webform-composite-types').each(function() {
        var $element = $(this);
        var $type = $element.closest('tr').find('.js-webform-composite-type');

        var types = $element.attr('data-composite-types').split(',');
        var required = $element.attr('data-composite-required');

        $type.on('change', function() {
          if ($.inArray($(this).val(), types) === -1) {
            $element.hide();
            if (required) {
              $element.removeAttr('required aria-required');
            }
          }
          else {
            $element.show();
            if (required) {
              $element.attr({ 'required': 'required', 'aria-required': 'aria-required' })
            }
          }
        }).change();
      })
    }
  };

})(jQuery, Drupal);
;
/**
 * @file
 * JavaScript behaviors for message element integration.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Move show weight to after the table.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.webformMultiple = {
    attach: function (context, settings) {
      for (var base in settings.tableDrag) {
        if (settings.tableDrag.hasOwnProperty(base)) {
          var $tableDrag = $(context).find('#' + base);
          var $toggleWeight = $tableDrag.parent().find('.tabledrag-toggle-weight');
          $toggleWeight.addClass('webform-multiple-tabledrag-toggle-weight');
          $tableDrag.after($toggleWeight);
        }
      }
    }
  };

})(jQuery, Drupal);
;
