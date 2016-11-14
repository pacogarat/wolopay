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
        $__internal_6b519c81ebb08bac9e2f70e2f20e71505954a11d94aa00c3cdb3241270463657 = $this->env->getExtension("native_profiler");
        $__internal_6b519c81ebb08bac9e2f70e2f20e71505954a11d94aa00c3cdb3241270463657->enter($__internal_6b519c81ebb08bac9e2f70e2f20e71505954a11d94aa00c3cdb3241270463657_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/checkbox_widget.html.php"));

        // line 1
        echo "<input type=\"checkbox\"
    <?php echo \$view['form']->block(\$form, 'widget_attributes') ?>
    <?php if (strlen(\$value) > 0): ?> value=\"<?php echo \$view->escape(\$value) ?>\"<?php endif ?>
    <?php if (\$checked): ?> checked=\"checked\"<?php endif ?>
/>
";
        
        $__internal_6b519c81ebb08bac9e2f70e2f20e71505954a11d94aa00c3cdb3241270463657->leave($__internal_6b519c81ebb08bac9e2f70e2f20e71505954a11d94aa00c3cdb3241270463657_prof);

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
