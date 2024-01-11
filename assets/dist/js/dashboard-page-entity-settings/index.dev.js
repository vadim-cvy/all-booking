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

/***/ "./assets/src/js/dashboard-page-entity-settings/index.ts":
/*!***************************************************************!*\
  !*** ./assets/src/js/dashboard-page-entity-settings/index.ts ***!
  \***************************************************************/
/***/ (() => {

eval("\n($ => {\n    $('#jbk-input_filter__has-filter')\n        .on('change', function () {\n        const input = $(this);\n        const hasFilter = input.is(':checked');\n        input.closest('tr').nextAll().each(function () {\n            const filterSettingRow = $(this);\n            hasFilter ? filterSettingRow.show() : filterSettingRow.hide();\n        });\n    })\n        .trigger('change');\n})(jQuery);\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard-page-entity-settings/index.ts?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/src/js/dashboard-page-entity-settings/index.ts"]();
/******/ 	
/******/ })()
;