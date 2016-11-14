<?php

/* @Framework/Form/collection_widget.html.php */
class __TwigTemplate_e6f758b4f518b7f86fe4586daf5463c276a93f77952f215d89eb9db80c32d022 extends Twig_Template
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
        $__internal_95647f3667c0019c3a73c758c41f95aebe13bd6fb03fbae2a6cc4913bcd0b68d = $this->env->getExtension("native_profiler");
        $__internal_95647f3667c0019c3a73c758c41f95aebe13bd6fb03fbae2a6cc4913bcd0b68d->enter($__internal_95647f3667c0019c3a73c758c41f95aebe13bd6fb03fbae2a6cc4913bcd0b68d_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/collection_widget.html.php"));

        // line 1
        echo "<?php if (isset(\$prototype)): ?>
    <?php \$attr['data-prototype'] = \$view->escape(\$view['form']->row(\$prototype)) ?>
<?php endif ?>
<?php echo \$view['form']->widget(\$form, array('attr' => \$attr)) ?>
";
        
        $__internal_95647f3667c0019c3a73c758c41f95aebe13bd6fb03fbae2a6cc4913bcd0b68d->leave($__internal_95647f3667c0019c3a73c758c41f95aebe13bd6fb03fbae2a6cc4913bcd0b68d_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/collection_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if (isset($prototype)): ?>*/
/*     <?php $attr['data-prototype'] = $view->escape($view['form']->row($prototype)) ?>*/
/* <?php endif ?>*/
/* <?php echo $view['form']->widget($form, array('attr' => $attr)) ?>*/
/* */
