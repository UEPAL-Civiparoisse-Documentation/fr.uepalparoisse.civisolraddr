(function(angular, $, _) {
  "use strict";

  // Declare module
  angular.module('hvaddrdialog', CRM.angRequires('hvaddrdialog'));
  angular.module('hvaddrdialog').directive('hvaddrDialogPopup', function(dialogService) {
    return {
      restrict: 'A',
      controller: function($scope, $element) {
        var ctrl = this;
        $element.on('click', function() {
          var options = CRM.utils.adjustDialogDefaults({
            autoOpen: false,
            title: _.trim($element.attr('title') || $element.text())
          });
          var dialogTest=jQuery('body').dialog;
          if(typeof dialogTest == 'undefined')
          {
            jQuery.extend($);
          }
          dialogService.open('hvaddrdialog','~/hvaddrdialog/hvaddrdialog.html' ,{} , options)
            .then(function(success) {
              if(typeof success=='object' && 0 in success && 'fields' in success[0] )
              {
                $(($element)[0]).trigger('hvaddrdialog',success[0].fields);
              }
            });
        });
      }
    };
  });

})(angular, CRM.$, CRM._);

