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

eval("\n(() => {\n    const filterIdDataPropName = 'data-jab-filter-id';\n    document.querySelectorAll(`[${filterIdDataPropName}]`).forEach(element => {\n        const filterId = element.getAttribute(filterIdDataPropName);\n        const app = Vue.createApp({\n            data: () => ({\n                startTime: Date.now(),\n                // todo: endTime\n                results: [],\n                isLoadingResults: true,\n                areAdvancedControlsVisible: false,\n            }),\n            computed: {\n                filterId() {\n                    return filterId;\n                },\n            },\n            methods: {\n                generateUniqueId() {\n                    return '' + Math.floor(Date.now() / 1000) + Math.floor(Math.random() * 100000);\n                },\n                async updateResults() {\n                    this.isLoadingResults = true;\n                    // todo\n                    this.results = [\n                        {\n                            id: 1,\n                            title: 'Result 1',\n                            excerpt: 'Excerpt 1',\n                            img: {\n                                src: 'https://via.placeholder.com/150',\n                                alt: 'Placeholder',\n                            },\n                            status: {\n                                slug: 'available',\n                                label: 'Available',\n                            },\n                        },\n                        {\n                            id: 2,\n                            title: 'Result 2',\n                            excerpt: 'Excerpt 2',\n                            img: {\n                                src: 'https://via.placeholder.com/150',\n                                alt: 'Placeholder',\n                            },\n                            status: {\n                                slug: 'unavailable',\n                                label: 'Unavailable',\n                            },\n                        },\n                        {\n                            id: 3,\n                            title: 'Result 3',\n                            excerpt: 'Excerpt 3',\n                            img: {\n                                src: 'https://via.placeholder.com/150',\n                                alt: 'Placeholder',\n                            },\n                            status: {\n                                slug: 'unavailable',\n                                label: 'Unavailable',\n                            },\n                        },\n                        {\n                            id: 4,\n                            title: 'Result 4',\n                            excerpt: 'Excerpt 4',\n                            img: {\n                                src: 'https://via.placeholder.com/150',\n                                alt: 'Placeholder',\n                            },\n                            status: {\n                                slug: 'unavailable',\n                                label: 'Unavailable',\n                            },\n                        },\n                    ];\n                    this.isLoadingResults = false;\n                },\n            },\n            created() {\n                this.updateResults();\n            },\n        });\n        app.mount(element);\n    });\n})();\n\n\n//# sourceURL=webpack:///./assets/src/js/frontend/filter-shortcode/index.ts?");

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