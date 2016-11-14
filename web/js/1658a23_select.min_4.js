/*!
 * ui-select
 * http://github.com/angular-ui/ui-select
 * Version: 0.12.1 - 2015-07-28T03:50:59.076Z
 * License: MIT
 */
!function(){"use strict";var e={TAB:9,ENTER:13,ESC:27,SPACE:32,LEFT:37,UP:38,RIGHT:39,DOWN:40,SHIFT:16,CTRL:17,ALT:18,PAGE_UP:33,PAGE_DOWN:34,HOME:36,END:35,BACKSPACE:8,DELETE:46,COMMAND:91,MAP:{91:"COMMAND",8:"BACKSPACE",9:"TAB",13:"ENTER",16:"SHIFT",17:"CTRL",18:"ALT",19:"PAUSEBREAK",20:"CAPSLOCK",27:"ESC",32:"SPACE",33:"PAGE_UP",34:"PAGE_DOWN",35:"END",36:"HOME",37:"LEFT",38:"UP",39:"RIGHT",40:"DOWN",43:"+",44:"PRINTSCREEN",45:"INSERT",46:"DELETE",48:"0",49:"1",50:"2",51:"3",52:"4",53:"5",54:"6",55:"7",56:"8",57:"9",59:";",61:"=",65:"A",66:"B",67:"C",68:"D",69:"E",70:"F",71:"G",72:"H",73:"I",74:"J",75:"K",76:"L",77:"M",78:"N",79:"O",80:"P",81:"Q",82:"R",83:"S",84:"T",85:"U",86:"V",87:"W",88:"X",89:"Y",90:"Z",96:"0",97:"1",98:"2",99:"3",100:"4",101:"5",102:"6",103:"7",104:"8",105:"9",106:"*",107:"+",109:"-",110:".",111:"/",112:"F1",113:"F2",114:"F3",115:"F4",116:"F5",117:"F6",118:"F7",119:"F8",120:"F9",121:"F10",122:"F11",123:"F12",144:"NUMLOCK",145:"SCROLLLOCK",186:";",187:"=",188:",",189:"-",190:".",191:"/",192:"`",219:"[",220:"\\",221:"]",222:"'"},isControl:function(t){var c=t.which;switch(c){case e.COMMAND:case e.SHIFT:case e.CTRL:case e.ALT:return!0}return t.metaKey?!0:!1},isFunctionKey:function(e){return e=e.which?e.which:e,e>=112&&123>=e},isVerticalMovement:function(t){return~[e.UP,e.DOWN].indexOf(t)},isHorizontalMovement:function(t){return~[e.LEFT,e.RIGHT,e.BACKSPACE,e.DELETE].indexOf(t)}};void 0===angular.element.prototype.querySelectorAll&&(angular.element.prototype.querySelectorAll=function(e){return angular.element(this[0].querySelectorAll(e))}),void 0===angular.element.prototype.closest&&(angular.element.prototype.closest=function(e){for(var t=this[0],c=t.matches||t.webkitMatchesSelector||t.mozMatchesSelector||t.msMatchesSelector;t;){if(c.bind(t)(e))return t;t=t.parentElement}return!1});var t=0,c=angular.module("ui.select",[]).constant("uiSelectConfig",{theme:"bootstrap",searchEnabled:!0,sortable:!1,placeholder:"",refreshDelay:1e3,closeOnSelect:!0,generateId:function(){return t++},appendToBody:!1}).service("uiSelectMinErr",function(){var e=angular.$$minErr("ui.select");return function(){var t=e.apply(this,arguments),c=t.message.replace(new RegExp("\nhttp://errors.angularjs.org/.*"),"");return new Error(c)}}).directive("uisTranscludeAppend",function(){return{link:function(e,t,c,i,l){l(e,function(e){t.append(e)})}}}).filter("highlight",function(){function e(e){return e.replace(/([.?*+^$[\]\\(){}|-])/g,"\\$1")}return function(t,c){return c&&t?t.replace(new RegExp(e(c),"gi"),'<span class="ui-select-highlight">$&</span>'):t}}).factory("uisOffset",["$document","$window",function(e,t){return function(c){var i=c[0].getBoundingClientRect();return{width:i.width||c.prop("offsetWidth"),height:i.height||c.prop("offsetHeight"),top:i.top+(t.pageYOffset||e[0].documentElement.scrollTop),left:i.left+(t.pageXOffset||e[0].documentElement.scrollLeft)}}}]);c.directive("uiSelectChoices",["uiSelectConfig","uisRepeatParser","uiSelectMinErr","$compile",function(e,t,c,i){return{restrict:"EA",require:"^uiSelect",replace:!0,transclude:!0,templateUrl:function(t){var c=t.parent().attr("theme")||e.theme;return c+"/choices.tpl.html"},compile:function(l,s){if(!s.repeat)throw c("repeat","Expected 'repeat' expression.");return function(l,s,n,a,r){var o=n.groupBy,u=n.groupFilter;if(a.parseRepeatAttr(n.repeat,o,u),a.disableChoiceExpression=n.uiDisableChoice,a.onHighlightCallback=n.onHighlight,o){var d=s.querySelectorAll(".ui-select-choices-group");if(1!==d.length)throw c("rows","Expected 1 .ui-select-choices-group but got '{0}'.",d.length);d.attr("ng-repeat",t.getGroupNgRepeatExpression())}var p=s.querySelectorAll(".ui-select-choices-row");if(1!==p.length)throw c("rows","Expected 1 .ui-select-choices-row but got '{0}'.",p.length);p.attr("ng-repeat",t.getNgRepeatExpression(a.parserResult.itemName,"$select.items",a.parserResult.trackByExp,o)).attr("ng-if","$select.open").attr("ng-mouseenter","$select.setActiveItem("+a.parserResult.itemName+")").attr("ng-click","$select.select("+a.parserResult.itemName+",false,$event)");var g=s.querySelectorAll(".ui-select-choices-row-inner");if(1!==g.length)throw c("rows","Expected 1 .ui-select-choices-row-inner but got '{0}'.",g.length);g.attr("uis-transclude-append",""),i(s,r)(l),l.$watch("$select.search",function(e){e&&!a.open&&a.multiple&&a.activate(!1,!0),a.activeIndex=a.tagging.isActivated?-1:0,a.refresh(n.refresh)}),n.$observe("refreshDelay",function(){var t=l.$eval(n.refreshDelay);a.refreshDelay=void 0!==t?t:e.refreshDelay})}}}}]),c.controller("uiSelectCtrl",["$scope","$element","$timeout","$filter","uisRepeatParser","uiSelectMinErr","uiSelectConfig",function(t,c,i,l,s,n,a){function r(){(p.resetSearchInput||void 0===p.resetSearchInput&&a.resetSearchInput)&&(p.search=g,p.selected&&p.items.length&&!p.multiple&&(p.activeIndex=p.items.indexOf(p.selected)))}function o(e,t){var c,i,l=[];for(c=0;c<t.length;c++)for(i=0;i<e.length;i++)e[i].name==[t[c]]&&l.push(e[i]);return l}function u(t){var c=!0;switch(t){case e.DOWN:!p.open&&p.multiple?p.activate(!1,!0):p.activeIndex<p.items.length-1&&p.activeIndex++;break;case e.UP:!p.open&&p.multiple?p.activate(!1,!0):(p.activeIndex>0||0===p.search.length&&p.tagging.isActivated&&p.activeIndex>-1)&&p.activeIndex--;break;case e.TAB:(!p.multiple||p.open)&&p.select(p.items[p.activeIndex],!0);break;case e.ENTER:p.open&&(p.tagging.isActivated||p.activeIndex>=0)?p.select(p.items[p.activeIndex]):p.activate(!1,!0);break;case e.ESC:p.close();break;default:c=!1}return c}function d(){var e=c.querySelectorAll(".ui-select-choices-content"),t=e.querySelectorAll(".ui-select-choices-row");if(t.length<1)throw n("choices","Expected multiple .ui-select-choices-row but got '{0}'.",t.length);if(!(p.activeIndex<0)){var i=t[p.activeIndex],l=i.offsetTop+i.clientHeight-e[0].scrollTop,s=e[0].offsetHeight;l>s?e[0].scrollTop+=l-s:l<i.clientHeight&&(p.isGrouped&&0===p.activeIndex?e[0].scrollTop=0:e[0].scrollTop-=i.clientHeight-l)}}var p=this,g="";if(p.placeholder=a.placeholder,p.searchEnabled=a.searchEnabled,p.sortable=a.sortable,p.refreshDelay=a.refreshDelay,p.removeSelected=!1,p.closeOnSelect=!0,p.search=g,p.activeIndex=0,p.items=[],p.open=!1,p.focus=!1,p.disabled=!1,p.selected=void 0,p.focusser=void 0,p.resetSearchInput=!0,p.multiple=void 0,p.disableChoiceExpression=void 0,p.tagging={isActivated:!1,fct:void 0},p.taggingTokens={isActivated:!1,tokens:void 0},p.lockChoiceExpression=void 0,p.clickTriggeredSelect=!1,p.$filter=l,p.searchInput=c.querySelectorAll("input.ui-select-search"),1!==p.searchInput.length)throw n("searchInput","Expected 1 input.ui-select-search but got '{0}'.",p.searchInput.length);p.isEmpty=function(){return angular.isUndefined(p.selected)||null===p.selected||""===p.selected},p.activate=function(e,c){p.disabled||p.open||(c||r(),t.$broadcast("uis:activate"),p.open=!0,p.activeIndex=p.activeIndex>=p.items.length?0:p.activeIndex,-1===p.activeIndex&&p.taggingLabel!==!1&&(p.activeIndex=0),i(function(){p.search=e||p.search,p.searchInput[0].focus()}))},p.findGroupByName=function(e){return p.groups&&p.groups.filter(function(t){return t.name===e})[0]},p.parseRepeatAttr=function(e,c,i){function l(e){var l=t.$eval(c);if(p.groups=[],angular.forEach(e,function(e){var t=angular.isFunction(l)?l(e):e[l],c=p.findGroupByName(t);c?c.items.push(e):p.groups.push({name:t,items:[e]})}),i){var s=t.$eval(i);angular.isFunction(s)?p.groups=s(p.groups):angular.isArray(s)&&(p.groups=o(p.groups,s))}p.items=[],p.groups.forEach(function(e){p.items=p.items.concat(e.items)})}function a(e){p.items=e}p.setItemsFn=c?l:a,p.parserResult=s.parse(e),p.isGrouped=!!c,p.itemProperty=p.parserResult.itemName,p.refreshItems=function(e){e=e||p.parserResult.source(t);var c=p.selected;if(angular.isArray(c)&&!c.length||!p.removeSelected)p.setItemsFn(e);else if(void 0!==e){var i=e.filter(function(e){return c.indexOf(e)<0});p.setItemsFn(i)}},t.$watchCollection(p.parserResult.source,function(e){if(void 0===e||null===e)p.items=[];else{if(!angular.isArray(e))throw n("items","Expected an array but got '{0}'.",e);p.refreshItems(e),p.ngModel.$modelValue=null}})};var h;p.refresh=function(e){void 0!==e&&(h&&i.cancel(h),h=i(function(){t.$eval(e)},p.refreshDelay))},p.setActiveItem=function(e){p.activeIndex=p.items.indexOf(e)},p.isActive=function(e){if(!p.open)return!1;var t=p.items.indexOf(e[p.itemProperty]),c=t===p.activeIndex;return!c||0>t&&p.taggingLabel!==!1||0>t&&p.taggingLabel===!1?!1:(c&&!angular.isUndefined(p.onHighlightCallback)&&e.$eval(p.onHighlightCallback),c)},p.isDisabled=function(e){if(p.open){var t,c=p.items.indexOf(e[p.itemProperty]),i=!1;return c>=0&&!angular.isUndefined(p.disableChoiceExpression)&&(t=p.items[c],i=!!e.$eval(p.disableChoiceExpression),t._uiSelectChoiceDisabled=i),i}},p.select=function(e,c,l){if(void 0===e||!e._uiSelectChoiceDisabled){if(!p.items&&!p.search)return;if(!e||!e._uiSelectChoiceDisabled){if(p.tagging.isActivated){if(p.taggingLabel===!1)if(p.activeIndex<0){if(e=void 0!==p.tagging.fct?p.tagging.fct(p.search):p.search,!e||angular.equals(p.items[0],e))return}else e=p.items[p.activeIndex];else if(0===p.activeIndex){if(void 0===e)return;if(void 0!==p.tagging.fct&&"string"==typeof e){if(e=p.tagging.fct(p.search),!e)return}else"string"==typeof e&&(e=e.replace(p.taggingLabel,"").trim())}if(p.selected&&angular.isArray(p.selected)&&p.selected.filter(function(t){return angular.equals(t,e)}).length>0)return p.close(c),void 0}t.$broadcast("uis:select",e);var s={};s[p.parserResult.itemName]=e,i(function(){p.onSelectCallback(t,{$item:e,$model:p.parserResult.modelMapper(t,s)})}),p.closeOnSelect&&p.close(c),l&&"click"===l.type&&(p.clickTriggeredSelect=!0)}}},p.close=function(e){p.open&&(p.ngModel&&p.ngModel.$setTouched&&p.ngModel.$setTouched(),r(),p.open=!1,t.$broadcast("uis:close",e))},p.setFocus=function(){p.focus||p.focusInput[0].focus()},p.clear=function(e){p.select(void 0),e.stopPropagation(),i(function(){p.focusser[0].focus()},0,!1)},p.toggle=function(e){p.open?(p.close(),e.preventDefault(),e.stopPropagation()):p.activate()},p.isLocked=function(e,t){var c,i=p.selected[t];return i&&!angular.isUndefined(p.lockChoiceExpression)&&(c=!!e.$eval(p.lockChoiceExpression),i._uiSelectChoiceLocked=c),c};var f=null;p.sizeSearchInput=function(){var e=p.searchInput[0],c=p.searchInput.parent().parent()[0],l=function(){return c.clientWidth*!!e.offsetParent},s=function(t){if(0===t)return!1;var c=t-e.offsetLeft-10;return 50>c&&(c=t),p.searchInput.css("width",c+"px"),!0};p.searchInput.css("width","10px"),i(function(){null!==f||s(l())||(f=t.$watch(l,function(e){s(e)&&(f(),f=null)}))})},p.searchInput.on("keydown",function(c){var l=c.which;t.$apply(function(){var t=!1;if((p.items.length>0||p.tagging.isActivated)&&(u(l),p.taggingTokens.isActivated)){for(var s=0;s<p.taggingTokens.tokens.length;s++)p.taggingTokens.tokens[s]===e.MAP[c.keyCode]&&p.search.length>0&&(t=!0);t&&i(function(){p.searchInput.triggerHandler("tagged");var t=p.search.replace(e.MAP[c.keyCode],"").trim();p.tagging.fct&&(t=p.tagging.fct(t)),t&&p.select(t,!0)})}}),e.isVerticalMovement(l)&&p.items.length>0&&d(),(l===e.ENTER||l===e.ESC)&&(c.preventDefault(),c.stopPropagation())}),p.searchInput.on("paste",function(e){var t=e.originalEvent.clipboardData.getData("text/plain");if(t&&t.length>0&&p.taggingTokens.isActivated&&p.tagging.fct){var c=t.split(p.taggingTokens.tokens[0]);c&&c.length>0&&(angular.forEach(c,function(e){var t=p.tagging.fct(e);t&&p.select(t,!0)}),e.preventDefault(),e.stopPropagation())}}),p.searchInput.on("tagged",function(){i(function(){r()})}),t.$on("$destroy",function(){p.searchInput.off("keyup keydown tagged blur paste")})}]),c.directive("uiSelect",["$document","uiSelectConfig","uiSelectMinErr","uisOffset","$compile","$parse","$timeout",function(e,t,c,i,l,s,n){return{restrict:"EA",templateUrl:function(e,c){var i=c.theme||t.theme;return i+(angular.isDefined(c.multiple)?"/select-multiple.tpl.html":"/select.tpl.html")},replace:!0,transclude:!0,require:["uiSelect","^ngModel"],scope:!0,controller:"uiSelectCtrl",controllerAs:"$select",compile:function(l,a){return angular.isDefined(a.multiple)?l.append("<ui-select-multiple/>").removeAttr("multiple"):l.append("<ui-select-single/>"),function(l,a,r,o,u){function d(e){if(h.open){var t=!1;if(t=window.jQuery?window.jQuery.contains(a[0],e.target):a[0].contains(e.target),!t&&!h.clickTriggeredSelect){var c=["input","button","textarea"],i=angular.element(e.target).scope(),s=i&&i.$select&&i.$select!==h;s||(s=~c.indexOf(e.target.tagName.toLowerCase())),h.close(s),l.$digest()}h.clickTriggeredSelect=!1}}function p(){var t=i(a);m=angular.element('<div class="ui-select-placeholder"></div>'),m[0].style.width=t.width+"px",m[0].style.height=t.height+"px",a.after(m),$=a[0].style.width,e.find("body").append(a),a[0].style.position="absolute",a[0].style.left=t.left+"px",a[0].style.top=t.top+"px",a[0].style.width=t.width+"px"}function g(){null!==m&&(m.replaceWith(a),m=null,a[0].style.position="",a[0].style.left="",a[0].style.top="",a[0].style.width=$)}var h=o[0],f=o[1];h.generatedId=t.generateId(),h.baseTitle=r.title||"Select box",h.focusserTitle=h.baseTitle+" focus",h.focusserId="focusser-"+h.generatedId,h.closeOnSelect=function(){return angular.isDefined(r.closeOnSelect)?s(r.closeOnSelect)():t.closeOnSelect}(),h.onSelectCallback=s(r.onSelect),h.onRemoveCallback=s(r.onRemove),h.ngModel=f,h.choiceGrouped=function(e){return h.isGrouped&&e&&e.name},r.tabindex&&r.$observe("tabindex",function(e){h.focusInput.attr("tabindex",e),a.removeAttr("tabindex")}),l.$watch("searchEnabled",function(){var e=l.$eval(r.searchEnabled);h.searchEnabled=void 0!==e?e:t.searchEnabled}),l.$watch("sortable",function(){var e=l.$eval(r.sortable);h.sortable=void 0!==e?e:t.sortable}),r.$observe("disabled",function(){h.disabled=void 0!==r.disabled?r.disabled:!1}),r.$observe("resetSearchInput",function(){var e=l.$eval(r.resetSearchInput);h.resetSearchInput=void 0!==e?e:!0}),r.$observe("tagging",function(){if(void 0!==r.tagging){var e=l.$eval(r.tagging);h.tagging={isActivated:!0,fct:e!==!0?e:void 0}}else h.tagging={isActivated:!1,fct:void 0}}),r.$observe("taggingLabel",function(){void 0!==r.tagging&&(h.taggingLabel="false"===r.taggingLabel?!1:void 0!==r.taggingLabel?r.taggingLabel:"(new)")}),r.$observe("taggingTokens",function(){if(void 0!==r.tagging){var e=void 0!==r.taggingTokens?r.taggingTokens.split("|"):[",","ENTER"];h.taggingTokens={isActivated:!0,tokens:e}}}),angular.isDefined(r.autofocus)&&n(function(){h.setFocus()}),angular.isDefined(r.focusOn)&&l.$on(r.focusOn,function(){n(function(){h.setFocus()})}),e.on("click",d),l.$on("$destroy",function(){e.off("click",d)}),u(l,function(e){var t=angular.element("<div>").append(e),i=t.querySelectorAll(".ui-select-match");if(i.removeAttr("ui-select-match"),i.removeAttr("data-ui-select-match"),1!==i.length)throw c("transcluded","Expected 1 .ui-select-match but got '{0}'.",i.length);a.querySelectorAll(".ui-select-match").replaceWith(i);var l=t.querySelectorAll(".ui-select-choices");if(l.removeAttr("ui-select-choices"),l.removeAttr("data-ui-select-choices"),1!==l.length)throw c("transcluded","Expected 1 .ui-select-choices but got '{0}'.",l.length);a.querySelectorAll(".ui-select-choices").replaceWith(l)});var v=l.$eval(r.appendToBody);(void 0!==v?v:t.appendToBody)&&(l.$watch("$select.open",function(e){e?p():g()}),l.$on("$destroy",function(){g()}));var m=null,$="",b=null,x="direction-up";l.$watch("$select.open",function(t){if(t){if(b=angular.element(a).querySelectorAll(".ui-select-dropdown"),null===b)return;b[0].style.opacity=0,n(function(){var t=i(a),c=i(b);t.top+t.height+c.height>e[0].documentElement.scrollTop+e[0].documentElement.clientHeight&&(b[0].style.position="absolute",b[0].style.top=-1*c.height+"px",a.addClass(x)),b[0].style.opacity=1})}else{if(null===b)return;b[0].style.position="",b[0].style.top="",a.removeClass(x)}})}}}}]),c.directive("uiSelectMatch",["uiSelectConfig",function(e){return{restrict:"EA",require:"^uiSelect",replace:!0,transclude:!0,templateUrl:function(t){var c=t.parent().attr("theme")||e.theme,i=t.parent().attr("multiple");return c+(i?"/match-multiple.tpl.html":"/match.tpl.html")},link:function(t,c,i,l){function s(e){l.allowClear=angular.isDefined(e)?""===e?!0:"true"===e.toLowerCase():!1}l.lockChoiceExpression=i.uiLockChoice,i.$observe("placeholder",function(t){l.placeholder=void 0!==t?t:e.placeholder}),i.$observe("allowClear",s),s(i.allowClear),l.multiple&&l.sizeSearchInput()}}}]),c.directive("uiSelectMultiple",["uiSelectMinErr","$timeout",function(t,c){return{restrict:"EA",require:["^uiSelect","^ngModel"],controller:["$scope","$timeout",function(e,t){var c,i=this,l=e.$select;e.$evalAsync(function(){c=e.ngModel}),i.activeMatchIndex=-1,i.updateModel=function(){c.$setViewValue(Date.now()),i.refreshComponent()},i.refreshComponent=function(){l.refreshItems(),l.sizeSearchInput()},i.removeChoice=function(c){var s=l.selected[c];if(!s._uiSelectChoiceLocked){var n={};n[l.parserResult.itemName]=s,l.selected.splice(c,1),i.activeMatchIndex=-1,l.sizeSearchInput(),t(function(){l.onRemoveCallback(e,{$item:s,$model:l.parserResult.modelMapper(e,n)})}),i.updateModel()}},i.getPlaceholder=function(){return l.selected.length?void 0:l.placeholder}}],controllerAs:"$selectMultiple",link:function(i,l,s,n){function a(e){return angular.isNumber(e.selectionStart)?e.selectionStart:e.value.length}function r(t){function c(){switch(t){case e.LEFT:return~g.activeMatchIndex?u:n;case e.RIGHT:return~g.activeMatchIndex&&r!==n?o:(d.activate(),!1);case e.BACKSPACE:return~g.activeMatchIndex?(g.removeChoice(r),u):n;case e.DELETE:return~g.activeMatchIndex?(g.removeChoice(g.activeMatchIndex),r):!1}}var i=a(d.searchInput[0]),l=d.selected.length,s=0,n=l-1,r=g.activeMatchIndex,o=g.activeMatchIndex+1,u=g.activeMatchIndex-1,p=r;return i>0||d.search.length&&t==e.RIGHT?!1:(d.close(),p=c(),g.activeMatchIndex=d.selected.length&&p!==!1?Math.min(n,Math.max(s,p)):-1,!0)}function o(e){if(void 0===e||void 0===d.search)return!1;var t=e.filter(function(e){return void 0===d.search.toUpperCase()||void 0===e?!1:e.toUpperCase()===d.search.toUpperCase()}).length>0;return t}function u(e,t){var c=-1;if(angular.isArray(e))for(var i=angular.copy(e),l=0;l<i.length;l++)if(void 0===d.tagging.fct)i[l]+" "+d.taggingLabel===t&&(c=l);else{var s=i[l];s.isTag=!0,angular.equals(s,t)&&(c=l)}return c}var d=n[0],p=i.ngModel=n[1],g=i.$selectMultiple;d.multiple=!0,d.removeSelected=!0,d.focusInput=d.searchInput,p.$parsers.unshift(function(){for(var e,t={},c=[],l=d.selected.length-1;l>=0;l--)t={},t[d.parserResult.itemName]=d.selected[l],e=d.parserResult.modelMapper(i,t),c.unshift(e);return c}),p.$formatters.unshift(function(e){var t,c=d.parserResult.source(i,{$select:{search:""}}),l={};if(!c)return e;var s=[],n=function(e,c){if(e&&e.length){for(var n=e.length-1;n>=0;n--){if(l[d.parserResult.itemName]=e[n],t=d.parserResult.modelMapper(i,l),d.parserResult.trackByExp){var a=/\.(.+)/.exec(d.parserResult.trackByExp);if(a.length>0&&t[a[1]]==c[a[1]])return s.unshift(e[n]),!0}if(angular.equals(t,c))return s.unshift(e[n]),!0}return!1}};if(!e)return s;for(var a=e.length-1;a>=0;a--)n(d.selected,e[a])||n(c,e[a])||s.unshift(e[a]);return s}),i.$watchCollection(function(){return p.$modelValue},function(e,t){t!=e&&(p.$modelValue=null,g.refreshComponent())}),p.$render=function(){if(!angular.isArray(p.$viewValue)){if(!angular.isUndefined(p.$viewValue)&&null!==p.$viewValue)throw t("multiarr","Expected model value to be array but got '{0}'",p.$viewValue);d.selected=[]}d.selected=p.$viewValue,i.$evalAsync()},i.$on("uis:select",function(e,t){d.selected.push(t),g.updateModel()}),i.$on("uis:activate",function(){g.activeMatchIndex=-1}),i.$watch("$select.disabled",function(e,t){t&&!e&&d.sizeSearchInput()}),d.searchInput.on("keydown",function(t){var c=t.which;i.$apply(function(){var i=!1;e.isHorizontalMovement(c)&&(i=r(c)),i&&c!=e.TAB&&(t.preventDefault(),t.stopPropagation())})}),d.searchInput.on("keyup",function(t){if(e.isVerticalMovement(t.which)||i.$evalAsync(function(){d.activeIndex=d.taggingLabel===!1?-1:0}),d.tagging.isActivated&&d.search.length>0){if(t.which===e.TAB||e.isControl(t)||e.isFunctionKey(t)||t.which===e.ESC||e.isVerticalMovement(t.which))return;if(d.activeIndex=d.taggingLabel===!1?-1:0,d.taggingLabel===!1)return;var c,l,s,n,a=angular.copy(d.items),r=angular.copy(d.items),p=!1,g=-1;if(void 0!==d.tagging.fct){if(s=d.$filter("filter")(a,{isTag:!0}),s.length>0&&(n=s[0]),a.length>0&&n&&(p=!0,a=a.slice(1,a.length),r=r.slice(1,r.length)),c=d.tagging.fct(d.search),c.isTag=!0,r.filter(function(e){return angular.equals(e,d.tagging.fct(d.search))}).length>0)return;c.isTag=!0}else{if(s=d.$filter("filter")(a,function(e){return e.match(d.taggingLabel)}),s.length>0&&(n=s[0]),l=a[0],void 0!==l&&a.length>0&&n&&(p=!0,a=a.slice(1,a.length),r=r.slice(1,r.length)),c=d.search+" "+d.taggingLabel,u(d.selected,d.search)>-1)return;if(o(r.concat(d.selected)))return p&&(a=r,i.$evalAsync(function(){d.activeIndex=0,d.items=a})),void 0;if(o(r))return p&&(d.items=r.slice(1,r.length)),void 0}p&&(g=u(d.selected,c)),g>-1?a=a.slice(g+1,a.length-1):(a=[],a.push(c),a=a.concat(r)),i.$evalAsync(function(){d.activeIndex=0,d.items=a})}}),d.searchInput.on("blur",function(){c(function(){g.activeMatchIndex=-1})})}}}]),c.directive("uiSelectSingle",["$timeout","$compile",function(t,c){return{restrict:"EA",require:["^uiSelect","^ngModel"],link:function(i,l,s,n){var a=n[0],r=n[1];r.$parsers.unshift(function(e){var t,c={};return c[a.parserResult.itemName]=e,t=a.parserResult.modelMapper(i,c)}),r.$formatters.unshift(function(e){var t,c=a.parserResult.source(i,{$select:{search:""}}),l={};if(c){var s=function(c){return l[a.parserResult.itemName]=c,t=a.parserResult.modelMapper(i,l),t==e};if(a.selected&&s(a.selected))return a.selected;for(var n=c.length-1;n>=0;n--)if(s(c[n]))return c[n]}return e}),i.$watch("$select.selected",function(e){r.$viewValue!==e&&r.$setViewValue(e)}),r.$render=function(){a.selected=r.$viewValue},i.$on("uis:select",function(e,t){a.selected=t}),i.$on("uis:close",function(e,c){t(function(){a.focusser.prop("disabled",!1),c||a.focusser[0].focus()},0,!1)}),i.$on("uis:activate",function(){o.prop("disabled",!0)});var o=angular.element("<input ng-disabled='$select.disabled' class='ui-select-focusser ui-select-offscreen' type='text' id='{{ $select.focusserId }}' aria-label='{{ $select.focusserTitle }}' aria-haspopup='true' role='button' />");c(o)(i),a.focusser=o,a.focusInput=o,l.parent().append(o),o.bind("focus",function(){i.$evalAsync(function(){a.focus=!0})}),o.bind("blur",function(){i.$evalAsync(function(){a.focus=!1})}),o.bind("keydown",function(t){return t.which===e.BACKSPACE?(t.preventDefault(),t.stopPropagation(),a.select(void 0),i.$apply(),void 0):(t.which===e.TAB||e.isControl(t)||e.isFunctionKey(t)||t.which===e.ESC||((t.which==e.DOWN||t.which==e.UP||t.which==e.ENTER||t.which==e.SPACE)&&(t.preventDefault(),t.stopPropagation(),a.activate()),i.$digest()),void 0)}),o.bind("keyup input",function(t){t.which===e.TAB||e.isControl(t)||e.isFunctionKey(t)||t.which===e.ESC||t.which==e.ENTER||t.which===e.BACKSPACE||(a.activate(o.val()),o.val(""),i.$digest())})}}}]),c.directive("uiSelectSort",["$timeout","uiSelectConfig","uiSelectMinErr",function(e,t,c){return{require:"^uiSelect",link:function(t,i,l,s){if(null===t[l.uiSelectSort])throw c("sort","Expected a list to sort");var n=angular.extend({axis:"horizontal"},t.$eval(l.uiSelectSortOptions)),a=n.axis,r="dragging",o="dropping",u="dropping-before",d="dropping-after";t.$watch(function(){return s.sortable},function(e){e?i.attr("draggable",!0):i.removeAttr("draggable")}),i.on("dragstart",function(e){i.addClass(r),(e.dataTransfer||e.originalEvent.dataTransfer).setData("text/plain",t.$index)}),i.on("dragend",function(){i.removeClass(r)});var p,g=function(e,t){this.splice(t,0,this.splice(e,1)[0])},h=function(e){e.preventDefault();var t="vertical"===a?e.offsetY||e.layerY||(e.originalEvent?e.originalEvent.offsetY:0):e.offsetX||e.layerX||(e.originalEvent?e.originalEvent.offsetX:0);t<this["vertical"===a?"offsetHeight":"offsetWidth"]/2?(i.removeClass(d),i.addClass(u)):(i.removeClass(u),i.addClass(d))},f=function(t){t.preventDefault();var c=parseInt((t.dataTransfer||t.originalEvent.dataTransfer).getData("text/plain"),10);e.cancel(p),p=e(function(){v(c)},20)},v=function(e){var c=t.$eval(l.uiSelectSort),s=c[e],n=null;n=i.hasClass(u)?e<t.$index?t.$index-1:t.$index:e<t.$index?t.$index:t.$index+1,g.apply(c,[e,n]),t.$apply(function(){t.$emit("uiSelectSort:change",{array:c,item:s,from:e,to:n})}),i.removeClass(o),i.removeClass(u),i.removeClass(d),i.off("drop",f)};i.on("dragenter",function(){i.hasClass(r)||(i.addClass(o),i.on("dragover",h),i.on("drop",f))}),i.on("dragleave",function(e){e.target==i&&(i.removeClass(o),i.removeClass(u),i.removeClass(d),i.off("dragover",h),i.off("drop",f))})}}}]),c.service("uisRepeatParser",["uiSelectMinErr","$parse",function(e,t){var c=this;c.parse=function(c){var i=c.match(/^\s*(?:([\s\S]+?)\s+as\s+)?([\S]+?)\s+in\s+([\s\S]+?)(?:\s+track\s+by\s+([\s\S]+?))?\s*$/);if(!i)throw e("iexp","Expected expression in form of '_item_ in _collection_[ track by _id_]' but got '{0}'.",c);return{itemName:i[2],source:t(i[3]),trackByExp:i[4],modelMapper:t(i[1]||i[2])}},c.getGroupNgRepeatExpression=function(){return"$group in $select.groups"},c.getNgRepeatExpression=function(e,t,c,i){var l=e+" in "+(i?"$group.items":t);return c&&(l+=" track by "+c),l}}])}(),angular.module("ui.select").run(["$templateCache",function(e){e.put("bootstrap/choices.tpl.html",'<ul class="ui-select-choices ui-select-choices-content ui-select-dropdown dropdown-menu" role="listbox" ng-show="$select.items.length > 0"><li class="ui-select-choices-group" id="ui-select-choices-{{ $select.generatedId }}"><div class="divider" ng-show="$select.isGrouped && $index > 0"></div><div ng-show="$select.isGrouped" class="ui-select-choices-group-label dropdown-header" ng-bind="$group.name"></div><div id="ui-select-choices-row-{{ $select.generatedId }}-{{$index}}" class="ui-select-choices-row" ng-class="{active: $select.isActive(this), disabled: $select.isDisabled(this)}" role="option"><a href="javascript:void(0)" class="ui-select-choices-row-inner"></a></div></li></ul>'),e.put("bootstrap/match-multiple.tpl.html",'<span class="ui-select-match"><span ng-repeat="$item in $select.selected"><span class="ui-select-match-item btn btn-default btn-xs" tabindex="-1" type="button" ng-disabled="$select.disabled" ng-click="$selectMultiple.activeMatchIndex = $index;" ng-class="{\'btn-primary\':$selectMultiple.activeMatchIndex === $index, \'select-locked\':$select.isLocked(this, $index)}" ui-select-sort="$select.selected"><span class="close ui-select-match-close" ng-hide="$select.disabled" ng-click="$selectMultiple.removeChoice($index)">&nbsp;&times;</span> <span uis-transclude-append=""></span></span></span></span>'),e.put("bootstrap/match.tpl.html",'<div class="ui-select-match" ng-hide="$select.open" ng-disabled="$select.disabled" ng-class="{\'btn-default-focus\':$select.focus}"><span tabindex="-1" class="btn btn-default form-control ui-select-toggle" aria-label="{{ $select.baseTitle }} activate" ng-disabled="$select.disabled" ng-click="$select.activate()" style="outline: 0;"><span ng-show="$select.isEmpty()" class="ui-select-placeholder text-muted">{{$select.placeholder}}</span> <span ng-hide="$select.isEmpty()" class="ui-select-match-text pull-left" ng-class="{\'ui-select-allow-clear\': $select.allowClear && !$select.isEmpty()}" ng-transclude=""></span> <i class="caret pull-right" ng-click="$select.toggle($event)"></i> <a ng-show="$select.allowClear && !$select.isEmpty()" aria-label="{{ $select.baseTitle }} clear" style="margin-right: 10px" ng-click="$select.clear($event)" class="btn btn-xs btn-link pull-right"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a></span></div>'),e.put("bootstrap/select-multiple.tpl.html",'<div class="ui-select-container ui-select-multiple ui-select-bootstrap dropdown form-control" ng-class="{open: $select.open}"><div><div class="ui-select-match"></div><input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="ui-select-search input-xs" placeholder="{{$selectMultiple.getPlaceholder()}}" ng-disabled="$select.disabled" ng-hide="$select.disabled" ng-click="$select.activate()" ng-model="$select.search" role="combobox" aria-label="{{ $select.baseTitle }}" ondrop="return false;"></div><div class="ui-select-choices"></div></div>'),e.put("bootstrap/select.tpl.html",'<div class="ui-select-container ui-select-bootstrap dropdown" ng-class="{open: $select.open}"><div class="ui-select-match"></div><input type="text" autocomplete="off" tabindex="-1" aria-expanded="true" aria-label="{{ $select.baseTitle }}" aria-owns="ui-select-choices-{{ $select.generatedId }}" aria-activedescendant="ui-select-choices-row-{{ $select.generatedId }}-{{ $select.activeIndex }}" class="form-control ui-select-search" placeholder="{{$select.placeholder}}" ng-model="$select.search" ng-show="$select.searchEnabled && $select.open"><div class="ui-select-choices"></div></div>'),e.put("select2/choices.tpl.html",'<ul class="ui-select-choices ui-select-choices-content select2-results"><li class="ui-select-choices-group" ng-class="{\'select2-result-with-children\': $select.choiceGrouped($group) }"><div ng-show="$select.choiceGrouped($group)" class="ui-select-choices-group-label select2-result-label" ng-bind="$group.name"></div><ul role="listbox" id="ui-select-choices-{{ $select.generatedId }}" ng-class="{\'select2-result-sub\': $select.choiceGrouped($group), \'select2-result-single\': !$select.choiceGrouped($group) }"><li role="option" id="ui-select-choices-row-{{ $select.generatedId }}-{{$index}}" class="ui-select-choices-row" ng-class="{\'select2-highlighted\': $select.isActive(this), \'select2-disabled\': $select.isDisabled(this)}"><div class="select2-result-label ui-select-choices-row-inner"></div></li></ul></li></ul>'),e.put("select2/match-multiple.tpl.html",'<span class="ui-select-match"><li class="ui-select-match-item select2-search-choice" ng-repeat="$item in $select.selected" ng-class="{\'select2-search-choice-focus\':$selectMultiple.activeMatchIndex === $index, \'select2-locked\':$select.isLocked(this, $index)}" ui-select-sort="$select.selected"><span uis-transclude-append=""></span> <a href="javascript:;" class="ui-select-match-close select2-search-choice-close" ng-click="$selectMultiple.removeChoice($index)" tabindex="-1"></a></li></span>'),e.put("select2/match.tpl.html",'<a class="select2-choice ui-select-match" ng-class="{\'select2-default\': $select.isEmpty()}" ng-click="$select.toggle($event)" aria-label="{{ $select.baseTitle }} select"><span ng-show="$select.isEmpty()" class="select2-chosen">{{$select.placeholder}}</span> <span ng-hide="$select.isEmpty()" class="select2-chosen" ng-transclude=""></span> <abbr ng-if="$select.allowClear && !$select.isEmpty()" class="select2-search-choice-close" ng-click="$select.clear($event)"></abbr> <span class="select2-arrow ui-select-toggle"><b></b></span></a>'),e.put("select2/select-multiple.tpl.html",'<div class="ui-select-container ui-select-multiple select2 select2-container select2-container-multi" ng-class="{\'select2-container-active select2-dropdown-open open\': $select.open, \'select2-container-disabled\': $select.disabled}"><ul class="select2-choices"><span class="ui-select-match"></span><li class="select2-search-field"><input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="combobox" aria-expanded="true" aria-owns="ui-select-choices-{{ $select.generatedId }}" aria-label="{{ $select.baseTitle }}" aria-activedescendant="ui-select-choices-row-{{ $select.generatedId }}-{{ $select.activeIndex }}" class="select2-input ui-select-search" placeholder="{{$selectMultiple.getPlaceholder()}}" ng-disabled="$select.disabled" ng-hide="$select.disabled" ng-model="$select.search" ng-click="$select.activate()" style="width: 34px;" ondrop="return false;"></li></ul><div class="ui-select-dropdown select2-drop select2-with-searchbox select2-drop-active" ng-class="{\'select2-display-none\': !$select.open}"><div class="ui-select-choices"></div></div></div>'),e.put("select2/select.tpl.html",'<div class="ui-select-container select2 select2-container" ng-class="{\'select2-container-active select2-dropdown-open open\': $select.open, \'select2-container-disabled\': $select.disabled, \'select2-container-active\': $select.focus, \'select2-allowclear\': $select.allowClear && !$select.isEmpty()}"><div class="ui-select-match"></div><div class="ui-select-dropdown select2-drop select2-with-searchbox select2-drop-active" ng-class="{\'select2-display-none\': !$select.open}"><div class="select2-search" ng-show="$select.searchEnabled"><input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="combobox" aria-expanded="true" aria-owns="ui-select-choices-{{ $select.generatedId }}" aria-label="{{ $select.baseTitle }}" aria-activedescendant="ui-select-choices-row-{{ $select.generatedId }}-{{ $select.activeIndex }}" class="ui-select-search select2-input" ng-model="$select.search"></div><div class="ui-select-choices"></div></div></div>'),e.put("selectize/choices.tpl.html",'<div ng-show="$select.open" class="ui-select-choices ui-select-dropdown selectize-dropdown single"><div class="ui-select-choices-content selectize-dropdown-content"><div class="ui-select-choices-group optgroup" role="listbox"><div ng-show="$select.isGrouped" class="ui-select-choices-group-label optgroup-header" ng-bind="$group.name"></div><div role="option" class="ui-select-choices-row" ng-class="{active: $select.isActive(this), disabled: $select.isDisabled(this)}"><div class="option ui-select-choices-row-inner" data-selectable=""></div></div></div></div></div>'),e.put("selectize/match.tpl.html",'<div ng-hide="($select.open || $select.isEmpty())" class="ui-select-match" ng-transclude=""></div>'),e.put("selectize/select.tpl.html",'<div class="ui-select-container selectize-control single" ng-class="{\'open\': $select.open}"><div class="selectize-input" ng-class="{\'focus\': $select.open, \'disabled\': $select.disabled, \'selectize-focus\' : $select.focus}" ng-click="$select.activate()"><div class="ui-select-match"></div><input type="text" autocomplete="off" tabindex="-1" class="ui-select-search ui-select-toggle" ng-click="$select.toggle($event)" placeholder="{{$select.placeholder}}" ng-model="$select.search" ng-hide="!$select.searchEnabled || ($select.selected && !$select.open)" ng-disabled="$select.disabled" aria-label="{{ $select.baseTitle }}"></div><div class="ui-select-choices"></div></div>')
}]);