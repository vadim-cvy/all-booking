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

/***/ "./assets/src/js/frontend/filter-shortcode/index.ts":
/*!**********************************************************!*\
  !*** ./assets/src/js/frontend/filter-shortcode/index.ts ***!
  \**********************************************************/
/***/ (() => {

eval("\n(() => {\n    const filterIdDataPropName = 'data-jab-filter-id';\n    document.querySelectorAll(`[${filterIdDataPropName}]`).forEach(element => {\n        const filterId = element.getAttribute(filterIdDataPropName);\n        const app = Vue.createApp({\n            data: () => ({\n                startTime: Date.now(),\n                // todo: endTime\n                results: [],\n                isLoadingResults: true,\n                controlValues: {},\n                bookingRequestData: {},\n            }),\n            computed: {\n                filterId() {\n                    return filterId;\n                },\n            },\n            methods: {\n                generateUniqueId() {\n                    return '' + Math.floor(Date.now() / 1000) + Math.floor(Math.random() * 100000);\n                },\n                async updateResults() {\n                    this.isLoadingResults = true;\n                    const requestData = new FormData();\n                    requestData.append('action', 'jab_filter_search');\n                    requestData.append('filter_id', String(jabFilterData.id));\n                    Object.entries(this.controlValues).forEach(val => requestData.append(val[0], String(val[1])));\n                    axios.post(jabFilterData.ajaxUrl, requestData)\n                        .then((resp) => {\n                        if (!resp.data.success) {\n                            // todo\n                            throw new Error(resp.data.data.errMsg);\n                        }\n                        this.results = resp.data.data.items;\n                    })\n                        // todo\n                        .catch(() => alert('Something goes wrong'))\n                        .finally(() => this.isLoadingResults = false);\n                },\n            },\n            watch: {\n                controlValues: {\n                    handler() {\n                        // todo: do with delay\n                        this.updateResults();\n                    },\n                    deep: true,\n                },\n            },\n            created() {\n                this.updateResults();\n            },\n        });\n        app.mount(element);\n    });\n})();\n\n\n//# sourceURL=webpack:///./assets/src/js/frontend/filter-shortcode/index.ts?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./assets/src/js/frontend/filter-shortcode/index.ts"]();
/******/ 	
/******/ })()
;