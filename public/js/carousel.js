/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/carousel.js":
/*!**********************************!*\
  !*** ./resources/js/carousel.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== \"undefined\" && o[Symbol.iterator] || o[\"@@iterator\"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === \"number\") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError(\"Invalid attempt to iterate non-iterable instance.\\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.\"); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it[\"return\"] != null) it[\"return\"](); } finally { if (didErr) throw err; } } }; }\n\nfunction _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === \"string\") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === \"Object\" && o.constructor) n = o.constructor.name; if (n === \"Map\" || n === \"Set\") return Array.from(o); if (n === \"Arguments\" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }\n\nfunction _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }\n\nfunction init() {\n  console.log('hello');\n  var span = document.getElementsByClassName('carousel-span');\n  var div = document.getElementsByClassName('categories');\n  var l = 0;\n\n  span[1].onclick = function () {\n    l++;\n\n    var _iterator = _createForOfIteratorHelper(div),\n        _step;\n\n    try {\n      for (_iterator.s(); !(_step = _iterator.n()).done;) {\n        var i = _step.value;\n\n        var _iterator2 = _createForOfIteratorHelper(div),\n            _step2;\n\n        try {\n          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {\n            var i = _step2.value;\n\n            if (l == 0) {\n              i.style.left = \"0px\";\n            }\n\n            if (l == 1) {\n              i.style.left = \"-740px\";\n            }\n\n            if (l == 2) {\n              i.style.left = \"-1480px\";\n            }\n\n            if (l == 3) {\n              i.style.left = \"-2220px\";\n            }\n\n            if (l == 4) {\n              i.style.left = \"-2960px\";\n            }\n\n            if (l > 4) {\n              l = 4;\n            }\n          }\n        } catch (err) {\n          _iterator2.e(err);\n        } finally {\n          _iterator2.f();\n        }\n      }\n    } catch (err) {\n      _iterator.e(err);\n    } finally {\n      _iterator.f();\n    }\n  };\n\n  span[0].onclick = function () {\n    l--;\n\n    var _iterator3 = _createForOfIteratorHelper(div),\n        _step3;\n\n    try {\n      for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {\n        var i = _step3.value;\n\n        var _iterator4 = _createForOfIteratorHelper(div),\n            _step4;\n\n        try {\n          for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {\n            var i = _step4.value;\n\n            if (l == 0) {\n              i.style.left = \"0px\";\n            }\n\n            if (l == 1) {\n              i.style.left = \"-740px\";\n            }\n\n            if (l == 2) {\n              i.style.left = \"-1480px\";\n            }\n\n            if (l == 3) {\n              i.style.left = \"-2220px\";\n            }\n\n            if (l == 4) {\n              i.style.left = \"-2960px\";\n            }\n\n            if (l < 0) {\n              l = 0;\n            }\n          }\n        } catch (err) {\n          _iterator4.e(err);\n        } finally {\n          _iterator4.f();\n        }\n      }\n    } catch (err) {\n      _iterator3.e(err);\n    } finally {\n      _iterator3.f();\n    }\n  };\n}\n\ndocument.addEventListener('DOMContentLoaded', init);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY2Fyb3VzZWwuanM/NmRkYiJdLCJuYW1lcyI6WyJpbml0IiwiY29uc29sZSIsImxvZyIsInNwYW4iLCJkb2N1bWVudCIsImdldEVsZW1lbnRzQnlDbGFzc05hbWUiLCJkaXYiLCJsIiwib25jbGljayIsImkiLCJzdHlsZSIsImxlZnQiLCJhZGRFdmVudExpc3RlbmVyIl0sIm1hcHBpbmdzIjoiOzs7Ozs7QUFBQSxTQUFTQSxJQUFULEdBQWdCO0FBRVpDLFNBQU8sQ0FBQ0MsR0FBUixDQUFZLE9BQVo7QUFFQSxNQUFJQyxJQUFJLEdBQUdDLFFBQVEsQ0FBQ0Msc0JBQVQsQ0FBZ0MsZUFBaEMsQ0FBWDtBQUNBLE1BQUlDLEdBQUcsR0FBR0YsUUFBUSxDQUFDQyxzQkFBVCxDQUFnQyxZQUFoQyxDQUFWO0FBQ0EsTUFBSUUsQ0FBQyxHQUFHLENBQVI7O0FBQ0FKLE1BQUksQ0FBQyxDQUFELENBQUosQ0FBUUssT0FBUixHQUFrQixZQUFNO0FBR3BCRCxLQUFDOztBQUhtQiwrQ0FLTkQsR0FMTTtBQUFBOztBQUFBO0FBS3BCLDBEQUFtQjtBQUFBLFlBQVZHLENBQVU7O0FBQUEsb0RBRURILEdBRkM7QUFBQTs7QUFBQTtBQUVmLGlFQUFtQjtBQUFBLGdCQUFWRyxDQUFVOztBQUVmLGdCQUFJRixDQUFDLElBQUksQ0FBVCxFQUFZO0FBQUVFLGVBQUMsQ0FBQ0MsS0FBRixDQUFRQyxJQUFSLEdBQWUsS0FBZjtBQUF1Qjs7QUFDckMsZ0JBQUlKLENBQUMsSUFBSSxDQUFULEVBQVk7QUFBRUUsZUFBQyxDQUFDQyxLQUFGLENBQVFDLElBQVIsR0FBZSxRQUFmO0FBQTBCOztBQUN4QyxnQkFBSUosQ0FBQyxJQUFJLENBQVQsRUFBWTtBQUFFRSxlQUFDLENBQUNDLEtBQUYsQ0FBUUMsSUFBUixHQUFlLFNBQWY7QUFBMkI7O0FBQ3pDLGdCQUFJSixDQUFDLElBQUksQ0FBVCxFQUFZO0FBQUVFLGVBQUMsQ0FBQ0MsS0FBRixDQUFRQyxJQUFSLEdBQWUsU0FBZjtBQUEyQjs7QUFDekMsZ0JBQUlKLENBQUMsSUFBSSxDQUFULEVBQVk7QUFBRUUsZUFBQyxDQUFDQyxLQUFGLENBQVFDLElBQVIsR0FBZSxTQUFmO0FBQTJCOztBQUN6QyxnQkFBSUosQ0FBQyxHQUFHLENBQVIsRUFBVztBQUFFQSxlQUFDLEdBQUcsQ0FBSjtBQUFRO0FBRXhCO0FBWGM7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQVlsQjtBQWpCbUI7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQWtCdkIsR0FsQkQ7O0FBbUJBSixNQUFJLENBQUMsQ0FBRCxDQUFKLENBQVFLLE9BQVIsR0FBa0IsWUFBTTtBQUdwQkQsS0FBQzs7QUFIbUIsZ0RBS05ELEdBTE07QUFBQTs7QUFBQTtBQUtwQiw2REFBbUI7QUFBQSxZQUFWRyxDQUFVOztBQUFBLG9EQUVESCxHQUZDO0FBQUE7O0FBQUE7QUFFZixpRUFBbUI7QUFBQSxnQkFBVkcsQ0FBVTs7QUFFZixnQkFBSUYsQ0FBQyxJQUFJLENBQVQsRUFBWTtBQUFFRSxlQUFDLENBQUNDLEtBQUYsQ0FBUUMsSUFBUixHQUFlLEtBQWY7QUFBdUI7O0FBQ3JDLGdCQUFJSixDQUFDLElBQUksQ0FBVCxFQUFZO0FBQUVFLGVBQUMsQ0FBQ0MsS0FBRixDQUFRQyxJQUFSLEdBQWUsUUFBZjtBQUEwQjs7QUFDeEMsZ0JBQUlKLENBQUMsSUFBSSxDQUFULEVBQVk7QUFBRUUsZUFBQyxDQUFDQyxLQUFGLENBQVFDLElBQVIsR0FBZSxTQUFmO0FBQTJCOztBQUN6QyxnQkFBSUosQ0FBQyxJQUFJLENBQVQsRUFBWTtBQUFFRSxlQUFDLENBQUNDLEtBQUYsQ0FBUUMsSUFBUixHQUFlLFNBQWY7QUFBMkI7O0FBQ3pDLGdCQUFJSixDQUFDLElBQUksQ0FBVCxFQUFZO0FBQUVFLGVBQUMsQ0FBQ0MsS0FBRixDQUFRQyxJQUFSLEdBQWUsU0FBZjtBQUEyQjs7QUFDekMsZ0JBQUlKLENBQUMsR0FBRyxDQUFSLEVBQVc7QUFBRUEsZUFBQyxHQUFHLENBQUo7QUFBUTtBQUV4QjtBQVhjO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFZbEI7QUFqQm1CO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFrQnZCLEdBbEJEO0FBbUJIOztBQUVESCxRQUFRLENBQUNRLGdCQUFULENBQTBCLGtCQUExQixFQUE4Q1osSUFBOUMiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY2Fyb3VzZWwuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyJmdW5jdGlvbiBpbml0KCkge1xuXG4gICAgY29uc29sZS5sb2coJ2hlbGxvJyk7XG5cbiAgICB2YXIgc3BhbiA9IGRvY3VtZW50LmdldEVsZW1lbnRzQnlDbGFzc05hbWUoJ2Nhcm91c2VsLXNwYW4nKTtcbiAgICB2YXIgZGl2ID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeUNsYXNzTmFtZSgnY2F0ZWdvcmllcycpO1xuICAgIHZhciBsID0gMDtcbiAgICBzcGFuWzFdLm9uY2xpY2sgPSAoKSA9PiB7XG5cblxuICAgICAgICBsKys7XG5cbiAgICAgICAgZm9yICh2YXIgaSBvZiBkaXYpIHtcblxuICAgICAgICAgICAgZm9yICh2YXIgaSBvZiBkaXYpIHtcblxuICAgICAgICAgICAgICAgIGlmIChsID09IDApIHsgaS5zdHlsZS5sZWZ0ID0gXCIwcHhcIjsgfVxuICAgICAgICAgICAgICAgIGlmIChsID09IDEpIHsgaS5zdHlsZS5sZWZ0ID0gXCItNzQwcHhcIjsgfVxuICAgICAgICAgICAgICAgIGlmIChsID09IDIpIHsgaS5zdHlsZS5sZWZ0ID0gXCItMTQ4MHB4XCI7IH1cbiAgICAgICAgICAgICAgICBpZiAobCA9PSAzKSB7IGkuc3R5bGUubGVmdCA9IFwiLTIyMjBweFwiOyB9XG4gICAgICAgICAgICAgICAgaWYgKGwgPT0gNCkgeyBpLnN0eWxlLmxlZnQgPSBcIi0yOTYwcHhcIjsgfVxuICAgICAgICAgICAgICAgIGlmIChsID4gNCkgeyBsID0gNDsgfVxuXG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9XG4gICAgc3BhblswXS5vbmNsaWNrID0gKCkgPT4ge1xuXG5cbiAgICAgICAgbC0tO1xuXG4gICAgICAgIGZvciAodmFyIGkgb2YgZGl2KSB7XG5cbiAgICAgICAgICAgIGZvciAodmFyIGkgb2YgZGl2KSB7XG5cbiAgICAgICAgICAgICAgICBpZiAobCA9PSAwKSB7IGkuc3R5bGUubGVmdCA9IFwiMHB4XCI7IH1cbiAgICAgICAgICAgICAgICBpZiAobCA9PSAxKSB7IGkuc3R5bGUubGVmdCA9IFwiLTc0MHB4XCI7IH1cbiAgICAgICAgICAgICAgICBpZiAobCA9PSAyKSB7IGkuc3R5bGUubGVmdCA9IFwiLTE0ODBweFwiOyB9XG4gICAgICAgICAgICAgICAgaWYgKGwgPT0gMykgeyBpLnN0eWxlLmxlZnQgPSBcIi0yMjIwcHhcIjsgfVxuICAgICAgICAgICAgICAgIGlmIChsID09IDQpIHsgaS5zdHlsZS5sZWZ0ID0gXCItMjk2MHB4XCI7IH1cbiAgICAgICAgICAgICAgICBpZiAobCA8IDApIHsgbCA9IDA7IH1cblxuICAgICAgICAgICAgfVxuICAgICAgICB9XG4gICAgfVxufVxuXG5kb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgaW5pdCk7XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/carousel.js\n");

/***/ }),

/***/ 2:
/*!****************************************!*\
  !*** multi ./resources/js/carousel.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/marco/Desktop/Boolean/final-project/deliveboo/resources/js/carousel.js */"./resources/js/carousel.js");


/***/ })

/******/ });