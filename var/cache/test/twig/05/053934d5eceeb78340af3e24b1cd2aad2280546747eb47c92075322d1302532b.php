<?php

/* SonataAdminBundle::empty_layout.html.twig */
class __TwigTemplate_05b8f76e47a46fb4b229dcf0f6beb84232df25373c2cd3db2f17e32d2593abb4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->blocks = array(
            'sonata_header' => array($this, 'block_sonata_header'),
            'sonata_left_side' => array($this, 'block_sonata_left_side'),
            'sonata_nav' => array($this, 'block_sonata_nav'),
            'sonata_breadcrumb' => array($this, 'block_sonata_breadcrumb'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'sonata_wrapper' => array($this, 'block_sonata_wrapper'),
            'sonata_page_content' => array($this, 'block_sonata_page_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        // line 12
        return $this->loadTemplate($this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : $this->getContext($context, "admin_pool")), "getTemplate", array(0 => "layout"), "method"), "SonataAdminBundle::empty_layout.html.twig", 12);
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_796e6772465c067cacac22d4ee24f951f5502033b78b78b7b23b66abbbc3c569 = $this->env->getExtension("native_profiler");
        $__internal_796e6772465c067cacac22d4ee24f951f5502033b78b78b7b23b66abbbc3c569->enter($__internal_796e6772465c067cacac22d4ee24f951f5502033b78b78b7b23b66abbbc3c569_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "SonataAdminBundle::empty_layout.html.twig"));

        $this->getParent($context)->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_796e6772465c067cacac22d4ee24f951f5502033b78b78b7b23b66abbbc3c569->leave($__internal_796e6772465c067cacac22d4ee24f951f5502033b78b78b7b23b66abbbc3c569_prof);

    }

    // line 14
    public function block_sonata_header($context, array $blocks = array())
    {
        $__internal_c3413bd0ac8531f483683e1bd93dd187ac4f8845be4f6d5a1aea07fecd588ddd = $this->env->getExtension("native_profiler");
        $__internal_c3413bd0ac8531f483683e1bd93dd187ac4f8845be4f6d5a1aea07fecd588ddd->enter($__internal_c3413bd0ac8531f483683e1bd93dd187ac4f8845be4f6d5a1aea07fecd588ddd_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_header"));

        
        $__internal_c3413bd0ac8531f483683e1bd93dd187ac4f8845be4f6d5a1aea07fecd588ddd->leave($__internal_c3413bd0ac8531f483683e1bd93dd187ac4f8845be4f6d5a1aea07fecd588ddd_prof);

    }

    // line 15
    public function block_sonata_left_side($context, array $blocks = array())
    {
        $__internal_dd5f23a67dd3a2fa76cc0d58a6963c12cdb383068a774c0545286c2e0d5b2b20 = $this->env->getExtension("native_profiler");
        $__internal_dd5f23a67dd3a2fa76cc0d58a6963c12cdb383068a774c0545286c2e0d5b2b20->enter($__internal_dd5f23a67dd3a2fa76cc0d58a6963c12cdb383068a774c0545286c2e0d5b2b20_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_left_side"));

        
        $__internal_dd5f23a67dd3a2fa76cc0d58a6963c12cdb383068a774c0545286c2e0d5b2b20->leave($__internal_dd5f23a67dd3a2fa76cc0d58a6963c12cdb383068a774c0545286c2e0d5b2b20_prof);

    }

    // line 16
    public function block_sonata_nav($context, array $blocks = array())
    {
        $__internal_bf094787008a92b9e0fdb833271ca43cba2e704b59d8465216cebec727837b0c = $this->env->getExtension("native_profiler");
        $__internal_bf094787008a92b9e0fdb833271ca43cba2e704b59d8465216cebec727837b0c->enter($__internal_bf094787008a92b9e0fdb833271ca43cba2e704b59d8465216cebec727837b0c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_nav"));

        
        $__internal_bf094787008a92b9e0fdb833271ca43cba2e704b59d8465216cebec727837b0c->leave($__internal_bf094787008a92b9e0fdb833271ca43cba2e704b59d8465216cebec727837b0c_prof);

    }

    // line 17
    public function block_sonata_breadcrumb($context, array $blocks = array())
    {
        $__internal_57f4208c32d27efe782d1343936f5af838deb9a3ee6e821c93ab8cd574134e33 = $this->env->getExtension("native_profiler");
        $__internal_57f4208c32d27efe782d1343936f5af838deb9a3ee6e821c93ab8cd574134e33->enter($__internal_57f4208c32d27efe782d1343936f5af838deb9a3ee6e821c93ab8cd574134e33_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_breadcrumb"));

        
        $__internal_57f4208c32d27efe782d1343936f5af838deb9a3ee6e821c93ab8cd574134e33->leave($__internal_57f4208c32d27efe782d1343936f5af838deb9a3ee6e821c93ab8cd574134e33_prof);

    }

    // line 19
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_23a1ed82a246c30b0d90f63a0348c4312053fd061f3b642384bcce9336be9f48 = $this->env->getExtension("native_profiler");
        $__internal_23a1ed82a246c30b0d90f63a0348c4312053fd061f3b642384bcce9336be9f48->enter($__internal_23a1ed82a246c30b0d90f63a0348c4312053fd061f3b642384bcce9336be9f48_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 20
        echo "    ";
        $this->displayParentBlock("stylesheets", $context, $blocks);
        echo "

    <style>
        .content {
            margin: 0px;
            padding: 0px;
        }
    </style>

";
        
        $__internal_23a1ed82a246c30b0d90f63a0348c4312053fd061f3b642384bcce9336be9f48->leave($__internal_23a1ed82a246c30b0d90f63a0348c4312053fd061f3b642384bcce9336be9f48_prof);

    }

    // line 31
    public function block_sonata_wrapper($context, array $blocks = array())
    {
        $__internal_a4a04c14303ac0c22fbedb2490f8acccc2378418a28c021a8fddf80484880a78 = $this->env->getExtension("native_profiler");
        $__internal_a4a04c14303ac0c22fbedb2490f8acccc2378418a28c021a8fddf80484880a78->enter($__internal_a4a04c14303ac0c22fbedb2490f8acccc2378418a28c021a8fddf80484880a78_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_wrapper"));

        // line 32
        echo "    ";
        $this->displayBlock('sonata_page_content', $context, $blocks);
        
        $__internal_a4a04c14303ac0c22fbedb2490f8acccc2378418a28c021a8fddf80484880a78->leave($__internal_a4a04c14303ac0c22fbedb2490f8acccc2378418a28c021a8fddf80484880a78_prof);

    }

    public function block_sonata_page_content($context, array $blocks = array())
    {
        $__internal_cc9b4b405ad7382a23bad5d4b0a0c01ff6a3722bf54ad862e4913af4b21f73f2 = $this->env->getExtension("native_profiler");
        $__internal_cc9b4b405ad7382a23bad5d4b0a0c01ff6a3722bf54ad862e4913af4b21f73f2->enter($__internal_cc9b4b405ad7382a23bad5d4b0a0c01ff6a3722bf54ad862e4913af4b21f73f2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "sonata_page_content"));

        // line 33
        echo "        ";
        $this->displayParentBlock("sonata_page_content", $context, $blocks);
        echo "
    ";
        
        $__internal_cc9b4b405ad7382a23bad5d4b0a0c01ff6a3722bf54ad862e4913af4b21f73f2->leave($__internal_cc9b4b405ad7382a23bad5d4b0a0c01ff6a3722bf54ad862e4913af4b21f73f2_prof);

    }

    public function getTemplateName()
    {
        return "SonataAdminBundle::empty_layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  126 => 33,  113 => 32,  107 => 31,  89 => 20,  83 => 19,  72 => 17,  61 => 16,  50 => 15,  39 => 14,  24 => 12,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% extends admin_pool.getTemplate('layout') %}*/
/* */
/* {% block sonata_header %}{% endblock %}*/
/* {% block sonata_left_side %}{% endblock %}*/
/* {% block sonata_nav %}{% endblock %}*/
/* {% block sonata_breadcrumb %}{% endblock %}*/
/* */
/* {% block stylesheets %}*/
/*     {{ parent() }}*/
/* */
/*     <style>*/
/*         .content {*/
/*             margin: 0px;*/
/*             padding: 0px;*/
/*         }*/
/*     </style>*/
/* */
/* {% endblock %}*/
/* */
/* {% block sonata_wrapper %}*/
/*     {% block sonata_page_content %}*/
/*         {{ parent() }}*/
/*     {% endblock %}*/
/* {% endblock %}*/
/* */
