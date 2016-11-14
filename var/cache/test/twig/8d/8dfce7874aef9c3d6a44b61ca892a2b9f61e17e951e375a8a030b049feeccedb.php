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
        $__internal_9d672e7d703cc5e7ad1bfac639a3184eda57be8ea45d0fe853a33b8e24bf601f = $this->env->getExtension("native_profiler");
        $__internal_9d672e7d703cc5e7ad1bfac639a3184eda57be8ea45d0fe853a33b8e24bf601f->enter($__internal_9d672e7d703cc5e7ad1bfac639a3184eda57be8ea45d0fe853a33b8e24bf601f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/datetime_widget.html.php"));

        // line 1
        echo "<?php if (\$widget == 'single_text'): ?>
    <?php echo \$view['form']->block(\$form, 'form_widget_simple'); ?>
<?php else: ?>
    <div <?php echo \$view['form']->block(\$form, 'widget_container_attributes') ?>>
        <?php echo \$view['form']->widget(\$form['date']).' '.\$view['form']->widget(\$form['time']) ?>
    </div>
<?php endif ?>
";
        
        $__internal_9d672e7d703cc5e7ad1bfac639a3184eda57be8ea45d0fe853a33b8e24bf601f->leave($__internal_9d672e7d703cc5e7ad1bfac639a3184eda57be8ea45d0fe853a33b8e24bf601f_prof);

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
