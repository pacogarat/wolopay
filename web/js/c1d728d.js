!function(a,b){"function"==typeof define&&define.amd?define(["angular"],b):b(angular)}(this,function(a){function b(a){return{restrict:"A",require:["ckeditor","ngModel"],controller:["$scope","$element","$attrs","$parse","$q",c],link:function(b,c,e,f){var g=f[0],h=f[1];g.ready().then(function(){["dataReady","change","blur","saveSnapshot"].forEach(function(a){g.$on(a,function(){h.$setViewValue(g.instance.getData()||"")})}),g.instance.setReadOnly(!!e.readonly),e.$observe("readonly",function(a){g.instance.setReadOnly(!!a)}),d(function(){a(e.ready)(b)})}),h.$render=function(){g.ready().then(function(){g.instance.setData(h.$viewValue||"")})}}}}function c(a,b,c,e,f){var g,h=e(c.ckeditor)(a)||{},i=b[0];g=this.instance=i.hasAttribute("contenteditable")&&"true"==i.getAttribute("contenteditable").toLowerCase()?CKEDITOR.inline(i,h):CKEDITOR.replace(i,h),this.$on=function(b,c){function e(){var a=arguments;d(function(){f.apply(null,a)})}function f(){var b=arguments;a.$apply(function(){c.apply(null,b)})}return g.on(b,e),function(){g.removeListener(b,f)}},this.ready=function(){if(this.readyDefer)return this.readyDefer.promise;var a=this.readyDefer=f.defer();return"ready"===this.instance.status?a.resolve():this.$on("instanceReady",a.resolve),a.promise},a.$on("$destroy",function(){g.destroy(!1)})}a.module("ckeditor",[]).directive("ckeditor",["$parse",b]);var d=window&&window.setImmediate?window.setImmediate:function(a){setTimeout(a,0)}});
//# sourceMappingURL=angular-ckeditor.min.map
(function(e,n){"use strict";var t=6,o=4,i="asc",r="desc",l="_ng_field_",a="_ng_depth_",s="_ng_hidden_",c="_ng_column_",g=/CUSTOM_FILTERS/g,d=/COL_FIELD/g,u=/DISPLAY_CELL_TEMPLATE/g,f=/EDITABLE_CELL_TEMPLATE/g,h=/CELL_EDITABLE_CONDITION/g,p=/<.+>/,m=/(\([^)]*\))?$/,v=/\./g,w=/'/g,C=/^(.*)((?:\s*\[\s*\d+\s*\]\s*)|(?:\s*\[\s*"(?:[^"\\]|\\.)*"\s*\]\s*)|(?:\s*\[\s*'(?:[^'\\]|\\.)*'\s*\]\s*))(.*)$/;e.ngGrid={},e.ngGrid.i18n={},angular.module("ngGrid.services",[]);var b=angular.module("ngGrid.directives",[]),y=angular.module("ngGrid.filters",[]);angular.module("ngGrid",["ngGrid.services","ngGrid.directives","ngGrid.filters"]);var S=function(e,n,o,i){if(void 0===e.selectionProvider.selectedItems||i.config.noKeyboardNavigation)return!0;if("INPUT"===document.activeElement.tagName)return!0;var r,l=o.which||o.keyCode,a=!1,s=!1,c=void 0===e.selectionProvider.lastClickedRow?1:e.selectionProvider.lastClickedRow.rowIndex,g=e.columns.filter(function(e){return e.visible&&e.width>0}),d=e.columns.filter(function(e){return e.pinned});if(e.col&&(r=g.indexOf(e.col)),37!==l&&38!==l&&39!==l&&40!==l&&(i.config.noTabInterference||9!==l)&&13!==l)return!0;if(e.enableCellSelection){9===l&&o.preventDefault();var u=e.showSelectionCheckbox?1===r:0===r,f=1===r||0===r,h=r===g.length-1||r===g.length-2,p=g.indexOf(e.col)===g.length-1,m=d.indexOf(e.col)===d.length-1;if(37===l||9===l&&o.shiftKey){var v=0;u||(r-=1),f?u&&9===l&&o.shiftKey?(v=i.$canvas.width(),r=g.length-1,s=!0):v=i.$viewport.scrollLeft()-e.col.width:d.length>0&&(v=i.$viewport.scrollLeft()-g[r].width),i.$viewport.scrollLeft(v)}else(39===l||9===l&&!o.shiftKey)&&(h?p&&9===l&&!o.shiftKey?(i.$viewport.scrollLeft(0),r=e.showSelectionCheckbox?1:0,a=!0):i.$viewport.scrollLeft(i.$viewport.scrollLeft()+e.col.width):m&&i.$viewport.scrollLeft(0),p||(r+=1))}var w;w=e.configGroups.length>0?i.rowFactory.parsedData.filter(function(e){return!e.isAggRow}):i.filteredRows;var C=0;if(0!==c&&(38===l||13===l&&o.shiftKey||9===l&&o.shiftKey&&s)?C=-1:c!==w.length-1&&(40===l||13===l&&!o.shiftKey||9===l&&a)&&(C=1),C){var b=w[c+C];b.beforeSelectionChange(b,o)&&(b.continueSelection(o),e.$emit("ngGridEventDigestGridParent"),e.selectionProvider.lastClickedRow.renderedRowIndex>=e.renderedRows.length-t-2?i.$viewport.scrollTop(i.$viewport.scrollTop()+e.rowHeight):t+2>=e.selectionProvider.lastClickedRow.renderedRowIndex&&i.$viewport.scrollTop(i.$viewport.scrollTop()-e.rowHeight))}return e.enableCellSelection&&setTimeout(function(){e.domAccessProvider.focusCellElement(e,e.renderedColumns.indexOf(g[r]))},3),!1};String.prototype.trim||(String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g,"")}),Array.prototype.indexOf||(Array.prototype.indexOf=function(e){var n=this.length>>>0,t=Number(arguments[1])||0;for(t=0>t?Math.ceil(t):Math.floor(t),0>t&&(t+=n);n>t;t++)if(t in this&&this[t]===e)return t;return-1}),Array.prototype.filter||(Array.prototype.filter=function(e){var n=Object(this),t=n.length>>>0;if("function"!=typeof e)throw new TypeError;for(var o=[],i=arguments[1],r=0;t>r;r++)if(r in n){var l=n[r];e.call(i,l,r,n)&&o.push(l)}return o}),y.filter("checkmark",function(){return function(e){return e?"✔":"✘"}}),y.filter("ngColumns",function(){return function(e){return e.filter(function(e){return!e.isAggCol})}}),angular.module("ngGrid.services").factory("$domUtilityService",["$utilityService","$window",function(e,t){var o={},i={},r=function(){var e=n("<div></div>");e.appendTo("body"),e.height(100).width(100).css("position","absolute").css("overflow","scroll"),e.append('<div style="height: 400px; width: 400px;"></div>'),o.ScrollH=e.height()-e[0].clientHeight,o.ScrollW=e.width()-e[0].clientWidth,e.empty(),e.attr("style",""),e.append('<span style="font-family: Verdana, Helvetica, Sans-Serif; font-size: 14px;"><strong>M</strong></span>'),o.LetterW=e.children().first().width(),e.remove()};return o.eventStorage={},o.AssignGridContainers=function(e,t,i){i.$root=n(t),i.$topPanel=i.$root.find(".ngTopPanel"),i.$groupPanel=i.$root.find(".ngGroupPanel"),i.$headerContainer=i.$topPanel.find(".ngHeaderContainer"),e.$headerContainer=i.$headerContainer,i.$headerScroller=i.$topPanel.find(".ngHeaderScroller"),i.$headers=i.$headerScroller.children(),i.$viewport=i.$root.find(".ngViewport"),i.$canvas=i.$viewport.find(".ngCanvas"),i.$footerPanel=i.$root.find(".ngFooterPanel");var r=e.$watch(function(){return i.$viewport.scrollLeft()},function(e){return i.$headerContainer.scrollLeft(e)});e.$on("$destroy",function(){i.$root&&(n(i.$root.parent()).off("resize.nggrid"),i.$root=null,i.$topPanel=null,i.$headerContainer=null,i.$headers=null,i.$canvas=null,i.$footerPanel=null),r()}),o.UpdateGridLayout(e,i)},o.getRealWidth=function(e){var t=0,o={visibility:"hidden",display:"block"},i=e.parents().andSelf().not(":visible");return n.swap(i[0],o,function(){t=e.outerWidth()}),t},o.UpdateGridLayout=function(e,n){if(n.$root){var t=n.$viewport.scrollTop();n.elementDims.rootMaxW=n.$root.width(),n.$root.is(":hidden")&&(n.elementDims.rootMaxW=o.getRealWidth(n.$root)),n.elementDims.rootMaxH=n.$root.height(),n.refreshDomSizes(),e.adjustScrollTop(t,!0)}},o.numberOfGrids=0,o.setStyleText=function(e,n){var o=e.styleSheet,i=e.gridId,r=t.document;o||(o=r.getElementById(i)),o||(o=r.createElement("style"),o.type="text/css",o.id=i,(r.head||r.getElementsByTagName("head")[0]).appendChild(o)),o.styleSheet&&!o.sheet?o.styleSheet.cssText=n:o.innerHTML=n,e.styleSheet=o,e.styleText=n},o.BuildStyles=function(e,n,t){var i,r=n.config.rowHeight,l=n.gridId,a=e.columns,s=0,c=e.totalRowWidth();i="."+l+" .ngCanvas { width: "+c+"px; }"+"."+l+" .ngRow { width: "+c+"px; }"+"."+l+" .ngCanvas { width: "+c+"px; }"+"."+l+" .ngHeaderScroller { width: "+(c+o.ScrollH)+"px}";for(var g=0;a.length>g;g++){var d=a[g];if(d.visible!==!1){var u=0;g===a.length-1&&s+d.width<n.elementDims.rootMaxW&&(u=n.elementDims.rootMaxW-s-d.width),i+="."+l+" .col"+g+" { width: "+(d.width+u)+"px; left: "+s+"px; height: "+r+"px }"+"."+l+" .colt"+g+" { width: "+(d.width+u)+"px; }",s+=d.width}}o.setStyleText(n,i),e.adjustScrollLeft(n.$viewport.scrollLeft()),t&&o.digest(e)},o.setColLeft=function(e,n,t){if(t.styleText){var r=i[e.index];r||(r=i[e.index]=RegExp(".col"+e.index+" { width: [0-9]+px; left: [0-9]+px"));var l=t.styleText.replace(r,".col"+e.index+" { width: "+e.width+"px; left: "+n+"px");o.setStyleText(t,l)}},o.setColLeft.immediate=1,o.RebuildGrid=function(e,n){o.UpdateGridLayout(e,n),(null==n.config.maintainColumnRatios||n.config.maintainColumnRatios)&&n.configureColumnWidths(),e.adjustScrollLeft(n.$viewport.scrollLeft()),o.BuildStyles(e,n,!0)},o.digest=function(e){e.$root.$$phase||e.$digest()},o.ScrollH=17,o.ScrollW=17,o.LetterW=10,r(),o}]),angular.module("ngGrid.services").factory("$sortService",["$parse","$utilityService",function(e,n){var t={};return t.colSortFnCache={},t.isCustomSort=!1,t.guessSortFn=function(e){var n=typeof e;switch(n){case"number":return t.sortNumber;case"boolean":return t.sortBool;case"string":return e.match(/^[-+]?[£$¤]?[\d,.]+%?$/)?t.sortNumberStr:t.sortAlpha;default:return"[object Date]"===Object.prototype.toString.call(e)?t.sortDate:t.basicSort}},t.basicSort=function(e,n){return e===n?0:n>e?-1:1},t.sortNumber=function(e,n){return e-n},t.sortNumberStr=function(e,n){var t,o,i=!1,r=!1;return t=parseFloat(e.replace(/[^0-9.-]/g,"")),isNaN(t)&&(i=!0),o=parseFloat(n.replace(/[^0-9.-]/g,"")),isNaN(o)&&(r=!0),i&&r?0:i?1:r?-1:t-o},t.sortAlpha=function(e,n){var t=e.toLowerCase(),o=n.toLowerCase();return t===o?0:o>t?-1:1},t.sortDate=function(e,n){var t=e.getTime(),o=n.getTime();return t===o?0:o>t?-1:1},t.sortBool=function(e,n){return e&&n?0:e||n?e?1:-1:0},t.sortData=function(e,o){if(o&&e){var r,l,a=e.fields.length,s=e.fields,c=o.slice(0);o.sort(function(o,g){for(var d,u,f=0,h=0;0===f&&a>h;){r=e.columns[h],l=e.directions[h],u=t.getSortFn(r,c);var p=n.evalProperty(o,s[h]),m=n.evalProperty(g,s[h]);t.isCustomSort?(d=u(p,m),f=l===i?d:0-d):null==p||null==m?null==m&&null==p?f=0:null==p?f=1:null==m&&(f=-1):(d=u(p,m),f=l===i?d:0-d),h++}return f})}},t.Sort=function(e,n){t.isSorting||(t.isSorting=!0,t.sortData(e,n),t.isSorting=!1)},t.getSortFn=function(n,o){var i,r;if(t.colSortFnCache[n.field])i=t.colSortFnCache[n.field];else if(void 0!==n.sortingAlgorithm)i=n.sortingAlgorithm,t.colSortFnCache[n.field]=n.sortingAlgorithm,t.isCustomSort=!0;else{if(r=o[0],!r)return i;i=t.guessSortFn(e("entity['"+n.field.replace(v,"']['")+"']")({entity:r})),i?t.colSortFnCache[n.field]=i:i=t.sortAlpha}return i},t}]),angular.module("ngGrid.services").factory("$utilityService",["$parse",function(t){var o=/function (.{1,})\(/,i={visualLength:function(e){var t=document.getElementById("testDataLength");t||(t=document.createElement("SPAN"),t.id="testDataLength",t.style.visibility="hidden",document.body.appendChild(t));var o=n(e);n(t).css({font:o.css("font"),"font-size":o.css("font-size"),"font-family":o.css("font-family")}),t.innerHTML=o.text();var i=t.offsetWidth;return document.body.removeChild(t),i},forIn:function(e,n){for(var t in e)e.hasOwnProperty(t)&&n(e[t],t)},endsWith:function(e,n){return e&&n&&"string"==typeof e?-1!==e.indexOf(n,e.length-n.length):!1},isNullOrUndefined:function(e){return void 0===e||null===e?!0:!1},getElementsByClassName:function(e){if(document.getElementsByClassName)return document.getElementsByClassName(e);for(var n=[],t=RegExp("\\b"+e+"\\b"),o=document.getElementsByTagName("*"),i=0;o.length>i;i++){var r=o[i].className;t.test(r)&&n.push(o[i])}return n},newId:function(){var e=(new Date).getTime();return function(){return e+=1}}(),seti18n:function(n,t){var o=e.ngGrid.i18n[t];for(var i in o)n.i18n[i]=o[i]},getInstanceType:function(e){var n=o.exec(""+e.constructor);if(n&&n.length>1){var t=n[1].replace(/^\s+|\s+$/g,"");return t}return""},init:function(){function e(n){var t=C.exec(n);if(t)return(t[1]?e(t[1]):t[1])+t[2]+(t[3]?e(t[3]):t[3]);n=n.replace(w,"\\'");var o=n.split(v),i=[o.shift()];return angular.forEach(o,function(e){i.push(e.replace(m,"']$1"))}),i.join("['")}return this.preEval=e,this.evalProperty=function(n,o){return t(e("entity."+o))({entity:n})},delete this.init,this}}.init();return i}]);var x=function(e,n,t,o){this.rowIndex=0,this.offsetTop=this.rowIndex*t,this.entity=e,this.label=e.gLabel,this.field=e.gField,this.depth=e.gDepth,this.parent=e.parent,this.children=e.children,this.aggChildren=e.aggChildren,this.aggIndex=e.aggIndex,this.collapsed=o,this.groupInitState=o,this.rowFactory=n,this.rowHeight=t,this.isAggRow=!0,this.offsetLeft=25*e.gDepth,this.aggLabelFilter=e.aggLabelFilter};x.prototype.toggleExpand=function(){this.collapsed=this.collapsed?!1:!0,this.orig&&(this.orig.collapsed=this.collapsed),this.notifyChildren()},x.prototype.setExpand=function(e){this.collapsed=e,this.orig&&(this.orig.collapsed=e),this.notifyChildren()},x.prototype.notifyChildren=function(){for(var e=Math.max(this.rowFactory.aggCache.length,this.children.length),n=0;e>n;n++)if(this.aggChildren[n]&&(this.aggChildren[n].entity[s]=this.collapsed,this.collapsed&&this.aggChildren[n].setExpand(this.collapsed)),this.children[n]&&(this.children[n][s]=this.collapsed),n>this.aggIndex&&this.rowFactory.aggCache[n]){var t=this.rowFactory.aggCache[n],o=30*this.children.length;t.offsetTop=this.collapsed?t.offsetTop-o:t.offsetTop+o}this.rowFactory.renderedChange()},x.prototype.aggClass=function(){return this.collapsed?"ngAggArrowCollapsed":"ngAggArrowExpanded"},x.prototype.totalChildren=function(){if(this.aggChildren.length>0){var e=0,n=function(t){t.aggChildren.length>0?angular.forEach(t.aggChildren,function(e){n(e)}):e+=t.children.length};return n(this),e}return this.children.length},x.prototype.copy=function(){var e=new x(this.entity,this.rowFactory,this.rowHeight,this.groupInitState);return e.orig=this,e};var T=function(e,t,o,l,a,s){var c=this,d=e.colDef,u=500,f=0,h=null;c.colDef=e.colDef,c.width=d.width,c.groupIndex=0,c.isGroupedBy=!1,c.minWidth=d.minWidth?d.minWidth:50,c.maxWidth=d.maxWidth?d.maxWidth:9e3,c.enableCellEdit=void 0!==d.enableCellEdit?d.enableCellEdit:e.enableCellEdit||e.enableCellEditOnFocus,c.cellEditableCondition=d.cellEditableCondition||e.cellEditableCondition||"true",c.headerRowHeight=e.headerRowHeight,c.displayName=void 0===d.displayName?d.field:d.displayName,c.index=e.index,c.isAggCol=e.isAggCol,c.cellClass=d.cellClass,c.sortPriority=void 0,c.cellFilter=d.cellFilter?d.cellFilter:"",c.field=d.field,c.aggLabelFilter=d.aggLabelFilter||d.cellFilter,c.visible=s.isNullOrUndefined(d.visible)||d.visible,c.sortable=!1,c.resizable=!1,c.pinnable=!1,c.pinned=e.enablePinning&&d.pinned,c.originalIndex=null==e.originalIndex?c.index:e.originalIndex,c.groupable=s.isNullOrUndefined(d.groupable)||d.groupable,e.enableSort&&(c.sortable=s.isNullOrUndefined(d.sortable)||d.sortable),e.enableResize&&(c.resizable=s.isNullOrUndefined(d.resizable)||d.resizable),e.enablePinning&&(c.pinnable=s.isNullOrUndefined(d.pinnable)||d.pinnable),c.sortDirection=void 0,c.sortingAlgorithm=d.sortFn,c.headerClass=d.headerClass,c.cursor=c.sortable?"pointer":"default",c.headerCellTemplate=d.headerCellTemplate||a.get("headerCellTemplate.html"),c.cellTemplate=d.cellTemplate||a.get("cellTemplate.html").replace(g,c.cellFilter?"|"+c.cellFilter:""),c.enableCellEdit&&(c.cellEditTemplate=d.cellEditTemplate||a.get("cellEditTemplate.html"),c.editableCellTemplate=d.editableCellTemplate||a.get("editableCellTemplate.html")),d.cellTemplate&&!p.test(d.cellTemplate)&&(c.cellTemplate=a.get(d.cellTemplate)||n.ajax({type:"GET",url:d.cellTemplate,async:!1}).responseText),c.enableCellEdit&&d.editableCellTemplate&&!p.test(d.editableCellTemplate)&&(c.editableCellTemplate=a.get(d.editableCellTemplate)||n.ajax({type:"GET",url:d.editableCellTemplate,async:!1}).responseText),d.headerCellTemplate&&!p.test(d.headerCellTemplate)&&(c.headerCellTemplate=a.get(d.headerCellTemplate)||n.ajax({type:"GET",url:d.headerCellTemplate,async:!1}).responseText),c.colIndex=function(){var e=c.pinned?"pinned ":"";return e+="col"+c.index+" colt"+c.index,c.cellClass&&(e+=" "+c.cellClass),e},c.groupedByClass=function(){return c.isGroupedBy?"ngGroupedByIcon":"ngGroupIcon"},c.toggleVisible=function(){c.visible=!c.visible},c.showSortButtonUp=function(){return c.sortable?c.sortDirection===r:c.sortable},c.showSortButtonDown=function(){return c.sortable?c.sortDirection===i:c.sortable},c.noSortVisible=function(){return!c.sortDirection},c.sort=function(n){if(!c.sortable)return!0;var t=c.sortDirection===i?r:i;return c.sortDirection=t,e.sortCallback(c,n),!1},c.gripClick=function(){f++,1===f?h=setTimeout(function(){f=0},u):(clearTimeout(h),e.resizeOnDataCallback(c),f=0)},c.gripOnMouseDown=function(e){return t.isColumnResizing=!0,e.ctrlKey&&!c.pinned?(c.toggleVisible(),l.BuildStyles(t,o),!0):(e.target.parentElement.style.cursor="col-resize",c.startMousePosition=e.clientX,c.origWidth=c.width,n(document).mousemove(c.onMouseMove),n(document).mouseup(c.gripOnMouseUp),!1)},c.onMouseMove=function(e){var n=e.clientX-c.startMousePosition,i=n+c.origWidth;return c.width=c.minWidth>i?c.minWidth:i>c.maxWidth?c.maxWidth:i,t.hasUserChangedGridColumnWidths=!0,l.BuildStyles(t,o),!1},c.gripOnMouseUp=function(e){return n(document).off("mousemove",c.onMouseMove),n(document).off("mouseup",c.gripOnMouseUp),e.target.parentElement.style.cursor="default",l.digest(t),t.isColumnResizing=!1,!1},c.copy=function(){var n=new T(e,t,o,l,a,s);return n.isClone=!0,n.orig=c,n},c.setVars=function(e){c.orig=e,c.width=e.width,c.groupIndex=e.groupIndex,c.isGroupedBy=e.isGroupedBy,c.displayName=e.displayName,c.index=e.index,c.isAggCol=e.isAggCol,c.cellClass=e.cellClass,c.cellFilter=e.cellFilter,c.field=e.field,c.aggLabelFilter=e.aggLabelFilter,c.visible=e.visible,c.sortable=e.sortable,c.resizable=e.resizable,c.pinnable=e.pinnable,c.pinned=e.pinned,c.originalIndex=e.originalIndex,c.sortDirection=e.sortDirection,c.sortingAlgorithm=e.sortingAlgorithm,c.headerClass=e.headerClass,c.headerCellTemplate=e.headerCellTemplate,c.cellTemplate=e.cellTemplate,c.cellEditTemplate=e.cellEditTemplate}},P=function(e){this.outerHeight=null,this.outerWidth=null,n.extend(this,e)},I=function(e){this.previousColumn=null,this.grid=e};I.prototype.changeUserSelect=function(e,n){e.css({"-webkit-touch-callout":n,"-webkit-user-select":n,"-khtml-user-select":n,"-moz-user-select":"none"===n?"-moz-none":n,"-ms-user-select":n,"user-select":n})},I.prototype.focusCellElement=function(e,n){if(e.selectionProvider.lastClickedRow){var t=void 0!==n?n:this.previousColumn,o=e.selectionProvider.lastClickedRow.clone?e.selectionProvider.lastClickedRow.clone.elm:e.selectionProvider.lastClickedRow.elm;if(void 0!==t&&o){var i=angular.element(o[0].children).filter(function(){return 8!==this.nodeType}),r=Math.max(Math.min(e.renderedColumns.length-1,t),0);this.grid.config.showSelectionCheckbox&&angular.element(i[r]).scope()&&0===angular.element(i[r]).scope().col.index&&(r=1),i[r]&&i[r].children[1].children[0].focus(),this.previousColumn=t}}},I.prototype.selectionHandlers=function(e,n){function t(t){if(16===t.keyCode)return r.changeUserSelect(n,"none",t),!0;if(!i){i=!0;var o=S(e,n,t,r.grid);return i=!1,o}return!0}function o(e){return 16===e.keyCode&&r.changeUserSelect(n,"text",e),!0}var i=!1,r=this;n.bind("keydown",t),n.bind("keyup",o),n.on("$destroy",function(){n.off("keydown",t),n.off("keyup",o)})};var $=function(t,o,i,r){var l=this;l.colToMove=void 0,l.groupToMove=void 0,l.assignEvents=function(){t.config.jqueryUIDraggable&&!t.config.enablePinning?(t.$groupPanel.droppable({addClasses:!1,drop:function(e){l.onGroupDrop(e)}}),t.$groupPanel.on("$destroy",function(){t.$groupPanel=null})):(t.$groupPanel.on("mousedown",l.onGroupMouseDown).on("dragover",l.dragOver).on("drop",l.onGroupDrop),t.$topPanel.on("mousedown",".ngHeaderScroller",l.onHeaderMouseDown).on("dragover",".ngHeaderScroller",l.dragOver),t.$groupPanel.on("$destroy",function(){t.$groupPanel&&t.$groupPanel.off("mousedown"),t.$groupPanel=null}),t.config.enableColumnReordering&&t.$topPanel.on("drop",".ngHeaderScroller",l.onHeaderDrop),t.$topPanel.on("$destroy",function(){t.$topPanel&&t.$topPanel.off("mousedown"),t.config.enableColumnReordering&&t.$topPanel&&t.$topPanel.off("drop"),t.$topPanel=null})),o.$on("$destroy",o.$watch("renderedColumns",function(){r(l.setDraggables)}))},l.dragStart=function(e){e.dataTransfer.setData("text","")},l.dragOver=function(e){e.preventDefault()},l.setDraggables=function(){if(t.config.jqueryUIDraggable)t.$root&&t.$root.find(".ngHeaderSortColumn").draggable({helper:"clone",appendTo:"body",stack:"div",addClasses:!1,start:function(e){l.onHeaderMouseDown(e)}}).droppable({drop:function(e){l.onHeaderDrop(e)}});else if(t.$root){var e=t.$root.find(".ngHeaderSortColumn");if(angular.forEach(e,function(e){e.className&&-1!==e.className.indexOf("ngHeaderSortColumn")&&(e.setAttribute("draggable","true"),e.addEventListener&&(e.addEventListener("dragstart",l.dragStart),angular.element(e).on("$destroy",function(){angular.element(e).off("dragstart",l.dragStart),e.removeEventListener("dragstart",l.dragStart)})))}),-1!==navigator.userAgent.indexOf("MSIE")){var n=t.$root.find(".ngHeaderSortColumn");n.bind("selectstart",function(){return this.dragDrop(),!1}),angular.element(n).on("$destroy",function(){n.off("selectstart")})}}},l.onGroupMouseDown=function(e){var o=n(e.target);if("ngRemoveGroup"!==o[0].className){var i=angular.element(o).scope();i&&(t.config.jqueryUIDraggable||(o.attr("draggable","true"),this.addEventListener&&(this.addEventListener("dragstart",l.dragStart),angular.element(this).on("$destroy",function(){this.removeEventListener("dragstart",l.dragStart)})),-1!==navigator.userAgent.indexOf("MSIE")&&(o.bind("selectstart",function(){return this.dragDrop(),!1}),o.on("$destroy",function(){o.off("selectstart")}))),l.groupToMove={header:o,groupName:i.group,index:i.$index})}else l.groupToMove=void 0},l.onGroupDrop=function(e){e.stopPropagation();var i,r;l.groupToMove?(i=n(e.target).closest(".ngGroupElement"),"ngGroupPanel"===i.context.className?(o.configGroups.splice(l.groupToMove.index,1),o.configGroups.push(l.groupToMove.groupName)):(r=angular.element(i).scope(),r&&l.groupToMove.index!==r.$index&&(o.configGroups.splice(l.groupToMove.index,1),o.configGroups.splice(r.$index,0,l.groupToMove.groupName))),l.groupToMove=void 0,t.fixGroupIndexes()):l.colToMove&&(-1===o.configGroups.indexOf(l.colToMove.col)&&(i=n(e.target).closest(".ngGroupElement"),"ngGroupPanel"===i.context.className||"ngGroupPanelDescription ng-binding"===i.context.className?o.groupBy(l.colToMove.col):(r=angular.element(i).scope(),r&&o.removeGroup(r.$index))),l.colToMove=void 0),o.$$phase||o.$apply()},l.onHeaderMouseDown=function(e){var t=n(e.target).closest(".ngHeaderSortColumn"),o=angular.element(t).scope();o&&(l.colToMove={header:t,col:o.col})},l.onHeaderDrop=function(e){if(l.colToMove&&!l.colToMove.col.pinned){var r=n(e.target).closest(".ngHeaderSortColumn"),a=angular.element(r).scope();if(a){if(l.colToMove.col===a.col||a.col.pinned)return;o.columns.splice(l.colToMove.col.index,1),o.columns.splice(a.col.index,0,l.colToMove.col),t.fixColumnIndexes(),l.colToMove=void 0,i.digest(o)}}},l.assignGridEventHandlers=function(){-1===t.config.tabIndex?(t.$viewport.attr("tabIndex",i.numberOfGrids),i.numberOfGrids++):t.$viewport.attr("tabIndex",t.config.tabIndex);var r,l=function(){clearTimeout(r),r=setTimeout(function(){i.RebuildGrid(o,t)},100)};n(e).on("resize.nggrid",l);var a,s=function(){clearTimeout(a),a=setTimeout(function(){i.RebuildGrid(o,t)},100)};n(t.$root.parent()).on("resize.nggrid",s),o.$on("$destroy",function(){n(e).off("resize.nggrid",l)})},l.assignGridEventHandlers(),l.assignEvents()},D=function(e,n){e.maxRows=function(){var t=Math.max(e.totalServerItems,n.data.length);return t},e.$on("$destroy",e.$watch("totalServerItems",function(){e.currentMaxPages=e.maxPages()})),e.multiSelect=n.config.enableRowSelection&&n.config.multiSelect,e.selectedItemCount=n.selectedItemCount,e.maxPages=function(){return 0===e.maxRows()?1:Math.ceil(e.maxRows()/e.pagingOptions.pageSize)},e.pageForward=function(){var n=e.pagingOptions.currentPage;e.totalServerItems>0?e.pagingOptions.currentPage=Math.min(n+1,e.maxPages()):e.pagingOptions.currentPage++},e.pageBackward=function(){var n=e.pagingOptions.currentPage;e.pagingOptions.currentPage=Math.max(n-1,1)},e.pageToFirst=function(){e.pagingOptions.currentPage=1},e.pageToLast=function(){var n=e.maxPages();e.pagingOptions.currentPage=n},e.cantPageForward=function(){var t=e.pagingOptions.currentPage,o=e.maxPages();return e.totalServerItems>0?t>=o:1>n.data.length},e.cantPageToLast=function(){return e.totalServerItems>0?e.cantPageForward():!0},e.cantPageBackward=function(){var n=e.pagingOptions.currentPage;return 1>=n}},L=function(i,r,l,a,c,g,d,u,f,h,m){var v={aggregateTemplate:void 0,afterSelectionChange:function(){},beforeSelectionChange:function(){return!0},checkboxCellTemplate:void 0,checkboxHeaderTemplate:void 0,columnDefs:void 0,data:[],dataUpdated:function(){},enableCellEdit:!1,enableCellEditOnFocus:!1,enableCellSelection:!1,enableColumnResize:!1,enableColumnReordering:!1,enableColumnHeavyVirt:!1,enablePaging:!1,enablePinning:!1,enableRowSelection:!0,enableSorting:!0,enableHighlighting:!1,excludeProperties:[],filterOptions:{filterText:"",useExternalFilter:!1},footerRowHeight:55,footerTemplate:void 0,forceSyncScrolling:!0,groups:[],groupsCollapsedByDefault:!0,headerRowHeight:30,headerRowTemplate:void 0,jqueryUIDraggable:!1,jqueryUITheme:!1,keepLastSelected:!0,maintainColumnRatios:void 0,menuTemplate:void 0,multiSelect:!0,pagingOptions:{pageSizes:[250,500,1e3],pageSize:250,currentPage:1},pinSelectionCheckbox:!1,plugins:[],primaryKey:void 0,rowHeight:30,rowTemplate:void 0,selectedItems:[],selectionCheckboxColumnWidth:25,selectWithCheckboxOnly:!1,showColumnMenu:!1,showFilter:!1,showFooter:!1,showGroupPanel:!1,showSelectionCheckbox:!1,sortInfo:{fields:[],columns:[],directions:[]},tabIndex:-1,totalServerItems:0,useExternalSorting:!1,i18n:"en",virtualizationThreshold:50,noTabInterference:!1},w=this;w.maxCanvasHt=0,w.config=n.extend(v,e.ngGrid.config,r),w.config.showSelectionCheckbox=w.config.showSelectionCheckbox&&w.config.enableColumnHeavyVirt===!1,w.config.enablePinning=w.config.enablePinning&&w.config.enableColumnHeavyVirt===!1,w.config.selectWithCheckboxOnly=w.config.selectWithCheckboxOnly&&w.config.showSelectionCheckbox!==!1,w.config.pinSelectionCheckbox=w.config.enablePinning,"string"==typeof r.columnDefs&&(w.config.columnDefs=i.$eval(r.columnDefs)),w.rowCache=[],w.rowMap=[],w.gridId="ng"+d.newId(),w.$root=null,w.$groupPanel=null,w.$topPanel=null,w.$headerContainer=null,w.$headerScroller=null,w.$headers=null,w.$viewport=null,w.$canvas=null,w.rootDim=w.config.gridDim,w.data=[],w.lateBindColumns=!1,w.filteredRows=[],w.initTemplates=function(){var e=["rowTemplate","aggregateTemplate","headerRowTemplate","checkboxCellTemplate","checkboxHeaderTemplate","menuTemplate","footerTemplate"],n=[];return angular.forEach(e,function(e){n.push(w.getTemplate(e))}),m.all(n)},w.getTemplate=function(e){var n=w.config[e],t=w.gridId+e+".html",o=m.defer();if(n&&!p.test(n))h.get(n,{cache:g}).success(function(e){g.put(t,e),o.resolve()}).error(function(){o.reject("Could not load template: "+n)});else if(n)g.put(t,n),o.resolve();else{var i=e+".html";g.put(t,g.get(i)),o.resolve()}return o.promise},"object"==typeof w.config.data&&(w.data=w.config.data),w.calcMaxCanvasHeight=function(){var e;return e=w.config.groups.length>0?w.rowFactory.parsedData.filter(function(e){return!e[s]}).length*w.config.rowHeight:w.filteredRows.length*w.config.rowHeight},w.elementDims={scrollW:0,scrollH:0,rowIndexCellW:w.config.selectionCheckboxColumnWidth,rowSelectedCellW:w.config.selectionCheckboxColumnWidth,rootMaxW:0,rootMaxH:0},w.setRenderedRows=function(e){i.renderedRows.length=e.length;for(var n=0;e.length>n;n++)!i.renderedRows[n]||e[n].isAggRow||i.renderedRows[n].isAggRow?(i.renderedRows[n]=e[n].copy(),i.renderedRows[n].collapsed=e[n].collapsed,e[n].isAggRow||i.renderedRows[n].setVars(e[n])):i.renderedRows[n].setVars(e[n]),i.renderedRows[n].rowIndex=e[n].rowIndex,i.renderedRows[n].offsetTop=e[n].offsetTop,i.renderedRows[n].selected=e[n].selected,e[n].renderedRowIndex=n;w.refreshDomSizes(),i.$emit("ngGridEventRows",e)},w.minRowsToRender=function(){var e=i.viewportDimHeight()||1;return Math.floor(e/w.config.rowHeight)},w.refreshDomSizes=function(){var e=new P;e.outerWidth=w.elementDims.rootMaxW,e.outerHeight=w.elementDims.rootMaxH,w.rootDim=e,w.maxCanvasHt=w.calcMaxCanvasHeight()},w.buildColumnDefsFromData=function(){w.config.columnDefs=[];var e=w.data[0];return e?(d.forIn(e,function(e,n){-1===w.config.excludeProperties.indexOf(n)&&w.config.columnDefs.push({field:n})}),void 0):(w.lateBoundColumns=!0,void 0)},w.buildColumns=function(){var e=w.config.columnDefs,n=[];if(e||(w.buildColumnDefsFromData(),e=w.config.columnDefs),w.config.showSelectionCheckbox&&n.push(new T({colDef:{field:"✔",width:w.elementDims.rowSelectedCellW,sortable:!1,resizable:!1,groupable:!1,headerCellTemplate:g.get(i.gridId+"checkboxHeaderTemplate.html"),cellTemplate:g.get(i.gridId+"checkboxCellTemplate.html"),pinned:w.config.pinSelectionCheckbox},index:0,headerRowHeight:w.config.headerRowHeight,sortCallback:w.sortData,resizeOnDataCallback:w.resizeOnData,enableResize:w.config.enableColumnResize,enableSort:w.config.enableSorting,enablePinning:w.config.enablePinning},i,w,a,g,d)),e.length>0){var t=w.config.showSelectionCheckbox?1:0,o=i.configGroups.length;i.configGroups.length=0,angular.forEach(e,function(e,r){r+=t;var l=new T({colDef:e,index:r+o,originalIndex:r,headerRowHeight:w.config.headerRowHeight,sortCallback:w.sortData,resizeOnDataCallback:w.resizeOnData,enableResize:w.config.enableColumnResize,enableSort:w.config.enableSorting,enablePinning:w.config.enablePinning,enableCellEdit:w.config.enableCellEdit||w.config.enableCellEditOnFocus,cellEditableCondition:w.config.cellEditableCondition},i,w,a,g,d),s=w.config.groups.indexOf(e.field);-1!==s&&(l.isGroupedBy=!0,i.configGroups.splice(s,0,l),l.groupIndex=i.configGroups.length),n.push(l)}),i.columns=n,w.config.groups.length>0&&w.rowFactory.getGrouping(w.config.groups)}},w.configureColumnWidths=function(){var e=[],n=[],t=0,o=0,r={};if(angular.forEach(i.columns,function(e,n){if(d.isNullOrUndefined(e.originalIndex))e.isAggCol&&e.visible&&(o+=25);else{var t=e.originalIndex;w.config.showSelectionCheckbox&&(0===e.originalIndex&&e.visible&&(o+=w.config.selectionCheckboxColumnWidth),t--),r[t]=n}}),angular.forEach(w.config.columnDefs,function(l,a){var s=i.columns[r[a]];l.index=a;var c,g=!1;if(d.isNullOrUndefined(l.width)?l.width="*":(g=isNaN(l.width)?d.endsWith(l.width,"%"):!1,c=g?l.width:parseInt(l.width,10)),isNaN(c)){if(c=l.width,"auto"===c){s.width=s.minWidth,o+=s.width;var u=s;return i.$on("$destroy",i.$on("ngGridEventData",function(){w.resizeOnData(u)})),void 0}if(-1!==c.indexOf("*"))return s.visible!==!1&&(t+=c.length),e.push(l),void 0;if(g)return n.push(l),void 0;throw'unable to parse column width, use percentage ("10%","20%", etc...) or "*" to use remaining width of grid'}s.visible!==!1&&(o+=s.width=parseInt(s.width,10))}),n.length>0){w.config.maintainColumnRatios=w.config.maintainColumnRatios!==!1;var l=0,s=0;angular.forEach(n,function(e){var n=i.columns[r[e.index]],t=parseFloat(e.width)/100;l+=t,n.visible||(s+=t)});var c=l-s;angular.forEach(n,function(e){var n=i.columns[r[e.index]],t=parseFloat(e.width)/100;t/=s>0?c:l;var a=w.rootDim.outerWidth*l;n.width=a*t,o+=n.width})}if(e.length>0){w.config.maintainColumnRatios=w.config.maintainColumnRatios!==!1;var g=w.rootDim.outerWidth-o;w.maxCanvasHt>i.viewportDimHeight()&&(g-=a.ScrollW);var u=Math.floor(g/t);angular.forEach(e,function(n,t){var l=i.columns[r[n.index]];l.width=u*n.width.length,l.width<l.minWidth&&(l.width=l.minWidth),l.visible!==!1&&(o+=l.width);var s=t===e.length-1;if(s&&w.rootDim.outerWidth>o){var c=w.rootDim.outerWidth-o;w.maxCanvasHt>i.viewportDimHeight()&&(c-=a.ScrollW),l.width+=c}})}},w.init=function(){return w.initTemplates().then(function(){i.selectionProvider=new H(w,i,f,d),i.domAccessProvider=new I(w),w.rowFactory=new G(w,i,a,g,d),w.searchProvider=new k(i,w,c,d),w.styleProvider=new F(i,w),i.$on("$destroy",i.$watch("configGroups",function(e){var n=[];angular.forEach(e,function(e){n.push(e.field||e)}),w.config.groups=n,w.rowFactory.filteredRowsChanged(),i.$emit("ngGridEventGroups",e)},!0)),i.$on("$destroy",i.$watch("columns",function(e){i.isColumnResizing||a.RebuildGrid(i,w),i.$emit("ngGridEventColumns",e)},!0)),i.$on("$destroy",i.$watch(function(){return r.i18n},function(e){d.seti18n(i,e)})),w.maxCanvasHt=w.calcMaxCanvasHeight(),w.config.sortInfo.fields&&w.config.sortInfo.fields.length>0&&i.$on("$destroy",i.$watch(function(){return w.config.sortInfo},function(){l.isSorting||(w.sortColumnsInit(),i.$emit("ngGridEventSorted",w.config.sortInfo))},!0))})},w.resizeOnData=function(e){var t=e.minWidth,o=d.getElementsByClassName("col"+e.index);angular.forEach(o,function(e,o){var i;if(0===o){var r=n(e).find(".ngHeaderText");i=d.visualLength(r)+10}else{var l=n(e).find(".ngCellText");i=d.visualLength(l)+10}i>t&&(t=i)}),e.width=e.longest=Math.min(e.maxWidth,t+7),a.BuildStyles(i,w,!0)},w.lastSortedColumns=[],w.sortData=function(e,t){if(t&&t.shiftKey&&w.config.sortInfo){var o=w.config.sortInfo.columns.indexOf(e);-1===o?(1===w.config.sortInfo.columns.length&&(w.config.sortInfo.columns[0].sortPriority=1),w.config.sortInfo.columns.push(e),e.sortPriority=w.config.sortInfo.columns.length,w.config.sortInfo.fields.push(e.field),w.config.sortInfo.directions.push(e.sortDirection),w.lastSortedColumns.push(e)):w.config.sortInfo.directions[o]=e.sortDirection,i.$emit("ngGridEventSorted",w.config.sortInfo)}else if(!w.config.useExternalSorting||w.config.useExternalSorting&&w.config.sortInfo){var r=n.isArray(e);w.config.sortInfo.columns.length=0,w.config.sortInfo.fields.length=0,w.config.sortInfo.directions.length=0;var l=function(e){w.config.sortInfo.columns.push(e),w.config.sortInfo.fields.push(e.field),w.config.sortInfo.directions.push(e.sortDirection),w.lastSortedColumns.push(e)};r?angular.forEach(e,function(e,n){e.sortPriority=n+1,l(e)
}):(w.clearSortingData(e),e.sortPriority=void 0,l(e)),w.sortActual(),w.searchProvider.evalFilter(),i.$emit("ngGridEventSorted",w.config.sortInfo)}},w.sortColumnsInit=function(){w.config.sortInfo.columns?w.config.sortInfo.columns.length=0:w.config.sortInfo.columns=[];var e=[];angular.forEach(i.columns,function(n){var t=w.config.sortInfo.fields.indexOf(n.field);-1!==t&&(n.sortDirection=w.config.sortInfo.directions[t]||"asc",e[t]=n)}),1===e.length?w.sortData(e[0]):w.sortData(e)},w.sortActual=function(){if(!w.config.useExternalSorting){var e=w.data.slice(0);angular.forEach(e,function(e,n){var t=w.rowMap[n];if(void 0!==t){var o=w.rowCache[t];void 0!==o&&(e.preSortSelected=o.selected,e.preSortIndex=n)}}),l.Sort(w.config.sortInfo,e),angular.forEach(e,function(e,n){w.rowCache[n].entity=e,w.rowCache[n].selected=e.preSortSelected,w.rowMap[e.preSortIndex]=n,delete e.preSortSelected,delete e.preSortIndex})}},w.clearSortingData=function(e){e?(angular.forEach(w.lastSortedColumns,function(n){e.index!==n.index&&(n.sortDirection="",n.sortPriority=null)}),w.lastSortedColumns[0]=e,w.lastSortedColumns.length=1):(angular.forEach(w.lastSortedColumns,function(e){e.sortDirection="",e.sortPriority=null}),w.lastSortedColumns=[])},w.fixColumnIndexes=function(){for(var e=0;i.columns.length>e;e++)i.columns[e].index=e},w.fixGroupIndexes=function(){angular.forEach(i.configGroups,function(e,n){e.groupIndex=n+1})},i.elementsNeedMeasuring=!0,i.columns=[],i.renderedRows=[],i.renderedColumns=[],i.headerRow=null,i.rowHeight=w.config.rowHeight,i.jqueryUITheme=w.config.jqueryUITheme,i.showSelectionCheckbox=w.config.showSelectionCheckbox,i.enableCellSelection=w.config.enableCellSelection,i.enableCellEditOnFocus=w.config.enableCellEditOnFocus,i.footer=null,i.selectedItems=w.config.selectedItems,i.multiSelect=w.config.multiSelect,i.showFooter=w.config.showFooter,i.footerRowHeight=i.showFooter?w.config.footerRowHeight:0,i.showColumnMenu=w.config.showColumnMenu,i.forceSyncScrolling=w.config.forceSyncScrolling,i.showMenu=!1,i.configGroups=[],i.gridId=w.gridId,i.enablePaging=w.config.enablePaging,i.pagingOptions=w.config.pagingOptions,i.i18n={},d.seti18n(i,w.config.i18n),i.adjustScrollLeft=function(e){for(var n=0,t=0,o=i.columns.length,r=[],l=!w.config.enableColumnHeavyVirt,s=0,c=function(e){l?r.push(e):i.renderedColumns[s]?i.renderedColumns[s].setVars(e):i.renderedColumns[s]=e.copy(),s++},g=0;o>g;g++){var d=i.columns[g];if(d.visible!==!1){var u=d.width+n;if(d.pinned){c(d);var f=g>0?e+t:e;a.setColLeft(d,f,w),t+=d.width}else u>=e&&e+w.rootDim.outerWidth>=n&&c(d);n+=d.width}}l&&(i.renderedColumns=r)},w.prevScrollTop=0,w.prevScrollIndex=0,i.adjustScrollTop=function(e,n){if(w.prevScrollTop!==e||n){e>0&&w.$viewport[0].scrollHeight-e<=w.$viewport.outerHeight()&&i.$emit("ngGridEventScroll");var r,l=Math.floor(e/w.config.rowHeight);if(w.filteredRows.length>w.config.virtualizationThreshold){if(e>w.prevScrollTop&&w.prevScrollIndex+o>l)return;if(w.prevScrollTop>e&&l>w.prevScrollIndex-o)return;r=new R(Math.max(0,l-t),l+w.minRowsToRender()+t)}else{var a=i.configGroups.length>0?w.rowFactory.parsedData.length:w.filteredRows.length;r=new R(0,Math.max(a,w.minRowsToRender()+t))}w.prevScrollTop=e,w.rowFactory.UpdateViewableRange(r),w.prevScrollIndex=l}},i.toggleShowMenu=function(){i.showMenu=!i.showMenu},i.toggleSelectAll=function(e,n){i.selectionProvider.toggleSelectAll(e,!1,n)},i.totalFilteredItemsLength=function(){return w.filteredRows.length},i.showGroupPanel=function(){return w.config.showGroupPanel},i.topPanelHeight=function(){return w.config.showGroupPanel===!0?w.config.headerRowHeight+32:w.config.headerRowHeight},i.viewportDimHeight=function(){return Math.max(0,w.rootDim.outerHeight-i.topPanelHeight()-i.footerRowHeight-2)},i.groupBy=function(e){if(!(1>w.data.length)&&e.groupable&&e.field){e.sortDirection||e.sort({shiftKey:i.configGroups.length>0?!0:!1});var n=i.configGroups.indexOf(e);-1===n?(e.isGroupedBy=!0,i.configGroups.push(e),e.groupIndex=i.configGroups.length):i.removeGroup(n),w.$viewport.scrollTop(0),a.digest(i)}},i.removeGroup=function(e){var n=i.columns.filter(function(n){return n.groupIndex===e+1})[0];n.isGroupedBy=!1,n.groupIndex=0,i.columns[e].isAggCol&&(i.columns.splice(e,1),i.configGroups.splice(e,1),w.fixGroupIndexes()),0===i.configGroups.length&&(w.fixColumnIndexes(),a.digest(i)),i.adjustScrollLeft(0)},i.togglePin=function(e){for(var n=e.index,t=0,o=0;i.columns.length>o&&i.columns[o].pinned;o++)t++;e.pinned&&(t=Math.max(e.originalIndex,t-1)),e.pinned=!e.pinned,i.columns.splice(n,1),i.columns.splice(t,0,e),w.fixColumnIndexes(),a.BuildStyles(i,w,!0),w.$viewport.scrollLeft(w.$viewport.scrollLeft()-e.width)},i.totalRowWidth=function(){for(var e=0,n=i.columns,t=0;n.length>t;t++)n[t].visible!==!1&&(e+=n[t].width);return e},i.headerScrollerDim=function(){var e=i.viewportDimHeight(),n=w.maxCanvasHt,t=n>e,o=new P;return o.autoFitHeight=!0,o.outerWidth=i.totalRowWidth(),t?o.outerWidth+=w.elementDims.scrollW:w.elementDims.scrollH>=n-e&&(o.outerWidth+=w.elementDims.scrollW),o}},R=function(e,n){this.topRow=e,this.bottomRow=n},E=function(e,n,t,o,i){this.entity=e,this.config=n,this.selectionProvider=t,this.rowIndex=o,this.utils=i,this.selected=t.getSelection(e),this.cursor=this.config.enableRowSelection&&!this.config.selectWithCheckboxOnly?"pointer":"default",this.beforeSelectionChange=n.beforeSelectionChangeCallback,this.afterSelectionChange=n.afterSelectionChangeCallback,this.offsetTop=this.rowIndex*n.rowHeight,this.rowDisplayIndex=0};E.prototype.setSelection=function(e){this.selectionProvider.setSelection(this,e),this.selectionProvider.lastClickedRow=this},E.prototype.continueSelection=function(e){this.selectionProvider.ChangeSelection(this,e)},E.prototype.ensureEntity=function(e){this.entity!==e&&(this.entity=e,this.selected=this.selectionProvider.getSelection(this.entity))},E.prototype.toggleSelected=function(e){if(!this.config.enableRowSelection&&!this.config.enableCellSelection)return!0;var n=e.target||e;return"checkbox"===n.type&&"ngSelectionCell ng-scope"!==n.parentElement.className?!0:this.config.selectWithCheckboxOnly&&"checkbox"!==n.type?(this.selectionProvider.lastClickedRow=this,!0):(this.beforeSelectionChange(this,e)&&this.continueSelection(e),!1)},E.prototype.alternatingRowClass=function(){var e=0===this.rowIndex%2,n={ngRow:!0,selected:this.selected,even:e,odd:!e,"ui-state-default":this.config.jqueryUITheme&&e,"ui-state-active":this.config.jqueryUITheme&&!e};return n},E.prototype.getProperty=function(e){return this.utils.evalProperty(this.entity,e)},E.prototype.copy=function(){return this.clone=new E(this.entity,this.config,this.selectionProvider,this.rowIndex,this.utils),this.clone.isClone=!0,this.clone.elm=this.elm,this.clone.orig=this,this.clone},E.prototype.setVars=function(e){e.clone=this,this.entity=e.entity,this.selected=e.selected,this.orig=e};var G=function(e,n,o,i,r){var g=this;g.aggCache={},g.parentCache=[],g.dataChanged=!0,g.parsedData=[],g.rowConfig={},g.selectionProvider=n.selectionProvider,g.rowHeight=30,g.numberOfAggregates=0,g.groupedData=void 0,g.rowHeight=e.config.rowHeight,g.rowConfig={enableRowSelection:e.config.enableRowSelection,rowClasses:e.config.rowClasses,selectedItems:n.selectedItems,selectWithCheckboxOnly:e.config.selectWithCheckboxOnly,beforeSelectionChangeCallback:e.config.beforeSelectionChange,afterSelectionChangeCallback:e.config.afterSelectionChange,jqueryUITheme:e.config.jqueryUITheme,enableCellSelection:e.config.enableCellSelection,rowHeight:e.config.rowHeight},g.renderedRange=new R(0,e.minRowsToRender()+t),g.buildEntityRow=function(e,n){return new E(e,g.rowConfig,g.selectionProvider,n,r)},g.buildAggregateRow=function(n,t){var o=g.aggCache[n.aggIndex];return o||(o=new x(n,g,g.rowConfig.rowHeight,e.config.groupsCollapsedByDefault),g.aggCache[n.aggIndex]=o),o.rowIndex=t,o.offsetTop=t*g.rowConfig.rowHeight,o},g.UpdateViewableRange=function(e){g.renderedRange=e,g.renderedChange()},g.filteredRowsChanged=function(){e.lateBoundColumns&&e.filteredRows.length>0&&(e.config.columnDefs=void 0,e.buildColumns(),e.lateBoundColumns=!1,n.$evalAsync(function(){n.adjustScrollLeft(0)})),g.dataChanged=!0,e.config.groups.length>0&&g.getGrouping(e.config.groups),g.UpdateViewableRange(g.renderedRange)},g.renderedChange=function(){if(!g.groupedData||1>e.config.groups.length)return g.renderedChangeNoGroups(),e.refreshDomSizes(),void 0;g.wasGrouped=!0,g.parentCache=[];var n=0,t=g.parsedData.filter(function(e){return e.isAggRow?e.parent&&e.parent.collapsed?!1:!0:(e[s]||(e.rowIndex=n++),!e[s])});g.totalRows=t.length;for(var o=[],i=g.renderedRange.topRow;g.renderedRange.bottomRow>i;i++)t[i]&&(t[i].offsetTop=i*e.config.rowHeight,o.push(t[i]));e.setRenderedRows(o)},g.renderedChangeNoGroups=function(){for(var n=[],t=g.renderedRange.topRow;g.renderedRange.bottomRow>t;t++)e.filteredRows[t]&&(e.filteredRows[t].rowIndex=t,e.filteredRows[t].offsetTop=t*e.config.rowHeight,n.push(e.filteredRows[t]));e.setRenderedRows(n)},g.fixRowCache=function(){var n=e.data.length,t=n-e.rowCache.length;if(0>t)e.rowCache.length=e.rowMap.length=n;else for(var o=e.rowCache.length;n>o;o++)e.rowCache[o]=e.rowFactory.buildEntityRow(e.data[o],o)},g.parseGroupData=function(e){if(e.values)for(var n=0;e.values.length>n;n++)g.parentCache[g.parentCache.length-1].children.push(e.values[n]),g.parsedData.push(e.values[n]);else for(var t in e)if(t!==l&&t!==a&&t!==c&&e.hasOwnProperty(t)){var o=g.buildAggregateRow({gField:e[l],gLabel:t,gDepth:e[a],isAggRow:!0,_ng_hidden_:!1,children:[],aggChildren:[],aggIndex:g.numberOfAggregates,aggLabelFilter:e[c].aggLabelFilter},0);g.numberOfAggregates++,o.parent=g.parentCache[o.depth-1],o.parent&&(o.parent.collapsed=!1,o.parent.aggChildren.push(o)),g.parsedData.push(o),g.parentCache[o.depth]=o,g.parseGroupData(e[t])}},g.getGrouping=function(t){function d(e,n){return e.filter(function(e){return e.field===n})}g.aggCache=[],g.numberOfAggregates=0,g.groupedData={};for(var u=e.filteredRows,f=t.length,h=n.columns,p=0;u.length>p;p++){var m=u[p].entity;if(!m)return;u[p][s]=e.config.groupsCollapsedByDefault;for(var v=g.groupedData,w=0;t.length>w;w++){var C=t[w],b=d(h,C)[0],y=r.evalProperty(m,C);y=""===y||null===y?"null":""+y,v[y]||(v[y]={}),v[l]||(v[l]=C),v[a]||(v[a]=w),v[c]||(v[c]=b),v=v[y]}v.values||(v.values=[]),v.values.push(u[p])}if(h.length>0)for(var S=0;t.length>S;S++)!h[S].isAggCol&&f>=S&&h.splice(0,0,new T({colDef:{field:"",width:25,sortable:!1,resizable:!1,headerCellTemplate:'<div class="ngAggHeader"></div>',pinned:e.config.pinSelectionCheckbox},enablePinning:e.config.enablePinning,isAggCol:!0,headerRowHeight:e.config.headerRowHeight},n,e,o,i,r));e.fixColumnIndexes(),n.adjustScrollLeft(0),g.parsedData.length=0,g.parseGroupData(g.groupedData),g.fixRowCache()},e.config.groups.length>0&&e.filteredRows.length>0&&g.getGrouping(e.config.groups)},k=function(e,t,o,i){var r=this,l=[];r.extFilter=t.config.filterOptions.useExternalFilter,e.showFilter=t.config.showFilter,e.filterText="",r.fieldMap={};var a=function(e){var n={};for(var t in e)e.hasOwnProperty(t)&&(n[t.toLowerCase()]=e[t]);return n},s=function(e){if("object"==typeof e){var n=[];for(var t in e)n=n.concat(s(e[t]));return n}return[e]},c=function(e,n,t){var i;for(var r in n)if(n.hasOwnProperty(r)){var l=t[r.toLowerCase()],s=n[r];if("object"!=typeof s||s instanceof Date){var g=null,d=null;if(l&&l.cellFilter&&(d=l.cellFilter.split(":"),g=o(d[0])),null!==s&&void 0!==s){if("function"==typeof g){var u=""+g(s,d[1]?d[1].slice(1,-1):"");i=e.regex.test(u)}else i=e.regex.test(""+s);if(i)return!0}}else{var f=a(l);if(i=c(e,s,f))return!0}}return!1},g=function(e,n){var t,l=r.fieldMap[e.columnDisplay];if(!l)return!1;var a=l.cellFilter.split(":"),c=l.cellFilter?o(a[0]):null,g=n[e.column]||n[l.field.split(".")[0]]||i.evalProperty(n,l.field);if(null===g||void 0===g)return!1;if("function"==typeof c){var d=""+c("object"==typeof g?u(g,l.field):g,a[1]);t=e.regex.test(d)}else{var f=s(u(g,l.field));for(var h in f)t|=e.regex.test(f[h])}return t?!0:!1},d=function(e){for(var n=0,t=l.length;t>n;n++){var o,i=l[n];if(o=i.column?g(i,e):c(i,e,r.fieldMap),!o)return!1}return!0};r.evalFilter=function(){t.filteredRows=0===l.length?t.rowCache:t.rowCache.filter(function(e){return d(e.entity)});for(var e=0;t.filteredRows.length>e;e++)t.filteredRows[e].rowIndex=e;t.rowFactory.filteredRowsChanged()};var u=function(e,n){if("object"!=typeof e||"string"!=typeof n)return e;var t=n.split("."),o=e;if(t.length>1){for(var i=1,r=t.length;r>i;i++)if(o=o[t[i]],!o)return e;return o}return e},f=function(e,n){try{return RegExp(e,n)}catch(t){return RegExp(e.replace(/(\^|\$|\(|\)|<|>|\[|\]|\{|\}|\\|\||\.|\*|\+|\?)/g,"\\$1"))}},h=function(e){l=[];var t;if(t=n.trim(e))for(var o=t.split(";"),i=0;o.length>i;i++){var r=o[i].split(":");if(r.length>1){var a=n.trim(r[0]),s=n.trim(r[1]);a&&s&&l.push({column:a,columnDisplay:a.replace(/\s+/g,"").toLowerCase(),regex:f(s,"i")})}else{var c=n.trim(r[0]);c&&l.push({column:"",regex:f(c,"i")})}}};r.extFilter||e.$on("$destroy",e.$watch("columns",function(e){for(var n=0;e.length>n;n++){var t=e[n];if(t.field)if(t.field.match(/\./g)){for(var o=t.field.split("."),i=r.fieldMap,l=0;o.length-1>l;l++)i[o[l]]=i[o[l]]||{},i=i[o[l]];i[o[o.length-1]]=t}else r.fieldMap[t.field.toLowerCase()]=t;t.displayName&&(r.fieldMap[t.displayName.toLowerCase().replace(/\s+/g,"")]=t)}})),e.$on("$destroy",e.$watch(function(){return t.config.filterOptions.filterText},function(n){e.filterText=n})),e.$on("$destroy",e.$watch("filterText",function(n){r.extFilter||(e.$emit("ngGridEventFilter",n),h(n),r.evalFilter())}))},H=function(e,n,t,o){var i=this;i.multi=e.config.multiSelect,i.selectedItems=e.config.selectedItems,i.selectedIndex=e.config.selectedIndex,i.lastClickedRow=void 0,i.ignoreSelectedItemChanges=!1;var r=e.config.primaryKey;r&&(r=o.preEval("entity."+e.config.primaryKey)),i.pKeyParser=t(r),i.ChangeSelection=function(t,o){var r=o.which||o.keyCode,l=40===r||38===r;if(o&&o.shiftKey&&!o.keyCode&&i.multi&&e.config.enableRowSelection){if(i.lastClickedRow){var a;a=n.configGroups.length>0?e.rowFactory.parsedData.filter(function(e){return!e.isAggRow}):e.filteredRows;var s=t.rowIndex,c=i.lastClickedRowIndex;if(s===c)return!1;c>s?(s^=c,c=s^c,s^=c,s--):c++;for(var g=[];s>=c;c++)g.push(a[c]);if(g[g.length-1].beforeSelectionChange(g,o)){for(var d=0;g.length>d;d++){var u=g[d],f=u.selected;u.selected=!f,u.clone&&(u.clone.selected=u.selected);var h=i.selectedItems.indexOf(u.entity);-1===h?i.selectedItems.push(u.entity):i.selectedItems.splice(h,1)}g[g.length-1].afterSelectionChange(g,o)}return i.lastClickedRow=t,i.lastClickedRowIndex=t.rowIndex,!0}}else i.multi?(!o.keyCode||l&&!e.config.selectWithCheckboxOnly)&&i.setSelection(t,!t.selected):i.lastClickedRow===t?i.setSelection(i.lastClickedRow,e.config.keepLastSelected?!0:!t.selected):(i.lastClickedRow&&i.setSelection(i.lastClickedRow,!1),i.setSelection(t,!t.selected));return i.lastClickedRow=t,i.lastClickedRowIndex=t.rowIndex,!0},i.getSelection=function(e){return-1!==i.getSelectionIndex(e)},i.getSelectionIndex=function(n){var t=-1;if(e.config.primaryKey){var o=i.pKeyParser({entity:n});angular.forEach(i.selectedItems,function(e,n){o===i.pKeyParser({entity:e})&&(t=n)})}else t=i.selectedItems.indexOf(n);return t},i.setSelection=function(n,t){if(e.config.enableRowSelection){if(t)-1===i.getSelectionIndex(n.entity)&&(!i.multi&&i.selectedItems.length>0&&i.toggleSelectAll(!1,!0),i.selectedItems.push(n.entity));else{var o=i.getSelectionIndex(n.entity);-1!==o&&i.selectedItems.splice(o,1)}n.selected=t,n.orig&&(n.orig.selected=t),n.clone&&(n.clone.selected=t),n.afterSelectionChange(n)}},i.toggleSelectAll=function(n,t,o){var r,l,a=o?e.filteredRows:e.rowCache;if(t||e.config.beforeSelectionChange(a,n)){!o&&i.selectedItems.length>0&&(i.selectedItems.length=0);for(var s=0;a.length>s;s++)r=a[s].selected,a[s].selected=n,a[s].clone&&(a[s].clone.selected=n),!r&&n?i.selectedItems.push(a[s].entity):r&&!n&&(l=i.getSelectionIndex(a[s].entity),l>-1&&i.selectedItems.splice(l,1));t||e.config.afterSelectionChange(a,n)}}},F=function(e,n){e.headerCellStyle=function(e){return{height:e.headerRowHeight+"px"}},e.rowStyle=function(n){var t={top:n.offsetTop+"px",height:e.rowHeight+"px"};return n.isAggRow&&(t.left=n.offsetLeft),t},e.canvasStyle=function(){return{height:n.maxCanvasHt+"px"}},e.headerScrollerStyle=function(){return{height:n.config.headerRowHeight+"px"}},e.topPanelStyle=function(){return{width:n.rootDim.outerWidth+"px",height:e.topPanelHeight()+"px"}},e.headerStyle=function(){return{width:n.rootDim.outerWidth+"px",height:n.config.headerRowHeight+"px"}},e.groupPanelStyle=function(){return{width:n.rootDim.outerWidth+"px",height:"32px"}},e.viewportStyle=function(){return{width:n.rootDim.outerWidth+"px",height:e.viewportDimHeight()+"px"}},e.footerStyle=function(){return{width:n.rootDim.outerWidth+"px",height:e.footerRowHeight+"px"}}};b.directive("ngCellHasFocus",["$domUtilityService",function(e){var n=function(n){n.isFocused=!0,e.digest(n),n.$broadcast("ngGridEventStartCellEdit"),n.$emit("ngGridEventStartCellEdit"),n.$on("$destroy",n.$on("ngGridEventEndCellEdit",function(){n.isFocused=!1,e.digest(n)}))};return function(e,t){function o(){return e.enableCellEditOnFocus?c=!0:t.focus(),!0}function i(o){e.enableCellEditOnFocus&&(o.preventDefault(),c=!1,n(e,t))}function r(){return s=!0,e.enableCellEditOnFocus&&!c&&n(e,t),!0}function l(){return s=!1,!0}function a(o){return e.enableCellEditOnFocus||(s&&37!==o.keyCode&&38!==o.keyCode&&39!==o.keyCode&&40!==o.keyCode&&9!==o.keyCode&&!o.shiftKey&&13!==o.keyCode&&n(e,t),s&&o.shiftKey&&o.keyCode>=65&&90>=o.keyCode&&n(e,t),27===o.keyCode&&t.focus()),!0}var s=!1,c=!1;e.editCell=function(){e.enableCellEditOnFocus||setTimeout(function(){n(e,t)},0)},t.bind("mousedown",o),t.bind("click",i),t.bind("focus",r),t.bind("blur",l),t.bind("keydown",a),t.on("$destroy",function(){t.off("mousedown",o),t.off("click",i),t.off("focus",r),t.off("blur",l),t.off("keydown",a)})}}]),b.directive("ngCellText",function(){return function(e,n){function t(e){e.preventDefault()}function o(e){e.preventDefault()}n.bind("mouseover",t),n.bind("mouseleave",o),n.on("$destroy",function(){n.off("mouseover",t),n.off("mouseleave",o)})}}),b.directive("ngCell",["$compile","$domUtilityService","$utilityService",function(e,t,o){var i={scope:!1,compile:function(){return{pre:function(t,i){var r,l=t.col.cellTemplate.replace(d,o.preEval("row.entity."+t.col.field));t.col.enableCellEdit?(r=t.col.cellEditTemplate,r=r.replace(h,t.col.cellEditableCondition),r=r.replace(u,l),r=r.replace(f,t.col.editableCellTemplate.replace(d,o.preEval("row.entity."+t.col.field)))):r=l;var a=n(r);i.append(a),e(a)(t),t.enableCellSelection&&-1===a[0].className.indexOf("ngSelectionCell")&&(a[0].setAttribute("tabindex",0),a.addClass("ngCellElement"))},post:function(e,n){e.enableCellSelection&&e.domAccessProvider.selectionHandlers(e,n),e.$on("$destroy",e.$on("ngGridEventDigestCell",function(){t.digest(e)}))}}}};return i}]),b.directive("ngEditCellIf",[function(){return{transclude:"element",priority:1e3,terminal:!0,restrict:"A",compile:function(e,n,t){return function(e,n,o){var i,r;e.$on("$destroy",e.$watch(o.ngEditCellIf,function(o){i&&(i.remove(),i=void 0),r&&(r.$destroy(),r=void 0),o&&(r=e.$new(),t(r,function(e){i=e,n.after(e)}))}))}}}}]),b.directive("ngGridFooter",["$compile","$templateCache",function(e,n){var t={scope:!1,compile:function(){return{pre:function(t,o){0===o.children().length&&o.append(e(n.get(t.gridId+"footerTemplate.html"))(t))}}}};return t}]),b.directive("ngGridMenu",["$compile","$templateCache",function(e,n){var t={scope:!1,compile:function(){return{pre:function(t,o){0===o.children().length&&o.append(e(n.get(t.gridId+"menuTemplate.html"))(t))}}}};return t}]),b.directive("ngGrid",["$compile","$filter","$templateCache","$sortService","$domUtilityService","$utilityService","$timeout","$parse","$http","$q",function(e,t,o,i,r,l,a,s,c,g){var d={scope:!0,compile:function(){return{pre:function(d,u,f){var h=n(u),p=d.$eval(f.ngGrid);p.gridDim=new P({outerHeight:n(h).height(),outerWidth:n(h).width()});var m=new L(d,p,i,r,t,o,l,a,s,c,g);return d.$on("$destroy",function(){p.gridDim=null,p.selectRow=null,p.selectItem=null,p.selectAll=null,p.selectVisible=null,p.groupBy=null,p.sortBy=null,p.gridId=null,p.ngGrid=null,p.$gridScope=null,p.$gridServices=null,d.domAccessProvider.grid=null,angular.element(m.styleSheet).remove(),m.styleSheet=null}),m.init().then(function(){if("string"==typeof p.columnDefs?d.$on("$destroy",d.$parent.$watch(p.columnDefs,function(e){return e?(m.lateBoundColumns=!1,d.columns=[],m.config.columnDefs=e,m.buildColumns(),m.eventProvider.assignEvents(),r.RebuildGrid(d,m),void 0):(m.refreshDomSizes(),m.buildColumns(),void 0)},!0)):m.buildColumns(),"string"==typeof p.totalServerItems?d.$on("$destroy",d.$parent.$watch(p.totalServerItems,function(e){d.totalServerItems=angular.isDefined(e)?e:0})):d.totalServerItems=0,"string"==typeof p.data){var t=function(e){m.data=n.extend([],e),m.rowFactory.fixRowCache(),angular.forEach(m.data,function(e,n){var t=m.rowMap[n]||n;m.rowCache[t]&&m.rowCache[t].ensureEntity(e),m.rowMap[t]=n}),m.searchProvider.evalFilter(),m.configureColumnWidths(),m.refreshDomSizes(),m.config.sortInfo.fields.length>0&&(m.sortColumnsInit(),d.$emit("ngGridEventSorted",m.config.sortInfo)),d.$emit("ngGridEventData",m.gridId)};d.$on("$destroy",d.$parent.$watch(p.data,t)),d.$on("$destroy",d.$parent.$watch(p.data+".length",function(){t(d.$eval(p.data)),d.adjustScrollTop(m.$viewport.scrollTop(),!0)}))}return m.footerController=new D(d,m),u.addClass("ngGrid").addClass(""+m.gridId),p.enableHighlighting||u.addClass("unselectable"),p.jqueryUITheme&&u.addClass("ui-widget"),u.append(e(o.get("gridTemplate.html"))(d)),r.AssignGridContainers(d,u,m),m.eventProvider=new $(m,d,r,a),p.selectRow=function(e,n){m.rowCache[e]&&(m.rowCache[e].clone&&m.rowCache[e].clone.setSelection(n?!0:!1),m.rowCache[e].setSelection(n?!0:!1))},p.selectItem=function(e,n){p.selectRow(m.rowMap[e],n)},p.selectAll=function(e){d.toggleSelectAll(e)},p.selectVisible=function(e){d.toggleSelectAll(e,!0)},p.groupBy=function(e){if(e)d.groupBy(d.columns.filter(function(n){return n.field===e})[0]);else{var t=n.extend(!0,[],d.configGroups);angular.forEach(t,d.groupBy)}},p.sortBy=function(e){var n=d.columns.filter(function(n){return n.field===e})[0];n&&n.sort()},p.gridId=m.gridId,p.ngGrid=m,p.$gridScope=d,p.$gridServices={SortService:i,DomUtilityService:r,UtilityService:l},d.$on("$destroy",d.$on("ngGridEventDigestGrid",function(){r.digest(d.$parent)})),d.$on("$destroy",d.$on("ngGridEventDigestGridParent",function(){r.digest(d.$parent)})),d.$evalAsync(function(){d.adjustScrollLeft(0)}),angular.forEach(p.plugins,function(e){"function"==typeof e&&(e=new e);var n=d.$new();e.init(n,m,p.$gridServices),p.plugins[l.getInstanceType(e)]=e,d.$on("$destroy",function(){n.$destroy()})}),"function"==typeof p.init&&p.init(m,d),null})}}}};return d}]),b.directive("ngHeaderCell",["$compile",function(e){var n={scope:!1,compile:function(){return{pre:function(n,t){t.append(e(n.col.headerCellTemplate)(n))}}}};return n}]),b.directive("ngHeaderRow",["$compile","$templateCache",function(e,n){var t={scope:!1,compile:function(){return{pre:function(t,o){0===o.children().length&&o.append(e(n.get(t.gridId+"headerRowTemplate.html"))(t))}}}};return t}]),b.directive("ngInput",[function(){return{require:"ngModel",link:function(e,n,t,o){function i(t){switch(t.keyCode){case 37:case 38:case 39:case 40:t.stopPropagation();break;case 27:e.$$phase||e.$apply(function(){o.$setViewValue(a),n.blur()});break;case 13:(e.enableCellEditOnFocus&&e.totalFilteredItemsLength()-1>e.row.rowIndex&&e.row.rowIndex>0||e.col.enableCellEdit)&&n.blur()}return!0}function r(e){e.stopPropagation()}function l(e){e.stopPropagation()}var a,s=e.$watch("ngModel",function(){a=o.$modelValue,s()});n.bind("keydown",i),n.bind("click",r),n.bind("mousedown",l),n.on("$destroy",function(){n.off("keydown",i),n.off("click",r),n.off("mousedown",l)}),e.$on("$destroy",e.$on("ngGridEventStartCellEdit",function(){n.focus(),n.select()})),angular.element(n).bind("blur",function(){e.$emit("ngGridEventEndCellEdit")})}}}]),b.directive("ngRow",["$compile","$domUtilityService","$templateCache",function(e,n,t){var o={scope:!1,compile:function(){return{pre:function(o,i){if(o.row.elm=i,o.row.clone&&(o.row.clone.elm=i),o.row.isAggRow){var r=t.get(o.gridId+"aggregateTemplate.html");r=o.row.aggLabelFilter?r.replace(g,"| "+o.row.aggLabelFilter):r.replace(g,""),i.append(e(r)(o))}else i.append(e(t.get(o.gridId+"rowTemplate.html"))(o));o.$on("$destroy",o.$on("ngGridEventDigestRow",function(){n.digest(o)}))}}}};return o}]),b.directive("ngViewport",[function(){return function(e,n){function t(n){var t=n.target.scrollLeft,o=n.target.scrollTop;return e.$headerContainer&&e.$headerContainer.scrollLeft(t),e.adjustScrollLeft(t),e.adjustScrollTop(o),e.forceSyncScrolling?s():(clearTimeout(l),l=setTimeout(s,150)),r=t,a=o,i=!1,!0}function o(){return i=!0,n.focus&&n.focus(),!0}var i,r,l,a=0,s=function(){e.$root.$$phase||e.$digest()};n.bind("scroll",t),n.bind("mousewheel DOMMouseScroll",o),n.on("$destroy",function(){n.off("scroll",t),n.off("mousewheel DOMMouseScroll",o)}),e.enableCellSelection||e.domAccessProvider.selectionHandlers(e,n)}}]),e.ngGrid.i18n.da={ngAggregateLabel:"artikler",ngGroupPanelDescription:"Grupér rækker udfra en kolonne ved at trække dens overskift hertil.",ngSearchPlaceHolder:"Søg...",ngMenuText:"Vælg kolonner:",ngShowingItemsLabel:"Viste rækker:",ngTotalItemsLabel:"Rækker totalt:",ngSelectedItemsLabel:"Valgte rækker:",ngPageSizeLabel:"Side størrelse:",ngPagerFirstTitle:"Første side",ngPagerNextTitle:"Næste side",ngPagerPrevTitle:"Forrige side",ngPagerLastTitle:"Sidste side"},e.ngGrid.i18n.de={ngAggregateLabel:"eintrag",ngGroupPanelDescription:"Ziehen Sie eine Spaltenüberschrift hierhin um nach dieser Spalte zu gruppieren.",ngSearchPlaceHolder:"Suche...",ngMenuText:"Spalten auswählen:",ngShowingItemsLabel:"Zeige Einträge:",ngTotalItemsLabel:"Einträge gesamt:",ngSelectedItemsLabel:"Ausgewählte Einträge:",ngPageSizeLabel:"Einträge pro Seite:",ngPagerFirstTitle:"Erste Seite",ngPagerNextTitle:"Nächste Seite",ngPagerPrevTitle:"Vorherige Seite",ngPagerLastTitle:"Letzte Seite"},e.ngGrid.i18n.en={ngAggregateLabel:"items",ngGroupPanelDescription:"Drag a column header here and drop it to group by that column.",ngSearchPlaceHolder:"Search...",ngMenuText:"Choose Columns:",ngShowingItemsLabel:"Showing Items:",ngTotalItemsLabel:"Total Items:",ngSelectedItemsLabel:"Selected Items:",ngPageSizeLabel:"Page Size:",ngPagerFirstTitle:"First Page",ngPagerNextTitle:"Next Page",ngPagerPrevTitle:"Previous Page",ngPagerLastTitle:"Last Page"},e.ngGrid.i18n.es={ngAggregateLabel:"Artículos",ngGroupPanelDescription:"Arrastre un encabezado de columna aquí y soltarlo para agrupar por esa columna.",ngSearchPlaceHolder:"Buscar...",ngMenuText:"Elegir columnas:",ngShowingItemsLabel:"Artículos Mostrando:",ngTotalItemsLabel:"Artículos Totales:",ngSelectedItemsLabel:"Artículos Seleccionados:",ngPageSizeLabel:"Tamaño de Página:",ngPagerFirstTitle:"Primera Página",ngPagerNextTitle:"Página Siguiente",ngPagerPrevTitle:"Página Anterior",ngPagerLastTitle:"Última Página"},e.ngGrid.i18n.fa={ngAggregateLabel:"موردها",ngGroupPanelDescription:"یک عنوان ستون اینجا را بردار و به گروهی از آن ستون بیانداز.",ngSearchPlaceHolder:"جستجو...",ngMenuText:"انتخاب ستون‌ها:",ngShowingItemsLabel:"نمایش موردها:",ngTotalItemsLabel:"همهٔ موردها:",ngSelectedItemsLabel:"موردهای انتخاب‌شده:",ngPageSizeLabel:"اندازهٔ صفحه:",ngPagerFirstTitle:"صفحهٔ اول",ngPagerNextTitle:"صفحهٔ بعد",ngPagerPrevTitle:"صفحهٔ قبل",ngPagerLastTitle:"آخرین صفحه"},e.ngGrid.i18n.fr={ngAggregateLabel:"articles",ngGroupPanelDescription:"Faites glisser un en-tête de colonne ici et déposez-le vers un groupe par cette colonne.",ngSearchPlaceHolder:"Recherche...",ngMenuText:"Choisir des colonnes:",ngShowingItemsLabel:"Articles Affichage des:",ngTotalItemsLabel:"Nombre total d'articles:",ngSelectedItemsLabel:"Éléments Articles:",ngPageSizeLabel:"Taille de page:",ngPagerFirstTitle:"Première page",ngPagerNextTitle:"Page Suivante",ngPagerPrevTitle:"Page précédente",ngPagerLastTitle:"Dernière page"},e.ngGrid.i18n.nl={ngAggregateLabel:"items",ngGroupPanelDescription:"Sleep hier een kolomkop om op te groeperen.",ngSearchPlaceHolder:"Zoeken...",ngMenuText:"Kies kolommen:",ngShowingItemsLabel:"Toon items:",ngTotalItemsLabel:"Totaal items:",ngSelectedItemsLabel:"Geselecteerde items:",ngPageSizeLabel:"Pagina grootte:, ",ngPagerFirstTitle:"Eerste pagina",ngPagerNextTitle:"Volgende pagina",ngPagerPrevTitle:"Vorige pagina",ngPagerLastTitle:"Laatste pagina"},e.ngGrid.i18n["pt-br"]={ngAggregateLabel:"itens",ngGroupPanelDescription:"Arraste e solte uma coluna aqui para agrupar por essa coluna",ngSearchPlaceHolder:"Procurar...",ngMenuText:"Selecione as colunas:",ngShowingItemsLabel:"Mostrando os Itens:",ngTotalItemsLabel:"Total de Itens:",ngSelectedItemsLabel:"Items Selecionados:",ngPageSizeLabel:"Tamanho da Página:",ngPagerFirstTitle:"Primeira Página",ngPagerNextTitle:"Próxima Página",ngPagerPrevTitle:"Página Anterior",ngPagerLastTitle:"Última Página"},e.ngGrid.i18n.ru={ngAggregateLabel:"записи",ngGroupPanelDescription:"Перетащите сюда заголовок колонки для группировки по этой колонке.",ngSearchPlaceHolder:"Искать...",ngMenuText:"Выберите столбцы:",ngShowingItemsLabel:"Показаны записи:",ngTotalItemsLabel:"Всего записей:",ngSelectedItemsLabel:"Выбранные записи:",ngPageSizeLabel:"Строк на странице:",ngPagerFirstTitle:"Первая страница",ngPagerNextTitle:"Следующая страница",ngPagerPrevTitle:"Предыдущая страница",ngPagerLastTitle:"Последняя страница"},e.ngGrid.i18n["zh-cn"]={ngAggregateLabel:"条目",ngGroupPanelDescription:"拖曳表头到此处以进行分组",ngSearchPlaceHolder:"搜索...",ngMenuText:"数据分组与选择列：",ngShowingItemsLabel:"当前显示条目：",ngTotalItemsLabel:"条目总数：",ngSelectedItemsLabel:"选中条目：",ngPageSizeLabel:"每页显示数：",ngPagerFirstTitle:"回到首页",ngPagerNextTitle:"下一页",ngPagerPrevTitle:"上一页",ngPagerLastTitle:"前往尾页"},e.ngGrid.i18n["zh-tw"]={ngAggregateLabel:"筆",ngGroupPanelDescription:"拖拉表頭到此處以進行分組",ngSearchPlaceHolder:"搜尋...",ngMenuText:"選擇欄位：",ngShowingItemsLabel:"目前顯示筆數：",ngTotalItemsLabel:"總筆數：",ngSelectedItemsLabel:"選取筆數：",ngPageSizeLabel:"每頁顯示：",ngPagerFirstTitle:"第一頁",ngPagerNextTitle:"下一頁",ngPagerPrevTitle:"上一頁",ngPagerLastTitle:"最後頁"},angular.module("ngGrid").run(["$templateCache",function(e){e.put("aggregateTemplate.html",'<div ng-click="row.toggleExpand()" ng-style="rowStyle(row)" class="ngAggregate">\r\n    <span class="ngAggregateText">{{row.label CUSTOM_FILTERS}} ({{row.totalChildren()}} {{AggItemsLabel}})</span>\r\n    <div class="{{row.aggClass()}}"></div>\r\n</div>\r\n'),e.put("cellEditTemplate.html",'<div ng-cell-has-focus ng-dblclick="CELL_EDITABLE_CONDITION && editCell()">\r\n	<div ng-edit-cell-if="!(isFocused && CELL_EDITABLE_CONDITION)">	\r\n		DISPLAY_CELL_TEMPLATE\r\n	</div>\r\n	<div ng-edit-cell-if="isFocused && CELL_EDITABLE_CONDITION">\r\n		EDITABLE_CELL_TEMPLATE\r\n	</div>\r\n</div>\r\n'),e.put("cellTemplate.html",'<div class="ngCellText" ng-class="col.colIndex()"><span ng-cell-text>{{COL_FIELD CUSTOM_FILTERS}}</span></div>'),e.put("checkboxCellTemplate.html",'<div class="ngSelectionCell"><input tabindex="-1" class="ngSelectionCheckbox" type="checkbox" ng-checked="row.selected" /></div>'),e.put("checkboxHeaderTemplate.html",'<input class="ngSelectionHeader" type="checkbox" ng-show="multiSelect" ng-model="allSelected" ng-change="toggleSelectAll(allSelected, true)"/>'),e.put("editableCellTemplate.html",'<input ng-class="\'colt\' + col.index" ng-input="COL_FIELD" ng-model="COL_FIELD" />'),e.put("footerTemplate.html",'<div ng-show="showFooter" class="ngFooterPanel" ng-class="{\'ui-widget-content\': jqueryUITheme, \'ui-corner-bottom\': jqueryUITheme}" ng-style="footerStyle()">\r\n    <div class="ngTotalSelectContainer" >\r\n        <div class="ngFooterTotalItems" ng-class="{\'ngNoMultiSelect\': !multiSelect}" >\r\n            <span class="ngLabel">{{i18n.ngTotalItemsLabel}} {{maxRows()}}</span><span ng-show="filterText.length > 0" class="ngLabel">({{i18n.ngShowingItemsLabel}} {{totalFilteredItemsLength()}})</span>\r\n        </div>\r\n        <div class="ngFooterSelectedItems" ng-show="multiSelect">\r\n            <span class="ngLabel">{{i18n.ngSelectedItemsLabel}} {{selectedItems.length}}</span>\r\n        </div>\r\n    </div>\r\n    <div class="ngPagerContainer" style="float: right; margin-top: 10px;" ng-show="enablePaging" ng-class="{\'ngNoMultiSelect\': !multiSelect}">\r\n        <div style="float:left; margin-right: 10px;" class="ngRowCountPicker">\r\n            <span style="float: left; margin-top: 3px;" class="ngLabel">{{i18n.ngPageSizeLabel}}</span>\r\n            <select style="float: left;height: 27px; width: 100px" ng-model="pagingOptions.pageSize" >\r\n                <option ng-repeat="size in pagingOptions.pageSizes">{{size}}</option>\r\n            </select>\r\n        </div>\r\n        <div style="float:left; margin-right: 10px; line-height:25px;" class="ngPagerControl" style="float: left; min-width: 135px;">\r\n            <button type="button" class="ngPagerButton" ng-click="pageToFirst()" ng-disabled="cantPageBackward()" title="{{i18n.ngPagerFirstTitle}}"><div class="ngPagerFirstTriangle"><div class="ngPagerFirstBar"></div></div></button>\r\n            <button type="button" class="ngPagerButton" ng-click="pageBackward()" ng-disabled="cantPageBackward()" title="{{i18n.ngPagerPrevTitle}}"><div class="ngPagerFirstTriangle ngPagerPrevTriangle"></div></button>\r\n            <input class="ngPagerCurrent" min="1" max="{{currentMaxPages}}" type="number" style="width:50px; height: 24px; margin-top: 1px; padding: 0 4px;" ng-model="pagingOptions.currentPage"/>\r\n            <span class="ngGridMaxPagesNumber" ng-show="maxPages() > 0">/ {{maxPages()}}</span>\r\n            <button type="button" class="ngPagerButton" ng-click="pageForward()" ng-disabled="cantPageForward()" title="{{i18n.ngPagerNextTitle}}"><div class="ngPagerLastTriangle ngPagerNextTriangle"></div></button>\r\n            <button type="button" class="ngPagerButton" ng-click="pageToLast()" ng-disabled="cantPageToLast()" title="{{i18n.ngPagerLastTitle}}"><div class="ngPagerLastTriangle"><div class="ngPagerLastBar"></div></div></button>\r\n        </div>\r\n    </div>\r\n</div>\r\n'),e.put("gridTemplate.html",'<div class="ngTopPanel" ng-class="{\'ui-widget-header\':jqueryUITheme, \'ui-corner-top\': jqueryUITheme}" ng-style="topPanelStyle()">\r\n    <div class="ngGroupPanel" ng-show="showGroupPanel()" ng-style="groupPanelStyle()">\r\n        <div class="ngGroupPanelDescription" ng-show="configGroups.length == 0">{{i18n.ngGroupPanelDescription}}</div>\r\n        <ul ng-show="configGroups.length > 0" class="ngGroupList">\r\n            <li class="ngGroupItem" ng-repeat="group in configGroups">\r\n                <span class="ngGroupElement">\r\n                    <span class="ngGroupName">{{group.displayName}}\r\n                        <span ng-click="removeGroup($index)" class="ngRemoveGroup">x</span>\r\n                    </span>\r\n                    <span ng-hide="$last" class="ngGroupArrow"></span>\r\n                </span>\r\n            </li>\r\n        </ul>\r\n    </div>\r\n    <div class="ngHeaderContainer" ng-style="headerStyle()">\r\n        <div ng-header-row class="ngHeaderScroller" ng-style="headerScrollerStyle()"></div>\r\n    </div>\r\n    <div ng-grid-menu></div>\r\n</div>\r\n<div class="ngViewport" unselectable="on" ng-viewport ng-class="{\'ui-widget-content\': jqueryUITheme}" ng-style="viewportStyle()">\r\n    <div class="ngCanvas" ng-style="canvasStyle()">\r\n        <div ng-style="rowStyle(row)" ng-repeat="row in renderedRows" ng-click="row.toggleSelected($event)" ng-class="row.alternatingRowClass()" ng-row></div>\r\n    </div>\r\n</div>\r\n<div ng-grid-footer></div>\r\n'),e.put("headerCellTemplate.html",'<div class="ngHeaderSortColumn {{col.headerClass}}" ng-style="{\'cursor\': col.cursor}" ng-class="{ \'ngSorted\': !col.noSortVisible() }">\r\n    <div ng-click="col.sort($event)" ng-class="\'colt\' + col.index" class="ngHeaderText">{{col.displayName}}</div>\r\n    <div class="ngSortButtonDown" ng-click="col.sort($event)" ng-show="col.showSortButtonDown()"></div>\r\n    <div class="ngSortButtonUp" ng-click="col.sort($event)" ng-show="col.showSortButtonUp()"></div>\r\n    <div class="ngSortPriority">{{col.sortPriority}}</div>\r\n    <div ng-class="{ ngPinnedIcon: col.pinned, ngUnPinnedIcon: !col.pinned }" ng-click="togglePin(col)" ng-show="col.pinnable"></div>\r\n</div>\r\n<div ng-show="col.resizable" class="ngHeaderGrip" ng-click="col.gripClick($event)" ng-mousedown="col.gripOnMouseDown($event)"></div>\r\n'),e.put("headerRowTemplate.html",'<div ng-style="{ height: col.headerRowHeight }" ng-repeat="col in renderedColumns" ng-class="col.colIndex()" class="ngHeaderCell">\r\n	<div class="ngVerticalBar" ng-style="{height: col.headerRowHeight}" ng-class="{ ngVerticalBarVisible: !$last }">&nbsp;</div>\r\n	<div ng-header-cell></div>\r\n</div>'),e.put("menuTemplate.html",'<div ng-show="showColumnMenu || showFilter"  class="ngHeaderButton" ng-click="toggleShowMenu()">\r\n    <div class="ngHeaderButtonArrow"></div>\r\n</div>\r\n<div ng-show="showMenu" class="ngColMenu">\r\n    <div ng-show="showFilter">\r\n        <input placeholder="{{i18n.ngSearchPlaceHolder}}" type="text" ng-model="filterText"/>\r\n    </div>\r\n    <div ng-show="showColumnMenu">\r\n        <span class="ngMenuText">{{i18n.ngMenuText}}</span>\r\n        <ul class="ngColList">\r\n            <li class="ngColListItem" ng-repeat="col in columns | ngColumns">\r\n                <label><input ng-disabled="col.pinned" type="checkbox" class="ngColListCheckbox" ng-model="col.visible"/>{{col.displayName}}</label>\r\n				<a title="Group By" ng-class="col.groupedByClass()" ng-show="col.groupable && col.visible" ng-click="groupBy(col)"></a>\r\n				<span class="ngGroupingNumber" ng-show="col.groupIndex > 0">{{col.groupIndex}}</span>          \r\n            </li>\r\n        </ul>\r\n    </div>\r\n</div>'),e.put("rowTemplate.html",'<div ng-style="{ \'cursor\': row.cursor }" ng-repeat="col in renderedColumns" ng-class="col.colIndex()" class="ngCell {{col.cellClass}}">\r\n	<div class="ngVerticalBar" ng-style="{height: rowHeight}" ng-class="{ ngVerticalBarVisible: !$last }">&nbsp;</div>\r\n	<div ng-cell></div>\r\n</div>')
}])})(window,jQuery);
/*! 
 * angular-loading-bar v0.7.1
 * https://chieffancypants.github.io/angular-loading-bar
 * Copyright (c) 2015 Wes Cruver
 * License: MIT
 */
!function(){"use strict";angular.module("angular-loading-bar",["cfp.loadingBarInterceptor"]),angular.module("chieffancypants.loadingBar",["cfp.loadingBarInterceptor"]),angular.module("cfp.loadingBarInterceptor",["cfp.loadingBar"]).config(["$httpProvider",function(a){var b=["$q","$cacheFactory","$timeout","$rootScope","$log","cfpLoadingBar",function(b,c,d,e,f,g){function h(){d.cancel(j),g.complete(),l=0,k=0}function i(b){var d,e=c.get("$http"),f=a.defaults;!b.cache&&!f.cache||b.cache===!1||"GET"!==b.method&&"JSONP"!==b.method||(d=angular.isObject(b.cache)?b.cache:angular.isObject(f.cache)?f.cache:e);var g=void 0!==d?void 0!==d.get(b.url):!1;return void 0!==b.cached&&g!==b.cached?b.cached:(b.cached=g,g)}var j,k=0,l=0,m=g.latencyThreshold;return{request:function(a){return a.ignoreLoadingBar||i(a)||(e.$broadcast("cfpLoadingBar:loading",{url:a.url}),0===k&&(j=d(function(){g.start()},m)),k++,g.set(l/k)),a},response:function(a){return a&&a.config?(a.config.ignoreLoadingBar||i(a.config)||(l++,e.$broadcast("cfpLoadingBar:loaded",{url:a.config.url,result:a}),l>=k?h():g.set(l/k)),a):(f.error("Broken interceptor detected: Config object not supplied in response:\n https://github.com/chieffancypants/angular-loading-bar/pull/50"),a)},responseError:function(a){return a&&a.config?(a.config.ignoreLoadingBar||i(a.config)||(l++,e.$broadcast("cfpLoadingBar:loaded",{url:a.config.url,result:a}),l>=k?h():g.set(l/k)),b.reject(a)):(f.error("Broken interceptor detected: Config object not supplied in rejection:\n https://github.com/chieffancypants/angular-loading-bar/pull/50"),b.reject(a))}}}];a.interceptors.push(b)}]),angular.module("cfp.loadingBar",[]).provider("cfpLoadingBar",function(){this.includeSpinner=!0,this.includeBar=!0,this.latencyThreshold=100,this.startSize=.02,this.parentSelector="body",this.spinnerTemplate='<div id="loading-bar-spinner"><div class="spinner-icon"></div></div>',this.loadingBarTemplate='<div id="loading-bar"><div class="bar"><div class="peg"></div></div></div>',this.$get=["$injector","$document","$timeout","$rootScope",function(a,b,c,d){function e(){k||(k=a.get("$animate"));var e=b.find(n).eq(0);c.cancel(m),r||(d.$broadcast("cfpLoadingBar:started"),r=!0,u&&k.enter(o,e,angular.element(e[0].lastChild)),t&&k.enter(q,e,angular.element(e[0].lastChild)),f(v))}function f(a){if(r){var b=100*a+"%";p.css("width",b),s=a,c.cancel(l),l=c(function(){g()},250)}}function g(){if(!(h()>=1)){var a=0,b=h();a=b>=0&&.25>b?(3*Math.random()+3)/100:b>=.25&&.65>b?3*Math.random()/100:b>=.65&&.9>b?2*Math.random()/100:b>=.9&&.99>b?.005:0;var c=h()+a;f(c)}}function h(){return s}function i(){s=0,r=!1}function j(){k||(k=a.get("$animate")),d.$broadcast("cfpLoadingBar:completed"),f(1),c.cancel(m),m=c(function(){var a=k.leave(o,i);a&&a.then&&a.then(i),k.leave(q)},500)}var k,l,m,n=this.parentSelector,o=angular.element(this.loadingBarTemplate),p=o.find("div").eq(0),q=angular.element(this.spinnerTemplate),r=!1,s=0,t=this.includeSpinner,u=this.includeBar,v=this.startSize;return{start:e,set:f,status:h,inc:g,complete:j,includeSpinner:this.includeSpinner,latencyThreshold:this.latencyThreshold,parentSelector:this.parentSelector,startSize:this.startSize}}]})}();
angular.module("ngUpload",[]).directive("uploadSubmit",["$parse",function(){function n(t,e){t=angular.element(t);var a=t.parent();return e=e.toLowerCase(),a&&a[0].tagName.toLowerCase()===e?a:a?n(a,e):null}return{restrict:"AC",link:function(t,e){e.bind("click",function(t){if(t&&(t.preventDefault(),t.stopPropagation()),!e.attr("disabled")){var a=n(e,"form");a.triggerHandler("submit"),a[0].submit()}})}}}]).directive("ngUpload",["$log","$parse","$document",function(n,t,e){function a(n){var t,a=e.find("head");return angular.forEach(a.find("meta"),function(e){e.getAttribute("name")===n&&(t=e)}),angular.element(t)}var r=1;return{restrict:"AC",link:function(e,o,i){function l(n){e.$isUploading=n}function d(){f.unbind("load"),e.$$phase?l(!1):e.$apply(function(){l(!1)});try{var t,a=(f[0].contentDocument||f[0].contentWindow.document).body;try{t=angular.fromJson(a.innerText||a.textContent)}catch(r){t=a.innerHTML,n.warn("Response is not valid JSON")}e.$$phase?p(e,{content:t}):e.$apply(function(){p(e,{content:t})})}catch(o){c&&(e.$$phase?c(e,{error:o}):e.$apply(function(){c(e,{error:o})}))}}r++;var u={},p=i.ngUpload?t(i.ngUpload):angular.noop,c=i.errorCatcher?t(i.errorCatcher):null,s=i.ngUploadLoading?t(i.ngUploadLoading):null;i.hasOwnProperty("uploadOptionsConvertHidden")&&(u.convertHidden="false"!=i.uploadOptionsConvertHidden),i.hasOwnProperty("uploadOptionsEnableRailsCsrf")&&(u.enableRailsCsrf="false"!=i.uploadOptionsEnableRailsCsrf),i.hasOwnProperty("uploadOptionsBeforeSubmit")&&(u.beforeSubmit=t(i.uploadOptionsBeforeSubmit)),o.attr({target:"upload-iframe-"+r,method:"post",enctype:"multipart/form-data",encoding:"multipart/form-data"});var f=angular.element('<iframe name="upload-iframe-'+r+'" '+'border="0" width="0" height="0" '+'style="width:0px;height:0px;border:none;display:none">');if(u.enableRailsCsrf){var m=angular.element("<input />");m.attr("class","upload-csrf-token"),m.attr("type","hidden"),m.attr("name",a("csrf-param").attr("content")),m.val(a("csrf-token").attr("content")),o.append(m)}o.after(f),l(!1),o.bind("submit",function(){var n=e[i.name];return n&&n.$invalid?!1:u.beforeSubmit&&u.beforeSubmit(e,{})===!1?!1:(f.bind("load",d),u.convertHidden&&angular.forEach(o.find("input"),function(n){var t=angular.element(n);t.attr("ng-model")&&t.attr("type")&&"hidden"==t.attr("type")&&t.attr("value",e.$eval(t.attr("ng-model")))}),e.$$phase?(s&&s(e),l(!0)):e.$apply(function(){s&&s(e),l(!0)}),void 0)})}}}]);
angular.module('ui.bootstrap.datetimepicker', ["ui.bootstrap"])
  .directive('datetimepicker', [
    function() {
      if (angular.version.full < '1.1.4') {
        return {
          restrict: 'EA',
          template: "<div class=\"alert alert-danger\">Angular 1.1.4 or above is required for datetimepicker to work correctly</div>"
        };
      }
      return {
        restrict: 'EA',
        require: 'ngModel',
        scope: {
          ngModel: '=',
          dayFormat: "=",
          monthFormat: "=",
          yearFormat: "=",
          dayHeaderFormat: "=",
          dayTitleFormat: "=",
          monthTitleFormat: "=",
          showWeeks: "=",
          startingDay: "=",
          yearRange: "=",
          dateFormat: "=",
          minDate: "=",
          maxDate: "=",
          dateOptions: "=",
          dateDisabled: "&",
          hourStep: "=",
          minuteStep: "=",
          showMeridian: "=",
          meredians: "=",
          mousewheel: "=",
          readonlyTime: "@"
        },
        template: function(elem, attrs) {
          function dashCase(name, separator) {
            return name.replace(/[A-Z]/g, function(letter, pos) {
              return (pos ? '-' : '') + letter.toLowerCase();
            });
          }

          function createAttr(innerAttr, dateTimeAttrOpt) {
            var dateTimeAttr = angular.isDefined(dateTimeAttrOpt) ? dateTimeAttrOpt : innerAttr;
            if (attrs[dateTimeAttr]) {
              return dashCase(innerAttr) + "=\"" + dateTimeAttr + "\" ";
            } else {
              return '';
            }
          }

          function createFuncAttr(innerAttr, funcArgs, dateTimeAttrOpt) {
            var dateTimeAttr = angular.isDefined(dateTimeAttrOpt) ? dateTimeAttrOpt : innerAttr;
            if (attrs[dateTimeAttr]) {
              return dashCase(innerAttr) + "=\"" + dateTimeAttr + "({" + funcArgs + "})\" ";
            } else {
              return '';
            }
          }

          function createEvalAttr(innerAttr, dateTimeAttrOpt) {
            var dateTimeAttr = angular.isDefined(dateTimeAttrOpt) ? dateTimeAttrOpt : innerAttr;
            if (attrs[dateTimeAttr]) {
              return dashCase(innerAttr) + "=\"" + attrs[dateTimeAttr] + "\" ";
            } else {
              return dashCase(innerAttr);
            }
          }

          function createAttrConcat(previousAttrs, attr) {
            return previousAttrs + createAttr.apply(null, attr)
          }
          var tmpl = "<div class=\"datetimepicker-wrapper\">" +
            "<input class=\"form-control\" type=\"text\" ng-model=\"ngModel\" " + [
              ["min", "minDate"],
              ["max", "maxDate"],
              ["dayFormat"],
              ["monthFormat"],
              ["yearFormat"],
              ["dayHeaderFormat"],
              ["dayTitleFormat"],
              ["monthTitleFormat"],
              ["showWeeks"],
              ["startingDay"],
              ["yearRange"],
              ["datepickerOptions", "dateOptions"]
          ].reduce(createAttrConcat, '') +
            createFuncAttr("dateDisabled", "date: date, mode: mode") +
            createEvalAttr("datepickerPopup", "dateFormat") +
            "/>\n" +
            "</div>\n" +
            "<div class=\"datetimepicker-wrapper\" ng-model=\"time\" ng-change=\"time_change()\" style=\"display:inline-block\">\n" +
            "<timepicker " + [
              ["hourStep"],
              ["minuteStep"],
              ["showMeridian"],
              ["meredians"],
              ["mousewheel"]
          ].reduce(createAttrConcat, '') +
            createEvalAttr("readonlyInput", "readonlyTime") +
            "></timepicker>\n" +
            "</div>";
          return tmpl;
        },
        controller: ['$scope',
          function($scope) {
            $scope.time_change = function() {
              if (angular.isDefined($scope.ngModel) && angular.isDefined($scope.time)) {
                $scope.ngModel.setHours($scope.time.getHours(), $scope.time.getMinutes());
              }
            }
          }
        ],
        link: function(scope) {
          scope.$watch(function() {
            return scope.ngModel;
          }, function(ngModel) {
            scope.time = ngModel;
          });
        }
      }
    }
  ]);

(function(e){var t={set:{colors:1,values:1,backgroundColor:1,scaleColors:1,normalizeFunction:1,focus:1},get:{selectedRegions:1,selectedMarkers:1,mapObject:1,regionName:1}};e.fn.vectorMap=function(e){var n,r,i,n=this.children(".jvectormap-container").data("mapObject");if(e==="addMap"){jvm.WorldMap.maps[arguments[1]]=arguments[2]}else{if(!(e!=="set"&&e!=="get"||!t[e][arguments[1]])){return r=arguments[1].charAt(0).toUpperCase()+arguments[1].substr(1),n[e+r].apply(n,Array.prototype.slice.call(arguments,2))}e=e||{},e.container=this,n=new jvm.WorldMap(e)}return this}})(jQuery),function(e){function r(t){var n=t||window.event,r=[].slice.call(arguments,1),i=0,s=!0,o=0,u=0;return t=e.event.fix(n),t.type="mousewheel",n.wheelDelta&&(i=n.wheelDelta/120),n.detail&&(i=-n.detail/3),u=i,n.axis!==undefined&&n.axis===n.HORIZONTAL_AXIS&&(u=0,o=-1*i),n.wheelDeltaY!==undefined&&(u=n.wheelDeltaY/120),n.wheelDeltaX!==undefined&&(o=-1*n.wheelDeltaX/120),r.unshift(t,i,o,u),(e.event.dispatch||e.event.handle).apply(this,r)}var t=["DOMMouseScroll","mousewheel"];if(e.event.fixHooks){for(var n=t.length;n;){e.event.fixHooks[t[--n]]=e.event.mouseHooks}}e.event.special.mousewheel={setup:function(){if(this.addEventListener){for(var e=t.length;e;){this.addEventListener(t[--e],r,!1)}}else{this.onmousewheel=r}},teardown:function(){if(this.removeEventListener){for(var e=t.length;e;){this.removeEventListener(t[--e],r,!1)}}else{this.onmousewheel=null}}},e.fn.extend({mousewheel:function(e){return e?this.bind("mousewheel",e):this.trigger("mousewheel")},unmousewheel:function(e){return this.unbind("mousewheel",e)}})}(jQuery);var jvm={inherits:function(e,t){function n(){}n.prototype=t.prototype,e.prototype=new n,e.prototype.constructor=e,e.parentClass=t},mixin:function(e,t){var n;for(n in t.prototype){t.prototype.hasOwnProperty(n)&&(e.prototype[n]=t.prototype[n])}},min:function(e){var t=Number.MAX_VALUE,n;if(e instanceof Array){for(n=0;n<e.length;n++){e[n]<t&&(t=e[n])}}else{for(n in e){e[n]<t&&(t=e[n])}}return t},max:function(e){var t=Number.MIN_VALUE,n;if(e instanceof Array){for(n=0;n<e.length;n++){e[n]>t&&(t=e[n])}}else{for(n in e){e[n]>t&&(t=e[n])}}return t},keys:function(e){var t=[],n;for(n in e){t.push(n)}return t},values:function(e){var t=[],n,r;for(r=0;r<arguments.length;r++){e=arguments[r];for(n in e){t.push(e[n])}}return t}};jvm.$=jQuery,jvm.AbstractElement=function(e,t){this.node=this.createElement(e),this.name=e,this.properties={},t&&this.set(t)},jvm.AbstractElement.prototype.set=function(e,t){var n;if(typeof e=="object"){for(n in e){this.properties[n]=e[n],this.applyAttr(n,e[n])}}else{this.properties[e]=t,this.applyAttr(e,t)}},jvm.AbstractElement.prototype.get=function(e){return this.properties[e]},jvm.AbstractElement.prototype.applyAttr=function(e,t){this.node.setAttribute(e,t)},jvm.AbstractElement.prototype.remove=function(){jvm.$(this.node).remove()},jvm.AbstractCanvasElement=function(e,t,n){this.container=e,this.setSize(t,n),this.rootElement=new jvm[this.classPrefix+"GroupElement"],this.node.appendChild(this.rootElement.node),this.container.appendChild(this.node)},jvm.AbstractCanvasElement.prototype.add=function(e,t){t=t||this.rootElement,t.add(e),e.canvas=this},jvm.AbstractCanvasElement.prototype.addPath=function(e,t,n){var r=new jvm[this.classPrefix+"PathElement"](e,t);return this.add(r,n),r},jvm.AbstractCanvasElement.prototype.addCircle=function(e,t,n){var r=new jvm[this.classPrefix+"CircleElement"](e,t);return this.add(r,n),r},jvm.AbstractCanvasElement.prototype.addGroup=function(e){var t=new jvm[this.classPrefix+"GroupElement"];return e?e.node.appendChild(t.node):this.node.appendChild(t.node),t.canvas=this,t},jvm.AbstractShapeElement=function(e,t,n){this.style=n||{},this.style.current={},this.isHovered=!1,this.isSelected=!1,this.updateStyle()},jvm.AbstractShapeElement.prototype.setHovered=function(e){this.isHovered!==e&&(this.isHovered=e,this.updateStyle())},jvm.AbstractShapeElement.prototype.setSelected=function(e){this.isSelected!==e&&(this.isSelected=e,this.updateStyle(),jvm.$(this.node).trigger("selected",[e]))},jvm.AbstractShapeElement.prototype.setStyle=function(e,t){var n={};typeof e=="object"?n=e:n[e]=t,jvm.$.extend(this.style.current,n),this.updateStyle()},jvm.AbstractShapeElement.prototype.updateStyle=function(){var e={};jvm.AbstractShapeElement.mergeStyles(e,this.style.initial),jvm.AbstractShapeElement.mergeStyles(e,this.style.current),this.isHovered&&jvm.AbstractShapeElement.mergeStyles(e,this.style.hover),this.isSelected&&(jvm.AbstractShapeElement.mergeStyles(e,this.style.selected),this.isHovered&&jvm.AbstractShapeElement.mergeStyles(e,this.style.selectedHover)),this.set(e)},jvm.AbstractShapeElement.mergeStyles=function(e,t){var n;t=t||{};for(n in t){t[n]===null?delete e[n]:e[n]=t[n]}},jvm.SVGElement=function(e,t){jvm.SVGElement.parentClass.apply(this,arguments)},jvm.inherits(jvm.SVGElement,jvm.AbstractElement),jvm.SVGElement.svgns="http://www.w3.org/2000/svg",jvm.SVGElement.prototype.createElement=function(e){return document.createElementNS(jvm.SVGElement.svgns,e)},jvm.SVGElement.prototype.addClass=function(e){this.node.setAttribute("class",e)},jvm.SVGElement.prototype.getElementCtr=function(e){return jvm["SVG"+e]},jvm.SVGElement.prototype.getBBox=function(){return this.node.getBBox()},jvm.SVGGroupElement=function(){jvm.SVGGroupElement.parentClass.call(this,"g")},jvm.inherits(jvm.SVGGroupElement,jvm.SVGElement),jvm.SVGGroupElement.prototype.add=function(e){this.node.appendChild(e.node)},jvm.SVGCanvasElement=function(e,t,n){this.classPrefix="SVG",jvm.SVGCanvasElement.parentClass.call(this,"svg"),jvm.AbstractCanvasElement.apply(this,arguments)},jvm.inherits(jvm.SVGCanvasElement,jvm.SVGElement),jvm.mixin(jvm.SVGCanvasElement,jvm.AbstractCanvasElement),jvm.SVGCanvasElement.prototype.setSize=function(e,t){this.width=e,this.height=t,this.node.setAttribute("width",e),this.node.setAttribute("height",t)},jvm.SVGCanvasElement.prototype.applyTransformParams=function(e,t,n){this.scale=e,this.transX=t,this.transY=n,this.rootElement.node.setAttribute("transform","scale("+e+") translate("+t+", "+n+")")},jvm.SVGShapeElement=function(e,t,n){jvm.SVGShapeElement.parentClass.call(this,e,t),jvm.AbstractShapeElement.apply(this,arguments)},jvm.inherits(jvm.SVGShapeElement,jvm.SVGElement),jvm.mixin(jvm.SVGShapeElement,jvm.AbstractShapeElement),jvm.SVGPathElement=function(e,t){jvm.SVGPathElement.parentClass.call(this,"path",e,t),this.node.setAttribute("fill-rule","evenodd")},jvm.inherits(jvm.SVGPathElement,jvm.SVGShapeElement),jvm.SVGCircleElement=function(e,t){jvm.SVGCircleElement.parentClass.call(this,"circle",e,t)},jvm.inherits(jvm.SVGCircleElement,jvm.SVGShapeElement),jvm.VMLElement=function(e,t){jvm.VMLElement.VMLInitialized||jvm.VMLElement.initializeVML(),jvm.VMLElement.parentClass.apply(this,arguments)},jvm.inherits(jvm.VMLElement,jvm.AbstractElement),jvm.VMLElement.VMLInitialized=!1,jvm.VMLElement.initializeVML=function(){try{document.namespaces.rvml||document.namespaces.add("rvml","urn:schemas-microsoft-com:vml"),jvm.VMLElement.prototype.createElement=function(e){return document.createElement("<rvml:"+e+' class="rvml">')}}catch(e){jvm.VMLElement.prototype.createElement=function(e){return document.createElement("<"+e+' xmlns="urn:schemas-microsoft.com:vml" class="rvml">')}}document.createStyleSheet().addRule(".rvml","behavior:url(#default#VML)"),jvm.VMLElement.VMLInitialized=!0},jvm.VMLElement.prototype.getElementCtr=function(e){return jvm["VML"+e]},jvm.VMLElement.prototype.addClass=function(e){jvm.$(this.node).addClass(e)},jvm.VMLElement.prototype.applyAttr=function(e,t){this.node[e]=t},jvm.VMLElement.prototype.getBBox=function(){var e=jvm.$(this.node);return{x:e.position().left/this.canvas.scale,y:e.position().top/this.canvas.scale,width:e.width()/this.canvas.scale,height:e.height()/this.canvas.scale}},jvm.VMLGroupElement=function(){jvm.VMLGroupElement.parentClass.call(this,"group"),this.node.style.left="0px",this.node.style.top="0px",this.node.coordorigin="0 0"},jvm.inherits(jvm.VMLGroupElement,jvm.VMLElement),jvm.VMLGroupElement.prototype.add=function(e){this.node.appendChild(e.node)},jvm.VMLCanvasElement=function(e,t,n){this.classPrefix="VML",jvm.VMLCanvasElement.parentClass.call(this,"group"),jvm.AbstractCanvasElement.apply(this,arguments),this.node.style.position="absolute"},jvm.inherits(jvm.VMLCanvasElement,jvm.VMLElement),jvm.mixin(jvm.VMLCanvasElement,jvm.AbstractCanvasElement),jvm.VMLCanvasElement.prototype.setSize=function(e,t){var n,r,i,s;this.width=e,this.height=t,this.node.style.width=e+"px",this.node.style.height=t+"px",this.node.coordsize=e+" "+t,this.node.coordorigin="0 0";if(this.rootElement){n=this.rootElement.node.getElementsByTagName("shape");for(i=0,s=n.length;i<s;i++){n[i].coordsize=e+" "+t,n[i].style.width=e+"px",n[i].style.height=t+"px"}r=this.node.getElementsByTagName("group");for(i=0,s=r.length;i<s;i++){r[i].coordsize=e+" "+t,r[i].style.width=e+"px",r[i].style.height=t+"px"}}},jvm.VMLCanvasElement.prototype.applyTransformParams=function(e,t,n){this.scale=e,this.transX=t,this.transY=n,this.rootElement.node.coordorigin=this.width-t-this.width/100+","+(this.height-n-this.height/100),this.rootElement.node.coordsize=this.width/e+","+this.height/e},jvm.VMLShapeElement=function(e,t){jvm.VMLShapeElement.parentClass.call(this,e,t),this.fillElement=new jvm.VMLElement("fill"),this.strokeElement=new jvm.VMLElement("stroke"),this.node.appendChild(this.fillElement.node),this.node.appendChild(this.strokeElement.node),this.node.stroked=!1,jvm.AbstractShapeElement.apply(this,arguments)},jvm.inherits(jvm.VMLShapeElement,jvm.VMLElement),jvm.mixin(jvm.VMLShapeElement,jvm.AbstractShapeElement),jvm.VMLShapeElement.prototype.applyAttr=function(e,t){switch(e){case"fill":this.node.fillcolor=t;break;case"fill-opacity":this.fillElement.node.opacity=Math.round(t*100)+"%";break;case"stroke":t==="none"?this.node.stroked=!1:this.node.stroked=!0,this.node.strokecolor=t;break;case"stroke-opacity":this.strokeElement.node.opacity=Math.round(t*100)+"%";break;case"stroke-width":parseInt(t,10)===0?this.node.stroked=!1:this.node.stroked=!0,this.node.strokeweight=t;break;case"d":this.node.path=jvm.VMLPathElement.pathSvgToVml(t);break;default:jvm.VMLShapeElement.parentClass.prototype.applyAttr.apply(this,arguments)}},jvm.VMLPathElement=function(e,t){var n=new jvm.VMLElement("skew");jvm.VMLPathElement.parentClass.call(this,"shape",e,t),this.node.coordorigin="0 0",n.node.on=!0,n.node.matrix="0.01,0,0,0.01,0,0",n.node.offset="0,0",this.node.appendChild(n.node)},jvm.inherits(jvm.VMLPathElement,jvm.VMLShapeElement),jvm.VMLPathElement.prototype.applyAttr=function(e,t){e==="d"?this.node.path=jvm.VMLPathElement.pathSvgToVml(t):jvm.VMLShapeElement.prototype.applyAttr.call(this,e,t)},jvm.VMLPathElement.pathSvgToVml=function(e){var t="",n=0,r=0,i,s;return e=e.replace(/(-?\d+)e(-?\d+)/g,"0"),e.replace(/([MmLlHhVvCcSs])\s*((?:-?\d*(?:\.\d+)?\s*,?\s*)+)/g,function(e,t,o,u){o=o.replace(/(\d)-/g,"$1,-").replace(/^\s+/g,"").replace(/\s+$/g,"").replace(/\s+/g,",").split(","),o[0]||o.shift();for(var a=0,f=o.length;a<f;a++){o[a]=Math.round(100*o[a])}switch(t){case"m":return n+=o[0],r+=o[1],"t"+o.join(",");case"M":return n=o[0],r=o[1],"m"+o.join(",");case"l":return n+=o[0],r+=o[1],"r"+o.join(",");case"L":return n=o[0],r=o[1],"l"+o.join(",");case"h":return n+=o[0],"r"+o[0]+",0";case"H":return n=o[0],"l"+n+","+r;case"v":return r+=o[0],"r0,"+o[0];case"V":return r=o[0],"l"+n+","+r;case"c":return i=n+o[o.length-4],s=r+o[o.length-3],n+=o[o.length-2],r+=o[o.length-1],"v"+o.join(",");case"C":return i=o[o.length-4],s=o[o.length-3],n=o[o.length-2],r=o[o.length-1],"c"+o.join(",");case"s":return o.unshift(r-s),o.unshift(n-i),i=n+o[o.length-4],s=r+o[o.length-3],n+=o[o.length-2],r+=o[o.length-1],"v"+o.join(",");case"S":return o.unshift(r+r-s),o.unshift(n+n-i),i=o[o.length-4],s=o[o.length-3],n=o[o.length-2],r=o[o.length-1],"c"+o.join(",")}return""}).replace(/z/g,"e")},jvm.VMLCircleElement=function(e,t){jvm.VMLCircleElement.parentClass.call(this,"oval",e,t)},jvm.inherits(jvm.VMLCircleElement,jvm.VMLShapeElement),jvm.VMLCircleElement.prototype.applyAttr=function(e,t){switch(e){case"r":this.node.style.width=t*2+"px",this.node.style.height=t*2+"px",this.applyAttr("cx",this.get("cx")||0),this.applyAttr("cy",this.get("cy")||0);break;case"cx":if(!t){return}this.node.style.left=t-(this.get("r")||0)+"px";break;case"cy":if(!t){return}this.node.style.top=t-(this.get("r")||0)+"px";break;default:jvm.VMLCircleElement.parentClass.prototype.applyAttr.call(this,e,t)}},jvm.VectorCanvas=function(e,t,n){return this.mode=window.SVGAngle?"svg":"vml",this.mode=="svg"?this.impl=new jvm.SVGCanvasElement(e,t,n):this.impl=new jvm.VMLCanvasElement(e,t,n),this.impl},jvm.SimpleScale=function(e){this.scale=e},jvm.SimpleScale.prototype.getValue=function(e){return e},jvm.OrdinalScale=function(e){this.scale=e},jvm.OrdinalScale.prototype.getValue=function(e){return this.scale[e]},jvm.NumericScale=function(e,t,n,r){this.scale=[],t=t||"linear",e&&this.setScale(e),t&&this.setNormalizeFunction(t),n&&this.setMin(n),r&&this.setMax(r)},jvm.NumericScale.prototype={setMin:function(e){this.clearMinValue=e,typeof this.normalize=="function"?this.minValue=this.normalize(e):this.minValue=e},setMax:function(e){this.clearMaxValue=e,typeof this.normalize=="function"?this.maxValue=this.normalize(e):this.maxValue=e},setScale:function(e){var t;for(t=0;t<e.length;t++){this.scale[t]=[e[t]]}},setNormalizeFunction:function(e){e==="polynomial"?this.normalize=function(e){return Math.pow(e,0.2)}:e==="linear"?delete this.normalize:this.normalize=e,this.setMin(this.clearMinValue),this.setMax(this.clearMaxValue)},getValue:function(e){var t=[],n=0,r,i=0,s;typeof this.normalize=="function"&&(e=this.normalize(e));for(i=0;i<this.scale.length-1;i++){r=this.vectorLength(this.vectorSubtract(this.scale[i+1],this.scale[i])),t.push(r),n+=r}s=(this.maxValue-this.minValue)/n;for(i=0;i<t.length;i++){t[i]*=s}i=0,e-=this.minValue;while(e-t[i]>=0){e-=t[i],i++}return i==this.scale.length-1?e=this.vectorToNum(this.scale[i]):e=this.vectorToNum(this.vectorAdd(this.scale[i],this.vectorMult(this.vectorSubtract(this.scale[i+1],this.scale[i]),e/t[i]))),e},vectorToNum:function(e){var t=0,n;for(n=0;n<e.length;n++){t+=Math.round(e[n])*Math.pow(256,e.length-n-1)}return t},vectorSubtract:function(e,t){var n=[],r;for(r=0;r<e.length;r++){n[r]=e[r]-t[r]}return n},vectorAdd:function(e,t){var n=[],r;for(r=0;r<e.length;r++){n[r]=e[r]+t[r]}return n},vectorMult:function(e,t){var n=[],r;for(r=0;r<e.length;r++){n[r]=e[r]*t}return n},vectorLength:function(e){var t=0,n;for(n=0;n<e.length;n++){t+=e[n]*e[n]}return Math.sqrt(t)}},jvm.ColorScale=function(e,t,n,r){jvm.ColorScale.parentClass.apply(this,arguments)},jvm.inherits(jvm.ColorScale,jvm.NumericScale),jvm.ColorScale.prototype.setScale=function(e){var t;for(t=0;t<e.length;t++){this.scale[t]=jvm.ColorScale.rgbToArray(e[t])}},jvm.ColorScale.prototype.getValue=function(e){return jvm.ColorScale.numToRgb(jvm.ColorScale.parentClass.prototype.getValue.call(this,e))},jvm.ColorScale.arrayToRgb=function(e){var t="#",n,r;for(r=0;r<e.length;r++){n=e[r].toString(16),t+=n.length==1?"0"+n:n}return t},jvm.ColorScale.numToRgb=function(e){e=e.toString(16);while(e.length<6){e="0"+e}return"#"+e},jvm.ColorScale.rgbToArray=function(e){return e=e.substr(1),[parseInt(e.substr(0,2),16),parseInt(e.substr(2,2),16),parseInt(e.substr(4,2),16)]},jvm.DataSeries=function(e,t){var n;e=e||{},e.attribute=e.attribute||"fill",this.elements=t,this.params=e,e.attributes&&this.setAttributes(e.attributes),jvm.$.isArray(e.scale)?(n=e.attribute==="fill"||e.attribute==="stroke"?jvm.ColorScale:jvm.NumericScale,this.scale=new n(e.scale,e.normalizeFunction,e.min,e.max)):e.scale?this.scale=new jvm.OrdinalScale(e.scale):this.scale=new jvm.SimpleScale(e.scale),this.values=e.values||{},this.setValues(this.values)},jvm.DataSeries.prototype={setAttributes:function(e,t){var n=e,r;if(typeof e=="string"){this.elements[e]&&this.elements[e].setStyle(this.params.attribute,t)}else{for(r in n){this.elements[r]&&this.elements[r].element.setStyle(this.params.attribute,n[r])}}},setValues:function(e){var t=Number.MIN_VALUE,n=Number.MAX_VALUE,r,i,s={};if(this.scale instanceof jvm.OrdinalScale||this.scale instanceof jvm.SimpleScale){for(i in e){e[i]?s[i]=this.scale.getValue(e[i]):s[i]=this.elements[i].element.style.initial[this.params.attribute]}}else{if(!this.params.min||!this.params.max){for(i in e){r=parseFloat(e[i]),r>t&&(t=e[i]),r<n&&(n=r)}this.params.min||this.scale.setMin(n),this.params.max||this.scale.setMax(t),this.params.min=n,this.params.max=t}for(i in e){r=parseFloat(e[i]),isNaN(r)?s[i]=this.elements[i].element.style.initial[this.params.attribute]:s[i]=this.scale.getValue(r)}}this.setAttributes(s),jvm.$.extend(this.values,e)},clear:function(){var e,t={};for(e in this.values){this.elements[e]&&(t[e]=this.elements[e].element.style.initial[this.params.attribute])}this.setAttributes(t),this.values={}},setScale:function(e){this.scale.setScale(e),this.values&&this.setValues(this.values)},setNormalizeFunction:function(e){this.scale.setNormalizeFunction(e),this.values&&this.setValues(this.values)}},jvm.Proj={degRad:180/Math.PI,radDeg:Math.PI/180,radius:6381372,sgn:function(e){return e>0?1:e<0?-1:e},mill:function(e,t,n){return{x:this.radius*(t-n)*this.radDeg,y:-this.radius*Math.log(Math.tan((45+0.4*e)*this.radDeg))/0.8}},mill_inv:function(e,t,n){return{lat:(2.5*Math.atan(Math.exp(0.8*t/this.radius))-5*Math.PI/8)*this.degRad,lng:(n*this.radDeg+e/this.radius)*this.degRad}},merc:function(e,t,n){return{x:this.radius*(t-n)*this.radDeg,y:-this.radius*Math.log(Math.tan(Math.PI/4+e*Math.PI/360))}},merc_inv:function(e,t,n){return{lat:(2*Math.atan(Math.exp(t/this.radius))-Math.PI/2)*this.degRad,lng:(n*this.radDeg+e/this.radius)*this.degRad}},aea:function(e,t,n){var r=0,i=n*this.radDeg,s=29.5*this.radDeg,o=45.5*this.radDeg,u=e*this.radDeg,a=t*this.radDeg,f=(Math.sin(s)+Math.sin(o))/2,l=Math.cos(s)*Math.cos(s)+2*f*Math.sin(s),c=f*(a-i),h=Math.sqrt(l-2*f*Math.sin(u))/f,p=Math.sqrt(l-2*f*Math.sin(r))/f;return{x:h*Math.sin(c)*this.radius,y:-(p-h*Math.cos(c))*this.radius}},aea_inv:function(e,t,n){var r=e/this.radius,i=t/this.radius,s=0,o=n*this.radDeg,u=29.5*this.radDeg,a=45.5*this.radDeg,f=(Math.sin(u)+Math.sin(a))/2,l=Math.cos(u)*Math.cos(u)+2*f*Math.sin(u),c=Math.sqrt(l-2*f*Math.sin(s))/f,h=Math.sqrt(r*r+(c-i)*(c-i)),p=Math.atan(r/(c-i));return{lat:Math.asin((l-h*h*f*f)/(2*f))*this.degRad,lng:(o+p/f)*this.degRad}},lcc:function(e,t,n){var r=0,i=n*this.radDeg,s=t*this.radDeg,o=33*this.radDeg,u=45*this.radDeg,a=e*this.radDeg,f=Math.log(Math.cos(o)*(1/Math.cos(u)))/Math.log(Math.tan(Math.PI/4+u/2)*(1/Math.tan(Math.PI/4+o/2))),l=Math.cos(o)*Math.pow(Math.tan(Math.PI/4+o/2),f)/f,c=l*Math.pow(1/Math.tan(Math.PI/4+a/2),f),h=l*Math.pow(1/Math.tan(Math.PI/4+r/2),f);return{x:c*Math.sin(f*(s-i))*this.radius,y:-(h-c*Math.cos(f*(s-i)))*this.radius}},lcc_inv:function(e,t,n){var r=e/this.radius,i=t/this.radius,s=0,o=n*this.radDeg,u=33*this.radDeg,a=45*this.radDeg,f=Math.log(Math.cos(u)*(1/Math.cos(a)))/Math.log(Math.tan(Math.PI/4+a/2)*(1/Math.tan(Math.PI/4+u/2))),l=Math.cos(u)*Math.pow(Math.tan(Math.PI/4+u/2),f)/f,c=l*Math.pow(1/Math.tan(Math.PI/4+s/2),f),h=this.sgn(f)*Math.sqrt(r*r+(c-i)*(c-i)),p=Math.atan(r/(c-i));return{lat:(2*Math.atan(Math.pow(l/h,1/f))-Math.PI/2)*this.degRad,lng:(o+p/f)*this.degRad}}},jvm.WorldMap=function(e){var t=this,n;this.params=jvm.$.extend(!0,{},jvm.WorldMap.defaultParams,e);if(!jvm.WorldMap.maps[this.params.map]){throw new Error("Attempt to use map which was not loaded: "+this.params.map)}this.mapData=jvm.WorldMap.maps[this.params.map],this.markers={},this.regions={},this.regionsColors={},this.regionsData={},this.container=jvm.$("<div>").css({width:"100%",height:"100%"}).addClass("jvectormap-container"),this.params.container.append(this.container),this.container.data("mapObject",this),this.container.css({position:"relative",overflow:"hidden"}),this.defaultWidth=this.mapData.width,this.defaultHeight=this.mapData.height,this.setBackgroundColor(this.params.backgroundColor),this.onResize=function(){t.setSize()},jvm.$(window).resize(this.onResize);for(n in jvm.WorldMap.apiEvents){this.params[n]&&this.container.bind(jvm.WorldMap.apiEvents[n]+".jvectormap",this.params[n])}this.canvas=new jvm.VectorCanvas(this.container[0],this.width,this.height),"ontouchstart" in window||window.DocumentTouch&&document instanceof DocumentTouch?this.params.bindTouchEvents&&this.bindContainerTouchEvents():this.bindContainerEvents(),this.bindElementEvents(),this.createLabel(),this.params.zoomButtons&&this.bindZoomButtons(),this.createRegions(),this.createMarkers(this.params.markers||{}),this.setSize(),this.params.focusOn&&(typeof this.params.focusOn=="object"?this.setFocus.call(this,this.params.focusOn.scale,this.params.focusOn.x,this.params.focusOn.y):this.setFocus.call(this,this.params.focusOn)),this.params.selectedRegions&&this.setSelectedRegions(this.params.selectedRegions),this.params.selectedMarkers&&this.setSelectedMarkers(this.params.selectedMarkers),this.params.series&&this.createSeries()},jvm.WorldMap.prototype={transX:0,transY:0,scale:1,baseTransX:0,baseTransY:0,baseScale:1,width:0,height:0,setBackgroundColor:function(e){this.container.css("background-color",e)},resize:function(){var e=this.baseScale;this.width/this.height>this.defaultWidth/this.defaultHeight?(this.baseScale=this.height/this.defaultHeight,this.baseTransX=Math.abs(this.width-this.defaultWidth*this.baseScale)/(2*this.baseScale)):(this.baseScale=this.width/this.defaultWidth,this.baseTransY=Math.abs(this.height-this.defaultHeight*this.baseScale)/(2*this.baseScale)),this.scale*=this.baseScale/e,this.transX*=this.baseScale/e,this.transY*=this.baseScale/e},setSize:function(){this.width=this.container.width(),this.height=this.container.height(),this.resize(),this.canvas.setSize(this.width,this.height),this.applyTransform()},reset:function(){var e,t;for(e in this.series){for(t=0;t<this.series[e].length;t++){this.series[e][t].clear()}}this.scale=this.baseScale,this.transX=this.baseTransX,this.transY=this.baseTransY,this.applyTransform()},applyTransform:function(){var e,t,n,r;this.defaultWidth*this.scale<=this.width?(e=(this.width-this.defaultWidth*this.scale)/(2*this.scale),n=(this.width-this.defaultWidth*this.scale)/(2*this.scale)):(e=0,n=(this.width-this.defaultWidth*this.scale)/this.scale),this.defaultHeight*this.scale<=this.height?(t=(this.height-this.defaultHeight*this.scale)/(2*this.scale),r=(this.height-this.defaultHeight*this.scale)/(2*this.scale)):(t=0,r=(this.height-this.defaultHeight*this.scale)/this.scale),this.transY>t?this.transY=t:this.transY<r&&(this.transY=r),this.transX>e?this.transX=e:this.transX<n&&(this.transX=n),this.canvas.applyTransformParams(this.scale,this.transX,this.transY),this.markers&&this.repositionMarkers(),this.container.trigger("viewportChange",[this.scale/this.baseScale,this.transX,this.transY])},bindContainerEvents:function(){var e=!1,t,n,r=this;this.container.mousemove(function(i){return e&&(r.transX-=(t-i.pageX)/r.scale,r.transY-=(n-i.pageY)/r.scale,r.applyTransform(),t=i.pageX,n=i.pageY),!1}).mousedown(function(r){return e=!0,t=r.pageX,n=r.pageY,!1}),jvm.$("body").mouseup(function(){e=!1}),this.params.zoomOnScroll&&this.container.mousewheel(function(e,t,n,i){var s=jvm.$(r.container).offset(),o=e.pageX-s.left,u=e.pageY-s.top,a=Math.pow(1.3,i);r.label.hide(),r.setScale(r.scale*a,o,u),e.preventDefault()})},bindContainerTouchEvents:function(){var e,t,n=this,r,i,s,o,u,a=function(a){var f=a.originalEvent.touches,l,c,h,p;a.type=="touchstart"&&(u=0),f.length==1?(u==1&&(h=n.transX,p=n.transY,n.transX-=(r-f[0].pageX)/n.scale,n.transY-=(i-f[0].pageY)/n.scale,n.applyTransform(),n.label.hide(),(h!=n.transX||p!=n.transY)&&a.preventDefault()),r=f[0].pageX,i=f[0].pageY):f.length==2&&(u==2?(c=Math.sqrt(Math.pow(f[0].pageX-f[1].pageX,2)+Math.pow(f[0].pageY-f[1].pageY,2))/t,n.setScale(e*c,s,o),n.label.hide(),a.preventDefault()):(l=jvm.$(n.container).offset(),f[0].pageX>f[1].pageX?s=f[1].pageX+(f[0].pageX-f[1].pageX)/2:s=f[0].pageX+(f[1].pageX-f[0].pageX)/2,f[0].pageY>f[1].pageY?o=f[1].pageY+(f[0].pageY-f[1].pageY)/2:o=f[0].pageY+(f[1].pageY-f[0].pageY)/2,s-=l.left,o-=l.top,e=n.scale,t=Math.sqrt(Math.pow(f[0].pageX-f[1].pageX,2)+Math.pow(f[0].pageY-f[1].pageY,2)))),u=f.length};jvm.$(this.container).bind("touchstart",a),jvm.$(this.container).bind("touchmove",a)},bindElementEvents:function(){var e=this,t;this.container.mousemove(function(){t=!0}),this.container.delegate("[class~='jvectormap-element']","mouseover mouseout",function(t){var n=this,r=jvm.$(this).attr("class").baseVal?jvm.$(this).attr("class").baseVal:jvm.$(this).attr("class"),i=r.indexOf("jvectormap-region")===-1?"marker":"region",s=i=="region"?jvm.$(this).attr("data-code"):jvm.$(this).attr("data-index"),o=i=="region"?e.regions[s].element:e.markers[s].element,u=i=="region"?e.mapData.paths[s].name:e.markers[s].config.name||"",a=jvm.$.Event(i+"LabelShow.jvectormap"),f=jvm.$.Event(i+"Over.jvectormap");t.type=="mouseover"?(e.container.trigger(f,[s]),f.isDefaultPrevented()||o.setHovered(!0),e.label.text(u),e.container.trigger(a,[e.label,s]),a.isDefaultPrevented()||(e.label.show(),e.labelWidth=e.label.width(),e.labelHeight=e.label.height())):(o.setHovered(!1),e.label.hide(),e.container.trigger(i+"Out.jvectormap",[s]))}),this.container.delegate("[class~='jvectormap-element']","mousedown",function(e){t=!1}),this.container.delegate("[class~='jvectormap-element']","mouseup",function(n){var r=this,i=jvm.$(this).attr("class").baseVal?jvm.$(this).attr("class").baseVal:jvm.$(this).attr("class"),s=i.indexOf("jvectormap-region")===-1?"marker":"region",o=s=="region"?jvm.$(this).attr("data-code"):jvm.$(this).attr("data-index"),u=jvm.$.Event(s+"Click.jvectormap"),a=s=="region"?e.regions[o].element:e.markers[o].element;if(!t){e.container.trigger(u,[o]);if(s==="region"&&e.params.regionsSelectable||s==="marker"&&e.params.markersSelectable){u.isDefaultPrevented()||(e.params[s+"sSelectableOne"]&&e.clearSelected(s+"s"),a.setSelected(!a.isSelected))}}})},bindZoomButtons:function(){var e=this;jvm.$("<div/>").addClass("jvectormap-zoomin").html("<i class='fa fa-plus'></i>").appendTo(this.container),jvm.$("<div/>").addClass("jvectormap-zoomout").html("<i class='fa fa-minus'></i>").appendTo(this.container),this.container.find(".jvectormap-zoomin").click(function(){e.setScale(e.scale*e.params.zoomStep,e.width/2,e.height/2)}),this.container.find(".jvectormap-zoomout").click(function(){e.setScale(e.scale/e.params.zoomStep,e.width/2,e.height/2)})},createLabel:function(){if($(".jvectormap-label").length){$(".jvectormap-label").remove()}var e=this;this.label=jvm.$("<div/>").addClass("jvectormap-label").appendTo(jvm.$("body")),this.container.mousemove(function(t){var n=t.pageX-15-e.labelWidth,r=t.pageY-15-e.labelHeight;n<5&&(n=t.pageX+15),r<5&&(r=t.pageY+15),e.label.is(":visible")&&e.label.css({left:n,top:r})})},setScale:function(e,t,n,r){var i,s=jvm.$.Event("zoom.jvectormap");e>this.params.zoomMax*this.baseScale?e=this.params.zoomMax*this.baseScale:e<this.params.zoomMin*this.baseScale&&(e=this.params.zoomMin*this.baseScale),typeof t!="undefined"&&typeof n!="undefined"&&(i=e/this.scale,r?(this.transX=t+this.defaultWidth*(this.width/(this.defaultWidth*e))/2,this.transY=n+this.defaultHeight*(this.height/(this.defaultHeight*e))/2):(this.transX-=(i-1)/e*t,this.transY-=(i-1)/e*n)),this.scale=e,this.applyTransform(),this.container.trigger(s,[e/this.baseScale])},setFocus:function(e,t,n){var r,i,s,o,u;if(jvm.$.isArray(e)||this.regions[e]){jvm.$.isArray(e)?o=e:o=[e];for(u=0;u<o.length;u++){this.regions[o[u]]&&(i=this.regions[o[u]].element.getBBox(),i&&(typeof r=="undefined"?r=i:(s={x:Math.min(r.x,i.x),y:Math.min(r.y,i.y),width:Math.max(r.x+r.width,i.x+i.width)-Math.min(r.x,i.x),height:Math.max(r.y+r.height,i.y+i.height)-Math.min(r.y,i.y)},r=s)))}this.setScale(Math.min(this.width/r.width,this.height/r.height),-(r.x+r.width/2),-(r.y+r.height/2),!0)}else{e*=this.baseScale,this.setScale(e,-t*this.defaultWidth,-n*this.defaultHeight,!0)}},getSelected:function(e){var t,n=[];for(t in this[e]){this[e][t].element.isSelected&&n.push(t)}return n},getSelectedRegions:function(){return this.getSelected("regions")},getSelectedMarkers:function(){return this.getSelected("markers")},setSelected:function(e,t){var n;typeof t!="object"&&(t=[t]);if(jvm.$.isArray(t)){for(n=0;n<t.length;n++){this[e][t[n]].element.setSelected(!0)}}else{for(n in t){this[e][n].element.setSelected(!!t[n])}}},setSelectedRegions:function(e){this.setSelected("regions",e)},setSelectedMarkers:function(e){this.setSelected("markers",e)},clearSelected:function(e){var t={},n=this.getSelected(e),r;for(r=0;r<n.length;r++){t[n[r]]=!1}this.setSelected(e,t)},clearSelectedRegions:function(){this.clearSelected("regions")},clearSelectedMarkers:function(){this.clearSelected("markers")},getMapObject:function(){return this},getRegionName:function(e){return this.mapData.paths[e].name},createRegions:function(){var e,t,n=this;for(e in this.mapData.paths){t=this.canvas.addPath({d:this.mapData.paths[e].path,"data-code":e},jvm.$.extend(!0,{},this.params.regionStyle)),jvm.$(t.node).bind("selected",function(e,t){n.container.trigger("regionSelected.jvectormap",[jvm.$(this).attr("data-code"),t,n.getSelectedRegions()])}),t.addClass("jvectormap-region jvectormap-element"),this.regions[e]={element:t,config:this.mapData.paths[e]}}},createMarkers:function(e){var t,n,r,i,s,o=this;this.markersGroup=this.markersGroup||this.canvas.addGroup();if(jvm.$.isArray(e)){s=e.slice(),e={};for(t=0;t<s.length;t++){e[t]=s[t]}}for(t in e){i=e[t] instanceof Array?{latLng:e[t]}:e[t],r=this.getMarkerPosition(i),r!==!1&&(n=this.canvas.addCircle({"data-index":t,cx:r.x,cy:r.y},jvm.$.extend(!0,{},this.params.markerStyle,{initial:i.style||{}}),this.markersGroup),n.addClass("jvectormap-marker jvectormap-element"),jvm.$(n.node).bind("selected",function(e,t){o.container.trigger("markerSelected.jvectormap",[jvm.$(this).attr("data-index"),t,o.getSelectedMarkers()])}),this.markers[t]&&this.removeMarkers([t]),this.markers[t]={element:n,config:i})}},repositionMarkers:function(){var e,t;for(e in this.markers){t=this.getMarkerPosition(this.markers[e].config),t!==!1&&this.markers[e].element.setStyle({cx:t.x,cy:t.y})}},getMarkerPosition:function(e){return jvm.WorldMap.maps[this.params.map].projection?this.latLngToPoint.apply(this,e.latLng||[0,0]):{x:e.coords[0]*this.scale+this.transX*this.scale,y:e.coords[1]*this.scale+this.transY*this.scale}},addMarker:function(e,t,n){var r={},i=[],s,o,n=n||[];r[e]=t;for(o=0;o<n.length;o++){s={},s[e]=n[o],i.push(s)}this.addMarkers(r,i)},addMarkers:function(e,t){var n;t=t||[],this.createMarkers(e);for(n=0;n<t.length;n++){this.series.markers[n].setValues(t[n]||{})}},removeMarkers:function(e){var t;for(t=0;t<e.length;t++){this.markers[e[t]].element.remove(),delete this.markers[e[t]]}},removeAllMarkers:function(){var e,t=[];for(e in this.markers){t.push(e)}this.removeMarkers(t)},latLngToPoint:function(e,t){var n,r=jvm.WorldMap.maps[this.params.map].projection,i=r.centralMeridian,s=this.width-this.baseTransX*2*this.baseScale,o=this.height-this.baseTransY*2*this.baseScale,u,a,f=this.scale/this.baseScale;return t<-180+i&&(t+=360),n=jvm.Proj[r.type](e,t,i),u=this.getInsetForPoint(n.x,n.y),u?(a=u.bbox,n.x=(n.x-a[0].x)/(a[1].x-a[0].x)*u.width*this.scale,n.y=(n.y-a[0].y)/(a[1].y-a[0].y)*u.height*this.scale,{x:n.x+this.transX*this.scale+u.left*this.scale,y:n.y+this.transY*this.scale+u.top*this.scale}):!1},pointToLatLng:function(e,t){var n=jvm.WorldMap.maps[this.params.map].projection,r=n.centralMeridian,i=jvm.WorldMap.maps[this.params.map].insets,s,o,u,a,f;for(s=0;s<i.length;s++){o=i[s],u=o.bbox,a=e-(this.transX*this.scale+o.left*this.scale),f=t-(this.transY*this.scale+o.top*this.scale),a=a/(o.width*this.scale)*(u[1].x-u[0].x)+u[0].x,f=f/(o.height*this.scale)*(u[1].y-u[0].y)+u[0].y;if(a>u[0].x&&a<u[1].x&&f>u[0].y&&f<u[1].y){return jvm.Proj[n.type+"_inv"](a,-f,r)}}return !1},getInsetForPoint:function(e,t){var n=jvm.WorldMap.maps[this.params.map].insets,r,i;for(r=0;r<n.length;r++){i=n[r].bbox;if(e>i[0].x&&e<i[1].x&&t>i[0].y&&t<i[1].y){return n[r]}}},createSeries:function(){var e,t;this.series={markers:[],regions:[]};for(t in this.params.series){for(e=0;e<this.params.series[t].length;e++){this.series[t][e]=new jvm.DataSeries(this.params.series[t][e],this[t])}}},remove:function(){this.label.remove(),this.container.remove(),jvm.$(window).unbind("resize",this.onResize)}},jvm.WorldMap.maps={},jvm.WorldMap.defaultParams={map:"world_mill_en",backgroundColor:"#505050",zoomButtons:!0,zoomOnScroll:!0,zoomMax:8,zoomMin:1,zoomStep:1.6,regionsSelectable:!1,markersSelectable:!1,bindTouchEvents:!0,regionStyle:{initial:{fill:"white","fill-opacity":1,stroke:"none","stroke-width":0,"stroke-opacity":1},hover:{"fill-opacity":0.8},selected:{fill:"yellow"},selectedHover:{}},markerStyle:{initial:{fill:"grey",stroke:"#505050","fill-opacity":1,"stroke-width":1,"stroke-opacity":1,r:5},hover:{stroke:"black","stroke-width":2},selected:{fill:"blue"},selectedHover:{}}},jvm.WorldMap.apiEvents={onRegionLabelShow:"regionLabelShow",onRegionOver:"regionOver",onRegionOut:"regionOut",onRegionClick:"regionClick",onRegionSelected:"regionSelected",onMarkerLabelShow:"markerLabelShow",onMarkerOver:"markerOver",onMarkerOut:"markerOut",onMarkerClick:"markerClick",onMarkerSelected:"markerSelected",onViewportChange:"viewportChange"};
$.fn.vectorMap('addMap', 'world_mill_en',{"insets": [{"width": 900.0, "top": 0, "height": 440.7063107441331, "bbox": [{"y": -12671671.123330014, "x": -20004297.151525836}, {"y": 6930392.02513512, "x": 20026572.394749384}], "left": 0}], "paths": {"BD": {"path": "M652.71,228.85l-0.04,1.38l-0.46,-0.21l-0.42,0.3l0.05,0.65l-0.17,-1.37l-0.48,-1.26l-1.08,-1.6l-0.23,-0.13l-2.31,-0.11l-0.31,0.36l0.21,0.98l-0.6,1.11l-0.8,-0.4l-0.37,0.09l-0.23,0.3l-0.54,-0.21l-0.78,-0.19l-0.38,-2.04l-0.83,-1.89l0.4,-1.5l-0.16,-0.35l-1.24,-0.57l0.36,-0.62l1.5,-0.95l0.02,-0.49l-1.62,-1.26l0.64,-1.31l1.7,1.0l0.12,0.04l0.96,0.11l0.19,1.62l0.25,0.26l2.38,0.37l2.32,-0.04l1.06,0.33l-0.92,1.79l-0.97,0.13l-0.23,0.16l-0.77,1.51l0.05,0.35l1.37,1.37l0.5,-0.14l0.35,-1.46l0.24,-0.0l1.24,3.92Z", "name": "Bangladesh"}, "BE": {"path": "M429.28,143.95l1.76,0.25l0.13,-0.01l2.16,-0.64l1.46,1.34l1.26,0.71l-0.23,1.8l-0.44,0.08l-0.24,0.25l-0.2,1.36l-1.8,-1.22l-0.23,-0.05l-1.14,0.23l-1.62,-1.43l-1.15,-1.31l-0.21,-0.1l-0.95,-0.04l-0.21,-0.68l1.66,-0.54Z", "name": "Belgium"}, "BF": {"path": "M413.48,260.21l-1.22,-0.46l-0.13,-0.02l-1.17,0.1l-0.15,0.06l-0.73,0.53l-0.87,-0.41l-0.39,-0.75l-0.13,-0.13l-0.98,-0.48l-0.14,-1.2l0.63,-0.99l0.05,-0.18l-0.05,-0.73l1.9,-2.01l0.08,-0.14l0.35,-1.65l0.49,-0.44l1.05,0.3l0.21,-0.02l1.05,-0.52l0.13,-0.13l0.3,-0.58l1.87,-1.1l0.11,-0.1l0.43,-0.72l2.23,-1.01l1.21,-0.32l0.51,0.4l0.19,0.06l1.25,-0.01l-0.14,0.89l0.01,0.13l0.34,1.16l0.06,0.11l1.35,1.59l0.07,1.13l0.24,0.28l2.64,0.53l-0.05,1.39l-0.42,0.59l-1.11,0.21l-0.22,0.17l-0.46,0.99l-0.69,0.23l-2.12,-0.05l-1.14,-0.2l-0.19,0.03l-0.72,0.36l-1.07,-0.17l-4.35,0.12l-0.29,0.29l-0.06,1.44l0.25,1.45Z", "name": "Burkina Faso"}, "BG": {"path": "M477.63,166.84l0.51,0.9l0.33,0.14l0.9,-0.21l1.91,0.47l3.68,0.16l0.17,-0.05l1.2,-0.75l2.78,-0.67l1.72,1.05l1.02,0.24l-0.97,0.97l-0.91,2.17l0.0,0.24l0.56,1.19l-1.58,-0.3l-0.16,0.01l-2.55,0.95l-0.2,0.28l-0.02,1.23l-1.92,0.24l-1.68,-0.99l-0.27,-0.02l-1.94,0.8l-1.52,-0.07l-0.15,-1.72l-0.12,-0.21l-0.99,-0.76l0.18,-0.18l0.02,-0.39l-0.17,-0.22l0.33,-0.75l0.91,-0.91l0.01,-0.42l-1.16,-1.25l-0.18,-0.89l0.24,-0.27Z", "name": "Bulgaria"}, "BA": {"path": "M468.39,164.66l0.16,0.04l0.43,-0.0l-0.43,0.93l0.06,0.34l1.08,1.06l-0.28,1.09l-0.5,0.13l-0.47,0.28l-0.86,0.74l-0.1,0.16l-0.28,1.29l-1.81,-0.94l-0.9,-1.22l-1.0,-0.73l-1.1,-1.1l-0.55,-0.96l-1.11,-1.3l0.3,-0.75l0.59,0.46l0.42,-0.04l0.46,-0.54l1.0,-0.06l2.11,0.5l1.72,-0.03l1.06,0.64Z", "name": "Bosnia and Herzegovina"}, "BN": {"path": "M707.34,273.57l0.76,-0.72l1.59,-1.03l-0.18,1.93l-0.9,-0.06l-0.28,0.14l-0.31,0.51l-0.68,-0.78Z", "name": "Brunei"}, "BO": {"path": "M263.83,340.79l-0.23,-0.12l-2.86,-0.11l-0.28,0.17l-0.77,1.67l-1.17,-1.51l-0.18,-0.11l-3.28,-0.64l-0.28,0.1l-2.02,2.3l-1.43,0.29l-0.91,-3.35l-1.31,-2.88l0.75,-2.41l-0.09,-0.32l-1.23,-1.03l-0.31,-1.76l-0.05,-0.12l-1.12,-1.6l1.49,-2.62l0.01,-0.28l-1.0,-2.0l0.48,-0.72l0.02,-0.29l-0.37,-0.78l0.87,-1.13l0.06,-0.18l0.05,-2.17l0.12,-1.71l0.5,-0.8l0.01,-0.3l-1.9,-3.58l1.3,0.15l1.34,-0.05l0.23,-0.12l0.51,-0.7l2.12,-0.99l1.31,-0.93l2.81,-0.37l-0.21,1.51l0.01,0.13l0.29,0.91l-0.19,1.64l0.11,0.27l2.72,2.27l0.15,0.07l2.71,0.41l0.92,0.88l0.12,0.07l1.64,0.49l1.0,0.71l0.18,0.06l1.5,-0.02l1.24,0.64l0.1,1.31l0.05,0.14l0.44,0.68l0.02,0.73l-0.44,0.03l-0.27,0.39l0.96,2.99l0.28,0.21l4.43,0.1l-0.28,1.12l0.0,0.15l0.27,1.02l0.15,0.19l1.27,0.67l0.52,1.42l-0.42,1.91l-0.66,1.1l-0.04,0.2l0.21,1.3l-0.19,0.13l-0.01,-0.27l-0.15,-0.24l-2.33,-1.33l-0.14,-0.04l-2.38,-0.03l-4.36,0.76l-0.21,0.16l-1.2,2.29l-0.03,0.13l-0.06,1.37l-0.79,2.53l-0.05,-0.08Z", "name": "Bolivia"}, "JP": {"path": "M781.17,166.78l1.8,0.67l0.28,-0.04l1.38,-1.01l0.43,2.67l-3.44,0.77l-0.18,0.12l-2.04,2.79l-3.71,-1.94l-0.42,0.15l-1.29,3.11l-2.32,0.04l-0.3,-2.63l1.12,-2.1l2.51,-0.16l0.28,-0.25l0.73,-4.22l0.58,-1.9l2.59,2.84l2.0,1.1ZM773.66,187.36l-0.92,2.24l-0.01,0.2l0.4,1.3l-1.18,1.81l-3.06,1.28l-4.35,0.17l-0.19,0.08l-3.4,3.06l-1.36,-0.87l-0.1,-1.95l-0.34,-0.28l-4.35,0.62l-2.99,1.33l-2.87,0.05l-0.28,0.2l0.09,0.33l2.37,1.93l-1.57,4.44l-1.35,0.97l-0.9,-0.79l0.57,-2.32l-0.15,-0.34l-1.5,-0.77l-0.81,-1.53l2.04,-0.75l0.14,-0.1l1.28,-1.72l2.47,-1.43l1.84,-1.92l4.83,-0.82l2.62,0.57l0.33,-0.16l2.45,-4.77l1.38,1.14l0.38,0.0l5.1,-4.02l0.09,-0.11l1.57,-3.57l0.02,-0.16l-0.42,-3.22l0.94,-1.67l2.27,-0.47l1.26,3.82l-0.07,2.23l-2.26,2.86l-0.06,0.19l0.04,2.93ZM757.85,196.18l0.22,0.66l-1.11,1.33l-0.8,-0.7l-0.33,-0.04l-1.28,0.65l-0.14,0.15l-0.54,1.34l-1.17,-0.57l0.02,-1.03l1.2,-1.45l1.24,0.28l0.29,-0.1l0.9,-1.03l1.51,0.5Z", "name": "Japan"}, "BI": {"path": "M494.7,295.83l-0.14,-2.71l-0.04,-0.13l-0.34,-0.62l0.93,0.12l0.3,-0.16l0.67,-1.25l0.9,0.11l0.11,0.76l0.08,0.16l0.46,0.48l0.02,0.56l-0.55,0.48l-0.96,1.29l-0.82,0.82l-0.61,0.07Z", "name": "Burundi"}, "BJ": {"path": "M427.4,268.94l-1.58,0.22l-0.52,-1.45l0.11,-5.73l-0.08,-0.21l-0.43,-0.44l-0.09,-1.13l-0.09,-0.19l-1.52,-1.52l0.24,-1.01l0.7,-0.23l0.18,-0.16l0.45,-0.97l1.07,-0.21l0.19,-0.12l0.53,-0.73l0.73,-0.65l0.68,-0.0l1.69,1.3l-0.08,0.67l0.02,0.14l0.52,1.38l-0.44,0.9l-0.01,0.24l0.2,0.52l-1.1,1.42l-0.76,0.76l-0.08,0.13l-0.47,1.59l0.05,1.69l-0.13,3.79Z", "name": "Benin"}, "BT": {"path": "M650.38,213.78l0.88,0.75l-0.13,1.24l-1.77,0.07l-2.1,-0.18l-1.57,0.4l-2.02,-0.91l-0.02,-0.24l1.54,-1.87l1.18,-0.6l1.67,0.59l1.32,0.08l1.01,0.67Z", "name": "Bhutan"}, "JM": {"path": "M226.67,238.37l1.64,0.23l1.2,0.56l0.11,0.19l-1.25,0.03l-0.14,0.04l-0.65,0.37l-1.24,-0.37l-1.17,-0.77l0.11,-0.22l0.86,-0.15l0.52,0.08Z", "name": "Jamaica"}, "BW": {"path": "M484.91,331.96l0.53,0.52l0.82,1.53l2.83,2.86l0.14,0.08l0.85,0.22l0.03,0.81l0.74,1.66l0.21,0.17l1.87,0.39l1.17,0.87l-3.13,1.71l-2.3,2.01l-0.07,0.1l-0.82,1.74l-0.66,0.88l-1.24,0.19l-0.24,0.2l-0.65,1.98l-1.4,0.55l-1.9,-0.12l-1.2,-0.74l-1.06,-0.32l-0.22,0.02l-1.22,0.62l-0.14,0.14l-0.58,1.21l-1.16,0.79l-1.18,1.13l-1.5,0.23l-0.4,-0.68l0.22,-1.53l-0.04,-0.19l-1.48,-2.54l-0.11,-0.11l-0.53,-0.31l-0.0,-7.25l2.18,-0.08l0.29,-0.3l0.07,-9.0l1.63,-0.08l3.69,-0.86l0.84,0.93l0.38,0.05l1.53,-0.97l0.79,-0.03l1.3,-0.53l0.23,0.1l0.92,1.96Z", "name": "Botswana"}, "BR": {"path": "M259.49,274.87l1.42,0.25l1.97,0.62l0.28,-0.05l0.67,-0.55l1.76,-0.38l2.8,-0.94l0.12,-0.08l0.92,-0.96l0.05,-0.33l-0.15,-0.32l0.73,-0.06l0.36,0.35l-0.27,0.93l0.17,0.36l0.76,0.34l0.44,0.9l-0.58,0.73l-0.06,0.13l-0.4,2.13l0.03,0.19l0.62,1.22l0.17,1.11l0.11,0.19l1.54,1.18l0.15,0.06l1.23,0.12l0.29,-0.15l0.2,-0.36l0.71,-0.11l1.13,-0.44l0.79,-0.63l1.25,0.19l0.65,-0.08l1.32,0.2l0.32,-0.18l0.23,-0.51l-0.05,-0.31l-0.31,-0.37l0.11,-0.31l0.75,0.17l0.13,0.0l1.1,-0.24l1.34,0.5l1.08,0.51l0.33,-0.05l0.67,-0.58l0.27,0.05l0.28,0.57l0.31,0.17l1.2,-0.18l0.17,-0.08l1.03,-1.05l0.76,-1.82l1.39,-2.16l0.49,-0.07l0.52,1.17l1.4,4.37l0.2,0.2l1.14,0.35l0.05,1.39l-1.8,1.97l0.01,0.42l0.78,0.75l0.18,0.08l4.16,0.37l0.08,2.25l0.5,0.22l1.78,-1.54l2.98,0.85l4.07,1.5l1.07,1.28l-0.37,1.23l0.36,0.38l2.83,-0.75l4.8,1.3l3.75,-0.09l3.6,2.02l3.27,2.84l1.93,0.72l2.13,0.11l0.76,0.66l1.22,4.56l-0.96,4.03l-1.22,1.58l-3.52,3.51l-1.63,2.91l-1.75,2.09l-0.5,0.04l-0.26,0.19l-0.72,1.99l0.18,4.76l-0.95,5.56l-0.74,0.96l-0.06,0.15l-0.43,3.39l-2.49,3.34l-0.06,0.13l-0.4,2.56l-1.9,1.07l-0.13,0.16l-0.51,1.38l-2.59,0.0l-3.94,1.01l-1.82,1.19l-2.85,0.81l-3.01,2.17l-2.12,2.65l-0.06,0.13l-0.36,2.0l0.01,0.13l0.4,1.42l-0.45,2.63l-0.53,1.23l-1.76,1.53l-2.76,4.79l-2.16,2.15l-1.69,1.29l-0.09,0.12l-1.12,2.6l-1.3,1.26l-0.45,-1.02l0.99,-1.18l0.01,-0.37l-1.5,-1.95l-1.98,-1.54l-2.58,-1.77l-0.2,-0.05l-0.81,0.07l-2.42,-2.05l-0.25,-0.07l-0.77,0.14l2.75,-3.07l2.8,-2.61l1.67,-1.09l2.11,-1.49l0.13,-0.24l0.05,-2.15l-0.07,-0.2l-1.26,-1.54l-0.35,-0.09l-0.64,0.27l0.3,-0.95l0.34,-1.57l0.01,-1.52l-0.16,-0.26l-0.9,-0.48l-0.27,-0.01l-0.86,0.39l-0.65,-0.08l-0.23,-0.8l-0.23,-2.39l-0.04,-0.12l-0.47,-0.79l-0.14,-0.12l-1.69,-0.71l-0.25,0.01l-0.93,0.47l-2.29,-0.44l0.15,-3.3l-0.03,-0.15l-0.62,-1.22l0.57,-0.39l0.13,-0.3l-0.22,-1.37l0.67,-1.13l0.44,-2.04l-0.01,-0.17l-0.59,-1.61l-0.14,-0.16l-1.25,-0.66l-0.22,-0.82l0.35,-1.41l-0.28,-0.37l-4.59,-0.1l-0.78,-2.41l0.34,-0.02l0.28,-0.31l-0.03,-1.1l-0.05,-0.16l-0.45,-0.68l-0.1,-1.4l-0.16,-0.24l-1.45,-0.76l-0.14,-0.03l-1.48,0.02l-1.04,-0.73l-1.62,-0.48l-0.93,-0.9l-0.16,-0.08l-2.72,-0.41l-2.53,-2.12l0.18,-1.54l-0.01,-0.13l-0.29,-0.91l0.26,-1.83l-0.34,-0.34l-3.28,0.43l-0.14,0.05l-1.3,0.93l-2.16,1.01l-0.12,0.09l-0.47,0.65l-1.12,0.05l-1.84,-0.21l-0.12,0.01l-1.33,0.41l-0.82,-0.21l0.16,-3.6l-0.48,-0.26l-1.97,1.43l-1.96,-0.06l-0.86,-1.23l-0.22,-0.13l-1.23,-0.11l0.34,-0.69l-0.05,-0.33l-1.36,-1.5l-0.92,-2.0l0.45,-0.32l0.13,-0.25l-0.0,-0.87l1.34,-0.64l0.17,-0.32l-0.23,-1.23l0.56,-0.77l0.05,-0.13l0.16,-1.03l2.7,-1.61l2.01,-0.47l0.16,-0.09l0.24,-0.27l2.11,0.11l0.31,-0.25l1.13,-6.87l0.06,-1.12l-0.4,-1.53l-0.1,-0.15l-1.0,-0.82l0.01,-1.45l1.08,-0.32l0.39,0.2l0.44,-0.24l0.08,-0.96l-0.25,-0.32l-1.22,-0.22l-0.02,-1.01l4.57,0.05l0.22,-0.09l0.6,-0.63l0.44,0.5l0.47,1.42l0.45,0.16l0.27,-0.18l1.21,1.16l0.23,0.08l1.95,-0.16l0.23,-0.14l0.43,-0.67l1.76,-0.55l1.05,-0.42l0.18,-0.2l0.25,-0.92l1.65,-0.66l0.18,-0.35l-0.14,-0.53l-0.26,-0.22l-1.91,-0.19l-0.29,-1.33l0.1,-1.64l-0.15,-0.28l-0.44,-0.25Z", "name": "Brazil"}, "BS": {"path": "M227.51,216.69l0.3,0.18l-0.24,1.07l0.03,-1.04l-0.09,-0.21ZM226.5,224.03l-0.13,0.03l-0.54,-1.3l-0.09,-0.12l-0.78,-0.64l0.4,-1.26l0.33,0.05l0.79,2.0l0.01,1.24ZM225.76,216.5l-2.16,0.34l-0.07,-0.41l0.85,-0.16l1.36,0.07l0.02,0.16Z", "name": "The Bahamas"}, "BY": {"path": "M480.08,135.28l2.09,0.02l0.13,-0.03l2.72,-1.3l0.16,-0.19l0.55,-1.83l1.94,-1.06l0.15,-0.31l-0.2,-1.33l1.33,-0.52l2.58,-1.3l2.39,0.8l0.3,0.75l0.37,0.17l1.22,-0.39l2.18,0.75l0.2,1.36l-0.48,0.85l0.01,0.32l1.57,2.26l0.92,0.6l-0.1,0.41l0.19,0.35l1.61,0.57l0.48,0.6l-0.64,0.49l-1.91,-0.11l-0.18,0.05l-0.48,0.32l-0.1,0.39l0.57,1.1l0.51,1.78l-1.79,0.17l-0.18,0.08l-0.77,0.73l-0.09,0.19l-0.13,1.31l-0.75,-0.22l-2.11,0.15l-0.56,-0.66l-0.39,-0.06l-0.8,0.49l-0.79,-0.4l-0.13,-0.03l-1.94,-0.07l-2.76,-0.79l-2.58,-0.27l-1.98,0.07l-0.15,0.05l-1.31,0.86l-0.8,0.09l-0.04,-1.16l-0.03,-0.12l-0.63,-1.28l1.22,-0.56l0.17,-0.27l0.01,-1.35l-0.04,-0.15l-0.66,-1.24l-0.08,-1.12Z", "name": "Belarus"}, "BZ": {"path": "M198.03,239.7l0.28,0.19l0.43,-0.1l0.82,-1.42l0.0,0.07l0.29,0.29l0.16,0.0l-0.02,0.35l-0.39,1.08l0.02,0.25l0.16,0.29l-0.23,0.8l0.04,0.24l0.09,0.14l-0.25,1.12l-0.38,0.53l-0.33,0.06l-0.21,0.15l-0.41,0.74l-0.25,0.0l0.17,-2.58l0.01,-2.2Z", "name": "Belize"}, "RU": {"path": "M688.57,38.85l0.63,2.39l0.44,0.19l2.22,-1.23l7.18,0.07l5.54,2.49l1.85,1.77l-0.55,2.34l-2.64,1.42l-6.57,2.76l-1.95,1.5l0.12,0.53l3.09,0.68l3.69,1.23l0.21,-0.01l1.98,-0.81l1.16,2.84l0.5,0.08l1.03,-1.18l3.86,-0.74l7.79,0.78l0.56,2.05l0.27,0.22l10.47,0.71l0.32,-0.29l0.13,-3.34l4.98,0.8l3.96,-0.02l3.88,2.43l1.06,2.79l-1.38,1.83l0.01,0.38l3.15,3.64l0.1,0.08l3.94,1.86l0.4,-0.14l2.28,-4.56l3.75,1.94l0.22,0.02l4.18,-1.22l4.76,1.4l0.26,-0.04l1.74,-1.23l3.98,0.63l0.32,-0.41l-1.71,-4.1l3.0,-1.86l22.39,3.04l2.06,2.67l0.1,0.08l6.55,3.51l0.17,0.03l10.08,-0.86l4.86,0.73l1.91,1.72l-0.29,3.13l0.18,0.31l3.08,1.26l0.19,0.01l3.32,-0.9l4.37,-0.11l4.78,0.87l4.61,-0.48l4.26,3.82l0.32,0.05l3.1,-1.4l0.12,-0.45l-1.91,-2.67l0.92,-1.64l7.78,1.22l5.22,-0.26l7.12,2.1l9.6,5.22l6.4,4.15l-0.2,2.44l0.14,0.28l1.69,1.04l0.45,-0.31l-0.51,-2.66l6.31,0.58l4.52,3.61l-2.1,1.52l-4.02,0.42l-0.27,0.29l-0.06,3.83l-0.81,0.67l-2.14,-0.11l-1.91,-1.39l-3.19,-1.13l-0.51,-1.63l-0.21,-0.2l-2.54,-0.67l-0.13,-0.0l-2.69,0.5l-1.12,-1.19l0.48,-1.36l-0.38,-0.39l-3.0,0.98l-0.17,0.44l1.02,1.76l-1.27,1.55l-3.09,1.71l-3.15,-0.29l-0.3,0.18l0.07,0.34l2.22,2.1l1.47,3.22l1.15,1.09l0.25,1.41l-0.48,0.76l-4.47,-0.81l-0.17,0.02l-6.97,2.9l-2.2,0.44l-0.11,0.05l-3.83,2.68l-3.63,2.32l-0.1,0.11l-0.76,1.4l-3.3,-2.4l-0.3,-0.03l-6.31,2.85l-0.99,-1.21l-0.4,-0.06l-2.32,1.54l-3.23,-0.49l-0.33,0.2l-0.79,2.39l-2.97,3.51l-0.07,0.21l0.09,1.47l0.22,0.27l2.62,0.74l-0.3,4.7l-2.06,0.12l-0.26,0.2l-1.07,2.94l0.04,0.27l0.83,1.19l-4.03,1.63l-0.18,0.21l-0.83,3.72l-3.55,0.79l-0.23,0.23l-0.73,3.32l-3.22,2.76l-0.76,-1.88l-1.07,-4.88l-1.39,-7.59l1.17,-4.76l2.05,-2.08l0.09,-0.19l0.11,-1.46l3.67,-0.77l0.15,-0.08l4.47,-4.61l4.29,-3.82l4.48,-3.01l0.11,-0.14l2.01,-5.43l-0.31,-0.4l-3.04,0.33l-0.24,0.17l-1.47,3.11l-5.98,3.94l-1.91,-4.36l-0.33,-0.17l-6.46,1.3l-0.15,0.08l-6.27,6.33l-0.01,0.41l1.7,1.87l-5.04,0.87l-3.51,0.34l0.16,-2.32l-0.26,-0.32l-3.89,-0.56l-0.19,0.04l-3.02,1.77l-7.63,-0.63l-8.24,1.1l-0.16,0.07l-8.11,7.09l-9.6,8.31l0.16,0.52l3.79,0.42l1.16,2.03l0.17,0.14l2.43,0.76l0.31,-0.08l1.5,-1.61l2.49,0.2l3.46,3.6l0.08,2.67l-1.91,3.26l-0.04,0.14l-0.21,3.91l-1.11,5.09l-3.73,4.55l-0.87,2.21l-6.73,7.14l-1.59,1.77l-3.23,1.72l-1.38,0.03l-1.48,-1.39l-0.37,-0.03l-3.36,2.22l-0.11,0.14l-0.16,0.42l-0.01,-1.09l1.0,-0.06l0.28,-0.27l0.36,-3.6l-0.61,-2.51l1.85,-0.94l2.94,0.53l0.32,-0.15l1.71,-3.1l0.84,-3.38l0.97,-1.18l1.32,-2.88l-0.34,-0.42l-4.14,0.95l-2.18,1.25l-3.51,-0.0l-0.95,-2.81l-0.1,-0.14l-2.97,-2.3l-0.11,-0.05l-4.19,-1.0l-0.89,-3.08l-0.87,-2.03l-0.95,-1.46l-1.54,-3.37l-0.12,-0.14l-2.27,-1.28l-3.83,-1.02l-3.37,0.1l-3.11,0.61l-0.13,0.06l-2.07,1.69l0.04,0.49l1.23,0.72l0.03,1.53l-1.34,1.05l-2.26,3.51l-0.05,0.17l0.02,1.27l-3.25,1.9l-2.87,-1.17l-0.14,-0.02l-2.86,0.26l-1.22,-1.02l-0.12,-0.06l-1.5,-0.35l-0.23,0.04l-3.62,2.27l-3.24,0.53l-2.28,0.79l-3.08,-0.51l-2.24,0.03l-1.49,-1.61l-2.45,-1.57l-0.11,-0.04l-2.6,-0.43l-3.17,0.43l-2.31,0.59l-3.31,-1.28l-0.45,-2.31l-0.21,-0.23l-2.94,-0.85l-2.26,-0.39l-2.77,-1.36l-0.37,0.09l-2.59,3.45l-0.03,0.32l0.91,1.74l-2.15,2.01l-3.47,-0.79l-2.44,-0.12l-1.59,-1.46l-0.2,-0.08l-2.55,-0.05l-2.12,-0.98l-0.24,-0.01l-3.85,1.57l-4.74,2.79l-2.59,0.55l-0.79,0.21l-1.21,-1.81l-0.29,-0.13l-3.05,0.41l-0.96,-1.25l-0.14,-0.1l-1.65,-0.6l-1.15,-1.82l-0.13,-0.12l-1.38,-0.6l-0.19,-0.02l-3.49,0.82l-3.35,-1.85l-0.38,0.08l-1.08,1.4l-5.36,-8.17l-3.02,-2.52l0.72,-0.85l0.01,-0.38l-0.37,-0.08l-6.22,3.21l-1.98,0.16l0.17,-1.51l-0.2,-0.31l-3.22,-1.17l-0.19,-0.0l-2.3,0.74l-0.72,-3.27l-0.24,-0.23l-4.5,-0.75l-0.21,0.04l-2.2,1.42l-6.21,1.27l-0.11,0.05l-1.16,0.81l-9.3,1.19l-0.18,0.09l-1.15,1.17l-0.02,0.39l1.56,2.01l-2.02,0.74l-0.16,0.42l0.35,0.68l-2.18,1.49l0.02,0.51l3.83,2.16l-0.45,1.13l-3.31,-0.13l-0.25,0.12l-0.57,0.77l-2.97,-1.59l-0.15,-0.04l-3.97,0.07l-0.13,0.03l-2.53,1.32l-2.84,-1.28l-5.52,-2.3l-0.12,-0.02l-3.91,0.09l-0.16,0.05l-5.17,3.6l-0.13,0.21l-0.25,1.89l-2.17,-1.6l-0.44,0.1l-2.0,3.59l0.06,0.37l0.55,0.5l-1.32,2.23l0.04,0.36l2.13,2.17l0.23,0.09l1.7,-0.08l1.42,1.89l-0.23,1.5l0.19,0.32l0.94,0.38l-0.89,1.44l-2.3,0.49l-0.17,0.11l-2.49,3.2l0.0,0.37l2.2,2.81l-0.23,1.93l0.06,0.22l2.56,3.32l-1.27,1.02l-0.4,0.66l-0.8,-0.15l-1.65,-1.75l-0.18,-0.09l-0.66,-0.09l-1.45,-0.64l-0.72,-1.16l-0.18,-0.13l-2.34,-0.63l-0.17,0.0l-1.32,0.41l-0.31,-0.4l-0.12,-0.09l-3.49,-1.48l-3.67,-0.49l-2.1,-0.52l-0.3,0.1l-0.12,0.14l-2.96,-2.4l-2.89,-1.19l-1.69,-1.42l1.27,-0.35l0.16,-0.1l2.08,-2.61l-0.04,-0.41l-1.02,-0.9l3.21,-1.12l0.2,-0.31l-0.07,-0.69l-0.37,-0.26l-1.86,0.42l0.05,-0.86l1.11,-0.76l2.35,-0.23l0.25,-0.19l0.39,-1.07l0.0,-0.19l-0.51,-1.64l0.95,-1.58l0.04,-0.16l-0.03,-0.95l-0.22,-0.28l-3.69,-1.06l-1.43,0.02l-1.45,-1.44l-0.29,-0.08l-1.83,0.49l-2.88,-1.04l0.04,-0.42l-0.04,-0.18l-0.89,-1.43l-0.23,-0.14l-1.77,-0.14l-0.13,-0.66l0.52,-0.56l0.01,-0.4l-1.6,-1.9l-0.27,-0.1l-2.55,0.32l-0.71,-0.16l-0.3,0.1l-0.53,0.63l-0.58,-0.08l-0.56,-1.97l-0.48,-0.94l0.17,-0.11l1.92,0.11l0.2,-0.06l0.97,-0.74l0.05,-0.42l-0.72,-0.91l-0.13,-0.1l-1.43,-0.51l0.09,-0.36l-0.13,-0.33l-0.97,-0.59l-1.43,-2.06l0.44,-0.77l0.04,-0.19l-0.25,-1.64l-0.2,-0.24l-2.45,-0.84l-0.19,-0.0l-1.05,0.34l-0.25,-0.62l-0.18,-0.17l-2.5,-0.84l-0.74,-1.93l-0.21,-1.7l-0.13,-0.21l-0.92,-0.63l0.83,-0.89l0.07,-0.27l-0.71,-3.26l1.69,-2.01l0.03,-0.34l-0.24,-0.41l2.63,-1.9l-0.01,-0.49l-2.31,-1.57l5.08,-4.61l2.33,-2.24l1.01,-2.08l-0.09,-0.37l-3.52,-2.56l0.94,-2.38l-0.04,-0.29l-2.14,-2.86l1.61,-3.35l-0.01,-0.29l-2.81,-4.58l2.19,-3.04l-0.06,-0.42l-3.7,-2.76l0.32,-2.67l1.87,-0.38l4.26,-1.77l2.46,-1.47l3.96,2.58l0.12,0.05l6.81,1.04l9.37,4.87l1.81,1.92l0.15,2.55l-2.61,2.06l-3.95,1.07l-11.1,-3.15l-0.17,0.0l-1.84,0.53l-0.1,0.53l3.97,2.97l0.15,1.77l0.16,4.14l0.19,0.27l3.21,1.22l1.94,1.03l0.44,-0.22l0.32,-1.94l-0.07,-0.25l-1.32,-1.52l1.25,-1.2l5.87,2.45l0.24,-0.01l2.11,-0.98l0.13,-0.42l-1.55,-2.75l5.52,-3.84l2.13,0.22l2.28,1.42l0.43,-0.12l1.46,-2.87l-0.04,-0.33l-1.97,-2.37l1.14,-2.38l-0.02,-0.3l-1.42,-2.07l6.15,1.22l1.14,1.92l-2.74,0.46l-0.25,0.3l0.02,2.36l0.12,0.24l1.97,1.44l0.25,0.05l3.87,-0.91l0.22,-0.23l0.58,-2.55l5.09,-1.98l8.67,-3.69l1.22,0.14l-2.06,2.2l0.18,0.5l3.11,0.45l0.23,-0.07l1.71,-1.41l4.59,-0.12l0.12,-0.03l3.53,-1.72l2.7,2.48l0.42,-0.01l2.85,-2.88l-0.0,-0.43l-2.42,-2.35l1.0,-1.13l7.2,1.31l3.42,1.36l9.06,4.97l0.39,-0.08l1.67,-2.27l-0.04,-0.4l-2.46,-2.23l-0.06,-0.82l-0.26,-0.27l-2.64,-0.38l0.69,-1.76l0.0,-0.22l-1.32,-3.47l-0.07,-1.27l4.52,-4.09l0.08,-0.11l1.6,-4.18l1.67,-0.84l6.33,1.2l0.46,2.31l-2.31,3.67l0.05,0.38l1.49,1.41l0.77,3.04l-0.56,6.05l0.09,0.24l2.62,2.54l-0.99,2.65l-4.87,5.96l0.17,0.48l2.86,0.61l0.31,-0.13l0.94,-1.42l2.67,-1.04l0.18,-0.19l0.64,-2.01l2.11,-1.98l0.05,-0.37l-1.38,-2.32l1.11,-2.74l-0.24,-0.41l-2.53,-0.33l-0.53,-2.16l1.96,-4.42l-0.05,-0.32l-3.03,-3.48l4.21,-2.94l0.12,-0.3l-0.52,-3.04l0.72,-0.06l1.18,2.35l-0.97,4.39l0.2,0.35l2.68,0.84l0.37,-0.38l-1.05,-3.07l3.89,-1.71l5.05,-0.24l4.55,2.62l0.36,-0.05l0.05,-0.36l-2.19,-3.84l-0.23,-4.78l4.07,-0.92l5.98,0.21l5.47,-0.64l0.2,-0.48l-1.88,-2.37l2.65,-2.99l2.75,-0.13l0.12,-0.03l4.82,-2.48l6.56,-0.67l0.23,-0.14l0.76,-1.27l6.33,-0.46l1.97,1.11l0.28,0.01l5.55,-2.71l4.53,0.08l0.29,-0.21l0.67,-2.18l2.29,-2.15l5.75,-2.13l3.48,1.4l-2.7,1.03l-0.19,0.31l0.26,0.26l5.47,0.78ZM871.83,65.73l0.25,-0.15l1.99,0.01l3.3,1.2l-0.08,0.22l-2.41,1.03l-5.73,0.49l-0.31,-1.0l2.99,-1.8ZM797.64,48.44l-2.22,1.51l-3.85,-0.43l-4.35,-1.85l0.42,-1.13l4.42,0.72l5.59,1.17ZM783.82,46.06l-1.71,3.25l-9.05,-0.14l-4.11,1.15l-4.64,-3.04l1.21,-3.13l3.11,-0.91l6.53,0.22l8.66,2.59ZM780.37,145.71l2.28,5.23l-3.09,-0.89l-0.37,0.19l-1.54,4.65l0.04,0.27l2.38,3.17l-0.05,1.4l-1.41,-1.41l-0.46,0.04l-1.23,1.81l-0.33,-1.86l0.28,-3.1l-0.28,-3.41l0.58,-2.46l0.11,-4.39l-0.03,-0.13l-1.44,-3.2l0.21,-4.39l2.19,-1.49l0.09,-0.41l-0.81,-1.3l0.48,-0.21l0.56,1.94l0.86,3.23l-0.05,3.36l1.03,3.35ZM780.16,57.18l-3.4,0.03l-5.06,-0.53l1.97,-1.59l2.95,-0.42l3.35,1.75l0.18,0.77ZM683.84,31.18l-13.29,1.97l4.16,-6.56l1.88,-0.58l1.77,0.34l6.08,3.02l-0.6,1.8ZM670.94,28.02l-5.18,0.65l-6.89,-1.58l-4.03,-2.07l-1.88,-3.98l-0.18,-0.16l-2.8,-0.93l5.91,-3.62l5.25,-1.29l4.73,2.88l5.63,5.44l-0.57,4.66ZM564.37,68.98l-0.85,0.23l-7.93,-0.57l-0.6,-1.84l-0.21,-0.2l-4.34,-1.18l-0.3,-2.08l2.34,-0.92l0.19,-0.29l-0.08,-2.43l4.85,-4.0l-0.12,-0.52l-1.68,-0.43l5.47,-3.94l0.11,-0.33l-0.6,-2.02l5.36,-2.55l8.22,-3.27l8.29,-0.96l4.34,-1.94l4.67,-0.65l1.45,1.72l-1.43,1.37l-8.8,2.52l-7.65,2.42l-7.92,4.84l-3.73,4.75l-3.92,4.58l-0.07,0.23l0.51,3.88l0.11,0.2l4.32,3.39ZM548.86,18.57l-3.28,0.75l-2.25,0.44l-0.22,0.19l-0.3,0.81l-2.67,0.86l-2.27,-1.14l1.2,-1.51l-0.23,-0.49l-3.14,-0.1l2.48,-0.54l3.55,-0.07l0.44,1.36l0.49,0.12l1.4,-1.35l2.2,-0.9l3.13,1.08l-0.54,0.49ZM477.5,133.25l-4.21,0.05l-2.69,-0.34l0.39,-1.03l3.24,-1.06l2.51,0.58l0.85,0.43l-0.2,0.71l-0.0,0.15l0.12,0.52Z", "name": "Russia"}, "RW": {"path": "M497.03,288.12l0.78,1.11l-0.12,1.19l-0.49,0.21l-1.25,-0.15l-0.3,0.16l-0.67,1.24l-1.01,-0.13l0.16,-0.92l0.22,-0.12l0.15,-0.24l0.09,-1.37l0.49,-0.48l0.42,0.18l0.25,-0.01l1.26,-0.65Z", "name": "Rwanda"}, "RS": {"path": "M469.75,168.65l0.21,-0.21l0.36,-1.44l-0.08,-0.29l-1.06,-1.03l0.54,-1.16l-0.28,-0.43l-0.26,0.0l0.55,-0.67l-0.01,-0.39l-0.77,-0.86l-0.45,-0.89l1.56,-0.67l1.39,0.12l1.22,1.1l0.26,0.91l0.16,0.19l1.38,0.66l0.17,1.12l0.14,0.21l1.46,0.9l0.35,-0.03l0.62,-0.54l0.09,0.06l-0.28,0.25l-0.03,0.42l0.29,0.34l-0.44,0.5l-0.07,0.26l0.22,1.12l0.07,0.14l1.02,1.1l-0.81,0.84l-0.42,0.96l0.04,0.3l0.12,0.15l-0.15,0.16l-1.04,0.04l-0.39,0.08l0.33,-0.81l-0.29,-0.41l-0.21,0.01l-0.39,-0.45l-0.13,-0.09l-0.32,-0.11l-0.27,-0.4l-0.14,-0.11l-0.4,-0.16l-0.31,-0.37l-0.34,-0.09l-0.45,0.17l-0.18,0.18l-0.29,0.84l-0.96,-0.65l-0.81,-0.33l-0.32,-0.37l-0.22,-0.18Z", "name": "Republic of Serbia"}, "LT": {"path": "M478.13,133.31l-0.14,-0.63l0.25,-0.88l-0.15,-0.35l-1.17,-0.58l-2.43,-0.57l-0.45,-2.51l2.58,-0.97l4.14,0.22l2.3,-0.32l0.26,0.54l0.22,0.17l1.26,0.22l2.25,1.6l0.19,1.23l-1.87,1.01l-0.14,0.18l-0.54,1.83l-2.54,1.21l-2.18,-0.02l-0.52,-0.91l-0.18,-0.14l-1.11,-0.32Z", "name": "Lithuania"}, "LU": {"path": "M435.95,147.99l0.33,0.49l-0.11,1.07l-0.39,0.04l-0.29,-0.15l0.21,-1.4l0.25,-0.05Z", "name": "Luxembourg"}, "LR": {"path": "M401.37,273.67l-0.32,0.01l-2.48,-1.15l-2.24,-1.89l-2.14,-1.38l-1.47,-1.42l0.44,-0.59l0.05,-0.13l0.12,-0.65l1.07,-1.3l1.08,-1.09l0.52,-0.07l0.43,-0.18l0.84,1.24l-0.15,0.89l0.07,0.25l0.49,0.54l0.22,0.1l0.71,0.01l0.27,-0.16l0.42,-0.83l0.19,0.02l-0.06,0.52l0.23,1.12l-0.5,1.03l0.06,0.35l0.73,0.69l0.14,0.08l0.71,0.15l0.92,0.91l0.06,0.76l-0.17,0.22l-0.06,0.15l-0.17,1.8Z", "name": "Liberia"}, "RO": {"path": "M477.94,155.19l1.02,-0.64l1.49,0.33l1.52,0.01l1.09,0.73l0.32,0.01l0.81,-0.46l1.8,-0.3l0.18,-0.1l0.54,-0.64l0.86,0.0l0.64,0.26l0.71,0.87l0.8,1.35l1.39,1.81l0.07,1.25l-0.26,1.3l0.01,0.15l0.45,1.42l0.15,0.18l1.12,0.57l0.25,0.01l1.05,-0.45l0.86,0.4l0.03,0.43l-0.92,0.51l-0.63,-0.24l-0.4,0.22l-0.64,3.41l-1.12,-0.24l-1.78,-1.09l-0.23,-0.04l-2.95,0.71l-1.25,0.77l-3.55,-0.16l-1.89,-0.47l-0.14,-0.0l-0.75,0.17l-0.61,-1.07l-0.3,-0.36l0.36,-0.32l-0.04,-0.48l-0.62,-0.38l-0.36,0.03l-0.62,0.54l-1.15,-0.71l-0.18,-1.14l-0.17,-0.22l-1.4,-0.67l-0.24,-0.86l-0.09,-0.14l-0.96,-0.87l1.49,-0.44l0.16,-0.11l1.51,-2.14l1.15,-2.09l1.44,-0.63Z", "name": "Romania"}, "GW": {"path": "M383.03,256.73l-1.12,-0.88l-0.14,-0.06l-0.94,-0.15l-0.43,-0.54l0.01,-0.27l-0.13,-0.26l-0.68,-0.48l-0.05,-0.16l0.99,-0.31l0.77,0.08l0.15,-0.02l0.61,-0.26l4.25,0.1l-0.02,0.44l-0.19,0.18l-0.08,0.29l0.17,0.66l-0.17,0.14l-0.44,0.0l-0.16,0.05l-0.57,0.37l-0.66,-0.04l-0.24,0.1l-0.92,1.03Z", "name": "Guinea Bissau"}, "GT": {"path": "M195.13,249.89l-1.05,-0.35l-1.5,-0.04l-1.06,-0.47l-1.19,-0.93l0.04,-0.53l0.27,-0.55l-0.03,-0.31l-0.24,-0.32l1.02,-1.77l3.04,-0.01l0.3,-0.28l0.06,-0.88l-0.19,-0.3l-0.3,-0.11l-0.23,-0.45l-0.11,-0.12l-0.9,-0.58l-0.35,-0.33l0.37,-0.0l0.3,-0.3l0.0,-1.15l4.05,0.02l-0.02,1.74l-0.2,2.89l0.3,0.32l0.67,-0.0l0.75,0.42l0.4,-0.11l-0.62,0.53l-1.17,0.7l-0.13,0.16l-0.18,0.49l0.0,0.21l0.14,0.34l-0.35,0.44l-0.49,0.13l-0.2,0.41l0.03,0.06l-0.27,0.16l-0.86,0.64l-0.12,0.22ZM199.35,245.38l0.07,-0.13l0.05,0.02l-0.13,0.11Z", "name": "Guatemala"}, "GR": {"path": "M487.2,174.55l-0.64,1.54l-0.43,0.24l-1.41,-0.08l-1.28,-0.28l-0.14,0.0l-3.03,0.77l-0.13,0.51l1.39,1.34l-0.78,0.29l-1.2,0.0l-1.23,-1.42l-0.47,0.02l-0.47,0.65l-0.04,0.27l0.56,1.76l0.06,0.11l1.02,1.12l-0.66,0.45l-0.04,0.46l1.39,1.35l1.15,0.79l0.02,1.06l-1.91,-0.63l-0.36,0.42l0.56,1.12l-1.2,0.23l-0.22,0.4l0.8,2.14l-1.15,0.02l-1.89,-1.15l-0.89,-2.19l-0.43,-1.91l-0.05,-0.11l-0.98,-1.35l-1.24,-1.62l-0.13,-0.63l1.07,-1.32l0.06,-0.14l0.13,-0.81l0.68,-0.36l0.16,-0.25l0.03,-0.54l1.4,-0.23l0.12,-0.05l0.87,-0.6l1.26,0.05l0.25,-0.11l0.34,-0.43l0.33,-0.07l1.81,0.08l0.13,-0.02l1.87,-0.77l1.64,0.97l0.19,0.04l2.28,-0.28l0.26,-0.29l0.02,-0.95l0.56,0.36ZM480.44,192.0l1.05,0.74l0.01,0.0l-1.26,-0.23l0.2,-0.51ZM481.76,192.79l1.86,-0.15l1.53,0.17l-0.02,0.19l0.34,0.3l-2.28,0.15l0.01,-0.13l-0.25,-0.31l-1.19,-0.22ZM485.65,193.28l0.65,-0.16l-0.05,0.12l-0.6,0.04Z", "name": "Greece"}, "GQ": {"path": "M444.81,282.04l-0.21,-0.17l0.74,-2.4l3.56,0.05l0.02,2.42l-3.34,-0.02l-0.76,0.13Z", "name": "Equatorial Guinea"}, "GY": {"path": "M271.34,264.25l1.43,0.81l1.44,1.53l0.06,1.19l0.28,0.28l0.84,0.05l2.13,1.92l-0.34,1.93l-1.37,0.59l-0.17,0.34l0.12,0.51l-0.43,1.21l0.03,0.26l1.11,1.82l0.26,0.14l0.56,0.0l0.32,1.29l1.25,1.78l-0.08,0.01l-1.34,-0.21l-0.24,0.06l-0.78,0.64l-1.06,0.41l-0.76,0.1l-0.22,0.15l-0.18,0.32l-0.95,-0.1l-1.38,-1.05l-0.19,-1.13l-0.6,-1.18l0.37,-1.96l0.65,-0.83l0.03,-0.32l-0.57,-1.17l-0.15,-0.14l-0.62,-0.27l0.25,-0.85l-0.08,-0.3l-0.58,-0.58l-0.24,-0.09l-1.15,0.1l-1.41,-1.58l0.48,-0.49l0.09,-0.22l-0.04,-0.92l1.31,-0.34l0.73,-0.52l0.04,-0.44l-0.75,-0.82l0.16,-0.66l1.74,-1.3Z", "name": "Guyana"}, "GE": {"path": "M525.41,174.19l0.26,-0.88l-0.0,-0.17l-0.63,-2.06l-0.1,-0.15l-1.45,-1.12l-0.11,-0.05l-1.31,-0.33l-0.66,-0.69l1.97,0.48l3.65,0.49l3.3,1.41l0.39,0.5l0.33,0.1l1.43,-0.45l2.14,0.58l0.7,1.14l0.13,0.12l1.06,0.47l-0.18,0.11l-0.08,0.43l1.08,1.41l-0.06,0.06l-1.16,-0.15l-1.82,-0.84l-0.31,0.04l-0.55,0.44l-3.29,0.44l-2.32,-1.41l-0.17,-0.04l-2.25,0.12Z", "name": "Georgia"}, "GB": {"path": "M412.82,118.6l-2.31,3.4l-0.0,0.33l0.31,0.13l2.52,-0.49l2.34,0.02l-0.56,2.51l-2.22,3.13l0.22,0.47l2.43,0.21l2.35,4.35l0.17,0.14l1.58,0.51l1.49,3.78l0.73,1.37l0.2,0.15l2.76,0.59l-0.25,1.75l-1.18,0.91l-0.08,0.39l0.87,1.49l-1.96,1.51l-3.31,-0.02l-4.15,0.88l-1.07,-0.59l-0.35,0.04l-1.55,1.44l-2.17,-0.35l-0.22,0.05l-1.61,1.15l-0.78,-0.38l3.31,-3.12l2.18,-0.7l0.21,-0.31l-0.26,-0.27l-3.78,-0.54l-0.48,-0.9l2.3,-0.92l0.13,-0.46l-1.29,-1.71l0.39,-1.83l3.46,0.29l0.32,-0.24l0.37,-1.99l-0.06,-0.24l-1.71,-2.17l-0.18,-0.11l-2.91,-0.58l-0.43,-0.68l0.82,-1.4l-0.03,-0.35l-0.82,-0.97l-0.46,0.01l-0.85,1.05l-0.11,-2.6l-0.05,-0.16l-1.19,-1.7l0.86,-3.53l1.81,-2.75l1.88,0.26l2.38,-0.24ZM406.39,132.84l-1.09,1.92l-1.65,-0.62l-1.26,0.02l0.41,-1.46l0.0,-0.16l-0.42,-1.51l1.62,-0.11l2.39,1.92Z", "name": "United Kingdom"}, "GA": {"path": "M448.76,294.47l-2.38,-2.34l-1.63,-2.04l-1.46,-2.48l0.06,-0.66l0.54,-0.81l0.61,-1.82l0.46,-1.69l0.63,-0.11l3.62,0.03l0.3,-0.3l-0.02,-2.75l0.88,-0.12l1.47,0.32l0.13,0.0l1.39,-0.3l-0.13,0.87l0.03,0.19l0.7,1.29l0.3,0.16l1.74,-0.19l0.36,0.29l-1.01,2.7l0.05,0.29l1.13,1.42l0.25,1.82l-0.3,1.56l-0.64,0.99l-1.93,-0.09l-1.26,-1.13l-0.5,0.17l-0.16,0.91l-1.48,0.27l-0.12,0.05l-0.86,0.63l-0.08,0.39l0.81,1.42l-1.48,1.08Z", "name": "Gabon"}, "GN": {"path": "M399.83,265.31l-0.69,-0.06l-0.3,0.16l-0.43,0.85l-0.39,-0.01l-0.3,-0.33l0.14,-0.87l-0.05,-0.22l-1.05,-1.54l-0.37,-0.11l-0.61,0.27l-0.84,0.12l0.02,-0.54l-0.04,-0.17l-0.35,-0.57l0.07,-0.63l-0.03,-0.17l-0.57,-1.11l-0.7,-0.9l-0.24,-0.12l-2.0,-0.0l-0.19,0.07l-0.51,0.42l-0.6,0.05l-0.21,0.11l-0.43,0.55l-0.3,0.7l-1.04,0.86l-0.91,-1.24l-1.0,-1.02l-0.69,-0.37l-0.52,-0.42l-0.3,-1.11l-0.37,-0.56l-0.1,-0.1l-0.4,-0.23l0.77,-0.85l0.62,0.04l0.18,-0.05l0.58,-0.38l0.46,-0.0l0.19,-0.07l0.39,-0.34l0.1,-0.3l-0.17,-0.67l0.15,-0.14l0.09,-0.2l0.03,-0.57l0.87,0.02l1.76,0.6l0.13,0.01l0.55,-0.06l0.22,-0.13l0.08,-0.12l1.18,0.17l0.17,-0.02l0.09,0.56l0.3,0.25l0.4,-0.0l0.14,-0.03l0.56,-0.29l0.23,0.05l0.63,0.59l0.15,0.07l1.07,0.2l0.24,-0.06l0.65,-0.52l0.77,-0.32l0.55,-0.32l0.3,0.04l0.44,0.45l0.34,0.74l0.84,0.87l-0.35,0.45l-0.06,0.15l-0.1,0.82l0.42,0.31l0.35,-0.16l0.05,0.04l-0.1,0.59l0.09,0.27l0.42,0.4l-0.06,0.02l-0.18,0.21l-0.2,0.86l0.03,0.21l0.56,1.02l0.52,1.71l-0.65,0.21l-0.15,0.12l-0.24,0.35l-0.03,0.28l0.16,0.41l-0.1,0.76l-0.12,0.0Z", "name": "Guinea"}, "GM": {"path": "M379.18,251.48l0.15,-0.55l2.51,-0.07l0.21,-0.09l0.48,-0.52l0.58,-0.03l0.91,0.58l0.16,0.05l0.78,0.01l0.14,-0.03l0.59,-0.31l0.16,0.24l-0.71,0.38l-0.94,-0.04l-1.02,-0.51l-0.3,0.01l-0.86,0.55l-0.37,0.02l-0.14,0.04l-0.53,0.31l-1.81,-0.04Z", "name": "Gambia"}, "GL": {"path": "M304.13,6.6l8.19,-3.63l8.72,0.28l0.19,-0.06l3.12,-2.28l8.75,-0.61l19.94,0.8l14.93,4.75l-3.92,2.01l-9.52,0.27l-13.48,0.6l-0.27,0.2l0.09,0.33l1.26,1.09l0.22,0.07l8.81,-0.67l7.49,2.07l0.19,-0.01l4.68,-1.78l1.76,1.84l-2.59,3.26l-0.01,0.36l0.34,0.11l6.35,-2.2l12.09,-2.32l7.31,1.14l1.17,2.13l-9.9,4.05l-1.43,1.32l-7.91,0.98l-0.26,0.31l0.29,0.29l5.25,0.25l-2.63,3.72l-2.02,3.61l-0.04,0.15l0.08,6.05l0.07,0.19l2.61,3.0l-3.4,0.2l-4.12,1.66l-0.04,0.54l4.5,2.67l0.53,3.9l-2.39,0.42l-0.19,0.48l2.91,3.83l-5.0,0.32l-0.27,0.22l0.12,0.33l2.69,1.84l-0.65,1.35l-3.36,0.71l-3.46,0.01l-0.21,0.51l3.05,3.15l0.02,1.53l-4.54,-1.79l-0.32,0.06l-1.29,1.26l0.11,0.5l3.33,1.15l3.17,2.74l0.85,3.29l-4.0,0.78l-1.83,-1.66l-3.1,-2.64l-0.36,-0.02l-0.13,0.33l0.8,2.92l-2.76,2.26l-0.09,0.33l0.28,0.2l6.59,0.19l2.47,0.18l-5.86,3.38l-6.76,3.43l-7.26,1.48l-2.73,0.02l-0.16,0.05l-2.67,1.72l-3.44,4.42l-5.28,2.86l-1.73,0.18l-3.33,1.01l-3.59,0.96l-0.15,0.1l-2.15,2.52l-0.07,0.19l-0.03,2.76l-1.21,2.49l-4.03,3.1l-0.1,0.33l0.98,2.94l-2.31,6.57l-3.21,0.21l-3.6,-3.0l-0.19,-0.07l-4.9,-0.02l-2.29,-1.97l-1.69,-3.78l-4.31,-4.86l-1.23,-2.52l-0.34,-3.58l-0.08,-0.17l-3.35,-3.67l0.85,-2.92l-0.09,-0.31l-1.5,-1.34l2.33,-4.7l3.67,-1.57l0.15,-0.13l1.02,-1.93l0.52,-3.47l-0.44,-0.31l-2.85,1.57l-1.33,0.64l-2.12,0.59l-2.81,-1.32l-0.15,-2.79l0.88,-2.17l2.09,-0.06l5.07,1.2l0.34,-0.17l-0.11,-0.37l-4.3,-2.9l-2.24,-1.58l-0.25,-0.05l-2.38,0.62l-1.7,-0.93l2.62,-4.1l-0.03,-0.36l-1.51,-1.75l-1.97,-3.3l-3.01,-5.21l-0.1,-0.11l-3.04,-1.85l0.03,-1.94l-0.18,-0.28l-6.82,-3.01l-5.35,-0.38l-6.69,0.21l-6.03,0.37l-2.81,-1.59l-3.84,-2.9l5.94,-1.5l5.01,-0.28l0.28,-0.29l-0.26,-0.31l-10.68,-1.38l-5.38,-2.1l0.27,-1.68l9.3,-2.6l9.18,-2.68l0.19,-0.16l0.97,-2.05l-0.18,-0.42l-6.29,-1.91l1.81,-1.9l8.58,-4.05l3.6,-0.63l0.23,-0.4l-0.92,-2.37l5.59,-1.5l7.66,-0.95l7.58,-0.05l2.65,1.84l0.31,0.02l6.52,-3.29l5.85,2.24l3.55,0.49l5.17,1.95l0.38,-0.16l-0.13,-0.39l-5.77,-3.16l0.29,-2.26Z", "name": "Greenland"}, "KW": {"path": "M540.87,207.81l0.41,0.94l-0.18,0.51l0.0,0.21l0.65,1.66l-1.15,0.05l-0.54,-1.12l-0.24,-0.17l-1.73,-0.2l1.44,-2.06l1.33,0.18Z", "name": "Kuwait"}, "GH": {"path": "M423.16,269.88l-3.58,1.34l-1.41,0.87l-2.13,0.69l-1.91,-0.61l0.09,-0.75l-0.03,-0.17l-1.04,-2.07l0.62,-2.7l1.04,-2.08l0.03,-0.19l-1.0,-5.46l0.05,-1.12l4.04,-0.11l1.08,0.18l0.18,-0.03l0.72,-0.36l0.75,0.13l-0.11,0.48l0.06,0.26l0.98,1.22l-0.0,1.77l0.24,1.99l0.05,0.13l0.55,0.81l-0.52,2.14l0.19,1.37l0.69,1.66l0.38,0.62Z", "name": "Ghana"}, "OM": {"path": "M568.16,231.0l-0.08,0.1l-0.84,1.61l-0.93,-0.11l-0.27,0.11l-0.58,0.73l-0.4,1.32l-0.01,0.14l0.29,1.61l-0.07,0.09l-1.0,-0.01l-0.16,0.04l-1.56,0.97l-0.14,0.2l-0.23,1.17l-0.41,0.4l-1.44,-0.02l-0.17,0.05l-0.98,0.65l-0.13,0.25l0.01,0.87l-0.97,0.57l-1.27,-0.22l-0.19,0.03l-1.63,0.84l-0.88,0.11l-2.55,-5.57l7.2,-2.49l0.19,-0.19l1.67,-5.23l-0.03,-0.25l-1.1,-1.78l0.05,-0.89l0.68,-1.03l0.05,-0.16l0.01,-0.89l0.96,-0.44l0.07,-0.5l-0.32,-0.26l0.16,-1.31l0.85,-0.01l1.03,1.67l0.09,0.09l1.4,0.96l0.11,0.05l1.82,0.34l1.37,0.45l1.75,2.32l0.13,0.1l0.7,0.26l-0.0,0.3l-1.25,2.19l-1.01,0.8ZM561.88,218.47l-0.01,0.02l-0.15,-0.29l0.3,-0.38l-0.14,0.65Z", "name": "Oman"}, "_3": {"path": "M543.2,261.06l-1.07,1.46l-1.65,1.99l-1.91,0.01l-8.08,-2.95l-0.89,-0.84l-0.9,-1.19l-0.81,-1.23l0.44,-0.73l0.76,-1.12l0.49,0.28l0.52,1.05l1.13,1.06l0.2,0.08l1.24,0.01l2.42,-0.65l2.77,-0.31l2.17,-0.78l1.31,-0.19l0.84,-0.43l1.03,-0.06l-0.01,4.54Z", "name": "Somaliland"}, "_2": {"path": "M384.23,230.37l0.07,-0.06l0.28,-0.89l0.99,-1.13l0.07,-0.13l0.8,-3.54l3.4,-2.8l0.09,-0.13l0.76,-2.17l0.07,5.5l-2.07,0.21l-0.24,0.17l-0.61,1.36l-0.02,0.16l0.43,3.46l-4.01,-0.01ZM391.82,218.2l0.07,-0.06l0.75,-1.93l1.86,-0.25l0.94,0.34l1.14,0.0l0.18,-0.06l0.73,-0.56l1.41,-0.08l-0.0,2.72l-7.08,-0.12Z", "name": "Western Sahara"}, "_1": {"path": "M472.71,172.84l-0.07,-0.43l-0.16,-0.22l-0.53,-0.27l-0.38,-0.58l0.3,-0.43l0.51,-0.19l0.18,-0.18l0.3,-0.87l0.12,-0.04l0.22,0.26l0.12,0.09l0.38,0.15l0.28,0.41l0.15,0.12l0.34,0.12l0.43,0.5l0.15,0.07l-0.12,0.3l-0.27,0.32l-0.03,0.18l-0.31,0.06l-1.48,0.47l-0.15,0.17Z", "name": "Kosovo"}, "_0": {"path": "M503.54,192.92l0.09,-0.17l0.41,0.01l-0.08,0.01l-0.42,0.15ZM504.23,192.76l1.02,0.02l0.4,-0.13l-0.09,0.29l0.03,0.08l-0.35,0.16l-0.24,-0.04l-0.06,-0.1l-0.18,-0.17l-0.19,-0.08l-0.33,-0.02Z", "name": "Northern Cyprus"}, "JO": {"path": "M510.26,200.93l0.28,-0.57l2.53,1.0l0.27,-0.02l4.57,-2.77l0.84,2.84l-0.28,0.25l-4.95,1.37l-0.14,0.49l2.24,2.48l-0.5,0.28l-0.13,0.14l-0.35,0.78l-1.76,0.35l-0.2,0.14l-0.57,0.94l-0.94,0.73l-2.45,-0.38l-0.03,-0.12l1.23,-4.32l-0.04,-1.1l0.34,-0.75l0.03,-0.12l0.0,-1.63Z", "name": "Jordan"}, "HR": {"path": "M455.49,162.73l1.53,0.09l0.24,-0.1l0.29,-0.34l0.64,0.38l0.14,0.04l0.98,0.06l0.32,-0.3l-0.01,-0.66l0.67,-0.25l0.19,-0.22l0.21,-1.11l1.72,-0.72l0.65,0.32l1.94,1.37l2.07,0.6l0.22,-0.02l0.67,-0.33l0.47,0.94l0.67,0.76l-0.63,0.77l-0.91,-0.55l-0.16,-0.04l-1.69,0.04l-2.2,-0.51l-1.17,0.07l-0.21,0.11l-0.36,0.42l-0.67,-0.53l-0.46,0.12l-0.52,1.29l0.05,0.31l1.21,1.42l0.58,0.99l1.15,1.14l0.95,0.68l0.92,1.23l0.1,0.09l1.75,0.91l-1.87,-0.89l-1.5,-1.11l-2.23,-0.88l-1.77,-1.9l0.12,-0.06l0.1,-0.47l-1.07,-1.22l-0.04,-0.94l-0.21,-0.27l-1.61,-0.49l-0.35,0.14l-0.53,0.93l-0.41,-0.57l0.04,-0.73Z", "name": "Croatia"}, "HT": {"path": "M237.82,234.68l1.35,0.1l1.95,0.37l0.18,1.15l-0.16,0.83l-0.51,0.37l-0.06,0.44l0.57,0.68l-0.02,0.22l-1.31,-0.35l-1.26,0.17l-1.49,-0.18l-0.15,0.02l-1.03,0.43l-1.02,-0.61l0.09,-0.36l2.04,0.32l1.9,0.21l0.19,-0.05l0.9,-0.58l0.05,-0.47l-1.05,-1.03l0.02,-0.86l-0.23,-0.3l-1.13,-0.29l0.18,-0.23Z", "name": "Haiti"}, "HU": {"path": "M461.96,157.92l0.68,-1.66l-0.03,-0.29l-0.15,-0.22l0.84,-0.0l0.3,-0.26l0.12,-0.84l0.88,0.57l0.98,0.38l0.16,0.01l2.1,-0.39l0.23,-0.21l0.14,-0.45l0.88,-0.1l1.06,-0.43l0.13,0.1l0.28,0.04l1.18,-0.4l0.14,-0.1l0.52,-0.67l0.63,-0.15l2.6,0.95l0.26,-0.03l0.38,-0.23l1.12,0.7l0.1,0.49l-1.31,0.57l-0.14,0.13l-1.18,2.14l-1.44,2.04l-1.85,0.55l-1.51,-0.13l-0.14,0.02l-1.92,0.82l-0.85,0.42l-1.91,-0.55l-1.83,-1.31l-0.74,-0.37l-0.44,-0.97l-0.26,-0.18Z", "name": "Hungary"}, "HN": {"path": "M202.48,251.87l-0.33,-0.62l-0.18,-0.14l-0.5,-0.15l0.13,-0.76l-0.11,-0.28l-0.34,-0.28l-0.6,-0.23l-0.18,-0.01l-0.81,0.22l-0.16,-0.24l-0.72,-0.39l-0.51,-0.48l-0.12,-0.07l-0.31,-0.09l0.24,-0.3l0.04,-0.3l-0.16,-0.4l0.1,-0.28l1.14,-0.69l1.0,-0.86l0.09,0.04l0.3,-0.05l0.47,-0.39l0.49,-0.03l0.14,0.13l0.29,0.06l0.31,-0.1l1.16,0.22l1.24,-0.08l0.81,-0.28l0.29,-0.25l0.63,0.1l0.69,0.18l0.65,-0.06l0.49,-0.2l1.04,0.32l0.38,0.06l0.7,0.44l0.71,0.56l0.92,0.41l0.1,0.11l-0.11,-0.01l-0.23,0.09l-0.3,0.3l-0.76,0.29l-0.58,0.0l-0.15,0.04l-0.45,0.26l-0.31,-0.07l-0.37,-0.34l-0.28,-0.07l-0.26,0.07l-0.18,0.15l-0.23,0.43l-0.04,-0.0l-0.33,0.28l-0.03,0.4l-0.76,0.61l-0.45,0.3l-0.15,0.16l-0.51,-0.36l-0.41,0.06l-0.45,0.56l-0.41,-0.01l-0.59,0.06l-0.27,0.31l0.04,0.96l-0.07,0.0l-0.25,0.16l-0.24,0.45l-0.42,0.06Z", "name": "Honduras"}, "PR": {"path": "M254.95,238.31l1.15,0.21l0.2,0.23l-0.36,0.36l-1.76,-0.01l-1.2,0.07l-0.09,-0.69l0.17,-0.18l1.89,0.01Z", "name": "Puerto Rico"}, "PS": {"path": "M509.66,201.06l-0.0,1.44l-0.29,0.63l-0.59,0.19l0.02,-0.11l0.52,-0.31l-0.02,-0.53l-0.41,-0.2l0.36,-1.28l0.41,0.17Z", "name": "West Bank"}, "PT": {"path": "M398.65,173.6l0.75,-0.63l0.7,-0.3l0.51,1.2l0.28,0.18l1.48,-0.0l0.2,-0.08l0.33,-0.3l1.16,0.08l0.52,1.11l-0.95,0.66l-0.13,0.24l-0.03,2.2l-0.33,0.35l-0.08,0.18l-0.08,1.17l-0.86,0.19l-0.2,0.44l0.93,1.64l-0.64,1.79l0.07,0.31l0.72,0.72l-0.24,0.56l-0.9,1.05l-0.07,0.26l0.17,0.77l-0.73,0.54l-1.18,-0.36l-0.16,-0.0l-0.85,0.21l0.31,-1.81l-0.23,-1.87l-0.23,-0.25l-0.99,-0.24l-0.49,-0.91l0.18,-1.72l0.93,-0.99l0.08,-0.16l0.17,-1.17l0.52,-1.76l-0.04,-1.36l-0.51,-1.14l-0.09,-0.8Z", "name": "Portugal"}, "PY": {"path": "M264.33,341.43l0.93,-2.96l0.07,-1.42l1.1,-2.1l4.19,-0.73l2.22,0.04l2.12,1.21l0.07,0.76l0.7,1.38l-0.16,3.48l0.24,0.31l2.64,0.5l0.19,-0.03l0.9,-0.45l1.47,0.62l0.38,0.64l0.23,2.35l0.3,1.07l0.25,0.21l0.93,0.12l0.16,-0.02l0.8,-0.37l0.61,0.33l-0.0,1.25l-0.33,1.53l-0.5,1.57l-0.39,2.26l-2.14,1.94l-1.85,0.4l-2.74,-0.4l-2.13,-0.62l2.26,-3.75l0.03,-0.24l-0.36,-1.18l-0.17,-0.19l-2.55,-1.03l-3.04,-1.95l-2.07,-0.43l-4.4,-4.12Z", "name": "Paraguay"}, "PA": {"path": "M213.65,263.79l0.18,-0.43l0.02,-0.18l-0.06,-0.28l0.23,-0.18l-0.01,-0.48l-0.4,-0.29l-0.01,-0.62l0.57,-0.13l0.68,0.69l-0.04,0.39l0.26,0.33l1.0,0.11l0.27,-0.1l0.49,0.44l0.24,0.07l1.34,-0.22l1.04,-0.62l1.49,-0.5l0.86,-0.73l0.99,0.11l0.18,0.28l1.35,0.08l1.02,0.4l0.78,0.72l0.71,0.53l-0.1,0.12l-0.05,0.3l0.53,1.34l-0.28,0.44l-0.6,-0.13l-0.36,0.22l-0.2,0.76l-0.41,-0.36l-0.44,-1.12l0.49,-0.53l-0.14,-0.49l-0.51,-0.14l-0.41,-0.72l-0.11,-0.11l-1.25,-0.7l-0.19,-0.04l-1.1,0.16l-0.22,0.15l-0.47,0.81l-0.9,0.56l-0.49,0.08l-0.22,0.17l-0.25,0.52l0.05,0.32l0.93,1.07l-0.41,0.21l-0.29,0.3l-0.81,0.09l-0.36,-1.26l-0.53,-0.1l-0.21,0.28l-0.5,-0.09l-0.44,-0.88l-0.22,-0.16l-0.99,-0.16l-0.61,-0.28l-0.13,-0.03l-1.0,0.0Z", "name": "Panama"}, "PG": {"path": "M808.4,298.6l0.62,0.46l1.19,1.56l1.04,0.77l-0.18,0.37l-0.42,0.15l-0.92,-0.82l-1.05,-1.53l-0.27,-0.96ZM804.09,296.06l-0.3,0.26l-0.36,-1.11l-0.66,-1.06l-2.55,-1.89l-1.42,-0.59l0.17,-0.15l1.16,0.6l0.85,0.55l1.01,0.58l0.97,1.02l0.9,0.76l0.24,1.03ZM796.71,297.99l0.15,0.82l0.34,0.24l1.43,-0.19l0.19,-0.11l0.68,-0.82l1.36,-0.87l0.13,-0.31l-0.21,-1.13l1.04,-0.03l0.3,0.25l-0.04,1.17l-0.74,1.34l-1.17,0.18l-0.22,0.15l-0.35,0.62l-2.51,1.13l-1.21,-0.0l-1.99,-0.71l-1.19,-0.58l0.07,-0.28l1.98,0.32l1.46,-0.2l0.24,-0.21l0.25,-0.79ZM789.24,303.52l0.11,0.15l2.19,1.62l1.6,2.62l0.27,0.14l1.09,-0.06l-0.07,0.77l0.23,0.32l1.23,0.27l-0.14,0.09l0.05,0.53l2.39,0.95l-0.11,0.28l-1.33,0.14l-0.51,-0.55l-0.18,-0.09l-4.59,-0.65l-1.87,-1.55l-1.38,-1.35l-1.28,-2.17l-0.16,-0.13l-3.27,-1.1l-0.19,0.0l-2.12,0.72l-1.58,0.85l-0.15,0.31l0.28,1.63l-1.65,0.73l-1.37,-0.4l-2.3,-0.09l-0.08,-15.65l3.95,1.57l4.58,1.42l1.67,1.25l1.32,1.19l0.36,1.39l0.19,0.21l4.06,1.51l0.39,0.85l-1.9,0.22l-0.25,0.39l0.55,1.68Z", "name": "Papua New Guinea"}, "PE": {"path": "M246.44,329.21l-0.63,1.25l-1.05,0.54l-2.25,-1.33l-0.19,-0.93l-0.16,-0.21l-4.95,-2.58l-4.46,-2.79l-1.87,-1.52l-0.94,-1.91l0.33,-0.6l-0.01,-0.31l-2.11,-3.33l-2.46,-4.66l-2.36,-5.02l-1.04,-1.18l-0.77,-1.81l-0.08,-0.11l-1.95,-1.64l-1.54,-0.88l0.61,-0.85l0.02,-0.31l-1.15,-2.27l0.69,-1.56l1.59,-1.26l0.12,0.42l-0.56,0.47l-0.11,0.25l0.07,0.92l0.36,0.27l0.97,-0.19l0.85,0.23l0.99,1.19l0.41,0.05l1.42,-1.03l0.11,-0.16l0.46,-1.64l1.45,-2.06l2.92,-0.96l0.11,-0.07l2.73,-2.62l0.84,-1.72l0.02,-0.18l-0.3,-1.65l0.28,-0.1l1.49,1.06l0.77,1.14l0.1,0.09l1.08,0.6l1.43,2.55l0.21,0.15l1.86,0.31l0.18,-0.03l1.25,-0.6l0.77,0.37l0.17,0.03l1.4,-0.2l1.57,0.96l-1.45,2.29l0.23,0.46l0.63,0.05l0.66,0.7l-1.51,-0.08l-0.24,0.1l-0.27,0.31l-1.96,0.46l-2.95,1.74l-0.14,0.21l-0.17,1.1l-0.6,0.82l-0.05,0.23l0.21,1.13l-1.31,0.63l-0.17,0.27l0.0,0.91l-0.53,0.37l-0.1,0.37l1.04,2.27l1.31,1.46l-0.44,0.9l0.24,0.43l1.52,0.13l0.87,1.23l0.24,0.13l2.21,0.07l0.18,-0.06l1.55,-1.13l-0.14,3.22l0.23,0.3l1.14,0.29l0.16,-0.0l1.18,-0.36l1.97,3.71l-0.45,0.71l-0.04,0.14l-0.12,1.8l-0.05,2.07l-0.92,1.2l-0.03,0.31l0.38,0.8l-0.48,0.72l-0.02,0.3l1.01,2.02l-1.5,2.64Z", "name": "Peru"}, "PK": {"path": "M609.08,187.76l1.66,1.21l0.71,2.11l0.2,0.19l3.62,1.01l-1.98,1.95l-2.65,0.4l-3.75,-0.68l-0.26,0.08l-1.23,1.22l-0.07,0.31l0.89,2.46l0.88,1.92l0.1,0.12l1.67,1.14l-1.8,1.35l-0.12,0.25l0.04,1.85l-2.35,2.67l-1.59,2.79l-2.5,2.72l-2.76,-0.2l-0.24,0.09l-2.76,2.83l0.04,0.45l1.54,1.13l0.27,1.94l0.09,0.17l1.34,1.29l0.4,1.83l-5.14,-0.01l-0.22,0.09l-1.53,1.63l-1.52,-0.56l-0.76,-1.88l-1.93,-2.03l-0.25,-0.09l-4.6,0.5l-4.05,0.05l-3.1,0.33l0.77,-2.53l3.48,-1.33l0.19,-0.33l-0.21,-1.24l-0.19,-0.23l-1.01,-0.37l-0.06,-2.18l-0.17,-0.26l-2.32,-1.16l-0.96,-1.57l-0.56,-0.65l3.16,1.05l0.14,0.01l2.45,-0.4l1.44,0.33l0.3,-0.1l0.4,-0.47l1.58,0.22l0.14,-0.01l3.25,-1.14l0.2,-0.27l0.08,-2.23l1.23,-1.38l1.73,0.0l0.28,-0.2l0.22,-0.61l1.68,-0.32l0.86,0.24l0.27,-0.05l0.98,-0.78l0.11,-0.26l-0.13,-1.57l0.96,-1.52l1.51,-0.67l0.14,-0.41l-0.74,-1.4l1.86,0.07l0.26,-0.13l0.69,-1.01l0.05,-0.2l-0.09,-0.94l1.14,-1.09l0.09,-0.28l-0.29,-1.41l-0.51,-1.07l1.23,-1.05l2.6,-0.58l2.86,-0.33l1.33,-0.54l1.3,-0.29Z", "name": "Pakistan"}, "PH": {"path": "M737.11,263.82l0.25,1.66l0.14,1.34l-0.54,1.46l-0.64,-1.79l-0.5,-0.1l-1.17,1.28l-0.05,0.32l0.74,1.71l-0.49,0.81l-2.6,-1.28l-0.61,-1.57l0.68,-1.07l-0.07,-0.4l-1.59,-1.19l-0.42,0.06l-0.69,0.91l-1.01,-0.08l-0.21,0.06l-1.58,1.2l-0.17,-0.3l0.87,-1.88l1.48,-0.66l1.18,-0.81l0.71,0.92l0.34,0.1l1.9,-0.69l0.18,-0.18l0.34,-0.94l1.57,-0.06l0.29,-0.32l-0.1,-1.38l1.41,0.83l0.36,2.06ZM734.94,254.42l0.56,2.24l-1.41,-0.49l-0.4,0.3l0.07,0.94l0.51,1.3l-0.54,0.26l-0.08,-1.34l-0.25,-0.28l-0.56,-0.1l-0.23,-0.91l1.03,0.14l0.34,-0.31l-0.03,-0.96l-0.06,-0.18l-1.14,-1.44l1.62,0.04l0.57,0.78ZM724.68,238.33l1.48,0.71l0.33,-0.04l0.44,-0.38l0.05,0.13l-0.37,0.97l0.01,0.23l0.81,1.75l-0.59,1.92l-1.37,0.79l-0.14,0.2l-0.39,2.07l0.01,0.14l0.56,2.04l0.23,0.21l1.33,0.28l0.14,-0.0l1.0,-0.27l2.82,1.28l-0.2,1.16l0.12,0.29l0.66,0.5l-0.13,0.56l-1.54,-0.99l-0.89,-1.29l-0.49,0.0l-0.44,0.65l-1.34,-1.28l-0.26,-0.08l-2.18,0.36l-0.96,-0.44l0.09,-0.72l0.69,-0.57l-0.01,-0.47l-0.75,-0.59l-0.47,0.14l-0.15,0.43l-0.86,-1.02l-0.34,-1.02l-0.07,-1.74l0.49,0.41l0.49,-0.21l0.26,-3.99l0.73,-2.1l1.23,0.0ZM731.12,258.92l-0.82,0.75l-0.83,1.64l-0.52,0.5l-1.17,-1.33l0.36,-0.47l0.62,-0.7l0.07,-0.15l0.24,-1.35l0.73,-0.08l-0.31,1.29l0.16,0.34l0.37,-0.09l1.21,-1.6l-0.12,1.24ZM726.66,255.58l0.85,0.45l0.14,0.03l1.28,-0.0l-0.03,0.62l-1.04,0.96l-1.15,0.55l-0.05,-0.71l0.17,-1.26l-0.01,-0.13l-0.16,-0.51ZM724.92,252.06l-0.45,1.5l-0.7,-0.83l-0.95,-1.43l1.44,0.06l0.67,0.7ZM717.48,261.28l-1.87,1.35l0.21,-0.3l1.81,-1.57l1.5,-1.75l0.97,-1.84l0.23,1.08l-1.56,1.33l-1.29,1.7Z", "name": "Philippines"}, "PL": {"path": "M458.8,144.25l-0.96,-1.98l0.18,-1.06l-0.01,-0.15l-0.62,-1.8l-0.82,-1.11l0.56,-0.73l0.05,-0.28l-0.51,-1.51l1.48,-0.87l3.88,-1.58l3.06,-1.14l2.23,0.52l0.15,0.66l0.29,0.23l2.4,0.04l3.11,0.39l4.56,-0.05l1.12,0.32l0.51,0.89l0.1,1.45l0.03,0.12l0.66,1.23l-0.01,1.08l-1.33,0.61l-0.14,0.41l0.74,1.5l0.07,1.53l1.22,2.79l-0.19,0.66l-1.09,0.33l-0.14,0.09l-2.27,2.72l-0.04,0.31l0.35,0.8l-2.22,-1.16l-0.21,-0.02l-1.72,0.44l-1.1,-0.31l-0.21,0.02l-1.3,0.61l-1.11,-1.02l-0.32,-0.05l-0.81,0.35l-1.15,-1.61l-0.21,-0.12l-1.65,-0.17l-0.19,-0.82l-0.23,-0.23l-1.72,-0.37l-0.34,0.17l-0.25,0.56l-0.88,-0.44l0.12,-0.69l-0.25,-0.35l-1.78,-0.27l-1.08,-0.97Z", "name": "Poland"}, "ZM": {"path": "M502.81,308.32l1.09,1.04l0.58,1.94l-0.39,0.66l-0.5,2.05l-0.0,0.14l0.45,1.95l-0.69,0.77l-0.06,0.11l-0.76,2.37l0.15,0.36l0.62,0.31l-6.85,1.9l-0.22,0.33l0.2,1.54l-1.62,0.3l-0.12,0.05l-1.43,1.02l-0.11,0.15l-0.25,0.73l-0.73,0.17l-0.14,0.08l-2.18,2.12l-1.33,1.6l-0.65,0.05l-0.83,-0.29l-2.75,-0.28l-0.24,-0.1l-0.15,-0.27l-0.99,-0.58l-0.12,-0.04l-1.73,-0.14l-1.88,0.54l-1.5,-1.48l-1.61,-2.01l0.11,-7.73l4.92,0.03l0.29,-0.37l-0.19,-0.79l0.34,-0.86l0.0,-0.21l-0.41,-1.11l0.26,-1.14l-0.01,-0.16l-0.12,-0.36l0.18,0.01l0.1,0.56l0.31,0.25l1.14,-0.06l1.44,0.21l0.76,1.05l0.19,0.12l2.01,0.35l0.19,-0.03l1.24,-0.65l0.44,1.03l0.22,0.18l1.81,0.34l0.85,0.99l1.02,1.39l0.24,0.12l1.92,0.02l0.3,-0.32l-0.21,-2.74l-0.47,-0.23l-0.53,0.36l-1.58,-0.89l-0.51,-0.34l0.29,-2.36l0.44,-2.99l-0.03,-0.18l-0.5,-0.99l0.61,-1.38l0.53,-0.24l3.26,-0.41l0.89,0.23l1.01,0.62l1.04,0.44l1.6,0.43l1.35,0.72Z", "name": "Zambia"}, "EE": {"path": "M482.19,120.88l0.23,-1.68l-0.43,-0.31l-0.75,0.37l-1.34,-1.1l-0.18,-1.75l2.92,-0.95l3.07,-0.53l2.66,0.6l2.48,-0.1l0.18,0.31l-1.65,1.96l-0.06,0.26l0.71,3.25l-0.88,0.94l-1.85,-0.01l-2.08,-1.3l-1.14,-0.47l-0.2,-0.01l-1.69,0.51Z", "name": "Estonia"}, "EG": {"path": "M508.07,208.8l-0.66,1.06l-0.53,2.03l-0.64,1.32l-0.32,0.26l-1.74,-1.85l-1.77,-3.86l-0.48,-0.09l-0.26,0.25l-0.07,0.32l1.04,2.88l1.55,2.76l1.89,4.18l0.94,1.48l0.83,1.54l2.08,2.73l-0.3,0.28l-0.1,0.23l0.08,1.72l0.11,0.22l2.91,2.37l-28.78,0.0l0.0,-19.06l-0.73,-2.2l0.61,-1.59l0.0,-0.2l-0.34,-1.04l0.73,-1.08l3.13,-0.04l2.36,0.72l2.48,0.81l1.15,0.43l0.23,-0.01l1.93,-0.87l1.02,-0.78l2.08,-0.21l1.59,0.31l0.62,1.24l0.52,0.03l0.46,-0.71l1.86,0.59l1.95,0.16l0.17,-0.04l0.92,-0.52l1.48,4.24Z", "name": "Egypt"}, "ZA": {"path": "M467.06,373.27l-0.13,-0.29l0.01,-1.58l-0.02,-0.12l-0.71,-1.64l0.59,-0.37l0.14,-0.26l-0.07,-2.13l-0.05,-0.15l-1.63,-2.58l-1.25,-2.31l-1.71,-3.37l0.88,-0.98l0.7,0.52l0.39,1.08l0.23,0.19l1.1,0.19l1.55,0.51l0.14,0.01l1.35,-0.2l0.11,-0.04l2.24,-1.39l0.14,-0.25l0.0,-9.4l0.16,0.09l1.39,2.38l-0.22,1.53l0.04,0.19l0.56,0.94l0.3,0.14l1.79,-0.27l0.16,-0.08l1.23,-1.18l1.17,-0.79l0.1,-0.12l0.57,-1.19l1.02,-0.52l0.9,0.28l1.16,0.73l0.14,0.05l2.04,0.13l0.13,-0.02l1.6,-0.62l0.18,-0.19l0.63,-1.93l1.18,-0.19l0.19,-0.12l0.78,-1.05l0.81,-1.71l2.18,-1.91l3.44,-1.88l0.89,0.02l1.17,0.43l0.21,-0.0l0.76,-0.29l1.07,0.21l1.15,3.55l0.63,1.82l-0.44,2.9l0.1,0.52l-0.74,-0.29l-0.18,-0.01l-0.72,0.19l-0.21,0.2l-0.22,0.74l-0.66,0.97l-0.05,0.18l0.02,0.93l0.09,0.21l1.49,1.46l0.27,0.08l1.47,-0.29l0.22,-0.18l0.43,-1.01l1.29,0.02l-0.51,1.63l-0.29,2.2l-0.59,1.12l-2.2,1.78l-1.06,1.39l-0.72,1.44l-1.39,1.93l-2.81,2.84l-1.75,1.65l-1.85,1.24l-2.55,1.06l-1.23,0.14l-0.24,0.18l-0.22,0.54l-1.27,-0.35l-0.2,0.01l-1.15,0.5l-2.62,-0.52l-0.12,0.0l-1.46,0.33l-0.98,-0.14l-0.16,0.02l-2.55,1.1l-2.11,0.44l-1.59,1.07l-0.93,0.06l-0.97,-0.92l-0.19,-0.08l-0.72,-0.04l-1.0,-1.16l-0.25,0.05ZM493.72,359.24l-1.12,-0.86l-0.31,-0.03l-1.23,0.59l-1.36,1.07l-1.39,1.78l0.01,0.38l1.88,2.11l0.31,0.09l0.9,-0.27l0.18,-0.15l0.4,-0.77l1.28,-0.39l0.18,-0.16l0.42,-0.88l0.76,-1.32l-0.05,-0.37l-0.87,-0.82Z", "name": "South Africa"}, "EC": {"path": "M220.2,293.48l1.25,-1.76l0.02,-0.31l-0.54,-1.09l-0.5,-0.06l-0.78,0.94l-1.03,-0.75l0.33,-0.46l0.05,-0.23l-0.38,-2.04l0.66,-0.28l0.17,-0.19l0.45,-1.52l0.93,-1.58l0.04,-0.2l-0.13,-0.78l1.19,-0.47l1.57,-0.91l2.35,1.34l0.17,0.04l0.28,-0.02l0.52,0.91l0.21,0.15l2.12,0.35l0.2,-0.03l0.55,-0.31l1.08,0.73l0.97,0.54l0.31,1.67l-0.71,1.49l-2.64,2.54l-2.95,0.97l-0.15,0.11l-1.53,2.18l-0.49,1.68l-1.1,0.8l-0.87,-1.05l-0.15,-0.1l-1.01,-0.27l-0.13,-0.0l-0.7,0.14l-0.03,-0.43l0.6,-0.5l0.1,-0.31l-0.26,-0.91Z", "name": "Ecuador"}, "AL": {"path": "M470.27,171.7l0.38,0.19l0.45,-0.18l0.4,0.61l0.11,0.1l0.46,0.24l0.13,0.87l-0.3,0.95l-0.0,0.17l0.36,1.28l0.12,0.17l0.9,0.63l-0.03,0.44l-0.67,0.35l-0.16,0.22l-0.14,0.88l-0.96,1.18l-0.06,-0.03l-0.04,-0.48l-0.12,-0.22l-1.28,-0.92l-0.19,-1.25l0.2,-1.96l0.33,-0.89l-0.06,-0.3l-0.36,-0.41l-0.13,-0.75l0.66,-0.9Z", "name": "Albania"}, "AO": {"path": "M461.62,299.93l0.55,1.67l0.73,1.54l1.56,2.18l0.28,0.12l1.66,-0.2l0.81,-0.34l1.28,0.33l0.33,-0.14l0.39,-0.67l0.56,-1.3l1.37,-0.09l0.27,-0.21l0.07,-0.23l0.67,-0.01l-0.13,0.53l0.29,0.37l2.74,-0.02l0.04,1.29l0.03,0.13l0.46,0.87l-0.35,1.52l0.18,1.55l0.07,0.16l0.75,0.85l-0.13,2.89l0.41,0.29l0.56,-0.21l1.11,0.05l1.5,-0.37l0.9,0.12l0.18,0.53l-0.27,1.15l0.01,0.17l0.4,1.08l-0.33,0.85l-0.01,0.18l0.12,0.51l-4.83,-0.03l-0.3,0.3l-0.12,8.13l0.07,0.19l1.69,2.1l1.27,1.25l-4.03,0.92l-5.93,-0.36l-1.66,-1.19l-0.18,-0.06l-10.15,0.11l-0.34,0.13l-1.35,-1.05l-0.17,-0.06l-1.62,-0.08l-1.6,0.45l-0.88,0.36l-0.17,-1.2l0.34,-2.19l0.85,-2.32l0.14,-1.13l0.79,-2.24l0.57,-1.0l1.42,-1.64l0.82,-1.15l0.05,-0.13l0.26,-1.88l-0.13,-1.51l-0.07,-0.16l-0.72,-0.87l-1.23,-2.91l0.09,-0.37l0.73,-0.95l0.05,-0.27l-1.27,-4.12l-1.19,-1.54l0.1,-0.2l0.86,-0.28l0.78,0.03l0.83,-0.29l7.12,0.03ZM451.81,298.94l-0.17,0.07l-0.5,-1.42l0.85,-0.92l0.53,-0.29l0.48,0.44l-0.56,0.32l-0.1,0.1l-0.41,0.65l-0.05,0.14l-0.07,0.91Z", "name": "Angola"}, "KZ": {"path": "M598.42,172.08l-1.37,0.54l-3.3,2.09l-0.11,0.12l-1.01,1.97l-0.56,0.01l-0.6,-1.24l-0.26,-0.17l-2.95,-0.09l-0.46,-2.22l-0.29,-0.24l-0.91,-0.02l0.17,-2.72l-0.12,-0.26l-3.0,-2.22l-0.2,-0.06l-4.29,0.24l-2.8,0.42l-2.36,-2.7l-6.4,-3.65l-0.23,-0.03l-6.45,1.83l-0.22,0.29l0.1,10.94l-0.84,0.1l-1.65,-2.21l-0.11,-0.09l-1.69,-0.84l-0.2,-0.02l-2.84,0.63l-0.14,0.07l-0.71,0.64l-0.02,-0.11l0.57,-1.17l0.0,-0.26l-0.48,-1.05l-0.17,-0.16l-2.78,-0.99l-1.08,-2.62l-0.13,-0.15l-1.24,-0.7l-0.04,-0.48l2.07,0.25l0.34,-0.29l0.09,-2.03l1.84,-0.44l2.12,0.45l0.36,-0.25l0.45,-3.04l-0.45,-2.06l-0.31,-0.23l-2.44,0.15l-2.07,-0.75l-0.23,0.01l-2.88,1.38l-2.21,0.62l-0.96,-0.38l0.22,-1.39l-0.06,-0.23l-1.6,-2.12l-0.25,-0.12l-1.72,0.08l-1.87,-1.91l1.33,-2.24l-0.06,-0.38l-0.55,-0.5l1.72,-3.08l2.3,1.7l0.48,-0.2l0.29,-2.26l4.99,-3.48l3.76,-0.08l5.46,2.27l2.96,1.33l0.26,-0.01l2.59,-1.36l3.82,-0.06l3.13,1.67l0.38,-0.09l0.63,-0.85l3.36,0.14l0.29,-0.19l0.63,-1.57l-0.13,-0.37l-3.64,-2.05l2.0,-1.36l0.1,-0.38l-0.32,-0.62l2.09,-0.76l0.13,-0.47l-1.65,-2.13l0.89,-0.91l9.27,-1.18l0.13,-0.05l1.17,-0.82l6.2,-1.27l2.26,-1.43l4.19,0.7l0.74,3.39l0.38,0.22l2.52,-0.81l2.9,1.06l-0.18,1.63l0.32,0.33l2.52,-0.23l5.0,-2.58l0.03,0.39l3.16,2.62l5.57,8.48l0.49,0.02l1.18,-1.53l3.22,1.78l0.21,0.03l3.5,-0.83l1.21,0.52l1.16,1.82l0.15,0.12l1.67,0.61l1.01,1.32l0.28,0.11l3.04,-0.41l1.1,1.64l-1.68,1.89l-1.97,0.28l-0.26,0.29l-0.12,3.09l-1.2,1.23l-4.81,-1.01l-0.35,0.2l-1.77,5.51l-1.14,0.62l-4.92,1.23l-0.2,0.41l2.14,5.06l-1.45,0.67l-0.17,0.31l0.15,1.28l-1.05,-0.3l-1.21,-1.04l-0.17,-0.07l-3.73,-0.32l-4.15,-0.08l-0.92,0.31l-3.46,-1.24l-0.22,0.01l-1.42,0.63l-0.17,0.21l-0.32,1.49l-3.82,-0.97l-0.15,0.0l-1.65,0.43l-0.2,0.17l-0.51,1.21Z", "name": "Kazakhstan"}, "ET": {"path": "M516.0,247.63l1.21,0.92l0.3,0.04l1.3,-0.53l0.46,0.41l0.19,0.08l1.65,0.03l2.05,0.96l0.67,0.88l1.07,0.79l1.0,1.45l0.7,0.68l-0.72,0.92l-0.85,1.19l-0.04,0.25l0.19,0.67l0.04,0.74l0.29,0.28l1.4,0.04l0.55,-0.15l0.23,0.19l-0.41,0.67l0.01,0.32l0.92,1.39l0.93,1.23l0.99,0.94l0.1,0.06l8.19,2.99l1.51,0.01l-6.51,6.95l-3.14,0.11l-0.18,0.06l-2.15,1.71l-1.51,0.04l-0.22,0.1l-0.6,0.69l-1.46,-0.0l-0.93,-0.78l-0.32,-0.04l-2.29,1.05l-0.12,0.1l-0.64,0.9l-1.44,-0.17l-0.51,-0.26l-0.17,-0.03l-0.56,0.07l-0.68,-0.02l-3.1,-2.08l-0.17,-0.05l-1.62,0.0l-0.68,-0.65l0.0,-1.28l-0.21,-0.29l-1.19,-0.38l-1.42,-2.63l-0.13,-0.12l-1.05,-0.53l-0.46,-1.0l-1.27,-1.23l-0.17,-0.08l-1.08,-0.13l0.53,-0.9l1.17,-0.05l0.26,-0.17l0.37,-0.77l0.03,-0.14l-0.03,-2.23l0.7,-2.49l1.08,-0.65l0.14,-0.19l0.24,-1.0l1.03,-1.85l1.47,-1.22l0.09,-0.12l1.02,-2.51l0.36,-1.96l2.62,0.48l0.33,-0.18l0.63,-1.55Z", "name": "Ethiopia"}, "ZW": {"path": "M498.95,341.2l-1.16,-0.23l-0.16,0.01l-0.74,0.28l-1.11,-0.41l-1.02,-0.04l-1.52,-1.13l-0.12,-0.05l-1.79,-0.37l-0.65,-1.46l-0.01,-0.86l-0.22,-0.29l-0.99,-0.26l-2.74,-2.77l-0.77,-1.46l-0.52,-0.5l-0.72,-1.54l2.24,0.23l0.78,0.28l0.12,0.02l0.85,-0.06l0.21,-0.11l1.38,-1.66l2.11,-2.05l0.81,-0.18l0.22,-0.2l0.27,-0.8l1.29,-0.93l1.53,-0.28l0.11,0.66l0.3,0.25l2.02,-0.05l1.04,0.48l0.5,0.59l0.18,0.1l1.13,0.18l1.11,0.7l0.01,3.06l-0.49,1.82l-0.11,1.94l0.03,0.16l0.35,0.68l-0.24,1.3l-0.27,0.17l-0.12,0.15l-0.64,1.83l-2.49,2.8Z", "name": "Zimbabwe"}, "ES": {"path": "M398.67,172.8l0.09,-1.45l-0.06,-0.2l-0.82,-1.05l3.16,-1.96l3.01,0.54l3.33,-0.02l2.64,0.52l2.14,-0.15l3.9,0.1l0.91,1.08l0.14,0.09l4.61,1.38l0.26,-0.04l0.77,-0.55l2.66,1.29l0.17,0.03l2.59,-0.35l0.1,1.28l-2.2,1.85l-3.13,0.62l-0.23,0.23l-0.21,0.92l-1.54,1.68l-0.97,2.4l0.02,0.26l0.85,1.46l-1.27,1.14l-0.09,0.14l-0.5,1.73l-1.73,0.53l-0.15,0.1l-1.68,2.1l-3.03,0.04l-2.38,-0.05l-0.17,0.05l-1.57,1.01l-0.9,1.01l-0.96,-0.19l-0.82,-0.86l-0.69,-1.6l-0.22,-0.18l-2.14,-0.41l-0.13,-0.62l0.83,-0.97l0.39,-0.86l-0.06,-0.33l-0.73,-0.73l0.63,-1.74l-0.02,-0.25l-0.8,-1.41l0.69,-0.15l0.23,-0.27l0.09,-1.29l0.33,-0.36l0.08,-0.2l0.03,-2.16l1.03,-0.72l0.1,-0.37l-0.7,-1.5l-0.25,-0.17l-1.46,-0.11l-0.22,0.07l-0.34,0.3l-1.17,0.0l-0.55,-1.29l-0.39,-0.16l-1.02,0.44l-0.45,0.36Z", "name": "Spain"}, "ER": {"path": "M527.15,253.05l-0.77,-0.74l-1.01,-1.47l-1.14,-0.86l-0.62,-0.84l-0.11,-0.09l-2.18,-1.02l-0.12,-0.03l-1.61,-0.03l-0.52,-0.46l-0.31,-0.05l-1.31,0.54l-1.38,-1.06l-0.46,0.12l-0.69,1.68l-2.49,-0.46l-0.2,-0.76l1.06,-3.69l0.24,-1.65l0.66,-0.66l1.76,-0.4l0.16,-0.1l0.97,-1.13l1.24,2.55l0.68,2.34l0.09,0.14l1.4,1.27l3.39,2.4l1.37,1.43l2.14,2.34l0.94,0.6l-0.32,0.26l-0.85,-0.17Z", "name": "Eritrea"}, "ME": {"path": "M469.05,172.9l-0.57,-0.8l-0.1,-0.09l-0.82,-0.46l0.16,-0.33l0.35,-1.57l0.72,-0.62l0.27,-0.16l0.48,0.38l0.35,0.4l0.12,0.08l0.79,0.32l0.66,0.43l-0.43,0.62l-0.28,0.11l-0.07,-0.25l-0.53,-0.1l-1.09,1.49l-0.05,0.23l0.06,0.32Z", "name": "Montenegro"}, "MD": {"path": "M488.2,153.75l0.14,-0.11l1.49,-0.28l1.75,0.95l1.06,0.14l0.92,0.7l-0.15,0.9l0.15,0.31l0.8,0.46l0.33,1.2l0.09,0.14l0.72,0.66l-0.11,0.28l0.1,0.33l-0.06,0.02l-1.25,-0.08l-0.17,-0.29l-0.39,-0.12l-0.52,0.25l-0.16,0.36l0.13,0.42l-0.6,0.88l-0.43,1.03l-0.22,0.12l-0.32,-1.0l0.25,-1.34l-0.08,-1.38l-0.06,-0.17l-1.43,-1.87l-0.81,-1.36l-0.78,-0.95l-0.12,-0.09l-0.29,-0.12Z", "name": "Moldova"}, "MG": {"path": "M544.77,316.45l0.64,1.04l0.6,1.62l0.4,3.04l0.63,1.21l-0.22,1.07l-0.15,0.26l-0.59,-1.05l-0.52,-0.01l-0.47,0.76l-0.04,0.23l0.46,1.84l-0.19,0.92l-0.61,0.53l-0.1,0.21l-0.16,2.15l-0.97,2.98l-1.24,3.59l-1.55,4.97l-0.96,3.67l-1.08,2.93l-1.94,0.61l-2.05,1.06l-3.2,-1.53l-0.62,-1.26l-0.18,-2.39l-0.87,-2.07l-0.22,-1.8l0.4,-1.69l1.01,-0.4l0.19,-0.28l0.01,-0.79l1.15,-1.91l0.04,-0.11l0.23,-1.66l-0.03,-0.17l-0.57,-1.21l-0.46,-1.58l-0.19,-2.25l0.82,-1.36l0.33,-1.51l1.11,-0.1l1.4,-0.53l0.9,-0.45l1.03,-0.03l0.21,-0.09l1.41,-1.45l2.12,-1.65l0.75,-1.29l0.03,-0.24l-0.17,-0.56l0.53,0.15l0.32,-0.1l1.38,-1.77l0.06,-0.18l0.04,-1.44l0.54,-0.74l0.62,0.77Z", "name": "Madagascar"}, "MA": {"path": "M378.66,230.13l0.07,-0.75l0.93,-0.72l0.82,-1.37l0.04,-0.21l-0.14,-0.8l0.8,-1.74l1.33,-1.61l0.79,-0.4l0.14,-0.15l0.66,-1.55l0.08,-1.46l0.83,-1.52l1.6,-0.94l0.11,-0.11l1.56,-2.71l1.2,-0.99l2.24,-0.29l0.17,-0.08l1.95,-1.83l1.3,-0.77l2.09,-2.28l0.07,-0.26l-0.61,-3.34l0.92,-2.3l0.33,-1.44l1.52,-1.79l2.48,-1.27l1.86,-1.16l0.1,-0.11l1.67,-2.93l0.72,-1.59l1.54,0.01l1.43,1.14l0.21,0.06l2.33,-0.19l2.55,0.62l0.97,0.03l0.83,1.6l0.15,1.71l0.86,2.96l0.09,0.14l0.5,0.45l-0.31,0.73l-3.11,0.44l-0.16,0.07l-1.07,0.97l-1.36,0.23l-0.25,0.28l-0.1,1.85l-2.74,1.02l-0.14,0.11l-0.9,1.3l-1.93,0.69l-2.56,0.44l-4.04,2.01l-0.17,0.27l0.02,2.91l-0.08,0.0l-0.3,0.31l0.05,1.15l-1.25,0.07l-0.16,0.06l-0.73,0.55l-0.98,0.0l-0.85,-0.33l-0.15,-0.02l-2.11,0.29l-0.24,0.19l-0.76,1.95l-0.63,0.16l-0.21,0.19l-1.15,3.29l-3.42,2.81l-0.1,0.17l-0.81,3.57l-0.98,1.12l-0.3,0.85l-5.13,0.19Z", "name": "Morocco"}, "UZ": {"path": "M587.83,186.48l0.06,-1.46l-0.19,-0.29l-3.31,-1.24l-2.57,-1.4l-1.63,-1.38l-2.79,-1.98l-1.2,-2.98l-0.12,-0.14l-0.84,-0.54l-0.18,-0.05l-2.61,0.13l-0.76,-0.48l-0.25,-2.25l-0.17,-0.24l-3.37,-1.6l-0.32,0.04l-2.08,1.73l-2.11,1.02l-0.16,0.35l0.31,1.14l-2.14,0.03l-0.09,-10.68l6.1,-1.74l6.25,3.57l2.36,2.72l0.27,0.1l2.92,-0.44l4.17,-0.23l2.78,2.06l-0.18,2.87l0.29,0.32l0.98,0.02l0.46,2.22l0.28,0.24l3.0,0.09l0.61,1.25l0.28,0.17l0.93,-0.02l0.26,-0.16l1.06,-2.06l3.21,-2.03l1.3,-0.5l0.19,0.08l-1.75,1.62l0.05,0.48l1.85,1.12l0.27,0.02l1.65,-0.69l2.4,1.27l-2.69,1.79l-1.79,-0.27l-0.89,0.06l-0.22,-0.52l0.48,-1.26l-0.34,-0.4l-3.35,0.69l-0.22,0.18l-0.78,1.87l-1.07,1.47l-1.93,-0.13l-0.29,0.16l-0.65,1.29l0.16,0.42l1.69,0.64l0.48,1.91l-1.25,2.6l-1.64,-0.53l-1.18,-0.03Z", "name": "Uzbekistan"}, "MM": {"path": "M670.1,233.39l-1.46,1.11l-1.68,0.11l-0.26,0.19l-1.1,2.7l-0.95,0.42l-0.14,0.42l1.21,2.27l1.61,1.92l0.94,1.55l-0.82,1.99l-0.77,0.42l-0.13,0.39l0.64,1.35l1.62,1.97l0.26,1.32l-0.04,1.15l0.02,0.13l0.92,2.18l-1.3,2.23l-0.79,1.69l-0.1,-0.77l0.74,-1.87l-0.02,-0.26l-0.8,-1.42l0.2,-2.68l-0.06,-0.2l-0.98,-1.27l-0.8,-2.98l-0.45,-3.22l-1.11,-2.22l-0.45,-0.1l-1.64,1.28l-2.74,1.76l-1.26,-0.2l-1.27,-0.49l0.79,-2.93l0.0,-0.14l-0.52,-2.42l-1.93,-2.97l0.26,-0.8l-0.22,-0.39l-1.37,-0.31l-1.65,-1.98l-0.12,-1.5l0.41,0.19l0.42,-0.26l0.05,-1.7l1.08,-0.54l0.16,-0.34l-0.24,-1.0l0.5,-0.79l0.05,-0.15l0.08,-2.35l1.58,0.49l0.36,-0.15l1.12,-2.19l0.15,-1.34l1.35,-2.18l0.04,-0.17l-0.07,-1.35l2.97,-1.71l1.67,0.45l0.38,-0.33l-0.18,-1.46l0.7,-0.4l0.15,-0.32l-0.13,-0.72l0.94,-0.13l0.74,1.41l0.11,0.12l0.95,0.56l0.07,1.89l-0.09,2.08l-2.28,2.15l-0.09,0.19l-0.3,3.15l0.35,0.32l2.37,-0.39l0.53,2.17l0.2,0.21l1.3,0.42l-0.63,1.9l0.14,0.36l1.86,0.99l1.1,0.49l0.24,0.0l1.45,-0.6l0.04,0.51l-2.01,1.6l-0.56,0.96l-1.34,0.56Z", "name": "Myanmar"}, "ML": {"path": "M390.79,248.2l0.67,-0.37l0.14,-0.18l0.36,-1.31l0.51,-0.04l1.68,0.69l0.21,0.0l1.34,-0.48l0.89,0.16l0.3,-0.13l0.29,-0.44l9.89,-0.04l0.29,-0.21l0.56,-1.8l-0.11,-0.33l-0.33,-0.24l-2.37,-22.1l3.41,-0.04l8.37,5.73l8.38,5.68l0.56,1.15l0.14,0.14l1.56,0.75l0.99,0.36l0.03,1.45l0.33,0.29l2.45,-0.22l0.01,5.52l-1.3,1.64l-0.06,0.15l-0.18,1.37l-1.99,0.36l-3.4,0.22l-0.19,0.09l-0.85,0.83l-1.48,0.09l-1.49,0.01l-0.54,-0.43l-0.26,-0.05l-1.38,0.36l-2.39,1.08l-0.13,0.12l-0.44,0.73l-1.88,1.11l-0.11,0.12l-0.3,0.57l-0.86,0.42l-1.1,-0.31l-0.28,0.07l-0.69,0.62l-0.09,0.16l-0.35,1.66l-1.93,2.04l-0.08,0.23l0.05,0.76l-0.63,0.99l-0.04,0.19l0.14,1.23l-0.81,0.29l-0.32,0.17l-0.27,-0.75l-0.39,-0.18l-0.65,0.26l-0.36,-0.04l-0.29,0.14l-0.37,0.6l-1.69,-0.02l-0.63,-0.34l-0.32,0.02l-0.12,0.09l-0.47,-0.45l0.1,-0.6l-0.09,-0.27l-0.31,-0.3l-0.33,-0.05l-0.05,0.02l0.02,-0.21l0.46,-0.59l-0.02,-0.39l-0.99,-1.02l-0.34,-0.74l-0.56,-0.56l-0.17,-0.09l-0.5,-0.07l-0.19,0.04l-0.58,0.35l-0.79,0.33l-0.65,0.51l-0.85,-0.16l-0.63,-0.59l-0.14,-0.07l-0.41,-0.08l-0.2,0.03l-0.59,0.31l-0.07,0.0l-0.1,-0.63l0.11,-0.85l-0.21,-0.98l-0.11,-0.17l-0.86,-0.66l-0.45,-1.34l-0.1,-1.36Z", "name": "Mali"}, "MN": {"path": "M641.06,150.59l2.41,-0.53l4.76,-2.8l3.67,-1.49l2.06,0.96l0.12,0.03l2.5,0.05l1.59,1.45l0.19,0.08l2.47,0.12l3.59,0.81l0.27,-0.07l2.43,-2.28l0.06,-0.36l-0.93,-1.77l2.33,-3.1l2.66,1.3l2.26,0.39l2.75,0.8l0.44,2.3l0.19,0.22l3.56,1.38l0.18,0.01l2.35,-0.6l3.1,-0.42l2.4,0.41l2.37,1.52l1.49,1.63l0.23,0.1l2.29,-0.03l3.13,0.52l0.15,-0.01l2.28,-0.79l3.27,-0.53l0.11,-0.04l3.56,-2.23l1.31,0.31l1.26,1.05l0.22,0.07l2.45,-0.22l-0.98,1.96l-1.77,3.21l-0.01,0.28l0.64,1.31l0.35,0.16l1.35,-0.38l2.4,0.48l0.22,-0.04l1.78,-1.09l1.82,0.92l2.11,2.07l-0.17,0.68l-1.79,-0.31l-3.74,0.45l-1.85,0.96l-1.78,2.01l-3.74,1.18l-2.46,1.61l-2.45,-0.6l-1.42,-0.28l-0.31,0.13l-1.31,1.99l0.0,0.33l0.78,1.15l0.3,0.74l-1.58,0.93l-1.75,1.59l-2.83,1.03l-3.77,0.12l-4.05,1.05l-2.81,1.54l-0.95,-0.8l-0.19,-0.07l-2.96,0.0l-3.64,-1.8l-2.55,-0.48l-3.38,0.41l-5.13,-0.67l-2.66,0.06l-1.35,-1.65l-1.12,-2.78l-0.21,-0.18l-1.5,-0.33l-2.98,-1.89l-0.12,-0.04l-3.37,-0.43l-2.84,-0.51l-0.75,-1.13l0.93,-3.54l-0.04,-0.24l-1.73,-2.55l-0.15,-0.12l-3.52,-1.18l-1.99,-1.61l-0.54,-1.85Z", "name": "Mongolia"}, "MK": {"path": "M472.73,173.87l0.08,0.01l0.32,-0.25l0.08,-0.44l1.29,-0.41l1.37,-0.28l1.03,-0.04l1.06,0.82l0.14,1.59l-0.22,0.04l-0.17,0.11l-0.32,0.4l-1.2,-0.05l-0.18,0.05l-0.9,0.61l-1.45,0.23l-0.85,-0.59l-0.3,-1.09l0.22,-0.71Z", "name": "Macedonia"}, "MW": {"path": "M507.18,313.84l-0.67,1.85l-0.01,0.16l0.7,3.31l0.31,0.24l0.75,-0.03l0.78,0.71l0.99,1.75l0.2,3.03l-0.91,0.45l-0.14,0.15l-0.59,1.38l-1.24,-1.21l-0.17,-1.62l0.49,-1.12l0.02,-0.16l-0.15,-1.03l-0.13,-0.21l-0.99,-0.65l-0.26,-0.03l-0.53,0.18l-1.31,-1.12l-1.15,-0.59l0.66,-2.06l0.75,-0.84l0.07,-0.27l-0.47,-2.04l0.48,-1.94l0.4,-0.65l0.03,-0.24l-0.64,-2.15l-0.08,-0.13l-0.44,-0.42l1.34,0.26l1.25,1.73l0.67,3.3Z", "name": "Malawi"}, "MR": {"path": "M390.54,247.66l-1.48,-1.58l-1.51,-1.88l-0.12,-0.09l-1.64,-0.67l-1.17,-0.74l-0.17,-0.05l-1.4,0.03l-0.12,0.03l-1.14,0.52l-1.15,-0.21l-0.26,0.08l-0.44,0.43l-0.11,-0.72l0.68,-1.29l0.31,-2.43l-0.28,-2.63l-0.29,-1.27l0.24,-1.24l-0.03,-0.2l-0.65,-1.24l-1.19,-1.05l0.32,-0.51l9.64,0.02l0.3,-0.34l-0.46,-3.71l0.51,-1.12l2.17,-0.22l0.27,-0.3l-0.08,-6.5l7.91,0.13l0.31,-0.3l0.01,-3.5l8.17,5.63l-2.89,0.04l-0.29,0.33l2.42,22.56l0.12,0.21l0.26,0.19l-0.43,1.38l-9.83,0.04l-0.25,0.13l-0.27,0.41l-0.77,-0.14l-0.15,0.01l-1.3,0.47l-1.64,-0.67l-0.14,-0.02l-0.79,0.06l-0.27,0.22l-0.39,1.39l-0.53,0.29Z", "name": "Mauritania"}, "UG": {"path": "M500.74,287.17l-2.84,-0.02l-0.92,0.32l-1.37,0.71l-0.29,-0.12l0.02,-1.6l0.54,-0.89l0.04,-0.13l0.14,-1.96l0.49,-1.09l0.91,-1.24l0.97,-0.68l0.8,-0.89l-0.13,-0.49l-0.79,-0.27l0.13,-2.55l0.78,-0.52l1.45,0.51l0.18,0.01l1.97,-0.57l1.72,0.01l0.18,-0.06l1.29,-0.97l0.98,1.44l0.29,1.24l1.05,2.75l-0.84,1.68l-1.94,2.66l-0.06,0.18l0.02,2.36l-4.8,0.18Z", "name": "Uganda"}, "MY": {"path": "M717.6,273.52l-1.51,0.7l-2.13,-0.41l-2.88,-0.0l-0.29,0.21l-0.84,2.77l-0.9,0.82l-0.08,0.12l-1.23,3.34l-1.81,0.47l-2.29,-0.68l-0.14,-0.01l-1.2,0.22l-0.14,0.07l-1.36,1.18l-1.47,-0.17l-0.12,0.01l-1.46,0.46l-1.51,-1.25l-0.24,-0.97l1.26,0.59l0.2,0.02l1.93,-0.47l0.22,-0.22l0.47,-1.98l0.9,-0.4l2.97,-0.54l0.17,-0.09l1.8,-1.98l1.02,-1.32l0.9,1.03l0.48,-0.04l0.43,-0.7l1.02,0.07l0.32,-0.27l0.25,-2.72l1.84,-1.67l1.23,-1.89l0.73,-0.01l1.12,1.11l0.1,0.99l0.18,0.24l1.66,0.71l1.85,0.67l-0.09,0.51l-1.45,0.11l-0.26,0.4l0.35,0.97ZM673.78,269.53l0.17,1.14l0.35,0.25l1.65,-0.3l0.18,-0.11l0.68,-0.86l0.31,0.13l1.41,1.45l0.99,1.59l0.13,1.57l-0.26,1.09l0.0,0.15l0.24,0.84l0.18,1.46l0.11,0.2l0.82,0.64l0.92,2.08l-0.03,0.52l-1.4,0.13l-2.29,-1.79l-2.86,-1.92l-0.27,-1.16l-0.07,-0.13l-1.39,-1.61l-0.33,-1.99l-0.05,-0.12l-0.84,-1.27l0.26,-1.72l-0.03,-0.18l-0.45,-0.87l0.13,-0.13l1.71,0.92Z", "name": "Malaysia"}, "MX": {"path": "M133.41,213.83l0.61,0.09l0.27,-0.09l0.93,-1.01l0.08,-0.18l0.09,-1.22l-0.09,-0.23l-1.93,-1.94l-1.46,-0.77l-2.96,-5.62l-0.86,-2.1l2.44,-0.18l2.68,-0.25l-0.03,0.08l0.17,0.4l3.79,1.35l5.81,1.97l6.96,-0.02l0.3,-0.3l0.0,-0.84l3.91,0.0l0.87,0.93l1.27,0.87l1.44,1.17l0.79,1.37l0.62,1.49l0.12,0.14l1.35,0.85l2.08,0.82l0.35,-0.1l1.49,-2.04l1.81,-0.05l1.63,1.01l1.21,1.8l0.86,1.58l1.47,1.55l0.53,1.82l0.73,1.32l0.14,0.13l1.98,0.84l1.78,0.59l0.61,-0.03l-0.78,1.89l-0.45,1.96l-0.19,3.58l-0.24,1.27l0.01,0.14l0.43,1.43l0.78,1.31l0.49,1.98l0.06,0.12l1.63,1.9l0.61,1.51l0.98,1.28l0.16,0.11l2.58,0.67l0.98,1.02l0.31,0.08l2.17,-0.71l1.91,-0.26l1.87,-0.47l1.67,-0.49l1.59,-1.06l0.11,-0.14l0.6,-1.52l0.22,-2.21l0.35,-0.62l1.58,-0.64l2.59,-0.59l2.18,0.09l1.43,-0.2l0.39,0.36l-0.07,1.02l-1.28,1.48l-0.65,1.68l0.07,0.32l0.33,0.32l-0.79,2.49l-0.28,-0.3l-0.24,-0.09l-1.0,0.08l-0.24,0.15l-0.74,1.28l-0.19,-0.13l-0.28,-0.03l-0.3,0.12l-0.19,0.29l0.0,0.06l-4.34,-0.02l-0.3,0.3l-0.0,1.16l-0.83,0.0l-0.28,0.19l0.08,0.33l0.93,0.86l0.9,0.58l0.24,0.48l0.16,0.15l0.2,0.08l-0.03,0.38l-2.94,0.01l-0.26,0.15l-1.21,2.09l0.02,0.33l0.25,0.33l-0.21,0.44l-0.04,0.22l-2.42,-2.35l-1.36,-0.87l-2.04,-0.67l-0.13,-0.01l-1.4,0.19l-2.07,0.98l-1.14,0.23l-1.72,-0.66l-1.85,-0.48l-2.31,-1.16l-1.92,-0.38l-2.79,-1.18l-2.04,-1.2l-0.6,-0.66l-0.19,-0.1l-1.37,-0.15l-2.45,-0.78l-1.07,-1.18l-2.63,-1.44l-1.2,-1.56l-0.44,-0.93l0.5,-0.15l0.2,-0.39l-0.2,-0.58l0.46,-0.55l0.07,-0.19l0.01,-0.91l-0.06,-0.18l-0.81,-1.13l-0.25,-1.08l-0.86,-1.36l-2.21,-2.63l-2.53,-2.09l-1.2,-1.63l-0.11,-0.09l-2.08,-1.06l-0.34,-0.48l0.35,-1.53l-0.16,-0.34l-1.24,-0.61l-1.39,-1.23l-0.6,-1.81l-0.24,-0.2l-1.25,-0.2l-1.38,-1.35l-1.11,-1.25l-0.1,-0.76l-0.05,-0.13l-1.33,-2.04l-0.85,-2.02l0.04,-0.99l-0.14,-0.27l-1.81,-1.1l-0.2,-0.04l-0.74,0.11l-1.34,-0.72l-0.42,0.16l-0.4,1.12l-0.0,0.19l0.41,1.3l0.24,2.04l0.06,0.15l0.88,1.16l1.84,1.86l0.4,0.61l0.12,0.1l0.27,0.14l0.29,0.82l0.31,0.2l0.2,-0.02l0.43,1.51l0.09,0.14l0.72,0.65l0.51,0.91l1.58,1.4l0.8,2.42l0.77,1.23l0.66,1.19l0.13,1.34l0.28,0.27l1.08,0.08l0.92,1.1l0.83,1.08l-0.03,0.24l-0.88,0.81l-0.13,-0.0l-0.59,-1.42l-0.07,-0.11l-1.67,-1.53l-1.81,-1.28l-1.15,-0.61l0.07,-1.85l-0.38,-1.45l-0.12,-0.17l-2.91,-2.03l-0.39,0.04l-0.11,0.11l-0.42,-0.46l-0.11,-0.08l-1.49,-0.63l-1.09,-1.16Z", "name": "Mexico"}, "VU": {"path": "M839.92,325.66l0.78,0.73l-0.18,0.07l-0.6,-0.8ZM839.13,322.74l0.27,1.36l-0.13,-0.06l-0.21,-0.02l-0.29,0.08l-0.22,-0.43l-0.03,-1.32l0.61,0.4Z", "name": "Vanuatu"}, "FR": {"path": "M444.58,172.63l-0.68,1.92l-0.72,-0.38l-0.51,-1.79l0.43,-0.95l1.15,-0.83l0.33,2.04ZM429.71,147.03l1.77,1.57l0.26,0.07l1.16,-0.23l2.12,1.44l0.56,0.28l0.16,0.03l0.61,-0.06l1.09,0.78l0.13,0.05l3.18,0.53l-1.09,1.94l-0.3,2.16l-0.48,0.38l-1.0,-0.26l-0.37,0.32l0.07,0.66l-1.73,1.68l-0.09,0.21l-0.04,1.42l0.41,0.29l0.96,-0.4l0.67,1.07l-0.09,0.78l0.04,0.19l0.61,0.97l-0.71,0.78l-0.07,0.28l0.65,2.39l0.21,0.21l1.09,0.31l-0.2,0.95l-2.08,1.58l-4.81,-0.8l-0.13,0.01l-3.65,0.99l-0.22,0.24l-0.25,1.6l-2.59,0.35l-2.74,-1.33l-0.31,0.03l-0.79,0.57l-4.38,-1.31l-0.79,-0.94l1.16,-1.64l0.05,-0.15l0.48,-6.17l-0.06,-0.21l-2.58,-3.3l-1.89,-1.65l-0.11,-0.06l-3.64,-1.17l-0.2,-1.88l2.92,-0.63l4.14,0.82l0.35,-0.36l-0.65,-3.0l1.77,1.05l0.27,0.02l5.83,-2.54l0.17,-0.19l0.71,-2.54l1.75,-0.53l0.27,0.88l0.27,0.21l1.04,0.05l1.08,1.23ZM289.1,278.45l-0.85,0.84l-0.88,0.13l-0.25,-0.51l-0.21,-0.16l-0.56,-0.1l-0.25,0.07l-0.63,0.55l-0.62,-0.29l0.5,-0.88l0.21,-1.11l0.42,-1.05l-0.03,-0.28l-0.93,-1.42l-0.18,-1.54l1.13,-1.87l2.42,0.78l2.55,2.04l0.33,0.81l-1.4,2.16l-0.77,1.84Z", "name": "France"}, "FI": {"path": "M492.26,76.42l-0.38,3.12l0.12,0.28l3.6,2.69l-2.14,2.96l-0.01,0.33l2.83,4.61l-1.61,3.36l0.03,0.31l2.15,2.87l-0.96,2.44l0.1,0.35l3.51,2.55l-0.81,1.72l-2.28,2.19l-5.28,4.79l-4.51,0.31l-4.39,1.37l-3.87,0.75l-1.34,-1.89l-0.11,-0.09l-2.23,-1.14l0.53,-3.54l-0.01,-0.14l-1.17,-3.37l1.12,-2.13l2.23,-2.44l5.69,-4.33l1.65,-0.84l0.16,-0.31l-0.26,-1.73l-0.15,-0.22l-3.4,-1.91l-0.77,-1.47l-0.07,-6.45l-0.12,-0.24l-3.91,-2.94l-3.0,-1.92l0.97,-0.76l2.6,2.17l0.21,0.07l3.2,-0.21l2.63,1.03l0.3,-0.05l2.39,-1.94l0.09,-0.13l1.18,-3.12l3.63,-1.42l2.87,1.59l-0.98,2.87Z", "name": "Finland"}, "FJ": {"path": "M869.98,327.07l-1.31,0.44l-0.14,-0.41l0.96,-0.41l0.85,-0.17l1.43,-0.78l-0.16,0.65l-1.64,0.67ZM867.58,329.12l0.54,0.47l-0.31,1.0l-1.32,0.3l-1.13,-0.26l-0.17,-0.78l0.72,-0.66l0.98,0.27l0.25,-0.04l0.43,-0.29Z", "name": "Fiji"}, "FK": {"path": "M268.15,427.89l2.6,-1.73l1.98,0.77l0.31,-0.05l1.32,-1.17l1.58,1.18l-0.54,0.84l-3.1,0.92l-1.0,-1.04l-0.39,-0.04l-1.9,1.35l-0.86,-1.04Z", "name": "Falkland Islands"}, "NI": {"path": "M202.1,252.6l0.23,-0.0l0.12,-0.11l0.68,-0.09l0.22,-0.15l0.23,-0.43l0.2,-0.01l0.28,-0.31l-0.04,-0.97l0.29,-0.03l0.5,0.02l0.25,-0.11l0.37,-0.46l0.51,0.35l0.4,-0.06l0.23,-0.28l0.45,-0.29l0.87,-0.7l0.11,-0.21l0.02,-0.26l0.23,-0.12l0.25,-0.48l0.29,0.27l0.14,0.07l0.5,0.12l0.22,-0.03l0.48,-0.28l0.66,-0.02l0.87,-0.33l0.36,-0.32l0.21,0.01l-0.11,0.48l0.0,0.14l0.22,0.8l-0.54,0.85l-0.27,1.03l-0.09,1.18l0.14,0.72l0.05,0.95l-0.24,0.15l-0.13,0.19l-0.23,1.09l0.0,0.14l0.14,0.53l-0.42,0.53l-0.06,0.24l0.12,0.69l0.08,0.15l0.18,0.19l-0.26,0.23l-0.49,-0.11l-0.35,-0.44l-0.16,-0.1l-0.79,-0.21l-0.23,0.03l-0.45,0.26l-1.51,-0.62l-0.31,0.05l-0.17,0.15l-1.81,-1.62l-0.6,-0.9l-1.04,-0.79l-0.77,-0.71Z", "name": "Nicaragua"}, "NL": {"path": "M436.22,136.65l1.82,0.08l0.36,0.89l-0.6,2.96l-0.53,1.06l-1.32,0.0l-0.3,0.34l0.35,2.89l-0.83,-0.47l-1.56,-1.43l-0.29,-0.07l-2.26,0.67l-1.02,-0.15l0.68,-0.48l0.1,-0.12l2.14,-4.84l3.25,-1.35Z", "name": "Netherlands"}, "NO": {"path": "M491.45,67.31l7.06,3.0l-2.52,0.94l-0.11,0.49l2.43,2.49l-3.82,1.59l-1.48,0.3l0.89,-2.61l-0.14,-0.36l-3.21,-1.78l-0.25,-0.02l-3.89,1.52l-0.17,0.17l-1.2,3.17l-2.19,1.78l-2.53,-0.99l-0.13,-0.02l-3.15,0.21l-2.69,-2.25l-0.38,-0.01l-1.43,1.11l-1.47,0.17l-0.26,0.26l-0.33,2.57l-4.42,-0.65l-0.33,0.22l-0.6,2.19l-2.17,-0.01l-0.27,0.16l-4.15,7.68l-3.88,5.76l-0.0,0.33l0.81,1.23l-0.7,1.27l-2.3,-0.06l-0.28,0.18l-1.63,3.72l-0.02,0.13l0.15,5.17l0.07,0.18l1.51,1.84l-0.79,4.24l-2.04,2.5l-0.92,1.75l-1.39,-1.88l-0.44,-0.05l-4.89,4.21l-3.16,0.81l-3.24,-1.74l-0.86,-3.82l-0.78,-8.6l2.18,-2.36l6.56,-3.28l5.0,-4.16l4.63,-5.74l5.99,-8.09l4.17,-3.23l6.84,-5.49l5.39,-1.92l4.06,0.24l0.23,-0.09l3.72,-3.67l4.51,0.19l4.4,-0.89ZM484.58,19.95l4.42,1.82l-3.25,2.68l-7.14,0.65l-7.16,-0.91l-0.39,-1.37l-0.28,-0.22l-3.48,-0.1l-2.25,-2.15l7.09,-1.48l3.55,1.36l0.28,-0.03l2.42,-1.66l6.18,1.41ZM481.99,33.92l-4.73,1.85l-3.76,-1.06l1.27,-1.02l0.04,-0.43l-1.18,-1.35l4.46,-0.94l0.89,1.83l0.17,0.15l2.83,0.96ZM466.5,23.95l7.64,3.87l-5.63,1.94l-0.19,0.19l-1.35,3.88l-2.08,0.96l-0.16,0.19l-1.14,4.18l-2.71,0.18l-4.94,-2.95l1.95,-1.63l-0.08,-0.51l-3.7,-1.54l-4.79,-4.54l-1.78,-4.01l6.29,-1.88l1.25,1.81l0.25,0.13l3.57,-0.08l0.26,-0.17l0.87,-1.79l3.41,-0.18l3.08,1.94Z", "name": "Norway"}, "NA": {"path": "M461.88,357.98l-1.61,-1.77l-0.94,-1.9l-0.54,-2.58l-0.62,-1.95l-0.83,-4.05l-0.06,-3.13l-0.33,-1.5l-0.07,-0.14l-0.95,-1.06l-1.27,-2.12l-1.3,-3.1l-0.59,-1.71l-1.98,-2.46l-0.13,-1.67l0.99,-0.4l1.44,-0.42l1.48,0.07l1.42,1.11l0.31,0.03l0.32,-0.15l9.99,-0.11l1.66,1.18l0.16,0.06l6.06,0.37l4.69,-1.06l2.01,-0.57l1.5,0.14l0.63,0.37l-1.0,0.41l-0.7,0.01l-0.16,0.05l-1.38,0.88l-0.79,-0.88l-0.29,-0.09l-3.83,0.9l-1.84,0.08l-0.29,0.3l-0.07,8.99l-2.18,0.08l-0.29,0.3l-0.0,17.47l-2.04,1.27l-1.21,0.18l-1.51,-0.49l-0.99,-0.18l-0.36,-1.0l-0.1,-0.14l-0.99,-0.74l-0.4,0.04l-0.98,1.09Z", "name": "Namibia"}, "NC": {"path": "M835.87,338.68l2.06,1.63l1.01,0.94l-0.49,0.32l-1.21,-0.62l-1.76,-1.16l-1.58,-1.36l-1.61,-1.79l-0.16,-0.41l0.54,0.02l1.32,0.83l1.08,0.87l0.79,0.73Z", "name": "New Caledonia"}, "NE": {"path": "M426.67,254.17l0.03,-1.04l-0.24,-0.3l-2.66,-0.53l-0.06,-1.0l-0.07,-0.17l-1.37,-1.62l-0.3,-1.04l0.15,-0.94l1.37,-0.09l0.19,-0.09l0.85,-0.83l3.34,-0.22l2.22,-0.41l0.24,-0.26l0.2,-1.5l1.32,-1.65l0.07,-0.19l-0.01,-5.74l3.4,-1.13l7.24,-5.12l8.46,-4.95l3.76,1.08l1.35,1.39l0.36,0.05l1.39,-0.77l0.55,3.66l0.12,0.2l0.82,0.6l0.03,0.69l0.1,0.21l0.87,0.74l-0.47,0.99l-0.96,5.26l-0.13,3.25l-3.08,2.34l-0.1,0.15l-1.08,3.37l0.08,0.31l0.94,0.86l-0.01,1.51l0.29,0.3l1.25,0.05l-0.14,0.66l-0.51,0.11l-0.24,0.26l-0.06,0.57l-0.04,0.0l-1.59,-2.62l-0.21,-0.14l-0.59,-0.1l-0.23,0.05l-1.83,1.33l-1.79,-0.68l-1.42,-0.17l-0.17,0.03l-0.65,0.32l-1.39,-0.07l-0.19,0.06l-1.4,1.03l-1.12,0.05l-2.97,-1.29l-0.26,0.01l-1.12,0.59l-1.08,-0.04l-0.85,-0.88l-0.11,-0.07l-2.51,-0.95l-0.14,-0.02l-2.69,0.3l-0.16,0.07l-0.65,0.55l-0.1,0.16l-0.34,1.41l-0.69,0.98l-0.05,0.15l-0.13,1.72l-1.47,-1.13l-0.18,-0.06l-0.9,0.01l-0.2,0.08l-0.32,0.28Z", "name": "Niger"}, "NG": {"path": "M442.0,272.7l-2.4,0.83l-0.88,-0.12l-0.19,0.04l-0.89,0.52l-1.78,-0.05l-1.23,-1.44l-0.88,-1.87l-1.77,-1.66l-0.21,-0.08l-3.78,0.03l0.13,-3.75l-0.06,-1.58l0.44,-1.47l0.74,-0.75l1.21,-1.56l0.04,-0.29l-0.22,-0.56l0.44,-0.9l0.01,-0.24l-0.54,-1.44l0.26,-2.97l0.72,-1.06l0.33,-1.37l0.51,-0.43l2.53,-0.28l2.38,0.9l0.89,0.91l0.2,0.09l1.28,0.04l0.15,-0.03l1.06,-0.56l2.9,1.26l0.13,0.02l1.28,-0.06l0.16,-0.06l1.39,-1.02l1.36,0.07l0.15,-0.03l0.64,-0.32l1.22,0.13l1.9,0.73l0.28,-0.04l1.86,-1.35l0.33,0.06l1.62,2.67l0.29,0.14l0.32,-0.04l0.73,0.74l-0.19,0.37l-0.12,0.74l-2.03,1.89l-0.07,0.11l-0.66,1.62l-0.35,1.28l-0.48,0.51l-0.07,0.12l-0.48,1.67l-1.26,0.98l-0.1,0.15l-0.38,1.24l-0.58,1.07l-0.2,0.91l-1.43,0.7l-1.26,-0.93l-0.19,-0.06l-0.95,0.04l-0.2,0.09l-1.41,1.39l-0.61,0.02l-0.26,0.17l-1.19,2.42l-0.61,1.67Z", "name": "Nigeria"}, "NZ": {"path": "M857.9,379.62l1.85,3.1l0.33,0.14l0.22,-0.28l0.04,-1.41l0.57,0.4l0.35,2.06l0.17,0.22l2.02,0.94l1.78,0.26l0.22,-0.06l1.31,-1.01l0.84,0.22l-0.53,2.27l-0.67,1.5l-1.71,-0.05l-0.25,0.12l-0.67,0.89l-0.05,0.23l0.21,1.15l-0.31,0.46l-2.15,3.57l-1.6,0.99l-0.28,-0.51l-0.15,-0.13l-0.72,-0.3l1.27,-2.15l0.01,-0.29l-0.82,-1.63l-0.15,-0.14l-2.5,-1.09l0.05,-0.69l1.67,-0.94l0.15,-0.21l0.42,-2.24l-0.11,-1.95l-0.03,-0.12l-0.97,-1.85l0.05,-0.41l-0.09,-0.25l-1.18,-1.17l-1.94,-2.49l-0.86,-1.64l0.38,-0.09l1.24,1.43l0.12,0.08l1.81,0.68l0.67,2.39ZM853.93,393.55l0.57,1.24l0.44,0.12l1.51,-1.03l0.52,0.91l0.0,1.09l-0.88,1.31l-1.62,2.2l-1.26,1.2l-0.05,0.38l0.64,1.02l-1.4,0.03l-0.14,0.04l-2.14,1.16l-0.14,0.17l-0.67,2.0l-1.38,3.06l-3.07,2.19l-2.12,-0.06l-1.55,-0.99l-0.14,-0.05l-2.53,-0.2l-0.31,-0.84l1.25,-2.15l3.07,-2.97l1.62,-0.59l1.81,-1.17l2.18,-1.63l1.55,-1.65l1.08,-2.18l0.9,-0.72l0.11,-0.17l0.35,-1.56l1.37,-1.07l0.4,0.91Z", "name": "New Zealand"}, "NP": {"path": "M641.26,213.53l-0.14,0.95l0.32,1.64l-0.21,0.78l-1.83,0.04l-2.98,-0.62l-1.86,-0.25l-1.37,-1.3l-0.18,-0.08l-3.38,-0.34l-3.21,-1.49l-2.38,-1.34l-2.16,-0.92l0.84,-2.2l1.51,-1.18l0.89,-0.57l1.83,0.77l2.5,1.76l1.39,0.41l0.78,1.21l0.17,0.13l1.91,0.53l2.0,1.17l2.92,0.66l2.63,0.24Z", "name": "Nepal"}, "CI": {"path": "M413.53,272.08l-0.83,0.02l-1.79,-0.49l-1.64,0.03l-3.04,0.46l-1.73,0.72l-2.4,0.89l-0.12,-0.02l0.16,-1.7l0.19,-0.25l0.06,-0.2l-0.08,-0.99l-0.09,-0.19l-1.06,-1.05l-0.15,-0.08l-0.71,-0.15l-0.51,-0.48l0.45,-0.92l0.02,-0.19l-0.24,-1.16l0.07,-0.43l0.14,-0.0l0.3,-0.26l0.15,-1.1l-0.02,-0.15l-0.13,-0.34l0.09,-0.13l0.83,-0.27l0.19,-0.37l-0.62,-2.02l-0.55,-1.0l0.14,-0.59l0.35,-0.14l0.24,-0.16l0.53,0.29l0.14,0.04l1.93,0.02l0.26,-0.14l0.36,-0.58l0.39,0.01l0.43,-0.17l0.28,0.79l0.43,0.16l0.56,-0.31l0.89,-0.32l0.92,0.45l0.39,0.75l0.14,0.13l1.13,0.53l0.3,-0.03l0.81,-0.59l1.02,-0.08l1.49,0.57l0.62,3.33l-1.03,2.09l-0.65,2.84l0.02,0.2l1.05,2.08l-0.07,0.64Z", "name": "Ivory Coast"}, "CH": {"path": "M444.71,156.27l0.05,0.3l-0.34,0.69l0.13,0.4l1.13,0.58l1.07,0.1l-0.12,0.81l-0.87,0.42l-1.75,-0.37l-0.34,0.18l-0.47,1.1l-0.86,0.07l-0.33,-0.38l-0.41,-0.04l-1.34,1.01l-1.02,0.13l-0.93,-0.58l-0.82,-1.32l-0.37,-0.12l-0.77,0.32l0.02,-0.84l1.74,-1.69l0.09,-0.25l-0.04,-0.38l0.73,0.19l0.26,-0.06l0.6,-0.48l2.02,0.02l0.24,-0.12l0.38,-0.51l2.31,0.84Z", "name": "Switzerland"}, "CO": {"path": "M232.24,284.95l-0.94,-0.52l-1.22,-0.82l-0.31,-0.01l-0.62,0.35l-1.88,-0.31l-0.54,-0.95l-0.29,-0.15l-0.37,0.03l-2.34,-1.33l-0.15,-0.35l0.57,-0.11l0.24,-0.32l-0.1,-1.15l0.46,-0.71l1.11,-0.15l0.21,-0.13l1.05,-1.57l0.95,-1.31l-0.08,-0.43l-0.73,-0.47l0.4,-1.24l0.01,-0.16l-0.53,-2.15l0.44,-0.54l0.06,-0.24l-0.4,-2.13l-0.06,-0.13l-0.93,-1.22l0.21,-0.8l0.52,0.12l0.32,-0.13l0.47,-0.75l0.03,-0.27l-0.52,-1.32l0.09,-0.11l1.14,0.07l0.22,-0.08l1.82,-1.71l0.96,-0.25l0.22,-0.28l0.02,-0.81l0.43,-2.01l1.28,-1.04l1.48,-0.05l0.27,-0.19l0.12,-0.31l1.73,0.19l0.2,-0.05l1.96,-1.28l0.97,-0.56l1.16,-1.16l0.64,0.11l0.43,0.44l-0.31,0.55l-1.49,0.39l-0.19,0.16l-0.6,1.2l-0.97,0.74l-0.73,0.94l-0.06,0.13l-0.3,1.76l-0.68,1.44l0.23,0.43l1.1,0.14l0.27,0.97l0.08,0.13l0.49,0.49l0.17,0.85l-0.27,0.86l-0.01,0.14l0.09,0.53l0.2,0.23l0.52,0.18l0.54,0.79l0.27,0.13l3.18,-0.24l1.31,0.29l1.7,2.08l0.31,0.1l0.96,-0.26l1.75,0.13l1.41,-0.27l0.56,0.27l-0.36,1.07l-0.54,0.81l-0.05,0.13l-0.2,1.8l0.51,1.79l0.07,0.12l0.65,0.68l0.05,0.32l-1.16,1.14l0.05,0.47l0.86,0.52l0.6,0.79l0.31,1.01l-0.7,-0.81l-0.44,-0.01l-0.74,0.77l-4.75,-0.05l-0.3,0.31l0.03,1.57l0.25,0.29l1.2,0.21l-0.02,0.24l-0.1,-0.05l-0.22,-0.02l-1.41,0.41l-0.22,0.29l-0.01,1.82l0.11,0.23l1.04,0.85l0.35,1.3l-0.06,1.02l-1.02,6.26l-0.84,-0.89l-0.19,-0.09l-0.25,-0.02l1.35,-2.13l-0.1,-0.42l-1.92,-1.17l-0.2,-0.04l-1.41,0.2l-0.82,-0.39l-0.26,0.0l-1.29,0.62l-1.63,-0.27l-1.4,-2.5l-0.12,-0.12l-1.1,-0.61l-0.83,-1.2l-1.67,-1.19l-0.27,-0.04l-0.54,0.19Z", "name": "Colombia"}, "CN": {"path": "M740.32,148.94l0.22,0.21l4.3,1.03l2.84,2.2l0.99,2.92l0.28,0.2l3.8,0.0l0.15,-0.04l2.13,-1.24l3.5,-0.8l-1.05,2.29l-0.95,1.13l-0.06,0.12l-0.85,3.41l-1.56,2.81l-2.83,-0.51l-0.19,0.03l-2.15,1.09l-0.15,0.34l0.65,2.59l-0.33,3.3l-1.03,0.07l-0.28,0.3l0.01,0.75l-1.09,-1.2l-0.48,0.05l-0.94,1.6l-3.76,1.26l-0.2,0.36l0.29,1.19l-1.67,-0.08l-1.11,-0.88l-0.42,0.05l-1.69,2.08l-2.71,1.57l-2.04,1.88l-3.42,0.84l-0.11,0.05l-1.8,1.34l-1.54,0.46l0.52,-0.53l0.06,-0.33l-0.44,-0.96l1.84,-1.84l0.02,-0.41l-1.32,-1.56l-0.36,-0.08l-2.23,1.08l-2.83,2.06l-1.52,1.85l-2.32,0.13l-0.2,0.09l-1.28,1.37l-0.03,0.37l1.32,1.97l0.18,0.13l1.83,0.43l0.07,1.08l0.18,0.26l1.98,0.84l0.3,-0.03l2.66,-1.96l2.06,1.04l0.12,0.03l1.4,0.07l0.27,1.0l-3.24,0.73l-0.17,0.11l-1.13,1.5l-2.38,1.4l-0.1,0.1l-1.29,1.99l0.1,0.42l2.6,1.5l0.97,2.72l1.52,2.56l1.66,2.08l-0.03,1.76l-1.4,0.67l-0.15,0.38l0.6,1.47l0.13,0.15l1.29,0.75l-0.35,2.0l-0.58,1.96l-1.22,0.21l-0.2,0.14l-1.83,2.93l-2.02,3.51l-2.29,3.13l-3.4,2.42l-3.42,2.18l-2.75,0.3l-0.15,0.06l-1.32,1.01l-0.68,-0.67l-0.41,-0.01l-1.37,1.27l-3.42,1.28l-2.62,0.4l-0.24,0.21l-0.8,2.57l-0.95,0.11l-0.53,-1.54l0.52,-0.89l-0.19,-0.44l-3.36,-0.84l-0.17,0.01l-1.09,0.4l-2.36,-0.64l-1.0,-0.9l0.35,-1.34l-0.23,-0.37l-2.22,-0.47l-1.15,-0.94l-0.36,-0.02l-2.08,1.37l-2.35,0.29l-1.98,-0.01l-0.13,0.03l-1.32,0.63l-1.28,0.38l-0.21,0.33l0.33,2.65l-0.78,-0.04l-0.14,-0.39l-0.07,-1.04l-0.41,-0.26l-1.72,0.71l-0.96,-0.43l-1.63,-0.86l0.65,-1.95l-0.19,-0.38l-1.43,-0.46l-0.56,-2.27l-0.34,-0.22l-2.26,0.38l0.25,-2.65l2.29,-2.15l0.09,-0.2l0.1,-2.21l-0.07,-2.09l-0.15,-0.25l-1.02,-0.6l-0.8,-1.52l-0.31,-0.16l-1.42,0.2l-2.16,-0.32l0.55,-0.74l0.01,-0.35l-1.17,-1.7l-0.41,-0.08l-1.67,1.07l-1.97,-0.63l-0.25,0.03l-2.89,1.73l-2.26,1.99l-1.82,0.3l-1.0,-0.66l-0.15,-0.05l-1.28,-0.06l-1.75,-0.61l-0.24,0.02l-1.35,0.69l-0.1,0.08l-1.2,1.45l-0.14,-1.41l-0.4,-0.25l-1.46,0.55l-2.83,-0.26l-2.77,-0.61l-1.99,-1.17l-1.91,-0.54l-0.78,-1.21l-0.17,-0.13l-1.36,-0.38l-2.54,-1.79l-2.01,-0.84l-0.28,0.02l-0.89,0.56l-3.31,-1.83l-2.35,-1.67l-0.57,-2.49l1.34,0.28l0.36,-0.28l0.08,-1.42l-0.05,-0.19l-0.93,-1.34l0.24,-2.18l-0.07,-0.22l-2.69,-3.32l-0.15,-0.1l-3.97,-1.11l-0.69,-2.05l-0.11,-0.15l-1.79,-1.3l-0.39,-0.73l-0.36,-1.57l0.08,-1.09l-0.18,-0.3l-1.52,-0.66l-0.22,-0.01l-0.51,0.18l-0.52,-2.21l0.59,-0.55l0.06,-0.35l-0.22,-0.44l2.12,-1.24l1.63,-0.55l2.58,0.39l0.31,-0.16l0.87,-1.75l3.05,-0.34l0.21,-0.12l0.84,-1.12l3.87,-1.59l0.15,-0.14l0.35,-0.68l0.03,-0.17l-0.17,-1.51l1.52,-0.7l0.15,-0.39l-2.12,-5.0l4.62,-1.15l1.35,-0.72l0.14,-0.17l1.72,-5.37l4.7,0.99l0.28,-0.08l1.39,-1.43l0.08,-0.2l0.11,-2.95l1.83,-0.26l0.18,-0.1l1.85,-2.08l0.61,-0.17l0.57,1.97l0.1,0.15l2.2,1.75l3.48,1.17l1.59,2.36l-0.93,3.53l0.04,0.24l0.9,1.35l0.2,0.13l2.98,0.53l3.32,0.43l2.97,1.89l1.49,0.35l1.08,2.67l1.52,1.88l0.24,0.11l2.74,-0.07l5.15,0.67l3.36,-0.41l2.39,0.43l3.67,1.81l0.13,0.03l2.92,-0.0l1.02,0.86l0.34,0.03l2.88,-1.59l3.98,-1.03l3.81,-0.13l3.02,-1.12l1.77,-1.61l1.73,-1.01l0.13,-0.37l-0.41,-1.01l-0.72,-1.07l1.09,-1.66l1.21,0.24l2.57,0.63l0.24,-0.04l2.46,-1.62l3.78,-1.19l0.13,-0.09l1.8,-2.03l1.66,-0.84l3.54,-0.41l1.93,0.35l0.34,-0.22l0.27,-1.12l-0.08,-0.29l-2.27,-2.22l-2.08,-1.07l-0.29,0.01l-1.82,1.12l-2.36,-0.47l-0.14,0.01l-1.18,0.34l-0.46,-0.94l1.69,-3.08l1.1,-2.21l2.75,1.12l0.26,-0.02l3.53,-2.06l0.15,-0.26l-0.02,-1.35l2.18,-3.39l1.35,-1.04l0.12,-0.24l-0.03,-1.85l-0.15,-0.25l-1.0,-0.58l1.68,-1.37l3.01,-0.59l3.25,-0.09l3.67,0.99l2.08,1.18l1.51,3.3l0.95,1.45l0.85,1.99l0.92,3.19ZM697.0,237.37l-1.95,1.12l-1.74,-0.68l-0.06,-1.9l1.08,-1.03l2.62,-0.7l1.23,0.05l0.37,0.65l-1.01,1.08l-0.54,1.4Z", "name": "China"}, "CM": {"path": "M453.76,278.92l-0.26,-0.11l-0.18,-0.02l-1.42,0.31l-1.56,-0.33l-1.17,0.16l-3.7,-0.05l0.3,-1.63l-0.04,-0.21l-0.98,-1.66l-0.15,-0.13l-1.03,-0.38l-0.46,-1.01l-0.13,-0.14l-0.48,-0.27l0.02,-0.46l0.62,-1.72l1.1,-2.25l0.54,-0.02l0.2,-0.09l1.41,-1.39l0.73,-0.03l1.32,0.97l0.31,0.03l1.72,-0.85l0.16,-0.2l0.22,-1.0l0.57,-1.03l0.36,-1.18l1.26,-0.98l0.1,-0.15l0.49,-1.7l0.48,-0.51l0.07,-0.13l0.35,-1.3l0.63,-1.54l2.06,-1.92l0.09,-0.17l0.12,-0.79l0.24,-0.41l-0.04,-0.36l-0.89,-0.91l0.04,-0.45l0.28,-0.06l0.85,1.39l0.16,1.59l-0.09,1.66l0.04,0.17l1.09,1.84l-0.86,-0.02l-0.72,0.17l-1.07,-0.24l-0.34,0.17l-0.54,1.19l0.06,0.34l1.48,1.47l1.06,0.44l0.32,0.94l0.73,1.6l-0.32,0.57l-1.23,2.49l-0.54,0.41l-0.12,0.21l-0.19,1.95l0.24,1.08l-0.18,0.67l0.07,0.28l1.13,1.25l0.24,0.93l0.92,1.29l1.1,0.8l0.1,1.01l0.26,0.73l-0.12,0.93l-1.65,-0.49l-2.02,-0.66l-3.19,-0.11Z", "name": "Cameroon"}, "CL": {"path": "M246.8,429.1l-1.14,0.78l-2.25,1.21l-0.16,0.23l-0.37,2.94l-0.75,0.06l-2.72,-1.07l-2.83,-2.34l-3.06,-1.9l-0.71,-1.92l0.67,-1.84l-0.02,-0.25l-1.22,-2.13l-0.31,-5.41l1.02,-2.95l2.59,-2.4l-0.13,-0.51l-3.32,-0.8l2.06,-2.4l0.07,-0.15l0.79,-4.77l2.44,0.95l0.4,-0.22l1.31,-6.31l-0.16,-0.33l-1.68,-0.8l-0.42,0.21l-0.72,3.47l-1.01,-0.27l0.74,-4.06l0.85,-5.46l1.12,-1.96l0.03,-0.22l-0.71,-2.82l-0.19,-2.94l0.76,-0.07l0.26,-0.2l1.53,-4.62l1.73,-4.52l1.07,-4.2l-0.56,-4.2l0.73,-2.2l0.01,-0.12l-0.29,-3.3l1.46,-3.34l0.45,-5.19l0.8,-5.52l0.78,-5.89l-0.18,-4.33l-0.49,-3.47l1.1,-0.56l0.13,-0.13l0.44,-0.88l0.9,1.29l0.32,1.8l0.1,0.18l1.16,0.97l-0.73,2.33l0.01,0.21l1.33,2.91l0.97,3.6l0.35,0.22l1.57,-0.31l0.16,0.34l-0.79,2.51l-2.61,1.25l-0.17,0.28l0.08,4.36l-0.48,0.79l0.01,0.33l0.6,0.84l-1.62,1.55l-1.67,2.6l-0.89,2.47l-0.02,0.13l0.23,2.56l-1.5,2.76l-0.03,0.21l1.15,4.8l0.11,0.17l0.54,0.42l-0.01,2.37l-1.4,2.7l-0.03,0.15l0.06,2.25l-1.8,1.78l-0.09,0.21l0.02,2.73l0.71,2.63l-1.33,0.94l-0.12,0.17l-0.67,2.64l-0.59,3.03l0.4,3.55l-0.84,0.51l-0.14,0.31l0.58,3.5l0.08,0.16l0.96,0.99l-0.7,1.08l0.11,0.43l1.04,0.55l0.19,0.8l-0.89,0.48l-0.16,0.31l0.26,1.77l-0.89,4.06l-1.31,2.67l-0.03,0.19l0.28,1.53l-0.73,1.88l-1.85,1.37l-0.12,0.26l0.22,3.46l0.06,0.16l0.88,1.19l0.28,0.12l1.32,-0.17l-0.04,2.13l0.04,0.15l1.04,1.95l0.24,0.16l5.94,0.44ZM248.79,430.71l0.0,7.41l0.3,0.3l2.67,0.0l1.01,0.06l-0.54,0.91l-1.99,1.01l-1.13,-0.1l-1.42,-0.27l-1.87,-1.06l-2.57,-0.49l-3.09,-1.9l-2.52,-1.83l-2.65,-2.93l0.93,0.32l3.54,2.29l3.32,1.23l0.34,-0.09l1.29,-1.57l0.83,-2.32l2.11,-1.28l1.43,0.32Z", "name": "Chile"}, "CA": {"path": "M280.14,145.66l-1.66,2.88l0.06,0.37l0.37,0.03l1.5,-1.01l1.17,0.49l-0.64,0.83l0.13,0.46l2.22,0.89l0.28,-0.03l1.02,-0.7l2.09,0.83l-0.69,2.1l0.37,0.38l1.43,-0.45l0.27,1.43l0.74,1.88l-0.95,2.5l-0.88,0.09l-1.34,-0.48l0.49,-2.34l-0.14,-0.32l-0.7,-0.4l-0.36,0.04l-2.81,2.66l-0.63,-0.05l1.2,-1.01l-0.1,-0.52l-2.4,-0.77l-2.79,0.18l-4.65,-0.09l-0.22,-0.54l1.37,-0.99l0.01,-0.48l-0.82,-0.65l1.91,-1.79l2.57,-5.17l1.49,-1.81l2.04,-1.07l0.63,0.08l-0.27,0.51l-1.33,2.07ZM193.92,74.85l-0.01,4.24l0.19,0.28l0.33,-0.07l3.14,-3.22l2.65,2.5l-0.71,3.04l0.06,0.26l2.42,2.88l0.46,0.0l2.66,-3.14l1.83,-3.74l0.03,-0.12l0.13,-4.53l3.23,0.31l3.63,0.64l3.18,2.08l0.13,1.91l-1.79,2.22l-0.0,0.37l1.69,2.2l-0.28,1.8l-4.74,2.84l-3.33,0.62l-2.5,-1.21l-0.41,0.17l-0.73,2.05l-2.39,3.44l-0.74,1.78l-2.78,2.61l-3.48,0.26l-0.17,0.07l-1.98,1.68l-0.1,0.21l-0.15,2.33l-2.68,0.45l-0.17,0.09l-3.1,3.2l-2.75,4.38l-0.99,3.06l-0.14,4.31l0.25,0.31l3.5,0.58l1.07,3.24l1.18,2.76l0.34,0.18l3.43,-0.69l4.55,1.52l2.45,1.32l1.76,1.65l0.12,0.07l3.11,0.96l2.63,1.46l0.13,0.04l4.12,0.2l2.41,0.3l-0.36,2.81l0.8,3.51l1.81,3.78l0.08,0.1l3.73,3.17l0.34,0.03l1.93,-1.08l0.13,-0.15l1.35,-3.44l0.01,-0.18l-1.31,-5.38l-0.08,-0.14l-1.46,-1.5l3.68,-1.51l2.84,-2.46l1.45,-2.55l0.04,-0.17l-0.2,-2.39l-0.04,-0.12l-1.7,-3.07l-2.9,-2.64l2.79,-3.66l0.05,-0.27l-1.08,-3.38l-0.8,-5.75l1.45,-0.75l4.18,1.03l2.6,0.38l0.18,-0.03l1.93,-0.95l2.18,1.23l3.01,2.18l0.73,1.42l0.25,0.16l4.18,0.27l-0.06,2.95l0.83,4.7l0.22,0.24l2.19,0.55l1.75,2.08l0.38,0.07l3.63,-2.03l0.11,-0.11l2.38,-4.06l1.36,-1.43l1.76,3.01l3.26,4.68l2.68,4.19l-0.94,2.09l0.12,0.38l3.31,1.98l2.23,1.98l0.13,0.07l3.94,0.89l1.48,1.02l0.96,2.82l0.22,0.2l1.85,0.43l0.88,1.13l0.17,3.53l-1.68,1.16l-1.76,1.14l-4.08,1.17l-0.11,0.06l-3.08,2.65l-4.11,0.52l-5.35,-0.69l-3.76,-0.02l-2.62,0.23l-0.2,0.1l-2.05,2.29l-3.13,1.41l-0.11,0.08l-3.6,4.24l-2.87,2.92l-0.05,0.36l0.33,0.14l2.13,-0.52l0.15,-0.08l3.98,-4.15l5.16,-2.63l3.58,-0.31l1.82,1.3l-2.09,1.91l-0.09,0.29l0.8,3.46l0.82,2.37l0.15,0.17l3.25,1.56l0.16,0.03l4.14,-0.45l0.21,-0.12l2.03,-2.86l0.11,1.46l0.13,0.22l1.26,0.88l-2.7,1.78l-5.51,1.83l-2.52,1.26l-2.75,2.16l-1.52,-0.18l-0.08,-2.16l4.19,-2.47l0.14,-0.34l-0.3,-0.22l-4.01,0.1l-2.66,0.36l-1.45,-1.56l0.0,-4.16l-0.11,-0.23l-1.11,-0.91l-0.28,-0.05l-1.5,0.48l-0.7,-0.7l-0.45,0.02l-1.91,2.39l-0.8,2.5l-0.82,1.31l-0.95,0.43l-0.77,0.15l-0.23,0.2l-0.18,0.56l-8.2,0.02l-0.13,0.03l-1.19,0.61l-2.95,2.45l-0.78,1.13l-4.6,0.01l-0.12,0.02l-1.13,0.48l-0.13,0.44l0.37,0.55l0.2,0.82l-0.01,0.09l-3.1,1.42l-2.63,0.5l-2.84,1.57l-0.47,0.0l-0.72,-0.4l-0.18,-0.27l0.03,-0.15l0.52,-1.0l1.2,-1.71l0.73,-1.8l0.02,-0.17l-1.03,-5.47l-0.15,-0.21l-2.35,-1.32l0.16,-0.29l-0.05,-0.35l-0.37,-0.38l-0.22,-0.09l-0.56,0.0l-0.35,-0.34l-0.11,-0.65l-0.46,-0.2l-0.39,0.26l-0.2,-0.03l-0.11,-0.33l-0.48,-0.25l-0.21,-0.71l-0.15,-0.18l-3.97,-2.07l-4.8,-2.39l-0.25,-0.01l-2.19,0.89l-0.72,0.03l-3.04,-0.82l-0.14,-0.0l-1.94,0.4l-2.4,-0.98l-2.56,-0.51l-1.7,-0.19l-0.62,-0.44l-0.42,-1.67l-0.3,-0.23l-0.85,0.02l-0.29,0.3l-0.01,0.95l-69.26,-0.01l-4.77,-3.14l-1.78,-1.41l-4.51,-1.38l-1.3,-2.73l0.34,-1.96l-0.17,-0.33l-3.06,-1.37l-0.41,-2.58l-0.11,-0.18l-2.92,-2.4l-0.05,-1.53l1.32,-1.59l0.07,-0.2l-0.07,-2.21l-0.16,-0.26l-4.19,-2.22l-2.52,-4.02l-1.56,-2.6l-0.08,-0.09l-2.28,-1.64l-1.65,-1.48l-1.31,-1.89l-0.38,-0.1l-2.51,1.21l-2.28,1.92l-2.03,-2.22l-1.85,-1.71l-2.44,-1.04l-2.28,-0.12l0.03,-37.72l4.27,0.98l4.0,2.13l2.61,0.4l0.24,-0.07l2.17,-1.81l2.92,-1.33l3.63,0.53l0.18,-0.03l3.72,-1.94l3.89,-1.06l1.6,1.72l0.37,0.06l1.87,-1.04l0.14,-0.19l0.48,-1.83l1.37,0.38l4.18,3.96l0.41,0.0l2.89,-2.62l0.28,2.79l0.37,0.26l3.08,-0.73l0.17,-0.12l0.85,-1.16l2.81,0.24l3.83,1.86l5.86,1.61l3.46,0.75l2.44,-0.26l2.89,1.89l-3.12,1.89l-0.14,0.31l0.24,0.24l4.53,0.92l6.84,-0.5l2.04,-0.71l2.54,2.44l0.39,0.02l2.72,-2.16l-0.01,-0.48l-2.26,-1.61l1.27,-1.16l2.94,-0.19l1.94,-0.42l1.89,0.97l2.49,2.32l0.24,0.08l2.71,-0.33l4.35,1.9l0.17,0.02l3.86,-0.67l3.62,0.1l0.31,-0.33l-0.26,-2.44l1.9,-0.65l3.58,1.36l-0.01,3.84l0.23,0.29l0.34,-0.17l1.51,-3.23l1.81,0.1l0.31,-0.22l1.13,-4.37l-0.08,-0.29l-2.68,-2.73l-2.83,-1.76l0.19,-4.73l2.77,-3.15l3.06,0.69l2.44,1.97l3.24,4.88l-2.05,2.02l0.15,0.51l4.41,0.85ZM265.85,150.7l-0.84,0.04l-3.15,-0.99l-1.77,-1.17l0.19,-0.06l3.17,0.79l2.39,1.27l0.01,0.12ZM249.41,3.71l6.68,0.49l5.34,0.79l4.34,1.6l-0.08,1.24l-5.91,2.56l-6.03,1.21l-2.36,1.38l-0.14,0.34l0.29,0.22l4.37,-0.02l-4.96,3.01l-4.06,1.64l-0.11,0.08l-4.21,4.62l-5.07,0.92l-0.12,0.05l-1.53,1.1l-7.5,0.59l-0.28,0.28l0.24,0.31l2.67,0.54l-1.04,0.6l-0.09,0.44l1.89,2.49l-2.11,1.66l-3.83,1.52l-0.15,0.13l-1.14,2.01l-3.41,1.55l-0.16,0.36l0.35,1.19l0.3,0.22l3.98,-0.19l0.03,0.78l-6.42,2.99l-6.44,-1.41l-7.41,0.79l-3.72,-0.62l-4.48,-0.26l-0.25,-2.0l4.37,-1.13l0.21,-0.38l-1.14,-3.55l1.13,-0.28l6.61,2.29l0.35,-0.12l-0.04,-0.37l-3.41,-3.45l-0.14,-0.08l-3.57,-0.92l1.62,-1.7l4.36,-1.3l0.2,-0.18l0.71,-1.94l-0.12,-0.36l-3.45,-2.15l-0.88,-2.43l6.36,0.23l1.94,0.61l0.23,-0.02l3.91,-2.1l0.15,-0.32l-0.26,-0.24l-5.69,-0.67l-8.69,0.37l-4.3,-1.92l-2.12,-2.39l-2.82,-1.68l-0.44,-1.65l3.41,-1.06l2.93,-0.2l4.91,-0.99l3.69,-2.28l2.93,0.31l2.64,1.68l0.42,-0.1l1.84,-3.23l3.17,-0.96l4.45,-0.69l7.56,-0.26l1.26,0.64l0.18,0.03l7.2,-1.06l10.81,0.8ZM203.94,57.59l0.01,0.32l1.97,2.97l0.51,-0.01l2.26,-3.75l6.05,-1.89l4.08,4.72l-0.36,2.95l0.38,0.33l4.95,-1.36l0.11,-0.05l2.23,-1.77l5.37,2.31l3.32,2.14l0.3,1.89l0.36,0.25l4.48,-1.01l2.49,2.8l0.14,0.09l5.99,1.78l2.09,1.74l2.18,3.83l-4.29,1.91l-0.01,0.54l5.9,2.83l3.95,0.94l3.54,3.84l0.2,0.1l3.58,0.25l-0.67,2.51l-4.18,4.54l-2.84,-1.61l-3.91,-3.95l-0.26,-0.09l-3.24,0.52l-0.25,0.26l-0.32,2.37l0.1,0.26l2.63,2.38l3.42,1.89l0.96,1.0l1.57,3.8l-0.74,2.43l-2.85,-0.96l-6.26,-3.15l-0.38,0.09l0.04,0.39l3.54,3.4l2.55,2.31l0.23,0.78l-6.26,-1.43l-5.33,-2.25l-2.73,-1.73l0.67,-0.86l-0.09,-0.45l-7.38,-4.01l-0.44,0.27l0.03,0.89l-6.85,0.61l-1.8,-1.17l1.43,-2.6l4.56,-0.07l5.15,-0.52l0.23,-0.45l-0.76,-1.34l0.8,-1.89l3.21,-4.06l0.05,-0.29l-0.72,-1.95l-0.97,-1.47l-0.11,-0.1l-3.84,-2.1l-4.53,-1.33l1.09,-0.75l0.05,-0.45l-2.65,-2.75l-0.18,-0.09l-2.12,-0.24l-1.91,-1.47l-0.39,0.02l-1.27,1.25l-4.4,0.56l-9.06,-0.99l-5.28,-1.31l-4.01,-0.67l-1.72,-1.31l2.32,-1.85l0.1,-0.33l-0.28,-0.2l-3.3,-0.02l-0.74,-4.36l1.86,-4.09l2.46,-1.88l5.74,-1.15l-1.5,2.55ZM261.28,159.28l0.19,0.14l1.82,0.42l1.66,-0.05l-0.66,0.68l-0.75,0.16l-3.0,-1.25l-0.46,-0.77l0.51,-0.52l0.68,1.19ZM230.87,84.48l-2.48,0.19l-0.52,-1.74l0.96,-2.17l2.03,-0.53l1.71,1.04l0.02,1.6l-0.22,0.46l-1.5,1.16ZM229.52,58.19l0.14,0.82l-4.99,-0.22l-2.73,0.63l-0.59,-0.23l-2.61,-2.4l0.08,-1.38l0.94,-0.25l5.61,0.51l4.14,2.54ZM222.12,105.0l-0.79,1.63l-0.75,-0.22l-0.52,-0.91l0.04,-0.09l0.84,-1.01l0.74,0.06l0.44,0.55ZM183.77,38.22l2.72,1.65l0.16,0.04l4.83,-0.01l1.92,1.52l-0.51,1.75l0.18,0.36l2.84,1.14l1.56,1.19l0.16,0.06l3.37,0.22l3.65,0.42l4.07,-1.1l5.05,-0.43l3.96,0.35l2.53,1.8l0.48,1.79l-1.37,1.16l-3.6,1.03l-3.22,-0.59l-7.17,0.76l-5.1,0.09l-4.0,-0.6l-6.48,-1.56l-0.81,-2.57l-0.3,-2.49l-0.1,-0.19l-2.51,-2.25l-0.16,-0.07l-5.12,-0.63l-2.61,-1.45l0.75,-1.71l4.88,0.32ZM207.46,91.26l0.42,1.62l0.42,0.19l1.12,-0.55l1.35,0.99l2.74,1.39l2.73,1.2l0.2,1.74l0.35,0.26l1.72,-0.29l1.31,0.97l-1.72,0.96l-3.68,-0.9l-1.34,-1.71l-0.43,-0.04l-2.46,2.1l-3.23,1.85l-0.74,-1.98l-0.31,-0.19l-2.47,0.28l1.49,-1.34l0.1,-0.19l0.32,-3.15l0.79,-3.45l1.34,0.25ZM215.59,102.66l-2.73,2.0l-1.49,-0.08l-0.37,-0.7l1.61,-1.56l3.0,0.03l-0.02,0.3ZM202.79,24.07l0.11,0.12l2.54,1.53l-3.01,1.47l-4.55,4.07l-4.3,0.38l-5.07,-0.68l-2.51,-2.09l0.03,-1.72l1.86,-1.4l0.1,-0.34l-0.29,-0.2l-4.49,0.04l-2.63,-1.79l-1.45,-2.36l1.61,-2.38l1.65,-1.69l2.47,-0.4l0.19,-0.48l-0.72,-0.89l5.1,-0.26l3.1,3.05l0.13,0.07l4.21,1.25l3.99,1.06l1.92,3.65ZM187.5,59.3l-0.15,0.1l-2.59,3.4l-2.5,-0.15l-1.47,-3.92l0.04,-2.24l1.22,-1.92l2.34,-1.26l5.11,0.17l4.28,1.06l-3.36,3.86l-2.9,0.9ZM186.19,48.8l-1.15,1.63l-3.42,-0.35l-2.68,-1.15l1.11,-1.88l3.34,-1.27l2.01,1.63l0.79,1.38ZM185.78,35.41l-0.95,0.13l-4.48,-0.33l-0.4,-0.91l4.5,0.07l1.45,0.82l-0.1,0.21ZM180.76,32.56l-3.43,1.03l-1.85,-1.14l-1.01,-1.92l-0.16,-1.87l2.87,0.2l1.39,0.35l2.75,1.75l-0.55,1.6ZM181.03,76.32l-1.21,1.2l-3.19,-1.26l-0.18,-0.01l-1.92,0.45l-2.88,-1.67l1.84,-1.16l1.6,-1.77l2.45,1.17l1.45,0.77l2.05,2.28ZM169.72,54.76l2.83,0.97l0.14,0.01l4.25,-0.58l0.47,1.01l-2.19,2.16l0.07,0.48l3.61,1.95l-0.41,3.84l-3.87,1.68l-2.23,-0.36l-1.73,-1.75l-6.07,-3.53l0.03,-1.01l4.79,0.55l0.3,-0.16l-0.04,-0.34l-2.55,-2.89l2.59,-2.05ZM174.44,40.56l1.49,1.87l0.07,2.48l-1.07,3.52l-3.87,0.48l-2.41,-0.72l0.05,-2.72l-0.33,-0.3l-3.79,0.36l-0.13,-3.31l2.36,0.14l0.15,-0.03l3.7,-1.74l3.44,0.29l0.31,-0.22l0.03,-0.12ZM170.14,31.5l0.75,1.74l-3.52,-0.52l-4.19,-1.77l-4.65,-0.17l1.65,-1.11l-0.05,-0.52l-2.86,-1.26l-0.13,-1.58l4.52,0.7l6.66,1.99l1.84,2.5ZM134.64,58.08l-1.08,1.93l0.34,0.44l5.44,-1.41l3.37,2.32l0.37,-0.02l2.66,-2.28l2.03,1.38l2.01,4.53l0.53,0.04l1.26,-1.93l0.03,-0.27l-1.67,-4.55l1.82,-0.58l2.36,0.73l2.69,1.84l1.53,4.46l0.77,3.24l0.15,0.19l4.22,2.26l4.32,2.04l-0.21,1.51l-3.87,0.34l-0.19,0.5l1.45,1.54l-0.65,1.23l-4.3,-0.65l-4.4,-1.19l-2.97,0.28l-4.67,1.48l-6.31,0.65l-4.27,0.39l-1.26,-1.91l-0.15,-0.12l-3.42,-1.2l-0.16,-0.01l-2.05,0.45l-2.66,-3.02l1.2,-0.34l3.82,-0.76l3.58,0.19l3.27,-0.78l0.23,-0.29l-0.24,-0.29l-4.84,-1.06l-5.42,0.35l-3.4,-0.09l-0.97,-1.22l5.39,-1.7l0.21,-0.33l-0.3,-0.25l-3.82,0.06l-3.95,-1.1l1.88,-3.13l1.68,-1.81l6.54,-2.84l2.11,0.77ZM158.85,56.58l-1.82,2.62l-3.38,-2.9l0.49,-0.39l3.17,-0.18l1.54,0.86ZM149.71,42.7l1.0,1.87l0.37,0.14l2.17,-0.83l2.33,0.2l0.38,2.16l-1.38,2.17l-8.33,0.76l-6.34,2.15l-3.51,0.1l-0.22,-1.13l4.98,-2.12l0.17,-0.34l-0.31,-0.23l-11.27,0.6l-3.04,-0.78l3.14,-4.57l2.2,-1.35l6.87,1.7l4.4,3.0l0.14,0.05l4.37,0.39l0.27,-0.48l-3.41,-4.68l1.96,-1.62l2.28,0.53l0.79,2.32ZM145.44,29.83l-2.18,0.77l-3.79,-0.0l0.02,-0.31l2.34,-1.5l1.2,0.23l2.42,0.83ZM144.83,34.5l-4.44,1.46l-3.18,-1.48l1.6,-1.36l3.51,-0.53l3.1,0.75l-0.6,1.16ZM119.02,65.87l-6.17,2.07l-1.19,-1.82l-0.13,-0.11l-5.48,-2.32l0.92,-1.7l1.73,-3.44l2.16,-3.15l-0.02,-0.36l-2.09,-2.56l7.84,-0.71l3.59,1.02l6.32,0.27l2.35,1.37l2.25,1.71l-2.68,1.04l-6.21,3.41l-3.1,3.28l-0.08,0.21l0.0,1.81ZM129.66,35.4l-0.3,3.55l-1.77,1.67l-2.34,0.27l-4.62,2.2l-3.89,0.76l-2.83,-0.93l3.85,-3.52l5.04,-3.36l3.75,0.07l3.11,-0.7ZM111.24,152.74l-0.82,0.29l-3.92,-1.39l-0.7,-1.06l-0.12,-0.1l-2.15,-1.09l-0.41,-0.84l-0.2,-0.16l-2.44,-0.56l-0.84,-1.56l0.1,-0.36l2.34,0.64l1.53,0.5l2.28,0.34l0.78,1.04l1.24,1.55l0.09,0.08l2.42,1.3l0.81,1.39ZM88.54,134.82l0.14,0.02l2.0,-0.23l-0.67,3.48l0.06,0.24l1.78,2.22l-0.24,-0.0l-1.4,-1.42l-0.91,-1.53l-1.26,-1.08l-0.42,-1.35l0.09,-0.66l0.82,0.31Z", "name": "Canada"}, "CG": {"path": "M453.66,296.61l-0.9,-0.82l-0.35,-0.04l-0.83,0.48l-0.77,0.83l-1.65,-2.13l1.66,-1.2l0.08,-0.39l-0.81,-1.43l0.59,-0.43l1.62,-0.29l0.24,-0.24l0.1,-0.58l0.94,0.84l0.19,0.08l2.21,0.11l0.27,-0.14l0.81,-1.29l0.32,-1.76l-0.27,-1.96l-0.06,-0.15l-1.08,-1.35l1.02,-2.74l-0.09,-0.34l-0.62,-0.5l-0.22,-0.06l-1.66,0.18l-0.55,-1.03l0.12,-0.73l2.85,0.09l1.98,0.65l2.0,0.59l0.38,-0.25l0.17,-1.3l1.26,-2.24l1.34,-1.19l1.54,0.38l1.35,0.12l-0.11,1.15l-0.74,1.34l-0.5,1.61l-0.31,2.22l0.12,1.41l-0.4,0.9l-0.06,0.88l-0.24,0.67l-1.57,1.15l-1.24,1.41l-1.09,2.43l-0.03,0.13l0.08,1.95l-0.55,0.69l-1.46,1.23l-1.32,1.41l-0.61,-0.29l-0.13,-0.57l-0.29,-0.23l-1.36,-0.02l-0.23,0.1l-0.72,0.81l-0.41,-0.16Z", "name": "Republic of the Congo"}, "CF": {"path": "M459.41,266.56l1.9,-0.17l0.22,-0.12l0.36,-0.5l0.14,0.02l0.55,0.51l0.29,0.07l3.15,-0.96l0.12,-0.07l1.05,-0.97l1.29,-0.87l0.12,-0.33l-0.17,-0.61l0.38,-0.12l2.36,0.15l0.15,-0.03l2.36,-1.17l0.12,-0.1l1.78,-2.72l1.18,-0.96l1.23,-0.34l0.21,0.79l0.07,0.13l1.37,1.5l0.01,0.86l-0.39,1.0l-0.01,0.17l0.16,0.78l0.1,0.17l0.91,0.76l1.89,1.09l1.24,0.92l0.02,0.67l0.12,0.23l1.67,1.3l0.99,1.03l0.61,1.46l0.14,0.15l1.79,0.95l0.2,0.4l-0.44,0.14l-1.54,-0.06l-1.98,-0.26l-0.93,0.22l-0.19,0.14l-0.3,0.48l-0.57,0.05l-0.91,-0.49l-0.26,-0.01l-2.7,1.21l-1.04,-0.23l-0.21,0.03l-0.34,0.19l-0.12,0.13l-0.64,1.3l-1.67,-0.43l-1.77,-0.24l-1.58,-0.91l-2.06,-0.85l-0.27,0.02l-1.42,0.88l-0.97,1.27l-0.06,0.14l-0.19,1.46l-1.3,-0.11l-1.67,-0.42l-0.27,0.07l-1.55,1.41l-0.99,1.76l-0.14,-1.18l-0.13,-0.22l-1.1,-0.78l-0.86,-1.2l-0.2,-0.84l-0.07,-0.13l-1.07,-1.19l0.16,-0.59l0.0,-0.15l-0.24,-1.01l0.18,-1.77l0.5,-0.38l0.09,-0.11l1.18,-2.4Z", "name": "Central African Republic"}, "CD": {"path": "M497.85,276.25l-0.14,2.77l0.2,0.3l0.57,0.19l-0.47,0.52l-1.0,0.71l-0.96,1.31l-0.56,1.22l-0.16,2.04l-0.54,0.89l-0.04,0.15l-0.02,1.76l-0.63,0.61l-0.09,0.2l-0.08,1.33l-0.2,0.11l-0.15,0.21l-0.23,1.37l0.03,0.2l0.6,1.08l0.16,2.96l0.44,2.29l-0.24,1.25l0.01,0.15l0.5,1.46l0.07,0.12l1.41,1.37l1.09,2.56l-0.51,-0.11l-3.45,0.45l-0.67,0.3l-0.15,0.15l-0.71,1.61l0.01,0.26l0.52,1.03l-0.43,2.9l-0.31,2.55l0.13,0.29l0.7,0.46l1.75,0.99l0.31,-0.01l0.26,-0.17l0.15,1.9l-1.44,-0.02l-0.94,-1.28l-0.94,-1.1l-0.17,-0.1l-1.76,-0.33l-0.5,-1.18l-0.42,-0.15l-1.44,0.75l-1.79,-0.32l-0.77,-1.05l-0.2,-0.12l-1.59,-0.23l-0.97,0.04l-0.1,-0.53l-0.27,-0.25l-0.86,-0.06l-1.13,-0.15l-1.62,0.37l-1.04,-0.06l-0.32,0.09l0.11,-2.56l-0.08,-0.21l-0.77,-0.87l-0.17,-1.41l0.36,-1.47l-0.03,-0.21l-0.48,-0.91l-0.04,-1.52l-0.3,-0.29l-2.65,0.02l0.13,-0.53l-0.29,-0.37l-1.28,0.01l-0.28,0.21l-0.07,0.24l-1.35,0.09l-0.26,0.18l-0.62,1.45l-0.25,0.42l-1.17,-0.3l-0.19,0.01l-0.79,0.34l-1.44,0.18l-1.41,-1.96l-0.7,-1.47l-0.61,-1.86l-0.28,-0.21l-7.39,-0.03l-0.92,0.3l-0.78,-0.03l-0.78,0.25l-0.11,-0.25l0.35,-0.15l0.18,-0.26l0.07,-1.02l0.33,-0.52l0.72,-0.42l0.52,0.2l0.33,-0.08l0.76,-0.86l0.99,0.02l0.11,0.48l0.16,0.2l0.94,0.44l0.35,-0.07l1.46,-1.56l1.44,-1.21l0.68,-0.85l0.06,-0.2l-0.08,-1.99l1.04,-2.33l1.1,-1.23l1.62,-1.19l0.11,-0.14l0.29,-0.8l0.08,-0.94l0.38,-0.82l0.03,-0.16l-0.13,-1.38l0.3,-2.16l0.47,-1.51l0.73,-1.31l0.04,-0.12l0.15,-1.51l0.21,-1.66l0.89,-1.16l1.16,-0.7l1.9,0.79l1.69,0.95l1.81,0.24l1.85,0.48l0.35,-0.16l0.71,-1.43l0.16,-0.09l1.03,0.23l0.19,-0.02l2.65,-1.19l0.86,0.46l0.17,0.03l0.81,-0.08l0.23,-0.14l0.31,-0.5l0.75,-0.17l1.83,0.26l1.64,0.06l0.72,-0.21l1.39,1.9l0.16,0.11l1.12,0.3l0.24,-0.04l0.58,-0.36l1.05,0.15l0.15,-0.02l1.15,-0.44l0.47,0.84l0.08,0.09l2.08,1.57Z", "name": "Democratic Republic of the Congo"}, "CZ": {"path": "M463.29,152.22l-0.88,-0.47l-0.18,-0.03l-1.08,0.15l-1.86,-0.94l-0.21,-0.02l-0.88,0.24l-0.13,0.07l-1.25,1.17l-1.63,-0.91l-1.38,-1.36l-1.22,-0.75l-0.24,-1.24l-0.33,-0.75l1.53,-0.6l0.98,-0.84l1.74,-0.62l0.11,-0.07l0.47,-0.47l0.46,0.27l0.24,0.03l0.96,-0.3l1.06,0.95l0.15,0.07l1.57,0.24l-0.1,0.6l0.16,0.32l1.36,0.68l0.41,-0.15l0.28,-0.62l1.29,0.28l0.19,0.84l0.26,0.23l1.73,0.18l0.74,1.02l-0.17,0.0l-0.25,0.13l-0.32,0.49l-0.46,0.11l-0.22,0.23l-0.13,0.57l-0.32,0.1l-0.2,0.22l-0.03,0.14l-0.65,0.25l-1.05,-0.05l-0.28,0.17l-0.22,0.43Z", "name": "Czech Republic"}, "CY": {"path": "M505.03,193.75l-1.51,0.68l-1.0,-0.3l-0.32,-0.63l0.69,-0.06l0.41,0.13l0.19,-0.0l0.62,-0.22l0.31,0.02l0.06,0.22l0.49,0.17l0.06,-0.01Z", "name": "Cyprus"}, "CR": {"path": "M213.0,263.84l-0.98,-0.4l-0.3,-0.31l0.16,-0.24l0.05,-0.21l-0.09,-0.56l-0.1,-0.18l-0.76,-0.65l-0.99,-0.5l-0.74,-0.28l-0.13,-0.58l-0.12,-0.18l-0.66,-0.45l-0.34,-0.0l-0.13,0.31l0.13,0.59l-0.17,0.21l-0.34,-0.42l-0.14,-0.1l-0.7,-0.22l-0.23,-0.34l0.01,-0.62l0.31,-0.74l-0.14,-0.38l-0.3,-0.15l0.47,-0.4l1.48,0.6l0.26,-0.02l0.47,-0.27l0.58,0.15l0.35,0.44l0.17,0.11l0.74,0.17l0.27,-0.07l0.3,-0.27l0.52,1.09l0.97,1.02l0.77,0.71l-0.41,0.1l-0.23,0.3l0.01,1.02l0.12,0.24l0.2,0.14l-0.07,0.05l-0.11,0.3l0.08,0.37l-0.23,0.63Z", "name": "Costa Rica"}, "CU": {"path": "M215.01,226.09l2.08,0.18l1.94,0.03l2.24,0.86l0.95,0.92l0.25,0.08l2.22,-0.28l0.79,0.55l3.68,2.81l0.19,0.06l0.77,-0.03l1.18,0.42l-0.12,0.47l0.27,0.37l1.78,0.1l1.59,0.9l-0.11,0.22l-1.5,0.3l-1.64,0.13l-1.75,-0.2l-2.69,0.19l1.0,-0.86l-0.03,-0.48l-1.02,-0.68l-0.13,-0.05l-1.52,-0.16l-0.74,-0.64l-0.57,-1.42l-0.3,-0.19l-1.36,0.1l-2.23,-0.67l-0.71,-0.52l-0.14,-0.06l-3.2,-0.4l-0.42,-0.25l0.56,-0.39l0.12,-0.33l-0.27,-0.22l-2.46,-0.13l-0.2,0.06l-1.72,1.31l-0.94,0.03l-0.25,0.15l-0.29,0.53l-1.04,0.24l-0.29,-0.07l0.7,-0.43l0.1,-0.11l0.5,-0.87l1.04,-0.54l1.23,-0.49l1.86,-0.25l0.62,-0.28Z", "name": "Cuba"}, "SZ": {"path": "M500.95,353.41l-0.41,0.97l-1.16,0.23l-1.29,-1.26l-0.02,-0.71l0.63,-0.93l0.23,-0.7l0.47,-0.12l1.04,0.4l0.32,1.05l0.2,1.08Z", "name": "Swaziland"}, "SY": {"path": "M510.84,199.83l0.09,-0.11l0.07,-0.2l-0.04,-1.08l0.56,-1.4l1.3,-1.01l0.1,-0.34l-0.41,-1.11l-0.24,-0.19l-0.89,-0.11l-0.2,-1.84l0.55,-1.05l1.3,-1.22l0.09,-0.19l0.09,-1.09l0.39,0.27l0.25,0.04l2.66,-0.77l1.35,0.52l2.06,-0.01l2.93,-1.08l1.35,0.04l2.14,-0.34l-0.83,1.16l-1.31,0.68l-0.16,0.3l0.23,2.03l-0.9,3.25l-5.43,2.87l-4.79,2.91l-2.32,-0.92Z", "name": "Syria"}, "KG": {"path": "M599.04,172.15l0.38,-0.9l1.43,-0.37l4.04,1.02l0.37,-0.23l0.36,-1.64l1.17,-0.52l3.45,1.24l0.2,-0.0l0.86,-0.31l4.09,0.08l3.61,0.31l1.18,1.02l0.11,0.06l1.19,0.34l-0.13,0.26l-3.84,1.58l-0.13,0.1l-0.81,1.08l-3.08,0.34l-0.24,0.16l-0.85,1.7l-2.43,-0.37l-0.14,0.01l-1.79,0.61l-2.39,1.4l-0.12,0.39l0.25,0.49l-0.48,0.45l-4.57,0.43l-3.04,-0.94l-2.45,0.18l0.14,-1.02l2.42,0.44l0.27,-0.08l0.81,-0.81l1.76,0.27l0.21,-0.05l3.21,-2.14l-0.03,-0.51l-2.97,-1.57l-0.26,-0.01l-1.64,0.69l-1.38,-0.84l1.81,-1.67l-0.09,-0.5l-0.46,-0.18Z", "name": "Kyrgyzstan"}, "KE": {"path": "M523.3,287.04l0.06,0.17l1.29,1.8l-1.46,0.84l-0.11,0.11l-0.55,0.93l-0.81,0.16l-0.24,0.24l-0.34,1.69l-0.81,1.06l-0.46,1.58l-0.76,0.63l-3.3,-2.3l-0.16,-1.32l-0.15,-0.23l-9.35,-5.28l-0.02,-2.4l1.92,-2.63l0.91,-1.83l0.01,-0.24l-1.09,-2.86l-0.29,-1.24l-1.09,-1.63l2.93,-2.85l0.92,0.3l0.0,1.19l0.09,0.22l0.86,0.83l0.21,0.08l1.65,0.0l3.09,2.08l0.16,0.05l0.79,0.03l0.54,-0.06l0.58,0.28l1.67,0.2l0.28,-0.12l0.69,-0.98l2.04,-0.94l0.86,0.73l0.19,0.07l1.1,0.0l-1.82,2.36l-0.06,0.18l0.03,9.12Z", "name": "Kenya"}, "SS": {"path": "M505.7,261.39l0.02,1.64l-0.27,0.55l-1.15,0.05l-0.24,0.15l-0.85,1.44l0.22,0.45l1.44,0.17l1.15,1.12l0.42,0.95l0.14,0.15l1.06,0.54l1.33,2.45l-3.06,2.98l-1.44,1.08l-1.75,0.01l-1.92,0.56l-1.5,-0.53l-0.27,0.03l-0.85,0.57l-1.98,-1.5l-0.56,-1.02l-0.37,-0.13l-1.32,0.5l-1.08,-0.15l-0.2,0.04l-0.56,0.35l-0.9,-0.24l-1.44,-1.97l-0.39,-0.77l-0.13,-0.13l-1.78,-0.94l-0.65,-1.5l-1.08,-1.12l-1.57,-1.22l-0.02,-0.68l-0.12,-0.23l-1.37,-1.02l-1.17,-0.68l0.2,-0.08l0.86,-0.48l0.14,-0.18l0.63,-2.22l0.6,-1.02l1.47,-0.28l0.35,0.56l1.29,1.48l0.14,0.09l0.69,0.22l0.22,-0.02l0.83,-0.4l1.58,0.08l0.26,0.39l0.25,0.13l2.49,0.0l0.3,-0.25l0.06,-0.35l1.13,-0.42l0.18,-0.18l0.22,-0.63l0.68,-0.38l1.95,1.37l0.23,0.05l1.29,-0.26l0.19,-0.12l1.23,-1.8l1.36,-1.37l0.08,-0.25l-0.21,-1.52l-0.06,-0.15l-0.25,-0.3l0.94,-0.08l0.26,-0.21l0.1,-0.32l0.6,0.09l-0.25,1.67l0.3,1.83l0.11,0.19l1.22,0.94l0.25,0.73l-0.04,1.2l0.26,0.31l0.09,0.01Z", "name": "South Sudan"}, "SR": {"path": "M278.1,270.26l2.71,0.45l0.31,-0.14l0.19,-0.32l1.82,-0.16l2.25,0.56l-1.09,1.81l-0.04,0.19l0.2,1.72l0.05,0.13l0.9,1.35l-0.39,0.99l-0.21,1.09l-0.48,0.8l-1.2,-0.44l-0.17,-0.01l-1.12,0.24l-0.95,-0.21l-0.35,0.2l-0.25,0.73l0.05,0.29l0.3,0.35l-0.06,0.13l-1.01,-0.15l-1.42,-2.03l-0.32,-1.36l-0.29,-0.23l-0.63,-0.0l-0.95,-1.56l0.41,-1.16l0.01,-0.17l-0.08,-0.35l1.29,-0.56l0.18,-0.22l0.35,-1.97Z", "name": "Suriname"}, "KH": {"path": "M680.28,257.89l-0.93,-1.2l-1.24,-2.56l-0.56,-2.9l1.45,-1.92l3.07,-0.46l2.26,0.35l2.03,0.98l0.38,-0.11l1.0,-1.55l1.86,0.79l0.52,1.51l-0.28,2.82l-4.05,1.88l-0.12,0.45l0.79,1.1l-2.2,0.17l-2.08,0.98l-1.89,-0.33Z", "name": "Cambodia"}, "SV": {"path": "M197.02,248.89l0.18,-0.05l0.59,0.17l0.55,0.51l0.64,0.35l0.06,0.22l0.37,0.21l1.01,-0.28l0.38,0.13l0.16,0.13l-0.14,0.81l-0.18,0.38l-1.22,-0.03l-0.84,-0.23l-1.11,-0.52l-1.31,-0.15l-0.49,-0.38l0.02,-0.08l0.76,-0.57l0.46,-0.27l0.11,-0.35Z", "name": "El Salvador"}, "SK": {"path": "M468.01,150.02l0.05,0.07l0.36,0.1l0.85,-0.37l1.12,1.02l0.33,0.05l1.38,-0.65l1.07,0.3l0.16,0.0l1.69,-0.43l1.95,1.02l-0.51,0.64l-0.45,1.2l-0.32,0.2l-2.55,-0.93l-0.17,-0.01l-0.82,0.2l-0.17,0.11l-0.53,0.68l-0.94,0.32l-0.14,-0.11l-0.29,-0.04l-1.18,0.48l-0.95,0.09l-0.26,0.21l-0.15,0.47l-1.84,0.34l-0.82,-0.31l-1.14,-0.73l-0.2,-0.89l0.42,-0.84l0.91,0.05l0.12,-0.02l0.86,-0.33l0.18,-0.21l0.03,-0.13l0.32,-0.1l0.2,-0.22l0.12,-0.55l0.39,-0.1l0.18,-0.13l0.3,-0.45l0.43,-0.0Z", "name": "Slovakia"}, "KR": {"path": "M737.31,185.72l0.84,0.08l0.27,-0.12l0.89,-1.2l1.63,-0.13l1.1,-0.2l0.21,-0.16l0.12,-0.24l1.86,2.95l0.59,1.79l0.02,3.17l-0.84,1.38l-2.23,0.55l-1.95,1.14l-1.91,0.21l-0.22,-1.21l0.45,-2.07l-0.01,-0.17l-0.99,-2.67l1.54,-0.4l0.17,-0.46l-1.55,-2.24Z", "name": "South Korea"}, "SI": {"path": "M455.77,159.59l1.79,0.21l0.18,-0.04l1.2,-0.68l2.12,-0.08l0.21,-0.1l0.38,-0.42l0.1,0.01l0.28,0.62l-1.71,0.71l-0.18,0.22l-0.21,1.1l-0.71,0.26l-0.2,0.28l0.01,0.55l-0.59,-0.04l-0.79,-0.47l-0.38,0.06l-0.36,0.41l-0.84,-0.05l0.05,-0.15l-0.56,-1.24l0.21,-1.17Z", "name": "Slovenia"}, "KP": {"path": "M747.76,172.02l-0.23,-0.04l-0.26,0.08l-1.09,1.02l-0.78,1.06l-0.06,0.19l0.09,1.95l-1.12,0.57l-0.53,0.58l-0.88,0.82l-1.69,0.51l-1.09,0.79l-0.12,0.22l-0.07,1.17l-0.22,0.25l0.09,0.47l0.96,0.46l1.22,1.1l-0.19,0.37l-0.91,0.16l-1.75,0.14l-0.22,0.12l-0.87,1.18l-0.95,-0.09l-0.3,0.18l-0.97,-0.44l-0.39,0.13l-0.25,0.44l-0.29,0.09l-0.03,-0.2l-0.18,-0.23l-0.62,-0.25l-0.43,-0.29l0.52,-0.97l0.52,-0.3l0.13,-0.38l-0.18,-0.42l0.59,-1.47l0.01,-0.21l-0.16,-0.48l-0.22,-0.2l-1.41,-0.31l-0.82,-0.55l1.74,-1.62l2.73,-1.58l1.62,-1.96l0.96,0.76l0.17,0.06l2.17,0.11l0.31,-0.37l-0.32,-1.31l3.61,-1.21l0.16,-0.13l0.79,-1.34l1.25,1.38Z", "name": "North Korea"}, "SO": {"path": "M543.8,256.48l0.61,-0.05l1.14,-0.37l1.31,-0.25l0.12,-0.05l1.11,-0.81l0.57,-0.0l0.03,0.39l-0.23,1.49l0.01,1.25l-0.52,0.92l-0.7,2.71l-1.19,2.79l-1.54,3.2l-2.13,3.66l-2.12,2.79l-2.92,3.39l-2.47,2.0l-3.76,2.5l-2.33,1.9l-2.77,3.06l-0.61,1.35l-0.28,0.29l-1.22,-1.69l-0.03,-8.92l2.12,-2.76l0.59,-0.68l1.47,-0.04l0.18,-0.06l2.15,-1.71l3.16,-0.11l0.21,-0.09l7.08,-7.55l1.76,-2.12l1.14,-1.57l0.06,-0.18l0.01,-4.67Z", "name": "Somalia"}, "SN": {"path": "M379.28,250.34l-0.95,-1.82l-0.09,-0.1l-0.83,-0.6l0.62,-0.28l0.13,-0.11l1.21,-1.8l0.6,-1.31l0.71,-0.68l1.09,0.2l0.18,-0.02l1.17,-0.53l1.25,-0.03l1.17,0.73l1.59,0.65l1.47,1.83l1.59,1.7l0.12,1.56l0.49,1.46l0.1,0.14l0.85,0.65l0.18,0.82l-0.08,0.57l-0.13,0.05l-1.29,-0.19l-0.29,0.13l-0.11,0.16l-0.35,0.04l-1.83,-0.61l-5.84,-0.13l-0.12,0.02l-0.6,0.26l-0.87,-0.06l-1.01,0.32l-0.26,-1.26l1.9,0.04l0.16,-0.04l0.54,-0.32l0.37,-0.02l0.15,-0.05l0.78,-0.5l0.92,0.46l0.12,0.03l1.09,0.04l0.15,-0.03l1.08,-0.57l0.11,-0.44l-0.51,-0.74l-0.39,-0.1l-0.76,0.39l-0.62,-0.01l-0.92,-0.58l-0.18,-0.05l-0.79,0.04l-0.2,0.09l-0.48,0.51l-2.41,0.06Z", "name": "Senegal"}, "SL": {"path": "M392.19,267.53l-0.44,-0.12l-1.73,-0.97l-1.24,-1.28l-0.4,-0.84l-0.27,-1.65l1.21,-1.0l0.09,-0.12l0.27,-0.66l0.32,-0.41l0.56,-0.05l0.16,-0.07l0.5,-0.41l1.75,0.0l0.59,0.77l0.49,0.96l-0.07,0.64l0.04,0.19l0.36,0.58l-0.03,0.84l0.24,0.2l-0.64,0.65l-1.13,1.37l-0.06,0.14l-0.12,0.66l-0.43,0.58Z", "name": "Sierra Leone"}, "SB": {"path": "M826.74,311.51l0.23,0.29l-0.95,-0.01l-0.39,-0.63l0.65,0.27l0.45,0.09ZM825.01,308.52l-1.18,-1.39l-0.37,-1.06l0.24,0.0l0.82,1.84l0.49,0.6ZM823.21,309.42l-0.44,0.03l-1.43,-0.24l-0.32,-0.24l0.08,-0.5l1.29,0.31l0.72,0.47l0.11,0.18ZM817.9,303.81l2.59,1.44l0.3,0.41l-1.21,-0.66l-1.34,-0.89l-0.34,-0.3ZM813.77,302.4l0.48,0.34l0.1,0.08l-0.33,-0.17l-0.25,-0.25Z", "name": "Solomon Islands"}, "SA": {"path": "M528.24,243.1l-0.2,-0.69l-0.07,-0.12l-0.69,-0.71l-0.18,-0.94l-0.12,-0.19l-1.24,-0.89l-1.28,-2.09l-0.7,-2.08l-0.07,-0.11l-1.73,-1.79l-0.11,-0.07l-1.03,-0.39l-1.57,-2.36l-0.27,-1.72l0.1,-1.53l-0.03,-0.15l-1.44,-2.93l-1.25,-1.13l-1.34,-0.56l-0.72,-1.33l0.11,-0.49l-0.02,-0.2l-0.7,-1.38l-0.08,-0.1l-0.68,-0.56l-0.97,-1.98l-2.8,-4.03l-0.25,-0.13l-0.85,0.01l0.29,-1.11l0.12,-0.97l0.23,-0.81l2.52,0.39l0.23,-0.06l1.08,-0.84l0.6,-0.95l1.78,-0.35l0.22,-0.17l0.37,-0.83l0.74,-0.42l0.08,-0.46l-2.17,-2.4l4.55,-1.26l0.12,-0.06l0.36,-0.32l2.83,0.71l3.67,1.91l7.04,5.5l0.17,0.06l4.64,0.22l2.06,0.24l0.55,1.15l0.28,0.17l1.56,-0.06l0.9,2.15l0.14,0.15l1.14,0.57l0.39,0.85l0.11,0.13l1.59,1.06l0.12,0.91l-0.23,0.83l0.01,0.18l0.32,0.9l0.07,0.11l0.68,0.7l0.33,0.86l0.37,0.65l0.09,0.1l0.76,0.53l0.25,0.04l0.45,-0.12l0.35,0.75l0.1,0.63l0.96,2.68l0.23,0.19l7.53,1.33l0.27,-0.09l0.24,-0.26l0.87,1.41l-1.58,4.96l-7.34,2.54l-7.28,1.02l-2.34,1.17l-0.12,0.1l-1.74,2.63l-0.86,0.32l-0.49,-0.68l-0.28,-0.12l-0.92,0.12l-2.32,-0.25l-0.41,-0.23l-0.15,-0.04l-2.89,0.06l-0.63,0.2l-0.91,-0.59l-0.43,0.11l-0.66,1.27l-0.03,0.21l0.21,0.89l-0.6,0.45Z", "name": "Saudi Arabia"}, "SE": {"path": "M476.42,90.44l-0.15,0.1l-2.43,2.86l-0.07,0.24l0.36,2.31l-3.84,3.1l-4.83,3.38l-0.11,0.15l-1.82,5.45l0.03,0.26l1.78,2.68l2.27,1.99l-2.13,3.88l-2.49,0.82l-0.2,0.24l-0.95,6.05l-1.32,3.09l-2.82,-0.32l-0.3,0.16l-1.34,2.64l-2.48,0.14l-0.76,-3.15l-2.09,-4.04l-1.85,-5.01l1.03,-1.98l2.06,-2.53l0.06,-0.13l0.83,-4.45l-0.06,-0.25l-1.54,-1.86l-0.15,-5.0l1.52,-3.48l2.28,0.06l0.27,-0.16l0.87,-1.59l-0.01,-0.31l-0.8,-1.21l3.79,-5.63l4.07,-7.54l2.23,0.01l0.29,-0.22l0.59,-2.15l4.46,0.66l0.34,-0.26l0.34,-2.64l1.21,-0.14l3.24,2.08l3.78,2.85l0.06,6.37l0.03,0.14l0.67,1.29l-3.95,1.07Z", "name": "Sweden"}, "SD": {"path": "M505.98,259.75l-0.31,-0.9l-0.1,-0.14l-1.2,-0.93l-0.27,-1.66l0.29,-1.83l-0.25,-0.34l-1.16,-0.17l-0.33,0.21l-0.11,0.37l-1.3,0.11l-0.21,0.49l0.55,0.68l0.18,1.29l-1.31,1.33l-1.18,1.72l-1.04,0.21l-2.0,-1.4l-0.32,-0.02l-0.95,0.52l-0.14,0.16l-0.21,0.6l-1.16,0.43l-0.19,0.23l-0.04,0.27l-2.08,0.0l-0.25,-0.39l-0.24,-0.13l-1.81,-0.09l-0.14,0.03l-0.8,0.38l-0.49,-0.16l-1.22,-1.39l-0.42,-0.67l-0.31,-0.14l-1.81,0.35l-0.2,0.14l-0.72,1.24l-0.61,2.14l-0.73,0.4l-0.62,0.22l-0.83,-0.68l-0.12,-0.6l0.38,-0.97l0.01,-1.14l-0.08,-0.2l-1.39,-1.53l-0.25,-0.97l0.03,-0.57l-0.11,-0.25l-0.81,-0.66l-0.03,-1.34l-0.04,-0.14l-0.52,-0.98l-0.31,-0.15l-0.42,0.07l0.12,-0.44l0.63,-1.03l0.03,-0.23l-0.24,-0.88l0.69,-0.66l0.02,-0.41l-0.4,-0.46l0.58,-1.39l1.04,-1.71l1.97,0.16l0.32,-0.3l-0.12,-10.24l0.02,-0.8l2.59,-0.01l0.3,-0.3l0.0,-4.92l29.19,0.0l0.68,2.17l-0.4,0.35l-0.1,0.27l0.36,2.69l0.93,3.15l0.12,0.16l2.05,1.4l-0.99,1.15l-1.75,0.4l-0.15,0.08l-0.79,0.79l-0.08,0.17l-0.24,1.69l-1.07,3.75l-0.0,0.16l0.25,0.96l-0.38,2.1l-0.98,2.41l-1.52,1.3l-1.07,1.94l-0.25,0.99l-1.08,0.64l-0.13,0.18l-0.46,1.65Z", "name": "Sudan"}, "DO": {"path": "M241.7,234.97l0.15,-0.22l1.73,0.01l1.43,0.64l0.15,0.03l0.45,-0.04l0.36,0.74l0.28,0.17l1.02,-0.04l-0.04,0.43l0.27,0.33l1.03,0.09l0.91,0.7l-0.57,0.64l-0.99,-0.47l-0.16,-0.03l-1.11,0.11l-0.79,-0.12l-0.26,0.09l-0.38,0.4l-0.66,0.11l-0.28,-0.45l-0.38,-0.12l-0.83,0.37l-0.14,0.13l-0.85,1.49l-0.27,-0.17l-0.1,-0.58l0.05,-0.67l-0.07,-0.21l-0.44,-0.53l0.35,-0.25l0.12,-0.19l0.19,-1.0l-0.2,-1.4Z", "name": "Dominican Republic"}, "DJ": {"path": "M528.78,253.36l0.34,0.45l-0.06,0.76l-1.26,0.54l-0.05,0.53l0.82,0.53l-0.57,0.83l-0.3,-0.25l-0.27,-0.05l-0.56,0.17l-1.07,-0.03l-0.04,-0.56l-0.16,-0.56l0.76,-1.07l0.76,-0.97l0.89,0.18l0.25,-0.06l0.51,-0.42Z", "name": "Djibouti"}, "DK": {"path": "M452.4,129.07l-1.27,2.39l-2.25,-1.69l-0.26,-1.08l3.15,-1.0l0.63,1.39ZM447.87,126.25l-0.35,0.76l-0.47,-0.24l-0.38,0.09l-1.8,2.53l-0.03,0.29l0.56,1.4l-1.22,0.4l-1.68,-0.41l-0.92,-1.76l-0.07,-3.47l0.38,-0.88l0.62,-0.93l2.07,-0.21l0.19,-0.1l0.84,-0.95l1.5,-0.76l-0.06,1.26l-0.7,1.1l-0.03,0.25l0.3,1.0l0.18,0.19l1.06,0.42Z", "name": "Denmark"}, "DE": {"path": "M445.51,131.69l0.03,0.94l0.21,0.28l2.32,0.74l-0.02,1.0l0.37,0.3l2.55,-0.65l1.36,-0.89l2.63,1.27l1.09,1.01l0.51,1.51l-0.6,0.78l-0.0,0.36l0.88,1.17l0.58,1.68l-0.18,1.08l0.03,0.18l0.87,1.81l-0.66,0.2l-0.55,-0.32l-0.36,0.05l-0.58,0.58l-1.73,0.62l-0.99,0.84l-1.77,0.7l-0.16,0.4l0.42,0.94l0.26,1.34l0.14,0.2l1.25,0.76l1.22,1.2l-0.71,1.2l-0.81,0.37l-0.17,0.32l0.34,1.99l-0.04,0.09l-0.47,-0.39l-0.17,-0.07l-1.2,-0.1l-1.85,0.57l-2.15,-0.13l-0.29,0.18l-0.21,0.5l-0.96,-0.67l-0.24,-0.05l-0.67,0.16l-2.6,-0.94l-0.34,0.1l-0.42,0.57l-1.64,-0.02l0.26,-1.88l1.24,-2.15l-0.21,-0.45l-3.54,-0.58l-0.98,-0.71l0.12,-1.26l-0.05,-0.2l-0.44,-0.64l0.27,-2.18l-0.38,-3.14l1.17,-0.0l0.27,-0.17l0.63,-1.26l0.65,-3.17l-0.02,-0.17l-0.41,-1.0l0.32,-0.47l1.77,-0.16l0.37,0.6l0.47,0.06l1.7,-1.69l0.06,-0.33l-0.55,-1.24l-0.09,-1.51l1.5,0.36l0.16,-0.01l1.22,-0.4Z", "name": "Germany"}, "YE": {"path": "M553.53,242.65l-1.51,0.58l-0.17,0.16l-0.48,1.14l-0.07,0.79l-2.31,1.0l-3.98,1.19l-2.28,1.8l-0.97,0.12l-0.7,-0.14l-0.23,0.05l-1.42,1.03l-1.51,0.47l-2.07,0.13l-0.68,0.15l-0.17,0.1l-0.49,0.6l-0.57,0.16l-0.18,0.13l-0.3,0.49l-1.06,-0.05l-0.13,0.02l-0.73,0.32l-1.48,-0.11l-0.55,-1.26l0.07,-1.32l-0.04,-0.16l-0.39,-0.72l-0.48,-1.85l-0.52,-0.79l0.08,-0.02l0.22,-0.36l-0.23,-1.05l0.24,-0.39l0.04,-0.19l-0.09,-0.95l0.96,-0.72l0.11,-0.31l-0.23,-0.98l0.46,-0.88l0.75,0.49l0.26,0.03l0.63,-0.22l2.76,-0.06l0.5,0.25l2.42,0.26l0.85,-0.11l0.52,0.71l0.35,0.1l1.17,-0.43l0.15,-0.12l1.75,-2.64l2.22,-1.11l6.95,-0.96l2.55,5.58Z", "name": "Yemen"}, "AT": {"path": "M463.17,154.15l-0.14,0.99l-1.15,0.01l-0.24,0.47l0.39,0.56l-0.75,1.84l-0.36,0.4l-2.06,0.07l-0.14,0.04l-1.18,0.67l-1.96,-0.23l-3.43,-0.78l-0.5,-0.97l-0.33,-0.16l-2.47,0.55l-0.2,0.16l-0.18,0.37l-1.27,-0.38l-1.28,-0.09l-0.81,-0.41l0.25,-0.51l0.03,-0.18l-0.05,-0.28l0.35,-0.08l1.16,0.81l0.45,-0.13l0.27,-0.64l2.0,0.12l1.84,-0.57l1.05,0.09l0.71,0.59l0.47,-0.11l0.23,-0.54l0.02,-0.17l-0.32,-1.85l0.69,-0.31l0.13,-0.12l0.73,-1.23l1.61,0.89l0.35,-0.04l1.35,-1.27l0.7,-0.19l1.84,0.93l0.18,0.03l1.08,-0.15l0.81,0.43l-0.07,0.15l-0.02,0.2l0.24,1.06Z", "name": "Austria"}, "DZ": {"path": "M450.58,224.94l-8.31,4.86l-7.23,5.12l-3.46,1.13l-2.42,0.22l-0.02,-1.33l-0.2,-0.28l-1.15,-0.42l-1.45,-0.69l-0.55,-1.13l-0.1,-0.12l-8.45,-5.72l-17.72,-12.17l0.03,-0.38l-0.02,-3.21l3.84,-1.91l2.46,-0.41l2.1,-0.75l0.14,-0.11l0.9,-1.3l2.84,-1.06l0.19,-0.27l0.09,-1.81l1.21,-0.2l0.15,-0.07l1.06,-0.96l3.19,-0.46l0.23,-0.18l0.46,-1.08l-0.08,-0.34l-0.6,-0.54l-0.83,-2.85l-0.18,-1.8l-0.82,-1.57l2.13,-1.37l2.65,-0.49l0.13,-0.05l1.55,-1.15l2.34,-0.85l4.2,-0.51l4.07,-0.23l1.21,0.41l0.23,-0.01l2.3,-1.11l2.52,-0.02l0.94,0.62l0.2,0.05l1.25,-0.13l-0.36,1.03l-0.01,0.14l0.39,2.66l-0.56,2.2l-1.49,1.52l-0.08,0.24l0.22,2.12l0.11,0.2l1.94,1.58l0.02,0.54l0.12,0.23l1.45,1.06l1.04,4.85l0.81,2.42l0.13,1.19l-0.43,2.17l0.17,1.28l-0.31,1.53l0.2,1.56l-0.9,1.02l-0.01,0.38l1.43,1.88l0.09,1.06l0.04,0.13l0.89,1.48l0.37,0.12l1.03,-0.43l1.79,1.12l0.89,1.34Z", "name": "Algeria"}, "US": {"path": "M892.64,99.05l1.16,0.57l0.21,0.02l1.45,-0.38l1.92,0.99l2.17,0.47l-1.65,0.72l-1.75,-0.79l-0.93,-0.7l-0.21,-0.06l-2.11,0.22l-0.35,-0.2l0.09,-0.87ZM183.29,150.37l0.39,1.54l0.12,0.17l0.78,0.55l0.14,0.05l1.74,0.2l2.52,0.5l2.4,0.98l0.17,0.02l1.96,-0.4l3.01,0.81l0.91,-0.02l2.22,-0.88l4.67,2.33l3.86,2.01l0.21,0.71l0.15,0.18l0.33,0.17l-0.02,0.05l0.23,0.43l0.67,0.1l0.21,-0.05l0.1,-0.07l0.05,0.29l0.09,0.16l0.5,0.5l0.21,0.09l0.56,0.0l0.13,0.13l-0.2,0.36l0.12,0.41l2.49,1.39l0.99,5.24l-0.69,1.68l-1.16,1.64l-0.6,1.18l-0.06,0.31l0.04,0.22l0.28,0.43l0.11,0.1l0.85,0.47l0.15,0.04l0.63,0.0l0.14,-0.04l2.87,-1.58l2.6,-0.49l3.28,-1.5l0.17,-0.23l0.04,-0.43l-0.23,-0.93l-0.24,-0.39l0.74,-0.32l4.7,-0.01l0.25,-0.13l0.77,-1.15l2.9,-2.41l1.04,-0.52l8.35,-0.02l0.28,-0.21l0.2,-0.6l0.7,-0.14l1.06,-0.48l0.13,-0.11l0.92,-1.49l0.75,-2.39l1.67,-2.08l0.59,0.6l0.3,0.07l1.52,-0.49l0.88,0.72l-0.0,4.14l0.08,0.2l1.6,1.72l0.31,0.72l-2.42,1.35l-2.55,1.05l-2.64,0.9l-0.14,0.11l-1.33,1.81l-0.44,0.7l-0.05,0.15l-0.03,1.6l0.03,0.14l0.83,1.59l0.24,0.16l0.78,0.06l-1.15,0.33l-1.25,-0.04l-1.83,0.52l-2.51,0.29l-2.17,0.88l-0.17,0.36l0.33,0.22l3.55,-0.54l0.15,0.11l-2.87,0.73l-1.19,0.0l-0.16,-0.33l-0.36,0.06l-0.76,0.82l0.17,0.5l0.42,0.08l-0.45,1.75l-1.4,1.74l-0.04,-0.17l-0.21,-0.22l-0.48,-0.13l-0.77,-0.69l-0.36,-0.03l-0.12,0.34l0.52,1.58l0.09,0.14l0.52,0.43l0.03,0.87l-0.74,1.05l-0.39,0.63l0.05,-0.12l-0.08,-0.34l-1.19,-1.03l-0.28,-2.31l-0.26,-0.26l-0.32,0.19l-0.48,1.27l-0.01,0.19l0.39,1.33l-1.14,-0.31l-0.36,0.18l0.14,0.38l1.57,0.85l0.1,2.58l0.22,0.28l0.55,0.15l0.21,0.81l0.33,2.72l-1.46,1.94l-2.5,0.81l-0.12,0.07l-1.58,1.58l-1.15,0.17l-0.15,0.06l-1.27,1.03l-0.09,0.13l-0.32,0.85l-2.71,1.79l-1.45,1.37l-1.18,1.64l-0.05,0.12l-0.39,1.96l0.0,0.13l0.44,1.91l0.85,2.37l1.1,1.91l0.03,1.2l1.16,3.07l-0.08,1.74l-0.1,0.99l-0.57,1.48l-0.54,0.24l-0.97,-0.26l-0.34,-1.02l-0.12,-0.16l-0.89,-0.58l-2.44,-4.28l-0.34,-0.94l0.49,-1.71l-0.02,-0.21l-0.7,-1.5l-2.0,-2.35l-0.11,-0.08l-0.98,-0.42l-0.25,0.01l-2.42,1.19l-0.26,-0.08l-1.26,-1.29l-1.57,-0.68l-0.16,-0.02l-2.79,0.34l-2.18,-0.3l-1.98,0.19l-1.12,0.45l-0.14,0.44l0.4,0.65l-0.04,1.02l0.09,0.22l0.29,0.3l-0.06,0.05l-0.77,-0.33l-0.26,0.01l-0.87,0.48l-1.64,-0.08l-1.79,-1.39l-0.23,-0.06l-2.11,0.33l-1.75,-0.61l-0.14,-0.01l-1.61,0.2l-2.11,0.64l-0.11,0.06l-2.25,1.99l-2.53,1.21l-1.43,1.38l-0.58,1.22l-0.03,0.12l-0.03,1.86l0.13,1.32l0.3,0.62l-0.46,0.04l-1.71,-0.57l-1.85,-0.79l-0.63,-1.14l-0.54,-1.85l-0.07,-0.12l-1.45,-1.51l-0.86,-1.58l-1.26,-1.87l-0.09,-0.09l-1.76,-1.09l-0.17,-0.04l-2.05,0.05l-0.23,0.12l-1.44,1.97l-1.84,-0.72l-1.19,-0.76l-0.6,-1.45l-0.9,-1.52l-1.49,-1.21l-1.27,-0.87l-0.89,-0.96l-0.22,-0.1l-4.34,-0.0l-0.3,0.3l-0.0,0.84l-6.62,0.02l-5.66,-1.93l-3.48,-1.24l0.11,-0.25l-0.3,-0.42l-3.18,0.3l-2.6,0.2l-0.35,-1.19l-0.08,-0.13l-1.62,-1.61l-0.13,-0.08l-1.02,-0.29l-0.22,-0.66l-0.25,-0.2l-1.31,-0.13l-0.82,-0.7l-0.16,-0.07l-2.25,-0.27l-0.48,-0.34l-0.28,-1.44l-0.07,-0.14l-2.41,-2.84l-2.03,-3.89l0.08,-0.58l-0.1,-0.27l-1.08,-0.94l-1.87,-2.36l-0.33,-2.31l-0.07,-0.15l-1.24,-1.5l0.52,-2.4l-0.09,-2.57l-0.78,-2.3l0.96,-2.83l0.61,-5.66l-0.46,-4.26l-0.79,-2.71l-0.68,-1.4l0.13,-0.26l3.24,0.97l1.28,2.88l0.52,0.06l0.62,-0.84l0.06,-0.22l-0.4,-2.61l-0.74,-2.29l68.9,-0.0l0.3,-0.3l0.01,-0.95l0.32,-0.01ZM32.5,67.43l1.75,1.99l0.41,0.04l1.02,-0.81l3.79,0.25l-0.1,0.72l0.24,0.34l3.83,0.77l2.6,-0.44l5.21,1.41l4.84,0.43l1.9,0.57l0.15,0.01l3.25,-0.71l3.72,1.32l2.52,0.58l-0.03,38.14l0.29,0.3l2.41,0.11l2.34,1.0l1.7,1.59l2.22,2.42l0.42,0.03l2.41,-2.04l2.25,-1.08l1.23,1.76l1.71,1.53l2.24,1.62l1.54,2.56l2.56,4.09l0.11,0.11l4.1,2.17l0.06,1.93l-1.12,1.35l-1.22,-1.14l-2.08,-1.05l-0.68,-2.94l-0.09,-0.16l-3.18,-2.84l-1.32,-3.35l-0.25,-0.19l-2.43,-0.24l-3.93,-0.09l-2.85,-1.02l-5.24,-3.85l-6.77,-2.04l-3.52,0.3l-4.84,-1.7l-2.96,-1.6l-0.23,-0.02l-2.78,0.8l-0.21,0.35l0.46,2.31l-1.11,0.19l-2.9,0.78l-2.24,1.26l-2.42,0.68l-0.29,-1.79l1.07,-3.49l2.54,-1.11l0.12,-0.45l-0.69,-0.96l-0.41,-0.07l-3.19,2.12l-1.76,2.54l-3.57,2.62l-0.03,0.46l1.63,1.59l-2.14,2.38l-2.64,1.49l-2.49,1.09l-0.16,0.17l-0.58,1.48l-3.8,1.79l-0.14,0.14l-0.75,1.57l-2.75,1.41l-1.62,-0.25l-0.16,0.02l-2.35,0.98l-2.54,1.19l-2.06,1.15l-4.05,0.93l-0.1,-0.15l2.45,-1.45l2.49,-1.1l2.61,-1.88l3.03,-0.39l0.19,-0.1l1.2,-1.41l3.43,-2.11l0.61,-0.75l1.81,-1.24l0.13,-0.2l0.42,-2.7l1.24,-2.12l-0.03,-0.35l-0.34,-0.09l-2.73,1.05l-0.67,-0.53l-0.39,0.02l-1.13,1.11l-1.43,-1.62l-0.49,0.06l-0.41,0.8l-0.67,-1.31l-0.42,-0.12l-2.43,1.43l-1.18,-0.0l-0.18,-1.86l0.43,-1.3l-0.09,-0.33l-1.61,-1.33l-0.26,-0.06l-3.11,0.68l-2.0,-1.66l-1.61,-0.85l-0.01,-1.97l-0.11,-0.23l-1.76,-1.48l0.86,-1.96l2.01,-2.13l0.88,-1.94l1.79,-0.25l1.65,0.6l0.31,-0.06l1.91,-1.8l1.67,0.31l0.22,-0.04l1.91,-1.23l0.13,-0.33l-0.47,-1.82l-0.15,-0.19l-1.0,-0.52l1.51,-1.27l0.09,-0.34l-0.29,-0.19l-1.62,0.06l-2.66,0.88l-0.13,0.09l-0.62,0.72l-1.77,-0.8l-0.16,-0.02l-3.48,0.44l-3.5,-0.92l-1.06,-1.61l-2.78,-2.09l3.07,-1.51l5.52,-2.01l1.65,0.0l-0.28,1.73l0.31,0.35l5.29,-0.16l0.23,-0.49l-2.03,-2.59l-0.1,-0.08l-3.03,-1.58l-1.79,-2.12l-2.4,-1.83l-3.18,-1.27l1.13,-1.84l4.28,-0.14l0.15,-0.05l3.16,-2.0l0.13,-0.17l0.57,-2.07l2.43,-2.02l2.42,-0.52l4.67,-1.98l2.22,0.29l0.2,-0.04l3.74,-2.37l3.57,0.91ZM37.66,123.49l-2.31,1.26l-1.04,-0.75l-0.31,-1.35l2.06,-1.16l1.24,-0.51l1.48,0.22l0.76,0.81l-1.89,1.49ZM30.89,233.84l1.2,0.57l0.35,0.3l0.48,0.69l-1.6,0.86l-0.3,0.31l-0.24,-0.14l0.05,-0.54l-0.02,-0.15l-0.36,-0.83l0.05,-0.12l0.39,-0.38l0.07,-0.31l-0.09,-0.27ZM29.06,231.89l0.5,0.14l0.31,0.19l-0.46,0.1l-0.34,-0.43ZM25.02,230.13l0.2,-0.11l0.4,0.47l-0.43,-0.05l-0.17,-0.31ZM21.29,228.68l0.1,-0.07l0.22,0.02l0.02,0.21l-0.02,0.02l-0.32,-0.18ZM6.0,113.33l-1.19,0.45l-1.5,-0.64l-0.94,-0.63l1.76,-0.46l1.71,0.29l0.16,0.98Z", "name": "United States of America"}, "LV": {"path": "M473.99,127.16l0.07,-2.15l1.15,-2.11l2.05,-1.07l1.84,2.48l0.25,0.12l2.01,-0.07l0.29,-0.25l0.45,-2.58l1.85,-0.56l0.98,0.4l2.13,1.33l0.16,0.05l1.97,0.01l1.02,0.7l0.21,1.67l0.71,1.84l-2.44,1.23l-1.36,0.53l-2.28,-1.62l-0.12,-0.05l-1.18,-0.2l-0.28,-0.6l-0.31,-0.17l-2.43,0.35l-4.17,-0.23l-0.12,0.02l-2.45,0.93Z", "name": "Latvia"}, "UY": {"path": "M276.9,363.17l1.3,-0.23l2.4,2.04l0.22,0.07l0.82,-0.07l2.48,1.7l1.93,1.5l1.28,1.67l-0.95,1.14l-0.04,0.31l0.63,1.45l-0.96,1.57l-2.65,1.47l-1.73,-0.53l-0.15,-0.01l-1.25,0.28l-2.22,-1.16l-0.16,-0.03l-1.56,0.08l-1.33,-1.36l0.17,-1.58l0.48,-0.55l0.07,-0.2l-0.02,-2.74l0.66,-2.8l0.57,-2.02Z", "name": "Uruguay"}, "LB": {"path": "M510.44,198.11l-0.48,0.03l-0.26,0.17l-0.15,0.32l-0.21,-0.0l0.72,-1.85l1.19,-1.9l0.74,0.09l0.27,0.73l-1.19,0.93l-0.09,0.13l-0.54,1.36Z", "name": "Lebanon"}, "LA": {"path": "M684.87,248.8l0.61,-0.86l0.05,-0.16l0.11,-2.17l-0.08,-0.22l-1.96,-2.16l-0.15,-2.44l-0.08,-0.18l-1.9,-2.1l-0.19,-0.1l-1.89,-0.18l-0.29,0.15l-0.42,0.76l-1.21,0.06l-0.67,-0.41l-0.31,-0.0l-2.2,1.29l-0.05,-1.77l0.61,-2.7l-0.27,-0.37l-1.44,-0.1l-0.12,-1.31l-0.12,-0.21l-0.87,-0.65l0.38,-0.68l1.76,-1.41l0.08,0.22l0.27,0.2l1.33,0.07l0.31,-0.34l-0.35,-2.75l0.85,-0.25l1.32,1.88l1.11,2.36l0.27,0.17l2.89,0.02l0.78,1.82l-1.32,0.56l-0.12,0.09l-0.72,0.93l0.1,0.45l2.93,1.52l3.62,5.27l1.88,1.78l0.58,1.67l-0.38,2.11l-1.87,-0.79l-0.37,0.11l-0.99,1.54l-1.51,-0.73Z", "name": "Laos"}, "TW": {"path": "M725.6,222.5l-1.5,4.22l-0.82,1.65l-1.01,-1.7l-0.26,-1.8l1.4,-2.48l1.8,-1.81l0.76,0.53l-0.38,1.39Z", "name": "Taiwan"}, "TT": {"path": "M266.35,259.46l0.41,-0.39l0.09,-0.23l-0.04,-0.75l1.14,-0.26l0.2,0.03l-0.07,1.37l-1.73,0.23Z", "name": "Trinidad and Tobago"}, "TR": {"path": "M513.25,175.38l3.63,1.17l0.14,0.01l2.88,-0.45l2.11,0.26l0.18,-0.03l2.9,-1.53l2.51,-0.13l2.25,1.37l0.36,0.88l-0.23,1.36l0.19,0.33l1.81,0.72l0.61,0.53l-1.31,0.64l-0.16,0.34l0.76,3.24l-0.44,0.8l0.01,0.3l1.19,2.02l-0.71,0.29l-0.74,-0.62l-0.15,-0.07l-2.91,-0.37l-0.15,0.02l-1.04,0.43l-2.78,0.44l-1.44,-0.03l-2.83,1.06l-1.95,0.01l-1.28,-0.52l-0.2,-0.01l-2.62,0.76l-0.7,-0.48l-0.47,0.22l-0.13,1.49l-1.01,0.94l-0.58,-0.82l0.79,-0.9l0.04,-0.34l-0.31,-0.15l-1.46,0.23l-2.03,-0.64l-0.3,0.07l-1.65,1.58l-3.58,0.3l-1.94,-1.47l-0.17,-0.06l-2.7,-0.1l-0.28,0.17l-0.51,1.06l-1.47,0.29l-2.32,-1.46l-0.17,-0.05l-2.55,0.05l-1.4,-2.7l-1.72,-1.54l1.11,-2.06l-0.07,-0.37l-1.35,-1.19l2.47,-2.51l3.74,-0.11l0.26,-0.17l0.96,-2.07l4.56,0.38l0.19,-0.05l2.97,-1.92l2.84,-0.83l4.03,-0.06l4.31,2.08ZM488.85,176.8l-1.81,1.38l-0.57,-1.01l0.02,-0.36l0.45,-0.25l0.13,-0.15l0.78,-1.87l-0.11,-0.37l-0.72,-0.47l1.91,-0.71l1.89,0.35l0.25,0.97l0.17,0.2l1.87,0.83l-0.19,0.31l-2.82,0.16l-0.18,0.07l-1.06,0.91Z", "name": "Turkey"}, "LK": {"path": "M625.44,266.07l-0.35,2.4l-0.9,0.61l-1.91,0.5l-1.04,-1.75l-0.43,-3.5l1.0,-3.6l1.34,1.09l1.13,1.72l1.16,2.52Z", "name": "Sri Lanka"}, "TN": {"path": "M444.91,206.18l-0.99,-4.57l-0.12,-0.18l-1.43,-1.04l-0.02,-0.53l-0.11,-0.22l-1.95,-1.59l-0.19,-1.85l1.44,-1.47l0.08,-0.14l0.59,-2.34l-0.38,-2.77l0.44,-1.28l2.52,-1.08l1.41,0.28l-0.06,1.2l0.43,0.28l1.81,-0.9l0.02,0.06l-1.14,1.28l-0.08,0.2l-0.02,1.32l0.11,0.24l0.74,0.6l-0.29,2.18l-1.56,1.35l-0.09,0.32l0.48,1.54l0.28,0.21l1.11,0.04l0.55,1.17l0.15,0.14l0.76,0.35l-0.12,1.79l-1.1,0.72l-0.8,0.91l-1.68,1.04l-0.13,0.32l0.25,1.08l-0.18,0.96l-0.74,0.39Z", "name": "Tunisia"}, "TL": {"path": "M734.21,307.22l0.17,-0.34l1.99,-0.52l1.72,-0.08l0.78,-0.3l0.29,0.1l-0.43,0.32l-2.57,1.09l-1.71,0.59l-0.05,-0.49l-0.19,-0.36Z", "name": "East Timor"}, "TM": {"path": "M553.16,173.51l-0.12,1.0l-0.26,-0.65l0.38,-0.34ZM553.54,173.16l0.13,-0.12l0.43,-0.09l-0.56,0.21ZM555.68,172.6l0.65,-0.14l1.53,0.76l1.71,2.29l0.27,0.12l1.27,-0.14l2.81,-0.04l0.29,-0.38l-0.35,-1.27l1.98,-0.97l1.96,-1.63l3.05,1.44l0.25,2.23l0.14,0.22l0.96,0.61l0.18,0.05l2.61,-0.13l0.68,0.44l1.2,2.97l0.1,0.13l2.85,2.03l1.67,1.41l2.66,1.45l3.13,1.17l-0.05,1.23l-0.36,-0.04l-1.12,-0.73l-0.44,0.14l-0.34,0.89l-1.96,0.52l-0.22,0.23l-0.47,2.17l-1.26,0.78l-1.93,0.42l-0.21,0.18l-0.46,1.14l-1.64,0.33l-2.3,-0.97l-0.2,-2.23l-0.28,-0.27l-1.76,-0.1l-2.78,-2.48l-0.15,-0.07l-1.95,-0.31l-2.82,-1.48l-1.78,-0.27l-0.18,0.03l-1.03,0.51l-1.6,-0.08l-0.22,0.08l-1.72,1.6l-1.83,0.46l-0.39,-1.7l0.36,-3.0l-0.16,-0.3l-1.73,-0.88l0.57,-1.77l-0.25,-0.39l-1.33,-0.14l0.41,-1.85l2.05,0.63l0.21,-0.01l2.2,-0.95l0.09,-0.49l-1.78,-1.75l-0.69,-1.66l-0.07,-0.03Z", "name": "Turkmenistan"}, "TJ": {"path": "M597.99,178.71l-0.23,0.23l-2.57,-0.47l-0.35,0.25l-0.24,1.7l0.32,0.34l2.66,-0.22l3.15,0.95l4.47,-0.42l0.58,2.45l0.39,0.21l0.71,-0.25l1.22,0.53l-0.06,1.01l0.29,1.28l-2.19,-0.0l-1.71,-0.21l-0.23,0.07l-1.51,1.25l-1.05,0.27l-0.77,0.51l-0.71,-0.67l0.22,-2.28l-0.24,-0.32l-0.43,-0.08l0.17,-0.57l-0.16,-0.36l-1.36,-0.66l-0.34,0.05l-1.08,1.01l-0.09,0.15l-0.25,1.09l-0.24,0.26l-1.36,-0.05l-0.27,0.14l-0.65,1.06l-0.58,-0.39l-0.3,-0.02l-1.68,0.86l-0.36,-0.16l1.28,-2.65l0.02,-0.2l-0.54,-2.17l-0.18,-0.21l-1.53,-0.58l0.41,-0.82l1.89,0.13l0.26,-0.12l1.19,-1.63l0.77,-1.82l2.66,-0.55l-0.33,0.87l0.01,0.23l0.36,0.82l0.3,0.18l0.23,-0.02Z", "name": "Tajikistan"}, "LS": {"path": "M493.32,359.69l0.69,0.65l-0.65,1.12l-0.38,0.8l-1.27,0.39l-0.18,0.15l-0.4,0.77l-0.59,0.18l-1.59,-1.78l1.16,-1.5l1.3,-1.02l0.97,-0.46l0.94,0.72Z", "name": "Lesotho"}, "TH": {"path": "M677.42,253.68l-1.7,-0.88l-0.14,-0.03l-1.77,0.04l0.3,-1.64l-0.3,-0.35l-2.21,0.01l-0.3,0.28l-0.2,2.76l-2.15,5.9l-0.02,0.13l0.17,1.83l0.28,0.27l1.45,0.07l0.93,2.1l0.44,2.15l0.08,0.15l1.4,1.44l0.16,0.09l1.43,0.27l1.04,1.05l-0.58,0.73l-1.24,0.22l-0.15,-0.99l-0.15,-0.22l-2.04,-1.1l-0.36,0.06l-0.23,0.23l-0.72,-0.71l-0.41,-1.18l-0.06,-0.11l-1.33,-1.42l-1.22,-1.2l-0.5,0.13l-0.15,0.54l-0.14,-0.41l0.26,-1.48l0.73,-2.38l1.2,-2.57l1.37,-2.35l0.02,-0.27l-0.95,-2.26l0.03,-1.19l-0.29,-1.42l-0.06,-0.13l-1.65,-2.0l-0.46,-0.99l0.62,-0.34l0.13,-0.15l0.92,-2.23l-0.02,-0.27l-1.05,-1.74l-1.57,-1.86l-1.04,-1.96l0.76,-0.34l0.16,-0.16l1.07,-2.63l1.58,-0.1l0.16,-0.06l1.43,-1.11l1.24,-0.52l0.84,0.62l0.13,1.43l0.28,0.27l1.34,0.09l-0.54,2.39l0.05,2.39l0.45,0.25l2.48,-1.45l0.6,0.36l0.17,0.04l1.47,-0.07l0.25,-0.15l0.41,-0.73l1.58,0.15l1.76,1.93l0.15,2.44l0.08,0.18l1.94,2.15l-0.1,1.96l-0.66,0.93l-2.25,-0.34l-3.24,0.49l-0.19,0.12l-1.6,2.12l-0.06,0.24l0.48,2.46Z", "name": "Thailand"}, "TF": {"path": "M593.76,417.73l1.38,0.84l2.15,0.37l0.04,0.31l-0.59,1.24l-3.36,0.19l-0.05,-1.38l0.43,-1.56Z", "name": "French Southern and Antarctic Lands"}, "TG": {"path": "M425.23,269.29l-1.49,0.4l-0.43,-0.68l-0.64,-1.54l-0.18,-1.16l0.54,-2.21l-0.04,-0.24l-0.59,-0.86l-0.23,-1.9l0.0,-1.82l-0.07,-0.19l-0.95,-1.19l0.1,-0.41l1.58,0.04l-0.23,0.97l0.08,0.28l1.55,1.55l0.09,1.13l0.08,0.19l0.42,0.43l-0.11,5.66l0.52,1.53Z", "name": "Togo"}, "TD": {"path": "M457.57,252.46l0.23,-1.08l-0.28,-0.36l-1.32,-0.05l0.0,-1.35l-0.1,-0.22l-0.9,-0.82l0.99,-3.1l3.12,-2.37l0.12,-0.23l0.13,-3.33l0.95,-5.2l0.53,-1.09l-0.07,-0.36l-0.94,-0.81l-0.03,-0.7l-0.12,-0.23l-0.84,-0.61l-0.57,-3.76l2.21,-1.26l19.67,9.88l0.12,9.74l-1.83,-0.15l-0.28,0.14l-1.14,1.89l-0.68,1.62l0.05,0.31l0.33,0.38l-0.61,0.58l-0.08,0.3l0.25,0.93l-0.58,0.95l-0.29,1.01l0.34,0.37l0.67,-0.11l0.39,0.73l0.03,1.4l0.11,0.23l0.8,0.65l-0.01,0.24l-1.38,0.37l-0.11,0.06l-1.27,1.03l-1.83,2.76l-2.21,1.1l-2.34,-0.15l-0.82,0.25l-0.2,0.37l0.19,0.68l-1.16,0.79l-1.01,0.94l-2.92,0.89l-0.5,-0.46l-0.17,-0.08l-0.41,-0.05l-0.28,0.12l-0.38,0.54l-1.36,0.12l0.1,-0.18l0.01,-0.27l-0.78,-1.72l-0.35,-1.03l-0.17,-0.18l-1.03,-0.41l-1.29,-1.28l0.36,-0.78l0.9,0.2l0.14,-0.0l0.67,-0.17l1.36,0.02l0.26,-0.45l-1.32,-2.22l0.09,-1.64l-0.17,-1.68l-0.04,-0.13l-0.93,-1.53Z", "name": "Chad"}, "LY": {"path": "M457.99,226.38l-1.57,0.87l-1.25,-1.28l-0.13,-0.08l-3.85,-1.11l-1.04,-1.57l-0.09,-0.09l-1.98,-1.23l-0.27,-0.02l-0.93,0.39l-0.72,-1.2l-0.09,-1.07l-0.06,-0.16l-1.33,-1.75l0.83,-0.94l0.07,-0.24l-0.21,-1.64l0.31,-1.43l-0.17,-1.29l0.43,-2.26l-0.15,-1.33l-0.73,-2.18l0.99,-0.52l0.16,-0.21l0.22,-1.16l-0.22,-1.06l1.54,-0.95l0.81,-0.92l1.19,-0.78l0.14,-0.23l0.12,-1.76l2.57,0.84l0.16,0.01l0.99,-0.23l2.01,0.45l3.19,1.2l1.12,2.36l0.2,0.16l2.24,0.53l3.5,1.14l2.65,1.36l0.29,-0.01l1.22,-0.71l1.27,-1.32l0.07,-0.29l-0.55,-2.0l0.69,-1.19l1.7,-1.23l1.61,-0.35l3.2,0.54l0.78,1.14l0.24,0.13l0.85,0.01l0.84,0.47l2.35,0.31l0.42,0.63l-0.79,1.16l-0.04,0.26l0.35,1.08l-0.61,1.6l-0.0,0.2l0.73,2.16l0.0,24.24l-2.58,0.01l-0.3,0.29l-0.02,0.62l-19.55,-9.83l-0.28,0.01l-2.53,1.44Z", "name": "Libya"}, "AE": {"path": "M550.59,223.8l0.12,0.08l1.92,-0.41l3.54,0.15l0.23,-0.09l1.71,-1.79l1.86,-1.7l1.31,-1.36l0.26,0.5l0.28,1.72l-0.93,0.01l-0.3,0.26l-0.21,1.73l0.11,0.27l0.08,0.06l-0.7,0.32l-0.17,0.27l-0.01,0.99l-0.68,1.02l-0.05,0.15l-0.06,0.96l-0.32,0.36l-7.19,-1.27l-0.79,-2.22Z", "name": "United Arab Emirates"}, "VE": {"path": "M240.66,256.5l0.65,0.91l-0.03,1.13l-1.05,1.39l-0.03,0.31l0.95,2.0l0.32,0.17l1.08,-0.16l0.24,-0.21l0.56,-1.83l-0.06,-0.29l-0.71,-0.81l-0.1,-1.58l2.9,-0.96l0.19,-0.37l-0.29,-1.02l0.45,-0.41l0.72,1.43l0.26,0.16l1.65,0.04l1.46,1.27l0.08,0.72l0.3,0.27l2.28,0.02l2.55,-0.25l1.34,1.06l0.14,0.06l1.92,0.31l0.2,-0.03l1.4,-0.79l0.15,-0.25l0.02,-0.36l2.82,-0.14l1.17,-0.01l-0.41,0.14l-0.14,0.46l0.86,1.19l0.22,0.12l1.93,0.18l1.73,1.13l0.37,1.9l0.31,0.24l1.21,-0.05l0.52,0.32l-1.63,1.21l-0.11,0.17l-0.22,0.92l0.07,0.27l0.63,0.69l-0.31,0.24l-1.48,0.39l-0.22,0.3l0.04,1.03l-0.59,0.6l-0.01,0.41l1.67,1.87l0.23,0.48l-0.72,0.76l-2.71,0.91l-1.78,0.39l-0.13,0.06l-0.6,0.49l-1.84,-0.58l-1.89,-0.33l-0.18,0.03l-0.47,0.23l-0.02,0.53l0.96,0.56l-0.08,1.58l0.35,1.58l0.26,0.23l1.91,0.19l0.02,0.07l-1.54,0.62l-0.18,0.2l-0.25,0.92l-0.88,0.35l-1.85,0.58l-0.16,0.13l-0.4,0.64l-1.66,0.14l-1.22,-1.18l-0.79,-2.52l-0.67,-0.88l-0.66,-0.43l0.99,-0.98l0.09,-0.26l-0.09,-0.56l-0.08,-0.16l-0.66,-0.69l-0.47,-1.54l0.18,-1.67l0.55,-0.85l0.45,-1.35l-0.15,-0.36l-0.89,-0.43l-0.19,-0.02l-1.39,0.28l-1.76,-0.13l-0.92,0.23l-1.64,-2.01l-0.17,-0.1l-1.54,-0.33l-3.05,0.23l-0.5,-0.73l-0.15,-0.12l-0.45,-0.15l-0.05,-0.28l0.28,-0.86l0.01,-0.15l-0.2,-1.01l-0.08,-0.15l-0.5,-0.5l-0.3,-1.08l-0.25,-0.22l-0.89,-0.12l0.54,-1.18l0.29,-1.73l0.66,-0.85l0.94,-0.7l0.09,-0.11l0.3,-0.6Z", "name": "Venezuela"}, "AF": {"path": "M574.42,192.1l2.24,0.95l0.18,0.02l1.89,-0.38l0.22,-0.18l0.46,-1.14l1.82,-0.4l1.5,-0.91l0.14,-0.19l0.46,-2.12l1.93,-0.51l0.2,-0.18l0.26,-0.68l0.87,0.57l0.13,0.05l0.79,0.09l1.35,0.02l1.83,0.59l0.75,0.34l0.26,-0.01l1.66,-0.85l0.7,0.46l0.42,-0.09l0.72,-1.17l1.32,0.05l0.23,-0.1l0.39,-0.43l0.07,-0.14l0.24,-1.08l0.86,-0.81l0.94,0.46l-0.2,0.64l0.23,0.38l0.49,0.09l-0.21,2.15l0.09,0.25l0.99,0.94l0.38,0.03l0.83,-0.57l1.06,-0.27l0.12,-0.06l1.46,-1.21l1.63,0.2l2.4,0.0l0.17,0.32l-1.12,0.25l-1.23,0.52l-2.86,0.33l-2.69,0.6l-0.13,0.06l-1.46,1.25l-0.07,0.36l0.58,1.18l0.25,1.21l-1.13,1.08l-0.09,0.25l0.09,0.98l-0.53,0.79l-2.22,-0.08l-0.28,0.44l0.83,1.57l-1.3,0.58l-0.13,0.11l-1.06,1.69l-0.05,0.18l0.13,1.51l-0.73,0.58l-0.78,-0.22l-0.14,-0.01l-1.91,0.36l-0.23,0.19l-0.2,0.57l-1.65,-0.0l-0.22,0.1l-1.4,1.56l-0.08,0.19l-0.08,2.13l-2.99,1.05l-1.67,-0.23l-0.27,0.1l-0.39,0.46l-1.43,-0.31l-2.43,0.4l-3.69,-1.23l1.96,-2.15l0.08,-0.24l-0.21,-1.78l-0.23,-0.26l-1.69,-0.42l-0.19,-1.62l-0.77,-2.08l0.98,-1.41l-0.14,-0.45l-0.82,-0.31l0.6,-1.79l0.93,-3.21Z", "name": "Afghanistan"}, "IQ": {"path": "M534.42,190.89l0.13,0.14l1.5,0.78l0.15,1.34l-1.13,0.87l-0.11,0.16l-0.58,2.2l0.04,0.24l1.73,2.67l0.12,0.1l2.99,1.49l1.18,1.94l-0.39,1.89l0.29,0.36l0.5,-0.0l0.02,1.17l0.08,0.2l0.83,0.86l-2.36,-0.29l-0.29,0.13l-1.74,2.49l-4.4,-0.21l-7.03,-5.49l-3.73,-1.94l-2.92,-0.74l-0.89,-3.0l5.33,-2.81l0.15,-0.19l0.95,-3.43l-0.2,-2.0l1.19,-0.61l0.11,-0.09l1.23,-1.73l0.92,-0.38l2.75,0.35l0.81,0.68l0.31,0.05l0.94,-0.38l1.5,3.17Z", "name": "Iraq"}, "IS": {"path": "M384.26,87.96l-0.51,2.35l0.08,0.28l2.61,2.58l-2.99,2.83l-7.16,2.72l-2.08,0.7l-9.51,-1.71l1.89,-1.36l-0.07,-0.53l-4.4,-1.59l3.33,-0.59l0.25,-0.32l-0.11,-1.2l-0.25,-0.27l-4.82,-0.88l1.38,-2.2l3.54,-0.57l3.8,2.74l0.33,0.01l3.68,-2.18l3.02,1.12l0.25,-0.02l4.01,-2.18l3.72,0.27Z", "name": "Iceland"}, "IR": {"path": "M556.2,187.5l2.05,-0.52l0.13,-0.07l1.69,-1.57l1.55,0.08l0.15,-0.03l1.02,-0.5l1.64,0.25l2.82,1.48l1.91,0.3l2.8,2.49l0.18,0.08l1.61,0.09l0.19,2.09l-1.0,3.47l-0.69,2.04l0.18,0.38l0.73,0.28l-0.85,1.22l-0.04,0.28l0.81,2.19l0.19,1.72l0.23,0.26l1.69,0.42l0.17,1.43l-2.18,2.39l-0.01,0.4l1.22,1.42l1.0,1.62l0.12,0.11l2.23,1.11l0.06,2.2l0.2,0.27l1.03,0.38l0.14,0.83l-3.38,1.3l-0.18,0.19l-0.87,2.85l-4.44,-0.76l-2.75,-0.62l-2.64,-0.32l-1.01,-3.11l-0.17,-0.19l-1.2,-0.48l-0.18,-0.01l-1.99,0.51l-2.42,1.25l-2.89,-0.84l-2.48,-2.03l-2.41,-0.79l-1.61,-2.47l-1.84,-3.63l-0.36,-0.15l-1.22,0.4l-1.48,-0.84l-0.37,0.06l-0.72,0.82l-1.08,-1.12l-0.02,-1.35l-0.3,-0.29l-0.43,0.0l0.34,-1.64l-0.04,-0.22l-1.29,-2.11l-0.12,-0.11l-3.0,-1.49l-1.62,-2.49l0.52,-1.98l1.18,-0.92l0.11,-0.27l-0.19,-1.66l-0.16,-0.23l-1.55,-0.81l-1.58,-3.33l-1.3,-2.2l0.41,-0.75l0.03,-0.21l-0.73,-3.12l1.2,-0.59l0.35,0.9l1.26,1.35l0.15,0.09l1.81,0.39l0.91,-0.09l0.15,-0.06l2.9,-2.13l0.7,-0.16l0.48,0.56l-0.75,1.26l0.05,0.37l1.56,1.53l0.28,0.08l0.37,-0.09l0.7,1.89l0.21,0.19l2.31,0.59l1.69,1.4l0.15,0.07l3.66,0.49l3.91,-0.76l0.23,-0.19l0.19,-0.52Z", "name": "Iran"}, "AM": {"path": "M530.51,176.08l2.91,-0.39l0.41,0.63l0.11,0.1l0.66,0.36l-0.32,0.47l0.07,0.41l1.1,0.84l-0.53,0.7l0.06,0.42l1.06,0.8l1.01,0.44l0.04,1.56l-0.44,0.04l-0.88,-1.46l0.01,-0.37l-0.3,-0.31l-0.98,0.01l-0.65,-0.69l-0.26,-0.09l-0.38,0.06l-0.97,-0.82l-1.64,-0.65l0.2,-1.2l-0.02,-0.16l-0.28,-0.69Z", "name": "Armenia"}, "IT": {"path": "M451.68,158.58l0.2,0.16l3.3,0.75l-0.22,1.26l0.02,0.18l0.35,0.78l-1.4,-0.32l-0.21,0.03l-2.04,1.1l-0.16,0.29l0.13,1.47l-0.29,0.82l0.02,0.24l0.82,1.57l0.1,0.11l2.28,1.5l1.29,2.53l2.79,2.43l0.2,0.07l1.83,-0.02l0.31,0.34l-0.46,0.39l0.06,0.5l4.06,1.97l2.06,1.49l0.17,0.36l-0.24,0.53l-1.08,-1.07l-0.15,-0.08l-2.18,-0.49l-0.33,0.15l-1.05,1.91l0.11,0.4l1.63,0.98l-0.22,1.12l-0.84,0.14l-0.22,0.15l-1.27,2.38l-0.54,0.12l0.01,-0.47l0.48,-1.46l0.5,-0.58l0.03,-0.35l-0.97,-1.69l-0.76,-1.48l-0.17,-0.15l-0.94,-0.33l-0.68,-1.18l-0.16,-0.13l-1.53,-0.52l-1.03,-1.14l-0.19,-0.1l-1.78,-0.19l-1.88,-1.3l-2.27,-1.94l-1.64,-1.68l-0.76,-2.94l-0.21,-0.21l-1.22,-0.35l-2.01,-1.0l-0.24,-0.01l-1.15,0.42l-0.11,0.07l-1.38,1.36l-0.5,0.11l0.19,-0.87l-0.21,-0.35l-1.19,-0.34l-0.56,-2.06l0.76,-0.82l0.03,-0.36l-0.68,-1.08l0.04,-0.31l0.68,0.42l0.19,0.04l1.21,-0.15l0.14,-0.06l1.18,-0.89l0.25,0.29l0.25,0.1l1.19,-0.1l0.25,-0.18l0.45,-1.04l1.61,0.34l0.19,-0.02l1.1,-0.53l0.17,-0.22l0.15,-0.95l1.19,0.35l0.35,-0.16l0.23,-0.47l2.11,-0.47l0.45,0.89ZM459.35,184.63l-0.71,1.81l0.0,0.23l0.33,0.79l-0.37,1.03l-1.6,-0.91l-1.33,-0.34l-3.24,-1.36l0.23,-0.99l2.73,0.24l3.95,-0.5ZM443.95,175.91l1.26,1.77l-0.31,3.47l-0.82,-0.13l-0.26,0.08l-0.83,0.79l-0.64,-0.52l-0.1,-3.42l-0.44,-1.34l0.91,0.1l0.21,-0.06l1.01,-0.74Z", "name": "Italy"}, "VN": {"path": "M690.8,230.21l-2.86,1.93l-2.09,2.46l-0.06,0.11l-0.55,1.8l0.04,0.26l4.26,6.1l2.31,1.63l1.46,1.97l1.12,4.62l-0.32,4.3l-1.97,1.57l-2.85,1.62l-2.09,2.14l-2.83,2.13l-0.67,-1.19l0.65,-1.58l-0.09,-0.35l-1.47,-1.14l1.67,-0.79l2.57,-0.18l0.22,-0.47l-0.89,-1.24l3.88,-1.8l0.17,-0.24l0.31,-3.05l-0.01,-0.13l-0.56,-1.63l0.44,-2.48l-0.01,-0.15l-0.63,-1.81l-0.08,-0.12l-1.87,-1.77l-3.64,-5.3l-0.11,-0.1l-2.68,-1.39l0.45,-0.59l1.53,-0.65l0.16,-0.39l-0.97,-2.27l-0.27,-0.18l-2.89,-0.02l-1.04,-2.21l-1.28,-1.83l0.96,-0.46l1.97,0.01l2.43,-0.3l0.13,-0.05l1.95,-1.29l1.04,0.85l0.13,0.06l1.98,0.42l-0.32,1.21l0.09,0.3l1.19,1.07l0.12,0.07l1.88,0.51Z", "name": "Vietnam"}, "AR": {"path": "M258.11,341.34l1.4,1.81l0.51,-0.06l0.89,-1.94l2.51,0.1l0.36,0.49l4.6,4.31l0.15,0.08l1.99,0.39l3.01,1.93l2.5,1.01l0.28,0.91l-2.4,3.97l0.17,0.44l2.57,0.74l2.81,0.41l2.09,-0.44l0.14,-0.07l2.27,-2.06l0.09,-0.17l0.38,-2.2l0.88,-0.36l1.05,1.29l-0.04,1.88l-1.98,1.4l-1.72,1.13l-2.84,2.65l-3.34,3.73l-0.07,0.12l-0.63,2.22l-0.67,2.85l0.02,2.73l-0.47,0.54l-0.07,0.17l-0.36,3.28l0.12,0.27l3.03,2.32l-0.31,1.78l0.11,0.29l1.44,1.15l-0.11,1.17l-2.32,3.57l-3.59,1.51l-4.95,0.6l-2.72,-0.29l-0.32,0.38l0.5,1.67l-0.49,2.13l0.01,0.16l0.4,1.29l-1.27,0.88l-2.41,0.39l-2.33,-1.05l-0.31,0.04l-0.97,0.78l-0.11,0.27l0.35,2.98l0.16,0.23l1.69,0.91l0.31,-0.02l1.08,-0.75l0.46,0.96l-2.1,0.88l-2.01,1.89l-0.09,0.18l-0.36,3.05l-0.51,1.42l-2.16,0.01l-0.19,0.07l-1.96,1.59l-0.1,0.15l-0.72,2.34l0.08,0.31l2.46,2.31l0.13,0.07l2.09,0.56l-0.74,2.45l-2.86,1.75l-0.12,0.14l-1.59,3.71l-2.2,1.24l-0.1,0.09l-1.03,1.54l-0.04,0.23l0.81,3.45l0.06,0.13l1.13,1.32l-2.59,-0.57l-5.89,-0.44l-0.92,-1.73l0.05,-2.4l-0.34,-0.3l-1.49,0.19l-0.72,-0.98l-0.2,-3.21l1.79,-1.33l0.1,-0.13l0.79,-2.04l0.02,-0.16l-0.27,-1.52l1.31,-2.69l0.91,-4.15l-0.23,-1.72l0.91,-0.49l0.15,-0.33l-0.27,-1.16l-0.15,-0.2l-0.87,-0.46l0.65,-1.01l-0.04,-0.37l-1.06,-1.09l-0.54,-3.2l0.83,-0.51l0.14,-0.29l-0.42,-3.6l0.58,-2.98l0.64,-2.5l1.41,-1.0l0.12,-0.32l-0.75,-2.8l-0.01,-2.48l1.81,-1.78l0.09,-0.22l-0.06,-2.3l1.39,-2.69l0.03,-0.14l0.01,-2.58l-0.11,-0.24l-0.57,-0.45l-1.1,-4.59l1.49,-2.73l0.04,-0.17l-0.23,-2.59l0.86,-2.38l1.6,-2.48l1.74,-1.65l0.04,-0.39l-0.64,-0.89l0.42,-0.7l0.04,-0.16l-0.08,-4.26l2.55,-1.23l0.16,-0.18l0.86,-2.75l-0.01,-0.22l-0.22,-0.48l1.84,-2.1l3.0,0.59ZM256.77,438.98l-2.1,0.15l-1.18,-1.14l-0.19,-0.08l-1.53,-0.09l-2.38,-0.0l-0.0,-6.28l0.4,0.65l1.25,2.55l0.11,0.12l3.26,2.07l3.19,0.8l-0.82,1.26Z", "name": "Argentina"}, "AU": {"path": "M705.55,353.06l0.09,0.09l0.37,0.05l0.13,-0.35l-0.57,-1.69l0.48,0.3l0.71,0.99l0.34,0.11l0.2,-0.29l-0.04,-1.37l-0.04,-0.14l-1.22,-2.07l-0.28,-0.9l-0.51,-0.69l0.24,-1.33l0.52,-0.7l0.34,-1.32l0.01,-0.13l-0.25,-1.44l0.51,-0.94l0.1,1.03l0.23,0.26l0.32,-0.14l1.01,-1.72l1.94,-0.84l1.27,-1.14l1.84,-0.92l1.0,-0.18l0.6,0.28l0.26,-0.0l1.94,-0.96l1.48,-0.28l0.19,-0.13l0.32,-0.49l0.51,-0.18l1.42,0.05l2.63,-0.76l0.11,-0.06l1.36,-1.15l0.08,-0.1l0.61,-1.33l1.42,-1.27l0.1,-0.19l0.11,-1.03l0.06,-1.32l1.39,-1.74l0.85,1.79l0.4,0.14l1.07,-0.51l0.11,-0.45l-0.77,-1.05l0.53,-0.84l0.86,0.43l0.43,-0.22l0.29,-1.85l1.29,-1.19l0.6,-0.98l1.16,-0.4l0.2,-0.27l0.02,-0.34l0.74,0.2l0.38,-0.27l0.03,-0.44l1.98,-0.61l1.7,1.08l1.36,1.48l0.22,0.1l1.55,0.02l1.57,0.24l0.33,-0.4l-0.48,-1.27l1.09,-1.86l1.06,-0.63l0.1,-0.42l-0.28,-0.46l0.93,-1.24l1.36,-0.8l1.16,0.27l0.14,0.0l2.1,-0.48l0.23,-0.3l-0.05,-1.3l-0.18,-0.26l-1.08,-0.49l0.44,-0.12l1.52,0.58l1.39,1.06l2.11,0.65l0.19,-0.0l0.59,-0.21l1.44,0.72l0.27,0.0l1.37,-0.68l0.84,0.2l0.26,-0.06l0.37,-0.3l0.82,0.89l-0.56,1.14l-0.84,0.91l-0.75,0.07l-0.26,0.38l0.26,0.9l-0.67,1.15l-0.88,1.24l-0.05,0.25l0.18,0.72l0.12,0.17l1.99,1.42l1.96,0.84l1.25,0.86l1.8,1.51l0.19,0.07l0.63,-0.0l1.15,0.58l0.34,0.7l0.17,0.15l2.39,0.88l0.24,-0.02l1.65,-0.88l0.14,-0.16l0.49,-1.37l0.52,-1.19l0.31,-1.39l0.75,-2.02l0.01,-0.19l-0.33,-1.16l0.16,-0.67l0.0,-0.13l-0.28,-1.41l0.3,-1.78l0.42,-0.45l0.05,-0.33l-0.33,-0.73l0.56,-1.25l0.48,-1.39l0.07,-0.69l0.58,-0.59l0.48,0.84l0.17,1.53l0.17,0.24l0.47,0.23l0.09,0.9l0.05,0.14l0.87,1.23l0.17,1.33l-0.09,0.89l0.03,0.15l0.9,2.0l0.43,0.13l1.38,-0.83l0.71,0.92l1.06,0.88l-0.22,0.96l0.0,0.14l0.53,2.2l0.38,1.3l0.15,0.18l0.52,0.26l0.62,2.01l-0.23,1.27l0.02,0.18l0.81,1.76l0.14,0.14l2.69,1.35l3.21,2.21l-0.2,0.4l0.04,0.34l1.39,1.6l0.95,2.78l0.43,0.16l0.79,-0.46l0.85,0.96l0.39,0.05l0.22,-0.15l0.36,2.33l0.09,0.18l1.78,1.63l1.16,1.01l1.9,2.1l0.67,2.05l0.06,1.47l-0.17,1.64l0.03,0.17l1.16,2.22l-0.14,2.28l-0.43,1.24l-0.68,2.44l0.04,1.63l-0.48,1.92l-1.06,2.43l-1.79,1.32l-0.1,0.12l-0.91,2.15l-0.82,1.37l-0.76,2.47l-0.98,1.46l-0.63,2.14l-0.33,2.02l0.1,0.82l-1.21,0.85l-2.71,0.1l-0.13,0.03l-2.31,1.19l-1.21,1.17l-1.34,1.11l-1.89,-1.18l-1.33,-0.46l0.32,-1.24l-0.4,-0.35l-1.46,0.61l-2.06,1.98l-1.99,-0.73l-1.43,-0.46l-1.45,-0.22l-2.32,-0.81l-1.51,-1.67l-0.45,-2.11l-0.6,-1.5l-0.07,-0.11l-1.23,-1.16l-0.16,-0.08l-1.96,-0.28l0.59,-0.99l0.03,-0.24l-0.61,-2.1l-0.54,-0.08l-1.16,1.85l-1.23,0.29l0.73,-0.88l0.06,-0.12l0.37,-1.57l0.93,-1.33l0.05,-0.2l-0.2,-2.07l-0.53,-0.17l-2.01,2.35l-1.52,0.94l-0.12,0.14l-0.82,1.93l-1.5,-0.9l0.07,-1.32l-0.06,-0.2l-1.57,-2.04l-1.15,-0.92l0.3,-0.41l-0.1,-0.44l-3.21,-1.69l-0.13,-0.03l-1.69,-0.08l-2.35,-1.31l-0.16,-0.04l-4.55,0.27l-3.24,0.99l-2.8,0.91l-2.33,-0.18l-0.17,0.03l-2.63,1.41l-2.14,0.64l-0.2,0.19l-0.47,1.42l-0.8,0.99l-1.99,0.06l-1.55,0.24l-2.27,-0.5l-1.79,0.3l-1.71,0.13l-0.19,0.09l-1.38,1.39l-0.58,-0.1l-0.21,0.04l-1.26,0.8l-1.13,0.85l-1.72,-0.1l-1.6,-0.0l-2.58,-1.76l-1.21,-0.49l0.04,-1.19l1.04,-0.32l0.16,-0.12l0.42,-0.64l0.05,-0.19l-0.09,-0.97l0.3,-2.0l-0.28,-1.64l-1.34,-2.84l-0.39,-1.49l0.1,-1.51l-0.04,-0.17l-0.96,-1.72l-0.06,-0.73l-0.09,-0.19l-1.04,-1.01l-0.3,-2.02l-0.05,-0.12l-1.23,-1.83ZM784.95,393.35l2.39,1.01l0.2,0.01l3.26,-0.96l1.19,0.16l0.16,3.19l-0.78,0.95l-0.07,0.16l-0.19,1.83l-0.43,-0.41l-0.44,0.03l-1.61,1.96l-0.4,-0.12l-1.38,-0.09l-1.43,-2.42l-0.37,-2.03l-1.4,-2.53l0.04,-0.94l1.27,0.2Z", "name": "Australia"}, "IL": {"path": "M509.04,199.22l0.71,0.0l0.27,-0.17l0.15,-0.33l0.19,-0.01l0.02,0.73l-0.27,0.34l0.02,0.08l-0.32,0.62l-0.65,-0.27l-0.41,0.19l-0.52,1.85l0.16,0.35l0.14,0.07l-0.17,0.1l-0.14,0.21l-0.11,0.73l0.39,0.33l0.81,-0.26l0.03,0.64l-0.97,3.43l-1.28,-3.67l0.62,-0.78l-0.03,-0.41l0.58,-1.16l0.5,-2.07l0.27,-0.54Z", "name": "Israel"}, "IN": {"path": "M615.84,192.58l2.4,2.97l-0.24,2.17l0.05,0.2l0.94,1.35l-0.06,0.97l-1.46,-0.3l-0.35,0.36l0.7,3.06l0.12,0.18l2.46,1.75l3.11,1.72l-1.23,0.96l-0.1,0.13l-0.97,2.55l0.16,0.38l2.41,1.02l2.37,1.33l3.27,1.52l3.43,0.37l1.37,1.3l0.17,0.08l1.92,0.25l3.0,0.62l2.15,-0.04l0.28,-0.22l0.29,-1.06l0.0,-0.13l-0.32,-1.66l0.16,-0.94l1.0,-0.37l0.23,2.28l0.18,0.24l2.28,1.02l0.2,0.02l1.52,-0.41l2.06,0.18l2.08,-0.08l0.29,-0.27l0.18,-1.66l-0.1,-0.26l-0.53,-0.44l1.38,-0.23l0.15,-0.07l2.26,-2.0l2.75,-1.65l1.97,0.63l0.25,-0.03l1.54,-0.99l0.89,1.28l-0.72,0.97l0.2,0.48l2.49,0.37l0.11,0.61l-0.69,0.39l-0.15,0.3l0.15,1.22l-1.36,-0.37l-0.23,0.03l-3.24,1.86l-0.15,0.28l0.07,1.44l-1.33,2.16l-0.04,0.13l-0.12,1.24l-0.98,1.91l-1.72,-0.53l-0.39,0.28l-0.09,2.66l-0.52,0.83l-0.04,0.23l0.21,0.89l-0.71,0.36l-1.21,-3.85l-0.29,-0.21l-0.69,0.01l-0.29,0.23l-0.28,1.17l-0.84,-0.84l0.6,-1.17l0.97,-0.13l0.23,-0.16l1.15,-2.25l-0.18,-0.42l-1.54,-0.47l-2.3,0.04l-2.13,-0.33l-0.19,-1.63l-0.26,-0.26l-1.13,-0.13l-1.93,-1.13l-0.42,0.13l-0.88,1.82l0.08,0.37l1.47,1.15l-1.21,0.77l-0.1,0.1l-0.56,0.97l0.13,0.42l1.31,0.61l-0.36,1.35l0.01,0.2l0.85,1.95l0.37,2.05l-0.26,0.68l-1.55,-0.02l-3.09,0.54l-0.25,0.32l0.13,1.84l-1.21,1.4l-3.64,1.79l-2.79,3.04l-1.86,1.61l-2.48,1.68l-0.13,0.25l-0.0,1.0l-1.07,0.55l-2.21,0.9l-1.13,0.13l-0.25,0.19l-0.75,1.96l-0.02,0.15l0.52,3.31l0.13,2.03l-1.03,2.35l-0.03,0.12l-0.01,4.03l-1.02,0.1l-0.23,0.15l-1.14,1.93l0.04,0.36l0.44,0.48l-1.83,0.57l-0.18,0.15l-0.81,1.65l-0.74,0.53l-2.14,-2.12l-1.14,-3.47l-0.96,-2.57l-0.9,-1.26l-1.3,-2.38l-0.61,-3.14l-0.44,-1.62l-2.29,-3.56l-1.03,-4.94l-0.74,-3.29l0.01,-3.12l-0.49,-2.51l-0.41,-0.22l-3.56,1.53l-1.59,-0.28l-2.96,-2.87l0.94,-0.74l0.06,-0.41l-0.74,-1.03l-2.73,-2.1l1.35,-1.43l5.38,0.01l0.29,-0.36l-0.5,-2.29l-0.09,-0.15l-1.33,-1.28l-0.27,-1.96l-0.12,-0.2l-1.36,-1.0l2.42,-2.48l2.77,0.2l0.24,-0.1l2.62,-2.85l1.59,-2.8l2.41,-2.74l0.07,-0.2l-0.04,-1.82l2.01,-1.51l-0.01,-0.49l-1.95,-1.33l-0.83,-1.81l-0.82,-2.27l0.98,-0.97l3.64,0.66l2.89,-0.42l0.17,-0.08l2.18,-2.15Z", "name": "India"}, "TZ": {"path": "M505.77,287.58l0.36,0.23l8.95,5.03l0.15,1.3l0.13,0.21l3.4,2.37l-1.07,2.88l-0.02,0.14l0.15,1.42l0.15,0.23l1.47,0.84l0.05,0.42l-0.66,1.44l-0.02,0.18l0.13,0.72l-0.16,1.16l0.03,0.19l0.87,1.57l1.03,2.48l0.12,0.14l0.53,0.32l-1.59,1.18l-2.64,0.95l-1.45,-0.04l-0.2,0.07l-0.81,0.69l-1.64,0.06l-0.68,0.3l-2.9,-0.69l-1.71,0.17l-0.65,-3.18l-0.05,-0.12l-1.35,-1.88l-0.19,-0.12l-2.41,-0.46l-1.38,-0.74l-1.63,-0.44l-0.96,-0.41l-0.95,-0.58l-1.31,-3.09l-1.47,-1.46l-0.45,-1.31l0.24,-1.34l-0.39,-1.99l0.71,-0.08l0.18,-0.09l0.91,-0.91l0.98,-1.31l0.59,-0.5l0.11,-0.24l-0.02,-0.81l-0.08,-0.2l-0.47,-0.5l-0.1,-0.67l0.51,-0.23l0.18,-0.25l0.14,-1.47l-0.05,-0.2l-0.76,-1.09l0.45,-0.15l2.71,0.03l5.01,-0.19Z", "name": "Tanzania"}, "AZ": {"path": "M539.36,175.66l0.16,0.09l1.11,0.2l0.32,-0.15l0.4,-0.71l1.22,-0.99l1.11,1.33l1.26,2.09l0.22,0.14l1.06,0.13l0.28,0.29l-1.46,0.17l-0.26,0.24l-0.43,2.26l-0.39,0.92l-0.85,0.63l-0.12,0.25l0.06,1.2l-0.22,0.05l-1.28,-1.25l0.74,-1.25l-0.03,-0.35l-0.74,-0.86l-0.3,-0.1l-1.05,0.27l-2.49,1.82l-0.04,-1.46l-0.18,-0.27l-1.09,-0.47l-0.8,-0.6l0.53,-0.7l-0.06,-0.42l-1.11,-0.84l0.34,-0.51l-0.11,-0.43l-0.89,-0.48l-0.33,-0.49l0.25,-0.2l1.78,0.81l1.35,0.18l0.25,-0.09l0.34,-0.35l0.02,-0.39l-1.04,-1.36l0.28,-0.18l0.49,0.07l1.65,1.74ZM533.53,180.16l0.63,0.67l0.22,0.09l0.8,-0.0l0.04,0.31l0.66,1.09l-0.94,-0.21l-1.16,-1.24l-0.25,-0.71Z", "name": "Azerbaijan"}, "IE": {"path": "M405.17,135.35l0.36,2.16l-1.78,2.84l-4.28,1.91l-3.02,-0.43l1.81,-3.13l0.02,-0.26l-1.23,-3.26l3.24,-2.56l1.54,-1.32l0.37,1.33l-0.49,1.77l0.3,0.38l1.49,-0.05l1.68,0.63Z", "name": "Ireland"}, "ID": {"path": "M756.56,287.86l0.69,4.02l0.15,0.21l2.59,1.5l0.39,-0.07l2.05,-2.61l2.75,-1.45l2.09,-0.0l2.08,0.85l1.85,0.89l2.52,0.46l0.08,15.44l-1.72,-1.6l-0.15,-0.07l-2.54,-0.51l-0.29,0.1l-0.53,0.62l-2.53,0.06l0.78,-1.51l1.48,-0.66l0.17,-0.34l-0.65,-2.74l-1.23,-2.19l-0.14,-0.13l-4.85,-2.13l-2.09,-0.23l-3.7,-2.28l-0.41,0.1l-0.67,1.11l-0.63,0.14l-0.41,-0.67l-0.01,-1.01l-0.14,-0.25l-1.39,-0.89l2.05,-0.69l1.73,0.05l0.29,-0.39l-0.21,-0.66l-0.29,-0.21l-3.5,-0.0l-0.9,-1.36l-0.19,-0.13l-2.14,-0.44l-0.65,-0.76l2.86,-0.51l1.28,-0.79l3.75,0.96l0.32,0.76ZM758.01,300.37l-0.79,1.04l-0.14,-1.07l0.4,-0.81l0.29,-0.47l0.24,0.31l-0.0,1.0ZM747.45,292.9l0.48,1.02l-1.45,-0.69l-2.09,-0.21l-1.45,0.16l-1.28,-0.07l0.35,-0.81l2.86,-0.1l2.58,0.68ZM741.15,285.69l-0.16,-0.25l-0.72,-3.08l0.47,-1.86l0.35,-0.38l0.1,0.73l0.25,0.26l1.28,0.19l0.18,0.78l-0.11,1.8l-0.96,-0.18l-0.35,0.22l-0.38,1.52l0.05,0.24ZM741.19,285.75l0.76,0.97l-0.11,0.05l-0.65,-1.02ZM739.18,293.52l-0.61,0.54l-1.44,-0.38l-0.25,-0.55l1.93,-0.09l0.36,0.48ZM728.4,295.87l-0.27,-0.07l-2.26,0.89l-0.37,-0.41l0.27,-0.8l-0.09,-0.33l-1.68,-1.37l0.17,-2.29l-0.42,-0.3l-1.67,0.76l-0.17,0.29l0.21,2.92l0.09,3.34l-1.22,0.28l-0.78,-0.54l0.65,-2.1l0.01,-0.14l-0.39,-2.42l-0.29,-0.25l-0.86,-0.02l-0.63,-1.4l0.99,-1.61l0.35,-1.97l1.24,-3.73l0.49,-0.96l1.95,-1.7l1.86,0.69l3.16,0.35l2.92,-0.1l0.17,-0.06l2.24,-1.65l0.11,0.14l-1.8,2.22l-1.72,0.44l-2.41,-0.48l-4.21,0.13l-2.19,0.36l-0.25,0.24l-0.36,1.9l0.08,0.27l2.24,2.23l0.4,0.02l1.29,-1.08l3.19,-0.58l-0.19,0.06l-1.04,1.4l-2.13,0.94l-0.12,0.45l2.26,3.06l-0.37,0.69l0.03,0.32l1.51,1.95ZM728.48,295.97l0.59,0.76l-0.02,1.37l-1.0,0.55l-0.64,-0.58l1.09,-1.84l-0.02,-0.26ZM728.64,286.95l0.79,-0.14l-0.07,0.39l-0.72,-0.24ZM732.38,310.1l-1.89,0.49l-0.06,-0.06l0.17,-0.64l1.0,-1.42l2.14,-0.87l0.1,0.2l0.04,0.58l-1.49,1.72ZM728.26,305.71l-0.17,0.63l-3.53,0.67l-3.02,-0.28l-0.0,-0.42l1.66,-0.44l1.47,0.71l0.16,0.03l1.75,-0.21l1.69,-0.69ZM722.98,310.33l-0.74,0.03l-2.52,-1.35l1.42,-0.3l1.19,0.7l0.72,0.63l-0.06,0.28ZM716.24,305.63l0.66,0.49l0.22,0.06l1.35,-0.18l0.31,0.53l-4.18,0.77l-0.8,-0.01l0.51,-0.86l1.2,-0.02l0.24,-0.12l0.49,-0.65ZM715.84,280.21l0.09,0.34l2.25,1.86l-2.25,0.22l-0.24,0.17l-0.84,1.71l-0.03,0.15l0.1,2.11l-2.27,1.62l-0.13,0.24l-0.06,2.46l-0.74,2.92l-0.02,-0.05l-0.39,-0.16l-2.62,1.04l-0.86,-1.33l-0.23,-0.14l-1.71,-0.14l-1.19,-0.76l-0.25,-0.03l-2.78,0.84l-0.79,-1.05l-0.26,-0.12l-1.61,0.13l-1.8,-0.25l-0.36,-3.13l-0.15,-0.23l-1.18,-0.65l-1.13,-2.02l-0.33,-2.1l0.27,-2.19l1.05,-1.17l0.28,1.12l0.1,0.16l1.71,1.41l0.28,0.05l1.55,-0.49l1.54,0.17l0.23,-0.07l1.4,-1.21l1.05,-0.19l2.3,0.68l0.16,0.0l2.04,-0.53l0.21,-0.19l1.26,-3.41l0.91,-0.82l0.09,-0.14l0.8,-2.64l2.63,0.0l1.71,0.33l-1.19,1.89l0.02,0.34l1.74,2.24l-0.37,1.0ZM692.67,302.0l0.26,0.19l4.8,0.25l0.28,-0.16l0.44,-0.83l4.29,1.12l0.85,1.52l0.23,0.15l3.71,0.45l2.37,1.15l-2.06,0.69l-2.77,-1.0l-2.25,0.07l-2.57,-0.18l-2.31,-0.45l-2.94,-0.97l-1.84,-0.25l-0.13,0.01l-0.97,0.29l-4.34,-0.98l-0.38,-0.94l-0.25,-0.19l-1.76,-0.14l1.31,-1.84l2.81,0.14l1.97,0.96l0.95,0.19l0.28,0.74ZM685.63,299.27l-2.36,0.04l-2.07,-2.05l-3.17,-2.02l-1.06,-1.5l-1.88,-2.02l-1.22,-1.85l-1.9,-3.49l-2.2,-2.11l-0.71,-2.08l-0.94,-1.99l-0.1,-0.12l-2.21,-1.54l-1.35,-2.17l-1.86,-1.39l-2.53,-2.68l-0.14,-0.81l1.22,0.08l3.76,0.47l2.16,2.4l1.94,1.7l1.37,1.04l2.35,2.67l0.22,0.1l2.44,0.04l1.99,1.62l1.42,2.06l0.09,0.09l1.67,1.0l-0.88,1.8l0.11,0.39l1.44,0.87l0.13,0.04l0.68,0.05l0.41,1.62l0.87,1.4l0.22,0.14l1.71,0.21l1.06,1.38l-0.61,3.04l-0.09,3.6Z", "name": "Indonesia"}, "UA": {"path": "M500.54,141.42l0.9,0.13l0.27,-0.11l0.52,-0.62l0.68,0.13l2.43,-0.3l1.32,1.57l-0.45,0.48l-0.07,0.26l0.21,1.03l0.27,0.24l1.85,0.15l0.76,1.22l-0.05,0.55l0.2,0.31l3.18,1.15l0.18,0.01l1.75,-0.47l1.42,1.41l0.22,0.09l1.42,-0.03l3.44,0.99l0.02,0.65l-0.97,1.62l-0.03,0.24l0.52,1.67l-0.29,0.79l-2.24,0.22l-0.14,0.05l-1.29,0.89l-0.13,0.23l-0.07,1.16l-1.75,0.22l-0.12,0.04l-1.6,0.98l-2.27,0.16l-0.12,0.04l-2.16,1.17l-0.16,0.29l0.15,1.94l0.14,0.23l1.23,0.75l0.18,0.04l2.06,-0.15l-0.22,0.51l-2.67,0.54l-3.27,1.72l-1.0,-0.45l0.45,-1.19l-0.19,-0.39l-2.34,-0.78l0.15,-0.2l2.32,-1.0l0.09,-0.49l-0.73,-0.72l-0.15,-0.08l-3.69,-0.75l-0.14,-0.96l-0.35,-0.25l-2.32,0.39l-0.21,0.15l-0.91,1.7l-1.77,2.1l-0.93,-0.44l-0.24,-0.0l-1.05,0.45l-0.48,-0.25l0.13,-0.07l0.14,-0.15l0.43,-1.04l0.67,-0.97l0.04,-0.26l-0.1,-0.31l0.04,-0.02l0.11,0.19l0.24,0.15l1.48,0.09l0.78,-0.25l0.07,-0.53l-0.27,-0.19l0.09,-0.25l-0.08,-0.33l-0.81,-0.74l-0.34,-1.24l-0.14,-0.18l-0.73,-0.42l0.15,-0.87l-0.11,-0.29l-1.13,-0.86l-0.15,-0.06l-0.97,-0.11l-1.79,-0.97l-0.2,-0.03l-1.66,0.32l-0.13,0.06l-0.52,0.41l-0.95,-0.0l-0.23,0.11l-0.56,0.66l-1.74,0.29l-0.79,0.43l-1.01,-0.68l-0.16,-0.05l-1.57,-0.01l-1.52,-0.35l-0.23,0.04l-0.71,0.45l-0.09,-0.43l-0.13,-0.19l-1.18,-0.74l0.38,-1.02l0.53,-0.64l0.35,0.12l0.37,-0.41l-0.57,-1.29l2.1,-2.5l1.16,-0.36l0.2,-0.2l0.27,-0.92l-0.01,-0.2l-1.1,-2.52l0.79,-0.09l0.13,-0.05l1.3,-0.86l1.83,-0.07l2.48,0.26l2.84,0.8l1.91,0.06l0.88,0.45l0.29,-0.01l0.72,-0.44l0.49,0.58l0.25,0.11l2.2,-0.16l0.94,0.3l0.39,-0.26l0.15,-1.57l0.61,-0.59l2.01,-0.19Z", "name": "Ukraine"}, "QA": {"path": "M548.47,221.47l-0.15,-1.72l0.59,-1.23l0.38,-0.16l0.54,0.6l0.04,1.4l-0.47,1.37l-0.41,0.11l-0.53,-0.37Z", "name": "Qatar"}, "MZ": {"path": "M507.71,314.14l1.65,-0.18l2.96,0.7l0.2,-0.02l0.6,-0.29l1.68,-0.06l0.18,-0.07l0.8,-0.69l1.5,0.02l2.74,-0.98l1.74,-1.27l0.25,0.7l-0.1,2.47l0.31,2.27l0.1,3.97l0.42,1.24l-0.7,1.71l-0.94,1.73l-1.52,1.52l-5.06,2.21l-2.88,2.8l-1.01,0.51l-1.72,1.81l-0.99,0.58l-0.15,0.23l-0.21,1.86l0.04,0.19l1.17,1.95l0.47,1.47l0.03,0.74l0.39,0.28l0.05,-0.01l-0.06,2.13l-0.39,1.19l0.1,0.33l0.42,0.32l-0.28,0.83l-0.95,0.86l-2.03,0.88l-3.08,1.49l-1.1,0.99l-0.09,0.28l0.21,1.13l0.21,0.23l0.38,0.11l-0.14,0.89l-1.39,-0.02l-0.17,-0.94l-0.38,-1.23l-0.2,-0.89l0.44,-2.91l-0.01,-0.14l-0.65,-1.88l-1.15,-3.55l2.52,-2.85l0.68,-1.89l0.29,-0.18l0.14,-0.2l0.28,-1.53l-0.03,-0.19l-0.36,-0.7l0.1,-1.83l0.49,-1.84l-0.01,-3.26l-0.14,-0.25l-1.3,-0.83l-0.11,-0.04l-1.08,-0.17l-0.47,-0.55l-0.1,-0.08l-1.16,-0.54l-0.13,-0.03l-1.83,0.04l-0.32,-2.25l7.19,-1.99l1.32,1.12l0.29,0.06l0.55,-0.19l0.75,0.49l0.11,0.81l-0.49,1.11l-0.02,0.15l0.19,1.81l0.09,0.18l1.63,1.59l0.48,-0.1l0.72,-1.68l0.99,-0.49l0.17,-0.29l-0.21,-3.29l-0.04,-0.13l-1.11,-1.92l-0.9,-0.82l-0.21,-0.08l-0.62,0.03l-0.63,-2.98l0.61,-1.67Z", "name": "Mozambique"}}, "height": 440.7063107441331, "projection": {"type": "mill", "centralMeridian": 11.5}, "width": 900.0});
/*         ______________________________________
  ________|                                      |_______
  \       |           SmartAdmin WebApp          |      /
   \      |      Copyright © 2014 MyOrange       |     /
   /      |______________________________________|     \
  /__________)                                (_________\

 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * =======================================================================
 * SmartAdmin is FULLY owned and LICENSED by MYORANGE INC.
 * This script may NOT be RESOLD or REDISTRUBUTED under any
 * circumstances, and is only to be used with this purchased
 * copy of SmartAdmin Template.
 * =======================================================================
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * =======================================================================
 * original filename: app.config.js
 * filesize: ??
 * author: Sunny (@bootstraphunt)
 * email: info@myorange.ca
 * =======================================================================
 *
 * APP CONFIGURATION (HTML/AJAX/PHP Versions ONLY)
 * Description: Enable / disable certain theme features here
 * GLOBAL: Your left nav in your app will no longer fire ajax calls, set 
 * it to false for HTML version
 */	
	$.navAsAjax = true; 
/*
 * GLOBAL: Sound Config
 */
	$.sound_path = "/bundles/app/client_admin/sound/";
	$.sound_on = true; 
/*
 * Impacts the responce rate of some of the responsive elements (lower 
 * value affects CPU but improves speed)
 */
	var throttle_delay = 350,
/*
 * The rate at which the menu expands revealing child elements on click
 */
	menu_speed = 235,	
/*
 * Turn on JarvisWidget functionality
 * dependency: js/jarviswidget/jarvis.widget.min.js
 */
	enableJarvisWidgets = true,
/*
 * Warning: Enabling mobile widgets could potentially crash your webApp 
 * if you have too many widgets running at once 
 * (must have enableJarvisWidgets = true)
 */
	enableMobileWidgets = false,	
/*
 * Turn on fast click for mobile devices?
 * Enable this to activate fastclick plugin
 * dependency: js/plugin/fastclick/fastclick.js 
 */
	fastClick = false,
/*
 * These elements are ignored during DOM object deletion for ajax version 
 * It will delete all objects during page load with these exceptions:
 */
	ignore_key_elms = ["#header, #left-panel, #main, div.page-footer, #shortcut, #divSmallBoxes, #divMiniIcons, #divbigBoxes, #voiceModal, script"],
/*
 * VOICE COMMAND CONFIG
 * dependency: voicecommand.js
 */
	voice_command = true,
/*
 * Turns on speech without asking
 */	
	voice_command_auto = false,
/*
 * 	Sets the language to the default 'en-US'. (supports over 50 languages 
 * 	by google)
 * 
 *  Afrikaans         ['af-ZA']
 *  Bahasa Indonesia  ['id-ID']
 *  Bahasa Melayu     ['ms-MY']
 *  Català            ['ca-ES']
 *  Čeština           ['cs-CZ']
 *  Deutsch           ['de-DE']
 *  English           ['en-AU', 'Australia']
 *                    ['en-CA', 'Canada']
 *                    ['en-IN', 'India']
 *                    ['en-NZ', 'New Zealand']
 *                    ['en-ZA', 'South Africa']
 *                    ['en-GB', 'United Kingdom']
 *                    ['en-US', 'United States']
 *  Español           ['es-AR', 'Argentina']
 *                    ['es-BO', 'Bolivia']
 *                    ['es-CL', 'Chile']
 *                    ['es-CO', 'Colombia']
 *                    ['es-CR', 'Costa Rica']
 *                    ['es-EC', 'Ecuador']
 *                    ['es-SV', 'El Salvador']
 *                    ['es-ES', 'España']
 *                    ['es-US', 'Estados Unidos']
 *                    ['es-GT', 'Guatemala']
 *                    ['es-HN', 'Honduras']
 *                    ['es-MX', 'México']
 *                    ['es-NI', 'Nicaragua']
 *                    ['es-PA', 'Panamá']
 *                    ['es-PY', 'Paraguay']
 *                    ['es-PE', 'Perú']
 *                    ['es-PR', 'Puerto Rico']
 *                    ['es-DO', 'República Dominicana']
 *                    ['es-UY', 'Uruguay']
 *                    ['es-VE', 'Venezuela']
 *  Euskara           ['eu-ES']
 *  Français          ['fr-FR']
 *  Galego            ['gl-ES']
 *  Hrvatski          ['hr_HR']
 *  IsiZulu           ['zu-ZA']
 *  Íslenska          ['is-IS']
 *  Italiano          ['it-IT', 'Italia']
 *                    ['it-CH', 'Svizzera']
 *  Magyar            ['hu-HU']
 *  Nederlands        ['nl-NL']
 *  Norsk bokmål      ['nb-NO']
 *  Polski            ['pl-PL']
 *  Português         ['pt-BR', 'Brasil']
 *                    ['pt-PT', 'Portugal']
 *  Română            ['ro-RO']
 *  Slovenčina        ['sk-SK']
 *  Suomi             ['fi-FI']
 *  Svenska           ['sv-SE']
 *  Türkçe            ['tr-TR']
 *  български         ['bg-BG']
 *  Pусский           ['ru-RU']
 *  Српски            ['sr-RS']
 *  한국어          ['ko-KR']
 *  中文                            ['cmn-Hans-CN', '普通话 (中国大陆)']
 *                    ['cmn-Hans-HK', '普通话 (香港)']
 *                    ['cmn-Hant-TW', '中文 (台灣)']
 *                    ['yue-Hant-HK', '粵語 (香港)']
 *  日本語                         ['ja-JP']
 *  Lingua latīna     ['la']
 */
	voice_command_lang = 'en-US',
/*
 * 	Use localstorage to remember on/off (best used with HTML Version)
 */	
	voice_localStorage = false;
/*
 * Voice Commands
 * Defines all voice command variables and functions
 */	
 	if (voice_command) {
	 		
		var commands = {
					
			'show dashboard' : function() { window.location.hash = "dashboard" },
			'show inbox' : function() {  window.location.hash = "inbox" },
			'show graphs' : function() {  window.location.hash = "graphs/flot" },
			'show flotchart' : function() { window.location.hash = "graphs/flot" },
			'show morris chart' : function() { window.location.hash = "graphs/morris" },
			'show inline chart' : function() { window.location.hash = "graphs/inline-charts" },
			'show dygraphs' : function() { window.location.hash = "graphs/dygraphs" },
			'show tables' : function() { window.location.hash = "tables/table" },
			'show data table' : function() { window.location.hash = "tables/datatable" },
			'show jquery grid' : function() { window.location.hash = "tables/jqgrid" },
			'show form' : function() { window.location.hash = "forms/form-elements" },
			'show form layouts' : function() { window.location.hash = "forms/form-templates" },
			'show form validation' : function() { window.location.hash = "forms/validation" },
			'show form elements' : function() { window.location.hash = "forms/bootstrap-forms" },
			'show form plugins' : function() { window.location.hash = "forms/plugins" },
			'show form wizards' : function() { window.location.hash = "forms/wizards" },
			'show bootstrap editor' : function() { window.location.hash = "forms/other-editors" },
			'show dropzone' : function() { window.location.hash = "forms/dropzone" },
			'show image cropping' : function() { window.location.hash = "forms/image-editor" },
			'show general elements' : function() { window.location.hash = "ui/general-elements" },
			'show buttons' : function() { window.location.hash = "ui/buttons" },
			'show fontawesome' : function() { window.location.hash = "ui/icons/fa" },
			'show glyph icons' : function() { window.location.hash = "ui/icons/glyph" },
			'show flags' : function() { window.location.hash = "ui/icons/flags" },
			'show grid' : function() { window.location.hash = "ui/grid" },
			'show tree view' : function() { window.location.hash = "ui/treeview" },
			'show nestable lists' : function() { window.location.hash = "ui/nestable-list" },
			'show jquery U I' : function() { window.location.hash = "ui/jqui" },
			'show typography' : function() { window.location.hash = "ui/typography" },
			'show calendar' : function() { window.location.hash = "calendar" },
			'show widgets' : function() { window.location.hash = "widgets" },
			'show gallery' : function() { window.location.hash = "gallery" },
			'show maps' : function() { window.location.hash = "gmap-xml" },
			'go back' :  function() { history.back(1); }, 
			'scroll up' : function () { $('html, body').animate({ scrollTop: 0 }, 100); },
			'scroll down' : function () { $('html, body').animate({ scrollTop: $(document).height() }, 100);},
			'hide navigation' : function() { 
				if ($.root_.hasClass("container") && !$.root_.hasClass("menu-on-top")){
					$('span.minifyme').trigger("click");
				} else {
					$('#hide-menu > span > a').trigger("click"); 
				}
			},
			'show navigation' : function() { 
				if ($.root_.hasClass("container") && !$.root_.hasClass("menu-on-top")){
					$('span.minifyme').trigger("click");
				} else {
					$('#hide-menu > span > a').trigger("click"); 
				}
			},
			'mute' : function() {
				$.sound_on = false;
				$.smallBox({
					title : "MUTE",
					content : "All sounds have been muted!",
					color : "#a90329",
					timeout: 4000,
					icon : "fa fa-volume-off"
				});
			},
			'sound on' : function() {
				$.sound_on = true;
				$.speechApp.playConfirmation();
				$.smallBox({
					title : "UNMUTE",
					content : "All sounds have been turned on!",
					color : "#40ac2b",
					sound_file: 'voice_alert',
					timeout: 5000,
					icon : "fa fa-volume-up"
				});
			},
			'stop' : function() {
				smartSpeechRecognition.abort();
				$.root_.removeClass("voice-command-active");
				$.smallBox({
					title : "VOICE COMMAND OFF",
					content : "Your voice commands has been successfully turned off. Click on the <i class='fa fa-microphone fa-lg fa-fw'></i> icon to turn it back on.",
					color : "#40ac2b",
					sound_file: 'voice_off',
					timeout: 8000,
					icon : "fa fa-microphone-slash"
				});
				if ($('#speech-btn .popover').is(':visible')) {
					$('#speech-btn .popover').fadeOut(250);
				}
			},
			'help' : function() {
				$('#voiceModal').removeData('modal').modal( { remote: "ajax/modal-content/modal-voicecommand.html", show: true } );
				if ($('#speech-btn .popover').is(':visible')) {
					$('#speech-btn .popover').fadeOut(250);
				}
			},		
			'got it' : function() {
				$('#voiceModal').modal('hide');
			},	
			'logout' : function() {
				$.speechApp.stop();
				window.location = $('#logout > span > a').attr("href");
			}
		}; 
		
	};
/*
 * END APP.CONFIG
 */
 
 
 
 
 
 	
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a){function b(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var c,d=a.ui.mouse.prototype,e=d._mouseInit;d._touchStart=function(a){var d=this;!c&&d._mouseCapture(a.originalEvent.changedTouches[0])&&(c=!0,d._touchMoved=!1,b(a,"mouseover"),b(a,"mousemove"),b(a,"mousedown"))},d._touchMove=function(a){c&&(this._touchMoved=!0,b(a,"mousemove"))},d._touchEnd=function(a){c&&(b(a,"mouseup"),b(a,"mouseout"),this._touchMoved||b(a,"click"),c=!1)},d._mouseInit=function(){var b=this;b.element.bind("touchstart",a.proxy(b,"_touchStart")).bind("touchmove",a.proxy(b,"_touchMove")).bind("touchend",a.proxy(b,"_touchEnd")),e.call(b)}}}(jQuery);
/*! SmartAdmin - v1.4.1 - 2014-06-27 */if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.2.0",d.prototype.close=function(b){function c(){f.detach().trigger("closed.bs.alert").remove()}var d=a(this),e=d.attr("data-target");e||(e=d.attr("href"),e=e&&e.replace(/.*(?=#[^\s]*$)/,""));var f=a(e);b&&b.preventDefault(),f.length||(f=d.hasClass("alert")?d:d.parent()),f.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one("bsTransitionEnd",c).emulateTransitionEnd(150):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.2.0",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),d[e](null==f[b]?this.options[b]:f[b]),setTimeout(a.proxy(function(){"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")&&(c.prop("checked")&&this.$element.hasClass("active")?a=!1:b.find(".active").removeClass("active")),a&&c.prop("checked",!this.$element.hasClass("active")).trigger("change")}a&&this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),c.preventDefault()})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b).on("keydown.bs.carousel",a.proxy(this.keydown,this)),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=this.sliding=this.interval=this.$active=this.$items=null,"hover"==this.options.pause&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.2.0",c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0},c.prototype.keydown=function(a){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.to=function(b){var c=this,d=this.getItemIndex(this.$active=this.$element.find(".item.active"));return b>this.$items.length-1||0>b?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){c.to(b)}):d==b?this.pause().cycle():this.slide(b>d?"next":"prev",a(this.$items[b]))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,c){var d=this.$element.find(".item.active"),e=c||d[b](),f=this.interval,g="next"==b?"left":"right",h="next"==b?"first":"last",i=this;if(!e.length){if(!this.options.wrap)return;e=this.$element.find(".item")[h]()}if(e.hasClass("active"))return this.sliding=!1;var j=e[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:g});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,f&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(e)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:g});return a.support.transition&&this.$element.hasClass("slide")?(e.addClass(b),e[0].offsetWidth,d.addClass(g),e.addClass(g),d.one("bsTransitionEnd",function(){e.removeClass([b,g].join(" ")).addClass("active"),d.removeClass(["active",g].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(1e3*d.css("transition-duration").slice(0,-1))):(d.removeClass("active"),e.addClass("active"),this.sliding=!1,this.$element.trigger(m)),f&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this},a(document).on("click.bs.carousel.data-api","[data-slide], [data-slide-to]",function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}}),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.collapse"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b);!e&&f.toggle&&"show"==b&&(b=!b),e||d.data("bs.collapse",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.transitioning=null,this.options.parent&&(this.$parent=a(this.options.parent)),this.options.toggle&&this.toggle()};c.VERSION="3.2.0",c.DEFAULTS={toggle:!0},c.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},c.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var c=a.Event("show.bs.collapse");if(this.$element.trigger(c),!c.isDefaultPrevented()){var d=this.$parent&&this.$parent.find("> .panel > .in");if(d&&d.length){var e=d.data("bs.collapse");if(e&&e.transitioning)return;b.call(d,"hide"),e||d.data("bs.collapse",null)}var f=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[f](0),this.transitioning=1;var g=function(){this.$element.removeClass("collapsing").addClass("collapse in")[f](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return g.call(this);var h=a.camelCase(["scroll",f].join("-"));this.$element.one("bsTransitionEnd",a.proxy(g,this)).emulateTransitionEnd(350)[f](this.$element[0][h])}}},c.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"),this.transitioning=1;var d=function(){this.transitioning=0,this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(d,this)).emulateTransitionEnd(350):d.call(this)}}},c.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()};var d=a.fn.collapse;a.fn.collapse=b,a.fn.collapse.Constructor=c,a.fn.collapse.noConflict=function(){return a.fn.collapse=d,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(c){var d,e=a(this),f=e.attr("data-target")||c.preventDefault()||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""),g=a(f),h=g.data("bs.collapse"),i=h?"toggle":e.data(),j=e.attr("data-parent"),k=j&&a(j);h&&h.transitioning||(k&&k.find('[data-toggle="collapse"][data-parent="'+j+'"]').not(e).addClass("collapsed"),e[g.hasClass("in")?"addClass":"removeClass"]("collapsed")),b.call(g,i)})}(jQuery),+function(a){"use strict";function b(b){b&&3===b.which||(a(e).remove(),a(f).each(function(){var d=c(a(this)),e={relatedTarget:this};d.hasClass("open")&&(d.trigger(b=a.Event("hide.bs.dropdown",e)),b.isDefaultPrevented()||d.removeClass("open").trigger("hidden.bs.dropdown",e))}))}function c(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.2.0",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=c(e),g=f.hasClass("open");if(b(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click",b);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus"),f.toggleClass("open").trigger("shown.bs.dropdown",h)}return!1}},g.prototype.keydown=function(b){if(/(38|40|27)/.test(b.keyCode)){var d=a(this);if(b.preventDefault(),b.stopPropagation(),!d.is(".disabled, :disabled")){var e=c(d),g=e.hasClass("open");if(!g||g&&27==b.keyCode)return 27==b.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.divider):visible a",i=e.find('[role="menu"]'+h+', [role="listbox"]'+h);if(i.length){var j=i.index(i.filter(":focus"));38==b.keyCode&&j>0&&j--,40==b.keyCode&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",b).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f+', [role="menu"], [role="listbox"]',g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$backdrop=this.isShown=null,this.scrollbarWidth=0,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.2.0",c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var c=this,d=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(d),this.isShown||d.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.$body.addClass("modal-open"),this.setScrollbar(),this.escape(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.backdrop(function(){var d=a.support.transition&&c.$element.hasClass("fade");c.$element.parent().length||c.$element.appendTo(c.$body),c.$element.show().scrollTop(0),d&&c.$element[0].offsetWidth,c.$element.addClass("in").attr("aria-hidden",!1),c.enforceFocus();var e=a.Event("shown.bs.modal",{relatedTarget:b});d?c.$element.find(".modal-dialog").one("bsTransitionEnd",function(){c.$element.trigger("focus").trigger(e)}).emulateTransitionEnd(300):c.$element.trigger("focus").trigger(e)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.$body.removeClass("modal-open"),this.resetScrollbar(),this.escape(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").attr("aria-hidden",!0).off("click.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(300):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keyup.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keyup.dismiss.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var c=this,d=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var e=a.support.transition&&d;if(this.$backdrop=a('<div class="modal-backdrop '+d+'" />').appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus.call(this.$element[0]):this.hide.call(this))},this)),e&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;e?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(150):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var f=function(){c.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",f).emulateTransitionEnd(150):f()}else b&&b()},c.prototype.checkScrollbar=function(){document.body.clientWidth>=window.innerWidth||(this.scrollbarWidth=this.scrollbarWidth||this.measureScrollbar())},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.scrollbarWidth&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right","")},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;(e||"destroy"!=b)&&(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null,this.init("tooltip",a,b)};c.VERSION="3.2.0",c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(this.options.viewport.selector||this.options.viewport);for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show()},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide()},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var c=a.contains(document.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!c)return;var d=this,e=this.tip(),f=this.getUID(this.type);this.setContent(),e.attr("id",f),this.$element.attr("aria-describedby",f),this.options.animation&&e.addClass("fade");var g="function"==typeof this.options.placement?this.options.placement.call(this,e[0],this.$element[0]):this.options.placement,h=/\s?auto?\s?/i,i=h.test(g);i&&(g=g.replace(h,"")||"top"),e.detach().css({top:0,left:0,display:"block"}).addClass(g).data("bs."+this.type,this),this.options.container?e.appendTo(this.options.container):e.insertAfter(this.$element);var j=this.getPosition(),k=e[0].offsetWidth,l=e[0].offsetHeight;if(i){var m=g,n=this.$element.parent(),o=this.getPosition(n);g="bottom"==g&&j.top+j.height+l-o.scroll>o.height?"top":"top"==g&&j.top-o.scroll-l<0?"bottom":"right"==g&&j.right+k>o.width?"left":"left"==g&&j.left-k<o.left?"right":g,e.removeClass(m).addClass(g)}var p=this.getCalculatedOffset(g,j,k,l);this.applyPlacement(p,g);var q=function(){d.$element.trigger("shown.bs."+d.type),d.hoverState=null};a.support.transition&&this.$tip.hasClass("fade")?e.one("bsTransitionEnd",q).emulateTransitionEnd(150):q()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top=b.top+g,b.left=b.left+h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=k.left?2*k.left-e+i:2*k.top-f+j,m=k.left?"left":"top",n=k.left?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(l,d[0][n],m)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c,a?50*(1-a/b)+"%":"")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(){function b(){"in"!=c.hoverState&&d.detach(),c.$element.trigger("hidden.bs."+c.type)}var c=this,d=this.tip(),e=a.Event("hide.bs."+this.type);return this.$element.removeAttr("aria-describedby"),this.$element.trigger(e),e.isDefaultPrevented()?void 0:(d.removeClass("in"),a.support.transition&&this.$tip.hasClass("fade")?d.one("bsTransitionEnd",b).emulateTransitionEnd(150):b(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName;return a.extend({},"function"==typeof c.getBoundingClientRect?c.getBoundingClientRect():null,{scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop(),width:d?a(window).width():b.outerWidth(),height:d?a(window).height():b.outerHeight()},d?{top:0,left:0}:b.offset())},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.width&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){return this.$tip=this.$tip||a(this.options.template)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.validate=function(){this.$element[0].parentNode||(this.hide(),this.$element=null,this.options=null)},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){clearTimeout(this.timeout),this.hide().$element.off("."+this.type).removeData("bs."+this.type)};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b;(e||"destroy"!=b)&&(e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.2.0",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").empty()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")},c.prototype.tip=function(){return this.$tip||(this.$tip=a(this.options.template)),this.$tip};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){var e=a.proxy(this.process,this);this.$body=a("body"),this.$scrollElement=a(a(c).is("body")?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",e),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.2.0",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b="offset",c=0;a.isWindow(this.$scrollElement[0])||(b="position",c=this.$scrollElement.scrollTop()),this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight();var d=this;this.$body.find(this.selector).map(function(){var d=a(this),e=d.data("target")||d.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[b]().top+c,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){d.offsets.push(this[0]),d.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<=e[0])return g!=(a=f[0])&&this.activate(a);for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(!e[a+1]||b<=e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,a(this.selector).parentsUntil(this.options.target,".active").removeClass("active");var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.2.0",c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a")[0],f=a.Event("show.bs.tab",{relatedTarget:e});if(b.trigger(f),!f.isDefaultPrevented()){var g=a(d);this.activate(b.closest("li"),c),this.activate(g,g.parent(),function(){b.trigger({type:"shown.bs.tab",relatedTarget:e})})}}},c.prototype.activate=function(b,c,d){function e(){f.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),b.addClass("active"),g?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu")&&b.closest("li.dropdown").addClass("active"),d&&d()}var f=c.find("> .active"),g=d&&a.support.transition&&f.hasClass("fade");g?f.one("bsTransitionEnd",e).emulateTransitionEnd(150):e(),f.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this},a(document).on("click.bs.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"]',function(c){c.preventDefault(),b.call(a(this),"show")})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=this.unpin=this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.2.0",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=a(document).height(),d=this.$target.scrollTop(),e=this.$element.offset(),f=this.options.offset,g=f.top,h=f.bottom;"object"!=typeof f&&(h=g=f),"function"==typeof g&&(g=f.top(this.$element)),"function"==typeof h&&(h=f.bottom(this.$element));var i=null!=this.unpin&&d+this.unpin<=e.top?!1:null!=h&&e.top+this.$element.height()>=b-h?"bottom":null!=g&&g>=d?"top":!1;if(this.affixed!==i){null!=this.unpin&&this.$element.css("top","");var j="affix"+(i?"-"+i:""),k=a.Event(j+".bs.affix");this.$element.trigger(k),k.isDefaultPrevented()||(this.affixed=i,this.unpin="bottom"==i?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(j).trigger(a.Event(j.replace("affix","affixed"))),"bottom"==i&&this.$element.offset({top:b-this.$element.height()-h}))}}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},d.offsetBottom&&(d.offset.bottom=d.offsetBottom),d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */function SmartUnLoading(){$(".divMessageBox").fadeOut(300,function(){$(this).remove()}),$(".LoadingBoxContainer").fadeOut(300,function(){$(this).remove()})}function getInternetExplorerVersion(){var a=-1;if("Microsoft Internet Explorer"==navigator.appName){var b=navigator.userAgent,c=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");null!=c.exec(b)&&(a=parseFloat(RegExp.$1))}return a}function checkVersion(){var a="You're not using Windows Internet Explorer.",b=getInternetExplorerVersion();b>-1&&(a=b>=8?"You're using a recent copy of Windows Internet Explorer.":"You should upgrade your copy of Windows Internet Explorer."),alert(a)}function isIE8orlower(){var a="0",b=getInternetExplorerVersion();return b>-1&&(a=b>=9?0:1),a}$.sound_path="/bundles/app/client_admin/sound/",$.sound_on=!0,jQuery(document).ready(function(){$("body").append("<div id='divSmallBoxes'></div>"),$("body").append("<div id='divMiniIcons'></div><div id='divbigBoxes'></div>")});var ExistMsg=0,SmartMSGboxCount=0,PrevTop=0;$.SmartMessageBox=function(a,b){var c,d;a=$.extend({title:"",content:"",NormalButton:void 0,ActiveButton:void 0,buttons:void 0,input:void 0,inputValue:void 0,placeholder:"",options:void 0},a);var e=0;if(e=1,0==isIE8orlower()){var f=document.createElement("audio");f.setAttribute("src",$.sound_path+"messagebox.mp3"),$.get(),f.addEventListener("load",function(){f.play()},!0),$.sound_on&&(f.pause(),f.play())}SmartMSGboxCount+=1,0==ExistMsg&&(ExistMsg=1,c="<div class='divMessageBox animated fadeIn fast' id='MsgBoxBack'></div>",$("body").append(c),1==isIE8orlower()&&$("#MsgBoxBack").addClass("MessageIE"));var g="",h=0;if(void 0!=a.input)switch(h=1,a.input=a.input.toLowerCase(),a.input){case"text":a.inputValue="string"===$.type(a.inputValue)?a.inputValue.replace(/'/g,"&#x27;"):a.inputValue,g="<input class='form-control' type='"+a.input+"' id='txt"+SmartMSGboxCount+"' placeholder='"+a.placeholder+"' value='"+a.inputValue+"'/><br/><br/>";break;case"password":g="<input class='form-control' type='"+a.input+"' id='txt"+SmartMSGboxCount+"' placeholder='"+a.placeholder+"'/><br/><br/>";break;case"select":if(void 0==a.options)alert("For this type of input, the options parameter is required.");else{g="<select class='form-control' id='txt"+SmartMSGboxCount+"'>";for(var i=0;i<=a.options.length-1;i++)"["==a.options[i]?j="":"]"==a.options[i]?(k+=1,j="<option>"+j+"</option>",g+=j):j+=a.options[i];g+="</select>"}break;default:alert("That type of input is not handled yet")}d="<div class='MessageBoxContainer animated fadeIn fast' id='Msg"+SmartMSGboxCount+"'>",d+="<div class='MessageBoxMiddle'>",d+="<span class='MsgTitle'>"+a.title+"</span class='MsgTitle'>",d+="<p class='pText'>"+a.content+"</p>",d+=g,d+="<div class='MessageBoxButtonSection'>",void 0==a.buttons&&(a.buttons="[Accept]"),a.buttons=$.trim(a.buttons),a.buttons=a.buttons.split("");var j="",k=0;void 0==a.NormalButton&&(a.NormalButton="#232323"),void 0==a.ActiveButton&&(a.ActiveButton="#ed145b");for(var i=0;i<=a.buttons.length-1;i++)"["==a.buttons[i]?j="":"]"==a.buttons[i]?(k+=1,j="<button id='bot"+k+"-Msg"+SmartMSGboxCount+"' class='btn btn-default btn-sm botTempo'> "+j+"</button>",d+=j):j+=a.buttons[i];d+="</div>",d+="</div>",d+="</div>",SmartMSGboxCount>1&&($(".MessageBoxContainer").hide(),$(".MessageBoxContainer").css("z-index",99999)),$(".divMessageBox").append(d),1==h&&$("#txt"+SmartMSGboxCount).focus(),$(".botTempo").hover(function(){$(this).attr("id")},function(){$(this).attr("id")}),$(".botTempo").click(function(){var a=$(this).attr("id"),c=a.substr(a.indexOf("-")+1),d=$.trim($(this).text());if(1==h){if("function"==typeof b){var e=c.replace("Msg",""),f=$("#txt"+e).val();b&&b(d,f)}}else"function"==typeof b&&b&&b(d);$("#"+c).addClass("animated fadeOut fast"),SmartMSGboxCount-=1,0==SmartMSGboxCount&&$("#MsgBoxBack").removeClass("fadeIn").addClass("fadeOut").delay(300).queue(function(){ExistMsg=0,$(this).remove()})})};var BigBoxes=0;$.bigBox=function(a,b){var c;if(a=$.extend({title:"",content:"",icon:void 0,number:void 0,color:void 0,sound:$.sound_on,sound_file:"bigbox",timeout:void 0,colortime:1500,colors:void 0},a),1==a.sound&&0==isIE8orlower()){var d=document.createElement("audio");navigator.userAgent.match("Firefox/")?d.setAttribute("src",$.sound_path+a.sound_file+".ogg"):d.setAttribute("src",$.sound_path+a.sound_file+".mp3"),$.get(),d.addEventListener("load",function(){d.play()},!0),$.sound_on&&(d.pause(),d.play())}BigBoxes+=1,c="<div id='bigBox"+BigBoxes+"' class='bigBox animated fadeIn fast'><div id='bigBoxColor"+BigBoxes+"'><i class='botClose fa fa-times' id='botClose"+BigBoxes+"'></i>",c+="<span>"+a.title+"</span>",c+="<p>"+a.content+"</p>",c+="<div class='bigboxicon'>",void 0==a.icon&&(a.icon="fa fa-cloud"),c+="<i class='"+a.icon+"'></i>",c+="</div>",c+="<div class='bigboxnumber'>",void 0!=a.number&&(c+=a.number),c+="</div></div>",c+="</div>",$("#divbigBoxes").append(c),void 0==a.color&&(a.color="#004d60"),$("#bigBox"+BigBoxes).css("background-color",a.color),$("#divMiniIcons").append("<div id='miniIcon"+BigBoxes+"' class='cajita animated fadeIn' style='background-color: "+a.color+";'><i class='"+a.icon+"'/></i></div>"),$("#miniIcon"+BigBoxes).bind("click",function(){var a=$(this).attr("id"),b=a.replace("miniIcon","bigBox"),c=a.replace("miniIcon","bigBoxColor");$(".cajita").each(function(){var a=$(this).attr("id"),b=a.replace("miniIcon","bigBox");$("#"+b).css("z-index",9998)}),$("#"+b).css("z-index",9999),$("#"+c).removeClass("animated fadeIn").delay(1).queue(function(){$(this).show(),$(this).addClass("animated fadeIn"),$(this).clearQueue()})});var e,f=$("#botClose"+BigBoxes),g=$("#bigBox"+BigBoxes),h=$("#miniIcon"+BigBoxes);if(void 0!=a.colors&&a.colors.length>0&&(f.attr("colorcount","0"),e=setInterval(function(){var b=f.attr("colorcount");f.animate({backgroundColor:a.colors[b].color}),g.animate({backgroundColor:a.colors[b].color}),h.animate({backgroundColor:a.colors[b].color}),b<a.colors.length-1?f.attr("colorcount",1*b+1):f.attr("colorcount",0)},a.colortime)),f.bind("click",function(){clearInterval(e),"function"==typeof b&&b&&b();var a=$(this).attr("id"),c=a.replace("botClose","bigBox"),d=a.replace("botClose","miniIcon");$("#"+c).removeClass("fadeIn fast"),$("#"+c).addClass("fadeOut fast").delay(300).queue(function(){$(this).clearQueue(),$(this).remove()}),$("#"+d).removeClass("fadeIn fast"),$("#"+d).addClass("fadeOut fast").delay(300).queue(function(){$(this).clearQueue(),$(this).remove()})}),void 0!=a.timeout){var i=BigBoxes;setTimeout(function(){clearInterval(e),$("#bigBox"+i).removeClass("fadeIn fast"),$("#bigBox"+i).addClass("fadeOut fast").delay(300).queue(function(){$(this).clearQueue(),$(this).remove()}),$("#miniIcon"+i).removeClass("fadeIn fast"),$("#miniIcon"+i).addClass("fadeOut fast").delay(300).queue(function(){$(this).clearQueue(),$(this).remove()})},a.timeout)}};var SmallBoxes=0,SmallCount=0,SmallBoxesAnchos=0;$.smallBox=function(a,b){var c;if(a=$.extend({title:"",content:"",icon:void 0,iconSmall:void 0,sound:$.sound_on,sound_file:"smallbox",color:void 0,timeout:void 0,colortime:1500,colors:void 0},a),1==a.sound&&0==isIE8orlower()){var d=document.createElement("audio");navigator.userAgent.match("Firefox/")?d.setAttribute("src",$.sound_path+a.sound_file+".ogg"):d.setAttribute("src",$.sound_path+a.sound_file+".mp3"),$.get(),d.addEventListener("load",function(){d.play()},!0),$.sound_on&&(d.pause(),d.play())}SmallBoxes+=1,c="";var e="",f="smallbox"+SmallBoxes;if(e=void 0==a.iconSmall?"<div class='miniIcono'></div>":"<div class='miniIcono'><i class='miniPic "+a.iconSmall+"'></i></div>",c=void 0==a.icon?"<div id='smallbox"+SmallBoxes+"' class='SmallBox animated fadeInRight fast'><div class='textoFull'><span>"+a.title+"</span><p>"+a.content+"</p></div>"+e+"</div>":"<div id='smallbox"+SmallBoxes+"' class='SmallBox animated fadeInRight fast'><div class='foto'><i class='"+a.icon+"'></i></div><div class='textoFoto'><span>"+a.title+"</span><p>"+a.content+"</p></div>"+e+"</div>",1==SmallBoxes)$("#divSmallBoxes").append(c),SmallBoxesAnchos=$("#smallbox"+SmallBoxes).height()+40;else{var g=$(".SmallBox").size();0==g?($("#divSmallBoxes").append(c),SmallBoxesAnchos=$("#smallbox"+SmallBoxes).height()+40):($("#divSmallBoxes").append(c),$("#smallbox"+SmallBoxes).css("top",SmallBoxesAnchos),SmallBoxesAnchos=SmallBoxesAnchos+$("#smallbox"+SmallBoxes).height()+20,$(".SmallBox").each(function(a){0==a?($(this).css("top",20),heightPrev=$(this).height()+40,SmallBoxesAnchos=$(this).height()+40):($(this).css("top",heightPrev),heightPrev=heightPrev+$(this).height()+20,SmallBoxesAnchos=SmallBoxesAnchos+$(this).height()+20)}))}var h=$("#smallbox"+SmallBoxes);void 0==a.color?h.css("background-color","#004d60"):h.css("background-color",a.color);var i;void 0!=a.colors&&a.colors.length>0&&(h.attr("colorcount","0"),i=setInterval(function(){var b=h.attr("colorcount");h.animate({backgroundColor:a.colors[b].color}),b<a.colors.length-1?h.attr("colorcount",1*b+1):h.attr("colorcount",0)},a.colortime)),void 0!=a.timeout&&setTimeout(function(){clearInterval(i);{var a=$(this).height()+20;$("#"+f).css("top")}0!=$("#"+f+":hover").length?$("#"+f).on("mouseleave",function(){SmallBoxesAnchos-=a,$("#"+f).remove(),"function"==typeof b&&b&&b();var c=0;$(".SmallBox").each(function(a){0==a?($(this).animate({top:20},300),c=$(this).height()+40,SmallBoxesAnchos=$(this).height()+40):($(this).animate({top:c},350),c=c+$(this).height()+20,SmallBoxesAnchos=SmallBoxesAnchos+$(this).height()+20)})}):(clearInterval(i),SmallBoxesAnchos-=a,"function"==typeof b&&b&&b(),$("#"+f).removeClass().addClass("SmallBox").animate({opacity:0},300,function(){$(this).remove();var a=0;$(".SmallBox").each(function(b){0==b?($(this).animate({top:20},300),a=$(this).height()+40,SmallBoxesAnchos=$(this).height()+40):($(this).animate({top:a}),a=a+$(this).height()+20,SmallBoxesAnchos=SmallBoxesAnchos+$(this).height()+20)})}))},a.timeout),$("#smallbox"+SmallBoxes).bind("click",function(){clearInterval(i),"function"==typeof b&&b&&b();{var a=$(this).height()+20;$(this).attr("id"),$(this).css("top")}SmallBoxesAnchos-=a,$(this).removeClass().addClass("SmallBox").animate({opacity:0},300,function(){$(this).remove();var a=0;$(".SmallBox").each(function(b){0==b?($(this).animate({top:20},300),a=$(this).height()+40,SmallBoxesAnchos=$(this).height()+40):($(this).animate({top:a},350),a=a+$(this).height()+20,SmallBoxesAnchos=SmallBoxesAnchos+$(this).height()+20)})})})};
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a,b,c,d){function e(b,c){this.obj=a(b),this.o=a.extend({},a.fn[f].defaults,c),this.objId=this.obj.attr("id"),this.pwCtrls=".jarviswidget-ctrls",this.widget=this.obj.find(this.o.widgets),this.toggleClass=this.o.toggleClass.split("|"),this.editClass=this.o.editClass.split("|"),this.fullscreenClass=this.o.fullscreenClass.split("|"),this.customClass=this.o.customClass.split("|"),this.init()}var f="jarvisWidgets";e.prototype={_settings:function(){var a=this;storage=!!function(){var a,b=+new Date;try{return localStorage.setItem(b,b),a=localStorage.getItem(b)==b,localStorage.removeItem(b),a}catch(c){}}()&&localStorage,storage&&a.o.localStorage&&(a.o.ajaxnav===!0?(widget_url=location.hash.replace(/^#/,""),keySettings="Plugin_settings_"+widget_url+"_"+a.objId,getKeySettings=localStorage.getItem(keySettings),keyPosition="Plugin_position_"+widget_url+"_"+a.objId,getKeyPosition=localStorage.getItem(keyPosition)):(keySettings="jarvisWidgets_settings_"+location.pathname+"_"+a.objId,getKeySettings=localStorage.getItem(keySettings),keyPosition="jarvisWidgets_position_"+location.pathname+"_"+a.objId,getKeyPosition=localStorage.getItem(keyPosition))),clickEvent="ontouchstart"in b||b.DocumentTouch&&c instanceof DocumentTouch?"touchstart":"click"},_runLoaderWidget:function(a){var b=this;b.o.indicator===!0&&a.parents(b.o.widgets).find(".jarviswidget-loader").stop(!0,!0).fadeIn(100).delay(b.o.indicatorTime).fadeOut(100)},_getPastTimestamp:function(a){var b=this,c=new Date(a),d=c.getMonth()+1,e=c.getDate(),f=c.getFullYear(),g=c.getHours(),h=c.getMinutes(),i=c.getUTCSeconds();10>d&&(d="0"+d),10>e&&(e="0"+e),10>g&&(g="0"+g),10>h&&(h="0"+h),10>i&&(i="0"+i);var j=b.o.timestampFormat.replace(/%d%/g,e).replace(/%m%/g,d).replace(/%y%/g,f).replace(/%h%/g,g).replace(/%i%/g,h).replace(/%s%/g,i);return j},_loadAjaxFile:function(b,c,d){var e=this;b.find(".widget-body").load(c,function(c,d,f){var g=a(this);if("error"==d&&g.html('<h4 class="alert alert-danger">'+e.o.labelError+"<b> "+f.status+" "+f.statusText+"</b></h4>"),"success"==d){var h=b.find(e.o.timestampPlaceholder);h.length&&h.html(e._getPastTimestamp(new Date)),"function"==typeof e.o.afterLoad&&e.o.afterLoad.call(this,b)}}),e._runLoaderWidget(d)},_saveSettingsWidget:function(){var b=this;if(b._settings(),storage&&b.o.localStorage){var c=[];b.obj.find(b.o.widgets).each(function(){var b={};b.id=a(this).attr("id"),b.style=a(this).attr("data-widget-attstyle"),b.title=a(this).children("header").children("h2").text(),b.hidden=a(this).is(":hidden")?1:0,b.collapsed=a(this).hasClass("jarviswidget-collapsed")?1:0,c.push(b)}),storeSettingsObj=JSON.stringify({widget:c}),getKeySettings!=storeSettingsObj&&localStorage.setItem(keySettings,storeSettingsObj)}"function"==typeof b.o.onSave&&b.o.onSave.call(this,null,storeSettingsObj)},_savePositionWidget:function(){var b=this;if(b._settings(),storage&&b.o.localStorage){var c=[];b.obj.find(b.o.grid+".sortable-grid").each(function(){var d=[];a(this).children(b.o.widgets).each(function(){var b={};b.id=a(this).attr("id"),d.push(b)});var e={section:d};c.push(e)});var d=JSON.stringify({grid:c});getKeyPosition!=d&&localStorage.setItem(keyPosition,d,null)}"function"==typeof b.o.onSave&&b.o.onSave.call(this,d)},init:function(){var b=this;if(b._settings(),a("#"+b.objId).length||alert("It looks like your using a class instead of an ID, dont do that!"),b.o.rtl===!0&&a("body").addClass("rtl"),a(b.o.grid).each(function(){a(this).find(b.o.widgets).length&&a(this).addClass("sortable-grid")}),storage&&b.o.localStorage&&getKeyPosition){var c=JSON.parse(getKeyPosition);for(var e in c.grid){var f=b.obj.find(b.o.grid+".sortable-grid").eq(e);for(var g in c.grid[e].section)f.append(a("#"+c.grid[e].section[g].id))}}if(storage&&b.o.localStorage&&getKeySettings){var h=JSON.parse(getKeySettings);for(var e in h.widget){var i=a("#"+h.widget[e].id);h.widget[e].style&&i.removeClassPrefix("jarviswidget-color-").addClass(h.widget[e].style).attr("data-widget-attstyle",""+h.widget[e].style),1==h.widget[e].hidden?i.hide(1):i.show(1).removeAttr("data-widget-hidden"),1==h.widget[e].collapsed&&i.addClass("jarviswidget-collapsed").children("div").hide(1),i.children("header").children("h2").text()!=h.widget[e].title&&i.children("header").children("h2").text(h.widget[e].title)}}if(b.widget.each(function(){var c,e,f,g,h,i,j,k,l=a(this),m=a(this).children("header");if(!m.parent().attr("role")){l.data("widget-hidden")===!0&&l.hide(),l.data("widget-collapsed")===!0&&l.addClass("jarviswidget-collapsed").children("div").hide(),c=b.o.customButton===!0&&l.data("widget-custombutton")===d&&0!==b.customClass[0].length?'<a href="javascript:void(0);" class="button-icon jarviswidget-custom-btn"><i class="'+b.customClass[0]+'"></i></a>':"",e=b.o.deleteButton===!0&&l.data("widget-deletebutton")===d?'<a href="javascript:void(0);" class="button-icon jarviswidget-delete-btn" rel="tooltip" title="Delete" data-placement="bottom"><i class="'+b.o.deleteClass+'"></i></a>':"",f=b.o.editButton===!0&&l.data("widget-editbutton")===d?'<a href="javascript:void(0);" class="button-icon jarviswidget-edit-btn" rel="tooltip" title="Edit Title" data-placement="bottom"><i class="'+b.editClass[0]+'"></i></a>':"",g=b.o.fullscreenButton===!0&&l.data("widget-fullscreenbutton")===d?'<a href="javascript:void(0);" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="Fullscreen" data-placement="bottom"><i class="'+b.fullscreenClass[0]+'"></i></a>':"",b.o.colorButton===!0&&l.data("widget-colorbutton")===d?(h='<a data-toggle="dropdown" class="dropdown-toggle color-box selector" href="javascript:void(0);"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span class="bg-color-green" data-widget-setstyle="jarviswidget-color-green" rel="tooltip" data-placement="left" data-original-title="Green Grass"></span></li><li><span class="bg-color-greenDark" data-widget-setstyle="jarviswidget-color-greenDark" rel="tooltip" data-placement="top" data-original-title="Dark Green"></span></li><li><span class="bg-color-greenLight" data-widget-setstyle="jarviswidget-color-greenLight" rel="tooltip" data-placement="top" data-original-title="Light Green"></span></li><li><span class="bg-color-purple" data-widget-setstyle="jarviswidget-color-purple" rel="tooltip" data-placement="top" data-original-title="Purple"></span></li><li><span class="bg-color-magenta" data-widget-setstyle="jarviswidget-color-magenta" rel="tooltip" data-placement="top" data-original-title="Magenta"></span></li><li><span class="bg-color-pink" data-widget-setstyle="jarviswidget-color-pink" rel="tooltip" data-placement="right" data-original-title="Pink"></span></li><li><span class="bg-color-pinkDark" data-widget-setstyle="jarviswidget-color-pinkDark" rel="tooltip" data-placement="left" data-original-title="Fade Pink"></span></li><li><span class="bg-color-blueLight" data-widget-setstyle="jarviswidget-color-blueLight" rel="tooltip" data-placement="top" data-original-title="Light Blue"></span></li><li><span class="bg-color-teal" data-widget-setstyle="jarviswidget-color-teal" rel="tooltip" data-placement="top" data-original-title="Teal"></span></li><li><span class="bg-color-blue" data-widget-setstyle="jarviswidget-color-blue" rel="tooltip" data-placement="top" data-original-title="Ocean Blue"></span></li><li><span class="bg-color-blueDark" data-widget-setstyle="jarviswidget-color-blueDark" rel="tooltip" data-placement="top" data-original-title="Night Sky"></span></li><li><span class="bg-color-darken" data-widget-setstyle="jarviswidget-color-darken" rel="tooltip" data-placement="right" data-original-title="Night"></span></li><li><span class="bg-color-yellow" data-widget-setstyle="jarviswidget-color-yellow" rel="tooltip" data-placement="left" data-original-title="Day Light"></span></li><li><span class="bg-color-orange" data-widget-setstyle="jarviswidget-color-orange" rel="tooltip" data-placement="bottom" data-original-title="Orange"></span></li><li><span class="bg-color-orangeDark" data-widget-setstyle="jarviswidget-color-orangeDark" rel="tooltip" data-placement="bottom" data-original-title="Dark Orange"></span></li><li><span class="bg-color-red" data-widget-setstyle="jarviswidget-color-red" rel="tooltip" data-placement="bottom" data-original-title="Red Rose"></span></li><li><span class="bg-color-redLight" data-widget-setstyle="jarviswidget-color-redLight" rel="tooltip" data-placement="bottom" data-original-title="Light Red"></span></li><li><span class="bg-color-white" data-widget-setstyle="jarviswidget-color-white" rel="tooltip" data-placement="right" data-original-title="Purity"></span></li><li><a href="javascript:void(0);" class="jarviswidget-remove-colors" data-widget-setstyle="" rel="tooltip" data-placement="bottom" data-original-title="Reset widget color to default">Remove</a></li></ul>',m.prepend('<div class="widget-toolbar">'+h+"</div>")):h="",b.o.toggleButton===!0&&l.data("widget-togglebutton")===d?(j=l.data("widget-collapsed")===!0||l.hasClass("jarviswidget-collapsed")?b.toggleClass[1]:b.toggleClass[0],i='<a href="javascript:void(0);" class="button-icon jarviswidget-toggle-btn" rel="tooltip" title="Collapse" data-placement="bottom"><i class="'+j+'"></i></a>'):i="",k=b.o.refreshButton===!0&&l.data("widget-refreshbutton")!==!1&&l.data("widget-load")?'<a href="javascript:void(0);" class="button-icon jarviswidget-refresh-btn" data-loading-text="&nbsp;&nbsp;Loading...&nbsp;" rel="tooltip" title="Refresh" data-placement="bottom"><i class="'+b.o.refreshButtonClass+'"></i></a>':"";var n=b.o.buttonOrder.replace(/%refresh%/g,k).replace(/%delete%/g,e).replace(/%custom%/g,c).replace(/%fullscreen%/g,g).replace(/%edit%/g,f).replace(/%toggle%/g,i);(""!==k||""!==e||""!==c||""!==g||""!==f||""!==i)&&m.prepend('<div class="jarviswidget-ctrls">'+n+"</div>"),b.o.sortable===!0&&l.data("widget-sortable")===d&&l.addClass("jarviswidget-sortable"),l.find(b.o.editPlaceholder).length&&l.find(b.o.editPlaceholder).find("input").val(a.trim(m.children("h2").text())),m.append('<span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>'),l.attr("role","widget").children("div").attr("role","content").prev("header").attr("role","heading").children("div").attr("role","menu")}}),b.o.buttonsHidden===!0&&a(b.o.pwCtrls).hide(),a(".jarviswidget header [rel=tooltip]").tooltip(),b.obj.find("[data-widget-load]").each(function(){{var c=a(this),d=c.children(),e=c.data("widget-load"),f=1e3*c.data("widget-refresh");c.children()}c.find(".jarviswidget-ajax-placeholder").length||(c.children("widget-body").append('<div class="jarviswidget-ajax-placeholder">'+b.o.loadingLabel+"</div>"),c.data("widget-refresh")>0?(b._loadAjaxFile(c,e,d),a.intervalArr.push(setInterval(function(){b._loadAjaxFile(c,e,d)},f))):b._loadAjaxFile(c,e,d))}),b.o.sortable===!0&&jQuery.ui){var j=b.obj.find(".sortable-grid").not("[data-widget-excludegrid]");j.sortable({items:j.find(".jarviswidget-sortable"),connectWith:j,placeholder:b.o.placeholderClass,cursor:"move",revert:!0,opacity:b.o.opacity,delay:200,cancel:".button-icon, #jarviswidget-fullscreen-mode > div",zIndex:1e4,handle:b.o.dragHandle,forcePlaceholderSize:!0,forceHelperSize:!0,update:function(a,c){b._runLoaderWidget(c.item.children()),b._savePositionWidget(),"function"==typeof b.o.onChange&&b.o.onChange.call(this,c.item)}})}b.o.buttonsHidden===!0&&b.widget.children("header").hover(function(){a(this).children(b.o.pwCtrls).stop(!0,!0).fadeTo(100,1)},function(){a(this).children(b.o.pwCtrls).stop(!0,!0).fadeTo(100,0)}),b._clickEvents(),a(b.o.deleteSettingsKey).on(clickEvent,this,function(a){if(storage&&b.o.localStorage){var c=confirm(b.o.settingsKeyLabel);c&&localStorage.removeItem(keySettings)}a.preventDefault()}),a(b.o.deletePositionKey).on(clickEvent,this,function(a){if(storage&&b.o.localStorage){var c=confirm(b.o.positionKeyLabel);c&&localStorage.removeItem(keyPosition)}a.preventDefault()}),storage&&b.o.localStorage&&((null===getKeySettings||getKeySettings.length<1)&&b._saveSettingsWidget(),(null===getKeyPosition||getKeyPosition.length<1)&&b._savePositionWidget())},_clickEvents:function(){function c(){if(a("#jarviswidget-fullscreen-mode").length){var c=a(b).height(),e=a("#jarviswidget-fullscreen-mode").find(d.o.widgets).children("header").height();a("#jarviswidget-fullscreen-mode").find(d.o.widgets).children("div").height(c-e-15)}}var d=this;d._settings(),d.widget.on(clickEvent,".jarviswidget-toggle-btn",function(b){var c=a(this),e=c.parents(d.o.widgets);d._runLoaderWidget(c),e.hasClass("jarviswidget-collapsed")?c.children().removeClass(d.toggleClass[1]).addClass(d.toggleClass[0]).parents(d.o.widgets).removeClass("jarviswidget-collapsed").children("[role=content]").slideDown(d.o.toggleSpeed,function(){d._saveSettingsWidget()}):c.children().removeClass(d.toggleClass[0]).addClass(d.toggleClass[1]).parents(d.o.widgets).addClass("jarviswidget-collapsed").children("[role=content]").slideUp(d.o.toggleSpeed,function(){d._saveSettingsWidget()}),"function"==typeof d.o.onToggle&&d.o.onToggle.call(this,e),b.preventDefault()}),d.widget.on(clickEvent,".jarviswidget-fullscreen-btn",function(b){var e=a(this).parents(d.o.widgets),f=e.children("div");d._runLoaderWidget(a(this)),a("#jarviswidget-fullscreen-mode").length?(a(".nooverflow").removeClass("nooverflow"),e.unwrap("<div>").children("div").removeAttr("style").end().find(".jarviswidget-fullscreen-btn").children().removeClass(d.fullscreenClass[1]).addClass(d.fullscreenClass[0]).parents(d.pwCtrls).children("a").show(),f.hasClass("jarviswidget-visible")&&f.hide().removeClass("jarviswidget-visible")):(a("body").addClass("nooverflow"),e.wrap('<div id="jarviswidget-fullscreen-mode"/>').parent().find(".jarviswidget-fullscreen-btn").children().removeClass(d.fullscreenClass[0]).addClass(d.fullscreenClass[1]).parents(d.pwCtrls).children("a:not(.jarviswidget-fullscreen-btn)").hide(),f.is(":hidden")&&f.show().addClass("jarviswidget-visible")),c(),"function"==typeof d.o.onFullscreen&&d.o.onFullscreen.call(this,e),b.preventDefault()}),a(b).resize(function(){c()}),d.widget.on(clickEvent,".jarviswidget-edit-btn",function(b){var c=a(this).parents(d.o.widgets);d._runLoaderWidget(a(this)),c.find(d.o.editPlaceholder).is(":visible")?a(this).children().removeClass(d.editClass[1]).addClass(d.editClass[0]).parents(d.o.widgets).find(d.o.editPlaceholder).slideUp(d.o.editSpeed,function(){d._saveSettingsWidget()}):a(this).children().removeClass(d.editClass[0]).addClass(d.editClass[1]).parents(d.o.widgets).find(d.o.editPlaceholder).slideDown(d.o.editSpeed),"function"==typeof d.o.onEdit&&d.o.onEdit.call(this,c),b.preventDefault()}),a(d.o.editPlaceholder).find("input").keyup(function(){a(this).parents(d.o.widgets).children("header").children("h2").text(a(this).val())}),d.widget.on(clickEvent,"[data-widget-setstyle]",function(b){var c=a(this).data("widget-setstyle"),e="";a(this).parents(d.o.editPlaceholder).find("[data-widget-setstyle]").each(function(){e+=a(this).data("widget-setstyle")+" "}),a(this).parents(d.o.widgets).attr("data-widget-attstyle",""+c).removeClassPrefix("jarviswidget-color-").addClass(c),d._runLoaderWidget(a(this)),d._saveSettingsWidget(),b.preventDefault()}),d.widget.on(clickEvent,".jarviswidget-custom-btn",function(b){var c=a(this).parents(d.o.widgets);d._runLoaderWidget(a(this)),a(this).children("."+d.customClass[0]).length?(a(this).children().removeClass(d.customClass[0]).addClass(d.customClass[1]),"function"==typeof d.o.customStart&&d.o.customStart.call(this,c)):(a(this).children().removeClass(d.customClass[1]).addClass(d.customClass[0]),"function"==typeof d.o.customEnd&&d.o.customEnd.call(this,c)),d._saveSettingsWidget(),b.preventDefault()}),d.widget.on(clickEvent,".jarviswidget-delete-btn",function(b){var c=a(this).parents(d.o.widgets),e=c.attr("id"),f=c.children("header").children("h2").text();a.SmartMessageBox?a.SmartMessageBox({title:"<i class='fa fa-times' style='color:#ed1c24'></i> "+d.o.labelDelete+' "'+f+'"',content:"Warning: This action cannot be undone",buttons:"[No][Yes]"},function(b){"Yes"==b&&(d._runLoaderWidget(a(this)),a("#"+e).fadeOut(d.o.deleteSpeed,function(){a(this).remove(),"function"==typeof d.o.onDelete&&d.o.onDelete.call(this,c)}))}):a("#"+e).fadeOut(d.o.deleteSpeed,function(){a(this).remove(),"function"==typeof d.o.onDelete&&d.o.onDelete.call(this,c)}),b.preventDefault()}),d.widget.on(clickEvent,".jarviswidget-refresh-btn",function(b){var c=a(this).parents(d.o.widgets),e=c.data("widget-load"),f=c.children(),g=a(this);g.button("loading"),f.addClass("widget-body-ajax-loading"),setTimeout(function(){g.button("reset"),f.removeClass("widget-body-ajax-loading"),d._loadAjaxFile(c,e,f)},1e3),b.preventDefault()})},destroy:function(){var a=this;a.widget.off("click",a._clickEvents()),a.obj.removeData(f)}},a.fn[f]=function(b){return this.each(function(){var c=a(this),d=c.data(f),g="object"==typeof b&&b;d||c.data(f,d=new e(this,g)),"string"==typeof b&&d[b]()})},a.fn[f].defaults={grid:"section",widgets:".jarviswidget",localStorage:!0,deleteSettingsKey:"",settingsKeyLabel:"Reset settings?",deletePositionKey:"",positionKeyLabel:"Reset position?",sortable:!0,buttonsHidden:!1,toggleButton:!0,toggleClass:"min-10 | plus-10",toggleSpeed:200,onToggle:function(){},deleteButton:!0,deleteClass:"trashcan-10",deleteSpeed:200,onDelete:function(){},editButton:!0,editPlaceholder:".jarviswidget-editbox",editClass:"pencil-10 | delete-10",editSpeed:200,onEdit:function(){},colorButton:!0,fullscreenButton:!0,fullscreenClass:"fullscreen-10 | normalscreen-10",fullscreenDiff:3,onFullscreen:function(){},customButton:!0,customClass:"",customStart:function(){},customEnd:function(){},buttonOrder:"%refresh% %delete% %custom% %edit% %fullscreen% %toggle%",opacity:1,dragHandle:"> header",placeholderClass:"jarviswidget-placeholder",indicator:!0,indicatorTime:600,ajax:!0,loadingLabel:"loading...",timestampPlaceholder:".jarviswidget-timestamp",timestampFormat:"Last update: %m%/%d%/%y% %h%:%i%:%s%",refreshButton:!0,refreshButtonClass:"refresh-10",labelError:"Sorry but there was a error:",labelUpdated:"Last Update:",labelRefresh:"Refresh",labelDelete:"Delete widget:",afterLoad:function(){},rtl:!1,onChange:function(){},onSave:function(){},ajaxnav:!0},a.fn.removeClassPrefix=function(b){return this.each(function(c,d){var e=d.className.split(" ").map(function(a){return 0===a.indexOf(b)?"":a});d.className=a.trim(e.join(" "))}),this}}(jQuery,window,document);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a){return a.easyPieChart=function(b,c){var d,e,f,g,h,i,j,k,l=this;return this.el=b,this.$el=a(b),this.$el.data("easyPieChart",this),this.init=function(){var b,d;return l.options=a.extend({},a.easyPieChart.defaultOptions,c),b=parseInt(l.$el.data("percent"),10),l.percentage=0,l.canvas=a("<canvas width='"+l.options.size+"' height='"+l.options.size+"'></canvas>").get(0),l.$el.append(l.canvas),"undefined"!=typeof G_vmlCanvasManager&&null!==G_vmlCanvasManager&&G_vmlCanvasManager.initElement(l.canvas),l.ctx=l.canvas.getContext("2d"),window.devicePixelRatio>1&&(d=window.devicePixelRatio,a(l.canvas).css({width:l.options.size,height:l.options.size}),l.canvas.width*=d,l.canvas.height*=d,l.ctx.scale(d,d)),l.ctx.translate(l.options.size/2,l.options.size/2),l.ctx.rotate(l.options.rotate*Math.PI/180),l.$el.addClass("easyPieChart"),l.$el.css({width:l.options.size,height:l.options.size,lineHeight:""+l.options.size+"px"}),l.update(b),l},this.update=function(a){return a=parseFloat(a)||0,l.options.animate===!1?f(a):e(l.percentage,a),l},j=function(){var a,b,c;for(l.ctx.fillStyle=l.options.scaleColor,l.ctx.lineWidth=1,c=[],a=b=0;24>=b;a=++b)c.push(d(a));return c},d=function(a){var b;b=a%6===0?0:.017*l.options.size,l.ctx.save(),l.ctx.rotate(a*Math.PI/12),l.ctx.fillRect(l.options.size/2-b,0,.05*-l.options.size+b,1),l.ctx.restore()},k=function(){var a;a=l.options.size/2-l.options.lineWidth/2,l.options.scaleColor!==!1&&(a-=.08*l.options.size),l.ctx.beginPath(),l.ctx.arc(0,0,a,0,2*Math.PI,!0),l.ctx.closePath(),l.ctx.strokeStyle=l.options.trackColor,l.ctx.lineWidth=l.options.lineWidth,l.ctx.stroke()},i=function(){l.options.scaleColor!==!1&&j(),l.options.trackColor!==!1&&k()},f=function(b){var c;i(),l.ctx.strokeStyle=a.isFunction(l.options.barColor)?l.options.barColor(b):l.options.barColor,l.ctx.lineCap=l.options.lineCap,l.ctx.lineWidth=l.options.lineWidth,c=l.options.size/2-l.options.lineWidth/2,l.options.scaleColor!==!1&&(c-=.08*l.options.size),l.ctx.save(),l.ctx.rotate(-Math.PI/2),l.ctx.beginPath(),l.ctx.arc(0,0,c,0,2*Math.PI*b/100,!1),l.ctx.stroke(),l.ctx.restore()},h=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(a){return window.setTimeout(a,1e3/60)}}(),e=function(a,b){var c,d;l.options.onStart.call(l),l.percentage=b,d=Date.now(),c=function(){var e,j;return j=Date.now()-d,j<l.options.animate&&h(c),l.ctx.clearRect(-l.options.size/2,-l.options.size/2,l.options.size,l.options.size),i.call(l),e=[g(j,a,b-a,l.options.animate)],l.options.onStep.call(l,e),f.call(l,e),j>=l.options.animate?l.options.onStop.call(l):void 0},h(c)},g=function(a,b,c,d){var e,f;return e=function(a){return Math.pow(a,2)},f=function(a){return 1>a?e(a):2-e(a/2*-2+2)},a/=d/2,c/2*f(a)+b},this.init()},a.easyPieChart.defaultOptions={barColor:"#ef1e25",trackColor:"#f2f2f2",scaleColor:"#dfe0e0",lineCap:"round",rotate:0,size:110,lineWidth:3,animate:!1,onStart:a.noop,onStop:a.noop,onStep:a.noop},void(a.fn.easyPieChart=function(b){return a.each(this,function(c,d){var e,f;return e=a(d),e.data("easyPieChart")?void 0:(f=a.extend({},b,e.data()),e.data("easyPieChart",new a.easyPieChart(d,f)))})})}(jQuery);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */$.blue="#2e7bcc",$.green="#3FB618",$.red="#FF0039",$.yellow="#FFA500",$.orange="#FF7518",$.pink="#E671B8",$.purple="#9954BB",$.black="#333333",function(a,b,c){!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):jQuery&&!jQuery.fn.sparkline&&a(jQuery)}(function(d){"use strict";var e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K={},L=0;e=function(){return{common:{type:"line",lineColor:"#00f",fillColor:"#cdf",defaultPixelsPerValue:3,width:"auto",height:"auto",composite:!1,tagValuesAttribute:"values",tagOptionsPrefix:"spark",enableTagOptions:!1,enableHighlight:!0,highlightLighten:1.4,tooltipSkipNull:!0,tooltipPrefix:"",tooltipSuffix:"",disableHiddenCheck:!1,numberFormatter:!1,numberDigitGroupCount:3,numberDigitGroupSep:",",numberDecimalMark:".",disableTooltips:!1,disableInteraction:!1},line:{spotColor:"#f80",highlightSpotColor:"#5f5",highlightLineColor:"#f22",spotRadius:1.5,minSpotColor:"#f80",maxSpotColor:"#f80",lineWidth:1,normalRangeMin:c,normalRangeMax:c,normalRangeColor:"#ccc",drawNormalOnTop:!1,chartRangeMin:c,chartRangeMax:c,chartRangeMinX:c,chartRangeMaxX:c,tooltipFormat:new g('<span style="color: {{color}}">&#9679;</span> {{prefix}}{{y}}{{suffix}}')},bar:{barColor:d.blue,negBarColor:"#f44",stackedBarColor:[d.blue,d.red,d.yellow,d.green,"#66aa00",d.pink,"#0099c6",d.purple],zeroColor:c,nullColor:c,zeroAxis:!0,barWidth:4,barSpacing:1,chartRangeMax:c,chartRangeMin:c,chartRangeClip:!1,colorMap:c,tooltipFormat:new g('<span style="color: {{color}}">&#9679;</span> {{prefix}}{{value}}{{suffix}}')},tristate:{barWidth:4,barSpacing:1,posBarColor:"#6f6",negBarColor:"#f44",zeroBarColor:"#999",colorMap:{},tooltipFormat:new g('<span style="color: {{color}}">&#9679;</span> {{value:map}}'),tooltipValueLookups:{map:{"-1":"Loss",0:"Draw",1:"Win"}}},discrete:{lineHeight:"auto",thresholdColor:c,thresholdValue:0,chartRangeMax:c,chartRangeMin:c,chartRangeClip:!1,tooltipFormat:new g("{{prefix}}{{value}}{{suffix}}")},bullet:{targetColor:"#f33",targetWidth:3,performanceColor:"#33f",rangeColors:["#d3dafe","#a8b6ff","#7f94ff"],base:c,tooltipFormat:new g("{{fieldkey:fields}} - {{value}}"),tooltipValueLookups:{fields:{r:"Range",p:"Performance",t:"Target"}}},pie:{offset:0,sliceColors:[d.blue,d.red,d.yellow,d.green,"#66aa00",d.pink,"#0099c6",d.purple],borderWidth:0,borderColor:"#000",tooltipFormat:new g('<span style="color: {{color}}">&#9679;</span> {{value}} ({{percent.1}}%)')},box:{raw:!1,boxLineColor:"#000",boxFillColor:"#cdf",whiskerColor:"#000",outlierLineColor:"#333",outlierFillColor:"#fff",medianColor:"#f00",showOutliers:!0,outlierIQR:1.5,spotRadius:1.5,target:c,targetColor:"#4a2",chartRangeMax:c,chartRangeMin:c,tooltipFormat:new g("{{field:fields}}: {{value}}"),tooltipFormatFieldlistKey:"field",tooltipValueLookups:{fields:{lq:"Lower Quartile",med:"Median",uq:"Upper Quartile",lo:"Left Outlier",ro:"Right Outlier",lw:"Left Whisker",rw:"Right Whisker"}}}}},D='.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}',f=function(){var a,b;return a=function(){this.init.apply(this,arguments)},arguments.length>1?(arguments[0]?(a.prototype=d.extend(new arguments[0],arguments[arguments.length-1]),a._super=arguments[0].prototype):a.prototype=arguments[arguments.length-1],arguments.length>2&&(b=Array.prototype.slice.call(arguments,1,-1),b.unshift(a.prototype),d.extend.apply(d,b))):a.prototype=arguments[0],a.prototype.cls=a,a},d.SPFormatClass=g=f({fre:/\{\{([\w.]+?)(:(.+?))?\}\}/g,precre:/(\w+)\.(\d+)/,init:function(a,b){this.format=a,this.fclass=b},render:function(a,b,d){var e,f,g,h,i,j=this,k=a;return this.format.replace(this.fre,function(){var a;return f=arguments[1],g=arguments[3],e=j.precre.exec(f),e?(i=e[2],f=e[1]):i=!1,h=k[f],h===c?"":g&&b&&b[g]?(a=b[g],a.get?b[g].get(h)||h:b[g][h]||h):(m(h)&&(h=d.get("numberFormatter")?d.get("numberFormatter")(h):r(h,i,d.get("numberDigitGroupCount"),d.get("numberDigitGroupSep"),d.get("numberDecimalMark"))),h)})}}),d.spformat=function(a,b){return new g(a,b)},h=function(a,b,c){return b>a?b:a>c?c:a},i=function(a,c){var d;return 2===c?(d=b.floor(a.length/2),a.length%2?a[d]:(a[d-1]+a[d])/2):a.length%2?(d=(a.length*c+c)/4,d%1?(a[b.floor(d)]+a[b.floor(d)-1])/2:a[d-1]):(d=(a.length*c+2)/4,d%1?(a[b.floor(d)]+a[b.floor(d)-1])/2:a[d-1])},j=function(a){var b;switch(a){case"undefined":a=c;break;case"null":a=null;break;case"true":a=!0;break;case"false":a=!1;break;default:b=parseFloat(a),a==b&&(a=b)}return a},k=function(a){var b,c=[];for(b=a.length;b--;)c[b]=j(a[b]);return c},l=function(a,b){var c,d,e=[];for(c=0,d=a.length;d>c;c++)a[c]!==b&&e.push(a[c]);return e},m=function(a){return!isNaN(parseFloat(a))&&isFinite(a)},r=function(a,b,c,e,f){var g,h;for(a=(b===!1?parseFloat(a).toString():a.toFixed(b)).split(""),g=(g=d.inArray(".",a))<0?a.length:g,g<a.length&&(a[g]=f),h=g-c;h>0;h-=c)a.splice(h,0,e);return a.join("")},n=function(a,b,c){var d;for(d=b.length;d--;)if((!c||null!==b[d])&&b[d]!==a)return!1;return!0},o=function(a){var b,c=0;for(b=a.length;b--;)c+="number"==typeof a[b]?a[b]:0;return c},q=function(a){return d.isArray(a)?a:[a]},p=function(b){var c;a.createStyleSheet?a.createStyleSheet().cssText=b:(c=a.createElement("style"),c.type="text/css",a.getElementsByTagName("head")[0].appendChild(c),c["string"==typeof a.body.style.WebkitAppearance?"innerText":"innerHTML"]=b)},d.fn.simpledraw=function(b,e,f,g){var h,i;if(f&&(h=this.data("_jqs_vcanvas")))return h;if(d.fn.sparkline.canvas===!1)return!1;if(d.fn.sparkline.canvas===c){var j=a.createElement("canvas");if(j.getContext&&j.getContext("2d"))d.fn.sparkline.canvas=function(a,b,c,d){return new H(a,b,c,d)};else{if(!a.namespaces||a.namespaces.v)return d.fn.sparkline.canvas=!1,!1;a.namespaces.add("v","urn:schemas-microsoft-com:vml","#default#VML"),d.fn.sparkline.canvas=function(a,b,c){return new I(a,b,c)}}}return b===c&&(b=d(this).innerWidth()),e===c&&(e=d(this).innerHeight()),h=d.fn.sparkline.canvas(b,e,this,g),i=d(this).data("_jqs_mhandler"),i&&i.registerCanvas(h),h},d.fn.cleardraw=function(){var a=this.data("_jqs_vcanvas");a&&a.reset()},d.RangeMapClass=s=f({init:function(a){var b,c,d=[];for(b in a)a.hasOwnProperty(b)&&"string"==typeof b&&b.indexOf(":")>-1&&(c=b.split(":"),c[0]=0===c[0].length?-1/0:parseFloat(c[0]),c[1]=0===c[1].length?1/0:parseFloat(c[1]),c[2]=a[b],d.push(c));this.map=a,this.rangelist=d||!1},get:function(a){var b,d,e,f=this.rangelist;if((e=this.map[a])!==c)return e;if(f)for(b=f.length;b--;)if(d=f[b],d[0]<=a&&d[1]>=a)return d[2];return c}}),d.range_map=function(a){return new s(a)},t=f({init:function(a,b){var c=d(a);this.$el=c,this.options=b,this.currentPageX=0,this.currentPageY=0,this.el=a,this.splist=[],this.tooltip=null,this.over=!1,this.displayTooltips=!b.get("disableTooltips"),this.highlightEnabled=!b.get("disableHighlight")},registerSparkline:function(a){this.splist.push(a),this.over&&this.updateDisplay()},registerCanvas:function(a){var b=d(a.canvas);this.canvas=a,this.$canvas=b,b.mouseenter(d.proxy(this.mouseenter,this)),b.mouseleave(d.proxy(this.mouseleave,this)),b.click(d.proxy(this.mouseclick,this))},reset:function(a){this.splist=[],this.tooltip&&a&&(this.tooltip.remove(),this.tooltip=c)},mouseclick:function(a){var b=d.Event("sparklineClick");b.originalEvent=a,b.sparklines=this.splist,this.$el.trigger(b)},mouseenter:function(b){d(a.body).unbind("mousemove.jqs"),d(a.body).bind("mousemove.jqs",d.proxy(this.mousemove,this)),this.over=!0,this.currentPageX=b.pageX,this.currentPageY=b.pageY,this.currentEl=b.target,!this.tooltip&&this.displayTooltips&&(this.tooltip=new u(this.options),this.tooltip.updatePosition(b.pageX,b.pageY)),this.updateDisplay()},mouseleave:function(){d(a.body).unbind("mousemove.jqs");var b,c,e=this.splist,f=e.length,g=!1;for(this.over=!1,this.currentEl=null,this.tooltip&&(this.tooltip.remove(),this.tooltip=null),c=0;f>c;c++)b=e[c],b.clearRegionHighlight()&&(g=!0);g&&this.canvas.render()},mousemove:function(a){this.currentPageX=a.pageX,this.currentPageY=a.pageY,this.currentEl=a.target,this.tooltip&&this.tooltip.updatePosition(a.pageX,a.pageY),this.updateDisplay()},updateDisplay:function(){var a,b,c,e,f,g=this.splist,h=g.length,i=!1,j=this.$canvas.offset(),k=this.currentPageX-j.left,l=this.currentPageY-j.top;if(this.over){for(c=0;h>c;c++)b=g[c],e=b.setRegionHighlight(this.currentEl,k,l),e&&(i=!0);if(i){if(f=d.Event("sparklineRegionChange"),f.sparklines=this.splist,this.$el.trigger(f),this.tooltip){for(a="",c=0;h>c;c++)b=g[c],a+=b.getCurrentRegionTooltip();this.tooltip.setContent(a)}this.disableHighlight||this.canvas.render()}null===e&&this.mouseleave()}}}),u=f({sizeStyle:"position: static !important;display: block !important;visibility: hidden !important;float: left !important;",init:function(b){var c,e=b.get("tooltipClassname","jqstooltip"),f=this.sizeStyle;this.container=b.get("tooltipContainer")||a.body,this.tooltipOffsetX=b.get("tooltipOffsetX",10),this.tooltipOffsetY=b.get("tooltipOffsetY",12),d("#jqssizetip").remove(),d("#jqstooltip").remove(),this.sizetip=d("<div/>",{id:"jqssizetip",style:f,"class":e}),this.tooltip=d("<div/>",{id:"jqstooltip","class":e}).appendTo(this.container),c=this.tooltip.offset(),this.offsetLeft=c.left,this.offsetTop=c.top,this.hidden=!0,d(window).unbind("resize.jqs scroll.jqs"),d(window).bind("resize.jqs scroll.jqs",d.proxy(this.updateWindowDims,this)),this.updateWindowDims()},updateWindowDims:function(){this.scrollTop=d(window).scrollTop(),this.scrollLeft=d(window).scrollLeft(),this.scrollRight=this.scrollLeft+d(window).width(),this.updatePosition()},getSize:function(a){this.sizetip.html(a).appendTo(this.container),this.width=this.sizetip.width()+1,this.height=this.sizetip.height(),this.sizetip.remove()},setContent:function(a){return a?(this.getSize(a),this.tooltip.html(a).css({width:this.width,height:this.height,visibility:"visible"}),void(this.hidden&&(this.hidden=!1,this.updatePosition()))):(this.tooltip.css("visibility","hidden"),void(this.hidden=!0))},updatePosition:function(a,b){if(a===c){if(this.mousex===c)return;a=this.mousex-this.offsetLeft,b=this.mousey-this.offsetTop}else this.mousex=a-=this.offsetLeft,this.mousey=b-=this.offsetTop;this.height&&this.width&&!this.hidden&&(b-=this.height+this.tooltipOffsetY,a+=this.tooltipOffsetX,b<this.scrollTop&&(b=this.scrollTop),a<this.scrollLeft?a=this.scrollLeft:a+this.width>this.scrollRight&&(a=this.scrollRight-this.width),this.tooltip.css({left:a,top:b}))},remove:function(){this.tooltip.remove(),this.sizetip.remove(),this.sizetip=this.tooltip=c,d(window).unbind("resize.jqs scroll.jqs")}}),E=function(){p(D)},d(E),J=[],d.fn.sparkline=function(b,e){return this.each(function(){var f,g,h=new d.fn.sparkline.options(this,e),i=d(this);if(f=function(){var e,f,g,j,k,l,m;return"html"===b||b===c?(m=this.getAttribute(h.get("tagValuesAttribute")),(m===c||null===m)&&(m=i.html()),e=m.replace(/(^\s*<!--)|(-->\s*$)|\s+/g,"").split(",")):e=b,f="auto"===h.get("width")?e.length*h.get("defaultPixelsPerValue"):h.get("width"),"auto"===h.get("height")?h.get("composite")&&d.data(this,"_jqs_vcanvas")||(j=a.createElement("span"),j.innerHTML="a",i.html(j),g=d(j).innerHeight()||d(j).height(),d(j).remove(),j=null):g=h.get("height"),h.get("disableInteraction")?k=!1:(k=d.data(this,"_jqs_mhandler"),k?h.get("composite")||k.reset():(k=new t(this,h),d.data(this,"_jqs_mhandler",k))),h.get("composite")&&!d.data(this,"_jqs_vcanvas")?void(d.data(this,"_jqs_errnotify")||(alert("Attempted to attach a composite sparkline to an element with no existing sparkline"),d.data(this,"_jqs_errnotify",!0))):(l=new(d.fn.sparkline[h.get("type")])(this,e,h,f,g),l.render(),void(k&&k.registerSparkline(l)))},d(this).html()&&!h.get("disableHiddenCheck")&&d(this).is(":hidden")||!d(this).parents("body").length){if(!h.get("composite")&&d.data(this,"_jqs_pending"))for(g=J.length;g;g--)J[g-1][0]==this&&J.splice(g-1,1);J.push([this,f]),d.data(this,"_jqs_pending",!0)}else f.call(this)})},d.fn.sparkline.defaults=e(),d.sparkline_display_visible=function(){var a,b,c,e=[];for(b=0,c=J.length;c>b;b++)a=J[b][0],d(a).is(":visible")&&!d(a).parents().is(":hidden")?(J[b][1].call(a),d.data(J[b][0],"_jqs_pending",!1),e.push(b)):d(a).closest("html").length||d.data(a,"_jqs_pending")||(d.data(J[b][0],"_jqs_pending",!1),e.push(b));for(b=e.length;b;b--)J.splice(e[b-1],1)},d.fn.sparkline.options=f({init:function(a,b){var c,e,f,g;this.userOptions=b=b||{},this.tag=a,this.tagValCache={},e=d.fn.sparkline.defaults,f=e.common,this.tagOptionsPrefix=b.enableTagOptions&&(b.tagOptionsPrefix||f.tagOptionsPrefix),g=this.getTagSetting("type"),c=g===K?e[b.type||f.type]:e[g],this.mergedOptions=d.extend({},f,c,b)},getTagSetting:function(a){var b,d,e,f,g=this.tagOptionsPrefix;if(g===!1||g===c)return K;if(this.tagValCache.hasOwnProperty(a))b=this.tagValCache.key;else{if(b=this.tag.getAttribute(g+a),b===c||null===b)b=K;else if("["===b.substr(0,1))for(b=b.substr(1,b.length-2).split(","),d=b.length;d--;)b[d]=j(b[d].replace(/(^\s*)|(\s*$)/g,""));else if("{"===b.substr(0,1))for(e=b.substr(1,b.length-2).split(","),b={},d=e.length;d--;)f=e[d].split(":",2),b[f[0].replace(/(^\s*)|(\s*$)/g,"")]=j(f[1].replace(/(^\s*)|(\s*$)/g,""));else b=j(b);this.tagValCache.key=b}return b},get:function(a,b){var d,e=this.getTagSetting(a);return e!==K?e:(d=this.mergedOptions[a])===c?b:d}}),d.fn.sparkline._base=f({disabled:!1,init:function(a,b,e,f,g){this.el=a,this.$el=d(a),this.values=b,this.options=e,this.width=f,this.height=g,this.currentRegion=c},initTarget:function(){var a=!this.options.get("disableInteraction");(this.target=this.$el.simpledraw(this.width,this.height,this.options.get("composite"),a))?(this.canvasWidth=this.target.pixelWidth,this.canvasHeight=this.target.pixelHeight):this.disabled=!0},render:function(){return this.disabled?(this.el.innerHTML="",!1):!0},getRegion:function(){},setRegionHighlight:function(a,b,d){var e,f=this.currentRegion,g=!this.options.get("disableHighlight");return b>this.canvasWidth||d>this.canvasHeight||0>b||0>d?null:(e=this.getRegion(a,b,d),f!==e?(f!==c&&g&&this.removeHighlight(),this.currentRegion=e,e!==c&&g&&this.renderHighlight(),!0):!1)},clearRegionHighlight:function(){return this.currentRegion!==c?(this.removeHighlight(),this.currentRegion=c,!0):!1},renderHighlight:function(){this.changeHighlight(!0)},removeHighlight:function(){this.changeHighlight(!1)},changeHighlight:function(){},getCurrentRegionTooltip:function(){var a,b,e,f,h,i,j,k,l,m,n,o,p,q,r=this.options,s="",t=[];if(this.currentRegion===c)return"";if(a=this.getCurrentRegionFields(),n=r.get("tooltipFormatter"))return n(this,r,a);if(r.get("tooltipChartTitle")&&(s+='<div class="jqs jqstitle">'+r.get("tooltipChartTitle")+"</div>\n"),b=this.options.get("tooltipFormat"),!b)return"";if(d.isArray(b)||(b=[b]),d.isArray(a)||(a=[a]),j=this.options.get("tooltipFormatFieldlist"),k=this.options.get("tooltipFormatFieldlistKey"),j&&k){for(l=[],i=a.length;i--;)m=a[i][k],-1!=(q=d.inArray(m,j))&&(l[q]=a[i]);a=l}for(e=b.length,p=a.length,i=0;e>i;i++)for(o=b[i],"string"==typeof o&&(o=new g(o)),f=o.fclass||"jqsfield",q=0;p>q;q++)a[q].isNull&&r.get("tooltipSkipNull")||(d.extend(a[q],{prefix:r.get("tooltipPrefix"),suffix:r.get("tooltipSuffix")}),h=o.render(a[q],r.get("tooltipValueLookups"),r),t.push('<div class="'+f+'">'+h+"</div>"));return t.length?s+t.join("\n"):""},getCurrentRegionFields:function(){},calcHighlightColor:function(a,c){var d,e,f,g,i=c.get("highlightColor"),j=c.get("highlightLighten");if(i)return i;if(j&&(d=/^#([0-9a-f])([0-9a-f])([0-9a-f])$/i.exec(a)||/^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i.exec(a))){for(f=[],e=4===a.length?16:1,g=0;3>g;g++)f[g]=h(b.round(parseInt(d[g+1],16)*e*j),0,255);return"rgb("+f.join(",")+")"}return a}}),v={changeHighlight:function(a){var b,c=this.currentRegion,e=this.target,f=this.regionShapes[c];f&&(b=this.renderRegion(c,a),d.isArray(b)||d.isArray(f)?(e.replaceWithShapes(f,b),this.regionShapes[c]=d.map(b,function(a){return a.id})):(e.replaceWithShape(f,b),this.regionShapes[c]=b.id))},render:function(){var a,b,c,e,f=this.values,g=this.target,h=this.regionShapes;if(this.cls._super.render.call(this)){for(c=f.length;c--;)if(a=this.renderRegion(c))if(d.isArray(a)){for(b=[],e=a.length;e--;)a[e].append(),b.push(a[e].id);h[c]=b}else a.append(),h[c]=a.id;else h[c]=null;g.render()}}},d.fn.sparkline.line=w=f(d.fn.sparkline._base,{type:"line",init:function(a,b,c,d,e){w._super.init.call(this,a,b,c,d,e),this.vertices=[],this.regionMap=[],this.xvalues=[],this.yvalues=[],this.yminmax=[],this.hightlightSpotId=null,this.lastShapeId=null,this.initTarget()},getRegion:function(a,b){var d,e=this.regionMap;for(d=e.length;d--;)if(null!==e[d]&&b>=e[d][0]&&b<=e[d][1])return e[d][2];return c},getCurrentRegionFields:function(){var a=this.currentRegion;return{isNull:null===this.yvalues[a],x:this.xvalues[a],y:this.yvalues[a],color:this.options.get("lineColor"),fillColor:this.options.get("fillColor"),offset:a}},renderHighlight:function(){var a,b,d=this.currentRegion,e=this.target,f=this.vertices[d],g=this.options,h=g.get("spotRadius"),i=g.get("highlightSpotColor"),j=g.get("highlightLineColor");f&&(h&&i&&(a=e.drawCircle(f[0],f[1],h,c,i),this.highlightSpotId=a.id,e.insertAfterShape(this.lastShapeId,a)),j&&(b=e.drawLine(f[0],this.canvasTop,f[0],this.canvasTop+this.canvasHeight,j),this.highlightLineId=b.id,e.insertAfterShape(this.lastShapeId,b)))},removeHighlight:function(){var a=this.target;this.highlightSpotId&&(a.removeShapeId(this.highlightSpotId),this.highlightSpotId=null),this.highlightLineId&&(a.removeShapeId(this.highlightLineId),this.highlightLineId=null)},scanValues:function(){var a,c,d,e,f,g=this.values,h=g.length,i=this.xvalues,j=this.yvalues,k=this.yminmax;for(a=0;h>a;a++)c=g[a],d="string"==typeof g[a],e="object"==typeof g[a]&&g[a]instanceof Array,f=d&&g[a].split(":"),d&&2===f.length?(i.push(Number(f[0])),j.push(Number(f[1])),k.push(Number(f[1]))):e?(i.push(c[0]),j.push(c[1]),k.push(c[1])):(i.push(a),null===g[a]||"null"===g[a]?j.push(null):(j.push(Number(c)),k.push(Number(c))));this.options.get("xvalues")&&(i=this.options.get("xvalues")),this.maxy=this.maxyorg=b.max.apply(b,k),this.miny=this.minyorg=b.min.apply(b,k),this.maxx=b.max.apply(b,i),this.minx=b.min.apply(b,i),this.xvalues=i,this.yvalues=j,this.yminmax=k},processRangeOptions:function(){var a=this.options,b=a.get("normalRangeMin"),d=a.get("normalRangeMax");b!==c&&(b<this.miny&&(this.miny=b),d>this.maxy&&(this.maxy=d)),a.get("chartRangeMin")!==c&&(a.get("chartRangeClip")||a.get("chartRangeMin")<this.miny)&&(this.miny=a.get("chartRangeMin")),a.get("chartRangeMax")!==c&&(a.get("chartRangeClip")||a.get("chartRangeMax")>this.maxy)&&(this.maxy=a.get("chartRangeMax")),a.get("chartRangeMinX")!==c&&(a.get("chartRangeClipX")||a.get("chartRangeMinX")<this.minx)&&(this.minx=a.get("chartRangeMinX")),a.get("chartRangeMaxX")!==c&&(a.get("chartRangeClipX")||a.get("chartRangeMaxX")>this.maxx)&&(this.maxx=a.get("chartRangeMaxX"))},drawNormalRange:function(a,d,e,f,g){var h=this.options.get("normalRangeMin"),i=this.options.get("normalRangeMax"),j=d+b.round(e-e*((i-this.miny)/g)),k=b.round(e*(i-h)/g);this.target.drawRect(a,j,f,k,c,this.options.get("normalRangeColor")).append()},render:function(){var a,e,f,g,h,i,j,k,l,m,n,o,p,q,r,t,u,v,x,y,z,A,B,C,D,E=this.options,F=this.target,G=this.canvasWidth,H=this.canvasHeight,I=this.vertices,J=E.get("spotRadius"),K=this.regionMap;if(w._super.render.call(this)&&(this.scanValues(),this.processRangeOptions(),B=this.xvalues,C=this.yvalues,this.yminmax.length&&!(this.yvalues.length<2))){for(g=h=0,a=this.maxx-this.minx===0?1:this.maxx-this.minx,e=this.maxy-this.miny===0?1:this.maxy-this.miny,f=this.yvalues.length-1,J&&(4*J>G||4*J>H)&&(J=0),J&&(z=E.get("highlightSpotColor")&&!E.get("disableInteraction"),(z||E.get("minSpotColor")||E.get("spotColor")&&C[f]===this.miny)&&(H-=b.ceil(J)),(z||E.get("maxSpotColor")||E.get("spotColor")&&C[f]===this.maxy)&&(H-=b.ceil(J),g+=b.ceil(J)),(z||(E.get("minSpotColor")||E.get("maxSpotColor"))&&(C[0]===this.miny||C[0]===this.maxy))&&(h+=b.ceil(J),G-=b.ceil(J)),(z||E.get("spotColor")||E.get("minSpotColor")||E.get("maxSpotColor")&&(C[f]===this.miny||C[f]===this.maxy))&&(G-=b.ceil(J))),H--,E.get("normalRangeMin")===c||E.get("drawNormalOnTop")||this.drawNormalRange(h,g,H,G,e),j=[],k=[j],q=r=null,t=C.length,D=0;t>D;D++)l=B[D],n=B[D+1],m=C[D],o=h+b.round((l-this.minx)*(G/a)),p=t-1>D?h+b.round((n-this.minx)*(G/a)):G,r=o+(p-o)/2,K[D]=[q||0,r,D],q=r,null===m?D&&(null!==C[D-1]&&(j=[],k.push(j)),I.push(null)):(m<this.miny&&(m=this.miny),m>this.maxy&&(m=this.maxy),j.length||j.push([o,g+H]),i=[o,g+b.round(H-H*((m-this.miny)/e))],j.push(i),I.push(i));for(u=[],v=[],x=k.length,D=0;x>D;D++)j=k[D],j.length&&(E.get("fillColor")&&(j.push([j[j.length-1][0],g+H]),v.push(j.slice(0)),j.pop()),j.length>2&&(j[0]=[j[0][0],j[1][1]]),u.push(j));for(x=v.length,D=0;x>D;D++)F.drawShape(v[D],E.get("fillColor"),E.get("fillColor")).append();for(E.get("normalRangeMin")!==c&&E.get("drawNormalOnTop")&&this.drawNormalRange(h,g,H,G,e),x=u.length,D=0;x>D;D++)F.drawShape(u[D],E.get("lineColor"),c,E.get("lineWidth")).append();if(J&&E.get("valueSpots"))for(y=E.get("valueSpots"),y.get===c&&(y=new s(y)),D=0;t>D;D++)A=y.get(C[D]),A&&F.drawCircle(h+b.round((B[D]-this.minx)*(G/a)),g+b.round(H-H*((C[D]-this.miny)/e)),J,c,A).append();J&&E.get("spotColor")&&null!==C[f]&&F.drawCircle(h+b.round((B[B.length-1]-this.minx)*(G/a)),g+b.round(H-H*((C[f]-this.miny)/e)),J,c,E.get("spotColor")).append(),this.maxy!==this.minyorg&&(J&&E.get("minSpotColor")&&(l=B[d.inArray(this.minyorg,C)],F.drawCircle(h+b.round((l-this.minx)*(G/a)),g+b.round(H-H*((this.minyorg-this.miny)/e)),J,c,E.get("minSpotColor")).append()),J&&E.get("maxSpotColor")&&(l=B[d.inArray(this.maxyorg,C)],F.drawCircle(h+b.round((l-this.minx)*(G/a)),g+b.round(H-H*((this.maxyorg-this.miny)/e)),J,c,E.get("maxSpotColor")).append())),this.lastShapeId=F.getLastShapeId(),this.canvasTop=g,F.render()}}}),d.fn.sparkline.bar=x=f(d.fn.sparkline._base,v,{type:"bar",init:function(a,e,f,g,i){var m,n,o,p,q,r,t,u,v,w,y,z,A,B,C,D,E,F,G,H,I,J,K=parseInt(f.get("barWidth"),10),L=parseInt(f.get("barSpacing"),10),M=f.get("chartRangeMin"),N=f.get("chartRangeMax"),O=f.get("chartRangeClip"),P=1/0,Q=-1/0;for(x._super.init.call(this,a,e,f,g,i),r=0,t=e.length;t>r;r++)H=e[r],m="string"==typeof H&&H.indexOf(":")>-1,(m||d.isArray(H))&&(C=!0,m&&(H=e[r]=k(H.split(":"))),H=l(H,null),n=b.min.apply(b,H),o=b.max.apply(b,H),P>n&&(P=n),o>Q&&(Q=o));this.stacked=C,this.regionShapes={},this.barWidth=K,this.barSpacing=L,this.totalBarWidth=K+L,this.width=g=e.length*K+(e.length-1)*L,this.initTarget(),O&&(A=M===c?-1/0:M,B=N===c?1/0:N),q=[],p=C?[]:q;var R=[],S=[];for(r=0,t=e.length;t>r;r++)if(C)for(D=e[r],e[r]=G=[],R[r]=0,p[r]=S[r]=0,E=0,F=D.length;F>E;E++)H=G[E]=O?h(D[E],A,B):D[E],null!==H&&(H>0&&(R[r]+=H),0>P&&Q>0?0>H?S[r]+=b.abs(H):p[r]+=H:p[r]+=b.abs(H-(0>H?Q:P)),q.push(H));else H=O?h(e[r],A,B):e[r],H=e[r]=j(H),null!==H&&q.push(H);this.max=z=b.max.apply(b,q),this.min=y=b.min.apply(b,q),this.stackMax=Q=C?b.max.apply(b,R):z,this.stackMin=P=C?b.min.apply(b,q):y,f.get("chartRangeMin")!==c&&(f.get("chartRangeClip")||f.get("chartRangeMin")<y)&&(y=f.get("chartRangeMin")),f.get("chartRangeMax")!==c&&(f.get("chartRangeClip")||f.get("chartRangeMax")>z)&&(z=f.get("chartRangeMax")),this.zeroAxis=v=f.get("zeroAxis",!0),w=0>=y&&z>=0&&v?0:0==v?y:y>0?y:z,this.xaxisOffset=w,u=C?b.max.apply(b,p)+b.max.apply(b,S):z-y,this.canvasHeightEf=v&&0>y?this.canvasHeight-2:this.canvasHeight-1,w>y?(J=C&&z>=0?Q:z,I=(J-w)/u*this.canvasHeight,I!==b.ceil(I)&&(this.canvasHeightEf-=2,I=b.ceil(I))):I=this.canvasHeight,this.yoffset=I,d.isArray(f.get("colorMap"))?(this.colorMapByIndex=f.get("colorMap"),this.colorMapByValue=null):(this.colorMapByIndex=null,this.colorMapByValue=f.get("colorMap"),this.colorMapByValue&&this.colorMapByValue.get===c&&(this.colorMapByValue=new s(this.colorMapByValue))),this.range=u},getRegion:function(a,d){var e=b.floor(d/this.totalBarWidth);return 0>e||e>=this.values.length?c:e},getCurrentRegionFields:function(){var a,b,c=this.currentRegion,d=q(this.values[c]),e=[];for(b=d.length;b--;)a=d[b],e.push({isNull:null===a,value:a,color:this.calcColor(b,a,c),offset:c});return e},calcColor:function(a,b,e){var f,g,h=this.colorMapByIndex,i=this.colorMapByValue,j=this.options;return f=j.get(this.stacked?"stackedBarColor":0>b?"negBarColor":"barColor"),0===b&&j.get("zeroColor")!==c&&(f=j.get("zeroColor")),i&&(g=i.get(b))?f=g:h&&h.length>e&&(f=h[e]),d.isArray(f)?f[a%f.length]:f},renderRegion:function(a,e){var f,g,h,i,j,k,l,m,o,p,q=this.values[a],r=this.options,s=this.xaxisOffset,t=[],u=this.range,v=this.stacked,w=this.target,x=a*this.totalBarWidth,y=this.canvasHeightEf,z=this.yoffset;if(q=d.isArray(q)?q:[q],l=q.length,m=q[0],i=n(null,q),p=n(s,q,!0),i)return r.get("nullColor")?(h=e?r.get("nullColor"):this.calcHighlightColor(r.get("nullColor"),r),f=z>0?z-1:z,w.drawRect(x,f,this.barWidth-1,0,h,h)):c;for(j=z,k=0;l>k;k++){if(m=q[k],v&&m===s){if(!p||o)continue;o=!0}g=u>0?b.floor(y*(b.abs(m-s)/u))+1:1,s>m||m===s&&0===z?(f=j,j+=g):(f=z-g,z-=g),h=this.calcColor(k,m,a),e&&(h=this.calcHighlightColor(h,r)),t.push(w.drawRect(x,f,this.barWidth-1,g-1,h,h))}return 1===t.length?t[0]:t}}),d.fn.sparkline.tristate=y=f(d.fn.sparkline._base,v,{type:"tristate",init:function(a,b,e,f,g){var h=parseInt(e.get("barWidth"),10),i=parseInt(e.get("barSpacing"),10);y._super.init.call(this,a,b,e,f,g),this.regionShapes={},this.barWidth=h,this.barSpacing=i,this.totalBarWidth=h+i,this.values=d.map(b,Number),this.width=f=b.length*h+(b.length-1)*i,d.isArray(e.get("colorMap"))?(this.colorMapByIndex=e.get("colorMap"),this.colorMapByValue=null):(this.colorMapByIndex=null,this.colorMapByValue=e.get("colorMap"),this.colorMapByValue&&this.colorMapByValue.get===c&&(this.colorMapByValue=new s(this.colorMapByValue))),this.initTarget()},getRegion:function(a,c){return b.floor(c/this.totalBarWidth)},getCurrentRegionFields:function(){var a=this.currentRegion;return{isNull:this.values[a]===c,value:this.values[a],color:this.calcColor(this.values[a],a),offset:a}},calcColor:function(a,b){var c,d,e=this.values,f=this.options,g=this.colorMapByIndex,h=this.colorMapByValue;return c=h&&(d=h.get(a))?d:g&&g.length>b?g[b]:f.get(e[b]<0?"negBarColor":e[b]>0?"posBarColor":"zeroBarColor")},renderRegion:function(a,c){var d,e,f,g,h,i,j=this.values,k=this.options,l=this.target;return d=l.pixelHeight,f=b.round(d/2),g=a*this.totalBarWidth,j[a]<0?(h=f,e=f-1):j[a]>0?(h=0,e=f-1):(h=f-1,e=2),i=this.calcColor(j[a],a),null!==i?(c&&(i=this.calcHighlightColor(i,k)),l.drawRect(g,h,this.barWidth-1,e-1,i,i)):void 0}}),d.fn.sparkline.discrete=z=f(d.fn.sparkline._base,v,{type:"discrete",init:function(a,e,f,g,h){z._super.init.call(this,a,e,f,g,h),this.regionShapes={},this.values=e=d.map(e,Number),this.min=b.min.apply(b,e),this.max=b.max.apply(b,e),this.range=this.max-this.min,this.width=g="auto"===f.get("width")?2*e.length:this.width,this.interval=b.floor(g/e.length),this.itemWidth=g/e.length,f.get("chartRangeMin")!==c&&(f.get("chartRangeClip")||f.get("chartRangeMin")<this.min)&&(this.min=f.get("chartRangeMin")),f.get("chartRangeMax")!==c&&(f.get("chartRangeClip")||f.get("chartRangeMax")>this.max)&&(this.max=f.get("chartRangeMax")),this.initTarget(),this.target&&(this.lineHeight="auto"===f.get("lineHeight")?b.round(.3*this.canvasHeight):f.get("lineHeight"))},getRegion:function(a,c){return b.floor(c/this.itemWidth)},getCurrentRegionFields:function(){var a=this.currentRegion;return{isNull:this.values[a]===c,value:this.values[a],offset:a}},renderRegion:function(a,c){var d,e,f,g,i=this.values,j=this.options,k=this.min,l=this.max,m=this.range,n=this.interval,o=this.target,p=this.canvasHeight,q=this.lineHeight,r=p-q;return e=h(i[a],k,l),g=a*n,d=b.round(r-r*((e-k)/m)),f=j.get(j.get("thresholdColor")&&e<j.get("thresholdValue")?"thresholdColor":"lineColor"),c&&(f=this.calcHighlightColor(f,j)),o.drawLine(g,d,g,d+q,f)}}),d.fn.sparkline.bullet=A=f(d.fn.sparkline._base,{type:"bullet",init:function(a,d,e,f,g){var h,i,j;A._super.init.call(this,a,d,e,f,g),this.values=d=k(d),j=d.slice(),j[0]=null===j[0]?j[2]:j[0],j[1]=null===d[1]?j[2]:j[1],h=b.min.apply(b,d),i=b.max.apply(b,d),h=e.get("base")===c?0>h?h:0:e.get("base"),this.min=h,this.max=i,this.range=i-h,this.shapes={},this.valueShapes={},this.regiondata={},this.width=f="auto"===e.get("width")?"4.0em":f,this.target=this.$el.simpledraw(f,g,e.get("composite")),d.length||(this.disabled=!0),this.initTarget()},getRegion:function(a,b,d){var e=this.target.getShapeAt(a,b,d);return e!==c&&this.shapes[e]!==c?this.shapes[e]:c},getCurrentRegionFields:function(){var a=this.currentRegion;return{fieldkey:a.substr(0,1),value:this.values[a.substr(1)],region:a}},changeHighlight:function(a){var b,c=this.currentRegion,d=this.valueShapes[c];switch(delete this.shapes[d],c.substr(0,1)){case"r":b=this.renderRange(c.substr(1),a);break;case"p":b=this.renderPerformance(a);break;case"t":b=this.renderTarget(a)}this.valueShapes[c]=b.id,this.shapes[b.id]=c,this.target.replaceWithShape(d,b)},renderRange:function(a,c){var d=this.values[a],e=b.round(this.canvasWidth*((d-this.min)/this.range)),f=this.options.get("rangeColors")[a-2];return c&&(f=this.calcHighlightColor(f,this.options)),this.target.drawRect(0,0,e-1,this.canvasHeight-1,f,f)},renderPerformance:function(a){var c=this.values[1],d=b.round(this.canvasWidth*((c-this.min)/this.range)),e=this.options.get("performanceColor");return a&&(e=this.calcHighlightColor(e,this.options)),this.target.drawRect(0,b.round(.3*this.canvasHeight),d-1,b.round(.4*this.canvasHeight)-1,e,e)},renderTarget:function(a){var c=this.values[0],d=b.round(this.canvasWidth*((c-this.min)/this.range)-this.options.get("targetWidth")/2),e=b.round(.1*this.canvasHeight),f=this.canvasHeight-2*e,g=this.options.get("targetColor");return a&&(g=this.calcHighlightColor(g,this.options)),this.target.drawRect(d,e,this.options.get("targetWidth")-1,f-1,g,g)},render:function(){var a,b,c=this.values.length,d=this.target;if(A._super.render.call(this)){for(a=2;c>a;a++)b=this.renderRange(a).append(),this.shapes[b.id]="r"+a,this.valueShapes["r"+a]=b.id;null!==this.values[1]&&(b=this.renderPerformance().append(),this.shapes[b.id]="p1",this.valueShapes.p1=b.id),null!==this.values[0]&&(b=this.renderTarget().append(),this.shapes[b.id]="t0",this.valueShapes.t0=b.id),d.render()}}}),d.fn.sparkline.pie=B=f(d.fn.sparkline._base,{type:"pie",init:function(a,c,e,f,g){var h,i=0;if(B._super.init.call(this,a,c,e,f,g),this.shapes={},this.valueShapes={},this.values=c=d.map(c,Number),"auto"===e.get("width")&&(this.width=this.height),c.length>0)for(h=c.length;h--;)i+=c[h];this.total=i,this.initTarget(),this.radius=b.floor(b.min(this.canvasWidth,this.canvasHeight)/2)},getRegion:function(a,b,d){var e=this.target.getShapeAt(a,b,d);return e!==c&&this.shapes[e]!==c?this.shapes[e]:c},getCurrentRegionFields:function(){var a=this.currentRegion;return{isNull:this.values[a]===c,value:this.values[a],percent:this.values[a]/this.total*100,color:this.options.get("sliceColors")[a%this.options.get("sliceColors").length],offset:a}},changeHighlight:function(a){var b=this.currentRegion,c=this.renderSlice(b,a),d=this.valueShapes[b];delete this.shapes[d],this.target.replaceWithShape(d,c),this.valueShapes[b]=c.id,this.shapes[c.id]=b},renderSlice:function(a,d){var e,f,g,h,i,j=this.target,k=this.options,l=this.radius,m=k.get("borderWidth"),n=k.get("offset"),o=2*b.PI,p=this.values,q=this.total,r=n?2*b.PI*(n/360):0;for(h=p.length,g=0;h>g;g++){if(e=r,f=r,q>0&&(f=r+o*(p[g]/q)),a===g)return i=k.get("sliceColors")[g%k.get("sliceColors").length],d&&(i=this.calcHighlightColor(i,k)),j.drawPieSlice(l,l,l-m,e,f,c,i);r=f}},render:function(){var a,d,e=this.target,f=this.values,g=this.options,h=this.radius,i=g.get("borderWidth");
if(B._super.render.call(this)){for(i&&e.drawCircle(h,h,b.floor(h-i/2),g.get("borderColor"),c,i).append(),d=f.length;d--;)f[d]&&(a=this.renderSlice(d).append(),this.valueShapes[d]=a.id,this.shapes[a.id]=d);e.render()}}}),d.fn.sparkline.box=C=f(d.fn.sparkline._base,{type:"box",init:function(a,b,c,e,f){C._super.init.call(this,a,b,c,e,f),this.values=d.map(b,Number),this.width="auto"===c.get("width")?"4.0em":e,this.initTarget(),this.values.length||(this.disabled=1)},getRegion:function(){return 1},getCurrentRegionFields:function(){var a=[{field:"lq",value:this.quartiles[0]},{field:"med",value:this.quartiles[1]},{field:"uq",value:this.quartiles[2]}];return this.loutlier!==c&&a.push({field:"lo",value:this.loutlier}),this.routlier!==c&&a.push({field:"ro",value:this.routlier}),this.lwhisker!==c&&a.push({field:"lw",value:this.lwhisker}),this.rwhisker!==c&&a.push({field:"rw",value:this.rwhisker}),a},render:function(){var a,d,e,f,g,h,j,k,l,m,n,o=this.target,p=this.values,q=p.length,r=this.options,s=this.canvasWidth,t=this.canvasHeight,u=r.get("chartRangeMin")===c?b.min.apply(b,p):r.get("chartRangeMin"),v=r.get("chartRangeMax")===c?b.max.apply(b,p):r.get("chartRangeMax"),w=0;if(C._super.render.call(this)){if(r.get("raw"))r.get("showOutliers")&&p.length>5?(d=p[0],a=p[1],f=p[2],g=p[3],h=p[4],j=p[5],k=p[6]):(a=p[0],f=p[1],g=p[2],h=p[3],j=p[4]);else if(p.sort(function(a,b){return a-b}),f=i(p,1),g=i(p,2),h=i(p,3),e=h-f,r.get("showOutliers")){for(a=j=c,l=0;q>l;l++)a===c&&p[l]>f-e*r.get("outlierIQR")&&(a=p[l]),p[l]<h+e*r.get("outlierIQR")&&(j=p[l]);d=p[0],k=p[q-1]}else a=p[0],j=p[q-1];this.quartiles=[f,g,h],this.lwhisker=a,this.rwhisker=j,this.loutlier=d,this.routlier=k,n=s/(v-u+1),r.get("showOutliers")&&(w=b.ceil(r.get("spotRadius")),s-=2*b.ceil(r.get("spotRadius")),n=s/(v-u+1),a>d&&o.drawCircle((d-u)*n+w,t/2,r.get("spotRadius"),r.get("outlierLineColor"),r.get("outlierFillColor")).append(),k>j&&o.drawCircle((k-u)*n+w,t/2,r.get("spotRadius"),r.get("outlierLineColor"),r.get("outlierFillColor")).append()),o.drawRect(b.round((f-u)*n+w),b.round(.1*t),b.round((h-f)*n),b.round(.8*t),r.get("boxLineColor"),r.get("boxFillColor")).append(),o.drawLine(b.round((a-u)*n+w),b.round(t/2),b.round((f-u)*n+w),b.round(t/2),r.get("lineColor")).append(),o.drawLine(b.round((a-u)*n+w),b.round(t/4),b.round((a-u)*n+w),b.round(t-t/4),r.get("whiskerColor")).append(),o.drawLine(b.round((j-u)*n+w),b.round(t/2),b.round((h-u)*n+w),b.round(t/2),r.get("lineColor")).append(),o.drawLine(b.round((j-u)*n+w),b.round(t/4),b.round((j-u)*n+w),b.round(t-t/4),r.get("whiskerColor")).append(),o.drawLine(b.round((g-u)*n+w),b.round(.1*t),b.round((g-u)*n+w),b.round(.9*t),r.get("medianColor")).append(),r.get("target")&&(m=b.ceil(r.get("spotRadius")),o.drawLine(b.round((r.get("target")-u)*n+w),b.round(t/2-m),b.round((r.get("target")-u)*n+w),b.round(t/2+m),r.get("targetColor")).append(),o.drawLine(b.round((r.get("target")-u)*n+w-m),b.round(t/2),b.round((r.get("target")-u)*n+w+m),b.round(t/2),r.get("targetColor")).append()),o.render()}}}),F=f({init:function(a,b,c,d){this.target=a,this.id=b,this.type=c,this.args=d},append:function(){return this.target.appendShape(this),this}}),G=f({_pxregex:/(\d+)(px)?\s*$/i,init:function(a,b,c){a&&(this.width=a,this.height=b,this.target=c,this.lastShapeId=null,c[0]&&(c=c[0]),d.data(c,"_jqs_vcanvas",this))},drawLine:function(a,b,c,d,e,f){return this.drawShape([[a,b],[c,d]],e,f)},drawShape:function(a,b,c,d){return this._genShape("Shape",[a,b,c,d])},drawCircle:function(a,b,c,d,e,f){return this._genShape("Circle",[a,b,c,d,e,f])},drawPieSlice:function(a,b,c,d,e,f,g){return this._genShape("PieSlice",[a,b,c,d,e,f,g])},drawRect:function(a,b,c,d,e,f){return this._genShape("Rect",[a,b,c,d,e,f])},getElement:function(){return this.canvas},getLastShapeId:function(){return this.lastShapeId},reset:function(){alert("reset not implemented")},_insert:function(a,b){d(b).html(a)},_calculatePixelDims:function(a,b,c){var e;e=this._pxregex.exec(b),this.pixelHeight=e?e[1]:d(c).height(),e=this._pxregex.exec(a),this.pixelWidth=e?e[1]:d(c).width()},_genShape:function(a,b){var c=L++;return b.unshift(c),new F(this,c,a,b)},appendShape:function(){alert("appendShape not implemented")},replaceWithShape:function(){alert("replaceWithShape not implemented")},insertAfterShape:function(){alert("insertAfterShape not implemented")},removeShapeId:function(){alert("removeShapeId not implemented")},getShapeAt:function(){alert("getShapeAt not implemented")},render:function(){alert("render not implemented")}}),H=f(G,{init:function(b,e,f,g){H._super.init.call(this,b,e,f),this.canvas=a.createElement("canvas"),f[0]&&(f=f[0]),d.data(f,"_jqs_vcanvas",this),d(this.canvas).css({display:"inline-block",width:b,height:e,verticalAlign:"top"}),this._insert(this.canvas,f),this._calculatePixelDims(b,e,this.canvas),this.canvas.width=this.pixelWidth,this.canvas.height=this.pixelHeight,this.interact=g,this.shapes={},this.shapeseq=[],this.currentTargetShapeId=c,d(this.canvas).css({width:this.pixelWidth,height:this.pixelHeight})},_getContext:function(a,b,d){var e=this.canvas.getContext("2d");return a!==c&&(e.strokeStyle=a),e.lineWidth=d===c?1:d,b!==c&&(e.fillStyle=b),e},reset:function(){var a=this._getContext();a.clearRect(0,0,this.pixelWidth,this.pixelHeight),this.shapes={},this.shapeseq=[],this.currentTargetShapeId=c},_drawShape:function(a,b,d,e,f){var g,h,i=this._getContext(d,e,f);for(i.beginPath(),i.moveTo(b[0][0]+.5,b[0][1]+.5),g=1,h=b.length;h>g;g++)i.lineTo(b[g][0]+.5,b[g][1]+.5);d!==c&&i.stroke(),e!==c&&i.fill(),this.targetX!==c&&this.targetY!==c&&i.isPointInPath(this.targetX,this.targetY)&&(this.currentTargetShapeId=a)},_drawCircle:function(a,d,e,f,g,h,i){var j=this._getContext(g,h,i);j.beginPath(),j.arc(d,e,f,0,2*b.PI,!1),this.targetX!==c&&this.targetY!==c&&j.isPointInPath(this.targetX,this.targetY)&&(this.currentTargetShapeId=a),g!==c&&j.stroke(),h!==c&&j.fill()},_drawPieSlice:function(a,b,d,e,f,g,h,i){var j=this._getContext(h,i);j.beginPath(),j.moveTo(b,d),j.arc(b,d,e,f,g,!1),j.lineTo(b,d),j.closePath(),h!==c&&j.stroke(),i&&j.fill(),this.targetX!==c&&this.targetY!==c&&j.isPointInPath(this.targetX,this.targetY)&&(this.currentTargetShapeId=a)},_drawRect:function(a,b,c,d,e,f,g){return this._drawShape(a,[[b,c],[b+d,c],[b+d,c+e],[b,c+e],[b,c]],f,g)},appendShape:function(a){return this.shapes[a.id]=a,this.shapeseq.push(a.id),this.lastShapeId=a.id,a.id},replaceWithShape:function(a,b){var c,d=this.shapeseq;for(this.shapes[b.id]=b,c=d.length;c--;)d[c]==a&&(d[c]=b.id);delete this.shapes[a]},replaceWithShapes:function(a,b){var c,d,e,f=this.shapeseq,g={};for(d=a.length;d--;)g[a[d]]=!0;for(d=f.length;d--;)c=f[d],g[c]&&(f.splice(d,1),delete this.shapes[c],e=d);for(d=b.length;d--;)f.splice(e,0,b[d].id),this.shapes[b[d].id]=b[d]},insertAfterShape:function(a,b){var c,d=this.shapeseq;for(c=d.length;c--;)if(d[c]===a)return d.splice(c+1,0,b.id),void(this.shapes[b.id]=b)},removeShapeId:function(a){var b,c=this.shapeseq;for(b=c.length;b--;)if(c[b]===a){c.splice(b,1);break}delete this.shapes[a]},getShapeAt:function(a,b,c){return this.targetX=b,this.targetY=c,this.render(),this.currentTargetShapeId},render:function(){var a,b,c,d=this.shapeseq,e=this.shapes,f=d.length,g=this._getContext();for(g.clearRect(0,0,this.pixelWidth,this.pixelHeight),c=0;f>c;c++)a=d[c],b=e[a],this["_draw"+b.type].apply(this,b.args);this.interact||(this.shapes={},this.shapeseq=[])}}),I=f(G,{init:function(b,c,e){var f;I._super.init.call(this,b,c,e),e[0]&&(e=e[0]),d.data(e,"_jqs_vcanvas",this),this.canvas=a.createElement("span"),d(this.canvas).css({display:"inline-block",position:"relative",overflow:"hidden",width:b,height:c,margin:"0px",padding:"0px",verticalAlign:"top"}),this._insert(this.canvas,e),this._calculatePixelDims(b,c,this.canvas),this.canvas.width=this.pixelWidth,this.canvas.height=this.pixelHeight,f='<v:group coordorigin="0 0" coordsize="'+this.pixelWidth+" "+this.pixelHeight+'" style="position:absolute;top:0;left:0;width:'+this.pixelWidth+"px;height="+this.pixelHeight+'px;"></v:group>',this.canvas.insertAdjacentHTML("beforeEnd",f),this.group=d(this.canvas).children()[0],this.rendered=!1,this.prerender=""},_drawShape:function(a,b,d,e,f){var g,h,i,j,k,l,m,n=[];for(m=0,l=b.length;l>m;m++)n[m]=""+b[m][0]+","+b[m][1];return g=n.splice(0,1),f=f===c?1:f,h=d===c?' stroked="false" ':' strokeWeight="'+f+'px" strokeColor="'+d+'" ',i=e===c?' filled="false"':' fillColor="'+e+'" filled="true" ',j=n[0]===n[n.length-1]?"x ":"",k='<v:shape coordorigin="0 0" coordsize="'+this.pixelWidth+" "+this.pixelHeight+'"  id="jqsshape'+a+'" '+h+i+' style="position:absolute;left:0px;top:0px;height:'+this.pixelHeight+"px;width:"+this.pixelWidth+'px;padding:0px;margin:0px;"  path="m '+g+" l "+n.join(", ")+" "+j+'e"> </v:shape>'},_drawCircle:function(a,b,d,e,f,g,h){var i,j,k;return b-=e,d-=e,i=f===c?' stroked="false" ':' strokeWeight="'+h+'px" strokeColor="'+f+'" ',j=g===c?' filled="false"':' fillColor="'+g+'" filled="true" ',k='<v:oval  id="jqsshape'+a+'" '+i+j+' style="position:absolute;top:'+d+"px; left:"+b+"px; width:"+2*e+"px; height:"+2*e+'px"></v:oval>'},_drawPieSlice:function(a,d,e,f,g,h,i,j){var k,l,m,n,o,p,q,r;if(g===h)return"";if(h-g===2*b.PI&&(g=0,h=2*b.PI),l=d+b.round(b.cos(g)*f),m=e+b.round(b.sin(g)*f),n=d+b.round(b.cos(h)*f),o=e+b.round(b.sin(h)*f),l===n&&m===o){if(h-g<b.PI)return"";l=n=d+f,m=o=e}return l===n&&m===o&&h-g<b.PI?"":(k=[d-f,e-f,d+f,e+f,l,m,n,o],p=i===c?' stroked="false" ':' strokeWeight="1px" strokeColor="'+i+'" ',q=j===c?' filled="false"':' fillColor="'+j+'" filled="true" ',r='<v:shape coordorigin="0 0" coordsize="'+this.pixelWidth+" "+this.pixelHeight+'"  id="jqsshape'+a+'" '+p+q+' style="position:absolute;left:0px;top:0px;height:'+this.pixelHeight+"px;width:"+this.pixelWidth+'px;padding:0px;margin:0px;"  path="m '+d+","+e+" wa "+k.join(", ")+' x e"> </v:shape>')},_drawRect:function(a,b,c,d,e,f,g){return this._drawShape(a,[[b,c],[b,c+e],[b+d,c+e],[b+d,c],[b,c]],f,g)},reset:function(){this.group.innerHTML=""},appendShape:function(a){var b=this["_draw"+a.type].apply(this,a.args);return this.rendered?this.group.insertAdjacentHTML("beforeEnd",b):this.prerender+=b,this.lastShapeId=a.id,a.id},replaceWithShape:function(a,b){var c=d("#jqsshape"+a),e=this["_draw"+b.type].apply(this,b.args);c[0].outerHTML=e},replaceWithShapes:function(a,b){var c,e=d("#jqsshape"+a[0]),f="",g=b.length;for(c=0;g>c;c++)f+=this["_draw"+b[c].type].apply(this,b[c].args);for(e[0].outerHTML=f,c=1;c<a.length;c++)d("#jqsshape"+a[c]).remove()},insertAfterShape:function(a,b){var c=d("#jqsshape"+a),e=this["_draw"+b.type].apply(this,b.args);c[0].insertAdjacentHTML("afterEnd",e)},removeShapeId:function(a){var b=d("#jqsshape"+a);this.group.removeChild(b[0])},getShapeAt:function(a){var b=a.id.substr(8);return b},render:function(){this.rendered||(this.group.innerHTML=this.prerender,this.rendered=!0)}})})}(document,Math);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a){var b=function(b,c){this.element=a(b),this.picker=a('<div class="slider"><div class="slider-track"><div class="slider-selection"></div><div class="slider-handle"></div><div class="slider-handle"></div></div><div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div></div>').insertBefore(this.element).prepend(this.element),this.id=this.element.data("slider-id")||c.id,this.id&&(this.picker[0].id=this.id),"undefined"!=typeof Modernizr&&Modernizr.touch&&(this.touchCapable=!0);var d=this.element.data("slider-tooltip")||c.tooltip;switch(this.tooltip=this.picker.find(".tooltip"),this.tooltipInner=this.tooltip.find("div.tooltip-inner"),this.orientation=this.element.data("slider-orientation")||c.orientation,this.orientation){case"vertical":this.picker.addClass("slider-vertical"),this.stylePos="top",this.mousePos="pageY",this.sizePos="offsetHeight",this.tooltip.addClass("right")[0].style.left="100%";break;default:this.picker.addClass("slider-horizontal").css("width",this.element.outerWidth()),this.orientation="horizontal",this.stylePos="left",this.mousePos="pageX",this.sizePos="offsetWidth",this.tooltip.addClass("top")[0].style.top=-this.tooltip.outerHeight()-14+"px"}this.min=this.element.data("slider-min")||c.min,this.max=this.element.data("slider-max")||c.max,this.step=this.element.data("slider-step")||c.step,this.value=this.element.data("slider-value")||c.value,this.value[1]&&(this.range=!0),this.selection=this.element.data("slider-selection")||c.selection,this.selectionEl=this.picker.find(".slider-selection"),"none"===this.selection&&this.selectionEl.addClass("hide"),this.selectionElStyle=this.selectionEl[0].style,this.handle1=this.picker.find(".slider-handle:first"),this.handle1Stype=this.handle1[0].style,this.handle2=this.picker.find(".slider-handle:last"),this.handle2Stype=this.handle2[0].style;var e=this.element.data("slider-handle")||c.handle;switch(e){case"round":this.handle1.addClass("round"),this.handle2.addClass("round");break;case"triangle":this.handle1.addClass("triangle"),this.handle2.addClass("triangle")}this.range?(this.value[0]=Math.max(this.min,Math.min(this.max,this.value[0])),this.value[1]=Math.max(this.min,Math.min(this.max,this.value[1]))):(this.value=[Math.max(this.min,Math.min(this.max,this.value))],this.handle2.addClass("hide"),this.value[1]="after"==this.selection?this.max:this.min),this.diff=this.max-this.min,this.percentage=[100*(this.value[0]-this.min)/this.diff,100*(this.value[1]-this.min)/this.diff,100*this.step/this.diff],this.offset=this.picker.offset(),this.size=this.picker[0][this.sizePos],this.formater=c.formater,this.layout(),this.picker.on(this.touchCapable?{touchstart:a.proxy(this.mousedown,this)}:{mousedown:a.proxy(this.mousedown,this)}),"show"===d?this.picker.on({mouseenter:a.proxy(this.showTooltip,this),mouseleave:a.proxy(this.hideTooltip,this)}):this.tooltip.addClass("hide")};b.prototype={constructor:b,over:!1,inDrag:!1,showTooltip:function(){this.tooltip.addClass("in"),this.over=!0},hideTooltip:function(){this.inDrag===!1&&this.tooltip.removeClass("in"),this.over=!1},layout:function(){this.handle1Stype[this.stylePos]=this.percentage[0]+"%",this.handle2Stype[this.stylePos]=this.percentage[1]+"%","vertical"==this.orientation?(this.selectionElStyle.top=Math.min(this.percentage[0],this.percentage[1])+"%",this.selectionElStyle.height=Math.abs(this.percentage[0]-this.percentage[1])+"%"):(this.selectionElStyle.left=Math.min(this.percentage[0],this.percentage[1])+"%",this.selectionElStyle.width=Math.abs(this.percentage[0]-this.percentage[1])+"%"),this.range?(this.tooltipInner.text(this.formater(this.value[0])+" : "+this.formater(this.value[1])),this.tooltip[0].style[this.stylePos]=this.size*(this.percentage[0]+(this.percentage[1]-this.percentage[0])/2)/100-("vertical"===this.orientation?this.tooltip.outerHeight()/2:this.tooltip.outerWidth()/2)+"px"):(this.tooltipInner.text(this.formater(this.value[0])),this.tooltip[0].style[this.stylePos]=this.size*this.percentage[0]/100-("vertical"===this.orientation?this.tooltip.outerHeight()/2:this.tooltip.outerWidth()/2)+"px")},mousedown:function(b){this.touchCapable&&"touchstart"===b.type&&(b=b.originalEvent),this.offset=this.picker.offset(),this.size=this.picker[0][this.sizePos];var c=this.getPercentage(b);if(this.range){var d=Math.abs(this.percentage[0]-c),e=Math.abs(this.percentage[1]-c);this.dragged=e>d?0:1}else this.dragged=0;this.percentage[this.dragged]=c,this.layout(),a(document).on(this.touchCapable?{touchmove:a.proxy(this.mousemove,this),touchend:a.proxy(this.mouseup,this)}:{mousemove:a.proxy(this.mousemove,this),mouseup:a.proxy(this.mouseup,this)}),this.inDrag=!0;var f=this.calculateValue();return this.element.trigger({type:"slideStart",value:f}).trigger({type:"slide",value:f}),!1},mousemove:function(a){this.touchCapable&&"touchmove"===a.type&&(a=a.originalEvent);var b=this.getPercentage(a);this.range&&(0===this.dragged&&this.percentage[1]<b?(this.percentage[0]=this.percentage[1],this.dragged=1):1===this.dragged&&this.percentage[0]>b&&(this.percentage[1]=this.percentage[0],this.dragged=0)),this.percentage[this.dragged]=b,this.layout();var c=this.calculateValue();return this.element.trigger({type:"slide",value:c}).data("value",c).prop("value",c),!1},mouseup:function(){a(document).off(this.touchCapable?{touchmove:this.mousemove,touchend:this.mouseup}:{mousemove:this.mousemove,mouseup:this.mouseup}),this.inDrag=!1,0==this.over&&this.hideTooltip(),this.element;var b=this.calculateValue();return this.element.trigger({type:"slideStop",value:b}).data("value",b).prop("value",b),!1},calculateValue:function(){var a;return this.range?(a=[this.min+Math.round(this.diff*this.percentage[0]/100/this.step)*this.step,this.min+Math.round(this.diff*this.percentage[1]/100/this.step)*this.step],this.value=a):(a=this.min+Math.round(this.diff*this.percentage[0]/100/this.step)*this.step,this.value=[a,this.value[1]]),a},getPercentage:function(a){this.touchCapable&&(a=a.touches[0]);var b=100*(a[this.mousePos]-this.offset[this.stylePos])/this.size;return b=Math.round(b/this.percentage[2])*this.percentage[2],Math.max(0,Math.min(100,b))},getValue:function(){return this.range?this.value:this.value[0]},setValue:function(a){this.value=a,this.range?(this.value[0]=Math.max(this.min,Math.min(this.max,this.value[0])),this.value[1]=Math.max(this.min,Math.min(this.max,this.value[1]))):(this.value=[Math.max(this.min,Math.min(this.max,this.value))],this.handle2.addClass("hide"),this.value[1]="after"==this.selection?this.max:this.min),this.diff=this.max-this.min,this.percentage=[100*(this.value[0]-this.min)/this.diff,100*(this.value[1]-this.min)/this.diff,100*this.step/this.diff],this.layout()}},a.fn.slider=function(c,d){return this.each(function(){var e=a(this),f=e.data("slider"),g="object"==typeof c&&c;f||e.data("slider",f=new b(this,a.extend({},a.fn.slider.defaults,g))),"string"==typeof c&&f[c](d)})},a.fn.slider.defaults={min:0,max:10,step:1,orientation:"horizontal",value:5,selection:"before",tooltip:"show",handle:"round",formater:function(a){return a}},a.fn.slider.Constructor=b}(window.jQuery);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(){if(!jQuery.browser){jQuery.browser={},jQuery.browser.mozilla=!1,jQuery.browser.webkit=!1,jQuery.browser.opera=!1,jQuery.browser.msie=!1;var a=navigator.userAgent;jQuery.browser.name=navigator.appName,jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10);var b,c,d;-1!=(c=a.indexOf("Opera"))?(jQuery.browser.opera=!0,jQuery.browser.name="Opera",jQuery.browser.fullVersion=a.substring(c+6),-1!=(c=a.indexOf("Version"))&&(jQuery.browser.fullVersion=a.substring(c+8))):-1!=(c=a.indexOf("MSIE"))?(jQuery.browser.msie=!0,jQuery.browser.name="Microsoft Internet Explorer",jQuery.browser.fullVersion=a.substring(c+5)):-1!=(c=a.indexOf("Chrome"))?(jQuery.browser.webkit=!0,jQuery.browser.name="Chrome",jQuery.browser.fullVersion=a.substring(c+7)):-1!=(c=a.indexOf("Safari"))?(jQuery.browser.webkit=!0,jQuery.browser.name="Safari",jQuery.browser.fullVersion=a.substring(c+7),-1!=(c=a.indexOf("Version"))&&(jQuery.browser.fullVersion=a.substring(c+8))):-1!=(c=a.indexOf("Firefox"))?(jQuery.browser.mozilla=!0,jQuery.browser.name="Firefox",jQuery.browser.fullVersion=a.substring(c+8)):(b=a.lastIndexOf(" ")+1)<(c=a.lastIndexOf("/"))&&(jQuery.browser.name=a.substring(b,c),jQuery.browser.fullVersion=a.substring(c+1),jQuery.browser.name.toLowerCase()==jQuery.browser.name.toUpperCase()&&(jQuery.browser.name=navigator.appName)),-1!=(d=jQuery.browser.fullVersion.indexOf(";"))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,d)),-1!=(d=jQuery.browser.fullVersion.indexOf(" "))&&(jQuery.browser.fullVersion=jQuery.browser.fullVersion.substring(0,d)),jQuery.browser.majorVersion=parseInt(""+jQuery.browser.fullVersion,10),isNaN(jQuery.browser.majorVersion)&&(jQuery.browser.fullVersion=""+parseFloat(navigator.appVersion),jQuery.browser.majorVersion=parseInt(navigator.appVersion,10)),jQuery.browser.version=jQuery.browser.majorVersion}}(jQuery);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */function FastClick(a){var b,c=this;if(this.trackingClick=!1,this.trackingClickStart=0,this.targetElement=null,this.lastTouchIdentifier=this.touchStartY=this.touchStartX=0,this.layer=a,!a||!a.nodeType)throw new TypeError("Layer must be a document node");this.onClick=function(){return FastClick.prototype.onClick.apply(c,arguments)},this.onMouse=function(){return FastClick.prototype.onMouse.apply(c,arguments)},this.onTouchStart=function(){return FastClick.prototype.onTouchStart.apply(c,arguments)},this.onTouchEnd=function(){return FastClick.prototype.onTouchEnd.apply(c,arguments)},this.onTouchCancel=function(){return FastClick.prototype.onTouchCancel.apply(c,arguments)},FastClick.notNeeded(a)||(this.deviceIsAndroid&&(a.addEventListener("mouseover",this.onMouse,!0),a.addEventListener("mousedown",this.onMouse,!0),a.addEventListener("mouseup",this.onMouse,!0)),a.addEventListener("click",this.onClick,!0),a.addEventListener("touchstart",this.onTouchStart,!1),a.addEventListener("touchend",this.onTouchEnd,!1),a.addEventListener("touchcancel",this.onTouchCancel,!1),Event.prototype.stopImmediatePropagation||(a.removeEventListener=function(b,c,d){var e=Node.prototype.removeEventListener;"click"===b?e.call(a,b,c.hijacked||c,d):e.call(a,b,c,d)},a.addEventListener=function(b,c,d){var e=Node.prototype.addEventListener;"click"===b?e.call(a,b,c.hijacked||(c.hijacked=function(a){a.propagationStopped||c(a)}),d):e.call(a,b,c,d)}),"function"==typeof a.onclick&&(b=a.onclick,a.addEventListener("click",function(a){b(a)},!1),a.onclick=null))}FastClick.prototype.deviceIsAndroid=0<navigator.userAgent.indexOf("Android"),FastClick.prototype.deviceIsIOS=/iP(ad|hone|od)/.test(navigator.userAgent),FastClick.prototype.deviceIsIOS4=FastClick.prototype.deviceIsIOS&&/OS 4_\d(_\d)?/.test(navigator.userAgent),FastClick.prototype.deviceIsIOSWithBadTarget=FastClick.prototype.deviceIsIOS&&/OS ([6-9]|\d{2})_\d/.test(navigator.userAgent),FastClick.prototype.needsClick=function(a){switch(a.nodeName.toLowerCase()){case"button":case"select":case"textarea":if(a.disabled)return!0;break;case"input":if(this.deviceIsIOS&&"file"===a.type||a.disabled)return!0;break;case"label":case"video":return!0}return/\bneedsclick\b/.test(a.className)},FastClick.prototype.needsFocus=function(a){switch(a.nodeName.toLowerCase()){case"textarea":case"select":return!0;case"input":switch(a.type){case"button":case"checkbox":case"file":case"image":case"radio":case"submit":return!1}return!a.disabled&&!a.readOnly;default:return/\bneedsfocus\b/.test(a.className)}},FastClick.prototype.sendClick=function(a,b){var c,d;document.activeElement&&document.activeElement!==a&&document.activeElement.blur(),d=b.changedTouches[0],c=document.createEvent("MouseEvents"),c.initMouseEvent("click",!0,!0,window,1,d.screenX,d.screenY,d.clientX,d.clientY,!1,!1,!1,!1,0,null),c.forwardedTouchEvent=!0,a.dispatchEvent(c)},FastClick.prototype.focus=function(a){var b;this.deviceIsIOS&&a.setSelectionRange?(b=a.value.length,a.setSelectionRange(b,b)):a.focus()},FastClick.prototype.updateScrollParent=function(a){var b,c;if(b=a.fastClickScrollParent,!b||!b.contains(a)){c=a;do{if(c.scrollHeight>c.offsetHeight){b=c,a.fastClickScrollParent=c;break}c=c.parentElement}while(c)}b&&(b.fastClickLastScrollTop=b.scrollTop)},FastClick.prototype.getTargetElementFromEventTarget=function(a){return a.nodeType===Node.TEXT_NODE?a.parentNode:a},FastClick.prototype.onTouchStart=function(a){var b,c,d;if(1<a.targetTouches.length)return!0;if(b=this.getTargetElementFromEventTarget(a.target),c=a.targetTouches[0],this.deviceIsIOS){if(d=window.getSelection(),d.rangeCount&&!d.isCollapsed)return!0;if(!this.deviceIsIOS4){if(c.identifier===this.lastTouchIdentifier)return a.preventDefault(),!1;this.lastTouchIdentifier=c.identifier,this.updateScrollParent(b)}}return this.trackingClick=!0,this.trackingClickStart=a.timeStamp,this.targetElement=b,this.touchStartX=c.pageX,this.touchStartY=c.pageY,200>a.timeStamp-this.lastClickTime&&a.preventDefault(),!0},FastClick.prototype.touchHasMoved=function(a){return a=a.changedTouches[0],10<Math.abs(a.pageX-this.touchStartX)||10<Math.abs(a.pageY-this.touchStartY)?!0:!1},FastClick.prototype.findControl=function(a){return void 0!==a.control?a.control:a.htmlFor?document.getElementById(a.htmlFor):a.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")},FastClick.prototype.onTouchEnd=function(a){var b,c,d;if(d=this.targetElement,this.touchHasMoved(a)&&(this.trackingClick=!1,this.targetElement=null),!this.trackingClick)return!0;if(200>a.timeStamp-this.lastClickTime)return this.cancelNextClick=!0;if(this.lastClickTime=a.timeStamp,b=this.trackingClickStart,this.trackingClick=!1,this.trackingClickStart=0,this.deviceIsIOSWithBadTarget&&(d=a.changedTouches[0],d=document.elementFromPoint(d.pageX-window.pageXOffset,d.pageY-window.pageYOffset)),c=d.tagName.toLowerCase(),"label"===c){if(b=this.findControl(d)){if(this.focus(d),this.deviceIsAndroid)return!1;d=b}}else if(this.needsFocus(d))return 100<a.timeStamp-b||this.deviceIsIOS&&window.top!==window&&"input"===c?(this.targetElement=null,!1):(this.focus(d),this.deviceIsIOS4&&"select"===c||(this.targetElement=null,a.preventDefault()),!1);return this.deviceIsIOS&&!this.deviceIsIOS4&&(b=d.fastClickScrollParent)&&b.fastClickLastScrollTop!==b.scrollTop?!0:(this.needsClick(d)||(a.preventDefault(),this.sendClick(d,a)),!1)},FastClick.prototype.onTouchCancel=function(){this.trackingClick=!1,this.targetElement=null},FastClick.prototype.onMouse=function(a){return this.targetElement&&!a.forwardedTouchEvent&&a.cancelable&&(!this.needsClick(this.targetElement)||this.cancelNextClick)?(a.stopImmediatePropagation?a.stopImmediatePropagation():a.propagationStopped=!0,a.stopPropagation(),a.preventDefault(),!1):!0},FastClick.prototype.onClick=function(a){return this.trackingClick?(this.targetElement=null,this.trackingClick=!1,!0):"submit"===a.target.type&&0===a.detail?!0:(a=this.onMouse(a),a||(this.targetElement=null),a)},FastClick.prototype.destroy=function(){var a=this.layer;this.deviceIsAndroid&&(a.removeEventListener("mouseover",this.onMouse,!0),a.removeEventListener("mousedown",this.onMouse,!0),a.removeEventListener("mouseup",this.onMouse,!0)),a.removeEventListener("click",this.onClick,!0),a.removeEventListener("touchstart",this.onTouchStart,!1),a.removeEventListener("touchend",this.onTouchEnd,!1),a.removeEventListener("touchcancel",this.onTouchCancel,!1)},FastClick.notNeeded=function(a){var b;if("undefined"==typeof window.ontouchstart)return!0;if(/Chrome\/[0-9]+/.test(navigator.userAgent)){if(!FastClick.prototype.deviceIsAndroid)return!0;if((b=document.querySelector("meta[name=viewport]"))&&-1!==b.content.indexOf("user-scalable=no"))return!0}return"none"===a.style.msTouchAction?!0:!1},FastClick.attach=function(a){return new FastClick(a)},"undefined"!=typeof define&&define.amd?define(function(){return FastClick}):"undefined"!=typeof module&&module.exports?(module.exports=FastClick.attach,module.exports.FastClick=FastClick):window.FastClick=FastClick;
/**
 * @license AngularJS v1.2.16
 * (c) 2010-2014 Google, Inc. http://angularjs.org
 * License: MIT
 */
(function(window, angular, undefined) {'use strict';

/**
 * @ngdoc module
 * @name ngRoute
 * @description
 *
 * # ngRoute
 *
 * The `ngRoute` module provides routing and deeplinking services and directives for angular apps.
 *
 * ## Example
 * See {@link ngRoute.$route#example $route} for an example of configuring and using `ngRoute`.
 *
 *
 * <div doc-module-components="ngRoute"></div>
 */
 /* global -ngRouteModule */
var ngRouteModule = angular.module('ngRoute', ['ng']).
                        provider('$route', $RouteProvider);

/**
 * @ngdoc provider
 * @name $routeProvider
 * @function
 *
 * @description
 *
 * Used for configuring routes.
 *
 * ## Example
 * See {@link ngRoute.$route#example $route} for an example of configuring and using `ngRoute`.
 *
 * ## Dependencies
 * Requires the {@link ngRoute `ngRoute`} module to be installed.
 */
function $RouteProvider(){
  function inherit(parent, extra) {
    return angular.extend(new (angular.extend(function() {}, {prototype:parent}))(), extra);
  }

  var routes = {};

  /**
   * @ngdoc method
   * @name $routeProvider#when
   *
   * @param {string} path Route path (matched against `$location.path`). If `$location.path`
   *    contains redundant trailing slash or is missing one, the route will still match and the
   *    `$location.path` will be updated to add or drop the trailing slash to exactly match the
   *    route definition.
   *
   *    * `path` can contain named groups starting with a colon: e.g. `:name`. All characters up
   *        to the next slash are matched and stored in `$routeParams` under the given `name`
   *        when the route matches.
   *    * `path` can contain named groups starting with a colon and ending with a star:
   *        e.g.`:name*`. All characters are eagerly stored in `$routeParams` under the given `name`
   *        when the route matches.
   *    * `path` can contain optional named groups with a question mark: e.g.`:name?`.
   *
   *    For example, routes like `/color/:color/largecode/:largecode*\/edit` will match
   *    `/color/brown/largecode/code/with/slashes/edit` and extract:
   *
   *    * `color: brown`
   *    * `largecode: code/with/slashes`.
   *
   *
   * @param {Object} route Mapping information to be assigned to `$route.current` on route
   *    match.
   *
   *    Object properties:
   *
   *    - `controller` – `{(string|function()=}` – Controller fn that should be associated with
   *      newly created scope or the name of a {@link angular.Module#controller registered
   *      controller} if passed as a string.
   *    - `controllerAs` – `{string=}` – A controller alias name. If present the controller will be
   *      published to scope under the `controllerAs` name.
   *    - `template` – `{string=|function()=}` – html template as a string or a function that
   *      returns an html template as a string which should be used by {@link
   *      ngRoute.directive:ngView ngView} or {@link ng.directive:ngInclude ngInclude} directives.
   *      This property takes precedence over `templateUrl`.
   *
   *      If `template` is a function, it will be called with the following parameters:
   *
   *      - `{Array.<Object>}` - route parameters extracted from the current
   *        `$location.path()` by applying the current route
   *
   *    - `templateUrl` – `{string=|function()=}` – path or function that returns a path to an html
   *      template that should be used by {@link ngRoute.directive:ngView ngView}.
   *
   *      If `templateUrl` is a function, it will be called with the following parameters:
   *
   *      - `{Array.<Object>}` - route parameters extracted from the current
   *        `$location.path()` by applying the current route
   *
   *    - `resolve` - `{Object.<string, function>=}` - An optional map of dependencies which should
   *      be injected into the controller. If any of these dependencies are promises, the router
   *      will wait for them all to be resolved or one to be rejected before the controller is
   *      instantiated.
   *      If all the promises are resolved successfully, the values of the resolved promises are
   *      injected and {@link ngRoute.$route#$routeChangeSuccess $routeChangeSuccess} event is
   *      fired. If any of the promises are rejected the
   *      {@link ngRoute.$route#$routeChangeError $routeChangeError} event is fired. The map object
   *      is:
   *
   *      - `key` – `{string}`: a name of a dependency to be injected into the controller.
   *      - `factory` - `{string|function}`: If `string` then it is an alias for a service.
   *        Otherwise if function, then it is {@link auto.$injector#invoke injected}
   *        and the return value is treated as the dependency. If the result is a promise, it is
   *        resolved before its value is injected into the controller. Be aware that
   *        `ngRoute.$routeParams` will still refer to the previous route within these resolve
   *        functions.  Use `$route.current.params` to access the new route parameters, instead.
   *
   *    - `redirectTo` – {(string|function())=} – value to update
   *      {@link ng.$location $location} path with and trigger route redirection.
   *
   *      If `redirectTo` is a function, it will be called with the following parameters:
   *
   *      - `{Object.<string>}` - route parameters extracted from the current
   *        `$location.path()` by applying the current route templateUrl.
   *      - `{string}` - current `$location.path()`
   *      - `{Object}` - current `$location.search()`
   *
   *      The custom `redirectTo` function is expected to return a string which will be used
   *      to update `$location.path()` and `$location.search()`.
   *
   *    - `[reloadOnSearch=true]` - {boolean=} - reload route when only `$location.search()`
   *      or `$location.hash()` changes.
   *
   *      If the option is set to `false` and url in the browser changes, then
   *      `$routeUpdate` event is broadcasted on the root scope.
   *
   *    - `[caseInsensitiveMatch=false]` - {boolean=} - match routes without being case sensitive
   *
   *      If the option is set to `true`, then the particular route can be matched without being
   *      case sensitive
   *
   * @returns {Object} self
   *
   * @description
   * Adds a new route definition to the `$route` service.
   */
  this.when = function(path, route) {
    routes[path] = angular.extend(
      {reloadOnSearch: true},
      route,
      path && pathRegExp(path, route)
    );

    // create redirection for trailing slashes
    if (path) {
      var redirectPath = (path[path.length-1] == '/')
            ? path.substr(0, path.length-1)
            : path +'/';

      routes[redirectPath] = angular.extend(
        {redirectTo: path},
        pathRegExp(redirectPath, route)
      );
    }

    return this;
  };

   /**
    * @param path {string} path
    * @param opts {Object} options
    * @return {?Object}
    *
    * @description
    * Normalizes the given path, returning a regular expression
    * and the original path.
    *
    * Inspired by pathRexp in visionmedia/express/lib/utils.js.
    */
  function pathRegExp(path, opts) {
    var insensitive = opts.caseInsensitiveMatch,
        ret = {
          originalPath: path,
          regexp: path
        },
        keys = ret.keys = [];

    path = path
      .replace(/([().])/g, '\\$1')
      .replace(/(\/)?:(\w+)([\?\*])?/g, function(_, slash, key, option){
        var optional = option === '?' ? option : null;
        var star = option === '*' ? option : null;
        keys.push({ name: key, optional: !!optional });
        slash = slash || '';
        return ''
          + (optional ? '' : slash)
          + '(?:'
          + (optional ? slash : '')
          + (star && '(.+?)' || '([^/]+)')
          + (optional || '')
          + ')'
          + (optional || '');
      })
      .replace(/([\/$\*])/g, '\\$1');

    ret.regexp = new RegExp('^' + path + '$', insensitive ? 'i' : '');
    return ret;
  }

  /**
   * @ngdoc method
   * @name $routeProvider#otherwise
   *
   * @description
   * Sets route definition that will be used on route change when no other route definition
   * is matched.
   *
   * @param {Object} params Mapping information to be assigned to `$route.current`.
   * @returns {Object} self
   */
  this.otherwise = function(params) {
    this.when(null, params);
    return this;
  };


  this.$get = ['$rootScope',
               '$location',
               '$routeParams',
               '$q',
               '$injector',
               '$http',
               '$templateCache',
               '$sce',
      function($rootScope, $location, $routeParams, $q, $injector, $http, $templateCache, $sce) {

    /**
     * @ngdoc service
     * @name $route
     * @requires $location
     * @requires $routeParams
     *
     * @property {Object} current Reference to the current route definition.
     * The route definition contains:
     *
     *   - `controller`: The controller constructor as define in route definition.
     *   - `locals`: A map of locals which is used by {@link ng.$controller $controller} service for
     *     controller instantiation. The `locals` contain
     *     the resolved values of the `resolve` map. Additionally the `locals` also contain:
     *
     *     - `$scope` - The current route scope.
     *     - `$template` - The current route template HTML.
     *
     * @property {Object} routes Object with all route configuration Objects as its properties.
     *
     * @description
     * `$route` is used for deep-linking URLs to controllers and views (HTML partials).
     * It watches `$location.url()` and tries to map the path to an existing route definition.
     *
     * Requires the {@link ngRoute `ngRoute`} module to be installed.
     *
     * You can define routes through {@link ngRoute.$routeProvider $routeProvider}'s API.
     *
     * The `$route` service is typically used in conjunction with the
     * {@link ngRoute.directive:ngView `ngView`} directive and the
     * {@link ngRoute.$routeParams `$routeParams`} service.
     *
     * @example
     * This example shows how changing the URL hash causes the `$route` to match a route against the
     * URL, and the `ngView` pulls in the partial.
     *
     * Note that this example is using {@link ng.directive:script inlined templates}
     * to get it working on jsfiddle as well.
     *
     * <example name="$route-service" module="ngRouteExample"
     *          deps="angular-route.js" fixBase="true">
     *   <file name="index.html">
     *     <div ng-controller="MainController">
     *       Choose:
     *       <a href="Book/Moby">Moby</a> |
     *       <a href="Book/Moby/ch/1">Moby: Ch1</a> |
     *       <a href="Book/Gatsby">Gatsby</a> |
     *       <a href="Book/Gatsby/ch/4?key=value">Gatsby: Ch4</a> |
     *       <a href="Book/Scarlet">Scarlet Letter</a><br/>
     *
     *       <div ng-view></div>
     *
     *       <hr />
     *
     *       <pre>$location.path() = {{$location.path()}}</pre>
     *       <pre>$route.current.templateUrl = {{$route.current.templateUrl}}</pre>
     *       <pre>$route.current.params = {{$route.current.params}}</pre>
     *       <pre>$route.current.scope.name = {{$route.current.scope.name}}</pre>
     *       <pre>$routeParams = {{$routeParams}}</pre>
     *     </div>
     *   </file>
     *
     *   <file name="book.html">
     *     controller: {{name}}<br />
     *     Book Id: {{params.bookId}}<br />
     *   </file>
     *
     *   <file name="chapter.html">
     *     controller: {{name}}<br />
     *     Book Id: {{params.bookId}}<br />
     *     Chapter Id: {{params.chapterId}}
     *   </file>
     *
     *   <file name="script.js">
     *     angular.module('ngRouteExample', ['ngRoute'])
     *
     *      .controller('MainController', function($scope, $route, $routeParams, $location) {
     *          $scope.$route = $route;
     *          $scope.$location = $location;
     *          $scope.$routeParams = $routeParams;
     *      })
     *
     *      .controller('BookController', function($scope, $routeParams) {
     *          $scope.name = "BookController";
     *          $scope.params = $routeParams;
     *      })
     *
     *      .controller('ChapterController', function($scope, $routeParams) {
     *          $scope.name = "ChapterController";
     *          $scope.params = $routeParams;
     *      })
     *
     *     .config(function($routeProvider, $locationProvider) {
     *       $routeProvider
     *        .when('/Book/:bookId', {
     *         templateUrl: 'book.html',
     *         controller: 'BookController',
     *         resolve: {
     *           // I will cause a 1 second delay
     *           delay: function($q, $timeout) {
     *             var delay = $q.defer();
     *             $timeout(delay.resolve, 1000);
     *             return delay.promise;
     *           }
     *         }
     *       })
     *       .when('/Book/:bookId/ch/:chapterId', {
     *         templateUrl: 'chapter.html',
     *         controller: 'ChapterController'
     *       });
     *
     *       // configure html5 to get links working on jsfiddle
     *       $locationProvider.html5Mode(true);
     *     });
     *
     *   </file>
     *
     *   <file name="protractor.js" type="protractor">
     *     it('should load and compile correct template', function() {
     *       element(by.linkText('Moby: Ch1')).click();
     *       var content = element(by.css('[ng-view]')).getText();
     *       expect(content).toMatch(/controller\: ChapterController/);
     *       expect(content).toMatch(/Book Id\: Moby/);
     *       expect(content).toMatch(/Chapter Id\: 1/);
     *
     *       element(by.partialLinkText('Scarlet')).click();
     *
     *       content = element(by.css('[ng-view]')).getText();
     *       expect(content).toMatch(/controller\: BookController/);
     *       expect(content).toMatch(/Book Id\: Scarlet/);
     *     });
     *   </file>
     * </example>
     */

    /**
     * @ngdoc event
     * @name $route#$routeChangeStart
     * @eventType broadcast on root scope
     * @description
     * Broadcasted before a route change. At this  point the route services starts
     * resolving all of the dependencies needed for the route change to occur.
     * Typically this involves fetching the view template as well as any dependencies
     * defined in `resolve` route property. Once  all of the dependencies are resolved
     * `$routeChangeSuccess` is fired.
     *
     * @param {Object} angularEvent Synthetic event object.
     * @param {Route} next Future route information.
     * @param {Route} current Current route information.
     */

    /**
     * @ngdoc event
     * @name $route#$routeChangeSuccess
     * @eventType broadcast on root scope
     * @description
     * Broadcasted after a route dependencies are resolved.
     * {@link ngRoute.directive:ngView ngView} listens for the directive
     * to instantiate the controller and render the view.
     *
     * @param {Object} angularEvent Synthetic event object.
     * @param {Route} current Current route information.
     * @param {Route|Undefined} previous Previous route information, or undefined if current is
     * first route entered.
     */

    /**
     * @ngdoc event
     * @name $route#$routeChangeError
     * @eventType broadcast on root scope
     * @description
     * Broadcasted if any of the resolve promises are rejected.
     *
     * @param {Object} angularEvent Synthetic event object
     * @param {Route} current Current route information.
     * @param {Route} previous Previous route information.
     * @param {Route} rejection Rejection of the promise. Usually the error of the failed promise.
     */

    /**
     * @ngdoc event
     * @name $route#$routeUpdate
     * @eventType broadcast on root scope
     * @description
     *
     * The `reloadOnSearch` property has been set to false, and we are reusing the same
     * instance of the Controller.
     */

    var forceReload = false,
        $route = {
          routes: routes,

          /**
           * @ngdoc method
           * @name $route#reload
           *
           * @description
           * Causes `$route` service to reload the current route even if
           * {@link ng.$location $location} hasn't changed.
           *
           * As a result of that, {@link ngRoute.directive:ngView ngView}
           * creates new scope, reinstantiates the controller.
           */
          reload: function() {
            forceReload = true;
            $rootScope.$evalAsync(updateRoute);
          }
        };

    $rootScope.$on('$locationChangeSuccess', updateRoute);

    return $route;

    /////////////////////////////////////////////////////

    /**
     * @param on {string} current url
     * @param route {Object} route regexp to match the url against
     * @return {?Object}
     *
     * @description
     * Check if the route matches the current url.
     *
     * Inspired by match in
     * visionmedia/express/lib/router/router.js.
     */
    function switchRouteMatcher(on, route) {
      var keys = route.keys,
          params = {};

      if (!route.regexp) return null;

      var m = route.regexp.exec(on);
      if (!m) return null;

      for (var i = 1, len = m.length; i < len; ++i) {
        var key = keys[i - 1];

        var val = 'string' == typeof m[i]
              ? decodeURIComponent(m[i])
              : m[i];

        if (key && val) {
          params[key.name] = val;
        }
      }
      return params;
    }

    function updateRoute() {
      var next = parseRoute(),
          last = $route.current;

      if (next && last && next.$$route === last.$$route
          && angular.equals(next.pathParams, last.pathParams)
          && !next.reloadOnSearch && !forceReload) {
        last.params = next.params;
        angular.copy(last.params, $routeParams);
        $rootScope.$broadcast('$routeUpdate', last);
      } else if (next || last) {
        forceReload = false;
        $rootScope.$broadcast('$routeChangeStart', next, last);
        $route.current = next;
        if (next) {
          if (next.redirectTo) {
            if (angular.isString(next.redirectTo)) {
              $location.path(interpolate(next.redirectTo, next.params)).search(next.params)
                       .replace();
            } else {
              $location.url(next.redirectTo(next.pathParams, $location.path(), $location.search()))
                       .replace();
            }
          }
        }

        $q.when(next).
          then(function() {
            if (next) {
              var locals = angular.extend({}, next.resolve),
                  template, templateUrl;

              angular.forEach(locals, function(value, key) {
                locals[key] = angular.isString(value) ?
                    $injector.get(value) : $injector.invoke(value);
              });

              if (angular.isDefined(template = next.template)) {
                if (angular.isFunction(template)) {
                  template = template(next.params);
                }
              } else if (angular.isDefined(templateUrl = next.templateUrl)) {
                if (angular.isFunction(templateUrl)) {
                  templateUrl = templateUrl(next.params);
                }
                templateUrl = $sce.getTrustedResourceUrl(templateUrl);
                if (angular.isDefined(templateUrl)) {
                  next.loadedTemplateUrl = templateUrl;
                  template = $http.get(templateUrl, {cache: $templateCache}).
                      then(function(response) { return response.data; });
                }
              }
              if (angular.isDefined(template)) {
                locals['$template'] = template;
              }
              return $q.all(locals);
            }
          }).
          // after route change
          then(function(locals) {
            if (next == $route.current) {
              if (next) {
                next.locals = locals;
                angular.copy(next.params, $routeParams);
              }
              $rootScope.$broadcast('$routeChangeSuccess', next, last);
            }
          }, function(error) {
            if (next == $route.current) {
              $rootScope.$broadcast('$routeChangeError', next, last, error);
            }
          });
      }
    }


    /**
     * @returns {Object} the current active route, by matching it against the URL
     */
    function parseRoute() {
      // Match a route
      var params, match;
      angular.forEach(routes, function(route, path) {
        if (!match && (params = switchRouteMatcher($location.path(), route))) {
          match = inherit(route, {
            params: angular.extend({}, $location.search(), params),
            pathParams: params});
          match.$$route = route;
        }
      });
      // No route matched; fallback to "otherwise" route
      return match || routes[null] && inherit(routes[null], {params: {}, pathParams:{}});
    }

    /**
     * @returns {string} interpolation of the redirect path with the parameters
     */
    function interpolate(string, params) {
      var result = [];
      angular.forEach((string||'').split(':'), function(segment, i) {
        if (i === 0) {
          result.push(segment);
        } else {
          var segmentMatch = segment.match(/(\w+)(.*)/);
          var key = segmentMatch[1];
          result.push(params[key]);
          result.push(segmentMatch[2] || '');
          delete params[key];
        }
      });
      return result.join('');
    }
  }];
}

ngRouteModule.provider('$routeParams', $RouteParamsProvider);


/**
 * @ngdoc service
 * @name $routeParams
 * @requires $route
 *
 * @description
 * The `$routeParams` service allows you to retrieve the current set of route parameters.
 *
 * Requires the {@link ngRoute `ngRoute`} module to be installed.
 *
 * The route parameters are a combination of {@link ng.$location `$location`}'s
 * {@link ng.$location#search `search()`} and {@link ng.$location#path `path()`}.
 * The `path` parameters are extracted when the {@link ngRoute.$route `$route`} path is matched.
 *
 * In case of parameter name collision, `path` params take precedence over `search` params.
 *
 * The service guarantees that the identity of the `$routeParams` object will remain unchanged
 * (but its properties will likely change) even when a route change occurs.
 *
 * Note that the `$routeParams` are only updated *after* a route change completes successfully.
 * This means that you cannot rely on `$routeParams` being correct in route resolve functions.
 * Instead you can use `$route.current.params` to access the new route's parameters.
 *
 * @example
 * ```js
 *  // Given:
 *  // URL: http://server.com/index.html#/Chapter/1/Section/2?search=moby
 *  // Route: /Chapter/:chapterId/Section/:sectionId
 *  //
 *  // Then
 *  $routeParams ==> {chapterId:1, sectionId:2, search:'moby'}
 * ```
 */
function $RouteParamsProvider() {
  this.$get = function() { return {}; };
}

ngRouteModule.directive('ngView', ngViewFactory);
ngRouteModule.directive('ngView', ngViewFillContentFactory);


/**
 * @ngdoc directive
 * @name ngView
 * @restrict ECA
 *
 * @description
 * # Overview
 * `ngView` is a directive that complements the {@link ngRoute.$route $route} service by
 * including the rendered template of the current route into the main layout (`index.html`) file.
 * Every time the current route changes, the included view changes with it according to the
 * configuration of the `$route` service.
 *
 * Requires the {@link ngRoute `ngRoute`} module to be installed.
 *
 * @animations
 * enter - animation is used to bring new content into the browser.
 * leave - animation is used to animate existing content away.
 *
 * The enter and leave animation occur concurrently.
 *
 * @scope
 * @priority 400
 * @param {string=} onload Expression to evaluate whenever the view updates.
 *
 * @param {string=} autoscroll Whether `ngView` should call {@link ng.$anchorScroll
 *                  $anchorScroll} to scroll the viewport after the view is updated.
 *
 *                  - If the attribute is not set, disable scrolling.
 *                  - If the attribute is set without value, enable scrolling.
 *                  - Otherwise enable scrolling only if the `autoscroll` attribute value evaluated
 *                    as an expression yields a truthy value.
 * @example
    <example name="ngView-directive" module="ngViewExample"
             deps="angular-route.js;angular-animate.js"
             animations="true" fixBase="true">
      <file name="index.html">
        <div ng-controller="MainCtrl as main">
          Choose:
          <a href="Book/Moby">Moby</a> |
          <a href="Book/Moby/ch/1">Moby: Ch1</a> |
          <a href="Book/Gatsby">Gatsby</a> |
          <a href="Book/Gatsby/ch/4?key=value">Gatsby: Ch4</a> |
          <a href="Book/Scarlet">Scarlet Letter</a><br/>

          <div class="view-animate-container">
            <div ng-view class="view-animate"></div>
          </div>
          <hr />

          <pre>$location.path() = {{main.$location.path()}}</pre>
          <pre>$route.current.templateUrl = {{main.$route.current.templateUrl}}</pre>
          <pre>$route.current.params = {{main.$route.current.params}}</pre>
          <pre>$route.current.scope.name = {{main.$route.current.scope.name}}</pre>
          <pre>$routeParams = {{main.$routeParams}}</pre>
        </div>
      </file>

      <file name="book.html">
        <div>
          controller: {{book.name}}<br />
          Book Id: {{book.params.bookId}}<br />
        </div>
      </file>

      <file name="chapter.html">
        <div>
          controller: {{chapter.name}}<br />
          Book Id: {{chapter.params.bookId}}<br />
          Chapter Id: {{chapter.params.chapterId}}
        </div>
      </file>

      <file name="animations.css">
        .view-animate-container {
          position:relative;
          height:100px!important;
          position:relative;
          background:white;
          border:1px solid black;
          height:40px;
          overflow:hidden;
        }

        .view-animate {
          padding:10px;
        }

        .view-animate.ng-enter, .view-animate.ng-leave {
          -webkit-transition:all cubic-bezier(0.250, 0.460, 0.450, 0.940) 1.5s;
          transition:all cubic-bezier(0.250, 0.460, 0.450, 0.940) 1.5s;

          display:block;
          width:100%;
          border-left:1px solid black;

          position:absolute;
          top:0;
          left:0;
          right:0;
          bottom:0;
          padding:10px;
        }

        .view-animate.ng-enter {
          left:100%;
        }
        .view-animate.ng-enter.ng-enter-active {
          left:0;
        }
        .view-animate.ng-leave.ng-leave-active {
          left:-100%;
        }
      </file>

      <file name="script.js">
        angular.module('ngViewExample', ['ngRoute', 'ngAnimate'])
          .config(['$routeProvider', '$locationProvider',
            function($routeProvider, $locationProvider) {
              $routeProvider
                .when('/Book/:bookId', {
                  templateUrl: 'book.html',
                  controller: 'BookCtrl',
                  controllerAs: 'book'
                })
                .when('/Book/:bookId/ch/:chapterId', {
                  templateUrl: 'chapter.html',
                  controller: 'ChapterCtrl',
                  controllerAs: 'chapter'
                });

              // configure html5 to get links working on jsfiddle
              $locationProvider.html5Mode(true);
          }])
          .controller('MainCtrl', ['$route', '$routeParams', '$location',
            function($route, $routeParams, $location) {
              this.$route = $route;
              this.$location = $location;
              this.$routeParams = $routeParams;
          }])
          .controller('BookCtrl', ['$routeParams', function($routeParams) {
            this.name = "BookCtrl";
            this.params = $routeParams;
          }])
          .controller('ChapterCtrl', ['$routeParams', function($routeParams) {
            this.name = "ChapterCtrl";
            this.params = $routeParams;
          }]);

      </file>

      <file name="protractor.js" type="protractor">
        it('should load and compile correct template', function() {
          element(by.linkText('Moby: Ch1')).click();
          var content = element(by.css('[ng-view]')).getText();
          expect(content).toMatch(/controller\: ChapterCtrl/);
          expect(content).toMatch(/Book Id\: Moby/);
          expect(content).toMatch(/Chapter Id\: 1/);

          element(by.partialLinkText('Scarlet')).click();

          content = element(by.css('[ng-view]')).getText();
          expect(content).toMatch(/controller\: BookCtrl/);
          expect(content).toMatch(/Book Id\: Scarlet/);
        });
      </file>
    </example>
 */


/**
 * @ngdoc event
 * @name ngView#$viewContentLoaded
 * @eventType emit on the current ngView scope
 * @description
 * Emitted every time the ngView content is reloaded.
 */
ngViewFactory.$inject = ['$route', '$anchorScroll', '$animate'];
function ngViewFactory(   $route,   $anchorScroll,   $animate) {
  return {
    restrict: 'ECA',
    terminal: true,
    priority: 400,
    transclude: 'element',
    link: function(scope, $element, attr, ctrl, $transclude) {
        var currentScope,
            currentElement,
            previousElement,
            autoScrollExp = attr.autoscroll,
            onloadExp = attr.onload || '';

        scope.$on('$routeChangeSuccess', update);
        update();

        function cleanupLastView() {
          if(previousElement) {
            previousElement.remove();
            previousElement = null;
          }
          if(currentScope) {
            currentScope.$destroy();
            currentScope = null;
          }
          if(currentElement) {
            $animate.leave(currentElement, function() {
              previousElement = null;
            });
            previousElement = currentElement;
            currentElement = null;
          }
        }

        function update() {
          var locals = $route.current && $route.current.locals,
              template = locals && locals.$template;

          if (angular.isDefined(template)) {
            var newScope = scope.$new();
            var current = $route.current;

            // Note: This will also link all children of ng-view that were contained in the original
            // html. If that content contains controllers, ... they could pollute/change the scope.
            // However, using ng-view on an element with additional content does not make sense...
            // Note: We can't remove them in the cloneAttchFn of $transclude as that
            // function is called before linking the content, which would apply child
            // directives to non existing elements.
            var clone = $transclude(newScope, function(clone) {
              $animate.enter(clone, null, currentElement || $element, function onNgViewEnter () {
                if (angular.isDefined(autoScrollExp)
                  && (!autoScrollExp || scope.$eval(autoScrollExp))) {
                  $anchorScroll();
                }
              });
              cleanupLastView();
            });

            currentElement = clone;
            currentScope = current.scope = newScope;
            currentScope.$emit('$viewContentLoaded');
            currentScope.$eval(onloadExp);
          } else {
            cleanupLastView();
          }
        }
    }
  };
}

// This directive is called during the $transclude call of the first `ngView` directive.
// It will replace and compile the content of the element with the loaded template.
// We need this directive so that the element content is already filled when
// the link function of another directive on the same element as ngView
// is called.
ngViewFillContentFactory.$inject = ['$compile', '$controller', '$route'];
function ngViewFillContentFactory($compile, $controller, $route) {
  return {
    restrict: 'ECA',
    priority: -400,
    link: function(scope, $element) {
      var current = $route.current,
          locals = current.locals;

      $element.html(locals.$template);

      var link = $compile($element.contents());

      if (current.controller) {
        locals.$scope = scope;
        var controller = $controller(current.controller, locals);
        if (current.controllerAs) {
          scope[current.controllerAs] = controller;
        }
        $element.data('$ngControllerController', controller);
        $element.children().data('$ngControllerController', controller);
      }

      link(scope);
    }
  };
}


})(window, window.angular);

/**
 * @license AngularJS v1.2.16
 * (c) 2010-2014 Google, Inc. http://angularjs.org
 * License: MIT
 */
(function(window, angular, undefined) {'use strict';

/* jshint maxlen: false */

/**
 * @ngdoc module
 * @name ngAnimate
 * @description
 *
 * # ngAnimate
 *
 * The `ngAnimate` module provides support for JavaScript, CSS3 transition and CSS3 keyframe animation hooks within existing core and custom directives.
 *
 *
 * <div doc-module-components="ngAnimate"></div>
 *
 * # Usage
 *
 * To see animations in action, all that is required is to define the appropriate CSS classes
 * or to register a JavaScript animation via the myModule.animation() function. The directives that support animation automatically are:
 * `ngRepeat`, `ngInclude`, `ngIf`, `ngSwitch`, `ngShow`, `ngHide`, `ngView` and `ngClass`. Custom directives can take advantage of animation
 * by using the `$animate` service.
 *
 * Below is a more detailed breakdown of the supported animation events provided by pre-existing ng directives:
 *
 * | Directive                                                 | Supported Animations                               |
 * |---------------------------------------------------------- |----------------------------------------------------|
 * | {@link ng.directive:ngRepeat#usage_animations ngRepeat}         | enter, leave and move                              |
 * | {@link ngRoute.directive:ngView#usage_animations ngView}        | enter and leave                                    |
 * | {@link ng.directive:ngInclude#usage_animations ngInclude}       | enter and leave                                    |
 * | {@link ng.directive:ngSwitch#usage_animations ngSwitch}         | enter and leave                                    |
 * | {@link ng.directive:ngIf#usage_animations ngIf}                 | enter and leave                                    |
 * | {@link ng.directive:ngClass#usage_animations ngClass}           | add and remove                                     |
 * | {@link ng.directive:ngShow#usage_animations ngShow & ngHide}    | add and remove (the ng-hide class value)           |
 * | {@link ng.directive:form#usage_animations form}                 | add and remove (dirty, pristine, valid, invalid & all other validations)                |
 * | {@link ng.directive:ngModel#usage_animations ngModel}           | add and remove (dirty, pristine, valid, invalid & all other validations)                |
 *
 * You can find out more information about animations upon visiting each directive page.
 *
 * Below is an example of how to apply animations to a directive that supports animation hooks:
 *
 * ```html
 * <style type="text/css">
 * .slide.ng-enter, .slide.ng-leave {
 *   -webkit-transition:0.5s linear all;
 *   transition:0.5s linear all;
 * }
 *
 * .slide.ng-enter { }        /&#42; starting animations for enter &#42;/
 * .slide.ng-enter-active { } /&#42; terminal animations for enter &#42;/
 * .slide.ng-leave { }        /&#42; starting animations for leave &#42;/
 * .slide.ng-leave-active { } /&#42; terminal animations for leave &#42;/
 * </style>
 *
 * <!--
 * the animate service will automatically add .ng-enter and .ng-leave to the element
 * to trigger the CSS transition/animations
 * -->
 * <ANY class="slide" ng-include="..."></ANY>
 * ```
 *
 * Keep in mind that if an animation is running, any child elements cannot be animated until the parent element's
 * animation has completed.
 *
 * <h2>CSS-defined Animations</h2>
 * The animate service will automatically apply two CSS classes to the animated element and these two CSS classes
 * are designed to contain the start and end CSS styling. Both CSS transitions and keyframe animations are supported
 * and can be used to play along with this naming structure.
 *
 * The following code below demonstrates how to perform animations using **CSS transitions** with Angular:
 *
 * ```html
 * <style type="text/css">
 * /&#42;
 *  The animate class is apart of the element and the ng-enter class
 *  is attached to the element once the enter animation event is triggered
 * &#42;/
 * .reveal-animation.ng-enter {
 *  -webkit-transition: 1s linear all; /&#42; Safari/Chrome &#42;/
 *  transition: 1s linear all; /&#42; All other modern browsers and IE10+ &#42;/
 *
 *  /&#42; The animation preparation code &#42;/
 *  opacity: 0;
 * }
 *
 * /&#42;
 *  Keep in mind that you want to combine both CSS
 *  classes together to avoid any CSS-specificity
 *  conflicts
 * &#42;/
 * .reveal-animation.ng-enter.ng-enter-active {
 *  /&#42; The animation code itself &#42;/
 *  opacity: 1;
 * }
 * </style>
 *
 * <div class="view-container">
 *   <div ng-view class="reveal-animation"></div>
 * </div>
 * ```
 *
 * The following code below demonstrates how to perform animations using **CSS animations** with Angular:
 *
 * ```html
 * <style type="text/css">
 * .reveal-animation.ng-enter {
 *   -webkit-animation: enter_sequence 1s linear; /&#42; Safari/Chrome &#42;/
 *   animation: enter_sequence 1s linear; /&#42; IE10+ and Future Browsers &#42;/
 * }
 * @-webkit-keyframes enter_sequence {
 *   from { opacity:0; }
 *   to { opacity:1; }
 * }
 * @keyframes enter_sequence {
 *   from { opacity:0; }
 *   to { opacity:1; }
 * }
 * </style>
 *
 * <div class="view-container">
 *   <div ng-view class="reveal-animation"></div>
 * </div>
 * ```
 *
 * Both CSS3 animations and transitions can be used together and the animate service will figure out the correct duration and delay timing.
 *
 * Upon DOM mutation, the event class is added first (something like `ng-enter`), then the browser prepares itself to add
 * the active class (in this case `ng-enter-active`) which then triggers the animation. The animation module will automatically
 * detect the CSS code to determine when the animation ends. Once the animation is over then both CSS classes will be
 * removed from the DOM. If a browser does not support CSS transitions or CSS animations then the animation will start and end
 * immediately resulting in a DOM element that is at its final state. This final state is when the DOM element
 * has no CSS transition/animation classes applied to it.
 *
 * <h3>CSS Staggering Animations</h3>
 * A Staggering animation is a collection of animations that are issued with a slight delay in between each successive operation resulting in a
 * curtain-like effect. The ngAnimate module, as of 1.2.0, supports staggering animations and the stagger effect can be
 * performed by creating a **ng-EVENT-stagger** CSS class and attaching that class to the base CSS class used for
 * the animation. The style property expected within the stagger class can either be a **transition-delay** or an
 * **animation-delay** property (or both if your animation contains both transitions and keyframe animations).
 *
 * ```css
 * .my-animation.ng-enter {
 *   /&#42; standard transition code &#42;/
 *   -webkit-transition: 1s linear all;
 *   transition: 1s linear all;
 *   opacity:0;
 * }
 * .my-animation.ng-enter-stagger {
 *   /&#42; this will have a 100ms delay between each successive leave animation &#42;/
 *   -webkit-transition-delay: 0.1s;
 *   transition-delay: 0.1s;
 *
 *   /&#42; in case the stagger doesn't work then these two values
 *    must be set to 0 to avoid an accidental CSS inheritance &#42;/
 *   -webkit-transition-duration: 0s;
 *   transition-duration: 0s;
 * }
 * .my-animation.ng-enter.ng-enter-active {
 *   /&#42; standard transition styles &#42;/
 *   opacity:1;
 * }
 * ```
 *
 * Staggering animations work by default in ngRepeat (so long as the CSS class is defined). Outside of ngRepeat, to use staggering animations
 * on your own, they can be triggered by firing multiple calls to the same event on $animate. However, the restrictions surrounding this
 * are that each of the elements must have the same CSS className value as well as the same parent element. A stagger operation
 * will also be reset if more than 10ms has passed after the last animation has been fired.
 *
 * The following code will issue the **ng-leave-stagger** event on the element provided:
 *
 * ```js
 * var kids = parent.children();
 *
 * $animate.leave(kids[0]); //stagger index=0
 * $animate.leave(kids[1]); //stagger index=1
 * $animate.leave(kids[2]); //stagger index=2
 * $animate.leave(kids[3]); //stagger index=3
 * $animate.leave(kids[4]); //stagger index=4
 *
 * $timeout(function() {
 *   //stagger has reset itself
 *   $animate.leave(kids[5]); //stagger index=0
 *   $animate.leave(kids[6]); //stagger index=1
 * }, 100, false);
 * ```
 *
 * Stagger animations are currently only supported within CSS-defined animations.
 *
 * <h2>JavaScript-defined Animations</h2>
 * In the event that you do not want to use CSS3 transitions or CSS3 animations or if you wish to offer animations on browsers that do not
 * yet support CSS transitions/animations, then you can make use of JavaScript animations defined inside of your AngularJS module.
 *
 * ```js
 * //!annotate="YourApp" Your AngularJS Module|Replace this or ngModule with the module that you used to define your application.
 * var ngModule = angular.module('YourApp', ['ngAnimate']);
 * ngModule.animation('.my-crazy-animation', function() {
 *   return {
 *     enter: function(element, done) {
 *       //run the animation here and call done when the animation is complete
 *       return function(cancelled) {
 *         //this (optional) function will be called when the animation
 *         //completes or when the animation is cancelled (the cancelled
 *         //flag will be set to true if cancelled).
 *       };
 *     },
 *     leave: function(element, done) { },
 *     move: function(element, done) { },
 *
 *     //animation that can be triggered before the class is added
 *     beforeAddClass: function(element, className, done) { },
 *
 *     //animation that can be triggered after the class is added
 *     addClass: function(element, className, done) { },
 *
 *     //animation that can be triggered before the class is removed
 *     beforeRemoveClass: function(element, className, done) { },
 *
 *     //animation that can be triggered after the class is removed
 *     removeClass: function(element, className, done) { }
 *   };
 * });
 * ```
 *
 * JavaScript-defined animations are created with a CSS-like class selector and a collection of events which are set to run
 * a javascript callback function. When an animation is triggered, $animate will look for a matching animation which fits
 * the element's CSS class attribute value and then run the matching animation event function (if found).
 * In other words, if the CSS classes present on the animated element match any of the JavaScript animations then the callback function will
 * be executed. It should be also noted that only simple, single class selectors are allowed (compound class selectors are not supported).
 *
 * Within a JavaScript animation, an object containing various event callback animation functions is expected to be returned.
 * As explained above, these callbacks are triggered based on the animation event. Therefore if an enter animation is run,
 * and the JavaScript animation is found, then the enter callback will handle that animation (in addition to the CSS keyframe animation
 * or transition code that is defined via a stylesheet).
 *
 */

angular.module('ngAnimate', ['ng'])

  /**
   * @ngdoc provider
   * @name $animateProvider
   * @description
   *
   * The `$animateProvider` allows developers to register JavaScript animation event handlers directly inside of a module.
   * When an animation is triggered, the $animate service will query the $animate service to find any animations that match
   * the provided name value.
   *
   * Requires the {@link ngAnimate `ngAnimate`} module to be installed.
   *
   * Please visit the {@link ngAnimate `ngAnimate`} module overview page learn more about how to use animations in your application.
   *
   */

  //this private service is only used within CSS-enabled animations
  //IE8 + IE9 do not support rAF natively, but that is fine since they
  //also don't support transitions and keyframes which means that the code
  //below will never be used by the two browsers.
  .factory('$$animateReflow', ['$$rAF', '$document', function($$rAF, $document) {
    var bod = $document[0].body;
    return function(fn) {
      //the returned function acts as the cancellation function
      return $$rAF(function() {
        //the line below will force the browser to perform a repaint
        //so that all the animated elements within the animation frame
        //will be properly updated and drawn on screen. This is
        //required to perform multi-class CSS based animations with
        //Firefox. DO NOT REMOVE THIS LINE.
        var a = bod.offsetWidth + 1;
        fn();
      });
    };
  }])

  .config(['$provide', '$animateProvider', function($provide, $animateProvider) {
    var noop = angular.noop;
    var forEach = angular.forEach;
    var selectors = $animateProvider.$$selectors;

    var ELEMENT_NODE = 1;
    var NG_ANIMATE_STATE = '$$ngAnimateState';
    var NG_ANIMATE_CLASS_NAME = 'ng-animate';
    var rootAnimateState = {running: true};

    function extractElementNode(element) {
      for(var i = 0; i < element.length; i++) {
        var elm = element[i];
        if(elm.nodeType == ELEMENT_NODE) {
          return elm;
        }
      }
    }

    function stripCommentsFromElement(element) {
      return angular.element(extractElementNode(element));
    }

    function isMatchingElement(elm1, elm2) {
      return extractElementNode(elm1) == extractElementNode(elm2);
    }

    $provide.decorator('$animate', ['$delegate', '$injector', '$sniffer', '$rootElement', '$$asyncCallback', '$rootScope', '$document',
                            function($delegate,   $injector,   $sniffer,   $rootElement,   $$asyncCallback,    $rootScope,   $document) {

      var globalAnimationCounter = 0;
      $rootElement.data(NG_ANIMATE_STATE, rootAnimateState);

      // disable animations during bootstrap, but once we bootstrapped, wait again
      // for another digest until enabling animations. The reason why we digest twice
      // is because all structural animations (enter, leave and move) all perform a
      // post digest operation before animating. If we only wait for a single digest
      // to pass then the structural animation would render its animation on page load.
      // (which is what we're trying to avoid when the application first boots up.)
      $rootScope.$$postDigest(function() {
        $rootScope.$$postDigest(function() {
          rootAnimateState.running = false;
        });
      });

      var classNameFilter = $animateProvider.classNameFilter();
      var isAnimatableClassName = !classNameFilter
              ? function() { return true; }
              : function(className) {
                return classNameFilter.test(className);
              };

      function lookup(name) {
        if (name) {
          var matches = [],
              flagMap = {},
              classes = name.substr(1).split('.');

          //the empty string value is the default animation
          //operation which performs CSS transition and keyframe
          //animations sniffing. This is always included for each
          //element animation procedure if the browser supports
          //transitions and/or keyframe animations. The default
          //animation is added to the top of the list to prevent
          //any previous animations from affecting the element styling
          //prior to the element being animated.
          if ($sniffer.transitions || $sniffer.animations) {
            matches.push($injector.get(selectors['']));
          }

          for(var i=0; i < classes.length; i++) {
            var klass = classes[i],
                selectorFactoryName = selectors[klass];
            if(selectorFactoryName && !flagMap[klass]) {
              matches.push($injector.get(selectorFactoryName));
              flagMap[klass] = true;
            }
          }
          return matches;
        }
      }

      function animationRunner(element, animationEvent, className) {
        //transcluded directives may sometimes fire an animation using only comment nodes
        //best to catch this early on to prevent any animation operations from occurring
        var node = element[0];
        if(!node) {
          return;
        }

        var isSetClassOperation = animationEvent == 'setClass';
        var isClassBased = isSetClassOperation ||
                           animationEvent == 'addClass' ||
                           animationEvent == 'removeClass';

        var classNameAdd, classNameRemove;
        if(angular.isArray(className)) {
          classNameAdd = className[0];
          classNameRemove = className[1];
          className = classNameAdd + ' ' + classNameRemove;
        }

        var currentClassName = element.attr('class');
        var classes = currentClassName + ' ' + className;
        if(!isAnimatableClassName(classes)) {
          return;
        }

        var beforeComplete = noop,
            beforeCancel = [],
            before = [],
            afterComplete = noop,
            afterCancel = [],
            after = [];

        var animationLookup = (' ' + classes).replace(/\s+/g,'.');
        forEach(lookup(animationLookup), function(animationFactory) {
          var created = registerAnimation(animationFactory, animationEvent);
          if(!created && isSetClassOperation) {
            registerAnimation(animationFactory, 'addClass');
            registerAnimation(animationFactory, 'removeClass');
          }
        });

        function registerAnimation(animationFactory, event) {
          var afterFn = animationFactory[event];
          var beforeFn = animationFactory['before' + event.charAt(0).toUpperCase() + event.substr(1)];
          if(afterFn || beforeFn) {
            if(event == 'leave') {
              beforeFn = afterFn;
              //when set as null then animation knows to skip this phase
              afterFn = null;
            }
            after.push({
              event : event, fn : afterFn
            });
            before.push({
              event : event, fn : beforeFn
            });
            return true;
          }
        }

        function run(fns, cancellations, allCompleteFn) {
          var animations = [];
          forEach(fns, function(animation) {
            animation.fn && animations.push(animation);
          });

          var count = 0;
          function afterAnimationComplete(index) {
            if(cancellations) {
              (cancellations[index] || noop)();
              if(++count < animations.length) return;
              cancellations = null;
            }
            allCompleteFn();
          }

          //The code below adds directly to the array in order to work with
          //both sync and async animations. Sync animations are when the done()
          //operation is called right away. DO NOT REFACTOR!
          forEach(animations, function(animation, index) {
            var progress = function() {
              afterAnimationComplete(index);
            };
            switch(animation.event) {
              case 'setClass':
                cancellations.push(animation.fn(element, classNameAdd, classNameRemove, progress));
                break;
              case 'addClass':
                cancellations.push(animation.fn(element, classNameAdd || className,     progress));
                break;
              case 'removeClass':
                cancellations.push(animation.fn(element, classNameRemove || className,  progress));
                break;
              default:
                cancellations.push(animation.fn(element, progress));
                break;
            }
          });

          if(cancellations && cancellations.length === 0) {
            allCompleteFn();
          }
        }

        return {
          node : node,
          event : animationEvent,
          className : className,
          isClassBased : isClassBased,
          isSetClassOperation : isSetClassOperation,
          before : function(allCompleteFn) {
            beforeComplete = allCompleteFn;
            run(before, beforeCancel, function() {
              beforeComplete = noop;
              allCompleteFn();
            });
          },
          after : function(allCompleteFn) {
            afterComplete = allCompleteFn;
            run(after, afterCancel, function() {
              afterComplete = noop;
              allCompleteFn();
            });
          },
          cancel : function() {
            if(beforeCancel) {
              forEach(beforeCancel, function(cancelFn) {
                (cancelFn || noop)(true);
              });
              beforeComplete(true);
            }
            if(afterCancel) {
              forEach(afterCancel, function(cancelFn) {
                (cancelFn || noop)(true);
              });
              afterComplete(true);
            }
          }
        };
      }

      /**
       * @ngdoc service
       * @name $animate
       * @function
       *
       * @description
       * The `$animate` service provides animation detection support while performing DOM operations (enter, leave and move) as well as during addClass and removeClass operations.
       * When any of these operations are run, the $animate service
       * will examine any JavaScript-defined animations (which are defined by using the $animateProvider provider object)
       * as well as any CSS-defined animations against the CSS classes present on the element once the DOM operation is run.
       *
       * The `$animate` service is used behind the scenes with pre-existing directives and animation with these directives
       * will work out of the box without any extra configuration.
       *
       * Requires the {@link ngAnimate `ngAnimate`} module to be installed.
       *
       * Please visit the {@link ngAnimate `ngAnimate`} module overview page learn more about how to use animations in your application.
       *
       */
      return {
        /**
         * @ngdoc method
         * @name $animate#enter
         * @function
         *
         * @description
         * Appends the element to the parentElement element that resides in the document and then runs the enter animation. Once
         * the animation is started, the following CSS classes will be present on the element for the duration of the animation:
         *
         * Below is a breakdown of each step that occurs during enter animation:
         *
         * | Animation Step                                                                               | What the element class attribute looks like |
         * |----------------------------------------------------------------------------------------------|---------------------------------------------|
         * | 1. $animate.enter(...) is called                                                             | class="my-animation"                        |
         * | 2. element is inserted into the parentElement element or beside the afterElement element     | class="my-animation"                        |
         * | 3. $animate runs any JavaScript-defined animations on the element                            | class="my-animation ng-animate"             |
         * | 4. the .ng-enter class is added to the element                                               | class="my-animation ng-animate ng-enter"    |
         * | 5. $animate scans the element styles to get the CSS transition/animation duration and delay  | class="my-animation ng-animate ng-enter"    |
         * | 6. $animate waits for 10ms (this performs a reflow)                                          | class="my-animation ng-animate ng-enter"    |
         * | 7. the .ng-enter-active and .ng-animate-active classes are added (this triggers the CSS transition/animation) | class="my-animation ng-animate ng-animate-active ng-enter ng-enter-active" |
         * | 8. $animate waits for X milliseconds for the animation to complete                           | class="my-animation ng-animate ng-animate-active ng-enter ng-enter-active" |
         * | 9. The animation ends and all generated CSS classes are removed from the element             | class="my-animation"                        |
         * | 10. The doneCallback() callback is fired (if provided)                                       | class="my-animation"                        |
         *
         * @param {DOMElement} element the element that will be the focus of the enter animation
         * @param {DOMElement} parentElement the parent element of the element that will be the focus of the enter animation
         * @param {DOMElement} afterElement the sibling element (which is the previous element) of the element that will be the focus of the enter animation
         * @param {function()=} doneCallback the callback function that will be called once the animation is complete
        */
        enter : function(element, parentElement, afterElement, doneCallback) {
          this.enabled(false, element);
          $delegate.enter(element, parentElement, afterElement);
          $rootScope.$$postDigest(function() {
            element = stripCommentsFromElement(element);
            performAnimation('enter', 'ng-enter', element, parentElement, afterElement, noop, doneCallback);
          });
        },

        /**
         * @ngdoc method
         * @name $animate#leave
         * @function
         *
         * @description
         * Runs the leave animation operation and, upon completion, removes the element from the DOM. Once
         * the animation is started, the following CSS classes will be added for the duration of the animation:
         *
         * Below is a breakdown of each step that occurs during leave animation:
         *
         * | Animation Step                                                                               | What the element class attribute looks like |
         * |----------------------------------------------------------------------------------------------|---------------------------------------------|
         * | 1. $animate.leave(...) is called                                                             | class="my-animation"                        |
         * | 2. $animate runs any JavaScript-defined animations on the element                            | class="my-animation ng-animate"             |
         * | 3. the .ng-leave class is added to the element                                               | class="my-animation ng-animate ng-leave"    |
         * | 4. $animate scans the element styles to get the CSS transition/animation duration and delay  | class="my-animation ng-animate ng-leave"    |
         * | 5. $animate waits for 10ms (this performs a reflow)                                          | class="my-animation ng-animate ng-leave"    |
         * | 6. the .ng-leave-active and .ng-animate-active classes is added (this triggers the CSS transition/animation) | class="my-animation ng-animate ng-animate-active ng-leave ng-leave-active" |
         * | 7. $animate waits for X milliseconds for the animation to complete                           | class="my-animation ng-animate ng-animate-active ng-leave ng-leave-active" |
         * | 8. The animation ends and all generated CSS classes are removed from the element             | class="my-animation"                        |
         * | 9. The element is removed from the DOM                                                       | ...                                         |
         * | 10. The doneCallback() callback is fired (if provided)                                       | ...                                         |
         *
         * @param {DOMElement} element the element that will be the focus of the leave animation
         * @param {function()=} doneCallback the callback function that will be called once the animation is complete
        */
        leave : function(element, doneCallback) {
          cancelChildAnimations(element);
          this.enabled(false, element);
          $rootScope.$$postDigest(function() {
            performAnimation('leave', 'ng-leave', stripCommentsFromElement(element), null, null, function() {
              $delegate.leave(element);
            }, doneCallback);
          });
        },

        /**
         * @ngdoc method
         * @name $animate#move
         * @function
         *
         * @description
         * Fires the move DOM operation. Just before the animation starts, the animate service will either append it into the parentElement container or
         * add the element directly after the afterElement element if present. Then the move animation will be run. Once
         * the animation is started, the following CSS classes will be added for the duration of the animation:
         *
         * Below is a breakdown of each step that occurs during move animation:
         *
         * | Animation Step                                                                               | What the element class attribute looks like |
         * |----------------------------------------------------------------------------------------------|---------------------------------------------|
         * | 1. $animate.move(...) is called                                                              | class="my-animation"                        |
         * | 2. element is moved into the parentElement element or beside the afterElement element        | class="my-animation"                        |
         * | 3. $animate runs any JavaScript-defined animations on the element                            | class="my-animation ng-animate"             |
         * | 4. the .ng-move class is added to the element                                                | class="my-animation ng-animate ng-move"     |
         * | 5. $animate scans the element styles to get the CSS transition/animation duration and delay  | class="my-animation ng-animate ng-move"     |
         * | 6. $animate waits for 10ms (this performs a reflow)                                          | class="my-animation ng-animate ng-move"     |
         * | 7. the .ng-move-active and .ng-animate-active classes is added (this triggers the CSS transition/animation) | class="my-animation ng-animate ng-animate-active ng-move ng-move-active" |
         * | 8. $animate waits for X milliseconds for the animation to complete                           | class="my-animation ng-animate ng-animate-active ng-move ng-move-active" |
         * | 9. The animation ends and all generated CSS classes are removed from the element             | class="my-animation"                        |
         * | 10. The doneCallback() callback is fired (if provided)                                       | class="my-animation"                        |
         *
         * @param {DOMElement} element the element that will be the focus of the move animation
         * @param {DOMElement} parentElement the parentElement element of the element that will be the focus of the move animation
         * @param {DOMElement} afterElement the sibling element (which is the previous element) of the element that will be the focus of the move animation
         * @param {function()=} doneCallback the callback function that will be called once the animation is complete
        */
        move : function(element, parentElement, afterElement, doneCallback) {
          cancelChildAnimations(element);
          this.enabled(false, element);
          $delegate.move(element, parentElement, afterElement);
          $rootScope.$$postDigest(function() {
            element = stripCommentsFromElement(element);
            performAnimation('move', 'ng-move', element, parentElement, afterElement, noop, doneCallback);
          });
        },

        /**
         * @ngdoc method
         * @name $animate#addClass
         *
         * @description
         * Triggers a custom animation event based off the className variable and then attaches the className value to the element as a CSS class.
         * Unlike the other animation methods, the animate service will suffix the className value with {@type -add} in order to provide
         * the animate service the setup and active CSS classes in order to trigger the animation (this will be skipped if no CSS transitions
         * or keyframes are defined on the -add or base CSS class).
         *
         * Below is a breakdown of each step that occurs during addClass animation:
         *
         * | Animation Step                                                                                 | What the element class attribute looks like |
         * |------------------------------------------------------------------------------------------------|---------------------------------------------|
         * | 1. $animate.addClass(element, 'super') is called                                               | class="my-animation"                        |
         * | 2. $animate runs any JavaScript-defined animations on the element                              | class="my-animation ng-animate"             |
         * | 3. the .super-add class are added to the element                                               | class="my-animation ng-animate super-add"   |
         * | 4. $animate scans the element styles to get the CSS transition/animation duration and delay    | class="my-animation ng-animate super-add"   |
         * | 5. $animate waits for 10ms (this performs a reflow)                                            | class="my-animation ng-animate super-add"   |
         * | 6. the .super, .super-add-active and .ng-animate-active classes are added (this triggers the CSS transition/animation) | class="my-animation ng-animate ng-animate-active super super-add super-add-active"          |
         * | 7. $animate waits for X milliseconds for the animation to complete                             | class="my-animation super super-add super-add-active"  |
         * | 8. The animation ends and all generated CSS classes are removed from the element               | class="my-animation super"                  |
         * | 9. The super class is kept on the element                                                      | class="my-animation super"                  |
         * | 10. The doneCallback() callback is fired (if provided)                                         | class="my-animation super"                  |
         *
         * @param {DOMElement} element the element that will be animated
         * @param {string} className the CSS class that will be added to the element and then animated
         * @param {function()=} doneCallback the callback function that will be called once the animation is complete
        */
        addClass : function(element, className, doneCallback) {
          element = stripCommentsFromElement(element);
          performAnimation('addClass', className, element, null, null, function() {
            $delegate.addClass(element, className);
          }, doneCallback);
        },

        /**
         * @ngdoc method
         * @name $animate#removeClass
         *
         * @description
         * Triggers a custom animation event based off the className variable and then removes the CSS class provided by the className value
         * from the element. Unlike the other animation methods, the animate service will suffix the className value with {@type -remove} in
         * order to provide the animate service the setup and active CSS classes in order to trigger the animation (this will be skipped if
         * no CSS transitions or keyframes are defined on the -remove or base CSS classes).
         *
         * Below is a breakdown of each step that occurs during removeClass animation:
         *
         * | Animation Step                                                                                | What the element class attribute looks like     |
         * |-----------------------------------------------------------------------------------------------|---------------------------------------------|
         * | 1. $animate.removeClass(element, 'super') is called                                           | class="my-animation super"                  |
         * | 2. $animate runs any JavaScript-defined animations on the element                             | class="my-animation super ng-animate"       |
         * | 3. the .super-remove class are added to the element                                           | class="my-animation super ng-animate super-remove"|
         * | 4. $animate scans the element styles to get the CSS transition/animation duration and delay   | class="my-animation super ng-animate super-remove"   |
         * | 5. $animate waits for 10ms (this performs a reflow)                                           | class="my-animation super ng-animate super-remove"   |
         * | 6. the .super-remove-active and .ng-animate-active classes are added and .super is removed (this triggers the CSS transition/animation) | class="my-animation ng-animate ng-animate-active super-remove super-remove-active"          |
         * | 7. $animate waits for X milliseconds for the animation to complete                            | class="my-animation ng-animate ng-animate-active super-remove super-remove-active"   |
         * | 8. The animation ends and all generated CSS classes are removed from the element              | class="my-animation"                        |
         * | 9. The doneCallback() callback is fired (if provided)                                         | class="my-animation"                        |
         *
         *
         * @param {DOMElement} element the element that will be animated
         * @param {string} className the CSS class that will be animated and then removed from the element
         * @param {function()=} doneCallback the callback function that will be called once the animation is complete
        */
        removeClass : function(element, className, doneCallback) {
          element = stripCommentsFromElement(element);
          performAnimation('removeClass', className, element, null, null, function() {
            $delegate.removeClass(element, className);
          }, doneCallback);
        },

          /**
           *
           * @ngdoc function
           * @name $animate#setClass
           * @function
           * @description Adds and/or removes the given CSS classes to and from the element.
           * Once complete, the done() callback will be fired (if provided).
           * @param {DOMElement} element the element which will it's CSS classes changed
           *   removed from it
           * @param {string} add the CSS classes which will be added to the element
           * @param {string} remove the CSS class which will be removed from the element
           * @param {Function=} done the callback function (if provided) that will be fired after the
           *   CSS classes have been set on the element
           */
        setClass : function(element, add, remove, doneCallback) {
          element = stripCommentsFromElement(element);
          performAnimation('setClass', [add, remove], element, null, null, function() {
            $delegate.setClass(element, add, remove);
          }, doneCallback);
        },

        /**
         * @ngdoc method
         * @name $animate#enabled
         * @function
         *
         * @param {boolean=} value If provided then set the animation on or off.
         * @param {DOMElement=} element If provided then the element will be used to represent the enable/disable operation
         * @return {boolean} Current animation state.
         *
         * @description
         * Globally enables/disables animations.
         *
        */
        enabled : function(value, element) {
          switch(arguments.length) {
            case 2:
              if(value) {
                cleanup(element);
              } else {
                var data = element.data(NG_ANIMATE_STATE) || {};
                data.disabled = true;
                element.data(NG_ANIMATE_STATE, data);
              }
            break;

            case 1:
              rootAnimateState.disabled = !value;
            break;

            default:
              value = !rootAnimateState.disabled;
            break;
          }
          return !!value;
         }
      };

      /*
        all animations call this shared animation triggering function internally.
        The animationEvent variable refers to the JavaScript animation event that will be triggered
        and the className value is the name of the animation that will be applied within the
        CSS code. Element, parentElement and afterElement are provided DOM elements for the animation
        and the onComplete callback will be fired once the animation is fully complete.
      */
      function performAnimation(animationEvent, className, element, parentElement, afterElement, domOperation, doneCallback) {

        var runner = animationRunner(element, animationEvent, className);
        if(!runner) {
          fireDOMOperation();
          fireBeforeCallbackAsync();
          fireAfterCallbackAsync();
          closeAnimation();
          return;
        }

        className = runner.className;
        var elementEvents = angular.element._data(runner.node);
        elementEvents = elementEvents && elementEvents.events;

        if (!parentElement) {
          parentElement = afterElement ? afterElement.parent() : element.parent();
        }

        var ngAnimateState  = element.data(NG_ANIMATE_STATE) || {};
        var runningAnimations     = ngAnimateState.active || {};
        var totalActiveAnimations = ngAnimateState.totalActive || 0;
        var lastAnimation         = ngAnimateState.last;

        //only allow animations if the currently running animation is not structural
        //or if there is no animation running at all
        var skipAnimations = runner.isClassBased ?
          ngAnimateState.disabled || (lastAnimation && !lastAnimation.isClassBased) :
          false;

        //skip the animation if animations are disabled, a parent is already being animated,
        //the element is not currently attached to the document body or then completely close
        //the animation if any matching animations are not found at all.
        //NOTE: IE8 + IE9 should close properly (run closeAnimation()) in case an animation was found.
        if (skipAnimations || animationsDisabled(element, parentElement)) {
          fireDOMOperation();
          fireBeforeCallbackAsync();
          fireAfterCallbackAsync();
          closeAnimation();
          return;
        }

        var skipAnimation = false;
        if(totalActiveAnimations > 0) {
          var animationsToCancel = [];
          if(!runner.isClassBased) {
            if(animationEvent == 'leave' && runningAnimations['ng-leave']) {
              skipAnimation = true;
            } else {
              //cancel all animations when a structural animation takes place
              for(var klass in runningAnimations) {
                animationsToCancel.push(runningAnimations[klass]);
                cleanup(element, klass);
              }
              runningAnimations = {};
              totalActiveAnimations = 0;
            }
          } else if(lastAnimation.event == 'setClass') {
            animationsToCancel.push(lastAnimation);
            cleanup(element, className);
          }
          else if(runningAnimations[className]) {
            var current = runningAnimations[className];
            if(current.event == animationEvent) {
              skipAnimation = true;
            } else {
              animationsToCancel.push(current);
              cleanup(element, className);
            }
          }

          if(animationsToCancel.length > 0) {
            forEach(animationsToCancel, function(operation) {
              operation.cancel();
            });
          }
        }

        if(runner.isClassBased && !runner.isSetClassOperation && !skipAnimation) {
          skipAnimation = (animationEvent == 'addClass') == element.hasClass(className); //opposite of XOR
        }

        if(skipAnimation) {
          fireBeforeCallbackAsync();
          fireAfterCallbackAsync();
          fireDoneCallbackAsync();
          return;
        }

        if(animationEvent == 'leave') {
          //there's no need to ever remove the listener since the element
          //will be removed (destroyed) after the leave animation ends or
          //is cancelled midway
          element.one('$destroy', function(e) {
            var element = angular.element(this);
            var state = element.data(NG_ANIMATE_STATE);
            if(state) {
              var activeLeaveAnimation = state.active['ng-leave'];
              if(activeLeaveAnimation) {
                activeLeaveAnimation.cancel();
                cleanup(element, 'ng-leave');
              }
            }
          });
        }

        //the ng-animate class does nothing, but it's here to allow for
        //parent animations to find and cancel child animations when needed
        element.addClass(NG_ANIMATE_CLASS_NAME);

        var localAnimationCount = globalAnimationCounter++;
        totalActiveAnimations++;
        runningAnimations[className] = runner;

        element.data(NG_ANIMATE_STATE, {
          last : runner,
          active : runningAnimations,
          index : localAnimationCount,
          totalActive : totalActiveAnimations
        });

        //first we run the before animations and when all of those are complete
        //then we perform the DOM operation and run the next set of animations
        fireBeforeCallbackAsync();
        runner.before(function(cancelled) {
          var data = element.data(NG_ANIMATE_STATE);
          cancelled = cancelled ||
                        !data || !data.active[className] ||
                        (runner.isClassBased && data.active[className].event != animationEvent);

          fireDOMOperation();
          if(cancelled === true) {
            closeAnimation();
          } else {
            fireAfterCallbackAsync();
            runner.after(closeAnimation);
          }
        });

        function fireDOMCallback(animationPhase) {
          var eventName = '$animate:' + animationPhase;
          if(elementEvents && elementEvents[eventName] && elementEvents[eventName].length > 0) {
            $$asyncCallback(function() {
              element.triggerHandler(eventName, {
                event : animationEvent,
                className : className
              });
            });
          }
        }

        function fireBeforeCallbackAsync() {
          fireDOMCallback('before');
        }

        function fireAfterCallbackAsync() {
          fireDOMCallback('after');
        }

        function fireDoneCallbackAsync() {
          fireDOMCallback('close');
          if(doneCallback) {
            $$asyncCallback(function() {
              doneCallback();
            });
          }
        }

        //it is less complicated to use a flag than managing and canceling
        //timeouts containing multiple callbacks.
        function fireDOMOperation() {
          if(!fireDOMOperation.hasBeenRun) {
            fireDOMOperation.hasBeenRun = true;
            domOperation();
          }
        }

        function closeAnimation() {
          if(!closeAnimation.hasBeenRun) {
            closeAnimation.hasBeenRun = true;
            var data = element.data(NG_ANIMATE_STATE);
            if(data) {
              /* only structural animations wait for reflow before removing an
                 animation, but class-based animations don't. An example of this
                 failing would be when a parent HTML tag has a ng-class attribute
                 causing ALL directives below to skip animations during the digest */
              if(runner && runner.isClassBased) {
                cleanup(element, className);
              } else {
                $$asyncCallback(function() {
                  var data = element.data(NG_ANIMATE_STATE) || {};
                  if(localAnimationCount == data.index) {
                    cleanup(element, className, animationEvent);
                  }
                });
                element.data(NG_ANIMATE_STATE, data);
              }
            }
            fireDoneCallbackAsync();
          }
        }
      }

      function cancelChildAnimations(element) {
        var node = extractElementNode(element);
        if (node) {
          var nodes = angular.isFunction(node.getElementsByClassName) ?
            node.getElementsByClassName(NG_ANIMATE_CLASS_NAME) :
            node.querySelectorAll('.' + NG_ANIMATE_CLASS_NAME);
          forEach(nodes, function(element) {
            element = angular.element(element);
            var data = element.data(NG_ANIMATE_STATE);
            if(data && data.active) {
              forEach(data.active, function(runner) {
                runner.cancel();
              });
            }
          });
        }
      }

      function cleanup(element, className) {
        if(isMatchingElement(element, $rootElement)) {
          if(!rootAnimateState.disabled) {
            rootAnimateState.running = false;
            rootAnimateState.structural = false;
          }
        } else if(className) {
          var data = element.data(NG_ANIMATE_STATE) || {};

          var removeAnimations = className === true;
          if(!removeAnimations && data.active && data.active[className]) {
            data.totalActive--;
            delete data.active[className];
          }

          if(removeAnimations || !data.totalActive) {
            element.removeClass(NG_ANIMATE_CLASS_NAME);
            element.removeData(NG_ANIMATE_STATE);
          }
        }
      }

      function animationsDisabled(element, parentElement) {
        if (rootAnimateState.disabled) return true;

        if(isMatchingElement(element, $rootElement)) {
          return rootAnimateState.disabled || rootAnimateState.running;
        }

        do {
          //the element did not reach the root element which means that it
          //is not apart of the DOM. Therefore there is no reason to do
          //any animations on it
          if(parentElement.length === 0) break;

          var isRoot = isMatchingElement(parentElement, $rootElement);
          var state = isRoot ? rootAnimateState : parentElement.data(NG_ANIMATE_STATE);
          var result = state && (!!state.disabled || state.running || state.totalActive > 0);
          if(isRoot || result) {
            return result;
          }

          if(isRoot) return true;
        }
        while(parentElement = parentElement.parent());

        return true;
      }
    }]);

    $animateProvider.register('', ['$window', '$sniffer', '$timeout', '$$animateReflow',
                           function($window,   $sniffer,   $timeout,   $$animateReflow) {
      // Detect proper transitionend/animationend event names.
      var CSS_PREFIX = '', TRANSITION_PROP, TRANSITIONEND_EVENT, ANIMATION_PROP, ANIMATIONEND_EVENT;

      // If unprefixed events are not supported but webkit-prefixed are, use the latter.
      // Otherwise, just use W3C names, browsers not supporting them at all will just ignore them.
      // Note: Chrome implements `window.onwebkitanimationend` and doesn't implement `window.onanimationend`
      // but at the same time dispatches the `animationend` event and not `webkitAnimationEnd`.
      // Register both events in case `window.onanimationend` is not supported because of that,
      // do the same for `transitionend` as Safari is likely to exhibit similar behavior.
      // Also, the only modern browser that uses vendor prefixes for transitions/keyframes is webkit
      // therefore there is no reason to test anymore for other vendor prefixes: http://caniuse.com/#search=transition
      if (window.ontransitionend === undefined && window.onwebkittransitionend !== undefined) {
        CSS_PREFIX = '-webkit-';
        TRANSITION_PROP = 'WebkitTransition';
        TRANSITIONEND_EVENT = 'webkitTransitionEnd transitionend';
      } else {
        TRANSITION_PROP = 'transition';
        TRANSITIONEND_EVENT = 'transitionend';
      }

      if (window.onanimationend === undefined && window.onwebkitanimationend !== undefined) {
        CSS_PREFIX = '-webkit-';
        ANIMATION_PROP = 'WebkitAnimation';
        ANIMATIONEND_EVENT = 'webkitAnimationEnd animationend';
      } else {
        ANIMATION_PROP = 'animation';
        ANIMATIONEND_EVENT = 'animationend';
      }

      var DURATION_KEY = 'Duration';
      var PROPERTY_KEY = 'Property';
      var DELAY_KEY = 'Delay';
      var ANIMATION_ITERATION_COUNT_KEY = 'IterationCount';
      var NG_ANIMATE_PARENT_KEY = '$$ngAnimateKey';
      var NG_ANIMATE_CSS_DATA_KEY = '$$ngAnimateCSS3Data';
      var NG_ANIMATE_BLOCK_CLASS_NAME = 'ng-animate-block-transitions';
      var ELAPSED_TIME_MAX_DECIMAL_PLACES = 3;
      var CLOSING_TIME_BUFFER = 1.5;
      var ONE_SECOND = 1000;

      var lookupCache = {};
      var parentCounter = 0;
      var animationReflowQueue = [];
      var cancelAnimationReflow;
      function afterReflow(element, callback) {
        if(cancelAnimationReflow) {
          cancelAnimationReflow();
        }
        animationReflowQueue.push(callback);
        cancelAnimationReflow = $$animateReflow(function() {
          forEach(animationReflowQueue, function(fn) {
            fn();
          });

          animationReflowQueue = [];
          cancelAnimationReflow = null;
          lookupCache = {};
        });
      }

      var closingTimer = null;
      var closingTimestamp = 0;
      var animationElementQueue = [];
      function animationCloseHandler(element, totalTime) {
        var node = extractElementNode(element);
        element = angular.element(node);

        //this item will be garbage collected by the closing
        //animation timeout
        animationElementQueue.push(element);

        //but it may not need to cancel out the existing timeout
        //if the timestamp is less than the previous one
        var futureTimestamp = Date.now() + totalTime;
        if(futureTimestamp <= closingTimestamp) {
          return;
        }

        $timeout.cancel(closingTimer);

        closingTimestamp = futureTimestamp;
        closingTimer = $timeout(function() {
          closeAllAnimations(animationElementQueue);
          animationElementQueue = [];
        }, totalTime, false);
      }

      function closeAllAnimations(elements) {
        forEach(elements, function(element) {
          var elementData = element.data(NG_ANIMATE_CSS_DATA_KEY);
          if(elementData) {
            (elementData.closeAnimationFn || noop)();
          }
        });
      }

      function getElementAnimationDetails(element, cacheKey) {
        var data = cacheKey ? lookupCache[cacheKey] : null;
        if(!data) {
          var transitionDuration = 0;
          var transitionDelay = 0;
          var animationDuration = 0;
          var animationDelay = 0;
          var transitionDelayStyle;
          var animationDelayStyle;
          var transitionDurationStyle;
          var transitionPropertyStyle;

          //we want all the styles defined before and after
          forEach(element, function(element) {
            if (element.nodeType == ELEMENT_NODE) {
              var elementStyles = $window.getComputedStyle(element) || {};

              transitionDurationStyle = elementStyles[TRANSITION_PROP + DURATION_KEY];

              transitionDuration = Math.max(parseMaxTime(transitionDurationStyle), transitionDuration);

              transitionPropertyStyle = elementStyles[TRANSITION_PROP + PROPERTY_KEY];

              transitionDelayStyle = elementStyles[TRANSITION_PROP + DELAY_KEY];

              transitionDelay  = Math.max(parseMaxTime(transitionDelayStyle), transitionDelay);

              animationDelayStyle = elementStyles[ANIMATION_PROP + DELAY_KEY];

              animationDelay   = Math.max(parseMaxTime(animationDelayStyle), animationDelay);

              var aDuration  = parseMaxTime(elementStyles[ANIMATION_PROP + DURATION_KEY]);

              if(aDuration > 0) {
                aDuration *= parseInt(elementStyles[ANIMATION_PROP + ANIMATION_ITERATION_COUNT_KEY], 10) || 1;
              }

              animationDuration = Math.max(aDuration, animationDuration);
            }
          });
          data = {
            total : 0,
            transitionPropertyStyle: transitionPropertyStyle,
            transitionDurationStyle: transitionDurationStyle,
            transitionDelayStyle: transitionDelayStyle,
            transitionDelay: transitionDelay,
            transitionDuration: transitionDuration,
            animationDelayStyle: animationDelayStyle,
            animationDelay: animationDelay,
            animationDuration: animationDuration
          };
          if(cacheKey) {
            lookupCache[cacheKey] = data;
          }
        }
        return data;
      }

      function parseMaxTime(str) {
        var maxValue = 0;
        var values = angular.isString(str) ?
          str.split(/\s*,\s*/) :
          [];
        forEach(values, function(value) {
          maxValue = Math.max(parseFloat(value) || 0, maxValue);
        });
        return maxValue;
      }

      function getCacheKey(element) {
        var parentElement = element.parent();
        var parentID = parentElement.data(NG_ANIMATE_PARENT_KEY);
        if(!parentID) {
          parentElement.data(NG_ANIMATE_PARENT_KEY, ++parentCounter);
          parentID = parentCounter;
        }
        return parentID + '-' + extractElementNode(element).getAttribute('class');
      }

      function animateSetup(animationEvent, element, className, calculationDecorator) {
        var cacheKey = getCacheKey(element);
        var eventCacheKey = cacheKey + ' ' + className;
        var itemIndex = lookupCache[eventCacheKey] ? ++lookupCache[eventCacheKey].total : 0;

        var stagger = {};
        if(itemIndex > 0) {
          var staggerClassName = className + '-stagger';
          var staggerCacheKey = cacheKey + ' ' + staggerClassName;
          var applyClasses = !lookupCache[staggerCacheKey];

          applyClasses && element.addClass(staggerClassName);

          stagger = getElementAnimationDetails(element, staggerCacheKey);

          applyClasses && element.removeClass(staggerClassName);
        }

        /* the animation itself may need to add/remove special CSS classes
         * before calculating the anmation styles */
        calculationDecorator = calculationDecorator ||
                               function(fn) { return fn(); };

        element.addClass(className);

        var formerData = element.data(NG_ANIMATE_CSS_DATA_KEY) || {};

        var timings = calculationDecorator(function() {
          return getElementAnimationDetails(element, eventCacheKey);
        });

        var transitionDuration = timings.transitionDuration;
        var animationDuration = timings.animationDuration;
        if(transitionDuration === 0 && animationDuration === 0) {
          element.removeClass(className);
          return false;
        }

        element.data(NG_ANIMATE_CSS_DATA_KEY, {
          running : formerData.running || 0,
          itemIndex : itemIndex,
          stagger : stagger,
          timings : timings,
          closeAnimationFn : noop
        });

        //temporarily disable the transition so that the enter styles
        //don't animate twice (this is here to avoid a bug in Chrome/FF).
        var isCurrentlyAnimating = formerData.running > 0 || animationEvent == 'setClass';
        if(transitionDuration > 0) {
          blockTransitions(element, className, isCurrentlyAnimating);
        }

        //staggering keyframe animations work by adjusting the `animation-delay` CSS property
        //on the given element, however, the delay value can only calculated after the reflow
        //since by that time $animate knows how many elements are being animated. Therefore,
        //until the reflow occurs the element needs to be blocked (where the keyframe animation
        //is set to `none 0s`). This blocking mechanism should only be set for when a stagger
        //animation is detected and when the element item index is greater than 0.
        if(animationDuration > 0 && stagger.animationDelay > 0 && stagger.animationDuration === 0) {
          blockKeyframeAnimations(element);
        }

        return true;
      }

      function isStructuralAnimation(className) {
        return className == 'ng-enter' || className == 'ng-move' || className == 'ng-leave';
      }

      function blockTransitions(element, className, isAnimating) {
        if(isStructuralAnimation(className) || !isAnimating) {
          extractElementNode(element).style[TRANSITION_PROP + PROPERTY_KEY] = 'none';
        } else {
          element.addClass(NG_ANIMATE_BLOCK_CLASS_NAME);
        }
      }

      function blockKeyframeAnimations(element) {
        extractElementNode(element).style[ANIMATION_PROP] = 'none 0s';
      }

      function unblockTransitions(element, className) {
        var prop = TRANSITION_PROP + PROPERTY_KEY;
        var node = extractElementNode(element);
        if(node.style[prop] && node.style[prop].length > 0) {
          node.style[prop] = '';
        }
        element.removeClass(NG_ANIMATE_BLOCK_CLASS_NAME);
      }

      function unblockKeyframeAnimations(element) {
        var prop = ANIMATION_PROP;
        var node = extractElementNode(element);
        if(node.style[prop] && node.style[prop].length > 0) {
          node.style[prop] = '';
        }
      }

      function animateRun(animationEvent, element, className, activeAnimationComplete) {
        var node = extractElementNode(element);
        var elementData = element.data(NG_ANIMATE_CSS_DATA_KEY);
        if(node.getAttribute('class').indexOf(className) == -1 || !elementData) {
          activeAnimationComplete();
          return;
        }

        var activeClassName = '';
        forEach(className.split(' '), function(klass, i) {
          activeClassName += (i > 0 ? ' ' : '') + klass + '-active';
        });

        var stagger = elementData.stagger;
        var timings = elementData.timings;
        var itemIndex = elementData.itemIndex;
        var maxDuration = Math.max(timings.transitionDuration, timings.animationDuration);
        var maxDelay = Math.max(timings.transitionDelay, timings.animationDelay);
        var maxDelayTime = maxDelay * ONE_SECOND;

        var startTime = Date.now();
        var css3AnimationEvents = ANIMATIONEND_EVENT + ' ' + TRANSITIONEND_EVENT;

        var style = '', appliedStyles = [];
        if(timings.transitionDuration > 0) {
          var propertyStyle = timings.transitionPropertyStyle;
          if(propertyStyle.indexOf('all') == -1) {
            style += CSS_PREFIX + 'transition-property: ' + propertyStyle + ';';
            style += CSS_PREFIX + 'transition-duration: ' + timings.transitionDurationStyle + ';';
            appliedStyles.push(CSS_PREFIX + 'transition-property');
            appliedStyles.push(CSS_PREFIX + 'transition-duration');
          }
        }

        if(itemIndex > 0) {
          if(stagger.transitionDelay > 0 && stagger.transitionDuration === 0) {
            var delayStyle = timings.transitionDelayStyle;
            style += CSS_PREFIX + 'transition-delay: ' +
                     prepareStaggerDelay(delayStyle, stagger.transitionDelay, itemIndex) + '; ';
            appliedStyles.push(CSS_PREFIX + 'transition-delay');
          }

          if(stagger.animationDelay > 0 && stagger.animationDuration === 0) {
            style += CSS_PREFIX + 'animation-delay: ' +
                     prepareStaggerDelay(timings.animationDelayStyle, stagger.animationDelay, itemIndex) + '; ';
            appliedStyles.push(CSS_PREFIX + 'animation-delay');
          }
        }

        if(appliedStyles.length > 0) {
          //the element being animated may sometimes contain comment nodes in
          //the jqLite object, so we're safe to use a single variable to house
          //the styles since there is always only one element being animated
          var oldStyle = node.getAttribute('style') || '';
          node.setAttribute('style', oldStyle + ' ' + style);
        }

        element.on(css3AnimationEvents, onAnimationProgress);
        element.addClass(activeClassName);
        elementData.closeAnimationFn = function() {
          onEnd();
          activeAnimationComplete();
        };

        var staggerTime       = itemIndex * (Math.max(stagger.animationDelay, stagger.transitionDelay) || 0);
        var animationTime     = (maxDelay + maxDuration) * CLOSING_TIME_BUFFER;
        var totalTime         = (staggerTime + animationTime) * ONE_SECOND;

        elementData.running++;
        animationCloseHandler(element, totalTime);
        return onEnd;

        // This will automatically be called by $animate so
        // there is no need to attach this internally to the
        // timeout done method.
        function onEnd(cancelled) {
          element.off(css3AnimationEvents, onAnimationProgress);
          element.removeClass(activeClassName);
          animateClose(element, className);
          var node = extractElementNode(element);
          for (var i in appliedStyles) {
            node.style.removeProperty(appliedStyles[i]);
          }
        }

        function onAnimationProgress(event) {
          event.stopPropagation();
          var ev = event.originalEvent || event;
          var timeStamp = ev.$manualTimeStamp || ev.timeStamp || Date.now();

          /* Firefox (or possibly just Gecko) likes to not round values up
           * when a ms measurement is used for the animation */
          var elapsedTime = parseFloat(ev.elapsedTime.toFixed(ELAPSED_TIME_MAX_DECIMAL_PLACES));

          /* $manualTimeStamp is a mocked timeStamp value which is set
           * within browserTrigger(). This is only here so that tests can
           * mock animations properly. Real events fallback to event.timeStamp,
           * or, if they don't, then a timeStamp is automatically created for them.
           * We're checking to see if the timeStamp surpasses the expected delay,
           * but we're using elapsedTime instead of the timeStamp on the 2nd
           * pre-condition since animations sometimes close off early */
          if(Math.max(timeStamp - startTime, 0) >= maxDelayTime && elapsedTime >= maxDuration) {
            activeAnimationComplete();
          }
        }
      }

      function prepareStaggerDelay(delayStyle, staggerDelay, index) {
        var style = '';
        forEach(delayStyle.split(','), function(val, i) {
          style += (i > 0 ? ',' : '') +
                   (index * staggerDelay + parseInt(val, 10)) + 's';
        });
        return style;
      }

      function animateBefore(animationEvent, element, className, calculationDecorator) {
        if(animateSetup(animationEvent, element, className, calculationDecorator)) {
          return function(cancelled) {
            cancelled && animateClose(element, className);
          };
        }
      }

      function animateAfter(animationEvent, element, className, afterAnimationComplete) {
        if(element.data(NG_ANIMATE_CSS_DATA_KEY)) {
          return animateRun(animationEvent, element, className, afterAnimationComplete);
        } else {
          animateClose(element, className);
          afterAnimationComplete();
        }
      }

      function animate(animationEvent, element, className, animationComplete) {
        //If the animateSetup function doesn't bother returning a
        //cancellation function then it means that there is no animation
        //to perform at all
        var preReflowCancellation = animateBefore(animationEvent, element, className);
        if(!preReflowCancellation) {
          animationComplete();
          return;
        }

        //There are two cancellation functions: one is before the first
        //reflow animation and the second is during the active state
        //animation. The first function will take care of removing the
        //data from the element which will not make the 2nd animation
        //happen in the first place
        var cancel = preReflowCancellation;
        afterReflow(element, function() {
          unblockTransitions(element, className);
          unblockKeyframeAnimations(element);
          //once the reflow is complete then we point cancel to
          //the new cancellation function which will remove all of the
          //animation properties from the active animation
          cancel = animateAfter(animationEvent, element, className, animationComplete);
        });

        return function(cancelled) {
          (cancel || noop)(cancelled);
        };
      }

      function animateClose(element, className) {
        element.removeClass(className);
        var data = element.data(NG_ANIMATE_CSS_DATA_KEY);
        if(data) {
          if(data.running) {
            data.running--;
          }
          if(!data.running || data.running === 0) {
            element.removeData(NG_ANIMATE_CSS_DATA_KEY);
          }
        }
      }

      return {
        enter : function(element, animationCompleted) {
          return animate('enter', element, 'ng-enter', animationCompleted);
        },

        leave : function(element, animationCompleted) {
          return animate('leave', element, 'ng-leave', animationCompleted);
        },

        move : function(element, animationCompleted) {
          return animate('move', element, 'ng-move', animationCompleted);
        },

        beforeSetClass : function(element, add, remove, animationCompleted) {
          var className = suffixClasses(remove, '-remove') + ' ' +
                          suffixClasses(add, '-add');
          var cancellationMethod = animateBefore('setClass', element, className, function(fn) {
            /* when classes are removed from an element then the transition style
             * that is applied is the transition defined on the element without the
             * CSS class being there. This is how CSS3 functions outside of ngAnimate.
             * http://plnkr.co/edit/j8OzgTNxHTb4n3zLyjGW?p=preview */
            var klass = element.attr('class');
            element.removeClass(remove);
            element.addClass(add);
            var timings = fn();
            element.attr('class', klass);
            return timings;
          });

          if(cancellationMethod) {
            afterReflow(element, function() {
              unblockTransitions(element, className);
              unblockKeyframeAnimations(element);
              animationCompleted();
            });
            return cancellationMethod;
          }
          animationCompleted();
        },

        beforeAddClass : function(element, className, animationCompleted) {
          var cancellationMethod = animateBefore('addClass', element, suffixClasses(className, '-add'), function(fn) {

            /* when a CSS class is added to an element then the transition style that
             * is applied is the transition defined on the element when the CSS class
             * is added at the time of the animation. This is how CSS3 functions
             * outside of ngAnimate. */
            element.addClass(className);
            var timings = fn();
            element.removeClass(className);
            return timings;
          });

          if(cancellationMethod) {
            afterReflow(element, function() {
              unblockTransitions(element, className);
              unblockKeyframeAnimations(element);
              animationCompleted();
            });
            return cancellationMethod;
          }
          animationCompleted();
        },

        setClass : function(element, add, remove, animationCompleted) {
          remove = suffixClasses(remove, '-remove');
          add = suffixClasses(add, '-add');
          var className = remove + ' ' + add;
          return animateAfter('setClass', element, className, animationCompleted);
        },

        addClass : function(element, className, animationCompleted) {
          return animateAfter('addClass', element, suffixClasses(className, '-add'), animationCompleted);
        },

        beforeRemoveClass : function(element, className, animationCompleted) {
          var cancellationMethod = animateBefore('removeClass', element, suffixClasses(className, '-remove'), function(fn) {
            /* when classes are removed from an element then the transition style
             * that is applied is the transition defined on the element without the
             * CSS class being there. This is how CSS3 functions outside of ngAnimate.
             * http://plnkr.co/edit/j8OzgTNxHTb4n3zLyjGW?p=preview */
            var klass = element.attr('class');
            element.removeClass(className);
            var timings = fn();
            element.attr('class', klass);
            return timings;
          });

          if(cancellationMethod) {
            afterReflow(element, function() {
              unblockTransitions(element, className);
              unblockKeyframeAnimations(element);
              animationCompleted();
            });
            return cancellationMethod;
          }
          animationCompleted();
        },

        removeClass : function(element, className, animationCompleted) {
          return animateAfter('removeClass', element, suffixClasses(className, '-remove'), animationCompleted);
        }
      };

      function suffixClasses(classes, suffix) {
        var className = '';
        classes = angular.isArray(classes) ? classes : classes.split(/\s+/);
        forEach(classes, function(klass, i) {
          if(klass && klass.length > 0) {
            className += (i > 0 ? ' ' : '') + klass + suffix;
          }
        });
        return className;
      }
    }]);
  }]);


})(window, window.angular);

/*!
 * ui-select
 * http://github.com/angular-ui/ui-select
 * Version: 0.8.3 - 2014-10-14T18:22:05.432Z
 * License: MIT
 */
!function(){"use strict";var e={TAB:9,ENTER:13,ESC:27,SPACE:32,LEFT:37,UP:38,RIGHT:39,DOWN:40,SHIFT:16,CTRL:17,ALT:18,PAGE_UP:33,PAGE_DOWN:34,HOME:36,END:35,BACKSPACE:8,DELETE:46,COMMAND:91,isControl:function(t){var c=t.which;switch(c){case e.COMMAND:case e.SHIFT:case e.CTRL:case e.ALT:return!0}return t.metaKey?!0:!1},isFunctionKey:function(e){return e=e.which?e.which:e,e>=112&&123>=e},isVerticalMovement:function(t){return~[e.UP,e.DOWN].indexOf(t)},isHorizontalMovement:function(t){return~[e.LEFT,e.RIGHT,e.BACKSPACE,e.DELETE].indexOf(t)}};void 0===angular.element.prototype.querySelectorAll&&(angular.element.prototype.querySelectorAll=function(e){return angular.element(this[0].querySelectorAll(e))}),angular.module("ui.select",[]).constant("uiSelectConfig",{theme:"bootstrap",searchEnabled:!0,placeholder:"",refreshDelay:1e3}).service("uiSelectMinErr",function(){var e=angular.$$minErr("ui.select");return function(){var t=e.apply(this,arguments),c=t.message.replace(new RegExp("\nhttp://errors.angularjs.org/.*"),"");return new Error(c)}}).service("RepeatParser",["uiSelectMinErr","$parse",function(e,t){var c=this;c.parse=function(c){var l=c.match(/^\s*(?:([\s\S]+?)\s+as\s+)?([\S]+?)\s+in\s+([\s\S]+?)(?:\s+track\s+by\s+([\s\S]+?))?\s*$/);if(!l)throw e("iexp","Expected expression in form of '_item_ in _collection_[ track by _id_]' but got '{0}'.",c);return{itemName:l[2],source:t(l[3]),trackByExp:l[4],modelMapper:t(l[1]||l[2])}},c.getGroupNgRepeatExpression=function(){return"$group in $select.groups"},c.getNgRepeatExpression=function(e,t,c,l){var s=e+" in "+(l?"$group.items":t);return c&&(s+=" track by "+c),s}}]).controller("uiSelectCtrl",["$scope","$element","$timeout","RepeatParser","uiSelectMinErr",function(t,c,l,s,i){function n(){p.resetSearchInput&&(p.search=d,p.selected&&p.items.length&&!p.multiple&&(p.activeIndex=p.items.indexOf(p.selected)))}function a(t){var c=!0;switch(t){case e.DOWN:!p.open&&p.multiple?p.activate(!1,!0):p.activeIndex<p.items.length-1&&p.activeIndex++;break;case e.UP:!p.open&&p.multiple?p.activate(!1,!0):p.activeIndex>0&&p.activeIndex--;break;case e.TAB:(!p.multiple||p.open)&&p.select(p.items[p.activeIndex],!0);break;case e.ENTER:p.open?p.select(p.items[p.activeIndex]):p.activate(!1,!0);break;case e.ESC:p.close();break;default:c=!1}return c}function r(t){function c(){switch(t){case e.LEFT:return~p.activeMatchIndex?u:n;case e.RIGHT:return~p.activeMatchIndex&&a!==n?r:(p.activate(),!1);case e.BACKSPACE:return~p.activeMatchIndex?(p.removeChoice(a),u):n;case e.DELETE:return~p.activeMatchIndex?(p.removeChoice(p.activeMatchIndex),a):!1}}var l=o(h[0]),s=p.selected.length,i=0,n=s-1,a=p.activeMatchIndex,r=p.activeMatchIndex+1,u=p.activeMatchIndex-1,d=a;return l>0||p.search.length&&t==e.RIGHT?!1:(p.close(),d=c(),p.activeMatchIndex=p.selected.length&&d!==!1?Math.min(n,Math.max(i,d)):-1,!0)}function o(e){return angular.isNumber(e.selectionStart)?e.selectionStart:e.value.length}function u(){var e=c.querySelectorAll(".ui-select-choices-content"),t=e.querySelectorAll(".ui-select-choices-row");if(t.length<1)throw i("choices","Expected multiple .ui-select-choices-row but got '{0}'.",t.length);var l=t[p.activeIndex],s=l.offsetTop+l.clientHeight-e[0].scrollTop,n=e[0].offsetHeight;s>n?e[0].scrollTop+=s-n:s<l.clientHeight&&(p.isGrouped&&0===p.activeIndex?e[0].scrollTop=0:e[0].scrollTop-=l.clientHeight-s)}var p=this,d="";p.placeholder=void 0,p.search=d,p.activeIndex=0,p.activeMatchIndex=-1,p.items=[],p.selected=void 0,p.open=!1,p.focus=!1,p.focusser=void 0,p.disabled=void 0,p.searchEnabled=void 0,p.resetSearchInput=void 0,p.refreshDelay=void 0,p.multiple=!1,p.disableChoiceExpression=void 0,p.isEmpty=function(){return angular.isUndefined(p.selected)||null===p.selected||""===p.selected};var h=c.querySelectorAll("input.ui-select-search");if(1!==h.length)throw i("searchInput","Expected 1 input.ui-select-search but got '{0}'.",h.length);p.activate=function(e,t){p.disabled||p.open||(t||n(),p.focusser.prop("disabled",!0),p.open=!0,p.activeMatchIndex=-1,p.activeIndex=p.activeIndex>=p.items.length?0:p.activeIndex,l(function(){p.search=e||p.search,h[0].focus()}))},p.findGroupByName=function(e){return p.groups&&p.groups.filter(function(t){return t.name===e})[0]},p.parseRepeatAttr=function(e,c){function l(e){p.groups=[],angular.forEach(e,function(e){var l=t.$eval(c),s=angular.isFunction(l)?l(e):e[l],i=p.findGroupByName(s);i?i.items.push(e):p.groups.push({name:s,items:[e]})}),p.items=[],p.groups.forEach(function(e){p.items=p.items.concat(e.items)})}function n(e){p.items=e}var a=c?l:n;p.parserResult=s.parse(e),p.isGrouped=!!c,p.itemProperty=p.parserResult.itemName,t.$watchCollection(p.parserResult.source,function(e){if(void 0===e||null===e)p.items=[];else{if(!angular.isArray(e))throw i("items","Expected an array but got '{0}'.",e);if(p.multiple){var t=e.filter(function(e){return p.selected.indexOf(e)<0});a(t)}else a(e);p.ngModel.$modelValue=null}}),p.multiple&&t.$watchCollection("$select.selected",function(e){var c=p.parserResult.source(t);if(e.length){var l=c.filter(function(t){return e.indexOf(t)<0});a(l)}else a(c);p.sizeSearchInput()})};var v;p.refresh=function(e){void 0!==e&&(v&&l.cancel(v),v=l(function(){t.$eval(e)},p.refreshDelay))},p.setActiveItem=function(e){p.activeIndex=p.items.indexOf(e)},p.isActive=function(e){return p.open&&p.items.indexOf(e[p.itemProperty])===p.activeIndex},p.isDisabled=function(e){if(p.open){var t,c=p.items.indexOf(e[p.itemProperty]),l=!1;return c>=0&&!angular.isUndefined(p.disableChoiceExpression)&&(t=p.items[c],l=!!e.$eval(p.disableChoiceExpression),t._uiSelectChoiceDisabled=l),l}},p.select=function(e,c){if(void 0===e||!e._uiSelectChoiceDisabled){var l={};l[p.parserResult.itemName]=e,p.onSelectCallback(t,{$item:e,$model:p.parserResult.modelMapper(t,l)}),p.multiple?(p.selected.push(e),p.sizeSearchInput()):p.selected=e,p.close(c)}},p.close=function(e){p.open&&(n(),p.open=!1,p.multiple||l(function(){p.focusser.prop("disabled",!1),e||p.focusser[0].focus()},0,!1))},p.toggle=function(e){p.open?p.close():p.activate(),e.preventDefault(),e.stopPropagation()},p.removeChoice=function(e){var c=p.selected[e],l={};l[p.parserResult.itemName]=c,p.selected.splice(e,1),p.activeMatchIndex=-1,p.sizeSearchInput(),p.onRemoveCallback(t,{$item:c,$model:p.parserResult.modelMapper(t,l)})},p.getPlaceholder=function(){return p.multiple&&p.selected.length?void 0:p.placeholder};var f;p.sizeSearchInput=function(){var e=h[0],c=h.parent().parent()[0];h.css("width","10px");var s=function(){var t=c.clientWidth-e.offsetLeft-10;50>t&&(t=c.clientWidth),h.css("width",t+"px")};l(function(){0!==c.clientWidth||f?f||s():f=t.$watch(function(){return c.clientWidth},function(e){0!==e&&(s(),f(),f=null)})},0,!1)},h.on("keydown",function(c){var l=c.which;t.$apply(function(){var t=!1;p.multiple&&e.isHorizontalMovement(l)&&(t=r(l)),!t&&p.items.length>0&&(t=a(l)),t&&l!=e.TAB&&(c.preventDefault(),c.stopPropagation())}),e.isVerticalMovement(l)&&p.items.length>0&&u()}),h.on("blur",function(){l(function(){p.activeMatchIndex=-1})}),t.$on("$destroy",function(){h.off("keydown blur")})}]).directive("uiSelect",["$document","uiSelectConfig","uiSelectMinErr","$compile","$parse",function(t,c,l,s,i){return{restrict:"EA",templateUrl:function(e,t){var l=t.theme||c.theme;return l+(angular.isDefined(t.multiple)?"/select-multiple.tpl.html":"/select.tpl.html")},replace:!0,transclude:!0,require:["uiSelect","ngModel"],scope:!0,controller:"uiSelectCtrl",controllerAs:"$select",link:function(c,n,a,r,o){function u(e){var t=!1;t=window.jQuery?window.jQuery.contains(n[0],e.target):n[0].contains(e.target),t||(p.close(),c.$digest())}var p=r[0],d=r[1],h=n.querySelectorAll("input.ui-select-search");p.multiple=angular.isDefined(a.multiple)?""===a.multiple?!0:"true"===a.multiple.toLowerCase():!1,p.onSelectCallback=i(a.onSelect),p.onRemoveCallback=i(a.onRemove),d.$parsers.unshift(function(e){var t,l={};if(p.multiple){for(var s=[],i=p.selected.length-1;i>=0;i--)l={},l[p.parserResult.itemName]=p.selected[i],t=p.parserResult.modelMapper(c,l),s.unshift(t);return s}return l={},l[p.parserResult.itemName]=e,t=p.parserResult.modelMapper(c,l)}),d.$formatters.unshift(function(e){var t,l=p.parserResult.source(c,{$select:{search:""}}),s={};if(l){if(p.multiple){var i=[],n=function(e,l){if(e&&e.length){for(var n=e.length-1;n>=0;n--)if(s[p.parserResult.itemName]=e[n],t=p.parserResult.modelMapper(c,s),t==l)return i.unshift(e[n]),!0;return!1}};if(!e)return i;for(var a=e.length-1;a>=0;a--)n(p.selected,e[a])||n(l,e[a]);return i}var r=function(l){return s[p.parserResult.itemName]=l,t=p.parserResult.modelMapper(c,s),t==e};if(p.selected&&r(p.selected))return p.selected;for(var o=l.length-1;o>=0;o--)if(r(l[o]))return l[o]}return e}),p.ngModel=d;var v=angular.element("<input ng-disabled='$select.disabled' class='ui-select-focusser ui-select-offscreen' type='text' aria-haspopup='true' role='button' />");a.tabindex&&a.$observe("tabindex",function(e){p.multiple?h.attr("tabindex",e):v.attr("tabindex",e),n.removeAttr("tabindex")}),s(v)(c),p.focusser=v,p.multiple||(n.append(v),v.bind("focus",function(){c.$evalAsync(function(){p.focus=!0})}),v.bind("blur",function(){c.$evalAsync(function(){p.focus=!1})}),v.bind("keydown",function(t){return t.which===e.BACKSPACE?(t.preventDefault(),t.stopPropagation(),p.select(void 0),void c.$apply()):void(t.which===e.TAB||e.isControl(t)||e.isFunctionKey(t)||t.which===e.ESC||((t.which==e.DOWN||t.which==e.UP||t.which==e.ENTER||t.which==e.SPACE)&&(t.preventDefault(),t.stopPropagation(),p.activate()),c.$digest()))}),v.bind("keyup input",function(t){t.which===e.TAB||e.isControl(t)||e.isFunctionKey(t)||t.which===e.ESC||t.which==e.ENTER||t.which===e.BACKSPACE||(p.activate(v.val()),v.val(""),c.$digest())})),c.$watch("searchEnabled",function(){var e=c.$eval(a.searchEnabled);p.searchEnabled=void 0!==e?e:!0}),a.$observe("disabled",function(){p.disabled=void 0!==a.disabled?a.disabled:!1}),a.$observe("resetSearchInput",function(){var e=c.$eval(a.resetSearchInput);p.resetSearchInput=void 0!==e?e:!0}),p.multiple?(c.$watchCollection(function(){return d.$modelValue},function(e,t){t!=e&&(d.$modelValue=null)}),c.$watchCollection("$select.selected",function(){d.$setViewValue(Date.now())}),v.prop("disabled",!0)):c.$watch("$select.selected",function(e){d.$viewValue!==e&&d.$setViewValue(e)}),d.$render=function(){if(p.multiple&&!angular.isArray(d.$viewValue)){if(!angular.isUndefined(d.$viewValue)&&null!==d.$viewValue)throw l("multiarr","Expected model value to be array but got '{0}'",d.$viewValue);p.selected=[]}p.selected=d.$viewValue},t.on("click",u),c.$on("$destroy",function(){t.off("click",u)}),o(c,function(e){var t=angular.element("<div>").append(e),c=t.querySelectorAll(".ui-select-match");if(c.removeAttr("ui-select-match"),1!==c.length)throw l("transcluded","Expected 1 .ui-select-match but got '{0}'.",c.length);n.querySelectorAll(".ui-select-match").replaceWith(c);var s=t.querySelectorAll(".ui-select-choices");if(s.removeAttr("ui-select-choices"),1!==s.length)throw l("transcluded","Expected 1 .ui-select-choices but got '{0}'.",s.length);n.querySelectorAll(".ui-select-choices").replaceWith(s)})}}}]).directive("uiSelectChoices",["uiSelectConfig","RepeatParser","uiSelectMinErr","$compile",function(e,t,c,l){return{restrict:"EA",require:"^uiSelect",replace:!0,transclude:!0,templateUrl:function(t){var c=t.parent().attr("theme")||e.theme;return c+"/choices.tpl.html"},compile:function(s,i){if(!i.repeat)throw c("repeat","Expected 'repeat' expression.");return function(s,i,n,a,r){var o=n.groupBy;if(a.parseRepeatAttr(n.repeat,o),a.disableChoiceExpression=n.uiDisableChoice,o){var u=i.querySelectorAll(".ui-select-choices-group");if(1!==u.length)throw c("rows","Expected 1 .ui-select-choices-group but got '{0}'.",u.length);u.attr("ng-repeat",t.getGroupNgRepeatExpression())}var p=i.querySelectorAll(".ui-select-choices-row");if(1!==p.length)throw c("rows","Expected 1 .ui-select-choices-row but got '{0}'.",p.length);p.attr("ng-repeat",t.getNgRepeatExpression(a.parserResult.itemName,"$select.items",a.parserResult.trackByExp,o)).attr("ng-mouseenter","$select.setActiveItem("+a.parserResult.itemName+")").attr("ng-click","$select.select("+a.parserResult.itemName+")");var d=i.querySelectorAll(".ui-select-choices-row-inner");if(1!==d.length)throw c("rows","Expected 1 .ui-select-choices-row-inner but got '{0}'.",d.length);d.attr("uis-transclude-append",""),l(i,r)(s),s.$watch("$select.search",function(e){e&&!a.open&&a.multiple&&a.activate(!1,!0),a.activeIndex=0,a.refresh(n.refresh)}),n.$observe("refreshDelay",function(){var t=s.$eval(n.refreshDelay);a.refreshDelay=void 0!==t?t:e.refreshDelay})}}}}]).directive("uisTranscludeAppend",function(){return{link:function(e,t,c,l,s){s(e,function(e){t.append(e)})}}}).directive("uiSelectMatch",["uiSelectConfig",function(e){return{restrict:"EA",require:"^uiSelect",replace:!0,transclude:!0,templateUrl:function(t){var c=t.parent().attr("theme")||e.theme,l=t.parent().attr("multiple");return c+(l?"/match-multiple.tpl.html":"/match.tpl.html")},link:function(t,c,l,s){l.$observe("placeholder",function(t){s.placeholder=void 0!==t?t:e.placeholder}),s.multiple&&s.sizeSearchInput()}}}]).filter("highlight",function(){function e(e){return e.replace(/([.?*+^$[\]\\(){}|-])/g,"\\$1")}return function(t,c){return c&&t?t.replace(new RegExp(e(c),"gi"),'<span class="ui-select-highlight">$&</span>'):t}})}(),angular.module("ui.select").run(["$templateCache",function(e){e.put("bootstrap/choices.tpl.html",'<ul class="ui-select-choices ui-select-choices-content dropdown-menu" role="menu" aria-labelledby="dLabel" ng-show="$select.items.length > 0"><li class="ui-select-choices-group"><div class="divider" ng-show="$select.isGrouped && $index > 0"></div><div ng-show="$select.isGrouped" class="ui-select-choices-group-label dropdown-header">{{$group.name}}</div><div class="ui-select-choices-row" ng-class="{active: $select.isActive(this), disabled: $select.isDisabled(this)}"><a href="javascript:void(0)" class="ui-select-choices-row-inner"></a></div></li></ul>'),e.put("bootstrap/match-multiple.tpl.html",'<span class="ui-select-match"><span ng-repeat="$item in $select.selected"><span style="margin-right: 3px;" class="ui-select-match-item btn btn-default btn-xs" tabindex="-1" type="button" ng-disabled="$select.disabled" ng-click="$select.activeMatchIndex = $index;" ng-class="{\'btn-primary\':$select.activeMatchIndex === $index}"><span class="close ui-select-match-close" ng-hide="$select.disabled" ng-click="$select.removeChoice($index)">&nbsp;&times;</span> <span uis-transclude-append=""></span></span></span></span>'),e.put("bootstrap/match.tpl.html",'<button type="button" class="btn btn-default form-control ui-select-match" tabindex="-1" ng-hide="$select.open" ng-disabled="$select.disabled" ng-class="{\'btn-default-focus\':$select.focus}" ;="" ng-click="$select.activate()"><span ng-show="$select.searchEnabled && $select.isEmpty()" class="text-muted">{{$select.placeholder}}</span> <span ng-hide="$select.isEmpty()" ng-transclude=""></span> <span class="caret ui-select-toggle" ng-click="$select.toggle($event)"></span></button>'),e.put("bootstrap/select-multiple.tpl.html",'<div class="ui-select-multiple ui-select-bootstrap dropdown form-control" ng-class="{open: $select.open}"><div><div class="ui-select-match"></div><input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="ui-select-search input-xs" placeholder="{{$select.getPlaceholder()}}" ng-disabled="$select.disabled" ng-hide="$select.disabled" ng-click="$select.activate()" ng-model="$select.search"></div><div class="ui-select-choices"></div></div>'),e.put("bootstrap/select.tpl.html",'<div class="ui-select-bootstrap dropdown" ng-class="{open: $select.open}"><div class="ui-select-match"></div><input type="text" autocomplete="off" tabindex="-1" class="form-control ui-select-search" placeholder="{{$select.placeholder}}" ng-model="$select.search" ng-show="$select.searchEnabled && $select.open"><div class="ui-select-choices"></div></div>'),e.put("select2/choices.tpl.html",'<ul class="ui-select-choices ui-select-choices-content select2-results"><li class="ui-select-choices-group" ng-class="{\'select2-result-with-children\': $select.isGrouped}"><div ng-show="$select.isGrouped" class="ui-select-choices-group-label select2-result-label">{{$group.name}}</div><ul ng-class="{\'select2-result-sub\': $select.isGrouped, \'select2-result-single\': !$select.isGrouped}"><li class="ui-select-choices-row" ng-class="{\'select2-highlighted\': $select.isActive(this), \'select2-disabled\': $select.isDisabled(this)}"><div class="select2-result-label ui-select-choices-row-inner"></div></li></ul></li></ul>'),e.put("select2/match-multiple.tpl.html",'<span class="ui-select-match"><li class="ui-select-match-item select2-search-choice" ng-repeat="$item in $select.selected" ng-class="{\'select2-search-choice-focus\':$select.activeMatchIndex === $index}"><span uis-transclude-append=""></span> <a href="javascript:;" class="ui-select-match-close select2-search-choice-close" ng-click="$select.removeChoice($index)" tabindex="-1"></a></li></span>'),e.put("select2/match.tpl.html",'<a class="select2-choice ui-select-match" ng-class="{\'select2-default\': $select.isEmpty()}" ng-click="$select.activate()"><span ng-show="$select.searchEnabled && $select.isEmpty()" class="select2-chosen">{{$select.placeholder}}</span> <span ng-hide="$select.isEmpty()" class="select2-chosen" ng-transclude=""></span> <span class="select2-arrow ui-select-toggle" ng-click="$select.toggle($event)"><b></b></span></a>'),e.put("select2/select-multiple.tpl.html",'<div class="ui-select-multiple select2 select2-container select2-container-multi" ng-class="{\'select2-container-active select2-dropdown-open\': $select.open,\n                \'select2-container-disabled\': $select.disabled}"><ul class="select2-choices"><span class="ui-select-match"></span><li class="select2-search-field"><input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input ui-select-search" placeholder="{{$select.getPlaceholder()}}" ng-disabled="$select.disabled" ng-hide="$select.disabled" ng-model="$select.search" ng-click="$select.activate()" style="width: 34px;"></li></ul><div class="select2-drop select2-with-searchbox select2-drop-active" ng-class="{\'select2-display-none\': !$select.open}"><div class="ui-select-choices"></div></div></div>'),e.put("select2/select.tpl.html",'<div class="select2 select2-container" ng-class="{\'select2-container-active select2-dropdown-open\': $select.open,\n                \'select2-container-disabled\': $select.disabled,\n                \'select2-container-active\': $select.focus }"><div class="ui-select-match"></div><div class="select2-drop select2-with-searchbox select2-drop-active" ng-class="{\'select2-display-none\': !$select.open}"><div class="select2-search" ng-show="$select.searchEnabled"><input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="ui-select-search select2-input" ng-model="$select.search"></div><div class="ui-select-choices"></div></div></div>'),e.put("selectize/choices.tpl.html",'<div ng-show="$select.open" class="ui-select-choices selectize-dropdown single"><div class="ui-select-choices-content selectize-dropdown-content"><div class="ui-select-choices-group optgroup"><div ng-show="$select.isGrouped" class="ui-select-choices-group-label optgroup-header">{{$group.name}}</div><div class="ui-select-choices-row" ng-class="{active: $select.isActive(this), disabled: $select.isDisabled(this)}"><div class="option ui-select-choices-row-inner" data-selectable=""></div></div></div></div></div>'),e.put("selectize/match.tpl.html",'<div ng-hide="$select.searchEnabled && ($select.open || $select.isEmpty())" class="ui-select-match" ng-transclude=""></div>'),e.put("selectize/select.tpl.html",'<div class="selectize-control single"><div class="selectize-input" ng-class="{\'focus\': $select.open, \'disabled\': $select.disabled, \'selectize-focus\' : $select.focus}" ng-click="$select.activate()"><div class="ui-select-match"></div><input type="text" autocomplete="off" tabindex="-1" class="ui-select-search ui-select-toggle" ng-click="$select.toggle($event)" placeholder="{{$select.placeholder}}" ng-model="$select.search" ng-hide="!$select.searchEnabled || ($select.selected && !$select.open)" ng-disabled="$select.disabled"></div><div class="ui-select-choices"></div></div>')}]);
/**
 * angular-ui-utils - Swiss-Army-Knife of AngularJS tools (with no external dependencies!)
 * @version v0.1.1 - 2014-02-05
 * @link http://angular-ui.github.com
 * @license MIT License, http://www.opensource.org/licenses/MIT
 */
"use strict";angular.module("ui.alias",[]).config(["$compileProvider","uiAliasConfig",function(a,b){b=b||{},angular.forEach(b,function(b,c){angular.isString(b)&&(b={replace:!0,template:b}),a.directive(c,function(){return b})})}]),angular.module("ui.event",[]).directive("uiEvent",["$parse",function(a){return function(b,c,d){var e=b.$eval(d.uiEvent);angular.forEach(e,function(d,e){var f=a(d);c.bind(e,function(a){var c=Array.prototype.slice.call(arguments);c=c.splice(1),f(b,{$event:a,$params:c}),b.$$phase||b.$apply()})})}}]),angular.module("ui.format",[]).filter("format",function(){return function(a,b){var c=a;if(angular.isString(c)&&void 0!==b)if(angular.isArray(b)||angular.isObject(b)||(b=[b]),angular.isArray(b)){var d=b.length,e=function(a,c){return c=parseInt(c,10),c>=0&&d>c?b[c]:a};c=c.replace(/\$([0-9]+)/g,e)}else angular.forEach(b,function(a,b){c=c.split(":"+b).join(a)});return c}}),angular.module("ui.highlight",[]).filter("highlight",function(){return function(a,b,c){return b||angular.isNumber(b)?(a=a.toString(),b=b.toString(),c?a.split(b).join('<span class="ui-match">'+b+"</span>"):a.replace(new RegExp(b,"gi"),'<span class="ui-match">$&</span>')):a}}),angular.module("ui.include",[]).directive("uiInclude",["$http","$templateCache","$anchorScroll","$compile",function(a,b,c,d){return{restrict:"ECA",terminal:!0,compile:function(e,f){var g=f.uiInclude||f.src,h=f.fragment||"",i=f.onload||"",j=f.autoscroll;return function(e,f){function k(){var k=++m,o=e.$eval(g),p=e.$eval(h);o?a.get(o,{cache:b}).success(function(a){if(k===m){l&&l.$destroy(),l=e.$new();var b;b=p?angular.element("<div/>").html(a).find(p):angular.element("<div/>").html(a).contents(),f.html(b),d(b)(l),!angular.isDefined(j)||j&&!e.$eval(j)||c(),l.$emit("$includeContentLoaded"),e.$eval(i)}}).error(function(){k===m&&n()}):n()}var l,m=0,n=function(){l&&(l.$destroy(),l=null),f.html("")};e.$watch(h,k),e.$watch(g,k)}}}}]),angular.module("ui.indeterminate",[]).directive("uiIndeterminate",[function(){return{compile:function(a,b){return b.type&&"checkbox"===b.type.toLowerCase()?function(a,b,c){a.$watch(c.uiIndeterminate,function(a){b[0].indeterminate=!!a})}:angular.noop}}}]),angular.module("ui.inflector",[]).filter("inflector",function(){function a(a){return a.replace(/^([a-z])|\s+([a-z])/g,function(a){return a.toUpperCase()})}function b(a,b){return a.replace(/[A-Z]/g,function(a){return b+a})}var c={humanize:function(c){return a(b(c," ").split("_").join(" "))},underscore:function(a){return a.substr(0,1).toLowerCase()+b(a.substr(1),"_").toLowerCase().split(" ").join("_")},variable:function(b){return b=b.substr(0,1).toLowerCase()+a(b.split("_").join(" ")).substr(1).split(" ").join("")}};return function(a,b){return b!==!1&&angular.isString(a)?(b=b||"humanize",c[b](a)):a}}),angular.module("ui.jq",[]).value("uiJqConfig",{}).directive("uiJq",["uiJqConfig","$timeout",function(a,b){return{restrict:"A",compile:function(c,d){if(!angular.isFunction(c[d.uiJq]))throw new Error('ui-jq: The "'+d.uiJq+'" function does not exist');var e=a&&a[d.uiJq];return function(a,c,d){function f(){b(function(){c[d.uiJq].apply(c,g)},0,!1)}var g=[];d.uiOptions?(g=a.$eval("["+d.uiOptions+"]"),angular.isObject(e)&&angular.isObject(g[0])&&(g[0]=angular.extend({},e,g[0]))):e&&(g=[e]),d.ngModel&&c.is("select,input,textarea")&&c.bind("change",function(){c.trigger("input")}),d.uiRefresh&&a.$watch(d.uiRefresh,function(){f()}),f()}}}}]),angular.module("ui.keypress",[]).factory("keypressHelper",["$parse",function(a){var b={8:"backspace",9:"tab",13:"enter",27:"esc",32:"space",33:"pageup",34:"pagedown",35:"end",36:"home",37:"left",38:"up",39:"right",40:"down",45:"insert",46:"delete"},c=function(a){return a.charAt(0).toUpperCase()+a.slice(1)};return function(d,e,f,g){var h,i=[];h=e.$eval(g["ui"+c(d)]),angular.forEach(h,function(b,c){var d,e;e=a(b),angular.forEach(c.split(" "),function(a){d={expression:e,keys:{}},angular.forEach(a.split("-"),function(a){d.keys[a]=!0}),i.push(d)})}),f.bind(d,function(a){var c=!(!a.metaKey||a.ctrlKey),f=!!a.altKey,g=!!a.ctrlKey,h=!!a.shiftKey,j=a.keyCode;"keypress"===d&&!h&&j>=97&&122>=j&&(j-=32),angular.forEach(i,function(d){var i=d.keys[b[j]]||d.keys[j.toString()],k=!!d.keys.meta,l=!!d.keys.alt,m=!!d.keys.ctrl,n=!!d.keys.shift;i&&k===c&&l===f&&m===g&&n===h&&e.$apply(function(){d.expression(e,{$event:a})})})})}}]),angular.module("ui.keypress").directive("uiKeydown",["keypressHelper",function(a){return{link:function(b,c,d){a("keydown",b,c,d)}}}]),angular.module("ui.keypress").directive("uiKeypress",["keypressHelper",function(a){return{link:function(b,c,d){a("keypress",b,c,d)}}}]),angular.module("ui.keypress").directive("uiKeyup",["keypressHelper",function(a){return{link:function(b,c,d){a("keyup",b,c,d)}}}]),angular.module("ui.mask",[]).value("uiMaskConfig",{maskDefinitions:{9:/\d/,A:/[a-zA-Z]/,"*":/[a-zA-Z0-9]/}}).directive("uiMask",["uiMaskConfig",function(a){return{priority:100,require:"ngModel",restrict:"A",compile:function(){var b=a;return function(a,c,d,e){function f(a){return angular.isDefined(a)?(s(a),N?(k(),l(),!0):j()):j()}function g(a){angular.isDefined(a)&&(D=a,N&&w())}function h(a){return N?(G=o(a||""),I=n(G),e.$setValidity("mask",I),I&&G.length?p(G):void 0):a}function i(a){return N?(G=o(a||""),I=n(G),e.$viewValue=G.length?p(G):"",e.$setValidity("mask",I),""===G&&void 0!==e.$error.required&&e.$setValidity("required",!1),I?G:void 0):a}function j(){return N=!1,m(),angular.isDefined(P)?c.attr("placeholder",P):c.removeAttr("placeholder"),angular.isDefined(Q)?c.attr("maxlength",Q):c.removeAttr("maxlength"),c.val(e.$modelValue),e.$viewValue=e.$modelValue,!1}function k(){G=K=o(e.$modelValue||""),H=J=p(G),I=n(G);var a=I&&G.length?H:"";d.maxlength&&c.attr("maxlength",2*B[B.length-1]),c.attr("placeholder",D),c.val(a),e.$viewValue=a}function l(){O||(c.bind("blur",t),c.bind("mousedown mouseup",u),c.bind("input keyup click focus",w),O=!0)}function m(){O&&(c.unbind("blur",t),c.unbind("mousedown",u),c.unbind("mouseup",u),c.unbind("input",w),c.unbind("keyup",w),c.unbind("click",w),c.unbind("focus",w),O=!1)}function n(a){return a.length?a.length>=F:!0}function o(a){var b="",c=C.slice();return a=a.toString(),angular.forEach(E,function(b){a=a.replace(b,"")}),angular.forEach(a.split(""),function(a){c.length&&c[0].test(a)&&(b+=a,c.shift())}),b}function p(a){var b="",c=B.slice();return angular.forEach(D.split(""),function(d,e){a.length&&e===c[0]?(b+=a.charAt(0)||"_",a=a.substr(1),c.shift()):b+=d}),b}function q(a){var b=d.placeholder;return"undefined"!=typeof b&&b[a]?b[a]:"_"}function r(){return D.replace(/[_]+/g,"_").replace(/([^_]+)([a-zA-Z0-9])([^_])/g,"$1$2_$3").split("_")}function s(a){var b=0;if(B=[],C=[],D="","string"==typeof a){F=0;var c=!1,d=a.split("");angular.forEach(d,function(a,d){R.maskDefinitions[a]?(B.push(b),D+=q(d),C.push(R.maskDefinitions[a]),b++,c||F++):"?"===a?c=!0:(D+=a,b++)})}B.push(B.slice().pop()+1),E=r(),N=B.length>1?!0:!1}function t(){L=0,M=0,I&&0!==G.length||(H="",c.val(""),a.$apply(function(){e.$setViewValue("")}))}function u(a){"mousedown"===a.type?c.bind("mouseout",v):c.unbind("mouseout",v)}function v(){M=A(this),c.unbind("mouseout",v)}function w(b){b=b||{};var d=b.which,f=b.type;if(16!==d&&91!==d){var g,h=c.val(),i=J,j=o(h),k=K,l=!1,m=y(this)||0,n=L||0,q=m-n,r=B[0],s=B[j.length]||B.slice().shift(),t=M||0,u=A(this)>0,v=t>0,w=h.length>i.length||t&&h.length>i.length-t,C=h.length<i.length||t&&h.length===i.length-t,D=d>=37&&40>=d&&b.shiftKey,E=37===d,F=8===d||"keyup"!==f&&C&&-1===q,G=46===d||"keyup"!==f&&C&&0===q&&!v,H=(E||F||"click"===f)&&m>r;if(M=A(this),!D&&(!u||"click"!==f&&"keyup"!==f)){if("input"===f&&C&&!v&&j===k){for(;F&&m>r&&!x(m);)m--;for(;G&&s>m&&-1===B.indexOf(m);)m++;var I=B.indexOf(m);j=j.substring(0,I)+j.substring(I+1),l=!0}for(g=p(j),J=g,K=j,c.val(g),l&&a.$apply(function(){e.$setViewValue(j)}),w&&r>=m&&(m=r+1),H&&m--,m=m>s?s:r>m?r:m;!x(m)&&m>r&&s>m;)m+=H?-1:1;(H&&s>m||w&&!x(n))&&m++,L=m,z(this,m)}}}function x(a){return B.indexOf(a)>-1}function y(a){if(!a)return 0;if(void 0!==a.selectionStart)return a.selectionStart;if(document.selection){a.focus();var b=document.selection.createRange();return b.moveStart("character",-a.value.length),b.text.length}return 0}function z(a,b){if(!a)return 0;if(0!==a.offsetWidth&&0!==a.offsetHeight)if(a.setSelectionRange)a.focus(),a.setSelectionRange(b,b);else if(a.createTextRange){var c=a.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",b),c.select()}}function A(a){return a?void 0!==a.selectionStart?a.selectionEnd-a.selectionStart:document.selection?document.selection.createRange().text.length:0:0}var B,C,D,E,F,G,H,I,J,K,L,M,N=!1,O=!1,P=d.placeholder,Q=d.maxlength,R={};d.uiOptions?(R=a.$eval("["+d.uiOptions+"]"),angular.isObject(R[0])&&(R=function(a,b){for(var c in a)Object.prototype.hasOwnProperty.call(a,c)&&(b[c]?angular.extend(b[c],a[c]):b[c]=angular.copy(a[c]));return b}(b,R[0]))):R=b,d.$observe("uiMask",f),d.$observe("placeholder",g),e.$formatters.push(h),e.$parsers.push(i),c.bind("mousedown mouseup",u),Array.prototype.indexOf||(Array.prototype.indexOf=function(a){if(null===this)throw new TypeError;var b=Object(this),c=b.length>>>0;if(0===c)return-1;var d=0;if(arguments.length>1&&(d=Number(arguments[1]),d!==d?d=0:0!==d&&1/0!==d&&d!==-1/0&&(d=(d>0||-1)*Math.floor(Math.abs(d)))),d>=c)return-1;for(var e=d>=0?d:Math.max(c-Math.abs(d),0);c>e;e++)if(e in b&&b[e]===a)return e;return-1})}}}}]),angular.module("ui.reset",[]).value("uiResetConfig",null).directive("uiReset",["uiResetConfig",function(a){var b=null;return void 0!==a&&(b=a),{require:"ngModel",link:function(a,c,d,e){var f;f=angular.element('<a class="ui-reset" />'),c.wrap('<span class="ui-resetwrap" />').after(f),f.bind("click",function(c){c.preventDefault(),a.$apply(function(){e.$setViewValue(d.uiReset?a.$eval(d.uiReset):b),e.$render()})})}}}]),angular.module("ui.route",[]).directive("uiRoute",["$location","$parse",function(a,b){return{restrict:"AC",scope:!0,compile:function(c,d){var e;if(d.uiRoute)e="uiRoute";else if(d.ngHref)e="ngHref";else{if(!d.href)throw new Error("uiRoute missing a route or href property on "+c[0]);e="href"}return function(c,d,f){function g(b){var d=b.indexOf("#");d>-1&&(b=b.substr(d+1)),(j=function(){i(c,a.path().indexOf(b)>-1)})()}function h(b){var d=b.indexOf("#");d>-1&&(b=b.substr(d+1)),(j=function(){var d=new RegExp("^"+b+"$",["i"]);i(c,d.test(a.path()))})()}var i=b(f.ngModel||f.routeModel||"$uiRoute").assign,j=angular.noop;switch(e){case"uiRoute":f.uiRoute?h(f.uiRoute):f.$observe("uiRoute",h);break;case"ngHref":f.ngHref?g(f.ngHref):f.$observe("ngHref",g);break;case"href":g(f.href)}c.$on("$routeChangeSuccess",function(){j()}),c.$on("$stateChangeSuccess",function(){j()})}}}}]),angular.module("ui.scroll.jqlite",["ui.scroll"]).service("jqLiteExtras",["$log","$window",function(a,b){return{registerFor:function(a){var c,d,e,f,g,h,i;return d=angular.element.prototype.css,a.prototype.css=function(a,b){var c,e;return e=this,c=e[0],c&&3!==c.nodeType&&8!==c.nodeType&&c.style?d.call(e,a,b):void 0},h=function(a){return a&&a.document&&a.location&&a.alert&&a.setInterval},i=function(a,b,c){var d,e,f,g,i;return d=a[0],i={top:["scrollTop","pageYOffset","scrollLeft"],left:["scrollLeft","pageXOffset","scrollTop"]}[b],e=i[0],g=i[1],f=i[2],h(d)?angular.isDefined(c)?d.scrollTo(a[f].call(a),c):g in d?d[g]:d.document.documentElement[e]:angular.isDefined(c)?d[e]=c:d[e]},b.getComputedStyle?(f=function(a){return b.getComputedStyle(a,null)},c=function(a,b){return parseFloat(b)}):(f=function(a){return a.currentStyle},c=function(a,b){var c,d,e,f,g,h,i;return c=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,f=new RegExp("^("+c+")(?!px)[a-z%]+$","i"),f.test(b)?(i=a.style,d=i.left,g=a.runtimeStyle,h=g&&g.left,g&&(g.left=i.left),i.left=b,e=i.pixelLeft,i.left=d,h&&(g.left=h),e):parseFloat(b)}),e=function(a,b){var d,e,g,i,j,k,l,m,n,o,p,q,r;return h(a)?(d=document.documentElement[{height:"clientHeight",width:"clientWidth"}[b]],{base:d,padding:0,border:0,margin:0}):(r={width:[a.offsetWidth,"Left","Right"],height:[a.offsetHeight,"Top","Bottom"]}[b],d=r[0],l=r[1],m=r[2],k=f(a),p=c(a,k["padding"+l])||0,q=c(a,k["padding"+m])||0,e=c(a,k["border"+l+"Width"])||0,g=c(a,k["border"+m+"Width"])||0,i=k["margin"+l],j=k["margin"+m],n=c(a,i)||0,o=c(a,j)||0,{base:d,padding:p+q,border:e+g,margin:n+o})},g=function(a,b,c){var d,g,h;return g=e(a,b),g.base>0?{base:g.base-g.padding-g.border,outer:g.base,outerfull:g.base+g.margin}[c]:(d=f(a),h=d[b],(0>h||null===h)&&(h=a.style[b]||0),h=parseFloat(h)||0,{base:h-g.padding-g.border,outer:h,outerfull:h+g.padding+g.border+g.margin}[c])},angular.forEach({before:function(a){var b,c,d,e,f,g,h;if(f=this,c=f[0],e=f.parent(),b=e.contents(),b[0]===c)return e.prepend(a);for(d=g=1,h=b.length-1;h>=1?h>=g:g>=h;d=h>=1?++g:--g)if(b[d]===c)return void angular.element(b[d-1]).after(a);throw new Error("invalid DOM structure "+c.outerHTML)},height:function(a){var b;return b=this,angular.isDefined(a)?(angular.isNumber(a)&&(a+="px"),d.call(b,"height",a)):g(this[0],"height","base")},outerHeight:function(a){return g(this[0],"height",a?"outerfull":"outer")},offset:function(a){var b,c,d,e,f,g;return f=this,arguments.length?void 0===a?f:a:(b={top:0,left:0},e=f[0],(c=e&&e.ownerDocument)?(d=c.documentElement,e.getBoundingClientRect&&(b=e.getBoundingClientRect()),g=c.defaultView||c.parentWindow,{top:b.top+(g.pageYOffset||d.scrollTop)-(d.clientTop||0),left:b.left+(g.pageXOffset||d.scrollLeft)-(d.clientLeft||0)}):void 0)},scrollTop:function(a){return i(this,"top",a)},scrollLeft:function(a){return i(this,"left",a)}},function(b,c){return a.prototype[c]?void 0:a.prototype[c]=b})}}}]).run(["$log","$window","jqLiteExtras",function(a,b,c){return b.jQuery?void 0:c.registerFor(angular.element)}]),angular.module("ui.scroll",[]).directive("ngScrollViewport",["$log",function(){return{controller:["$scope","$element",function(a,b){return b}]}}]).directive("ngScroll",["$log","$injector","$rootScope","$timeout",function(a,b,c,d){return{require:["?^ngScrollViewport"],transclude:"element",priority:1e3,terminal:!0,compile:function(e,f,g){return function(f,h,i,j){var k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T;if(H=i.ngScroll.match(/^\s*(\w+)\s+in\s+(\w+)\s*$/),!H)throw new Error('Expected ngScroll in form of "item_ in _datasource_" but got "'+i.ngScroll+'"');if(F=H[1],v=H[2],D=function(a){return angular.isObject(a)&&a.get&&angular.isFunction(a.get)},u=f[v],!D(u)&&(u=b.get(v),!D(u)))throw new Error(v+" is not a valid datasource");return r=Math.max(3,+i.bufferSize||10),q=function(){return T.height()*Math.max(.1,+i.padding||.1)},O=function(a){return a[0].scrollHeight||a[0].document.documentElement.scrollHeight},k=null,g(R=f.$new(),function(a){var b,c,d,f,g,h;if(f=a[0].localName,"dl"===f)throw new Error("ng-scroll directive does not support <"+a[0].localName+"> as a repeating tag: "+a[0].outerHTML);return"li"!==f&&"tr"!==f&&(f="div"),h=j[0]||angular.element(window),h.css({"overflow-y":"auto",display:"block"}),d=function(a){var b,c,d;switch(a){case"tr":return d=angular.element("<table><tr><td><div></div></td></tr></table>"),b=d.find("div"),c=d.find("tr"),c.paddingHeight=function(){return b.height.apply(b,arguments)},c;default:return c=angular.element("<"+a+"></"+a+">"),c.paddingHeight=c.height,c}},c=function(a,b,c){return b[{top:"before",bottom:"after"}[c]](a),{paddingHeight:function(){return a.paddingHeight.apply(a,arguments)},insert:function(b){return a[{top:"after",bottom:"before"}[c]](b)}}},g=c(d(f),e,"top"),b=c(d(f),e,"bottom"),R.$destroy(),k={viewport:h,topPadding:g.paddingHeight,bottomPadding:b.paddingHeight,append:b.insert,prepend:g.insert,bottomDataPos:function(){return O(h)-b.paddingHeight()},topDataPos:function(){return g.paddingHeight()}}}),T=k.viewport,B=1,I=1,p=[],J=[],x=!1,n=!1,G=u.loading||function(){},E=!1,L=function(a,b){var c,d;for(c=d=a;b>=a?b>d:d>b;c=b>=a?++d:--d)p[c].scope.$destroy(),p[c].element.remove();return p.splice(a,b-a)},K=function(){return B=1,I=1,L(0,p.length),k.topPadding(0),k.bottomPadding(0),J=[],x=!1,n=!1,l(!1)},o=function(){return T.scrollTop()+T.height()},S=function(){return T.scrollTop()},P=function(){return!x&&k.bottomDataPos()<o()+q()},s=function(){var b,c,d,e,f,g;for(b=0,e=0,c=f=g=p.length-1;(0>=g?0>=f:f>=0)&&(d=p[c].element.outerHeight(!0),k.bottomDataPos()-b-d>o()+q());c=0>=g?++f:--f)b+=d,e++,x=!1;return e>0?(k.bottomPadding(k.bottomPadding()+b),L(p.length-e,p.length),I-=e,a.log("clipped off bottom "+e+" bottom padding "+k.bottomPadding())):void 0},Q=function(){return!n&&k.topDataPos()>S()-q()},t=function(){var b,c,d,e,f,g;for(e=0,d=0,f=0,g=p.length;g>f&&(b=p[f],c=b.element.outerHeight(!0),k.topDataPos()+e+c<S()-q());f++)e+=c,d++,n=!1;return d>0?(k.topPadding(k.topPadding()+e),L(0,d),B+=d,a.log("clipped off top "+d+" top padding "+k.topPadding())):void 0},w=function(a,b){return E||(E=!0,G(!0)),1===J.push(a)?z(b):void 0},C=function(a,b){var c,d,e;return c=f.$new(),c[F]=b,d=a>B,c.$index=a,d&&c.$index--,e={scope:c},g(c,function(b){return e.element=b,d?a===I?(k.append(b),p.push(e)):(p[a-B].element.after(b),p.splice(a-B+1,0,e)):(k.prepend(b),p.unshift(e))}),{appended:d,wrapper:e}},m=function(a,b){var c;return a?k.bottomPadding(Math.max(0,k.bottomPadding()-b.element.outerHeight(!0))):(c=k.topPadding()-b.element.outerHeight(!0),c>=0?k.topPadding(c):T.scrollTop(T.scrollTop()+b.element.outerHeight(!0)))},l=function(b,c,e){var f;return f=function(){return a.log("top {actual="+k.topDataPos()+" visible from="+S()+" bottom {visible through="+o()+" actual="+k.bottomDataPos()+"}"),P()?w(!0,b):Q()&&w(!1,b),e?e():void 0},c?d(function(){var a,b,d;for(b=0,d=c.length;d>b;b++)a=c[b],m(a.appended,a.wrapper);return f()}):f()},A=function(a,b){return l(a,b,function(){return J.shift(),0===J.length?(E=!1,G(!1)):z(a)})},z=function(b){var c;return c=J[0],c?p.length&&!P()?A(b):u.get(I,r,function(c){var d,e,f,g;if(e=[],0===c.length)x=!0,k.bottomPadding(0),a.log("appended: requested "+r+" records starting from "+I+" recieved: eof");else{for(t(),f=0,g=c.length;g>f;f++)d=c[f],e.push(C(++I,d));a.log("appended: requested "+r+" received "+c.length+" buffer size "+p.length+" first "+B+" next "+I)}return A(b,e)}):p.length&&!Q()?A(b):u.get(B-r,r,function(c){var d,e,f,g;if(e=[],0===c.length)n=!0,k.topPadding(0),a.log("prepended: requested "+r+" records starting from "+(B-r)+" recieved: bof");else{for(s(),d=f=g=c.length-1;0>=g?0>=f:f>=0;d=0>=g?++f:--f)e.unshift(C(--B,c[d]));a.log("prepended: requested "+r+" received "+c.length+" buffer size "+p.length+" first "+B+" next "+I)}return A(b,e)})},M=function(){return c.$$phase||E?void 0:(l(!1),f.$apply())},T.bind("resize",M),N=function(){return c.$$phase||E?void 0:(l(!0),f.$apply())},T.bind("scroll",N),f.$watch(u.revision,function(){return K()}),y=u.scope?u.scope.$new():f.$new(),f.$on("$destroy",function(){return y.$destroy(),T.unbind("resize",M),T.unbind("scroll",N)}),y.$on("update.items",function(a,b,c){var d,e,f,g,h;if(angular.isFunction(b))for(e=function(a){return b(a.scope)},f=0,g=p.length;g>f;f++)d=p[f],e(d);else 0<=(h=b-B-1)&&h<p.length&&(p[b-B-1].scope[F]=c);return null}),y.$on("delete.items",function(a,b){var c,d,e,f,g,h,i,j,k,m,n,o;if(angular.isFunction(b)){for(e=[],h=0,k=p.length;k>h;h++)d=p[h],e.unshift(d);for(g=function(a){return b(a.scope)?(L(e.length-1-c,e.length-c),I--):void 0},c=i=0,m=e.length;m>i;c=++i)f=e[c],g(f)}else 0<=(o=b-B-1)&&o<p.length&&(L(b-B-1,b-B),I--);for(c=j=0,n=p.length;n>j;c=++j)d=p[c],d.scope.$index=B+c;return l(!1)}),y.$on("insert.item",function(a,b,c){var d,e,f,g,h,i,j,k,m,n,o,q;if(e=[],angular.isFunction(b)){for(f=[],i=0,m=p.length;m>i;i++)c=p[i],f.unshift(c);for(h=function(a){var f,g,h,i,j;if(g=b(a.scope)){if(C=function(a,b){return C(a,b),I++},angular.isArray(g)){for(j=[],f=h=0,i=g.length;i>h;f=++h)c=g[f],j.push(e.push(C(d+f,c)));return j}return e.push(C(d,g))}},d=j=0,n=f.length;n>j;d=++j)g=f[d],h(g)}else 0<=(q=b-B-1)&&q<p.length&&(e.push(C(b,c)),I++);for(d=k=0,o=p.length;o>k;d=++k)c=p[d],c.scope.$index=B+d;return l(!1,e)})}}}}]),angular.module("ui.scrollfix",[]).directive("uiScrollfix",["$window",function(a){return{require:"^?uiScrollfixTarget",link:function(b,c,d,e){function f(){var b;if(angular.isDefined(a.pageYOffset))b=a.pageYOffset;else{var e=document.compatMode&&"BackCompat"!==document.compatMode?document.documentElement:document.body;b=e.scrollTop}!c.hasClass("ui-scrollfix")&&b>d.uiScrollfix?c.addClass("ui-scrollfix"):c.hasClass("ui-scrollfix")&&b<d.uiScrollfix&&c.removeClass("ui-scrollfix")}var g=c[0].offsetTop,h=e&&e.$element||angular.element(a);d.uiScrollfix?"string"==typeof d.uiScrollfix&&("-"===d.uiScrollfix.charAt(0)?d.uiScrollfix=g-parseFloat(d.uiScrollfix.substr(1)):"+"===d.uiScrollfix.charAt(0)&&(d.uiScrollfix=g+parseFloat(d.uiScrollfix.substr(1)))):d.uiScrollfix=g,h.on("scroll",f),b.$on("$destroy",function(){h.off("scroll",f)})}}}]).directive("uiScrollfixTarget",[function(){return{controller:["$element",function(a){this.$element=a}]}}]),angular.module("ui.showhide",[]).directive("uiShow",[function(){return function(a,b,c){a.$watch(c.uiShow,function(a){a?b.addClass("ui-show"):b.removeClass("ui-show")})}}]).directive("uiHide",[function(){return function(a,b,c){a.$watch(c.uiHide,function(a){a?b.addClass("ui-hide"):b.removeClass("ui-hide")})}}]).directive("uiToggle",[function(){return function(a,b,c){a.$watch(c.uiToggle,function(a){a?b.removeClass("ui-hide").addClass("ui-show"):b.removeClass("ui-show").addClass("ui-hide")})}}]),angular.module("ui.unique",[]).filter("unique",["$parse",function(a){return function(b,c){if(c===!1)return b;if((c||angular.isUndefined(c))&&angular.isArray(b)){var d=[],e=angular.isString(c)?a(c):function(a){return a},f=function(a){return angular.isObject(a)?e(a):a};angular.forEach(b,function(a){for(var b=!1,c=0;c<d.length;c++)if(angular.equals(f(d[c]),f(a))){b=!0;break}b||d.push(a)}),b=d}return b}}]),angular.module("ui.validate",[]).directive("uiValidate",function(){return{restrict:"A",require:"ngModel",link:function(a,b,c,d){function e(b){return angular.isString(b)?void a.$watch(b,function(){angular.forEach(g,function(a){a(d.$modelValue)})}):angular.isArray(b)?void angular.forEach(b,function(b){a.$watch(b,function(){angular.forEach(g,function(a){a(d.$modelValue)})})}):void(angular.isObject(b)&&angular.forEach(b,function(b,c){angular.isString(b)&&a.$watch(b,function(){g[c](d.$modelValue)}),angular.isArray(b)&&angular.forEach(b,function(b){a.$watch(b,function(){g[c](d.$modelValue)})})}))}var f,g={},h=a.$eval(c.uiValidate);h&&(angular.isString(h)&&(h={validator:h}),angular.forEach(h,function(b,c){f=function(e){var f=a.$eval(b,{$value:e});return angular.isObject(f)&&angular.isFunction(f.then)?(f.then(function(){d.$setValidity(c,!0)},function(){d.$setValidity(c,!1)}),e):f?(d.$setValidity(c,!0),e):(d.$setValidity(c,!1),e)},g[c]=f,d.$formatters.push(f),d.$parsers.push(f)}),c.uiValidateWatch&&e(a.$eval(c.uiValidateWatch)))}}}),angular.module("ui.utils",["ui.event","ui.format","ui.highlight","ui.include","ui.indeterminate","ui.inflector","ui.jq","ui.keypress","ui.mask","ui.reset","ui.route","ui.scrollfix","ui.scroll","ui.scroll.jqlite","ui.showhide","ui.unique","ui.validate"]);
/*         ______________________________________
  ________|                                      |_______
  \       |           SmartAdmin WebApp          |      /
   \      |      Copyright © 2014 MyOrange       |     /
   /      |______________________________________|     \
  /__________)                                (_________\

 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 * =======================================================================
 * SmartAdmin is FULLY owned and LICENSED by MYORANGE INC.
 * This script may NOT be RESOLD or REDISTRUBUTED under any
 * circumstances, and is only to be used with this purchased
 * copy of SmartAdmin Template.
 * =======================================================================
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * =======================================================================
 * original filename: app.js
 * filesize: 50,499 bytes
 * author: Sunny (@bootstraphunt)
 * email: info@myorange.ca
 *
 * GLOBAL: Reference DOM
 */
	$.root_ = $('body');
/*
 * GLOBAL: interval array (to be used with jarviswidget in ajax and angular mode) to clear auto fetch interval
 */
	$.intervalArr = [];
/*
 * Calculate nav height
 */
var calc_navbar_height = function() {
		var height = null;
	
		if ($('#header').length)
			height = $('#header').height();
	
		if (height === null)
			height = $('<div id="header"></div>').height();
	
		if (height === null)
			return 49;
		// default
		return height;
	},
	
	navbar_height = calc_navbar_height, 
/*
 * APP DOM REFERENCES
 * Description: Obj DOM reference, please try to avoid changing these
 */	
	shortcut_dropdown = $('#shortcut'),
	
	bread_crumb = $('#ribbon ol.breadcrumb'),
/*
 * Top menu on/off
 */
	topmenu = false,
/*
 * desktop or mobile
 */
	thisDevice = null,
/*
 * JS ARRAY SCRIPT STORAGE
 * Description: used with loadScript to store script path and file name
 * so it will not load twice
 */	
	jsArray = {},	
/*
 * DETECT MOBILE DEVICES
 * Description: Detects mobile device - if any of the listed device is detected
 * a class is inserted to $.root_ and the variable thisDevice is decleard. 
 * (so far this is covering most hand held devices)
 */	
	ismobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
/*
 * CHECK MOBILE VIEW
 */
	if (!ismobile) {
		// Desktop
		$.root_.addClass("desktop-detected");
		device = "desktop";
	} else {
		// Mobile
		$.root_.addClass("mobile-detected");
		device = "mobile";
		
		if (fastClick) {
			// Removes the tap delay in idevices
			// dependency: js/plugin/fastclick/fastclick.js 
			$.root_.addClass("needsclick");
			FastClick.attach(document.body); 
		}
		
	}
/*
 * CHECK FOR MENU POSITION
 */
if ($('body').hasClass("menu-on-top") || localStorage.getItem('sm-setmenu')=='top' ) { 
	topmenu = true;
	$('body').addClass("menu-on-top");
}
/* ~ END: CHECK MOBILE DEVICE */

/*
 * DOCUMENT LOADED EVENT
 * Description: Fire when DOM is ready
 */

jQuery(document).ready(function() {
	
	
	/*
	 * SMART ACTIONS
	 * ANGULAR: handled via "action" directive
	 */
	/*var smartActions = {
	    
	    // LOGOUT MSG 
	    userLogout: function($this){
	
			// ask verification
			$.SmartMessageBox({
				title : "<i class='fa fa-sign-out txt-color-orangeDark'></i> Logout <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span> ?",
				content : $this.data('logout-msg') || "You can improve your security further after logging out by closing this opened browser",
				buttons : '[No][Yes]'
	
			}, function(ButtonPressed) {
				if (ButtonPressed == "Yes") {
					$.root_.addClass('animated fadeOutUp');
					setTimeout(logout, 1000);
				}
			});
			function logout() {
				window.location = $this.attr('href');
			}
	
		},

		// RESET WIDGETS
	    resetWidgets: function(){
			$.widresetMSG = $this.data('reset-msg');
			
			$.SmartMessageBox({
				title : "<i class='fa fa-refresh' style='color:green'></i> Clear Local Storage",
				content : $.widresetMSG || "Would you like to RESET all your saved widgets and clear LocalStorage?",
				buttons : '[No][Yes]'
			}, function(ButtonPressed) {
				if (ButtonPressed == "Yes" && localStorage) {
					localStorage.clear();
					location.reload();
				}
	
			});
	    },
	    
	    // LAUNCH FULLSCREEN 
	    launchFullscreen: function(element){
	
			if (!$.root_.hasClass("full-screen")) {
		
				$.root_.addClass("full-screen");
		
				if (element.requestFullscreen) {
					element.requestFullscreen();
				} else if (element.mozRequestFullScreen) {
					element.mozRequestFullScreen();
				} else if (element.webkitRequestFullscreen) {
					element.webkitRequestFullscreen();
				} else if (element.msRequestFullscreen) {
					element.msRequestFullscreen();
				}
		
			} else {
				
				$.root_.removeClass("full-screen");
				
				if (document.exitFullscreen) {
					document.exitFullscreen();
				} else if (document.mozCancelFullScreen) {
					document.mozCancelFullScreen();
				} else if (document.webkitExitFullscreen) {
					document.webkitExitFullscreen();
				}
		
			}
	
	   },
	
	   // MINIFY MENU
	    minifyMenu: function(){
	    	if (!$.root_.hasClass("menu-on-top")){
				$.root_.toggleClass("minified");
				$.root_.removeClass("hidden-menu");
				$('html').removeClass("hidden-menu-mobile-lock");
				$this.effect("highlight", {}, 500);
			}
	    },
	    
	    // TOGGLE MENU 
	    toggleMenu: function(){
	    	if (!$.root_.hasClass("menu-on-top")){
				$('html').toggleClass("hidden-menu-mobile-lock");
				$.root_.toggleClass("hidden-menu");
				$.root_.removeClass("minified");
	    	}
	    },     
	
	    // TOGGLE SHORTCUT 
	    toggleShortcut: function(){
	    	
			if (shortcut_dropdown.is(":visible")) {
				shortcut_buttons_hide();
			} else {
				shortcut_buttons_show();
			}

			// SHORT CUT (buttons that appear when clicked on user name)
			shortcut_dropdown.find('a').click(function(e) {
				e.preventDefault();
				window.location = $(this).attr('href');
				setTimeout(shortcut_buttons_hide, 300);
		
			});
		
			// SHORTCUT buttons goes away if mouse is clicked outside of the area
			$(document).mouseup(function(e) {
				if (!shortcut_dropdown.is(e.target) && shortcut_dropdown.has(e.target).length === 0) {
					shortcut_buttons_hide();
				}
			});
			
			// SHORTCUT ANIMATE HIDE
			function shortcut_buttons_hide() {
				shortcut_dropdown.animate({
					height : "hide"
				}, 300, "easeOutCirc");
				$.root_.removeClass('shortcut-on');
		
			}
		
			// SHORTCUT ANIMATE SHOW
			function shortcut_buttons_show() {
				shortcut_dropdown.animate({
					height : "show"
				}, 200, "easeOutCirc");
				$.root_.addClass('shortcut-on');
			}
	
	    }  
	   
	};


	$.root_.on('click', '[data-action="userLogout"]', function(e) {
		var $this = $(this);
		smartActions.userLogout($this);
		e.preventDefault();
	}); 

	$.root_.on('click', '[data-action="resetWidgets"]', function(e) {	
		var $this = $(this);
		smartActions.resetWidgets($this);
		e.preventDefault();
	});
	
	$.root_.on('click', '[data-action="launchFullscreen"]', function(e) {	
		smartActions.launchFullscreen(document.documentElement);
		e.preventDefault();
	}); 
	
	$.root_.on('click', '[data-action="minifyMenu"]', function(e) {
		var $this = $(this);
		smartActions.minifyMenu($this);
		e.preventDefault();
	}); 
	
	$.root_.on('click', '[data-action="toggleMenu"]', function(e) {	
		smartActions.toggleMenu();
		e.preventDefault();
	});  

	$.root_.on('click', '[data-action="toggleShortcut"]', function(e) {	
		smartActions.toggleShortcut();
		e.preventDefault();
	}); */
	

	/*
	 * Fire tooltips
	 */
	if ($("[rel=tooltip]").length) {
		$("[rel=tooltip]").tooltip();
	}

	// INITIALIZE LEFT NAV
	/* ANGULAR: handled via "navigation" directive
	if (!$topmenu) {
		if (!null) {
			$('nav ul').jarvismenu({
				accordion : true,
				speed : menu_speed,
				closedSign : '<em class="fa fa-plus-square-o"></em>',
				openedSign : '<em class="fa fa-minus-square-o"></em>'
			});
		} else {
			alert("Error - menu anchor does not exist");
		}
	}

	// SHOW & HIDE MOBILE SEARCH FIELD
	$('#search-mobile').click(function() {
		$.root_.addClass('search-mobile');
	});

	$('#cancel-search-js').click(function() {
		$.root_.removeClass('search-mobile');
	});

	// ACTIVITY
	// ajax drop
	$('#activity').click(function(e) {
		var $this = $(this);

		if ($this.find('.badge').hasClass('bg-color-red')) {
			$this.find('.badge').removeClassPrefix('bg-color-');
			$this.find('.badge').text("0");
			// console.log("Ajax call for activity")
		}

		if (!$this.next('.ajax-dropdown').is(':visible')) {
			$this.next('.ajax-dropdown').fadeIn(150);
			$this.addClass('active');
		} else {
			$this.next('.ajax-dropdown').fadeOut(150);
			$this.removeClass('active');
		}

		var mytest = $this.next('.ajax-dropdown').find('.btn-group > .active > input').attr('id');
		//console.log(mytest)

		e.preventDefault();
	});

	$('input[name="activity"]').change(function() {
		//alert($(this).val())
		var $this = $(this);

		url = $this.attr('id');
		container = $('.ajax-notifications');

		loadURL(url, container);

	});*/

	$(document).mouseup(function(e) {
		if (!$('.ajax-dropdown').is(e.target) && $('.ajax-dropdown').has(e.target).length === 0 && !$('.modal').is(e.target) && $('.modal').has(e.target).length === 0) {
			$('.ajax-dropdown').fadeOut(150);
			$('.ajax-dropdown').prev().removeClass("active");
		}
	});

	$('button[data-btn-loading]').on('click', function() {
		var btn = $(this);
		btn.button('loading');
		setTimeout(function() {
			btn.button('reset');
		}, 3000);
	});

	// NOTIFICATION IS PRESENT
	/* ANGULAR: Handled via "activityButton" directive
	function notification_check() {
		$this = $('#activity > .badge');

		if (parseInt($this.text()) > 0) {
			$this.addClass("bg-color-red bounceIn animated");
		}
	}

	notification_check();*/

	// SLIMSCROLL FOR NAV
	/* ANGULAR: Initialized via "navigation" directive
	if ($.fn.slimScroll) {
		$('nav').slimScroll({
	        height: '100%'
	    });
	}*/

});


/*
 * RESIZER WITH THROTTLE
 * Source: http://benalman.com/code/projects/jquery-resize/examples/resize/
 */

(function ($, window, undefined) {

    var elems = $([]),
        jq_resize = $.resize = $.extend($.resize, {}),
        timeout_id, str_setTimeout = 'setTimeout',
        str_resize = 'resize',
        str_data = str_resize + '-special-event',
        str_delay = 'delay',
        str_throttle = 'throttleWindow';

    jq_resize[str_delay] = throttle_delay;

    jq_resize[str_throttle] = true;

    $.event.special[str_resize] = {

        setup: function () {
            if (!jq_resize[str_throttle] && this[str_setTimeout]) {
                return false;
            }

            var elem = $(this);
            elems = elems.add(elem);
            try {
                $.data(this, str_data, {
                    w: elem.width(),
                    h: elem.height()
                });
            } catch (e) {
                $.data(this, str_data, {
                    w: elem.width, // elem.width();
                    h: elem.height // elem.height();
                });
            }

            if (elems.length === 1) {
                loopy();
            }
        },
        teardown: function () {
            if (!jq_resize[str_throttle] && this[str_setTimeout]) {
                return false;
            }

            var elem = $(this);
            elems = elems.not(elem);
            elem.removeData(str_data);
            if (!elems.length) {
                clearTimeout(timeout_id);
            }
        },

        add: function (handleObj) {
            if (!jq_resize[str_throttle] && this[str_setTimeout]) {
                return false;
            }
            var old_handler;

            function new_handler(e, w, h) {
                var elem = $(this),
                    data = $.data(this, str_data);
                data.w = w !== undefined ? w : elem.width();
                data.h = h !== undefined ? h : elem.height();

                old_handler.apply(this, arguments);
            }
            if ($.isFunction(handleObj)) {
                old_handler = handleObj;
                return new_handler;
            } else {
                old_handler = handleObj.handler;
                handleObj.handler = new_handler;
            }
        }
    };

    function loopy() {
        timeout_id = window[str_setTimeout](function () {
            elems.each(function () {
                var width;
                var height;

                var elem = $(this),
                    data = $.data(this, str_data); //width = elem.width(), height = elem.height();

                // Highcharts fix
                try {
                    width = elem.width();
                } catch (e) {
                    width = elem.width;
                }

                try {
                    height = elem.height();
                } catch (e) {
                    height = elem.height;
                }
                //fixed bug


                if (width !== data.w || height !== data.h) {
                    elem.trigger(str_resize, [data.w = width, data.h = height]);
                }

            });
            loopy();

        }, jq_resize[str_delay]);

    }

})(jQuery, this);

/*
* ADD CLASS WHEN BELOW CERTAIN WIDTH (MOBILE MENU)
* Description: changes the page min-width of #CONTENT and NAV when navigation is resized.
* This is to counter bugs for min page width on many desktop and mobile devices.
* Note: This script uses JSthrottle technique so don't worry about memory/CPU usage
*/

$('#main').resize(function() {
	check_if_mobile_width();
});


function check_if_mobile_width() {
	if ($(window).width() < 979) {
		$.root_.addClass('mobile-view-activated');
		$.root_.removeClass('minified');
	} else if ($.root_.hasClass('mobile-view-activated')) {
		$.root_.removeClass('mobile-view-activated');
	}
}

/* ~ END: NAV OR #LEFT-BAR RESIZE DETECT */

/*
 * DETECT IE VERSION
 * Description: A short snippet for detecting versions of IE in JavaScript
 * without resorting to user-agent sniffing
 * RETURNS:
 * If you're not in IE (or IE version is less than 5) then:
 * //ie === undefined
 *
 * If you're in IE (>=5) then you can determine which version:
 * // ie === 7; // IE7
 *
 * Thus, to detect IE:
 * // if (ie) {}
 *
 * And to detect the version:
 * ie === 6 // IE6
 * ie > 7 // IE8, IE9 ...
 * ie < 9 // Anything less than IE9
 */

// TODO: delete this function later on - no longer needed (?)
var ie = ( function() {

		var undef, v = 3, div = document.createElement('div'), all = div.getElementsByTagName('i');

		while (div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->', all[0]);

		return v > 4 ? v : undef;

	}()); // do we need this? 

/* ~ END: DETECT IE VERSION */

/*
 * CUSTOM MENU PLUGIN
 */

$.fn.extend({

	//pass the options variable to the function
	jarvismenu : function(options) {

		var defaults = {
			accordion : 'true',
			speed : 200,
			closedSign : '[+]',
			openedSign : '[-]'
		};

		// Extend our default options with those provided.
		var opts = $.extend(defaults, options);
		//Assign current element to variable, in this case is UL element
		var $this = $(this);

		//add a mark [+] to a multilevel menu
		$this.find("li").each(function() {
			if ($(this).find("ul").size() !== 0) {
				//add the multilevel sign next to the link
				$(this).find("a:first").append("<b class='collapse-sign'>" + opts.closedSign + "</b>");

				//avoid jumping to the top of the page when the href is an #
				if ($(this).find("a:first").attr('href') == "#") {
					$(this).find("a:first").click(function() {
						return false;
					});
				}
			}
		});

		//open active level
		$this.find("li.active").each(function() {
			$(this).parents("ul").slideDown(opts.speed);
			$(this).parents("ul").parent("li").find("b:first").html(opts.openedSign);
			$(this).parents("ul").parent("li").addClass("open");
		});

		$this.find("li a").click(function() {

			if ($(this).parent().find("ul").size() !== 0) {

				if (opts.accordion) {
					//Do nothing when the list is open
					if (!$(this).parent().find("ul").is(':visible')) {
						parents = $(this).parent().parents("ul");
						visible = $this.find("ul:visible");
						visible.each(function(visibleIndex) {
							var close = true;
							parents.each(function(parentIndex) {
								if (parents[parentIndex] == visible[visibleIndex]) {
									close = false;
									return false;
								}
							});
							if (close) {
								if ($(this).parent().find("ul") != visible[visibleIndex]) {
									$(visible[visibleIndex]).slideUp(opts.speed, function() {
										$(this).parent("li").find("b:first").html(opts.closedSign);
										$(this).parent("li").removeClass("open");
									});

								}
							}
						});
					}
				}// end if
				if ($(this).parent().find("ul:first").is(":visible") && !$(this).parent().find("ul:first").hasClass("active")) {
					$(this).parent().find("ul:first").slideUp(opts.speed, function() {
						$(this).parent("li").removeClass("open");
						$(this).parent("li").find("b:first").delay(opts.speed).html(opts.closedSign);
					});

				} else {
					$(this).parent().find("ul:first").slideDown(opts.speed, function() {
						/*$(this).effect("highlight", {color : '#616161'}, 500); - disabled due to CPU clocking on phones*/
						$(this).parent("li").addClass("open");
						$(this).parent("li").find("b:first").delay(opts.speed).html(opts.openedSign);
					});
				} // end else
			} // end if
		});
	} // end function
});


/* ~ END: CUSTOM MENU PLUGIN */

/*
 * ELEMENT EXIST OR NOT
 * Description: returns true or false
 * Usage: $('#myDiv').doesExist();
 */

jQuery.fn.doesExist = function() {
	return jQuery(this).length > 0;
};

/* ~ END: ELEMENT EXIST OR NOT */

/*
 * FULL SCREEN FUNCTION
 

// Find the right method, call on correct element
function launchFullscreen(element) {

	if (!$.root_.hasClass("full-screen")) {

		$.root_.addClass("full-screen");

		if (element.requestFullscreen) {
			element.requestFullscreen();
		} else if (element.mozRequestFullScreen) {
			element.mozRequestFullScreen();
		} else if (element.webkitRequestFullscreen) {
			element.webkitRequestFullscreen();
		} else if (element.msRequestFullscreen) {
			element.msRequestFullscreen();
		}

	} else {
		
		$.root_.removeClass("full-screen");
		
		if (document.exitFullscreen) {
			document.exitFullscreen();
		} else if (document.mozCancelFullScreen) {
			document.mozCancelFullScreen();
		} else if (document.webkitExitFullscreen) {
			document.webkitExitFullscreen();
		}

	}

}*/

/*
 * ~ END: FULL SCREEN FUNCTION
 */

/*
 * INITIALIZE FORMS
 * Description: Select2, Masking, Datepicker, Autocomplete
 */

function runAllForms() {

	/*
	 * BOOTSTRAP SLIDER PLUGIN
	 * Usage:
	 * Dependency: js/plugin/bootstrap-slider
	 */
	if ($.fn.slider) {
		$('.slider').slider();
	}

	/*
	 * SELECT2 PLUGIN
	 * Usage:
	 * Dependency: js/plugin/select2/
	 */
	if ($.fn.select2) {
		$('#content .select2').each(function() {
			var $this = $(this);
			var width = $this.attr('data-select-width') || '100%';
			//, _showSearchInput = $this.attr('data-select-search') === 'true';
            console.log($(this));
			$this.select2({
				//showSearchInput : _showSearchInput,
				allowClear : true,
				width : width
			});
		});
	}

	/*
	 * MASKING
	 * Dependency: js/plugin/masked-input/
	 */
	if ($.fn.mask) {
		$('[data-mask]').each(function() {

			var $this = $(this);
			var mask = $this.attr('data-mask') || 'error...', mask_placeholder = $this.attr('data-mask-placeholder') || 'X';

			$this.mask(mask, {
				placeholder : mask_placeholder
			});
		});
	}

	/*
	 * Autocomplete
	 * Dependency: js/jqui
	 */
	if ($.fn.autocomplete) {
		$('[data-autocomplete]').each(function() {

			var $this = $(this);
			var availableTags = $this.data('autocomplete') || ["The", "Quick", "Brown", "Fox", "Jumps", "Over", "Three", "Lazy", "Dogs"];

			$this.autocomplete({
				source : availableTags
			});
		});
	}

	/*
	 * JQUERY UI DATE
	 * Dependency: js/libs/jquery-ui-1.10.3.min.js
	 * Usage:
	 */
	if ($.fn.datepicker) {
		$('.datepicker').each(function() {

			var $this = $(this);
			var dataDateFormat = $this.attr('data-dateformat') || 'dd.mm.yy';

			$this.datepicker({
				dateFormat : dataDateFormat,
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
			});
		});
	}

	/*
	 * AJAX BUTTON LOADING TEXT
	 * Usage: <button type="button" data-loading-text="Loading..." class="btn btn-xs btn-default ajax-refresh"> .. </button>
	 */
	/* ANGUlAR: NOT NEEDED
	$('button[data-loading-text]').on('click', function() {
		var btn = $(this);
		btn.button('loading');
		setTimeout(function() {
			btn.button('reset');
		}, 3000);
	});*/

}

/* ~ END: INITIALIZE FORMS */

/*
 * INITIALIZE CHARTS
 * Description: Sparklines, PieCharts
 */

function runAllCharts() {
	/*
	 * SPARKLINES
	 * DEPENDENCY: js/plugins/sparkline/jquery.sparkline.min.js
	 * See usage example below...
	 */

	/* Usage:
	 * 		<div class="sparkline-line txt-color-blue" data-fill-color="transparent" data-sparkline-height="26px">
	 *			5,6,7,9,9,5,9,6,5,6,6,7,7,6,7,8,9,7
	 *		</div>
	 */

	if ($.fn.sparkline) {

		// variable declearations:

		var barColor,
		    sparklineHeight,
		    sparklineBarWidth,
		    sparklineBarSpacing,
		    sparklineNegBarColor,
		    sparklineStackedColor,
		    thisLineColor,
		    thisLineWidth,
		    thisFill,
		    thisSpotColor,
		    thisMinSpotColor,
		    thisMaxSpotColor,
		    thishighlightSpotColor,
		    thisHighlightLineColor,
		    thisSpotRadius,			        
			pieColors,
		    pieWidthHeight,
		    pieBorderColor,
		    pieOffset,
		 	thisBoxWidth,
		    thisBoxHeight,
		    thisBoxRaw,
		    thisBoxTarget,
		    thisBoxMin,
		    thisBoxMax,
		    thisShowOutlier,
		    thisIQR,
		    thisBoxSpotRadius,
		    thisBoxLineColor,
		    thisBoxFillColor,
		    thisBoxWhisColor,
		    thisBoxOutlineColor,
		    thisBoxOutlineFill,
		    thisBoxMedianColor,
		    thisBoxTargetColor,
			thisBulletHeight,
		    thisBulletWidth,
		    thisBulletColor,
		    thisBulletPerformanceColor,
		    thisBulletRangeColors,
			thisDiscreteHeight,
		    thisDiscreteWidth,
		    thisDiscreteLineColor,
		    thisDiscreteLineHeight,
		    thisDiscreteThrushold,
		    thisDiscreteThrusholdColor,
			thisTristateHeight,
		    thisTristatePosBarColor,
		    thisTristateNegBarColor,
		    thisTristateZeroBarColor,
		    thisTristateBarWidth,
		    thisTristateBarSpacing,
		    thisZeroAxis,
		    thisBarColor,
		    sparklineWidth,
		    sparklineValue,
		    sparklineValueSpots1,
		    sparklineValueSpots2,
		    thisLineWidth1,
		    thisLineWidth2,
		    thisLineColor1,
		    thisLineColor2,
		    thisSpotRadius1,
		    thisSpotRadius2,
		    thisMinSpotColor1,
		    thisMaxSpotColor1,
		    thisMinSpotColor2,
		    thisMaxSpotColor2,
		    thishighlightSpotColor1,
		    thisHighlightLineColor1,
		    thishighlightSpotColor2,
		    thisFillColor1,
		    thisFillColor2;
				    				    

		$('.sparkline').each(function() {
			var $this = $(this);
			var sparklineType = $this.data('sparkline-type') || 'bar';

			// BAR CHART
			if (sparklineType == 'bar') {

					barColor = $this.data('sparkline-bar-color') || $this.css('color') || '#0000f0';
				    sparklineHeight = $this.data('sparkline-height') || '26px';
				    sparklineBarWidth = $this.data('sparkline-barwidth') || 5;
				    sparklineBarSpacing = $this.data('sparkline-barspacing') || 2;
				    sparklineNegBarColor = $this.data('sparkline-negbar-color') || '#A90329';
				    sparklineStackedColor = $this.data('sparkline-barstacked-color') || ["#A90329", "#0099c6", "#98AA56", "#da532c", "#4490B1", "#6E9461", "#990099", "#B4CAD3"];
				        
				$this.sparkline('html', {
					barColor : barColor,
					type : sparklineType,
					height : sparklineHeight,
					barWidth : sparklineBarWidth,
					barSpacing : sparklineBarSpacing,
					stackedBarColor : sparklineStackedColor,
					negBarColor : sparklineNegBarColor,
					zeroAxis : 'false'
				});

			}

			//LINE CHART
			if (sparklineType == 'line') {

					sparklineHeight = $this.data('sparkline-height') || '20px';
				    sparklineWidth = $this.data('sparkline-width') || '90px';
				    thisLineColor = $this.data('sparkline-line-color') || $this.css('color') || '#0000f0';
				    thisLineWidth = $this.data('sparkline-line-width') || 1;
				    thisFill = $this.data('fill-color') || '#c0d0f0';
				    thisSpotColor = $this.data('sparkline-spot-color') || '#f08000';
				    thisMinSpotColor = $this.data('sparkline-minspot-color') || '#ed1c24';
				    thisMaxSpotColor = $this.data('sparkline-maxspot-color') || '#f08000';
				    thishighlightSpotColor = $this.data('sparkline-highlightspot-color') || '#50f050';
				    thisHighlightLineColor = $this.data('sparkline-highlightline-color') || 'f02020';
				    thisSpotRadius = $this.data('sparkline-spotradius') || 1.5;
					thisChartMinYRange = $this.data('sparkline-min-y') || 'undefined'; 
					thisChartMaxYRange = $this.data('sparkline-max-y') || 'undefined'; 
					thisChartMinXRange = $this.data('sparkline-min-x') || 'undefined'; 
					thisChartMaxXRange = $this.data('sparkline-max-x') || 'undefined'; 
					thisMinNormValue = $this.data('min-val') || 'undefined'; 
					thisMaxNormValue = $this.data('max-val') || 'undefined'; 
					thisNormColor =  $this.data('norm-color') || '#c0c0c0';
					thisDrawNormalOnTop = $this.data('draw-normal') || false;
				    
				$this.sparkline('html', {
					type : 'line',
					width : sparklineWidth,
					height : sparklineHeight,
					lineWidth : thisLineWidth,
					lineColor : thisLineColor,
					fillColor : thisFill,
					spotColor : thisSpotColor,
					minSpotColor : thisMinSpotColor,
					maxSpotColor : thisMaxSpotColor,
					highlightSpotColor : thishighlightSpotColor,
					highlightLineColor : thisHighlightLineColor,
					spotRadius : thisSpotRadius,
					chartRangeMin : thisChartMinYRange,
					chartRangeMax : thisChartMaxYRange,
					chartRangeMinX : thisChartMinXRange,
					chartRangeMaxX : thisChartMaxXRange,
					normalRangeMin : thisMinNormValue,
					normalRangeMax : thisMaxNormValue,
					normalRangeColor : thisNormColor,
					drawNormalOnTop : thisDrawNormalOnTop

				});

			}

			//PIE CHART
			if (sparklineType == 'pie') {

					pieColors = $this.data('sparkline-piecolor') || ["#B4CAD3", "#4490B1", "#98AA56", "#da532c","#6E9461", "#0099c6", "#990099", "#717D8A"];
				    pieWidthHeight = $this.data('sparkline-piesize') || 90;
				    pieBorderColor = $this.data('border-color') || '#45494C';
				    pieOffset = $this.data('sparkline-offset') || 0;
				    
				$this.sparkline('html', {
					type : 'pie',
					width : pieWidthHeight,
					height : pieWidthHeight,
					tooltipFormat : '<span style="color: {{color}}">&#9679;</span> ({{percent.1}}%)',
					sliceColors : pieColors,
					borderWidth : 1,
					offset : pieOffset,
					borderColor : pieBorderColor
				});

			}

			//BOX PLOT
			if (sparklineType == 'box') {

					thisBoxWidth = $this.data('sparkline-width') || 'auto';
				    thisBoxHeight = $this.data('sparkline-height') || 'auto';
				    thisBoxRaw = $this.data('sparkline-boxraw') || false;
				    thisBoxTarget = $this.data('sparkline-targetval') || 'undefined';
				    thisBoxMin = $this.data('sparkline-min') || 'undefined';
				    thisBoxMax = $this.data('sparkline-max') || 'undefined';
				    thisShowOutlier = $this.data('sparkline-showoutlier') || true;
				    thisIQR = $this.data('sparkline-outlier-iqr') || 1.5;
				    thisBoxSpotRadius = $this.data('sparkline-spotradius') || 1.5;
				    thisBoxLineColor = $this.css('color') || '#000000';
				    thisBoxFillColor = $this.data('fill-color') || '#c0d0f0';
				    thisBoxWhisColor = $this.data('sparkline-whis-color') || '#000000';
				    thisBoxOutlineColor = $this.data('sparkline-outline-color') || '#303030';
				    thisBoxOutlineFill = $this.data('sparkline-outlinefill-color') || '#f0f0f0';
				    thisBoxMedianColor = $this.data('sparkline-outlinemedian-color') || '#f00000';
				    thisBoxTargetColor = $this.data('sparkline-outlinetarget-color') || '#40a020';
				    
				$this.sparkline('html', {
					type : 'box',
					width : thisBoxWidth,
					height : thisBoxHeight,
					raw : thisBoxRaw,
					target : thisBoxTarget,
					minValue : thisBoxMin,
					maxValue : thisBoxMax,
					showOutliers : thisShowOutlier,
					outlierIQR : thisIQR,
					spotRadius : thisBoxSpotRadius,
					boxLineColor : thisBoxLineColor,
					boxFillColor : thisBoxFillColor,
					whiskerColor : thisBoxWhisColor,
					outlierLineColor : thisBoxOutlineColor,
					outlierFillColor : thisBoxOutlineFill,
					medianColor : thisBoxMedianColor,
					targetColor : thisBoxTargetColor

				});

			}

			//BULLET
			if (sparklineType == 'bullet') {

				var thisBulletHeight = $this.data('sparkline-height') || 'auto';
				    thisBulletWidth = $this.data('sparkline-width') || 2;
				    thisBulletColor = $this.data('sparkline-bullet-color') || '#ed1c24';
				    thisBulletPerformanceColor = $this.data('sparkline-performance-color') || '#3030f0';
				    thisBulletRangeColors = $this.data('sparkline-bulletrange-color') || ["#d3dafe", "#a8b6ff", "#7f94ff"];
				    
				$this.sparkline('html', {

					type : 'bullet',
					height : thisBulletHeight,
					targetWidth : thisBulletWidth,
					targetColor : thisBulletColor,
					performanceColor : thisBulletPerformanceColor,
					rangeColors : thisBulletRangeColors

				});

			}

			//DISCRETE
			if (sparklineType == 'discrete') {

				 	thisDiscreteHeight = $this.data('sparkline-height') || 26;
				    thisDiscreteWidth = $this.data('sparkline-width') || 50;
				    thisDiscreteLineColor = $this.css('color');
				    thisDiscreteLineHeight = $this.data('sparkline-line-height') || 5;
				    thisDiscreteThrushold = $this.data('sparkline-threshold') || 'undefined';
				    thisDiscreteThrusholdColor = $this.data('sparkline-threshold-color') || '#ed1c24';
				    
				$this.sparkline('html', {

					type : 'discrete',
					width : thisDiscreteWidth,
					height : thisDiscreteHeight,
					lineColor : thisDiscreteLineColor,
					lineHeight : thisDiscreteLineHeight,
					thresholdValue : thisDiscreteThrushold,
					thresholdColor : thisDiscreteThrusholdColor

				});

			}

			//TRISTATE
			if (sparklineType == 'tristate') {

				 	thisTristateHeight = $this.data('sparkline-height') || 26;
				    thisTristatePosBarColor = $this.data('sparkline-posbar-color') || '#60f060';
				    thisTristateNegBarColor = $this.data('sparkline-negbar-color') || '#f04040';
				    thisTristateZeroBarColor = $this.data('sparkline-zerobar-color') || '#909090';
				    thisTristateBarWidth = $this.data('sparkline-barwidth') || 5;
				    thisTristateBarSpacing = $this.data('sparkline-barspacing') || 2;
				    thisZeroAxis = $this.data('sparkline-zeroaxis') || false;
				    
				$this.sparkline('html', {

					type : 'tristate',
					height : thisTristateHeight,
					posBarColor : thisBarColor,
					negBarColor : thisTristateNegBarColor,
					zeroBarColor : thisTristateZeroBarColor,
					barWidth : thisTristateBarWidth,
					barSpacing : thisTristateBarSpacing,
					zeroAxis : thisZeroAxis

				});

			}

			//COMPOSITE: BAR
			if (sparklineType == 'compositebar') {

				 	sparklineHeight = $this.data('sparkline-height') || '20px';
				    sparklineWidth = $this.data('sparkline-width') || '100%';
				    sparklineBarWidth = $this.data('sparkline-barwidth') || 3;
				    thisLineWidth = $this.data('sparkline-line-width') || 1;
				    thisLineColor = $this.data('sparkline-color-top') || '#ed1c24';
				    thisBarColor = $this.data('sparkline-color-bottom') || '#333333';
				    
				$this.sparkline($this.data('sparkline-bar-val'), {

					type : 'bar',
					width : sparklineWidth,
					height : sparklineHeight,
					barColor : thisBarColor,
					barWidth : sparklineBarWidth
					//barSpacing: 5

				});

				$this.sparkline($this.data('sparkline-line-val'), {

					width : sparklineWidth,
					height : sparklineHeight,
					lineColor : thisLineColor,
					lineWidth : thisLineWidth,
					composite : true,
					fillColor : false

				});

			}

			//COMPOSITE: LINE
			if (sparklineType == 'compositeline') {

					sparklineHeight = $this.data('sparkline-height') || '20px';
				    sparklineWidth = $this.data('sparkline-width') || '90px';
				    sparklineValue = $this.data('sparkline-bar-val');
				    sparklineValueSpots1 = $this.data('sparkline-bar-val-spots-top') || null;
				    sparklineValueSpots2 = $this.data('sparkline-bar-val-spots-bottom') || null;
				    thisLineWidth1 = $this.data('sparkline-line-width-top') || 1;
				    thisLineWidth2 = $this.data('sparkline-line-width-bottom') || 1;
				    thisLineColor1 = $this.data('sparkline-color-top') || '#333333';
				    thisLineColor2 = $this.data('sparkline-color-bottom') || '#ed1c24';
				    thisSpotRadius1 = $this.data('sparkline-spotradius-top') || 1.5;
				    thisSpotRadius2 = $this.data('sparkline-spotradius-bottom') || thisSpotRadius1;
				    thisSpotColor = $this.data('sparkline-spot-color') || '#f08000';
				    thisMinSpotColor1 = $this.data('sparkline-minspot-color-top') || '#ed1c24';
				    thisMaxSpotColor1 = $this.data('sparkline-maxspot-color-top') || '#f08000';
				    thisMinSpotColor2 = $this.data('sparkline-minspot-color-bottom') || thisMinSpotColor1;
				    thisMaxSpotColor2 = $this.data('sparkline-maxspot-color-bottom') || thisMaxSpotColor1;
				    thishighlightSpotColor1 = $this.data('sparkline-highlightspot-color-top') || '#50f050';
				    thisHighlightLineColor1 = $this.data('sparkline-highlightline-color-top') || '#f02020';
				    thishighlightSpotColor2 = $this.data('sparkline-highlightspot-color-bottom') ||
				        thishighlightSpotColor1;
				    thisHighlightLineColor2 = $this.data('sparkline-highlightline-color-bottom') ||
				        thisHighlightLineColor1;
				    thisFillColor1 = $this.data('sparkline-fillcolor-top') || 'transparent';
				    thisFillColor2 = $this.data('sparkline-fillcolor-bottom') || 'transparent';
				    
				$this.sparkline(sparklineValue, {

					type : 'line',
					spotRadius : thisSpotRadius1,

					spotColor : thisSpotColor,
					minSpotColor : thisMinSpotColor1,
					maxSpotColor : thisMaxSpotColor1,
					highlightSpotColor : thishighlightSpotColor1,
					highlightLineColor : thisHighlightLineColor1,

					valueSpots : sparklineValueSpots1,

					lineWidth : thisLineWidth1,
					width : sparklineWidth,
					height : sparklineHeight,
					lineColor : thisLineColor1,
					fillColor : thisFillColor1

				});

				$this.sparkline($this.data('sparkline-line-val'), {

					type : 'line',
					spotRadius : thisSpotRadius2,

					spotColor : thisSpotColor,
					minSpotColor : thisMinSpotColor2,
					maxSpotColor : thisMaxSpotColor2,
					highlightSpotColor : thishighlightSpotColor2,
					highlightLineColor : thisHighlightLineColor2,

					valueSpots : sparklineValueSpots2,

					lineWidth : thisLineWidth2,
					width : sparklineWidth,
					height : sparklineHeight,
					lineColor : thisLineColor2,
					composite : true,
					fillColor : thisFillColor2

				});

			}

		});

	}// end if

	/*
	 * EASY PIE CHARTS
	 * DEPENDENCY: js/plugins/easy-pie-chart/jquery.easy-pie-chart.min.js
	 * Usage: <div class="easy-pie-chart txt-color-orangeDark" data-pie-percent="33" data-pie-size="72" data-size="72">
	 *			<span class="percent percent-sign">35</span>
	 * 	  	  </div>
	 */

	if ($.fn.easyPieChart) {

		$('.easy-pie-chart').each(function() {
			var $this = $(this);
			var barColor = $this.css('color') || $this.data('pie-color'),
			    trackColor = $this.data('pie-track-color') || '#eeeeee',
			    size = parseInt($this.data('pie-size')) || 25;
			    
			$this.easyPieChart({
				
				barColor : barColor,
				trackColor : trackColor,
				scaleColor : false,
				lineCap : 'butt',
				lineWidth : parseInt(size / 8.5),
				animate : 1500,
				rotate : -90,
				size : size,
				onStep : function(value) {
					this.$el.find('span').text(~~value);
				}
				
			});
		});

	} // end if

}

/* ~ END: INITIALIZE CHARTS */

/*
 * INITIALIZE JARVIS WIDGETS
 */

// Setup Desktop Widgets
function setup_widgets_desktop() {

	if ($.fn.jarvisWidgets && enableJarvisWidgets) {

		$('#widget-grid').jarvisWidgets({

			grid : 'article',
			widgets : '.jarviswidget',
			localStorage : true,
			deleteSettingsKey : '#deletesettingskey-options',
			settingsKeyLabel : 'Reset settings?',
			deletePositionKey : '#deletepositionkey-options',
			positionKeyLabel : 'Reset position?',
			sortable : true,
			buttonsHidden : false,
			// toggle button
			toggleButton : true,
			toggleClass : 'fa fa-minus | fa fa-plus',
			toggleSpeed : 200,
			onToggle : function() {
			},
			// delete btn
			deleteButton : true,
			deleteClass : 'fa fa-times',
			deleteSpeed : 200,
			onDelete : function() {
			},
			// edit btn
			editButton : true,
			editPlaceholder : '.jarviswidget-editbox',
			editClass : 'fa fa-cog | fa fa-save',
			editSpeed : 200,
			onEdit : function() {
			},
			// color button
			colorButton : true,
			// full screen
			fullscreenButton : true,
			fullscreenClass : 'fa fa-expand | fa fa-compress',
			fullscreenDiff : 3,
			onFullscreen : function() {
			},
			// custom btn
			customButton : false,
			customClass : 'folder-10 | next-10',
			customStart : function() {
				alert('Hello you, this is a custom button...');
			},
			customEnd : function() {
				alert('bye, till next time...');
			},
			// order
			buttonOrder : '%refresh% %custom% %edit% %toggle% %fullscreen% %delete%',
			opacity : 1.0,
			dragHandle : '> header',
			placeholderClass : 'jarviswidget-placeholder',
			indicator : true,
			indicatorTime : 600,
			ajax : true,
			timestampPlaceholder : '.jarviswidget-timestamp',
			timestampFormat : 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
			refreshButton : true,
			refreshButtonClass : 'fa fa-refresh',
			labelError : 'Sorry but there was a error:',
			labelUpdated : 'Last Update:',
			labelRefresh : 'Refresh',
			labelDelete : 'Delete widget:',
			afterLoad : function() {
			},
			rtl : false, // best not to toggle this!
			onChange : function() {
				
			},
			onSave : function() {
				
			},
			ajaxnav : $.navAsAjax // declears how the localstorage should be saved (HTML or AJAX page)

		});

	}

}

// Setup Desktop Widgets
function setup_widgets_mobile() {

	if (enableMobileWidgets && enableJarvisWidgets) {
		setup_widgets_desktop();
	}

}

/* ~ END: INITIALIZE JARVIS WIDGETS */

/*
 * GOOGLE MAPS
 * description: Append google maps to head dynamically (only execute for ajax version)
 * Loads at the begining for ajax pages
 */

if ($.navAsAjax || $(".google_maps")){
	var gMapsLoaded = false;
	window.gMapsCallback = function() {
		gMapsLoaded = true;
		$(window).trigger('gMapsLoaded');
	};
	window.loadGoogleMaps = function() {
		if (gMapsLoaded)
			return window.gMapsCallback();
		var script_tag = document.createElement('script');
		script_tag.setAttribute("type", "text/javascript");
		script_tag.setAttribute("src", "//maps.google.com/maps/api/js?sensor=false&callback=gMapsCallback");
		(document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script_tag);
	};
}

/* ~ END: GOOGLE MAPS */

/*
 * LOAD SCRIPTS
 * Usage:
 * Define function = myPrettyCode ()...
 * loadScript("js/my_lovely_script.js", myPrettyCode);
 */

var jsArray = {};

function loadScript(scriptName, callback) {

	if (!jsArray[scriptName]) {
		jsArray[scriptName] = true;

		// adding the script tag to the head as suggested before
		var body = document.getElementsByTagName('body')[0];
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.src = '/bundles/app/client_admin/'+scriptName;

		// then bind the event to the callback function
		// there are several events for cross browser compatibility
		//script.onreadystatechange = callback;
		script.onload = callback;

		// fire the loading
		body.appendChild(script);

	} else if (callback) {// changed else to else if(callback)
		//console.log("JS file already added!");
		//execute function
		callback();
	}

}

/* ~ END: LOAD SCRIPTS */

/*
* APP AJAX REQUEST SETUP
* Description: Executes and fetches all ajax requests also
* updates naivgation elements to active
*/
/* ANGULAR: Handled via ngRoute
if($.navAsAjax)
{
    // fire this on page load if nav exists
    if ($('nav').length) {
	    checkURL();
    }

	// ANGULAR: Handled via "navItem" directive
    $(document).on('click', 'nav a[href!="#"]', function(e) {
	    e.preventDefault();
	    var $this = $(e.currentTarget);

	    // if parent is not active then get hash, or else page is assumed to be loaded
		if (!$this.parent().hasClass("active") && !$this.attr('target')) {

		    // update window with hash
		    // you could also do here:  device === "mobile" - and save a little more memory

		    if ($.root_.hasClass('mobile-view-activated')) {
			    $.root_.removeClass('hidden-menu');
			    window.setTimeout(function() {
					if (window.location.search) {
						window.location.href =
							window.location.href.replace(window.location.search, '')
								.replace(window.location.hash, '') + '#' + $this.attr('href');
					} else {
						window.location.hash = $this.attr('href');
					}
			    }, 150);
			    // it may not need this delay...
		    } else {
				if (window.location.search) {
					window.location.href =
						window.location.href.replace(window.location.search, '')
							.replace(window.location.hash, '') + '#' + $this.attr('href');
				} else {
					window.location.hash = $this.attr('href');
				}
		    }
	    }

    });

    // fire links with targets on different window
    $(document).on('click', 'nav a[target="_blank"]', function(e) {
	    e.preventDefault();
	    var $this = $(e.currentTarget);

	    window.open($this.attr('href'));
    });

    // fire links with targets on same window
    $(document).on('click', 'nav a[target="_top"]', function(e) {
	    e.preventDefault();
	    var $this = $(e.currentTarget);

	    window.location = ($this.attr('href'));
    });

    // all links with hash tags are ignored
    $(document).on('click', 'nav a[href="#"]', function(e) {
	    e.preventDefault();
    });

    // DO on hash change
    $(window).on('hashchange', function() {
	    checkURL();
    });
}

// CHECK TO SEE IF URL EXISTS
function checkURL() {

	// bootstrap backdrop bug for ajax version
	if ($('.modal-backdrop')[0] && $.navAsAjax){
		$('.modal-backdrop').remove();
		//console.log("backdrop removed");
	}

	//get the url by removing the hash
	var url = location.hash.replace(/^#/, '');
	
	//BEGIN: IE11 Work Around
	if (!url) {
	
		try {
			var documentUrl = window.document.URL;
			if (documentUrl) {
				if (documentUrl.indexOf('#', 0) > 0 && documentUrl.indexOf('#', 0) < (documentUrl.length + 1)) {
					url = documentUrl.substring(documentUrl.indexOf('#', 0) + 1);
	
				}
	
			}
	
		} catch (err) {}
	}
	//END: IE11 Work Around

	container = $('#content');
	// Do this if url exists (for page refresh, etc...)
	if (url) {
		// remove all active class
		$('nav li.active').removeClass("active");
		// match the url and add the active class
		$('nav li:has(a[href="' + url + '"])').addClass("active");
		var title = ($('nav a[href="' + url + '"]').attr('title'));

		// change page title from global var
		document.title = (title || document.title);
		//console.log("page title: " + document.title);

		// parse url to jquery
		loadURL(url + location.search, container);
	} else {

		// grab the first URL from nav
		var $this = $('nav > ul > li:first-child > a[href!="#"]');

		//update hash
		window.location.hash = $this.attr('href');

	}

}
*/

// LOAD AJAX PAGES
function loadURL(url, container) {
	//console.log(container)

	$.ajax({
		type : "GET",
		url : url,
		dataType : 'html',
		cache : true, // (warning: setting it to false will cause a timestamp and will call the request twice)
		beforeSend : function() {
			
			//IE11 bug fix for googlemaps (delete all google map instances)
			//check if the page is ajax = true, has google map class and the container is #content
			if ($.navAsAjax && $(".google_maps")[0] && (container[0] == $("#content")[0]) ) {
				
				// target gmaps if any on page
				var collection = $(".google_maps"),
					i = 0;
				// run for each	map
				collection.each(function() {
				    i ++;
				    // get map id from class elements
				    var divDealerMap = document.getElementById(this.id);
				    
				    if(i == collection.length + 1) {
					    // "callback"
					    //console.log("all maps destroyed");
					} else {
						// destroy every map found
						if (divDealerMap) divDealerMap.parentNode.removeChild(divDealerMap);
						//console.log(this.id + " destroying maps...");
					}
				});
				
				//console.log("google maps nuked!!!");
				
			}; //end fix
			
			// destroy all datatable instances
			if ( $.navAsAjax && $('.dataTables_wrapper')[0] && (container[0] == $("#content")[0]) ) {
				
				var tables = $.fn.dataTable.fnTables(true);				
				$(tables).each(function () {
				    $(this).dataTable().fnDestroy();
				});
				//console.log("datatable nuked!!!");
			}
			// end destroy
			
			// pop intervals (destroys jarviswidget related intervals)
			if ( $.navAsAjax && $.intervalArr.length > 0 && (container[0] == $("#content")[0]) && enableJarvisWidgets ) {
				
				while($.intervalArr.length > 0)
        			clearInterval($.intervalArr.pop());
        			//console.log("all intervals cleared..")
        			
			}
			// end pop intervals
			
			// empty container to start garbage memory collection
			container.html("");
			
			// place cog
			container.html('<h1 class="ajax-loading-animation"><i class="fa fa-cog fa-spin"></i> Loading...</h1>');
		
			// Only draw breadcrumb if it is main content material
			if (container[0] == $("#content")[0]) {
				
				// clear everything else except these key DOM elements
				// we do this because sometime plugins will leave dynamic elements behind
				$('body').find('> *').filter(':not(' + ignore_key_elms + ')').empty().remove();
				
				// draw breadcrumb
				drawBreadCrumb();
				
				// scroll up
				$("html").animate({
					scrollTop : 0
				}, "fast");
			} 
			// end if
		},
		success : function(data) {
			container.css({
				opacity : '0.0'
			}).html(data).delay(50).animate({
				opacity : '1.0'
			}, 300);
		},
		error : function(xhr, ajaxOptions, thrownError) {
			container.html('<h4 class="ajax-loading-error"><i class="fa fa-warning txt-color-orangeDark"></i> Error 404! Page not found.</h4>');
		},
		async : true 
	});

	//console.log("ajax request sent");
}

/* ANGULAR: Handled via 'ribbon > breadcrumb' directive
// UPDATE BREADCRUMB
function drawBreadCrumb() {
	var nav_elems = $('nav li.active > a'), count = nav_elems.length;
	
	//console.log("breadcrumb")
	bread_crumb.empty();
	bread_crumb.append($("<li>Home</li>"));
	nav_elems.each(function() {
		bread_crumb.append($("<li></li>").html($.trim($(this).clone().children(".badge").remove().end().text())));
		// update title when breadcrumb is finished...
		if (!--count) document.title = bread_crumb.find("li:last-child").text();
	});

}*/

/* ~ END: APP AJAX REQUEST SETUP */

/*
 * PAGE SETUP
 * Description: fire certain scripts that run through the page
 * to check for form elements, tooltip activation, popovers, etc...
 */
function pageSetUp() {
    setTimeout(
        function()
        {

        if (device === "desktop"){
            // is desktop

            // activate tooltips
//            $("[rel=tooltip]").tooltip();

//            $("[rel=popover]").popover();

            // activate popovers with hover states
//            $("[rel=popover-hover]").popover({
//                trigger : "hover"
//            });
            // setup widgets
            setup_widgets_desktop();
            // run form elements
            runAllForms();

        } else {

            // is mobile

            // activate popovers
//            $("[rel=popover]").popover();
//
//            // activate popovers with hover states
//            $("[rel=popover-hover]").popover({
//                trigger : "hover"
//            });

            // setup widgets
            setup_widgets_mobile();

            // run form elements
            runAllForms();

        }

    }, 1000);
}

// Keep only 1 active popover per trigger - also check and hide active popover if user clicks on document
//$('body').on('click', function(e) {
//	$('[rel="popover"]').each(function() {
//		//the 'is' for buttons that trigger popups
//		//the 'has' for icons within a button that triggers a popup
//		if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
//			$(this).popover('hide');
//		}
//	});
//});
var smartApp = angular.module('smartApp', [
    'ngGrid',
    'ngRoute',
    'ngAnimate', // this is buggy, jarviswidget will not work with ngAnimate :(
//    'plunker',
    'app.controllers',
//    'app.demoControllers',
    'app.main',
    'app.navigation',
    'app.localize',
    'app.smartui',
    'ui.select',
    'ui.utils',
    'ui.bootstrap',
    'ui.bootstrap.tpls',
    'ui.bootstrap.datetimepicker',
    'ngUpload',
    'angular-loading-bar',
    'ckeditor'
]);

smartApp.config(['$routeProvider', '$provide', '$interpolateProvider', '$httpProvider', 'uiSelectConfig', '$logProvider', function ($routeProvider, $provide, $interpolateProvider, $httpProvider, uiSelectConfig, $logProvider) {

    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    $httpProvider.interceptors.push('HttpInterceptor');
    $logProvider.debugEnabled(initVars.d);

    $routeProvider
        .when('/', {
            redirectTo: 'dashboard'
        })
        .otherwise({
            redirectTo: 'dashboard'
        })
        /* We are loading our views dynamically by passing arguments to the location url */

        // A bug in smartwidget with angular (routes not reloading).
        // We need to reload these pages everytime so widget would work
        // The trick is to add "/" at the end of the view.
        // http://stackoverflow.com/a/17588833
        .when('/:page', { // we can enable ngAnimate and implement the fix here, but it's a bit laggy
            templateUrl: function ($routeParams) {
                return '/bundles/app/client_admin/views/' + $routeParams.page + '.html?'+initVars.v;
            },
            controller: 'PageViewController'
        })
        .when('/configuration/offers/wizard/:id', {
            templateUrl: '/bundles/app/client_admin/views/configuration/offers/wizard.html?'+initVars.v,
            controller: 'OfferContainerCtrl'
        })
        .when('/:page/:child*', {
            templateUrl: function ($routeParams) {
                return '/bundles/app/client_admin/views/' + $routeParams.page + '/' + $routeParams.child + '.html?'+initVars.v;
            },
            controller: 'PageViewController'
        })
        ;

    // with this, you can use $log('Message') same as $log.info('Message');
    $provide.decorator('$log', ['$delegate',
        function ($delegate) {
            // create a new function to be returned below as the $log service (instead of the $delegate)
            function logger() {
                // if $log fn is called directly, default to "info" message
                logger.info.apply(logger, arguments);
            }

            // add all the $log props into our new logger fn
            angular.extend(logger, $delegate);
            return logger;
        }]);

    uiSelectConfig.theme = 'select2';
}]);


smartApp.run(function ($rootScope, settings, Permissions, APIRoles, $templateCache) {

//    $rootScope.$on('$viewContentLoaded', function() {
//        $templateCache.removeAll();
//    });

    $rootScope.apps=initVars.apps;

    $rootScope.usernameId=initVars.usernameId;
    $rootScope.currencies=initVars.currencies;
    $rootScope.dateFrom=initVars.dateFrom;
    $rootScope.dateTo=initVars.dateTo;
    $rootScope.v=initVars.v;

    if (localStorage.getItem('language-'+$rootScope.usernameId))
        settings.currentLang = JSON.parse(localStorage.getItem('language-'+$rootScope.usernameId));
    else
        settings.currentLang = settings.languages[0]; // en

    if (localStorage.getItem('currency-'+$rootScope.usernameId))
        $rootScope.currency=JSON.parse(localStorage.getItem('currency-'+$rootScope.usernameId));
    else
        $rootScope.currency=initVars.currency;


    if (localStorage.getItem('app-'+$rootScope.usernameId))
        $rootScope.app=JSON.parse(localStorage.getItem('app-'+$rootScope.usernameId));
    else
        $rootScope.app=initVars.apps[0];

    APIRoles.getAll().success(function(data){
        Permissions.setPermissions(data)
    });

});
(function (ng) {
    'use strict';

    // Used for ng-grid to update interpolation symbols
    ng.module("ngGrid.services").service(
        "$InterpolateUpdateService",
        ['$templateCache', '$interpolate', function($templateCache, $interpolate){
            this.changeGridInterpolate = function() {

                var templates = [
                    "aggregateTemplate.html",
                    "rowTemplate.html",
                    "cellTemplate.html",
                    "cellEditTemplate.html",
                    "checkboxCellTemplate.html",
                    "editableCellTemplate.html",
                    "headerRowTemplate.html",
                    "headerCellTemplate.html",
                    "checkboxHeaderTemplate.html",
                    "gridTemplate.html",
                    "footerTemplate.html",
                    "menuTemplate.html"
                ];

                var start = $interpolate.startSymbol();
                var end = $interpolate.endSymbol();
                for (var i = 0; i < templates.length; i++){
                    var template = templates[i];
                    var curTemplate = $templateCache.get(template);
                    if (start !== "}}"){
                        curTemplate = curTemplate.replace(/\{\{/g, start);
                    }
                    if (end !== "}}"){
                        curTemplate = curTemplate.replace(/\}\}/g, end);
                    }
                    $templateCache.put(template, curTemplate);
                }
            };
        }]);

    ng.module("ngGrid").run(["$InterpolateUpdateService", function($InterpolateUpdateService){
        $InterpolateUpdateService.changeGridInterpolate();
    }]);

})(angular);
angular.module('app.controllers', [])
    .factory('settings', ['$rootScope', function ($rootScope) {
        // supported languages

        var settings = {
            languages: [
                {
                    language: 'English',
                    translation: 'English',
                    langCode: 'en',
                    flagCode: 'us'
                },
                {
                    language: 'Spanish',
                    translation: 'Español',
                    langCode: 'es',
                    flagCode: 'es'
                },
                {
                    language: 'German',
                    translation: 'Deutsch',
                    langCode: 'de',
                    flagCode: 'de'
                },
                {
                    language: 'Korean',
                    translation: '한국의',
                    langCode: 'ko',
                    flagCode: 'kr'
                },
                {
                    language: 'French',
                    translation: 'Français',
                    langCode: 'fr',
                    flagCode: 'fr'
                },
                {
                    language: 'Portuguese',
                    translation: 'Português',
                    langCode: 'pt',
                    flagCode: 'br'
                },
                {
                    language: 'Russian',
                    translation: 'русский',
                    langCode: 'ru',
                    flagCode: 'ru'
                },
                {
                    language: 'Chinese',
                    translation: '中國的',
                    langCode: 'zh',
                    flagCode: 'cn'
                }
            ]

        };

        return settings;

    }])

    .controller('PageViewController', ['$scope', '$route', '$animate', function ($scope, $route, $animate) {
        // controler of the dynamically loaded views, for DEMO purposes only.
        /*$scope.$on('$viewContentLoaded', function() {

         });*/
    }])

    .controller('LangController', ['$scope', 'settings', 'localize', function ($scope, settings, localize) {
        $scope.languages = settings.languages;
        $scope.currentLang = settings.currentLang;
        $scope.setLang = function (lang) {
            settings.currentLang = lang;
            $scope.currentLang = lang;
            localize.setLang(lang);
        };

        // set the default language
        $scope.setLang($scope.currentLang);

    }])


;

angular.module('app.demoControllers', [])
    .controller('WidgetDemoCtrl', ['$scope', '$sce', function ($scope, $sce) {
        $scope.title = 'Wolopay';
        $scope.icon = 'fa fa-user';
        $scope.toolbars = [
            $sce.trustAsHtml('<div class="label label-success">\
				<i class="fa fa-arrow-up"></i> 2.35%\
			</div>'),
            $sce.trustAsHtml('<div class="btn-group" data-toggle="buttons">\
		        <label class="btn btn-default btn-xs active">\
		          <input type="radio" name="style-a1" id="style-a1"> <i class="fa fa-play"></i>\
		        </label>\
		        <label class="btn btn-default btn-xs">\
		          <input type="radio" name="style-a2" id="style-a2"> <i class="fa fa-pause"></i>\
		        </label>\
		        <label class="btn btn-default btn-xs">\
		          <input type="radio" name="style-a2" id="style-a3"> <i class="fa fa-stop"></i>\
		        </label>\
		    </div>')
        ];

        $scope.content = $sce.trustAsHtml('\
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
    }])


;

smartApp.controller('ActiveSubscriptionsController', function ($scope, APISubscription, $modal, $rootScope) {

    $scope.currentPage = 0;
    $scope.subscriptions = [];
    $scope.maxCurrentPage = false;

    function exe(){
        APISubscription.getActives(null, null, null, null, $scope.currentPage).success(function (data){
            if (data.length > 0)
            {
                $scope.subscriptions=$.merge($scope.subscriptions, data);
                $scope.currentPage++;
            }else{
                $scope.maxCurrentPage = true;
            }
        });
    }

    $scope.loadMore = function(){
        exe();
    };

    $scope.predicate = 'created_at';
    $scope.reverse=false;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };


    // MODAL WINDOW
    $scope.cancel = function (subscription) {
        var modalInstance = $modal.open({
            controller: "ActiveSubscriptionCancelCtrl",
            templateUrl: 'myModalContent.html',
            resolve: {
                subscription: function()
                {
                    return subscription;
                }
            }
        });

    };


    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.currentPage = 0;
            $scope.subscriptions = [];
            $scope.maxCurrentPage = false;
            exe();
        }
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });

    exe();
});
smartApp.controller('ActiveSubscriptionCancelCtrl', function ($scope, $modalInstance, subscription, APISubscription, alerts)
{
    $scope.subscription = subscription;

    $scope.ok = function (reason) {
        APISubscription.cancelById($scope.subscription.id, reason).success(function (data){
            $modalInstance.dismiss('cancel');
            alerts.addInfo('active_subscription.cancel_in_process');
        });
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
smartApp.controller('AnalyticsController', function (APIStats, $scope, $rootScope, $log, Sparkline, Flot, localize, Utils) {

    $scope.dateFormat='days';

    $scope.predicate = 'begin_at';
    $scope.reverse=false;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };

    function exe()
    {

        var colors,
            dataStats = [],
            dateFormat
        ;

        APIStats.getByApp(null, $scope.dateFormat).success(function (data){

            $scope.table = data.purchases_by_country_full;

            if ($scope.dateFormat=='weeks'){
                dateFormat =  '%y-%m-%d W';
            }else if ($scope.dateFormat=='days'){
                dateFormat =  '%y-%m-%d';
            }else{
                dateFormat =  '%y-%m';
            }

            var options = {
                grid: {
                    hoverable: true
                },
                tooltip: true,
//                tooltipOpts: {
//                    dateFormat: dateFormat,
//                    defaultTheme: false
//                },
                shifts: {
                    x: -400,
                    y: 20
                },
                xaxis: {
                    mode: 'time',
                    timeformat: dateFormat
                },
                legend: {
                    show: true,
                    position : "ne", // position of default legend container within plot
                    margin : [0, 10], // distance from grid edge to default legend container within plot
                    backgroundColor : "#efefef", // null means auto-detect
                    backgroundOpacity : 1 // set to 0 to avoid background
                }

            };


            colors = Flot.getColors();
            dataStats=[];


            /* chart colors default */
            var $chrt_border_color = "#efefef";
            var $chrt_grid_color = "#DDD"
            var $chrt_main = "#E24913";			/* red       */
            var $chrt_second = "#6595b4";		/* blue      */
            var $chrt_third = "#FF9F01";		/* orange    */
            var $chrt_fourth = "#7e9d3a";		/* green     */
            var $chrt_fifth = "#BD362F";		/* dark red  */
            var $chrt_mono = "#000";

            $("#flotcontainer_analitycs_1_1").empty();
            $.plot($("#flotcontainer_analitycs_1_1"), [{
                data : Flot.parseArrayKey(data.transactions, $scope.dateFormat),
                label : localize.localizeText('transactions')
            }, {
                data :  Flot.parseArrayKey(data.purchases, $scope.dateFormat),
                label : localize.localizeText('purchases')
            }, {
                data :  Flot.parseArrayKey(data.purchases_without_gifts, $scope.dateFormat),
                label : localize.localizeText('analitycs.purchases_without_gifts')
            }
            ], {
                series : {
                    lines : {
                        show : true,
                        lineWidth : 1,
                        fill : true,
                        fillColor : {
                            colors : [{
                                opacity : 0.1
                            }, {
                                opacity : 0.15
                            }]
                        }
                    },
                    points : {
                        show : true
                    },
                    shadowSize : 0
                },
                xaxis : {
                    mode : "time",
                    timeformat: dateFormat
                },

                grid : {
                    hoverable : true,
                    clickable : true,
                    tickColor : $chrt_border_color,
                    borderWidth : 0,
                    borderColor : $chrt_border_color
                },
                tooltip : true,
                tooltipOpts : {
                    dateFormat : dateFormat,
                    defaultTheme : false,
                    shifts: {
                        x: -100,
                        y: 20
                    }
                },
                colors : [$chrt_main, $chrt_second, $chrt_fourth],
                 legend: {
                    show: true,
                    position : "ne", // position of default legend container within plot
                    margin : [0, 20], // distance from grid edge to default legend container within plot
                    backgroundColor : null, // null means auto-detect
                    backgroundOpacity : 0.8 // set to 0 to avoid background
                }
            });

            // Range
            dataStats=[];

            dataStats.push({label: localize.localizeText('purchases'), data: data.purchases_sum, color: $chrt_second});
            dataStats.push({label: localize.localizeText('analitycs.no_hit'), data: data.transactions_sum - data.purchases_sum, color: '#CCC'});

            createSimplePieChart($('#flotcontainer_analitycs_1_2'), dataStats, null, false);

            dataStats=[];

            dataStats.push({label: localize.localizeText('analitycs.purchases_without_gifts'), data: data.purchases_without_gifts_sum, color: $chrt_fourth});
            dataStats.push({label: localize.localizeText('analitycs.no_hit'), data: data.transactions_sum - data.purchases_without_gifts_sum, color: '#CCC'});

            createSimplePieChart($('#flotcontainer_analitycs_1_3'), dataStats, null, false);

            dataStats=[];

            dataStats.push({label: localize.localizeText('analitycs.unique_users'), data: data.unique_users_sum, color: $chrt_main});
            dataStats.push({label: localize.localizeText('others'), data: data.transactions_sum - data.unique_users_sum, color: '#CCC'});

            createSimplePieChart($('#flotcontainer_analitycs_1_4'), dataStats, null, false);

            // Providers
            createSimplePieChart($('#flotcontainer_analitycs_2'), Flot.parseArrayKeyText(data.providers_pie, 'name', 'num'));
            // Articles
            createSimplePieChart($('#flotcontainer_analitycs_5'), Flot.parseArrayKeyText(data.articles_pie, 'name', 'num'));

            $("#flotcontainer_analitycs_3").empty();
            $.plot($("#flotcontainer_analitycs_3"), [{
                    data :  Flot.parseArrayKey(data.unique_users, $scope.dateFormat),
                    label : localize.localizeText('analitycs.unique_users')
                },
                {
                    data :  Flot.parseArrayKey(data.unique_users_purchases, $scope.dateFormat),
                    label : localize.localizeText('analitycs.unique_users_purchases')
                },
                {
                    data :  Flot.parseArrayKey(data.unique_users_purchases_without_gifts, $scope.dateFormat),
                    label : localize.localizeText('analitycs.unique_users_purchases_without_gifts')
                }
            ], {
                series : {
                    lines : {
                        show : true,
                        lineWidth : 1,
                        fill : true,
                        fillColor : {
                            colors : [{
                                opacity : 0.1
                            }, {
                                opacity : 0.15
                            }]
                        }
                    },
                    points : {
                        show : true
                    },
                    shadowSize : 0
                },
                xaxis : {
                    mode : "time",
                    timeformat: dateFormat
                },

                grid : {
                    hoverable : true,
                    clickable : true,
                    tickColor : $chrt_border_color,
                    borderWidth : 0,
                    borderColor : $chrt_border_color
                },
                tooltip : true,
                tooltipOpts : {
                    dateFormat : dateFormat,
                    defaultTheme : false,
                    shifts: {
                        x: -100,
                        y: 20
                    }
                },
                colors : [$chrt_main, $chrt_second, $chrt_fourth],
                legend: {
                    show: true,
                    position : "ne", // position of default legend container within plot
                    margin : [0, 20], // distance from grid edge to default legend container within plot
                    backgroundColor : null, // null means auto-detect
                    backgroundOpacity : 0.8 // set to 0 to avoid background
                },
                yaxis : {
                    ticks : 15,
                    tickDecimals : 0
                }
            });

        });


    }

    function createSimplePieChart(target, dataCharts, legend, label)
    {
        var rect = target.offset();

        label = label === null ? true : label;
        legend = legend || {
            show : true,
            noColumns : 1, // number of colums in legend table
            labelFormatter : null, // fn: string -> string
            labelBoxBorderColor : "#000", // border color for the little label boxes
            container : null, // container (as jQuery object) to put legend in, null means default on top of graph
            position : "ne", // position of default legend container within plot
            margin : [5, 10], // distance from grid edge to default legend container within plot
            backgroundColor :null, // null means auto-detect
            backgroundOpacity : 1 // set to 0 to avoid background
        };

        $.plot(target, dataCharts, {
            series : {
                pie : {
                    show : true,
                    innerRadius : 0.5,
                    radius : 1,
                    label : {
                        show : label,
                        radius : 5 / 8,
                        formatter : function(label, series) {
                            return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">TU NIGGAAA' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                        },
                        threshold : 0.1,
                        background: {
                            opacity: 0.5
                        }
                    }
                }
            },
            legend: legend,
            grid : {
                hoverable : true,
                clickable : true
            },
            tooltip: true,
            tooltipOpts: {
                content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                shifts: {
                    x: rect.left,
                    y: rect.top
                },
                defaultTheme: false
            }
        });
    }

    setTimeout(function(){ exe() }, 1000);

    $scope.$watch('dateFormat', function(newValue, oldValue) {
        if (newValue !== oldValue)
            exe();
    });

    $scope.exe = function (){exe();};

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
            exe();
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });
});
smartApp.controller('CredentialsController', function ($scope, $rootScope, APICredentials) {

    function exe(){
        APICredentials.getAll().success(function (data){
            $scope.credentials = data;
        });
    }

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
            exe();
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
    });

    exe();
});
smartApp.controller('DashboardController', function ($filter, APIStats, $scope, $rootScope, Sparkline, Flot, localize, Utils, $timeout, tableBelow, Permissions) {

    if (sessionStorage.getItem('firstTimeDashBoard') === null)
    {
        sessionStorage.setItem('firstTimeDashBoard', true);
        $scope.dashboard=false;
        console.log("Hi :)");
    }else{
        $scope.dashboard=null;
    }

    function exe(){

        if (!Permissions.getPermissions())
        {
            $timeout(function() {exe();}, 300);
            return;
        }

        if (!Permissions.hasPermission('ROLE_ADMIN_DASHBOARD'))
        {
            $scope.dashboard=false;
            return;
        }

        var dateFormat = 'days';

        APIStats.getAll(null, dateFormat).success(function (data){

            if (sessionStorage.getItem('firstTimeDashBoard') === true)
                $timeout(function() {$scope.dashboard= (data.apps);}, 3000);
            else
                $scope.dashboard= (data.apps);

            $timeout(function() {

                $scope.stats = data;
                $scope.amountsGameSpark = Sparkline.getArrayFromArrayKey(data.amounts_game);
                $scope.transactionsSpark = Sparkline.getArrayFromArrayKey(data.transactions);
                $scope.purchasesSpark = Sparkline.getArrayFromArrayKey(data.purchases);

                var toggles = $("#rev-toggles"),
                    dataStats = [],
                    name,
                    colors = Flot.getColors(),
                    aux,
                    temp= []
                ;

                $scope.actualApps = [];

                angular.forEach(data.apps, function(app, key) {
                    app.color = colors.shift();
                    aux = Utils.findObjectById($rootScope.apps, 'id', key);
                    aux.color = app.color;
                    $scope.actualApps.push(aux);
                });

                // amounts
                angular.forEach(data.apps, function(app, key) {
                    appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');

                    var color = app.color;

                    temp.push({title: appName, data: app.amounts_game, color: color});

                    console.log(Flot.parseArrayKey(app.amounts_game, dateFormat));

                    dataStats.push({
                        stack: true,
                        label: appName+", "+localize.localizeText("game_amount"),
                        data:  Flot.parseArrayKey(app.amounts_game, dateFormat),
                        color: color,
                        bars: {
                            show: true,
                            align: "center",
                            barWidth: 30 * 30 * 60 * 1000 * 1,
                            fillColor : {
                                colors : [
                                    { opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5},{ opacity : 0.5}
                                ]
                            }
                        },

                        group: 'amounts'

                    });
                });

                $scope.gameAmountTable = tableBelow.createObjectByBarChart(temp, true, $rootScope.currency.symbol);

                var options = {

                    grid: {
                        hoverable: true
                    },
                    tooltip: true,
                    tooltipOpts: {
                        dateFormat: '%y-%m-%d',
                        defaultTheme: false
                    },
                    xaxis: {
                        mode: 'time',
                        timeformat: '%y-%m-%d'
                    },
                    legend: {
                        show: false
                    }
                };



                $("#flotcontainer_dashboard_1").empty();
                $.plot($("#flotcontainer_dashboard_1"), dataStats, options);
                dataStats = [];
                temp = [];

                // TRANSACTIONS
                angular.forEach(data.apps, function(app, key) {
                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.transactions, color: app.color});

                    dataStats.push({
                        label: appName+", "+localize.localizeText("transactions"),
                        data:  Flot.parseArrayKey(app.transactions, dateFormat),
                        color: app.color,
                        lines: {
                            show: true,
                            lineWidth: 1
                        },
                        points: {
                            show: true
                        },
                        group: 'transactions'

                    });
                });

                $scope.transactionsTable = tableBelow.createObjectByBarChart(temp, true);

                $("#flotcontainer_dashboard_3").empty();
                $.plot($("#flotcontainer_dashboard_3"), dataStats, options);
                dataStats = [];
                temp = [];

                // PURCHASES
                angular.forEach(data.apps, function(app, key) {

                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.purchases, color: app.color});

                    dataStats.push({

                        label: appName+", "+localize.localizeText("purchases"),
                        data:  Flot.parseArrayKey(app.purchases, dateFormat),
                        color: app.color,
                        lines: {
                            show: true,
                            lineWidth: 1
                        },
                        points: {
                            show: true
                        },
                        group: 'purchases'

                    });
                });

                $scope.purchasesTable = tableBelow.createObjectByBarChart(temp, true);


                $("#flotcontainer_dashboard_4").empty();
                $.plot($("#flotcontainer_dashboard_4"), dataStats, options);
                dataStats = [];
                temp = [];

                // GIFTS
                angular.forEach(data.apps, function(app, key) {

                    var appName = Utils.findStringById($rootScope.apps, 'id', key, 'name');
                    temp.push({title: appName, data: app.gifts, color: app.color});

                    dataStats.push({

                        label: appName+", "+localize.localizeText("gifts"),
                        data:  Flot.parseArrayKey(app.gifts, dateFormat),
                        color: app.color,
                        lines: {
                            show: true,
                            lineWidth: 1
                        },
                        points : {
                            show : true
                        },
                        group: 'gifts'

                    });
                });

                $scope.giftsTable = tableBelow.createObjectByBarChart(temp, true);

                $("#flotcontainer_dashboard_5").empty();
                $.plot($("#flotcontainer_dashboard_5"), dataStats, options);
                dataStats = [];

                function createSimplePieChart(target, dataCharts)
                {
                    var rect = target.offset();
                    target.empty();
                    $.plot(target, dataCharts, {
                        series : {
                            pie : {
                                show : true,
                                innerRadius : 0.5,
                                radius : 1,
                                label : {
                                    show : true,
                                    radius : 2 / 3,
                                    formatter : function(label, series) {
                                        return '<div style="font-size:11px;text-align:center;padding:4px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                                    },
                                    threshold : 0.1,
                                    background: {
                                        opacity: 0.5
                                    }
                                }
                            }
                        },
                        legend : {
                            show : true,
                            noColumns : 1, // number of colums in legend table
                            labelFormatter : null, // fn: string -> string
                            labelBoxBorderColor : "#000", // border color for the little label boxes
                            container : null, // container (as jQuery object) to put legend in, null means default on top of graph
                            position : "ne", // position of default legend container within plot
                            margin : [5, 10], // distance from grid edge to default legend container within plot
                            backgroundColor : "#efefef", // null means auto-detect
                            backgroundOpacity : 1 // set to 0 to avoid background
                        },
                        grid : {
                            hoverable : true
                        },
                        tooltip: true,
                        tooltipOpts: {
                            content: "%p.0%, %x, %s",
                            shifts: {
                                x: rect.left,
                                y: rect.top
                            },
                            defaultTheme: false
                        }
                    });
                }
                var dataAmountByGame=[];

                angular.forEach(data.apps, function(app, key) {
                    dataAmountByGame.push({label: Utils.findStringById($rootScope.apps, 'id', key, 'name'), data: app.amounts_game_sum, color: app.color})
                });
                createSimplePieChart($('#flotcontainer_dashboard_6'), dataAmountByGame);
                $scope.gameAmountPieTable = tableBelow.createObjectByPieChart(dataAmountByGame, $rootScope.currency.symbol);

    //            createSimplePieChart($('#flotcontainer_dashboard_4'), Flot.parseArrayKeyText(data[$rootScope.app.id].providers_pie, 'name', 'num'));

                // BirdsEye
                var max=0;
                $.each(data.purchases_by_country_sum, function(key, value) {
                    if (max < value)
                        max= value;
                });

                $scope.birdEyeMax = max;
                $scope.purchasesCountryTable = tableBelow.createObjectByPieChartSimple(data.purchases_by_country_sum);

                data_array = data.purchases_by_country_sum;

                function renderVectorMap() {
                    $('#vector-map').empty();
                    $('#vector-map').vectorMap({
                        map: 'world_mill_en',
                        backgroundColor: '#fff',
                        regionStyle: {
                            initial: {
                                fill: '#c4c4c4'
                            },
                            hover: {
                                "fill-opacity": 1
                            }
                        },
                        series: {
                            regions: [{
                                values: data_array,
                                scale: ['#85a8b6', '#4d7686'],
                                normalizeFunction: 'polynomial'
                            }]
                        },
                        onRegionLabelShow: function (e, el, code) {
                            if (typeof data_array[code] == 'undefined') {
                                e.preventDefault();
                            } else {
                                var countrylbl = data_array[code];
                                el.html(el.html() + ': ' + countrylbl + ', '+localize.localizeText('purchases'));
                            }
                        }
                    });
                }

                renderVectorMap();
                sessionStorage.setItem('firstTimeDashBoard', false);

//                $timeout(function() {
//                    angular.forEach($scope.gridOptions.ngGrid.rowFactory.aggCache,function(row){
//                        row.toggleExpand();
//                    });
//                }, 1000);

            }, sessionStorage.getItem('firstTimeDashBoard') === true ? 3100: 100);
        });

        APIStats.getPayMethods().success(function (data){
            $scope.pay_method_stats = data;
            $scope.pay_method_stats_original = data;
        });
    }

    var tempFilterText = '', filterTextTimeout;
    $scope.searchChange = function (search){

        if (filterTextTimeout)
            $timeout.cancel(filterTextTimeout);

        tempFilterText = search;
        filterTextTimeout = $timeout(function() {
            $scope.pay_method_stats = $filter('filter')($scope.pay_method_stats_original, tempFilterText);
        }, 500);

    };

        var myHeaderCellTemplate = '<div class="ngHeaderSortColumn {[{col.headerClass}]}" ng-style="{\'cursor\': col.cursor}" ng-class="{ \'ngSorted\': !noSortVisible }"><div ng-click="col.sort($event)" ng-class="\'colt\' + col.index" class="ngHeaderText" data-localize="{[{col.displayName}]}"></div><div class="ngSortButtonDown" ng-show="col.showSortButtonDown()"></div><div class="ngSortButtonUp" ng-show="col.showSortButtonUp()"></div><div class="ngSortPriority">{[{col.sortPriority}]}</div><div ng-class="{ ngPinnedIcon: col.pinned, ngUnPinnedIcon: !col.pinned }" ng-click="togglePin(col)" ng-show="col.pinnable"></div></div><div ng-show="col.resizable" class="ngHeaderGrip" ng-click="col.gripClick($event)" ng-mousedown="col.gripOnMouseDown($event)"></div>'

        $scope.gridOptions = {
        data: 'pay_method_stats',
        showGroupPanel: true,
        showColumnMenu: true,
        jqueryUIDraggable: true,
        enableColumnResize: true,
        groupsCollapsedByDefault: true,

        groups: ['my_date', 'app', 'country'],
        aggregateTemplate: '' +
            '<div ng-click="row.toggleExpand()" ng-style="rowStyle(row)" class="ngAggregate ngRow group-depth-{[{row.depth}]}">' +
            '    <span class="ngAggregateText">{[{row.label CUSTOM_FILTERS}]} ({[{row.totalChildren()}]} {[{AggItemsLabel}]})</span>' +
            //'    <div class="ngCell col{[{ 3 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 3 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">≃ {[{aggFunc(row, "n_unique_users") | number }]}</span></div>' +
            '    <div class="ngCell col{[{ 4 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 4 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">≃ {[{aggFunc(row, "n_unique_users") | number }]}</span></div>' +
            '    <div class="ngCell col{[{ 5 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 5 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "n_transactions") | number }]}</span></div>' +
//            '    <div class="ngCell col{[{ 5 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 5 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "n_clicked") | number }]}</span></div>' +
            '    <div class="ngCell col{[{ 6 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 6 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "n_purchases") | number }]}</span></div>' +

            '    <div class="ngCell col{[{ 7 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 7 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFuncAvg(row, "ctr") | percentage }]}</span></div>' +


            '    <div class="ngCell col{[{ 8 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 8 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "total") | currency:currency.symbol }]}</span></div>' +
            '    <div class="ngCell col{[{ 9 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 9 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "game_total") | currency:currency.symbol }]}</span></div>' +

            '    <div class="ngCell col{[{ 10 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 10 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "game_total") / aggFunc(row, "n_purchases") | currency:currency.symbol }]}</span></div>' +
            '    <div class="ngCell col{[{ 11 + gridOptions.$gridScope.configGroups.length }]} colt{[{ 11 + gridOptions.$gridScope.configGroups.length}]}"><span class="ngAggregateText">{[{aggFunc(row, "game_total") / aggFunc(row, "n_transactions") * 1000 | currency:currency.symbol }]}</span></div>' +

            '    <div class="{[{row.aggClass()}]}"></div>' +

            '</div>',
        columnDefs: [
            {field:'my_date', aggLabelFilter: 'localize', displayName: 'Date', headerCellTemplate: myHeaderCellTemplate},
            {field:'app', aggLabelFilter: 'localize', displayName: 'App', headerCellTemplate: myHeaderCellTemplate},
            {field:'country', aggLabelFilter: 'localize', displayName:"Country", headerCellTemplate: myHeaderCellTemplate},
            {field:'pay_method', aggLabelFilter: 'localize', displayName: "Pay Method", headerCellTemplate: myHeaderCellTemplate, groupable: false},
            {field:'n_unique_users', displayName: "dashboard.table.n_unique_users", headerCellTemplate: myHeaderCellTemplate, groupable: false},
            {field:'n_transactions', displayName: "dashboard.table.n_transactions", headerCellTemplate: myHeaderCellTemplate, groupable: false},
//            {field:'n_clicked', displayName: "dashboard.table.n_clicked", headerCellTemplate: myHeaderCellTemplate},

            {field:'n_purchases', displayName: "dashboard.table.n_purchases", headerCellTemplate: myHeaderCellTemplate, groupable: false},
            {field:'ctr', displayName: "dashboard.table.ctr", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'percentage', groupable: false},

            {field:'total', displayName: "dashboard.table.total", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false},
            {field:'game_total', displayName: "dashboard.table.game_total", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false},

            {field:'payout_vs_purchases', displayName: "dashboard.table.payout_vs_purchases", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false},
            {field:'payout_vs_transactions', displayName: "dashboard.table.payout_vs_transactions", headerCellTemplate: myHeaderCellTemplate, cellFilter: 'currency:currency.symbol', groupable: false}

        ]
    };

    $scope.aggFunc = function (row, col) {

        var sumColumn = col;
        var total = 0, temp;
        angular.forEach(row.children, function(entry) {
            temp = parseFloat(entry.entity[sumColumn]);
            if (!isNaN(temp))
                total+= temp ;
        });
        angular.forEach(row.aggChildren, function(entry) {
            total+= parseFloat($scope.aggFunc(entry, col));
        });

        return total;
    };

    $scope.aggFuncAvg = function (row, col) {

        var result = aggFuncAvg(row, col);

        return result.total / result.count;
    };

    function aggFuncAvg(row, col)
    {
        var sumColumn = col;
        var total = 0, temp, result, count = 0;
        angular.forEach(row.children, function(entry) {
            temp = parseFloat(entry.entity[sumColumn]);
            if (!isNaN(temp))
            {
                total+= temp ;
                count++;
            }
        });
        angular.forEach(row.aggChildren, function(entry) {
            result = aggFuncAvg(entry, col);
            total+= parseFloat(result.total);
            count+= result.count;
        });

        return {total: total, count: count};
    }

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
            exe();
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });

    exe();
});
smartApp.controller('SmartAppController', function ($scope, $rootScope, APIRoles, Permissions) {

    $rootScope.$watch('currency', function(newValue, oldValue) {
        localStorage.setItem('currency-'+$rootScope.usernameId, JSON.stringify(newValue));
    });

    $rootScope.$watch('app', function(newValue, oldValue) {
        if (newValue.id === oldValue.id)
            return false;
        localStorage.setItem('app-'+$rootScope.usernameId, JSON.stringify(newValue));
        APIRoles.getAll().success(function(data){
            Permissions.setPermissions(data)
        });
    });

});
smartApp.controller('MessagesCtrl', function ($rootScope, $scope, alerts) {

    $scope.removeError = function(item) {
        var index = $rootScope.errors.indexOf(item)
        $rootScope.errors.splice(index, 1);
    };

    $scope.removeWarning = function(item) {
        alerts.removeWarning(item);
    };

    $scope.removeInfo = function(item) {
        var index = $rootScope.infos.indexOf(item)
        $rootScope.infos.splice(index, 1);
    };

});
smartApp.controller('NotificationsController', function ($scope, APINotifications, $modal, $rootScope) {

    $scope.currentPage = 0;
    $scope.notifications = [];
    $scope.maxCurrentPage = false;

    function exe(){
        APINotifications.getAll(null, null, null, null, $scope.currentPage).success(function (data){
            if (data.length > 0)
            {
                $scope.notifications=$.merge($scope.notifications, data);
                $scope.currentPage++;
            }else{
                $scope.maxCurrentPage = true;
            }

        });
    }

    exe();

    $scope.loadMore = function(){
        exe();
    };

    $scope.predicate = 'created_at';
    $scope.reverse=true;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };

    // MODAL WINDOW
    $scope.open = function (notification) {

        var modalInstance = $modal.open({
            controller: "NotificationModalCtrl",
            templateUrl: 'myModalContent.html',
            resolve: {
                notification: function()
                {
                    return notification;
                }
            }
        });

    };

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.notifications = [];
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            exe();
        }
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });
});

smartApp.controller('NotificationModalCtrl', function ($scope, $modalInstance, notification)
{
    $scope.notification = notification;

});
smartApp.controller('PurchasesController', function ($scope, APIPurchases, $modal, $rootScope, $filter) {
    $scope.currentPage = 0;
    $scope.purchases = [];
    $scope.maxCurrentPage = false;

    function exe(){
        APIPurchases.getAll(null, null, null, null, $scope.currentPage).success(function (data){
            if (data.length > 0)
            {
                $scope.transactions=$.merge($scope.purchases, data);
                $scope.purchases_country = $filter('unique')($scope.purchases, 'country.id');
                $scope.purchases_gamer = $filter('unique')($scope.purchases, 'gamer.gamer_external_id');
                $scope.purchases_pay_method = $filter('unique')($scope.purchases, 'pay_method.name');
                $scope.currentPage++;
            }else{
                $scope.maxCurrentPage = true;
            }

        });
    }

    $scope.loadMore = function(){
        exe();
    };

    $scope.predicate = 'created_at';
    $scope.reverse=true;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };

    // MODAL WINDOW
    $scope.open = function (purchase) {

        var modalInstance = $modal.open({
            controller: "PurchaseModalCtrl",
            templateUrl: 'myModalContent.html',
            resolve: {
                purchase: function()
                {
                    return angular.copy(purchase);
                }
            }
        });

    };


    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            $scope.purchases = [];
            exe();
        }
    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });

    exe();
});
smartApp.controller('PurchaseModalCtrl', function ($scope, $modalInstance, purchase)
{
    $scope.purchase = purchase;

});
smartApp.controller('TransactionsController', function ($scope, APITransactions, $rootScope) {
    $scope.currentPage = 0;
    $scope.transactions = [];
    $scope.maxCurrentPage = false;
    function exe(){
        APITransactions.getAll(null, null, null, null, $scope.currentPage).success(function (data){
            if (data.length > 0)
            {
                $scope.transactions=$.merge($scope.transactions, data);
                $scope.currentPage++;
            }else{
                $scope.maxCurrentPage = true;
            }
        });
    }

    $scope.loadMore = function(){
        exe();
    };

    $scope.predicate = 'begin_at';
    $scope.reverse=true;

    $scope.orderBy = function(field){

        if (field == $scope.predicate)
            $scope.reverse = !$scope.reverse;

        $scope.predicate = field;

    };

    function watcher(newValue, oldValue)
    {
        if (oldValue && newValue!=oldValue)
        {
            $scope.currentPage=0;
            $scope.maxCurrentPage = false;
            $scope.transactions = [];
            exe();
        }

    }

    var appWatch =$rootScope.$watch('app', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var currency =$rootScope.$watch('currency', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateFrom =$rootScope.$watch('dateFrom', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });
    var dateTo =$rootScope.$watch('dateTo', function(newValue, oldValue) {
        watcher(newValue, oldValue);
    });

    $scope.$on("$destroy", function() {
        appWatch();
        currency();
        dateFrom();
        dateTo();
    });

    exe();
});
smartApp.controller('ActivityDemoCtrl',  function ($rootScope, $scope, APIUserNotifications, $modal) {

    var ctrl = this;
    $scope.activityShow = false;
    ctrl.getDate = function () {
        return new Date().toUTCString();
    };

    function exe()
    {
        APIUserNotifications.getAll().success(function (data){
            $scope.notifications = data;
            $scope.nNotifications = data.length;
            var total=0;
            angular.forEach($scope.notifications, function (item) {
                if (item.unread)
                    total++;
            });
            $rootScope.totalNotifications = total;
        });

        $scope.footerContent = ctrl.getDate();
    }

    $scope.refreshCallback = function () {
        exe();
    };

    $scope.items = [
        {
            title: 'notifications',
            count: 0
        }
    ];

    $scope.nNotifications = 0;

    $rootScope.totalNotifications = 0;
    angular.forEach($scope.items, function (item) {
        $rootScope.totalNotifications += item.count;
    });

    $scope.footerContent = ctrl.getDate();

    exe();

    // MODAL WINDOW
    $scope.open = function (notification) {

        var modalInstance = $modal.open({
            controller: "NotificationModalCtrl",
            templateUrl: 'notificationModal.html',
            resolve: {
                notification: function()
                {
                    return notification;
                }
            }
        });

    };
});
smartApp.controller('NotificationModalCtrl', function ($rootScope, $scope, $modalInstance, notification, APIUserNotifications){
    $scope.notification = notification;
    if (notification.unread)
    {
        APIUserNotifications.setReadById(notification.id).success(function(data){
            notification.unread = false;
            $rootScope.totalNotifications-=1;
        });
    }

});
smartApp.controller('DocsPayMethodsController', function ($scope, APIPayMethods, $rootScope) {

    function exe(){
        APIPayMethods.getByAppId($rootScope.app.id).success(function (data){
            $scope.payMethods = data;
        });
    }

    $scope.paymethodFee = function (payMethod)
    {
        var max = 1.5;
        angular.forEach(payMethod.pay_method_has_provider, function(payMethodHasProvider) {
            if (payMethodHasProvider.fee_provider_percent > max)
                max = payMethodHasProvider.fee_provider_percent;
        });

        return max;
    }

    $scope.hasDirectPayment = function (payMethod)
    {
        var result = false;

        angular.forEach(payMethod.pay_method_has_provider, function(payMethodHasProvider) {
           if (payMethodHasProvider.can_be_custom_transaction)
               result = true;
        });

        return result;
    };

    $scope.getCountriesByPayMethod = function (payMethod)
    {
        var result = [];
        var exist = false;
        angular.forEach(payMethod.pay_method_has_provider, function(payMethodHasProvider) {

            angular.forEach(payMethodHasProvider.pay_method_provider_has_countries, function(country) {

                if (result.indexOf(country.id) == -1)
                {
                    result.push(country.country.id);
                }
            });

        });

        return result;
    };

    exe();
});

smartApp.controller('ConfiguratorContainerCtrl', function ($rootScope, APIArticles, $location, $scope, APIOffers, Utils,  alerts, localize, $routeParams, $filter) {

    $scope.$on("$destroy", function() {
        delete $rootScope.configuratorCurrent;
    });

    $scope.$watch('app', function(newValue, oldValue) {
        if (newValue===oldValue)
            return;
        exe();
    });

    $rootScope.configuratorCurrent = {};

    function exe(){
        APIArticles.getArticleByAppId($rootScope.app.id).success(function (data){
            if (data.length == 0)
                $rootScope.configuratorCurrent = { step: 1 };
            else
                $rootScope.configuratorCurrent = { step: 9 };
        });
    }


    $scope.goBack = function (step)
    {
        if (step < $rootScope.configuratorCurrent.step)
            $rootScope.configuratorCurrent.step = step;
    };

    exe();

});


smartApp.controller('ConfiguratorSelectCountriesController', function ($scope, APICountries, $rootScope, Utils, $filter) {

    $scope.continents = {};
    $scope.search = {name: 'España'};

    $scope.otherIsSelected = function(){
        var result = false;
        angular.forEach($rootScope.configuratorCurrent.countries, function(country){
            if (country.id == 'DF' && country.selected)
                result = true;
        });

        return result;
    };


    var copyCountries = angular.copy($rootScope.configuratorCurrent.countries);
    APICountries.getByAppId($rootScope.app.id).success(function (data){

        angular.forEach(data, function(country){
            country.selected = true;
            country.continent.selected = true;

        });

        var copyCountries = data;

        APICountries.getAllByAppIdAvailable($rootScope.app.id).success(function(data){

            var countries = data;
            var continents = $filter('unique')(data, 'continent.id');
            // restore session if exist
            if (copyCountries)
            {
                var copyContinents = $filter('unique')(copyCountries, 'continent.id');

                angular.forEach(continents, function(country){

                    angular.forEach(copyContinents, function(copyCountry){

                        if (copyCountry.continent.id == country.continent.id && copyCountry.continent.selected)
                            country.continent.selected = true;
                    });
                });

                angular.forEach(countries, function(country){

                    angular.forEach(copyCountries, function(copyCountry){

                        if (copyCountry.id == country.id && copyCountry.selected)
                        {
                            country.activate = true;
                            country.selected = true;
                        }
                    });
                });

            }

            $rootScope.configuratorCurrent.countries = countries;
            $scope.continents = continents;

            $scope.updateSelectedCountries();
        });
    });

    $scope.updateSelectedCountries = function(){
        var value;

        angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
            value=false;
            angular.forEach($scope.continents, function(continent) {
                if (continent.continent && continent.continent.id == country.continent.id && continent.continent.selected)
                    value=true;
            });
            country.active = value;
        });


        angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
            if (country.active == false)
                country.selected = false;
        });
    };

    $scope.addAllContinents = function(){
        angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
                value.continent.selected=true;
        });

        $scope.updateSelectedCountries();
    };

    $scope.removeAllContinents = function(){
        angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
            value.continent.selected=false;
        });

        $scope.updateSelectedCountries();
    };

    $scope.addAllCountriesAvailable = function(){
        angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
            if (value.active)
                value.selected=true;
        });
    };

    $scope.removeAllCountriesAvailable = function(){
        angular.forEach($rootScope.configuratorCurrent.countries, function(value) {
            value.selected=false;
        });
    };

    $scope.getCountries = function(){
        var result = [];
        angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
            if (country.active)
                result.push(country);
        });

        return result;
    };

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.configuratorCurrent.countries, function(value) {

            if (value.selected)
                result = true;
        });

        return result;
    };

    $scope.submit = function (){
        var countries = [];
        angular.forEach($rootScope.configuratorCurrent.countries, function(country) {
            if (country.selected)
                countries.push(country.id);
        });

        APICountries.updateByApp($rootScope.app.id, countries).success(function (data){
            $rootScope.configuratorCurrent.step = 2;
        });
    }

});

smartApp.controller('ConfiguratorSelectLanguageController', function ($scope, APILanguages, $rootScope) {

    $rootScope.$watch('configuratorCurrent', function(newValue, oldValue) {
        setEnglishSelected();
    });

    $rootScope.configuratorCurrent.languages = [];

    APILanguages.getAll().success(function (data){
        $rootScope.configuratorCurrent.languages = data;

        APILanguages.getAll($rootScope.app.id).success(function (data){
            angular.forEach($rootScope.configuratorCurrent.languages, function(lang) {
                angular.forEach(data, function(langSelected) {
                    if (lang.id == langSelected.id)
                        lang.selected = true;
                });
            });
            setEnglishSelected();
        });
    });

    function setEnglishSelected()
    {
        angular.forEach($rootScope.configuratorCurrent.languages, function(value) {
            if (value.id == 'en')
                value.selected = true;
        });
    }

    $scope.someSelected = function () {

        var result = false, englishDisabled=false;

        angular.forEach($rootScope.configuratorCurrent.languages, function(value) {

            if (value.id == 'en' && !value.selected)
                englishDisabled = true;

            if (value.selected)
                result = true;
        });

        return (result && englishDisabled == false);
    };

    $scope.submit = function (){
        var languages = [];
        angular.forEach($rootScope.configuratorCurrent.languages, function(language) {
            if (language.selected)
                languages.push(language.id);
        });

        APILanguages.updateByApp($rootScope.app.id, languages).success(function (data){
            $rootScope.configuratorCurrent.step = 3;
        });
    }
})
;

smartApp.controller('ConfiguratorSelectItemController', function (APICountries, APILanguages, $scope, APIItems, $rootScope, Utils, $filter, $modal, dialogs) {

    $rootScope.configuratorCurrent.items = [];

    APIItems.getByAppId($rootScope.app.id).success(function (data){
        $rootScope.configuratorCurrent.items = data;
    });

    APILanguages.getAll($rootScope.app.id).success(function (data){
        $scope.languages = data;

        $scope.loadModal = function (item)
        {
            var modalInstance = $modal.open({
                controller: "ConfiguratorItemEditCtrl",
                templateUrl: 'item_mod.html',
                resolve: {
                    item: function()
                    {
                        return angular.copy(item);
                    },
                    languages: function()
                    {
                        return $scope.languages;
                    },
                    countries: function()
                    {
                        return $scope.countries;
                    }
                }
            });
        };
    });

    APICountries.getAll().success(function(data){
        $scope.countries=data;
    });

    $scope.delete = function (item) {
        var dlg = dialogs.confirm();
        dlg.result.then(function(btn){
            APIItems.deleteById(item.id).success(function (data){
                $rootScope.configuratorCurrent.items.splice( $rootScope.configuratorCurrent.items.indexOf(item), 1 );
            });
        },function(btn){

        });
    };

}).controller('ConfiguratorItemEditCtrl', function (countries, languages, $scope, $modalInstance, item, alerts, $rootScope, APIItems, $modal)
{
    $scope.item = item;
    $scope.languages = languages;
    $scope.countries = countries;

    $scope.not_number = false;
    $scope.searchIfContainsNumber = function () {

        $scope.not_number = false;

        angular.forEach(languages, function(lang) {
            if (item.name_label && 'translation_'+ lang.id in item.name_label && item.name_label['translation_'+ lang.id ].indexOf("{[{number}]}") == -1)
                $scope.not_number = true;
        });
    };

    if ((!item || !item.id) && localStorage.getItem('unitary_price_country'))
    {
        item.unitary_price_country = JSON.parse(localStorage.getItem('unitary_price_country'));
    }

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.uploadComplete  = function (content){

        if (content.id)
        {
            localStorage.setItem('unitary_price_country', JSON.stringify(item.unitary_price_country));

            APIItems.getByAppId($rootScope.app.id).success(function (data){
                $rootScope.configuratorCurrent.items = data;
            });
            $modalInstance.dismiss('cancel');

        }else if (typeof content == 'object'){
            alerts.addError(content.message);
        }else{
            alerts.addError('internal_server_error');
        }
        $rootScope.loading = false;
    };

    $scope.editDescription = function (item, language)
    {
        var modalInstance = $modal.open({
            controller: "DescriptionItemEditCtrl",
            templateUrl: 'item_description_mod.html',
            resolve: {
                item: function()
                {
                    return item;
                },
                language: function()
                {
                    return language;
                }
            }
        });
    };
}).controller('DescriptionItemEditCtrl', function (item, language, $scope, $modalInstance, alerts, $rootScope)
{
    $scope.text = item.description_label['translation_'+ language.id ];
    $scope.language = language;

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.ok = function (text) {
        item.description_label['translation_'+ language.id ]= text;
        $modalInstance.dismiss('cancel');
    };

});


smartApp.controller('ConfiguratorSelectArticlesController', function ($scope, APIItems, $rootScope, Utils, $filter, $modal, dialogs) {

    $rootScope.configuratorCurrent.items = {};

    APIItems.getByAppId($rootScope.app.id).success(function (data){
        $rootScope.configuratorCurrent.items = data;
    });

    $scope.loadModal = function (item)
    {
        var modalInstance = $modal.open({
            controller: "ConfiguratorArticleEditCtrl",
            templateUrl: 'article_mod.html',
            backdrop: 'static',
            windowClass: 'full',
            resolve: {
                item: function()
                {
                    return item;
                }
            }
        });
    };

    $scope.delete = function (item) {
        var dlg = dialogs.confirm();
        dlg.result.then(function(btn){
            APIItems.deleteById(item.id).success(function (data){
                $rootScope.configuratorCurrent.items.splice( $rootScope.configuratorCurrent.items.indexOf(item), 1 );
            });
        },function(btn){

        });
    };

}).controller('ConfiguratorArticleEditCtrl', function ($scope, $modalInstance, item, alerts, $rootScope, APIItems)
{
    $scope.item = angular.copy(item);


    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };

    $scope.addArticle = function (){
        $scope.item.articles.push({});
    };

    $scope.delete = function (article){
        $scope.item.articles.splice( $scope.item.articles.indexOf(article), 1 );
    };

    $scope.calculateDiscount = function (item, article){
        if (article.article_category && article.article_category.id == 'free')
            article.discount = -100;
        else
            article.discount= ((article.amount_standard / article.items_quantity) * 100 / item.unitary_price ) - 100;
    }

    $scope.uploadComplete = function (content){

        if (content.id)
        {
            APIItems.getByAppId($rootScope.app.id).success(function (data){
                $rootScope.configuratorCurrent.items = data;
            });
            $modalInstance.dismiss('cancel');

        }else if (typeof content == 'object'){
            alerts.addError(content.message);
        }else{
            alerts.addError('internal_server_error');
        }

        $rootScope.loading = false;
    };
});

smartApp.controller('ConfiguratorSelectPayMethodsController', function ($scope, APICountries, APIPayMethods, $rootScope, Utils, filterFilter, $http) {

    APICountries.getByAppId($rootScope.app.id).success(function (countries){


        APIPayMethods.getByAppId($rootScope.app.id).success(function (data){

            $scope.pay_methods = data;

            APIPayMethods.getByAppId($rootScope.app.id, true).success(function (data){

                angular.forEach($scope.pay_methods, function(payMethod){
                    angular.forEach(data, function(pm){
                        if (payMethod.id == pm.id)
                        {
                            angular.forEach(pm.pay_method_has_provider, function(pmp){
                                angular.forEach(pmp.pay_method_provider_has_countries, function(country){
                                    payMethod['selected_'+country.country.id]=true;
                                });
                            });
                        }
                    });
                });

            });

            var toDelete = [];

            var exist ;
            // delete countries with empty custom paymethods
            angular.forEach(countries, function(country){

                angular.forEach($scope.pay_methods, function(pm){
                    angular.forEach(pm.pay_method_has_provider, function(pmp){
                        angular.forEach(pmp.pay_method_provider_has_countries, function(pmpc){

                            if (country.id == pmpc.country.id)
                            {
                                exist=true;
                            }
                        });
                        if (exist)
                            return;
                    });
                    if (exist)
                        return;
                });

                if (!exist)
                    toDelete.push(country);
            });

            angular.forEach(toDelete, function(country){
                countries.splice( countries.indexOf(country), 1 );
            });

            $scope.countries = countries;
            $scope.search = countries[0];

        });

    });

    $scope.selectAll = function ()
    {
        var data = filterFilter($scope.pay_methods, $scope.search.name);
        angular.forEach(data, function(pay_method){
            pay_method['selected_' + $scope.search.id ]=true;
        });
    };

    $scope.removeAll = function ()
    {
        var data = filterFilter($scope.pay_methods, $scope.search.name);
        angular.forEach(data, function(pay_method){
            pay_method['selected_' + $scope.search.id ]=false;
        });
    };

    function findPMPC(payMethod)
    {
        var val = null;
        angular.forEach(payMethod.pay_method_has_provider, function(pmp) {
            angular.forEach(pmp.pay_method_provider_has_countries, function(pmpc) {
                if (pmpc.country.id == $scope.search.id)
                    val = pmpc;
            });
        });

        return val;
    }

    $scope.paymethodFeePercent = function (payMethod)
    {
        var pmpc = findPMPC(payMethod);
        return pmpc && pmpc.fee_provider_percent ? pmpc.fee_provider_percent : 'N/A' ;
    };

    $scope.paymethodEachPayment = function (payMethod)
    {
        var pmpc = findPMPC(payMethod);
        return pmpc && pmpc.fee_extra_each_payment ? pmpc.fee_extra_each_payment + '' + pmpc.country.currency.symbol : null ;
    };

    $scope.paymethodMinimal = function (payMethod)
    {
        var pmpc = findPMPC(payMethod);
        return pmpc && pmpc.fee_provider_minimal ? pmpc.fee_provider_minimal + '' + pmpc.country.currency.symbol : '-' ;
    };

    $scope.someSelected = function (){
        var result = false;

        angular.forEach($scope.pay_methods, function(pay_method){
            angular.forEach($scope.countries, function(country){
                if (pay_method['selected_'+country.id])
                    result = true;
            });
        });

        return result;
    };

    $scope.submit = function (){
        $http.put('/admin/api/pay_methods/sync/app/'+$rootScope.app.id, {pay_methods: $scope.pay_methods}).success(function (data){
             $rootScope.configuratorCurrent.step = 6
        });
    };

});

smartApp.controller('ConfiguratorSelectArticlesAndShopsController', function (APIAppShops, APIShopTemplates, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http) {

    $scope.tab = {};

    APIShopTemplates.getByAppId($rootScope.app.id).success(function (data){
        $scope.templates = data;
    });

    APIAppShops.getCategories().success(function (data){
        $scope.categories = data;

        APIAppShops.getByAppId($rootScope.app.id).success(function (selecteds){

            angular.forEach($scope.categories, function(category){
                angular.forEach(selecteds, function(selected){
                    if (selected.level_category.id == category.id)
                    {
                        category.selected = true;
                        category.value_lower = selected.value_lower;
                        category.value_higher = selected.value_higher;
                        category.css = selected.css;
                    }
                });
            });

            angular.forEach($scope.categories, function(category){
                if (!category.css)
                    category.css = {};
            });

            APIArticles.getArticleByAppId($rootScope.app.id).success(function (data){
                $scope.articles = data;

                angular.forEach(data, function(row){
                    angular.forEach(row.app_shop_has_articles, function(app_shop_has_article){

                        if (app_shop_has_article.active == 1)
                            row['selected_'+app_shop_has_article.app_shop.level_category.id ] = true;

                    });
                });

                selectTabAvailableAuto();
            });



        });

    });

    $scope.selectAll = function (categoryId)
    {
        angular.forEach($scope.articles, function(article){
            article['selected_'+categoryId] = true;
        });
    };

    $scope.removeAll = function (categoryId)
    {
        angular.forEach($scope.articles, function(article){
            article['selected_'+categoryId] = false;
        });
    };

    $scope.valueHigherChanged = function (category){
        var next=null;
        angular.forEach($scope.categories, function(categoryCurrent, key){
            if (categoryCurrent.selected)
            {
                if (next)
                    categoryCurrent.value_lower = next.value_higher;

                if (categoryCurrent.id == category.id)
                {
                    next=categoryCurrent;
                }else{
                    next=null;
                }
            }


        });

    };

    $scope.someSelected = function (){
        var result = false;

        angular.forEach($scope.categories, function(category){
            angular.forEach($scope.articles, function(article){
                if (article['selected_'+category.id])
                    result = true;
            });
        });

        return result;
    };

    $scope.submit = function (){
        $http.put('/admin/api/article/sync/shops/app/'+$rootScope.app.id, {categories: $scope.categories, articles: $scope.articles}).success(function (data){
             $rootScope.configuratorCurrent.step = 7;
        });
    };

    $scope.updateShop= function(levelCategory)
    {
        var min= 0, max=999999, last, first, before;
        angular.forEach($scope.categories, function(category){

            if (category.selected)
            {
                if (!first)
                    first = category;

                last = category;
                category.value_lower = min;

                if (category.value_higher)
                    min = category.value_higher;
            }
        });
        angular.forEach($scope.categories, function(category){

            if (first && first.id != category.id && category.value_lower === 0 )
            {
                category.value_lower = null;
            }

            if (category.value_lower == max )
                category.value_lower = null;

            if (last && category.id !== last.id)
            {
                if (category.value_higher == max)
                    category.value_higher = null;
            }
        });
        if (last)
            last.value_higher = max;

        angular.forEach($scope.articles, function(article){
            if (levelCategory.selected)
                article['selected_'+levelCategory.id] = article['selected_previous_'+levelCategory.id] || false;
            else{
                article['selected_previous_'+levelCategory.id] = article['selected_'+levelCategory.id];
                article['selected_'+levelCategory.id] = false;
            }
        });

        selectTabAvailableAuto();
    };

    function selectTabAvailableAuto(){

        $scope.tab = null;

        angular.forEach($scope.categories, function(category){
            if (category.selected && $scope.tab == null)
                $scope.tab = category;
        });

    }

});

smartApp.controller('ConfiguratorSelectPricesController', function (APIAppShopHasArticles, APIAppShops, APICountries, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http) {

    $scope.free = {article_category: { id: 'free'}};
    $scope.single = {article_category: { id: 'single_payment'}};
    $scope.subscription = {article_category: { id: 'subscription'}};

    APIArticles.getArticleByAppId($rootScope.app.id, null, true).success(function (data){
        $scope.articles = data;
    });

    APICountries.getByAppId($rootScope.app.id).success(function (data){
        $scope.countries = data;
        $scope.countrySelected = data[0];
    });

    APIAppShops.getByAppId($rootScope.app.id).success(function (data){
        $scope.appShops = data;
    });

    APIAppShops.getByAppId($rootScope.app.id).success(function (data){
        $scope.tab = data[0].level_category;
        $scope.categories = data;
    });

    $scope.modifyPriceByArticleAmountStandard = function(articleToModify) {
        angular.forEach($scope.articles, function(article){
            if (articleToModify.id == article.id)
            {
                angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){

                    if (article.amount_standard === 0)
                    {
                        appShopHasArticle.current_amount_without_offer = 0;

                    }else{

                        if (!$scope.ignoreCostOfLife)
                        {

                                APICountries.getCostOfLife(
                                        article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id
                                    ).success(function (data){
                                        appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                                    });


                        }else{
                            APICountries.getExchange(
                                    article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id
                                ).success(function (data){
                                    appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                                });
                        }

                    }

                });
            }

        });
    };

    $scope.modifyPriceByCostOfLifeByCountry = function() {
        angular.forEach($scope.articles, function(article){

            angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){

                if (appShopHasArticle.country.id == $scope.countrySelected.id)
                {
                    APICountries.getCostOfLife(
                            article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id
                        ).success(function (data){
                            appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                        });
                }

            });
        });
    };

    $scope.modifyPriceByCurrencyByCountry = function() {
        angular.forEach($scope.articles, function(article){

            angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){

                if (appShopHasArticle.country.id == $scope.countrySelected.id)
                {
                    APICountries.getExchange(
                            article.amount_standard, article.item.unitary_price_country.id, appShopHasArticle.country.id
                        ).success(function (data){
                            appShopHasArticle.current_amount_without_offer = Math.round(parseFloat(data.price) * 100) / 100;
                        });
                }

            });
        });
    };

    $scope.submit = function (){
        $http.put('/admin/api/article/sync/prices/app/'+$rootScope.app.id, {articles: $scope.articles}).success(function(data){
            $rootScope.configuratorCurrent.step = 8;
        });
    };

});

smartApp.controller('ConfiguratorSelectSMSController', function (APIAppShopHasArticles, APIAppShops, APICountries, APIArticles, APIPayMethods, $scope, Utils, $rootScope, $http) {

    $scope.single = {article_category: { id: 'single_payment'}};
    $scope.empty = false;
    $scope.loading = true;

    APIAppShops.getByAppId($rootScope.app.id).success(function (data){
        $scope.appShops = data;
    });

    $scope.payMethodCustomsAvailableByCountry = null;

    APIAppShops.getByAppId($rootScope.app.id).success(function (data){
        $scope.tab = data[0].level_category;
        $scope.categories = data;
    });


    APIPayMethods.getSpecialsByAppId($rootScope.app.id).success(function (data){
        $scope.payMethodCustoms = data;

        APIArticles.getArticleByAppId($rootScope.app.id, 1, 1).success(function (data){
            $scope.articles = data;

            angular.forEach($scope.articles, function(article){
                angular.forEach(article.app_shop_has_articles, function(appShopHasArticle){
                    angular.forEach(appShopHasArticle.app_shop_article_has_p_m_p_cs, function(asahpmpc){
                        angular.forEach(asahpmpc.sms, function(sms){
                            appShopHasArticle['selected_sms_'+sms.id]=true;
                        });

                        if (asahpmpc.voice != undefined)
                            appShopHasArticle['selected_voice_'+ asahpmpc.voice.id]=true;
                    });
                });
            });


            APICountries.getByAppId($rootScope.app.id).success(function (countries){
                var toDelete = [];

                // delete countries with empty custom paymethods
                angular.forEach(countries, function(country){
                    if ($scope.payMethodSpecialByCurrentCountry(country.id) === null)
                        toDelete.push(country);
                });

                angular.forEach(toDelete, function(country){
                    countries.splice( countries.indexOf(country), 1 );
                });

                // end delete
                if ($scope.payMethodCustoms.length == 0 || countries.length == 0)
                {
                    $rootScope.configuratorCurrent.step = 9;
                    $scope.empty = true;
                    return;
                }

                $scope.countries = countries;
                $scope.countrySelected = $scope.countries[0];
                $scope.onChangeCountry($scope.countrySelected);
                $scope.loading = false;
            });

        });
    });

    $scope.onChangeCountry = function (country)
    {
        $scope.countrySelected = country;
        $scope.payMethodCustomsAvailableByCountry = $scope.payMethodSpecialByCurrentCountry(country.id);
        $scope.customsAvailableByCountryGrouped = groupPayMethodSpecial($scope.payMethodCustomsAvailableByCountry);
    };

    $scope.payMethodSpecialByCurrentCountry = function (countryId)
    {
        var result = [];
        angular.forEach($scope.payMethodCustoms, function(pm){
            angular.forEach(pm.pay_method_has_provider, function(pmp){
                angular.forEach(pmp.pay_method_provider_has_countries, function(pmpc){
                    if (pmp.is_our_implementation && pmpc.country.id === countryId && (pmpc.sms.length > 0 || pmpc.voice.length > 0)){
                        pmpc.img = pm.img;
                        result.push(pmpc);
                    }
                });
            });
        });



        return (result.length == 0 ? null : result);
    };

    function groupPayMethodSpecial(pmpcs)
    {
        function findIfSMSHaveSameAmountAndSameFee(smsE)
        {
            var val;
            angular.forEach(result, function(sms){
                if (sms.type=='sms' && sms.amount == smsE.amount && sms.fee_provider_percent == smsE.fee_provider_percent)
                    val = sms;
            });

            return val;
        }

        function findIfVoiceHaveSameAmountAndSameFee(voiceE)
        {
            var val;
            angular.forEach(result, function(voice){
                if (voice.type=='voice' && voice.amount == voiceE.amount && voice.fee_provider_percent == voiceE.fee_provider_percent)
                    val = voice;
            });

            return val;
        }

        var result = [], same;
        angular.forEach(pmpcs, function(pmpc){

            if (pmpc.sms)
            {
                angular.forEach(pmpc.sms, function(sms){

                    sms.fee_provider_percent = pmpc.fee_provider_percent;
                    sms.currency = pmpc.currency;
                    sms.type = 'sms';
                    sms.img = pmpc.img;

                    same = findIfSMSHaveSameAmountAndSameFee(sms);

                    if (same)
                    {
                        same.operator.name += ', '+ sms.operator.name;
                        if (typeof same.group == 'undefined')
                            same.group = [];

                        same.group.push(sms);
                    }else{
                        result.push(sms);
                    }

                });
            }

            if (pmpc.voice)
            {
                angular.forEach(pmpc.voice, function(voice){

                    voice.fee_provider_percent = pmpc.fee_provider_percent;
                    voice.currency = pmpc.currency;
                    voice.type = 'voice';
                    voice.img = pmpc.img;

                    same = findIfVoiceHaveSameAmountAndSameFee(voice);

                    if (same)
                    {
                        //same.operator.name += ', '+ sms.operator.name;
                        if (typeof same.group == 'undefined')
                            same.group = [];

                        same.group.push(voice);
                    }else{
                        result.push(voice);
                    }

                });
            }
        });

        return result;
    }

    $scope.checkboxSelectedPayMethod = function (appShopArticle, smsOrVoice, active, prefix){

        if (smsOrVoice.group)
        {
            angular.forEach(smsOrVoice.group, function(obj){
                appShopArticle[prefix + obj.id] = active;
            });
        }

    };

    $scope.submit = function (){
        $http.put('/admin/api/article/sync/special_pay_methods/app/'+$rootScope.app.id, {articles: $scope.articles}).success(function(data){
            $rootScope.configuratorCurrent.step = 9;
        });
    };

});

smartApp.controller('OfferContainerCtrl', function ($rootScope, $location, $scope, APIOffers, Utils,  alerts, localize, $routeParams, $filter) {

    $scope.$watch('app', function(newValue, oldValue) {
        if (newValue===oldValue)
            return;

        $location.path( "/configuration/offers/list" );
    });

    function exe(){
        $rootScope.offerCurrent = {};

        if (!$routeParams.id)
            $rootScope.offerCurrent = { step: 1, local_time: false, pretty_price: true, create: true };
        else{
            APIOffers.getByAppIdAndId($rootScope.app.id, $routeParams.id).success(function (data){
                $rootScope.offerCurrent = data;
                $rootScope.offerCurrent.update = true;
                $rootScope.offerCurrent.step = 5;
                $rootScope.offerCurrent.offer_to = new Date($rootScope.offerCurrent.offer_to);
                $rootScope.offerCurrent.offer_from = new Date($rootScope.offerCurrent.offer_from);
                $rootScope.offerCurrent.limit_purchases = $rootScope.offerCurrent.limit_purchases || 0;
                $rootScope.offerCurrent.limit_per_user = $rootScope.offerCurrent.limit_per_user || 0;

                Utils.selectAll($rootScope.offerCurrent.app_shops);
                Utils.selectAll($rootScope.offerCurrent.countries);
                Utils.selectAll($rootScope.offerCurrent.articles);

                angular.forEach($rootScope.offerCurrent.countries, function(value) {
                    value.continent.selected = true;
                });
            });
        }
    }



    $scope.goBack = function (step)
    {
        if (step < $rootScope.offerCurrent.step)
            $rootScope.offerCurrent.step = step;
    };

    $scope.sendOffer = function ()
    {
        if ($rootScope.offerCurrent.update)
        {
            APIOffers.update($rootScope.app.id, $rootScope.offerCurrent.id, $rootScope.offerCurrent.name, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops),
                    Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.countries), Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.articles),
                    $rootScope.offerCurrent.offer_from.toISOString(), $rootScope.offerCurrent.offer_to.toISOString(),
                    $rootScope.offerCurrent.local_time, $rootScope.offerCurrent.amount_percent_discount, $rootScope.offerCurrent.quantity_extra_percent,
                    $rootScope.offerCurrent.limit_purchases, $rootScope.offerCurrent.limit_per_user, $rootScope.offerCurrent.pretty_price
                )
                .success(function (data){
                    $rootScope.offerCurrent.create = false;
                    $rootScope.offerCurrent.update = true;
                    alerts.addInfo('action_completed');
                }).error(function(data, status, headers, config) {
                    if (status == 422)
                        alerts.addError(localize.localizeText('offer.conflicts_with_other_offer', {'%offer_name%': data.message.toString()}));
                });
        }else{
            APIOffers.insert($rootScope.app.id, $rootScope.offerCurrent.name, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops),
                    Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.countries), Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.articles),
                    $rootScope.offerCurrent.offer_from.toISOString(), $rootScope.offerCurrent.offer_to.toISOString(),
                    $rootScope.offerCurrent.local_time, $rootScope.offerCurrent.amount_percent_discount, $rootScope.offerCurrent.quantity_extra_percent,
                    $rootScope.offerCurrent.limit_purchases, $rootScope.offerCurrent.limit_per_user, $rootScope.offerCurrent.pretty_price
                )
                .success(function (data){
                    $rootScope.offerCurrent.id = data.id;
                    $rootScope.offerCurrent.create = false;
                    $rootScope.offerCurrent.update = true;
                    alerts.addInfo('action_completed');
                }).error(function(data, status, headers, config) {
                    if (status == 422)
                        alerts.addError(localize.localizeText('offer.conflicts_with_other_offer', {'%offer_name%': data.message.toString()}));
                });
        }

    };

    $scope.$on("$destroy", function() {
        delete $rootScope.offerCurrent;
    });

    exe();
})


smartApp.controller('OfferListCtrl', function ($rootScope, $scope, APIOffers, dialogs, Utils, alerts, localize) {

    $rootScope.$watch('app', function(newValue, oldValue) {
        if (newValue===oldValue)
            return;

        exe();
    });

    function exe(){
        APIOffers.getByAppId($rootScope.app.id).success(function (data){
            $scope.offers = data;
        });
    }

    $scope.delete = function (offerProgrammer) {
        var dlg = dialogs.confirm();
        dlg.result.then(function(btn){
            APIOffers.deleteById(offerProgrammer.id).success(function (data){
                $scope.offers.splice( $scope.offers.indexOf(offerProgrammer), 1 );
            });
        },function(btn){

        });
    };

    exe();
});

smartApp.controller('OfferSelectShopController', function ($scope, $rootScope, APIAppShops, Utils) {

    APIAppShops.getByAppId($rootScope.app.id).success(function(data){
        $rootScope.offerCurrent.app_shops = Utils.reselectPreviousSession1Level(data, $rootScope.offerCurrent.app_shops);
    });

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.app_shops, function(value) {
            if (value.selected)
                result = true;
        });

        return result;
    };

});

smartApp.controller('OfferSelectCountriesController', function ($scope, APICountries, $rootScope, Utils, $filter) {

    $scope.continents = {};
    $scope.search = {name: 'España'};

    var copyCountries = angular.copy($rootScope.offerCurrent.countries);

    APICountries.getByAppIdAndShops($rootScope.app.id, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops)).success(function(data){

        var countries = data;
        var continents = $filter('unique')(data, 'continent.id');
        // restore session if exist
        if (copyCountries)
        {
            var copyContinents = $filter('unique')(copyCountries, 'continent.id');

            angular.forEach(continents, function(country){

                angular.forEach(copyContinents, function(copyCountry){

                    if (copyCountry.continent.id == country.continent.id && copyCountry.continent.selected)
                        country.continent.selected = true;
                });
            });

            angular.forEach(countries, function(country){

                angular.forEach(copyCountries, function(copyCountry){

                    if (copyCountry.id == country.id && copyCountry.selected)
                    {
                        country.activate = true;
                        country.selected = true;
                    }
                });
            });

        }

        $rootScope.offerCurrent.countries = countries;
        $scope.continents = continents;

        $scope.updateSelectedCountries();
    });

    $scope.updateSelectedCountries = function(){
        var value;

        angular.forEach($rootScope.offerCurrent.countries, function(country) {
            value=false;
            angular.forEach($scope.continents, function(continent) {
                if (continent.continent && continent.continent.id == country.continent.id && continent.continent.selected)
                    value=true;
            });
            country.active = value;
        });


        angular.forEach($rootScope.offerCurrent.countries, function(country) {
            if (country.active == false)
                country.selected = false;
        });
    };

    $scope.addAllContinents = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
                value.continent.selected=true;
        });

        $scope.updateSelectedCountries();
    };

    $scope.removeAllContinents = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
            value.continent.selected=false;
        });

        $scope.updateSelectedCountries();
    };

    $scope.addAllCountriesAvailable = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
            if (value.active)
                value.selected=true;
        });
    };

    $scope.removeAllCountriesAvailable = function(){
        angular.forEach($rootScope.offerCurrent.countries, function(value) {
            value.selected=false;
        });
    };

    $scope.getCountries = function(){
        var result = [];
        angular.forEach($rootScope.offerCurrent.countries, function(country) {
            if (country.active)
                result.push(country);
        });

        return result;
    };

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.countries, function(value) {

            if (value.selected)
                result = true;
        });

        return result;
    };

    $scope.nextStep = function(){
        $rootScope.offerCurrent.step = 3;
    };
});

smartApp.controller('OfferSelectArticlesController', function ($scope, $rootScope, APIArticles, Utils, localize, $interpolate) {

    APIArticles.getByAppIdAndShopsAndCountries($rootScope.app.id, Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.app_shops),
            Utils.getCSVFromSelectedObjectsId($rootScope.offerCurrent.countries), localize.currentLang.langCode)
                .success(function(data){

                    $rootScope.offerCurrent.articles = Utils.reselectPreviousSession1Level(data, $rootScope.offerCurrent.articles);


    });

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.articles, function(value) {
            if (value.selected)
                result = true;
        });

        return result;
    };

    $scope.tableInfo = function (appShopHasArticles) {
        var th = [], td = [], x = 0, y=0;

        td[0] = [];
        td[0][0] = [];

        function searchIfExistById(array, search)
        {
            var result = false;

            angular.forEach(array, function(value, key) {

                if (value == search)
                    result = key;
            });

            return result;
        }

        function searchIfExistCountry(array, search)
        {
            var result = false;
            angular.forEach(array, function(value, key) {
                if (value[0] == search)
                    result = key;
            });

            return result;
        }

        angular.forEach(appShopHasArticles, function(appShopHasArticle) {


            var column = searchIfExistById(td[0], appShopHasArticle.app_shop.name)

            if (!column)
            {
                column = ++x;

                td[0][column] = []
                td[0][column].push(appShopHasArticle.app_shop.name);
            }

            row = searchIfExistCountry(td, appShopHasArticle.country.name);
            if (!row)
            {
                row = ++y;

                if (!td[row])
                    td[row] = [];

                if (!td[row][0])
                    td[row][0] = [];

                td[row][0].push(appShopHasArticle.country.name);
            }

            if (!td[row][column])
                td[row][column] = [];

            var text;
            if (typeof appShopHasArticle.current_amount_without_offer === "undefined")
                text = '-';
            else
                text = appShopHasArticle.current_amount_without_offer  + appShopHasArticle.country.currency.symbol;

            td[row][column].push(text);

        });

        var result = "<table style=''>", value;
        for(i=0; i<30; i++)
        {
            result+="<tr>";
            for(j=0; j<30; j++)
            {
                value = (td[i] ? td[i][j]|| (td[0][j] ? '-' : '') : '' );
                result+="<td style='"+(j==0 && td[i] ? 'border-right:1px dashed #ccc;' : '' )+(i==0 && td[0][j] ? 'border-bottom:1px dashed #ccc;' : '' ) +(td[i] && td[0][j] ? 'text-align:center;padding:3px 10px;': '')+"'>"+value+"</td>";
            }
            result+="</tr>";
        }
        result+="</table>";

        return result;
    }

});

smartApp.controller('OfferSelectTimeController', function ($scope, $rootScope) {

    $scope.minDate=new Date();

    $scope.someSelected = function () {

        var result = false;

        angular.forEach($rootScope.offerCurrent.appShops, function(value) {
            if (value.selected)
                result = true;
        });

        return result;
    };

});

smartApp.controller('OfferSelectOfferController', function ($scope, $rootScope) {

});

angular.module( 'ui.bootstrap.popover' )
    .directive("popoverHtmlUnsafePopup", function () {
        return {
            restrict: "EA",
            replace: true,
            scope: { title: "@", content: "@", placement: "@", animation: "&", isOpen: "&" },
            templateUrl: "template/popover/popover-html-unsafe-popup.html"
        };
    })

    .directive("popoverHtmlUnsafe", [ "$tooltip", function ($tooltip) {
        return $tooltip("popoverHtmlUnsafe", "popover", "click");
    }]);
smartApp.directive('clickOnce', function($timeout,localize,$rootScope,$compile) {
    $rootScope.loading = false;
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {

            var oldVal = element.html();

            $rootScope.$watch('loading', function(newValue, oldValue) {
                // timeout to not conflict with submit
                $timeout(function () {
                    if (newValue)
                    {
                        element.html(localize.localizeText('loading'));
                        element.attr('disabled', true);

                    }else{

                        element.html(oldVal);
                        element.attr('disabled', false);
                        $compile(element.contents())(scope);
                    }
                }, 0);
            });



            element.bind('click', function() {
                $rootScope.loading = true;
            });

        }
    };
});
smartApp.directive('datepick', function() {
    return {
        restrict: 'A',
        require : 'ngModel',
        link : function (scope, element, attrs, ngModelCtrl) {
            var maxDate, minDate;
            if (attrs.maxDate)
                maxDate = $( attrs.maxDate );
            if (attrs.minDate)
                minDate = $( attrs.minDate );


            function getDate(queryDate)
            {
                var dateParts = queryDate.match(/(\d+)/g);
                return  new Date(dateParts[0], dateParts[1] -1, dateParts[2], 0, 0, 0);
            }

            function isSameDay(dateToCheck, actualDate)
            {
                return (dateToCheck.getDate() == actualDate.getDate()
                    && dateToCheck.getMonth() == actualDate.getMonth()
                    && dateToCheck.getFullYear() == actualDate.getFullYear());
            }

            $(function(){
                element.datepicker({
                    dateFormat:'yy-mm-dd',
                    firstDay: 1 ,
                    numberOfMonths: 1,
                    beforeShowDay: function(date) {


                        // check if date is in your array of dates
                        var maxDateVal,minDateVal;
                        if (maxDate){
                            maxDateVal=getDate(maxDate.val())
                        }
                        if (minDate){
                            minDateVal=getDate(minDate.val())
                        }
                        if((maxDate && isSameDay(date, maxDateVal)) || (minDate && isSameDay(date, minDateVal))) {
                            return [true, 'css-class-to-highlight',null];
                        } else {

                            return [true, '', ''];
                        }
                    },
                    onClose: function( selectedDate ) {
                        if (maxDate)
                            maxDate.datepicker( "option", "minDate", selectedDate );

                        if (minDate)
                            minDate.datepicker( "option", "maxDate", selectedDate );

                    },
                    onSelect:function (date) {
                        scope.$apply(function () {
                            ngModelCtrl.$setViewValue(date);
                        });
                    }
                });

                if (maxDate)
                    element.datepicker( "option", "maxDate", maxDate.val() );

                if (minDate)
                    element.datepicker( "option", "minDate", minDate.val() );


            });
        }
    }
});
smartApp.directive('hasPermission', function(Permissions) {
    return {
        link: function(scope, element, attrs) {

            var value = attrs.hasPermission.trim();
            var notPermissionFlag = value[0] === '!';
            if(notPermissionFlag) {
                value = value.slice(1).trim();
            }

            function toggleVisibilityBasedOnPermission() {

                var hasPermission = Permissions.hasPermission(value);

                if(hasPermission && !notPermissionFlag || !hasPermission && notPermissionFlag)
                    element.show();
                else
                    element.hide();


            }
            toggleVisibilityBasedOnPermission();
            scope.$on('permissionsChanged', toggleVisibilityBasedOnPermission);
        }
    };
});
smartApp.factory('Sparkline' ,  function ($filter) {
    return {
        getCSVFromObject: function (obj){

            var result = '';

            $.each(obj, function(key, value) {
                if (key != 'total')
                    result +=String(value) +',';
            });
            if (result.length> 1)
                result = result.substring(0, result.length -1);

            return result;
        },
        getArrayFromArrayKey: function (obj, maxDataNum){

            maxDataNum = maxDataNum || 8;
            var result = [], i = 0;

            $.each(obj, function(key, value) {
                result.push(Math.round(value* 100) / 100);
                if (i >= maxDataNum)
                    result.shift();
                i++;
            });

            return result;
        }
    };
});

smartApp.directive('jqSparkline', [function () {
        'use strict';
        return {
            restrict: 'A',
            require: 'ngModel',
            link: function (scope, elem, attrs, ngModel) {

                var opts={};

                var opts={
                    type : attrs.type || 'bar',
                    barColor : $(elem).data('sparkline-bar-color') || $(elem).css('color') || '#0000f0',
                    height : '26px',
                    barWidth : 5,
                    barSpacing : 2,
                    stackedBarColor : '#A90329',
                    negBarColor : ["#A90329", "#0099c6", "#98AA56", "#da532c", "#4490B1", "#6E9461", "#990099", "#B4CAD3"],
                    zeroAxis : 'false'
                };

                var render = function () {
                    var model;

                    if(attrs.opts) angular.extend(opts, angular.fromJson(attrs.opts));

                    // Trim trailing comma if we are a string
                    angular.isString(ngModel.$viewValue) ? model = ngModel.$viewValue.replace(/(^,)|(,$)/g, "") : model = ngModel.$viewValue;
                    var data=model;
                    // Make sure we have an array of numbers
//                    angular.isArray(model) ? data = model : data = model.split(',');
                    if (data)
                    {
                        $(elem).sparkline(data, opts);
                    }


                };

                scope.$watch(attrs.ngModel, function () {
                    render();
                });

//                scope.$watch(attrs.opts, function(){
//                        render();
//                    }
//                );

            }
        }
    }]);
smartApp.directive('tableBelow', function() {
    return {
        restrict: 'E',
        templateUrl: '/bundles/app/client_admin/views/partials/table_below.html?v=', // markup for template
        scope: {
            data: '=', // allows data to be passed into directive from controller scope
            noHeader: '='
        }
    };
});

smartApp
    .directive('validFile',function(){
        return {
            require:'ngModel',
            link:function(scope,el,attrs,ngModel){

                //change event is fired when file is selected
                el.bind('change',function(){
                    scope.$apply(function(){
                        ngModel.$setViewValue(el.val());
                        ngModel.$render();
                    })
                })
            }
        }
    });
smartApp.filter('percentage', function($filter) {
    return function(input, decimals) {
        decimals = decimals || 2;
        return $filter('number')(input , decimals) + '%';
    }
});
smartApp.filter('api_translation', function(localize, $sce) {
    return function(array) {
        var result;
        angular.forEach(array, function(row, key){

            if (key.indexOf('_'+localize.currentLang.langCode) !== -1)
                result = row;
        });

        return $sce.trustAsHtml(result);
    }
});
smartApp.filter('http_code', function(localize, $sce) {
    return function(text, input) {
        if (text>=200 &&  text <300) {

            return $sce.trustAsHtml('<span class="label label-success">'+text+'</span>');
        }

        return $sce.trustAsHtml('<span class="label label-danger" data-localize="%s">'+text+'</span>');
    }
});
smartApp.filter('localize', function(localize) {
    return function(text, input) {

        return localize.localizeText(text);
    }
});
smartApp.filter('nl2br', function(localize, $sce) {
    return function(text, input) {
        return $sce.trustAsHtml(text.replace(/(?:\r\n|\r|\n)/g, '<br />'));
    }
});
smartApp.filter('numberIfItIsPossible', function($filter) {
    return function(text) {
        if (isNaN(text) || !text)
            return text;
        else
            return $filter('number')(text, 1);
    }
});
smartApp.filter("string.replace", [ function(){
    return function(str, pattern, replacement){
        try {
            return (str || '').replace(pattern,replacement);
        } catch(e) {
            console.error("error in string.replace", e);
            return (str || '');
        }
    }
}
]);
smartApp.filter('replace_our_vars', function(localize, $sce) {
    return function(str, number) {
        number = number || 'N#';
        return $sce.trustAsHtml((str.toString() || '').replace('{[{number}]}', number));
    }
});
smartApp.filter('transaction_status', function(localize, $sce) {
    return function(text, input) {
        text = parseInt(text);
        var textString, keyTranslation;

        if (text==1)
            keyTranslation= 'status_category.begin';
        else if (text ==25)
            keyTranslation= 'status_category.shopping';
        else if (text ==50)
            keyTranslation= 'status_category.processing';
        else if (text ==100)
            keyTranslation= 'status_category.pending';
        else if (text ==200)
            keyTranslation= 'status_category.completed';
        else if (text ==201)
            keyTranslation= 'status_category.subscription_active';
        else if (text ==500)
            keyTranslation= 'status_category.failed';
        else if (text ==700)
            keyTranslation= 'status_category.blocked';
        else if (text ==1000)
            keyTranslation= 'status_category.expired';


        if (text>=200 &&  text <300) {

            return $sce.trustAsHtml('<span class="label label-success" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }else if (text == 100){
            return $sce.trustAsHtml('<span class="label label-info" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }else if (text >= 300 && text < 1000){
            return $sce.trustAsHtml('<span class="label label-danger" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }else if (text >= 1000){
            return $sce.trustAsHtml('<span class="label label-warning" data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
        }

        return $sce.trustAsHtml('<span data-localize="'+keyTranslation+'">'+localize.localizeText(keyTranslation)+'</span>');
    }
});
smartApp.filter('true_false', function(localize, $sce) {
    return function(text, input) {
        var theme= '<span></span>';

        if (text) {
            if (input=='bootstrap')
                theme = '<span class="label label-success">%n</span>';

            return $sce.trustAsHtml(theme.replace("%n", "&#10004;"));
        }

        if (input=='bootstrap')
            theme = '<span class="label label-danger">%n</span>';

        return $sce.trustAsHtml(theme.replace("%n", localize.localizeText("&#10007;")));
    }
});
smartApp.filter('unique', function () {

    return function (items, filterOn) {

        if (filterOn === false) {
            return items;
        }

        if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {

            var hashCheck = {}, newItems = [];

            var extractValueToCompare = function (item) {

                if (angular.isObject(item) && angular.isString(filterOn)) {
                    var values = filterOn.split("."),temp=angular.copy(item);

                    angular.forEach(values, function (val) {
                        temp=temp[val];
                    });

                    return temp;
                } else {

                    return item;
                }
            };

            angular.forEach(items, function (item) {
                var valueToCheck, isDuplicate = false;

                for (var i = 0; i < newItems.length; i++) {

                    if (angular.equals(extractValueToCompare(newItems[i]), extractValueToCompare(item))) {
                        isDuplicate = true;
                        break;
                    }
                }
                if (!isDuplicate) {
                    newItems.push(item);
                }

            });
            items = newItems;
        }
        return items;
    };
});
smartApp.factory('alerts', ['$rootScope', '$timeout', 'localize', function ($rootScope, $timeout, localize) {

    return {
        addError: function (msg, title) {
            title = title || 'alerts.error';
            $.smallBox({
                title : localize.localizeText(title),
                content : localize.localizeText(msg),
                color : "#A65858",
                iconSmall : "fa fa-times bounce animated",
                timeout : 10000
            });
        },
        addWarning: function (msg, title) {
            title = title || 'alerts.warning';
            $.smallBox({
                title : localize.localizeText(title),
                content : localize.localizeText(msg),
                color : "#C79121",
                iconSmall : "fa fa-cloud bounce animated",
                timeout : 10000
            });
        },
        addInfo: function (msg, title) {
            title = title || 'alerts.info';
            $.smallBox({
                title : localize.localizeText(title),
                content : localize.localizeText(msg),
                color : "#739E73",
                iconSmall : "fa fa-thumbs-up bounce animated",
                timeout : 10000
            });
        }

    };
}]);
smartApp.factory('APIAppShopHasArticles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/app_shop_has_articles/app/'+appId);
        }
    };
}]);

smartApp.factory('APIAppShops' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/shops/app/'+appId);
        },
        getCategories: function (appId, available){
            appId = appId || $rootScope.app.id;
            available = available || '';
            return $http.get('/admin/api/app_shops_categories/'+appId+'?available='+available);
        }
    };
}]);

smartApp.factory('APIArticles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppIdAndShopsAndCountries: function (appId,shops,countries,locale){
            return $http.get('/admin/api/article/'+appId+'/'+shops+'/'+countries+'/'+locale);
        },
        getArticleByAppId: function (appId, pmpc, active){
            pmpc = pmpc || '';
            active = (active ? '&active=1' : '');
            return $http.get('/admin/api/article/app/'+appId+'?pmpc='+pmpc + active);
        }
    };
}]);

smartApp.factory('APICountries' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppIdAndShops: function (appId,shops){
            return $http.get('/admin/api/country/'+appId+'/'+shops);
        },
        updateByApp: function (appId, countries){
            return $http.put('/admin/api/country/'+appId, {countries: countries});
        },
        getByAppId: function (appId){
            return $http.get('/admin/api/country?app_id='+appId);
        },
        getCostOfLife: function (price, countryId, countryIdWanted){
            return $http.get('/admin/api/country/cost_of_life/'+price+'/'+countryId+'/'+countryIdWanted, { cache: true});
        },
        getExchange: function (price, countryId, countryIdWanted){
            return $http.get('/admin/api/country/exchange/'+price+'/'+countryId+'/'+countryIdWanted, { cache: true});
        },
        getAll: function (){
            return $http.get('/admin/api/country');
        },
        getAllByAppIdAvailable: function (appId){
            return $http.get('/admin/api/country?app_id='+appId+'&pmpc=1');
        }
    };
}]);

smartApp.factory('APICredentials' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId){
            appId = appId || $rootScope.app.id;

            return $http.get('/admin/api/credentials/'+appId);
        }
    };
}]);

smartApp.factory('APIItems' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/item/'+appId);
        },
        deleteById: function (itemId){
            return $http.delete('/admin/api/item/'+itemId);
        }
    };
}]);

smartApp.factory('APILanguages' , ['$http', function ($http) {
    return {
        getAll: function (appId){
            appId = appId || '';
            return $http.get('/admin/api/language?app_id='+appId);
        },
        updateByApp: function (appId, languages){
            return $http.put('/admin/api/language/'+appId, {languages: languages});
        }
    };
}]);

smartApp.factory('APINotifications' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId, dateFrom, dateTo, currencyId, page){
            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            page = page || 0;

            return $http.get('/admin/api/notifications/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page);
        }
    };
}]);

smartApp.factory('APIOffers' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function(appId){
            return $http.get('/admin/api/offer/'+appId);
        },
        getByAppIdAndId: function(appId, id){
            return $http.get('/admin/api/offer/'+appId+'/'+id);
        },
        insert: function (appId, name, appShopsIds, countriesIds, articles_ids, date_from, date_to, local_time, price, quantity_extra, limit_purchases, limit_per_user, pretty_price){

            return $http.post('/admin/api/offer/'+appId, {name: name, shops_ids: appShopsIds, countries: countriesIds,
                articles_ids: articles_ids, date_from: date_from, date_to: date_to, local_time: local_time, price:price,
                quantity_extra: quantity_extra, limit_purchases: limit_purchases, limit_per_user: limit_per_user,
                pretty_price: pretty_price
            });
        },
        update: function (appId, id, name, appShopsIds, countriesIds, articles_ids, date_from, date_to, local_time, price, quantity_extra, limit_purchases, limit_per_user, pretty_price){

            return $http.put('/admin/api/offer/'+appId+'/'+id, {name: name, shops_ids: appShopsIds, countries: countriesIds,
                articles_ids: articles_ids, date_from: date_from, date_to: date_to, local_time: local_time, price:price,
                quantity_extra: quantity_extra, limit_purchases: limit_purchases, limit_per_user: limit_per_user,
                pretty_price: pretty_price
            });
        },
        deleteById: function (id){
            return $http.delete('/admin/api/offer/'+id);
        }
    };
}]);

smartApp.factory('APIPayMethods' , ['$http', function ($http) {
    return {
        getAll: function (app){
            return $http.get('/admin/api/pay_methods/', { cache: true});
        },
        getByAppId: function (appId, active){
            active = active ? 'active=1' : '';
            return $http.get('/admin/api/pay_methods/app/'+appId+'?'+active );
        },
        getSpecialsByAppId: function (appId){
            return $http.get('/admin/api/pay_methods/specials/app/'+appId);
        }
    };
}]);

smartApp.factory('APIPayMethodProviderHasCountry' , ['$http', function ($http) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/pay_methods_provider_has_country_special/app/app/'+appId);
        }
    };
}]);

smartApp.factory('APIPurchases' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId, dateFrom, dateTo, currencyId, page){
            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            page = page || 0;

            return $http.get('/admin/api/purchases/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page);
        }
    };
}]);

smartApp.factory('APIRoles' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId){
            appId = appId || $rootScope.app.id;

            return $http.get('/admin/api/roles/'+appId);
        }
    };
}]);

smartApp.factory('APIShopTemplates' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/shop_templates/app/'+appId);
        }

    };
}]);

smartApp.factory('APIItems' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getByAppId: function (appId){
            return $http.get('/admin/api/item/'+appId);
        },
        deleteById: function (itemId){
            return $http.delete('/admin/api/item/'+itemId);
        }
    };
}]);

smartApp.factory('APIStats' , ['$http', '$rootScope', 'Utils', function ($http, $rootScope, Utils) {
    return {
        getByApp: function (appId, dateFormatResult, dateFrom, dateTo, currencyId){

            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'months';

            return $http.get('/admin/api/stats/app/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getAll: function (appIds, dateFormatResult, dateFrom, dateTo, currencyId){
            appIds = appIds || Utils.getCSVFromObjectId($rootScope.apps);
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'months';

            return $http.get('/admin/api/stats/apps/'+appIds+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        },
        getPayMethods: function (appIds, dateFormatResult, dateFrom, dateTo, currencyId){
            appIds = appIds || Utils.getCSVFromObjectId($rootScope.apps);
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            dateFormatResult = dateFormatResult || 'months';

            return $http.get('/admin/api/stats/pay_methods/apps/'+appIds+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'/'+dateFormatResult);
        }
    };
}]);

smartApp.factory('APISubscription' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getActives: function (appId, dateFrom, dateTo, currencyId, page){
            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            page = page || 0;

            return $http.get('/admin/api/active-subscriptions/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page);
        },
        cancelById: function (subscriptionId, reason, appId){
            appId = appId || $rootScope.app.id;
            reason = reason || '';

            return $http.post('/admin/api/active-subscriptions/cancel/'+appId+'/'+subscriptionId, {reason: reason});
        }
    };
}]);

smartApp.factory('APITransactions' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (appId, dateFrom, dateTo, currencyId, page){
            appId = appId || $rootScope.app.id;
            dateFrom = dateFrom || $rootScope.dateFrom.toISOString();
            dateTo = dateTo || $rootScope.dateTo.toISOString();
            currencyId = currencyId || $rootScope.currency.id;
            page = page || 0;

            return $http.get('/admin/api/transactions/'+appId+'/'+dateFrom+'/'+dateTo+'/'+currencyId+'?page='+page);
        }
    };
}]);

smartApp.factory('APIUserNotifications' , ['$http', '$rootScope', function ($http, $rootScope) {
    return {
        getAll: function (){

            return $http.get('/admin/api/notify/notifications');
        },
        setReadById: function (clientUserNotificationId){
            return $http.get('/admin/api/notify/notifications/read/'+clientUserNotificationId);
        }
    };
}]);

smartApp.factory('dialogs', ['$rootScope', '$timeout', '$modal', function ($rootScope, $timeout, $modal) {

    var _b = true; // backdrop
    var _k = true; // keyboard
    var _w = 'dialogs-default'; // windowClass
    var _copy = true; // controls use of angular.copy
    var _wTmpl = null; // window template
    var _wSize = 'lg'; // large modal window default

    var _setOpts = function(opts){
        var _opts = {};
        opts = opts || {};
        _opts.kb = (angular.isDefined(opts.keyboard)) ? opts.keyboard : _k; // values: true,false
        _opts.bd = (angular.isDefined(opts.backdrop)) ? opts.backdrop : _b; // values: 'static',true,false
        _opts.ws = (angular.isDefined(opts.size) && (angular.equals(opts.size,'sm') || angular.equals(opts.size,'lg') || angular.equals(opts.size,'md'))) ? opts.size : _wSize; // values: 'sm', 'lg', 'md'
        _opts.wc = (angular.isDefined(opts.windowClass)) ? opts.windowClass : _w; // additional CSS class(es) to be added to a modal window

        return _opts;
    };

    return {
        confirm : function(header,msg,opts){
            opts = _setOpts(opts);

            return $modal.open({
                templateUrl : '/dialogs/confirm.html',
                controller : 'confirmDialogCtrl',
                backdrop: opts.bd,
                keyboard: opts.kb,
                windowClass: opts.wc,
                size: opts.ws,
                resolve : {
                    data : function(){
                        return {
                            header : angular.copy(header),
                            msg : angular.copy(msg)
                        };
                    }
                }
            }); // end modal.open
        }
    };
}])
    .run(['$templateCache','$interpolate', 'localize', function($templateCache, $interpolate, localize){

//        $templateCache.put('/dialogs/error.html','<div class="modal-header dialog-header-error"><button type="button" class="close" ng-click="close()">&times;</button><h4 class="modal-title text-danger"><span class="glyphicon glyphicon-warning-sign"></span> <span ng-bind-html="header"></span></h4></div><div class="modal-body text-danger" ng-bind-html="msg"></div><div class="modal-footer"><button type="button" class="btn btn-default" ng-click="close()">'+startSym+'"DIALOGS_CLOSE" | translate'+endSym+'</button></div>');
//        $templateCache.put('/dialogs/wait.html','<div class="modal-header dialog-header-wait"><h4 class="modal-title"><span class="glyphicon glyphicon-time"></span> '+startSym+'header'+endSym+'</h4></div><div class="modal-body"><p ng-bind-html="msg"></p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" ng-style="getProgress()"></div><span class="sr-only">'+startSym+'progress'+endSym+''+startSym+'"DIALOGS_PERCENT_COMPLETE" | translate'+endSym+'</span></div></div>');
//        $templateCache.put('/dialogs/notify.html','<div class="modal-header dialog-header-notify"><button type="button" class="close" ng-click="close()" class="pull-right">&times;</button><h4 class="modal-title text-info"><span class="glyphicon glyphicon-info-sign"></span> '+startSym+'header'+endSym+'</h4></div><div class="modal-body text-info" ng-bind-html="msg"></div><div class="modal-footer"><button type="button" class="btn btn-primary" ng-click="close()">'+startSym+'"DIALOGS_OK" | translate'+endSym+'</button></div>');
        $templateCache.put('/dialogs/confirm.html','<div class="modal-header dialog-header-confirm"><button type="button" class="close" ng-click="no()">&times;</button><h4 class="modal-title"><span class="glyphicon glyphicon-check"></span> {[{header | localize }]}</h4></div><div class="modal-body">{[{msg | localize }]}</div><div class="modal-footer"><button type="button" class="btn btn-default" ng-click="yes()">{[{ "yes" | localize }]}</button><button type="button" class="btn btn-primary" ng-click="no()">{[{ "no" | localize }]}</button></div>');
    }]) // end run / dialogs.main
    .controller('confirmDialogCtrl',['$scope','$modalInstance','data',function($scope,$modalInstance,data){
    //-- Variables -----//

    $scope.header = (angular.isDefined(data.header)) ? data.header : 'dialog.are_u_sure_title_default';
    $scope.msg = (angular.isDefined(data.msg)) ? data.msg : 'dialog.are_u_sure_desc_default';

    //-- Methods -----//

    $scope.no = function(){
        $modalInstance.dismiss('no');
    }; // end close

    $scope.yes = function(){
        $modalInstance.close('yes');
    }; // end yes
}]);
;
smartApp.factory('Flot' ,  function () {
    return {
        parseArrayKey: function (obj, format){

            var result = [], time;
            format = format || 'months';

            $.each(obj, function(key, value) {

                if (format == 'weeks')
            {
                    time = Date.UTC(parseInt(key.substring(0, 4)), 0, 1) + ((24*60*60*1000) * (parseInt(key.substring(5))*7));

                }else if (format == 'days')
                    time = Date.UTC(key.substring(0, 4), key.substring(5, 7)-1, key.substring(8, 10));
                else
                {
                    time = Date.UTC(key.substring(0, 4), key.substring(5, 7)-1);
                }


                result.push([time, value]);
            });


            return result;
        },
        parseArrayKeyText: function (obj, label, data){

            var result = [];

            $.each(obj, function(key, value) {
                result.push({label: value[label], data: parseInt(value[data])});
            });

            return result;
        },
        getColors: function ()
        {
            return ['#3276B1', '#71843F', '#BD0000', '#F5DB31', '#666666', '#EE9A49' , '#00F5FF', '#C6E2FF', '#98FB98'];
        }
    };
});
smartApp.factory('HttpInterceptor', [ '$q' , '$log', '$location',  function ($q, $log, $location) {

    return {
        request: function (config) {

            $log.debug('REQUEST', config.url);

            return config;
        },
        response: function(response) {

            $log.debug('RESPONSE', response);
            // Session expired
            if (typeof response.data === "string" && response.data.indexOf("login_check") !== -1) {
                $.root_.addClass('animated fadeOutUp');
                setTimeout(function(){window.location.replace("/admin/");}, 1000);
            }

            return response;
        },
        responseError: function (response) {

//            if (response.status===403)
//                $location.path('/');

            $log.error('RESPONSE ERROR', response);

            return $q.reject(response);
        }
    };

}]);
smartApp.factory('Permissions' ,  function ($rootScope) {

    var permissionList;

    return {
        setPermissions: function(permissions) {
            permissionList = permissions;
            $rootScope.$broadcast('permissionsChanged');
        },
        getPermissions: function(){
            return permissionList;
        },
        hasPermission: function (permission){

            if (!permissionList)
                return false;

            permission = permission.trim();
            if (permissionList.indexOf(permission) == -1)
                return false;

            return true;
        }
    };
});
smartApp.factory('tableBelow' ,  function ($filter) {
    return {
        createObjectByBarChart: function (arrObject, dateFormat, suffix){

            suffix = suffix || '';

            var result = [];
            var firstRow = [];

            firstRow.push('');
            angular.forEach(arrObject, function(data) {
                firstRow.push(data.title.toString());
            });

            result.push(firstRow);

            var found = [];

            if (typeof arrObject[0] == 'undefined')
                return result;

            angular.forEach(arrObject[0].data, function(data, key) {
                var temp = [];
                temp.push(key);
                angular.forEach(arrObject, function(app) {
                    angular.forEach(app.data, function(appVal, appRow) {
                        if (key == appRow)
                            temp.push($filter('number')(appVal, 1)+suffix);
                    });
                });
                result.push(temp);
            });

            return result;

        },
        createObjectByPieChart: function (arrObject, suffix){

            var result = [];
            suffix = suffix || '';

            angular.forEach(arrObject, function(value, key) {
                var temp = [];

                temp.push(value.label);
                temp.push($filter('number')(value.data, 1)+suffix);

                result.push(temp);
            });

            return result;

        },
        createObjectByPieChartSimple: function (arrObject){

            var result = [];

            angular.forEach(arrObject, function(value, key) {
                var temp = [];

                temp.push(key);
                temp.push(value);

                result.push(temp);
            });

            return result;
        }
    };
});

smartApp.factory('Utils' ,  function () {
    return {
        getCSVFromObjectId: function (obj){

            var result='';
            angular.forEach(obj, function(item){

                result +=String(item.id) +',';
            });

            if (result.length> 1)
                result = result.substring(0, result.length -1);

            return result;

        },
        getCSVFromSelectedObjectsId: function (obj){

            var result='';
            angular.forEach(obj, function(item){
                if (item.selected)
                    result +=String(item.id) +',';
            });

            if (result.length> 1)
                result = result.substring(0, result.length -1);

            return result;
        },
        findStringById: function (obj, id, equal, result){
            var resultx;

            angular.forEach(obj, function(item){
                if (item[id] == equal)
                    resultx = item[result];
            });
            return resultx;
        },
        findObjectById: function (obj, id, equal){
            var resultx;
            angular.forEach(obj, function(item){
                if (item[id] == equal)
                    resultx = item;
            });
            return resultx;
        },
        selectAll: function(obj){
            angular.forEach(obj, function(item){
                item.selected=true;
            });
        },
        selectedRemoveAll: function(obj){
            angular.forEach(obj, function(item){
                item.selected=false;
            });
        },
        reselectPreviousSession1Level: function (obj1New, obj2Previous){

            if (!obj2Previous)
                return obj1New;

            angular.forEach(obj1New, function(newItem){
                angular.forEach(obj2Previous, function(previousItem){
                    if (newItem.id == previousItem.id && previousItem.selected)
                        newItem.selected = true;
                });
            });

            return obj1New;
        }
    };
});

// APP DIRECTIVES
// main directives
angular.module('app.main', [])
    // initiate body
    .directive('body', function () {
        return {
            restrict: 'E',
            link: function (scope, element, attrs) {
                element.on('click', 'a[href="#"], [data-toggle]', function (e) {
                    e.preventDefault();
                })
            }
        }
    })

    .factory('ribbon', ['$rootScope', function ($rootScope) {
        var ribbon = {
            currentBreadcrumb: [],
            updateBreadcrumb: function (crumbs) {
                crumbs.push('Home');
                var breadCrumb = crumbs.reverse();
                ribbon.currentBreadcrumb = breadCrumb;
                $rootScope.$broadcast('navItemSelected', breadCrumb);
            }
        };

        return ribbon;
    }])

    .directive('action', function (localize) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                /*
                 * SMART ACTIONS
                 */
                var smartActions = {

                    // LOGOUT MSG
                    userLogout: function ($this) {
                        var no = localize.localizeText("no"),
                            yes = localize.localizeText("yes");
                        // ask verification
                        $.SmartMessageBox({
                            title: "<i class='fa fa-sign-out txt-color-orangeDark'></i> "+localize.localizeText("logout")+" <span class='txt-color-orangeDark'><strong>" + $('#show-shortcut').text() + "</strong></span> ?",
                            content: localize.localizeText("logout_extra"),
                            buttons: '['+no+']['+yes+']'

                        }, function (ButtonPressed) {
                            if (ButtonPressed == yes) {
                                $.root_.addClass('animated fadeOutUp');
                                setTimeout(logout, 1000);
                            }
                        });
                        function logout() {
                            window.location = $this.attr('href');
                        }

                    },

                    // RESET WIDGETS
                    resetWidgets: function ($this) {
                        $.widresetMSG = $this.data('reset-msg');
                        var no = localize.localizeText("no"),
                            yes = localize.localizeText("yes");
                        $.SmartMessageBox({
                            title: "<i class='fa fa-refresh' style='color:green'></i> "+localize.localizeText("clear_storage"),
                            content: $.widresetMSG || localize.localizeText("clear_storage_extra"),
                            buttons: '['+no+']['+yes+']'
                        }, function (ButtonPressed) {
                            if (ButtonPressed == yes && localStorage) {
                                localStorage.clear();
                                location.reload();
                            }

                        });
                    },

                    // LAUNCH FULLSCREEN
                    launchFullscreen: function (element) {

                        if (!$.root_.hasClass("full-screen")) {

                            $.root_.addClass("full-screen");

                            if (element.requestFullscreen) {
                                element.requestFullscreen();
                            } else if (element.mozRequestFullScreen) {
                                element.mozRequestFullScreen();
                            } else if (element.webkitRequestFullscreen) {
                                element.webkitRequestFullscreen();
                            } else if (element.msRequestFullscreen) {
                                element.msRequestFullscreen();
                            }

                        } else {

                            $.root_.removeClass("full-screen");

                            if (document.exitFullscreen) {
                                document.exitFullscreen();
                            } else if (document.mozCancelFullScreen) {
                                document.mozCancelFullScreen();
                            } else if (document.webkitExitFullscreen) {
                                document.webkitExitFullscreen();
                            }

                        }

                    },

                    // MINIFY MENU
                    minifyMenu: function ($this) {
                        if (!$.root_.hasClass("menu-on-top")) {
                            $.root_.toggleClass("minified");
                            $.root_.removeClass("hidden-menu");
                            $('html').removeClass("hidden-menu-mobile-lock");
                            $this.effect("highlight", {}, 500);
                        }
                    },

                    // TOGGLE MENU
                    toggleMenu: function () {
                        if (!$.root_.hasClass("menu-on-top")) {
                            $('html').toggleClass("hidden-menu-mobile-lock");
                            $.root_.toggleClass("hidden-menu");
                            $.root_.removeClass("minified");
                        } else if ($.root_.hasClass("menu-on-top") && $.root_.hasClass("mobile-view-activated")) {
                            $('html').toggleClass("hidden-menu-mobile-lock");
                            $.root_.toggleClass("hidden-menu");
                            $.root_.removeClass("minified");
                        }
                    },

                    // TOGGLE SHORTCUT
                    toggleShortcut: function () {

                        if (shortcut_dropdown.is(":visible")) {
                            shortcut_buttons_hide();
                        } else {
                            shortcut_buttons_show();
                        }

                        // SHORT CUT (buttons that appear when clicked on user name)
                        shortcut_dropdown.find('a').click(function (e) {
                            e.preventDefault();
                            window.location = $(this).attr('href');
                            setTimeout(shortcut_buttons_hide, 300);

                        });

                        // SHORTCUT buttons goes away if mouse is clicked outside of the area
                        $(document).mouseup(function (e) {
                            if (!shortcut_dropdown.is(e.target) && shortcut_dropdown.has(e.target).length === 0) {
                                shortcut_buttons_hide();
                            }
                        });

                        // SHORTCUT ANIMATE HIDE
                        function shortcut_buttons_hide() {
                            shortcut_dropdown.animate({
                                height: "hide"
                            }, 300, "easeOutCirc");
                            $.root_.removeClass('shortcut-on');

                        }

                        // SHORTCUT ANIMATE SHOW
                        function shortcut_buttons_show() {
                            shortcut_dropdown.animate({
                                height: "show"
                            }, 200, "easeOutCirc");
                            $.root_.addClass('shortcut-on');
                        }

                    }

                };

                var actionEvents = {
                    userLogout: function (e) {
                        smartActions.userLogout(element);
                    },
                    resetWidgets: function (e) {
                        smartActions.resetWidgets(element);
                    },
                    launchFullscreen: function (e) {
                        smartActions.launchFullscreen(document.documentElement);
                    },
                    minifyMenu: function (e) {
                        smartActions.minifyMenu(element);
                    },
                    toggleMenu: function (e) {
                        smartActions.toggleMenu();
                    },
                    toggleShortcut: function (e) {
                        smartActions.toggleShortcut();
                    }
                };

                if (angular.isDefined(attrs.action) && attrs.action != '') {
                    var actionEvent = actionEvents[attrs.action];
                    if (typeof actionEvent === 'function') {
                        element.on('click', function (e) {
                            actionEvent(e);
                            e.preventDefault();
                        });
                    }
                }

            }
        };
    })

    .directive('header', function () {
        return {
            restrict: 'EA',
            link: function (scope, element, attrs) {
                // SHOW & HIDE MOBILE SEARCH FIELD
                angular.element('#search-mobile').click(function () {
                    $.root_.addClass('search-mobile');
                });

                angular.element('#cancel-search-js').click(function () {
                    $.root_.removeClass('search-mobile');
                });
            }
        };
    })

    .controller('breadcrumbController', ['$scope', function ($scope) {
        $scope.breadcrumbs = [];
        $scope.$on('navItemSelected', function (name, crumbs) {
            $scope.setBreadcrumb(crumbs);
        });

        $scope.setBreadcrumb = function (crumbs) {
            $scope.breadcrumbs = crumbs;
        }
    }])

    .directive('breadcrumb', ['ribbon', 'localize', '$compile', function (ribbon, localize, $compile) {
        return {
            restrict: 'AE',
            controller: 'breadcrumbController',
            replace: true,
            link: function (scope, element, attrs) {
                scope.$watch('breadcrumbs', function (newVal, oldVal) {
                    if (newVal !== oldVal) {
                        // update DOM
                        scope.updateDOM();
                    }
                })
                scope.updateDOM = function () {
                    element.empty();
                    angular.forEach(scope.breadcrumbs, function (crumb) {
                        var li = angular.element('<li data-localize="' + crumb + '">' + crumb + '</li>');
                        li.text(localize.localizeText(crumb));

                        $compile(li)(scope);
                        element.append(li);
                    });
                };

                // set the current breadcrumb on load
                scope.setBreadcrumb(ribbon.currentBreadcrumb);
                scope.updateDOM();
            },
            template: '<ol class="breadcrumb"></ol>'
        }
    }])
;

// directives for localization
angular.module('app.localize', [])

    .factory('localize', ['$http', '$rootScope', '$window', '$sce', function ($http, $rootScope, $window, $sce) {
        var localize = {
            defaultCallBack: {},
            currentLocaleData: {},
            currentLang: {},
            setLang: function (lang) {
                $http({method: 'GET', url: localize.getLangUrl(lang), cache: false})
                    .success(function (data) {
                        localStorage.setItem('language-'+$rootScope.usernameId, JSON.stringify(lang));
                        localize.currentLocaleData = data;
                        localize.currentLang = lang;
                        $rootScope.$broadcast('localizeLanguageChanged');
                    }).error(function (data) {
                        console.log('Error updating language!');
                    })
            },
            getLangUrl: function (lang) {

                return '/translations/g/admin/' + lang.langCode + '.js';
            },

            localizeText: function (sourceText, replaceText) {
                var result;
                replaceText = replaceText || {};

                if (localize.currentLocaleData[sourceText])
                    result = localize.currentLocaleData[sourceText];
                else if (localize.defaultCallBack[sourceText]) // callback
                    result =  localize.defaultCallBack[sourceText];
                else
                    result = sourceText;

                angular.forEach(replaceText, function(value, key) {
                    result = result.replace(key, value);
                });

                return result;
            }
        };

        $http({method: 'GET', url: localize.getLangUrl({langCode: 'en'}), cache: false})
            .success(function (data) {
                localize.defaultCallBack = data;
            }).error(function (data) {
                console.log('Error updating language!');
            });

        return localize;
    }])

    .directive('localize', ['localize', function (localize) {
        return {
            restrict: 'A',
            scope: {
                sourceText: '@localize'
            },
            link: function (scope, element, attrs) {

                function execute(scope){
                    var localizedText = localize.localizeText(scope.sourceText);
                    if (element.is('input, textarea')) element.attr('placeholder', localizedText)
                    else element.text(localizedText);
                }

                scope.$on('localizeLanguageChanged', function () {
                    execute(scope);
                });

                execute(scope);
            }
        }
    }])
;

// directives for navigation
angular.module('app.navigation', [])
    .directive('navigation', function () {
        return {
            restrict: 'AE',
            controller: ['$scope', function ($scope) {

            }],
            transclude: true,
            replace: true,
            link: function (scope, element, attrs) {

                element.first().jarvismenu({
                    accordion: true,
                    speed: $.menu_speed,
                    closedSign: '<em class="fa fa-plus-square-o"></em>',
                    openedSign: '<em class="fa fa-minus-square-o"></em>'
                });

                // SLIMSCROLL FOR NAV
                if ($.fn.slimScroll) {
                    element.slimScroll({
                        height: '100%'
                    });
                }

                scope.getElement = function () {
                    return element;
                }
            },
            template: '<nav><ul data-ng-transclude=""></ul></nav>'
        };
    })

    .controller('NavGroupController', ['$scope', function ($scope) {
        $scope.active = false;
        $scope.hasIcon = angular.isDefined($scope.icon);
        $scope.hasIconCaption = angular.isDefined($scope.iconCaption);

        this.setActive = function (active) {
            $scope.active = active;
        }

    }])
    .directive('navGroup', function () {
        return {
            restrict: 'AE',
            controller: 'NavGroupController',
            transclude: true,
            replace: true,
            scope: {
                icon: '@',
                title: '@',
                iconCaption: '@',
                active: '=?'
            },
            template: '\
				<li data-ng-class="{active: active}">\
					<a href="" title="{{title | localize}}">\
						<i data-ng-if="hasIcon" class="{{ icon }}"><em data-ng-if="hasIconCaption"> {{ iconCaption }} </em></i>\
						<span class="menu-item-parent" data-localize="{{ title }}">{{ title }}</span>\
					</a>\
					<ul data-ng-transclude=""></ul>\
				</li>'

        };
    })

    .controller('NavItemController', ['$rootScope', '$scope', '$location', function ($rootScope, $scope, $location) {
        $scope.isChild = false;
        $scope.active = false;
        $scope.isActive = function (viewLocation) {
            $scope.active = viewLocation === $location.path();
            return $scope.active;
        };

        $scope.hasIcon = angular.isDefined($scope.icon);
        $scope.hasIconCaption = angular.isDefined($scope.iconCaption);

        $scope.getItemUrl = function (view) {
            if (angular.isDefined($scope.href)) return $scope.href;
            if (!angular.isDefined(view)) return '';
            return '#' + view;
        };

        $scope.getItemTarget = function () {
            return angular.isDefined($scope.target) ? $scope.target : '_self';
        };

    }])
    .directive('navItem', ['ribbon', '$window', 'localize', function (ribbon, $window, localize) {
        return {
            require: ['^navigation', '^?navGroup'],
            restrict: 'AE',
            controller: 'NavItemController',
            scope: {
                title: '@',
                view: '@',
                icon: '@',
                iconCaption: '@',
                href: '@',
                target: '@'
            },
            link: function (scope, element, attrs, parentCtrls) {
                var navCtrl = parentCtrls[0],
                    navgroupCtrl = parentCtrls[1]

                scope.$watch('active', function (newVal, oldVal) {
                    if (newVal) {
                        if (angular.isDefined(navgroupCtrl)) navgroupCtrl.setActive(true);
                        $window.document.title = localize.localizeText(scope.title);
                        $('title').attr('data-localize',scope.title)
                        scope.setBreadcrumb();
                    } else {
                        if (angular.isDefined(navgroupCtrl)) navgroupCtrl.setActive(false);
                    }
                });

                scope.openParents = scope.isActive(scope.view);
                scope.isChild = angular.isDefined(navgroupCtrl);

                scope.setBreadcrumb = function () {
                    var crumbs = [];
                    crumbs.push(localize.localizeText(scope.title));
                    // get parent menus
                    var test = element.parents('nav li').each(function () {
                        var el = angular.element(this);
                        var parent = el.find('.menu-item-parent:eq(0)');
                        crumbs.push(parent.data('localize').trim());
                        if (scope.openParents) {
                            // open menu on first load
                            parent.trigger('click');
                        }
                    });
                    // this should be only fired upon first load so let's set this to false now
                    scope.openParents = false;
                    ribbon.updateBreadcrumb(crumbs);
                };

                element.on('click', 'a[href!="#"]', function () {
                    if ($.root_.hasClass('mobile-view-activated')) {
                        $.root_.removeClass('hidden-menu');
                        $('html').removeClass("hidden-menu-mobile-lock");
                    }
                });

            },
            transclude: true,
            replace: true,
            template: '\
				<li data-ng-class="{active: isActive(view)}">\
					<a href="{{ getItemUrl(view) }}" target="{{ getItemTarget() }}" title="{{ title | localize }}">\
						<i data-ng-if="hasIcon" class="{{ icon }}"><em data-ng-if="hasIconCaption"> {{ iconCaption }} </em></i>\
						<span ng-class="{\'menu-item-parent\': !isChild}" data-localize="{{ title }}"> {{ title }} </span>\
						<span data-ng-transclude=""></span>\
					</a>\
				</li>'
        };
    }])
;

angular.module('app.smartui', [])
    .directive('widgetGrid', function () {
        return {
            restrict: 'AE',
            link: function (scope, element, attrs) {
                scope.setup_widget_desktop = function () {
                    if ($.fn.jarvisWidgets && $.enableJarvisWidgets) {
                        element.jarvisWidgets({
                            grid: 'article',
                            widgets: '.jarviswidget',
                            localStorage: true,
                            deleteSettingsKey: '#deletesettingskey-options',
                            settingsKeyLabel: 'Reset settings?',
                            deletePositionKey: '#deletepositionkey-options',
                            positionKeyLabel: 'Reset position?',
                            sortable: true,
                            buttonsHidden: false,
                            // toggle button
                            toggleButton: true,
                            toggleClass: 'fa fa-minus | fa fa-plus',
                            toggleSpeed: 200,
                            onToggle: function () {
                            },
                            // delete btn
                            deleteButton: true,
                            deleteClass: 'fa fa-times',
                            deleteSpeed: 200,
                            onDelete: function () {
                            },
                            // edit btn
                            editButton: true,
                            editPlaceholder: '.jarviswidget-editbox',
                            editClass: 'fa fa-cog | fa fa-save',
                            editSpeed: 200,
                            onEdit: function () {
                            },
                            // color button
                            colorButton: true,
                            // full screen
                            fullscreenButton: true,
                            fullscreenClass: 'fa fa-expand | fa fa-compress',
                            fullscreenDiff: 3,
                            onFullscreen: function () {
                            },
                            // custom btn
                            customButton: false,
                            customClass: 'folder-10 | next-10',
                            customStart: function () {
                                alert('Hello you, this is a custom button...');
                            },
                            customEnd: function () {
                                alert('bye, till next time...');
                            },
                            // order
                            buttonOrder: '%refresh% %custom% %edit% %toggle% %fullscreen% %delete%',
                            opacity: 1.0,
                            dragHandle: '> header',
                            placeholderClass: 'jarviswidget-placeholder',
                            indicator: true,
                            indicatorTime: 600,
                            ajax: true,
                            timestampPlaceholder: '.jarviswidget-timestamp',
                            timestampFormat: 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
                            refreshButton: true,
                            refreshButtonClass: 'fa fa-refresh',
                            labelError: 'Sorry but there was a error:',
                            labelUpdated: 'Last Update:',
                            labelRefresh: 'Refresh',
                            labelDelete: 'Delete widget:',
                            afterLoad: function () {
                            },
                            rtl: false, // best not to toggle this!
                            onChange: function () {

                            },
                            onSave: function () {

                            },
                            ajaxnav: $.navAsAjax // declears how the localstorage should be saved (HTML or AJAX page)

                        });
                    }
                }

                scope.setup_widget_mobile = function () {
                    if ($.enableMobileWidgets && $.enableJarvisWidgets) {
                        scope.setup_widgets_desktop();
                    }
                }

                if ($.device === "desktop") {
                    scope.setup_widget_desktop();
                } else {
                    scope.setup_widget_mobile();
                }

            }
        }
    })

    .directive('widget', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="jarviswidget" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetHeader', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            scope: {
                title: '@',
                icon: '@'
            },
            template: '\
				<header>\
					<span class="widget-icon"> <i data-ng-class="icon"></i> </span>\
					<h2 data-localize="{{ title }}"></h2>\
					<span data-ng-transclude></span>\
				</header>'
        }
    })

    .directive('widgetToolbar', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="widget-toolbar" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetEditbox', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="jarviswidget-editbox" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetBody', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div data-ng-transclude=""></div>'
        }
    })

    .directive('widgetBodyToolbar', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            scope: {
                class: '@'
            },
            template: '<div class="widget-body-toolbar" data-ng-transclude=""></div>'
        }
    })

    .directive('widgetContent', function () {
        return {
            restrict: 'AE',
            transclude: true,
            replace: true,
            template: '<div class="widget-body" data-ng-transclude=""></div>'
        }
    })
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a){a.color={},a.color.make=function(b,c,d,e){var f={};return f.r=b||0,f.g=c||0,f.b=d||0,f.a=null!=e?e:1,f.add=function(a,b){for(var c=0;c<a.length;++c)f[a.charAt(c)]+=b;return f.normalize()},f.scale=function(a,b){for(var c=0;c<a.length;++c)f[a.charAt(c)]*=b;return f.normalize()},f.toString=function(){return f.a>=1?"rgb("+[f.r,f.g,f.b].join(",")+")":"rgba("+[f.r,f.g,f.b,f.a].join(",")+")"},f.normalize=function(){function a(a,b,c){return a>b?a:b>c?c:b}return f.r=a(0,parseInt(f.r),255),f.g=a(0,parseInt(f.g),255),f.b=a(0,parseInt(f.b),255),f.a=a(0,f.a,1),f},f.clone=function(){return a.color.make(f.r,f.b,f.g,f.a)},f.normalize()},a.color.extract=function(b,c){var d;do{if(d=b.css(c).toLowerCase(),""!=d&&"transparent"!=d)break;b=b.parent()}while(!a.nodeName(b.get(0),"body"));return"rgba(0, 0, 0, 0)"==d&&(d="transparent"),a.color.parse(d)},a.color.parse=function(c){var d,e=a.color.make;if(d=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(c))return e(parseInt(d[1],10),parseInt(d[2],10),parseInt(d[3],10));if(d=/rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(c))return e(parseInt(d[1],10),parseInt(d[2],10),parseInt(d[3],10),parseFloat(d[4]));if(d=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(c))return e(2.55*parseFloat(d[1]),2.55*parseFloat(d[2]),2.55*parseFloat(d[3]));if(d=/rgba\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\s*\)/.exec(c))return e(2.55*parseFloat(d[1]),2.55*parseFloat(d[2]),2.55*parseFloat(d[3]),parseFloat(d[4]));if(d=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(c))return e(parseInt(d[1],16),parseInt(d[2],16),parseInt(d[3],16));if(d=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(c))return e(parseInt(d[1]+d[1],16),parseInt(d[2]+d[2],16),parseInt(d[3]+d[3],16));var f=a.trim(c).toLowerCase();return"transparent"==f?e(255,255,255,0):(d=b[f]||[0,0,0],e(d[0],d[1],d[2]))};var b={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0]}}(jQuery),function(a){function b(b,d,e,f){function g(a,b){b=[vb].concat(b);for(var c=0;c<a.length;++c)a[c].apply(this,b)}function h(){for(var b=0;b<f.length;++b){var c=f[b];c.init(vb),c.options&&a.extend(!0,hb,c.options)}}function j(b){var c;for(a.extend(!0,hb,b),null==hb.xaxis.color&&(hb.xaxis.color=hb.grid.color),null==hb.yaxis.color&&(hb.yaxis.color=hb.grid.color),null==hb.xaxis.tickColor&&(hb.xaxis.tickColor=hb.grid.tickColor),null==hb.yaxis.tickColor&&(hb.yaxis.tickColor=hb.grid.tickColor),null==hb.grid.borderColor&&(hb.grid.borderColor=hb.grid.color),null==hb.grid.tickColor&&(hb.grid.tickColor=a.color.parse(hb.grid.color).scale("a",.22).toString()),c=0;c<Math.max(1,hb.xaxes.length);++c)hb.xaxes[c]=a.extend(!0,{},hb.xaxis,hb.xaxes[c]);for(c=0;c<Math.max(1,hb.yaxes.length);++c)hb.yaxes[c]=a.extend(!0,{},hb.yaxis,hb.yaxes[c]);for(hb.xaxis.noTicks&&null==hb.xaxis.ticks&&(hb.xaxis.ticks=hb.xaxis.noTicks),hb.yaxis.noTicks&&null==hb.yaxis.ticks&&(hb.yaxis.ticks=hb.yaxis.noTicks),hb.x2axis&&(hb.xaxes[1]=a.extend(!0,{},hb.xaxis,hb.x2axis),hb.xaxes[1].position="top"),hb.y2axis&&(hb.yaxes[1]=a.extend(!0,{},hb.yaxis,hb.y2axis),hb.yaxes[1].position="right"),hb.grid.coloredAreas&&(hb.grid.markings=hb.grid.coloredAreas),hb.grid.coloredAreasColor&&(hb.grid.markingsColor=hb.grid.coloredAreasColor),hb.lines&&a.extend(!0,hb.series.lines,hb.lines),hb.points&&a.extend(!0,hb.series.points,hb.points),hb.bars&&a.extend(!0,hb.series.bars,hb.bars),null!=hb.shadowSize&&(hb.series.shadowSize=hb.shadowSize),c=0;c<hb.xaxes.length;++c)q(nb,c+1).options=hb.xaxes[c];for(c=0;c<hb.yaxes.length;++c)q(ob,c+1).options=hb.yaxes[c];for(var d in ub)hb.hooks[d]&&hb.hooks[d].length&&(ub[d]=ub[d].concat(hb.hooks[d]));g(ub.processOptions,[hb])}function k(a){gb=l(a),r(),s()}function l(b){for(var c=[],d=0;d<b.length;++d){var e=a.extend(!0,{},hb.series);null!=b[d].data?(e.data=b[d].data,delete b[d].data,a.extend(!0,e,b[d]),b[d].data=e.data):e.data=b[d],c.push(e)}return c}function m(a,b){var c=a[b+"axis"];return"object"==typeof c&&(c=c.n),"number"!=typeof c&&(c=1),c}function n(){return a.grep(nb.concat(ob),function(a){return a})}function o(a){var b,c,d={};for(b=0;b<nb.length;++b)c=nb[b],c&&c.used&&(d["x"+c.n]=c.c2p(a.left));for(b=0;b<ob.length;++b)c=ob[b],c&&c.used&&(d["y"+c.n]=c.c2p(a.top));return void 0!==d.x1&&(d.x=d.x1),void 0!==d.y1&&(d.y=d.y1),d}function p(a){var b,c,d,e={};for(b=0;b<nb.length;++b)if(c=nb[b],c&&c.used&&(d="x"+c.n,null==a[d]&&1==c.n&&(d="x"),null!=a[d])){e.left=c.p2c(a[d]);break}for(b=0;b<ob.length;++b)if(c=ob[b],c&&c.used&&(d="y"+c.n,null==a[d]&&1==c.n&&(d="y"),null!=a[d])){e.top=c.p2c(a[d]);break}return e}function q(b,c){return b[c-1]||(b[c-1]={n:c,direction:b==nb?"x":"y",options:a.extend(!0,{},b==nb?hb.xaxis:hb.yaxis)}),b[c-1]}function r(){var b,c=gb.length,d=[],e=[];for(b=0;b<gb.length;++b){var f=gb[b].color;null!=f&&(--c,"number"==typeof f?e.push(f):d.push(a.color.parse(gb[b].color)))}for(b=0;b<e.length;++b)c=Math.max(c,e[b]+1);var g=[],h=0;for(b=0;g.length<c;){var i;i=hb.colors.length==b?a.color.make(100,100,100):a.color.parse(hb.colors[b]);var j=h%2==1?-1:1;i.scale("rgb",1+j*Math.ceil(h/2)*.2),g.push(i),++b,b>=hb.colors.length&&(b=0,++h)}var k,l=0;for(b=0;b<gb.length;++b){if(k=gb[b],null==k.color?(k.color=g[l].toString(),++l):"number"==typeof k.color&&(k.color=g[k.color].toString()),null==k.lines.show){var n,o=!0;for(n in k)if(k[n]&&k[n].show){o=!1;break}o&&(k.lines.show=!0)}k.xaxis=q(nb,m(k,"x")),k.yaxis=q(ob,m(k,"y"))}}function s(){function b(a,b,c){b<a.datamin&&b!=-q&&(a.datamin=b),c>a.datamax&&c!=q&&(a.datamax=c)}var c,d,e,f,h,i,j,k,l,m,o=Number.POSITIVE_INFINITY,p=Number.NEGATIVE_INFINITY,q=Number.MAX_VALUE;for(a.each(n(),function(a,b){b.datamin=o,b.datamax=p,b.used=!1}),c=0;c<gb.length;++c)h=gb[c],h.datapoints={points:[]},g(ub.processRawData,[h,h.data,h.datapoints]);for(c=0;c<gb.length;++c){h=gb[c];var r=h.data,s=h.datapoints.format;if(s||(s=[],s.push({x:!0,number:!0,required:!0}),s.push({y:!0,number:!0,required:!0}),(h.bars.show||h.lines.show&&h.lines.fill)&&(s.push({y:!0,number:!0,required:!1,defaultValue:0}),h.bars.horizontal&&(delete s[s.length-1].y,s[s.length-1].x=!0)),h.datapoints.format=s),null==h.datapoints.pointsize)for(h.datapoints.pointsize=s.length,j=h.datapoints.pointsize,i=h.datapoints.points,insertSteps=h.lines.show&&h.lines.steps,h.xaxis.used=h.yaxis.used=!0,d=e=0;d<r.length;++d,e+=j){m=r[d];var t=null==m;if(!t)for(f=0;j>f;++f)k=m[f],l=s[f],l&&(l.number&&null!=k&&(k=+k,isNaN(k)?k=null:1/0==k?k=q:k==-1/0&&(k=-q)),null==k&&(l.required&&(t=!0),null!=l.defaultValue&&(k=l.defaultValue))),i[e+f]=k;if(t)for(f=0;j>f;++f)k=i[e+f],null!=k&&(l=s[f],l.x&&b(h.xaxis,k,k),l.y&&b(h.yaxis,k,k)),i[e+f]=null;else if(insertSteps&&e>0&&null!=i[e-j]&&i[e-j]!=i[e]&&i[e-j+1]!=i[e+1]){for(f=0;j>f;++f)i[e+j+f]=i[e+f];i[e+1]=i[e-j+1],e+=j}}}for(c=0;c<gb.length;++c)h=gb[c],g(ub.processDatapoints,[h,h.datapoints]);for(c=0;c<gb.length;++c){h=gb[c],i=h.datapoints.points,j=h.datapoints.pointsize;var u=o,v=o,w=p,x=p;for(d=0;d<i.length;d+=j)if(null!=i[d])for(f=0;j>f;++f)k=i[d+f],l=s[f],l&&k!=q&&k!=-q&&(l.x&&(u>k&&(u=k),k>w&&(w=k)),l.y&&(v>k&&(v=k),k>x&&(x=k)));if(h.bars.show){var y="left"==h.bars.align?0:-h.bars.barWidth/2;h.bars.horizontal?(v+=y,x+=y+h.bars.barWidth):(u+=y,w+=y+h.bars.barWidth)}b(h.xaxis,u,w),b(h.yaxis,v,x)}a.each(n(),function(a,b){b.datamin==o&&(b.datamin=null),b.datamax==p&&(b.datamax=null)})}function t(c,d){var e=document.createElement("canvas");return e.className=d,e.width=qb,e.height=rb,c||a(e).css({position:"absolute",left:0,top:0}),a(e).appendTo(b),fb&&(e.width=2*qb,e.height=2*rb,e.style.width=""+qb+"px",e.style.height=""+rb+"px"),e.getContext||(e=window.G_vmlCanvasManager.initElement(e)),e.getContext("2d").save(),fb&&e.getContext("2d").scale(2,2),e}function u(){if(qb=b.width(),rb=b.height(),0>=qb||0>=rb)throw"Invalid dimensions for plot, width = "+qb+", height = "+rb}function v(a){a.width!=qb&&(a.width=qb,fb&&(a.width=2*qb),a.style.width=""+qb+"px"),a.height!=rb&&(a.height=rb,fb&&(a.height=2*rb),a.style.height=""+rb+"px");var b=a.getContext("2d");b.restore(),b.save(),fb&&b.scale(2,2)}function w(){var c,d=b.children("canvas.base"),e=b.children("canvas.overlay");0==d.length||0==e?(b.html(""),b.css({padding:0}),"static"==b.css("position")&&b.css("position","relative"),u(),ib=t(!0,"base"),jb=t(!1,"overlay"),c=!1):(ib=d.get(0),jb=e.get(0),c=!0),lb=ib.getContext("2d"),mb=jb.getContext("2d"),kb=a([jb,ib]),c&&(b.data("plot").shutdown(),vb.resize(),mb.clearRect(0,0,qb,rb),kb.unbind(),b.children().not([ib,jb]).remove()),b.data("plot",vb)}function x(){hb.grid.hoverable&&(kb.mousemove(V),kb.mouseleave(W)),hb.grid.clickable&&kb.click(X),g(ub.bindEvents,[kb])}function y(){xb&&clearTimeout(xb),kb.unbind("mousemove",V),kb.unbind("mouseleave",W),kb.unbind("click",X),g(ub.shutdown,[kb])}function z(a){function b(a){return a}var c,d,e=a.options.transform||b,f=a.options.inverseTransform;"x"==a.direction?(c=a.scale=sb/Math.abs(e(a.max)-e(a.min)),d=Math.min(e(a.max),e(a.min))):(c=a.scale=tb/Math.abs(e(a.max)-e(a.min)),c=-c,d=Math.max(e(a.max),e(a.min))),a.p2c=e==b?function(a){return(a-d)*c}:function(a){return(e(a)-d)*c},a.c2p=f?function(a){return f(d+a/c)}:function(a){return d+a/c}}function A(c){function d(d,e){return a('<div style="position:absolute;top:-10000px;'+e+'font-size:smaller"><div class="'+c.direction+"Axis "+c.direction+c.n+'Axis">'+d.join("")+"</div></div>").appendTo(b)}var e,f,g,h=c.options,i=c.ticks||[],j=[],k=h.labelWidth,l=h.labelHeight;if("x"==c.direction){if(null==k&&(k=Math.floor(qb/(i.length>0?i.length:1))),null==l){for(j=[],e=0;e<i.length;++e)f=i[e].label,f&&j.push('<div class="tickLabel" style="float:left;width:'+k+'px">'+f+"</div>");j.length>0&&(j.push('<div style="clear:left"></div>'),g=d(j,"width:10000px;"),l=g.height(),g.remove())}}else if(null==k||null==l){for(e=0;e<i.length;++e)f=i[e].label,f&&j.push('<div class="tickLabel">'+f+"</div>");j.length>0&&(g=d(j,""),null==k&&(k=g.children().width()),null==l&&(l=g.find("div.tickLabel").height()),g.remove())}null==k&&(k=0),null==l&&(l=0),c.labelWidth=k,c.labelHeight=l}function B(b){var c=b.labelWidth,d=b.labelHeight,e=b.options.position,f=b.options.tickLength,g=hb.grid.axisMargin,h=hb.grid.labelMargin,i="x"==b.direction?nb:ob,j=a.grep(i,function(a){return a&&a.options.position==e&&a.reserveSpace});a.inArray(b,j)==j.length-1&&(g=0),null==f&&(f="full");var k=a.grep(i,function(a){return a&&a.reserveSpace}),l=0==a.inArray(b,k);l||"full"!=f||(f=5),isNaN(+f)||(h+=+f),"x"==b.direction?(d+=h,"bottom"==e?(pb.bottom+=d+g,b.box={top:rb-pb.bottom,height:d}):(b.box={top:pb.top+g,height:d},pb.top+=d+g)):(c+=h,"left"==e?(b.box={left:pb.left+g,width:c},pb.left+=c+g):(pb.right+=c+g,b.box={left:qb-pb.right,width:c})),b.position=e,b.tickLength=f,b.box.padding=h,b.innermost=l}function C(a){"x"==a.direction?(a.box.left=pb.left,a.box.width=sb):(a.box.top=pb.top,a.box.height=tb)}function D(){var b,c=n();if(a.each(c,function(a,b){b.show=b.options.show,null==b.show&&(b.show=b.used),b.reserveSpace=b.show||b.options.reserveSpace,E(b)}),allocatedAxes=a.grep(c,function(a){return a.reserveSpace}),pb.left=pb.right=pb.top=pb.bottom=0,hb.grid.show){for(a.each(allocatedAxes,function(a,b){F(b),G(b),H(b,b.ticks),A(b)}),b=allocatedAxes.length-1;b>=0;--b)B(allocatedAxes[b]);var d=hb.grid.minBorderMargin;if(null==d)for(d=0,b=0;b<gb.length;++b)d=Math.max(d,gb[b].points.radius+gb[b].points.lineWidth/2);for(var e in pb)pb[e]+=hb.grid.borderWidth,pb[e]=Math.max(d,pb[e])}sb=qb-pb.left-pb.right,tb=rb-pb.bottom-pb.top,a.each(c,function(a,b){z(b)}),hb.grid.show&&(a.each(allocatedAxes,function(a,b){C(b)}),M()),T()}function E(a){var b=a.options,c=+(null!=b.min?b.min:a.datamin),d=+(null!=b.max?b.max:a.datamax),e=d-c;if(0==e){var f=0==d?1:.01;null==b.min&&(c-=f),(null==b.max||null!=b.min)&&(d+=f)}else{var g=b.autoscaleMargin;null!=g&&(null==b.min&&(c-=e*g,0>c&&null!=a.datamin&&a.datamin>=0&&(c=0)),null==b.max&&(d+=e*g,d>0&&null!=a.datamax&&a.datamax<=0&&(d=0)))}a.min=c,a.max=d}function F(b){var d,e=b.options;d="number"==typeof e.ticks&&e.ticks>0?e.ticks:.3*Math.sqrt("x"==b.direction?qb:rb);var f,g,h,i,j,k,l,m=(b.max-b.min)/d;if("time"==e.mode){var n={second:1e3,minute:6e4,hour:36e5,day:864e5,month:2592e6,year:525949.2*60*1e3},o=[[1,"second"],[2,"second"],[5,"second"],[10,"second"],[30,"second"],[1,"minute"],[2,"minute"],[5,"minute"],[10,"minute"],[30,"minute"],[1,"hour"],[2,"hour"],[4,"hour"],[8,"hour"],[12,"hour"],[1,"day"],[2,"day"],[3,"day"],[.25,"month"],[.5,"month"],[1,"month"],[2,"month"],[3,"month"],[6,"month"],[1,"year"]],p=0;null!=e.minTickSize&&(p="number"==typeof e.tickSize?e.tickSize:e.minTickSize[0]*n[e.minTickSize[1]]);for(var j=0;j<o.length-1&&!(m<(o[j][0]*n[o[j][1]]+o[j+1][0]*n[o[j+1][1]])/2&&o[j][0]*n[o[j][1]]>=p);++j);f=o[j][0],h=o[j][1],"year"==h&&(k=Math.pow(10,Math.floor(Math.log(m/n.year)/Math.LN10)),l=m/n.year/k,f=1.5>l?1:3>l?2:7.5>l?5:10,f*=k),b.tickSize=e.tickSize||[f,h],g=function(a){var b=[],d=a.tickSize[0],e=a.tickSize[1],f=new Date(a.min),g=d*n[e];"second"==e&&f.setUTCSeconds(c(f.getUTCSeconds(),d)),"minute"==e&&f.setUTCMinutes(c(f.getUTCMinutes(),d)),"hour"==e&&f.setUTCHours(c(f.getUTCHours(),d)),"month"==e&&f.setUTCMonth(c(f.getUTCMonth(),d)),"year"==e&&f.setUTCFullYear(c(f.getUTCFullYear(),d)),f.setUTCMilliseconds(0),g>=n.minute&&f.setUTCSeconds(0),g>=n.hour&&f.setUTCMinutes(0),g>=n.day&&f.setUTCHours(0),g>=4*n.day&&f.setUTCDate(1),g>=n.year&&f.setUTCMonth(0);var h,i=0,j=Number.NaN;do if(h=j,j=f.getTime(),b.push(j),"month"==e)if(1>d){f.setUTCDate(1);var k=f.getTime();f.setUTCMonth(f.getUTCMonth()+1);var l=f.getTime();f.setTime(j+i*n.hour+(l-k)*d),i=f.getUTCHours(),f.setUTCHours(0)}else f.setUTCMonth(f.getUTCMonth()+d);else"year"==e?f.setUTCFullYear(f.getUTCFullYear()+d):f.setTime(j+g);while(j<a.max&&j!=h);return b},i=function(b,c){var d=new Date(b);if(null!=e.timeformat)return a.plot.formatDate(d,e.timeformat,e.monthNames);var f=c.tickSize[0]*n[c.tickSize[1]],g=c.max-c.min,h=e.twelveHourClock?" %p":"";return fmt=f<n.minute?"%h:%M:%S"+h:f<n.day?g<2*n.day?"%h:%M"+h:"%b %d %h:%M"+h:f<n.month?"%b %d":f<n.year?g<n.year?"%b":"%b %y":"%y",a.plot.formatDate(d,fmt,e.monthNames)}}else{var q=e.tickDecimals,r=-Math.floor(Math.log(m)/Math.LN10);null!=q&&r>q&&(r=q),k=Math.pow(10,-r),l=m/k,1.5>l?f=1:3>l?(f=2,l>2.25&&(null==q||q>=r+1)&&(f=2.5,++r)):f=7.5>l?5:10,f*=k,null!=e.minTickSize&&f<e.minTickSize&&(f=e.minTickSize),b.tickDecimals=Math.max(0,null!=q?q:r),b.tickSize=e.tickSize||f,g=function(a){var b,d=[],e=c(a.min,a.tickSize),f=0,g=Number.NaN;do b=g,g=e+f*a.tickSize,d.push(g),++f;while(g<a.max&&g!=b);return d},i=function(a,b){return a.toFixed(b.tickDecimals)}}if(null!=e.alignTicksWithAxis){var s=("x"==b.direction?nb:ob)[e.alignTicksWithAxis-1];if(s&&s.used&&s!=b){var t=g(b);if(t.length>0&&(null==e.min&&(b.min=Math.min(b.min,t[0])),null==e.max&&t.length>1&&(b.max=Math.max(b.max,t[t.length-1]))),g=function(a){var b,c,d=[];for(c=0;c<s.ticks.length;++c)b=(s.ticks[c].v-s.min)/(s.max-s.min),b=a.min+b*(a.max-a.min),d.push(b);return d},"time"!=b.mode&&null==e.tickDecimals){var u=Math.max(0,-Math.floor(Math.log(m)/Math.LN10)+1),v=g(b);v.length>1&&/\..*0$/.test((v[1]-v[0]).toFixed(u))||(b.tickDecimals=u)}}}b.tickGenerator=g,b.tickFormatter=a.isFunction(e.tickFormatter)?function(a,b){return""+e.tickFormatter(a,b)}:i}function G(b){var c=b.options.ticks,d=[];null==c||"number"==typeof c&&c>0?d=b.tickGenerator(b):c&&(d=a.isFunction(c)?c({min:b.min,max:b.max}):c);var e,f;for(b.ticks=[],e=0;e<d.length;++e){var g=null,h=d[e];"object"==typeof h?(f=+h[0],h.length>1&&(g=h[1])):f=+h,null==g&&(g=b.tickFormatter(f,b)),isNaN(f)||b.ticks.push({v:f,label:g})}}function H(a,b){a.options.autoscaleMargin&&b.length>0&&(null==a.options.min&&(a.min=Math.min(a.min,b[0].v)),null==a.options.max&&b.length>1&&(a.max=Math.max(a.max,b[b.length-1].v)))}function I(){lb.clearRect(0,0,qb,rb);var a=hb.grid;a.show&&a.backgroundColor&&K(),a.show&&!a.aboveData&&L();for(var b=0;b<gb.length;++b)g(ub.drawSeries,[lb,gb[b]]),N(gb[b]);g(ub.draw,[lb]),a.show&&a.aboveData&&L()}function J(a,b){var c,d,e,f,g=n();for(i=0;i<g.length;++i)if(c=g[i],c.direction==b&&(f=b+c.n+"axis",a[f]||1!=c.n||(f=b+"axis"),a[f])){d=a[f].from,e=a[f].to;break}if(a[f]||(c="x"==b?nb[0]:ob[0],d=a[b+"1"],e=a[b+"2"]),null!=d&&null!=e&&d>e){var h=d;d=e,e=h}return{from:d,to:e,axis:c}}function K(){lb.save(),lb.translate(pb.left,pb.top),lb.fillStyle=eb(hb.grid.backgroundColor,tb,0,"rgba(255, 255, 255, 0)"),lb.fillRect(0,0,sb,tb),lb.restore()}function L(){var b;lb.save(),lb.translate(pb.left,pb.top);var c=hb.grid.markings;if(c){if(a.isFunction(c)){var d=vb.getAxes();d.xmin=d.xaxis.min,d.xmax=d.xaxis.max,d.ymin=d.yaxis.min,d.ymax=d.yaxis.max,c=c(d)}for(b=0;b<c.length;++b){var e=c[b],f=J(e,"x"),g=J(e,"y");null==f.from&&(f.from=f.axis.min),null==f.to&&(f.to=f.axis.max),null==g.from&&(g.from=g.axis.min),null==g.to&&(g.to=g.axis.max),f.to<f.axis.min||f.from>f.axis.max||g.to<g.axis.min||g.from>g.axis.max||(f.from=Math.max(f.from,f.axis.min),f.to=Math.min(f.to,f.axis.max),g.from=Math.max(g.from,g.axis.min),g.to=Math.min(g.to,g.axis.max),(f.from!=f.to||g.from!=g.to)&&(f.from=f.axis.p2c(f.from),f.to=f.axis.p2c(f.to),g.from=g.axis.p2c(g.from),g.to=g.axis.p2c(g.to),f.from==f.to||g.from==g.to?(lb.beginPath(),lb.strokeStyle=e.color||hb.grid.markingsColor,lb.lineWidth=e.lineWidth||hb.grid.markingsLineWidth,lb.moveTo(f.from,g.from),lb.lineTo(f.to,g.to),lb.stroke()):(lb.fillStyle=e.color||hb.grid.markingsColor,lb.fillRect(f.from,g.to,f.to-f.from,g.from-g.to))))}}for(var d=n(),h=hb.grid.borderWidth,i=0;i<d.length;++i){var j,k,l,m,o=d[i],p=o.box,q=o.tickLength;if(o.show&&0!=o.ticks.length){for(lb.strokeStyle=o.options.tickColor||a.color.parse(o.options.color).scale("a",.22).toString(),lb.lineWidth=1,"x"==o.direction?(j=0,k="full"==q?"top"==o.position?0:tb:p.top-pb.top+("top"==o.position?p.height:0)):(k=0,j="full"==q?"left"==o.position?0:sb:p.left-pb.left+("left"==o.position?p.width:0)),o.innermost||(lb.beginPath(),l=m=0,"x"==o.direction?l=sb:m=tb,1==lb.lineWidth&&(j=Math.floor(j)+.5,k=Math.floor(k)+.5),lb.moveTo(j,k),lb.lineTo(j+l,k+m),lb.stroke()),lb.beginPath(),b=0;b<o.ticks.length;++b){var r=o.ticks[b].v;l=m=0,r<o.min||r>o.max||"full"==q&&h>0&&(r==o.min||r==o.max)||("x"==o.direction?(j=o.p2c(r),m="full"==q?-tb:q,"top"==o.position&&(m=-m)):(k=o.p2c(r),l="full"==q?-sb:q,"left"==o.position&&(l=-l)),1==lb.lineWidth&&("x"==o.direction?j=Math.floor(j)+.5:k=Math.floor(k)+.5),lb.moveTo(j,k),lb.lineTo(j+l,k+m))}lb.stroke()}}h&&(lb.lineWidth=h,lb.strokeStyle=hb.grid.borderColor,lb.strokeRect(-h/2,-h/2,sb+h,tb+h)),lb.restore()}function M(){b.find(".tickLabels").remove();for(var a=['<div class="tickLabels" style="font-size:smaller">'],c=n(),d=0;d<c.length;++d){var e=c[d],f=e.box;if(e.show){a.push('<div class="'+e.direction+"Axis "+e.direction+e.n+'Axis" style="color:'+e.options.color+'">');for(var g=0;g<e.ticks.length;++g){var h=e.ticks[g];if(!(!h.label||h.v<e.min||h.v>e.max)){var i,j={};"x"==e.direction?(i="center",j.left=Math.round(pb.left+e.p2c(h.v)-e.labelWidth/2),"bottom"==e.position?j.top=f.top+f.padding:j.bottom=rb-(f.top+f.height-f.padding)):(j.top=Math.round(pb.top+e.p2c(h.v)-e.labelHeight/2),"left"==e.position?(j.right=qb-(f.left+f.width-f.padding),i="right"):(j.left=f.left+f.padding,i="left")),j.width=e.labelWidth;var k=["position:absolute","text-align:"+i];for(var l in j)k.push(l+":"+j[l]+"px");a.push('<div class="tickLabel" style="'+k.join(";")+'">'+h.label+"</div>")}}a.push("</div>")}}a.push("</div>"),b.append(a.join(""))}function N(a){a.lines.show&&O(a),a.bars.show&&R(a),a.points.show&&P(a)}function O(a){function b(a,b,c,d,e){var f=a.points,g=a.pointsize,h=null,i=null;lb.beginPath();for(var j=g;j<f.length;j+=g){var k=f[j-g],l=f[j-g+1],m=f[j],n=f[j+1];if(null!=k&&null!=m){if(n>=l&&l<e.min){if(n<e.min)continue;k=(e.min-l)/(n-l)*(m-k)+k,l=e.min}else if(l>=n&&n<e.min){if(l<e.min)continue;m=(e.min-l)/(n-l)*(m-k)+k,n=e.min}if(l>=n&&l>e.max){if(n>e.max)continue;k=(e.max-l)/(n-l)*(m-k)+k,l=e.max}else if(n>=l&&n>e.max){if(l>e.max)continue;m=(e.max-l)/(n-l)*(m-k)+k,n=e.max}if(m>=k&&k<d.min){if(m<d.min)continue;l=(d.min-k)/(m-k)*(n-l)+l,k=d.min}else if(k>=m&&m<d.min){if(k<d.min)continue;n=(d.min-k)/(m-k)*(n-l)+l,m=d.min}if(k>=m&&k>d.max){if(m>d.max)continue;l=(d.max-k)/(m-k)*(n-l)+l,k=d.max}else if(m>=k&&m>d.max){if(k>d.max)continue;n=(d.max-k)/(m-k)*(n-l)+l,m=d.max}(k!=h||l!=i)&&lb.moveTo(d.p2c(k)+b,e.p2c(l)+c),h=m,i=n,lb.lineTo(d.p2c(m)+b,e.p2c(n)+c)}}lb.stroke()}function c(a,b,c){for(var d=a.points,e=a.pointsize,f=Math.min(Math.max(0,c.min),c.max),g=0,h=!1,i=1,j=0,k=0;;){if(e>0&&g>d.length+e)break;g+=e;var l=d[g-e],m=d[g-e+i],n=d[g],o=d[g+i];if(h){if(e>0&&null!=l&&null==n){k=g,e=-e,i=2;continue}if(0>e&&g==j+e){lb.fill(),h=!1,e=-e,i=1,g=j=k+e;continue}}if(null!=l&&null!=n){if(n>=l&&l<b.min){if(n<b.min)continue;m=(b.min-l)/(n-l)*(o-m)+m,l=b.min}else if(l>=n&&n<b.min){if(l<b.min)continue;o=(b.min-l)/(n-l)*(o-m)+m,n=b.min}if(l>=n&&l>b.max){if(n>b.max)continue;m=(b.max-l)/(n-l)*(o-m)+m,l=b.max}else if(n>=l&&n>b.max){if(l>b.max)continue;o=(b.max-l)/(n-l)*(o-m)+m,n=b.max}if(h||(lb.beginPath(),lb.moveTo(b.p2c(l),c.p2c(f)),h=!0),m>=c.max&&o>=c.max)lb.lineTo(b.p2c(l),c.p2c(c.max)),lb.lineTo(b.p2c(n),c.p2c(c.max));else if(m<=c.min&&o<=c.min)lb.lineTo(b.p2c(l),c.p2c(c.min)),lb.lineTo(b.p2c(n),c.p2c(c.min));else{var p=l,q=n;o>=m&&m<c.min&&o>=c.min?(l=(c.min-m)/(o-m)*(n-l)+l,m=c.min):m>=o&&o<c.min&&m>=c.min&&(n=(c.min-m)/(o-m)*(n-l)+l,o=c.min),m>=o&&m>c.max&&o<=c.max?(l=(c.max-m)/(o-m)*(n-l)+l,m=c.max):o>=m&&o>c.max&&m<=c.max&&(n=(c.max-m)/(o-m)*(n-l)+l,o=c.max),l!=p&&lb.lineTo(b.p2c(p),c.p2c(m)),lb.lineTo(b.p2c(l),c.p2c(m)),lb.lineTo(b.p2c(n),c.p2c(o)),n!=q&&(lb.lineTo(b.p2c(n),c.p2c(o)),lb.lineTo(b.p2c(q),c.p2c(o)))}}}}lb.save(),lb.translate(pb.left,pb.top),lb.lineJoin="round";var d=a.lines.lineWidth,e=a.shadowSize;if(d>0&&e>0){lb.lineWidth=e,lb.strokeStyle="rgba(0,0,0,0.1)";var f=Math.PI/18;b(a.datapoints,Math.sin(f)*(d/2+e/2),Math.cos(f)*(d/2+e/2),a.xaxis,a.yaxis),lb.lineWidth=e/2,b(a.datapoints,Math.sin(f)*(d/2+e/4),Math.cos(f)*(d/2+e/4),a.xaxis,a.yaxis)}lb.lineWidth=d,lb.strokeStyle=a.color;var g=S(a.lines,a.color,0,tb);g&&(lb.fillStyle=g,c(a.datapoints,a.xaxis,a.yaxis)),d>0&&b(a.datapoints,0,0,a.xaxis,a.yaxis),lb.restore()}function P(a){function b(a,b,c,d,e,f,g,h){for(var i=a.points,j=a.pointsize,k=0;k<i.length;k+=j){var l=i[k],m=i[k+1];null==l||l<f.min||l>f.max||m<g.min||m>g.max||(lb.beginPath(),l=f.p2c(l),m=g.p2c(m)+d,"circle"==h?lb.arc(l,m,b,0,e?Math.PI:2*Math.PI,!1):h(lb,l,m,b,e),lb.closePath(),c&&(lb.fillStyle=c,lb.fill()),lb.stroke())}}lb.save(),lb.translate(pb.left,pb.top);var c=a.points.lineWidth,d=a.shadowSize,e=a.points.radius,f=a.points.symbol;if(c>0&&d>0){var g=d/2;lb.lineWidth=g,lb.strokeStyle="rgba(0,0,0,0.1)",b(a.datapoints,e,null,g+g/2,!0,a.xaxis,a.yaxis,f),lb.strokeStyle="rgba(0,0,0,0.2)",b(a.datapoints,e,null,g/2,!0,a.xaxis,a.yaxis,f)}lb.lineWidth=c,lb.strokeStyle=a.color,b(a.datapoints,e,S(a.points,a.color),0,!1,a.xaxis,a.yaxis,f),lb.restore()}function Q(a,b,c,d,e,f,g,h,i,j,k,l){var m,n,o,p,q,r,s,t,u;k?(t=r=s=!0,q=!1,m=c,n=a,p=b+d,o=b+e,m>n&&(u=n,n=m,m=u,q=!0,r=!1)):(q=r=s=!0,t=!1,m=a+d,n=a+e,o=c,p=b,o>p&&(u=p,p=o,o=u,t=!0,s=!1)),n<h.min||m>h.max||p<i.min||o>i.max||(m<h.min&&(m=h.min,q=!1),n>h.max&&(n=h.max,r=!1),o<i.min&&(o=i.min,t=!1),p>i.max&&(p=i.max,s=!1),m=h.p2c(m),o=i.p2c(o),n=h.p2c(n),p=i.p2c(p),g&&(j.beginPath(),j.moveTo(m,o),j.lineTo(m,p),j.lineTo(n,p),j.lineTo(n,o),j.fillStyle=g(o,p),j.fill()),l>0&&(q||r||s||t)&&(j.beginPath(),j.moveTo(m,o+f),q?j.lineTo(m,p+f):j.moveTo(m,p+f),s?j.lineTo(n,p+f):j.moveTo(n,p+f),r?j.lineTo(n,o+f):j.moveTo(n,o+f),t?j.lineTo(m,o+f):j.moveTo(m,o+f),j.stroke()))}function R(a){function b(b,c,d,e,f,g,h){for(var i=b.points,j=b.pointsize,k=0;k<i.length;k+=j)null!=i[k]&&Q(i[k],i[k+1],i[k+2],c,d,e,f,g,h,lb,a.bars.horizontal,a.bars.lineWidth)}lb.save(),lb.translate(pb.left,pb.top),lb.lineWidth=a.bars.lineWidth,lb.strokeStyle=a.color;var c="left"==a.bars.align?0:-a.bars.barWidth/2,d=a.bars.fill?function(b,c){return S(a.bars,a.color,b,c)}:null;b(a.datapoints,c,c+a.bars.barWidth,0,d,a.xaxis,a.yaxis),lb.restore()}function S(b,c,d,e){var f=b.fill;if(!f)return null;if(b.fillColor)return eb(b.fillColor,d,e,c);var g=a.color.parse(c);return g.a="number"==typeof f?f:.4,g.normalize(),g.toString()}function T(){if(b.find(".legend").remove(),hb.legend.show){for(var c,d,e=[],f=!1,g=hb.legend.labelFormatter,h=0;h<gb.length;++h)c=gb[h],d=c.label,d&&(h%hb.legend.noColumns==0&&(f&&e.push("</tr>"),e.push("<tr>"),f=!0),g&&(d=g(d,c)),e.push('<td class="legendColorBox"><div style="'+hb.legend.labelBoxBorderColor+'"><div style="border:2px solid '+c.color+';overflow:hidden"></div></div></td><td class="legendLabel"><span>'+d+"</span></td>"));if(f&&e.push("</tr>"),0!=e.length){var i='<table style="font-size: 11px; color:'+hb.grid.color+'">'+e.join("")+"</table>";if(null!=hb.legend.container)a(hb.legend.container).html(i);else{var j="",k=hb.legend.position,l=hb.legend.margin;null==l[0]&&(l=[l,l]),"n"==k.charAt(0)?j+="top:"+(l[1]+pb.top)+"px;":"s"==k.charAt(0)&&(j+="bottom:"+(l[1]+pb.bottom)+"px;"),"e"==k.charAt(1)?j+="right:"+(l[0]+pb.right)+"px;":"w"==k.charAt(1)&&(j+="left:"+(l[0]+pb.left)+"px;");var m=a('<div class="legend">'+i.replace('style="','style="position:absolute;'+j+";")+"</div>").appendTo(b);if(0!=hb.legend.backgroundOpacity){var n=hb.legend.backgroundColor;null==n&&(n=hb.grid.backgroundColor,n=n&&"string"==typeof n?a.color.parse(n):a.color.extract(m,"background-color"),n.a=1,n=n.toString());var o=m.children();a('<div style="position:absolute;width:'+o.width()+"px;height:"+o.height()+"px;"+j+"background-color:"+n+';"> </div>').prependTo(m).css("opacity",hb.legend.backgroundOpacity)}}}}}function U(a,b,c){var d,e,f=hb.grid.mouseActiveRadius,g=f*f+1,h=null;for(d=gb.length-1;d>=0;--d)if(c(gb[d])){var i=gb[d],j=i.xaxis,k=i.yaxis,l=i.datapoints.points,m=i.datapoints.pointsize,n=j.c2p(a),o=k.c2p(b),p=f/j.scale,q=f/k.scale;if(j.options.inverseTransform&&(p=Number.MAX_VALUE),k.options.inverseTransform&&(q=Number.MAX_VALUE),i.lines.show||i.points.show)for(e=0;e<l.length;e+=m){var r=l[e],s=l[e+1];if(null!=r&&!(r-n>p||-p>r-n||s-o>q||-q>s-o)){var t=Math.abs(j.p2c(r)-a),u=Math.abs(k.p2c(s)-b),v=t*t+u*u;g>v&&(g=v,h=[d,e/m])}}if(i.bars.show&&!h){var w="left"==i.bars.align?0:-i.bars.barWidth/2,x=w+i.bars.barWidth;for(e=0;e<l.length;e+=m){var r=l[e],s=l[e+1],y=l[e+2];null!=r&&(gb[d].bars.horizontal?n<=Math.max(y,r)&&n>=Math.min(y,r)&&o>=s+w&&s+x>=o:n>=r+w&&r+x>=n&&o>=Math.min(y,s)&&o<=Math.max(y,s))&&(h=[d,e/m])}}}return h?(d=h[0],e=h[1],m=gb[d].datapoints.pointsize,{datapoint:gb[d].datapoints.points.slice(e*m,(e+1)*m),dataIndex:e,series:gb[d],seriesIndex:d}):null}function V(a){hb.grid.hoverable&&Y("plothover",a,function(a){return 0!=a.hoverable})}function W(a){hb.grid.hoverable&&Y("plothover",a,function(){return!1})}function X(a){Y("plotclick",a,function(a){return 0!=a.clickable})}function Y(a,c,d){var e=kb.offset(),f=c.pageX-e.left-pb.left,g=c.pageY-e.top-pb.top,h=o({left:f,top:g});h.pageX=c.pageX,h.pageY=c.pageY;var i=U(f,g,d);if(i&&(i.pageX=parseInt(i.series.xaxis.p2c(i.datapoint[0])+e.left+pb.left),i.pageY=parseInt(i.series.yaxis.p2c(i.datapoint[1])+e.top+pb.top)),hb.grid.autoHighlight){for(var j=0;j<wb.length;++j){var k=wb[j];k.auto!=a||i&&k.series==i.series&&k.point[0]==i.datapoint[0]&&k.point[1]==i.datapoint[1]||ab(k.series,k.point)}i&&_(i.series,i.datapoint,a)}b.trigger(a,[h,i])}function Z(){xb||(xb=setTimeout($,30))}function $(){xb=null,mb.save(),mb.clearRect(0,0,qb,rb),mb.translate(pb.left,pb.top);var a,b;for(a=0;a<wb.length;++a)b=wb[a],b.series.bars.show?db(b.series,b.point):cb(b.series,b.point);mb.restore(),g(ub.drawOverlay,[mb])}function _(a,b,c){if("number"==typeof a&&(a=gb[a]),"number"==typeof b){var d=a.datapoints.pointsize;b=a.datapoints.points.slice(d*b,d*(b+1))}var e=bb(a,b);-1==e?(wb.push({series:a,point:b,auto:c}),Z()):c||(wb[e].auto=!1)}function ab(a,b){null==a&&null==b&&(wb=[],Z()),"number"==typeof a&&(a=gb[a]),"number"==typeof b&&(b=a.data[b]);var c=bb(a,b);-1!=c&&(wb.splice(c,1),Z())}function bb(a,b){for(var c=0;c<wb.length;++c){var d=wb[c];if(d.series==a&&d.point[0]==b[0]&&d.point[1]==b[1])return c}return-1}function cb(b,c){var d=c[0],e=c[1],f=b.xaxis,g=b.yaxis;if(!(d<f.min||d>f.max||e<g.min||e>g.max)){var h=b.points.radius+b.points.lineWidth/2;mb.lineWidth=h,mb.strokeStyle=a.color.parse(b.color).scale("a",.5).toString();var i=1.5*h,d=f.p2c(d),e=g.p2c(e);mb.beginPath(),"circle"==b.points.symbol?mb.arc(d,e,i,0,2*Math.PI,!1):b.points.symbol(mb,d,e,i,!1),mb.closePath(),mb.stroke()}}function db(b,c){mb.lineWidth=b.bars.lineWidth,mb.strokeStyle=a.color.parse(b.color).scale("a",.5).toString();var d=a.color.parse(b.color).scale("a",.5).toString(),e="left"==b.bars.align?0:-b.bars.barWidth/2;Q(c[0],c[1],c[2]||0,e,e+b.bars.barWidth,0,function(){return d},b.xaxis,b.yaxis,mb,b.bars.horizontal,b.bars.lineWidth)}function eb(b,c,d,e){if("string"==typeof b)return b;for(var f=lb.createLinearGradient(0,d,0,c),g=0,h=b.colors.length;h>g;++g){var i=b.colors[g];if("string"!=typeof i){var j=a.color.parse(e);null!=i.brightness&&(j=j.scale("rgb",i.brightness)),null!=i.opacity&&(j.a*=i.opacity),i=j.toString()}f.addColorStop(g/(h-1),i)}return f}var fb=window.devicePixelRatio>1,gb=[],hb={colors:a.flot_color_array||["#931313","#638167","#65596B","#60747C","#B09B5B"],legend:{show:!0,noColumns:a.flot_noColumns||0,labelFormatter:null,labelBoxBorderColor:"",container:null,position:"ne",margin:a.flot_margin||[-5,-32],backgroundColor:a.flot_backgroundColor||"",backgroundOpacity:a.flot_backgroundOpacity||1},xaxis:{show:null,position:"bottom",mode:null,color:null,tickColor:null,transform:null,inverseTransform:null,min:null,max:null,autoscaleMargin:null,ticks:null,tickFormatter:null,labelWidth:null,labelHeight:null,reserveSpace:null,tickLength:null,alignTicksWithAxis:null,tickDecimals:null,tickSize:null,minTickSize:null,monthNames:null,timeformat:null,twelveHourClock:!1},yaxis:{autoscaleMargin:.02,position:"left"},xaxes:[],yaxes:[],series:{points:{show:!1,radius:3,lineWidth:2,fill:!0,fillColor:"#ffffff",symbol:"circle"},lines:{lineWidth:2,fill:!1,fillColor:null,steps:!1},bars:{show:!1,lineWidth:a.flot_bars_lineWidth||1,barWidth:1,fill:!0,fillColor:a.flot_bars_fillColor||{colors:[{opacity:.7},{opacity:1}]},align:"left",horizontal:!1},shadowSize:a.flot_shadowSize||0},grid:{show:!0,aboveData:!1,color:a.flot_grid_color||"#545454",backgroundColor:null,borderColor:a.flot_grid_borderColor||"#efefef",tickColor:a.flot_grid_tickColor||"rgba(0,0,0,0.06)",labelMargin:a.flot_grid_labelMargin||10,axisMargin:8,borderWidth:a.flot_grid_borderWidth||0,minBorderMargin:a.flot_grid_minBorderMargin||10,markings:null,markingsColor:"#f4f4f4",markingsLineWidth:2,clickable:!1,hoverable:!1,autoHighlight:!0,mouseActiveRadius:a.flot_grid_mouseActiveRadius||5},hooks:{}},ib=null,jb=null,kb=null,lb=null,mb=null,nb=[],ob=[],pb={left:0,right:0,top:0,bottom:0},qb=0,rb=0,sb=0,tb=0,ub={processOptions:[],processRawData:[],processDatapoints:[],drawSeries:[],draw:[],bindEvents:[],drawOverlay:[],shutdown:[]},vb=this;vb.setData=k,vb.setupGrid=D,vb.draw=I,vb.getPlaceholder=function(){return b
},vb.getCanvas=function(){return ib},vb.getPlotOffset=function(){return pb},vb.width=function(){return sb},vb.height=function(){return tb},vb.offset=function(){var a=kb.offset();return a.left+=pb.left,a.top+=pb.top,a},vb.getData=function(){return gb},vb.getAxes=function(){var b={};return a.each(nb.concat(ob),function(a,c){c&&(b[c.direction+(1!=c.n?c.n:"")+"axis"]=c)}),b},vb.getXAxes=function(){return nb},vb.getYAxes=function(){return ob},vb.c2p=o,vb.p2c=p,vb.getOptions=function(){return hb},vb.highlight=_,vb.unhighlight=ab,vb.triggerRedrawOverlay=Z,vb.pointOffset=function(a){return{left:parseInt(nb[m(a,"x")-1].p2c(+a.x)+pb.left),top:parseInt(ob[m(a,"y")-1].p2c(+a.y)+pb.top)}},vb.shutdown=y,vb.resize=function(){u(),v(ib),v(jb)},vb.hooks=ub,h(vb),j(e),w(),k(d),D(),I(),x();var wb=[],xb=null}function c(a,b){return b*Math.floor(a/b)}a.plot=function(c,d,e){var f=new b(a(c),d,e,a.plot.plugins);return f},a.plot.version="0.7",a.plot.plugins=[],a.plot.formatDate=function(a,b,c){var d=function(a){return a=""+a,1==a.length?"0"+a:a},e=[],f=!1,g=!1,h=a.getUTCHours(),i=12>h;null==c&&(c=["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]),-1!=b.search(/%p|%P/)&&(h>12?h-=12:0==h&&(h=12));for(var j=0;j<b.length;++j){var k=b.charAt(j);if(f){switch(k){case"h":k=""+h;break;case"H":k=d(h);break;case"M":k=d(a.getUTCMinutes());break;case"S":k=d(a.getUTCSeconds());break;case"d":k=""+a.getUTCDate();break;case"m":k=""+(a.getUTCMonth()+1);break;case"y":k=""+a.getUTCFullYear();break;case"b":k=""+c[a.getUTCMonth()];break;case"p":k=i?"am":"pm";break;case"P":k=i?"AM":"PM";break;case"0":k="",g=!0}k&&g&&(k=d(k),g=!1),e.push(k),g||(f=!1)}else"%"==k?f=!0:e.push(k)}return e.join("")}}(jQuery);
/* Flot plugin for stacking data sets rather than overlyaing them.

Copyright (c) 2007-2014 IOLA and Ole Laursen.
Licensed under the MIT license.

The plugin assumes the data is sorted on x (or y if stacking horizontally).
For line charts, it is assumed that if a line has an undefined gap (from a
null point), then the line above it should have the same gap - insert zeros
instead of "null" if you want another behaviour. This also holds for the start
and end of the chart. Note that stacking a mix of positive and negative values
in most instances doesn't make sense (so it looks weird).

Two or more series are stacked when their "stack" attribute is set to the same
key (which can be any number or string or just "true"). To specify the default
stack, you can set the stack option like this:

	series: {
		stack: null/false, true, or a key (number/string)
	}

You can also specify it for a single series, like this:

	$.plot( $("#placeholder"), [{
		data: [ ... ],
		stack: true
	}])

The stacking order is determined by the order of the data series in the array
(later series end up on top of the previous).

Internally, the plugin modifies the datapoints in each series, adding an
offset to the y value. For line series, extra data points are inserted through
interpolation. If there's a second y value, it's also adjusted (e.g for bar
charts or filled areas).

*/

(function ($) {
    var options = {
        series: { stack: null } // or number/string
    };
    
    function init(plot) {
        function findMatchingSeries(s, allseries) {
            var res = null;
            for (var i = 0; i < allseries.length; ++i) {
                if (s == allseries[i])
                    break;
                
                if (allseries[i].stack == s.stack)
                    res = allseries[i];
            }
            
            return res;
        }
        
        function stackData(plot, s, datapoints) {
            if (s.stack == null || s.stack === false)
                return;

            var other = findMatchingSeries(s, plot.getData());
            if (!other)
                return;

            var ps = datapoints.pointsize,
                points = datapoints.points,
                otherps = other.datapoints.pointsize,
                otherpoints = other.datapoints.points,
                newpoints = [],
                px, py, intery, qx, qy, bottom,
                withlines = s.lines.show,
                horizontal = s.bars.horizontal,
                withbottom = ps > 2 && (horizontal ? datapoints.format[2].x : datapoints.format[2].y),
                withsteps = withlines && s.lines.steps,
                fromgap = true,
                keyOffset = horizontal ? 1 : 0,
                accumulateOffset = horizontal ? 0 : 1,
                i = 0, j = 0, l, m;

            while (true) {
                if (i >= points.length)
                    break;

                l = newpoints.length;

                if (points[i] == null) {
                    // copy gaps
                    for (m = 0; m < ps; ++m)
                        newpoints.push(points[i + m]);
                    i += ps;
                }
                else if (j >= otherpoints.length) {
                    // for lines, we can't use the rest of the points
                    if (!withlines) {
                        for (m = 0; m < ps; ++m)
                            newpoints.push(points[i + m]);
                    }
                    i += ps;
                }
                else if (otherpoints[j] == null) {
                    // oops, got a gap
                    for (m = 0; m < ps; ++m)
                        newpoints.push(null);
                    fromgap = true;
                    j += otherps;
                }
                else {
                    // cases where we actually got two points
                    px = points[i + keyOffset];
                    py = points[i + accumulateOffset];
                    qx = otherpoints[j + keyOffset];
                    qy = otherpoints[j + accumulateOffset];
                    bottom = 0;

                    if (px == qx) {
                        for (m = 0; m < ps; ++m)
                            newpoints.push(points[i + m]);

                        newpoints[l + accumulateOffset] += qy;
                        bottom = qy;
                        
                        i += ps;
                        j += otherps;
                    }
                    else if (px > qx) {
                        // we got past point below, might need to
                        // insert interpolated extra point
                        if (withlines && i > 0 && points[i - ps] != null) {
                            intery = py + (points[i - ps + accumulateOffset] - py) * (qx - px) / (points[i - ps + keyOffset] - px);
                            newpoints.push(qx);
                            newpoints.push(intery + qy);
                            for (m = 2; m < ps; ++m)
                                newpoints.push(points[i + m]);
                            bottom = qy; 
                        }

                        j += otherps;
                    }
                    else { // px < qx
                        if (fromgap && withlines) {
                            // if we come from a gap, we just skip this point
                            i += ps;
                            continue;
                        }
                            
                        for (m = 0; m < ps; ++m)
                            newpoints.push(points[i + m]);
                        
                        // we might be able to interpolate a point below,
                        // this can give us a better y
                        if (withlines && j > 0 && otherpoints[j - otherps] != null)
                            bottom = qy + (otherpoints[j - otherps + accumulateOffset] - qy) * (px - qx) / (otherpoints[j - otherps + keyOffset] - qx);

                        newpoints[l + accumulateOffset] += bottom;
                        
                        i += ps;
                    }

                    fromgap = false;
                    
                    if (l != newpoints.length && withbottom)
                        newpoints[l + 2] += bottom;
                }

                // maintain the line steps invariant
                if (withsteps && l != newpoints.length && l > 0
                    && newpoints[l] != null
                    && newpoints[l] != newpoints[l - ps]
                    && newpoints[l + 1] != newpoints[l - ps + 1]) {
                    for (m = 0; m < ps; ++m)
                        newpoints[l + ps + m] = newpoints[l + m];
                    newpoints[l + 1] = newpoints[l - ps + 1];
                }
            }

            datapoints.points = newpoints;
        }
        
        plot.hooks.processDatapoints.push(stackData);
    }
    
    $.plot.plugins.push({
        init: init,
        options: options,
        name: 'stack',
        version: '1.2'
    });
})(jQuery);

/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a,b,c){function d(){e=b[h](function(){f.each(function(){var b=a(this),c=b.width(),d=b.height(),e=a.data(this,j);(c!==e.w||d!==e.h)&&b.trigger(i,[e.w=c,e.h=d])}),d()},g[k])}var e,f=a([]),g=a.resize=a.extend(a.resize,{}),h="setTimeout",i="resize",j=i+"-special-event",k="delay",l="throttleWindow";g[k]=250,g[l]=!0,a.event.special[i]={setup:function(){if(!g[l]&&this[h])return!1;var b=a(this);f=f.add(b),a.data(this,j,{w:b.width(),h:b.height()}),1===f.length&&d()},teardown:function(){if(!g[l]&&this[h])return!1;var b=a(this);f=f.not(b),b.removeData(j),f.length||clearTimeout(e)},add:function(b){function d(b,d,f){var g=a(this),h=a.data(this,j);h.w=d!==c?d:g.width(),h.h=f!==c?f:g.height(),e.apply(this,arguments)}if(!g[l]&&this[h])return!1;var e;return a.isFunction(b)?(e=b,d):(e=b.handler,void(b.handler=d))}}}(jQuery,this),function(a){function b(a){function b(){var b=a.getPlaceholder();0!=b.width()&&0!=b.height()&&(a.resize(),a.setupGrid(),a.draw())}function c(a){a.getPlaceholder().resize(b)}function d(a){a.getPlaceholder().unbind("resize",b)}a.hooks.bindEvents.push(c),a.hooks.shutdown.push(d)}var c={};a.plot.plugins.push({init:b,options:c,name:"resize",version:"1.0"})}(jQuery);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a){var b={tooltip:!1,tooltipOpts:{content:"%s | X: %x | Y: %y.2",dateFormat:"%y-%0m-%0d",shifts:{x:10,y:20},defaultTheme:!0}},c=function(b){var c={x:0,y:0},d=b.getOptions(),e=function(a){c.x=a.x,c.y=a.y},f=function(a){var b={x:0,y:0};b.x=a.pageX,b.y=a.pageY,e(b)},g=function(b){var c=new Date(b);return a.plot.formatDate(c,d.tooltipOpts.dateFormat)};b.hooks.bindEvents.push(function(b,e){var i,j=d.tooltipOpts,k=b.getPlaceholder();d.tooltip!==!1&&(a("#flotTip").length>0?i=a("#flotTip"):(i=a("<div />").attr("id","flotTip"),i.appendTo("body").hide().css({position:"absolute"}),j.defaultTheme&&i.css({background:"#fff","z-index":"100",padding:"0.4em 0.6em","border-radius":"0.5em","font-size":"0.8em",border:"1px solid #111"})),a(k).bind("plothover",function(a,b,e){if(e){var f;f="time"===d.xaxis.mode||"time"===d.xaxes[0].mode?h(j.content,e,g):h(j.content,e),i.html(f).css({left:c.x+j.shifts.x,top:c.y+j.shifts.y}).show()}else i.hide().html("")}),e.mousemove(f))});var h=function(a,b,c){var d=/%p\.{0,1}(\d{0,})/,e=/%s/,f=/%x\.{0,1}(\d{0,})/,g=/%y\.{0,1}(\d{0,})/;return"undefined"!=typeof b.series.percent&&(a=i(d,a,b.series.percent)),"undefined"!=typeof b.series.label&&(a=a.replace(e,b.series.label)),"function"==typeof c?a=a.replace(f,c(b.series.data[b.dataIndex][0])):"number"==typeof b.series.data[b.dataIndex][0]&&(a=i(f,a,b.series.data[b.dataIndex][0])),"number"==typeof b.series.data[b.dataIndex][1]&&(a=i(g,a,b.series.data[b.dataIndex][1])),a},i=function(a,b,c){var d;return"null"!==b.match(a)&&(""!==RegExp.$1&&(d=RegExp.$1,c=c.toFixed(d)),b=b.replace(a,c)),b}};a.plot.plugins.push({init:c,options:b,name:"tooltip",version:"0.4.4"})}(jQuery);
/*! SmartAdmin - v1.4.1 - 2014-06-20 */!function(a){function b(b){function f(b){x||(x=!0,s=b.getCanvas(),t=a(s).parent(),e=b.getOptions(),b.setData(g(b.getData())))}function g(b){for(var c=0,d=0,f=0,g=e.series.pie.combine.color,h=[],i=0;i<b.length;++i){var j=b[i].data;a.isArray(j)?j[1]=a.isNumeric(j[1])?+j[1]:0:j=a.isNumeric(j)?[1,+j]:[1,0],b[i].data=[j]}for(var i=0;i<b.length;++i)c+=b[i].data[0][1];for(var i=0;i<b.length;++i){var j=b[i].data[0][1];j/c<=e.series.pie.combine.threshold&&(d+=j,f++,g||(g=b[i].color))}for(var i=0;i<b.length;++i){var j=b[i].data[0][1];(2>f||j/c>e.series.pie.combine.threshold)&&h.push({data:[[1,j]],color:b[i].color,label:b[i].label,angle:j*Math.PI*2/c,percent:j/(c/100)})}return f>1&&h.push({data:[[1,d]],color:g,label:e.series.pie.combine.label,angle:d*Math.PI*2/c,percent:d/(c/100)}),h}function h(b,f){function g(){y.clearRect(0,0,k,l),t.children().filter(".pieLabel, .pieLabelBackground").remove()}function h(){var a=e.series.pie.shadow.left,b=e.series.pie.shadow.top,c=10,d=e.series.pie.shadow.alpha,f=e.series.pie.radius>1?e.series.pie.radius:u*e.series.pie.radius;if(!(f>=k/2-a||f*e.series.pie.tilt>=l/2-b||c>=f)){y.save(),y.translate(a,b),y.globalAlpha=d,y.fillStyle="#000",y.translate(v,w),y.scale(1,e.series.pie.tilt);for(var g=1;c>=g;g++)y.beginPath(),y.arc(0,0,f,0,2*Math.PI,!1),y.fill(),f-=g;y.restore()}}function j(){function b(a,b,c){0>=a||isNaN(a)||(c?y.fillStyle=b:(y.strokeStyle=b,y.lineJoin="round"),y.beginPath(),Math.abs(a-2*Math.PI)>1e-9&&y.moveTo(0,0),y.arc(0,0,f,g,g+a/2,!1),y.arc(0,0,f,g+a/2,g+a,!1),y.closePath(),g+=a,c?y.fill():y.stroke())}function c(){function b(b,c,d){if(0==b.data[0][1])return!0;var g,h=e.legend.labelFormatter,i=e.series.pie.label.formatter;g=h?h(b.label,b):b.label,i&&(g=i(g,b));var j=(c+b.angle+c)/2,m=v+Math.round(Math.cos(j)*f),n=w+Math.round(Math.sin(j)*f)*e.series.pie.tilt,o="<span class='pieLabel' id='pieLabel"+d+"' style='position:absolute;top:"+n+"px;left:"+m+"px;'>"+g+"</span>";t.append(o);var p=t.children("#pieLabel"+d),q=n-p.height()/2,r=m-p.width()/2;if(p.css("top",q),p.css("left",r),0-q>0||0-r>0||l-(q+p.height())<0||k-(r+p.width())<0)return!1;if(0!=e.series.pie.label.background.opacity){var s=e.series.pie.label.background.color;null==s&&(s=b.color);var u="top:"+q+"px;left:"+r+"px;";a("<div class='pieLabelBackground' style='position:absolute;width:"+p.width()+"px;height:"+p.height()+"px;"+u+"background-color:"+s+";'></div>").css("opacity",e.series.pie.label.background.opacity).insertBefore(p)}return!0}for(var c=d,f=e.series.pie.label.radius>1?e.series.pie.label.radius:u*e.series.pie.label.radius,g=0;g<n.length;++g){if(n[g].percent>=100*e.series.pie.label.threshold&&!b(n[g],c,g))return!1;c+=n[g].angle}return!0}var d=Math.PI*e.series.pie.startAngle,f=e.series.pie.radius>1?e.series.pie.radius:u*e.series.pie.radius;y.save(),y.translate(v,w),y.scale(1,e.series.pie.tilt),y.save();for(var g=d,h=0;h<n.length;++h)n[h].startAngle=g,b(n[h].angle,n[h].color,!0);if(y.restore(),e.series.pie.stroke.width>0){y.save(),y.lineWidth=e.series.pie.stroke.width,g=d;for(var h=0;h<n.length;++h)b(n[h].angle,e.series.pie.stroke.color,!1);y.restore()}return i(y),y.restore(),e.series.pie.label.show?c():!0}if(t){var k=b.getPlaceholder().width(),l=b.getPlaceholder().height(),m=t.children().filter(".legend").children().width()||0;y=f,x=!1,u=Math.min(k,l/e.series.pie.tilt)/2,w=l/2+e.series.pie.offset.top,v=k/2,"auto"==e.series.pie.offset.left?e.legend.position.match("w")?v+=m/2:v-=m/2:v+=e.series.pie.offset.left,u>v?v=u:v>k-u&&(v=k-u);var n=b.getData(),o=0;do o>0&&(u*=d),o+=1,g(),e.series.pie.tilt<=.8&&h();while(!j()&&c>o);o>=c&&(g(),t.prepend("<div class='error'>Could not draw pie with labels contained inside canvas</div>")),b.setSeries&&b.insertLegend&&(b.setSeries(n),b.insertLegend())}}function i(a){if(e.series.pie.innerRadius>0){a.save();var b=e.series.pie.innerRadius>1?e.series.pie.innerRadius:u*e.series.pie.innerRadius;a.globalCompositeOperation="destination-out",a.beginPath(),a.fillStyle=e.series.pie.stroke.color,a.arc(0,0,b,0,2*Math.PI,!1),a.fill(),a.closePath(),a.restore(),a.save(),a.beginPath(),a.strokeStyle=e.series.pie.stroke.color,a.arc(0,0,b,0,2*Math.PI,!1),a.stroke(),a.closePath(),a.restore()}}function j(a,b){for(var c=!1,d=-1,e=a.length,f=e-1;++d<e;f=d)(a[d][1]<=b[1]&&b[1]<a[f][1]||a[f][1]<=b[1]&&b[1]<a[d][1])&&b[0]<(a[f][0]-a[d][0])*(b[1]-a[d][1])/(a[f][1]-a[d][1])+a[d][0]&&(c=!c);return c}function k(a,c){for(var d,e,f=b.getData(),g=b.getOptions(),h=g.series.pie.radius>1?g.series.pie.radius:u*g.series.pie.radius,i=0;i<f.length;++i){var k=f[i];if(k.pie.show){if(y.save(),y.beginPath(),y.moveTo(0,0),y.arc(0,0,h,k.startAngle,k.startAngle+k.angle/2,!1),y.arc(0,0,h,k.startAngle+k.angle/2,k.startAngle+k.angle,!1),y.closePath(),d=a-v,e=c-w,y.isPointInPath){if(y.isPointInPath(a-v,c-w))return y.restore(),{datapoint:[k.percent,k.data],dataIndex:0,series:k,seriesIndex:i}}else{var l=h*Math.cos(k.startAngle),m=h*Math.sin(k.startAngle),n=h*Math.cos(k.startAngle+k.angle/4),o=h*Math.sin(k.startAngle+k.angle/4),p=h*Math.cos(k.startAngle+k.angle/2),q=h*Math.sin(k.startAngle+k.angle/2),r=h*Math.cos(k.startAngle+k.angle/1.5),s=h*Math.sin(k.startAngle+k.angle/1.5),t=h*Math.cos(k.startAngle+k.angle),x=h*Math.sin(k.startAngle+k.angle),z=[[0,0],[l,m],[n,o],[p,q],[r,s],[t,x]],A=[d,e];if(j(z,A))return y.restore(),{datapoint:[k.percent,k.data],dataIndex:0,series:k,seriesIndex:i}}y.restore()}}return null}function l(a){n("plothover",a)}function m(a){n("plotclick",a)}function n(a,c){var d=b.offset(),f=parseInt(c.pageX-d.left),g=parseInt(c.pageY-d.top),h=k(f,g);if(e.grid.autoHighlight)for(var i=0;i<z.length;++i){var j=z[i];j.auto!=a||h&&j.series==h.series||p(j.series)}h&&o(h.series,a);var l={pageX:c.pageX,pageY:c.pageY};t.trigger(a,[l,h])}function o(a,c){var d=q(a);-1==d?(z.push({series:a,auto:c}),b.triggerRedrawOverlay()):c||(z[d].auto=!1)}function p(a){null==a&&(z=[],b.triggerRedrawOverlay());var c=q(a);-1!=c&&(z.splice(c,1),b.triggerRedrawOverlay())}function q(a){for(var b=0;b<z.length;++b){var c=z[b];if(c.series==a)return b}return-1}function r(a,b){function c(a){a.angle<=0||isNaN(a.angle)||(b.fillStyle="rgba(255, 255, 255, "+d.series.pie.highlight.opacity+")",b.beginPath(),Math.abs(a.angle-2*Math.PI)>1e-9&&b.moveTo(0,0),b.arc(0,0,e,a.startAngle,a.startAngle+a.angle/2,!1),b.arc(0,0,e,a.startAngle+a.angle/2,a.startAngle+a.angle,!1),b.closePath(),b.fill())}var d=a.getOptions(),e=d.series.pie.radius>1?d.series.pie.radius:u*d.series.pie.radius;b.save(),b.translate(v,w),b.scale(1,d.series.pie.tilt);for(var f=0;f<z.length;++f)c(z[f].series);i(b),b.restore()}var s=null,t=null,u=null,v=null,w=null,x=!1,y=null,z=[];b.hooks.processOptions.push(function(a,b){b.series.pie.show&&(b.grid.show=!1,"auto"==b.series.pie.label.show&&(b.series.pie.label.show=b.legend.show?!1:!0),"auto"==b.series.pie.radius&&(b.series.pie.radius=b.series.pie.label.show?.75:1),b.series.pie.tilt>1?b.series.pie.tilt=1:b.series.pie.tilt<0&&(b.series.pie.tilt=0))}),b.hooks.bindEvents.push(function(a,b){var c=a.getOptions();c.series.pie.show&&(c.grid.hoverable&&b.unbind("mousemove").mousemove(l),c.grid.clickable&&b.unbind("click").click(m))}),b.hooks.processDatapoints.push(function(a,b,c,d){var e=a.getOptions();e.series.pie.show&&f(a,b,c,d)}),b.hooks.drawOverlay.push(function(a,b){var c=a.getOptions();c.series.pie.show&&r(a,b)}),b.hooks.draw.push(function(a,b){var c=a.getOptions();c.series.pie.show&&h(a,b)})}var c=10,d=.95,e={series:{pie:{show:!1,radius:"auto",innerRadius:0,startAngle:1.5,tilt:1,shadow:{left:5,top:15,alpha:.02},offset:{top:0,left:"auto"},stroke:{color:"#fff",width:1},label:{show:"auto",formatter:function(a,b){return"<div style='font-size:x-small;text-align:center;padding:2px;color:"+b.color+";'>"+a+"<br/>"+Math.round(b.percent)+"%</div>"},radius:1,background:{color:null,opacity:0},threshold:0},combine:{threshold:-1,color:null,label:"Other"},highlight:{opacity:.5}}}};a.plot.plugins.push({init:b,options:e,name:"pie",version:"1.1"})}(jQuery);
/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
