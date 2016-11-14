<?php

/* @Framework/Form/form_widget_compound.html.php */
class __TwigTemplate_4e83249826086592060dcf5f328b7c2859bdf5ff9aa039345ea4752691267b6f extends Twig_Template
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
        $__internal_dabe5675136f518dd2a6e0a882bb7a4774ccf7ed28b5db3719751da13afd7258 = $this->env->getExtension("native_profiler");
        $__internal_dabe5675136f518dd2a6e0a882bb7a4774ccf7ed28b5db3719751da13afd7258->enter($__internal_dabe5675136f518dd2a6e0a882bb7a4774ccf7ed28b5db3719751da13afd7258_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_widget_compound.html.php"));

        // line 1
        echo "<div <?php echo \$view['form']->block(\$form, 'widget_container_attributes') ?>>
    <?php if (!\$form->parent && \$errors): ?>
    <?php echo \$view['form']->errors(\$form) ?>
    <?php endif ?>
    <?php echo \$view['form']->block(\$form, 'form_rows') ?>
    <?php echo \$view['form']->rest(\$form) ?>
</div>
";
        
        $__internal_dabe5675136f518dd2a6e0a882bb7a4774ccf7ed28b5db3719751da13afd7258->leave($__internal_dabe5675136f518dd2a6e0a882bb7a4774ccf7ed28b5db3719751da13afd7258_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_widget_compound.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <div <?php echo $view['form']->block($form, 'widget_container_attributes') ?>>*/
/*     <?php if (!$form->parent && $errors): ?>*/
/*     <?php echo $view['form']->errors($form) ?>*/
/*     <?php endif ?>*/
/*     <?php echo $view['form']->block($form, 'form_rows') ?>*/
/*     <?php echo $view['form']->rest($form) ?>*/
/* </div>*/
/* */
