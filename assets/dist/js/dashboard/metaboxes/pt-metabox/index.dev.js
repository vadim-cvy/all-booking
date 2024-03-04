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

/***/ "./assets/src/js/dashboard/components/JabField.ts":
/*!********************************************************!*\
  !*** ./assets/src/js/dashboard/components/JabField.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, exports) => {

eval("\nObject.defineProperty(exports, \"__esModule\", ({ value: true }));\nexports.JabField = void 0;\nexports.JabField = Vue.defineComponent({\n    props: {\n        class: {\n            type: String,\n            required: true,\n        },\n        label: {\n            type: String,\n            required: true,\n        },\n        isLabelClickable: {\n            type: Boolean,\n            required: false,\n            default: true,\n        },\n    },\n    computed: {\n        inputId() {\n            return this.class + '__input';\n        },\n        wrapperClass() {\n            return 'jab-field ' + this.class;\n        }\n    },\n    template: `<div :class=\"wrapperClass\">\r\n      <label class=\"jab-field__label\" :for=\"isLabelClickable ? inputId : ''\">\r\n        {{ label }}\r\n      </label>\r\n\r\n      <div class=\"jab-field__input-wrapper\">\r\n        <slot :input-id=\"isLabelClickable ? inputId : ''\"></slot>\r\n      </div>\r\n    </div>`,\n});\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard/components/JabField.ts?");

/***/ }),

/***/ "./assets/src/js/dashboard/metaboxes/pt-metabox/index.ts":
/*!***************************************************************!*\
  !*** ./assets/src/js/dashboard/metaboxes/pt-metabox/index.ts ***!
  \***************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

eval("\nObject.defineProperty(exports, \"__esModule\", ({ value: true }));\nconst JabField_1 = __webpack_require__(/*! ../../components/JabField */ \"./assets/src/js/dashboard/components/JabField.ts\");\n(() => {\n    const app = Vue.createApp({\n        data: () => ({\n            overrides: jabMetaboxData.overrides,\n            limit: jabMetaboxData.limit,\n        }),\n    });\n    app.component('jab-field', JabField_1.JabField);\n    app.mount('#jab');\n})();\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard/metaboxes/pt-metabox/index.ts?");

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
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/src/js/dashboard/metaboxes/pt-metabox/index.ts");
/******/ 	
/******/ })()
;