<?php

/* @Framework/Form/form_row.html.php */
class __TwigTemplate_2eaa45c083a7796578c5bcffeaf900edfc542fe97e246bc0a26e2f356db59792 extends Twig_Template
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
        $__internal_78256efa4e5e046e59b0fd3e9e2565f8eb22905285a673f47fffcfb0886cebf5 = $this->env->getExtension("native_profiler");
        $__internal_78256efa4e5e046e59b0fd3e9e2565f8eb22905285a673f47fffcfb0886cebf5->enter($__internal_78256efa4e5e046e59b0fd3e9e2565f8eb22905285a673f47fffcfb0886cebf5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_row.html.php"));

        // line 1
        echo "<div>
    <?php echo \$view['form']->label(\$form) ?>
    <?php echo \$view['form']->errors(\$form) ?>
    <?php echo \$view['form']->widget(\$form) ?>
</div>
";
        
        $__internal_78256efa4e5e046e59b0fd3e9e2565f8eb22905285a673f47fffcfb0886cebf5->leave($__internal_78256efa4e5e046e59b0fd3e9e2565f8eb22905285a673f47fffcfb0886cebf5_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_row.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <div>*/
/*     <?php echo $view['form']->label($form) ?>*/
/*     <?php echo $view['form']->errors($form) ?>*/
/*     <?php echo $view['form']->widget($form) ?>*/
/* </div>*/
/* */
