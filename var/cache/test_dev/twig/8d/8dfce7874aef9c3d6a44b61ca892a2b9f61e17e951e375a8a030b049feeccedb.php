<?php

/* @Framework/Form/datetime_widget.html.php */
class __TwigTemplate_97627c59881612cd76f7e8f98f6ea542274fffc37e919d723b16bb831fcfa620 extends Twig_Template
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
        $__internal_a69ca453d682b1593fc366de2f5f875e9d00f3029f54776ffb24d31fd4f73b5f = $this->env->getExtension("native_profiler");
        $__internal_a69ca453d682b1593fc366de2f5f875e9d00f3029f54776ffb24d31fd4f73b5f->enter($__internal_a69ca453d682b1593fc366de2f5f875e9d00f3029f54776ffb24d31fd4f73b5f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/datetime_widget.html.php"));

        // line 1
        echo "<?php if (\$widget == 'single_text'): ?>
    <?php echo \$view['form']->block(\$form, 'form_widget_simple'); ?>
<?php else: ?>
    <div <?php echo \$view['form']->block(\$form, 'widget_container_attributes') ?>>
        <?php echo \$view['form']->widget(\$form['date']).' '.\$view['form']->widget(\$form['time']) ?>
    </div>
<?php endif ?>
";
        
        $__internal_a69ca453d682b1593fc366de2f5f875e9d00f3029f54776ffb24d31fd4f73b5f->leave($__internal_a69ca453d682b1593fc366de2f5f875e9d00f3029f54776ffb24d31fd4f73b5f_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/datetime_widget.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <?php if ($widget == 'single_text'): ?>*/
/*     <?php echo $view['form']->block($form, 'form_widget_simple'); ?>*/
/* <?php else: ?>*/
/*     <div <?php echo $view['form']->block($form, 'widget_container_attributes') ?>>*/
/*         <?php echo $view['form']->widget($form['date']).' '.$view['form']->widget($form['time']) ?>*/
/*     </div>*/
/* <?php endif ?>*/
/* */
