<?php

/* AppBundle:PaymentHosted/CreditCard:creditCard.html.twig */
class __TwigTemplate_4e6a17cbda5fd481c62f1a853045cb80420563cae0567c4bacc93c360c5627c9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@App/PaymentHosted/layout_pay_method_hosted.html.twig", "AppBundle:PaymentHosted/CreditCard:creditCard.html.twig", 1);
        $this->blocks = array(
            'page' => array($this, 'block_page'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/PaymentHosted/layout_pay_method_hosted.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_6e7b50a49ffa95279b1719dcc9e407cc678a988040baee79805f7c3bf79581aa = $this->env->getExtension("native_profiler");
        $__internal_6e7b50a49ffa95279b1719dcc9e407cc678a988040baee79805f7c3bf79581aa->enter($__internal_6e7b50a49ffa95279b1719dcc9e407cc678a988040baee79805f7c3bf79581aa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:PaymentHosted/CreditCard:creditCard.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_6e7b50a49ffa95279b1719dcc9e407cc678a988040baee79805f7c3bf79581aa->leave($__internal_6e7b50a49ffa95279b1719dcc9e407cc678a988040baee79805f7c3bf79581aa_prof);

    }

    // line 2
    public function block_page($context, array $blocks = array())
    {
        $__internal_33ccea296e133c4029ec64984f6e8ad9885d42936f659a0f93e06698467e75e4 = $this->env->getExtension("native_profiler");
        $__internal_33ccea296e133c4029ec64984f6e8ad9885d42936f659a0f93e06698467e75e4->enter($__internal_33ccea296e133c4029ec64984f6e8ad9885d42936f659a0f93e06698467e75e4_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "page"));

        // line 3
        echo "
    <style>

        .credit-cards-logos{
            cursor: pointer;
            border: 3px solid #fff;
        }
        .credit-cards-logos, .form-credit-card{
            transition: 0.5s linear;
        }
        .credit-cards-logos.selected{
            border: 3px solid #00c329;
            margin: 0px 80px;
        }
        .credit-card-container{
            margin-bottom: 20px;
            margin-left: 50px;
        }
        .credit-card-front, .credit-card-end{
            max-width: 400px;
            min-height: 220px;
        }
        .credit-card-front{
            background-color: #FCFCFC;
            border-radius: 8px;
            border: 1px solid #bbb;
            padding: 30px;
            margin-top: -187px;
        }
        .credit-card-end{
            background-color: #ededed;
            border-radius: 8px;
            border: 1px solid #c6c6c6;
            min-resolution: 200px;
            margin-left: 200px;
        }
        .credit-card-end .in{
            padding: 20px;
            clear: both;
            float: right;
            width: 195px;
        }
        .credit-card-end:before{
            display: block;
            width: 100%;
            height: 50px;
            content: '';
            background: #a2a2a2;
            margin-top: 50px;
            border: 1px solid #777;
        }
        ul.help-block{
            padding-left: 0;
        }
        ul li{
            list-style-type: none;
        }
        .button-box{
            margin: 30px 50px;
            text-align: right;
        }



    </style>

    <div class=\"row voffset3\">
        <div class=\"col-md-12\">
            <h1>";
        // line 71
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("credit_card.title"), "html", null, true);
        echo " </h1>
            <h3>";
        // line 72
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.follow_instructions"), "html", null, true);
        echo "</h3>

            <div>
                <blockquote>
                    <span class=\"text-info\">";
        // line 76
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.step_1"), "html", null, true);
        echo ".</span> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("credit_card.step_1_desc"), "html", null, true);
        echo "
                </blockquote>

                <div style=\"height: 100px;\">
                ";
        // line 80
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["formsAvailable"]) ? $context["formsAvailable"] : $this->getContext($context, "formsAvailable")));
        foreach ($context['_seq'] as $context["_key"] => $context["form"]) {
            // line 81
            echo "                    <div id=\"logo-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["form"], "name", array()), "html", null, true);
            echo "\" class=\"credit-cards-logos\" onclick=\"select('";
            echo twig_escape_filter($this->env, $this->getAttribute($context["form"], "name", array()), "html", null, true);
            echo "')\" style=\"display: inline-block\">
                        <img src=\"";
            // line 82
            echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl((("bundles/app/payment_hosted/img/" . twig_lower_filter($this->env, $this->getAttribute($context["form"], "name", array()))) . ".png")), "html", null, true);
            echo "\">
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['form'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 85
        echo "                </div>

                <blockquote>
                    <span class=\"text-info\">";
        // line 88
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("sms.logic_mo_mt_code.step_2"), "html", null, true);
        echo ".</span> ";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("credit_card.step_2_desc"), "html", null, true);
        echo "
                </blockquote>

                <div class=\"row voffset3\">
                    ";
        // line 92
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["formsAvailable"]) ? $context["formsAvailable"] : $this->getContext($context, "formsAvailable")));
        foreach ($context['_seq'] as $context["_key"] => $context["form"]) {
            // line 93
            echo "                        <form method=\"post\" role=\"form\" id=\"form-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["form"], "name", array()), "html", null, true);
            echo "\" class=\"form-credit-card\" style=\"min-width: 600px\">
                            <div class=\"credit-card-container\">
                                <div class=\"credit-card-end\">
                                    <div class=\"in\">
                                        <div class=\"form-group ";
            // line 97
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cvv", array()), "vars", array()), "errors", array()))) {
                echo "has-error";
            }
            echo "\">
                                            ";
            // line 98
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cvv", array()), 'label');
            echo "
                                            <div class=\"input-group\">
                                            <span class=\"input-group-addon\" id=\"sizing-addon2\">
                                                 <i class=\"glyphicon glyphicon-lock\"></i>
                                            </span>
                                            ";
            // line 103
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cvv", array()), 'widget');
            echo "
                                            </div>
                                            <div class=\"text-danger\">
                                                ";
            // line 106
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cvv", array()), 'errors');
            echo "
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"credit-card-front\">

                                    <div class=\"row \" style=\"display: inline-block; margin-bottom: 17px\">
                                        <div class=\"col-xs-8 ";
            // line 114
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cardNumber", array()), "vars", array()), "errors", array()))) {
                echo "has-error";
            }
            echo "\" style=\"min-width: \">
                                            ";
            // line 115
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cardNumber", array()), 'label');
            echo "
                                            <div class=\"input-group\">
                                                <span class=\"input-group-addon\">
                                                     <i class=\"glyphicon glyphicon-credit-card\"></i>
                                                </span>
                                                ";
            // line 120
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cardNumber", array()), 'widget');
            echo "
                                            </div>
                                            <div class=\"text-danger\">
                                                ";
            // line 123
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "cardNumber", array()), 'errors');
            echo "
                                            </div>
                                        </div>

                                        <div class=\"col-xs-4 ";
            // line 127
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "expireDate", array()), "vars", array()), "errors", array()))) {
                echo "has-error";
            }
            echo "\">
                                            ";
            // line 128
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "expireDate", array()), 'label');
            echo "
                                            ";
            // line 129
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "expireDate", array()), 'widget');
            echo "
                                            <div class=\"text-danger\">
                                                ";
            // line 131
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "expireDate", array()), 'errors');
            echo "
                                            </div>
                                        </div>

                                    </div>


                                    <div class=\"row \" style=\"display: inline-block; margin-bottom: 17px\">
                                        <div class=\"col-xs-6 ";
            // line 139
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerFirstName", array()), "vars", array()), "errors", array()))) {
                echo "has-error";
            }
            echo "\">
                                            ";
            // line 140
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerFirstName", array()), 'label');
            echo "
                                            <div class=\"input-group\">
                                            <span class=\"input-group-addon\">
                                                 <i class=\"glyphicon glyphicon-user\"></i>
                                            </span>
                                                ";
            // line 145
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerFirstName", array()), 'widget');
            echo "
                                            </div>
                                            <div class=\"text-danger\">
                                                ";
            // line 148
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerFirstName", array()), 'errors');
            echo "
                                            </div>
                                        </div>
                                        <div class=\"col-xs-6 ";
            // line 151
            if (twig_length_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerLastName", array()), "vars", array()), "errors", array()))) {
                echo "has-error";
            }
            echo "\">
                                            ";
            // line 152
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerLastName", array()), 'label');
            echo "
                                            <div class=\"input-group\">
                                            <span class=\"input-group-addon\">
                                                 <i class=\"glyphicon glyphicon-user\"></i>
                                            </span>
                                                ";
            // line 157
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerLastName", array()), 'widget');
            echo "
                                            </div>
                                            <div class=\"text-danger\">
                                                ";
            // line 160
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($this->getAttribute($context["form"], "form_view", array()), "ownerLastName", array()), 'errors');
            echo "
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                ";
            // line 168
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["form"], "form_view", array()), 'rest');
            echo "
                            </div>

                            <div class=\"button-box\">
                                <button type=\"submit\" class=\"btn btn-primary btn-lg\" style=\"min-width: 150px;;\" aria-label=\"Left Align\">
                                    <span class=\"glyphicon glyphicon-send\" aria-hidden=\"true\"></span> ";
            // line 173
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("form.generic.submit"), "html", null, true);
            echo "
                                </button>
                            </div>

                        </form>

                        <div class=\"text-danger\">";
            // line 179
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["form"], "form_view", array()), 'errors');
            echo "</div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['form'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 181
        echo "                </div>


            </div>

        </div>

        <div style=\"margin: 20px\">
            ";
        // line 189
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("credit_card.footer"), "html", null, true);
        echo "
        </div>

    </div>

    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>
    <script src=\"";
        // line 195
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("js_glob/jquery.maskedinput.min.js"), "html", null, true);
        echo "\"></script>

    <script>
        function select(name)
        {
            hideAll();

            var logo = document.getElementById(\"logo-\"+name);
            logo.className=\"credit-cards-logos selected\";

            var elem = document.getElementById(\"form-\"+name);
            elem.style.display = \"block\";

            setTimeout(function(){elem.style.opacity = \"1\";}, 100);
        }

        function hideAll()
        {
            var forms = document.getElementsByClassName(\"form-credit-card\");
            for (i = 0; i < forms.length; i++) {
                forms[i].style.opacity = \"0\";
                forms[i].style.display =\"none\" ;
            }

            var creditCardsLogos = document.getElementsByClassName(\"credit-cards-logos\");
            for (i = 0; i < creditCardsLogos.length; i++) {
                creditCardsLogos[i].className =\"credit-cards-logos\";
            }
        }

        function format()
        {
            \$(\"input[data-mask]\").each(function( index, element ) {
                element=\$(element);

                var obj = {};
                if (element.attr('placeholder'))
                    obj.placeholder = element.attr('placeholder');

                element.mask(element.attr('data-mask'), obj);
            });
        }

        hideAll();
        format();
        ";
        // line 240
        if ((isset($context["beforeSelected"]) ? $context["beforeSelected"] : $this->getContext($context, "beforeSelected"))) {
            // line 241
            echo "            select('";
            echo twig_escape_filter($this->env, (isset($context["beforeSelected"]) ? $context["beforeSelected"] : $this->getContext($context, "beforeSelected")), "html", null, true);
            echo "');
        ";
        }
        // line 243
        echo "


    </script>


";
        
        $__internal_33ccea296e133c4029ec64984f6e8ad9885d42936f659a0f93e06698467e75e4->leave($__internal_33ccea296e133c4029ec64984f6e8ad9885d42936f659a0f93e06698467e75e4_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:PaymentHosted/CreditCard:creditCard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  417 => 243,  411 => 241,  409 => 240,  361 => 195,  352 => 189,  342 => 181,  334 => 179,  325 => 173,  317 => 168,  306 => 160,  300 => 157,  292 => 152,  286 => 151,  280 => 148,  274 => 145,  266 => 140,  260 => 139,  249 => 131,  244 => 129,  240 => 128,  234 => 127,  227 => 123,  221 => 120,  213 => 115,  207 => 114,  196 => 106,  190 => 103,  182 => 98,  176 => 97,  168 => 93,  164 => 92,  155 => 88,  150 => 85,  141 => 82,  134 => 81,  130 => 80,  121 => 76,  114 => 72,  110 => 71,  40 => 3,  34 => 2,  11 => 1,);
    }
}
/* {% extends '@App/PaymentHosted/layout_pay_method_hosted.html.twig' %}*/
/* {% block page %}*/
/* */
/*     <style>*/
/* */
/*         .credit-cards-logos{*/
/*             cursor: pointer;*/
/*             border: 3px solid #fff;*/
/*         }*/
/*         .credit-cards-logos, .form-credit-card{*/
/*             transition: 0.5s linear;*/
/*         }*/
/*         .credit-cards-logos.selected{*/
/*             border: 3px solid #00c329;*/
/*             margin: 0px 80px;*/
/*         }*/
/*         .credit-card-container{*/
/*             margin-bottom: 20px;*/
/*             margin-left: 50px;*/
/*         }*/
/*         .credit-card-front, .credit-card-end{*/
/*             max-width: 400px;*/
/*             min-height: 220px;*/
/*         }*/
/*         .credit-card-front{*/
/*             background-color: #FCFCFC;*/
/*             border-radius: 8px;*/
/*             border: 1px solid #bbb;*/
/*             padding: 30px;*/
/*             margin-top: -187px;*/
/*         }*/
/*         .credit-card-end{*/
/*             background-color: #ededed;*/
/*             border-radius: 8px;*/
/*             border: 1px solid #c6c6c6;*/
/*             min-resolution: 200px;*/
/*             margin-left: 200px;*/
/*         }*/
/*         .credit-card-end .in{*/
/*             padding: 20px;*/
/*             clear: both;*/
/*             float: right;*/
/*             width: 195px;*/
/*         }*/
/*         .credit-card-end:before{*/
/*             display: block;*/
/*             width: 100%;*/
/*             height: 50px;*/
/*             content: '';*/
/*             background: #a2a2a2;*/
/*             margin-top: 50px;*/
/*             border: 1px solid #777;*/
/*         }*/
/*         ul.help-block{*/
/*             padding-left: 0;*/
/*         }*/
/*         ul li{*/
/*             list-style-type: none;*/
/*         }*/
/*         .button-box{*/
/*             margin: 30px 50px;*/
/*             text-align: right;*/
/*         }*/
/* */
/* */
/* */
/*     </style>*/
/* */
/*     <div class="row voffset3">*/
/*         <div class="col-md-12">*/
/*             <h1>{{ 'credit_card.title' | trans }} </h1>*/
/*             <h3>{{'sms.follow_instructions' | trans }}</h3>*/
/* */
/*             <div>*/
/*                 <blockquote>*/
/*                     <span class="text-info">{{ 'sms.logic_mo_mt_code.step_1' | trans }}.</span> {{ 'credit_card.step_1_desc' | trans }}*/
/*                 </blockquote>*/
/* */
/*                 <div style="height: 100px;">*/
/*                 {% for form in formsAvailable  %}*/
/*                     <div id="logo-{{form.name}}" class="credit-cards-logos" onclick="select('{{form.name}}')" style="display: inline-block">*/
/*                         <img src="{{ asset('bundles/app/payment_hosted/img/'~ form.name |lower ~'.png') }}">*/
/*                     </div>*/
/*                 {% endfor %}*/
/*                 </div>*/
/* */
/*                 <blockquote>*/
/*                     <span class="text-info">{{ 'sms.logic_mo_mt_code.step_2' | trans }}.</span> {{ 'credit_card.step_2_desc' | trans }}*/
/*                 </blockquote>*/
/* */
/*                 <div class="row voffset3">*/
/*                     {% for form in formsAvailable %}*/
/*                         <form method="post" role="form" id="form-{{form.name}}" class="form-credit-card" style="min-width: 600px">*/
/*                             <div class="credit-card-container">*/
/*                                 <div class="credit-card-end">*/
/*                                     <div class="in">*/
/*                                         <div class="form-group {% if form.form_view.cvv.vars.errors|length %}has-error{% endif %}">*/
/*                                             {{ form_label(form.form_view.cvv) }}*/
/*                                             <div class="input-group">*/
/*                                             <span class="input-group-addon" id="sizing-addon2">*/
/*                                                  <i class="glyphicon glyphicon-lock"></i>*/
/*                                             </span>*/
/*                                             {{ form_widget(form.form_view.cvv) }}*/
/*                                             </div>*/
/*                                             <div class="text-danger">*/
/*                                                 {{ form_errors(form.form_view.cvv) }}*/
/*                                             </div>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                                 <div class="credit-card-front">*/
/* */
/*                                     <div class="row " style="display: inline-block; margin-bottom: 17px">*/
/*                                         <div class="col-xs-8 {% if form.form_view.cardNumber.vars.errors|length %}has-error{% endif %}" style="min-width: ">*/
/*                                             {{ form_label(form.form_view.cardNumber) }}*/
/*                                             <div class="input-group">*/
/*                                                 <span class="input-group-addon">*/
/*                                                      <i class="glyphicon glyphicon-credit-card"></i>*/
/*                                                 </span>*/
/*                                                 {{ form_widget(form.form_view.cardNumber) }}*/
/*                                             </div>*/
/*                                             <div class="text-danger">*/
/*                                                 {{ form_errors(form.form_view.cardNumber) }}*/
/*                                             </div>*/
/*                                         </div>*/
/* */
/*                                         <div class="col-xs-4 {% if form.form_view.expireDate.vars.errors|length %}has-error{% endif %}">*/
/*                                             {{ form_label(form.form_view.expireDate) }}*/
/*                                             {{ form_widget(form.form_view.expireDate) }}*/
/*                                             <div class="text-danger">*/
/*                                                 {{ form_errors(form.form_view.expireDate) }}*/
/*                                             </div>*/
/*                                         </div>*/
/* */
/*                                     </div>*/
/* */
/* */
/*                                     <div class="row " style="display: inline-block; margin-bottom: 17px">*/
/*                                         <div class="col-xs-6 {% if form.form_view.ownerFirstName.vars.errors|length %}has-error{% endif %}">*/
/*                                             {{ form_label(form.form_view.ownerFirstName) }}*/
/*                                             <div class="input-group">*/
/*                                             <span class="input-group-addon">*/
/*                                                  <i class="glyphicon glyphicon-user"></i>*/
/*                                             </span>*/
/*                                                 {{ form_widget(form.form_view.ownerFirstName) }}*/
/*                                             </div>*/
/*                                             <div class="text-danger">*/
/*                                                 {{ form_errors(form.form_view.ownerFirstName) }}*/
/*                                             </div>*/
/*                                         </div>*/
/*                                         <div class="col-xs-6 {% if form.form_view.ownerLastName.vars.errors|length %}has-error{% endif %}">*/
/*                                             {{ form_label(form.form_view.ownerLastName) }}*/
/*                                             <div class="input-group">*/
/*                                             <span class="input-group-addon">*/
/*                                                  <i class="glyphicon glyphicon-user"></i>*/
/*                                             </span>*/
/*                                                 {{ form_widget(form.form_view.ownerLastName) }}*/
/*                                             </div>*/
/*                                             <div class="text-danger">*/
/*                                                 {{ form_errors(form.form_view.ownerLastName) }}*/
/*                                             </div>*/
/*                                         </div>*/
/*                                     </div>*/
/*                                 </div>*/
/*                             </div>*/
/* */
/*                             <div>*/
/*                                 {{ form_rest(form.form_view) }}*/
/*                             </div>*/
/* */
/*                             <div class="button-box">*/
/*                                 <button type="submit" class="btn btn-primary btn-lg" style="min-width: 150px;;" aria-label="Left Align">*/
/*                                     <span class="glyphicon glyphicon-send" aria-hidden="true"></span> {{ 'form.generic.submit' | trans }}*/
/*                                 </button>*/
/*                             </div>*/
/* */
/*                         </form>*/
/* */
/*                         <div class="text-danger">{{ form_errors(form.form_view) }}</div>*/
/*                     {% endfor %}*/
/*                 </div>*/
/* */
/* */
/*             </div>*/
/* */
/*         </div>*/
/* */
/*         <div style="margin: 20px">*/
/*             {{ 'credit_card.footer' | trans }}*/
/*         </div>*/
/* */
/*     </div>*/
/* */
/*     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>*/
/*     <script src="{{ asset('js_glob/jquery.maskedinput.min.js') }}"></script>*/
/* */
/*     <script>*/
/*         function select(name)*/
/*         {*/
/*             hideAll();*/
/* */
/*             var logo = document.getElementById("logo-"+name);*/
/*             logo.className="credit-cards-logos selected";*/
/* */
/*             var elem = document.getElementById("form-"+name);*/
/*             elem.style.display = "block";*/
/* */
/*             setTimeout(function(){elem.style.opacity = "1";}, 100);*/
/*         }*/
/* */
/*         function hideAll()*/
/*         {*/
/*             var forms = document.getElementsByClassName("form-credit-card");*/
/*             for (i = 0; i < forms.length; i++) {*/
/*                 forms[i].style.opacity = "0";*/
/*                 forms[i].style.display ="none" ;*/
/*             }*/
/* */
/*             var creditCardsLogos = document.getElementsByClassName("credit-cards-logos");*/
/*             for (i = 0; i < creditCardsLogos.length; i++) {*/
/*                 creditCardsLogos[i].className ="credit-cards-logos";*/
/*             }*/
/*         }*/
/* */
/*         function format()*/
/*         {*/
/*             $("input[data-mask]").each(function( index, element ) {*/
/*                 element=$(element);*/
/* */
/*                 var obj = {};*/
/*                 if (element.attr('placeholder'))*/
/*                     obj.placeholder = element.attr('placeholder');*/
/* */
/*                 element.mask(element.attr('data-mask'), obj);*/
/*             });*/
/*         }*/
/* */
/*         hideAll();*/
/*         format();*/
/*         {% if beforeSelected %}*/
/*             select('{{beforeSelected}}');*/
/*         {% endif %}*/
/* */
/* */
/* */
/*     </script>*/
/* */
/* */
/* {% endblock %}*/
