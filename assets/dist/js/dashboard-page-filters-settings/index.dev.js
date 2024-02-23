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

eval("\n(() => {\n    const app = Vue.createApp({\n        data: () => ({\n            filters: [],\n        }),\n        methods: {\n            addFilter() {\n                const filters = this.filters;\n                filters.push({\n                    label: null,\n                    itemsPerPage: 12,\n                    booking: {\n                        isTimeable: true,\n                        slots: [],\n                        fields: [\n                            this.createBookingFieldObject({\n                                label: 'Bookable Object (not visible to the user)',\n                                type: 'pt',\n                                isCustom: false,\n                                parent: null,\n                            })\n                        ],\n                    }\n                });\n                this.addBookingSlot(filters.length - 1);\n            },\n            deleteFilter(index) {\n                this.filters.splice(index, 1);\n            },\n            addBookingField(filterIndex) {\n                this.filters[filterIndex].booking.fields.push(this.createBookingFieldObject());\n            },\n            createBookingFieldObject(fieldData = {}) {\n                return Object.assign({ label: null, type: null, pt: null, isCustom: true, numeric: {\n                        isNumeric: true,\n                        default: 1,\n                        isEditable: false,\n                        min: 1,\n                        max: 100,\n                        step: 1,\n                        parent: 0,\n                        numericParentRelation: 'each',\n                    } }, fieldData);\n            },\n            deleteBookingField(fieldIndex, filterIndex) {\n                this.filters[filterIndex].booking.fields.splice(fieldIndex, 1);\n            },\n            addBookingSlot(filterIndex) {\n                const slots = this.filters[filterIndex].booking.slots;\n                slots.push({\n                    startTime: {\n                        h: 0,\n                        m: 0,\n                    },\n                    repeat: [],\n                    durationOptions: [],\n                });\n                this.addBookingSlotDurationOption(slots.length - 1, filterIndex);\n            },\n            deleteBookingSlot(slotIndex, filterIndex) {\n                this.filters[filterIndex].booking.slots.splice(slotIndex, 1);\n            },\n            addBookingSlotDurationOption(slotIndex, filterIndex) {\n                this.filters[filterIndex].booking.slots[slotIndex].durationOptions.push({\n                    label: '',\n                    time: {\n                        d: 0,\n                        h: 0,\n                        m: 0,\n                    },\n                });\n            },\n            deleteBookingSlotDurationOption(optionIndex, slotIndex, filterIndex) {\n                this.filters[filterIndex].booking.slots[slotIndex].durationOptions.splice(optionIndex, 1);\n            },\n            prefixInputId(baseId, filterIndex) {\n                return 'jbk-filter_' + filterIndex + '__' + baseId;\n            },\n            prefixBookingFieldInputId(baseId, fieldIndex, filterIndex) {\n                return this.prefixInputId('booking-custom-field_' + fieldIndex + '__' + baseId, filterIndex);\n            },\n            prefixBookingSlotInputId(baseId, slotIndex, filterIndex) {\n                return this.prefixInputId('booking-slot_' + slotIndex + '__' + baseId, filterIndex);\n            },\n            prefixBookingSlotDurationOptionInputId(baseId, durationOptionIndex, slotIndex, filterIndex) {\n                return this.prefixBookingSlotInputId('duration_' + durationOptionIndex + '__' + baseId, slotIndex, filterIndex);\n            },\n        }\n    });\n    app.mount('#jbk-filters');\n})();\n\n\n//# sourceURL=webpack:///./assets/src/js/dashboard-page-filters-settings/index.ts?");

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