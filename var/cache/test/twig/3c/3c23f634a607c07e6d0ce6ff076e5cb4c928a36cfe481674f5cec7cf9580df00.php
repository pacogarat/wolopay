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
        $__internal_085f1c8bba24343a148b22db8f92e1341fda20cca5e94be9fa4ca976e9a351e6 = $this->env->getExtension("native_profiler");
        $__internal_085f1c8bba24343a148b22db8f92e1341fda20cca5e94be9fa4ca976e9a351e6->enter($__internal_085f1c8bba24343a148b22db8f92e1341fda20cca5e94be9fa4ca976e9a351e6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_widget_simple.html.php"));

        // line 1
        echo "<input type=\"<?php echo isset(\$type) ? \$view->escape(\$type) : 'text' ?>\" <?php echo \$view['form']->block(\$form, 'widget_attributes') ?><?php if (!empty(\$value) || is_numeric(\$value)): ?> value=\"<?php echo \$view->escape(\$value) ?>\"<?php endif ?> />
";
        
        $__internal_085f1c8bba24343a148b22db8f92e1341fda20cca5e94be9fa4ca976e9a351e6->leave($__internal_085f1c8bba24343a148b22db8f92e1341fda20cca5e94be9fa4ca976e9a351e6_prof);

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
