<?php

/* AppBundle:Admin/StatsToPayClients:index.html.twig */
class __TwigTemplate_429a40ffe4f615ba4595e7ebb62077badecc7b5e22ffbf5c484b2e2ef4d16410 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'content' => array($this, 'block_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "AppBundle:Admin/StatsToPayClients:index.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9f38883ddf16a2202831ace23eb32604b5c90f3efcc407e912810b8dd944a001 = $this->env->getExtension("native_profiler");
        $__internal_9f38883ddf16a2202831ace23eb32604b5c90f3efcc407e912810b8dd944a001->enter($__internal_9f38883ddf16a2202831ace23eb32604b5c90f3efcc407e912810b8dd944a001_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Admin/StatsToPayClients:index.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_9f38883ddf16a2202831ace23eb32604b5c90f3efcc407e912810b8dd944a001->leave($__internal_9f38883ddf16a2202831ace23eb32604b5c90f3efcc407e912810b8dd944a001_prof);

    }

    // line 3
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
        $__internal_a08700f8e2fbd91a8e3072aee60fd9da3c9fdb8133dfc5702f37176d2ef4a3f8 = $this->env->getExtension("native_profiler");
        $__internal_a08700f8e2fbd91a8e3072aee60fd9da3c9fdb8133dfc5702f37176d2ef4a3f8->enter($__internal_a08700f8e2fbd91a8e3072aee60fd9da3c9fdb8133dfc5702f37176d2ef4a3f8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_breadcrumb"));

        // line 4
        echo "    <div class=\"hidden-xs\">

        <ol class=\"nav navbar-top-links breadcrumb\">

            <li>
                <a href=\"#\">Stats</a>
            </li>
            <li class=\"active\">
                <span>Stats to pay clients</span>
            </li>
        </ol>

    </div>
";
        
        $__internal_a08700f8e2fbd91a8e3072aee60fd9da3c9fdb8133dfc5702f37176d2ef4a3f8->leave($__internal_a08700f8e2fbd91a8e3072aee60fd9da3c9fdb8133dfc5702f37176d2ef4a3f8_prof);

    }

    // line 19
    public function block_content($context, array $blocks = array())
    {
        $__internal_26c2748379ba1bc7916bc0d54aa9bf022a70c6bc2ddb1cd86020c0336735d7b7 = $this->env->getExtension("native_profiler");
        $__internal_26c2748379ba1bc7916bc0d54aa9bf022a70c6bc2ddb1cd86020c0336735d7b7->enter($__internal_26c2748379ba1bc7916bc0d54aa9bf022a70c6bc2ddb1cd86020c0336735d7b7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 20
        echo "
    <div ng-app=\"statsApp\" ng-controller=\"MyCtrl\" style=\"min-height: 400px\">

        <div class=\"row\" style=\"margin: 20px 0; z-index: 9999; border-bottom: 1px dashed #ccc;padding-bottom: 20px\">
            <form class=\"form-inline form-group\" role=\"form\">

                <div class=\"col-md-offset-1 col-md-3\">
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <select ng-model=\"dateChange\" class=\"form-control\" ng-click=\"setMonth(dateChange)\">
                            <option value=\"0\">Este mes</option>
                            <option value=\"-1\">Mes anterior</option>
                            <option value=\"-2\">Dos meses atras</option>
                        </select>
                    </div>
                </div>

                <div class=\"col-md-3\" >
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <input type=\"text\" id=\"dateTo\" placeholder=\"Date to\" date-options=\"{'starting-day': 1}\" class=\"form-control\" datepicker-popup=\"yyyy/MM/dd\" ng-model=\"dateFrom\" >
                    </div>
                </div>

                <div class=\"col-md-3\">
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <input type=\"text\" id=\"dateTo\" placeholder=\"Date to\" date-options=\"{'starting-day': 1}\" class=\"form-control\" datepicker-popup=\"yyyy/MM/dd\" ng-model=\"dateTo\" >
                    </div>
                </div>

            </form>
        </div>

        <div class=\"row\" style=\"margin-bottom: 20px\">
            <div class=\"col-md-12\">
                <input type=\"text\" placeholder=\"Search\" class=\"form-control\" ng-model=\"search\" ng-change=\"searchChange(search)\">
            </div>
        </div>
        <div class=\"box box-primary\">
            <h4 class=\"box-title filter_legend inactive\" style=\"padding: 10px\">Pay to clients</h4>
            <div class=\"gridStyle\" ng-grid=\"gridOptionsPayToClients\">
            </div>
        </div>

        <div class=\"box box-primary\" style=\"margin-top: 30px\">
            <h4 class=\"box-title filter_legend inactive\" style=\"padding: 10px\">Pay to providers</h4>
            <div class=\"gridStyle\" ng-grid=\"gridOptionsPayToProviders\">
            </div>
        </div>

    </div>
";
        
        $__internal_26c2748379ba1bc7916bc0d54aa9bf022a70c6bc2ddb1cd86020c0336735d7b7->leave($__internal_26c2748379ba1bc7916bc0d54aa9bf022a70c6bc2ddb1cd86020c0336735d7b7_prof);

    }

    // line 71
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_882ad19623f299bfa6d395e5c463aa66e18d022496db4215e2ec4a0109220d28 = $this->env->getExtension("native_profiler");
        $__internal_882ad19623f299bfa6d395e5c463aa66e18d022496db4215e2ec4a0109220d28->enter($__internal_882ad19623f299bfa6d395e5c463aa66e18d022496db4215e2ec4a0109220d28_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 72
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <link rel=\"stylesheet\" href=\"";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/ng-grid.min.css"), "html", null, true);
        echo "\" media=\"screen\" />

    ";
        // line 77
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js\"></script>
    <script src=\"//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js\"></script>
    <script src=\"//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.10.0.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/build/ng-grid.min.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/plugins/ng-grid-csv-export.js"), "html", null, true);
        echo "\"></script>
    <script src=\"//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_es.js\"></script>

    ";
        // line 247
        echo "
    <script>
        var app = angular.module('statsApp', ['ngGrid', 'ui.bootstrap']);
        app.controller('MyCtrl', function(\$scope, \$http, \$filter, \$timeout) {

            var setMonth = function setMonth(less){

                less = parseInt(less);

                var now = new Date();
                var after = new Date();

                now.setHours(2,0,0,0);after.setHours(2,0,0,0);

                now.setMonth(now.getMonth() + less);
                after.setMonth(after.getMonth() + less + 1);

                now.setDate(1);
                after.setDate(1);


                \$scope.dateFrom = now;
                \$scope.dateTo = after;

            };

            \$scope.setMonth = setMonth;

            function exe(){

                \$http.get('/backoffice/stats_pay_to_clients/data/'+\$scope.dateFrom.toISOString()+'/'+\$scope.dateTo.toISOString()).success(function(data){
                    \$scope.payToClients = data;
                    \$scope.payToClientsData = data;
                });

                \$http.get('/backoffice/stats_pay_to_providers/data/'+\$scope.dateFrom.toISOString()+'/'+\$scope.dateTo.toISOString()).success(function(data){
                    \$scope.payToProviders = data;
                    \$scope.payToProvidersData = data;
                });
            }

            \$scope.gridOptionsPayToClients = {
                data: 'payToClients',
                plugins: [new ngGridCsvExportPlugin()],
                showFooter: true,
                showGroupPanel: true,
                jqueryUIDraggable: true,
                groups: ['name', 'paymethod'],
                columnDefs: [
                    {field:'name', displayName:'App name'},
                    {field:'paymethod', displayName:'Pay Method'},
                    {field:'total_amount', displayName:'Total', cellFilter: 'currency:\"€\"'},
                    {field:'exchange_ratio', displayName:'Average Exchange to EUR', cellFilter: 'currency:\"€\"'},
                    {field:'id', displayName:'Purchase Id'},
                    {field:'createdAt', displayName:'Date', cellFilter: 'date'}
                ],
                aggregateTemplate: '' +
                        '<div ng-click=\"row.toggleExpand()\" ng-style=\"rowStyle(row)\" class=\"ngAggregate ngRow\">' +
                        '    <span class=\"ngAggregateText\">{{row.label CUSTOM_FILTERS}} ({{row.totalChildren()}} {{AggItemsLabel}})</span>' +

                        '    <div class=\"ngCell col{{ 2 + gridOptionsPayToClients.\$gridScope.configGroups.length }} colt{{ 2 + gridOptionsPayToClients.\$gridScope.configGroups.length}}\"><span class=\"ngAggregateText\">{{aggFunc(row, \"total_amount\") | currency:\"€\":4}}</span></div>' +
                        '    <div class=\"ngCell col{{ 3 + gridOptionsPayToClients.\$gridScope.configGroups.length }} colt{{ 3 + gridOptionsPayToClients.\$gridScope.configGroups.length}}\"><span class=\"ngAggregateText\">{{aggFuncAvg(row, \"exchange_ratio\") | currency:\"€\":4}}</span></div>' +
                        '    <div class=\"{{row.aggClass()}}\"></div>' +

                        '</div>'


            };

            \$scope.gridOptionsPayToProviders = {
                data: 'payToProviders',
                plugins: [new ngGridCsvExportPlugin()],
                showFooter: true,
                showGroupPanel: true,
                jqueryUIDraggable: true,
                groups: ['provider'],
                columnDefs: [
                    {field:'provider', displayName:'Provider'},
                    {field:'total_amount', displayName:'Total', cellFilter: 'currency:\"€\"'},
                    {field:'pay_from_providers_eur', displayName:'To pay Exchange from payment Date', cellFilter: 'currency:\"€\"'},
                    {field:'pay_from_providers_eur_current_exchange', displayName:'To pay Exchange from now', cellFilter: 'currency:\"€\"'},
                    {field:'countryDetected', displayName:'country' },
                    {field:'id', displayName:'Purchase Id'},
                    {field:'createdAt', displayName:'Date', cellFilter: 'date'}

                ],
                aggregateTemplate: '' +
                        '<div ng-click=\"row.toggleExpand()\" ng-style=\"rowStyle(row)\" class=\"ngAggregate ngRow\">' +
                        '    <span class=\"ngAggregateText\">{{row.label CUSTOM_FILTERS}} ({{row.totalChildren()}} {{AggItemsLabel}})</span>' +

                        '    <div class=\"ngCell col{{ 1 + gridOptionsPayToProviders.\$gridScope.configGroups.length }} colt{{ 1 + gridOptions.\$gridScope.configGroups.length}}\"><span class=\"ngAggregateText\">{{aggFunc(row, \"total_amount\") | currency:\"€\":4}}</span></div>' +
                        '    <div class=\"ngCell col{{ 2 + gridOptionsPayToProviders.\$gridScope.configGroups.length }} colt{{ 2 + gridOptions.\$gridScope.configGroups.length}}\"><span class=\"ngAggregateText\">{{aggFunc(row, \"pay_from_providers_eur\") | currency:\"€\":4}}</span></div>' +
                        '    <div class=\"ngCell col{{ 3 + gridOptionsPayToProviders.\$gridScope.configGroups.length }} colt{{ 3 + gridOptions.\$gridScope.configGroups.length}}\"><span class=\"ngAggregateText\">{{aggFunc(row, \"pay_from_providers_eur_current_exchange\") | currency:\"€\":4}}</span></div>' +
                        '    <div class=\"{{row.aggClass()}}\"></div>' +

                        '</div>'


            };

            \$scope.aggFunc = function (row, col) {

                var sumColumn = col;
                var total = 0, temp;
                angular.forEach(row.children, function(entry) {
                    temp = parseFloat(entry.entity[sumColumn]);
                    if (!isNaN(temp))
                        total+= temp ;
                });
                angular.forEach(row.aggChildren, function(entry) {
                    total+= parseFloat(\$scope.aggFunc(entry, col));
                });
                return total;
            };

            \$scope.aggFuncAvg = function (row, col) {

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

            \$scope.dateChange=0;
            setMonth(\$scope.dateChange);
            exe();

            \$scope.\$watch('[dateFrom,dateTo]', function () { exe() }, true);
            var tempFilterText = '', filterTextTimeout;
            \$scope.searchChange = function (search){

                if (filterTextTimeout)
                    \$timeout.cancel(filterTextTimeout);

                tempFilterText = search;
                filterTextTimeout = \$timeout(function() {
                    \$scope.payToProviders = \$filter('filter')(\$scope.payToProvidersData, tempFilterText);
                    \$scope.payToClients = \$filter('filter')(\$scope.payToClientsData, tempFilterText);
                }, 500);
            };

        });
    </script>
    ";
        echo "
    <style>
        .gridStyle {
            border: 1px solid rgb(212,212,212);

        }
        .ngViewport{
            height: auto !important;
            overflow-x: hidden;
        }
    </style>
";
        
        $__internal_882ad19623f299bfa6d395e5c463aa66e18d022496db4215e2ec4a0109220d28->leave($__internal_882ad19623f299bfa6d395e5c463aa66e18d022496db4215e2ec4a0109220d28_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Admin/StatsToPayClients:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  155 => 247,  149 => 81,  145 => 80,  140 => 77,  135 => 74,  129 => 72,  123 => 71,  67 => 20,  61 => 19,  41 => 4,  35 => 3,  20 => 1,);
    }
}
/* {% extends base_template %}*/
/* */
/* {% block sonata_breadcrumb %}*/
/*     <div class="hidden-xs">*/
/* */
/*         <ol class="nav navbar-top-links breadcrumb">*/
/* */
/*             <li>*/
/*                 <a href="#">Stats</a>*/
/*             </li>*/
/*             <li class="active">*/
/*                 <span>Stats to pay clients</span>*/
/*             </li>*/
/*         </ol>*/
/* */
/*     </div>*/
/* {% endblock sonata_breadcrumb %}*/
/* */
/* {% block content %}*/
/* */
/*     <div ng-app="statsApp" ng-controller="MyCtrl" style="min-height: 400px">*/
/* */
/*         <div class="row" style="margin: 20px 0; z-index: 9999; border-bottom: 1px dashed #ccc;padding-bottom: 20px">*/
/*             <form class="form-inline form-group" role="form">*/
/* */
/*                 <div class="col-md-offset-1 col-md-3">*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <select ng-model="dateChange" class="form-control" ng-click="setMonth(dateChange)">*/
/*                             <option value="0">Este mes</option>*/
/*                             <option value="-1">Mes anterior</option>*/
/*                             <option value="-2">Dos meses atras</option>*/
/*                         </select>*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="col-md-3" >*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <input type="text" id="dateTo" placeholder="Date to" date-options="{'starting-day': 1}" class="form-control" datepicker-popup="yyyy/MM/dd" ng-model="dateFrom" >*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="col-md-3">*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <input type="text" id="dateTo" placeholder="Date to" date-options="{'starting-day': 1}" class="form-control" datepicker-popup="yyyy/MM/dd" ng-model="dateTo" >*/
/*                     </div>*/
/*                 </div>*/
/* */
/*             </form>*/
/*         </div>*/
/* */
/*         <div class="row" style="margin-bottom: 20px">*/
/*             <div class="col-md-12">*/
/*                 <input type="text" placeholder="Search" class="form-control" ng-model="search" ng-change="searchChange(search)">*/
/*             </div>*/
/*         </div>*/
/*         <div class="box box-primary">*/
/*             <h4 class="box-title filter_legend inactive" style="padding: 10px">Pay to clients</h4>*/
/*             <div class="gridStyle" ng-grid="gridOptionsPayToClients">*/
/*             </div>*/
/*         </div>*/
/* */
/*         <div class="box box-primary" style="margin-top: 30px">*/
/*             <h4 class="box-title filter_legend inactive" style="padding: 10px">Pay to providers</h4>*/
/*             <div class="gridStyle" ng-grid="gridOptionsPayToProviders">*/
/*             </div>*/
/*         </div>*/
/* */
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block javascripts %}*/
/*     {{ parent() }}*/
/* */
/*     <link rel="stylesheet" href="{{asset('bower_components/ng-grid/ng-grid.min.css')}}" media="screen" />*/
/* */
/*     {#<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>#}*/
/*     <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>*/
/*     <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js"></script>*/
/*     <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.10.0.js"></script>*/
/*     <script type="text/javascript" src="{{asset('bower_components/ng-grid/build/ng-grid.min.js')}}"></script>*/
/*     <script type="text/javascript" src="{{asset('bower_components/ng-grid/plugins/ng-grid-csv-export.js')}}"></script>*/
/*     <script src="//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_es.js"></script>*/
/* */
/*     {% verbatim %}*/
/*     <script>*/
/*         var app = angular.module('statsApp', ['ngGrid', 'ui.bootstrap']);*/
/*         app.controller('MyCtrl', function($scope, $http, $filter, $timeout) {*/
/* */
/*             var setMonth = function setMonth(less){*/
/* */
/*                 less = parseInt(less);*/
/* */
/*                 var now = new Date();*/
/*                 var after = new Date();*/
/* */
/*                 now.setHours(2,0,0,0);after.setHours(2,0,0,0);*/
/* */
/*                 now.setMonth(now.getMonth() + less);*/
/*                 after.setMonth(after.getMonth() + less + 1);*/
/* */
/*                 now.setDate(1);*/
/*                 after.setDate(1);*/
/* */
/* */
/*                 $scope.dateFrom = now;*/
/*                 $scope.dateTo = after;*/
/* */
/*             };*/
/* */
/*             $scope.setMonth = setMonth;*/
/* */
/*             function exe(){*/
/* */
/*                 $http.get('/backoffice/stats_pay_to_clients/data/'+$scope.dateFrom.toISOString()+'/'+$scope.dateTo.toISOString()).success(function(data){*/
/*                     $scope.payToClients = data;*/
/*                     $scope.payToClientsData = data;*/
/*                 });*/
/* */
/*                 $http.get('/backoffice/stats_pay_to_providers/data/'+$scope.dateFrom.toISOString()+'/'+$scope.dateTo.toISOString()).success(function(data){*/
/*                     $scope.payToProviders = data;*/
/*                     $scope.payToProvidersData = data;*/
/*                 });*/
/*             }*/
/* */
/*             $scope.gridOptionsPayToClients = {*/
/*                 data: 'payToClients',*/
/*                 plugins: [new ngGridCsvExportPlugin()],*/
/*                 showFooter: true,*/
/*                 showGroupPanel: true,*/
/*                 jqueryUIDraggable: true,*/
/*                 groups: ['name', 'paymethod'],*/
/*                 columnDefs: [*/
/*                     {field:'name', displayName:'App name'},*/
/*                     {field:'paymethod', displayName:'Pay Method'},*/
/*                     {field:'total_amount', displayName:'Total', cellFilter: 'currency:"€"'},*/
/*                     {field:'exchange_ratio', displayName:'Average Exchange to EUR', cellFilter: 'currency:"€"'},*/
/*                     {field:'id', displayName:'Purchase Id'},*/
/*                     {field:'createdAt', displayName:'Date', cellFilter: 'date'}*/
/*                 ],*/
/*                 aggregateTemplate: '' +*/
/*                         '<div ng-click="row.toggleExpand()" ng-style="rowStyle(row)" class="ngAggregate ngRow">' +*/
/*                         '    <span class="ngAggregateText">{{row.label CUSTOM_FILTERS}} ({{row.totalChildren()}} {{AggItemsLabel}})</span>' +*/
/* */
/*                         '    <div class="ngCell col{{ 2 + gridOptionsPayToClients.$gridScope.configGroups.length }} colt{{ 2 + gridOptionsPayToClients.$gridScope.configGroups.length}}"><span class="ngAggregateText">{{aggFunc(row, "total_amount") | currency:"€":4}}</span></div>' +*/
/*                         '    <div class="ngCell col{{ 3 + gridOptionsPayToClients.$gridScope.configGroups.length }} colt{{ 3 + gridOptionsPayToClients.$gridScope.configGroups.length}}"><span class="ngAggregateText">{{aggFuncAvg(row, "exchange_ratio") | currency:"€":4}}</span></div>' +*/
/*                         '    <div class="{{row.aggClass()}}"></div>' +*/
/* */
/*                         '</div>'*/
/* */
/* */
/*             };*/
/* */
/*             $scope.gridOptionsPayToProviders = {*/
/*                 data: 'payToProviders',*/
/*                 plugins: [new ngGridCsvExportPlugin()],*/
/*                 showFooter: true,*/
/*                 showGroupPanel: true,*/
/*                 jqueryUIDraggable: true,*/
/*                 groups: ['provider'],*/
/*                 columnDefs: [*/
/*                     {field:'provider', displayName:'Provider'},*/
/*                     {field:'total_amount', displayName:'Total', cellFilter: 'currency:"€"'},*/
/*                     {field:'pay_from_providers_eur', displayName:'To pay Exchange from payment Date', cellFilter: 'currency:"€"'},*/
/*                     {field:'pay_from_providers_eur_current_exchange', displayName:'To pay Exchange from now', cellFilter: 'currency:"€"'},*/
/*                     {field:'countryDetected', displayName:'country' },*/
/*                     {field:'id', displayName:'Purchase Id'},*/
/*                     {field:'createdAt', displayName:'Date', cellFilter: 'date'}*/
/* */
/*                 ],*/
/*                 aggregateTemplate: '' +*/
/*                         '<div ng-click="row.toggleExpand()" ng-style="rowStyle(row)" class="ngAggregate ngRow">' +*/
/*                         '    <span class="ngAggregateText">{{row.label CUSTOM_FILTERS}} ({{row.totalChildren()}} {{AggItemsLabel}})</span>' +*/
/* */
/*                         '    <div class="ngCell col{{ 1 + gridOptionsPayToProviders.$gridScope.configGroups.length }} colt{{ 1 + gridOptions.$gridScope.configGroups.length}}"><span class="ngAggregateText">{{aggFunc(row, "total_amount") | currency:"€":4}}</span></div>' +*/
/*                         '    <div class="ngCell col{{ 2 + gridOptionsPayToProviders.$gridScope.configGroups.length }} colt{{ 2 + gridOptions.$gridScope.configGroups.length}}"><span class="ngAggregateText">{{aggFunc(row, "pay_from_providers_eur") | currency:"€":4}}</span></div>' +*/
/*                         '    <div class="ngCell col{{ 3 + gridOptionsPayToProviders.$gridScope.configGroups.length }} colt{{ 3 + gridOptions.$gridScope.configGroups.length}}"><span class="ngAggregateText">{{aggFunc(row, "pay_from_providers_eur_current_exchange") | currency:"€":4}}</span></div>' +*/
/*                         '    <div class="{{row.aggClass()}}"></div>' +*/
/* */
/*                         '</div>'*/
/* */
/* */
/*             };*/
/* */
/*             $scope.aggFunc = function (row, col) {*/
/* */
/*                 var sumColumn = col;*/
/*                 var total = 0, temp;*/
/*                 angular.forEach(row.children, function(entry) {*/
/*                     temp = parseFloat(entry.entity[sumColumn]);*/
/*                     if (!isNaN(temp))*/
/*                         total+= temp ;*/
/*                 });*/
/*                 angular.forEach(row.aggChildren, function(entry) {*/
/*                     total+= parseFloat($scope.aggFunc(entry, col));*/
/*                 });*/
/*                 return total;*/
/*             };*/
/* */
/*             $scope.aggFuncAvg = function (row, col) {*/
/* */
/*                 var result = aggFuncAvg(row, col);*/
/* */
/*                 return result.total / result.count;*/
/*             };*/
/* */
/*             function aggFuncAvg(row, col)*/
/*             {*/
/*                 var sumColumn = col;*/
/*                 var total = 0, temp, result, count = 0;*/
/*                 angular.forEach(row.children, function(entry) {*/
/*                     temp = parseFloat(entry.entity[sumColumn]);*/
/*                     if (!isNaN(temp))*/
/*                     {*/
/*                         total+= temp ;*/
/*                         count++;*/
/*                     }*/
/*                 });*/
/*                 angular.forEach(row.aggChildren, function(entry) {*/
/*                     result = aggFuncAvg(entry, col);*/
/*                     total+= parseFloat(result.total);*/
/*                     count+= result.count;*/
/*                 });*/
/* */
/*                 return {total: total, count: count};*/
/*             }*/
/* */
/*             $scope.dateChange=0;*/
/*             setMonth($scope.dateChange);*/
/*             exe();*/
/* */
/*             $scope.$watch('[dateFrom,dateTo]', function () { exe() }, true);*/
/*             var tempFilterText = '', filterTextTimeout;*/
/*             $scope.searchChange = function (search){*/
/* */
/*                 if (filterTextTimeout)*/
/*                     $timeout.cancel(filterTextTimeout);*/
/* */
/*                 tempFilterText = search;*/
/*                 filterTextTimeout = $timeout(function() {*/
/*                     $scope.payToProviders = $filter('filter')($scope.payToProvidersData, tempFilterText);*/
/*                     $scope.payToClients = $filter('filter')($scope.payToClientsData, tempFilterText);*/
/*                 }, 500);*/
/*             };*/
/* */
/*         });*/
/*     </script>*/
/*     {% endverbatim %}*/
/*     <style>*/
/*         .gridStyle {*/
/*             border: 1px solid rgb(212,212,212);*/
/* */
/*         }*/
/*         .ngViewport{*/
/*             height: auto !important;*/
/*             overflow-x: hidden;*/
/*         }*/
/*     </style>*/
/* {% endblock %}*/
/* */
