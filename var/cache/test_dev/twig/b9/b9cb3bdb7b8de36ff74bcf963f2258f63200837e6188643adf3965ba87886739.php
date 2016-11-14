<?php

/* @Framework/Form/choice_widget.html.php */
class __TwigTemplate_798d70f4f0d52c2d7cbaeb2509863c15e74df247c38b5d3cbc4907f84f7131d9 extends Twig_Template
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
        $__internal_ce28bc38ce87c0a13b574005c8b7fe1a90b4793cf30928356c18bd0041775125 = $this->env->getExtension("native_profiler");
        $__internal_ce28bc38ce87c0a13b574005c8b7fe1a90b4793cf30928356c18bd0041775125->enter($__internal_ce28bc38ce87c0a13b574005c8b7fe1a90b4793cf30928356c18bd0041775125_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/choice_widget.html.php"));

        // line 1
        echo "<?php if (\$expanded): ?>
<?php echo \$view['form']->block(\$form, 'choice_widget_expanded') ?>
<?php else: ?>
<?php echo \$view['form']->block(\$form, 'choice_widget_collapsed') ?>
<?php endif ?>
";
        
        $__internal_ce28bc38ce87c0a13b574005c8b7fe1a90b4793cf30928356c18bd0041775125->leave($__internal_ce28bc38ce87c0a13b574005c8b7fe1a90b4793cf30928356c18bd0041775125_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/choice_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if ($expanded): ?>*/
/* <?php echo $view['form']->block($form, 'choice_widget_expanded') ?>*/
/* <?php else: ?>*/
/* <?php echo $view['form']->block($form, 'choice_widget_collapsed') ?>*/
/* <?php endif ?>*/
/* */
