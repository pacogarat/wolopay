/*!
 * angular-translate - v2.7.2 - 2015-06-01
 * http://github.com/angular-translate/angular-translate
 * Copyright (c) 2015 ; Licensed MIT
 */
!function(a,b){"function"==typeof define&&define.amd?define([],function(){return b()}):"object"==typeof exports?module.exports=b():b()}(this,function(){function a(a){"use strict";var b=a.storageKey(),c=a.storage(),d=function(){var d=a.preferredLanguage();angular.isString(d)?a.use(d):c.put(b,a.use())};d.displayName="fallbackFromIncorrectStorageValue",c?c.get(b)?a.use(c.get(b))["catch"](d):d():angular.isString(a.preferredLanguage())&&a.use(a.preferredLanguage())}function b(){"use strict";var a,b,c=null,d=!1,e=!1;b={sanitize:function(a,b){return"text"===b&&(a=g(a)),a},escape:function(a,b){return"text"===b&&(a=f(a)),a},sanitizeParameters:function(a,b){return"params"===b&&(a=h(a,g)),a},escapeParameters:function(a,b){return"params"===b&&(a=h(a,f)),a}},b.escaped=b.escapeParameters,this.addStrategy=function(a,c){return b[a]=c,this},this.removeStrategy=function(a){return delete b[a],this},this.useStrategy=function(a){return d=!0,c=a,this},this.$get=["$injector","$log",function(f,g){var h=function(a,c,d){return angular.forEach(d,function(d){if(angular.isFunction(d))a=d(a,c);else{if(!angular.isFunction(b[d]))throw new Error("pascalprecht.translate.$translateSanitization: Unknown sanitization strategy: '"+d+"'");a=b[d](a,c)}}),a},i=function(){d||e||(g.warn("pascalprecht.translate.$translateSanitization: No sanitization strategy has been configured. This can have serious security implications. See http://angular-translate.github.io/docs/#/guide/19_security for details."),e=!0)};return f.has("$sanitize")&&(a=f.get("$sanitize")),{useStrategy:function(a){return function(b){a.useStrategy(b)}}(this),sanitize:function(a,b,d){if(c||i(),arguments.length<3&&(d=c),!d)return a;var e=angular.isArray(d)?d:[d];return h(a,b,e)}}}];var f=function(a){var b=angular.element("<div></div>");return b.text(a),b.html()},g=function(b){if(!a)throw new Error("pascalprecht.translate.$translateSanitization: Error cannot find $sanitize service. Either include the ngSanitize module (https://docs.angularjs.org/api/ngSanitize) or use a sanitization strategy which does not depend on $sanitize, such as 'escape'.");return a(b)},h=function(a,b){if(angular.isObject(a)){var c=angular.isArray(a)?[]:{};return angular.forEach(a,function(a,d){c[d]=h(a,b)}),c}return angular.isNumber(a)?a:b(a)}}function c(a,b,c,d){"use strict";var e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t={},u=[],v=a,w=[],x="translate-cloak",y=!1,z=!1,A=".",B=0,C=!0,D="default",E={"default":function(a){return(a||"").split("-").join("_")},java:function(a){var b=(a||"").split("-").join("_"),c=b.split("_");return c.length>1?c[0].toLowerCase()+"_"+c[1].toUpperCase():b},bcp47:function(a){var b=(a||"").split("_").join("-"),c=b.split("-");return c.length>1?c[0].toLowerCase()+"-"+c[1].toUpperCase():b}},F="2.7.2",G=function(){if(angular.isFunction(d.getLocale))return d.getLocale();var a,c,e=b.$get().navigator,f=["language","browserLanguage","systemLanguage","userLanguage"];if(angular.isArray(e.languages))for(a=0;a<e.languages.length;a++)if(c=e.languages[a],c&&c.length)return c;for(a=0;a<f.length;a++)if(c=e[f[a]],c&&c.length)return c;return null};G.displayName="angular-translate/service: getFirstBrowserLanguage";var H=function(){var a=G()||"";return E[D]&&(a=E[D](a)),a};H.displayName="angular-translate/service: getLocale";var I=function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},J=function(){return this.toString().replace(/^\s+|\s+$/g,"")},K=function(a){for(var b=[],c=angular.lowercase(a),d=0,e=u.length;e>d;d++)b.push(angular.lowercase(u[d]));if(I(b,c)>-1)return a;if(f){var g;for(var h in f){var i=!1,j=Object.prototype.hasOwnProperty.call(f,h)&&angular.lowercase(h)===angular.lowercase(a);if("*"===h.slice(-1)&&(i=h.slice(0,-1)===a.slice(0,h.length-1)),(j||i)&&(g=f[h],I(b,angular.lowercase(g))>-1))return g}}if(a){var k=a.split("_");if(k.length>1&&I(b,angular.lowercase(k[0]))>-1)return k[0]}return a},L=function(a,b){if(!a&&!b)return t;if(a&&!b){if(angular.isString(a))return t[a]}else angular.isObject(t[a])||(t[a]={}),angular.extend(t[a],M(b));return this};this.translations=L,this.cloakClassName=function(a){return a?(x=a,this):x};var M=function(a,b,c,d){var e,f,g,h;b||(b=[]),c||(c={});for(e in a)Object.prototype.hasOwnProperty.call(a,e)&&(h=a[e],angular.isObject(h)?M(h,b.concat(e),c,e):(f=b.length?""+b.join(A)+A+e:e,b.length&&e===d&&(g=""+b.join(A),c[g]="@:"+f),c[f]=h));return c};M.displayName="flatObject",this.addInterpolation=function(a){return w.push(a),this},this.useMessageFormatInterpolation=function(){return this.useInterpolation("$translateMessageFormatInterpolation")},this.useInterpolation=function(a){return n=a,this},this.useSanitizeValueStrategy=function(a){return c.useStrategy(a),this},this.preferredLanguage=function(a){return N(a),this};var N=function(a){return a&&(e=a),e};this.translationNotFoundIndicator=function(a){return this.translationNotFoundIndicatorLeft(a),this.translationNotFoundIndicatorRight(a),this},this.translationNotFoundIndicatorLeft=function(a){return a?(q=a,this):q},this.translationNotFoundIndicatorRight=function(a){return a?(r=a,this):r},this.fallbackLanguage=function(a){return O(a),this};var O=function(a){return a?(angular.isString(a)?(h=!0,g=[a]):angular.isArray(a)&&(h=!1,g=a),angular.isString(e)&&I(g,e)<0&&g.push(e),this):h?g[0]:g};this.use=function(a){if(a){if(!t[a]&&!o)throw new Error("$translateProvider couldn't find translationTable for langKey: '"+a+"'");return i=a,this}return i};var P=function(a){return a?(v=a,this):l?l+v:v};this.storageKey=P,this.useUrlLoader=function(a,b){return this.useLoader("$translateUrlLoader",angular.extend({url:a},b))},this.useStaticFilesLoader=function(a){return this.useLoader("$translateStaticFilesLoader",a)},this.useLoader=function(a,b){return o=a,p=b||{},this},this.useLocalStorage=function(){return this.useStorage("$translateLocalStorage")},this.useCookieStorage=function(){return this.useStorage("$translateCookieStorage")},this.useStorage=function(a){return k=a,this},this.storagePrefix=function(a){return a?(l=a,this):a},this.useMissingTranslationHandlerLog=function(){return this.useMissingTranslationHandler("$translateMissingTranslationHandlerLog")},this.useMissingTranslationHandler=function(a){return m=a,this},this.usePostCompiling=function(a){return y=!!a,this},this.forceAsyncReload=function(a){return z=!!a,this},this.uniformLanguageTag=function(a){return a?angular.isString(a)&&(a={standard:a}):a={},D=a.standard,this},this.determinePreferredLanguage=function(a){var b=a&&angular.isFunction(a)?a():H();return e=u.length?K(b):b,this},this.registerAvailableLanguageKeys=function(a,b){return a?(u=a,b&&(f=b),this):u},this.useLoaderCache=function(a){return a===!1?s=void 0:a===!0?s=!0:"undefined"==typeof a?s="$translationCache":a&&(s=a),this},this.directivePriority=function(a){return void 0===a?B:(B=a,this)},this.statefulFilter=function(a){return void 0===a?C:(C=a,this)},this.$get=["$log","$injector","$rootScope","$q",function(a,b,c,d){var f,l,u,A=b.get(n||"$translateDefaultInterpolation"),D=!1,E={},G={},H=function(a,b,c,h){if(angular.isArray(a)){var j=function(a){for(var e={},f=[],g=function(a){var f=d.defer(),g=function(b){e[a]=b,f.resolve([a,b])};return H(a,b,c,h).then(g,g),f.promise},i=0,j=a.length;j>i;i++)f.push(g(a[i]));return d.all(f).then(function(){return e})};return j(a)}var m=d.defer();a&&(a=J.apply(a));var n=function(){var a=e?G[e]:G[i];if(l=0,k&&!a){var b=f.get(v);if(a=G[b],g&&g.length){var c=I(g,b);l=0===c?1:0,I(g,e)<0&&g.push(e)}}return a}();if(n){var o=function(){ab(a,b,c,h).then(m.resolve,m.reject)};o.displayName="promiseResolved",n["finally"](o,m.reject)}else ab(a,b,c,h).then(m.resolve,m.reject);return m.promise},Q=function(a){return q&&(a=[q,a].join(" ")),r&&(a=[a,r].join(" ")),a},R=function(a){i=a,c.$emit("$translateChangeSuccess",{language:a}),k&&f.put(H.storageKey(),i),A.setLocale(i);var b=function(a,b){E[b].setLocale(i)};b.displayName="eachInterpolatorLocaleSetter",angular.forEach(E,b),c.$emit("$translateChangeEnd",{language:a})},S=function(a){if(!a)throw"No language key specified for loading.";var e=d.defer();c.$emit("$translateLoadingStart",{language:a}),D=!0;var f=s;"string"==typeof f&&(f=b.get(f));var g=angular.extend({},p,{key:a,$http:angular.extend({},{cache:f},p.$http)}),h=function(b){var d={};c.$emit("$translateLoadingSuccess",{language:a}),angular.isArray(b)?angular.forEach(b,function(a){angular.extend(d,M(a))}):angular.extend(d,M(b)),D=!1,e.resolve({key:a,table:d}),c.$emit("$translateLoadingEnd",{language:a})};h.displayName="onLoaderSuccess";var i=function(a){c.$emit("$translateLoadingError",{language:a}),e.reject(a),c.$emit("$translateLoadingEnd",{language:a})};return i.displayName="onLoaderError",b.get(o)(g).then(h,i),e.promise};if(k&&(f=b.get(k),!f.get||!f.put))throw new Error("Couldn't use storage '"+k+"', missing get() or put() method!");if(w.length){var T=function(a){var c=b.get(a);c.setLocale(e||i),E[c.getInterpolationIdentifier()]=c};T.displayName="interpolationFactoryAdder",angular.forEach(w,T)}var U=function(a){var b=d.defer();if(Object.prototype.hasOwnProperty.call(t,a))b.resolve(t[a]);else if(G[a]){var c=function(a){L(a.key,a.table),b.resolve(a.table)};c.displayName="translationTableResolver",G[a].then(c,b.reject)}else b.reject();return b.promise},V=function(a,b,c,e){var f=d.defer(),g=function(d){if(Object.prototype.hasOwnProperty.call(d,b)){e.setLocale(a);var g=d[b];"@:"===g.substr(0,2)?V(a,g.substr(2),c,e).then(f.resolve,f.reject):f.resolve(e.interpolate(d[b],c)),e.setLocale(i)}else f.reject()};return g.displayName="fallbackTranslationResolver",U(a).then(g,f.reject),f.promise},W=function(a,b,c,d){var e,f=t[a];if(f&&Object.prototype.hasOwnProperty.call(f,b)){if(d.setLocale(a),e=d.interpolate(f[b],c),"@:"===e.substr(0,2))return W(a,e.substr(2),c,d);d.setLocale(i)}return e},X=function(a,c){if(m){var d=b.get(m)(a,i,c);return void 0!==d?d:a}return a},Y=function(a,b,c,e,f){var h=d.defer();if(a<g.length){var i=g[a];V(i,b,c,e).then(h.resolve,function(){Y(a+1,b,c,e,f).then(h.resolve)})}else h.resolve(f?f:X(b,c));return h.promise},Z=function(a,b,c,d){var e;if(a<g.length){var f=g[a];e=W(f,b,c,d),e||(e=Z(a+1,b,c,d))}return e},$=function(a,b,c,d){return Y(u>0?u:l,a,b,c,d)},_=function(a,b,c){return Z(u>0?u:l,a,b,c)},ab=function(a,b,c,e){var f=d.defer(),h=i?t[i]:t,j=c?E[c]:A;if(h&&Object.prototype.hasOwnProperty.call(h,a)){var k=h[a];"@:"===k.substr(0,2)?H(k.substr(2),b,c,e).then(f.resolve,f.reject):f.resolve(j.interpolate(k,b))}else{var l;m&&!D&&(l=X(a,b)),i&&g&&g.length?$(a,b,j,e).then(function(a){f.resolve(a)},function(a){f.reject(Q(a))}):m&&!D&&l?f.resolve(e?e:l):e?f.resolve(e):f.reject(Q(a))}return f.promise},bb=function(a,b,c){var d,e=i?t[i]:t,f=A;if(E&&Object.prototype.hasOwnProperty.call(E,c)&&(f=E[c]),e&&Object.prototype.hasOwnProperty.call(e,a)){var h=e[a];d="@:"===h.substr(0,2)?bb(h.substr(2),b,c):f.interpolate(h,b)}else{var j;m&&!D&&(j=X(a,b)),i&&g&&g.length?(l=0,d=_(a,b,f)):d=m&&!D&&j?j:Q(a)}return d},cb=function(a){j===a&&(j=void 0),G[a]=void 0};if(H.preferredLanguage=function(a){return a&&N(a),e},H.cloakClassName=function(){return x},H.fallbackLanguage=function(a){if(void 0!==a&&null!==a){if(O(a),o&&g&&g.length)for(var b=0,c=g.length;c>b;b++)G[g[b]]||(G[g[b]]=S(g[b]));H.use(H.use())}return h?g[0]:g},H.useFallbackLanguage=function(a){if(void 0!==a&&null!==a)if(a){var b=I(g,a);b>-1&&(u=b)}else u=0},H.proposedLanguage=function(){return j},H.storage=function(){return f},H.use=function(a){if(!a)return i;var b=d.defer();c.$emit("$translateChangeStart",{language:a});var e=K(a);return e&&(a=e),!z&&t[a]||!o||G[a]?j===a&&G[a]?G[a].then(function(a){return b.resolve(a.key),a},function(a){return b.reject(a),d.reject(a)}):(b.resolve(a),R(a)):(j=a,G[a]=S(a).then(function(a){return L(a.key,a.table),b.resolve(a.key),R(a.key),a},function(a){return c.$emit("$translateChangeError",{language:a}),b.reject(a),c.$emit("$translateChangeEnd",{language:a}),d.reject(a)}),G[a]["finally"](function(){cb(a)})),b.promise},H.storageKey=function(){return P()},H.isPostCompilingEnabled=function(){return y},H.isForceAsyncReloadEnabled=function(){return z},H.refresh=function(a){function b(){f.resolve(),c.$emit("$translateRefreshEnd",{language:a})}function e(){f.reject(),c.$emit("$translateRefreshEnd",{language:a})}if(!o)throw new Error("Couldn't refresh translation table, no loader registered!");var f=d.defer();if(c.$emit("$translateRefreshStart",{language:a}),a)if(t[a]){var h=function(c){L(c.key,c.table),a===i&&R(i),b()};h.displayName="refreshPostProcessor",S(a).then(h,e)}else e();else{var j=[],k={};if(g&&g.length)for(var l=0,m=g.length;m>l;l++)j.push(S(g[l])),k[g[l]]=!0;i&&!k[i]&&j.push(S(i));var n=function(a){t={},angular.forEach(a,function(a){L(a.key,a.table)}),i&&R(i),b()};n.displayName="refreshPostProcessor",d.all(j).then(n,e)}return f.promise},H.instant=function(a,b,c){if(null===a||angular.isUndefined(a))return a;if(angular.isArray(a)){for(var d={},f=0,h=a.length;h>f;f++)d[a[f]]=H.instant(a[f],b,c);return d}if(angular.isString(a)&&a.length<1)return a;a&&(a=J.apply(a));var j,k=[];e&&k.push(e),i&&k.push(i),g&&g.length&&(k=k.concat(g));for(var l=0,n=k.length;n>l;l++){var o=k[l];if(t[o]&&("undefined"!=typeof t[o][a]?j=bb(a,b,c):(q||r)&&(j=Q(a))),"undefined"!=typeof j)break}return j||""===j||(j=A.interpolate(a,b),m&&!D&&(j=X(a,b))),j},H.versionInfo=function(){return F},H.loaderCache=function(){return s},H.directivePriority=function(){return B},H.statefulFilter=function(){return C},o&&(angular.equals(t,{})&&H.use(H.use()),g&&g.length))for(var db=function(a){return L(a.key,a.table),c.$emit("$translateChangeEnd",{language:a.key}),a},eb=0,fb=g.length;fb>eb;eb++){var gb=g[eb];(z||!t[gb])&&(G[gb]=S(gb).then(db))}return H}]}function d(a,b){"use strict";var c,d={},e="default";return d.setLocale=function(a){c=a},d.getInterpolationIdentifier=function(){return e},d.useSanitizeValueStrategy=function(a){return b.useStrategy(a),this},d.interpolate=function(c,d){d=d||{},d=b.sanitize(d,"params");var e=a(c)(d);return e=b.sanitize(e,"text")},d}function e(a,b,c,d,e,f){"use strict";var g=function(){return this.toString().replace(/^\s+|\s+$/g,"")};return{restrict:"AE",scope:!0,priority:a.directivePriority(),compile:function(b,h){var i=h.translateValues?h.translateValues:void 0,j=h.translateInterpolation?h.translateInterpolation:void 0,k=b[0].outerHTML.match(/translate-value-+/i),l="^(.*)("+c.startSymbol()+".*"+c.endSymbol()+")(.*)",m="^(.*)"+c.startSymbol()+"(.*)"+c.endSymbol()+"(.*)";return function(b,n,o){b.interpolateParams={},b.preText="",b.postText="";var p={},q=function(a,c,d){if(c.translateValues&&angular.extend(a,e(c.translateValues)(b.$parent)),k)for(var f in d)if(Object.prototype.hasOwnProperty.call(c,f)&&"translateValue"===f.substr(0,14)&&"translateValues"!==f){var g=angular.lowercase(f.substr(14,1))+f.substr(15);a[g]=d[f]}},r=function(a){if(angular.isFunction(r._unwatchOld)&&(r._unwatchOld(),r._unwatchOld=void 0),angular.equals(a,"")||!angular.isDefined(a)){var d=g.apply(n.text()).match(l);if(angular.isArray(d)){b.preText=d[1],b.postText=d[3],p.translate=c(d[2])(b.$parent);var e=n.text().match(m);angular.isArray(e)&&e[2]&&e[2].length&&(r._unwatchOld=b.$watch(e[2],function(a){p.translate=a,x()}))}else p.translate=n.text().replace(/^\s+|\s+$/g,"")}else p.translate=a;x()},s=function(a){o.$observe(a,function(b){p[a]=b,x()})};q(b.interpolateParams,o,h);var t=!0;o.$observe("translate",function(a){"undefined"==typeof a?r(""):""===a&&t||(p.translate=a,x()),t=!1});for(var u in o)o.hasOwnProperty(u)&&"translateAttr"===u.substr(0,13)&&s(u);if(o.$observe("translateDefault",function(a){b.defaultText=a}),i&&o.$observe("translateValues",function(a){a&&b.$parent.$watch(function(){angular.extend(b.interpolateParams,e(a)(b.$parent))})}),k){var v=function(a){o.$observe(a,function(c){var d=angular.lowercase(a.substr(14,1))+a.substr(15);b.interpolateParams[d]=c})};for(var w in o)Object.prototype.hasOwnProperty.call(o,w)&&"translateValue"===w.substr(0,14)&&"translateValues"!==w&&v(w)}var x=function(){for(var a in p)p.hasOwnProperty(a)&&void 0!==p[a]&&y(a,p[a],b,b.interpolateParams,b.defaultText)},y=function(b,c,d,e,f){c?a(c,e,j,f).then(function(a){z(a,d,!0,b)},function(a){z(a,d,!1,b)}):z(c,d,!1,b)},z=function(b,c,e,f){if("translate"===f){e||"undefined"==typeof c.defaultText||(b=c.defaultText),n.html(c.preText+b+c.postText);var g=a.isPostCompilingEnabled(),i="undefined"!=typeof h.translateCompile,j=i&&"false"!==h.translateCompile;(g&&!i||j)&&d(n.contents())(c)}else{e||"undefined"==typeof c.defaultText||(b=c.defaultText);var k=o.$attr[f];"data-"===k.substr(0,5)&&(k=k.substr(5)),k=k.substr(15),n.attr(k,b)}};(i||k||o.translateDefault)&&b.$watch("interpolateParams",x,!0);var A=f.$on("$translateChangeSuccess",x);n.text().length?r(o.translate?o.translate:""):o.translate&&r(o.translate),x(),b.$on("$destroy",A)}}}}function f(a,b){"use strict";return{compile:function(c){var d=function(){c.addClass(b.cloakClassName())},e=function(){c.removeClass(b.cloakClassName())},f=a.$on("$translateChangeEnd",function(){e(),f(),f=null});return d(),function(a,c,f){f.translateCloak&&f.translateCloak.length&&f.$observe("translateCloak",function(a){b(a).then(e,d)})}}}}function g(a,b){"use strict";var c=function(c,d,e){return angular.isObject(d)||(d=a(d)(this)),b.instant(c,d,e)};return b.statefulFilter()&&(c.$stateful=!0),c}function h(a){"use strict";return a("translations")}return angular.module("pascalprecht.translate",["ng"]).run(a),a.$inject=["$translate"],a.displayName="runTranslate",angular.module("pascalprecht.translate").provider("$translateSanitization",b),angular.module("pascalprecht.translate").constant("pascalprechtTranslateOverrider",{}).provider("$translate",c),c.$inject=["$STORAGE_KEY","$windowProvider","$translateSanitizationProvider","pascalprechtTranslateOverrider"],c.displayName="displayName",angular.module("pascalprecht.translate").factory("$translateDefaultInterpolation",d),d.$inject=["$interpolate","$translateSanitization"],d.displayName="$translateDefaultInterpolation",angular.module("pascalprecht.translate").constant("$STORAGE_KEY","NG_TRANSLATE_LANG_KEY"),angular.module("pascalprecht.translate").directive("translate",e),e.$inject=["$translate","$q","$interpolate","$compile","$parse","$rootScope"],e.displayName="translateDirective",angular.module("pascalprecht.translate").directive("translateCloak",f),f.$inject=["$rootScope","$translate"],f.displayName="translateCloakDirective",angular.module("pascalprecht.translate").filter("translate",g),g.$inject=["$parse","$translate"],g.displayName="translateFilterFactory",angular.module("pascalprecht.translate").factory("$translationCache",h),h.$inject=["$cacheFactory"],h.displayName="$translationCache","pascalprecht.translate"});