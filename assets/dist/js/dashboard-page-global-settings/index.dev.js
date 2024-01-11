/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/js/dashboard-page-global-settings/index.ts":
/*!***************************************************************!*\
  !*** ./assets/src/js/dashboard-page-global-settings/index.ts ***!
  \***************************************************************/
/***/ (() => {

eval("\n($ => {\n    const bookablePtInputs = $('.jbk-field_bookable-entities input[type=\"checkbox\"]');\n    const entityConnectionsFildWrapper = $('.jbk-field_entity-connections');\n    bookablePtInputs.on('change', function () {\n        const entityConnectionsFieldRow = entityConnectionsFildWrapper.closest('tr');\n        const bookablePtCheckedInputs = bookablePtInputs.filter(':checked');\n        bookablePtCheckedInputs.length >= 2 ? entityConnectionsFieldRow.show() : entityConnectionsFieldRow.hide();\n        entityConnectionsFildWrapper.find('.jbk-connection').each(function () {\n            const div = $(this);\n            div.show();\n            for (const ptSlug of div.data('pts')) {\n                if (!bookablePtCheckedInputs.filter(`[value=\"${ptSlug}\"]`).length) {\n                    div.hide();\n                }\n            }\n        });\n    });\n    bookablePtInputs.trigger('change');\n})(jQuery);\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard-page-global-settings/index.ts?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/src/js/dashboard-page-global-settings/index.ts"]();
/******/ 	
/******/ })()
;