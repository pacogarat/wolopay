<?php

/* AppBundle:Admin/StatsVatToPay:index.html.twig */
class __TwigTemplate_2b6c38b3eb27fe3fa7692ee1572dac3cc1fe56e1ac63f7160d3bb1a4b1ddd442 extends Twig_Template
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
        return $this->loadTemplate((isset($context["base_template"]) ? $context["base_template"] : $this->getContext($context, "base_template")), "AppBundle:Admin/StatsVatToPay:index.html.twig", 1);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_0ebfc9efe55e0fbce36ae9a7f97a1a6805dbbec270a84689ea08948fdb44d442 = $this->env->getExtension("native_profiler");
        $__internal_0ebfc9efe55e0fbce36ae9a7f97a1a6805dbbec270a84689ea08948fdb44d442->enter($__internal_0ebfc9efe55e0fbce36ae9a7f97a1a6805dbbec270a84689ea08948fdb44d442_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Admin/StatsVatToPay:index.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_0ebfc9efe55e0fbce36ae9a7f97a1a6805dbbec270a84689ea08948fdb44d442->leave($__internal_0ebfc9efe55e0fbce36ae9a7f97a1a6805dbbec270a84689ea08948fdb44d442_prof);

    }

    // line 3
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
        $__internal_90ecf98009b7cb93d615b4257ace053ad4578d1c21afd64705cf827406bce6f7 = $this->env->getExtension("native_profiler");
        $__internal_90ecf98009b7cb93d615b4257ace053ad4578d1c21afd64705cf827406bce6f7->enter($__internal_90ecf98009b7cb93d615b4257ace053ad4578d1c21afd64705cf827406bce6f7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_breadcrumb"));

        // line 4
        echo "    <div class=\"hidden-xs\">

        <ol class=\"nav navbar-top-links breadcrumb\">

            <li>
                <a href=\"#\">Stats</a>
            </li>
            <li class=\"active\">
                <span>Stats Vat</span>
            </li>
        </ol>

    </div>
";
        
        $__internal_90ecf98009b7cb93d615b4257ace053ad4578d1c21afd64705cf827406bce6f7->leave($__internal_90ecf98009b7cb93d615b4257ace053ad4578d1c21afd64705cf827406bce6f7_prof);

    }

    // line 19
    public function block_content($context, array $blocks = array())
    {
        $__internal_25f372f427d008b603a25501cb8de6c38eb8ae9c1af4aca30f79668bc61a5c00 = $this->env->getExtension("native_profiler");
        $__internal_25f372f427d008b603a25501cb8de6c38eb8ae9c1af4aca30f79668bc61a5c00->enter($__internal_25f372f427d008b603a25501cb8de6c38eb8ae9c1af4aca30f79668bc61a5c00_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        // line 20
        echo "
    <div ng-app=\"statsApp\" ng-controller=\"MyCtrl\" style=\"min-height: 400px\">
        <div class=\"row\" style=\"margin: 20px 0; z-index: 9999; border-bottom: 1px dashed #ccc;padding-bottom: 20px\">
            <form class=\"form-inline form-group\" role=\"form\">

                <div class=\"col-md-offset-1 col-md-2\">
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <select ng-model=\"dateChange\" class=\"form-control\" ng-click=\"setMonth(dateChange)\">
                            <option value=\"0\">Este mes</option>
                            <option value=\"-1\">Mes anterior</option>
                            <option value=\"-2\">Dos meses atras</option>
                            <option value=\"-3\">Tres meses atras</option>
                            <option value=\"-4\">Cuatro meses atras</option>
                            <option value=\"-5\">Cinco  meses atras</option>
                            <option value=\"-6\">Seis meses atras</option>
                        </select>
                    </div>
                </div>

                <div class=\"col-md-2\" >
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <input type=\"text\" id=\"dateTo\" placeholder=\"Date to\" class=\"form-control\" date-options=\"{'starting-day': -30}\" datepicker-popup=\"yyyy/MM/dd\" ng-model=\"dateFrom\" >
                    </div>
                </div>

                <div class=\"col-md-2\">
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <input type=\"text\" id=\"dateTo\" placeholder=\"Date to\" class=\"form-control\" date-options=\"{'starting-day': 1}\" datepicker-popup=\"yyyy/MM/dd\" ng-model=\"dateTo\" >
                    </div>
                </div>

                <div class=\"col-md-2\">
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <select ng-model=\"currencyChange\" class=\"form-control\" ng-click=\"setCurrency(currencyChange)\">
                            <option value=\"0\">EUR</option>
                            <option value=\"-1\">Moneda local del pais</option>
                        </select>
                    </div>
                </div>

            </form>
        </div>
        <div class=\"gridStyle\" ng-grid=\"gridOptions\">
        </div>
    </div>
";
        
        $__internal_25f372f427d008b603a25501cb8de6c38eb8ae9c1af4aca30f79668bc61a5c00->leave($__internal_25f372f427d008b603a25501cb8de6c38eb8ae9c1af4aca30f79668bc61a5c00_prof);

    }

    // line 67
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_984d78cd95988e95f2b7f1f0d01ad1e83c828fdb410d39485bb8106cd0e8a100 = $this->env->getExtension("native_profiler");
        $__internal_984d78cd95988e95f2b7f1f0d01ad1e83c828fdb410d39485bb8106cd0e8a100->enter($__internal_984d78cd95988e95f2b7f1f0d01ad1e83c828fdb410d39485bb8106cd0e8a100_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        // line 68
        echo "    ";
        $this->displayParentBlock("javascripts", $context, $blocks);
        echo "

    <link rel=\"stylesheet\" href=\"";
        // line 70
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/ng-grid.min.css"), "html", null, true);
        echo "\" media=\"screen\" />

    ";
        // line 73
        echo "    <script src=\"//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js\"></script>
    <script src=\"//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js\"></script>
    <script src=\"//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.10.0.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/build/ng-grid.min.js"), "html", null, true);
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 77
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/plugins/ng-grid-csv-export.js"), "html", null, true);
        echo "\"></script>
    <script src=\"//cdnjs.cloudflare.com/ajax/libs/angular-i18n/1.2.15/angular-locale_es.js\"></script>

 ";
        // line 158
        echo "


    <script>
        var app = angular.module('statsApp', ['ngGrid', 'ui.bootstrap']);
        app.controller('MyCtrl', function(\$scope, \$http) {

            var setMonth = function setMonth(less){

                less = parseInt(less);

                var now = new Date();
                var after = new Date();
                now.setHours(2,0,0,0);

                now.setMonth(now.getMonth() + less);
                after.setMonth(after.getMonth() + less +1);
                now.setDate(1);
                after.setDate(0);
                after.setHours(25,59,59,999);

                \$scope.dateFrom = now;
                \$scope.dateTo = after;

                console.log(\$scope.dateTo, \$scope.dateFrom);
            }

            var setCurrency = function setCurrency(currency){
                exe();
            }

            \$scope.setCurrency = setCurrency;
            \$scope.setMonth = setMonth;

            function exe(){
                if (\$scope.currencyChange==0){
                    \$http.get('/backoffice/stats_vat/dataEur/'+\$scope.dateFrom.toISOString()+'/'+\$scope.dateTo.toISOString()).success(function(data){
                        \$scope.myData = data;
                    });
                }else{
                    \$http.get('/backoffice/stats_vat/data/'+\$scope.dateFrom.toISOString()+'/'+\$scope.dateTo.toISOString()).success(function(data){
                        \$scope.myData = data;
                    });
                }
            }

            \$scope.gridOptions = {
                data: 'myData',
                plugins: [new ngGridCsvExportPlugin()],
                groups: [],
                rowTemplate: '<div ng-style=\"{ \\'cursor\\': row.cursor }\" ng-repeat=\"col in renderedColumns\" ng-class=\"col.colIndex()\" class=\"ngCell {{col.cellClass}} {{ row.getProperty(\\'color\\') }} \"><div class=\"ngVerticalBar\" ng-style=\"{height: rowHeight}\" ng-class=\"{ ngVerticalBarVisible: !\$last }\">&nbsp;</div><div ng-cell></div></div>',
                showFooter: true,
                showGroupPanel: true,
                jqueryUIDraggable: true,
                columnDefs: [
                    {field:'month', displayName:'Month'},
                    {field:'continent', displayName:'Continent'},
                    {field:'country',name:'country',displayName: 'Country'},
                    {field:'provider', displayName:'Provider'},
                    {field:'pay_method', displayName:'Pay Method'},
                    {field:'country_vat', displayName:'IVA included'},
                    {field:'currency', displayName:'Moneda'},
                    {field:'averageExchangeEur', displayName:'Tasa Cambio media vs EUR', cellFilter: 'currency:\"€\"'},
                    {field:'withoutVat', displayName:'Importe SIN IVA',  cellTemplate: '<div>{{row.entity.withoutVat|number:2}} {{row.entity.symbol}} </div>', cellFilter: 'currency'},
                    {field:'fee', displayName:'Impuestos',  cellTemplate: '<div>{{row.entity.fee|number:2}} {{row.entity.symbol}} </div>', cellFilter: 'currency'},
                    {field:'withVat', displayName:'Importe CON IVA',  cellTemplate: '<div>{{row.entity.withVat|number:2}} {{row.entity.symbol}} </div>', cellFilter: 'currency'}
                ]
            };

            \$scope.dateChange=0;
            setMonth(\$scope.dateChange);
            \$scope.currencyChange=0;
            setCurrency(\$scope.currencyChange);
            exe();

            \$scope.\$watch('[dateFrom,dateTo,currencyChange]', function () { exe() }, true);
        });
    </script>
 ";
        echo "
    <style>

        .color1 {
            background-color: #d0d0d0;
        }

        .color2 {
            background-color: #ffffff;
        }

        .gridStyle {
            border: 1px solid rgb(212,212,212);
        }
        .ngViewport{
            height: auto !important;
        }
        .grid .ui-grid-row .ui-grid-cell .ngCell .ngRow {
            background-color: inherit !important;
        }

        .ngRow.selected {
            background-color: #BDD5FF;
        }

    </style>
";
        
        $__internal_984d78cd95988e95f2b7f1f0d01ad1e83c828fdb410d39485bb8106cd0e8a100->leave($__internal_984d78cd95988e95f2b7f1f0d01ad1e83c828fdb410d39485bb8106cd0e8a100_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Admin/StatsVatToPay:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  151 => 158,  145 => 77,  141 => 76,  136 => 73,  131 => 70,  125 => 68,  119 => 67,  67 => 20,  61 => 19,  41 => 4,  35 => 3,  20 => 1,);
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
/*                 <span>Stats Vat</span>*/
/*             </li>*/
/*         </ol>*/
/* */
/*     </div>*/
/* {% endblock sonata_breadcrumb %}*/
/* */
/* {% block content %}*/
/* */
/*     <div ng-app="statsApp" ng-controller="MyCtrl" style="min-height: 400px">*/
/*         <div class="row" style="margin: 20px 0; z-index: 9999; border-bottom: 1px dashed #ccc;padding-bottom: 20px">*/
/*             <form class="form-inline form-group" role="form">*/
/* */
/*                 <div class="col-md-offset-1 col-md-2">*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <select ng-model="dateChange" class="form-control" ng-click="setMonth(dateChange)">*/
/*                             <option value="0">Este mes</option>*/
/*                             <option value="-1">Mes anterior</option>*/
/*                             <option value="-2">Dos meses atras</option>*/
/*                             <option value="-3">Tres meses atras</option>*/
/*                             <option value="-4">Cuatro meses atras</option>*/
/*                             <option value="-5">Cinco  meses atras</option>*/
/*                             <option value="-6">Seis meses atras</option>*/
/*                         </select>*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="col-md-2" >*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <input type="text" id="dateTo" placeholder="Date to" class="form-control" date-options="{'starting-day': -30}" datepicker-popup="yyyy/MM/dd" ng-model="dateFrom" >*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="col-md-2">*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <input type="text" id="dateTo" placeholder="Date to" class="form-control" date-options="{'starting-day': 1}" datepicker-popup="yyyy/MM/dd" ng-model="dateTo" >*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="col-md-2">*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <select ng-model="currencyChange" class="form-control" ng-click="setCurrency(currencyChange)">*/
/*                             <option value="0">EUR</option>*/
/*                             <option value="-1">Moneda local del pais</option>*/
/*                         </select>*/
/*                     </div>*/
/*                 </div>*/
/* */
/*             </form>*/
/*         </div>*/
/*         <div class="gridStyle" ng-grid="gridOptions">*/
/*         </div>*/
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
/*  {% verbatim %}*/
/* */
/* */
/*     <script>*/
/*         var app = angular.module('statsApp', ['ngGrid', 'ui.bootstrap']);*/
/*         app.controller('MyCtrl', function($scope, $http) {*/
/* */
/*             var setMonth = function setMonth(less){*/
/* */
/*                 less = parseInt(less);*/
/* */
/*                 var now = new Date();*/
/*                 var after = new Date();*/
/*                 now.setHours(2,0,0,0);*/
/* */
/*                 now.setMonth(now.getMonth() + less);*/
/*                 after.setMonth(after.getMonth() + less +1);*/
/*                 now.setDate(1);*/
/*                 after.setDate(0);*/
/*                 after.setHours(25,59,59,999);*/
/* */
/*                 $scope.dateFrom = now;*/
/*                 $scope.dateTo = after;*/
/* */
/*                 console.log($scope.dateTo, $scope.dateFrom);*/
/*             }*/
/* */
/*             var setCurrency = function setCurrency(currency){*/
/*                 exe();*/
/*             }*/
/* */
/*             $scope.setCurrency = setCurrency;*/
/*             $scope.setMonth = setMonth;*/
/* */
/*             function exe(){*/
/*                 if ($scope.currencyChange==0){*/
/*                     $http.get('/backoffice/stats_vat/dataEur/'+$scope.dateFrom.toISOString()+'/'+$scope.dateTo.toISOString()).success(function(data){*/
/*                         $scope.myData = data;*/
/*                     });*/
/*                 }else{*/
/*                     $http.get('/backoffice/stats_vat/data/'+$scope.dateFrom.toISOString()+'/'+$scope.dateTo.toISOString()).success(function(data){*/
/*                         $scope.myData = data;*/
/*                     });*/
/*                 }*/
/*             }*/
/* */
/*             $scope.gridOptions = {*/
/*                 data: 'myData',*/
/*                 plugins: [new ngGridCsvExportPlugin()],*/
/*                 groups: [],*/
/*                 rowTemplate: '<div ng-style="{ \'cursor\': row.cursor }" ng-repeat="col in renderedColumns" ng-class="col.colIndex()" class="ngCell {{col.cellClass}} {{ row.getProperty(\'color\') }} "><div class="ngVerticalBar" ng-style="{height: rowHeight}" ng-class="{ ngVerticalBarVisible: !$last }">&nbsp;</div><div ng-cell></div></div>',*/
/*                 showFooter: true,*/
/*                 showGroupPanel: true,*/
/*                 jqueryUIDraggable: true,*/
/*                 columnDefs: [*/
/*                     {field:'month', displayName:'Month'},*/
/*                     {field:'continent', displayName:'Continent'},*/
/*                     {field:'country',name:'country',displayName: 'Country'},*/
/*                     {field:'provider', displayName:'Provider'},*/
/*                     {field:'pay_method', displayName:'Pay Method'},*/
/*                     {field:'country_vat', displayName:'IVA included'},*/
/*                     {field:'currency', displayName:'Moneda'},*/
/*                     {field:'averageExchangeEur', displayName:'Tasa Cambio media vs EUR', cellFilter: 'currency:"€"'},*/
/*                     {field:'withoutVat', displayName:'Importe SIN IVA',  cellTemplate: '<div>{{row.entity.withoutVat|number:2}} {{row.entity.symbol}} </div>', cellFilter: 'currency'},*/
/*                     {field:'fee', displayName:'Impuestos',  cellTemplate: '<div>{{row.entity.fee|number:2}} {{row.entity.symbol}} </div>', cellFilter: 'currency'},*/
/*                     {field:'withVat', displayName:'Importe CON IVA',  cellTemplate: '<div>{{row.entity.withVat|number:2}} {{row.entity.symbol}} </div>', cellFilter: 'currency'}*/
/*                 ]*/
/*             };*/
/* */
/*             $scope.dateChange=0;*/
/*             setMonth($scope.dateChange);*/
/*             $scope.currencyChange=0;*/
/*             setCurrency($scope.currencyChange);*/
/*             exe();*/
/* */
/*             $scope.$watch('[dateFrom,dateTo,currencyChange]', function () { exe() }, true);*/
/*         });*/
/*     </script>*/
/*  {% endverbatim %}*/
/*     <style>*/
/* */
/*         .color1 {*/
/*             background-color: #d0d0d0;*/
/*         }*/
/* */
/*         .color2 {*/
/*             background-color: #ffffff;*/
/*         }*/
/* */
/*         .gridStyle {*/
/*             border: 1px solid rgb(212,212,212);*/
/*         }*/
/*         .ngViewport{*/
/*             height: auto !important;*/
/*         }*/
/*         .grid .ui-grid-row .ui-grid-cell .ngCell .ngRow {*/
/*             background-color: inherit !important;*/
/*         }*/
/* */
/*         .ngRow.selected {*/
/*             background-color: #BDD5FF;*/
/*         }*/
/* */
/*     </style>*/
/* {% endblock %}*/
/* */
