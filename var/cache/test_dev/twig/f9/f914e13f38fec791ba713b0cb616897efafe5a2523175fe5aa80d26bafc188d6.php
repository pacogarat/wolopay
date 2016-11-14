<?php

/* @Framework/Form/form.html.php */
class __TwigTemplate_27b7997c4cf23ea8e6c73a578ffe6c267b07e98ff86e3a1031c74d775df8cb2e extends Twig_Template
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
        $__internal_8e82dbce7b4391ab0565a6c001f9151253b0a4a7ff2d7a2bfa2790a51b96caa1 = $this->env->getExtension("native_profiler");
        $__internal_8e82dbce7b4391ab0565a6c001f9151253b0a4a7ff2d7a2bfa2790a51b96caa1->enter($__internal_8e82dbce7b4391ab0565a6c001f9151253b0a4a7ff2d7a2bfa2790a51b96caa1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form.html.php"));

        // line 1
        echo "<?php echo \$view['form']->start(\$form) ?>
    <?php echo \$view['form']->widget(\$form) ?>
<?php echo \$view['form']->end(\$form) ?>
";
        
        $__internal_8e82dbce7b4391ab0565a6c001f9151253b0a4a7ff2d7a2bfa2790a51b96caa1->leave($__internal_8e82dbce7b4391ab0565a6c001f9151253b0a4a7ff2d7a2bfa2790a51b96caa1_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php echo $view['form']->start($form) ?>*/
/*     <?php echo $view['form']->widget($form) ?>*/
/* <?php echo $view['form']->end($form) ?>*/
/* */
