/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/routes.js":
/*!********************************!*\
  !*** ./resources/js/routes.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   \"route\": () => (/* binding */ route)\n/* harmony export */ });\n/* provided dependency */ var process = __webpack_require__(/*! process/browser */ \"./node_modules/process/browser.js\");\nvar routes = {\n  \"generated::BHTyyk3BRW3DNqu7\": {\n    \"uri\": \"api\\/user\"\n  },\n  \"Posts.index\": {\n    \"uri\": \"api\\/Posts\"\n  },\n  \"Posts.create\": {\n    \"uri\": \"api\\/Posts\\/create\"\n  },\n  \"Posts.store\": {\n    \"uri\": \"api\\/Posts\"\n  },\n  \"Posts.show\": {\n    \"uri\": \"api\\/Posts\\/{Post}\"\n  },\n  \"Posts.edit\": {\n    \"uri\": \"api\\/Posts\\/{Post}\\/edit\"\n  },\n  \"Posts.update\": {\n    \"uri\": \"api\\/Posts\\/{Post}\"\n  },\n  \"Posts.destroy\": {\n    \"uri\": \"api\\/Posts\\/{Post}\"\n  },\n  \"users.index\": {\n    \"uri\": \"api\\/users\"\n  },\n  \"users.create\": {\n    \"uri\": \"api\\/users\\/create\"\n  },\n  \"users.store\": {\n    \"uri\": \"api\\/users\"\n  },\n  \"users.show\": {\n    \"uri\": \"api\\/users\\/{user}\"\n  },\n  \"users.edit\": {\n    \"uri\": \"api\\/users\\/{user}\\/edit\"\n  },\n  \"users.update\": {\n    \"uri\": \"api\\/users\\/{user}\"\n  },\n  \"users.destroy\": {\n    \"uri\": \"api\\/users\\/{user}\"\n  },\n  \"roles.index\": {\n    \"uri\": \"api\\/roles\"\n  },\n  \"roles.create\": {\n    \"uri\": \"api\\/roles\\/create\"\n  },\n  \"roles.store\": {\n    \"uri\": \"api\\/roles\"\n  },\n  \"roles.show\": {\n    \"uri\": \"api\\/roles\\/{role}\"\n  },\n  \"roles.edit\": {\n    \"uri\": \"api\\/roles\\/{role}\\/edit\"\n  },\n  \"roles.update\": {\n    \"uri\": \"api\\/roles\\/{role}\"\n  },\n  \"roles.destroy\": {\n    \"uri\": \"api\\/roles\\/{role}\"\n  },\n  \"options\": {\n    \"uri\": \"api\\/options\"\n  },\n  \"generated::nW2qTLnQTkLcAmnh\": {\n    \"uri\": \"\\/\"\n  },\n  \"generated::YkPHZhYjBc25oAIq\": {\n    \"uri\": \"mucks\"\n  },\n  \"adminPage\": {\n    \"uri\": \"admin\"\n  },\n  \"login\": {\n    \"uri\": \"login\"\n  },\n  \"generated::nvRKnHcipii9xHJD\": {\n    \"uri\": \"login\"\n  },\n  \"logout\": {\n    \"uri\": \"logout\"\n  },\n  \"register\": {\n    \"uri\": \"register\"\n  },\n  \"generated::TywFaVLwgMDT7Lcj\": {\n    \"uri\": \"register\"\n  },\n  \"password.request\": {\n    \"uri\": \"password\\/reset\"\n  },\n  \"password.email\": {\n    \"uri\": \"password\\/email\"\n  },\n  \"password.reset\": {\n    \"uri\": \"password\\/reset\\/{token}\"\n  },\n  \"password.update\": {\n    \"uri\": \"password\\/reset\"\n  },\n  \"password.confirm\": {\n    \"uri\": \"password\\/confirm\"\n  },\n  \"generated::izztR1RYldOFIr4B\": {\n    \"uri\": \"password\\/confirm\"\n  },\n  \"home\": {\n    \"uri\": \"home\"\n  },\n  \"getApiKey\": {\n    \"uri\": \"getApiKey\"\n  }\n};\n\nvar route = function route(routeName) {\n  var params = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : [];\n  var absolute = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;\n  var _route = routes[routeName];\n  if (_route == null) throw \"Requested route doesn't exist\";\n  var uri = _route.uri;\n  var matches = uri.match(/{[\\w]+\\??}/g) || [];\n  var optionals = uri.match(/{[\\w]+\\?}/g) || [];\n  var requiredParametersCount = matches.length - optionals.length;\n\n  if (params instanceof Array) {\n    if (params.length < requiredParametersCount) throw \"Missing parameters\";\n\n    for (var i = 0; i < requiredParametersCount; i++) {\n      uri = uri.replace(/{[\\w]+\\??}/, params.shift());\n    }\n\n    for (var _i = 0; _i < params.length; _i++) {\n      uri += (_i ? \"&\" : \"?\") + params[_i] + \"=\" + params[_i];\n    }\n  } else if (params instanceof Object) {\n    var extraParams = matches.reduce(function (ac, match) {\n      var key = match.substring(1, match.length - 1);\n      var isOptional = key.endsWith(\"?\");\n\n      if (params.hasOwnProperty(key.replace(\"?\", \"\"))) {\n        uri = uri.replace(new RegExp(match.replace(\"?\", \"\\\\?\"), \"g\"), params[key.replace(\"?\", \"\")]);\n        delete ac[key.replace(\"?\", \"\")];\n      } else if (isOptional) {\n        uri = uri.replace(\"/\" + new RegExp(match, \"g\"), \"\");\n      }\n\n      return ac;\n    }, params);\n    Object.keys(extraParams).forEach(function (key, i) {\n      uri += (i ? \"&\" : \"?\") + key + \"=\" + extraParams[key];\n    });\n  }\n\n  if (optionals.length > 0) {\n    for (var _i2 in optionals) {\n      uri = uri.replace(\"/\" + optionals[_i2], \"\");\n    }\n  }\n\n  if (uri.includes(\"}\")) throw \"Missing parameters\";\n  if (absolute && process.env.MIX_APP_URL) return process.env.MIX_APP_URL + \"/\" + uri;\n  return \"/\" + uri;\n};\n\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvcm91dGVzLmpzPzA3NzgiXSwibmFtZXMiOlsicm91dGVzIiwicm91dGUiLCJyb3V0ZU5hbWUiLCJwYXJhbXMiLCJhYnNvbHV0ZSIsIl9yb3V0ZSIsInVyaSIsIm1hdGNoZXMiLCJtYXRjaCIsIm9wdGlvbmFscyIsInJlcXVpcmVkUGFyYW1ldGVyc0NvdW50IiwibGVuZ3RoIiwiQXJyYXkiLCJpIiwicmVwbGFjZSIsInNoaWZ0IiwiT2JqZWN0IiwiZXh0cmFQYXJhbXMiLCJyZWR1Y2UiLCJhYyIsImtleSIsInN1YnN0cmluZyIsImlzT3B0aW9uYWwiLCJlbmRzV2l0aCIsImhhc093blByb3BlcnR5IiwiUmVnRXhwIiwia2V5cyIsImZvckVhY2giLCJpbmNsdWRlcyIsInByb2Nlc3MiLCJlbnYiLCJNSVhfQVBQX1VSTCJdLCJtYXBwaW5ncyI6Ijs7Ozs7QUFBQSxJQUFNQSxNQUFNLEdBQUc7QUFDWCxpQ0FBK0I7QUFDM0IsV0FBTztBQURvQixHQURwQjtBQUlYLGlCQUFlO0FBQ1gsV0FBTztBQURJLEdBSko7QUFPWCxrQkFBZ0I7QUFDWixXQUFPO0FBREssR0FQTDtBQVVYLGlCQUFlO0FBQ1gsV0FBTztBQURJLEdBVko7QUFhWCxnQkFBYztBQUNWLFdBQU87QUFERyxHQWJIO0FBZ0JYLGdCQUFjO0FBQ1YsV0FBTztBQURHLEdBaEJIO0FBbUJYLGtCQUFnQjtBQUNaLFdBQU87QUFESyxHQW5CTDtBQXNCWCxtQkFBaUI7QUFDYixXQUFPO0FBRE0sR0F0Qk47QUF5QlgsaUJBQWU7QUFDWCxXQUFPO0FBREksR0F6Qko7QUE0Qlgsa0JBQWdCO0FBQ1osV0FBTztBQURLLEdBNUJMO0FBK0JYLGlCQUFlO0FBQ1gsV0FBTztBQURJLEdBL0JKO0FBa0NYLGdCQUFjO0FBQ1YsV0FBTztBQURHLEdBbENIO0FBcUNYLGdCQUFjO0FBQ1YsV0FBTztBQURHLEdBckNIO0FBd0NYLGtCQUFnQjtBQUNaLFdBQU87QUFESyxHQXhDTDtB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RyxHQUFELENBQWhEO0FBQ0QsS0FGRDtBQUdEOztBQUVELE1BQUlYLFNBQVMsQ0FBQ0UsTUFBVixHQUFtQixDQUF2QixFQUEwQjtBQUN4QixTQUFLLElBQUlFLEdBQVQsSUFBY0osU0FBZCxFQUF5QjtBQUN2QkgsU0FBRyxHQUFHQSxHQUFHLENBQUNRLE9BQUosQ0FBWSxNQUFNTCxTQUFTLENBQUNJLEdBQUQsQ0FBM0IsRUFBZ0MsRUFBaEMsQ0FBTjtBQUNEO0FBQ0Y7O0FBRUQsTUFBSVAsR0FBRyxDQUFDc0IsUUFBSixDQUFhLEdBQWIsQ0FBSixFQUF1QixNQUFNLG9CQUFOO0FBRXZCLE1BQUl4QixRQUFRLElBQUl5QixPQUFPLENBQUNDLEdBQVIsQ0FBWUMsV0FBNUIsRUFDRSxPQUFPRixPQUFPLENBQUNDLEdBQVIsQ0FBWUMsV0FBWixHQUEwQixHQUExQixHQUFnQ3pCLEdBQXZDO0FBQ0YsU0FBTyxNQUFNQSxHQUFiO0FBQ0QsQ0FoREQiLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvcm91dGVzLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsiY29uc3Qgcm91dGVzID0ge1xuICAgIFwiZ2VuZXJhdGVkOjpCSFR5eWszQlJXM0ROcXU3XCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC91c2VyXCJcbiAgICB9LFxuICAgIFwiUG9zdHMuaW5kZXhcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL1Bvc3RzXCJcbiAgICB9LFxuICAgIFwiUG9zdHMuY3JlYXRlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC9Qb3N0c1xcL2NyZWF0ZVwiXG4gICAgfSxcbiAgICBcIlBvc3RzLnN0b3JlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC9Qb3N0c1wiXG4gICAgfSxcbiAgICBcIlBvc3RzLnNob3dcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL1Bvc3RzXFwve1Bvc3R9XCJcbiAgICB9LFxuICAgIFwiUG9zdHMuZWRpdFwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwiYXBpXFwvUG9zdHNcXC97UG9zdH1cXC9lZGl0XCJcbiAgICB9LFxuICAgIFwiUG9zdHMudXBkYXRlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC9Qb3N0c1xcL3tQb3N0fVwiXG4gICAgfSxcbiAgICBcIlBvc3RzLmRlc3Ryb3lcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL1Bvc3RzXFwve1Bvc3R9XCJcbiAgICB9LFxuICAgIFwidXNlcnMuaW5kZXhcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL3VzZXJzXCJcbiAgICB9LFxuICAgIFwidXNlcnMuY3JlYXRlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC91c2Vyc1xcL2NyZWF0ZVwiXG4gICAgfSxcbiAgICBcInVzZXJzLnN0b3JlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC91c2Vyc1wiXG4gICAgfSxcbiAgICBcInVzZXJzLnNob3dcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL3VzZXJzXFwve3VzZXJ9XCJcbiAgICB9LFxuICAgIFwidXNlcnMuZWRpdFwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwiYXBpXFwvdXNlcnNcXC97dXNlcn1cXC9lZGl0XCJcbiAgICB9LFxuICAgIFwidXNlcnMudXBkYXRlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC91c2Vyc1xcL3t1c2VyfVwiXG4gICAgfSxcbiAgICBcInVzZXJzLmRlc3Ryb3lcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL3VzZXJzXFwve3VzZXJ9XCJcbiAgICB9LFxuICAgIFwicm9sZXMuaW5kZXhcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL3JvbGVzXCJcbiAgICB9LFxuICAgIFwicm9sZXMuY3JlYXRlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC9yb2xlc1xcL2NyZWF0ZVwiXG4gICAgfSxcbiAgICBcInJvbGVzLnN0b3JlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC9yb2xlc1wiXG4gICAgfSxcbiAgICBcInJvbGVzLnNob3dcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL3JvbGVzXFwve3JvbGV9XCJcbiAgICB9LFxuICAgIFwicm9sZXMuZWRpdFwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwiYXBpXFwvcm9sZXNcXC97cm9sZX1cXC9lZGl0XCJcbiAgICB9LFxuICAgIFwicm9sZXMudXBkYXRlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJhcGlcXC9yb2xlc1xcL3tyb2xlfVwiXG4gICAgfSxcbiAgICBcInJvbGVzLmRlc3Ryb3lcIjoge1xuICAgICAgICBcInVyaVwiOiBcImFwaVxcL3JvbGVzXFwve3JvbGV9XCJcbiAgICB9LFxuICAgIFwib3B0aW9uc1wiOiB7XG4gICAgICAgIFwidXJpXCI6IFwiYXBpXFwvb3B0aW9uc1wiXG4gICAgfSxcbiAgICBcImdlbmVyYXRlZDo6blcycVRMblFUa0xjQW1uaFwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwiXFwvXCJcbiAgICB9LFxuICAgIFwiZ2VuZXJhdGVkOjpZa1BIWmhZakJjMjVvQUlxXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJtdWNrc1wiXG4gICAgfSxcbiAgICBcImFkbWluUGFnZVwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwiYWRtaW5cIlxuICAgIH0sXG4gICAgXCJsb2dpblwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwibG9naW5cIlxuICAgIH0sXG4gICAgXCJnZW5lcmF0ZWQ6Om52UktuSGNpcGlpOXhISkRcIjoge1xuICAgICAgICBcInVyaVwiOiBcImxvZ2luXCJcbiAgICB9LFxuICAgIFwibG9nb3V0XCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJsb2dvdXRcIlxuICAgIH0sXG4gICAgXCJyZWdpc3RlclwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwicmVnaXN0ZXJcIlxuICAgIH0sXG4gICAgXCJnZW5lcmF0ZWQ6OlR5d0ZhVkx3Z01EVDdMY2pcIjoge1xuICAgICAgICBcInVyaVwiOiBcInJlZ2lzdGVyXCJcbiAgICB9LFxuICAgIFwicGFzc3dvcmQucmVxdWVzdFwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwicGFzc3dvcmRcXC9yZXNldFwiXG4gICAgfSxcbiAgICBcInBhc3N3b3JkLmVtYWlsXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJwYXNzd29yZFxcL2VtYWlsXCJcbiAgICB9LFxuICAgIFwicGFzc3dvcmQucmVzZXRcIjoge1xuICAgICAgICBcInVyaVwiOiBcInBhc3N3b3JkXFwvcmVzZXRcXC97dG9rZW59XCJcbiAgICB9LFxuICAgIFwicGFzc3dvcmQudXBkYXRlXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJwYXNzd29yZFxcL3Jlc2V0XCJcbiAgICB9LFxuICAgIFwicGFzc3dvcmQuY29uZmlybVwiOiB7XG4gICAgICAgIFwidXJpXCI6IFwicGFzc3dvcmRcXC9jb25maXJtXCJcbiAgICB9LFxuICAgIFwiZ2VuZXJhdGVkOjppenp0UjFSWWxkT0ZJcjRCXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJwYXNzd29yZFxcL2NvbmZpcm1cIlxuICAgIH0sXG4gICAgXCJob21lXCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJob21lXCJcbiAgICB9LFxuICAgIFwiZ2V0QXBpS2V5XCI6IHtcbiAgICAgICAgXCJ1cmlcIjogXCJnZXRBcGlLZXlcIlxuICAgIH1cbn07XG5cbmNvbnN0IHJvdXRlID0gKHJvdXRlTmFtZSwgcGFyYW1zID0gW10sIGFic29sdXRlID0gdHJ1ZSkgPT4ge1xuICBjb25zdCBfcm91dGUgPSByb3V0ZXNbcm91dGVOYW1lXTtcbiAgaWYgKF9yb3V0ZSA9PSBudWxsKSB0aHJvdyBcIlJlcXVlc3RlZCByb3V0ZSBkb2Vzbid0IGV4aXN0XCI7XG5cbiAgbGV0IHVyaSA9IF9yb3V0ZS51cmk7XG5cbiAgY29uc3QgbWF0Y2hlcyA9IHVyaS5tYXRjaCgve1tcXHddK1xcPz99L2cpIHx8IFtdO1xuICBjb25zdCBvcHRpb25hbHMgPSB1cmkubWF0Y2goL3tbXFx3XStcXD99L2cpIHx8IFtdO1xuXG4gIGNvbnN0IHJlcXVpcmVkUGFyYW1ldGVyc0NvdW50ID0gbWF0Y2hlcy5sZW5ndGggLSBvcHRpb25hbHMubGVuZ3RoO1xuXG4gIGlmIChwYXJhbXMgaW5zdGFuY2VvZiBBcnJheSkge1xuICAgIGlmIChwYXJhbXMubGVuZ3RoIDwgcmVxdWlyZWRQYXJhbWV0ZXJzQ291bnQpIHRocm93IFwiTWlzc2luZyBwYXJhbWV0ZXJzXCI7XG5cbiAgICBmb3IgKGxldCBpID0gMDsgaSA8IHJlcXVpcmVkUGFyYW1ldGVyc0NvdW50OyBpKyspXG4gICAgICB1cmkgPSB1cmkucmVwbGFjZSgve1tcXHddK1xcPz99LywgcGFyYW1zLnNoaWZ0KCkpO1xuXG4gICAgZm9yIChsZXQgaSA9IDA7IGkgPCBwYXJhbXMubGVuZ3RoOyBpKyspXG4gICAgICB1cmkgKz0gKGkgPyBcIiZcIiA6IFwiP1wiKSArIHBhcmFtc1tpXSArIFwiPVwiICsgcGFyYW1zW2ldO1xuICB9IGVsc2UgaWYgKHBhcmFtcyBpbnN0YW5jZW9mIE9iamVjdCkge1xuICAgIGxldCBleHRyYVBhcmFtcyA9IG1hdGNoZXMucmVkdWNlKChhYywgbWF0Y2gpID0+IHtcbiAgICAgIGxldCBrZXkgPSBtYXRjaC5zdWJzdHJpbmcoMSwgbWF0Y2gubGVuZ3RoIC0gMSk7XG4gICAgICBsZXQgaXNPcHRpb25hbCA9IGtleS5lbmRzV2l0aChcIj9cIik7XG4gICAgICBpZiAocGFyYW1zLmhhc093blByb3BlcnR5KGtleS5yZXBsYWNlKFwiP1wiLCBcIlwiKSkpIHtcbiAgICAgICAgdXJpID0gdXJpLnJlcGxhY2UobmV3IFJlZ0V4cChtYXRjaC5yZXBsYWNlKFwiP1wiLCBcIlxcXFw/XCIpLCBcImdcIiksIHBhcmFtc1trZXkucmVwbGFjZShcIj9cIiwgXCJcIildKTtcbiAgICAgICAgZGVsZXRlIGFjW2tleS5yZXBsYWNlKFwiP1wiLCBcIlwiKV07XG4gICAgICB9IGVsc2UgaWYgKGlzT3B0aW9uYWwpIHtcbiAgICAgICAgICB1cmkgPSB1cmkucmVwbGFjZShcIi9cIiArIG5ldyBSZWdFeHAobWF0Y2gsIFwiZ1wiKSwgXCJcIik7XG4gICAgICB9XG4gICAgICByZXR1cm4gYWM7XG4gICAgfSwgcGFyYW1zKTtcblxuICAgIE9iamVjdC5rZXlzKGV4dHJhUGFyYW1zKS5mb3JFYWNoKChrZXksIGkpID0+IHtcbiAgICAgIHVyaSArPSAoaSA/IFwiJlwiIDogXCI/XCIpICsga2V5ICsgXCI9XCIgKyBleHRyYVBhcmFtc1trZXldO1xuICAgIH0pO1xuICB9XG5cbiAgaWYgKG9wdGlvbmFscy5sZW5ndGggPiAwKSB7XG4gICAgZm9yIChsZXQgaSBpbiBvcHRpb25hbHMpIHtcbiAgICAgIHVyaSA9IHVyaS5yZXBsYWNlKFwiL1wiICsgb3B0aW9uYWxzW2ldLCBcIlwiKTtcbiAgICB9XG4gIH1cblxuICBpZiAodXJpLmluY2x1ZGVzKFwifVwiKSkgdGhyb3cgXCJNaXNzaW5nIHBhcmFtZXRlcnNcIjtcblxuICBpZiAoYWJzb2x1dGUgJiYgcHJvY2Vzcy5lbnYuTUlYX0FQUF9VUkwpXG4gICAgcmV0dXJuIHByb2Nlc3MuZW52Lk1JWF9BUFBfVVJMICsgXCIvXCIgKyB1cmk7XG4gIHJldHVybiBcIi9cIiArIHVyaTtcbn07XG5cbmV4cG9ydCB7IHJvdXRlIH07XG4iXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/routes.js\n");

/***/ }),

/***/ "./node_modules/process/browser.js":
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
/***/ ((module) => {

eval("// shim for using process in browser\nvar process = module.exports = {};\n\n// cached from whatever global is present so that test runners that stub it\n// don't break things.  But we need to wrap it in a try catch in case it is\n// wrapped in strict mode code which doesn't define any globals.  It's inside a\n// function because try/catches deoptimize in certain engines.\n\nvar cachedSetTimeout;\nvar cachedClearTimeout;\n\nfunction defaultSetTimout() {\n    throw new Error('setTimeout has not been defined');\n}\nfunction defaultClearTimeout () {\n    throw new Error('clearTimeout has not been defined');\n}\n(function () {\n    try {\n        if (typeof setTimeout === 'function') {\n            cachedSetTimeout = setTimeout;\n        } else {\n            cachedSetTimeout = defaultSetTimout;\n        }\n    } catch (e) {\n        cachedSetTimeout = defaultSetTimout;\n    }\n    try {\n        if (typeof clearTimeout === 'function') {\n            cachedClearTimeout = clearTimeout;\n        } else {\n            cachedClearTimeout = defaultClearTimeout;\n        }\n    } catch (e) {\n        cachedClearTimeout = defaultClearTimeout;\n    }\n} ())\nfunction runTimeout(fun) {\n    if (cachedSetTimeout === setTimeout) {\n        //normal enviroments in sane situations\n        return setTimeout(fun, 0);\n    }\n    // if setTimeout wasn't available but was latter defined\n    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {\n        cachedSetTimeout = setTimeout;\n        return setTimeout(fun, 0);\n    }\n    try {\n        // when when somebody has screwed with setTimeout but no I.E. maddness\n        return cachedSetTimeout(fun, 0);\n    } catch(e){\n        try {\n            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally\n            return cachedSetTimeout.call(null, fun, 0);\n        } catch(e){\n            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error\n            return cachedSetTimeout.call(this, fun, 0);\n        }\n    }\n\n\n}\nfunction runClearTimeout(marker) {\n    if (cachedClearTimeout === clearTimeout) {\n        //normal enviroments in sane situations\n        return clearTimeout(marker);\n    }\n    // if clearTimeout wasn't available but was latter defined\n    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {\n        cachedClearTimeout = clearTimeout;\n        return clearTimeout(marker);\n    }\n    try {\n        // when when somebody has screwed with setTimeout but no I.E. maddness\n        return cachedClearTimeout(marker);\n    } catch (e){\n        try {\n            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally\n            return cachedClearTimeout.call(null, marker);\n        } catch (e){\n            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.\n            // Some versions of I.E. have different rules for clearTimeout vs setTimeout\n            return cachedClearTimeout.call(this, marker);\n        }\n    }\n\n\n\n}\nvar queue = [];\nvar draining = false;\nvar currentQueue;\nvar queueIndex = -1;\n\nfunction cleanUpNextTick() {\n    if (!draining || !currentQueue) {\n        return;\n    }\n    draining = false;\n    if (currentQueue.length) {\n        queue = currentQueue.concat(queue);\n    } else {\n        queueIndex = -1;\n    }\n    if (queue.length) {\n        drainQueue();\n    }\n}\n\nfunction drainQueue() {\n    if (draining) {\n        return;\n    }\n    var timeout = runTimeout(cleanUpNextTick);\n    draining = true;\n\n    var len = queue.length;\n    while(len) {\n        currentQueue = queue;\n        queue = [];\n        while (++queueIndex < len) {\n            if (currentQueue) {\n                currentQueue[queueIndex].run();\n            }\n        }\n        queueIndex = -1;\n        len = queue.length;\n    }\n    currentQueue = null;\n    draining = false;\n    runClearTimeout(timeout);\n}\n\nprocess.nextTick = function (fun) {\n    var args = new Array(arguments.length - 1);\n    if (arguments.length > 1) {\n        for (var i = 1; i < arguments.length; i++) {\n            args[i - 1] = arguments[i];\n        }\n    }\n    queue.push(new Item(fun, args));\n    if (queue.length === 1 && !draining) {\n        runTimeout(drainQueue);\n    }\n};\n\n// v8 likes predictible objects\nfunction Item(fun, array) {\n    this.fun = fun;\n    this.array = array;\n}\nItem.prototype.run = function () {\n    this.fun.apply(null, this.array);\n};\nprocess.title = 'browser';\nprocess.browser = true;\nprocess.env = {};\nprocess.argv = [];\nprocess.version = ''; // empty string to avoid regexp issues\nprocess.versions = {};\n\nfunction noop() {}\n\nprocess.on = noop;\nprocess.addListener = noop;\nprocess.once = noop;\nprocess.off = noop;\nprocess.removeListener = noop;\nprocess.removeAllListeners = noop;\nprocess.emit = noop;\nprocess.prependListener = noop;\nprocess.prependOnceListener = noop;\n\nprocess.listeners = function (name) { return [] }\n\nprocess.binding = function (name) {\n    throw new Error('process.binding is not supported');\n};\n\nprocess.cwd = function () { return '/' };\nprocess.chdir = function (dir) {\n    throw new Error('process.chdir is not supported');\n};\nprocess.umask = function() { return 0; };\n//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9ub2RlX21vZHVsZXMvcHJvY2Vzcy9icm93c2VyLmpzP2YyOGMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsU0FBUztBQUNUO0FBQ0E7QUFDQSxLQUFLO0FBQ0w7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLFNBQVM7QUFDVDtBQUNBO0FBQ0EsS0FBSztBQUNMO0FBQ0E7QUFDQSxDQUFDO0FBQ0Q7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxLQUFLO0FBQ0w7QUFDQTtBQUNBO0FBQ0EsU0FBUztBQUNUO0FBQ0E7QUFDQTtBQUNBOzs7QUFHQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0EsS0FBSztBQUNMO0FBQ0E7QUFDQTtBQUNBLFNBQVM7QUFDVDtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7O0FBSUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBLEtBQUs7QUFDTDtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBO0FBQ0E7QUFDQTtBQUNBLHVCQUF1QixzQkFBc0I7QUFDN0M7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxxQkFBcUI7QUFDckI7O0FBRUE7O0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOztBQUVBLHFDQUFxQzs7QUFFckM7QUFDQTtBQUNBOztBQUVBLDJCQUEyQjtBQUMzQjtBQUNBO0FBQ0E7QUFDQSw0QkFBNEIsVUFBVSIsImZpbGUiOiIuL25vZGVfbW9kdWxlcy9wcm9jZXNzL2Jyb3dzZXIuanMuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyBzaGltIGZvciB1c2luZyBwcm9jZXNzIGluIGJyb3dzZXJcbnZhciBwcm9jZXNzID0gbW9kdWxlLmV4cG9ydHMgPSB7fTtcblxuLy8gY2FjaGVkIGZyb20gd2hhdGV2ZXIgZ2xvYmFsIGlzIHByZXNlbnQgc28gdGhhdCB0ZXN0IHJ1bm5lcnMgdGhhdCBzdHViIGl0XG4vLyBkb24ndCBicmVhayB0aGluZ3MuICBCdXQgd2UgbmVlZCB0byB3cmFwIGl0IGluIGEgdHJ5IGNhdGNoIGluIGNhc2UgaXQgaXNcbi8vIHdyYXBwZWQgaW4gc3RyaWN0IG1vZGUgY29kZSB3aGljaCBkb2Vzbid0IGRlZmluZSBhbnkgZ2xvYmFscy4gIEl0J3MgaW5zaWRlIGFcbi8vIGZ1bmN0aW9uIGJlY2F1c2UgdHJ5L2NhdGNoZXMgZGVvcHRpbWl6ZSBpbiBjZXJ0YWluIGVuZ2luZXMuXG5cbnZhciBjYWNoZWRTZXRUaW1lb3V0O1xudmFyIGNhY2hlZENsZWFyVGltZW91dDtcblxuZnVuY3Rpb24gZGVmYXVsdFNldFRpbW91dCgpIHtcbiAgICB0aHJvdyBuZXcgRXJyb3IoJ3NldFRpbWVvdXQgaGFzIG5vdCBiZWVuIGRlZmluZWQnKTtcbn1cbmZ1bmN0aW9uIGRlZmF1bHRDbGVhclRpbWVvdXQgKCkge1xuICAgIHRocm93IG5ldyBFcnJvcignY2xlYXJUaW1lb3V0IGhhcyBub3QgYmVlbiBkZWZpbmVkJyk7XG59XG4oZnVuY3Rpb24gKCkge1xuICAgIHRyeSB7XG4gICAgICAgIGlmICh0eXBlb2Ygc2V0VGltZW91dCA9PT0gJ2Z1bmN0aW9uJykge1xuICAgICAgICAgICAgY2FjaGVkU2V0VGltZW91dCA9IHNldFRpbWVvdXQ7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBjYWNoZWRTZXRUaW1lb3V0ID0gZGVmYXVsdFNldFRpbW91dDtcbiAgICAgICAgfVxuICAgIH0gY2F0Y2ggKGUpIHtcbiAgICAgICAgY2FjaGVkU2V0VGltZW91dCA9IGRlZmF1bHRTZXRUaW1vdXQ7XG4gICAgfVxuICAgIHRyeSB7XG4gICAgICAgIGlmICh0eXBlb2YgY2xlYXJUaW1lb3V0ID09PSAnZnVuY3Rpb24nKSB7XG4gICAgICAgICAgICBjYWNoZWRDbGVhclRpbWVvdXQgPSBjbGVhclRpbWVvdXQ7XG4gICAgICAgIH0gZWxzZSB7XG4gICAgICAgICAgICBjYWNoZWRDbGVhclRpbWVvdXQgPSBkZWZhdWx0Q2xlYXJUaW1lb3V0O1xuICAgICAgICB9XG4gICAgfSBjYXRjaCAoZSkge1xuICAgICAgICBjYWNoZWRDbGVhclRpbWVvdXQgPSBkZWZhdWx0Q2xlYXJUaW1lb3V0O1xuICAgIH1cbn0gKCkpXG5mdW5jdGlvbiBydW5UaW1lb3V0KGZ1bikge1xuICAgIGlmIChjYWNoZWRTZXRUaW1lb3V0ID09PSBzZXRUaW1lb3V0KSB7XG4gICAgICAgIC8vbm9ybWFsIGVudmlyb21lbnRzIGluIHNhbmUgc2l0dWF0aW9uc1xuICAgICAgICByZXR1cm4gc2V0VGltZW91dChmdW4sIDApO1xuICAgIH1cbiAgICAvLyBpZiBzZXRUaW1lb3V0IHdhc24ndCBhdmFpbGFibGUgYnV0IHdhcyBsYXR0ZXIgZGVmaW5lZFxuICAgIGlmICgoY2FjaGVkU2V0VGltZW91dCA9PT0gZGVmYXVsdFNldFRpbW91dCB8fCAhY2FjaGVkU2V0VGltZW91dCkgJiYgc2V0VGltZW91dCkge1xuICAgICAgICBjYWNoZWRTZXRUaW1lb3V0ID0gc2V0VGltZW91dDtcbiAgICAgICAgcmV0dXJuIHNldFRpbWVvdXQoZnVuLCAwKTtcbiAgICB9XG4gICAgdHJ5IHtcbiAgICAgICAgLy8gd2hlbiB3aGVuIHNvbWVib2R5IGhhcyBzY3Jld2VkIHdpdGggc2V0VGltZW91dCBidXQgbm8gSS5FLiBtYWRkbmVzc1xuICAgICAgICByZXR1cm4gY2FjaGVkU2V0VGltZW91dChmdW4sIDApO1xuICAgIH0gY2F0Y2goZSl7XG4gICAgICAgIHRyeSB7XG4gICAgICAgICAgICAvLyBXaGVuIHdlIGFyZSBpbiBJLkUuIGJ1dCB0aGUgc2NyaXB0IGhhcyBiZWVuIGV2YWxlZCBzbyBJLkUuIGRvZXNuJ3QgdHJ1c3QgdGhlIGdsb2JhbCBvYmplY3Qgd2hlbiBjYWxsZWQgbm9ybWFsbHlcbiAgICAgICAgICAgIHJldHVybiBjYWNoZWRTZXRUaW1lb3V0LmNhbGwobnVsbCwgZnVuLCAwKTtcbiAgICAgICAgfSBjYXRjaChlKXtcbiAgICAgICAgICAgIC8vIHNhbWUgYXMgYWJvdmUgYnV0IHdoZW4gaXQncyBhIHZlcnNpb24gb2YgSS5FLiB0aGF0IG11c3QgaGF2ZSB0aGUgZ2xvYmFsIG9iamVjdCBmb3IgJ3RoaXMnLCBob3BmdWxseSBvdXIgY29udGV4dCBjb3JyZWN0IG90aGVyd2lzZSBpdCB3aWxsIHRocm93IGEgZ2xvYmFsIGVycm9yXG4gICAgICAgICAgICByZXR1cm4gY2FjaGVkU2V0VGltZW91dC5jYWxsKHRoaXMsIGZ1biwgMCk7XG4gICAgICAgIH1cbiAgICB9XG5cblxufVxuZnVuY3Rpb24gcnVuQ2xlYXJUaW1lb3V0KG1hcmtlcikge1xuICAgIGlmIChjYWNoZWRDbGVhclRpbWVvdXQgPT09IGNsZWFyVGltZW91dCkge1xuICAgICAgICAvL25vcm1hbCBlbnZpcm9tZW50cyBpbiBzYW5lIHNpdHVhdGlvbnNcbiAgICAgICAgcmV0dXJuIGNsZWFyVGltZW91dChtYXJrZXIpO1xuICAgIH1cbiAgICAvLyBpZiBjbGVhclRpbWVvdXQgd2Fzbid0IGF2YWlsYWJsZSBidXQgd2FzIGxhdHRlciBkZWZpbmVkXG4gICAgaWYgKChjYWNoZWRDbGVhclRpbWVvdXQgPT09IGRlZmF1bHRDbGVhclRpbWVvdXQgfHwgIWNhY2hlZENsZWFyVGltZW91dCkgJiYgY2xlYXJUaW1lb3V0KSB7XG4gICAgICAgIGNhY2hlZENsZWFyVGltZW91dCA9IGNsZWFyVGltZW91dDtcbiAgICAgICAgcmV0dXJuIGNsZWFyVGltZW91dChtYXJrZXIpO1xuICAgIH1cbiAgICB0cnkge1xuICAgICAgICAvLyB3aGVuIHdoZW4gc29tZWJvZHkgaGFzIHNjcmV3ZWQgd2l0aCBzZXRUaW1lb3V0IGJ1dCBubyBJLkUuIG1hZGRuZXNzXG4gICAgICAgIHJldHVybiBjYWNoZWRDbGVhclRpbWVvdXQobWFya2VyKTtcbiAgICB9IGNhdGNoIChlKXtcbiAgICAgICAgdHJ5IHtcbiAgICAgICAgICAgIC8vIFdoZW4gd2UgYXJlIGluIEkuRS4gYnV0IHRoZSBzY3JpcHQgaGFzIGJlZW4gZXZhbGVkIHNvIEkuRS4gZG9lc24ndCAgdHJ1c3QgdGhlIGdsb2JhbCBvYmplY3Qgd2hlbiBjYWxsZWQgbm9ybWFsbHlcbiAgICAgICAgICAgIHJldHVybiBjYWNoZWRDbGVhclRpbWVvdXQuY2FsbChudWxsLCBtYXJrZXIpO1xuICAgICAgICB9IGNhdGNoIChlKXtcbiAgICAgICAgICAgIC8vIHNhbWUgYXMgYWJvdmUgYnV0IHdoZW4gaXQncyBhIHZlcnNpb24gb2YgSS5FLiB0aGF0IG11c3QgaGF2ZSB0aGUgZ2xvYmFsIG9iamVjdCBmb3IgJ3RoaXMnLCBob3BmdWxseSBvdXIgY29udGV4dCBjb3JyZWN0IG90aGVyd2lzZSBpdCB3aWxsIHRocm93IGEgZ2xvYmFsIGVycm9yLlxuICAgICAgICAgICAgLy8gU29tZSB2ZXJzaW9ucyBvZiBJLkUuIGhhdmUgZGlmZmVyZW50IHJ1bGVzIGZvciBjbGVhclRpbWVvdXQgdnMgc2V0VGltZW91dFxuICAgICAgICAgICAgcmV0dXJuIGNhY2hlZENsZWFyVGltZW91dC5jYWxsKHRoaXMsIG1hcmtlcik7XG4gICAgICAgIH1cbiAgICB9XG5cblxuXG59XG52YXIgcXVldWUgPSBbXTtcbnZhciBkcmFpbmluZyA9IGZhbHNlO1xudmFyIGN1cnJlbnRRdWV1ZTtcbnZhciBxdWV1ZUluZGV4ID0gLTE7XG5cbmZ1bmN0aW9uIGNsZWFuVXBOZXh0VGljaygpIHtcbiAgICBpZiAoIWRyYWluaW5nIHx8ICFjdXJyZW50UXVldWUpIHtcbiAgICAgICAgcmV0dXJuO1xuICAgIH1cbiAgICBkcmFpbmluZyA9IGZhbHNlO1xuICAgIGlmIChjdXJyZW50UXVldWUubGVuZ3RoKSB7XG4gICAgICAgIHF1ZXVlID0gY3VycmVudFF1ZXVlLmNvbmNhdChxdWV1ZSk7XG4gICAgfSBlbHNlIHtcbiAgICAgICAgcXVldWVJbmRleCA9IC0xO1xuICAgIH1cbiAgICBpZiAocXVldWUubGVuZ3RoKSB7XG4gICAgICAgIGRyYWluUXVldWUoKTtcbiAgICB9XG59XG5cbmZ1bmN0aW9uIGRyYWluUXVldWUoKSB7XG4gICAgaWYgKGRyYWluaW5nKSB7XG4gICAgICAgIHJldHVybjtcbiAgICB9XG4gICAgdmFyIHRpbWVvdXQgPSBydW5UaW1lb3V0KGNsZWFuVXBOZXh0VGljayk7XG4gICAgZHJhaW5pbmcgPSB0cnVlO1xuXG4gICAgdmFyIGxlbiA9IHF1ZXVlLmxlbmd0aDtcbiAgICB3aGlsZShsZW4pIHtcbiAgICAgICAgY3VycmVudFF1ZXVlID0gcXVldWU7XG4gICAgICAgIHF1ZXVlID0gW107XG4gICAgICAgIHdoaWxlICgrK3F1ZXVlSW5kZXggPCBsZW4pIHtcbiAgICAgICAgICAgIGlmIChjdXJyZW50UXVldWUpIHtcbiAgICAgICAgICAgICAgICBjdXJyZW50UXVldWVbcXVldWVJbmRleF0ucnVuKCk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICAgICAgcXVldWVJbmRleCA9IC0xO1xuICAgICAgICBsZW4gPSBxdWV1ZS5sZW5ndGg7XG4gICAgfVxuICAgIGN1cnJlbnRRdWV1ZSA9IG51bGw7XG4gICAgZHJhaW5pbmcgPSBmYWxzZTtcbiAgICBydW5DbGVhclRpbWVvdXQodGltZW91dCk7XG59XG5cbnByb2Nlc3MubmV4dFRpY2sgPSBmdW5jdGlvbiAoZnVuKSB7XG4gICAgdmFyIGFyZ3MgPSBuZXcgQXJyYXkoYXJndW1lbnRzLmxlbmd0aCAtIDEpO1xuICAgIGlmIChhcmd1bWVudHMubGVuZ3RoID4gMSkge1xuICAgICAgICBmb3IgKHZhciBpID0gMTsgaSA8IGFyZ3VtZW50cy5sZW5ndGg7IGkrKykge1xuICAgICAgICAgICAgYXJnc1tpIC0gMV0gPSBhcmd1bWVudHNbaV07XG4gICAgICAgIH1cbiAgICB9XG4gICAgcXVldWUucHVzaChuZXcgSXRlbShmdW4sIGFyZ3MpKTtcbiAgICBpZiAocXVldWUubGVuZ3RoID09PSAxICYmICFkcmFpbmluZykge1xuICAgICAgICBydW5UaW1lb3V0KGRyYWluUXVldWUpO1xuICAgIH1cbn07XG5cbi8vIHY4IGxpa2VzIHByZWRpY3RpYmxlIG9iamVjdHNcbmZ1bmN0aW9uIEl0ZW0oZnVuLCBhcnJheSkge1xuICAgIHRoaXMuZnVuID0gZnVuO1xuICAgIHRoaXMuYXJyYXkgPSBhcnJheTtcbn1cbkl0ZW0ucHJvdG90eXBlLnJ1biA9IGZ1bmN0aW9uICgpIHtcbiAgICB0aGlzLmZ1bi5hcHBseShudWxsLCB0aGlzLmFycmF5KTtcbn07XG5wcm9jZXNzLnRpdGxlID0gJ2Jyb3dzZXInO1xucHJvY2Vzcy5icm93c2VyID0gdHJ1ZTtcbnByb2Nlc3MuZW52ID0ge307XG5wcm9jZXNzLmFyZ3YgPSBbXTtcbnByb2Nlc3MudmVyc2lvbiA9ICcnOyAvLyBlbXB0eSBzdHJpbmcgdG8gYXZvaWQgcmVnZXhwIGlzc3Vlc1xucHJvY2Vzcy52ZXJzaW9ucyA9IHt9O1xuXG5mdW5jdGlvbiBub29wKCkge31cblxucHJvY2Vzcy5vbiA9IG5vb3A7XG5wcm9jZXNzLmFkZExpc3RlbmVyID0gbm9vcDtcbnByb2Nlc3Mub25jZSA9IG5vb3A7XG5wcm9jZXNzLm9mZiA9IG5vb3A7XG5wcm9jZXNzLnJlbW92ZUxpc3RlbmVyID0gbm9vcDtcbnByb2Nlc3MucmVtb3ZlQWxsTGlzdGVuZXJzID0gbm9vcDtcbnByb2Nlc3MuZW1pdCA9IG5vb3A7XG5wcm9jZXNzLnByZXBlbmRMaXN0ZW5lciA9IG5vb3A7XG5wcm9jZXNzLnByZXBlbmRPbmNlTGlzdGVuZXIgPSBub29wO1xuXG5wcm9jZXNzLmxpc3RlbmVycyA9IGZ1bmN0aW9uIChuYW1lKSB7IHJldHVybiBbXSB9XG5cbnByb2Nlc3MuYmluZGluZyA9IGZ1bmN0aW9uIChuYW1lKSB7XG4gICAgdGhyb3cgbmV3IEVycm9yKCdwcm9jZXNzLmJpbmRpbmcgaXMgbm90IHN1cHBvcnRlZCcpO1xufTtcblxucHJvY2Vzcy5jd2QgPSBmdW5jdGlvbiAoKSB7IHJldHVybiAnLycgfTtcbnByb2Nlc3MuY2hkaXIgPSBmdW5jdGlvbiAoZGlyKSB7XG4gICAgdGhyb3cgbmV3IEVycm9yKCdwcm9jZXNzLmNoZGlyIGlzIG5vdCBzdXBwb3J0ZWQnKTtcbn07XG5wcm9jZXNzLnVtYXNrID0gZnVuY3Rpb24oKSB7IHJldHVybiAwOyB9O1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./node_modules/process/browser.js\n");

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
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/js/routes.js");
/******/ 	
/******/ })()
;