<?php

/* AppBundle:Others/Stats:index.html.twig */
class __TwigTemplate_9a56dae5bbefc13141dbf048c6566b3663cb5950eabb1a5dd9245fba20b4070e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_95911e40885bf2b7e05c2fea677adf1448eaa157b2f6cfd18131e77202f62609 = $this->env->getExtension("native_profiler");
        $__internal_95911e40885bf2b7e05c2fea677adf1448eaa157b2f6cfd18131e77202f62609->enter($__internal_95911e40885bf2b7e05c2fea677adf1448eaa157b2f6cfd18131e77202f62609_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Others/Stats:index.html.twig"));

        // line 1
        echo "<html ng-app=\"statsApp\">
<head>
    ";
        // line 4
        echo "
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css\" media=\"screen\" >
    <link rel=\"stylesheet\" href=\"https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css\" media=\"screen\" />
    <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/ng-grid.min.css"), "html", null, true);
        echo "\" media=\"screen\" />

    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js\"></script>
    <script src=\"//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js\"></script>
    <script src=\"//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.10.0.js\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bower_components/ng-grid/build/ng-grid.min.js"), "html", null, true);
        echo "\"></script>

    <script>
        var app = angular.module('statsApp', ['ngGrid', 'ui.bootstrap']);
        app.controller('MyCtrl', function(\$scope, \$http) {

            var setMonth = function setMonth(less){

                less = parseInt(less);

                var now = new Date();
                var after = new Date();

                now.setMonth(now.getMonth() + less);
                after.setMonth(after.getMonth() + less + 1);

                now.setDate(1);
                after.setDate(1);

                \$scope.dateFrom = now;
                \$scope.dateTo = after;

                console.log(\$scope.dateTo, \$scope.dateFrom);
            }

            \$scope.setMonth = setMonth;

            function exe(){

                \$http.get('/stats/data/'+\$scope.dateFrom.toISOString()+'/'+\$scope.dateTo.toISOString()).success(function(data){
                    \$scope.myData = data;
                });
            }

            \$scope.gridOptions = {
                data: 'myData',
                showGroupPanel: true,
                jqueryUIDraggable: true,
                columnDefs: [
                    {field:'month', displayName:'Mes'},
                    {field:'country', displayName:'Pais'},
                    {field:'pay_method', displayName:'TipoMedioPago'},
                    {field:'country_vat', displayName:'IVA aplicado'},
                    {field:'currency', displayName:'Moneda'},
                    {field:'averageExchangeEur', displayName:'Tasa Cambio media vs EUR'},

                    {field:'withoutVat', displayName:'Importe SIN IVA'},
                    {field:'fee', displayName:'Impuestos'},
                    {field:'withVat', displayName:'Importe CON IVA'}


                ]
            };

            \$scope.dateChange=0;
            setMonth(\$scope.dateChange);
            exe();

            \$scope.\$watch('[dateFrom,dateTo]', function () { exe() }, true);
        });
    </script>
    <style>
        .gridStyle {
            border: 1px solid rgb(212,212,212);
        }
        .ngViewport{
            height: auto !important;
        }
    </style>
</head>
<body ng-controller=\"MyCtrl\">
    <div class=\"container\">
        <div class=\"row\" style=\"margin: 20px 0\">
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

                <div class=\"col-md-3\">
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <input type=\"text\" id=\"dateTo\" placeholder=\"Date to\" class=\"form-control\" date-options=\"{'starting-day': 1}\" datepicker-popup=\"yyyy/MM/dd\" ng-model=\"dateFrom\" >
                    </div>
                </div>

                <div class=\"col-md-3\">
                    <div class=\"input-group\" style=\"width: 100%;\">
                        <input type=\"text\" id=\"dateTo\" placeholder=\"Date to\" class=\"form-control\" date-options=\"{'starting-day': 1}\" datepicker-popup=\"yyyy/MM/dd\" ng-model=\"dateTo\" >
                    </div>
                </div>

            </form>
        </div>
        <div class=\"gridStyle\" ng-grid=\"gridOptions\">
        </div>
    </div>
</body>
</html>";
        
        $__internal_95911e40885bf2b7e05c2fea677adf1448eaa157b2f6cfd18131e77202f62609->leave($__internal_95911e40885bf2b7e05c2fea677adf1448eaa157b2f6cfd18131e77202f62609_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Others/Stats:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 13,  31 => 7,  26 => 4,  22 => 1,);
    }
}
/* <html ng-app="statsApp">*/
/* <head>*/
/*     {#<link rel="stylesheet" href="http://ui-grid.info/release/ui-grid-unstable.min.css" media="screen" />#}*/
/* */
/*     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" media="screen" >*/
/*     <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" media="screen" />*/
/*     <link rel="stylesheet" href="{{asset('bower_components/ng-grid/ng-grid.min.css')}}" media="screen" />*/
/* */
/*     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>*/
/*     <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>*/
/*     <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.19/angular.min.js"></script>*/
/*     <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.10.0.js"></script>*/
/*     <script type="text/javascript" src="{{asset('bower_components/ng-grid/build/ng-grid.min.js')}}"></script>*/
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
/* */
/*                 now.setMonth(now.getMonth() + less);*/
/*                 after.setMonth(after.getMonth() + less + 1);*/
/* */
/*                 now.setDate(1);*/
/*                 after.setDate(1);*/
/* */
/*                 $scope.dateFrom = now;*/
/*                 $scope.dateTo = after;*/
/* */
/*                 console.log($scope.dateTo, $scope.dateFrom);*/
/*             }*/
/* */
/*             $scope.setMonth = setMonth;*/
/* */
/*             function exe(){*/
/* */
/*                 $http.get('/stats/data/'+$scope.dateFrom.toISOString()+'/'+$scope.dateTo.toISOString()).success(function(data){*/
/*                     $scope.myData = data;*/
/*                 });*/
/*             }*/
/* */
/*             $scope.gridOptions = {*/
/*                 data: 'myData',*/
/*                 showGroupPanel: true,*/
/*                 jqueryUIDraggable: true,*/
/*                 columnDefs: [*/
/*                     {field:'month', displayName:'Mes'},*/
/*                     {field:'country', displayName:'Pais'},*/
/*                     {field:'pay_method', displayName:'TipoMedioPago'},*/
/*                     {field:'country_vat', displayName:'IVA aplicado'},*/
/*                     {field:'currency', displayName:'Moneda'},*/
/*                     {field:'averageExchangeEur', displayName:'Tasa Cambio media vs EUR'},*/
/* */
/*                     {field:'withoutVat', displayName:'Importe SIN IVA'},*/
/*                     {field:'fee', displayName:'Impuestos'},*/
/*                     {field:'withVat', displayName:'Importe CON IVA'}*/
/* */
/* */
/*                 ]*/
/*             };*/
/* */
/*             $scope.dateChange=0;*/
/*             setMonth($scope.dateChange);*/
/*             exe();*/
/* */
/*             $scope.$watch('[dateFrom,dateTo]', function () { exe() }, true);*/
/*         });*/
/*     </script>*/
/*     <style>*/
/*         .gridStyle {*/
/*             border: 1px solid rgb(212,212,212);*/
/*         }*/
/*         .ngViewport{*/
/*             height: auto !important;*/
/*         }*/
/*     </style>*/
/* </head>*/
/* <body ng-controller="MyCtrl">*/
/*     <div class="container">*/
/*         <div class="row" style="margin: 20px 0">*/
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
/*                 <div class="col-md-3">*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <input type="text" id="dateTo" placeholder="Date to" class="form-control" date-options="{'starting-day': 1}" datepicker-popup="yyyy/MM/dd" ng-model="dateFrom" >*/
/*                     </div>*/
/*                 </div>*/
/* */
/*                 <div class="col-md-3">*/
/*                     <div class="input-group" style="width: 100%;">*/
/*                         <input type="text" id="dateTo" placeholder="Date to" class="form-control" date-options="{'starting-day': 1}" datepicker-popup="yyyy/MM/dd" ng-model="dateTo" >*/
/*                     </div>*/
/*                 </div>*/
/* */
/*             </form>*/
/*         </div>*/
/*         <div class="gridStyle" ng-grid="gridOptions">*/
/*         </div>*/
/*     </div>*/
/* </body>*/
/* </html>*/
