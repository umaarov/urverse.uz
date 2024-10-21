/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
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
/************************************************************************/
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/articles.js ***!
  \**********************************/
__webpack_require__.r(__webpack_exports__);
// resources\js\articles.js
document.addEventListener('DOMContentLoaded', function () {
  var urlParams = new URLSearchParams(window.location.search);
  var activeTag = urlParams.get('tag');
  if (activeTag) {
    var tagElements = document.querySelectorAll('.tag');
    tagElements.forEach(function (tag) {
      if (tag.textContent.toLowerCase() === "#".concat(activeTag.toLowerCase())) {
        tag.classList.add('active-tag');
      }
    });
  }
});
/******/ })()
;