<?php

/* @Framework/Form/textarea_widget.html.php */
class __TwigTemplate_dcc9d52666f90694c46a0cb6c184516c119339b04736af2e07f22c1bd04232e3 extends Twig_Template
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
        $__internal_e11c2ec2e41eb2f75a1dc6c817fd0866c3410e4058abdd9dfb67d596902cbb79 = $this->env->getExtension("native_profiler");
        $__internal_e11c2ec2e41eb2f75a1dc6c817fd0866c3410e4058abdd9dfb67d596902cbb79->enter($__internal_e11c2ec2e41eb2f75a1dc6c817fd0866c3410e4058abdd9dfb67d596902cbb79_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/textarea_widget.html.php"));

        // line 1
        echo "<textarea <?php echo \$view['form']->block(\$form, 'widget_attributes') ?>><?php echo \$view->escape(\$value) ?></textarea>
";
        
        $__internal_e11c2ec2e41eb2f75a1dc6c817fd0866c3410e4058abdd9dfb67d596902cbb79->leave($__internal_e11c2ec2e41eb2f75a1dc6c817fd0866c3410e4058abdd9dfb67d596902cbb79_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/textarea_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <textarea <?php echo $view['form']->block($form, 'widget_attributes') ?>><?php echo $view->escape($value) ?></textarea>*/
/* */
