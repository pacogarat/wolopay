<?php

/* NelmioApiDocBundle::layout.html.twig */
class __TwigTemplate_9079f649a0123033113bac94680cfd0d8eb28231266b1eae798f5663fb08acd5 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 4
        $this->parent = $this->loadTemplate("@App/Documentation/documentation_layout.html.twig", "NelmioApiDocBundle::layout.html.twig", 4);
        $this->blocks = array(
            'head_extra' => array($this, 'block_head_extra'),
            'main_content' => array($this, 'block_main_content'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@App/Documentation/documentation_layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_04719a26173eee530ed34bacbef179efb8341b4557047c4481ff50502eba6013 = $this->env->getExtension("native_profiler");
        $__internal_04719a26173eee530ed34bacbef179efb8341b4557047c4481ff50502eba6013->enter($__internal_04719a26173eee530ed34bacbef179efb8341b4557047c4481ff50502eba6013_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "NelmioApiDocBundle::layout.html.twig"));

        // line 1
        $context["tocHeaders"] = "h1,h2";
        // line 2
        $context["injectTocJquerySelector"] = "#api";
        // line 4
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_04719a26173eee530ed34bacbef179efb8341b4557047c4481ff50502eba6013->leave($__internal_04719a26173eee530ed34bacbef179efb8341b4557047c4481ff50502eba6013_prof);

    }

    // line 8
    public function block_head_extra($context, array $blocks = array())
    {
        $__internal_ad8c1eb24d36a5bc75d34be6984ae2d4e93d61951f48c4be248ecba7f7c7cea1 = $this->env->getExtension("native_profiler");
        $__internal_ad8c1eb24d36a5bc75d34be6984ae2d4e93d61951f48c4be248ecba7f7c7cea1->enter($__internal_ad8c1eb24d36a5bc75d34be6984ae2d4e93d61951f48c4be248ecba7f7c7cea1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head_extra"));

        // line 9
        echo "    ";
        $this->loadTemplate("@NelmioApiDoc/override_layout_style.html.twig", "NelmioApiDocBundle::layout.html.twig", 9)->display($context);
        // line 10
        echo "    <script type=\"text/javascript\">
        ";
        // line 11
        echo (isset($context["js"]) ? $context["js"] : $this->getContext($context, "js"));
        echo "
    </script>
    ";
        // line 13
        $this->displayParentBlock("head_extra", $context, $blocks);
        echo "
";
        
        $__internal_ad8c1eb24d36a5bc75d34be6984ae2d4e93d61951f48c4be248ecba7f7c7cea1->leave($__internal_ad8c1eb24d36a5bc75d34be6984ae2d4e93d61951f48c4be248ecba7f7c7cea1_prof);

    }

    // line 15
    public function block_main_content($context, array $blocks = array())
    {
        $__internal_f40c84406f18ae29cbbc9a67f53bbf9a06b59fbc74b543955c04e052e0e98ca2 = $this->env->getExtension("native_profiler");
        $__internal_f40c84406f18ae29cbbc9a67f53bbf9a06b59fbc74b543955c04e052e0e98ca2->enter($__internal_f40c84406f18ae29cbbc9a67f53bbf9a06b59fbc74b543955c04e052e0e98ca2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "main_content"));

        // line 16
        echo "
        <div id=\"header\" class=\"form-inline\">

            ";
        // line 20
        echo "            ";
        if ((isset($context["enableSandbox"]) ? $context["enableSandbox"] : $this->getContext($context, "enableSandbox"))) {
            // line 21
            echo "                <div id=\"sandbox_configuration\">
                    ";
            // line 23
            echo "                        ";
            // line 24
            echo "                        ";
            // line 25
            echo "                            ";
            // line 26
            echo "                            ";
            // line 27
            echo "                        ";
            // line 28
            echo "                    ";
            // line 29
            echo "                    ";
            if ((twig_length_filter($this->env, (isset($context["requestFormats"]) ? $context["requestFormats"] : $this->getContext($context, "requestFormats"))) > 0)) {
                // line 30
                echo "                    <div class=\"form-group\">
                        <label> request format:</label>
                        <select id=\"request_format\" class=\"form-control\">
                            ";
                // line 33
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["requestFormats"]) ? $context["requestFormats"] : $this->getContext($context, "requestFormats")));
                foreach ($context['_seq'] as $context["format"] => $context["header"]) {
                    // line 34
                    echo "                                <option value=\"";
                    echo twig_escape_filter($this->env, $context["header"], "html", null, true);
                    echo "\"";
                    echo ((((isset($context["defaultRequestFormat"]) ? $context["defaultRequestFormat"] : $this->getContext($context, "defaultRequestFormat")) == $context["format"])) ? (" selected") : (""));
                    echo ">";
                    echo twig_escape_filter($this->env, $context["format"], "html", null, true);
                    echo "</option>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['format'], $context['header'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 36
                echo "                        </select>
                    </div>
                    ";
            }
            // line 39
            echo "                    ";
            if ((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication"))) {
                // line 40
                echo "
                            ";
                // line 41
                if ((($this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()) == "http") && ($this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "type", array()) == "basic"))) {
                    // line 42
                    echo "                                <div class=\"form-group\">
                                    <label>api login:</label>
                                    <input type=\"text\" id=\"api_login\" value=\"\" class=\"form-control\"/>
                                </div>
                                <div class=\"form-group\">
                                    <label>api password:</label>
                                    <input type=\"text\" id=\"api_pass\" value=\"\" class=\"form-control\"/>
                                </div>
                            ";
                } elseif (twig_in_filter($this->getAttribute(                // line 50
(isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()), array(0 => "query", 1 => "http", 2 => "header"))) {
                    // line 51
                    echo "                                api key: <input type=\"text\" id=\"api_key\" value=\"\"/>
                            ";
                }
                // line 53
                echo "
                            ";
                // line 54
                if ($this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "custom_endpoint", array())) {
                    // line 55
                    echo "                                api endpoint: <input type=\"text\" id=\"api_endpoint\" value=\"\"/>
                            ";
                }
                // line 57
                echo "                            <button id=\"save_api_auth\" type=\"button\" class=\"btn btn-success\">Save</button>
                            <button id=\"clear_api_auth\" type=\"button\" class=\"btn btn-warning\">Clear</button>

                    ";
            }
            // line 61
            echo "                </div>
            ";
        }
        // line 63
        echo "            <br style=\"clear: both;\" />
        </div>

    <div style=\"margin-top: 20px;line-height: 25px;\">
        Insert your credentials to test your application.<br>
        After this you can test it in \"sandbox link\" -> click try (button) with required inputs
    </div>

    ";
        // line 71
        $this->loadTemplate((isset($context["motdTemplate"]) ? $context["motdTemplate"] : $this->getContext($context, "motdTemplate")), "NelmioApiDocBundle::layout.html.twig", 71)->display($context);
        // line 72
        echo "    <div id=\"resources_container\">
        <ul id=\"resources\">
            ";
        // line 74
        $this->displayBlock('content', $context, $blocks);
        // line 75
        echo "        </ul>
    </div>
    <p id=\"colophon\">
        Documentation auto-generated on ";
        // line 78
        echo twig_escape_filter($this->env, (isset($context["date"]) ? $context["date"] : $this->getContext($context, "date")), "html", null, true);
        echo "
    </p>
    <script type=\"text/javascript\">

    var getHash = function() {
        return window.location.hash || '';
    };

    var setHash = function(hash) {
        window.location.hash = hash;
    };

    var clearHash = function() {
        var scrollTop, scrollLeft;

        if(typeof history === 'object' && typeof history.pushState === 'function') {
            history.replaceState('', document.title, window.location.pathname + window.location.search);
        } else {
            scrollTop = document.body.scrollTop;
            scrollLeft = document.body.scrollLeft;

            setHash('');

            document.body.scrollTop = scrollTop;
            document.body.scrollLeft = scrollLeft;
        }
    };

    \$(window).load(function() {
        var id = getHash().substr(1).replace( /([:\\.\\[\\]\\{\\}|])/g, \"\\\\\$1\");
        var elem = \$('#' + id);
        if (elem.length) {
            setTimeout(function() {
                \$('body,html').scrollTop(elem.position().top);
            });
            elem.find('.toggler').click();
            var section = elem.parents('.section').first();
            if (section) {
                section.addClass('active');
                section.find('.section-list').slideDown('fast');
            }
        }
        ";
        // line 120
        if ((isset($context["enableSandbox"]) ? $context["enableSandbox"] : $this->getContext($context, "enableSandbox"))) {
            // line 121
            echo "        loadStoredAuthParams();
        ";
        }
        // line 123
        echo "    });

    \$('.toggler').click(function(event) {
        var contentContainer = \$(this).next();

        if(contentContainer.is(':visible')) {
            clearHash();
        } else {
            setHash(\$(this).data('href'));
        }

        contentContainer.slideToggle('fast');
        return false;
    });

    \$('.action-show-hide, .section > h1').on('click', function(){
        var section = \$(this).parents('.section').first();
        if (section.hasClass('active')) {
            section.removeClass('active');
            section.find('.section-list').slideUp('fast');
        } else {
            section.addClass('active');
            section.find('.section-list').slideDown('fast');
        }

    });

    \$('.action-list').on('click', function(){
        var section = \$(this).parents('.section').first();
        if (!section.hasClass('active')) {
            section.addClass('active');
        }
        section.find('.section-list').slideDown('fast');
        section.find('.operation > .content').slideUp('fast');
    });

    \$('.action-expand').on('click', function(){
        var section = \$(this).parents('.section').first();
        if (!section.hasClass('active')) {
            section.addClass('active');
        }
        \$(section).find('ul').slideDown('fast');
        \$(section).find('.operation > .content').slideDown('fast');
    });

    ";
        // line 168
        if ((isset($context["enableSandbox"]) ? $context["enableSandbox"] : $this->getContext($context, "enableSandbox"))) {
            // line 169
            echo "    var getStoredValue, storeValue, deleteStoredValue;
    var apiAuthKeys = ['api_key', 'api_login', 'api_pass', 'api_endpoint'];

    if ('localStorage' in window) {
        var buildKey = function (key) {
            return 'nelmio_' + key;
        }

        getStoredValue = function (key) {
            return localStorage.getItem(buildKey(key));
        }

        storeValue = function (key, value) {
            localStorage.setItem(buildKey(key), value);
        }

        deleteStoredValue = function (key) {
            localStorage.removeItem(buildKey(key));
        }
    } else {
        getStoredValue = storeValue = deleteStoredValue = function (){};
    }

    var loadStoredAuthParams = function() {
        \$.each(apiAuthKeys, function(_, value) {
            var elm = \$('#' + value);
            if (elm.length) {
                elm.val(getStoredValue(value));
            }
        });
    }

    var setParameterType = function (\$context,setType) {
        // no 2nd argument, use default from parameters
        if (typeof setType == \"undefined\") {
            setType = \$context.parent().attr(\"data-dataType\");
            \$context.val(setType);
        }

        \$context.parent().find('.value').remove();
        var placeholder = \"\";
        if (\$context.parent().attr(\"data-dataType\") != \"\" && typeof \$context.parent().attr(\"data-dataType\") != \"undefined\") {
            placeholder += \"[\" + \$context.parent().attr(\"data-dataType\") + \"] \";
        }
        if (\$context.parent().attr(\"data-format\") != \"\" && typeof \$context.parent().attr(\"data-format\") != \"undefined\") {
            placeholder += \$context.parent().attr(\"data-dataType\");
        }
        if (\$context.parent().attr(\"data-description\") != \"\" && typeof \$context.parent().attr(\"data-description\") != \"undefined\") {
            placeholder += \$context.parent().attr(\"data-description\");
        } else {
            placeholder += \"Value\";
        }

        switch(setType) {
            case \"boolean\":
                \$('<select class=\"value\"><option value=\"\"></option><option value=\"1\">True</option><option value=\"0\">False</option></select>').insertAfter(\$context);
                break;
            case \"file\":
                \$('<input type=\"file\" class=\"value\" placeholder=\"'+ placeholder +'\">').insertAfter(\$context);
                break;
            default:
                \$('<input type=\"text\" class=\"value\" placeholder=\"'+ placeholder +'\">').insertAfter(\$context);
        }
    };

    var toggleButtonText = function (\$btn) {
        if (\$btn.text() === 'Default') {
            \$btn.text('Raw');
        } else {
            \$btn.text('Default');
        }
    };

    var renderRawBody = function (\$container) {
        var rawData, \$btn;

        rawData = \$container.data('raw-response');
        \$btn = \$container.parents('.pane').find('.to-raw');

        \$container.addClass('prettyprinted');
        \$container.html(\$('<div/>').text(rawData).html());

        \$btn.removeClass('to-raw');
        \$btn.addClass('to-prettify');

        toggleButtonText(\$btn);
    };

    var renderPrettifiedBody = function (\$container) {
        var rawData, \$btn;

        rawData = \$container.data('raw-response');
        \$btn = \$container.parents('.pane').find('.to-prettify');

        \$container.removeClass('prettyprinted');
        \$container.html(attachCollapseMarker(prettifyResponse(rawData)));
        prettyPrint && prettyPrint();

        \$btn.removeClass('to-prettify');
        \$btn.addClass('to-raw');

        toggleButtonText(\$btn);
    };

    var unflattenDict = function (body) {
        var found = true;
        while(found) {
            found = false;

            for (var key in body) {
                var okey;
                var value = body[key];
                var dictMatch = key.match(/^(.+)\\[([^\\]]+)\\]\$/);

                if(dictMatch) {
                    found = true;
                    okey = dictMatch[1];
                    var subkey = dictMatch[2];
                    body[okey] = body[okey] || {};
                    body[okey][subkey] = value;
                    delete body[key];
                } else {
                    body[key] = value;
                }
            }
        }
        return body;
    };

    \$('#save_api_auth').click(function(event) {
        \$.each(apiAuthKeys, function(_, value) {
            var elm = \$('#' + value);
            if (elm.length) {
                storeValue(value, elm.val());
            }
        });
    });

    \$('#clear_api_auth').click(function(event) {
        \$.each(apiAuthKeys, function(_, value) {
            deleteStoredValue(value);
            var elm = \$('#' + value);
            if (elm.length) {
                elm.val('');
            }
        });
    });

    \$('.tabs li').click(function() {
        var contentGroup = \$(this).parents('.content');

        \$('.pane.selected', contentGroup).removeClass('selected');
        \$('.pane.' + \$(this).data('pane'), contentGroup).addClass('selected');

        \$('li', \$(this).parent()).removeClass('selected');
        \$(this).addClass('selected');
    });

    var getJsonCollapseHtml = function(sectionOpenCharacter) {
        var \$toggler = \$('<span>').addClass('json-collapse-section').
                attr('data-section-open-character', sectionOpenCharacter).
                append(\$('<span>').addClass('json-collapse-marker')
                        .html('&#9663;')
                ).append(sectionOpenCharacter);
        return \$('<div>').append(\$toggler).html();
    };

    var attachCollapseMarker = function (prettifiedJsonString) {
        prettifiedJsonString = prettifiedJsonString.replace(/(\\{|\\[)\\n/g, function(match, sectionOpenCharacter) {
            return getJsonCollapseHtml(sectionOpenCharacter) + '<span class=\"json-collapse-content\">\\n';
        });
        return prettifiedJsonString.replace(/([^\\[][\\}\\]],?)\\n/g, '\$1</span>\\n');
    };

    var prettifyResponse = function(text) {
        try {
            var data = typeof text === 'string' ? JSON.parse(text) : text;
            text = JSON.stringify(data, undefined, '  ');
        } catch (err) {
        }

        // HTML encode the result
        return \$('<div>').text(text).html();
    };

    var displayFinalUrl = function(xhr, method, url, data, container) {
        if ('GET' == method && !jQuery.isEmptyObject(data)) {
            var separator = url.indexOf('?') >= 0 ? '&' : '?';
            url = url + separator + decodeURIComponent(jQuery.param(data));
        }

        container.text(method + ' ' + url);
    };

    var displayProfilerUrl = function(xhr, link, container) {
        var profilerUrl = xhr.getResponseHeader('X-Debug-Token-Link');
        if (profilerUrl) {
            link.attr('href', profilerUrl);
            container.show();
        } else {
            link.attr('href', '');
            container.hide();
        }
    }

    var displayResponseData = function(xhr, container) {
        var data = xhr.responseText;

        container.data('raw-response', data);

        renderPrettifiedBody(container);

        container.parents('.pane').find('.to-prettify').text('Raw');
        container.parents('.pane').find('.to-raw').text('Raw');
    };

    var displayResponseHeaders = function(xhr, container) {
        var text = xhr.status + ' ' + xhr.statusText + \"\\n\\n\";
        text += xhr.getAllResponseHeaders();

        container.text(text);
    };

    var displayResponse = function(xhr, method, url, data, result_container) {
        displayFinalUrl(xhr, method, url, data, \$('.url', result_container));
        displayProfilerUrl(xhr, \$('.profiler-link', result_container), \$('.profiler', result_container));
        displayResponseData(xhr, \$('.response', result_container));
        displayResponseHeaders(xhr, \$('.headers', result_container));

        result_container.show();
    };

    \$('.pane.sandbox form').submit(function() {
        var url = \$(this).attr('action'),
                method = \$('[name=\"header_method\"]', this).val(),
                self = this,
                params = {},
                formData = new FormData(),
                doubledParams = {},
                headers = {},
                content = \$(this).find('textarea.content').val(),
                result_container = \$('.result', \$(this).parent());

        if (method === 'ANY') {
            method = 'POST';
        }

        // set requestFormat
        var requestFormatMethod = '";
            // line 417
            echo twig_escape_filter($this->env, (isset($context["requestFormatMethod"]) ? $context["requestFormatMethod"] : $this->getContext($context, "requestFormatMethod")), "html", null, true);
            echo "';
        if (requestFormatMethod == 'format_param') {
            params['_format'] = \$('#request_format option:selected').text();
            formData.append('_format',\$('#request_format option:selected').text());
        } else if (requestFormatMethod == 'accept_header') {
            headers['Accept'] = \$('#request_format').val();
        }

        // set default bodyFormat
        var bodyFormat = \$('#body_format').val() || '";
            // line 426
            echo twig_escape_filter($this->env, (isset($context["defaultBodyFormat"]) ? $context["defaultBodyFormat"] : $this->getContext($context, "defaultBodyFormat")), "html", null, true);
            echo "';

        if(!('Content-type' in headers)) {
            if (bodyFormat == 'form') {
                headers['Content-type'] = 'application/x-www-form-urlencoded';
            } else {
                headers['Content-type'] = 'application/json';
            }
        }

        var hasFileTypes = false;
        \$('.parameters .tuple_type', \$(this)).each(function() {
            if (\$(this).val() == 'file') {
                hasFileTypes = true;
            }
        });

        if (hasFileTypes && method != 'POST') {
            alert(\"Sorry, you can only submit files via POST.\");
            return false;
        }

        if (hasFileTypes && bodyFormat != 'form') {
            alert(\"Body Format must be set to 'Form Data' when utilizing file upload type parameters.\\nYour current bodyFormat is '\" + bodyFormat + \"'. Change your BodyFormat or do not use file type\\nparameters.\");
            return false;
        }

        if (hasFileTypes) {
            // retrieve all the parameters to send for file upload
            \$('.parameters .tuple', \$(this)).each(function() {
                var key, value;

                key = \$('.key', \$(this)).val();
                if (\$('.value', \$(this)).attr('type') === 'file' ) {
                    value = \$('.value', \$(this)).prop('files')[0];
                } else {
                    value = \$('.value', \$(this)).val();
                }

                if (value) {
                    formData.append(key,value);
                }
            });
        }


        // retrieve all the parameters to send
        \$('.parameters .tuple', \$(this)).each(function() {
            var key, value;

            key = \$('.key', \$(this)).val();
            value = \$('.value', \$(this)).val();

            if (value) {
                // temporary save all additional/doubled parameters
                if (key in params) {
                    doubledParams[key] = value;
                } else {
                    params[key] = value;
                }
            }
        });




        // retrieve the additional headers to send
        \$('.headers .tuple', \$(this)).each(function() {
            var key, value;

            key = \$('.key', \$(this)).val();
            value = \$('.value', \$(this)).val();

            if (value) {
                headers[key] = value;
            }

        });

        // fix parameters in URL
        for (var key in \$.extend({}, params)) {
            if (url.indexOf('{' + key + '}') !== -1) {
                url = url.replace('{' + key + '}', params[key]);
                delete params[key];
            }
        };

        // merge additional params back to real params object
        if (!\$.isEmptyObject(doubledParams)) {
            \$.extend(params, doubledParams);
        }

        // disable all the fiels and buttons
        \$('input, button', \$(this)).attr('disabled', 'disabled');

        // append the query authentication
        var api_key_val = \$('#api_key').val();
        if (authentication_delivery == 'query' && api_key_val.length>0) {
            url += url.indexOf('?') > 0 ? '&' : '?';
            url += api_key_parameter + '=' + api_key_val;
        }

        // prepare the api enpoint
        ";
            // line 529
            if (((((isset($context["endpoint"]) ? $context["endpoint"] : $this->getContext($context, "endpoint")) == "") &&  !(null === $this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()))) && $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "host", array()))) {
                // line 530
                echo "var endpoint = '";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : $this->getContext($context, "app")), "request", array()), "getBaseUrl", array(), "method"), "html", null, true);
                echo "';
        ";
            } else {
                // line 532
                echo "var endpoint = '";
                echo twig_escape_filter($this->env, (isset($context["endpoint"]) ? $context["endpoint"] : $this->getContext($context, "endpoint")), "html", null, true);
                echo "';
        ";
            }
            // line 534
            if (((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")) && $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "custom_endpoint", array()))) {
                // line 535
                echo "        if (\$('#api_endpoint') && typeof(\$('#api_endpoint').val()) != 'undefined') {
            endpoint = \$('#api_endpoint').val();
        }
        ";
            }
            // line 539
            echo "
        // prepare final parameters
        var body = {};
        if(bodyFormat == 'json' && method != 'GET') {
            body = unflattenDict(params);
            body = JSON.stringify(body);
        } else {
            body = params;
        }
        var data = content.length ? content : body;
        var ajaxOptions = {
            url: (url.indexOf('http')!=0?endpoint:'') + url,
            type: method,
            data: data,
            headers: headers,
            crossDomain: true,
            beforeSend: function (xhr) {
                if (authentication_delivery) {
                    var value;

                    if ('http' == authentication_delivery) {
                        if ('basic' == authentication_type) {
                            value = 'Basic ' + btoa(\$('#api_login').val() + ':' + \$('#api_pass').val());
                        } else if ('bearer' == authentication_type) {
                            value = 'Bearer ' + \$('#api_key').val();
                        }
                    } else if ('header' == authentication_delivery) {
                        value = \$('#api_key').val();
                    }

                    xhr.setRequestHeader(api_key_parameter, value);
                }
            },
            complete: function(xhr) {
                displayResponse(xhr, method, url, data, result_container);

                // and enable them back
                \$('input:not(.content-type), button', \$(self)).removeAttr('disabled');
            }
        };

        // overrides body format to send data properly
        if (hasFileTypes) {
            ajaxOptions.data = formData;
            ajaxOptions.processData = false;
            ajaxOptions.contentType = false;
            delete(headers['Content-type']);
        }

        // and trigger the API call
        \$.ajax(ajaxOptions);

        return false;
    });

    \$('.operations').on('click', '.operation > .heading', function(e) {
        if (history.pushState) {
            history.pushState(null, null, \$(this).data('href'));
            e.preventDefault();
        }
    });

    \$(document).on('click', '.json-collapse-section', function() {
        var openChar = \$(this).data('section-open-character'),
                closingChar = (openChar == '{' ? '}' : ']');
        if (\$(this).next('.json-collapse-content').is(':visible')) {
            \$(this).html('&oplus;' +  openChar + '...' + closingChar);
        } else {
            \$(this).html('&#9663;' + \$(this).data('section-open-character'));
        }
        \$(this).next('.json-collapse-content').toggle();
    });

    \$(document).on('copy', '.prettyprinted', function () {
        var \$toggleMarkers = \$(this).find('.json-collapse-marker');
        \$toggleMarkers.hide();
        setTimeout(function () {
            \$toggleMarkers.show();
        }, 100);
    });

    \$('.pane.sandbox').on('click', '.to-raw', function(e) {
        renderRawBody(\$(this).parents('.pane').find('.response'));

        e.preventDefault();
    });

    \$('.pane.sandbox').on('click', '.to-prettify', function(e) {
        renderPrettifiedBody(\$(this).parents('.pane').find('.response'));

        e.preventDefault();
    });

    \$('.pane.sandbox').on('click', '.to-expand, .to-shrink', function(e) {
        var \$headers = \$(this).parents('.result').find('.headers');
        var \$label = \$(this).parents('.result').find('a.to-expand');

        if (\$headers.hasClass('to-expand')) {
            \$headers.removeClass('to-expand');
            \$headers.addClass('to-shrink');
            \$label.text('Shrink');
        } else {
            \$headers.removeClass('to-shrink');
            \$headers.addClass('to-expand');
            \$label.text('Expand');
        }

        e.preventDefault();
    });


    // sets the correct parameter type on load
    \$('.pane.sandbox .tuple_type').each(function() {
        setParameterType(\$(this));
    });


    // handles parameter type change
    \$('.pane.sandbox').on('change', '.tuple_type', function() {
        setParameterType(\$(this),\$(this).val());
    });



    \$('.pane.sandbox').on('click', '.add_parameter', function() {
        var html = \$(this).parents('.pane').find('.parameters_tuple_template').html();

        \$(this).before(html);

        return false;
    });

    \$('.pane.sandbox').on('click', '.add_header', function() {
        var html = \$(this).parents('.pane').find('.headers_tuple_template').html();

        \$(this).before(html);

        return false;
    });

    \$('.pane.sandbox').on('click', '.remove', function() {
        \$(this).parent().remove();
    });

    \$('.pane.sandbox').on('click', '.set-content-type', function(e) {
        var html;
        var \$element;
        var \$headers = \$(this).parents('form').find('.headers');
        var content_type = \$(this).prev('input.value').val();

        e.preventDefault();

        if (content_type.length === 0) {
            return;
        }

        \$headers.find('input.key').each(function() {
            if (\$.trim(\$(this).val().toLowerCase()) === 'content-type') {
                \$element = \$(this).parents('p');
                return false;
            }
        });

        if (typeof \$element === 'undefined') {
            html = \$(this).parents('.pane').find('.tuple_template').html();

            \$element = \$headers.find('legend').after(html).next('p');
        }

        \$element.find('input.key').val('Content-Type');
        \$element.find('input.value').val(content_type);

    });

    ";
            // line 713
            if (((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")) && ($this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()) == "http"))) {
                // line 714
                echo "    var authentication_delivery = '";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()), "html", null, true);
                echo "';
    var api_key_parameter = '";
                // line 715
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "name", array()), "html", null, true);
                echo "';
    var authentication_type = '";
                // line 716
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "type", array()), "html", null, true);
                echo "';
    ";
            } elseif ((            // line 717
(isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")) && ($this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()) == "query"))) {
                // line 718
                echo "    var authentication_delivery = '";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()), "html", null, true);
                echo "';
    var api_key_parameter = '";
                // line 719
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "name", array()), "html", null, true);
                echo "';
    var search = window.location.search;
    var api_key_start = search.indexOf(api_key_parameter) + api_key_parameter.length + 1;

    if (api_key_start > 0 ) {
        var api_key_end = search.indexOf('&', api_key_start);

        var api_key = -1 == api_key_end
                ? search.substr(api_key_start)
                : search.substring(api_key_start, api_key_end);

        \$('#api_key').val(api_key);
    }
    ";
            } elseif ((            // line 732
(isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")) && ($this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()) == "header"))) {
                // line 733
                echo "    var authentication_delivery = '";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "delivery", array()), "html", null, true);
                echo "';
    var api_key_parameter = '";
                // line 734
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["authentication"]) ? $context["authentication"] : $this->getContext($context, "authentication")), "name", array()), "html", null, true);
                echo "';
    ";
            } else {
                // line 736
                echo "    var authentication_delivery = false;
    ";
            }
            // line 738
            echo "    ";
        }
        // line 739
        echo "
    </script>
";
        
        $__internal_f40c84406f18ae29cbbc9a67f53bbf9a06b59fbc74b543955c04e052e0e98ca2->leave($__internal_f40c84406f18ae29cbbc9a67f53bbf9a06b59fbc74b543955c04e052e0e98ca2_prof);

    }

    // line 74
    public function block_content($context, array $blocks = array())
    {
        $__internal_cf2d7224d44645d5ced61e3e71859f771048a8849c0ebbf72ede4f94df856574 = $this->env->getExtension("native_profiler");
        $__internal_cf2d7224d44645d5ced61e3e71859f771048a8849c0ebbf72ede4f94df856574->enter($__internal_cf2d7224d44645d5ced61e3e71859f771048a8849c0ebbf72ede4f94df856574_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "content"));

        
        $__internal_cf2d7224d44645d5ced61e3e71859f771048a8849c0ebbf72ede4f94df856574->leave($__internal_cf2d7224d44645d5ced61e3e71859f771048a8849c0ebbf72ede4f94df856574_prof);

    }

    public function getTemplateName()
    {
        return "NelmioApiDocBundle::layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  924 => 74,  915 => 739,  912 => 738,  908 => 736,  903 => 734,  898 => 733,  896 => 732,  880 => 719,  875 => 718,  873 => 717,  869 => 716,  865 => 715,  860 => 714,  858 => 713,  682 => 539,  676 => 535,  674 => 534,  668 => 532,  662 => 530,  660 => 529,  554 => 426,  542 => 417,  292 => 169,  290 => 168,  243 => 123,  239 => 121,  237 => 120,  192 => 78,  187 => 75,  185 => 74,  181 => 72,  179 => 71,  169 => 63,  165 => 61,  159 => 57,  155 => 55,  153 => 54,  150 => 53,  146 => 51,  144 => 50,  134 => 42,  132 => 41,  129 => 40,  126 => 39,  121 => 36,  108 => 34,  104 => 33,  99 => 30,  96 => 29,  94 => 28,  92 => 27,  90 => 26,  88 => 25,  86 => 24,  84 => 23,  81 => 21,  78 => 20,  73 => 16,  67 => 15,  58 => 13,  53 => 11,  50 => 10,  47 => 9,  41 => 8,  34 => 4,  32 => 2,  30 => 1,  11 => 4,);
    }
}
/* {% set tocHeaders = 'h1,h2' %}*/
/* {% set injectTocJquerySelector = '#api' %}*/
/* */
/* {% extends "@App/Documentation/documentation_layout.html.twig" %}*/
/* */
/* */
/* */
/* {% block head_extra %}*/
/*     {% include '@NelmioApiDoc/override_layout_style.html.twig' %}*/
/*     <script type="text/javascript">*/
/*         {{ js|raw }}*/
/*     </script>*/
/*     {{parent()}}*/
/* {% endblock %}*/
/* {% block main_content %}*/
/* */
/*         <div id="header" class="form-inline">*/
/* */
/*             {#<a href="{{ path('nelmio_api_doc_index') }}"><h1>{{ apiName }}</h1></a> MGD #}*/
/*             {% if enableSandbox %}*/
/*                 <div id="sandbox_configuration">*/
/*                     {#{% if bodyFormats|length > 0 %} MGD#}*/
/*                         {#body format:#}*/
/*                         {#<select id="body_format">#}*/
/*                             {#{% if 'form' in bodyFormats %}<option value="form"{{ defaultBodyFormat == 'form' ? ' selected' : '' }}>Form Data</option>{% endif %}#}*/
/*                             {#{% if 'json' in bodyFormats %}<option value="json"{{ defaultBodyFormat == 'json' ? ' selected' : '' }}>JSON</option>{% endif %}#}*/
/*                         {#</select>#}*/
/*                     {#{% endif %}#}*/
/*                     {% if requestFormats|length > 0 %}*/
/*                     <div class="form-group">*/
/*                         <label> request format:</label>*/
/*                         <select id="request_format" class="form-control">*/
/*                             {% for format, header in requestFormats %}*/
/*                                 <option value="{{ header }}"{{ defaultRequestFormat == format ? ' selected' : '' }}>{{ format }}</option>*/
/*                             {% endfor %}*/
/*                         </select>*/
/*                     </div>*/
/*                     {% endif %}*/
/*                     {% if authentication %}*/
/* */
/*                             {% if authentication.delivery == 'http' and authentication.type == 'basic' %}*/
/*                                 <div class="form-group">*/
/*                                     <label>api login:</label>*/
/*                                     <input type="text" id="api_login" value="" class="form-control"/>*/
/*                                 </div>*/
/*                                 <div class="form-group">*/
/*                                     <label>api password:</label>*/
/*                                     <input type="text" id="api_pass" value="" class="form-control"/>*/
/*                                 </div>*/
/*                             {% elseif authentication.delivery in ['query', 'http', 'header'] %}*/
/*                                 api key: <input type="text" id="api_key" value=""/>*/
/*                             {% endif %}*/
/* */
/*                             {% if authentication.custom_endpoint %}*/
/*                                 api endpoint: <input type="text" id="api_endpoint" value=""/>*/
/*                             {% endif %}*/
/*                             <button id="save_api_auth" type="button" class="btn btn-success">Save</button>*/
/*                             <button id="clear_api_auth" type="button" class="btn btn-warning">Clear</button>*/
/* */
/*                     {% endif %}*/
/*                 </div>*/
/*             {% endif %}*/
/*             <br style="clear: both;" />*/
/*         </div>*/
/* */
/*     <div style="margin-top: 20px;line-height: 25px;">*/
/*         Insert your credentials to test your application.<br>*/
/*         After this you can test it in "sandbox link" -> click try (button) with required inputs*/
/*     </div>*/
/* */
/*     {% include motdTemplate %}*/
/*     <div id="resources_container">*/
/*         <ul id="resources">*/
/*             {% block content %}{% endblock %}*/
/*         </ul>*/
/*     </div>*/
/*     <p id="colophon">*/
/*         Documentation auto-generated on {{ date }}*/
/*     </p>*/
/*     <script type="text/javascript">*/
/* */
/*     var getHash = function() {*/
/*         return window.location.hash || '';*/
/*     };*/
/* */
/*     var setHash = function(hash) {*/
/*         window.location.hash = hash;*/
/*     };*/
/* */
/*     var clearHash = function() {*/
/*         var scrollTop, scrollLeft;*/
/* */
/*         if(typeof history === 'object' && typeof history.pushState === 'function') {*/
/*             history.replaceState('', document.title, window.location.pathname + window.location.search);*/
/*         } else {*/
/*             scrollTop = document.body.scrollTop;*/
/*             scrollLeft = document.body.scrollLeft;*/
/* */
/*             setHash('');*/
/* */
/*             document.body.scrollTop = scrollTop;*/
/*             document.body.scrollLeft = scrollLeft;*/
/*         }*/
/*     };*/
/* */
/*     $(window).load(function() {*/
/*         var id = getHash().substr(1).replace( /([:\.\[\]\{\}|])/g, "\\$1");*/
/*         var elem = $('#' + id);*/
/*         if (elem.length) {*/
/*             setTimeout(function() {*/
/*                 $('body,html').scrollTop(elem.position().top);*/
/*             });*/
/*             elem.find('.toggler').click();*/
/*             var section = elem.parents('.section').first();*/
/*             if (section) {*/
/*                 section.addClass('active');*/
/*                 section.find('.section-list').slideDown('fast');*/
/*             }*/
/*         }*/
/*         {% if enableSandbox %}*/
/*         loadStoredAuthParams();*/
/*         {% endif %}*/
/*     });*/
/* */
/*     $('.toggler').click(function(event) {*/
/*         var contentContainer = $(this).next();*/
/* */
/*         if(contentContainer.is(':visible')) {*/
/*             clearHash();*/
/*         } else {*/
/*             setHash($(this).data('href'));*/
/*         }*/
/* */
/*         contentContainer.slideToggle('fast');*/
/*         return false;*/
/*     });*/
/* */
/*     $('.action-show-hide, .section > h1').on('click', function(){*/
/*         var section = $(this).parents('.section').first();*/
/*         if (section.hasClass('active')) {*/
/*             section.removeClass('active');*/
/*             section.find('.section-list').slideUp('fast');*/
/*         } else {*/
/*             section.addClass('active');*/
/*             section.find('.section-list').slideDown('fast');*/
/*         }*/
/* */
/*     });*/
/* */
/*     $('.action-list').on('click', function(){*/
/*         var section = $(this).parents('.section').first();*/
/*         if (!section.hasClass('active')) {*/
/*             section.addClass('active');*/
/*         }*/
/*         section.find('.section-list').slideDown('fast');*/
/*         section.find('.operation > .content').slideUp('fast');*/
/*     });*/
/* */
/*     $('.action-expand').on('click', function(){*/
/*         var section = $(this).parents('.section').first();*/
/*         if (!section.hasClass('active')) {*/
/*             section.addClass('active');*/
/*         }*/
/*         $(section).find('ul').slideDown('fast');*/
/*         $(section).find('.operation > .content').slideDown('fast');*/
/*     });*/
/* */
/*     {% if enableSandbox %}*/
/*     var getStoredValue, storeValue, deleteStoredValue;*/
/*     var apiAuthKeys = ['api_key', 'api_login', 'api_pass', 'api_endpoint'];*/
/* */
/*     if ('localStorage' in window) {*/
/*         var buildKey = function (key) {*/
/*             return 'nelmio_' + key;*/
/*         }*/
/* */
/*         getStoredValue = function (key) {*/
/*             return localStorage.getItem(buildKey(key));*/
/*         }*/
/* */
/*         storeValue = function (key, value) {*/
/*             localStorage.setItem(buildKey(key), value);*/
/*         }*/
/* */
/*         deleteStoredValue = function (key) {*/
/*             localStorage.removeItem(buildKey(key));*/
/*         }*/
/*     } else {*/
/*         getStoredValue = storeValue = deleteStoredValue = function (){};*/
/*     }*/
/* */
/*     var loadStoredAuthParams = function() {*/
/*         $.each(apiAuthKeys, function(_, value) {*/
/*             var elm = $('#' + value);*/
/*             if (elm.length) {*/
/*                 elm.val(getStoredValue(value));*/
/*             }*/
/*         });*/
/*     }*/
/* */
/*     var setParameterType = function ($context,setType) {*/
/*         // no 2nd argument, use default from parameters*/
/*         if (typeof setType == "undefined") {*/
/*             setType = $context.parent().attr("data-dataType");*/
/*             $context.val(setType);*/
/*         }*/
/* */
/*         $context.parent().find('.value').remove();*/
/*         var placeholder = "";*/
/*         if ($context.parent().attr("data-dataType") != "" && typeof $context.parent().attr("data-dataType") != "undefined") {*/
/*             placeholder += "[" + $context.parent().attr("data-dataType") + "] ";*/
/*         }*/
/*         if ($context.parent().attr("data-format") != "" && typeof $context.parent().attr("data-format") != "undefined") {*/
/*             placeholder += $context.parent().attr("data-dataType");*/
/*         }*/
/*         if ($context.parent().attr("data-description") != "" && typeof $context.parent().attr("data-description") != "undefined") {*/
/*             placeholder += $context.parent().attr("data-description");*/
/*         } else {*/
/*             placeholder += "Value";*/
/*         }*/
/* */
/*         switch(setType) {*/
/*             case "boolean":*/
/*                 $('<select class="value"><option value=""></option><option value="1">True</option><option value="0">False</option></select>').insertAfter($context);*/
/*                 break;*/
/*             case "file":*/
/*                 $('<input type="file" class="value" placeholder="'+ placeholder +'">').insertAfter($context);*/
/*                 break;*/
/*             default:*/
/*                 $('<input type="text" class="value" placeholder="'+ placeholder +'">').insertAfter($context);*/
/*         }*/
/*     };*/
/* */
/*     var toggleButtonText = function ($btn) {*/
/*         if ($btn.text() === 'Default') {*/
/*             $btn.text('Raw');*/
/*         } else {*/
/*             $btn.text('Default');*/
/*         }*/
/*     };*/
/* */
/*     var renderRawBody = function ($container) {*/
/*         var rawData, $btn;*/
/* */
/*         rawData = $container.data('raw-response');*/
/*         $btn = $container.parents('.pane').find('.to-raw');*/
/* */
/*         $container.addClass('prettyprinted');*/
/*         $container.html($('<div/>').text(rawData).html());*/
/* */
/*         $btn.removeClass('to-raw');*/
/*         $btn.addClass('to-prettify');*/
/* */
/*         toggleButtonText($btn);*/
/*     };*/
/* */
/*     var renderPrettifiedBody = function ($container) {*/
/*         var rawData, $btn;*/
/* */
/*         rawData = $container.data('raw-response');*/
/*         $btn = $container.parents('.pane').find('.to-prettify');*/
/* */
/*         $container.removeClass('prettyprinted');*/
/*         $container.html(attachCollapseMarker(prettifyResponse(rawData)));*/
/*         prettyPrint && prettyPrint();*/
/* */
/*         $btn.removeClass('to-prettify');*/
/*         $btn.addClass('to-raw');*/
/* */
/*         toggleButtonText($btn);*/
/*     };*/
/* */
/*     var unflattenDict = function (body) {*/
/*         var found = true;*/
/*         while(found) {*/
/*             found = false;*/
/* */
/*             for (var key in body) {*/
/*                 var okey;*/
/*                 var value = body[key];*/
/*                 var dictMatch = key.match(/^(.+)\[([^\]]+)\]$/);*/
/* */
/*                 if(dictMatch) {*/
/*                     found = true;*/
/*                     okey = dictMatch[1];*/
/*                     var subkey = dictMatch[2];*/
/*                     body[okey] = body[okey] || {};*/
/*                     body[okey][subkey] = value;*/
/*                     delete body[key];*/
/*                 } else {*/
/*                     body[key] = value;*/
/*                 }*/
/*             }*/
/*         }*/
/*         return body;*/
/*     };*/
/* */
/*     $('#save_api_auth').click(function(event) {*/
/*         $.each(apiAuthKeys, function(_, value) {*/
/*             var elm = $('#' + value);*/
/*             if (elm.length) {*/
/*                 storeValue(value, elm.val());*/
/*             }*/
/*         });*/
/*     });*/
/* */
/*     $('#clear_api_auth').click(function(event) {*/
/*         $.each(apiAuthKeys, function(_, value) {*/
/*             deleteStoredValue(value);*/
/*             var elm = $('#' + value);*/
/*             if (elm.length) {*/
/*                 elm.val('');*/
/*             }*/
/*         });*/
/*     });*/
/* */
/*     $('.tabs li').click(function() {*/
/*         var contentGroup = $(this).parents('.content');*/
/* */
/*         $('.pane.selected', contentGroup).removeClass('selected');*/
/*         $('.pane.' + $(this).data('pane'), contentGroup).addClass('selected');*/
/* */
/*         $('li', $(this).parent()).removeClass('selected');*/
/*         $(this).addClass('selected');*/
/*     });*/
/* */
/*     var getJsonCollapseHtml = function(sectionOpenCharacter) {*/
/*         var $toggler = $('<span>').addClass('json-collapse-section').*/
/*                 attr('data-section-open-character', sectionOpenCharacter).*/
/*                 append($('<span>').addClass('json-collapse-marker')*/
/*                         .html('&#9663;')*/
/*                 ).append(sectionOpenCharacter);*/
/*         return $('<div>').append($toggler).html();*/
/*     };*/
/* */
/*     var attachCollapseMarker = function (prettifiedJsonString) {*/
/*         prettifiedJsonString = prettifiedJsonString.replace(/(\{|\[)\n/g, function(match, sectionOpenCharacter) {*/
/*             return getJsonCollapseHtml(sectionOpenCharacter) + '<span class="json-collapse-content">\n';*/
/*         });*/
/*         return prettifiedJsonString.replace(/([^\[][\}\]],?)\n/g, '$1</span>\n');*/
/*     };*/
/* */
/*     var prettifyResponse = function(text) {*/
/*         try {*/
/*             var data = typeof text === 'string' ? JSON.parse(text) : text;*/
/*             text = JSON.stringify(data, undefined, '  ');*/
/*         } catch (err) {*/
/*         }*/
/* */
/*         // HTML encode the result*/
/*         return $('<div>').text(text).html();*/
/*     };*/
/* */
/*     var displayFinalUrl = function(xhr, method, url, data, container) {*/
/*         if ('GET' == method && !jQuery.isEmptyObject(data)) {*/
/*             var separator = url.indexOf('?') >= 0 ? '&' : '?';*/
/*             url = url + separator + decodeURIComponent(jQuery.param(data));*/
/*         }*/
/* */
/*         container.text(method + ' ' + url);*/
/*     };*/
/* */
/*     var displayProfilerUrl = function(xhr, link, container) {*/
/*         var profilerUrl = xhr.getResponseHeader('X-Debug-Token-Link');*/
/*         if (profilerUrl) {*/
/*             link.attr('href', profilerUrl);*/
/*             container.show();*/
/*         } else {*/
/*             link.attr('href', '');*/
/*             container.hide();*/
/*         }*/
/*     }*/
/* */
/*     var displayResponseData = function(xhr, container) {*/
/*         var data = xhr.responseText;*/
/* */
/*         container.data('raw-response', data);*/
/* */
/*         renderPrettifiedBody(container);*/
/* */
/*         container.parents('.pane').find('.to-prettify').text('Raw');*/
/*         container.parents('.pane').find('.to-raw').text('Raw');*/
/*     };*/
/* */
/*     var displayResponseHeaders = function(xhr, container) {*/
/*         var text = xhr.status + ' ' + xhr.statusText + "\n\n";*/
/*         text += xhr.getAllResponseHeaders();*/
/* */
/*         container.text(text);*/
/*     };*/
/* */
/*     var displayResponse = function(xhr, method, url, data, result_container) {*/
/*         displayFinalUrl(xhr, method, url, data, $('.url', result_container));*/
/*         displayProfilerUrl(xhr, $('.profiler-link', result_container), $('.profiler', result_container));*/
/*         displayResponseData(xhr, $('.response', result_container));*/
/*         displayResponseHeaders(xhr, $('.headers', result_container));*/
/* */
/*         result_container.show();*/
/*     };*/
/* */
/*     $('.pane.sandbox form').submit(function() {*/
/*         var url = $(this).attr('action'),*/
/*                 method = $('[name="header_method"]', this).val(),*/
/*                 self = this,*/
/*                 params = {},*/
/*                 formData = new FormData(),*/
/*                 doubledParams = {},*/
/*                 headers = {},*/
/*                 content = $(this).find('textarea.content').val(),*/
/*                 result_container = $('.result', $(this).parent());*/
/* */
/*         if (method === 'ANY') {*/
/*             method = 'POST';*/
/*         }*/
/* */
/*         // set requestFormat*/
/*         var requestFormatMethod = '{{ requestFormatMethod }}';*/
/*         if (requestFormatMethod == 'format_param') {*/
/*             params['_format'] = $('#request_format option:selected').text();*/
/*             formData.append('_format',$('#request_format option:selected').text());*/
/*         } else if (requestFormatMethod == 'accept_header') {*/
/*             headers['Accept'] = $('#request_format').val();*/
/*         }*/
/* */
/*         // set default bodyFormat*/
/*         var bodyFormat = $('#body_format').val() || '{{ defaultBodyFormat }}';*/
/* */
/*         if(!('Content-type' in headers)) {*/
/*             if (bodyFormat == 'form') {*/
/*                 headers['Content-type'] = 'application/x-www-form-urlencoded';*/
/*             } else {*/
/*                 headers['Content-type'] = 'application/json';*/
/*             }*/
/*         }*/
/* */
/*         var hasFileTypes = false;*/
/*         $('.parameters .tuple_type', $(this)).each(function() {*/
/*             if ($(this).val() == 'file') {*/
/*                 hasFileTypes = true;*/
/*             }*/
/*         });*/
/* */
/*         if (hasFileTypes && method != 'POST') {*/
/*             alert("Sorry, you can only submit files via POST.");*/
/*             return false;*/
/*         }*/
/* */
/*         if (hasFileTypes && bodyFormat != 'form') {*/
/*             alert("Body Format must be set to 'Form Data' when utilizing file upload type parameters.\nYour current bodyFormat is '" + bodyFormat + "'. Change your BodyFormat or do not use file type\nparameters.");*/
/*             return false;*/
/*         }*/
/* */
/*         if (hasFileTypes) {*/
/*             // retrieve all the parameters to send for file upload*/
/*             $('.parameters .tuple', $(this)).each(function() {*/
/*                 var key, value;*/
/* */
/*                 key = $('.key', $(this)).val();*/
/*                 if ($('.value', $(this)).attr('type') === 'file' ) {*/
/*                     value = $('.value', $(this)).prop('files')[0];*/
/*                 } else {*/
/*                     value = $('.value', $(this)).val();*/
/*                 }*/
/* */
/*                 if (value) {*/
/*                     formData.append(key,value);*/
/*                 }*/
/*             });*/
/*         }*/
/* */
/* */
/*         // retrieve all the parameters to send*/
/*         $('.parameters .tuple', $(this)).each(function() {*/
/*             var key, value;*/
/* */
/*             key = $('.key', $(this)).val();*/
/*             value = $('.value', $(this)).val();*/
/* */
/*             if (value) {*/
/*                 // temporary save all additional/doubled parameters*/
/*                 if (key in params) {*/
/*                     doubledParams[key] = value;*/
/*                 } else {*/
/*                     params[key] = value;*/
/*                 }*/
/*             }*/
/*         });*/
/* */
/* */
/* */
/* */
/*         // retrieve the additional headers to send*/
/*         $('.headers .tuple', $(this)).each(function() {*/
/*             var key, value;*/
/* */
/*             key = $('.key', $(this)).val();*/
/*             value = $('.value', $(this)).val();*/
/* */
/*             if (value) {*/
/*                 headers[key] = value;*/
/*             }*/
/* */
/*         });*/
/* */
/*         // fix parameters in URL*/
/*         for (var key in $.extend({}, params)) {*/
/*             if (url.indexOf('{' + key + '}') !== -1) {*/
/*                 url = url.replace('{' + key + '}', params[key]);*/
/*                 delete params[key];*/
/*             }*/
/*         };*/
/* */
/*         // merge additional params back to real params object*/
/*         if (!$.isEmptyObject(doubledParams)) {*/
/*             $.extend(params, doubledParams);*/
/*         }*/
/* */
/*         // disable all the fiels and buttons*/
/*         $('input, button', $(this)).attr('disabled', 'disabled');*/
/* */
/*         // append the query authentication*/
/*         var api_key_val = $('#api_key').val();*/
/*         if (authentication_delivery == 'query' && api_key_val.length>0) {*/
/*             url += url.indexOf('?') > 0 ? '&' : '?';*/
/*             url += api_key_parameter + '=' + api_key_val;*/
/*         }*/
/* */
/*         // prepare the api enpoint*/
/*         {% if endpoint == '' and app.request is not null and app.request.host -%}*/
/*         var endpoint = '{{ app.request.getBaseUrl() }}';*/
/*         {% else -%}*/
/*         var endpoint = '{{ endpoint }}';*/
/*         {% endif -%}*/
/*         {% if authentication and authentication.custom_endpoint %}*/
/*         if ($('#api_endpoint') && typeof($('#api_endpoint').val()) != 'undefined') {*/
/*             endpoint = $('#api_endpoint').val();*/
/*         }*/
/*         {% endif %}*/
/* */
/*         // prepare final parameters*/
/*         var body = {};*/
/*         if(bodyFormat == 'json' && method != 'GET') {*/
/*             body = unflattenDict(params);*/
/*             body = JSON.stringify(body);*/
/*         } else {*/
/*             body = params;*/
/*         }*/
/*         var data = content.length ? content : body;*/
/*         var ajaxOptions = {*/
/*             url: (url.indexOf('http')!=0?endpoint:'') + url,*/
/*             type: method,*/
/*             data: data,*/
/*             headers: headers,*/
/*             crossDomain: true,*/
/*             beforeSend: function (xhr) {*/
/*                 if (authentication_delivery) {*/
/*                     var value;*/
/* */
/*                     if ('http' == authentication_delivery) {*/
/*                         if ('basic' == authentication_type) {*/
/*                             value = 'Basic ' + btoa($('#api_login').val() + ':' + $('#api_pass').val());*/
/*                         } else if ('bearer' == authentication_type) {*/
/*                             value = 'Bearer ' + $('#api_key').val();*/
/*                         }*/
/*                     } else if ('header' == authentication_delivery) {*/
/*                         value = $('#api_key').val();*/
/*                     }*/
/* */
/*                     xhr.setRequestHeader(api_key_parameter, value);*/
/*                 }*/
/*             },*/
/*             complete: function(xhr) {*/
/*                 displayResponse(xhr, method, url, data, result_container);*/
/* */
/*                 // and enable them back*/
/*                 $('input:not(.content-type), button', $(self)).removeAttr('disabled');*/
/*             }*/
/*         };*/
/* */
/*         // overrides body format to send data properly*/
/*         if (hasFileTypes) {*/
/*             ajaxOptions.data = formData;*/
/*             ajaxOptions.processData = false;*/
/*             ajaxOptions.contentType = false;*/
/*             delete(headers['Content-type']);*/
/*         }*/
/* */
/*         // and trigger the API call*/
/*         $.ajax(ajaxOptions);*/
/* */
/*         return false;*/
/*     });*/
/* */
/*     $('.operations').on('click', '.operation > .heading', function(e) {*/
/*         if (history.pushState) {*/
/*             history.pushState(null, null, $(this).data('href'));*/
/*             e.preventDefault();*/
/*         }*/
/*     });*/
/* */
/*     $(document).on('click', '.json-collapse-section', function() {*/
/*         var openChar = $(this).data('section-open-character'),*/
/*                 closingChar = (openChar == '{' ? '}' : ']');*/
/*         if ($(this).next('.json-collapse-content').is(':visible')) {*/
/*             $(this).html('&oplus;' +  openChar + '...' + closingChar);*/
/*         } else {*/
/*             $(this).html('&#9663;' + $(this).data('section-open-character'));*/
/*         }*/
/*         $(this).next('.json-collapse-content').toggle();*/
/*     });*/
/* */
/*     $(document).on('copy', '.prettyprinted', function () {*/
/*         var $toggleMarkers = $(this).find('.json-collapse-marker');*/
/*         $toggleMarkers.hide();*/
/*         setTimeout(function () {*/
/*             $toggleMarkers.show();*/
/*         }, 100);*/
/*     });*/
/* */
/*     $('.pane.sandbox').on('click', '.to-raw', function(e) {*/
/*         renderRawBody($(this).parents('.pane').find('.response'));*/
/* */
/*         e.preventDefault();*/
/*     });*/
/* */
/*     $('.pane.sandbox').on('click', '.to-prettify', function(e) {*/
/*         renderPrettifiedBody($(this).parents('.pane').find('.response'));*/
/* */
/*         e.preventDefault();*/
/*     });*/
/* */
/*     $('.pane.sandbox').on('click', '.to-expand, .to-shrink', function(e) {*/
/*         var $headers = $(this).parents('.result').find('.headers');*/
/*         var $label = $(this).parents('.result').find('a.to-expand');*/
/* */
/*         if ($headers.hasClass('to-expand')) {*/
/*             $headers.removeClass('to-expand');*/
/*             $headers.addClass('to-shrink');*/
/*             $label.text('Shrink');*/
/*         } else {*/
/*             $headers.removeClass('to-shrink');*/
/*             $headers.addClass('to-expand');*/
/*             $label.text('Expand');*/
/*         }*/
/* */
/*         e.preventDefault();*/
/*     });*/
/* */
/* */
/*     // sets the correct parameter type on load*/
/*     $('.pane.sandbox .tuple_type').each(function() {*/
/*         setParameterType($(this));*/
/*     });*/
/* */
/* */
/*     // handles parameter type change*/
/*     $('.pane.sandbox').on('change', '.tuple_type', function() {*/
/*         setParameterType($(this),$(this).val());*/
/*     });*/
/* */
/* */
/* */
/*     $('.pane.sandbox').on('click', '.add_parameter', function() {*/
/*         var html = $(this).parents('.pane').find('.parameters_tuple_template').html();*/
/* */
/*         $(this).before(html);*/
/* */
/*         return false;*/
/*     });*/
/* */
/*     $('.pane.sandbox').on('click', '.add_header', function() {*/
/*         var html = $(this).parents('.pane').find('.headers_tuple_template').html();*/
/* */
/*         $(this).before(html);*/
/* */
/*         return false;*/
/*     });*/
/* */
/*     $('.pane.sandbox').on('click', '.remove', function() {*/
/*         $(this).parent().remove();*/
/*     });*/
/* */
/*     $('.pane.sandbox').on('click', '.set-content-type', function(e) {*/
/*         var html;*/
/*         var $element;*/
/*         var $headers = $(this).parents('form').find('.headers');*/
/*         var content_type = $(this).prev('input.value').val();*/
/* */
/*         e.preventDefault();*/
/* */
/*         if (content_type.length === 0) {*/
/*             return;*/
/*         }*/
/* */
/*         $headers.find('input.key').each(function() {*/
/*             if ($.trim($(this).val().toLowerCase()) === 'content-type') {*/
/*                 $element = $(this).parents('p');*/
/*                 return false;*/
/*             }*/
/*         });*/
/* */
/*         if (typeof $element === 'undefined') {*/
/*             html = $(this).parents('.pane').find('.tuple_template').html();*/
/* */
/*             $element = $headers.find('legend').after(html).next('p');*/
/*         }*/
/* */
/*         $element.find('input.key').val('Content-Type');*/
/*         $element.find('input.value').val(content_type);*/
/* */
/*     });*/
/* */
/*     {% if authentication and authentication.delivery == 'http' %}*/
/*     var authentication_delivery = '{{ authentication.delivery }}';*/
/*     var api_key_parameter = '{{ authentication.name }}';*/
/*     var authentication_type = '{{ authentication.type }}';*/
/*     {% elseif authentication and authentication.delivery == 'query' %}*/
/*     var authentication_delivery = '{{ authentication.delivery }}';*/
/*     var api_key_parameter = '{{ authentication.name }}';*/
/*     var search = window.location.search;*/
/*     var api_key_start = search.indexOf(api_key_parameter) + api_key_parameter.length + 1;*/
/* */
/*     if (api_key_start > 0 ) {*/
/*         var api_key_end = search.indexOf('&', api_key_start);*/
/* */
/*         var api_key = -1 == api_key_end*/
/*                 ? search.substr(api_key_start)*/
/*                 : search.substring(api_key_start, api_key_end);*/
/* */
/*         $('#api_key').val(api_key);*/
/*     }*/
/*     {% elseif authentication and authentication.delivery == 'header' %}*/
/*     var authentication_delivery = '{{ authentication.delivery }}';*/
/*     var api_key_parameter = '{{ authentication.name }}';*/
/*     {% else %}*/
/*     var authentication_delivery = false;*/
/*     {% endif %}*/
/*     {% endif %}*/
/* */
/*     </script>*/
/* {% endblock %}*/
/* */
/* */
