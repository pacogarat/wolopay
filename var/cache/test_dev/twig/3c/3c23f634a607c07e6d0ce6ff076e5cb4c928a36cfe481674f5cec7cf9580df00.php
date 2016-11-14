<?php

/* @Framework/Form/form_widget_simple.html.php */
class __TwigTemplate_9dd090c33aea05fd5a159dfadff1df1103b19958734451c943b812e159259be7 extends Twig_Template
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
        $__internal_44a01c0122bbc6a44222c76c6104c367d9286c936b22e4e662927d779223704a = $this->env->getExtension("native_profiler");
        $__internal_44a01c0122bbc6a44222c76c6104c367d9286c936b22e4e662927d779223704a->enter($__internal_44a01c0122bbc6a44222c76c6104c367d9286c936b22e4e662927d779223704a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_widget_simple.html.php"));

        // line 1
        echo "<input type=\"<?php echo isset(\$type) ? \$view->escape(\$type) : 'text' ?>\" <?php echo \$view['form']->block(\$form, 'widget_attributes') ?><?php if (!empty(\$value) || is_numeric(\$value)): ?> value=\"<?php echo \$view->escape(\$value) ?>\"<?php endif ?> />
";
        
        $__internal_44a01c0122bbc6a44222c76c6104c367d9286c936b22e4e662927d779223704a->leave($__internal_44a01c0122bbc6a44222c76c6104c367d9286c936b22e4e662927d779223704a_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_widget_simple.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <input type="<?php echo isset($type) ? $view->escape($type) : 'text' ?>" <?php echo $view['form']->block($form, 'widget_attributes') ?><?php if (!empty($value) || is_numeric($value)): ?> value="<?php echo $view->escape($value) ?>"<?php endif ?> />*/
/* */
