/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/widgets.js":
/*!*********************************!*\
  !*** ./resources/js/widgets.js ***!
  \*********************************/
/***/ (() => {

(function ($, elementor) {
  var elementor = window.elementorFrontend;
  var SuperDocsUtils = {
    debounce: function debounce(func, delay) {
      var debounceTimer;
      return function () {
        var context = this;
        var args = arguments;
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(function () {
          return func.apply(context, args);
        }, delay);
      };
    }
  };
  var SuperDocs = {
    init: function init() {
      var widgets = {
        'superdocs-search.default': SuperDocs.Search,
        'superdocs-print.default': SuperDocs.docPrint,
        'superdocs-categories.default': SuperDocs.categories
      };
      $.each(widgets, function (widget, callback) {
        elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
      });
    },
    categories: function categories($scope) {
      $scope.find('.submenu-link').on('click', function () {
        var $submenu = $(this).closest('.submenu');
        var $docs = $submenu.find('.documents');
        var $un_collapse = $submenu.find('.un_collapse');
        var $collapse = $submenu.find('.collapse');
        if ($docs.is(":hidden")) {
          $un_collapse.show();
          $collapse.hide();
        } else {
          $un_collapse.hide();
          $collapse.show();
        }
        $docs.slideToggle(250);
      });
    },
    Search: function Search($scope) {
      var resultArea = $scope.find('.result-body');
      var search = function search(s) {
        var formData = $scope.find('form').serialize();
        $scope.find('.loader-body').show();
        $.ajax({
          url: wpCommanderLocale.rest + 'superdocs/search',
          method: 'POST',
          data: formData,
          complete: function complete(data) {
            $('body').addClass('superdocs-search-open');
            $scope.find('.loader-body').hide();
            resultArea.html(data.responseText);
            if (resultArea.is(":hidden")) {
              resultArea.slideToggle(250);
            }
          }
        });
      };
      var searchInput = $scope.find('input[name="s"]');
      searchInput.keyup(SuperDocsUtils.debounce(search, 500));
      $scope.find('.normal-search-form').submit(function (event) {
        event.preventDefault();
        search();
      });
      $(document).on('click', '.superdocs-search-open', function (e) {
        if ($(e.target).parents('.superdocs-search').length > 0) {
          return;
        }
        resultArea.slideToggle(250);
        $('body').removeClass('superdocs-search-open');
      });
    },
    docPrint: function docPrint($scope) {
      $scope.find('.superdocs-print').on('click', function () {
        var data = JSON.parse($scope.attr('data-settings'));
        if ('full_window' === data.doc_print_content_area) {
          window.print();
        } else {
          var html = document.querySelector("div[data-widget_type='superdocs-doc-content.default']").outerHTML;
          var stylesheets = document.querySelectorAll('link[rel="stylesheet"], style');
          var myWindow = window.open('', 'PRINT', 'popup');
          myWindow.document.write('<html><head><title>' + document.title + '</title>');
          stylesheets.forEach(function (stylesheet) {
            myWindow.document.write(stylesheet.outerHTML);
          });
          myWindow.document.write('</head><body >');
          myWindow.document.write('<h1>' + document.title + '</h1>');
          myWindow.document.write(html);
          var scripts = document.querySelectorAll('link[rel="stylesheet"], style');
          scripts.forEach(function (stylesheet) {
            myWindow.document.write(stylesheet.outerHTML);
          });
          myWindow.document.write('</body></html>');
          myWindow.document.close(); // necessary for IE >= 10
          myWindow.focus(); // necessary for IE >= 10*/

          myWindow.print();
          myWindow.close();
        }
      });
    }
  };
  $(window).on('elementor/frontend/init', SuperDocs.init);
  $(window).on('elementor/frontend/init', function () {
    var tableOfContent = $('.superdocs-table-of-content');
    var tags = JSON.parse(tableOfContent.attr('data-allowed_heading'));
    if (0 === tags.length) {
      tags = ['H1', 'H2', 'H3', 'H4', 'H5', 'H6'];
    }
    var orderList = tableOfContent.find('ol');
    orderList.html('');
    $('.elementor-heading-title').each(function () {
      var tag = $(this);
      if (tags.includes(tag.prop("tagName"))) {
        orderList.append('<li>' + tag.html() + '</li>');
      }
    });
  });
})(jQuery, window.elementorFrontend);

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/sass/widgets.scss":
/*!*************************************!*\
  !*** ./resources/sass/widgets.scss ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/widgets": 0,
/******/ 			"assets/css/widgets": 0,
/******/ 			"assets/css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunksuperdocs"] = self["webpackChunksuperdocs"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/css/widgets","assets/css/app"], () => (__webpack_require__("./resources/js/widgets.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/widgets","assets/css/app"], () => (__webpack_require__("./resources/sass/app.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/css/widgets","assets/css/app"], () => (__webpack_require__("./resources/sass/widgets.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;