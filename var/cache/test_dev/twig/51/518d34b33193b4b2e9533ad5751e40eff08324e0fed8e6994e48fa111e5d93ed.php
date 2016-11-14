<?php

/* @Framework/Form/form_widget.html.php */
class __TwigTemplate_a78f83d5ee60b466f7c7bb2061d74b0891905c90b93d2c20c36354c778ddad45 extends Twig_Template
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
        $__internal_d1322de2569b947596b01aa81fd179531e5e421a51610a85c3652783d7786d34 = $this->env->getExtension("native_profiler");
        $__internal_d1322de2569b947596b01aa81fd179531e5e421a51610a85c3652783d7786d34->enter($__internal_d1322de2569b947596b01aa81fd179531e5e421a51610a85c3652783d7786d34_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/form_widget.html.php"));

        // line 1
        echo "<?php if (\$compound): ?>
<?php echo \$view['form']->block(\$form, 'form_widget_compound')?>
<?php else: ?>
<?php echo \$view['form']->block(\$form, 'form_widget_simple')?>
<?php endif ?>
";
        
        $__internal_d1322de2569b947596b01aa81fd179531e5e421a51610a85c3652783d7786d34->leave($__internal_d1322de2569b947596b01aa81fd179531e5e421a51610a85c3652783d7786d34_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/form_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if ($compound): ?>*/
/* <?php echo $view['form']->block($form, 'form_widget_compound')?>*/
/* <?php else: ?>*/
/* <?php echo $view['form']->block($form, 'form_widget_simple')?>*/
/* <?php endif ?>*/
/* */
