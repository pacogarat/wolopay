<?php

/* @Framework/Form/radio_widget.html.php */
class __TwigTemplate_b54037fa5fe0747a6cd410ac65651459a784825976d5db4569d31ebe64d5f450 extends Twig_Template
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
        $__internal_2907ea48946515b51be1f089b40a8be404f2d8cfbf4f6d7e32b5acabc3693540 = $this->env->getExtension("native_profiler");
        $__internal_2907ea48946515b51be1f089b40a8be404f2d8cfbf4f6d7e32b5acabc3693540->enter($__internal_2907ea48946515b51be1f089b40a8be404f2d8cfbf4f6d7e32b5acabc3693540_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/radio_widget.html.php"));

        // line 1
        echo "<input type=\"radio\"
    <?php echo \$view['form']->block(\$form, 'widget_attributes') ?>
    value=\"<?php echo \$view->escape(\$value) ?>\"
    <?php if (\$checked): ?> checked=\"checked\"<?php endif ?>
/>
";
        
        $__internal_2907ea48946515b51be1f089b40a8be404f2d8cfbf4f6d7e32b5acabc3693540->leave($__internal_2907ea48946515b51be1f089b40a8be404f2d8cfbf4f6d7e32b5acabc3693540_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/radio_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <input type="radio"*/
/*     <?php echo $view['form']->block($form, 'widget_attributes') ?>*/
/*     value="<?php echo $view->escape($value) ?>"*/
/*     <?php if ($checked): ?> checked="checked"<?php endif ?>*/
/* />*/
/* */
