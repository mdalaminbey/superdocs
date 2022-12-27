/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************!*\
  !*** ./resources/js/admin/template.js ***!
  \****************************************/
(function ($) {
  $('.page-title-action').on('click', function (e) {
    e.preventDefault();
    var drawer = Alpine.store('DoatKolomUiDrawer');
    drawer.setContentByApi(wpApiSettings.root + 'superdocs/template/create', {
      headers: {
        'X-WP-Nonce': wpApiSettings.nonce
      }
    }, 'superDocsCreateTemplate');
    drawer.changeStatus();
  });
})(jQuery);
/******/ })()
;