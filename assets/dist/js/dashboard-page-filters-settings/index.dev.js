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

/***/ "./assets/src/js/dashboard-page-filters-settings/index.ts":
/*!****************************************************************!*\
  !*** ./assets/src/js/dashboard-page-filters-settings/index.ts ***!
  \****************************************************************/
/***/ (() => {

eval("\n(() => {\n    const app = Vue.createApp({\n        data: () => ({\n            filters: [\n                {\n                    label: 'Dummy Filter',\n                    itemsPerPage: 12,\n                    hasTimeSlots: false,\n                    popupFields: [\n                        {\n                            label: 'Dummy Field',\n                            type: 'pt',\n                            pt: 'dummy_pt_slug',\n                        }\n                    ],\n                }\n            ],\n        }),\n        methods: {\n            addFilter() {\n                this.filters.push({\n                    label: null,\n                    itemsPerPage: null,\n                    hasTimeSlots: false,\n                    popupFields: [],\n                });\n            },\n            deleteFilter(index) {\n                this.filters.splice(index, 1);\n            },\n            addPopupField(filterIndex) {\n                const filter = this.filters[filterIndex];\n                filter.popupFields.push({\n                    label: null,\n                    type: null,\n                    pt: null,\n                });\n                filter.activePopupFieldIndex = filter.popupFields.length - 1;\n            },\n            deletePopupField(fieldIndex, filterIndex) {\n                this.filters[filterIndex].popupFields.splice(fieldIndex, 1);\n            },\n            prefixInputId(baseId, filterIndex, fieldIndex) {\n                let prefix = 'jbk-filters-setting__filter_' + filterIndex + '__';\n                if (typeof fieldIndex !== undefined) {\n                    prefix += 'popup-field_' + fieldIndex + '__';\n                }\n                return prefix + baseId;\n            },\n        }\n    });\n    app.mount('#jbk-filters-setting');\n})();\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard-page-filters-settings/index.ts?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/src/js/dashboard-page-filters-settings/index.ts"]();
/******/ 	
/******/ })()
;