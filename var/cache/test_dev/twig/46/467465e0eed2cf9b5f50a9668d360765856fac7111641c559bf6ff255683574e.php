<?php

/* NelmioApiDocBundle::method.html.twig */
class __TwigTemplate_e9d4467a2a678dc508dca952ef48cde0e391570a5d067cbc7fe5a008b61529db extends Twig_Template
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
        $__internal_3e9367f9e2aeeacc431e23fffffeafce8194b26ad28d50d111c0e2e6b9fb297a = $this->env->getExtension("native_profiler");
        $__internal_3e9367f9e2aeeacc431e23fffffeafce8194b26ad28d50d111c0e2e6b9fb297a->enter($__internal_3e9367f9e2aeeacc431e23fffffeafce8194b26ad28d50d111c0e2e6b9fb297a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "NelmioApiDocBundle::method.html.twig"));

        // line 1
        echo "<li class=\"";
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "method", array())), "html", null, true);
        echo " operation\" id=\"";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "id", array()), "html", null, true);
        echo "\">
<div class=\"heading toggler";
        // line 2
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "deprecated", array())) {
            echo " deprecated";
        }
        echo "\" data-href=\"#";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "id", array()), "html", null, true);
        echo "\">
    <h3>
            <span class=\"http_method\">
                <i>";
        // line 5
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "method", array())), "html", null, true);
        echo "</i>
            </span>

        ";
        // line 8
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "deprecated", array())) {
            // line 9
            echo "            <span class=\"deprecated\">
                <i>DEPRECATED</i>
            </span>
        ";
        }
        // line 13
        echo "
        ";
        // line 14
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "https", array())) {
            // line 15
            echo "            <span class=\"icon lock\" title=\"HTTPS\"></span>
        ";
        }
        // line 17
        echo "        ";
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "authentication", array())) {
            // line 18
            echo "            <span class=\"icon keys\" title=\"Needs ";
            echo twig_escape_filter($this->env, (((twig_length_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "authenticationRoles", array())) > 0)) ? (twig_join_filter($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "authenticationRoles", array()), ", ")) : ("authentication")), "html", null, true);
            echo "\"></span>
        ";
        }
        // line 20
        echo "
        <span class=\"path\">
                ";
        // line 22
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "host", array(), "any", true, true)) {
            // line 23
            echo (($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "https", array())) ? ("https://") : ("http://"));
            // line 24
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "host", array()), "html", null, true);
        }
        // line 26
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "uri", array()), "html", null, true);
        echo "
            </span>
        ";
        // line 28
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "tags", array(), "any", true, true)) {
            // line 29
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "tags", array()));
            foreach ($context['_seq'] as $context["tag"] => $context["color_code"]) {
                // line 30
                echo "                <span class=\"tag\" ";
                if ((array_key_exists("color_code", $context) &&  !twig_test_empty($context["color_code"]))) {
                    echo "style=\"background-color:";
                    echo twig_escape_filter($this->env, $context["color_code"], "html", null, true);
                    echo ";\"";
                }
                echo ">";
                echo twig_escape_filter($this->env, $context["tag"], "html", null, true);
                echo "</span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['tag'], $context['color_code'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 32
            echo "        ";
        }
        // line 33
        echo "    </h3>
    <ul class=\"options\">
        ";
        // line 35
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "description", array(), "any", true, true)) {
            // line 36
            echo "            <li>";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "description", array()), "html", null, true);
            echo "</li>
        ";
        }
        // line 38
        echo "    </ul>
</div>

<div class=\"content\" style=\"display: ";
        // line 41
        if ((array_key_exists("displayContent", $context) && ((isset($context["displayContent"]) ? $context["displayContent"] : $this->getContext($context, "displayContent")) == true))) {
            echo "display";
        } else {
            echo "none";
        }
        echo ";\">
<ul class=\"tabs\">
    ";
        // line 43
        if ((isset($context["enableSandbox"]) ? $context["enableSandbox"] : $this->getContext($context, "enableSandbox"))) {
            // line 44
            echo "        <li class=\"selected\" data-pane=\"content\">Documentation</li>
        <li data-pane=\"sandbox\">Sandbox</li>
    ";
        }
        // line 47
        echo "</ul>

<div class=\"panes\">
<div class=\"pane content selected\">
    ";
        // line 51
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "documentation", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "documentation", array())))) {
            // line 52
            echo "        <h4>Documentation</h4>
        <div>";
            // line 53
            echo $this->env->getExtension('nelmio_api_doc')->markdown($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "documentation", array()));
            echo "</div>
    ";
        }
        // line 55
        echo "
    ";
        // line 56
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "link", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "link", array())))) {
            // line 57
            echo "        <h4>Link</h4>
        <div><a href=\"";
            // line 58
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "link", array()), "html", null, true);
            echo "\" target=\"_blank\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "link", array()), "html", null, true);
            echo "</a></div>
    ";
        }
        // line 60
        echo "
    ";
        // line 61
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "requirements", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "requirements", array())))) {
            // line 62
            echo "        <h4>Requirements</h4>
        <table class=\"fullwidth\">
            <thead>
            <tr>
                <th>Name</th>
                <th>Requirement</th>
                <th>Type</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 73
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "requirements", array()));
            foreach ($context['_seq'] as $context["name"] => $context["infos"]) {
                // line 74
                echo "                <tr>
                    <td>";
                // line 75
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "</td>
                    <td>";
                // line 76
                echo twig_escape_filter($this->env, (($this->getAttribute($context["infos"], "requirement", array(), "any", true, true)) ? ($this->getAttribute($context["infos"], "requirement", array())) : ("")), "html", null, true);
                echo "</td>
                    <td>";
                // line 77
                echo twig_escape_filter($this->env, (($this->getAttribute($context["infos"], "dataType", array(), "any", true, true)) ? ($this->getAttribute($context["infos"], "dataType", array())) : ("")), "html", null, true);
                echo "</td>
                    <td>";
                // line 78
                echo twig_escape_filter($this->env, (($this->getAttribute($context["infos"], "description", array(), "any", true, true)) ? ($this->getAttribute($context["infos"], "description", array())) : ("")), "html", null, true);
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['infos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 81
            echo "            </tbody>
        </table>
    ";
        }
        // line 84
        echo "
    ";
        // line 85
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "filters", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "filters", array())))) {
            // line 86
            echo "        <h4>Filters</h4>
        <table class=\"fullwidth\">
            <thead>
            <tr>
                <th>Name</th>
                <th>Information</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 95
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "filters", array()));
            foreach ($context['_seq'] as $context["name"] => $context["infos"]) {
                // line 96
                echo "                <tr>
                    <td>";
                // line 97
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "</td>
                    <td>
                        <table>
                            ";
                // line 100
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["infos"]);
                foreach ($context['_seq'] as $context["key"] => $context["value"]) {
                    // line 101
                    echo "                                <tr>
                                    <td>";
                    // line 102
                    echo twig_escape_filter($this->env, twig_title_string_filter($this->env, $context["key"]), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 103
                    echo twig_escape_filter($this->env, trim(twig_replace_filter(twig_jsonencode_filter($context["value"]), array("\\\\" => "\\")), "\""), "html", null, true);
                    echo "</td>
                                </tr>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['key'], $context['value'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 106
                echo "                        </table>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['infos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 110
            echo "            </tbody>
        </table>
    ";
        }
        // line 113
        echo "
    ";
        // line 114
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "parameters", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "parameters", array())))) {
            // line 115
            echo "        <h4>Parameters</h4>
        <table class='fullwidth'>
            <thead>
            <tr>
                <th>Parameter</th>
                <th>Type</th>
                <th>Required?</th>
                <th>Format</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 127
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "parameters", array()));
            foreach ($context['_seq'] as $context["name"] => $context["infos"]) {
                // line 128
                echo "                ";
                if ( !$this->getAttribute($context["infos"], "readonly", array())) {
                    // line 129
                    echo "                    <tr>
                        <td>";
                    // line 130
                    echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                    echo "</td>
                        <td>";
                    // line 131
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["infos"], "dataType", array(), "any", true, true)) ? ($this->getAttribute($context["infos"], "dataType", array())) : ("")), "html", null, true);
                    echo "</td>
                        <td>";
                    // line 132
                    echo (($this->getAttribute($context["infos"], "required", array())) ? ("true") : ("false"));
                    echo "</td>
                        <td>";
                    // line 133
                    echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "format", array()), "html", null, true);
                    echo "</td>
                        <td>";
                    // line 134
                    echo twig_escape_filter($this->env, (($this->getAttribute($context["infos"], "description", array(), "any", true, true)) ? ($this->getAttribute($context["infos"], "description", array())) : ("")), "html", null, true);
                    echo "</td>
                    </tr>
                ";
                }
                // line 137
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['infos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 138
            echo "            </tbody>
        </table>
    ";
        }
        // line 141
        echo "
    ";
        // line 142
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "response", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "response", array())))) {
            // line 143
            echo "        <h4>Return</h4>
        <table class='fullwidth'>
            <thead>
            <tr>
                <th>Parameter</th>
                <th>Type</th>
                <th>Versions</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 154
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "response", array()));
            foreach ($context['_seq'] as $context["name"] => $context["infos"]) {
                // line 155
                echo "                <tr>
                    <td>";
                // line 156
                echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                echo "</td>
                    <td>";
                // line 157
                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "dataType", array()), "html", null, true);
                echo "</td>
                    <td>";
                // line 158
                $this->loadTemplate("NelmioApiDocBundle:Components:version.html.twig", "NelmioApiDocBundle::method.html.twig", 158)->display(array("sinceVersion" => $this->getAttribute($context["infos"], "sinceVersion", array()), "untilVersion" => $this->getAttribute($context["infos"], "untilVersion", array())));
                echo "</td>
                    <td>";
                // line 159
                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "description", array()), "html", null, true);
                echo "</td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['infos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 162
            echo "            </tbody>
        </table>
    ";
        }
        // line 165
        echo "
    ";
        // line 166
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "statusCodes", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "statusCodes", array())))) {
            // line 167
            echo "        <h4>Status Codes</h4>
        <table class=\"fullwidth\">
            <thead>
            <tr>
                <th>Status Code</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            ";
            // line 176
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "statusCodes", array()));
            foreach ($context['_seq'] as $context["status_code"] => $context["descriptions"]) {
                // line 177
                echo "                <tr>
                    <td><a href=\"http://en.wikipedia.org/wiki/HTTP_";
                // line 178
                echo twig_escape_filter($this->env, $context["status_code"], "html", null, true);
                echo "\" target=\"_blank\">";
                echo twig_escape_filter($this->env, $context["status_code"], "html", null, true);
                echo "</a></td>
                    <td>
                        <ul>
                            ";
                // line 181
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["descriptions"]);
                foreach ($context['_seq'] as $context["_key"] => $context["description"]) {
                    // line 182
                    echo "                                <li>";
                    echo twig_escape_filter($this->env, $context["description"], "html", null, true);
                    echo "</li>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['description'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 184
                echo "                        </ul>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['status_code'], $context['descriptions'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 188
            echo "            </tbody>
        </table>
    ";
        }
        // line 191
        echo "
    ";
        // line 192
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "cache", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "cache", array())))) {
            // line 193
            echo "        <h4>Cache</h4>
        <div>";
            // line 194
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "cache", array()), "html", null, true);
            echo "s</div>
    ";
        }
        // line 196
        echo "
</div>

";
        // line 199
        if ((isset($context["enableSandbox"]) ? $context["enableSandbox"] : $this->getContext($context, "enableSandbox"))) {
            // line 200
            echo "    <div class=\"pane sandbox\">
        ";
            // line 201
            if ((( !(null === $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array())) && $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "https", array())) && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "secure", array()) != $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "https", array())))) {
                // line 202
                echo "            Please reload the documentation using the scheme ";
                if ($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "https", array())) {
                    echo "HTTPS";
                } else {
                    echo "HTTP";
                }
                echo " if you want to use the sandbox.
        ";
            } else {
                // line 204
                echo "            <form method=\"\" action=\"";
                if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "host", array(), "any", true, true)) {
                    echo (($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "https", array())) ? ("https://") : ("http://"));
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "host", array()), "html", null, true);
                }
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "uri", array()), "html", null, true);
                echo "\">
                <fieldset class=\"parameters\">
                    <legend>Input</legend>
                    ";
                // line 207
                if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "requirements", array(), "any", true, true)) {
                    // line 208
                    echo "                        <h4>Requirements</h4>
                        ";
                    // line 209
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "requirements", array()));
                    foreach ($context['_seq'] as $context["name"] => $context["infos"]) {
                        // line 210
                        echo "                            ";
                        // line 211
                        echo "                            ";
                        if (($context["name"] == "_format")) {
                            // line 212
                            echo "                                ";
                            $context["infos"] = twig_array_merge($context["infos"], array("default" => "json"));
                            // line 213
                            echo "                            ";
                        }
                        // line 214
                        echo "                            <p class=\"tuple\">
                                <input type=\"text\" class=\"key\" value=\"";
                        // line 215
                        echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                        echo "\" placeholder=\"Key\" />
                                <span>=</span>
                                <input type=\"text\" class=\"value\" placeholder=\"";
                        // line 217
                        if ($this->getAttribute($context["infos"], "description", array(), "any", true, true)) {
                            echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "description", array()), "html", null, true);
                        } else {
                            echo "Value";
                        }
                        echo "\" ";
                        if ($this->getAttribute($context["infos"], "default", array(), "any", true, true)) {
                            echo " value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "default", array()), "html", null, true);
                            echo "\" ";
                        }
                        echo "/> <span class=\"remove\">-</span>
                            </p>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['name'], $context['infos'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 220
                    echo "                    ";
                }
                // line 221
                echo "                    ";
                if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "filters", array(), "any", true, true)) {
                    // line 222
                    echo "                        <h4>Filters</h4>
                        ";
                    // line 223
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "filters", array()));
                    foreach ($context['_seq'] as $context["name"] => $context["infos"]) {
                        // line 224
                        echo "                            <p class=\"tuple\">
                                <input type=\"text\" class=\"key\" value=\"";
                        // line 225
                        echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                        echo "\" placeholder=\"Key\" />
                                <span>=</span>
                                <input type=\"text\" class=\"value\" placeholder=\"";
                        // line 227
                        if ($this->getAttribute($context["infos"], "description", array(), "any", true, true)) {
                            echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "description", array()), "html", null, true);
                        } else {
                            echo "Value";
                        }
                        echo "\" ";
                        if ($this->getAttribute($context["infos"], "default", array(), "any", true, true)) {
                            echo " value=\"";
                            echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "default", array()), "html", null, true);
                            echo "\" ";
                        }
                        echo "/> <span class=\"remove\">-</span>
                            </p>
                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['name'], $context['infos'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 230
                    echo "                    ";
                }
                // line 231
                echo "                    ";
                if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "parameters", array(), "any", true, true)) {
                    // line 232
                    echo "                        <h4>Parameters</h4>
                        ";
                    // line 233
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "parameters", array()));
                    foreach ($context['_seq'] as $context["name"] => $context["infos"]) {
                        // line 234
                        echo "                            ";
                        if ( !$this->getAttribute($context["infos"], "readonly", array())) {
                            // line 235
                            echo "                                <p class=\"tuple\" data-dataType=\"";
                            if ($this->getAttribute($context["infos"], "dataType", array())) {
                                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "dataType", array()), "html", null, true);
                            }
                            echo "\" data-format=\"";
                            if ($this->getAttribute($context["infos"], "format", array())) {
                                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "format", array()), "html", null, true);
                            }
                            echo "\" data-description=\"";
                            if ($this->getAttribute($context["infos"], "description", array())) {
                                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "description", array()), "html", null, true);
                            }
                            echo "\">
                                    <input type=\"text\" class=\"key\" value=\"";
                            // line 236
                            echo twig_escape_filter($this->env, $context["name"], "html", null, true);
                            echo "\" placeholder=\"Key\" />
                                    <span>=</span>
                                    <select class=\"tuple_type\">
                                        <option value=\"\">Type</option>
                                        <option value=\"string\">String</option>
                                        <option value=\"boolean\">Boolean</option>
                                        <option value=\"file\">File</option>
                                    </select>
                                    <input type=\"text\" class=\"value\" placeholder=\"";
                            // line 244
                            if ($this->getAttribute($context["infos"], "dataType", array())) {
                                echo "[";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "dataType", array()), "html", null, true);
                                echo "] ";
                            }
                            if ($this->getAttribute($context["infos"], "format", array())) {
                                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "format", array()), "html", null, true);
                            }
                            if ($this->getAttribute($context["infos"], "description", array())) {
                                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "description", array()), "html", null, true);
                            } else {
                                echo "Value";
                            }
                            echo "\" ";
                            if ($this->getAttribute($context["infos"], "default", array(), "any", true, true)) {
                                echo " value=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["infos"], "default", array()), "html", null, true);
                                echo "\" ";
                            }
                            echo "/> <span class=\"remove\">-</span>
                                </p>
                            ";
                        }
                        // line 247
                        echo "                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['name'], $context['infos'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 248
                    echo "                        <button type=\"button\" class=\"add_parameter\">New parameter</button>
                    ";
                }
                // line 250
                echo "
                </fieldset>

                <fieldset class=\"headers\">
                    ";
                // line 254
                $context["methods"] = twig_split_filter($this->env, twig_upper_filter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : $this->getContext($context, "data")), "method", array())), "|");
                // line 255
                echo "                    ";
                if ((twig_length_filter($this->env, (isset($context["methods"]) ? $context["methods"] : $this->getContext($context, "methods"))) > 1)) {
                    // line 256
                    echo "                        <legend>Method</legend>
                        <select name=\"header_method\">
                            ";
                    // line 258
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["methods"]) ? $context["methods"] : $this->getContext($context, "methods")));
                    foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
                        // line 259
                        echo "                                <option value=\"";
                        echo twig_escape_filter($this->env, $context["method"], "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $context["method"], "html", null, true);
                        echo "</option>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 261
                    echo "                        </select>
                    ";
                } else {
                    // line 263
                    echo "                        <input type=\"hidden\" name=\"header_method\" value=\"";
                    echo twig_escape_filter($this->env, twig_join_filter((isset($context["methods"]) ? $context["methods"] : $this->getContext($context, "methods"))), "html", null, true);
                    echo "\" />
                    ";
                }
                // line 265
                echo "
                    <legend>Headers</legend>

                    ";
                // line 268
                if ((isset($context["acceptType"]) ? $context["acceptType"] : $this->getContext($context, "acceptType"))) {
                    // line 269
                    echo "                        <p class=\"tuple\">
                            <input type=\"text\" class=\"key\" value=\"Accept\" />
                            <span>=</span>
                            <input type=\"text\" class=\"value\" value=\"";
                    // line 272
                    echo twig_escape_filter($this->env, (isset($context["acceptType"]) ? $context["acceptType"] : $this->getContext($context, "acceptType")), "html", null, true);
                    echo "\" /> <span class=\"remove\">-</span>
                        </p>
                    ";
                }
                // line 275
                echo "
                    ";
                // line 276
                $this->loadTemplate("@NelmioApiDoc/override_method.html.twig", "NelmioApiDocBundle::method.html.twig", 276)->display($context);
                // line 277
                echo "
                    ";
                // line 279
                echo "                        ";
                // line 280
                echo "                        ";
                // line 281
                echo "                        ";
                // line 282
                echo "                    ";
                // line 283
                echo "
                    <button type=\"button\" class=\"add_header\">New header</button>
                </fieldset>

                <fieldset class=\"request-content\">
                    <legend>Content</legend>

                    <textarea class=\"content\" placeholder=\"Content set here will override the parameters that do not match the url\"></textarea>

                    <p class=\"tuple\">
                        <input type=\"text\" class=\"key content-type\" value=\"Content-Type\" disabled=\"disabled\" />
                        <span>=</span>
                        <input type=\"text\" class=\"value\" placeholder=\"Value\" />
                        <button  type=\"button\" class=\"set-content-type\">Set header</button> <small>Replaces header if set</small>
                    </p>
                </fieldset>

                <div class=\"buttons\">
                    <input type=\"submit\" value=\"Try!\" />
                </div>
            </form>

            <script type=\"text/x-tmpl\" class=\"parameters_tuple_template\">
                        <p class=\"tuple\">
                            <input type=\"text\" class=\"key\" placeholder=\"Key\" />
                            <span>=</span>
                            <select class=\"tuple_type\">
                                                <option value=\"\">Type</option>
                                                <option value=\"string\">String</option>
                                                <option value=\"boolean\">Boolean</option>
                                                <option value=\"file\">File</option>
                                            </select>
                            <input type=\"text\" class=\"value\" placeholder=\"Value\" /> <span class=\"remove\">-</span>
                        </p>
                        </script>

            <script type=\"text/x-tmpl\" class=\"headers_tuple_template\">
                        <p class=\"tuple\">
                            <input type=\"text\" class=\"key\" placeholder=\"Key\" />
                            <span>=</span>
                            <input type=\"text\" class=\"value\" placeholder=\"Value\" /> <span class=\"remove\">-</span>
                        </p>
                        </script>


            <div class=\"result\">
                <h4>Request URL</h4>
                <pre class=\"url\"></pre>

                <h4>Response Headers&nbsp;<small>[<a href=\"\" class=\"to-expand\">Expand</a>]</small>&nbsp;<small class=\"profiler\">[<a href=\"\" class=\"profiler-link\" target=\"_blank\">Profiler</a>]</small></h4>
                <pre class=\"headers to-expand\"></pre>

                <h4>Response Body&nbsp;<small>[<a href=\"\" class=\"to-raw\">Raw</a>]</small></h4>
                <pre class=\"response prettyprint\"></pre>
            </div>
        ";
            }
            // line 339
            echo "    </div>
";
        }
        // line 341
        echo "</div>
</div>
</li>
";
        
        $__internal_3e9367f9e2aeeacc431e23fffffeafce8194b26ad28d50d111c0e2e6b9fb297a->leave($__internal_3e9367f9e2aeeacc431e23fffffeafce8194b26ad28d50d111c0e2e6b9fb297a_prof);

    }

    public function getTemplateName()
    {
        return "NelmioApiDocBundle::method.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  806 => 341,  802 => 339,  744 => 283,  742 => 282,  740 => 281,  738 => 280,  736 => 279,  733 => 277,  731 => 276,  728 => 275,  722 => 272,  717 => 269,  715 => 268,  710 => 265,  704 => 263,  700 => 261,  689 => 259,  685 => 258,  681 => 256,  678 => 255,  676 => 254,  670 => 250,  666 => 248,  660 => 247,  636 => 244,  625 => 236,  610 => 235,  607 => 234,  603 => 233,  600 => 232,  597 => 231,  594 => 230,  575 => 227,  570 => 225,  567 => 224,  563 => 223,  560 => 222,  557 => 221,  554 => 220,  535 => 217,  530 => 215,  527 => 214,  524 => 213,  521 => 212,  518 => 211,  516 => 210,  512 => 209,  509 => 208,  507 => 207,  496 => 204,  486 => 202,  484 => 201,  481 => 200,  479 => 199,  474 => 196,  469 => 194,  466 => 193,  464 => 192,  461 => 191,  456 => 188,  447 => 184,  438 => 182,  434 => 181,  426 => 178,  423 => 177,  419 => 176,  408 => 167,  406 => 166,  403 => 165,  398 => 162,  389 => 159,  385 => 158,  381 => 157,  377 => 156,  374 => 155,  370 => 154,  357 => 143,  355 => 142,  352 => 141,  347 => 138,  341 => 137,  335 => 134,  331 => 133,  327 => 132,  323 => 131,  319 => 130,  316 => 129,  313 => 128,  309 => 127,  295 => 115,  293 => 114,  290 => 113,  285 => 110,  276 => 106,  267 => 103,  263 => 102,  260 => 101,  256 => 100,  250 => 97,  247 => 96,  243 => 95,  232 => 86,  230 => 85,  227 => 84,  222 => 81,  213 => 78,  209 => 77,  205 => 76,  201 => 75,  198 => 74,  194 => 73,  181 => 62,  179 => 61,  176 => 60,  169 => 58,  166 => 57,  164 => 56,  161 => 55,  156 => 53,  153 => 52,  151 => 51,  145 => 47,  140 => 44,  138 => 43,  129 => 41,  124 => 38,  118 => 36,  116 => 35,  112 => 33,  109 => 32,  94 => 30,  89 => 29,  87 => 28,  82 => 26,  79 => 24,  77 => 23,  75 => 22,  71 => 20,  65 => 18,  62 => 17,  58 => 15,  56 => 14,  53 => 13,  47 => 9,  45 => 8,  39 => 5,  29 => 2,  22 => 1,);
    }
}
/* <li class="{{ data.method|lower }} operation" id="{{ data.id }}">*/
/* <div class="heading toggler{% if data.deprecated %} deprecated{% endif %}" data-href="#{{ data.id }}">*/
/*     <h3>*/
/*             <span class="http_method">*/
/*                 <i>{{ data.method|upper }}</i>*/
/*             </span>*/
/* */
/*         {% if data.deprecated %}*/
/*             <span class="deprecated">*/
/*                 <i>DEPRECATED</i>*/
/*             </span>*/
/*         {% endif %}*/
/* */
/*         {% if data.https %}*/
/*             <span class="icon lock" title="HTTPS"></span>*/
/*         {% endif %}*/
/*         {% if data.authentication %}*/
/*             <span class="icon keys" title="Needs {{ data.authenticationRoles|length > 0 ? data.authenticationRoles|join(', ') : 'authentication' }}"></span>*/
/*         {% endif %}*/
/* */
/*         <span class="path">*/
/*                 {% if data.host is defined -%}*/
/*                     {{ data.https ? 'https://' : 'http://' -}}*/
/*                     {{ data.host -}}*/
/*                 {% endif -%}*/
/*             {{ data.uri }}*/
/*             </span>*/
/*         {% if data.tags is defined %}*/
/*             {% for tag, color_code in data.tags %}*/
/*                 <span class="tag" {% if color_code is defined and color_code is not empty %}style="background-color:{{ color_code }};"{% endif %}>{{ tag }}</span>*/
/*             {% endfor %}*/
/*         {%  endif %}*/
/*     </h3>*/
/*     <ul class="options">*/
/*         {% if data.description is defined %}*/
/*             <li>{{ data.description }}</li>*/
/*         {% endif %}*/
/*     </ul>*/
/* </div>*/
/* */
/* <div class="content" style="display: {% if displayContent is defined and displayContent == true %}display{% else %}none{% endif %};">*/
/* <ul class="tabs">*/
/*     {% if enableSandbox %}*/
/*         <li class="selected" data-pane="content">Documentation</li>*/
/*         <li data-pane="sandbox">Sandbox</li>*/
/*     {% endif %}*/
/* </ul>*/
/* */
/* <div class="panes">*/
/* <div class="pane content selected">*/
/*     {% if data.documentation is defined and data.documentation is not empty %}*/
/*         <h4>Documentation</h4>*/
/*         <div>{{ data.documentation|extra_markdown }}</div>*/
/*     {% endif %}*/
/* */
/*     {% if data.link is defined and data.link is not empty %}*/
/*         <h4>Link</h4>*/
/*         <div><a href="{{ data.link }}" target="_blank">{{ data.link }}</a></div>*/
/*     {% endif %}*/
/* */
/*     {% if data.requirements is defined and data.requirements is not empty %}*/
/*         <h4>Requirements</h4>*/
/*         <table class="fullwidth">*/
/*             <thead>*/
/*             <tr>*/
/*                 <th>Name</th>*/
/*                 <th>Requirement</th>*/
/*                 <th>Type</th>*/
/*                 <th>Description</th>*/
/*             </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*             {% for name, infos in data.requirements %}*/
/*                 <tr>*/
/*                     <td>{{ name }}</td>*/
/*                     <td>{{ infos.requirement is defined ? infos.requirement : ''}}</td>*/
/*                     <td>{{ infos.dataType is defined ? infos.dataType : ''}}</td>*/
/*                     <td>{{ infos.description is defined ? infos.description : ''}}</td>*/
/*                 </tr>*/
/*             {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/*     {% endif %}*/
/* */
/*     {% if data.filters is defined and data.filters is not empty %}*/
/*         <h4>Filters</h4>*/
/*         <table class="fullwidth">*/
/*             <thead>*/
/*             <tr>*/
/*                 <th>Name</th>*/
/*                 <th>Information</th>*/
/*             </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*             {% for name, infos in data.filters %}*/
/*                 <tr>*/
/*                     <td>{{ name }}</td>*/
/*                     <td>*/
/*                         <table>*/
/*                             {% for key, value in infos %}*/
/*                                 <tr>*/
/*                                     <td>{{ key|title }}</td>*/
/*                                     <td>{{ value|json_encode|replace({'\\\\': '\\'})|trim('"') }}</td>*/
/*                                 </tr>*/
/*                             {% endfor %}*/
/*                         </table>*/
/*                     </td>*/
/*                 </tr>*/
/*             {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/*     {% endif %}*/
/* */
/*     {% if data.parameters is defined and data.parameters is not empty %}*/
/*         <h4>Parameters</h4>*/
/*         <table class='fullwidth'>*/
/*             <thead>*/
/*             <tr>*/
/*                 <th>Parameter</th>*/
/*                 <th>Type</th>*/
/*                 <th>Required?</th>*/
/*                 <th>Format</th>*/
/*                 <th>Description</th>*/
/*             </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*             {% for name, infos in data.parameters %}*/
/*                 {% if not infos.readonly %}*/
/*                     <tr>*/
/*                         <td>{{ name }}</td>*/
/*                         <td>{{ infos.dataType is defined ? infos.dataType : '' }}</td>*/
/*                         <td>{{ infos.required ? 'true' : 'false' }}</td>*/
/*                         <td>{{ infos.format }}</td>*/
/*                         <td>{{ infos.description is defined ? infos.description : ''  }}</td>*/
/*                     </tr>*/
/*                 {% endif %}*/
/*             {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/*     {% endif %}*/
/* */
/*     {% if data.response is defined and data.response is not empty %}*/
/*         <h4>Return</h4>*/
/*         <table class='fullwidth'>*/
/*             <thead>*/
/*             <tr>*/
/*                 <th>Parameter</th>*/
/*                 <th>Type</th>*/
/*                 <th>Versions</th>*/
/*                 <th>Description</th>*/
/*             </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*             {% for name, infos in data.response %}*/
/*                 <tr>*/
/*                     <td>{{ name }}</td>*/
/*                     <td>{{ infos.dataType }}</td>*/
/*                     <td>{% include 'NelmioApiDocBundle:Components:version.html.twig' with {'sinceVersion': infos.sinceVersion, 'untilVersion': infos.untilVersion} only %}</td>*/
/*                     <td>{{ infos.description }}</td>*/
/*                 </tr>*/
/*             {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/*     {% endif %}*/
/* */
/*     {% if data.statusCodes is defined and data.statusCodes is not empty %}*/
/*         <h4>Status Codes</h4>*/
/*         <table class="fullwidth">*/
/*             <thead>*/
/*             <tr>*/
/*                 <th>Status Code</th>*/
/*                 <th>Description</th>*/
/*             </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*             {% for status_code, descriptions in data.statusCodes %}*/
/*                 <tr>*/
/*                     <td><a href="http://en.wikipedia.org/wiki/HTTP_{{ status_code }}" target="_blank">{{ status_code }}</a></td>*/
/*                     <td>*/
/*                         <ul>*/
/*                             {% for description in descriptions %}*/
/*                                 <li>{{ description }}</li>*/
/*                             {%  endfor %}*/
/*                         </ul>*/
/*                     </td>*/
/*                 </tr>*/
/*             {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/*     {% endif %}*/
/* */
/*     {% if data.cache is defined and data.cache is not empty %}*/
/*         <h4>Cache</h4>*/
/*         <div>{{ data.cache }}s</div>*/
/*     {% endif %}*/
/* */
/* </div>*/
/* */
/* {% if enableSandbox %}*/
/*     <div class="pane sandbox">*/
/*         {% if app.request is not null and data.https and app.request.secure != data.https %}*/
/*             Please reload the documentation using the scheme {% if data.https %}HTTPS{% else %}HTTP{% endif %} if you want to use the sandbox.*/
/*         {% else %}*/
/*             <form method="" action="{% if data.host is defined %}{{ data.https ? 'https://' : 'http://' }}{{ data.host }}{% endif %}{{ data.uri }}">*/
/*                 <fieldset class="parameters">*/
/*                     <legend>Input</legend>*/
/*                     {% if data.requirements is defined %}*/
/*                         <h4>Requirements</h4>*/
/*                         {% for name, infos in data.requirements %}*/
/*                             {#MGD OVERRIDE#}*/
/*                             {% if name == '_format' %}*/
/*                                 {% set infos = infos|merge({'default' : 'json'}) %}*/
/*                             {% endif %}*/
/*                             <p class="tuple">*/
/*                                 <input type="text" class="key" value="{{ name }}" placeholder="Key" />*/
/*                                 <span>=</span>*/
/*                                 <input type="text" class="value" placeholder="{% if infos.description is defined %}{{ infos.description }}{% else %}Value{% endif %}" {% if infos.default is defined %} value="{{ infos.default }}" {% endif %}/> <span class="remove">-</span>*/
/*                             </p>*/
/*                         {% endfor %}*/
/*                     {% endif %}*/
/*                     {% if data.filters is defined %}*/
/*                         <h4>Filters</h4>*/
/*                         {% for name, infos in data.filters %}*/
/*                             <p class="tuple">*/
/*                                 <input type="text" class="key" value="{{ name }}" placeholder="Key" />*/
/*                                 <span>=</span>*/
/*                                 <input type="text" class="value" placeholder="{% if infos.description is defined %}{{ infos.description }}{% else %}Value{% endif %}" {% if infos.default is defined %} value="{{ infos.default }}" {% endif %}/> <span class="remove">-</span>*/
/*                             </p>*/
/*                         {% endfor %}*/
/*                     {% endif %}*/
/*                     {% if data.parameters is defined %}*/
/*                         <h4>Parameters</h4>*/
/*                         {% for name, infos in data.parameters %}*/
/*                             {% if not infos.readonly %}*/
/*                                 <p class="tuple" data-dataType="{% if infos.dataType %}{{ infos.dataType }}{% endif %}" data-format="{% if infos.format %}{{ infos.format }}{% endif %}" data-description="{% if infos.description %}{{ infos.description }}{% endif %}">*/
/*                                     <input type="text" class="key" value="{{ name }}" placeholder="Key" />*/
/*                                     <span>=</span>*/
/*                                     <select class="tuple_type">*/
/*                                         <option value="">Type</option>*/
/*                                         <option value="string">String</option>*/
/*                                         <option value="boolean">Boolean</option>*/
/*                                         <option value="file">File</option>*/
/*                                     </select>*/
/*                                     <input type="text" class="value" placeholder="{% if infos.dataType %}[{{ infos.dataType }}] {% endif %}{% if infos.format %}{{ infos.format }}{% endif %}{% if infos.description %}{{ infos.description }}{% else %}Value{% endif %}" {% if infos.default is defined %} value="{{ infos.default }}" {% endif %}/> <span class="remove">-</span>*/
/*                                 </p>*/
/*                             {% endif %}*/
/*                         {% endfor %}*/
/*                         <button type="button" class="add_parameter">New parameter</button>*/
/*                     {% endif %}*/
/* */
/*                 </fieldset>*/
/* */
/*                 <fieldset class="headers">*/
/*                     {% set methods = data.method|upper|split('|') %}*/
/*                     {% if methods|length > 1 %}*/
/*                         <legend>Method</legend>*/
/*                         <select name="header_method">*/
/*                             {% for method in methods %}*/
/*                                 <option value="{{ method }}">{{ method }}</option>*/
/*                             {% endfor %}*/
/*                         </select>*/
/*                     {% else %}*/
/*                         <input type="hidden" name="header_method" value="{{ methods|join }}" />*/
/*                     {% endif %}*/
/* */
/*                     <legend>Headers</legend>*/
/* */
/*                     {% if acceptType %}*/
/*                         <p class="tuple">*/
/*                             <input type="text" class="key" value="Accept" />*/
/*                             <span>=</span>*/
/*                             <input type="text" class="value" value="{{ acceptType }}" /> <span class="remove">-</span>*/
/*                         </p>*/
/*                     {% endif %}*/
/* */
/*                     {% include '@NelmioApiDoc/override_method.html.twig' %}*/
/* */
/*                     {#<p class="tuple">#}*/
/*                         {#<input type="text" class="key" placeholder="Key" />#}*/
/*                         {#<span>=</span>#}*/
/*                         {#<input type="text" class="value" placeholder="Value" /> <span class="remove">-</span>#}*/
/*                     {#</p>#}*/
/* */
/*                     <button type="button" class="add_header">New header</button>*/
/*                 </fieldset>*/
/* */
/*                 <fieldset class="request-content">*/
/*                     <legend>Content</legend>*/
/* */
/*                     <textarea class="content" placeholder="Content set here will override the parameters that do not match the url"></textarea>*/
/* */
/*                     <p class="tuple">*/
/*                         <input type="text" class="key content-type" value="Content-Type" disabled="disabled" />*/
/*                         <span>=</span>*/
/*                         <input type="text" class="value" placeholder="Value" />*/
/*                         <button  type="button" class="set-content-type">Set header</button> <small>Replaces header if set</small>*/
/*                     </p>*/
/*                 </fieldset>*/
/* */
/*                 <div class="buttons">*/
/*                     <input type="submit" value="Try!" />*/
/*                 </div>*/
/*             </form>*/
/* */
/*             <script type="text/x-tmpl" class="parameters_tuple_template">*/
/*                         <p class="tuple">*/
/*                             <input type="text" class="key" placeholder="Key" />*/
/*                             <span>=</span>*/
/*                             <select class="tuple_type">*/
/*                                                 <option value="">Type</option>*/
/*                                                 <option value="string">String</option>*/
/*                                                 <option value="boolean">Boolean</option>*/
/*                                                 <option value="file">File</option>*/
/*                                             </select>*/
/*                             <input type="text" class="value" placeholder="Value" /> <span class="remove">-</span>*/
/*                         </p>*/
/*                         </script>*/
/* */
/*             <script type="text/x-tmpl" class="headers_tuple_template">*/
/*                         <p class="tuple">*/
/*                             <input type="text" class="key" placeholder="Key" />*/
/*                             <span>=</span>*/
/*                             <input type="text" class="value" placeholder="Value" /> <span class="remove">-</span>*/
/*                         </p>*/
/*                         </script>*/
/* */
/* */
/*             <div class="result">*/
/*                 <h4>Request URL</h4>*/
/*                 <pre class="url"></pre>*/
/* */
/*                 <h4>Response Headers&nbsp;<small>[<a href="" class="to-expand">Expand</a>]</small>&nbsp;<small class="profiler">[<a href="" class="profiler-link" target="_blank">Profiler</a>]</small></h4>*/
/*                 <pre class="headers to-expand"></pre>*/
/* */
/*                 <h4>Response Body&nbsp;<small>[<a href="" class="to-raw">Raw</a>]</small></h4>*/
/*                 <pre class="response prettyprint"></pre>*/
/*             </div>*/
/*         {% endif %}*/
/*     </div>*/
/* {% endif %}*/
/* </div>*/
/* </div>*/
/* </li>*/
/* */
