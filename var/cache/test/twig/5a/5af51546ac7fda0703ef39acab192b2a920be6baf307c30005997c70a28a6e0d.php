<?php

/* @Framework/Form/money_widget.html.php */
class __TwigTemplate_a9e0a50b7729228c29a14162707a8c52efbe5cad508feaa09e8e5d04d1cbfccc extends Twig_Template
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
        $__internal_bd4b7ddcd91aab348f3a4cdef20fb397201003c77e185a6846cc12f4e7aafce5 = $this->env->getExtension("native_profiler");
        $__internal_bd4b7ddcd91aab348f3a4cdef20fb397201003c77e185a6846cc12f4e7aafce5->enter($__internal_bd4b7ddcd91aab348f3a4cdef20fb397201003c77e185a6846cc12f4e7aafce5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/money_widget.html.php"));

        // line 1
        echo "<?php echo str_replace('";
        echo twig_escape_filter($this->env, (isset($context["widget"]) ? $context["widget"] : $this->getContext($context, "widget")), "html", null, true);
        echo "', \$view['form']->block(\$form, 'form_widget_simple'), \$money_pattern) ?>
";
        
        $__internal_bd4b7ddcd91aab348f3a4cdef20fb397201003c77e185a6846cc12f4e7aafce5->leave($__internal_bd4b7ddcd91aab348f3a4cdef20fb397201003c77e185a6846cc12f4e7aafce5_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/money_widget.html.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php echo str_replace('{{ widget }}', $view['form']->block($form, 'form_widget_simple'), $money_pattern) ?>*/
/* */
