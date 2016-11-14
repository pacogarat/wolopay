<?php

/* @Framework/Form/choice_widget_expanded.html.php */
class __TwigTemplate_7212d532c2ff4d11c20671bbaa534cb6dbfff1873177b9f29e35c4a242edb43c extends Twig_Template
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
        $__internal_dfddb00068650c2aea9f7a4fbe2cb4f8e773242d365a250c88126cf3dbbe54ac = $this->env->getExtension("native_profiler");
        $__internal_dfddb00068650c2aea9f7a4fbe2cb4f8e773242d365a250c88126cf3dbbe54ac->enter($__internal_dfddb00068650c2aea9f7a4fbe2cb4f8e773242d365a250c88126cf3dbbe54ac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Framework/Form/choice_widget_expanded.html.php"));

        // line 1
        echo "<div <?php echo \$view['form']->block(\$form, 'widget_container_attributes') ?>>
<?php foreach (\$form as \$child): ?>
    <?php echo \$view['form']->widget(\$child) ?>
    <?php echo \$view['form']->label(\$child, null, array('translation_domain' => \$choice_translation_domain)) ?>
<?php endforeach ?>
</div>
";
        
        $__internal_dfddb00068650c2aea9f7a4fbe2cb4f8e773242d365a250c88126cf3dbbe54ac->leave($__internal_dfddb00068650c2aea9f7a4fbe2cb4f8e773242d365a250c88126cf3dbbe54ac_prof);

    }

    public function getTemplateName()
    {
        return "@Framework/Form/choice_widget_expanded.html.php";
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }
}
/* <div <?php echo $view['form']->block($form, 'widget_container_attributes') ?>>*/
/* <?php foreach ($form as $child): ?>*/
/*     <?php echo $view['form']->widget($child) ?>*/
/*     <?php echo $view['form']->label($child, null, array('translation_domain' => $choice_translation_domain)) ?>*/
/* <?php endforeach ?>*/
/* </div>*/
/* */
