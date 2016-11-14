<?php

/* @Framework/Form/checkbox_widget.html.php */
class __TwigTemplate_f5b772582bde50ad3eb5200ccf35edc54fc6911265af25415ee6ba0b4a7221b6 extends Twig_Template
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
        $__internal_37924a76d2bdb455ae9566f2dd18475e50e013cef8170658017abd05b5ebc3be = $this->env->getExtension("native_profiler");
        $__internal_37924a76d2bdb455ae9566f2dd18475e50e013cef8170658017abd05b5ebc3be->enter($__internal_37924a76d2bdb455ae9566f2dd18475e50e013cef8170658017abd05b5ebc3be_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/checkbox_widget.html.php"));

        // line 1
        echo "<input type=\"checkbox\"
    <?php echo \$view['form']->block(\$form, 'widget_attributes') ?>
    <?php if (strlen(\$value) > 0): ?> value=\"<?php echo \$view->escape(\$value) ?>\"<?php endif ?>
    <?php if (\$checked): ?> checked=\"checked\"<?php endif ?>
/>
";
        
        $__internal_37924a76d2bdb455ae9566f2dd18475e50e013cef8170658017abd05b5ebc3be->leave($__internal_37924a76d2bdb455ae9566f2dd18475e50e013cef8170658017abd05b5ebc3be_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/checkbox_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <input type="checkbox"*/
/*     <?php echo $view['form']->block($form, 'widget_attributes') ?>*/
/*     <?php if (strlen($value) > 0): ?> value="<?php echo $view->escape($value) ?>"<?php endif ?>*/
/*     <?php if ($checked): ?> checked="checked"<?php endif ?>*/
/* />*/
/* */
