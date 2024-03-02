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

/***/ "./assets/src/js/dashboard/setting-pages/filters/components/JbkField.ts":
/*!******************************************************************************!*\
  !*** ./assets/src/js/dashboard/setting-pages/filters/components/JbkField.ts ***!
  \******************************************************************************/
/***/ ((__unused_webpack_module, exports) => {

eval("\nObject.defineProperty(exports, \"__esModule\", ({ value: true }));\nexports.JabField = void 0;\nexports.JabField = Vue.defineComponent({\n    props: {\n        class: {\n            type: String,\n            required: true,\n        },\n        label: {\n            type: String,\n            required: true,\n        },\n        isLabelClickable: {\n            type: Boolean,\n            required: false,\n            default: true,\n        },\n    },\n    computed: {\n        inputId() {\n            return this.class + '__input';\n        },\n        wrapperClass() {\n            return 'jab-field ' + this.class;\n        }\n    },\n    template: `<div :class=\"wrapperClass\">\r\n      <label class=\"jab-field__label\" :for=\"isLabelClickable ? inputId : ''\">\r\n        {{ label }}\r\n      </label>\r\n\r\n      <div class=\"jab-field__input-wrapper\">\r\n        <slot :input-id=\"isLabelClickable ? inputId : ''\"></slot>\r\n      </div>\r\n    </div>`,\n});\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard/setting-pages/filters/components/JbkField.ts?");

/***/ }),

/***/ "./assets/src/js/dashboard/setting-pages/filters/components/JbkItemsList.ts":
/*!**********************************************************************************!*\
  !*** ./assets/src/js/dashboard/setting-pages/filters/components/JbkItemsList.ts ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, exports) => {

eval("\nObject.defineProperty(exports, \"__esModule\", ({ value: true }));\nexports.JabItemsList = void 0;\nexports.JabItemsList = Vue.defineComponent({\n    props: {\n        items: {\n            type: Array,\n            required: true,\n        },\n        itemGeneralLabel: {\n            type: String,\n            required: true,\n        },\n        itemCssClass: {\n            type: String,\n            required: false,\n        },\n        newItemDataCb: {\n            type: Function,\n            required: true,\n        },\n    },\n    methods: {\n        deleteItem(itemIndex) {\n            const confirmMsg = `Are you sure you want to delete this ${this.itemGeneralLabel.toLocaleLowerCase()}?`;\n            if (confirm(confirmMsg)) {\n                this.items.splice(itemIndex, 1);\n            }\n        },\n    },\n    template: `<div class=\"jab-items-list\">\r\n      <div class=\"jab-items-list__items\" v-show=\"items.length !== 0\">\r\n        <div\r\n          :class=\"[\r\n            'jab-items-list__item',\r\n            itemCssClass,\r\n            itemCssClass + '_' + itemIndex\r\n          ]\"\r\n          v-for=\"(item, itemIndex) in items\"\r\n          :key=\"itemIndex\"\r\n        >\r\n          <div class=\"jab-items-list__item__content\">\r\n            <slot :item=\"item\" :itemIndex=\"itemIndex\"></slot>\r\n          </div>\r\n\r\n          <div class=\"jab-items-list__item__actions\">\r\n            <button\r\n              type=\"button\"\r\n              class=\"button jab-button_danger\"\r\n              @click=\"() => deleteItem( itemIndex )\"\r\n            >\r\n              Remove this {{ itemGeneralLabel }}\r\n            </button>\r\n\r\n            <slot name=\"item-actions\" :item=\"item\" :itemIndex=\"itemIndex\"></slot>\r\n          </div>\r\n        </div>\r\n      </div>\r\n\r\n      <div class=\"jab-items-list__actions\">\r\n        <button\r\n          @click=\"() => items.push(newItemDataCb())\"\r\n          type=\"button\"\r\n          class=\"button\"\r\n        >\r\n          Add {{ itemGeneralLabel }}\r\n        </button>\r\n      </div>\r\n    </div>`,\n});\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard/setting-pages/filters/components/JbkItemsList.ts?");

/***/ }),

/***/ "./assets/src/js/dashboard/setting-pages/filters/index.ts":
/*!****************************************************************!*\
  !*** ./assets/src/js/dashboard/setting-pages/filters/index.ts ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, exports, __webpack_require__) => {

eval("\nObject.defineProperty(exports, \"__esModule\", ({ value: true }));\nconst JbkField_1 = __webpack_require__(/*! ./components/JbkField */ \"./assets/src/js/dashboard/setting-pages/filters/components/JbkField.ts\");\nconst JbkItemsList_1 = __webpack_require__(/*! ./components/JbkItemsList */ \"./assets/src/js/dashboard/setting-pages/filters/components/JbkItemsList.ts\");\n(() => {\n    const app = Vue.createApp({\n        data: () => ({\n            filters: jabFiltersSettingsPage.filters,\n            pts: jabFiltersSettingsPage.pts,\n        }),\n    });\n    app.component('jab-items-list', JbkItemsList_1.JabItemsList);\n    app.component('jab-field', JbkField_1.JabField);\n    app.mount('#jab-filters');\n})();\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard/setting-pages/filters/index.ts?");

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
/******/ 	var __webpack_exports__ = __webpack_require__("./assets/src/js/dashboard/setting-pages/filters/index.ts");
/******/ 	
/******/ })()
;