<?php

/* BraincraftedBootstrapBundle:Form:bootstrap.html.twig */
class __TwigTemplate_1cdcb91623888c76b6da17ce3aec04b75adb19728633791dc59ff43baf9764bd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $_trait_0 = $this->loadTemplate("form_div_layout.html.twig", "BraincraftedBootstrapBundle:Form:bootstrap.html.twig", 1);
        // line 1
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."form_div_layout.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'form_widget' => array($this, 'block_form_widget'),
                'form_widget_simple' => array($this, 'block_form_widget_simple'),
                'form_widget_compound' => array($this, 'block_form_widget_compound'),
                'collection_widget' => array($this, 'block_collection_widget'),
                'bootstrap_collection_widget' => array($this, 'block_bootstrap_collection_widget'),
                'textarea_widget' => array($this, 'block_textarea_widget'),
                'file_widget' => array($this, 'block_file_widget'),
                'choice_widget' => array($this, 'block_choice_widget'),
                'choice_widget_expanded' => array($this, 'block_choice_widget_expanded'),
                'choice_widget_collapsed' => array($this, 'block_choice_widget_collapsed'),
                'choice_widget_options' => array($this, 'block_choice_widget_options'),
                'checkbox_row' => array($this, 'block_checkbox_row'),
                'radio_row' => array($this, 'block_radio_row'),
                'checkbox_widget' => array($this, 'block_checkbox_widget'),
                'radio_widget' => array($this, 'block_radio_widget'),
                'datetime_widget' => array($this, 'block_datetime_widget'),
                'date_widget' => array($this, 'block_date_widget'),
                'time_widget' => array($this, 'block_time_widget'),
                'number_widget' => array($this, 'block_number_widget'),
                'integer_widget' => array($this, 'block_integer_widget'),
                'money_widget' => array($this, 'block_money_widget'),
                'url_widget' => array($this, 'block_url_widget'),
                'search_widget' => array($this, 'block_search_widget'),
                'percent_widget' => array($this, 'block_percent_widget'),
                'password_widget' => array($this, 'block_password_widget'),
                'hidden_widget' => array($this, 'block_hidden_widget'),
                'email_widget' => array($this, 'block_email_widget'),
                'button_widget' => array($this, 'block_button_widget'),
                'submit_widget' => array($this, 'block_submit_widget'),
                'reset_widget' => array($this, 'block_reset_widget'),
                'form_actions_widget' => array($this, 'block_form_actions_widget'),
                'bs_static_widget' => array($this, 'block_bs_static_widget'),
                'form_label' => array($this, 'block_form_label'),
                'button_label' => array($this, 'block_button_label'),
                'repeated_row' => array($this, 'block_repeated_row'),
                'form_row' => array($this, 'block_form_row'),
                'form_input_group' => array($this, 'block_form_input_group'),
                'form_help' => array($this, 'block_form_help'),
                'button_row' => array($this, 'block_button_row'),
                'hidden_row' => array($this, 'block_hidden_row'),
                'form_actions_row' => array($this, 'block_form_actions_row'),
                'form' => array($this, 'block_form'),
                'form_start' => array($this, 'block_form_start'),
                'form_end' => array($this, 'block_form_end'),
                'form_enctype' => array($this, 'block_form_enctype'),
                'global_form_errors' => array($this, 'block_global_form_errors'),
                'form_errors' => array($this, 'block_form_errors'),
                'form_rest' => array($this, 'block_form_rest'),
                'form_rows' => array($this, 'block_form_rows'),
                'widget_attributes' => array($this, 'block_widget_attributes'),
                'widget_container_attributes' => array($this, 'block_widget_container_attributes'),
                'button_attributes' => array($this, 'block_button_attributes'),
            )
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ed228684314c5e34a7b2f6d6379f7190e9294eb55ba7ef90cf16c8385ae774da = $this->env->getExtension("native_profiler");
        $__internal_ed228684314c5e34a7b2f6d6379f7190e9294eb55ba7ef90cf16c8385ae774da->enter($__internal_ed228684314c5e34a7b2f6d6379f7190e9294eb55ba7ef90cf16c8385ae774da_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "BraincraftedBootstrapBundle:Form:bootstrap.html.twig"));

        // line 2
        echo "
";
        // line 4
        echo "
";
        // line 5
        $this->displayBlock('form_widget', $context, $blocks);
        // line 14
        echo "
";
        // line 15
        $this->displayBlock('form_widget_simple', $context, $blocks);
        // line 59
        echo "
";
        // line 60
        $this->displayBlock('form_widget_compound', $context, $blocks);
        // line 71
        echo "
";
        // line 72
        $this->displayBlock('collection_widget', $context, $blocks);
        // line 80
        echo "
";
        // line 81
        $this->displayBlock('bootstrap_collection_widget', $context, $blocks);
        // line 121
        echo "
";
        // line 122
        $this->displayBlock('textarea_widget', $context, $blocks);
        // line 146
        echo "
";
        // line 147
        $this->displayBlock('file_widget', $context, $blocks);
        // line 170
        echo "
";
        // line 171
        $this->displayBlock('choice_widget', $context, $blocks);
        // line 180
        echo "
";
        // line 181
        $this->displayBlock('choice_widget_expanded', $context, $blocks);
        // line 194
        echo "
";
        // line 195
        $this->displayBlock('choice_widget_collapsed', $context, $blocks);
        // line 215
        echo "
";
        // line 216
        $this->displayBlock('choice_widget_options', $context, $blocks);
        // line 230
        echo "
";
        // line 231
        $this->displayBlock('checkbox_row', $context, $blocks);
        // line 302
        echo "
";
        // line 303
        $this->displayBlock('radio_row', $context, $blocks);
        // line 369
        echo "
";
        // line 370
        $this->displayBlock('checkbox_widget', $context, $blocks);
        // line 375
        echo "
";
        // line 376
        $this->displayBlock('radio_widget', $context, $blocks);
        // line 381
        echo "
";
        // line 382
        $this->displayBlock('datetime_widget', $context, $blocks);
        // line 397
        echo "
";
        // line 398
        $this->displayBlock('date_widget', $context, $blocks);
        // line 414
        echo "
";
        // line 415
        $this->displayBlock('time_widget', $context, $blocks);
        // line 430
        echo "
";
        // line 431
        $this->displayBlock('number_widget', $context, $blocks);
        // line 438
        echo "
";
        // line 439
        $this->displayBlock('integer_widget', $context, $blocks);
        // line 445
        echo "
";
        // line 446
        $this->displayBlock('money_widget', $context, $blocks);
        // line 457
        echo "
";
        // line 458
        $this->displayBlock('url_widget', $context, $blocks);
        // line 464
        echo "
";
        // line 465
        $this->displayBlock('search_widget', $context, $blocks);
        // line 471
        echo "
";
        // line 472
        $this->displayBlock('percent_widget', $context, $blocks);
        // line 481
        echo "
";
        // line 482
        $this->displayBlock('password_widget', $context, $blocks);
        // line 488
        echo "
";
        // line 489
        $this->displayBlock('hidden_widget', $context, $blocks);
        // line 495
        echo "
";
        // line 496
        $this->displayBlock('email_widget', $context, $blocks);
        // line 502
        echo "
";
        // line 503
        $this->displayBlock('button_widget', $context, $blocks);
        // line 520
        echo "
";
        // line 521
        $this->displayBlock('submit_widget', $context, $blocks);
        // line 527
        echo "
";
        // line 528
        $this->displayBlock('reset_widget', $context, $blocks);
        // line 534
        echo "
";
        // line 535
        $this->displayBlock('form_actions_widget', $context, $blocks);
        // line 540
        echo "
";
        // line 541
        $this->displayBlock('bs_static_widget', $context, $blocks);
        // line 545
        echo "
";
        // line 547
        echo "
";
        // line 548
        $this->displayBlock('form_label', $context, $blocks);
        // line 590
        echo "
";
        // line 591
        $this->displayBlock('button_label', $context, $blocks);
        // line 592
        echo "
";
        // line 594
        echo "
";
        // line 595
        $this->displayBlock('repeated_row', $context, $blocks);
        // line 604
        echo "
";
        // line 605
        $this->displayBlock('form_row', $context, $blocks);
        // line 648
        echo "
";
        // line 649
        $this->displayBlock('form_input_group', $context, $blocks);
        // line 683
        echo "
";
        // line 684
        $this->displayBlock('form_help', $context, $blocks);
        // line 695
        echo "
";
        // line 696
        $this->displayBlock('button_row', $context, $blocks);
        // line 730
        echo "
";
        // line 731
        $this->displayBlock('hidden_row', $context, $blocks);
        // line 734
        echo "
";
        // line 735
        $this->displayBlock('form_actions_row', $context, $blocks);
        // line 738
        echo "
";
        // line 740
        echo "
";
        // line 741
        $this->displayBlock('form', $context, $blocks);
        // line 748
        echo "
";
        // line 749
        $this->displayBlock('form_start', $context, $blocks);
        // line 794
        echo "
";
        // line 795
        $this->displayBlock('form_end', $context, $blocks);
        // line 819
        echo "
";
        // line 820
        $this->displayBlock('form_enctype', $context, $blocks);
        // line 825
        echo "
";
        // line 826
        $this->displayBlock('global_form_errors', $context, $blocks);
        // line 832
        echo "
";
        // line 833
        $this->displayBlock('form_errors', $context, $blocks);
        // line 857
        echo "
";
        // line 858
        $this->displayBlock('form_rest', $context, $blocks);
        // line 867
        echo "
";
        // line 869
        echo "
";
        // line 870
        $this->displayBlock('form_rows', $context, $blocks);
        // line 893
        echo "
";
        // line 894
        $this->displayBlock('widget_attributes', $context, $blocks);
        // line 900
        echo "
";
        // line 901
        $this->displayBlock('widget_container_attributes', $context, $blocks);
        // line 911
        echo "
";
        // line 912
        $this->displayBlock('button_attributes', $context, $blocks);
        
        $__internal_ed228684314c5e34a7b2f6d6379f7190e9294eb55ba7ef90cf16c8385ae774da->leave($__internal_ed228684314c5e34a7b2f6d6379f7190e9294eb55ba7ef90cf16c8385ae774da_prof);

    }

    // line 5
    public function block_form_widget($context, array $blocks = array())
    {
        $__internal_ca5163704932b92d4d6cdada06b371eb076a4522353f4eb766ddfe24928163f5 = $this->env->getExtension("native_profiler");
        $__internal_ca5163704932b92d4d6cdada06b371eb076a4522353f4eb766ddfe24928163f5->enter($__internal_ca5163704932b92d4d6cdada06b371eb076a4522353f4eb766ddfe24928163f5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_widget"));

        // line 6
        echo "    ";
        ob_start();
        // line 7
        echo "        ";
        if ((isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound"))) {
            // line 8
            echo "            ";
            $this->displayBlock("form_widget_compound", $context, $blocks);
            echo "
        ";
        } else {
            // line 10
            echo "            ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
        ";
        }
        // line 12
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_ca5163704932b92d4d6cdada06b371eb076a4522353f4eb766ddfe24928163f5->leave($__internal_ca5163704932b92d4d6cdada06b371eb076a4522353f4eb766ddfe24928163f5_prof);

    }

    // line 15
    public function block_form_widget_simple($context, array $blocks = array())
    {
        $__internal_02b0cd7f93432747375f6fcde6ce3a648375acdf32c060cc027dd1decf1dfcba = $this->env->getExtension("native_profiler");
        $__internal_02b0cd7f93432747375f6fcde6ce3a648375acdf32c060cc027dd1decf1dfcba->enter($__internal_02b0cd7f93432747375f6fcde6ce3a648375acdf32c060cc027dd1decf1dfcba_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_widget_simple"));

        // line 16
        echo "    ";
        ob_start();
        // line 17
        echo "        ";
        $context["style"] = ((array_key_exists("style", $context)) ? (_twig_default_filter((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")), $this->env->getExtension('braincrafted_bootstrap_form')->getStyle())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getStyle()));
        // line 18
        echo "        ";
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 19
        echo "
        ";
        // line 20
        if (( !array_key_exists("simple_col", $context) && $this->env->getExtension('braincrafted_bootstrap_form')->getSimpleCol())) {
            // line 21
            echo "            ";
            $context["simple_col"] = $this->env->getExtension('braincrafted_bootstrap_form')->getSimpleCol();
            // line 22
            echo "        ";
        }
        // line 23
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "simple_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "simple_col", array())))) {
            // line 24
            echo "            ";
            $context["simple_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "simple_col", array());
            // line 25
            echo "        ";
        }
        // line 26
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 27
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 28
            echo "        ";
        }
        // line 29
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())))) {
            // line 30
            echo "            ";
            $context["style"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array());
            // line 31
            echo "        ";
        }
        // line 32
        echo "
        ";
        // line 33
        if ((array_key_exists("simple_col", $context) && (isset($context["simple_col"]) ? $context["simple_col"] : $this->getContext($context, "simple_col")))) {
            // line 34
            echo "            <div class=\"col-";
            echo twig_escape_filter($this->env, (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, (isset($context["simple_col"]) ? $context["simple_col"] : $this->getContext($context, "simple_col")), "html", null, true);
            echo "\">
        ";
        }
        // line 36
        echo "
        ";
        // line 37
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "text")) : ("text"));
        // line 38
        echo "
        ";
        // line 39
        if (((((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "inline") && ( !$this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "placeholder", array(), "any", true, true) || twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "placeholder", array())))) &&  !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false))) {
            // line 40
            echo "            ";
            if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
                // line 41
                echo "                ";
                $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("placeholder" => $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")))));
                // line 42
                echo "            ";
            } else {
                // line 43
                echo "                ";
                $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("placeholder" => (isset($context["label"]) ? $context["label"] : $this->getContext($context, "label"))));
                // line 44
                echo "            ";
            }
            // line 45
            echo "        ";
        }
        // line 46
        echo "
        ";
        // line 47
        if ((array_key_exists("static_control", $context) && ((isset($context["static_control"]) ? $context["static_control"] : $this->getContext($context, "static_control")) == true))) {
            // line 48
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control-static"))));
            // line 49
            echo "            <p id=\"";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "\"";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "</p>";
        } else {
            // line 51
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control"))));
            // line 52
            echo "            <input type=\"";
            echo twig_escape_filter($this->env, (isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "html", null, true);
            echo "\" ";
            $this->displayBlock("widget_attributes", $context, $blocks);
            echo " ";
            if ( !twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
                echo "value=\"";
                echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
                echo "\" ";
            }
            echo ">";
        }
        // line 54
        echo "        ";
        if (array_key_exists("simple_col", $context)) {
            // line 55
            echo "            </div>
        ";
        }
        // line 57
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_02b0cd7f93432747375f6fcde6ce3a648375acdf32c060cc027dd1decf1dfcba->leave($__internal_02b0cd7f93432747375f6fcde6ce3a648375acdf32c060cc027dd1decf1dfcba_prof);

    }

    // line 60
    public function block_form_widget_compound($context, array $blocks = array())
    {
        $__internal_a25dcae977c429366a019ee531b47404ee4b9660ca374b51e0abe8776b3b5e78 = $this->env->getExtension("native_profiler");
        $__internal_a25dcae977c429366a019ee531b47404ee4b9660ca374b51e0abe8776b3b5e78->enter($__internal_a25dcae977c429366a019ee531b47404ee4b9660ca374b51e0abe8776b3b5e78_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_widget_compound"));

        // line 61
        echo "    ";
        ob_start();
        // line 62
        echo "        <div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
            ";
        // line 63
        if (twig_test_empty($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent", array()))) {
            // line 64
            echo "                ";
            $this->displayBlock("global_form_errors", $context, $blocks);
            echo "
            ";
        }
        // line 66
        echo "            ";
        $this->displayBlock("form_rows", $context, $blocks);
        echo "
            ";
        // line 67
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_a25dcae977c429366a019ee531b47404ee4b9660ca374b51e0abe8776b3b5e78->leave($__internal_a25dcae977c429366a019ee531b47404ee4b9660ca374b51e0abe8776b3b5e78_prof);

    }

    // line 72
    public function block_collection_widget($context, array $blocks = array())
    {
        $__internal_7d8773d5741a4770c33b15c239e1e9ede524755e195dd058f1ccd198227558fc = $this->env->getExtension("native_profiler");
        $__internal_7d8773d5741a4770c33b15c239e1e9ede524755e195dd058f1ccd198227558fc->enter($__internal_7d8773d5741a4770c33b15c239e1e9ede524755e195dd058f1ccd198227558fc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "collection_widget"));

        // line 73
        echo "    ";
        ob_start();
        // line 74
        echo "        ";
        if (array_key_exists("prototype", $context)) {
            // line 75
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("data-prototype" => $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["prototype"]) ? $context["prototype"] : $this->getContext($context, "prototype")), 'row')));
            // line 76
            echo "        ";
        }
        // line 77
        echo "        ";
        $this->displayBlock("form_widget", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_7d8773d5741a4770c33b15c239e1e9ede524755e195dd058f1ccd198227558fc->leave($__internal_7d8773d5741a4770c33b15c239e1e9ede524755e195dd058f1ccd198227558fc_prof);

    }

    // line 81
    public function block_bootstrap_collection_widget($context, array $blocks = array())
    {
        $__internal_6a2c91e62a35a5e9fbc920a4a4c3d0f1b3df706d66fefcb85de02b38a9441e0c = $this->env->getExtension("native_profiler");
        $__internal_6a2c91e62a35a5e9fbc920a4a4c3d0f1b3df706d66fefcb85de02b38a9441e0c->enter($__internal_6a2c91e62a35a5e9fbc920a4a4c3d0f1b3df706d66fefcb85de02b38a9441e0c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "bootstrap_collection_widget"));

        // line 82
        echo "    ";
        ob_start();
        // line 83
        echo "        ";
        if (array_key_exists("prototype", $context)) {
            // line 84
            echo "            ";
            $context["prototype_vars"] = array();
            // line 85
            echo "            ";
            if (array_key_exists("style", $context)) {
                // line 86
                echo "                ";
                $context["prototype_vars"] = twig_array_merge((isset($context["prototype_vars"]) ? $context["prototype_vars"] : $this->getContext($context, "prototype_vars")), array("style" => (isset($context["style"]) ? $context["style"] : $this->getContext($context, "style"))));
                // line 87
                echo "            ";
            }
            // line 88
            echo "            ";
            $context["prototype_html"] = (((("<div class=\"col-xs-" . $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "sub_widget_col", array())) . "\">") . $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["prototype"]) ? $context["prototype"] : $this->getContext($context, "prototype")), 'widget', (isset($context["prototype_vars"]) ? $context["prototype_vars"] : $this->getContext($context, "prototype_vars")))) . "</div>");
            // line 89
            echo "            ";
            if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "allow_delete", array())) {
                // line 90
                echo "                ";
                $context["prototype_html"] = ((((((isset($context["prototype_html"]) ? $context["prototype_html"] : $this->getContext($context, "prototype_html")) . "<div class=\"col-xs-") . $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "button_col", array())) . "\"><a href=\"#\" class=\"btn btn-danger btn-sm\" data-removefield=\"collection\" data-field=\"__id__\">") . $this->env->getExtension('braincrafted_bootstrap_icon')->parseIconsFilter(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "delete_button_text", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true))) . "</a></div>");
                // line 91
                echo "            ";
            }
            // line 92
            echo "            ";
            $context["prototype_html"] = (("<div class=\"row\">" . (isset($context["prototype_html"]) ? $context["prototype_html"] : $this->getContext($context, "prototype_html"))) . "</div>");
            // line 93
            echo "
            ";
            // line 94
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("data-prototype" => (isset($context["prototype_html"]) ? $context["prototype_html"] : $this->getContext($context, "prototype_html"))));
            // line 95
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("data-prototype-name" => (isset($context["prototype_name"]) ? $context["prototype_name"] : $this->getContext($context, "prototype_name"))));
            // line 96
            echo "        ";
        }
        // line 97
        echo "        <div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
            <ul class=\"bc-collection list-unstyled\">
                ";
        // line 99
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            // line 100
            echo "                    <li>
                        <div class=\"row\">
                            <div class=\"col-xs-";
            // line 102
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "sub_widget_col", array()), "html", null, true);
            echo "\">
                                ";
            // line 103
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["field"], 'widget');
            echo "
                                ";
            // line 104
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["field"], 'errors');
            echo "
                            </div>
                            ";
            // line 106
            if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "allow_delete", array())) {
                // line 107
                echo "                                <div class=\"col-xs-";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "button_col", array()), "html", null, true);
                echo "\">
                                    <a href=\"#\" class=\"btn btn-danger btn-sm\" data-removefield=\"collection\" data-field=\"";
                // line 108
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["field"], "vars", array()), "id", array()), "html", null, true);
                echo "\">";
                echo $this->env->getExtension('braincrafted_bootstrap_icon')->parseIconsFilter(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "delete_button_text", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true));
                echo "</a>
                                </div>
                            ";
            }
            // line 111
            echo "                        </div>
                    </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 114
        echo "            </ul>
            ";
        // line 115
        if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "allow_add", array())) {
            // line 116
            echo "                <a href=\"#\" class=\"btn btn-primary btn-sm\" data-addfield=\"collection\" data-collection=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "id", array()), "html", null, true);
            echo "\" data-prototype-name=\"";
            echo twig_escape_filter($this->env, (isset($context["prototype_name"]) ? $context["prototype_name"] : $this->getContext($context, "prototype_name")), "html", null, true);
            echo "\">";
            echo $this->env->getExtension('braincrafted_bootstrap_icon')->parseIconsFilter(twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "add_button_text", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true));
            echo "</a>
            ";
        }
        // line 118
        echo "        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_6a2c91e62a35a5e9fbc920a4a4c3d0f1b3df706d66fefcb85de02b38a9441e0c->leave($__internal_6a2c91e62a35a5e9fbc920a4a4c3d0f1b3df706d66fefcb85de02b38a9441e0c_prof);

    }

    // line 122
    public function block_textarea_widget($context, array $blocks = array())
    {
        $__internal_3f3846c116adee444c6d156da315f7f853adf347c896e2e330f8357bed912fd1 = $this->env->getExtension("native_profiler");
        $__internal_3f3846c116adee444c6d156da315f7f853adf347c896e2e330f8357bed912fd1->enter($__internal_3f3846c116adee444c6d156da315f7f853adf347c896e2e330f8357bed912fd1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "textarea_widget"));

        // line 123
        echo "    ";
        ob_start();
        // line 124
        echo "        ";
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 125
        echo "
        ";
        // line 126
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "simple_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "simple_col", array())))) {
            // line 127
            echo "            ";
            $context["simple_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "simple_col", array());
            // line 128
            echo "        ";
        }
        // line 129
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 130
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 131
            echo "        ";
        }
        // line 132
        echo "
        ";
        // line 133
        if (array_key_exists("simple_col", $context)) {
            // line 134
            echo "            <div class=\"col-";
            echo twig_escape_filter($this->env, (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, (isset($context["simple_col"]) ? $context["simple_col"] : $this->getContext($context, "simple_col")), "html", null, true);
            echo "\">
        ";
        }
        // line 136
        echo "
        ";
        // line 137
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control"))));
        // line 138
        echo "
        <textarea ";
        // line 139
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo ">";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo "</textarea>

        ";
        // line 141
        if (array_key_exists("simple_col", $context)) {
            // line 142
            echo "            </div>
        ";
        }
        // line 144
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_3f3846c116adee444c6d156da315f7f853adf347c896e2e330f8357bed912fd1->leave($__internal_3f3846c116adee444c6d156da315f7f853adf347c896e2e330f8357bed912fd1_prof);

    }

    // line 147
    public function block_file_widget($context, array $blocks = array())
    {
        $__internal_a61212b54cc54aa52162c46b9a3f1579e45b2888a0e30325dea665f9a2107b9d = $this->env->getExtension("native_profiler");
        $__internal_a61212b54cc54aa52162c46b9a3f1579e45b2888a0e30325dea665f9a2107b9d->enter($__internal_a61212b54cc54aa52162c46b9a3f1579e45b2888a0e30325dea665f9a2107b9d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "file_widget"));

        // line 148
        echo "    ";
        ob_start();
        // line 149
        echo "        ";
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 150
        echo "
        ";
        // line 151
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "simple_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "simple_col", array())))) {
            // line 152
            echo "            ";
            $context["simple_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "simple_col", array());
            // line 153
            echo "        ";
        }
        // line 154
        echo "
        ";
        // line 155
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 156
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 157
            echo "        ";
        }
        // line 158
        echo "
        ";
        // line 159
        if (array_key_exists("simple_col", $context)) {
            // line 160
            echo "            <div class=\"col-";
            echo twig_escape_filter($this->env, (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, (isset($context["simple_col"]) ? $context["simple_col"] : $this->getContext($context, "simple_col")), "html", null, true);
            echo "\">
        ";
        }
        // line 162
        echo "
        <input type=\"file\" ";
        // line 163
        $this->displayBlock("widget_attributes", $context, $blocks);
        echo ">

        ";
        // line 165
        if (array_key_exists("simple_col", $context)) {
            // line 166
            echo "            </div>
        ";
        }
        // line 168
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_a61212b54cc54aa52162c46b9a3f1579e45b2888a0e30325dea665f9a2107b9d->leave($__internal_a61212b54cc54aa52162c46b9a3f1579e45b2888a0e30325dea665f9a2107b9d_prof);

    }

    // line 171
    public function block_choice_widget($context, array $blocks = array())
    {
        $__internal_ecbead017b782183ae53032f2b55519bac46a82095c830c6d6bdb1b10beeea67 = $this->env->getExtension("native_profiler");
        $__internal_ecbead017b782183ae53032f2b55519bac46a82095c830c6d6bdb1b10beeea67->enter($__internal_ecbead017b782183ae53032f2b55519bac46a82095c830c6d6bdb1b10beeea67_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "choice_widget"));

        // line 172
        echo "    ";
        ob_start();
        // line 173
        echo "        ";
        if ((isset($context["expanded"]) ? $context["expanded"] : $this->getContext($context, "expanded"))) {
            // line 174
            echo "            ";
            $this->displayBlock("choice_widget_expanded", $context, $blocks);
            echo "
        ";
        } else {
            // line 176
            echo "            ";
            $this->displayBlock("choice_widget_collapsed", $context, $blocks);
            echo "
        ";
        }
        // line 178
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_ecbead017b782183ae53032f2b55519bac46a82095c830c6d6bdb1b10beeea67->leave($__internal_ecbead017b782183ae53032f2b55519bac46a82095c830c6d6bdb1b10beeea67_prof);

    }

    // line 181
    public function block_choice_widget_expanded($context, array $blocks = array())
    {
        $__internal_a13e002137740595707affea6c24ed231ab5c4fa1b76b527d9d83ec0de01a386 = $this->env->getExtension("native_profiler");
        $__internal_a13e002137740595707affea6c24ed231ab5c4fa1b76b527d9d83ec0de01a386->enter($__internal_a13e002137740595707affea6c24ed231ab5c4fa1b76b527d9d83ec0de01a386_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "choice_widget_expanded"));

        // line 182
        echo "    ";
        ob_start();
        // line 183
        echo "        <div ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
            ";
        // line 184
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 185
            echo "                ";
            if ((isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))) {
                // line 186
                echo "                    ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'row', array("no_form_group" => true, "inline" => ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "inline", array(), "any", true, true) && $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "inline", array())), "label_attr" => (isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr"))));
                echo "
                ";
            } else {
                // line 188
                echo "                    ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'row', array("no_form_group" => true, "inline" => ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "inline", array(), "any", true, true) && $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "inline", array())), "label_attr" => (isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr"))));
                echo "
                ";
            }
            // line 190
            echo "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 191
        echo "        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_a13e002137740595707affea6c24ed231ab5c4fa1b76b527d9d83ec0de01a386->leave($__internal_a13e002137740595707affea6c24ed231ab5c4fa1b76b527d9d83ec0de01a386_prof);

    }

    // line 195
    public function block_choice_widget_collapsed($context, array $blocks = array())
    {
        $__internal_55f444033ba476161b01f59441483eec617a82b535fd75f6090dbee63acae6e0 = $this->env->getExtension("native_profiler");
        $__internal_55f444033ba476161b01f59441483eec617a82b535fd75f6090dbee63acae6e0->enter($__internal_55f444033ba476161b01f59441483eec617a82b535fd75f6090dbee63acae6e0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "choice_widget_collapsed"));

        // line 196
        echo "    ";
        ob_start();
        // line 197
        echo "        ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control"))));
        // line 198
        echo "
        <select ";
        // line 199
        $this->displayBlock("widget_attributes", $context, $blocks);
        if ((isset($context["multiple"]) ? $context["multiple"] : $this->getContext($context, "multiple"))) {
            echo " multiple=\"multiple\"";
        }
        echo ">
            ";
        // line 200
        if ( !(null === (isset($context["placeholder"]) ? $context["placeholder"] : $this->getContext($context, "placeholder")))) {
            // line 201
            echo "                <option ";
            if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
                echo " disabled=\"disabled\"";
                if (twig_test_empty((isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
                    echo " selected=\"selected\"";
                }
            }
            echo " value=\"\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["placeholder"]) ? $context["placeholder"] : $this->getContext($context, "placeholder")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "</option>
            ";
        }
        // line 203
        echo "            ";
        if ((twig_length_filter($this->env, (isset($context["preferred_choices"]) ? $context["preferred_choices"] : $this->getContext($context, "preferred_choices"))) > 0)) {
            // line 204
            echo "                ";
            $context["options"] = (isset($context["preferred_choices"]) ? $context["preferred_choices"] : $this->getContext($context, "preferred_choices"));
            // line 205
            echo "                ";
            $this->displayBlock("choice_widget_options", $context, $blocks);
            echo "
                ";
            // line 206
            if (((twig_length_filter($this->env, (isset($context["choices"]) ? $context["choices"] : $this->getContext($context, "choices"))) > 0) &&  !(null === (isset($context["separator"]) ? $context["separator"] : $this->getContext($context, "separator"))))) {
                // line 207
                echo "                    <option disabled=\"disabled\">";
                echo twig_escape_filter($this->env, (isset($context["separator"]) ? $context["separator"] : $this->getContext($context, "separator")), "html", null, true);
                echo "</option>
                ";
            }
            // line 209
            echo "            ";
        }
        // line 210
        echo "            ";
        $context["options"] = (isset($context["choices"]) ? $context["choices"] : $this->getContext($context, "choices"));
        // line 211
        echo "            ";
        $this->displayBlock("choice_widget_options", $context, $blocks);
        echo "
        </select>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_55f444033ba476161b01f59441483eec617a82b535fd75f6090dbee63acae6e0->leave($__internal_55f444033ba476161b01f59441483eec617a82b535fd75f6090dbee63acae6e0_prof);

    }

    // line 216
    public function block_choice_widget_options($context, array $blocks = array())
    {
        $__internal_65a7b5e771aee316f5ece3e8b3c50e0306f22e39599a460be706a6567c02fff8 = $this->env->getExtension("native_profiler");
        $__internal_65a7b5e771aee316f5ece3e8b3c50e0306f22e39599a460be706a6567c02fff8->enter($__internal_65a7b5e771aee316f5ece3e8b3c50e0306f22e39599a460be706a6567c02fff8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "choice_widget_options"));

        // line 217
        echo "    ";
        ob_start();
        // line 218
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["options"]) ? $context["options"] : $this->getContext($context, "options")));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["group_label"] => $context["choice"]) {
            // line 219
            echo "            ";
            if (twig_test_iterable($context["choice"])) {
                // line 220
                echo "                <optgroup label=\"";
                echo twig_escape_filter($this->env, ((array_key_exists("choice_translation_domain", $context)) ? (((((isset($context["choice_translation_domain"]) ? $context["choice_translation_domain"] : $this->getContext($context, "choice_translation_domain")) === false)) ? ($context["group_label"]) : ($this->env->getExtension('translator')->trans($context["group_label"], array(), (isset($context["choice_translation_domain"]) ? $context["choice_translation_domain"] : $this->getContext($context, "choice_translation_domain")))))) : ($this->env->getExtension('translator')->trans($context["group_label"], array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))))), "html", null, true);
                echo "\">
                    ";
                // line 221
                $context["options"] = $context["choice"];
                // line 222
                echo "                    ";
                $this->displayBlock("choice_widget_options", $context, $blocks);
                echo "
                </optgroup>
            ";
            } else {
                // line 225
                echo "                <option value=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["choice"], "value", array()), "html", null, true);
                echo "\"";
                if ($this->env->getExtension('form')->isSelectedChoice($context["choice"], (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")))) {
                    echo " selected=\"selected\"";
                }
                echo ">";
                echo twig_escape_filter($this->env, ((array_key_exists("choice_translation_domain", $context)) ? (((((isset($context["choice_translation_domain"]) ? $context["choice_translation_domain"] : $this->getContext($context, "choice_translation_domain")) === false)) ? ($this->getAttribute($context["choice"], "label", array())) : ($this->env->getExtension('translator')->trans($this->getAttribute($context["choice"], "label", array()), array(), (isset($context["choice_translation_domain"]) ? $context["choice_translation_domain"] : $this->getContext($context, "choice_translation_domain")))))) : ($this->env->getExtension('translator')->trans($this->getAttribute($context["choice"], "label", array()), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))))), "html", null, true);
                echo "</option>
            ";
            }
            // line 227
            echo "        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['group_label'], $context['choice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 228
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_65a7b5e771aee316f5ece3e8b3c50e0306f22e39599a460be706a6567c02fff8->leave($__internal_65a7b5e771aee316f5ece3e8b3c50e0306f22e39599a460be706a6567c02fff8_prof);

    }

    // line 231
    public function block_checkbox_row($context, array $blocks = array())
    {
        $__internal_270834ad85d4bb17a6491c3a5519d11de457681878693678d1a536bab323c425 = $this->env->getExtension("native_profiler");
        $__internal_270834ad85d4bb17a6491c3a5519d11de457681878693678d1a536bab323c425->enter($__internal_270834ad85d4bb17a6491c3a5519d11de457681878693678d1a536bab323c425_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "checkbox_row"));

        // line 232
        echo "    ";
        ob_start();
        // line 233
        echo "        ";
        $context["style"] = ((array_key_exists("style", $context)) ? (_twig_default_filter((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")), $this->env->getExtension('braincrafted_bootstrap_form')->getStyle())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getStyle()));
        // line 234
        echo "        ";
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 235
        echo "
        ";
        // line 236
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "label_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array())))) {
            // line 237
            echo "            ";
            $context["label_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array());
            // line 238
            echo "        ";
        }
        // line 239
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array())))) {
            // line 240
            echo "            ";
            $context["widget_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array());
            // line 241
            echo "        ";
        }
        // line 242
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 243
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 244
            echo "        ";
        }
        // line 245
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())))) {
            // line 246
            echo "            ";
            $context["style"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array());
            // line 247
            echo "        ";
        }
        // line 248
        echo "
        ";
        // line 249
        $context["class"] = "";
        // line 250
        echo "        ";
        if ((array_key_exists("align_with_widget", $context) || $this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "align_with_widget", array(), "any", true, true))) {
            // line 251
            echo "            ";
            $context["widget_col"] = ((array_key_exists("widget_col", $context)) ? (_twig_default_filter((isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol()));
            // line 252
            echo "            ";
            $context["label_col"] = ((array_key_exists("label_col", $context)) ? (_twig_default_filter((isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol()));
            // line 253
            echo "            ";
            $context["class"] = ((((((("col-" . (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size"))) . "-") . (isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col"))) . " col-") . (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size"))) . "-offset-") . (isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")));
            // line 254
            echo "            <div class=\"form-group ";
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "errors", array())) > 0)) {
                echo " has-error";
            }
            echo "\">
            <div class=\"";
            // line 255
            echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "html", null, true);
            echo "\">
        ";
        } elseif (( !        // line 256
array_key_exists("no_form_group", $context) || ((isset($context["no_form_group"]) ? $context["no_form_group"] : $this->getContext($context, "no_form_group")) == false))) {
            // line 257
            echo "            <div class=\"form-group";
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "errors", array())) > 0)) {
                echo " has-error";
            }
            echo "\">
        ";
        }
        // line 259
        echo "
        ";
        // line 260
        ob_start();
        // line 261
        echo "        ";
        if ( !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false)) {
            // line 262
            echo "            ";
            if ( !(isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound"))) {
                // line 263
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("for" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
                // line 264
                echo "            ";
            }
            // line 265
            echo "            ";
            if ((array_key_exists("inline", $context) && (isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")))) {
                // line 266
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " checkbox-inline"))));
                // line 267
                echo "            ";
            }
            // line 268
            echo "            ";
            if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
                // line 269
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " required"))));
                // line 270
                echo "            ";
            }
            // line 271
            echo "            ";
            if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
                // line 272
                echo "                ";
                $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
                // line 273
                echo "            ";
            }
            // line 274
            echo "            <label";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">
            ";
            // line 275
            $this->displayBlock("checkbox_widget", $context, $blocks);
            echo "
            ";
            // line 276
            echo $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain")));
            // line 277
            echo "</label>
        ";
        } else {
            // line 279
            echo "            ";
            $this->displayBlock("checkbox_widget", $context, $blocks);
            echo "
        ";
        }
        // line 281
        echo "        ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
        ";
        $context["checkboxdata"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 283
        echo "
        ";
        // line 284
        if ((array_key_exists("inline", $context) && (isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")))) {
            // line 285
            echo "            ";
            echo (isset($context["checkboxdata"]) ? $context["checkboxdata"] : $this->getContext($context, "checkboxdata"));
            echo "
        ";
        } else {
            // line 287
            echo "            <div class=\"checkbox\">";
            echo (isset($context["checkboxdata"]) ? $context["checkboxdata"] : $this->getContext($context, "checkboxdata"));
            echo "</div>
        ";
        }
        // line 289
        echo "
        ";
        // line 290
        $this->displayBlock("form_help", $context, $blocks);
        echo "

        ";
        // line 292
        if ((array_key_exists("align_with_widget", $context) || $this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "align_with_widget", array(), "any", true, true))) {
            // line 293
            echo "            </div>
            </div>
        ";
        } elseif (( !        // line 295
array_key_exists("no_form_group", $context) || ((isset($context["no_form_group"]) ? $context["no_form_group"] : $this->getContext($context, "no_form_group")) == false))) {
            // line 296
            echo "            </div>
        ";
        }
        // line 298
        echo "
        ";
        // line 299
        if (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "inline")) {
            echo "&nbsp;";
        }
        // line 300
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_270834ad85d4bb17a6491c3a5519d11de457681878693678d1a536bab323c425->leave($__internal_270834ad85d4bb17a6491c3a5519d11de457681878693678d1a536bab323c425_prof);

    }

    // line 303
    public function block_radio_row($context, array $blocks = array())
    {
        $__internal_f81c5d10f4628532343237b1d9d27804313849378f8864d5beddf94b2f3c3bdd = $this->env->getExtension("native_profiler");
        $__internal_f81c5d10f4628532343237b1d9d27804313849378f8864d5beddf94b2f3c3bdd->enter($__internal_f81c5d10f4628532343237b1d9d27804313849378f8864d5beddf94b2f3c3bdd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "radio_row"));

        // line 304
        echo "    ";
        ob_start();
        // line 305
        echo "        ";
        $context["class"] = "";
        // line 306
        echo "
        ";
        // line 307
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 308
        echo "
        ";
        // line 309
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "label_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array())))) {
            // line 310
            echo "            ";
            $context["label_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array());
            // line 311
            echo "        ";
        }
        // line 312
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array())))) {
            // line 313
            echo "            ";
            $context["widget_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array());
            // line 314
            echo "        ";
        }
        // line 315
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 316
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 317
            echo "        ";
        }
        // line 318
        echo "
        ";
        // line 319
        if ((array_key_exists("align_with_widget", $context) || $this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "align_with_widget", array(), "any", true, true))) {
            // line 320
            echo "            ";
            $context["widget_col"] = ((array_key_exists("widget_col", $context)) ? (_twig_default_filter((isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol()));
            // line 321
            echo "            ";
            $context["label_col"] = ((array_key_exists("label_col", $context)) ? (_twig_default_filter((isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol()));
            // line 322
            echo "            ";
            $context["class"] = (((((((" col-" . (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size"))) . "-") . (isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col"))) . " col-") . (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size"))) . "-offset-") . (isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")));
            // line 323
            echo "            <div class=\"form-group ";
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "errors", array())) > 0)) {
                echo " has-error";
            }
            echo "\">
            <div class=\"";
            // line 324
            echo twig_escape_filter($this->env, (isset($context["class"]) ? $context["class"] : $this->getContext($context, "class")), "html", null, true);
            echo "\">
        ";
        } elseif (( !        // line 325
array_key_exists("no_form_group", $context) || ((isset($context["no_form_group"]) ? $context["no_form_group"] : $this->getContext($context, "no_form_group")) == false))) {
            // line 326
            echo "            <div class=\"form-group";
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "errors", array())) > 0)) {
                echo " has-error";
            }
            echo "\">
        ";
        }
        // line 328
        echo "
        ";
        // line 329
        ob_start();
        // line 330
        echo "        ";
        if ( !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false)) {
            // line 331
            echo "            ";
            if ( !(isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound"))) {
                // line 332
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("for" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
                // line 333
                echo "            ";
            }
            // line 334
            echo "            ";
            if ((array_key_exists("inline", $context) && (isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")))) {
                // line 335
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " radio-inline"))));
                // line 336
                echo "            ";
            }
            // line 337
            echo "            ";
            if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
                // line 338
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " required"))));
                // line 339
                echo "            ";
            }
            // line 340
            echo "            ";
            if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
                // line 341
                echo "                ";
                $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
                // line 342
                echo "            ";
            }
            // line 343
            echo "            <label";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">
            ";
            // line 344
            $this->displayBlock("radio_widget", $context, $blocks);
            echo "
            ";
            // line 345
            echo $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain")));
            // line 346
            echo "</label>
        ";
        } else {
            // line 348
            echo "            ";
            $this->displayBlock("radio_widget", $context, $blocks);
            echo "
        ";
        }
        // line 350
        echo "        ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
        ";
        $context["radiodata"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 352
        echo "
        ";
        // line 353
        if ((array_key_exists("inline", $context) && (isset($context["inline"]) ? $context["inline"] : $this->getContext($context, "inline")))) {
            // line 354
            echo "            ";
            echo (isset($context["radiodata"]) ? $context["radiodata"] : $this->getContext($context, "radiodata"));
            echo "
        ";
        } else {
            // line 356
            echo "            <div class=\"radio\">";
            echo (isset($context["radiodata"]) ? $context["radiodata"] : $this->getContext($context, "radiodata"));
            echo "</div>
        ";
        }
        // line 358
        echo "
        ";
        // line 359
        $this->displayBlock("form_help", $context, $blocks);
        echo "

        ";
        // line 361
        if ((array_key_exists("align_with_widget", $context) || $this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "align_with_widget", array(), "any", true, true))) {
            // line 362
            echo "            </div>
            </div>
        ";
        } elseif (( !        // line 364
array_key_exists("no_form_group", $context) || ((isset($context["no_form_group"]) ? $context["no_form_group"] : $this->getContext($context, "no_form_group")) == false))) {
            // line 365
            echo "            </div>
        ";
        }
        // line 367
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_f81c5d10f4628532343237b1d9d27804313849378f8864d5beddf94b2f3c3bdd->leave($__internal_f81c5d10f4628532343237b1d9d27804313849378f8864d5beddf94b2f3c3bdd_prof);

    }

    // line 370
    public function block_checkbox_widget($context, array $blocks = array())
    {
        $__internal_621a33431c4dc447f1e5278f6af36bbb21a497a6ac1d75af69eeab75532dd342 = $this->env->getExtension("native_profiler");
        $__internal_621a33431c4dc447f1e5278f6af36bbb21a497a6ac1d75af69eeab75532dd342->enter($__internal_621a33431c4dc447f1e5278f6af36bbb21a497a6ac1d75af69eeab75532dd342_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "checkbox_widget"));

        // line 371
        echo "    ";
        ob_start();
        // line 372
        echo "        <input type=\"checkbox\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        if (array_key_exists("value", $context)) {
            echo " value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "\"";
        }
        if ((isset($context["checked"]) ? $context["checked"] : $this->getContext($context, "checked"))) {
            echo " checked=\"checked\"";
        }
        echo " />
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_621a33431c4dc447f1e5278f6af36bbb21a497a6ac1d75af69eeab75532dd342->leave($__internal_621a33431c4dc447f1e5278f6af36bbb21a497a6ac1d75af69eeab75532dd342_prof);

    }

    // line 376
    public function block_radio_widget($context, array $blocks = array())
    {
        $__internal_7b7b86bc5e37b88c603fc85929352f49ae2f368b82b274b16f5697628341feb6 = $this->env->getExtension("native_profiler");
        $__internal_7b7b86bc5e37b88c603fc85929352f49ae2f368b82b274b16f5697628341feb6->enter($__internal_7b7b86bc5e37b88c603fc85929352f49ae2f368b82b274b16f5697628341feb6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "radio_widget"));

        // line 377
        echo "    ";
        ob_start();
        // line 378
        echo "        <input type=\"radio\" ";
        $this->displayBlock("widget_attributes", $context, $blocks);
        if (array_key_exists("value", $context)) {
            echo " value=\"";
            echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
            echo "\"";
        }
        if ((isset($context["checked"]) ? $context["checked"] : $this->getContext($context, "checked"))) {
            echo " checked=\"checked\"";
        }
        echo " />
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_7b7b86bc5e37b88c603fc85929352f49ae2f368b82b274b16f5697628341feb6->leave($__internal_7b7b86bc5e37b88c603fc85929352f49ae2f368b82b274b16f5697628341feb6_prof);

    }

    // line 382
    public function block_datetime_widget($context, array $blocks = array())
    {
        $__internal_dd6ad76b7602163f08d2c5432bf31d78def0f5295802c326dac467be1e57d5de = $this->env->getExtension("native_profiler");
        $__internal_dd6ad76b7602163f08d2c5432bf31d78def0f5295802c326dac467be1e57d5de->enter($__internal_dd6ad76b7602163f08d2c5432bf31d78def0f5295802c326dac467be1e57d5de_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "datetime_widget"));

        // line 383
        echo "    ";
        ob_start();
        // line 384
        echo "        ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 385
            echo "            ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
        ";
        } else {
            // line 387
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => "bootstrap-datetime"));
            // line 388
            echo "            <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
                ";
            // line 389
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date", array()), 'widget');
            echo "
                ";
            // line 390
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "time", array()), 'widget');
            echo "
                ";
            // line 391
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "date", array()), 'errors');
            echo "
                ";
            // line 392
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "time", array()), 'errors');
            echo "
            </div>
        ";
        }
        // line 395
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_dd6ad76b7602163f08d2c5432bf31d78def0f5295802c326dac467be1e57d5de->leave($__internal_dd6ad76b7602163f08d2c5432bf31d78def0f5295802c326dac467be1e57d5de_prof);

    }

    // line 398
    public function block_date_widget($context, array $blocks = array())
    {
        $__internal_cb03a3c87ca10568b6b8fc72e44b823424a5886ee8c6e26918b3d103903a5fac = $this->env->getExtension("native_profiler");
        $__internal_cb03a3c87ca10568b6b8fc72e44b823424a5886ee8c6e26918b3d103903a5fac->enter($__internal_cb03a3c87ca10568b6b8fc72e44b823424a5886ee8c6e26918b3d103903a5fac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "date_widget"));

        // line 399
        echo "    ";
        ob_start();
        // line 400
        echo "        ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 401
            echo "            ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
        ";
        } else {
            // line 403
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => "bootstrap-date"));
            // line 404
            echo "            <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
                ";
            // line 405
            echo twig_replace_filter((isset($context["date_pattern"]) ? $context["date_pattern"] : $this->getContext($context, "date_pattern")), array("{{ year }}" =>             // line 406
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "year", array()), 'widget'), "{{ month }}" =>             // line 407
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "month", array()), 'widget'), "{{ day }}" =>             // line 408
$this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "day", array()), 'widget')));
            // line 409
            echo "
            </div>
        ";
        }
        // line 412
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_cb03a3c87ca10568b6b8fc72e44b823424a5886ee8c6e26918b3d103903a5fac->leave($__internal_cb03a3c87ca10568b6b8fc72e44b823424a5886ee8c6e26918b3d103903a5fac_prof);

    }

    // line 415
    public function block_time_widget($context, array $blocks = array())
    {
        $__internal_f2ebb5ab2f159916982c06643b2472ed94ff29b9ef641fb175fa4f656156746a = $this->env->getExtension("native_profiler");
        $__internal_f2ebb5ab2f159916982c06643b2472ed94ff29b9ef641fb175fa4f656156746a->enter($__internal_f2ebb5ab2f159916982c06643b2472ed94ff29b9ef641fb175fa4f656156746a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "time_widget"));

        // line 416
        echo "    ";
        ob_start();
        // line 417
        echo "        ";
        if (((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "single_text")) {
            // line 418
            echo "            ";
            $this->displayBlock("form_widget_simple", $context, $blocks);
            echo "
        ";
        } else {
            // line 420
            echo "            ";
            $context["vars"] = ((((isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")) == "text")) ? (array("attr" => array("size" => 1))) : (array()));
            // line 421
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => "bootstrap-time"));
            // line 422
            echo "            <div ";
            $this->displayBlock("widget_container_attributes", $context, $blocks);
            echo ">
                ";
            // line 423
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "hour", array()), 'widget', (isset($context["vars"]) ? $context["vars"] : $this->getContext($context, "vars")));
            echo "
                ";
            // line 424
            if ((isset($context["with_minutes"]) ? $context["with_minutes"] : $this->getContext($context, "with_minutes"))) {
                echo ":";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "minute", array()), 'widget', (isset($context["vars"]) ? $context["vars"] : $this->getContext($context, "vars")));
            }
            // line 425
            echo "                ";
            if ((isset($context["with_seconds"]) ? $context["with_seconds"] : $this->getContext($context, "with_seconds"))) {
                echo ":";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "second", array()), 'widget', (isset($context["vars"]) ? $context["vars"] : $this->getContext($context, "vars")));
            }
            // line 426
            echo "            </div>
        ";
        }
        // line 428
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_f2ebb5ab2f159916982c06643b2472ed94ff29b9ef641fb175fa4f656156746a->leave($__internal_f2ebb5ab2f159916982c06643b2472ed94ff29b9ef641fb175fa4f656156746a_prof);

    }

    // line 431
    public function block_number_widget($context, array $blocks = array())
    {
        $__internal_a2a28e56ad1bd0ed9bcd332293e8a514c599220c6d311d2708765bdb44a5b907 = $this->env->getExtension("native_profiler");
        $__internal_a2a28e56ad1bd0ed9bcd332293e8a514c599220c6d311d2708765bdb44a5b907->enter($__internal_a2a28e56ad1bd0ed9bcd332293e8a514c599220c6d311d2708765bdb44a5b907_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "number_widget"));

        // line 432
        echo "    ";
        ob_start();
        // line 433
        echo "        ";
        // line 434
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "text")) : ("text"));
        // line 435
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_a2a28e56ad1bd0ed9bcd332293e8a514c599220c6d311d2708765bdb44a5b907->leave($__internal_a2a28e56ad1bd0ed9bcd332293e8a514c599220c6d311d2708765bdb44a5b907_prof);

    }

    // line 439
    public function block_integer_widget($context, array $blocks = array())
    {
        $__internal_9a82fd05940b1c395b2ae03de705aa51523d198523b2d9d87d44d786dc1eb8b3 = $this->env->getExtension("native_profiler");
        $__internal_9a82fd05940b1c395b2ae03de705aa51523d198523b2d9d87d44d786dc1eb8b3->enter($__internal_9a82fd05940b1c395b2ae03de705aa51523d198523b2d9d87d44d786dc1eb8b3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "integer_widget"));

        // line 440
        echo "    ";
        ob_start();
        // line 441
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "number")) : ("number"));
        // line 442
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_9a82fd05940b1c395b2ae03de705aa51523d198523b2d9d87d44d786dc1eb8b3->leave($__internal_9a82fd05940b1c395b2ae03de705aa51523d198523b2d9d87d44d786dc1eb8b3_prof);

    }

    // line 446
    public function block_money_widget($context, array $blocks = array())
    {
        $__internal_6e752112f01885eaaa491afc9b4a5772ae17d82c62d3ff07f2d6f7064a564794 = $this->env->getExtension("native_profiler");
        $__internal_6e752112f01885eaaa491afc9b4a5772ae17d82c62d3ff07f2d6f7064a564794->enter($__internal_6e752112f01885eaaa491afc9b4a5772ae17d82c62d3ff07f2d6f7064a564794_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "money_widget"));

        // line 447
        echo "    ";
        ob_start();
        // line 448
        echo "        <div class=\"input-group\">
            ";
        // line 449
        echo twig_replace_filter((isset($context["money_pattern"]) ? $context["money_pattern"] : $this->getContext($context, "money_pattern")), array("{{ widget }}" => $this->renderBlock("form_widget_simple", $context, $blocks), "{{ tag_start }}" => "<span class=\"input-group-addon\">", "{{ tag_end }}" => "</span>"));
        // line 453
        echo "
        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_6e752112f01885eaaa491afc9b4a5772ae17d82c62d3ff07f2d6f7064a564794->leave($__internal_6e752112f01885eaaa491afc9b4a5772ae17d82c62d3ff07f2d6f7064a564794_prof);

    }

    // line 458
    public function block_url_widget($context, array $blocks = array())
    {
        $__internal_48293a6c65d8935ed05d9c04e6403365daa1f3af705eecc2f76ed84a30301fb9 = $this->env->getExtension("native_profiler");
        $__internal_48293a6c65d8935ed05d9c04e6403365daa1f3af705eecc2f76ed84a30301fb9->enter($__internal_48293a6c65d8935ed05d9c04e6403365daa1f3af705eecc2f76ed84a30301fb9_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "url_widget"));

        // line 459
        echo "    ";
        ob_start();
        // line 460
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "url")) : ("url"));
        // line 461
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_48293a6c65d8935ed05d9c04e6403365daa1f3af705eecc2f76ed84a30301fb9->leave($__internal_48293a6c65d8935ed05d9c04e6403365daa1f3af705eecc2f76ed84a30301fb9_prof);

    }

    // line 465
    public function block_search_widget($context, array $blocks = array())
    {
        $__internal_660eb41846d0a4a7af72355972155886f928edb20b11dcaca7ab9e23def5cb62 = $this->env->getExtension("native_profiler");
        $__internal_660eb41846d0a4a7af72355972155886f928edb20b11dcaca7ab9e23def5cb62->enter($__internal_660eb41846d0a4a7af72355972155886f928edb20b11dcaca7ab9e23def5cb62_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "search_widget"));

        // line 466
        echo "    ";
        ob_start();
        // line 467
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "search")) : ("search"));
        // line 468
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_660eb41846d0a4a7af72355972155886f928edb20b11dcaca7ab9e23def5cb62->leave($__internal_660eb41846d0a4a7af72355972155886f928edb20b11dcaca7ab9e23def5cb62_prof);

    }

    // line 472
    public function block_percent_widget($context, array $blocks = array())
    {
        $__internal_a76004a29d4a922cb784a3c694f4baa333b0d2e20b1257a300c19c9245ee8203 = $this->env->getExtension("native_profiler");
        $__internal_a76004a29d4a922cb784a3c694f4baa333b0d2e20b1257a300c19c9245ee8203->enter($__internal_a76004a29d4a922cb784a3c694f4baa333b0d2e20b1257a300c19c9245ee8203_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "percent_widget"));

        // line 473
        echo "    ";
        ob_start();
        // line 474
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "text")) : ("text"));
        // line 475
        echo "        <div class=\"input-group\">
            ";
        // line 476
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
            <span class=\"input-group-addon\">%</span>
        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_a76004a29d4a922cb784a3c694f4baa333b0d2e20b1257a300c19c9245ee8203->leave($__internal_a76004a29d4a922cb784a3c694f4baa333b0d2e20b1257a300c19c9245ee8203_prof);

    }

    // line 482
    public function block_password_widget($context, array $blocks = array())
    {
        $__internal_65520a6dd5076348e5dec7ad0d4ced03860ed073796130ce74b44e01738ff197 = $this->env->getExtension("native_profiler");
        $__internal_65520a6dd5076348e5dec7ad0d4ced03860ed073796130ce74b44e01738ff197->enter($__internal_65520a6dd5076348e5dec7ad0d4ced03860ed073796130ce74b44e01738ff197_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "password_widget"));

        // line 483
        echo "    ";
        ob_start();
        // line 484
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "password")) : ("password"));
        // line 485
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_65520a6dd5076348e5dec7ad0d4ced03860ed073796130ce74b44e01738ff197->leave($__internal_65520a6dd5076348e5dec7ad0d4ced03860ed073796130ce74b44e01738ff197_prof);

    }

    // line 489
    public function block_hidden_widget($context, array $blocks = array())
    {
        $__internal_7bb65d26aafa688a062e1180101af49b5bf3d593d169058314bd89744d16877b = $this->env->getExtension("native_profiler");
        $__internal_7bb65d26aafa688a062e1180101af49b5bf3d593d169058314bd89744d16877b->enter($__internal_7bb65d26aafa688a062e1180101af49b5bf3d593d169058314bd89744d16877b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "hidden_widget"));

        // line 490
        echo "    ";
        ob_start();
        // line 491
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "hidden")) : ("hidden"));
        // line 492
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_7bb65d26aafa688a062e1180101af49b5bf3d593d169058314bd89744d16877b->leave($__internal_7bb65d26aafa688a062e1180101af49b5bf3d593d169058314bd89744d16877b_prof);

    }

    // line 496
    public function block_email_widget($context, array $blocks = array())
    {
        $__internal_3f414bf9a2dce24d0e203980ae02322c79cd7610759c085ee3df34a454259f7c = $this->env->getExtension("native_profiler");
        $__internal_3f414bf9a2dce24d0e203980ae02322c79cd7610759c085ee3df34a454259f7c->enter($__internal_3f414bf9a2dce24d0e203980ae02322c79cd7610759c085ee3df34a454259f7c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "email_widget"));

        // line 497
        echo "    ";
        ob_start();
        // line 498
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "email")) : ("email"));
        // line 499
        echo "        ";
        $this->displayBlock("form_widget_simple", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_3f414bf9a2dce24d0e203980ae02322c79cd7610759c085ee3df34a454259f7c->leave($__internal_3f414bf9a2dce24d0e203980ae02322c79cd7610759c085ee3df34a454259f7c_prof);

    }

    // line 503
    public function block_button_widget($context, array $blocks = array())
    {
        $__internal_c3af5874d68fde5483973abb219a78a2e7711a79e77aadac0293657f02495bac = $this->env->getExtension("native_profiler");
        $__internal_c3af5874d68fde5483973abb219a78a2e7711a79e77aadac0293657f02495bac->enter($__internal_c3af5874d68fde5483973abb219a78a2e7711a79e77aadac0293657f02495bac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "button_widget"));

        // line 504
        echo "    ";
        ob_start();
        // line 505
        echo "        ";
        if ((twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label"))) &&  !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false))) {
            // line 506
            echo "            ";
            $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
            // line 507
            echo "        ";
        }
        // line 508
        echo "        ";
        if ((array_key_exists("type", $context) && ((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")) == "submit"))) {
            // line 509
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim((((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " btn btn-") . ((array_key_exists("button_class", $context)) ? (_twig_default_filter((isset($context["button_class"]) ? $context["button_class"] : $this->getContext($context, "button_class")), "primary")) : ("primary"))))));
            // line 510
            echo "        ";
        } else {
            // line 511
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim((((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " btn btn-") . ((array_key_exists("button_class", $context)) ? (_twig_default_filter((isset($context["button_class"]) ? $context["button_class"] : $this->getContext($context, "button_class")), "default")) : ("default"))))));
            // line 512
            echo "        ";
        }
        // line 513
        echo "        ";
        if ((array_key_exists("as_link", $context) && ((isset($context["as_link"]) ? $context["as_link"] : $this->getContext($context, "as_link")) == true))) {
            // line 514
            echo "            <a ";
            $this->displayBlock("button_attributes", $context, $blocks);
            echo ">";
            if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "icon", array(), "any", true, true) && ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "icon", array()) != ""))) {
                echo $this->env->getExtension('braincrafted_bootstrap_icon')->iconFunction($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "icon", array()));
            }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "</a>
        ";
        } else {
            // line 516
            echo "            <button type=\"";
            echo twig_escape_filter($this->env, ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "button")) : ("button")), "html", null, true);
            echo "\" ";
            $this->displayBlock("button_attributes", $context, $blocks);
            echo ">";
            if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "icon", array(), "any", true, true) && ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "icon", array()) != ""))) {
                echo $this->env->getExtension('braincrafted_bootstrap_icon')->iconFunction($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "icon", array()));
            }
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "</button>
        ";
        }
        // line 518
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_c3af5874d68fde5483973abb219a78a2e7711a79e77aadac0293657f02495bac->leave($__internal_c3af5874d68fde5483973abb219a78a2e7711a79e77aadac0293657f02495bac_prof);

    }

    // line 521
    public function block_submit_widget($context, array $blocks = array())
    {
        $__internal_d029f02e6ac4f4242ec55a20c200fb2b71cd599b9e4bd5978398b1f3ec7f9e9e = $this->env->getExtension("native_profiler");
        $__internal_d029f02e6ac4f4242ec55a20c200fb2b71cd599b9e4bd5978398b1f3ec7f9e9e->enter($__internal_d029f02e6ac4f4242ec55a20c200fb2b71cd599b9e4bd5978398b1f3ec7f9e9e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "submit_widget"));

        // line 522
        echo "    ";
        ob_start();
        // line 523
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "submit")) : ("submit"));
        // line 524
        echo "        ";
        $this->displayBlock("button_widget", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_d029f02e6ac4f4242ec55a20c200fb2b71cd599b9e4bd5978398b1f3ec7f9e9e->leave($__internal_d029f02e6ac4f4242ec55a20c200fb2b71cd599b9e4bd5978398b1f3ec7f9e9e_prof);

    }

    // line 528
    public function block_reset_widget($context, array $blocks = array())
    {
        $__internal_5dc72b10db99a171c65cfa731b36e197917351713b288a00a644bce9e8d6491a = $this->env->getExtension("native_profiler");
        $__internal_5dc72b10db99a171c65cfa731b36e197917351713b288a00a644bce9e8d6491a->enter($__internal_5dc72b10db99a171c65cfa731b36e197917351713b288a00a644bce9e8d6491a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "reset_widget"));

        // line 529
        echo "    ";
        ob_start();
        // line 530
        echo "        ";
        $context["type"] = ((array_key_exists("type", $context)) ? (_twig_default_filter((isset($context["type"]) ? $context["type"] : $this->getContext($context, "type")), "reset")) : ("reset"));
        // line 531
        echo "        ";
        $this->displayBlock("button_widget", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_5dc72b10db99a171c65cfa731b36e197917351713b288a00a644bce9e8d6491a->leave($__internal_5dc72b10db99a171c65cfa731b36e197917351713b288a00a644bce9e8d6491a_prof);

    }

    // line 535
    public function block_form_actions_widget($context, array $blocks = array())
    {
        $__internal_b0cd7a36f51444b6bc5850fa653f663cdc8780f6003e86923e535867c37a5023 = $this->env->getExtension("native_profiler");
        $__internal_b0cd7a36f51444b6bc5850fa653f663cdc8780f6003e86923e535867c37a5023->enter($__internal_b0cd7a36f51444b6bc5850fa653f663cdc8780f6003e86923e535867c37a5023_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_actions_widget"));

        // line 536
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "children", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["button"]) {
            // line 537
            echo "        ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["button"], 'widget');
            echo "&nbsp; ";
            // line 538
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['button'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_b0cd7a36f51444b6bc5850fa653f663cdc8780f6003e86923e535867c37a5023->leave($__internal_b0cd7a36f51444b6bc5850fa653f663cdc8780f6003e86923e535867c37a5023_prof);

    }

    // line 541
    public function block_bs_static_widget($context, array $blocks = array())
    {
        $__internal_fb973d643e71b943da6d9f2f4ca5fad9d185fdc29b1e7f9de926a2c75b22f25e = $this->env->getExtension("native_profiler");
        $__internal_fb973d643e71b943da6d9f2f4ca5fad9d185fdc29b1e7f9de926a2c75b22f25e->enter($__internal_fb973d643e71b943da6d9f2f4ca5fad9d185fdc29b1e7f9de926a2c75b22f25e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "bs_static_widget"));

        // line 542
        echo "    ";
        $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-control-static"))));
        // line 543
        echo "    <p id=\"";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\"";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            echo " ";
            echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
            echo "\"";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        echo ">";
        echo twig_escape_filter($this->env, (isset($context["value"]) ? $context["value"] : $this->getContext($context, "value")), "html", null, true);
        echo "</p>
";
        
        $__internal_fb973d643e71b943da6d9f2f4ca5fad9d185fdc29b1e7f9de926a2c75b22f25e->leave($__internal_fb973d643e71b943da6d9f2f4ca5fad9d185fdc29b1e7f9de926a2c75b22f25e_prof);

    }

    // line 548
    public function block_form_label($context, array $blocks = array())
    {
        $__internal_0af743d33cb90325e73fefce868fbc646f928d00800b7c6e77618ae225098edd = $this->env->getExtension("native_profiler");
        $__internal_0af743d33cb90325e73fefce868fbc646f928d00800b7c6e77618ae225098edd->enter($__internal_0af743d33cb90325e73fefce868fbc646f928d00800b7c6e77618ae225098edd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_label"));

        // line 549
        echo "    ";
        ob_start();
        // line 550
        echo "        ";
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 551
        echo "
        ";
        // line 552
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "label_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array())))) {
            // line 553
            echo "            ";
            $context["label_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array());
            // line 554
            echo "        ";
        }
        // line 555
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array())))) {
            // line 556
            echo "            ";
            $context["widget_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array());
            // line 557
            echo "        ";
        }
        // line 558
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 559
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 560
            echo "        ";
        }
        // line 561
        echo "
        ";
        // line 562
        if ( !((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false)) {
            // line 563
            echo "            ";
            $context["style"] = ((array_key_exists("style", $context)) ? (_twig_default_filter((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")), $this->env->getExtension('braincrafted_bootstrap_form')->getStyle())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getStyle()));
            // line 564
            echo "            ";
            $context["label_col"] = ((array_key_exists("label_col", $context)) ? (_twig_default_filter((isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol()));
            // line 565
            echo "
            ";
            // line 566
            if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())))) {
                // line 567
                echo "                ";
                $context["style"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array());
                // line 568
                echo "            ";
            }
            // line 569
            echo "
            ";
            // line 570
            $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " control-label"))));
            // line 571
            echo "            ";
            if (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "horizontal")) {
                // line 572
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim((((((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " col-") . (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size"))) . "-") . (isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col"))))));
                // line 573
                echo "            ";
            } elseif (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "inline")) {
                // line 574
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " sr-only"))));
                // line 575
                echo "            ";
            }
            // line 576
            echo "
            ";
            // line 577
            if ( !(isset($context["compound"]) ? $context["compound"] : $this->getContext($context, "compound"))) {
                // line 578
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("for" => (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id"))));
                // line 579
                echo "            ";
            }
            // line 580
            echo "            ";
            if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
                // line 581
                echo "                ";
                $context["label_attr"] = twig_array_merge((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")), array("class" => trim(((($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["label_attr"]) ? $context["label_attr"] : null), "class", array()), "")) : ("")) . " required"))));
                // line 582
                echo "            ";
            }
            // line 583
            echo "            ";
            if (twig_test_empty((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")))) {
                // line 584
                echo "                ";
                $context["label"] = $this->env->getExtension('form')->humanize((isset($context["name"]) ? $context["name"] : $this->getContext($context, "name")));
                // line 585
                echo "            ";
            }
            // line 586
            echo "            <label";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["label_attr"]) ? $context["label_attr"] : $this->getContext($context, "label_attr")));
            foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
                echo " ";
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\"";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ">";
            echo $this->env->getExtension('translator')->trans((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain")));
            echo "</label>
        ";
        }
        // line 588
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_0af743d33cb90325e73fefce868fbc646f928d00800b7c6e77618ae225098edd->leave($__internal_0af743d33cb90325e73fefce868fbc646f928d00800b7c6e77618ae225098edd_prof);

    }

    // line 591
    public function block_button_label($context, array $blocks = array())
    {
        $__internal_02c0b3b18c89f92bd146eb0d4d5646adfe9a0b3241d4ef97e104684a73be73ef = $this->env->getExtension("native_profiler");
        $__internal_02c0b3b18c89f92bd146eb0d4d5646adfe9a0b3241d4ef97e104684a73be73ef->enter($__internal_02c0b3b18c89f92bd146eb0d4d5646adfe9a0b3241d4ef97e104684a73be73ef_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "button_label"));

        
        $__internal_02c0b3b18c89f92bd146eb0d4d5646adfe9a0b3241d4ef97e104684a73be73ef->leave($__internal_02c0b3b18c89f92bd146eb0d4d5646adfe9a0b3241d4ef97e104684a73be73ef_prof);

    }

    // line 595
    public function block_repeated_row($context, array $blocks = array())
    {
        $__internal_48bc7c55746b6d31d01e89dd9046c48adcf4669180ff40fc1ba726746b753373 = $this->env->getExtension("native_profiler");
        $__internal_48bc7c55746b6d31d01e89dd9046c48adcf4669180ff40fc1ba726746b753373->enter($__internal_48bc7c55746b6d31d01e89dd9046c48adcf4669180ff40fc1ba726746b753373_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "repeated_row"));

        // line 596
        echo "    ";
        ob_start();
        // line 597
        echo "        ";
        // line 601
        echo "        ";
        $this->displayBlock("form_rows", $context, $blocks);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_48bc7c55746b6d31d01e89dd9046c48adcf4669180ff40fc1ba726746b753373->leave($__internal_48bc7c55746b6d31d01e89dd9046c48adcf4669180ff40fc1ba726746b753373_prof);

    }

    // line 605
    public function block_form_row($context, array $blocks = array())
    {
        $__internal_0af0a1bc52661a6d080421ad71c909fb87b4fa33b12c78a7e3c3641b509c7cf6 = $this->env->getExtension("native_profiler");
        $__internal_0af0a1bc52661a6d080421ad71c909fb87b4fa33b12c78a7e3c3641b509c7cf6->enter($__internal_0af0a1bc52661a6d080421ad71c909fb87b4fa33b12c78a7e3c3641b509c7cf6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_row"));

        // line 606
        echo "    ";
        ob_start();
        // line 607
        echo "        ";
        $context["style"] = ((array_key_exists("style", $context)) ? (_twig_default_filter((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")), $this->env->getExtension('braincrafted_bootstrap_form')->getStyle())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getStyle()));
        // line 608
        echo "        ";
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 609
        echo "
        ";
        // line 610
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "label_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array())))) {
            // line 611
            echo "            ";
            $context["label_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array());
            // line 612
            echo "        ";
        }
        // line 613
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array())))) {
            // line 614
            echo "            ";
            $context["widget_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array());
            // line 615
            echo "            ";
            if ((((isset($context["label"]) ? $context["label"] : $this->getContext($context, "label")) === false) && array_key_exists("label_col", $context))) {
                // line 616
                echo "                ";
                $context["widget_col"] = ((isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col")) + (isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")));
                // line 617
                echo "            ";
            }
            // line 618
            echo "        ";
        }
        // line 619
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 620
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 621
            echo "        ";
        }
        // line 622
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())))) {
            // line 623
            echo "            ";
            $context["style"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array());
            // line 624
            echo "        ";
        }
        // line 625
        echo "
        ";
        // line 626
        $context["label_col"] = ((array_key_exists("label_col", $context)) ? (_twig_default_filter((isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol()));
        // line 627
        echo "        ";
        $context["widget_col"] = ((array_key_exists("widget_col", $context)) ? (_twig_default_filter((isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol()));
        // line 628
        echo "
        <div class=\"form-group";
        // line 629
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "errors", array())) > 0)) {
            echo " has-error";
        }
        echo "\">
            ";
        // line 630
        if (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "horizontal")) {
            // line 631
            echo "                ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label');
            echo "
                <div class=\"col-";
            // line 632
            echo twig_escape_filter($this->env, (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, (isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col")), "html", null, true);
            echo "\">
                    ";
            // line 633
            $this->displayBlock("form_input_group", $context, $blocks);
            echo "
                    ";
            // line 634
            $this->displayBlock("form_help", $context, $blocks);
            echo "
                    ";
            // line 635
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
                </div>
            ";
        } else {
            // line 638
            echo "                ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label');
            echo "
                ";
            // line 639
            $this->displayBlock("form_input_group", $context, $blocks);
            echo "
                ";
            // line 640
            $this->displayBlock("form_help", $context, $blocks);
            echo "
                ";
            // line 641
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
            ";
        }
        // line 643
        echo "        </div>

        ";
        // line 645
        if (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "inline")) {
            echo "&nbsp;";
        }
        // line 646
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_0af0a1bc52661a6d080421ad71c909fb87b4fa33b12c78a7e3c3641b509c7cf6->leave($__internal_0af0a1bc52661a6d080421ad71c909fb87b4fa33b12c78a7e3c3641b509c7cf6_prof);

    }

    // line 649
    public function block_form_input_group($context, array $blocks = array())
    {
        $__internal_b147a4d837ab5ae82a7a4c2bdf1f165ee06bd7aadec495744dc17d24414cc62e = $this->env->getExtension("native_profiler");
        $__internal_b147a4d837ab5ae82a7a4c2bdf1f165ee06bd7aadec495744dc17d24414cc62e->enter($__internal_b147a4d837ab5ae82a7a4c2bdf1f165ee06bd7aadec495744dc17d24414cc62e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_input_group"));

        // line 650
        echo "    ";
        ob_start();
        // line 651
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "input_group", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "input_group", array())))) {
            // line 652
            echo "            ";
            $context["input_group"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "input_group", array());
            // line 653
            echo "        ";
        }
        // line 654
        echo "        ";
        $context["input_group"] = ((array_key_exists("input_group", $context)) ? (_twig_default_filter((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), array())) : (array()));
        // line 655
        echo "        ";
        if ( !twig_test_empty((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")))) {
            // line 656
            echo "            ";
            $context["ig_size_class"] = "";
            // line 657
            echo "            ";
            if (($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : null), "size", array(), "any", true, true) && ($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "size", array()) == "large"))) {
                // line 658
                echo "                ";
                $context["ig_size_class"] = " input-group-lg";
                // line 659
                echo "            ";
            }
            // line 660
            echo "            ";
            if (($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : null), "size", array(), "any", true, true) && ($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "size", array()) == "small"))) {
                // line 661
                echo "                ";
                $context["ig_size_class"] = " input-group-sm";
                // line 662
                echo "            ";
            }
            // line 663
            echo "            <div class=\"input-group";
            echo twig_escape_filter($this->env, (isset($context["ig_size_class"]) ? $context["ig_size_class"] : $this->getContext($context, "ig_size_class")), "html", null, true);
            echo "\">
                ";
            // line 664
            if (($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : null), "prepend", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "prepend", array())))) {
                // line 665
                echo "                    <span class=\"input-group-addon\">";
                echo $this->env->getExtension('braincrafted_bootstrap_icon')->parseIconsFilter($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "prepend", array()));
                echo "</span>
                ";
            }
            // line 667
            echo "                ";
            if (($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : null), "button_prepend", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "button_prepend", array())))) {
                // line 668
                echo "                    <span class=\"input-group-btn\">";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["input_group_button_prepend"]) ? $context["input_group_button_prepend"] : $this->getContext($context, "input_group_button_prepend")), 'widget');
                echo "</span>
                ";
            }
            // line 670
            echo "                ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
            echo "
                ";
            // line 671
            if (($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : null), "button_append", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "button_append", array())))) {
                // line 672
                echo "                    <span class=\"input-group-btn\">";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["input_group_button_append"]) ? $context["input_group_button_append"] : $this->getContext($context, "input_group_button_append")), 'widget');
                echo "</span>
                ";
            }
            // line 674
            echo "                ";
            if (($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : null), "append", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "append", array())))) {
                // line 675
                echo "                    <span class=\"input-group-addon\">";
                echo $this->env->getExtension('braincrafted_bootstrap_icon')->parseIconsFilter($this->getAttribute((isset($context["input_group"]) ? $context["input_group"] : $this->getContext($context, "input_group")), "append", array()));
                echo "</span>
                ";
            }
            // line 677
            echo "            </div>
        ";
        } else {
            // line 679
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
            echo "
        ";
        }
        // line 681
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_b147a4d837ab5ae82a7a4c2bdf1f165ee06bd7aadec495744dc17d24414cc62e->leave($__internal_b147a4d837ab5ae82a7a4c2bdf1f165ee06bd7aadec495744dc17d24414cc62e_prof);

    }

    // line 684
    public function block_form_help($context, array $blocks = array())
    {
        $__internal_585bcdd848f4473c68d4139e033e92ead3094d96ea03155847a819cac81a0bba = $this->env->getExtension("native_profiler");
        $__internal_585bcdd848f4473c68d4139e033e92ead3094d96ea03155847a819cac81a0bba->enter($__internal_585bcdd848f4473c68d4139e033e92ead3094d96ea03155847a819cac81a0bba_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_help"));

        // line 685
        echo "    ";
        ob_start();
        // line 686
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "help_text", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "help_text", array())))) {
            // line 687
            echo "            ";
            $context["help_text"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "help_text", array());
            // line 688
            echo "        ";
        }
        // line 689
        echo "        ";
        $context["help_text"] = ((array_key_exists("help_text", $context)) ? (_twig_default_filter((isset($context["help_text"]) ? $context["help_text"] : $this->getContext($context, "help_text")), "")) : (""));
        // line 690
        echo "        ";
        if ( !twig_test_empty((isset($context["help_text"]) ? $context["help_text"] : $this->getContext($context, "help_text")))) {
            // line 691
            echo "            <span class=\"help-block\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["help_text"]) ? $context["help_text"] : $this->getContext($context, "help_text")), array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
            echo "</span>
        ";
        }
        // line 693
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_585bcdd848f4473c68d4139e033e92ead3094d96ea03155847a819cac81a0bba->leave($__internal_585bcdd848f4473c68d4139e033e92ead3094d96ea03155847a819cac81a0bba_prof);

    }

    // line 696
    public function block_button_row($context, array $blocks = array())
    {
        $__internal_b7a7171fae38b631938b9421c7a9deab06e28fab259c14e07b84b90b26375722 = $this->env->getExtension("native_profiler");
        $__internal_b7a7171fae38b631938b9421c7a9deab06e28fab259c14e07b84b90b26375722->enter($__internal_b7a7171fae38b631938b9421c7a9deab06e28fab259c14e07b84b90b26375722_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "button_row"));

        // line 697
        echo "    ";
        ob_start();
        // line 698
        echo "        ";
        $context["style"] = ((array_key_exists("style", $context)) ? (_twig_default_filter((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")), $this->env->getExtension('braincrafted_bootstrap_form')->getStyle())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getStyle()));
        // line 699
        echo "        ";
        $context["col_size"] = ((array_key_exists("col_size", $context)) ? (_twig_default_filter((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), $this->env->getExtension('braincrafted_bootstrap_form')->getColSize())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()));
        // line 700
        echo "
        ";
        // line 701
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "label_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array())))) {
            // line 702
            echo "            ";
            $context["label_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array());
            // line 703
            echo "        ";
        }
        // line 704
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_col", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array())))) {
            // line 705
            echo "            ";
            $context["widget_col"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array());
            // line 706
            echo "        ";
        }
        // line 707
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())))) {
            // line 708
            echo "            ";
            $context["col_size"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array());
            // line 709
            echo "        ";
        }
        // line 710
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())))) {
            // line 711
            echo "            ";
            $context["style"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array());
            // line 712
            echo "        ";
        }
        // line 713
        echo "
        ";
        // line 714
        $context["label_col"] = ((array_key_exists("label_col", $context)) ? (_twig_default_filter((isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol()));
        // line 715
        echo "        ";
        $context["widget_col"] = ((array_key_exists("widget_col", $context)) ? (_twig_default_filter((isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col")), $this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol()));
        // line 716
        echo "
        <div class=\"form-group\">
            ";
        // line 718
        if (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "horizontal")) {
            // line 719
            echo "                <div class=\"col-";
            echo twig_escape_filter($this->env, (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), "html", null, true);
            echo "-offset-";
            echo twig_escape_filter($this->env, (isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col")), "html", null, true);
            echo " col-";
            echo twig_escape_filter($this->env, (isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size")), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, (isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col")), "html", null, true);
            echo "\">
            ";
        }
        // line 721
        echo "
            ";
        // line 722
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "

            ";
        // line 724
        if (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "horizontal")) {
            // line 725
            echo "                </div>
            ";
        }
        // line 727
        echo "        </div>
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_b7a7171fae38b631938b9421c7a9deab06e28fab259c14e07b84b90b26375722->leave($__internal_b7a7171fae38b631938b9421c7a9deab06e28fab259c14e07b84b90b26375722_prof);

    }

    // line 731
    public function block_hidden_row($context, array $blocks = array())
    {
        $__internal_05574c8928cdf51f637e3b7caaeadf3f4d8c5a762d99911de81524c108e75ac2 = $this->env->getExtension("native_profiler");
        $__internal_05574c8928cdf51f637e3b7caaeadf3f4d8c5a762d99911de81524c108e75ac2->enter($__internal_05574c8928cdf51f637e3b7caaeadf3f4d8c5a762d99911de81524c108e75ac2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "hidden_row"));

        // line 732
        echo "    ";
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
";
        
        $__internal_05574c8928cdf51f637e3b7caaeadf3f4d8c5a762d99911de81524c108e75ac2->leave($__internal_05574c8928cdf51f637e3b7caaeadf3f4d8c5a762d99911de81524c108e75ac2_prof);

    }

    // line 735
    public function block_form_actions_row($context, array $blocks = array())
    {
        $__internal_391d23c77682143934fac6bc934b907c7a93c417cbfbf43cddcc0653781def35 = $this->env->getExtension("native_profiler");
        $__internal_391d23c77682143934fac6bc934b907c7a93c417cbfbf43cddcc0653781def35->enter($__internal_391d23c77682143934fac6bc934b907c7a93c417cbfbf43cddcc0653781def35_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_actions_row"));

        // line 736
        echo "    ";
        $this->displayBlock("button_row", $context, $blocks);
        echo "
";
        
        $__internal_391d23c77682143934fac6bc934b907c7a93c417cbfbf43cddcc0653781def35->leave($__internal_391d23c77682143934fac6bc934b907c7a93c417cbfbf43cddcc0653781def35_prof);

    }

    // line 741
    public function block_form($context, array $blocks = array())
    {
        $__internal_c873800aed6c5f8ae5da693c89e2a081383b6029cf8eba5a47eb95fca616a916 = $this->env->getExtension("native_profiler");
        $__internal_c873800aed6c5f8ae5da693c89e2a081383b6029cf8eba5a47eb95fca616a916->enter($__internal_c873800aed6c5f8ae5da693c89e2a081383b6029cf8eba5a47eb95fca616a916_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form"));

        // line 742
        echo "    ";
        ob_start();
        // line 743
        echo "        ";
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_start');
        echo "
        ";
        // line 744
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
        ";
        // line 745
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form_end');
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_c873800aed6c5f8ae5da693c89e2a081383b6029cf8eba5a47eb95fca616a916->leave($__internal_c873800aed6c5f8ae5da693c89e2a081383b6029cf8eba5a47eb95fca616a916_prof);

    }

    // line 749
    public function block_form_start($context, array $blocks = array())
    {
        $__internal_2f0a3a04088d887f0f9e2f9cf2f33c5c79b268783ab0f9be82f22843b314c920 = $this->env->getExtension("native_profiler");
        $__internal_2f0a3a04088d887f0f9e2f9cf2f33c5c79b268783ab0f9be82f22843b314c920->enter($__internal_2f0a3a04088d887f0f9e2f9cf2f33c5c79b268783ab0f9be82f22843b314c920_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_start"));

        // line 750
        echo "    ";
        ob_start();
        // line 751
        echo "        ";
        echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->backupFormSettings(), "html", null, true);
        echo "
        ";
        // line 752
        $context["method"] = twig_upper_filter($this->env, (isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")));
        // line 753
        echo "        ";
        if (twig_in_filter((isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), array(0 => "GET", 1 => "POST"))) {
            // line 754
            echo "            ";
            $context["form_method"] = (isset($context["method"]) ? $context["method"] : $this->getContext($context, "method"));
            // line 755
            echo "        ";
        } else {
            // line 756
            echo "            ";
            $context["form_method"] = "POST";
            // line 757
            echo "        ";
        }
        // line 758
        echo "
        ";
        // line 759
        if (array_key_exists("style", $context)) {
            // line 760
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim((((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " form-") . (isset($context["style"]) ? $context["style"] : $this->getContext($context, "style"))))));
            // line 761
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setStyle((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style"))), "html", null, true);
            echo "
        ";
        }
        // line 763
        echo "
        ";
        // line 764
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "errors", array())) > 0)) {
            // line 765
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : ("")) . " has-global-errors"))));
            // line 766
            echo "        ";
        }
        // line 767
        echo "
        ";
        // line 768
        if (array_key_exists("col_size", $context)) {
            // line 769
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setColSize((isset($context["col_size"]) ? $context["col_size"] : $this->getContext($context, "col_size"))), "html", null, true);
            echo "
        ";
        }
        // line 771
        echo "
        ";
        // line 772
        if (array_key_exists("widget_col", $context)) {
            // line 773
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setWidgetCol((isset($context["widget_col"]) ? $context["widget_col"] : $this->getContext($context, "widget_col"))), "html", null, true);
            echo "
        ";
        }
        // line 775
        echo "
        ";
        // line 776
        if (array_key_exists("label_col", $context)) {
            // line 777
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setLabelCol((isset($context["label_col"]) ? $context["label_col"] : $this->getContext($context, "label_col"))), "html", null, true);
            echo "
        ";
        }
        // line 779
        echo "
        ";
        // line 780
        if (array_key_exists("simple_col", $context)) {
            // line 781
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setSimpleCol((isset($context["simple_col"]) ? $context["simple_col"] : $this->getContext($context, "simple_col"))), "html", null, true);
            echo "
        ";
        }
        // line 783
        echo "
        ";
        // line 784
        if (( !$this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "role", array(), "any", true, true) || twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "role", array())))) {
            // line 785
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("role" => "form"));
            // line 786
            echo "        ";
        }
        // line 787
        echo "
        <form  name=\"";
        // line 788
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "vars", array()), "name", array()), "html", null, true);
        echo "\" method=\"";
        echo twig_escape_filter($this->env, twig_lower_filter($this->env, (isset($context["form_method"]) ? $context["form_method"] : $this->getContext($context, "form_method"))), "html", null, true);
        echo "\" action=\"";
        echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "html", null, true);
        echo "\"";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            echo " ";
            echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
            echo "\"";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        if ((isset($context["multipart"]) ? $context["multipart"] : $this->getContext($context, "multipart"))) {
            echo " enctype=\"multipart/form-data\"";
        }
        echo ">
        ";
        // line 789
        if (((isset($context["form_method"]) ? $context["form_method"] : $this->getContext($context, "form_method")) != (isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")))) {
            // line 790
            echo "            <input type=\"hidden\" name=\"_method\" value=\"";
            echo twig_escape_filter($this->env, (isset($context["method"]) ? $context["method"] : $this->getContext($context, "method")), "html", null, true);
            echo "\" />
        ";
        }
        // line 792
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_2f0a3a04088d887f0f9e2f9cf2f33c5c79b268783ab0f9be82f22843b314c920->leave($__internal_2f0a3a04088d887f0f9e2f9cf2f33c5c79b268783ab0f9be82f22843b314c920_prof);

    }

    // line 795
    public function block_form_end($context, array $blocks = array())
    {
        $__internal_9763c30a776f8a8d6827c74b33216add101a00b37f4509a275e9ddfad5c38878 = $this->env->getExtension("native_profiler");
        $__internal_9763c30a776f8a8d6827c74b33216add101a00b37f4509a275e9ddfad5c38878->enter($__internal_9763c30a776f8a8d6827c74b33216add101a00b37f4509a275e9ddfad5c38878_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_end"));

        // line 796
        echo "    ";
        ob_start();
        // line 797
        echo "        ";
        if (( !array_key_exists("render_rest", $context) || (isset($context["render_rest"]) ? $context["render_rest"] : $this->getContext($context, "render_rest")))) {
            // line 798
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
            echo "
        ";
        }
        // line 800
        echo "        </form>
        ";
        // line 801
        if ($this->env->getExtension('braincrafted_bootstrap_form')->getStyle()) {
            // line 802
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setStyle(""), "html", null, true);
            echo "
        ";
        }
        // line 804
        echo "        ";
        if ($this->env->getExtension('braincrafted_bootstrap_form')->getColSize()) {
            // line 805
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setColSize("lg"), "html", null, true);
            echo "
        ";
        }
        // line 807
        echo "        ";
        if ($this->env->getExtension('braincrafted_bootstrap_form')->getWidgetCol()) {
            // line 808
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setWidgetCol(10), "html", null, true);
            echo "
        ";
        }
        // line 810
        echo "        ";
        if ($this->env->getExtension('braincrafted_bootstrap_form')->getLabelCol()) {
            // line 811
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setLabelCol(2), "html", null, true);
            echo "
        ";
        }
        // line 813
        echo "        ";
        if ($this->env->getExtension('braincrafted_bootstrap_form')->getSimpleCol()) {
            // line 814
            echo "            ";
            echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->setSimpleCol(false), "html", null, true);
            echo "
        ";
        }
        // line 816
        echo "    ";
        echo twig_escape_filter($this->env, $this->env->getExtension('braincrafted_bootstrap_form')->restoreFormSettings(), "html", null, true);
        echo "
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_9763c30a776f8a8d6827c74b33216add101a00b37f4509a275e9ddfad5c38878->leave($__internal_9763c30a776f8a8d6827c74b33216add101a00b37f4509a275e9ddfad5c38878_prof);

    }

    // line 820
    public function block_form_enctype($context, array $blocks = array())
    {
        $__internal_be2784d0cb4ee5d9410c6b98afe5c14b5ad40febd898900235f5ce9ede628384 = $this->env->getExtension("native_profiler");
        $__internal_be2784d0cb4ee5d9410c6b98afe5c14b5ad40febd898900235f5ce9ede628384->enter($__internal_be2784d0cb4ee5d9410c6b98afe5c14b5ad40febd898900235f5ce9ede628384_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_enctype"));

        // line 821
        echo "    ";
        ob_start();
        // line 822
        echo "        ";
        if ((isset($context["multipart"]) ? $context["multipart"] : $this->getContext($context, "multipart"))) {
            echo "enctype=\"multipart/form-data\"";
        }
        // line 823
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_be2784d0cb4ee5d9410c6b98afe5c14b5ad40febd898900235f5ce9ede628384->leave($__internal_be2784d0cb4ee5d9410c6b98afe5c14b5ad40febd898900235f5ce9ede628384_prof);

    }

    // line 826
    public function block_global_form_errors($context, array $blocks = array())
    {
        $__internal_40361c40ce6da5749b84deacc1a562c1af7c0c5a72230f3d3afbff4cd3960723 = $this->env->getExtension("native_profiler");
        $__internal_40361c40ce6da5749b84deacc1a562c1af7c0c5a72230f3d3afbff4cd3960723->enter($__internal_40361c40ce6da5749b84deacc1a562c1af7c0c5a72230f3d3afbff4cd3960723_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "global_form_errors"));

        // line 827
        echo "    ";
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            // line 828
            echo "        ";
            $context["global_errors"] = true;
            // line 829
            echo "        ";
            $this->displayBlock("form_errors", $context, $blocks);
            echo "
    ";
        }
        
        $__internal_40361c40ce6da5749b84deacc1a562c1af7c0c5a72230f3d3afbff4cd3960723->leave($__internal_40361c40ce6da5749b84deacc1a562c1af7c0c5a72230f3d3afbff4cd3960723_prof);

    }

    // line 833
    public function block_form_errors($context, array $blocks = array())
    {
        $__internal_ee8675a6bf03134c798e582424e14337f8a13705bde986f46a731ccbc1447975 = $this->env->getExtension("native_profiler");
        $__internal_ee8675a6bf03134c798e582424e14337f8a13705bde986f46a731ccbc1447975->enter($__internal_ee8675a6bf03134c798e582424e14337f8a13705bde986f46a731ccbc1447975_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_errors"));

        // line 834
        echo "    ";
        ob_start();
        // line 835
        echo "        ";
        $context["global_errors"] = ((array_key_exists("global_errors", $context)) ? (_twig_default_filter((isset($context["global_errors"]) ? $context["global_errors"] : $this->getContext($context, "global_errors")), false)) : (false));
        // line 836
        echo "        ";
        $context["style"] = ((array_key_exists("style", $context)) ? (_twig_default_filter((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")), $this->env->getExtension('braincrafted_bootstrap_form')->getStyle())) : ($this->env->getExtension('braincrafted_bootstrap_form')->getStyle()));
        // line 837
        echo "
        ";
        // line 838
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true) &&  !twig_test_empty($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())))) {
            // line 839
            echo "            ";
            $context["style"] = $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array());
            // line 840
            echo "        ";
        }
        // line 841
        echo "
        ";
        // line 842
        if ((twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0)) {
            // line 843
            echo "            ";
            if ((isset($context["global_errors"]) ? $context["global_errors"] : $this->getContext($context, "global_errors"))) {
                // line 844
                echo "                <div class=\"alert alert-danger\">
            ";
            }
            // line 846
            echo "            <ul";
            if ( !(isset($context["global_errors"]) ? $context["global_errors"] : $this->getContext($context, "global_errors"))) {
                echo " class=\"help-block\"";
            }
            echo ">
                ";
            // line 847
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors")));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 848
                echo "                    <li>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["error"], "message", array()), "html", null, true);
                echo "</li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 850
            echo "            </ul>
            ";
            // line 851
            if (((isset($context["global_errors"]) ? $context["global_errors"] : $this->getContext($context, "global_errors")) == true)) {
                // line 852
                echo "                </div>
            ";
            }
            // line 854
            echo "        ";
        }
        // line 855
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_ee8675a6bf03134c798e582424e14337f8a13705bde986f46a731ccbc1447975->leave($__internal_ee8675a6bf03134c798e582424e14337f8a13705bde986f46a731ccbc1447975_prof);

    }

    // line 858
    public function block_form_rest($context, array $blocks = array())
    {
        $__internal_5939ab977d44220a1af055526567f5dcd41f9afc1f94de4ff085a20fca6ec0f3 = $this->env->getExtension("native_profiler");
        $__internal_5939ab977d44220a1af055526567f5dcd41f9afc1f94de4ff085a20fca6ec0f3->enter($__internal_5939ab977d44220a1af055526567f5dcd41f9afc1f94de4ff085a20fca6ec0f3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_rest"));

        // line 859
        echo "    ";
        ob_start();
        // line 860
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 861
            echo "            ";
            if ( !$this->getAttribute($context["child"], "rendered", array())) {
                // line 862
                echo "                ";
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'row');
                echo "
            ";
            }
            // line 864
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 865
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_5939ab977d44220a1af055526567f5dcd41f9afc1f94de4ff085a20fca6ec0f3->leave($__internal_5939ab977d44220a1af055526567f5dcd41f9afc1f94de4ff085a20fca6ec0f3_prof);

    }

    // line 870
    public function block_form_rows($context, array $blocks = array())
    {
        $__internal_d120ae2052a2850eb5fa2d4ec1008f384119e33e6466f0134f9a23c26776d50b = $this->env->getExtension("native_profiler");
        $__internal_d120ae2052a2850eb5fa2d4ec1008f384119e33e6466f0134f9a23c26776d50b->enter($__internal_d120ae2052a2850eb5fa2d4ec1008f384119e33e6466f0134f9a23c26776d50b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "form_rows"));

        // line 871
        echo "    ";
        ob_start();
        // line 872
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")));
        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
            // line 873
            echo "            ";
            $context["childAttr"] = array();
            // line 874
            echo "            ";
            if ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "col_size", array(), "any", true, true)) {
                // line 875
                echo "                ";
                $context["childAttr"] = twig_array_merge((isset($context["childAttr"]) ? $context["childAttr"] : $this->getContext($context, "childAttr")), array("col_size" => $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "col_size", array())));
                // line 876
                echo "            ";
            }
            // line 877
            echo "            ";
            if ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "widget_col", array(), "any", true, true)) {
                // line 878
                echo "                ";
                $context["childAttr"] = twig_array_merge((isset($context["childAttr"]) ? $context["childAttr"] : $this->getContext($context, "childAttr")), array("widget_col" => $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "widget_col", array())));
                // line 879
                echo "            ";
            }
            // line 880
            echo "            ";
            if ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "label_col", array(), "any", true, true)) {
                // line 881
                echo "                ";
                $context["childAttr"] = twig_array_merge((isset($context["childAttr"]) ? $context["childAttr"] : $this->getContext($context, "childAttr")), array("label_col" => $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "label_col", array())));
                // line 882
                echo "            ";
            }
            // line 883
            echo "            ";
            if ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "simple_col", array(), "any", true, true)) {
                // line 884
                echo "                ";
                $context["childAttr"] = twig_array_merge((isset($context["childAttr"]) ? $context["childAttr"] : $this->getContext($context, "childAttr")), array("simple_col" => $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "simple_col", array())));
                // line 885
                echo "            ";
            }
            // line 886
            echo "            ";
            if ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true)) {
                // line 887
                echo "                ";
                $context["childAttr"] = twig_array_merge((isset($context["childAttr"]) ? $context["childAttr"] : $this->getContext($context, "childAttr")), array("style" => $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())));
                // line 888
                echo "            ";
            }
            // line 889
            echo "            ";
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($context["child"], 'row', (isset($context["childAttr"]) ? $context["childAttr"] : $this->getContext($context, "childAttr")));
            echo "
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 891
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_d120ae2052a2850eb5fa2d4ec1008f384119e33e6466f0134f9a23c26776d50b->leave($__internal_d120ae2052a2850eb5fa2d4ec1008f384119e33e6466f0134f9a23c26776d50b_prof);

    }

    // line 894
    public function block_widget_attributes($context, array $blocks = array())
    {
        $__internal_d630957b30a1a803f783bc60ec4bc84c391e91b62ae5054e575ad685484ae068 = $this->env->getExtension("native_profiler");
        $__internal_d630957b30a1a803f783bc60ec4bc84c391e91b62ae5054e575ad685484ae068->enter($__internal_d630957b30a1a803f783bc60ec4bc84c391e91b62ae5054e575ad685484ae068_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "widget_attributes"));

        // line 895
        echo "    ";
        ob_start();
        // line 896
        echo "        id=\"";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\" name=\"";
        echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : $this->getContext($context, "full_name")), "html", null, true);
        echo "\" ";
        if ((isset($context["disabled"]) ? $context["disabled"] : $this->getContext($context, "disabled"))) {
            echo " disabled=\"disabled\"";
        }
        if ((isset($context["required"]) ? $context["required"] : $this->getContext($context, "required"))) {
            echo " required=\"required\"";
        }
        // line 897
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            if (twig_in_filter($context["attrname"], array(0 => "placeholder", 1 => "title"))) {
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($context["attrvalue"], array(), (isset($context["translation_domain"]) ? $context["translation_domain"] : $this->getContext($context, "translation_domain"))), "html", null, true);
                echo "\" ";
            } elseif (twig_in_filter($context["attrname"], array(0 => "input_group"))) {
            } else {
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\" ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 898
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_d630957b30a1a803f783bc60ec4bc84c391e91b62ae5054e575ad685484ae068->leave($__internal_d630957b30a1a803f783bc60ec4bc84c391e91b62ae5054e575ad685484ae068_prof);

    }

    // line 901
    public function block_widget_container_attributes($context, array $blocks = array())
    {
        $__internal_57d75ff0d924839ab0c907786b265ceea3a0c8ceaec46f66b39273e6bbb912db = $this->env->getExtension("native_profiler");
        $__internal_57d75ff0d924839ab0c907786b265ceea3a0c8ceaec46f66b39273e6bbb912db->enter($__internal_57d75ff0d924839ab0c907786b265ceea3a0c8ceaec46f66b39273e6bbb912db_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "widget_container_attributes"));

        // line 902
        echo "    ";
        ob_start();
        // line 903
        echo "        ";
        if (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "style", array(), "any", true, true) && (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array()) == "inline") || ($this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array()) == "horizontal")))) {
            // line 904
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("class" => trim(((("form-" . $this->getAttribute((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), "style", array())) . " ") . (($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute((isset($context["attr"]) ? $context["attr"] : null), "class", array()), "")) : (""))))));
            // line 905
            echo "            ";
            $context["attr"] = twig_array_merge((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")), array("style" => null));
            // line 906
            echo "        ";
        }
        // line 907
        echo "        ";
        if ( !twig_test_empty((isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")))) {
            echo "id=\"";
            echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
            echo "\" ";
        }
        // line 908
        echo "        ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            if (( !(null === $context["attrvalue"]) &&  !twig_test_iterable($context["attrvalue"]))) {
                echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
                echo "=\"";
                echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
                echo "\" ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 909
        echo "    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        
        $__internal_57d75ff0d924839ab0c907786b265ceea3a0c8ceaec46f66b39273e6bbb912db->leave($__internal_57d75ff0d924839ab0c907786b265ceea3a0c8ceaec46f66b39273e6bbb912db_prof);

    }

    // line 912
    public function block_button_attributes($context, array $blocks = array())
    {
        $__internal_aa3e716d30307b402edd4c2b929c411a0eda27eabfd6110db2c7a9f2be6f7773 = $this->env->getExtension("native_profiler");
        $__internal_aa3e716d30307b402edd4c2b929c411a0eda27eabfd6110db2c7a9f2be6f7773->enter($__internal_aa3e716d30307b402edd4c2b929c411a0eda27eabfd6110db2c7a9f2be6f7773_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "button_attributes"));

        // line 913
        echo "id=\"";
        echo twig_escape_filter($this->env, (isset($context["id"]) ? $context["id"] : $this->getContext($context, "id")), "html", null, true);
        echo "\" name=\"";
        echo twig_escape_filter($this->env, (isset($context["full_name"]) ? $context["full_name"] : $this->getContext($context, "full_name")), "html", null, true);
        echo "\"";
        if ((isset($context["disabled"]) ? $context["disabled"] : $this->getContext($context, "disabled"))) {
            echo " disabled=\"disabled\"";
        }
        // line 914
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["attr"]) ? $context["attr"] : $this->getContext($context, "attr")));
        foreach ($context['_seq'] as $context["attrname"] => $context["attrvalue"]) {
            echo " ";
            echo twig_escape_filter($this->env, $context["attrname"], "html", null, true);
            echo "=\"";
            echo twig_escape_filter($this->env, $context["attrvalue"], "html", null, true);
            echo "\"";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['attrname'], $context['attrvalue'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        
        $__internal_aa3e716d30307b402edd4c2b929c411a0eda27eabfd6110db2c7a9f2be6f7773->leave($__internal_aa3e716d30307b402edd4c2b929c411a0eda27eabfd6110db2c7a9f2be6f7773_prof);

    }

    public function getTemplateName()
    {
        return "BraincraftedBootstrapBundle:Form:bootstrap.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  3349 => 914,  3340 => 913,  3334 => 912,  3326 => 909,  3311 => 908,  3304 => 907,  3301 => 906,  3298 => 905,  3295 => 904,  3292 => 903,  3289 => 902,  3283 => 901,  3275 => 898,  3254 => 897,  3242 => 896,  3239 => 895,  3233 => 894,  3225 => 891,  3216 => 889,  3213 => 888,  3210 => 887,  3207 => 886,  3204 => 885,  3201 => 884,  3198 => 883,  3195 => 882,  3192 => 881,  3189 => 880,  3186 => 879,  3183 => 878,  3180 => 877,  3177 => 876,  3174 => 875,  3171 => 874,  3168 => 873,  3163 => 872,  3160 => 871,  3154 => 870,  3146 => 865,  3140 => 864,  3134 => 862,  3131 => 861,  3126 => 860,  3123 => 859,  3117 => 858,  3109 => 855,  3106 => 854,  3102 => 852,  3100 => 851,  3097 => 850,  3088 => 848,  3084 => 847,  3077 => 846,  3073 => 844,  3070 => 843,  3068 => 842,  3065 => 841,  3062 => 840,  3059 => 839,  3057 => 838,  3054 => 837,  3051 => 836,  3048 => 835,  3045 => 834,  3039 => 833,  3028 => 829,  3025 => 828,  3022 => 827,  3016 => 826,  3008 => 823,  3003 => 822,  3000 => 821,  2994 => 820,  2983 => 816,  2977 => 814,  2974 => 813,  2968 => 811,  2965 => 810,  2959 => 808,  2956 => 807,  2950 => 805,  2947 => 804,  2941 => 802,  2939 => 801,  2936 => 800,  2930 => 798,  2927 => 797,  2924 => 796,  2918 => 795,  2910 => 792,  2904 => 790,  2902 => 789,  2878 => 788,  2875 => 787,  2872 => 786,  2869 => 785,  2867 => 784,  2864 => 783,  2858 => 781,  2856 => 780,  2853 => 779,  2847 => 777,  2845 => 776,  2842 => 775,  2836 => 773,  2834 => 772,  2831 => 771,  2825 => 769,  2823 => 768,  2820 => 767,  2817 => 766,  2814 => 765,  2812 => 764,  2809 => 763,  2803 => 761,  2800 => 760,  2798 => 759,  2795 => 758,  2792 => 757,  2789 => 756,  2786 => 755,  2783 => 754,  2780 => 753,  2778 => 752,  2773 => 751,  2770 => 750,  2764 => 749,  2754 => 745,  2750 => 744,  2745 => 743,  2742 => 742,  2736 => 741,  2726 => 736,  2720 => 735,  2710 => 732,  2704 => 731,  2695 => 727,  2691 => 725,  2689 => 724,  2684 => 722,  2681 => 721,  2669 => 719,  2667 => 718,  2663 => 716,  2660 => 715,  2658 => 714,  2655 => 713,  2652 => 712,  2649 => 711,  2646 => 710,  2643 => 709,  2640 => 708,  2637 => 707,  2634 => 706,  2631 => 705,  2628 => 704,  2625 => 703,  2622 => 702,  2620 => 701,  2617 => 700,  2614 => 699,  2611 => 698,  2608 => 697,  2602 => 696,  2594 => 693,  2588 => 691,  2585 => 690,  2582 => 689,  2579 => 688,  2576 => 687,  2573 => 686,  2570 => 685,  2564 => 684,  2556 => 681,  2550 => 679,  2546 => 677,  2540 => 675,  2537 => 674,  2531 => 672,  2529 => 671,  2524 => 670,  2518 => 668,  2515 => 667,  2509 => 665,  2507 => 664,  2502 => 663,  2499 => 662,  2496 => 661,  2493 => 660,  2490 => 659,  2487 => 658,  2484 => 657,  2481 => 656,  2478 => 655,  2475 => 654,  2472 => 653,  2469 => 652,  2466 => 651,  2463 => 650,  2457 => 649,  2449 => 646,  2445 => 645,  2441 => 643,  2436 => 641,  2432 => 640,  2428 => 639,  2423 => 638,  2417 => 635,  2413 => 634,  2409 => 633,  2403 => 632,  2398 => 631,  2396 => 630,  2390 => 629,  2387 => 628,  2384 => 627,  2382 => 626,  2379 => 625,  2376 => 624,  2373 => 623,  2370 => 622,  2367 => 621,  2364 => 620,  2361 => 619,  2358 => 618,  2355 => 617,  2352 => 616,  2349 => 615,  2346 => 614,  2343 => 613,  2340 => 612,  2337 => 611,  2335 => 610,  2332 => 609,  2329 => 608,  2326 => 607,  2323 => 606,  2317 => 605,  2306 => 601,  2304 => 597,  2301 => 596,  2295 => 595,  2284 => 591,  2276 => 588,  2257 => 586,  2254 => 585,  2251 => 584,  2248 => 583,  2245 => 582,  2242 => 581,  2239 => 580,  2236 => 579,  2233 => 578,  2231 => 577,  2228 => 576,  2225 => 575,  2222 => 574,  2219 => 573,  2216 => 572,  2213 => 571,  2211 => 570,  2208 => 569,  2205 => 568,  2202 => 567,  2200 => 566,  2197 => 565,  2194 => 564,  2191 => 563,  2189 => 562,  2186 => 561,  2183 => 560,  2180 => 559,  2177 => 558,  2174 => 557,  2171 => 556,  2168 => 555,  2165 => 554,  2162 => 553,  2160 => 552,  2157 => 551,  2154 => 550,  2151 => 549,  2145 => 548,  2120 => 543,  2117 => 542,  2111 => 541,  2100 => 538,  2096 => 537,  2091 => 536,  2085 => 535,  2074 => 531,  2071 => 530,  2068 => 529,  2062 => 528,  2051 => 524,  2048 => 523,  2045 => 522,  2039 => 521,  2031 => 518,  2018 => 516,  2007 => 514,  2004 => 513,  2001 => 512,  1998 => 511,  1995 => 510,  1992 => 509,  1989 => 508,  1986 => 507,  1983 => 506,  1980 => 505,  1977 => 504,  1971 => 503,  1960 => 499,  1957 => 498,  1954 => 497,  1948 => 496,  1937 => 492,  1934 => 491,  1931 => 490,  1925 => 489,  1914 => 485,  1911 => 484,  1908 => 483,  1902 => 482,  1890 => 476,  1887 => 475,  1884 => 474,  1881 => 473,  1875 => 472,  1864 => 468,  1861 => 467,  1858 => 466,  1852 => 465,  1841 => 461,  1838 => 460,  1835 => 459,  1829 => 458,  1819 => 453,  1817 => 449,  1814 => 448,  1811 => 447,  1805 => 446,  1794 => 442,  1791 => 441,  1788 => 440,  1782 => 439,  1771 => 435,  1768 => 434,  1766 => 433,  1763 => 432,  1757 => 431,  1749 => 428,  1745 => 426,  1739 => 425,  1734 => 424,  1730 => 423,  1725 => 422,  1722 => 421,  1719 => 420,  1713 => 418,  1710 => 417,  1707 => 416,  1701 => 415,  1693 => 412,  1688 => 409,  1686 => 408,  1685 => 407,  1684 => 406,  1683 => 405,  1678 => 404,  1675 => 403,  1669 => 401,  1666 => 400,  1663 => 399,  1657 => 398,  1649 => 395,  1643 => 392,  1639 => 391,  1635 => 390,  1631 => 389,  1626 => 388,  1623 => 387,  1617 => 385,  1614 => 384,  1611 => 383,  1605 => 382,  1586 => 378,  1583 => 377,  1577 => 376,  1558 => 372,  1555 => 371,  1549 => 370,  1541 => 367,  1537 => 365,  1535 => 364,  1531 => 362,  1529 => 361,  1524 => 359,  1521 => 358,  1515 => 356,  1509 => 354,  1507 => 353,  1504 => 352,  1498 => 350,  1492 => 348,  1488 => 346,  1486 => 345,  1482 => 344,  1466 => 343,  1463 => 342,  1460 => 341,  1457 => 340,  1454 => 339,  1451 => 338,  1448 => 337,  1445 => 336,  1442 => 335,  1439 => 334,  1436 => 333,  1433 => 332,  1430 => 331,  1427 => 330,  1425 => 329,  1422 => 328,  1414 => 326,  1412 => 325,  1408 => 324,  1401 => 323,  1398 => 322,  1395 => 321,  1392 => 320,  1390 => 319,  1387 => 318,  1384 => 317,  1381 => 316,  1378 => 315,  1375 => 314,  1372 => 313,  1369 => 312,  1366 => 311,  1363 => 310,  1361 => 309,  1358 => 308,  1356 => 307,  1353 => 306,  1350 => 305,  1347 => 304,  1341 => 303,  1333 => 300,  1329 => 299,  1326 => 298,  1322 => 296,  1320 => 295,  1316 => 293,  1314 => 292,  1309 => 290,  1306 => 289,  1300 => 287,  1294 => 285,  1292 => 284,  1289 => 283,  1283 => 281,  1277 => 279,  1273 => 277,  1271 => 276,  1267 => 275,  1251 => 274,  1248 => 273,  1245 => 272,  1242 => 271,  1239 => 270,  1236 => 269,  1233 => 268,  1230 => 267,  1227 => 266,  1224 => 265,  1221 => 264,  1218 => 263,  1215 => 262,  1212 => 261,  1210 => 260,  1207 => 259,  1199 => 257,  1197 => 256,  1193 => 255,  1186 => 254,  1183 => 253,  1180 => 252,  1177 => 251,  1174 => 250,  1172 => 249,  1169 => 248,  1166 => 247,  1163 => 246,  1160 => 245,  1157 => 244,  1154 => 243,  1151 => 242,  1148 => 241,  1145 => 240,  1142 => 239,  1139 => 238,  1136 => 237,  1134 => 236,  1131 => 235,  1128 => 234,  1125 => 233,  1122 => 232,  1116 => 231,  1108 => 228,  1094 => 227,  1082 => 225,  1075 => 222,  1073 => 221,  1068 => 220,  1065 => 219,  1047 => 218,  1044 => 217,  1038 => 216,  1026 => 211,  1023 => 210,  1020 => 209,  1014 => 207,  1012 => 206,  1007 => 205,  1004 => 204,  1001 => 203,  988 => 201,  986 => 200,  979 => 199,  976 => 198,  973 => 197,  970 => 196,  964 => 195,  955 => 191,  949 => 190,  943 => 188,  937 => 186,  934 => 185,  930 => 184,  925 => 183,  922 => 182,  916 => 181,  908 => 178,  902 => 176,  896 => 174,  893 => 173,  890 => 172,  884 => 171,  876 => 168,  872 => 166,  870 => 165,  865 => 163,  862 => 162,  854 => 160,  852 => 159,  849 => 158,  846 => 157,  843 => 156,  841 => 155,  838 => 154,  835 => 153,  832 => 152,  830 => 151,  827 => 150,  824 => 149,  821 => 148,  815 => 147,  807 => 144,  803 => 142,  801 => 141,  794 => 139,  791 => 138,  789 => 137,  786 => 136,  778 => 134,  776 => 133,  773 => 132,  770 => 131,  767 => 130,  764 => 129,  761 => 128,  758 => 127,  756 => 126,  753 => 125,  750 => 124,  747 => 123,  741 => 122,  732 => 118,  722 => 116,  720 => 115,  717 => 114,  709 => 111,  701 => 108,  696 => 107,  694 => 106,  689 => 104,  685 => 103,  681 => 102,  677 => 100,  673 => 99,  667 => 97,  664 => 96,  661 => 95,  659 => 94,  656 => 93,  653 => 92,  650 => 91,  647 => 90,  644 => 89,  641 => 88,  638 => 87,  635 => 86,  632 => 85,  629 => 84,  626 => 83,  623 => 82,  617 => 81,  606 => 77,  603 => 76,  600 => 75,  597 => 74,  594 => 73,  588 => 72,  577 => 67,  572 => 66,  566 => 64,  564 => 63,  559 => 62,  556 => 61,  550 => 60,  542 => 57,  538 => 55,  535 => 54,  522 => 52,  520 => 51,  500 => 49,  497 => 48,  495 => 47,  492 => 46,  489 => 45,  486 => 44,  483 => 43,  480 => 42,  477 => 41,  474 => 40,  472 => 39,  469 => 38,  467 => 37,  464 => 36,  456 => 34,  454 => 33,  451 => 32,  448 => 31,  445 => 30,  442 => 29,  439 => 28,  436 => 27,  433 => 26,  430 => 25,  427 => 24,  424 => 23,  421 => 22,  418 => 21,  416 => 20,  413 => 19,  410 => 18,  407 => 17,  404 => 16,  398 => 15,  390 => 12,  384 => 10,  378 => 8,  375 => 7,  372 => 6,  366 => 5,  359 => 912,  356 => 911,  354 => 901,  351 => 900,  349 => 894,  346 => 893,  344 => 870,  341 => 869,  338 => 867,  336 => 858,  333 => 857,  331 => 833,  328 => 832,  326 => 826,  323 => 825,  321 => 820,  318 => 819,  316 => 795,  313 => 794,  311 => 749,  308 => 748,  306 => 741,  303 => 740,  300 => 738,  298 => 735,  295 => 734,  293 => 731,  290 => 730,  288 => 696,  285 => 695,  283 => 684,  280 => 683,  278 => 649,  275 => 648,  273 => 605,  270 => 604,  268 => 595,  265 => 594,  262 => 592,  260 => 591,  257 => 590,  255 => 548,  252 => 547,  249 => 545,  247 => 541,  244 => 540,  242 => 535,  239 => 534,  237 => 528,  234 => 527,  232 => 521,  229 => 520,  227 => 503,  224 => 502,  222 => 496,  219 => 495,  217 => 489,  214 => 488,  212 => 482,  209 => 481,  207 => 472,  204 => 471,  202 => 465,  199 => 464,  197 => 458,  194 => 457,  192 => 446,  189 => 445,  187 => 439,  184 => 438,  182 => 431,  179 => 430,  177 => 415,  174 => 414,  172 => 398,  169 => 397,  167 => 382,  164 => 381,  162 => 376,  159 => 375,  157 => 370,  154 => 369,  152 => 303,  149 => 302,  147 => 231,  144 => 230,  142 => 216,  139 => 215,  137 => 195,  134 => 194,  132 => 181,  129 => 180,  127 => 171,  124 => 170,  122 => 147,  119 => 146,  117 => 122,  114 => 121,  112 => 81,  109 => 80,  107 => 72,  104 => 71,  102 => 60,  99 => 59,  97 => 15,  94 => 14,  92 => 5,  89 => 4,  86 => 2,  14 => 1,);
    }
}
/* {% use "form_div_layout.html.twig" %}*/
/* */
/* {# Widgets #}*/
/* */
/* {% block form_widget %}*/
/*     {% spaceless %}*/
/*         {% if compound %}*/
/*             {{ block('form_widget_compound') }}*/
/*         {% else %}*/
/*             {{ block('form_widget_simple') }}*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_widget %}*/
/* */
/* {% block form_widget_simple %}*/
/*     {% spaceless %}*/
/*         {% set style = style|default(bootstrap_get_style()) %}*/
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if simple_col is not defined and bootstrap_get_simple_col() %}*/
/*             {% set simple_col = bootstrap_get_simple_col() %}*/
/*         {% endif %}*/
/*         {% if attr.simple_col is defined and attr.simple_col is not empty %}*/
/*             {% set simple_col = attr.simple_col %}*/
/*         {% endif  %}*/
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/*         {% if attr.style is defined and attr.style is not empty %}*/
/*             {% set style = attr.style %}*/
/*         {% endif %}*/
/* */
/*         {% if simple_col is defined and simple_col %}*/
/*             <div class="col-{{ col_size }}-{{ simple_col }}">*/
/*         {% endif %}*/
/* */
/*         {% set type = type|default('text') %}*/
/* */
/*         {% if style == 'inline' and (attr.placeholder is not defined or attr.placeholder is empty)  and label is not same as (false) %}*/
/*             {% if label is empty %}*/
/*                 {% set attr = attr|merge({ 'placeholder': name|humanize }) %}*/
/*             {% else %}*/
/*                 {% set attr = attr|merge({ 'placeholder': label}) %}*/
/*             {% endif %}*/
/*         {% endif %}*/
/* */
/*         {% if static_control is defined and static_control == true %}*/
/*             {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' form-control-static')|trim }) %}*/
/*             <p id="{{ id }}" {%- for attrname, attrvalue in attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}>{{ value }}</p>*/
/*         {%- else -%}*/
/*             {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' form-control')|trim }) %}*/
/*             <input type="{{ type }}" {{ block('widget_attributes') }} {% if value is not empty %}value="{{ value }}" {% endif %}>*/
/*         {%- endif %}*/
/*         {% if simple_col is defined %}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_widget_simple %}*/
/* */
/* {% block form_widget_compound %}*/
/*     {% spaceless %}*/
/*         <div {{ block('widget_container_attributes') }}>*/
/*             {% if form.parent is empty %}*/
/*                 {{ block('global_form_errors') }}*/
/*             {% endif %}*/
/*             {{ block('form_rows') }}*/
/*             {{ form_rest(form) }}*/
/*         </div>*/
/*     {% endspaceless %}*/
/* {% endblock form_widget_compound %}*/
/* */
/* {% block collection_widget %}*/
/*     {% spaceless %}*/
/*         {% if prototype is defined %}*/
/*             {% set attr = attr|merge({'data-prototype': form_row(prototype) }) %}*/
/*         {% endif %}*/
/*         {{ block('form_widget') }}*/
/*     {% endspaceless %}*/
/* {% endblock collection_widget %}*/
/* */
/* {% block bootstrap_collection_widget %}*/
/*     {% spaceless %}*/
/*         {% if prototype is defined %}*/
/*             {% set prototype_vars = {} %}*/
/*             {% if style is defined %}*/
/*                 {% set prototype_vars = prototype_vars|merge({'style': style}) %}*/
/*             {% endif %}*/
/*             {% set prototype_html = '<div class="col-xs-' ~ form.vars.sub_widget_col ~ '">' ~ form_widget(prototype, prototype_vars) ~ '</div>' %}*/
/*             {% if form.vars.allow_delete %}*/
/*                 {% set prototype_html = prototype_html ~ '<div class="col-xs-' ~ form.vars.button_col ~ '"><a href="#" class="btn btn-danger btn-sm" data-removefield="collection" data-field="__id__">' ~ form.vars.delete_button_text|trans({}, translation_domain)|parse_icons|raw ~ '</a></div>' %}*/
/*             {% endif %}*/
/*             {% set prototype_html = '<div class="row">' ~ prototype_html ~ '</div>' %}*/
/* */
/*             {% set attr = attr|merge({'data-prototype': prototype_html }) %}*/
/*             {% set attr = attr|merge({'data-prototype-name': prototype_name }) %}*/
/*         {% endif %}*/
/*         <div {{ block('widget_container_attributes') }}>*/
/*             <ul class="bc-collection list-unstyled">*/
/*                 {% for field in form %}*/
/*                     <li>*/
/*                         <div class="row">*/
/*                             <div class="col-xs-{{ form.vars.sub_widget_col }}">*/
/*                                 {{ form_widget(field) }}*/
/*                                 {{ form_errors(field) }}*/
/*                             </div>*/
/*                             {% if form.vars.allow_delete %}*/
/*                                 <div class="col-xs-{{ form.vars.button_col }}">*/
/*                                     <a href="#" class="btn btn-danger btn-sm" data-removefield="collection" data-field="{{ field.vars.id }}">{{ form.vars.delete_button_text|trans({}, translation_domain)|parse_icons|raw }}</a>*/
/*                                 </div>*/
/*                             {% endif %}*/
/*                         </div>*/
/*                     </li>*/
/*                 {% endfor %}*/
/*             </ul>*/
/*             {% if form.vars.allow_add %}*/
/*                 <a href="#" class="btn btn-primary btn-sm" data-addfield="collection" data-collection="{{ form.vars.id }}" data-prototype-name="{{ prototype_name }}">{{ form.vars.add_button_text|trans({}, translation_domain)|parse_icons|raw }}</a>*/
/*             {% endif %}*/
/*         </div>*/
/*     {% endspaceless %}*/
/* {% endblock bootstrap_collection_widget %}*/
/* */
/* {% block textarea_widget %}*/
/*     {% spaceless %}*/
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if attr.simple_col is defined and attr.simple_col is not empty %}*/
/*             {% set simple_col = attr.simple_col %}*/
/*         {% endif  %}*/
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/* */
/*         {% if simple_col is defined %}*/
/*             <div class="col-{{ col_size }}-{{ simple_col }}">*/
/*         {% endif %}*/
/* */
/*         {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' form-control')|trim }) %}*/
/* */
/*         <textarea {{ block('widget_attributes') }}>{{ value }}</textarea>*/
/* */
/*         {% if simple_col is defined %}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock textarea_widget %}*/
/* */
/* {% block file_widget %}*/
/*     {% spaceless %}*/
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if attr.simple_col is defined and attr.simple_col is not empty %}*/
/*             {% set simple_col = attr.simple_col %}*/
/*         {% endif  %}*/
/* */
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/* */
/*         {% if simple_col is defined %}*/
/*             <div class="col-{{ col_size }}-{{ simple_col }}">*/
/*         {% endif %}*/
/* */
/*         <input type="file" {{ block('widget_attributes') }}>*/
/* */
/*         {% if simple_col is defined %}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock file_widget %}*/
/* */
/* {% block choice_widget %}*/
/*     {% spaceless %}*/
/*         {% if expanded %}*/
/*             {{ block('choice_widget_expanded') }}*/
/*         {% else %}*/
/*             {{ block('choice_widget_collapsed') }}*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock choice_widget %}*/
/* */
/* {% block choice_widget_expanded %}*/
/*     {% spaceless %}*/
/*         <div {{ block('widget_container_attributes') }}>*/
/*             {% for child in form %}*/
/*                 {% if multiple %}*/
/*                     {{ checkbox_row(child, { 'no_form_group': true, 'inline' : (attr.inline is defined and attr.inline), 'label_attr': label_attr }) }}*/
/*                 {% else %}*/
/*                     {{ radio_row(child, { 'no_form_group': true, 'inline' : (attr.inline is defined and attr.inline), 'label_attr': label_attr  }) }}*/
/*                 {% endif %}*/
/*             {% endfor %}*/
/*         </div>*/
/*     {% endspaceless %}*/
/* {% endblock choice_widget_expanded %}*/
/* */
/* {% block choice_widget_collapsed %}*/
/*     {% spaceless %}*/
/*         {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' form-control')|trim }) %}*/
/* */
/*         <select {{ block('widget_attributes') }}{% if multiple %} multiple="multiple"{% endif %}>*/
/*             {% if placeholder is not none %}*/
/*                 <option {% if required %} disabled="disabled"{% if value is empty %} selected="selected"{% endif %}{% endif %} value="">{{ placeholder|trans({}, translation_domain) }}</option>*/
/*             {% endif %}*/
/*             {% if preferred_choices|length > 0 %}*/
/*                 {% set options = preferred_choices %}*/
/*                 {{ block('choice_widget_options') }}*/
/*                 {% if choices|length > 0 and separator is not none %}*/
/*                     <option disabled="disabled">{{ separator }}</option>*/
/*                 {% endif %}*/
/*             {% endif %}*/
/*             {% set options = choices %}*/
/*             {{ block('choice_widget_options') }}*/
/*         </select>*/
/*     {% endspaceless %}*/
/* {% endblock choice_widget_collapsed %}*/
/* */
/* {% block choice_widget_options %}*/
/*     {% spaceless %}*/
/*         {% for group_label, choice in options %}*/
/*             {% if choice is iterable %}*/
/*                 <optgroup label="{{ choice_translation_domain is defined ? (choice_translation_domain is same as (false) ? group_label : group_label|trans({}, choice_translation_domain)) : group_label|trans({}, translation_domain) }}">*/
/*                     {% set options = choice %}*/
/*                     {{ block('choice_widget_options') }}*/
/*                 </optgroup>*/
/*             {% else %}*/
/*                 <option value="{{ choice.value }}"{% if choice is selectedchoice(value) %} selected="selected"{% endif %}>{{ choice_translation_domain is defined ? (choice_translation_domain is same as (false) ? choice.label : choice.label|trans({}, choice_translation_domain)) : choice.label|trans({}, translation_domain) }}</option>*/
/*             {% endif %}*/
/*         {% endfor %}*/
/*     {% endspaceless %}*/
/* {% endblock choice_widget_options %}*/
/* */
/* {% block checkbox_row %}*/
/*     {% spaceless %}*/
/*         {% set style = style|default(bootstrap_get_style()) %}*/
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if attr.label_col is defined and attr.label_col is not empty %}*/
/*             {% set label_col = attr.label_col %}*/
/*         {% endif %}*/
/*         {% if attr.widget_col is defined and attr.widget_col is not empty %}*/
/*             {% set widget_col = attr.widget_col %}*/
/*         {% endif %}*/
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/*         {% if attr.style is defined and attr.style is not empty %}*/
/*             {% set style = attr.style %}*/
/*         {% endif %}*/
/* */
/*         {% set class = '' %}*/
/*         {% if align_with_widget is defined or attr.align_with_widget is defined %}*/
/*             {% set widget_col = widget_col|default(bootstrap_get_widget_col()) %}*/
/*             {% set label_col = label_col|default(bootstrap_get_label_col()) %}*/
/*             {% set class = 'col-' ~ col_size ~ '-' ~ widget_col ~ ' col-' ~ col_size ~ '-offset-' ~ label_col %}*/
/*             <div class="form-group {% if form.vars.errors|length > 0 %} has-error{% endif %}">*/
/*             <div class="{{ class }}">*/
/*         {% elseif no_form_group is not defined or no_form_group == false %}*/
/*             <div class="form-group{% if form.vars.errors|length > 0 %} has-error{% endif %}">*/
/*         {% endif %}*/
/* */
/*         {%set checkboxdata %}*/
/*         {% if label is not same as (false) %}*/
/*             {% if not compound %}*/
/*                 {% set label_attr = label_attr|merge({'for': id}) %}*/
/*             {% endif %}*/
/*             {% if inline is defined and inline %}*/
/*                 {% set label_attr = label_attr|merge({'class': (label_attr.class|default('') ~ ' checkbox-inline')|trim}) %}*/
/*             {% endif %}*/
/*             {% if required %}*/
/*                 {% set label_attr = label_attr|merge({'class': (label_attr.class|default('') ~ ' required')|trim}) %}*/
/*             {% endif %}*/
/*             {% if label is empty %}*/
/*                 {% set label = name|humanize %}*/
/*             {% endif %}*/
/*             <label{% for attrname, attrvalue in label_attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}>*/
/*             {{ block('checkbox_widget') }}*/
/*             {{ label|trans({}, translation_domain)|raw -}}*/
/*             </label>*/
/*         {% else %}*/
/*             {{ block('checkbox_widget') }}*/
/*         {% endif %}*/
/*         {{ form_errors(form) }}*/
/*         {% endset %}*/
/* */
/*         {% if inline is defined and inline %}*/
/*             {{ checkboxdata|raw }}*/
/*         {% else%}*/
/*             <div class="checkbox">{{ checkboxdata|raw }}</div>*/
/*         {% endif %}*/
/* */
/*         {{ block('form_help') }}*/
/* */
/*         {% if align_with_widget is defined or attr.align_with_widget is defined %}*/
/*             </div>*/
/*             </div>*/
/*         {% elseif no_form_group is not defined or no_form_group == false %}*/
/*             </div>*/
/*         {% endif %}*/
/* */
/*         {% if style == 'inline' %}&nbsp;{% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock checkbox_row %}*/
/* */
/* {% block radio_row %}*/
/*     {% spaceless %}*/
/*         {% set class = '' %}*/
/* */
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if attr.label_col is defined and attr.label_col is not empty %}*/
/*             {% set label_col = attr.label_col %}*/
/*         {% endif %}*/
/*         {% if attr.widget_col is defined and attr.widget_col is not empty %}*/
/*             {% set widget_col = attr.widget_col %}*/
/*         {% endif %}*/
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/* */
/*         {% if align_with_widget is defined or attr.align_with_widget is defined %}*/
/*             {% set widget_col = widget_col|default(bootstrap_get_widget_col()) %}*/
/*             {% set label_col = label_col|default(bootstrap_get_label_col()) %}*/
/*             {% set class = ' col-'~ col_size ~ '-' ~ widget_col ~ ' col-' ~ col_size ~ '-offset-' ~ label_col %}*/
/*             <div class="form-group {% if form.vars.errors|length > 0 %} has-error{% endif %}">*/
/*             <div class="{{ class }}">*/
/*         {% elseif no_form_group is not defined or no_form_group == false %}*/
/*             <div class="form-group{% if form.vars.errors|length > 0 %} has-error{% endif %}">*/
/*         {% endif %}*/
/* */
/*         {%set radiodata %}*/
/*         {% if label is not same as (false) %}*/
/*             {% if not compound %}*/
/*                 {% set label_attr = label_attr|merge({'for': id}) %}*/
/*             {% endif %}*/
/*             {% if inline is defined and inline %}*/
/*                 {% set label_attr = label_attr|merge({'class': (label_attr.class|default('') ~ ' radio-inline')|trim}) %}*/
/*             {% endif %}*/
/*             {% if required %}*/
/*                 {% set label_attr = label_attr|merge({'class': (label_attr.class|default('') ~ ' required')|trim}) %}*/
/*             {% endif %}*/
/*             {% if label is empty %}*/
/*                 {% set label = name|humanize %}*/
/*             {% endif %}*/
/*             <label{% for attrname, attrvalue in label_attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}>*/
/*             {{ block('radio_widget') }}*/
/*             {{ label|trans({}, translation_domain)|raw -}}*/
/*             </label>*/
/*         {% else %}*/
/*             {{ block('radio_widget') }}*/
/*         {% endif %}*/
/*         {{ form_errors(form) }}*/
/*         {% endset %}*/
/* */
/*         {% if inline is defined and inline %}*/
/*             {{ radiodata|raw }}*/
/*         {% else%}*/
/*             <div class="radio">{{ radiodata|raw }}</div>*/
/*         {% endif %}*/
/* */
/*         {{ block('form_help') }}*/
/* */
/*         {% if align_with_widget is defined or attr.align_with_widget is defined %}*/
/*             </div>*/
/*             </div>*/
/*         {% elseif no_form_group is not defined or no_form_group == false %}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock radio_row %}*/
/* */
/* {% block checkbox_widget %}*/
/*     {% spaceless %}*/
/*         <input type="checkbox" {{ block('widget_attributes') }}{% if value is defined %} value="{{ value }}"{% endif %}{% if checked %} checked="checked"{% endif %} />*/
/*     {% endspaceless %}*/
/* {% endblock checkbox_widget %}*/
/* */
/* {% block radio_widget %}*/
/*     {% spaceless %}*/
/*         <input type="radio" {{ block('widget_attributes') }}{% if value is defined %} value="{{ value }}"{% endif %}{% if checked %} checked="checked"{% endif %} />*/
/*     {% endspaceless %}*/
/* {% endblock radio_widget %}*/
/* */
/* {% block datetime_widget %}*/
/*     {% spaceless %}*/
/*         {% if widget == 'single_text' %}*/
/*             {{ block('form_widget_simple') }}*/
/*         {% else %}*/
/*             {% set attr = attr|merge({ 'class': 'bootstrap-datetime' }) %}*/
/*             <div {{ block('widget_container_attributes') }}>*/
/*                 {{ form_widget(form.date) }}*/
/*                 {{ form_widget(form.time) }}*/
/*                 {{ form_errors(form.date) }}*/
/*                 {{ form_errors(form.time) }}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock datetime_widget %}*/
/* */
/* {% block date_widget %}*/
/*     {% spaceless %}*/
/*         {% if widget == 'single_text' %}*/
/*             {{ block('form_widget_simple') }}*/
/*         {% else %}*/
/*             {% set attr = attr|merge({ 'class': 'bootstrap-date' }) %}*/
/*             <div {{ block('widget_container_attributes') }}>*/
/*                 {{ date_pattern|replace({*/
/*                 '{{ year }}':  form_widget(form.year),*/
/*                 '{{ month }}': form_widget(form.month),*/
/*                 '{{ day }}':   form_widget(form.day),*/
/*                 })|raw }}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock date_widget %}*/
/* */
/* {% block time_widget %}*/
/*     {% spaceless %}*/
/*         {% if widget == 'single_text' %}*/
/*             {{ block('form_widget_simple') }}*/
/*         {% else %}*/
/*             {% set vars = widget == 'text' ? { 'attr': { 'size': 1 }} : {} %}*/
/*             {% set attr = attr|merge({ 'class': 'bootstrap-time' }) %}*/
/*             <div {{ block('widget_container_attributes') }}>*/
/*                 {{ form_widget(form.hour, vars) }}*/
/*                 {% if with_minutes %}:{{ form_widget(form.minute, vars) }}{% endif %}*/
/*                 {% if with_seconds %}:{{ form_widget(form.second, vars) }}{% endif %}*/
/*             </div>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock time_widget %}*/
/* */
/* {% block number_widget %}*/
/*     {% spaceless %}*/
/*         {# type="number" doesn't work with floats #}*/
/*         {% set type = type|default('text') %}*/
/*         {{ block('form_widget_simple') }}*/
/*     {% endspaceless %}*/
/* {% endblock number_widget %}*/
/* */
/* {% block integer_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('number') %}*/
/*         {{ block('form_widget_simple') }}*/
/*     {% endspaceless %}*/
/* {% endblock integer_widget %}*/
/* */
/* {% block money_widget %}*/
/*     {% spaceless %}*/
/*         <div class="input-group">*/
/*             {{ money_pattern|replace({*/
/*             '{{ widget }}': block('form_widget_simple'),*/
/*             '{{ tag_start }}': '<span class="input-group-addon">',*/
/*             '{{ tag_end }}': '</span>'*/
/*             })|raw }}*/
/*         </div>*/
/*     {% endspaceless %}*/
/* {% endblock money_widget %}*/
/* */
/* {% block url_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('url') %}*/
/*         {{ block('form_widget_simple') }}*/
/*     {% endspaceless %}*/
/* {% endblock url_widget %}*/
/* */
/* {% block search_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('search') %}*/
/*         {{ block('form_widget_simple') }}*/
/*     {% endspaceless %}*/
/* {% endblock search_widget %}*/
/* */
/* {% block percent_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('text') %}*/
/*         <div class="input-group">*/
/*             {{ block('form_widget_simple') }}*/
/*             <span class="input-group-addon">%</span>*/
/*         </div>*/
/*     {% endspaceless %}*/
/* {% endblock percent_widget %}*/
/* */
/* {% block password_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('password') %}*/
/*         {{ block('form_widget_simple') }}*/
/*     {% endspaceless %}*/
/* {% endblock password_widget %}*/
/* */
/* {% block hidden_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('hidden') %}*/
/*         {{ block('form_widget_simple') }}*/
/*     {% endspaceless %}*/
/* {% endblock hidden_widget %}*/
/* */
/* {% block email_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('email') %}*/
/*         {{ block('form_widget_simple') }}*/
/*     {% endspaceless %}*/
/* {% endblock email_widget %}*/
/* */
/* {% block button_widget %}*/
/*     {% spaceless %}*/
/*         {% if label is empty and label is not same as (false) %}*/
/*             {% set label = name|humanize %}*/
/*         {% endif %}*/
/*         {% if type is defined and type == 'submit' %}*/
/*             {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' btn btn-'~button_class|default('primary'))|trim }) %}*/
/*         {% else %}*/
/*             {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' btn btn-'~button_class|default('default'))|trim }) %}*/
/*         {% endif %}*/
/*         {% if as_link is defined and as_link == true %}*/
/*             <a {{ block('button_attributes') }}>{% if attr.icon is defined and attr.icon != '' %}{{ icon(attr.icon) }}{% endif %}{{ label|trans({}, translation_domain) }}</a>*/
/*         {% else %}*/
/*             <button type="{{ type|default('button') }}" {{ block('button_attributes') }}>{% if attr.icon is defined and attr.icon != '' %}{{ icon(attr.icon) }}{% endif %}{{ label|trans({}, translation_domain) }}</button>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock button_widget %}*/
/* */
/* {% block submit_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('submit') %}*/
/*         {{ block('button_widget') }}*/
/*     {% endspaceless %}*/
/* {% endblock submit_widget %}*/
/* */
/* {% block reset_widget %}*/
/*     {% spaceless %}*/
/*         {% set type = type|default('reset') %}*/
/*         {{ block('button_widget') }}*/
/*     {% endspaceless %}*/
/* {% endblock reset_widget %}*/
/* */
/* {% block form_actions_widget %}*/
/*     {% for button in form.children %}*/
/*         {{ form_widget(button) }}&nbsp; {# this needs to be here due to https://github.com/twbs/bootstrap/issues/3245 #}*/
/*     {% endfor  %}*/
/* {% endblock %}*/
/* */
/* {% block bs_static_widget %}*/
/*     {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' form-control-static')|trim }) %}*/
/*     <p id="{{ id }}" {%- for attrname, attrvalue in attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}>{{ value }}</p>*/
/* {% endblock %}*/
/* */
/* {# Labels #}*/
/* */
/* {% block form_label %}*/
/*     {% spaceless %}*/
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if attr.label_col is defined and attr.label_col is not empty %}*/
/*             {% set label_col = attr.label_col %}*/
/*         {% endif %}*/
/*         {% if attr.widget_col is defined and attr.widget_col is not empty %}*/
/*             {% set widget_col = attr.widget_col %}*/
/*         {% endif %}*/
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/* */
/*         {% if label is not same as (false) %}*/
/*             {% set style = style|default(bootstrap_get_style()) %}*/
/*             {% set label_col = label_col|default(bootstrap_get_label_col()) %}*/
/* */
/*             {% if attr.style is defined and attr.style is not empty %}*/
/*                 {% set style = attr.style %}*/
/*             {% endif %}*/
/* */
/*             {% set label_attr = label_attr|merge({ 'class': (label_attr.class|default('') ~ ' control-label')|trim }) %}*/
/*             {% if style == 'horizontal' %}*/
/*                 {% set label_attr = label_attr|merge({ 'class': (label_attr.class|default('') ~ ' col-' ~ col_size ~ '-' ~ label_col)|trim }) %}*/
/*             {% elseif style == 'inline' %}*/
/*                 {% set label_attr = label_attr|merge({ 'class': (label_attr.class|default('') ~ ' sr-only')|trim }) %}*/
/*             {% endif %}*/
/* */
/*             {% if not compound %}*/
/*                 {% set label_attr = label_attr|merge({'for': id}) %}*/
/*             {% endif %}*/
/*             {% if required %}*/
/*                 {% set label_attr = label_attr|merge({'class': (label_attr.class|default('') ~ ' required')|trim}) %}*/
/*             {% endif %}*/
/*             {% if label is empty %}*/
/*                 {% set label = name|humanize %}*/
/*             {% endif %}*/
/*             <label{% for attrname, attrvalue in label_attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}>{{ label|trans({}, translation_domain)|raw }}</label>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_label %}*/
/* */
/* {% block button_label %}{% endblock %}*/
/* */
/* {# Rows #}*/
/* */
/* {% block repeated_row %}*/
/*     {% spaceless %}*/
/*         {#*/
/*         No need to render the errors here, as all errors are mapped*/
/*         to the first child (see RepeatedTypeValidatorExtension).*/
/*         #}*/
/*         {{ block('form_rows') }}*/
/*     {% endspaceless %}*/
/* {% endblock repeated_row %}*/
/* */
/* {% block form_row %}*/
/*     {% spaceless %}*/
/*         {% set style = style|default(bootstrap_get_style()) %}*/
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if attr.label_col is defined and attr.label_col is not empty %}*/
/*             {% set label_col = attr.label_col %}*/
/*         {% endif %}*/
/*         {% if attr.widget_col is defined and attr.widget_col is not empty %}*/
/*             {% set widget_col = attr.widget_col %}*/
/*             {% if label is same as (false) and label_col is defined %}*/
/*                 {% set widget_col = widget_col + label_col %}*/
/*             {% endif %}*/
/*         {% endif %}*/
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/*         {% if attr.style is defined and attr.style is not empty %}*/
/*             {% set style = attr.style %}*/
/*         {% endif %}*/
/* */
/*         {% set label_col = label_col|default(bootstrap_get_label_col()) %}*/
/*         {% set widget_col = widget_col|default(bootstrap_get_widget_col()) %}*/
/* */
/*         <div class="form-group{% if form.vars.errors|length > 0 %} has-error{% endif %}">*/
/*             {% if style == 'horizontal' %}*/
/*                 {{ form_label(form) }}*/
/*                 <div class="col-{{ col_size }}-{{ widget_col }}">*/
/*                     {{ block('form_input_group') }}*/
/*                     {{ block('form_help') }}*/
/*                     {{ form_errors(form) }}*/
/*                 </div>*/
/*             {% else %}*/
/*                 {{ form_label(form) }}*/
/*                 {{ block('form_input_group') }}*/
/*                 {{ block('form_help') }}*/
/*                 {{ form_errors(form) }}*/
/*             {% endif %}*/
/*         </div>*/
/* */
/*         {% if style == 'inline' %}&nbsp;{% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_row %}*/
/* */
/* {% block form_input_group %}*/
/*     {% spaceless %}*/
/*         {% if attr.input_group is defined and attr.input_group is not empty %}*/
/*             {% set input_group = attr.input_group %}*/
/*         {% endif %}*/
/*         {% set input_group = input_group|default({}) %}*/
/*         {% if input_group is not empty %}*/
/*             {% set ig_size_class = '' %}*/
/*             {% if input_group.size is defined and input_group.size == 'large' %}*/
/*                 {% set ig_size_class = ' input-group-lg' %}*/
/*             {% endif  %}*/
/*             {% if input_group.size is defined and input_group.size == 'small' %}*/
/*                 {% set ig_size_class = ' input-group-sm' %}*/
/*             {% endif  %}*/
/*             <div class="input-group{{ ig_size_class }}">*/
/*                 {% if input_group.prepend is defined and input_group.prepend is not empty %}*/
/*                     <span class="input-group-addon">{{ input_group.prepend|raw|parse_icons }}</span>*/
/*                 {% endif %}*/
/*                 {% if input_group.button_prepend is defined and input_group.button_prepend is not empty %}*/
/*                     <span class="input-group-btn">{{ form_widget(input_group_button_prepend) }}</span>*/
/*                 {% endif %}*/
/*                 {{ form_widget(form) }}*/
/*                 {% if input_group.button_append is defined and input_group.button_append is not empty %}*/
/*                     <span class="input-group-btn">{{ form_widget(input_group_button_append) }}</span>*/
/*                 {% endif %}*/
/*                 {% if input_group.append is defined and input_group.append is not empty %}*/
/*                     <span class="input-group-addon">{{ input_group.append|raw|parse_icons }}</span>*/
/*                 {% endif %}*/
/*             </div>*/
/*         {% else %}*/
/*             {{ form_widget(form) }}*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_input_group %}*/
/* */
/* {% block form_help %}*/
/*     {% spaceless %}*/
/*         {% if attr.help_text is defined and attr.help_text is not empty %}*/
/*             {% set help_text = attr.help_text %}*/
/*         {% endif %}*/
/*         {% set help_text = help_text|default('') %}*/
/*         {% if help_text is not empty %}*/
/*             <span class="help-block">{{ help_text|trans({}, translation_domain) }}</span>*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_help %}*/
/* */
/* {% block button_row %}*/
/*     {% spaceless %}*/
/*         {% set style = style|default(bootstrap_get_style()) %}*/
/*         {% set col_size = col_size|default(bootstrap_get_col_size()) %}*/
/* */
/*         {% if attr.label_col is defined and attr.label_col is not empty %}*/
/*             {% set label_col = attr.label_col %}*/
/*         {% endif %}*/
/*         {% if attr.widget_col is defined and attr.widget_col is not empty %}*/
/*             {% set widget_col = attr.widget_col %}*/
/*         {% endif %}*/
/*         {% if attr.col_size is defined and attr.col_size is not empty %}*/
/*             {% set col_size = attr.col_size %}*/
/*         {% endif %}*/
/*         {% if attr.style is defined and attr.style is not empty %}*/
/*             {% set style = attr.style %}*/
/*         {% endif %}*/
/* */
/*         {% set label_col = label_col|default(bootstrap_get_label_col()) %}*/
/*         {% set widget_col = widget_col|default(bootstrap_get_widget_col()) %}*/
/* */
/*         <div class="form-group">*/
/*             {% if style == 'horizontal' %}*/
/*                 <div class="col-{{ col_size }}-offset-{{ label_col }} col-{{ col_size }}-{{ widget_col }}">*/
/*             {% endif %}*/
/* */
/*             {{ form_widget(form) }}*/
/* */
/*             {% if style == 'horizontal' %}*/
/*                 </div>*/
/*             {% endif %}*/
/*         </div>*/
/*     {% endspaceless %}*/
/* {% endblock button_row %}*/
/* */
/* {% block hidden_row %}*/
/*     {{ form_widget(form) }}*/
/* {% endblock hidden_row %}*/
/* */
/* {% block form_actions_row %}*/
/*     {{ block('button_row')  }}*/
/* {% endblock %}*/
/* */
/* {# Misc #}*/
/* */
/* {% block form %}*/
/*     {% spaceless %}*/
/*         {{ form_start(form) }}*/
/*         {{ form_widget(form) }}*/
/*         {{ form_end(form) }}*/
/*     {% endspaceless %}*/
/* {% endblock form %}*/
/* */
/* {% block form_start %}*/
/*     {% spaceless %}*/
/*         {{ bootstrap_backup_form_settings() }}*/
/*         {% set method = method|upper %}*/
/*         {% if method in ["GET", "POST"] %}*/
/*             {% set form_method = method %}*/
/*         {% else %}*/
/*             {% set form_method = "POST" %}*/
/*         {% endif %}*/
/* */
/*         {% if style is defined %}*/
/*             {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' form-' ~ style)|trim }) %}*/
/*             {{ bootstrap_set_style(style) }}*/
/*         {% endif %}*/
/* */
/*         {% if form.vars.errors|length > 0 %}*/
/*             {% set attr = attr|merge({ 'class': (attr.class|default('') ~ ' has-global-errors')|trim }) %}*/
/*         {% endif %}*/
/* */
/*         {% if col_size is defined %}*/
/*             {{ bootstrap_set_col_size(col_size) }}*/
/*         {% endif %}*/
/* */
/*         {% if widget_col is defined %}*/
/*             {{ bootstrap_set_widget_col(widget_col) }}*/
/*         {% endif %}*/
/* */
/*         {% if label_col is defined %}*/
/*             {{ bootstrap_set_label_col(label_col) }}*/
/*         {% endif %}*/
/* */
/*         {% if simple_col is defined %}*/
/*             {{ bootstrap_set_simple_col(simple_col) }}*/
/*         {% endif %}*/
/* */
/*         {% if attr.role is not defined or attr.role is empty %}*/
/*             {% set attr = attr|merge({ 'role': 'form' }) %}*/
/*         {% endif %}*/
/* */
/*         <form  name="{{ form.vars.name }}" method="{{ form_method|lower }}" action="{{ action }}"{% for attrname, attrvalue in attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}{% if multipart %} enctype="multipart/form-data"{% endif %}>*/
/*         {% if form_method != method %}*/
/*             <input type="hidden" name="_method" value="{{ method }}" />*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_start %}*/
/* */
/* {% block form_end %}*/
/*     {% spaceless %}*/
/*         {% if not render_rest is defined or render_rest %}*/
/*             {{ form_rest(form) }}*/
/*         {% endif %}*/
/*         </form>*/
/*         {% if bootstrap_get_style() %}*/
/*             {{ bootstrap_set_style('') }}*/
/*         {% endif %}*/
/*         {% if bootstrap_get_col_size() %}*/
/*             {{ bootstrap_set_col_size('lg') }}*/
/*         {% endif %}*/
/*         {% if bootstrap_get_widget_col() %}*/
/*             {{ bootstrap_set_widget_col(10) }}*/
/*         {% endif %}*/
/*         {% if bootstrap_get_label_col() %}*/
/*             {{ bootstrap_set_label_col(2) }}*/
/*         {% endif %}*/
/*         {% if bootstrap_get_simple_col() %}*/
/*             {{ bootstrap_set_simple_col(false) }}*/
/*         {% endif %}*/
/*     {{ bootstrap_restore_form_settings() }}*/
/*     {% endspaceless %}*/
/* {% endblock form_end %}*/
/* */
/* {% block form_enctype %}*/
/*     {% spaceless %}*/
/*         {% if multipart %}enctype="multipart/form-data"{% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_enctype %}*/
/* */
/* {% block global_form_errors %}*/
/*     {% if errors|length > 0 %}*/
/*         {% set global_errors = true %}*/
/*         {{ block('form_errors') }}*/
/*     {% endif %}*/
/* {% endblock global_form_errors %}*/
/* */
/* {% block form_errors %}*/
/*     {% spaceless %}*/
/*         {% set global_errors = global_errors|default(false) %}*/
/*         {% set style = style|default(bootstrap_get_style()) %}*/
/* */
/*         {% if attr.style is defined and attr.style is not empty %}*/
/*             {% set style = attr.style %}*/
/*         {% endif %}*/
/* */
/*         {% if errors|length > 0 %}*/
/*             {% if global_errors %}*/
/*                 <div class="alert alert-danger">*/
/*             {% endif %}*/
/*             <ul{% if not global_errors %} class="help-block"{% endif %}>*/
/*                 {% for error in errors %}*/
/*                     <li>{{ error.message }}</li>*/
/*                 {% endfor %}*/
/*             </ul>*/
/*             {% if global_errors == true %}*/
/*                 </div>*/
/*             {% endif %}*/
/*         {% endif %}*/
/*     {% endspaceless %}*/
/* {% endblock form_errors %}*/
/* */
/* {% block form_rest %}*/
/*     {% spaceless %}*/
/*         {% for child in form %}*/
/*             {% if not child.rendered %}*/
/*                 {{ form_row(child) }}*/
/*             {% endif %}*/
/*         {% endfor %}*/
/*     {% endspaceless %}*/
/* {% endblock form_rest %}*/
/* */
/* {# Support #}*/
/* */
/* {% block form_rows %}*/
/*     {% spaceless %}*/
/*         {% for child in form %}*/
/*             {% set childAttr = {} %}*/
/*             {% if attr.col_size is defined %}*/
/*                 {% set childAttr = childAttr|merge({ 'col_size': attr.col_size }) %}*/
/*             {% endif %}*/
/*             {% if attr.widget_col is defined %}*/
/*                 {% set childAttr = childAttr|merge({ 'widget_col': attr.widget_col }) %}*/
/*             {% endif %}*/
/*             {% if attr.label_col is defined %}*/
/*                 {% set childAttr = childAttr|merge({ 'label_col': attr.label_col }) %}*/
/*             {% endif %}*/
/*             {% if attr.simple_col is defined %}*/
/*                 {% set childAttr = childAttr|merge({ 'simple_col': attr.simple_col }) %}*/
/*             {% endif %}*/
/*             {% if attr.style is defined %}*/
/*                 {% set childAttr = childAttr|merge({ 'style': attr.style }) %}*/
/*             {% endif %}*/
/*             {{ form_row(child, childAttr) }}*/
/*         {% endfor %}*/
/*     {% endspaceless %}*/
/* {% endblock form_rows %}*/
/* */
/* {% block widget_attributes %}*/
/*     {% spaceless %}*/
/*         id="{{ id }}" name="{{ full_name }}" {% if disabled %} disabled="disabled"{% endif %}{% if required %} required="required"{% endif %}*/
/*         {% for attrname, attrvalue in attr %}{% if attrname in ['placeholder', 'title'] %}{{ attrname }}="{{ attrvalue|trans({}, translation_domain) }}" {% elseif attrname in ['input_group'] %}{% else %}{{ attrname }}="{{ attrvalue }}" {% endif %}{% endfor %}*/
/*     {% endspaceless %}*/
/* {% endblock widget_attributes %}*/
/* */
/* {% block widget_container_attributes %}*/
/*     {% spaceless %}*/
/*         {% if attr.style is defined and (attr.style == 'inline' or attr.style == 'horizontal') %}*/
/*             {% set attr = attr|merge({ 'class': ('form-'~attr.style~' '~attr.class|default(''))|trim }) %}*/
/*             {% set attr = attr|merge({ 'style': null }) %}*/
/*         {% endif %}*/
/*         {% if id is not empty %}id="{{ id }}" {% endif %}*/
/*         {% for attrname, attrvalue in attr %}{% if attrvalue is not null and (attrvalue is not iterable) %}{{ attrname }}="{{ attrvalue }}" {% endif %}{% endfor %}*/
/*     {% endspaceless %}*/
/* {% endblock widget_container_attributes %}*/
/* */
/* {% block button_attributes -%}*/
/*         id="{{ id }}" name="{{ full_name }}"{% if disabled %} disabled="disabled"{% endif %}*/
/*         {%- for attrname, attrvalue in attr %} {{ attrname }}="{{ attrvalue }}"{% endfor %}*/
/* {% endblock button_attributes %}*/
/* */
