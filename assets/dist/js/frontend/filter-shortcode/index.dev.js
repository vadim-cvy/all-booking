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

eval("\nconst parseDate = (strDate) => {\n    const date = new Date();\n    date.setFullYear(Number(strDate.substring(0, 4)));\n    date.setMonth(Number(strDate.substring(4, 6)) - 1);\n    date.setDate(Number(strDate.substring(6, 8)));\n    return date;\n};\nconst stringifyDate = (date) => {\n    const y = String(date.getFullYear());\n    let m = String(date.getMonth() + 1), d = String(date.getDate());\n    m = m.length === 1 ? '0' + m : m;\n    d = d.length === 1 ? '0' + d : d;\n    return y + m + d;\n};\n(() => {\n    const filterIdDataPropName = 'data-jab-filter-id';\n    document.querySelectorAll(`[${filterIdDataPropName}]`).forEach(element => {\n        const filterId = element.getAttribute(filterIdDataPropName);\n        const app = Vue.createApp({\n            data: () => {\n                const controlValues = {};\n                const GETParams = (new URLSearchParams(window.location.search));\n                GETParams.forEach((controlVal, controlKey) => {\n                    switch (controlKey) {\n                        case 'start_date':\n                        case 'end_date':\n                            controlValues[controlKey] = parseDate(controlVal);\n                            break;\n                        default:\n                            controlValues[controlKey] = controlVal;\n                            break;\n                    }\n                });\n                controlValues.start_date = controlValues.start_date || new Date();\n                controlValues.end_date = controlValues.end_date || parseDate(jabFilterData.maxEndDate);\n                return {\n                    controlValues,\n                    results: [],\n                    isLoadingResults: true,\n                    bookingRequestData: {},\n                };\n            },\n            computed: {\n                filterId() {\n                    return filterId;\n                },\n            },\n            methods: {\n                generateUniqueId() {\n                    return '' + Math.floor(Date.now() / 1000) + Math.floor(Math.random() * 100000);\n                },\n                async updateResults() {\n                    this.isLoadingResults = true;\n                    const requestData = new FormData();\n                    requestData.append('action', 'jab_filter_search');\n                    requestData.append('filter_id', String(jabFilterData.id));\n                    Object.entries(this.controlValues).forEach(([controlKey, controlVal]) => {\n                        switch (controlKey) {\n                            case 'start_date':\n                            case 'end_date':\n                                requestData.append(controlKey, stringifyDate(controlVal));\n                                break;\n                            default:\n                                requestData.append(controlKey, String(controlVal));\n                                break;\n                        }\n                    });\n                    axios.post(jabFilterData.ajaxUrl, requestData)\n                        .then((resp) => {\n                        if (!resp.data.success) {\n                            // todo\n                            throw new Error(resp.data.data.errMsg);\n                        }\n                        this.results = resp.data.data.items;\n                    })\n                        // todo: uncomment\n                        // .catch(() => alert( 'Something goes wrong' ) )\n                        .finally(() => this.isLoadingResults = false);\n                },\n                printDate(date) {\n                    return date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();\n                },\n            },\n            watch: {\n                controlValues: {\n                    handler(controlValues) {\n                        const GETParams = new URLSearchParams(window.location.search);\n                        Object.entries(controlValues).forEach(control => {\n                            const [key, val] = control;\n                            if (val instanceof Date) {\n                                GETParams.set(key, stringifyDate(val));\n                            }\n                            else {\n                                GETParams.set(key, String(val));\n                            }\n                        });\n                        history.pushState(null, '', '?' + GETParams.toString());\n                        // todo: do with delay\n                        this.updateResults();\n                    },\n                    deep: true,\n                },\n            },\n            created() {\n                this.updateResults();\n            },\n        });\n        app.mount(element);\n    });\n})();\n\n\n//# sourceURL=webpack:///./assets/src/js/frontend/filter-shortcode/index.ts?");

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